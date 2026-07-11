<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_cortes_bimestral_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function ventas_cortes_bimestral_model_cmbanios(){
        $SQL = "SELECT DISTINCT CorteAnio AS anio FROM Cortes WHERE CorteTipoId = 2";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>";         
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_cmbmes($anio){
        $SQL = "SELECT DISTINCT CorteMes AS mes FROM Cortes WHERE CorteTipoId = 2 AND CorteAnio = $anio";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>";         
        return $query->result();
    }    
    public function ventas_cortes_bimestral_model_promociones($VentaId){
        $SQL    = "SELECT distinct VentasPromociones.VentaPromocionNombre FROM VentasUsuariosPromociones INNER JOIN Ventas ON VentasUsuariosPromociones.VentaId = Ventas.VentaId INNER JOIN VentasPromocionesDetalles INNER JOIN VentasPromociones ON VentasPromocionesDetalles.VentaPromocionId = VentasPromociones.VentaPromocionId ON VentasUsuariosPromociones.VentaPromocionDetalleId = VentasPromocionesDetalles.VentaPromocionDetalleId WHERE (Ventas.VentaId = $VentaId) ";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }    
    public function ventas_cortes_bimestral_model_corte($anio,$mes) {
        $SQL = "SELECT CorteId,CorteTipoId,CorteAnio,CorteMes,CorteFechaRegistro,CorteUsuarioIdRegistro,CorteIdOtro FROM Cortes WHERE CorteTipoId = 3 AND CorteAnio =$anio AND CorteMes = $mes";
        $query	= $this->db->query($SQL);
        return $query->row()->CorteId;     
    }     
    public function ventas_cortes_bimestral_model_corte_ventas($CorteId) {
        $SQL = "SELECT 
            CBV.CorteBimestralVentaId,
            CBV.CorteId,
            CBV.CorteBimestralVentaTarjetaId,
            CBV.CorteBimestralVentaVentaId,
            CBV.CorteBimestralVentaUsuarioIdMP,
            CBV.CorteBimestralVentaDistribuidorId,
            CBV.CorteBimestralVentaVentaNumeroTicket,
            CBV.CorteBimestralVentaVentaMontoTicket,
            CBV.CorteBimestralVentaMes,
            CBV.CorteBimestralVentaFechaRegistro,
            CBV.CorteBimestralVentaFechaCorte,
            CBV.CorteBimestralVentaUsuarioIdCorte,
            DD.DistribuidorDetalleCodigo AS CorteBimestralVentaDistribuidorDetalleCodigo,
            DD.DistribuidorDetalleRazonSocial AS CorteBimestralVentaDistribuidorDetalleRazonSocial,
            DD.DistribuidorDetalleNombreComercial AS CorteBimestralVentaDistribuidorDetalleNombreComercial,
            DDR.DistribuidorDetalleRegionNombre AS CorteBimestralVentaDistribuidorDetalleRegionNombre
        FROM CortesBimestralesVentas CBV
        LEFT OUTER JOIN DistribuidoresDetalles DD ON CBV.CorteBimestralVentaDistribuidorId = DD.DistribuidorId
        LEFT OUTER JOIN DistribuidoresDetallesRegiones DDR ON DD.DistribuidorDetalleRegionId = DDR.DistribuidorDetalleRegionId
        WHERE CBV.CorteId = $CorteId";
        $query	= $this->db->query($SQL);
        return $query->result();        
    }
    public function ventas_cortes_bimestral_model_corte_maestros_pintores($CorteId) {
        $SQL = "SELECT 
            CBMP.CorteBimestralMaestroPintorId,
            CBMP.CorteId,
            CBMP.CorteBimestralMaestroPintorDistribuidorId,
            CBMP.CorteBimestralMaestroPintorUsuarioIdMP,
            CBMP.CorteBimestralMaestroPintorCantidadTickets,
            CBMP.CorteBimestralMaestroPintorVentaMontoTicket,
            CBMP.ReposicionProductoGanadorPremioLugar,
            CBMP.CorteBimestralMaestroPintorFechaRegistroCorte,
            CBMP.CorteBimestralMaestroPintorUsuarioIdRegistroCorte,
            DD.DistribuidorDetalleCodigo AS CorteBimestralMaestroPintorDistribuidorDetalleCodigo,
            DD.DistribuidorDetalleRazonSocial AS CorteBimestralMaestroPintorDistribuidorDetalleRazonSocial,
            DD.DistribuidorDetalleNombreComercial AS CorteBimestralMaestroPintorDistribuidorDetalleNombreComercial,
            DDR.DistribuidorDetalleRegionNombre AS CorteBimestralMaestroPintorDistribuidorDetalleRegionNombre
        FROM CortesBimestralesMaestrosPintores CBMP
        LEFT OUTER JOIN DistribuidoresDetalles DD ON CBMP.CorteBimestralMaestroPintorDistribuidorId = DD.DistribuidorId
        LEFT OUTER JOIN DistribuidoresDetallesRegiones DDR ON DD.DistribuidorDetalleRegionId = DDR.DistribuidorDetalleRegionId
        WHERE CBMP.CorteId = $CorteId";
        $query	= $this->db->query($SQL);
        return $query->result();        
    }
    public function ventas_cortes_bimestral_model_corte_perfil44($CorteId) {
        $SQL = "SELECT 
            CBP.CorteId,
            CBP.CortesBimestralPerfilDistribuidorId,
            CBP.CortesBimestralPerfilDetalleUsuarioIdRegistro,
            CBP.CortesBimestralPerfilId,
            CBP.CortesBimestralPerfilDistribuidorCantidadTicktes,
            CBP.CortesBimestralPerfilDistribuidorVentaMontoTicket,
            CBP.CortesBimestralPerfilDistribuidorUsuarioIdRegistroCorte,
            DD.DistribuidorDetalleCodigo AS CortesBimestralPerfilDistribuidorDetalleCodigo,
            DD.DistribuidorDetalleRazonSocial AS CortesBimestralPerfilDistribuidorDetalleRazonSocial,
            DD.DistribuidorDetalleNombreComercial AS CortesBimestralPerfilDistribuidorDetalleNombreComercial,
            DDR.DistribuidorDetalleRegionNombre AS CortesBimestralPerfilDistribuidorDetalleRegionNombre,
            P.PerfilDescripcion AS CortesBimestralPerfilPerfilDescripcion
        FROM CortesBimestralesPerfiles CBP
        LEFT OUTER JOIN DistribuidoresDetalles DD ON CBP.CortesBimestralPerfilDistribuidorId = DD.DistribuidorId
        LEFT OUTER JOIN DistribuidoresDetallesRegiones DDR ON DD.DistribuidorDetalleRegionId = DDR.DistribuidorDetalleRegionId
        LEFT OUTER JOIN Perfiles P ON CBP.CortesBimestralPerfilId = P.PerfilId
        WHERE CBP.CorteId = $CorteId";
        $query	= $this->db->query($SQL);
        return $query->result();        
    }    
    public function ventas_cortes_bimestral_model_corte_ditribuidores($CorteId) {
        $SQL = "SELECT 
            CBD.CorteBimestralDistribuidorId,
            CBD.CorteId,
            CBD.CorteBimestralDistribuidorDistribuidorId,
            CBD.CorteBimestralDistribuidorCantidadTicktes,
            CBD.CorteBimestralDistribuidorVentaMontoTicket,
            CBD.CorteBimestralDistribuidorFechaRegistroCorte,
            CBD.CorteBimestralDistribuidorUsuarioIdRegistroCorte,
            DD.DistribuidorDetalleCodigo AS CorteBimestralDistribuidorDistribuidorDetalleCodigo,
            DD.DistribuidorDetalleRazonSocial AS CorteBimestralDistribuidorDistribuidorDetalleRazonSocial,
            DD.DistribuidorDetalleNombreComercial AS CorteBimestralDistribuidorDistribuidorDetalleNombreComercial,
            DDR.DistribuidorDetalleRegionNombre AS CorteBimestralDistribuidorDistribuidorDetalleRegionNombre
        FROM CortesBimestralesDistribuidores CBD
        LEFT OUTER JOIN DistribuidoresDetalles DD ON CBD.CorteBimestralDistribuidorDistribuidorId = DD.DistribuidorId
        LEFT OUTER JOIN DistribuidoresDetallesRegiones DDR ON DD.DistribuidorDetalleRegionId = DDR.DistribuidorDetalleRegionId
        WHERE CBD.CorteId = $CorteId";
        $query	= $this->db->query($SQL);
        return $query->result();        
    }    
    public function ventas_cortes_bimestral_model_valida_ventas_auditorias($anio,$mes,$mes_anterior){        
        $SQL1 = "SELECT COUNT(VentaId) tot FROM Ventas WHERE VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro)=$anio AND MONTH(VentaFechaRegistro) in ($mes_anterior,$mes)";
        $query1	= $this->db->query($SQL1);
//        echo  $this->db->last_query()."<br>"; 
        $total_ventas = $query1->row()->tot;
        $SQL2 = "SELECT COUNT(Ventas.VentaId) AS tot FROM Ventas LEFT OUTER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId "
                . "WHERE (Ventas.VentaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaId IS NOT NULL) AND (VentasAuditorias.VentaAuditoriaEstatusId != 1) AND (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) "
                . "AND YEAR(Ventas.VentaFechaRegistro)=$anio AND MONTH(Ventas.VentaFechaRegistro) in ($mes_anterior,$mes)";
        $query2	= $this->db->query($SQL2);
//        echo  $this->db->last_query()."<br>"; 
        $total_auditoria = $query2->row()->tot;
        return ($total_ventas==$total_auditoria)?0:1;
    }
    public function ventas_cortes_bimestral_model_productos_registrados($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id)
    {
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorDetalleCodigo, 
            DistribuidoresDetalles.DistribuidorDetalleRazonSocial, 
DistribuidoresDetalles.DistribuidorDetalleNombreComercial, UsuariosDetalles.UsuarioId, UsuariosDetalles.UsuarioDetalleId, Tarjetas.TarjetaId, 
Tarjetas.TarjetaNumero, VentasDetalles.VentaId, Ventas.VentaNumeroTicket, 
Ventas.VentaMontoTicketCapturado,Ventas.VentaMontoTicket, VentasDetalles.VentaDetalleMonto, VentasDetalles.VentaDetalleTotal, VentasDetalles.VentaDetalleLitros, 
VentasDetalles.VentaDetalleCantidad, Ventas.VentaFechaRegistro, ProductosMarcas.ProductoMarcaId , ProductosMarcas.ProductoMarcaDescripcion,
ProductosMarcas.ProductoMarcaDescripcion,ProductosClases.ProductoClaseId, ProductosClases.ProductoClaseDescripcion, 
VentasAuditorias.VentaAuditoriaEstatusId, 
Divisiones.DivisionNombre, Paises.PaisId,Divisiones.DivisionId, Paises.PaisNombre,
UsuariosDetalles.UsuarioDetalleNombre AS nombrepax
FROM VentasDetalles 
INNER JOIN Ventas ON VentasDetalles.VentaId = Ventas.VentaId 
INNER JOIN UsuariosDetalles ON Ventas.UsuarioDetalleId = UsuariosDetalles.UsuarioDetalleId 
INNER JOIN Usuarios ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
INNER JOIN Tarjetas ON (ventas.TarjetaNumero = Tarjetas.TarjetaNumero AND Tarjetas.UsuarioId =  Usuarios.UsuarioId ) 
INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorDetalleId = DistribuidoresDetalles.DistribuidorDetalleId 
INNER JOIN ProductosMarcas ON VentasDetalles.ProductoMarcaId = ProductosMarcas.ProductoMarcaId 
INNER JOIN ProductosClases ON ProductosMarcas.ProductoClaseId = ProductosClases.ProductoClaseId 
INNER JOIN Divisiones ON Tarjetas.DivisionId = Divisiones.DivisionId  LEFT OUTER JOIN VentasAuditorias ON VentasAuditorias.VentaId = Ventas.VentaId 
INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
INNER JOIN Paises ON Paises.PaisId = Distribuidores.PaisId 
WHERE  (Ventas.VentaFechaBaja IS NULL) AND VentasDetalles.VentaDetalleFechaBaja IS NULL AND Usuarios.UsuarioFechaBajaParticipante IS NULL  AND (VentasAuditorias.VentaAuditoriaEstatusId = 1) AND (Distribuidores.PaisId = $PaisId) AND (Distribuidores.DivisionId = $DivisionId) 
AND YEAR(Ventas.VentaFechaRegistro)='" . $anio . "' AND MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes) and VentasAuditorias.VentaAuditoriaFechaBaja IS NULL";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_corte_bimestral_model_valida_corte_cambio_estatus($anio, $mes, $mes_anterior)
    {
        $SQL1 = "SELECT COUNT(CorteId) as tot1 FROM Cortes WHERE CorteTipoId = 1 AND CorteAnio = $anio AND CorteMes = $mes";
        $query1 = $this->db->query($SQL1);
        //        echo  $this->db->last_query()."<br>"; 
        $mesactual = $query1->row()->tot1;
        $SQL2 = "SELECT COUNT(CorteId) as tot2 FROM Cortes WHERE CorteTipoId = 1 AND CorteAnio = $anio AND CorteMes in ($mes_anterior)";
        $query2 = $this->db->query($SQL2);
        //        echo  $this->db->last_query()."<br>"; 
        $mesanterior = $query2->row()->tot2;
        return ($mesactual > 0 && $mesanterior > 0) ? 0 : 1;
    }

    public function ventas_corte_bimestral_model_valida_ventas_auditorias($anio, $mes, $mes_anterior)
    {
        $SQL1 = "SELECT COUNT(VentaId) tot 
                FROM Ventas 
                INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId
                 WHERE VentaFechaBaja IS NULL AND YEAR(Ventas.VentaFechaRegistro)='" . $anio . "' AND (MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes))";
        $query1 = $this->db->query($SQL1);
        //        echo  $this->db->last_query()."<br>"; 
        $total_ventas = $query1->row()->tot;
        $SQL2 = "SELECT COUNT(Ventas.VentaId) AS tot 
                FROM Ventas 
                INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId
                LEFT OUTER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
                 WHERE  (Ventas.VentaFechaBaja IS NULL)  AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaId IS NOT NULL) AND YEAR(Ventas.VentaFechaRegistro)='" . $anio . "' AND (MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes))";
        $query2 = $this->db->query($SQL2);
        //        echo  $this->db->last_query()."<br>"; 
        $total_auditoria = $query2->row()->tot;
        //        echo $total_ventas." - ".$total_auditoria;
        return ($total_ventas == $total_auditoria) ? 0 : 1;
    }
}