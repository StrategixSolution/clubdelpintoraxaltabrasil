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
        $SQL = "SELECT CorteBimestralVentaId,CorteId,CorteBimestralVentaTarjetaId,CorteBimestralVentaVentaId,CorteBimestralVentaUsuarioDetalleId,CorteBimestralVentaUsuarioIdMP,CorteBimestralVentaNombreMaestroPintor,CorteBimestralVentaUsuarioIdMPEstatus,CorteBimestralVentaDistribuidorDetalleId,CorteBimestralVentaDistribuidorId,CorteBimestralVentaDistribuidorDetalleCodigo,CorteBimestralVentaDistribuidorDetalleRazonSocial,CorteBimestralVentaDistribuidorDetalleNombreComercial,CorteBimestralVentaDistribuidorDetalleRegionId,CorteBimestralVentaDistribuidorDetalleRegionNombre,CorteBimestralVentaDistribuidorDetalleEstatus,CorteBimestralVentaVentaNumeroTicket,CorteBimestralVentaVentaMontoTicket,CorteBimestralVentaMes,CorteBimestralVentaVentaEstatus,CorteBimestralVentaVentaEstatusAuditoria,CorteBimestralVentaFechaRegistro,CorteBimestralVentaFechaCorte,CorteBimestralVentaUsuarioIdCorte FROM CortesBimestralesVentas where CorteId = $CorteId";
        $query	= $this->db->query($SQL);
        return $query->result();        
    }
    public function ventas_cortes_bimestral_model_corte_maestros_pintores($CorteId) {
        $SQL = "SELECT CorteBimestralMaestroPintorId,CorteId,CorteBimestralMaestroPintorDistribuidorDetalleId,CorteBimestralMaestroPintorDistribuidorId,CorteBimestralMaestroPintorDistribuidorDetalleCodigo,CorteBimestralMaestroPintorDistribuidorDetalleRazonSocial,CorteBimestralMaestroPintorDistribuidorDetalleNombreComercial,CorteBimestralMaestroPintorDistribuidorEstatus,CorteBimestralMaestroPintorDistribuidorDetalleRegionId,CorteBimestralMaestroPintorDistribuidorDetalleRegionNombre,CorteBimestralMaestroPintorUsuarioDetalleIdMP,CorteBimestralMaestroPintorUsuarioIdMP,CorteBimestralMaestroPintorMaestroPintor,CorteBimestralMaestroPintorEstatusMaestroPintor,CorteBimestralMaestroPintorCantidadTickets,CorteBimestralMaestroPintorVentaMontoTicket,ReposicionProductoGanadorPremioLugar,CorteBimestralMaestroPintorFechaRegistroCorte,CorteBimestralMaestroPintorUsuarioIdRegistroCorte FROM CortesBimestralesMaestrosPintores WHERE CorteId = $CorteId";
        $query	= $this->db->query($SQL);
        return $query->result();        
    }
    public function ventas_cortes_bimestral_model_corte_perfil($CorteId) {
        $SQL = "SELECT CorteId,CortesBimestralPerfilDistribuidorDetalleId,CortesBimestralPerfilDistribuidorId,CortesBimestralPerfilDistribuidorDetalleCodigo,CortesBimestralPerfilDistribuidorDetalleRazonSocial,CortesBimestralPerfilDistribuidorDetalleNombreComercial,CortesBimestralPerfilDistribuidorDetalleRegionId,CortesBimestralPerfilDistribuidorDetalleRegionNombre,CortesBimestralPerfilDistribuidorEstatus,CortesBimestralPerfilDetalleUsuarioIdRegistro,CortesBimestralPerfilDetalleUsuarioRegistroNombre,CortesBimestralPerfilDistribuidorPerfilId,CortesBimestralPerfilDistribuidorPerfilDescripcion,CortesBimestralPerfilDetalleUsuarioRegistroEstatus,CortesBimestralPerfilDistribuidorCantidadTicktes,CortesBimestralPerfilDistribuidorVentaMontoTicket,CortesBimestralPerfilDistribuidorUsuarioIdRegistroCorte FROM CortesBimestralesPerfiles WHERE CorteId = $CorteId";
        $query	= $this->db->query($SQL);
        return $query->result();        
    }    
    public function ventas_cortes_bimestral_model_corte_ditribuidores($CorteId) {
        $SQL = "SELECT CorteBimestralDistribuidorId,CorteId,CorteBimestralDistribuidorDistribuidorDetalleId,CorteBimestralDistribuidorDistribuidorId,CorteBimestralDistribuidorDistribuidorDetalleCodigo,CorteBimestralDistribuidorDistribuidorDetalleRazonSocial,CorteBimestralDistribuidorDistribuidorDetalleNombreComercial,CorteBimestralDistribuidorDistribuidorDetalleRegionId,CorteBimestralDistribuidorDistribuidorDetalleRegionNombre,CorteBimestralDistribuidorDistribuidorEstatus,CorteBimestralDistribuidorCantidadTicktes,CorteBimestralDistribuidorVentaMontoTicket,CorteBimestralDistribuidorFechaRegistroCorte,CorteBimestralDistribuidorUsuarioIdRegistroCorte FROM CortesBimestralesDistribuidores WHERE CorteId = $CorteId";
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