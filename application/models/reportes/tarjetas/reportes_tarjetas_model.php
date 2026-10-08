<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_tarjetas_model extends Base_Model {

    public function __construct(){
        parent::__construct();
    }

    private function perfil_actual(){
        return (int) $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));
    }

    private function usuario_actual(){
        return (int) $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
    }

    private function permite_tarjetas_sin_distribuidor(){
        return in_array($this->perfil_actual(), array(1, 2, 3), true);
    }

    private function filtro_distribuidores_asignados($alias = 'DD'){
        $perfilId  = $this->perfil_actual();
        $usuarioId = $this->usuario_actual();

        if (in_array($perfilId, array(4,5,6,7,8), true)) {
            return " AND EXISTS (
                        SELECT 1
                        FROM UsuariosDistribuidores UDX
                        WHERE UDX.DistribuidorId = {$alias}.DistribuidorId
                          AND UDX.UsuarioId = {$usuarioId}
                    ) ";
        }

        return '';
    }

    public function cmb_distribuidores(){
        $filtroAsignados = $this->filtro_distribuidores_asignados('DD');

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
                DD.DistribuidorId,
                ISNULL(CAST(DD.DistribuidorDetalleCodigo AS NVARCHAR(100)), '') AS Codigo,
                LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500)), ''))) AS NombreComercial,
                LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleRazonSocial AS NVARCHAR(500)), ''))) AS RazonSocial,
                CASE
                    WHEN LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500)), ''))) <> ''
                        THEN LTRIM(RTRIM(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500))))
                    ELSE LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleRazonSocial AS NVARCHAR(500)), '')))
                END AS NombreMostrar
            FROM Tarjetas T
            INNER JOIN Distribuidores D
                ON D.DistribuidorId = T.DistribuidorId
               AND D.DistribuidorFechaBaja IS NULL
            INNER JOIN DD_ULT DD
                ON DD.DistribuidorId = T.DistribuidorId
               AND DD.rn = 1
               AND DD.DistribuidorDetalleFechaBaja IS NULL
               AND DD.DistribuidorDetalleFechaActivacion IS NOT NULL
            WHERE T.TarjetaFechaBaja IS NULL
              AND T.TarjetaEstatusId IN (1, 2)
              {$filtroAsignados}
            ORDER BY DD.DistribuidorId ASC
        ";

        return $this->db->query($sql)->result();
    }

    public function datos($distribuidorId){
        $distribuidorId = (int) $distribuidorId;

        if ($distribuidorId === 0 && !$this->permite_tarjetas_sin_distribuidor()) {
            return array();
        }

        $where = '';
        $filtroAsignados = '';

        if ($distribuidorId === 0) {
            $where = ' WHERE T.DistribuidorId IS NULL ';
        } else {
            if ($distribuidorId < 0) {
                return array();
            }

            $where = " WHERE T.DistribuidorId = {$distribuidorId}
                         AND D.DistribuidorFechaBaja IS NULL
                         AND DD.DistribuidorId IS NOT NULL ";
            $filtroAsignados = $this->filtro_distribuidores_asignados('DD');
        }

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
            SELECT
                T.TarjetaId,
                ISNULL(CAST(T.TarjetaNumero AS NVARCHAR(100)), '') AS TarjetaNumero,
                T.DistribuidorId,
                ISNULL(CAST(DD.DistribuidorDetalleCodigo AS NVARCHAR(100)), '') AS DistribuidorDetalleCodigo,
                LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleRazonSocial AS NVARCHAR(500)), ''))) AS DistribuidorDetalleRazonSocial,
                LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleNombreComercial AS NVARCHAR(500)), ''))) AS DistribuidorDetalleNombreComercial,
                CASE
                    WHEN T.DistribuidorId IS NULL THEN 'TARJETAS SIN DISTRIBUIDOR'
                    ELSE
                        CAST(T.DistribuidorId AS NVARCHAR(50)) + ' - ' +
                        ISNULL(CAST(DD.DistribuidorDetalleCodigo AS NVARCHAR(100)), '') + ' - ' +
                        LTRIM(RTRIM(ISNULL(CAST(DD.DistribuidorDetalleRazonSocial AS NVARCHAR(500)), '')))
                END AS Distribuidor,
                CONVERT(VARCHAR(10), T.TarjetaFechaRegistro, 103) AS TarjetaFechaRegistro,
                ISNULL(CONVERT(VARCHAR(10), T.TarjetaFechaBaja, 103), '') AS TarjetaFechaBaja,
                ISNULL(CAST(TE.TarjetaEstatusDescripcion AS NVARCHAR(100)), '') AS TarjetaEstatusDescripcion,
                CASE
                    WHEN T.UsuarioId IS NULL THEN ''
                    ELSE
                        CAST(T.UsuarioId AS NVARCHAR(50)) + ' - ' +
                        LTRIM(RTRIM(
                            ISNULL(CAST(UD.UsuarioDetalleNombre AS NVARCHAR(250)), '')
                        ))
                END AS Participante,
                -- En el sitio anterior esta columna repite el estatus de la tarjeta.
                ISNULL(CAST(TE.TarjetaEstatusDescripcion AS NVARCHAR(100)), '') AS EstatusParticipante,
                ISNULL(CAST(P.PerfilDescripcion AS NVARCHAR(100)), '') AS PerfilDescripcion
            FROM Tarjetas T
            LEFT JOIN Distribuidores D
                ON D.DistribuidorId = T.DistribuidorId
            LEFT JOIN DD_ULT DD
                ON DD.DistribuidorId = T.DistribuidorId
               AND DD.rn = 1
               AND DD.DistribuidorDetalleFechaBaja IS NULL
               AND DD.DistribuidorDetalleFechaActivacion IS NOT NULL
            LEFT JOIN Usuarios U
                ON U.UsuarioId = T.UsuarioId
            LEFT JOIN UD_ULT UD
                ON UD.UsuarioId = T.UsuarioId
               AND UD.rn = 1
            LEFT JOIN Perfiles P
                ON P.PerfilId = U.PerfilId
            INNER JOIN TarjetasEstatus TE
                ON TE.TarjetaEstatusId = T.TarjetaEstatusId
            {$where}
            {$filtroAsignados}
            ORDER BY T.TarjetaId ASC
        ";

        return $this->db->query($sql)->result();
    }
}
