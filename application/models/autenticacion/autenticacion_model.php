<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion_model extends Base_Model {	
    public function __construct(){ 
        parent::__construct();
    }
    public function autenticacion_model_usuario($UsuarioDetalleUsuario,$UsuarioDetalleClave) {
        $UsuarioDetalleUsuario_clean    = $this->security->xss_clean($UsuarioDetalleUsuario);
        $UsuarioDetalleClave_clean      = $this->security->xss_clean($UsuarioDetalleClave);
        $SQL = "SELECT
                    u.UsuarioId, u.UsuarioFechaActualizoDatos, u.UsuarioFechaAceptoTerminos,
                    u.UsuarioFechaAceptoAvisoPrivacidad, u.UsuarioFechaAceptoTerminosTarjetaDigital,
                    u.UsuarioFechaAceptoAvisoPrivacidadTarjetaDigital, u.UsuarioFechaRegistro,
                    u.UsuarioFechaEnvioMailRegistro, u.UsuarioCapturaId,
                    u.UsuarioBajaParticipanteUsuarioId, u.UsuarioBajaDistribuidoraUsuarioId,
                    u.UsuarioTipoRegistroId, u.PerfilId, u.UsuarioSessionId,
                    ud.UsuarioDetalleNombre, ud.UsuarioDetalleSegundoNombre,
                    ud.UsuarioDetalleApellidoPaterno, ud.UsuarioDetalleApellidoMaterno,
                    ud.UsuarioDetalleClave,
                    ud.UsuarioDetalleEmail, ud.UsuarioDetalleTelefono, ud.UsuarioDetalleExtension,
                    p.PerfilDescripcion
                FROM UsuariosDetalles ud
                INNER JOIN Usuarios u  ON ud.UsuarioId  = u.UsuarioId
                INNER JOIN Perfiles  p ON u.PerfilId    = p.PerfilId
                WHERE ud.UsuarioDetalleEmail       = ?
                  AND ud.UsuarioDetalleClave         = ?
                  AND ud.UsuarioDetalleFechaBaja      IS NULL
                  AND u.UsuarioFechaBajaParticipante  IS NULL
                  AND u.UsuarioFechaBajaDistribuidora IS NULL";
        $query	=  $this->db->query($SQL, array($UsuarioDetalleUsuario_clean, $UsuarioDetalleClave_clean));       
        //echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }     
    public function autenticacion_model_registro_accesos($data) {
        $clave_data = trim($this->security->xss_clean($data)); 
        $SQL = "insert into UsuariosRegistroAccesos (UsuarioId,UsuarioRegistroAccesoIP,UsuarioRegistroAccesoSistemaOperativo) values ($clave_data)";                
        $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return 1;
    }
    public function autenticacion_model_registro_cookie($data,$usuarioId,$token) {
        $data_clean = trim($this->security->xss_clean($data)); 
        $usuarioId_clean = trim($this->security->xss_clean($usuarioId)); 
        $token_clean = trim($this->security->xss_clean($token)); 
        $SQL = "SELECT count(UsuarioId) as tot FROM UsuariosRegistroCookie WHERE UsuarioId = $usuarioId_clean and UsuarioRegistroCookieToken = '$token_clean'";
        $query	= $this->db->query($SQL);        
        if ($query->row()->tot==0){
            $SQLINSERT = "insert into UsuariosRegistroCookie (UsuarioId,UsuarioRegistroCookieIP,UsuarioRegistroCookieSistemaOperativo,UsuarioRegistroCookieFechaAcepto,UsuarioRegistroCookieToken) values ($data_clean)";        
            $this->db->query($SQLINSERT);
        }
        return 1;
    }
    public function autenticacion_model_valida_usuario_distribuidor($UsuarioId) {
        $data_UsuarioId = trim($this->security->xss_clean($UsuarioId)); 
        $SQL = trim($this->security->xss_clean("SELECT Count(UsuarioDistribuidorId) as tot FROM UsuariosDistribuidores where UsuarioId = ?"));
        $query	= $this->db->query($SQL, array($data_UsuarioId));
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;
    }
    public function autenticacion_model_usuario_distribuidor($UsuarioId) {
        $data_UsuarioId = trim($this->security->xss_clean($UsuarioId)); 
        $SQL = trim($this->security->xss_clean("SELECT UsuariosDistribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleNombreComercial FROM UsuariosDistribuidores INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (UsuariosDistribuidores.UsuarioId = ?)"));
        $query	= $this->db->query($SQL, array($data_UsuarioId));
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->DistribuidorId;
    }      
}