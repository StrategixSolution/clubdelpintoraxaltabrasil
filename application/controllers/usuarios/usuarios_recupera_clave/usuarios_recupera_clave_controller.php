<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 marzo 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_recupera_clave_controller extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('usuarios/usuarios_recuperar_clave/usuarios_recupera_clave_model');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }
    public function index(){
        $data['frm_action'] = "frm_login_view";
        $this->base_controller_create_view_login('usuarios/usuarios_recuperar_clave/usuarios_recupera_clave_view',$data);
    }
    public function usuarios_recupera_clave_controller_email(){
        $usuarios_crea_clave_view_chk_whatsapp = $this->input->post('usuarios_crea_clave_view_chk_whatsapp',true);
        $usuarios_crea_clave_view_chk_email = $this->input->post('usuarios_crea_clave_view_chk_email',true);
        $usuarios_crea_clave_view_txt_whatsapp = $this->input->post('usuarios_crea_clave_view_txt_whatsapp',true);
        $this->usuarios_recupera_clave_controller_valida_usuario_set_rules();
        $res_errors = $this->usuarios_recupera_clave_controller_valida_usuario_form_error();
        if ($res_errors==1){
            $inputCaptcha = "RECAPTCHAV3";
            $sessCaptcha = "RECAPTCHAV3";           
            $txt_email      = $this->input->post('usuarios_crea_clave_view_txt_email',true);
            $usuarios_crea_clave_view_txt_whatsapp      = $this->input->post('usuarios_crea_clave_view_txt_whatsapp',true);
            $token      = $this->input->post('token');
            $action      = $this->input->post('action');              
            $resultado_captcha = $this->repatcha3_library->send_recaptcha($token,$action);
            if ($resultado_captcha!=1){ $data['res'] = 2; echo json_encode($data);  return false; }            
            $info = $this->base_controller_datos_usuario_web();
            if($usuarios_crea_clave_view_chk_email==1){ 
                $res =$this->usuarios_recupera_clave_model->usuarios_recupera_clave_model_datos_mail($txt_email); 
                $resEmail = $this->usuarios_recupera_clave_controller_envio_correo_recupera_clave($res);
                $data['tipo']=1;
            }
            if($usuarios_crea_clave_view_chk_whatsapp==1){ 
                $res = $this->usuarios_recupera_clave_model->usuarios_recupera_clave_model_data_whatsapp($usuarios_crea_clave_view_txt_whatsapp); 
                $nombre     = utf8_encode(strtoupper($res->UsuarioDetalleNombre . " ". $res->UsuarioDetalleSegundoNombre. " ". $res->UsuarioDetalleApellidos));
                $this->infobip_library->infobip_library_send_whatsapp(8,"+52".$usuarios_crea_clave_view_txt_whatsapp,'recuperacion_contrasena2','"'.$nombre.'"','es',$this->uniqueId);  

                $data['tipo']=2;
            }
            $dato ="'".$res->UsuarioId."','".$info['ip_address']."','".$res->UsuarioDetalleClave."','".$txt_email."','".$sessCaptcha."','".$inputCaptcha."','".$this->uniqueId."'";
            $this->usuarios_recupera_clave_model->usuarios_recupera_clave_model_email_historico($dato,$res->UsuarioId);                     
            $data['res']=1;
            echo json_encode($data);
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }
    }
    private function usuarios_recupera_clave_controller_valida_usuario_set_rules() {
        $usuarios_crea_clave_view_chk_whatsapp = $this->input->post('usuarios_crea_clave_view_chk_whatsapp',true);
        $usuarios_crea_clave_view_chk_email = $this->input->post('usuarios_crea_clave_view_chk_email',true);        
        if ($usuarios_crea_clave_view_chk_email==1){ $this->form_validation->set_rules('usuarios_crea_clave_view_txt_email', $this->lang->line('usuarios_recupera_clave_controller_lang_msg_validacion_correo_electronico'), 'required|xss_clean|trim|valid_email|callback_usuarios_recupera_clave_controller_valida_email'); }
        if ($usuarios_crea_clave_view_chk_whatsapp==1){ $this->form_validation->set_rules('usuarios_crea_clave_view_txt_whatsapp', $this->lang->line('usuarios_recupera_clave_controller_lang_msg_validacion_whatsapp'), 'required|xss_clean|trim|numeric|callback_usuarios_recupera_clave_controller_valida_whatapp'); }
    }
    private function usuarios_recupera_clave_controller_valida_usuario_form_error() {
        $usuarios_crea_clave_view_chk_whatsapp  = $this->input->post('usuarios_crea_clave_view_chk_whatsapp',true);
        $usuarios_crea_clave_view_chk_email     = $this->input->post('usuarios_crea_clave_view_chk_email',true);
        $json_txt_email=$json_txt_captcha= array();
        if (!$this->form_validation->run()) {
            if ($usuarios_crea_clave_view_chk_email==1){  if (!empty(form_error('usuarios_crea_clave_view_txt_email'))) { $json_txt_email =  array('usuarios_crea_clave_view_txt_email' => form_error('usuarios_crea_clave_view_txt_email', '<small class="mt-3 text-danger">', '</small>')); } }
            if ($usuarios_crea_clave_view_chk_whatsapp==1){  if (!empty(form_error('usuarios_crea_clave_view_txt_whatsapp'))) { $json_txt_email =  array('usuarios_crea_clave_view_txt_whatsapp' => form_error('usuarios_crea_clave_view_txt_whatsapp', '<small class="mt-3 text-danger">', '</small>')); } }
            $json = array_merge($json_txt_email,$json_txt_captcha);
            return $json;
        } else {             
            return 1; 
        }         
    }
    public function usuarios_recupera_clave_controller_valida_email($txt_email){
        if ($txt_email!=""){ 
            $res =$this->usuarios_recupera_clave_model->usuarios_recupera_clave_model_valida_mail($txt_email);  
            if ($res==0){
                $this->form_validation->set_message('usuarios_recupera_clave_controller_valida_email', $this->lang->line('usuarios_recupera_clave_controller_lang_correo_invalido')); $response = FALSE; 
            } else {
                $response = TRUE; 
            }            
        } else { 
            $response = TRUE; 
        }
        return $response;
    }
    public function usuarios_recupera_clave_controller_valida_whatapp($txt_whatsapp){
        if ($txt_whatsapp!=""){
            $res = $this->usuarios_recupera_clave_model->usuarios_recupera_clave_model_valida_whatsapp($txt_whatsapp);  
            if ($res==0){
                $this->form_validation->set_message('usuarios_recupera_clave_controller_valida_whatapp', $this->lang->line('usuarios_recupera_clave_controller_lang_whatsapp_invalido')); $response = FALSE; 
            } else {
                $response = TRUE; 
            }            
        } else {
            $response = TRUE; 
        }
        return $response;
    }      
    public function usuarios_recupera_clave_controller_envio_correo_recupera_clave($res) {
        $nombre     = utf8_encode(strtoupper($res->UsuarioDetalleNombre . " ". $res->UsuarioDetalleSegundoNombre. " ". $res->UsuarioDetalleApellidos));        
        $data       = array('nombre'=> "$nombre","perfil"=>$res->PerfilDescripcion,'sessionId'=>$this->uniqueId);
        $mail       = $this->load->view('mails/mails_usuarios/mails_usuarios_recupera_clave/mails_usuarios_recupera_clave_view' ,$data, TRUE);
        $to         = array('to' => "$res->UsuarioDetalleEmail",'cc'=>0,'bcc'=>$this->config->item('bcc'));
        $status_msg = $this->base_controller_envio_correos($to,$this->lang->line('usuarios_recupera_clave_controller_lang_titulo'), $mail, '');
        return $status_msg;  
    }
}