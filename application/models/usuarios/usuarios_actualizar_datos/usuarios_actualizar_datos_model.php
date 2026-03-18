<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_actualizar_datos_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
    public function usuarios_actualizar_datos_model_participante(){
        $SQL = "SELECT UsuarioDetalleId, UsuarioId, UsuarioDetalleNombre, UsuarioDetalleSegundoNombre, UsuarioDetalleApellidoPaterno, UsuarioDetalleApellidoMaterno, UsuarioDetalleUsuario, UsuarioDetalleEmail, UsuarioDetalleTelefono,UsuarioDetalleCelular, UsuarioDetalleRFC, UsuarioDetalleCP, UsuarioDetalleEstado, UsuarioDetalleCiudad, UsuarioDetalleMunicipio, UsuarioDetalleColonia, UsuarioDetalleCalle, UsuarioDetalleExterior, UsuarioDetalleInterior
                FROM UsuariosDetalles WHERE  (UsuarioDetalleFechaBaja IS NULL) AND (UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();     
    }
    public function usuarios_actualizar_datos_model_valida_email_repetido($email=""){
        $email_clean = $this->security->xss_clean($email); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot "
                . "FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId "
                . "WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (Usuarios.UsuarioId <> ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).") AND (UsuariosDetalles.UsuarioDetalleEmail = '$email_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
    public function usuarios_actualizar_datos_model_alida_celular_repetido($celular=""){
        $celular_clean = $this->security->xss_clean($celular); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot "
                . "FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId "
                . "WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (Usuarios.UsuarioId <> ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).") AND (UsuariosDetalles.UsuarioDetalleCelular = '$celular_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }    
    public function usuarios_actualizar_datos_model_update_usaurio($DetalleUsuarioId,$data,$UsuarioDetalleEmail,$UsuarioDetalleValidarEmailToken) {
        $DetalleUsuarioId_clean = $this->security->xss_clean($DetalleUsuarioId);
        $data_clean             = utf8_decode($this->security->xss_clean($data));
        if ($this->session->userdata(funciones_strategix_sitio_alias("s_perfil_id"))<=5){
            $SQLINSERT          = "INSERT INTO UsuariosDetalles (UsuarioDetalleNombre,UsuarioDetalleSegundoNombre,UsuarioDetalleApellidoPaterno,UsuarioDetalleApellidoMaterno,UsuarioDetalleClave,UsuarioDetalleEmail,UsuarioDetalleTelefono,UsuarioDetalleCelular,UsuarioDetalleSessionId,UsuarioDetalleRFC,UsuarioDetalleCP,UsuarioDetalleEstado,UsuarioDetalleCiudad,UsuarioDetalleMunicipio,UsuarioDetalleColonia,UsuarioDetalleCalle,UsuarioDetalleExterior,UsuarioDetalleInterior,UsuarioDetalleObservaciones,UsuarioId,UsuarioDetalleUsuario,UsuarioDetalleUsuarioIdRegistro) 
                                    SELECT                       $data,UsuarioDetalleRFC,UsuarioDetalleCP,UsuarioDetalleEstado,UsuarioDetalleCiudad,UsuarioDetalleMunicipio,UsuarioDetalleColonia,UsuarioDetalleCalle,UsuarioDetalleExterior,UsuarioDetalleInterior,'PRIMERA ACTUALIZACION DE DATOS',UsuarioId,UsuarioDetalleUsuario,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."
                                    FROM UsuariosDetalles
                                    WHERE UsuarioDetalleId = $DetalleUsuarioId_clean";
        } else {
            $SQLINSERT          = "INSERT INTO UsuariosDetalles (UsuarioDetalleNombre,UsuarioDetalleSegundoNombre,UsuarioDetalleApellidoPaterno,UsuarioDetalleApellidoMaterno,UsuarioDetalleClave,UsuarioDetalleEmail,UsuarioDetalleTelefono,UsuarioDetalleCelular,UsuarioDetalleSessionId,UsuarioDetalleRFC,UsuarioDetalleCP,UsuarioDetalleEstado,UsuarioDetalleCiudad,UsuarioDetalleMunicipio,UsuarioDetalleColonia,UsuarioDetalleCalle,UsuarioDetalleExterior,UsuarioDetalleInterior,UsuarioDetalleObservaciones,UsuarioId,UsuarioDetalleUsuario,UsuarioDetalleUsuarioIdRegistro) 
                                    SELECT                       $data,UsuarioDetalleCP,UsuarioDetalleEstado,UsuarioDetalleCiudad,UsuarioDetalleMunicipio,UsuarioDetalleColonia,UsuarioDetalleCalle,UsuarioDetalleExterior,UsuarioDetalleInterior,'PRIMERA ACTUALIZACION DE DATOS',UsuarioId,UsuarioDetalleUsuario,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."
                                    FROM UsuariosDetalles
                                    WHERE UsuarioDetalleId = $DetalleUsuarioId_clean";
        }
        $this->db->query($SQLINSERT);
        $query  = $this->db->query("SELECT IDENT_CURRENT('UsuariosDetalles') as last_id"); $res = $query->result(); $id = $res[0]->last_id;      
        $SQLUPDATE              = "UPDATE UsuariosDetalles SET UsuariosDetalles.UsuarioDetalleFechaBaja = GETDATE(),UsuariosDetalles.UsuarioDetalleUsuarioIdBaja = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." WHERE UsuariosDetalles.UsuarioDetalleId = $DetalleUsuarioId_clean";
        $this->db->query($SQLUPDATE);     
        if(funciones_strategix_valida_terminos_condiciones_aviso_privacidad_actualiza_datos($this->session->userdata(funciones_strategix_sitio_alias('s_actualiza_datos')))==0){
            $SQL    = "UPDATE Usuarios SET UsuarioFechaActualizoDatos = getdate() WHERE UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
            $this->db->query($SQL);
        }        
        return 1;
    } 
    public function usuarios_actualizar_datos_model_get_valida_rfc($rfc=""){
        $rfc_clean = $this->security->xss_clean($rfc); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE UsuariosDetalles.UsuarioId <> ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." AND (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleRFC = '$rfc_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
}