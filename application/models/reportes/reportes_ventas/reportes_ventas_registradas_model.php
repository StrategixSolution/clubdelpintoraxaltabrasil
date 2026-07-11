<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_ventas_registradas_model extends Base_Model {

    public function __construct(){
        parent::__construct();
    }

    /*
    |--------------------------------------------------------------------------
    | CONFIGURACIÓN DE PERFILES
    |--------------------------------------------------------------------------
    | Ajusta aquí si en el proyecto nuevo cambia el ID de algún perfil.
    |
    | Perfiles globales:
    | - Pueden ver todas las distribuidoras.
    |
    | Perfiles limitados:
    | - Solo pueden ver las distribuidoras asignadas en UsuariosDistribuidores.
    |
    | Perfil maestro pintor:
    | - Solo ve sus propias ventas.
    |--------------------------------------------------------------------------
    */

    private $perfiles_globales = array(
        1, // Administrador Strategix / Super Admin
        2, // Atención a clientes
        3  // Administrador Axalta
    );

    private $perfiles_limitados_por_distribuidora = array(
        4, // Gerente regional
        5, // Ejecutivo
        6, // Administrador de distribuidora
        7, // Personal de tienda
        8  // Responsable de tienda
    );

    private $perfiles_maestro_pintor = array(
        9 // Maestro pintor / participante, si aplica en este reporte
    );

    /*
    |--------------------------------------------------------------------------
    | HELPERS DE SESIÓN
    |--------------------------------------------------------------------------
    */

    private function session_value($key, $default = null)
    {
        $value = null;

        if (function_exists('funciones_strategix_sitio_alias')) {
            $alias = funciones_strategix_sitio_alias($key);
            $value = $this->session->userdata($alias);
        }

        if ($value === null || $value === '') {
            $value = $this->session->userdata($key);
        }

        return ($value === null || $value === '') ? $default : $value;
    }

    private function perfil_id_actual()
    {
        $perfilId = $this->session_value('s_perfil_id');

        if ($perfilId === null || $perfilId === '') {
            $perfilId = $this->session_value('s_id_perfil');
        }

        return (int)$perfilId;
    }

    private function usuario_id_actual()
    {
        $usuarioId = $this->session_value('s_usuario_id');

        if ($usuarioId === null || $usuarioId === '') {
            $usuarioId = $this->session_value('s_id_usuario');
        }

        if ($usuarioId === null || $usuarioId === '') {
            $usuarioId = $this->session_value('s_id_participante');
        }

        if ($usuarioId === null || $usuarioId === '') {
            $usuarioId = $this->session_value('s_participante_id');
        }

        return (int)$usuarioId;
    }

    private function es_perfil_global()
    {
        return in_array($this->perfil_id_actual(), $this->perfiles_globales);
    }

    private function es_perfil_limitado_por_distribuidora()
    {
        return in_array($this->perfil_id_actual(), $this->perfiles_limitados_por_distribuidora);
    }

    private function es_perfil_maestro_pintor()
    {
        return in_array($this->perfil_id_actual(), $this->perfiles_maestro_pintor);
    }

    /*
    |--------------------------------------------------------------------------
    | SEGURIDAD POR DISTRIBUIDORA / USUARIO
    |--------------------------------------------------------------------------
    */

    private function distribuidores_asignados_usuario()
    {
        $usuarioId = $this->usuario_id_actual();

        if ($usuarioId <= 0) {
            return array();
        }

        $sql = "
            SELECT DISTINCT
                UD.DistribuidorId
            FROM UsuariosDistribuidores UD
            INNER JOIN Distribuidores D
                ON D.DistribuidorId = UD.DistribuidorId
               AND D.DistribuidorFechaBaja IS NULL
            WHERE UD.UsuarioId = ?
        ";

        $rows = $this->db->query($sql, array($usuarioId))->result();

        $ids = array();

        foreach ($rows as $row) {
            $ids[] = (int)$row->DistribuidorId;
        }

        return $ids;
    }

    private function filtro_seguridad_distribuidores($aliasCampo = 'V.DistribuidorId')
    {
        if ($this->es_perfil_global()) {
            return array(
                'sql'    => '',
                'params' => array()
            );
        }

        if ($this->es_perfil_limitado_por_distribuidora()) {
            $distribuidores = $this->distribuidores_asignados_usuario();

            if (count($distribuidores) <= 0) {
                return array(
                    'sql'    => ' AND 1 = 0 ',
                    'params' => array()
                );
            }

            $placeholders = implode(',', array_fill(0, count($distribuidores), '?'));

            return array(
                'sql'    => " AND {$aliasCampo} IN ({$placeholders}) ",
                'params' => $distribuidores
            );
        }

        return array(
            'sql'    => '',
            'params' => array()
        );
    }

    private function filtro_seguridad_maestro_pintor($aliasCampo = 'V.VentaUsuarioIdMP')
    {
        if (!$this->es_perfil_maestro_pintor()) {
            return array(
                'sql'    => '',
                'params' => array()
            );
        }

        $usuarioId = $this->usuario_id_actual();

        if ($usuarioId <= 0) {
            return array(
                'sql'    => ' AND 1 = 0 ',
                'params' => array()
            );
        }

        return array(
            'sql'    => " AND {$aliasCampo} = ? ",
            'params' => array($usuarioId)
        );
    }

    private function filtros_seguridad($aliasDistribuidor = 'V.DistribuidorId', $aliasUsuarioMP = 'V.VentaUsuarioIdMP')
    {
        $filtroDistribuidor = $this->filtro_seguridad_distribuidores($aliasDistribuidor);
        $filtroMP = $this->filtro_seguridad_maestro_pintor($aliasUsuarioMP);

        return array(
            'sql'    => $filtroDistribuidor['sql'] . $filtroMP['sql'],
            'params' => array_merge($filtroDistribuidor['params'], $filtroMP['params'])
        );
    }

    /*
    |--------------------------------------------------------------------------
    | COMBOS
    |--------------------------------------------------------------------------
    */

    public function combo_anios()
    {
      $SQL = "SELECT DISTINCT YEAR(V.VentaFechaRegistro) AS anio from Ventas v WHERE v.VentaFechaBaja IS NULL ORDER BY anio DESC";
        $query = $this->db->query($SQL);
        return $query->result();
        }

    public function combo_meses($anio)
    {
        $anio = (int)$anio;
        $SQL = "SELECT DISTINCT MONTH(V.VentaFechaRegistro) AS mes FROM Ventas v
            WHERE v.VentaFechaBaja IS NULL 
            AND YEAR(V.VentaFechaRegistro) = $anio
            ORDER BY mes ASC";
            $query = $this->db->query($SQL);
        return $query->result();
    }

    public function combo_distribuidores($anio, $mes, $perfil_id)
    {
        if($mes > 0){
            $filtro_mes = " AND MONTH(v.VentaFechaRegistro) = $mes ";
        } else {
            $filtro_mes = "";
        }
        $perfil_id = (int)$perfil_id;
        $usuario_id = (int)$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));

        // Perfiles 1,2,3: Administradores (todos los distribuidores)
        if (in_array($perfil_id, [1, 2, 3])) {
            $SQL = "SELECT DISTINCT d.DistribuidorId, 
                    dd.DistribuidorDetalleCodigo, 
                    dd.DistribuidorDetalleRazonSocial,
                    dd.DistribuidorDetalleNombreComercial 
                    FROM Ventas v 
                    INNER JOIN Distribuidores d ON d.DistribuidorId = v.DistribuidorId 
                    INNER JOIN DistribuidoresDetalles dd ON DD.DistribuidorId = d.DistribuidorId 
                    WHERE v.VentaFechaBaja IS NULL
                    AND dd.DistribuidorDetalleFechaBaja IS NULL
                    AND d.DistribuidorFechaBaja IS NULL
                    AND YEAR(v.VentaFechaRegistro) = $anio
                    $filtro_mes
                    ORDER BY dd.DistribuidorDetalleCodigo";
                            } 
        // Perfiles 4 o 5: Regionales/Ejecutivos/personal (solo sus distribuidores)
        else {
            $SQL = "SELECT DISTINCT Distribuidores.DistribuidorId, 
                           DistribuidoresDetalles.DistribuidorDetalleCodigo, 
                           DistribuidoresDetalles.DistribuidorDetalleRazonSocial,
                           DistribuidoresDetalles.DistribuidorDetalleNombreComercial
                           FROM Ventas 
                    INNER JOIN  UsuariosDistribuidores ON UsuariosDistribuidores.DistribuidorId = Ventas.DistribuidorId 
                    INNER JOIN Usuarios ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId 
                    INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId 
                    WHERE Usuarios.PerfilId = $perfil_id
                    AND Distribuidores.DistribuidorFechaBaja IS NULL 
                    AND DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL 
                    AND Usuarios.UsuarioId = $usuario_id
                    AND Ventas.VentaFechaBaja IS NULL
                    AND YEAR(Ventas.VentaFechaRegistro) = $anio
 					$filtro_mes
                    ORDER BY DistribuidoresDetalles.DistribuidorDetalleCodigo";
        }        
        $query = $this->db->query($SQL);
        return $query->result();
    }

    public function combo_estatus()
    {
        $sql = "SELECT VentaAuditoriaEstatusId AS id,VentaAuditoriaEstatusDescripcion AS descripcion FROM VentasAuditoriasEstatus ORDER BY VentaAuditoriaEstatusId ASC";
        return $this->db->query($sql)->result();
    }

    /*
    |--------------------------------------------------------------------------
    | DATOS DEL REPORTE
    |--------------------------------------------------------------------------
    */

    public function datos($anio, $mes, $distId, $estatus)
    {
        $anio    = (int)$anio;
        $mes     = (int)$mes;
        $distId  = (int)$distId;
        $estatus = (int)$estatus;

        $params = array($anio);

        $fMes = "";
        if ($mes > 0) {
            $fMes = " AND MONTH(V.VentaFechaRegistro) = ? ";
            $params[] = $mes;
        }

        $fDist = "";
        if ($distId > 0) {
            $fDist = " AND V.DistribuidorId = ? ";
            $params[] = $distId;
        }

        $fEstatus = "";
        if ($estatus > 0) {

            /*
            * Regla funcional confirmada:
            *
            * PENDIENTE incluye:
            * - Ventas con registro en VentasAuditorias y VentaAuditoriaEstatusId = 1
            * - Ventas que no tienen registro en VentasAuditorias
            */
            if ($estatus == 1) {
                $fEstatus = " AND (VA.VentaAuditoriaEstatusId = ? OR VA.VentaAuditoriaId IS NULL) ";
                $params[] = $estatus;
            } else {
                $fEstatus = " AND VA.VentaAuditoriaEstatusId = ? ";
                $params[] = $estatus;
            }
        }

        $seguridad = $this->filtros_seguridad('V.DistribuidorId', 'V.VentaUsuarioIdMP');
        $params = array_merge($params, $seguridad['params']);

        $sql = "SELECT
                V.VentaId AS ID,
                    LTRIM(RTRIM(
                        ISNULL(UDMP.UsuarioDetalleNombre,'')
                    ))
                 AS NOMBRE_PINTOR,

                ISNULL(EV.EVENTO, '') AS EVENTO,

                V.DistribuidorId AS ID_DISTRIBUIDORA,
                CONVERT(VARCHAR(20), DD.DistribuidorDetalleCodigo) AS CODIGO,
                DD.DistribuidorDetalleRazonSocial AS RAZON_SOCIAL,
                DD.DistribuidorDetalleNombreComercial AS NOMBRE_COMERCIAL,

                ISNULL(REG.DistribuidorDetalleRegionNombre,'') AS REGION,
               

                ISNULL(EJ.NOMBRE_EJECUTIVO,'') AS EJECUTIVO,

                (
                    ISNULL(DD.DistribuidorDetalleCiudad,'') + ' / ' +
                    ISNULL(DD.DistribuidorDetalleUnidadFederativa,'')
                ) AS CIUDAD_ESTADO,

                V.VentaNumeroTicket AS NUM_TICKET,
                ISNULL(V.VentaMontoTicket, 0) AS TOTAL_TICKET,
                CONVERT(VARCHAR(10), V.VentaFechaRegistro, 23) AS FECHA_REGISTRO,

                CASE
                    WHEN ISNULL(VA.VentaAuditoriaEstatusOportunidadId, 0) = 1
                    THEN 'SI'
                    ELSE 'NO'
                END AS VENTA_COMPLETADA,

                CASE
                    WHEN VA.VentaAuditoriaId IS NULL THEN 'PENDIENTE'
                    WHEN VA.VentaAuditoriaEstatusId = 1 THEN 'PENDIENTE'
                    ELSE ISNULL(VAES.VentaAuditoriaEstatusDescripcion, '')
                END AS AUDITORIA,

                V.VentaFotoTicket AS TICKET_FOTO,

                ISNULL(VAO.VentaAuditoriaObservacionDescripcion,'') AS OBSERVACIONES

            FROM Ventas V

            LEFT JOIN UsuariosDetalles UDMP
                ON UDMP.UsuarioId = V.VentaUsuarioIdMP
               AND UDMP.UsuarioDetalleFechaBaja IS NULL

            LEFT JOIN DistribuidoresDetalles DD
                ON DD.DistribuidorId = V.DistribuidorId
               AND DD.DistribuidorDetalleFechaBaja IS NULL

               

            LEFT JOIN DistribuidoresDetallesRegiones REG
                ON REG.DistribuidorDetalleRegionId = DD.DistribuidorDetalleRegionId

           
            LEFT JOIN (
                SELECT VA1.*
                FROM VentasAuditorias VA1
                INNER JOIN (
                    SELECT
                        VentaId,
                        MAX(VentaAuditoriaId) AS MaxId
                    FROM VentasAuditorias
                    WHERE VentaAuditoriaFechaBaja IS NULL
                    GROUP BY VentaId
                ) X
                    ON X.VentaId = VA1.VentaId
                   AND X.MaxId = VA1.VentaAuditoriaId
                WHERE VA1.VentaAuditoriaFechaBaja IS NULL
            ) VA
                ON VA.VentaId = V.VentaId

            LEFT JOIN VentasAuditoriasEstatus VAES
                ON VAES.VentaAuditoriaEstatusId = VA.VentaAuditoriaEstatusId

            LEFT JOIN VentasAuditoriasObservaciones VAO
                ON VAO.VentaAuditoriaObservacionId = VA.VentaAuditoriaObservacionId

            LEFT JOIN (
                SELECT
                    UDIST.DistribuidorId,
                    MAX(LTRIM(RTRIM(
                        ISNULL(UD2.UsuarioDetalleNombre,'')
                    ))) AS NOMBRE_EJECUTIVO
                FROM UsuariosDistribuidores UDIST
                INNER JOIN Usuarios U2
                    ON U2.UsuarioId = UDIST.UsuarioId
                   AND U2.PerfilId = 5
                INNER JOIN UsuariosDetalles UD2
                    ON UD2.UsuarioId = U2.UsuarioId
                   AND UD2.UsuarioDetalleFechaBaja IS NULL
                GROUP BY UDIST.DistribuidorId
            ) EJ
                ON EJ.DistribuidorId = V.DistribuidorId

            LEFT JOIN (
                SELECT
                    VUP.VentaId,
                    STUFF((
                        SELECT DISTINCT ', ' + VP.VentaPromocionNombre
                        FROM VentasUsuariosPromociones VUP2
                        INNER JOIN VentasPromocionesDetalles VPD
                            ON VPD.VentaPromocionDetalleId = VUP2.VentaPromocionDetalleId
                        INNER JOIN VentasPromociones VP
                            ON VP.VentaPromocionId = VPD.VentaPromocionId
                        WHERE VUP2.VentaId = VUP.VentaId
                        FOR XML PATH(''), TYPE
                    ).value('.', 'NVARCHAR(MAX)'), 1, 2, '') AS EVENTO
                FROM VentasUsuariosPromociones VUP
                GROUP BY VUP.VentaId
            ) EV
                ON EV.VentaId = V.VentaId

            WHERE V.VentaFechaBaja IS NULL
              AND DD.DistribuidorDetalleFechaActivacion IS NOT NULL
              AND YEAR(V.VentaFechaRegistro) = ?
              {$fMes}
              {$fDist}
              {$fEstatus}
              {$seguridad['sql']}

            ORDER BY V.VentaId DESC
        ";

        return $this->db->query($sql, $params)->result();
    }

    /*
    |--------------------------------------------------------------------------
    | TICKET MODAL
    |--------------------------------------------------------------------------
    */

    public function obtener_ticket($ventaId)
    {
        $ventaId = (int)$ventaId;

        $r = $this->db->query("
            SELECT TOP 1
                VentaFotoTicket
            FROM Ventas
            WHERE VentaId = ?
              AND VentaFechaBaja IS NULL
        ", array($ventaId))->row();

        if (!$r || empty($r->VentaFotoTicket)) {
            return null;
        }

        $ruta = trim($r->VentaFotoTicket);

        if (
            stripos($ruta, 'uploads/') === 0 ||
            stripos($ruta, 'http') === 0 ||
            strpos($ruta, '/') !== false
        ) {
            return array('url' => $ruta);
        }

        return array(
            'url' => 'uploads/ventas/tickets/' . $ruta
        );
    }
}