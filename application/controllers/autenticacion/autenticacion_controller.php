<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct();  
        $this->load->model('autenticacion/autenticacion_model'); 
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }
    public function index(){
        $json_txt_usuario = $json_txt_clave = $json_captcha = array();
        $this->form_validation->set_rules('txt_usuario', $this->lang->line('login_input_placeholder_usuario'), 'required|valid_email|xss_clean|min_length[4]|max_length[100]'); 
        $this->form_validation->set_rules('txt_clave', $this->lang->line('login_input_placeholder_clave'), 'required|min_length[5]');
        $token      = $this->input->post('token');
        $action      = $this->input->post('action');        
        $resultado_captcha = $this->repatcha3_library->send_recaptcha($token,$action);
        if ($resultado_captcha!=1){ $data['res'] = 2; echo json_encode($data);  return false; }
        if (!$this->form_validation->run()) {
            if (!empty(form_error('txt_usuario'))) { $json_txt_usuario =  array('txt_usuario' => form_error('txt_usuario', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_clave'))) { $json_txt_clave =  array('txt_clave' => form_error('txt_clave', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_txt_usuario,$json_txt_clave,$json_captcha);
            $this->output->set_content_type('application/json')->set_output(json_encode($json));
        } else {
            $txt_usuario = trim($this->input->post('txt_usuario',true));
            $txt_clave = hash('sha256', trim($this->input->post('txt_clave',true)));            
            $usuario = $this->autenticacion_model->autenticacion_model_usuario($txt_usuario,$txt_clave);
            $data = $this->authentication_valida_usuario($usuario);           
            echo json_encode($data); 
        }
    }   
    private function authentication_valida_usuario($usuario){
        $DistribuidorId = 0;
        if (isset($usuario)!=0){ 
            if ($usuario->PerfilId==6 or $usuario->PerfilId==7 or $usuario->PerfilId==8){
                $DistribuidorId = $this->authentication_valida_distribuidor($usuario);
                if ($DistribuidorId==0){
                    $data['res'] = 0;
                    return $data;
                    die;
                }
            }
            $info = $this->base_controller_datos_usuario_web();
            $this->autenticacion_model->autenticacion_model_registro_accesos("'".$usuario->UsuarioId."','".$info['ip_address']."','".$info['sitemaOperativo']."'");
            $this->autenticacion_model->autenticacion_model_registro_cookie("'".$usuario->UsuarioId."','".$info['ip_address']."','".$info['sitemaOperativo']."','".date('Y-m-d\TH:i:s')."','".$this->config->item('cookie_name')."'",$usuario->UsuarioId,$this->config->item('cookie_name'));             
            $nombre = utf8_encode($usuario->UsuarioDetalleNombre).' '.utf8_encode($usuario->UsuarioDetalleApellidos);
            $popup_array = $this->authentication_popups($usuario->PerfilId);
            $control_array = $this->control_modulos();
            $session_data = array(                
                funciones_strategix_sitio_alias('logged_in') => 1,
                funciones_strategix_sitio_alias('s_usuario_id') =>$usuario->UsuarioId,
                funciones_strategix_sitio_alias('s_usuario_nombre')=>$nombre,
                funciones_strategix_sitio_alias('s_perfil_id') =>$usuario->PerfilId ,
                funciones_strategix_sitio_alias('s_perfil_nombre')=>utf8_encode($usuario->PerfilDescripcion),                                
                funciones_strategix_sitio_alias('s_actualiza_datos')=>$usuario->UsuarioFechaActualizoDatos,
                funciones_strategix_sitio_alias('s_aviso_privacidad')=>$usuario->UsuarioFechaAceptoAvisoPrivacidad,
                funciones_strategix_sitio_alias('s_terminos')=>$usuario->UsuarioFechaAceptoTerminos,
                funciones_strategix_sitio_alias('control_modulos') => $control_array,
                funciones_strategix_sitio_alias('s_popups')=>$popup_array,
                funciones_strategix_sitio_alias('s_distribuidor_id') =>$DistribuidorId,
                funciones_strategix_sitio_alias('my_session_id') =>$this->uniqueId);                
            $this->session->set_userdata( $session_data );                 
            $data['res'] = 1;
            return $data; 
        }else{ 
            $data['res'] = 0;
            return $data;         
        } 
    }
    private function authentication_valida_distribuidor($usuario){
        $total_res = $this->autenticacion_model->autenticacion_model_valida_usuario_distribuidor($usuario->UsuarioId);
        if ($total_res==0){
            return 0;
        } else {
            return $this->autenticacion_model->autenticacion_model_usuario_distribuidor($usuario->UsuarioId);
        }
    }
    private function authentication_popups($usuario_PerfilId) {
        $data = array();
        $this->load->model('popups/popups_model');
        $popups =  $this->popups_model->popups_model_datos($usuario_PerfilId);
        foreach ($popups as $row) {
            $popupid = "popup$row->CargaMultimediaId";
            $data[$popupid] = array("CargaMultimediaId"=>$row->CargaMultimediaId,"CargaMultimediaRuta"=>$row->CargaMultimediaRuta,"CargaMultimediaTipoId"=>$row->CargaMultimediaTipoId,"CargaMultimediaTexto"=>$row->CargaMultimediaTexto,"CargaMultimediaDownload"=>$row->CargaMultimediaDownload,"CargaMultimediaExtension"=>$row->CargaMultimediaExtension,"activo"=>1);          
        }
        return $data;
    }
    private function control_modulos() {
        $data = array();
        $this->load->model('control_modulos/control_modulos_model');
        $control =  $this->control_modulos_model->control_modulos_model_datos();
        foreach ($control as $row) {
            $data[$row->ControlModuloId] = array("ControlModuloId"=>$row->ControlModuloId,"ControlModuloNombre"=>$row->ControlModuloNombre,"ControlModuloEstatus"=>$row->ControlModuloEstatus);          
        }
       // print_r($data);die;
        return $data;
    }
}