<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_participantes_modificacion_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
    public function usuarios_participantes_modificacion_model_participante($UsuarioId){
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT ud.UsuarioDetalleRFC,p.PerfilId,p.PerfilDescripcion, ud.UsuarioDetalleId, u.UsuarioId, ud.UsuarioDetalleNombre, ud.UsuarioDetalleEmail, ud.UsuarioDetalleCelular, ud.UsuarioDetalleFechaRegistro, ud.UsuarioDetalleUsuarioIdRegistro, ud.UsuarioDetalleSessionId, ud.UsuarioDetalleFechaBaja, ud.UsuarioDetalleUsuarioIdBaja, ud.UsuarioDetalleClave
                FROM Usuarios u INNER JOIN UsuariosDetalles ud ON u.UsuarioId = ud.UsuarioId INNER JOIN Perfiles p ON u.PerfilId = p.PerfilId
                WHERE (u.UsuarioId = $UsuarioId_clean) AND (u.UsuarioFechaBajaParticipante IS NULL) AND (u.UsuarioFechaBajaDistribuidora IS NULL) AND  (ud.UsuarioDetalleFechaBaja IS NULL)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();     
    }
    public function usuarios_participantes_modificacion_model_usuario_distribuidoras($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT Comercios.ComercioRazonSocial FROM UsuariosComercios INNER JOIN Comercios ON UsuariosComercios.ComercioId = Comercios.ComercioId WHERE (Comercios.ComercioTipoId = 1) AND (UsuariosComercios.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function Usuarios_participantes_modificacion_model_usuario_comercio($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT        DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM UsuariosDistribuidores INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId
                WHERE  (UsuariosDistribuidores.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();    
    } 
    public function usuarios_participantes_modificacion_model_update_usaurio($DetalleUsuarioId,$data) {
        $DetalleUsuarioId_clean = $this->security->xss_clean($DetalleUsuarioId);
        $data_clean             = utf8_decode($this->security->xss_clean($data));
        $SQLINSERT              = "INSERT INTO UsuariosDetalles (UsuarioId,UsuarioDetalleNombre, UsuarioDetalleClave,UsuarioDetalleEmail,UsuarioDetalleRFC,UsuarioDetalleCelular,UsuarioDetalleUsuarioIdRegistro,UsuarioDetalleSessionId) VALUES ($data_clean)";
        $this->db->query($SQLINSERT);
        $SQLUPDATE              = "UPDATE UsuariosDetalles SET UsuariosDetalles.UsuarioDetalleFechaBaja = DATEADD(hour, 3, GETDATE()),UsuariosDetalles.UsuarioDetalleUsuarioIdBaja = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." WHERE UsuariosDetalles.UsuarioDetalleId = $DetalleUsuarioId_clean";
        $this->db->query($SQLUPDATE);
        return 1;
    } 
    public function usuarios_participantes_modificacion_model_valida_rfc($rfc="",$DetalleUsuarioId){
        $rfc_clean = $this->security->xss_clean($rfc);
        $DetalleUsuarioId_clean = $this->security->xss_clean($DetalleUsuarioId); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE UsuariosDetalles.UsuarioId <> ".$DetalleUsuarioId_clean."AND (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleRFC = '$rfc_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }   
    
    public function usuarios_participantes_modificacion_model_valida_email($email="",$DetalleUsuarioId){
        $email_clean = $this->security->xss_clean($email); 
        $DetalleUsuarioId_clean = $this->security->xss_clean($DetalleUsuarioId); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE UsuariosDetalles.UsuarioId <> ".$DetalleUsuarioId_clean." AND  (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleEmail = '$email_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
    public function usuarios_participantes_modificacion_model_valida_celular($celular="",$DetalleUsuarioId){
        $celular_clean = $this->security->xss_clean($celular); 
        $DetalleUsuarioId_clean = $this->security->xss_clean($DetalleUsuarioId); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE UsuariosDetalles.UsuarioId <> ".$DetalleUsuarioId_clean." AND  (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleCelular = '$celular_clean')";
        $query	= $this->db->query($SQL);
        //secho  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
}
