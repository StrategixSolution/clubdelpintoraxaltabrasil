<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_actualizar_datos_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
        $this->load->model('usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_model'); 
        $this->participante = $this->usuarios_actualizar_datos_model->usuarios_actualizar_datos_model_participante();
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }
    public function index(){//Pagina de Inicio             
        $pag = ($this->session->userdata(funciones_strategix_sitio_alias("s_perfil_id"))<=5)?"usuarios_actualizar_datos_admin_view":"usuarios_actualizar_datos_view";
        $this->base_controller_create_view_sistema('usuarios/usuarios_actualizar_datos/'.$pag);
    }
    public function usuarios_actualizar_datos_controller_datos() {
        $data = array();
        $data['txt_nombre']             = utf8_encode($this->participante->UsuarioDetalleNombre);
        $data['txt_segundo_nombre']     = utf8_encode($this->participante->UsuarioDetalleSegundoNombre);
        $data['txt_apellidos']   = utf8_encode($this->participante->UsuarioDetalleApellidos);
       // $data['txt_apellido_materno']   = utf8_encode($this->participante->UsuarioDetalleApellidoMaterno);
        $data['txt_telefono']           = utf8_encode($this->participante->UsuarioDetalleTelefono);              
        $data['txt_email']              = utf8_encode($this->participante->UsuarioDetalleEmail);
        $data['txt_celular']            = utf8_encode(strtoupper($this->participante->UsuarioDetalleCelular));
        $data['txt_rfc']                = utf8_encode(strtoupper($this->participante->UsuarioDetalleRFC));    
        echo json_encode($data);
    }
    public function usuarios_actualizar_datos_controller_guardar() {
//        $correo = $this->usuarios_actualizar_datos_model->usuarios_actualizar_datos_model_valida_email($this->participante->UsuarioDetalleId,$this->participante->UsuarioDetalleEmail);
//        if (!isset($correo)){ echo 4; return false; }
//        if ($this->input->post('txt_celular',TRUE)!=""){if ($this->usuarios_actualizar_datos_model->usuarios_actualizar_datos_model_valida_celular($this->participante->UsuarioDetalleId,$this->participante->UsuarioDetalleCelular)==0) { echo 5; return false; }}
        $this->usuarios_actualizar_datos_controller_set_rules();
        $res_errors = $this->usuarios_actualizar_datos_controller_form_error();
        if ($res_errors==1){
            echo json_encode($this->usuarios_actualizar_datos_controller_guardar_participante());
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        } 
    }
    private function usuarios_actualizar_datos_controller_set_rules() {
        $this->form_validation->set_rules('txt_nombre', $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_nombre'), 'required|xss_clean|min_length[1]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ,.]*$/u]');
        $this->form_validation->set_rules('txt_segundo_nombre', $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_segundo_nombre'), 'trim|xss_clean|min_length[1]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ,.]*$/u]');
        $this->form_validation->set_rules('txt_apellidos', $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_apellido_paterno'), 'required|xss_clean|trim|min_length[1]|max_length[50]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ,.]*$/u]');        
        $this->form_validation->set_rules('txt_apellido_materno', $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_apellido_materno'), 'required|xss_clean|trim|min_length[1]|max_length[50]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ,.]*$/u]');        
        $this->form_validation->set_rules('txt_email', $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_email'), 'required|valid_email|xss_clean|min_length[10]|max_length[50]|callback_usuarios_actualizar_datos_controller_valida_email_repetido');
        $this->form_validation->set_rules('txt_telefono', $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_telefono'), 'numeric|xss_clean|exact_length[10]');
        $this->form_validation->set_rules('txt_celular', $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_celular'), 'numeric|xss_clean|exact_length[10]|callback_usuarios_actualizar_datos_controller_valida_celular_repetido');
        $this->form_validation->set_rules('txt_clave_nueva', $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_clave'), 'required|xss_clean|trim|min_length[6]|callback_usuarios_actualizar_datos_controller_valida_clave');
        if($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))>=6){
            $this->form_validation->set_rules('txt_rfc', $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_rfc'), 'trim|min_length[10]|regex_match[/^[A-Z,Ñ,&]{3,4}[0-9]{2}[0-1][0-9][0-3][0-9][A-Z,0-9]?[A-Z,0-9]?[0-9,A-Z]?$/]|callback_usuarios_actualizar_datos_controller_valida_rfc');
        } 
    }
    private function usuarios_actualizar_datos_controller_form_error() {        
        $json = $json_pais = $json_perfil = $json_nombre = $json_segundo_nombre = $json_apellido_paterno = $json_email = $json_telefono = $txt_apellido_materno = $json_rfc = $json_email = $json_celular = $json_clave_nueva = array();
        if (!$this->form_validation->run()) {
            if (!empty(form_error('txt_nombre')))           { $json_nombre              =  array('txt_nombre' => form_error('txt_nombre', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_segundo_nombre')))   { $json_segundo_nombre      =  array('txt_segundo_nombre' => form_error('txt_segundo_nombre', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_apellidos'))) { $json_apellido_paterno    =  array('txt_apellidos' => form_error('txt_apellidos', '<small class="mt-3 text-danger">', '</small>')); }                
            if (!empty(form_error('txt_apellido_materno'))) { $txt_apellido_materno     =  array('txt_apellido_materno' => form_error('txt_apellido_materno', '<small class="mt-3 text-danger">', '</small>')); }                
            if (!empty(form_error('txt_email')))            { $json_email               =  array('txt_email' => form_error('txt_email', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_telefono')))         { $json_telefono            =  array('txt_telefono' => form_error('txt_telefono', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_celular')))          { $json_celular             =  array('txt_celular' => form_error('txt_celular', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_clave_nueva')))      { $json_clave_nueva         =  array('txt_clave_nueva' => form_error('txt_clave_nueva', '<small class="mt-3 text-danger">', '</small>')); }
            if($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))>=6){
            if (!empty(form_error('txt_rfc'))) { 
                $json_rfc =  array('txt_rfc' => form_error('txt_rfc', '<small class="mt-3 text-danger">', '</small>')); }
                $json = array_merge($json_nombre,$json_segundo_nombre,$json_apellido_paterno,$txt_apellido_materno,$json_telefono,$json_email,$json_celular,$json_rfc,$json_clave_nueva);
            } else {
                $json = array_merge($json_nombre,$json_segundo_nombre,$json_apellido_paterno,$txt_apellido_materno,$json_telefono,$json_email,$json_celular,$json_clave_nueva);
            }
            return $json;
        } else {
            return 1;
        }
    }
    public function usuarios_actualizar_datos_controller_valida_email_repetido($txtemail) {
        if ($this->usuarios_actualizar_datos_model->usuarios_actualizar_datos_model_valida_email_repetido($txtemail)==1){        
            $this->form_validation->set_message('usuarios_actualizar_datos_controller_valida_email_repetido', sprintf($this->lang->line('usuarios_actualizar_datos_controller_lang_msg_email_repetido'),$txtemail));
            $response = FALSE;
        } else {
            $response = TRUE;
        }
        return $response;
    }     
    public function usuarios_actualizar_datos_controller_valida_celular_repetido($txtcelular) {
        if ($txtcelular!=""){
            if ($this->usuarios_actualizar_datos_model->usuarios_actualizar_datos_model_alida_celular_repetido($txtcelular)==1){        
                $this->form_validation->set_message('usuarios_actualizar_datos_controller_valida_celular_repetido', sprintf($this->lang->line('usuarios_actualizar_datos_controller_lang_msg_celular_repetido'),$txtcelular));
                $response = FALSE;
            } else {
                $response = TRUE;
            }
        } else {
            $response = TRUE;
        }
        return $response;
    }    
    public function usuarios_actualizar_datos_controller_valida_clave($clave_nueva){
        if ($clave_nueva!=""){ 
            if (!preg_match('`[a-z]`',$clave_nueva)){
                $this->form_validation->set_message('usuarios_actualizar_datos_controller_valida_clave', $this->lang->line('usuarios_actualizar_datos_controller_lang_nueva_valida_clave_nueva_confirma_msg_min')); $response = FALSE;
            } else if (!preg_match('`[A-Z]`',$clave_nueva)){
                $this->form_validation->set_message('usuarios_actualizar_datos_controller_valida_clave', $this->lang->line('usuarios_actualizar_datos_controller_lang_nueva_valida_clave_nueva_confirma_msg_may')); $response = FALSE;
            } else if (!preg_match('`[0-9]`',$clave_nueva)){
                $this->form_validation->set_message('usuarios_actualizar_datos_controller_valida_clave', $this->lang->line('usuarios_actualizar_datos_controller_lang_nueva_valida_clave_nueva_confirma_msg_num')); $response = FALSE;                  
            } else {
                $response = TRUE;
            }            
        } else { 
            $response = TRUE;
        }
        return $response;
    }        
    public function usuarios_actualizar_datos_controller_valida_rfc($txtrfc) {
        if ($txtrfc!=''){
            if ($this->usuarios_actualizar_datos_model->usuarios_actualizar_datos_model_get_valida_rfc($txtrfc)==1){        
                $this->form_validation->set_message('usuarios_actualizar_valida_rfc', sprintf($this->lang->line('usuarios_actualizar_datos_msg_rfc_repetido'),$txtrfc));
                $response = FALSE;
            } else {
                $response = TRUE;
            }
        } else {
            $response = TRUE;
        }            
        return $response;
    }
    private function usuarios_actualizar_datos_controller_guardar_participante() {
        $txt_clave      = hash('sha256', trim($this->input->post('txt_clave_nueva',true)));       
        $txt_rfc_trim   = trim($this->input->post('txt_rfc',TRUE)); $txt_rfc_utf8_decode = utf8_encode($txt_rfc_trim); $txt_rfc = strtoupper($txt_rfc_utf8_decode);
        $cp = (empty($this->participante->UsuarioDetalleCP))?"NULL":$this->participante->UsuarioDetalleCP;
        if ($this->session->userdata(funciones_strategix_sitio_alias("s_perfil_id"))<=5){
                            //UsuarioDetalleNombre,                         UsuarioDetalleSegundoNombre,                            UsuarioDetalleApellidos,                      UsuarioDetalleApellidoMaterno,                           UsuarioDetalleClave,                           UsuarioDetalleEmail,                    UsuarioDetalleTelefono,                         UsuarioDetalleCelular,          UsuarioDetalleSessionId
            $datos = "'". utf8_decode($this->input->post('txt_nombre',TRUE))."','".utf8_decode($this->input->post('txt_segundo_nombre',TRUE))."','".utf8_decode($this->input->post('txt_apellidos',TRUE))."','".utf8_decode($this->input->post('txt_apellido_materno',TRUE))."','".$txt_clave."','".$this->input->post('txt_email',TRUE)."','".$this->input->post('txt_telefono',TRUE)."','".$this->input->post('txt_celular',TRUE)."','".$this->uniqueId."'";
        } else {
                            //UsuarioDetalleNombre,                         UsuarioDetalleSegundoNombre,                            UsuarioDetalleApellidos,                      UsuarioDetalleApellidoMaterno,                           UsuarioDetalleClave,                           UsuarioDetalleEmail,                    UsuarioDetalleTelefono,                         UsuarioDetalleCelular,          UsuarioDetalleSessionId,             UsuarioDetalleRFC
            $datos = "'".utf8_decode($this->input->post('txt_nombre',TRUE))."','".utf8_decode($this->input->post('txt_segundo_nombre',TRUE))."','".utf8_decode($this->input->post('txt_apellidos',TRUE))."','".utf8_decode($this->input->post('txt_apellido_materno',TRUE))."','".$txt_clave."','".$this->input->post('txt_email',TRUE)."','".$this->input->post('txt_telefono',TRUE)."','".$this->input->post('txt_celular',TRUE)."','".$this->uniqueId."','".$this->input->post('$txt_rfc',TRUE)."'";
        }        
        $resultado_update = $this->usuarios_actualizar_datos_model->usuarios_actualizar_datos_model_update_usaurio($this->participante->UsuarioDetalleId,$datos,$this->input->post('txt_email',TRUE),$this->uniqueId);
        if ($resultado_update==1){ 
            $nombre_usuario = $this->input->post('txt_nombre',TRUE)." ".$this->input->post('txt_segundo_nombre',TRUE)." ".$this->input->post('txt_apellidos',TRUE)." ".$this->input->post('txt_apellido_materno',TRUE);
            $this->session->set_userdata(funciones_strategix_sitio_alias('s_actualiza_datos'),1); 
            $this->session->set_userdata(funciones_strategix_sitio_alias('s_usuario_nombre'),$nombre_usuario);
            return 1; 
        } else { 
            return 0;            
        }
    }
}