<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_participantes_altas_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
    public function usuarios_participante_alta_model_distribuidor_pais($DistribuidorId) {
        $SQL = "SELECT Distribuidores.PaisId FROM Distribuidores WHERE Distribuidores.DistribuidorId = $DistribuidorId";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();    
    }    
    public function usuarios_participante_alta_model_combo_lista_pais($where){
        $SQL    = "SELECT DISTINCT Paises.PaisId,Paises.PaisCodigo,Paises.PaisNombre,Paises.PaisFechaRegistro,Paises.PaisFechaBaja FROM Paises inner join Usuarios on paises.PaisId= Usuarios.PaisId where PaisFechaBaja IS NULL $where";
        $query	= $this->db->query($SQL);
        return $query->result();
    }    
    public function usuarios_participante_alta_model_combo_lista_distribuidoras($where) {
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Distribuidores.DistribuidorFechaBaja IS NULL) $where";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function usuarios_participante_alta_model_combo_lista_perfiles($perfiles) {
        $perfiles_clean = $this->security->xss_clean($perfiles); 
        $SQL = "SELECT PerfilId,PerfilDescripcion FROM Perfiles WHERE PerfilId IN ($perfiles_clean)";
        $query	= $this->db->query($SQL);
//         echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }    
    public function usuarios_participantes_alta_model_usuario_comercio($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT DistribuidorId FROM UsuariosDistribuidores WHERE  (UsuariosDistribuidores.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();    
    }
    public function participantes_altas_model_get_valida_email($email=""){
        $email_clean = $this->security->xss_clean($email); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleEmail = '$email_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
    public function participantes_altas_model_get_valida_celular($celular=""){
        $celular_clean = $this->security->xss_clean($celular); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleCelular = '$celular_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
    public function participantes_altas_model_get_valida_participantes_perfil($PerfilId,$ComercioId){
        $PerfilId_clean = $this->security->xss_clean($PerfilId); 
        $ComercioId_clean = $this->security->xss_clean($ComercioId); 
        $SQL = "SELECT COUNT(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId 
        WHERE  (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Distribuidores.DistribuidorFechaBaja IS NULL) AND (Usuarios.PerfilId = $PerfilId_clean) AND (Distribuidores.DistribuidorId = $ComercioId_clean)";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
    public function participantes_altas_model_insert_participante($dataHead,$dataDetalle,$perfilId,$distribuidora){
        $perfilId_clean = $this->security->xss_clean($perfilId); 
        $distribuidora_clean = $this->security->xss_clean($distribuidora); 
        $SQL1    = "INSERT INTO Usuarios (UsuarioCapturaId,PerfilId,PaisId,UsuarioSessionId,UsuarioTipoRegistroId) VALUES ($dataHead,1)"; 
        $this->db->query($SQL1);        
        //echo  $this->db->last_query()."<br>";
        $query  = $this->db->query("SELECT IDENT_CURRENT('Usuarios') as last_id"); 
        $res    = $query->result(); 
        $id     = $res[0]->last_id;
        //echo  $this->db->last_query()."<br>";        
        $SQL2    = "INSERT INTO UsuariosDetalles (UsuarioId,UsuarioDetalleNombre,UsuarioDetalleSegundoNombre,UsuarioDetalleApellidoPaterno,UsuarioDetalleApellidoMaterno,UsuarioDetalleEmail,UsuarioDetalleTelefono,UsuarioDetalleExtension,UsuarioDetalleRFC,UsuarioDetalleCelular,UsuarioDetalleUsuarioIdRegistro,UsuarioDetalleSessionId,UsuarioDetalleUsuario,UsuarioDetalleClave) VALUES ($id,$dataDetalle,'EN CREACION','EN CREACION')";
        $this->db->query($SQL2);
        $DistribuidoraId = $distribuidora_clean;
        $SQL3    = "INSERT INTO UsuariosDistribuidores (UsuarioId,DistribuidorId) VALUES ($id,$DistribuidoraId)"; $this->db->query($SQL3); //echo  $this->db->last_query()."<br>";
        return $id;
    }
    public function participantes_altas_model_update_usaurio_clave($UsuarioId,$UsuarioDetalleUsuario) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $UsuarioDetalleUsuario_clean = $this->security->xss_clean($UsuarioDetalleUsuario);
        $SQL    = "UPDATE UsuariosDetalles SET UsuarioDetalleUsuario = '$UsuarioDetalleUsuario_clean' WHERE UsuarioId = $UsuarioId_clean";
        $this->db->query($SQL);
        return 1;
    }
    public function participantes_altas_model_update_email($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL    = "UPDATE Usuarios SET UsuarioFechaEnvioMailRegistro = GETDATE() WHERE UsuarioId = $UsuarioId_clean";
        $this->db->query($SQL);
        return 1;
    } 
    public function participantes_altas_model_get_participante($UsuarioId){
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT u.PaisId, p.PerfilId,p.PerfilDescripcion, ud.UsuarioDetalleId, u.UsuarioId, ud.UsuarioDetalleNombre, ud.UsuarioDetalleSegundoNombre, ud.UsuarioDetalleApellidoPaterno, ud.UsuarioDetalleApellidoMaterno, ud.UsuarioDetalleUsuario, ud.UsuarioDetalleClave, ud.UsuarioDetalleEmail, ud.UsuarioDetalleTelefono, ud.UsuarioDetalleExtension, ud.UsuarioDetalleCelular, ud.UsuarioDetalleFechaRegistro, ud.UsuarioDetalleUsuarioIdRegistro, ud.UsuarioDetalleSessionId, ud.UsuarioDetalleFechaBaja, ud.UsuarioDetalleUsuarioIdBaja
                FROM Usuarios u INNER JOIN UsuariosDetalles ud ON u.UsuarioId = ud.UsuarioId INNER JOIN Perfiles p ON u.PerfilId = p.PerfilId
                WHERE (u.UsuarioId = $UsuarioId_clean) AND (u.UsuarioFechaBajaParticipante IS NULL) AND (u.UsuarioFechaBajaDistribuidora IS NULL) AND (ud.UsuarioDetalleFechaBaja IS NULL)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();     
    }
    public function participantes_altas_model_get_usuario_comercio($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT f.ComercioId as ComercioIdFerreteria,f.ComercioRazonSocial AS ComercioRazonSocialFerreteria, d.ComercioId as ComercioIdDistribuidora,d.ComercioRazonSocial AS ComercioRazonSocialDistribuidora FROM UsuariosComercios as us INNER JOIN Comercios as f ON us.ComercioId = f.ComercioId INNER JOIN Comercios as d ON f.ComercioParentId = d.ComercioId
                WHERE (f.ComercioTipoId = 2) AND (d.ComercioTipoId = 1) AND (us.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();    
    }
    public function participantes_altas_model_get_usuario_distribuidoras($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT Comercios.ComercioRazonSocial FROM UsuariosComercios INNER JOIN Comercios ON UsuariosComercios.ComercioId = Comercios.ComercioId WHERE (Comercios.ComercioTipoId = 1) AND (UsuariosComercios.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    } 
    public function participantes_altas_model_get_perfil($perfiles = ""){
        $where_perfiles = ($perfiles!="")?"where PerfilId in ($perfiles)":"";
        $sql= "SELECT PerfilId,PerfilDescripcion FROM Perfiles $where_perfiles";
        $query	=  $this->db->query($sql);
//        echo  $this->db->last_query()."<br>";         
        return $query->row()->PerfilDescripcion;
    }
    public function participantes_altas_model_get_valida_rfc($rfc=""){
        $rfc_clean = $this->security->xss_clean($rfc); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleRFC = '$rfc_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }

    public function participantes_altas_model_get_division($UsuarioId){
        $sql= "SELECT DISTINCT Distribuidores.DivisionId from Distribuidores 
        inner join UsuariosDistribuidores on Distribuidores.DistribuidorId = UsuariosDistribuidores.DistribuidorId
        where UsuariosDistribuidores.UsuarioId =$UsuarioId";
        $query	=  $this->db->query($sql);
//        echo  $this->db->last_query()."<br>";         
        return $query->row()->DivisionId;
    }
}
