<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_participantes_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
      
    public function usuarios_participantes_model_distribuidoras($where) {
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Distribuidores.DistribuidorFechaBaja IS NULL) $where";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function usuarios_participantes_model_usuario_comercio($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT DistribuidorId FROM UsuariosDistribuidores WHERE  (UsuariosDistribuidores.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();    
    }
    public function usuarios_participantes_model_perfiles($perfiles) {
        $perfiles_clean = $this->security->xss_clean($perfiles); 
        $SQL = "SELECT PerfilId,PerfilDescripcion FROM Perfiles WHERE PerfilId IN ($perfiles_clean)";
        $query	= $this->db->query($SQL);
//         echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function participante_model_baja_usuario($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "UPDATE Usuarios set UsuarioFechaBajaParticipante = GETDATE(),UsuarioBajaParticipanteUsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." where UsuarioId = $UsuarioId_clean";
        $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>";
        return 1;    
    } 
    public function usuarios_participantes_model_tabla($where="") {
    $SQL = "SELECT 
            Usuarios.UsuarioId, 
            Usuarios.UsuarioFechaRegistro, 
            Usuarios.PerfilId, 
            UsuariosDetalles.UsuarioDetalleNombre, 
            UsuariosDetalles.UsuarioDetalleEmail, 
            UsuariosDetalles.UsuarioDetalleCelular, 
            UsuariosDetalles.UsuarioDetalleRFC, 
            DistribuidoresDetalles.DistribuidorDetalleCodigo,
            DistribuidoresDetalles.DistribuidorDetalleRazonSocial,
            DistribuidoresDetalles.DistribuidorDetalleNombreComercial,
            DistribuidoresDetalles.DistribuidorDetalleRegistroFederal,
            DistribuidoresDetalles.DistribuidorDetalleInscripcionEstatal,
            Perfiles.PerfilDescripcion,
            Usuarios.UsuarioFechaBajaParticipante,
            Usuarios.UsuarioFechaBajaDistribuidora 
            FROM Usuarios 
            INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
            INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId 
            INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId 
            INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
            INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId 
            WHERE (UsuarioDetalleFechaBaja IS NULL) 
            AND (DistribuidorFechaBaja IS NULL) 
            AND (DistribuidorDetalleFechaBaja IS NULL) $where ";
        $query	= $this->db->query($SQL);
     //   echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function usuarios_participantes_model_combo_distribuidor_administradores($where){
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL $where";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function usuarios_participantes_model_combo_distribuidor_regionales($where){
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM UsuariosDistribuidores INNER JOIN Usuarios ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId WHERE (Usuarios.PerfilId in (4,5,6)) AND (Distribuidores.DistribuidorFechaBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Usuarios.UsuarioId = " . $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')) . ") $where";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function usuarios_participantes_model_combo_distribuidor_ejecutrivos($where){
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial  FROM UsuariosDistribuidores INNER JOIN Usuarios ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId WHERE (Usuarios.PerfilId in (7)) AND (Distribuidores.DistribuidorFechaBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Usuarios.UsuarioId = " . $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')) . ") $where";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    } 
}
