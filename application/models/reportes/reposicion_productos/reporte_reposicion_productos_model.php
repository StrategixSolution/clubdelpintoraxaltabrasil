<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_reposicion_productos_model extends Base_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function reporte_reposicion_productos_model_anios()
    {
        $SQL = "SELECT DISTINCT ReposicionProductoGanadorAnio AS anio FROM ReposicionesProductosGanadores ORDER BY anio DESC";
        return $this->db->query($SQL)->result();
    }
    public function reporte_reposicion_productos_model_periodos_bimestrales($anio)
    {
        $SQL = "SELECT DISTINCT  ReposicionProductoGanadorMes AS mes FROM ReposicionesProductosGanadores WHERE ReposicionProductoGanadorAnio = $anio ORDER BY mes ASC";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function reporte_reposicion_productos_model_distribuidores($anio, $periodo)
    {
        $SQL = ";WITH DD_ULT AS (
                    SELECT
                        DD.*,
                        ROW_NUMBER() OVER (PARTITION BY DD.DistribuidorId ORDER BY DD.DistribuidorDetalleId DESC) AS rn
                    FROM DistribuidoresDetalles DD
                )
                SELECT DISTINCT
                    rpg.DistribuidorId,
                    DD.DistribuidorDetalleCodigo,
                    DD.DistribuidorDetalleNombreComercial
                FROM ReposicionesProductosGanadores rpg
                INNER JOIN DD_ULT DD
                    ON DD.DistribuidorId = rpg.DistribuidorId
                   AND DD.rn = 1
                   AND DD.DistribuidorDetalleFechaBaja IS NULL
                   AND DD.DistribuidorDetalleFechaActivacion IS NOT NULL
                WHERE rpg.ReposicionProductoGanadorAnio = $anio
                  AND rpg.ReposicionProductoGanadorMes = $periodo
                ORDER BY rpg.DistribuidorId ASC";
        return $this->db->query($SQL)->result();
    }
    public function reporte_reposicion_productos_model_distribuidores_personal_tienda($anio, $periodo)
    {
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleNombreComercial  
                FROM UsuariosDistribuidores 
                INNER JOIN Usuarios ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId 
                INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId 
                WHERE (Usuarios.PerfilId in (6,7,8)) 
                AND (Distribuidores.DistribuidorFechaBaja IS NULL) 
                AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL)
                AND (DistribuidoresDetalles.DistribuidorDetalleFechaActivacion IS NOT NULL)
                AND (Usuarios.UsuarioId = " . $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')) . ") 
                ORDER BY DistribuidoresDetalles.DistribuidorId ASC";
        return $this->db->query($SQL)->result();
    }
    public function reporte_reposicion_productos_model_datos($where)
    {
        $SQL = "SELECT
    rpg.DistribuidorId,
    dd.DistribuidorDetalleCodigo,
    UPPER(dd.DistribuidorDetalleRazonSocial) AS RazonSocial,
    UPPER(dd.DistribuidorDetalleNombreComercial) AS NombreComercial,
    'AXALTA' AS TipoDistribuidora,
    '' AS periodo,
    rpg.TarjetaId,
    UPPER(CONVERT(VARCHAR(8000), ud_mp.UsuarioDetalleNombre)) AS nombreMP,
    UPPER(ddr.DistribuidorDetalleRegionNombre) AS region,
    (SELECT TOP 1 
        UPPER(ud.UsuarioDetalleNombre)
     FROM Usuarios u 
     INNER JOIN UsuariosDetalles ud ON ud.UsuarioId = u.UsuarioId 
     INNER JOIN UsuariosDistribuidores udist ON udist.UsuarioId = u.UsuarioId 
     WHERE u.PerfilId = 5
       AND udist.DistribuidorId = rpg.DistribuidorId
    ) AS nombre_ejecutivo,
    rpg.ReposicionProductoGanadorPremioLugar AS lugar,
    rpg.ReposicionProductoGanadorFechaEntregaTienda AS fechaEntrega,
    rppp.ReposicionProductoPremioProductoGMS,
    rppp.ReposicionProductoPremioProductoCodigo,
    rppp.ReposicionProductoPremioProductoDescripcion,
     vdg.VentaDetalleGalonDescripcion AS ReposicionProductoPremioProductoPresentacion,
    1 AS cantidad,
    rppp.ReposicionProductoPremioProductoPrecio,
    rppp.ReposicionProductoPremioProductoPrecio AS precioTotal
FROM ReposicionesProductosGanadores rpg
INNER JOIN DistribuidoresDetalles dd
    ON dd.DistribuidorId = rpg.DistribuidorId
   AND dd.DistribuidorDetalleFechaBaja IS NULL
   AND dd.DistribuidorDetalleFechaActivacion IS NOT NULL
INNER JOIN DistribuidoresDetallesRegiones ddr ON ddr.DistribuidorDetalleRegionId = dd.DistribuidorDetalleRegionId
LEFT JOIN UsuariosDetalles ud_mp ON ud_mp.UsuarioId = rpg.UsuarioId
LEFT JOIN ReposicionesProductosPremiosProductos rppp ON rppp.ReposicionProductoPremioProductoId = rpg.ReposicionProductoPremioProductoId
LEFT JOIN VentasDetallesGalones vdg ON rppp.ReposicionProductoPremioProductoPresentacion = vdg.VentaDetalleGalonId 
$where ORDER BY rpg.DistribuidorId, rpg.ReposicionProductoGanadorPremioLugar ASC";
        return $this->db->query($SQL)->result();
    }
}