<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_personal_tienda_model extends Base_Model {

    public function __construct(){
        parent::__construct();
    }

    private function perfil_actual(){
        return (int) $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));
    }

    public function perfil_actual_publico(){
        return $this->perfil_actual();
    }

    private function usuario_actual(){
        return (int) $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
    }

    /**
     * Perfiles habilitados según el sitio anterior:
     * 1 Administrador Strategix, 2 Atención a clientes, 3 Administrador Axalta,
     * 4 Gerente Regional, 5 Ejecutivo, 6 Administrador Distribuidor,
     * 8 Responsable de Tienda.
     * No se habilita a 7 Personal de Tienda ni 9 Maestro Pintor.
     */
    private function perfiles_permitidos(){
        return array(1,2,3,4,5,6,8,10);
    }

    public function acceso_permitido(){
        return in_array($this->perfil_actual(), $this->perfiles_permitidos(), true);
    }

    public function es_callcenter(){
        return $this->perfil_actual() === 2;
    }

    /**
     * Perfiles globales: Admin Strategix, Atención Clientes y Admin Axalta.
     */
    public function puede_ver_todas_distribuidoras(){
        return in_array($this->perfil_actual(), array(1,2,3,10), true);
    }

    /**
     * Perfiles con alcance limitado por distribuidoras asignadas:
     * 4 Gerente Regional, 5 Ejecutivo, 6 Administrador Distribuidor,
     * 8 Responsable de Tienda.
     */
    private function filtro_distribuidores_asignados($alias = 'D'){
        $perfilId  = $this->perfil_actual();
        $usuarioId = $this->usuario_actual();

        if (in_array($perfilId, array(4,5,6,8), true)) {
            return " AND EXISTS (
                        SELECT 1
                        FROM UsuariosDistribuidores UDX_SCOPE
                        WHERE UDX_SCOPE.DistribuidorId = {$alias}.DistribuidorId
                          AND UDX_SCOPE.UsuarioId = {$usuarioId}
                    ) ";
        }

        return '';
    }

    private function filtro_distribuidor_seleccionado($distribuidorId, $alias = 'D'){
        $distribuidorId = (int) $distribuidorId;

        if ($distribuidorId > 0) {
            return " AND {$alias}.DistribuidorId = {$distribuidorId} ";
        }

        if ($distribuidorId < 0) {
            return " AND 1 = 0 ";
        }

        return '';
    }

    private function escape_like_manual($str){
        $str = str_replace('!',  '!!', $str);
        $str = str_replace('%',  '!%', $str);
        $str = str_replace('_',  '!_', $str);
        $str = str_replace('[',  '![', $str);
        return $str;
    }

    private function filtro_texto_distribuidor($codigo, $nombre, $aliasDD = 'DD'){
        $where = '';

        $codigo = trim((string) $codigo);
        if ($codigo !== '') {
            $codigo = $this->escape_like_manual($codigo);
            $where .= " AND CAST({$aliasDD}.DistribuidorDetalleCodigo AS NVARCHAR(100)) LIKE '%{$codigo}%' ESCAPE '!' ";
        }

        $nombre = trim((string) $nombre);
        if ($nombre !== '') {
            $nombre = $this->escape_like_manual($nombre);
            $where .= " AND (
                            CAST({$aliasDD}.DistribuidorDetalleRazonSocial AS NVARCHAR(500)) LIKE '%{$nombre}%' ESCAPE '!'
                         OR CAST({$aliasDD}.DistribuidorDetalleNombreComercial AS NVARCHAR(500)) LIKE '%{$nombre}%' ESCAPE '!'
                        ) ";
        }

        return $where;
    }

    public function cmb_distribuidores(){
        if (!$this->acceso_permitido()) {
            return array();
        }

        $filtroAsignados = $this->filtro_distribuidores_asignados('D');

        $sql = "
            ;WITH DD_ULT AS (
                SELECT
                    DD.*,
                    ROW_NUMBER() OVER (
                        PARTITION BY DD.DistribuidorId
                        ORDER BY DD.DistribuidorDetalleId DESC
                    ) AS rn
                FROM DistribuidoresDetalles DD
            )
            SELECT DISTINCT
                D.DistribuidorId,
                ISNULL(CAST(DD.DistribuidorDetalleCodigo AS NVARCHAR(100)), '') AS Codigo,
                LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500)), ''))) AS NombreComercial,
                LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleRazonSocial AS NVARCHAR(500)), ''))) AS RazonSocial,
                CASE
                    WHEN LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500)), ''))) <> ''
                        THEN LTRIM(RTRIM(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500))))
                    ELSE LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleRazonSocial AS NVARCHAR(500)), '')))
                END AS NombreMostrar
            FROM Distribuidores D
            INNER JOIN DD_ULT DD
                ON DD.DistribuidorId = D.DistribuidorId
               AND DD.rn = 1
               AND DD.DistribuidorDetalleFechaBaja IS NULL
            WHERE D.DistribuidorFechaBaja IS NULL
              {$filtroAsignados}
            ORDER BY D.DistribuidorId ASC
        ";

        return $this->db->query($sql)->result();
    }

    public function datos($distribuidorId = 0, $codigo = '', $nombre = ''){
        if (!$this->acceso_permitido()) {
            return array();
        }

        if ($this->es_callcenter()) {
            return $this->datos_callcenter($distribuidorId, $codigo, $nombre);
        }

        return $this->datos_estandar($distribuidorId, $codigo, $nombre);
    }

    /**
     * Reporte estándar tomado del Reporte de Participantes anterior:
     * perfiles objetivo antiguos 5,6,9 => perfiles nuevos 6,7,8.
     */
    private function datos_estandar($distribuidorId, $codigo, $nombre){
        $filtroAsignados      = $this->filtro_distribuidores_asignados('D');
        $filtroDistribuidor   = $this->filtro_distribuidor_seleccionado($distribuidorId, 'D');
        $filtroTextoDist      = $this->filtro_texto_distribuidor($codigo, $nombre, 'DD');

        $sql = "
            ;WITH DD_ULT AS (
                SELECT
                    DD.*,
                    ROW_NUMBER() OVER (
                        PARTITION BY DD.DistribuidorId
                        ORDER BY DD.DistribuidorDetalleId DESC
                    ) AS rn
                FROM DistribuidoresDetalles DD
            ),
            UD_ULT AS (
                SELECT
                    UD.*,
                    ROW_NUMBER() OVER (
                        PARTITION BY UD.UsuarioId
                        ORDER BY
                            CASE WHEN UD.UsuarioDetalleFechaBaja IS NULL THEN 0 ELSE 1 END,
                            UD.UsuarioDetalleId DESC
                    ) AS rn
                FROM UsuariosDetalles UD
            ),
            EJECUTIVOS AS (
                SELECT
                    UDX_EJ.DistribuidorId,
                    U_EJ.UsuarioId AS EjecutivoId,
                    LTRIM(RTRIM(
                        ISNULL(CAST(UD_EJ.UsuarioDetalleNombre AS NVARCHAR(250)), '') 
                    )) AS Ejecutivo,
                    ROW_NUMBER() OVER (
                        PARTITION BY UDX_EJ.DistribuidorId
                        ORDER BY U_EJ.UsuarioId ASC
                    ) AS rn
                FROM Usuarios U_EJ
                INNER JOIN UD_ULT UD_EJ
                    ON UD_EJ.UsuarioId = U_EJ.UsuarioId
                   AND UD_EJ.rn = 1
                   AND UD_EJ.UsuarioDetalleFechaBaja IS NULL
                INNER JOIN UsuariosDistribuidores UDX_EJ
                    ON UDX_EJ.UsuarioId = U_EJ.UsuarioId
                WHERE U_EJ.PerfilId = 5
                  AND U_EJ.UsuarioFechaBajaParticipante IS NULL
                  AND U_EJ.UsuarioFechaBajaDistribuidora IS NULL
            )
            SELECT DISTINCT
                U.UsuarioId,
                LTRIM(RTRIM(
                    ISNULL(CAST(UD.UsuarioDetalleNombre AS NVARCHAR(250)), '')
                )) AS Nombre,
                ISNULL(CAST(UD.UsuarioDetalleEmail AS NVARCHAR(250)), '') AS Email,
                ISNULL(CAST(P.PerfilDescripcion AS NVARCHAR(250)), '') AS PerfilDescripcion,
                U.PerfilId,
                ISNULL(CAST(UD.UsuarioDetalleCelular AS NVARCHAR(100)), '') AS Celular,
                D.DistribuidorId,
                ISNULL(CAST(DD.DistribuidorDetalleCodigo AS NVARCHAR(100)), '') AS DistribuidorDetalleCodigo,
                LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleRazonSocial AS NVARCHAR(500)), ''))) AS DistribuidorDetalleRazonSocial,
                LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500)), ''))) AS DistribuidorDetalleNombreComercial,
                ISNULL(CAST(EJ.EjecutivoId AS NVARCHAR(50)), '') AS EjecutivoId,
                ISNULL(CAST(EJ.Ejecutivo AS NVARCHAR(500)), '') AS Ejecutivo
            FROM Usuarios U
            INNER JOIN UD_ULT UD
                ON UD.UsuarioId = U.UsuarioId
               AND UD.rn = 1
               AND UD.UsuarioDetalleFechaBaja IS NULL
            INNER JOIN Perfiles P
                ON P.PerfilId = U.PerfilId
            INNER JOIN UsuariosDistribuidores UX
                ON UX.UsuarioId = U.UsuarioId
            INNER JOIN Distribuidores D
                ON D.DistribuidorId = UX.DistribuidorId
               AND D.DistribuidorFechaBaja IS NULL
            INNER JOIN DD_ULT DD
                ON DD.DistribuidorId = D.DistribuidorId
               AND DD.rn = 1
               AND DD.DistribuidorDetalleFechaBaja IS NULL
            LEFT JOIN EJECUTIVOS EJ
                ON EJ.DistribuidorId = D.DistribuidorId
               AND EJ.rn = 1
            WHERE U.UsuarioFechaBajaParticipante IS NULL
              AND U.UsuarioFechaBajaDistribuidora IS NULL
              AND U.PerfilId IN (6,7,8)
              {$filtroAsignados}
              {$filtroDistribuidor}
              {$filtroTextoDist}
            ORDER BY Nombre ASC, U.UsuarioId ASC, D.DistribuidorId ASC
        ";

        return $this->db->query($sql)->result();
    }

    /**
     * Variante del sitio anterior ReporteParticipanteCallCenter:
     * Atención Clientes ve usuarios activos con distribuidoras concatenadas,
     * excluyendo Maestro Pintor nuevo PerfilId 9.
     */
    private function datos_callcenter($distribuidorId, $codigo, $nombre){
        $filtroDistribuidor = '';
        $distribuidorId     = (int) $distribuidorId;

        if ($distribuidorId > 0) {
            $filtroDistribuidor = " AND EXISTS (
                                        SELECT 1
                                        FROM UsuariosDistribuidores UDX_F
                                        WHERE UDX_F.UsuarioId = U.UsuarioId
                                          AND UDX_F.DistribuidorId = {$distribuidorId}
                                    ) ";
        } elseif ($distribuidorId < 0) {
            $filtroDistribuidor = ' AND 1 = 0 ';
        }

        $filtroTextoDist = $this->filtro_texto_distribuidor($codigo, $nombre, 'DD_FILTER');

        $sql = "
            ;WITH DD_ULT AS (
                SELECT
                    DD.*,
                    ROW_NUMBER() OVER (
                        PARTITION BY DD.DistribuidorId
                        ORDER BY DD.DistribuidorDetalleId DESC
                    ) AS rn
                FROM DistribuidoresDetalles DD
            ),
            UD_ULT AS (
                SELECT
                    UD.*,
                    ROW_NUMBER() OVER (
                        PARTITION BY UD.UsuarioId
                        ORDER BY
                            CASE WHEN UD.UsuarioDetalleFechaBaja IS NULL THEN 0 ELSE 1 END,
                            UD.UsuarioDetalleId DESC
                    ) AS rn
                FROM UsuariosDetalles UD
            )
            SELECT DISTINCT
                U.UsuarioId,
                LTRIM(RTRIM(
                    ISNULL(CAST(UD.UsuarioDetalleNombre AS NVARCHAR(250)), '')
                )) AS Nombre,
                ISNULL(CAST(UD.UsuarioDetalleEmail AS NVARCHAR(250)), '') AS Email,
                ISNULL(CAST(P.PerfilDescripcion AS NVARCHAR(250)), '') AS PerfilDescripcion,
                U.PerfilId,
                ISNULL(CAST(UD.UsuarioDetalleCelular AS NVARCHAR(100)), '') AS Celular,
                ISNULL(STUFF((
                    SELECT ' || ' +
                           CAST(D2.DistribuidorId AS NVARCHAR(50)) + ' - ' +
                           ISNULL(CAST(DD2.DistribuidorDetalleCodigo AS NVARCHAR(100)), '') + ' - ' +
                           CASE
                               WHEN LTRIM(RTRIM(ISNULL(CAST(DD2.DistribuidorDetalleNombreComercial AS NVARCHAR(500)), ''))) <> ''
                                   THEN LTRIM(RTRIM(CAST(DD2.DistribuidorDetalleNombreComercial AS NVARCHAR(500))))
                               ELSE LTRIM(RTRIM(ISNULL(CAST(DD2.DistribuidorDetalleRazonSocial AS NVARCHAR(500)), '')))
                           END
                    FROM UsuariosDistribuidores UDX2
                    INNER JOIN Distribuidores D2
                        ON D2.DistribuidorId = UDX2.DistribuidorId
                       AND D2.DistribuidorFechaBaja IS NULL
                    INNER JOIN DD_ULT DD2
                        ON DD2.DistribuidorId = D2.DistribuidorId
                       AND DD2.rn = 1
                       AND DD2.DistribuidorDetalleFechaBaja IS NULL
                    WHERE UDX2.UsuarioId = U.UsuarioId
                    ORDER BY D2.DistribuidorId ASC
                    FOR XML PATH(''), TYPE
                ).value('.', 'NVARCHAR(MAX)'), 1, 4, ''), '') AS Distribuidoras
            FROM Usuarios U
            INNER JOIN UD_ULT UD
                ON UD.UsuarioId = U.UsuarioId
               AND UD.rn = 1
               AND UD.UsuarioDetalleFechaBaja IS NULL
            INNER JOIN Perfiles P
                ON P.PerfilId = U.PerfilId
            INNER JOIN UsuariosDistribuidores UX
                ON UX.UsuarioId = U.UsuarioId
            INNER JOIN Distribuidores D_FILTER
                ON D_FILTER.DistribuidorId = UX.DistribuidorId
               AND D_FILTER.DistribuidorFechaBaja IS NULL
            INNER JOIN DD_ULT DD_FILTER
                ON DD_FILTER.DistribuidorId = D_FILTER.DistribuidorId
               AND DD_FILTER.rn = 1
               AND DD_FILTER.DistribuidorDetalleFechaBaja IS NULL
            WHERE U.UsuarioFechaBajaParticipante IS NULL
              AND U.UsuarioFechaBajaDistribuidora IS NULL
              AND U.PerfilId <> 9
              {$filtroDistribuidor}
              {$filtroTextoDist}
            ORDER BY Nombre ASC, U.UsuarioId ASC
        ";

        return $this->db->query($sql)->result();
    }
}
