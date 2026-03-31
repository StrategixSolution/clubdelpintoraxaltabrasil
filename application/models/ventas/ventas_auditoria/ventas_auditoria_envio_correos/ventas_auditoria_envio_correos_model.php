<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 ABRIL 2025 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class ventas_auditoria_envio_correos_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function ventas_auditoria_envio_correos_model_combo_anio(){
        $SQL = "SELECT DISTINCT YEAR(VentaFechaRegistro) AS anio FROM Ventas ORDER BY YEAR(VentaFechaRegistro) ASC";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_auditoria_envio_correos_model_combo_mes($anio){
        $anio_clean = $this->security->xss_clean($anio);
        $SQL = "SELECT DISTINCT MONTH(VentaFechaRegistro) AS mes FROM Ventas WHERE YEAR(VentaFechaRegistro) = ? ORDER BY MONTH(VentaFechaRegistro) ASC";
        $query	= $this->db->query($SQL,array($anio_clean));
        return $query->result();
    }    
    public function ventas_auditoria_envio_correos_model_crea_tabla($anio,$mes){
        $anio_clean = $this->security->xss_clean($anio);
        $mes_clean = $this->security->xss_clean($mes);
        /******************************************** TABLA DE AUDITORIAS ******************************************/
        $SQL1 = "SELECT 
Ventas.VentaId, 
VentasAuditorias.
VentaAuditoriaId,
VentasAuditorias.VentaAuditoriaFechaEnvioCorreo, 
Ventas.TarjetaNumero, 
Ventas.TarjetaNumero, 
Ventas.UsuarioDetalleId, 
Ventas.DistribuidorDetalleId, 
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
VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion, 
VentasAuditorias.VentaAuditoriaFechaAudito, 
VentasAuditorias.VentaAuditoriaUsuarioAudito, 
UsuariosDetalles.UsuarioDetalleNombre, 
UsuariosDetalles.UsuarioDetalleSegundoNombre, 
UsuariosDetalles.UsuarioDetalleApellidos, 
VentasAuditorias.VentaAuditoriaFechaEnvioCorreoCierre 
FROM Ventas 
inner join DistribuidoresDetalles on DistribuidoresDetalles.DistribuidorDetalleId = ventas.DistribuidorDetalleId 
INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
INNER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId 
INNER JOIN VentasAuditoriasEstatusOportunidades ON VentasAuditorias.VentaAuditoriaEstatusOportunidadId = VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadId 
INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId 
INNER JOIN UsuariosDetalles ON VentasAuditorias.VentaAuditoriaUsuarioAudito = UsuariosDetalles.UsuarioId 
LEFT OUTER JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId 
WHERE  (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusId = 3) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (YEAR(Ventas.VentaFechaRegistro) = ?) AND (MONTH(Ventas.VentaFechaRegistro) = ?) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (Ventas.VentaFechaBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL)";
        $query_tabla	= $this->db->query($SQL1,array($anio_clean,$mes_clean));
        $data["auditoria_tabla"]        =  $query_tabla->result();
//        echo $this->db->last_query();  
        return $data;
    }  
    public function ventas_auditoria_envio_correos_model_ticket_modal($VentaId){
        $VentaId_clean = $this->security->xss_clean($VentaId);
        $SQL = "SELECT Ventas.VentaId, Ventas.TarjetaId, Ventas.TarjetaNumero, Ventas.VentaUsuarioIdMP, Ventas.VentaUsuarioNombreMP, Ventas.DistribuidorId, Ventas.DistribuidorDetalleId, Ventas.DistribuidorDetalleCodigo, Ventas.DistribuidorDetalleRazonSocial, Ventas.DistribuidorDetalleNombreComercial, Ventas.UsuarioDetalleId, Ventas.VentaNumeroTicket, Ventas.VentaMontoTicket, Ventas.VentaFotoTicket, Ventas.VentaFechaRegistro, VentasAuditorias.VentaAuditoriaEstatusId, VentasAuditorias.VentaAuditoriaTipoId, VentasAuditorias.VentaAuditoriaEstatusOportunidadId, VentasAuditorias.VentaAuditoriaObservacionId, VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion, VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadDescripcion, VentasAuditoriasTipos.VentaAuditoriaTipoDescripcion, VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId INNER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId INNER JOIN VentasAuditoriasEstatusOportunidades ON VentasAuditorias.VentaAuditoriaEstatusOportunidadId = VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadId INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId LEFT OUTER JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId
        WHERE Ventas.VentaId = ?";
        $query	= $this->db->query($SQL,array($VentaId_clean));
        //echo  $this->db->last_query()."<br>"; 
        return $query->row();
    } 
    public function ventas_auditoria_envio_correos_model_tickets_repetidos($VentaId,$anio,$mes,$DistribuidorId,$VentaUsuarioIdMP,$VentaMontoTicket){
        $tickets = "";
        $VentaId_clean = $this->security->xss_clean($VentaId);
        $anio_clean = $this->security->xss_clean($anio);
        $mes_clean = $this->security->xss_clean($mes);
        $DistribuidorId_clean = $this->security->xss_clean($DistribuidorId);
        $VentaUsuarioIdMP_clean = $this->security->xss_clean($VentaUsuarioIdMP);
        $VentaMontoTicket_clean = $this->security->xss_clean($VentaMontoTicket);
        $SQL    = "SELECT VentaId FROM Ventas WHERE VentaId <> ? AND VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro)= ? AND MONTH(VentaFechaRegistro) = ? AND DistribuidorId = ? AND VentaUsuarioIdMP = ? AND VentaMontoTicket = ?";
        $query	= $this->db->query($SQL,array($VentaId_clean,$anio_clean,$mes_clean,$DistribuidorId_clean,$VentaUsuarioIdMP_clean,$VentaMontoTicket_clean));
        //echo  $this->db->last_query()."<br>"; 
        foreach ($query->result() as $row) {
            $tickets .= $row->VentaId.",";
        }
        $tickets = substr ($tickets, 0, strlen($tickets) - 1);
        return $tickets;
    } 
    public function ventas_auditoria_envio_correos_model_observaciones(){
        $SQL = "SELECT VentaAuditoriaObservacionId,VentaAuditoriaObservacionDescripcion FROM VentasAuditoriasObservaciones";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result(); 
    }
    public function ventas_auditoria_envio_correos_model_crea_tabla_email($VentaId){
        $VentaId_clean = $this->security->xss_clean($VentaId);
        /******************************************** TABLA DE AUDITORIAS ******************************************/
        $SQL1 = "SELECT Ventas.VentaId, VentasAuditorias.VentaAuditoriaId,VentasAuditorias.VentaAuditoriaFechaEnvioCorreo, Ventas.TarjetaId, Ventas.TarjetaNumero, Ventas.VentaUsuarioIdMP, Ventas.VentaUsuarioNombreMP, Ventas.DistribuidorId, Ventas.DistribuidorDetalleId, Ventas.DistribuidorDetalleCodigo, Ventas.DistribuidorDetalleRazonSocial, Ventas.DistribuidorDetalleNombreComercial, Ventas.UsuarioDetalleId, Ventas.VentaNumeroTicket, Ventas.VentaMontoTicket, Ventas.VentaFotoTicket, Ventas.VentaFechaRegistro, VentasAuditorias.VentaAuditoriaEstatusId, VentasAuditorias.VentaAuditoriaTipoId, VentasAuditorias.VentaAuditoriaEstatusOportunidadId, VentasAuditorias.VentaAuditoriaObservacionId, VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion, VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadDescripcion, VentasAuditoriasTipos.VentaAuditoriaTipoDescripcion, VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion, VentasAuditorias.VentaAuditoriaFechaAudito, VentasAuditorias.VentaAuditoriaUsuarioAudito, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidoPaterno, UsuariosDetalles.UsuarioDetalleApellidoMaterno FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId INNER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId INNER JOIN VentasAuditoriasEstatusOportunidades ON VentasAuditorias.VentaAuditoriaEstatusOportunidadId = VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadId INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId INNER JOIN UsuariosDetalles ON VentasAuditorias.VentaAuditoriaUsuarioAudito = UsuariosDetalles.UsuarioId LEFT OUTER JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId
        WHERE  (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusId = 3) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (Ventas.VentaId = ?) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (Ventas.VentaFechaBaja IS NULL)";
        $query_tabla	= $this->db->query($SQL1,array($VentaId_clean));
//        echo $this->db->last_query();  
        return $query_tabla->row();
    } 
    public function ventas_auditoria_envio_correos_model_datos_distribuidor($DistribuidorId){
        $DistribuidorId_clean = $this->security->xss_clean($DistribuidorId);
        $SQL = "SELECT Usuarios.UsuarioId, Usuarios.PerfilId, UsuariosDetalles.UsuarioDetalleId, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidoPaterno, UsuariosDetalles.UsuarioDetalleApellidoMaterno, UsuariosDetalles.UsuarioDetalleEmail, UsuariosDistribuidores.DistribuidorId FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDistribuidores.DistribuidorId = ?) AND (Usuarios.PerfilId IN (6, 7, 8))";
        $query	= $this->db->query($SQL,array($DistribuidorId_clean));
//        echo  $this->db->last_query()."<br>"; 
        return $query->result(); 
    }
    public function ventas_auditoria_envio_correos_model_actualiza_envio($VentaAuditoriaId,$VentaAuditoriaEnvioCorreoTipoId){
        $this->db->query("UPDATE VentasAuditorias SET VentaAuditoriaFechaEnvioCorreoCierre = CASE WHEN DATEPART(WEEKDAY, GETDATE()) IN (5, 6) THEN DATEADD(DAY, 3, GETDATE()) ELSE DATEADD(DAY, 2, GETDATE()) END,VentaAuditoriaFechaEnvioCorreo = GETDATE(), VentaAuditoriaUsuarioIdEnvioCorreo = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).", VentaAuditoriaEnvioCorreoTipoId = $VentaAuditoriaEnvioCorreoTipoId WHERE VentaAuditoriaId = $VentaAuditoriaId");
        return 1;
    }
     public function ventas_auditoria_envio_correos_model_distribuidora_Id($cmbAnio,$cmbMes) {  
        $anio_clean = $this->security->xss_clean($cmbAnio);
        $mes_clean = $this->security->xss_clean($cmbMes);
        $SQL ="SELECT DISTINCT  DistribuidoresDetalles.DistribuidorId	 
                FROM Ventas 
                inner join DistribuidoresDetalles on DistribuidoresDetalles.DistribuidorDetalleId = ventas.DistribuidorDetalleId 
                INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
                INNER JOIN UsuariosDetalles ON VentasAuditorias.VentaAuditoriaUsuarioAudito = UsuariosDetalles.UsuarioId 
                WHERE  (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) 
                AND (VentasAuditorias.VentaAuditoriaEstatusId = 3) 
                AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) 
                AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) 
                AND (YEAR(Ventas.VentaFechaRegistro) = ?) 
                AND (MONTH(Ventas.VentaFechaRegistro) = ?) 
                AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) 
                AND (Ventas.VentaFechaBaja IS NULL)
                AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL)
                AND (VentaAuditoriaFechaEnvioCorreo IS NULL)";
        $query	= $this->db->query($SQL, array($anio_clean, $mes_clean));
        //  echo $this->db->last_query();
        return $query->result();        
    }   
    public function ventas_auditoria_envio_correos_model_ventas($cmbAnio,$cmbMes,$DistribuidorId){
        $anio_clean = $this->security->xss_clean($cmbAnio);
        $mes_clean = $this->security->xss_clean($cmbMes);
        $distribuidor_clean = $this->security->xss_clean($DistribuidorId);
        $SQL ="SELECT Ventas.VentaId, VentasAuditorias.VentaAuditoriaId,VentasAuditorias.VentaAuditoriaFechaEnvioCorreo, Ventas.TarjetaId, Ventas.TarjetaNumero, Ventas.VentaUsuarioIdMP, Ventas.VentaUsuarioNombreMP, Ventas.DistribuidorId, Ventas.DistribuidorDetalleId, Ventas.DistribuidorDetalleCodigo, Ventas.DistribuidorDetalleRazonSocial, Ventas.DistribuidorDetalleNombreComercial, Ventas.UsuarioDetalleId, Ventas.VentaNumeroTicket, Ventas.VentaMontoTicket, Ventas.VentaFotoTicket, Ventas.VentaFechaRegistro, VentasAuditorias.VentaAuditoriaEstatusId, VentasAuditorias.VentaAuditoriaTipoId, VentasAuditorias.VentaAuditoriaEstatusOportunidadId, VentasAuditorias.VentaAuditoriaObservacionId, VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion, VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadDescripcion, VentasAuditoriasTipos.VentaAuditoriaTipoDescripcion, VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion, VentasAuditorias.VentaAuditoriaFechaAudito, VentasAuditorias.VentaAuditoriaUsuarioAudito, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidoPaterno, UsuariosDetalles.UsuarioDetalleApellidoMaterno 
        FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId INNER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId INNER JOIN VentasAuditoriasEstatusOportunidades ON VentasAuditorias.VentaAuditoriaEstatusOportunidadId = VentasAuditoriasEstatusOportunidades.VentaAuditoriaEstatusOportunidadId INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId INNER JOIN UsuariosDetalles ON VentasAuditorias.VentaAuditoriaUsuarioAudito = UsuariosDetalles.UsuarioId LEFT OUTER JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId
        WHERE  (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusId = 3) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (VentaAuditoriaFechaEnvioCorreo IS NULL)
        AND (YEAR(Ventas.VentaFechaRegistro) = ?) 
        AND (MONTH(Ventas.VentaFechaRegistro) = ?) 
        AND (Ventas.DistribuidorId = ?) 
        AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (Ventas.VentaFechaBaja IS NULL)";
        $query	= $this->db->query($SQL, array($anio_clean, $mes_clean, $distribuidor_clean));
        // echo $this->db->last_query();
        return $query->result();    
    }  
     public function ventas_auditoria_envio_correos_model_cuerpocorreo($cmbAnio,$cmbMes,$DistId)    {
        $SQL ="SELECT DISTINCT DistribuidoresDetalles.DistribuidorId , DistribuidoresDetalles.DistribuidorDetalleCodigo , DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleNombreComercial
        FROM Ventas 
        INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
        INNER JOIN UsuariosDetalles ON VentasAuditorias.VentaAuditoriaUsuarioAudito = UsuariosDetalles.UsuarioId 
        INNER JOIN DistribuidoresDetalles ON DistribuidoresDetalles.DistribuidorId = Ventas.DistribuidorId 
        WHERE  (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) 
        AND (VentasAuditorias.VentaAuditoriaEstatusId = 3) 
        AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) 
        AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) 
        AND (YEAR(Ventas.VentaFechaRegistro) = $cmbAnio) 
        AND (MONTH(Ventas.VentaFechaRegistro) = $cmbMes) 
        AND (Ventas.DistribuidorId = $DistId) 
        AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) 
        AND (Ventas.VentaFechaBaja IS NULL)
        AND (VentaAuditoriaFechaEnvioCorreo IS NULL)";
        $query	= $this->db->query($SQL);       
        //  echo $this->db->last_query();
          return $query->row();    
    }
     public function ventas_auditoria_envio_correos_model_datoscorreo($cmbAnio,$cmbMes,$DistId) {  
        $SQL ="SELECT DISTINCT UsuariosDetalles.UsuarioDetalleEmail
        FROM Usuarios 
        INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
        INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId 
        WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) 
        AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) 
        AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) 
        AND (UsuariosDistribuidores.DistribuidorId = $DistId) 
        AND (Usuarios.PerfilId IN (6, 7, 8))";
        $query	= $this->db->query($SQL);       
         // echo $this->db->last_query();
        return $query->result();        
    }  
}