<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_maestro_pintor_registro_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
    public function usuarios_maestro_pintor_registro_model_puestos() {
        $SQL = "SELECT UsuarioDetallePuestoId,UsuarioDetallePuestoDescripcion  FROM UsuariosDetallesPuestos";
        $query	= $this->db->query($SQL);
//         echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
   /* public function usuarios_maestro_pintor_registro_model_compania() {
        $SQL = "SELECT UsuarioDetalleCompaniaCelularId,UsuarioDetalleCompaniaCelularDescripcion FROM UsuariosDetallesCompaniasCelulares WHERE PaisId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_pais_id'));
        $query	= $this->db->query($SQL);
//         echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }*/
    public function usuarios_maestro_pintor_registro_model_tallas() {
        $SQL = "SELECT UsuarioDetalleTallaId, UsuarioDetalleTallaDescripcion, UsuarioDetalleTallaClave FROM UsuariosDetallesTallas";
        $query	= $this->db->query($SQL);
//         echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function usuarios_maestro_pintor_registro_model_valida_email($email=""){
        $email_clean = $this->security->xss_clean($email); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleEmail = '$email_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
    public function usuarios_maestro_pintor_registro_model_valida_celular($celular=""){
        $celular_clean = $this->security->xss_clean($celular); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleCelular = '$celular_clean')";
        $query	= $this->db->query($SQL);
        //secho  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
    public function usuarios_maestro_pintor_registro_model_valida_rfc($rfc=""){
        $rfc_clean = $this->security->xss_clean($rfc); 
        $SQL = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (UsuariosDetalles.UsuarioDetalleRFC = '$rfc_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;           
    }
    public function usuarios_maestro_pintor_registro_model_valida_tarjeta($tarjeta,$iddist){
        $tarjeta_clean = $this->security->xss_clean($tarjeta); 
        $SQL = "SELECT Tarjetas.TarjetaEstatusId FROM Tarjetas WHERE (TarjetaFechaBaja IS NULL) AND (TarjetaNumero = $tarjeta_clean) AND (DistribuidorId=$iddist)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();           
    }
    public function usuarios_maestro_pintor_registro_model_distribuidora_id($usuario){
        $usuario_clean = $this->security->xss_clean($usuario); 
        $SQL = "SELECT DistribuidorId FROM UsuariosDistribuidores WHERE (UsuarioId = '$usuario_clean')";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->DistribuidorId;           
    }
    public function usuarios_maestro_pintor_registro_model_insert_participante($dataHead,$dataDetalle,$distribuidora){
        $distribuidora_clean = $this->security->xss_clean($distribuidora); 
        $SQL1    = "INSERT INTO Usuarios (UsuarioCapturaId,PerfilId,UsuarioSessionId,UsuarioTipoRegistroId,UsuarioFechaAceptoTerminosTarjetaDigital,UsuarioFechaAceptoAvisoPrivacidadTarjetaDigital) VALUES ($dataHead,1,GETDATE(),GETDATE())"; 
        $this->db->query($SQL1);        
        //echo  $this->db->last_query()."<br>";
        $query  = $this->db->query("SELECT IDENT_CURRENT('Usuarios') as last_id"); 
        $res    = $query->result(); 
        $id     = $res[0]->last_id;
        //echo  $this->db->last_query()."<br>";        
        $SQL2    = "INSERT INTO UsuariosDetalles (UsuarioId,UsuarioDetalleNombre,UsuarioDetalleSegundoNombre,UsuarioDetalleApellidoPaterno,UsuarioDetalleApellidoMaterno,UsuarioDetalleEmail,UsuarioDetalleTelefono,UsuarioDetalleExtension,UsuarioDetalleCelular,UsuarioDetalleRFC,UsuarioDetalleCiudad,UsuarioDetalleTallaId,UsuarioDetalleFechaNacimiento,UsuarioDetallePuestoId,UsuarioDetalleNombreTaller,UsuarioDetallePersonasTaller,UsuarioDetalleAutosPorsemana,UsuarioDetalleUsuarioIdRegistro,UsuarioDetalleSessionId,UsuarioDetalleObservaciones,UsuarioDetalleUsuario,UsuarioDetalleClave) VALUES ($id,$dataDetalle)";
        $this->db->query($SQL2);
        $DistribuidoraId = $distribuidora_clean;
        $SQL3    = "INSERT INTO UsuariosDistribuidores (UsuarioId,DistribuidorId) VALUES ($id,$DistribuidoraId)"; $this->db->query($SQL3); //echo  $this->db->last_query()."<br>";
        return $id;
    }
    public function usuarios_maestro_pintor_registro_model_update_usaurio_clave($UsuarioId,$UsuarioDetalleUsuario,$identificacion) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $UsuarioDetalleUsuario_clean = $this->security->xss_clean($UsuarioDetalleUsuario); 
        $SQL    = "UPDATE UsuariosDetalles SET UsuarioDetalleUsuario = '$UsuarioDetalleUsuario_clean',UsuarioDetalleArchivoIdentificacion = '$identificacion' WHERE UsuarioId = $UsuarioId_clean";
        $this->db->query($SQL);
        return 1;
    }public function usuarios_maestro_pintor_registro_model_update_firma($firma,$UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL    = "UPDATE UsuariosDetalles SET UsuarioDetalleArchivoFirma ='$firma' WHERE UsuarioId = $UsuarioId_clean";
        $this->db->query($SQL);
        return 1;
    }
    public function usuarios_maestro_pintor_registro_model_update_email($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL    = "UPDATE Usuarios SET UsuarioFechaEnvioMailRegistro = GETDATE() WHERE UsuarioId = $UsuarioId_clean";
        $this->db->query($SQL);
        return 1;
    }
    public function  usuarios_maestro_pintor_registro_model_update_tarjeta($UsuarioId,$IDdistribudor,$idtarjeta) {
        $IDdistribudor_clean = utf8_decode($this->security->xss_clean($IDdistribudor));
        $idtarjeta_clean             = $this->security->xss_clean($idtarjeta);
        $SQLUPDATE              = "UPDATE Tarjetas SET Tarjetas.TarjetaEstatusId = 2,Tarjetas.UsuarioId = $UsuarioId,Tarjetas.TarjetaFechaAsigno = GETDATE(),Tarjetas.TarjetaUsuarioIdAsigno = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." WHERE Tarjetas.TarjetaNumero = $idtarjeta_clean AND Tarjetas.DistribuidorId = $IDdistribudor_clean ";
//        echo $SQLUPDATE;
        $this->db->query($SQLUPDATE);
        return 1;
    }
    
    public function usuarios_maestro_pintor_registro_model_last_id() {
        $SQL    = "SELECT IDENT_CURRENT('Usuarios')+1 as last_id";
        $query  = $this->db->query($SQL);
        $res    = $query->result();
        $id     = $res[0]->last_id;
        return $id;
    }



    /*public function usuarios_maestro_pintor_registro_model_get_division($UsuarioId){
      //  print_r($UsuarioId);die;
        $sql= "SELECT DISTINCT Distribuidores.DivisionId from Distribuidores 
        inner join UsuariosDistribuidores on Distribuidores.DistribuidorId = UsuariosDistribuidores.DistribuidorId
        where UsuariosDistribuidores.UsuarioId =$UsuarioId";
        $query	=  $this->db->query($sql);
     //  echo  $this->db->last_query()."<br>";         
        return $query->row()->DivisionId;
    }*/
}
