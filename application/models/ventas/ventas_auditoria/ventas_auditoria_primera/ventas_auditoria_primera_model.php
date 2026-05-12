<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MAR. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_auditoria_primera_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function ventas_auditoria_primera_model_combo_anio(){
        $SQL = "SELECT DISTINCT YEAR(VentaFechaRegistro) AS anio FROM Ventas ORDER BY YEAR(VentaFechaRegistro) ASC";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_auditoria_primera_model_combo_mes($anio){
        $SQL = "SELECT DISTINCT MONTH(VentaFechaRegistro) AS mes FROM Ventas WHERE YEAR(VentaFechaRegistro) = '$anio' ORDER BY MONTH(VentaFechaRegistro) ASC";
        $query	= $this->db->query($SQL);
        return $query->result();
    }    
    public function Ventas_auditoria_primera_model_crea_tabla($anio,$mes){
        /******************************************** TABLA DE AUDITORIAS ******************************************/
        $SQL1 = "SELECT Ventas.VentaId, VentasAuditorias.VentaAuditoriaId, Ventas.TarjetaId, Ventas.TarjetaNumero, Ventas.VentaUsuarioIdMP, Ventas.VentaUsuarioNombreMP, Ventas.DistribuidorId, Ventas.DistribuidorDetalleId, Ventas.DistribuidorDetalleCodigo, Ventas.DistribuidorDetalleRazonSocial, Ventas.DistribuidorDetalleNombreComercial, Ventas.UsuarioDetalleId, Ventas.VentaNumeroTicket, Ventas.VentaMontoTicket, Ventas.VentaFotoTicket, Ventas.VentaFechaRegistro, VentasAuditorias.VentaAuditoriaEstatusId, VentasAuditorias.VentaAuditoriaTipoId, VentasAuditorias.VentaAuditoriaEstatusOportunidadId, VentasAuditorias.VentaAuditoriaObservacionId, VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion, VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadDescripcion, VentasAuditoriasTipos.VentaAuditoriaTipoDescripcion, VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId INNER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId INNER JOIN VentasAuditoriasEstatusOportunidades ON VentasAuditorias.VentaAuditoriaEstatusOportunidadId = VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadId INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId LEFT OUTER JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId
        WHERE  (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (YEAR(Ventas.VentaFechaRegistro) = ?) AND (MONTH(Ventas.VentaFechaRegistro) = ?) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (Ventas.VentaFechaBaja IS NULL) AND (VentasAuditoriasTipos.VentaAuditoriaTipoId !=4)";
        $query_tabla	= $this->db->query($SQL1,array($anio,$mes));
        $data["auditoria_tabla"]        =  $query_tabla->result();
//        echo $this->db->last_query();
        /******************************************** TOTAL DE AUDITORIAS ******************************************/
        $SQL2 = "SELECT COUNT(Ventas.VentaId) AS total FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (YEAR(Ventas.VentaFechaRegistro) = ?) AND (MONTH(Ventas.VentaFechaRegistro) = ?) AND (VentasAuditoriasTipos.VentaAuditoriaTipoId !=4)";
        $query_auditoria_total          = $this->db->query($SQL2,array($anio,$mes));
        //echo  $this->db->last_query()."<br>"; 
        $data["auditoria_total"]        = $query_auditoria_total->row()->total;
        /******************************************** AUDITORIAS PENDIENTES ******************************************/
        $SQL3 = "SELECT COUNT(Ventas.VentaId) AS total FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (VentasAuditorias.VentaAuditoriaEstatusId = 1) AND (YEAR(Ventas.VentaFechaRegistro) = ?) AND (MONTH(Ventas.VentaFechaRegistro) = ?) AND (VentasAuditoriasTipos.VentaAuditoriaTipoId !=4)";
        $query_auditoria_pendientes     = $this->db->query($SQL3,array($anio,$mes));
        //echo  $this->db->last_query()."<br>"; 
        $data["auditoria_pendientes"]   = $query_auditoria_pendientes->row()->total;
        /******************************************** AUDITORIAS NO PENDIENTES ******************************************/
        $SQL4 = "SELECT COUNT(Ventas.VentaId) AS total FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (VentasAuditorias.VentaAuditoriaEstatusId <> 1) AND (YEAR(Ventas.VentaFechaRegistro) = ?) AND (MONTH(Ventas.VentaFechaRegistro) = ?) AND (VentasAuditoriasTipos.VentaAuditoriaTipoId !=4)";
        $query_auditoria_no_pendientes     = $this->db->query($SQL4,array($anio,$mes));
        //echo  $this->db->last_query()."<br>"; 
        $data["auditoria_no_pendientes"]   = $query_auditoria_no_pendientes->row()->total;    
        return $data;
    }  
    public function ventas_auditoria_primera_model_ticket_modal($VentaId){
        $SQL = "SELECT Ventas.VentaId, Ventas.TarjetaId, Ventas.TarjetaNumero, Ventas.VentaUsuarioIdMP, Ventas.VentaUsuarioNombreMP, Ventas.DistribuidorId, Ventas.DistribuidorDetalleId, Ventas.DistribuidorDetalleCodigo, Ventas.DistribuidorDetalleRazonSocial, Ventas.DistribuidorDetalleNombreComercial, Ventas.UsuarioDetalleId, Ventas.VentaNumeroTicket, Ventas.VentaMontoTicket, Ventas.VentaFotoTicket, Ventas.VentaFechaRegistro, VentasAuditorias.VentaAuditoriaEstatusId, VentasAuditorias.VentaAuditoriaTipoId, VentasAuditorias.VentaAuditoriaEstatusOportunidadId, VentasAuditorias.VentaAuditoriaObservacionId, VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion, VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadDescripcion, VentasAuditoriasTipos.VentaAuditoriaTipoDescripcion, VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId INNER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId INNER JOIN VentasAuditoriasEstatusOportunidades ON VentasAuditorias.VentaAuditoriaEstatusOportunidadId = VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadId INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId LEFT OUTER JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId
        WHERE Ventas.VentaId = ?";
        $query	= $this->db->query($SQL,array($VentaId));
        //echo  $this->db->last_query()."<br>"; 
        return $query->row();
    } 
    public function ventas_auditoria_primera_model_tickets_repetidos($VentaId,$anio,$mes,$DistribuidorId,$VentaUsuarioIdMP,$VentaMontoTicket){
        $tickets = "";
        $SQL    = "SELECT VentaId FROM Ventas WHERE VentaId <> ? AND VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro)= ? AND MONTH(VentaFechaRegistro) = ? AND DistribuidorId = ? AND VentaUsuarioIdMP = ? AND VentaMontoTicket = ?";
        $query	= $this->db->query($SQL,array($VentaId,$anio,$mes,$DistribuidorId,$VentaUsuarioIdMP,$VentaMontoTicket));
        //echo  $this->db->last_query()."<br>"; 
        foreach ($query->result() as $row) {
            $tickets .= $row->VentaId.",";
        }
        $tickets = substr ($tickets, 0, strlen($tickets) - 1);
        return $tickets;
    } 
    public function ventas_auditoria_primera_model_observaciones(){
        $SQL = "SELECT VentaAuditoriaObservacionId,VentaAuditoriaObservacionDescripcion FROM VentasAuditoriasObservaciones";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result(); 
    }
    public function ventas_auditoria_primera_model_aprobar($VentaAuditoriaId){
        $this->db->query("UPDATE VentasAuditorias SET VentaAuditoriaFechaAudito = GETDATE(), VentaAuditoriaUsuarioAudito = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).", VentaAuditoriaEstatusId = 2 WHERE VentaAuditoriaId = $VentaAuditoriaId");
        return 1;
    }
    public function ventas_auditoria_primera_model_rechazada($VentaAuditoriaId,$VentaAuditoriaObservacionId){
        $this->db->query("UPDATE VentasAuditorias SET VentaAuditoriaFechaAudito = GETDATE(), VentaAuditoriaUsuarioAudito = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).", VentaAuditoriaEstatusId = 3, VentaAuditoriaObservacionId = $VentaAuditoriaObservacionId WHERE VentaAuditoriaId = $VentaAuditoriaId");
        return 1;
    }
    public function ventas_auditoria_primera_model_observacion_descripcion($VentaAuditoriaObservacionId){
        $SQL = "SELECT VentaAuditoriaObservacionId,VentaAuditoriaObservacionDescripcion FROM VentasAuditoriasObservaciones WHERE VentaAuditoriaObservacionId = $VentaAuditoriaObservacionId";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return utf8_encode(strtoupper($query->row()->VentaAuditoriaObservacionDescripcion)); 
    }
    public function ventas_auditoria_primera_model_auditorias_random($anio,$mes){
        /*********************************************** TOTAL DE VENTAS **********************************************/
        $query_total                            = $this->db->query("SELECT COUNT(VentaId) as total FROM Ventas WHERE VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro)= ? AND MONTH(VentaFechaRegistro) = ?",array($anio,$mes)); 
        //echo  $this->db->last_query()."<br>"; 
        $data["ventas_total"]                   = $query_total->row()->total;
        /*********************************************** TOTAL DE AUDITORIAS ******************************************/
        $query_total_auditorias                 = $this->db->query("SELECT COUNT(Ventas.VentaId) AS total FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (YEAR(Ventas.VentaFechaRegistro) = ?) AND (MONTH(Ventas.VentaFechaRegistro) = ?)",array($anio,$mes));
        //echo  $this->db->last_query()."<br>"; 
        $data["ventas_total_auditorias"]        = $query_total_auditorias->row()->total; 
        /*********************************************** PORCENTAJES *************************************************/
        $data["porcentaje"]                     = intval($data["ventas_total"] * .2);
        $data["auditorias_random_faltantes"]    = $data["porcentaje"] - $data["ventas_total_auditorias"];
        return $data;
    }
    public function ventas_auditoria_primera_model_genera_randoms($NumRandom,$Anio,$Mes){
        $this->db->query("INSERT INTO VentasAuditorias (VentaId,UsuarioIdCapturo ,VentaAuditoriaEstatusId ,VentaAuditoriaTipoId ,VentaAuditoriaEstatusOportunidadId) SELECT TOP $NumRandom VentaId,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",1,3,1 FROM Ventas WHERE (VentaFechaBaja IS NULL) AND (YEAR(VentaFechaRegistro) = $Anio) AND (MONTH(VentaFechaRegistro) = $Mes) AND VentaId NOT IN (SELECT VentaId FROM VentasAuditorias WHERE (VentaAuditoriaEstatusOportunidadId = 1) AND (VentaAuditoriaFechaBaja IS NULL) AND (YEAR(VentaAuditoriaFechaRegistro) = $Anio) AND (MONTH(VentaAuditoriaFechaRegistro) = $Mes)) ORDER BY VentaMontoTicket DESC");
        return 1;
    }

    public function ventas_auditoria_primera_model_detalle_ventas($VentaId){
        $SQL    = "    SELECT        VentasDetalles.VentaDetalleId, VentasDetalles.VentaId, VentasDetalles.UsuarioIdCapturo, VentasDetalles.VentaDetalleMonto, VentasDetalles.VentaDetalleCantidad, VentasDetalles.VentaDetalleLitros, VentasDetalles.ProductoMarcaId, VentasDetalles.VentaDetalleFechaRegistro, VentasDetalles.VentaDetalleFechaBaja, ProductosMarcas.ProductoMarcaDescripcion, ProductosClases.ProductoClaseDescripcion
FROM VentasDetalles 
INNER JOIN ProductosMarcas ON VentasDetalles.ProductoMarcaId = ProductosMarcas.ProductoMarcaId 
INNER JOIN ProductosClases ON ProductosMarcas.ProductoClaseId = ProductosClases.ProductoClaseId        
                WHERE (VentasDetalles.VentaDetalleFechaBaja IS NULL) AND (VentasDetalles.VentaId = $VentaId) "; 
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_auditoria_primera_model_promociones($VentaId){
        $SQL    = "SELECT Ventas.VentaId, VentasPromociones.VentaPromocionNombre, VentasPromocionesDetalles.VentaPromocionDetallePresentacion, VentasPromocionesDetalles.VentaPromocionDetalleGMC, VentasPromocionesDetalles.VentaPromocionDetalleCodigo, VentasPromocionesDetalles.VentaPromocionDetalleDescripcion, VentasUsuariosPromociones.VentaUsuarioPromocionCantidad FROM VentasUsuariosPromociones INNER JOIN Ventas ON VentasUsuariosPromociones.VentaId = Ventas.VentaId INNER JOIN VentasPromocionesDetalles INNER JOIN VentasPromociones ON VentasPromocionesDetalles.VentaPromocionId = VentasPromociones.VentaPromocionId ON VentasUsuariosPromociones.VentaPromocionDetalleId = VentasPromocionesDetalles.VentaPromocionDetalleId
                WHERE (Ventas.VentaFechaBaja IS NULL) AND (VentasPromocionesDetalles.VentaPromocionDetalleFechaBaja IS NULL) AND (Ventas.VentaId = $VentaId) ";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
}