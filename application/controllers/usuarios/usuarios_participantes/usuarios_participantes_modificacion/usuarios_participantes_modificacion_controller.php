<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_participantes_modificacion_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct();
        $this->load->model('usuarios/usuarios_participantes/usuarios_participantes_modificacion/usuarios_participantes_modificacion_model');
        $participanteVariableGet = md5('IDCDP'.funciones_strategix_formato_fecha_actual());
        $this->ParticipanteId = $this->input->get($participanteVariableGet);
        $this->uniqueId = md5(uniqid(rand(), TRUE));
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
    }    
    public function index(){//Pagina de Inicio
        $URLRedirect = funciones_strategix_version_url_random_base_url("Participantes");
        $data['UsusarioId'] = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        $this->participante = $this->usuarios_participantes_modificacion_model->Usuarios_participantes_modificacion_model_participante($this->ParticipanteId);
        $data['ParticipanteId'] = $this->ParticipanteId;
        $data['perfil'] = utf8_encode(strtoupper($this->participante->PerfilDescripcion));
        $comercio = $this->usuarios_participantes_modificacion_model->Usuarios_participantes_modificacion_model_usuario_comercio($this->ParticipanteId);
        $data['distribuidora'] = utf8_encode(strtoupper($comercio->DistribuidorDetalleRazonSocial));
        $data['txtnombre'] = utf8_encode($this->participante->UsuarioDetalleNombre);
        $data['email'] = utf8_encode($this->participante->UsuarioDetalleEmail);
        $data['celular'] = utf8_encode(strtoupper($this->participante->UsuarioDetalleCelular));
        $data['txtrfc'] = utf8_encode(strtoupper($this->participante->UsuarioDetalleRFC));
        $this->base_controller_create_view_sistema('usuarios/usuarios_participantes/usuarios_participantes_modificacion/usuarios_participantes_modificacion_view',$data);
    }
    public function usuarios_participantes_modificacion_controller_guarda() { 
        $IdUsuario  = $this->input->post('IdUsuario',TRUE);
        $this->usuarios_participantes_modificacion_controller_set_rules($IdUsuario);
        $res_errors = $this->usuarios_participantes_modificacion_controller_form_error($IdUsuario);
        if ($res_errors==1){                    
            echo json_encode($this->usuarios_participantes_modificacion_controller_modifica_participante($IdUsuario));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }        
    }   
    public function usuarios_participantes_modificacion_controller_set_rules($IdUsuario) {
          $_POST['txtcelular'] = preg_replace('/\D/', '', $this->input->post('txtcelular', TRUE));
        $_POST['txtrfc']     = preg_replace('/\D/', '', $this->input->post('txtrfc', TRUE));
        $this->form_validation->set_rules('txtnombre', $this->lang->line('usuarios_participantes_edicion_placeholder_nombre'), 'required|xss_clean|min_length[1]|regex_match[/^[A-ZÑÁÉÍÓÚÜ ,.]*$/u]');
        $this->form_validation->set_rules('txtrfc', $this->lang->line('usuarios_participantes_edicion_placeholder_rfc'), 'xss_clean|trim|min_length[4]|max_length[25]|callback_usuarios_participantes_modificacion_controller_valida_rfc');    
        $this->form_validation->set_rules('txt_email', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_email'), 'required|valid_email|xss_clean|min_length[6]|max_length[100]|callback_usuarios_maestro_pintor_registro_controller_valida_email');  
        $this->form_validation->set_rules('txtcelular', $this->lang->line('usuarios_participantes_edicion_placeholder_celular'), 'required|xss_clean|numeric|min_length[6]|max_length[20]|callback_usuarios_participantes_modificacion_controller_valida_celular');
    }
    public function usuarios_participantes_modificacion_controller_form_error($IdUsuario) {
        $json  = $json_perfil = $json_distribuidoras = $json_ferreterias = $json_nombre   = $json_txt_email  = $json_rfc  = $json_celular = array();      
        if (!$this->form_validation->run()) {                     
            if (!empty(form_error('txtnombre'))) { $json_nombre =  array('txtnombre' => form_error('txtnombre', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txtrfc'))) { $json_rfc =  array('txtrfc' => form_error('txtrfc', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_email'))) { $json_txt_email =  array('txt_email' => form_error('txt_email', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txtcelular'))) { $json_celular =  array('txtcelular' => form_error('txtcelular', '<small class="mt-3 text-danger">','</small>')); }
            $json = array_merge($json_nombre,$json_rfc,$json_txt_email,$json_celular);
            return $json;
        } else {
            return 1;
        } 
    }
    public function usuarios_participantes_modificacion_controller_modifica_participante($IdUsuario) {
        $this->participante = $this->usuarios_participantes_modificacion_model->usuarios_participantes_modificacion_model_participante($this->input->post('ParticipanteId',TRUE));
        $txt_rfc_trim           = trim($this->input->post('txtrfc',TRUE)); $txt_rfc_utf8_decode = utf8_decode($txt_rfc_trim); $txt_rfc = strtoupper($txt_rfc_utf8_decode);
            $datos = $this->input->post('ParticipanteId',TRUE).",'".trim($this->input->post('txtnombre',TRUE))."','".trim($this->participante->UsuarioDetalleClave)."','".$this->input->post('txt_email',TRUE)."','".$txt_rfc."','".$this->input->post('txtcelular',TRUE)."',".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",'".$this->uniqueId."'";
        $resultado_update = $this->usuarios_participantes_modificacion_model->usuarios_participantes_modificacion_model_update_usaurio($this->participante->UsuarioDetalleId,$datos);
        if ($resultado_update==1){ 
            return 1; 
        } else { 
            return 0;            
        }        
    }
    public function usuarios_participantes_modificacion_controller_valida_rfc($txtrfc) {
        $response = TRUE; 
            if ($this->usuarios_participantes_modificacion_model->usuarios_participantes_modificacion_model_valida_rfc($txtrfc,$this->input->post('ParticipanteId',TRUE))==1){        
                $this->form_validation->set_message('usuarios_participantes_modificacion_controller_valida_rfc', sprintf($this->lang->line('usuarios_participantes_modificacion_controller_lang_msg_rfc_repetido'),$txtrfc));
                $response = FALSE;
            } else {
                $response = TRUE;
            }        
        return $response;
    }    
    public function usuarios_maestro_pintor_registro_controller_valida_email($txt_email) {
        if($txt_email == ""){
            $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_email', sprintf($this->lang->line('usuarios_participantes_modificacion_controller_lang_msg_mail_vacio'),$txt_email));
            $response = FALSE;
             }else{
        if ($this->usuarios_participantes_modificacion_model->usuarios_participantes_modificacion_model_valida_email($txt_email,$this->input->post('ParticipanteId',TRUE))>=1){        
            $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_email', sprintf($this->lang->line('usuarios_participantes_modificacion_controller_lang_msg_email_repetido'),$txt_email));
            $response = FALSE;
        } else {
            $response = TRUE;
        }       
    }   
    return $response;
 }
    public function usuarios_participantes_modificacion_controller_valida_celular($txt_celular) {
        if($txt_celular == ""){
            $this->form_validation->set_message('usuarios_participantes_modificacion_controller_valida_celular', sprintf($this->lang->line('usuarios_participantes_modificacion_controller_lang_msg_celular_vacio'),$txt_celular));
            $response = FALSE;
             }else{
        if ($this->usuarios_participantes_modificacion_model->usuarios_participantes_modificacion_model_valida_celular($txt_celular,$this->input->post('ParticipanteId',TRUE))>=1){        
            $this->form_validation->set_message('usuarios_participantes_modificacion_controller_valida_celular', sprintf($this->lang->line('usuarios_participantes_modificacion_controller_lang_msg_celular_repetido'),$txt_celular));
            $response = FALSE;
        } else {
            $response = TRUE;
        }
        return $response;
    }  
}
}