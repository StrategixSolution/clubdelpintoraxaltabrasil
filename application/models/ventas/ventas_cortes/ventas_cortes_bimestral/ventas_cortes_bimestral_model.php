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
    public function ventas_cortes_bimestral_model_corte_perfil($CorteId) {
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
}