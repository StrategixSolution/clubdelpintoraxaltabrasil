<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 marzo 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_recupera_clave_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function usuarios_recupera_clave_model_datos_mail($email){
        $email_clean = $this->security->xss_clean($email);
        $SQL    = "SELECT Usuarios.UsuarioId,Usuarios.UsuarioSessionId, Perfiles.PerfilDescripcion, UsuariosDetalles.UsuarioDetalleNombre, 
                  UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidos, UsuariosDetalles.UsuarioDetalleClave, 
                  UsuariosDetalles.UsuarioDetalleEmail FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId
                  WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleEmail = '$email_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>";
        return $query->row();
    }
    public function usuarios_recupera_clave_model_valida_mail($email){
        $email_clean = $this->security->xss_clean($email);
        $SQL    = "SELECT count(Usuarios.UsuarioId) as tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId
                  WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleEmail = '$email_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>";
        return $query->row()->tot;
    }    
    public function usuarios_recupera_clave_model_data_whatsapp($whatsapp){
        $whatsapp_clean = $this->security->xss_clean($whatsapp);
        $SQL    = "SELECT  Usuarios.UsuarioId,  Usuarios.UsuarioSessionId, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidos, 
             UsuariosDetalles.UsuarioDetalleClave, UsuariosDetalles.UsuarioDetalleEmail,UsuariosDetalles.UsuarioDetalleCelular
                  FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId
                  WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleCelular = '$whatsapp_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>";
        return $query->row();
    }
    public function usuarios_recupera_clave_model_valida_whatsapp($whatsapp){
        $whatsapp_clean = $this->security->xss_clean($whatsapp);
        $SQL    = "SELECT count(Usuarios.UsuarioId) as tot
                FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId
                WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleCelular = '$whatsapp_clean')";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>";
        return $query->row()->tot;
    }
    public function usuarios_recupera_clave_model_usuario_detalle($UsuarioId){
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId);
          $SQL    = "SELECT UsuariosDetalles.UsuarioDetalleId, UsuariosDetalles.UsuarioId, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuarioDetalleApellidos, UsuariosDetalles.UsuarioDetalleClave, UsuariosDetalles.UsuarioDetalleEmail, UsuariosDetalles.UsuarioDetalleTelefono,UsuariosDetalles.UsuarioDetalleCelular, UsuariosDetalles.UsuarioDetalleRFC,UsuarioDetalleCP, UsuariosDetalles.UsuarioDetalleEstado, UsuariosDetalles.UsuarioDetalleCiudad, UsuariosDetalles.UsuarioDetalleMunicipio, UsuariosDetalles.UsuarioDetalleColonia, UsuariosDetalles.UsuarioDetalleCalle, UsuariosDetalles.UsuarioDetalleExterior, UsuariosDetalles.UsuarioDetalleInterior,UsuariosDetalles.UsuarioDetalleFechaRegistro, UsuariosDetalles.UsuarioDetalleUsuarioIdRegistro,UsuariosDetalles.UsuarioDetalleFechaBaja, UsuariosDetalles.UsuarioDetalleUsuarioIdBaja, UsuariosDetalles.UsuarioDetalleObservaciones, UsuariosDetalles.UsuarioDetalleSessionId, Usuarios.PerfilId FROM UsuariosDetalles INNER JOIN Usuarios ON UsuariosDetalles.UsuarioId = Usuarios.UsuarioId WHERE (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioId = '$UsuarioId_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>";
        return $query->row();
    }
    public function usuarios_recupera_clave_model_email_historico($data,$UsuarioId) {
        $data_clean = $this->security->xss_clean($data);
        $SQL2 = "UPDATE UsuariosRecuperacionClave SET UsuarioRecuperacionClaveFechaCambio = getdate(),UsuarioRecuperacionClaveCaptchaTextBox = 'SE DIO DE BAJA POR PETICION NUEVA' WHERE UsuarioRecuperacionClaveFechaCambio IS NULL AND UsuarioId = $UsuarioId";
        $this->db->query($SQL2);     
        //echo  $this->db->last_query()."<br>"; 
        $SQL = "insert into UsuariosRecuperacionClave (UsuarioId,UsuarioRecuperacionClaveIP,UsuarioRecuperacionClaveAnterior,UsuarioRecuperacionClaveEmailTecleado,UsuarioRecuperacionClaveCaptchaSession,UsuarioRecuperacionClaveCaptchaTextBox,UsuarioRecuperacionClaveSessionId) values ($data_clean)";
        $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return 1;
    }
    public function usuarios_recupera_clave_model_sesion_usuarios_recuperacion_clave($UsuarioRecuperacionClaveSessionId) {
        $UsuarioRecuperacionClaveSessionId_clean = $this->security->xss_clean($UsuarioRecuperacionClaveSessionId);
        $SQL    = "SELECT UsuarioRecuperacionClaveId,UsuarioId,UsuarioRecuperacionClaveIP,UsuarioRecuperacionClaveFechaRegistro,UsuarioRecuperacionClaveAnterior,UsuarioRecuperacionClaveEmailTecleado,UsuarioRecuperacionClaveCaptchaSession,UsuarioRecuperacionClaveCaptchaTextBox,UsuarioRecuperacionClaveSessionId,UsuarioRecuperacionClaveFechaCambio  FROM UsuariosRecuperacionClave where (UsuarioRecuperacionClaveFechaCambio IS NULL) AND (UsuarioRecuperacionClaveSessionId = '$UsuarioRecuperacionClaveSessionId_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row();        
    }
    public function usuarios_recupera_clave_model_actualizar_clave($UsuarioId,$Clave,$PerfilId,$sessionId) {
        $SQL_UsuarioDetalle = "SELECT UsuariosDetalles.UsuarioDetalleId 
                   FROM UsuariosDetalles INNER JOIN Usuarios ON UsuariosDetalles.UsuarioId = Usuarios.UsuarioId 
                   WHERE (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioId = '$UsuarioId')";
        $UsuarioDetalleId   = $this->db->query($SQL_UsuarioDetalle)->row()->UsuarioDetalleId;
        $SQL1 = "UPDATE UsuariosDetalles SET UsuarioDetalleFechaBaja = getdate(),UsuarioDetalleUsuarioIdBaja = ".$UsuarioId." WHERE UsuarioDetalleFechaBaja IS NULL AND UsuarioDetalleId = $UsuarioDetalleId";
        $this->db->query($SQL1);
            $SQLINSERT          = "
                INSERT INTO UsuariosDetalles (  UsuarioId,UsuarioDetalleNombre,UsuarioDetalleSegundoNombre,UsuarioDetalleApellidos,UsuarioDetalleEmail,UsuarioDetalleTelefono,UsuarioDetalleCelular,UsuarioDetalleRFC,UsuarioDetalleCP,UsuarioDetalleEstado,UsuarioDetalleCiudad,UsuarioDetalleMunicipio,UsuarioDetalleColonia,UsuarioDetalleCalle,UsuarioDetalleExterior,UsuarioDetalleInterior,UsuarioDetalleUsuarioIdRegistro,UsuarioDetalleObservaciones,UsuarioDetalleClave,UsuarioDetalleSessionId) 
                SELECT                          UsuarioId,UsuarioDetalleNombre,UsuarioDetalleSegundoNombre,UsuarioDetalleApellidos,UsuarioDetalleEmail,UsuarioDetalleTelefono,UsuarioDetalleCelular,UsuarioDetalleRFC,UsuarioDetalleCP,UsuarioDetalleEstado,UsuarioDetalleCiudad,UsuarioDetalleMunicipio,UsuarioDetalleColonia,UsuarioDetalleCalle,UsuarioDetalleExterior,UsuarioDetalleInterior,$UsuarioId,'CREADO AUTAMATICAMENTE AL MODIFICAR LA CLAVE','$Clave','$sessionId' FROM UsuariosDetalles WHERE UsuarioDetalleId = $UsuarioDetalleId ";   
        $this->db->query($SQLINSERT);
        $SQL2 = "UPDATE UsuariosRecuperacionClave SET UsuarioRecuperacionClaveFechaCambio = getdate() WHERE UsuarioRecuperacionClaveFechaCambio IS NULL AND UsuarioId = $UsuarioId";
        $this->db->query($SQL2);        
        return 1;
    }
}