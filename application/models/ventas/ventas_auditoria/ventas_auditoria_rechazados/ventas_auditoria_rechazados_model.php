<?php

/* 
 * Sistema Web Responsivo CDPMEX                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_auditoria_rechazados_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }

    public function ventas_auditoria_rechazados_model_combo_distribuidor($UsuarioId){
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial, DistribuidoresDetalles.DistribuidorId FROM UsuariosDistribuidores INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE  (UsuariosDistribuidores.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_auditoria_rechazados_model_tabla($cmb_distribuidor){
        $SQL = "SELECT 
Ventas.VentaId, 
VentasAuditorias.VentaAuditoriaId, 
Ventas.TarjetaNumero, 
UsuariosDetalles.UsuarioId as VentaUsuarioIdMP, 
CONCAT_WS(' ', UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidos ) AS VentaUsuarioNombreMP,
DistribuidoresDetalles.DistribuidorId, 
DistribuidoresDetalles.DistribuidorDetalleId, 
DistribuidoresDetalles.DistribuidorDetalleCodigo, 
DistribuidoresDetalles.DistribuidorDetalleRazonSocial,
DistribuidoresDetalles.DistribuidorDetalleNombreComercial, 
Ventas.UsuarioDetalleId,
Ventas.VentaNumeroTicket, 
Ventas.VentaMontoTicket,
Ventas.VentaFotoTicket, 
Ventas.VentaFechaRegistro, 
VentasAuditorias.VentaAuditoriaFechaEnvioCorreo,
VentasAuditorias.VentaAuditoriaFechaAudito,
VentasAuditorias.VentaAuditoriaEstatusId, 
VentasAuditorias.VentaAuditoriaTipoId, 
VentasAuditorias.VentaAuditoriaEstatusOportunidadId, 
VentasAuditorias.VentaAuditoriaObservacionId, 
VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion, 
VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadDescripcion, 
VentasAuditoriasTipos.VentaAuditoriaTipoDescripcion, 
VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion, 
VentasAuditorias.VentaAuditoriaFechaEnvioCorreoCierre, 
VentasAuditorias.VentaAuditoriaFechaActualizado 
FROM Ventas 
INNER JOIN DistribuidoresDetalles ON DistribuidoresDetalles.DistribuidorDetalleId = Ventas.DistribuidorDetalleId 
INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
INNER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId 
INNER JOIN VentasAuditoriasEstatusOportunidades ON VentasAuditorias.VentaAuditoriaEstatusOportunidadId = VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadId 
INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId 
INNER JOIN UsuariosDetalles ON VentasAuditorias.VentaAuditoriaUsuarioAudito = UsuariosDetalles.UsuarioId
LEFT OUTER JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId 
        WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (Ventas.VentaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (VentasAuditorias.VentaAuditoriaEstatusId = 3) AND (VentasAuditorias.VentaAuditoriaUsuarioIdEnvioCorreo IS NOT NULL)  AND 
        (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) AND ('".funciones_strategix_formato_fecha_hora_actual()."' <= VentasAuditorias.VentaAuditoriaFechaEnvioCorreoCierre) AND DistribuidoresDetalles.DistribuidorId =$cmb_distribuidor";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->result();
    } 
    public function ventas_auditoria_rechazados_model_ticket_modal($VentaId){
        $SQL = "SELECT 
Ventas.VentaId, 
Ventas.TarjetaNumero, 
UsuariosDetalles.UsuarioId as VentaUsuarioIdMP, 
CONCAT_WS(' ', UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidos ) AS VentaUsuarioNombreMP,
DistribuidoresDetalles.DistribuidorId, 
DistribuidoresDetalles.DistribuidorDetalleId, 
DistribuidoresDetalles.DistribuidorDetalleCodigo, 
DistribuidoresDetalles.DistribuidorDetalleRazonSocial,
DistribuidoresDetalles.DistribuidorDetalleNombreComercial, 
Ventas.UsuarioDetalleId, 
Ventas.VentaNumeroTicket, 
Ventas.VentaMontoTicket, 
Ventas.VentaFotoTicket, 
Ventas.VentaFechaRegistro, 
VentasAuditorias.VentaAuditoriaEstatusId, 
VentasAuditorias.VentaAuditoriaTipoId, 
VentasAuditorias.VentaAuditoriaEstatusOportunidadId, 
VentasAuditorias.VentaAuditoriaObservacionId, 
VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion, 
VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadDescripcion, 
VentasAuditoriasTipos.VentaAuditoriaTipoDescripcion, 
VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion 
FROM Ventas 
INNER JOIN DistribuidoresDetalles ON DistribuidoresDetalles.DistribuidorDetalleId = Ventas.DistribuidorDetalleId 
INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
INNER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId 
INNER JOIN VentasAuditoriasEstatusOportunidades ON VentasAuditorias.VentaAuditoriaEstatusOportunidadId = VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadId 
INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId 
INNER JOIN UsuariosDetalles ON VentasAuditorias.VentaAuditoriaUsuarioAudito = UsuariosDetalles.UsuarioId
LEFT OUTER JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId 
        WHERE Ventas.VentaId = ?";
        $query	= $this->db->query($SQL,array($VentaId));
        //echo  $this->db->last_query()."<br>"; 
        return $query->row();
    } 
    public function ventas_auditoria_rechazados_model_tickets_repetidos($VentaId,$anio,$mes,$DistribuidorId,$VentaUsuarioIdMP,$VentaMontoTicket){
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
    public function ventas_auditoria_rechazados_model_observaciones(){
        $SQL = "SELECT VentaAuditoriaObservacionId,VentaAuditoriaObservacionDescripcion FROM VentasAuditoriasObservaciones";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result(); 
    }
    public function ventas_auditoria_rechazados_model_observacion_descripcion($VentaAuditoriaObservacionId){
        $SQL = "SELECT VentaAuditoriaObservacionId,VentaAuditoriaObservacionDescripcion FROM VentasAuditoriasObservaciones WHERE VentaAuditoriaObservacionId = $VentaAuditoriaObservacionId";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return utf8_encode(strtoupper($query->row()->VentaAuditoriaObservacionDescripcion)); 
    }
    public function ventas_auditoria_rechazados_model_folio_tarjeta($VentaId) {
        $SQL = "SELECT VentaId,TarjetaNumero,VentaNumeroTicket,VentaMontoTicket,VentaFotoTicket FROM Ventas WHERE  (VentaId = ?)";
        $query	= $this->db->query($SQL,array($VentaId));
        //echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
    public function ventas_auditoria_rechazados_model_venta_detalles($VentaId) {
        $SQL = "SELECT
        VentasDetalles.VentaDetalleId,
        VentasDetalles.VentaId,
        VentasDetalles.UsuarioIdCapturo,
        VentasDetalles.VentaDetalleMonto,
        VentasDetalles.VentaDetalleCantidad,
        VentasDetalles.VentaDetalleTotal,
        VentasDetalles.VentaDetalleLitros,
        VentasDetalles.ProductoMarcaId,
        ProductosMarcas.ProductoClaseId,
        VentasDetalles.VentaDetalleFechaRegistro
        FROM VentasDetalles
        INNER JOIN ProductosMarcas ON VentasDetalles.ProductoMarcaId = ProductosMarcas.ProductoMarcaId
        WHERE VentasDetalles.VentaDetalleFechaBaja IS NULL
        AND VentasDetalles.VentaId = $VentaId";
       $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_auditoria_rechazados_model_maestro_pintor_informacion($numero_tarjeta){
        $numero_tarjeta_clean = $this->security->xss_clean($numero_tarjeta);
        $SQL    = "SELECT Usuarios.UsuarioId, UsuariosDetalles.UsuarioDetalleId, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidos, Tarjetas.TarjetaNumero, UsuariosDetalles.UsuarioDetalleEmail,UsuariosDetalles.UsuarioDetalleCelular, UsuariosDetalles.UsuarioDetalleRFC,Tarjetas.TarjetaId FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN Tarjetas ON Usuarios.UsuarioId = Tarjetas.UsuarioId WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (Tarjetas.TarjetaFechaBaja IS NULL) AND (Tarjetas.TarjetaEstatusId = 2) AND (Tarjetas.TarjetaNumero = ?)";
        $query	= $this->db->query($SQL, array($numero_tarjeta_clean));
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
    public function ventas_auditoria_rechazados_model_distribuidor(){
        $SQL    = "SELECT DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorId,DistribuidoresDetalles.DistribuidorDetalleCodigo,DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial FROM UsuariosDistribuidores INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL AND UsuariosDistribuidores.DistribuidorId = ? ";
        $query	= $this->db->query($SQL, array($this->session->userdata(funciones_strategix_sitio_alias('s_distribuidor_id'))));
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
   
    public function ventas_auditoria_rechazados_model_guardar_venta($VentaId,$numero_ticket,$monto_ticket,$imagen,$session_id,$cargaarchivo){
        $numero_ticket_clean = $this->security->xss_clean($numero_ticket);
        $monto_ticket_clean = $this->security->xss_clean($monto_ticket);
        $this->db->query("INSERT INTO VentasHistoricosRechazos (VentaId, TarjetaNumero, DistribuidorDetalleId, UsuarioDetalleId, UsuarioIdCapturo, VentaNumeroTicket, VentaMontoTicketCapturado, VentaMontoTicket, VentaCantidadProdcutos, VentaTotalCantidadProdcutos, VentaFotoTicket, VentaFechaRegistro, VentaFechaBaja, VentaHistoricoRechazoFechaRegistro, VentaHistoricoRechazoUsuarioIdRegistro, VentaHistoricoRechazoSessionId) 
        SELECT VentaId, TarjetaNumero, DistribuidorDetalleId, UsuarioDetalleId, UsuarioIdCapturo, VentaNumeroTicket, VentaMontoTicketCapturado, VentaMontoTicket, VentaCantidadProdcutos, VentaTotalCantidadProdcutos, VentaFotoTicket, VentaFechaRegistro, VentaFechaBaja, 
        GETDATE(),".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",'$session_id' FROM Ventas WHERE VentaId = $VentaId");
             if($cargaarchivo == 1){
        $this->db->query("UPDATE Ventas SET VentaNumeroTicket = '$numero_ticket_clean',VentaMontoTicket = '$monto_ticket_clean',VentaFotoTicket = '$imagen' WHERE VentaId = $VentaId");
            }else{
         $this->db->query("UPDATE Ventas SET VentaNumeroTicket = '$numero_ticket_clean',VentaMontoTicket = '$monto_ticket_clean' WHERE VentaId = $VentaId");
            }
        $this->db->query("INSERT INTO VentasAuditorias (VentaId,UsuarioIdCapturo,VentaAuditoriaEstatusId,VentaAuditoriaTipoId,VentaAuditoriaEstatusOportunidadId) SELECT VentaId,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",1,VentaAuditoriaTipoId,2 FROM VentasAuditorias WHERE VentaId = $VentaId ");

        $this->db->query("UPDATE VentasAuditorias SET VentaAuditoriaFechaActualizado =GETDATE() WHERE VentaId = $VentaId AND VentaAuditoriaEstatusOportunidadId = 1 AND VentaAuditoriaFechaActualizado IS NULL");

        return 1;
    }
     public function ventas_auditoria_rechazados_model_nombre_clases($ProductoClaseId){
        $SQL    = "SELECT ProductoClaseId,ProductoClaseDescripcion FROM ProductosClases WHERE ProductoClaseId =".$ProductoClaseId;
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->ProductoClaseDescripcion;
    }
    public function ventas_auditoria_rechazados_model_nombre_marcas($ProductoMarcaId){
        $SQL    = "SELECT ProductoMarcaId,ProductoClaseId,ProductoMarcaDescripcion FROM ProductosMarcas WHERE ProductoMarcaId=".$ProductoMarcaId;
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->ProductoMarcaDescripcion;
    }
    public function ventas_auditoria_rechazados_model_nombre_litros($ProductoMarcaId){
        $SQL    = "SELECT VentaDetalleGalonId,VentaDetalleGalonDescripcion,VentaDetalleGalonEquivalencia FROM VentasDetallesGalones where VentaDetalleGalonEquivalencia=".$ProductoMarcaId;
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->VentaDetalleGalonDescripcion;
    }
    public function ventas_auditoria_rechazados_model_combo_clases(){
        $SQL    = "SELECT ProductoClaseId,ProductoClaseDescripcion FROM ProductosClases WHERE ProductoClaseFechaBaja IS NULL";
        $query	= $this->db->query($SQL);
     //   echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
     public function ventas_auditoria_rechazados_model_combo_litros(){
        $SQL    = "SELECT VentaDetalleGalonId,VentaDetalleGalonDescripcion,VentaDetalleGalonEquivalencia FROM VentasDetallesGalones ";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }  
    public function ventas_auditoria_rechazados_model_combo_marcas($ProductoClaseId){
        $SQL    = "SELECT ProductoMarcaId,ProductoClaseId,ProductoMarcaDescripcion FROM ProductosMarcas WHERE ProductoClaseId=".$ProductoClaseId." AND ProductoMarcaFechaBaja IS NULL";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_auditoria_rechazados_model_baja_venta_detalle($id_prod){
        $SQL    = "UPDATE VentasDetalles SET VentaDetalleFechaBaja=GETDATE() WHERE VentaDetalleId=$id_prod";
        $this->db->query($SQL);
        return 1;
    }
    public function ventas_auditoria_rechazados_model_guardar_venta_detalle($data) {
        $SQL    = "INSERT INTO VentasDetalles (VentaId,UsuarioIdCapturo,VentaDetalleMonto,VentaDetalleCantidad,VentaDetalleLitros,ProductoMarcaId,VentaDetalleTotal) VALUES ($data)";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
    }   
}