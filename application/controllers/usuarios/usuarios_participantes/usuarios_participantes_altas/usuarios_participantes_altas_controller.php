<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_participantes_altas_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct();
        $this->load->model('usuarios/usuarios_participantes/usuarios_participantes_altas/usuarios_participantes_altas_model');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->config->set_item('language', $this->session->userdata(funciones_strategix_sitio_alias('s_language')));
        $this->lang->load(array(get_class()), $this->session->userdata(funciones_strategix_sitio_alias('s_language')));
    }    
    public function index(){//Pagina de Inicio
        if ($this->input->get('IDDIS',true)!=""){
            $data['DistribuidorId']=$this->input->get('IDDIS',true);
            $this->base_controller_create_view_sistema('usuarios/usuarios_participantes/usuarios_participantes_altas/usuarios_participantes_altas_distribuidor_view',$data);
        } else {
            $this->base_controller_create_view_sistema('usuarios/usuarios_participantes/usuarios_participantes_altas/usuarios_participantes_altas_view');
        }
    }
    public function usuarios_participantes_altas_controller_combo_lista_pais() {
        if ($this->input->post('DistribuidorId',true)!=""){
            $PaisId = $this->usuarios_participantes_altas_model->usuarios_participante_alta_model_distribuidor_pais($this->input->post('DistribuidorId',true))->PaisId;
            $where = " AND Paises.PaisId = ".$PaisId; $combo_pais = "";
            $paises = $this->usuarios_participantes_altas_model->usuarios_participante_alta_model_combo_lista_pais($where);
        }else{
            $where = "";
            switch ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))) {
                case 1:
                case 2:
                case 3:
                   $combo_pais = "<option value='0'>".$this->lang->line('distribuidores_controller_lang_combo_pais_todos')."</option>";
                   $paises         = $this->usuarios_participantes_altas_model->usuarios_participante_alta_model_combo_lista_pais($where);
                    break;//ADMINISTRADORES
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    
                       $combo_pais = "<option value='0'>".$this->lang->line('distribuidores_controller_lang_combo_pais_todos')."</option>";
                    $where .= " AND Usuarios.UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." ";
                    $paises = $this->usuarios_participantes_altas_model->usuarios_participante_alta_model_combo_lista_pais($where);
                    break;//ADMINISTRADORES AXALTA PAIS, AXALTA REGION Y GERENTE REGIONAL
                    case 8:
                    case 9:
                    case 10:
                        $combo_pais = "";
                        $where .= " AND Usuarios.UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." ";
                        $paises = $this->usuarios_participantes_altas_model->usuarios_participante_alta_model_combo_lista_pais($where);
                        break;
                    }
        }        
        
        foreach ($paises as $pais) { $combo_pais   .='<option value="'.$pais->PaisId.'">'.utf8_encode(strtoupper($pais->PaisNombre)).'</option>'; } 
        echo json_encode($combo_pais);
    }
    public function usuarios_participantes_altas_controller_combo_distribuidoras() {        
        $where = $cmbdistribuidora= ""; $cmb_pais = $this->input->post('cmb_pais',true);
        if ($this->input->post('DistribuidorId',true)!=""){
            $cmbdistribuidora ="";
            $where .= "AND Distribuidores.DistribuidorId = ".$this->input->post('DistribuidorId',true);
        } elseif($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==8) {
            $where .= "AND Distribuidores.DistribuidorId = ".$this->usuarios_participantes_altas_model->usuarios_participantes_alta_model_usuario_comercio($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')))->DistribuidorId;
        } else {
            if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 7){
                $distribuidorid = $this->usuarios_participantes_altas_model->usuarios_participantes_alta_model_usuario_comercio($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));
                $where .= "AND Distribuidores.DistribuidorId = $distribuidorid->DistribuidorId AND Distribuidores.PaisId = ".$cmb_pais;
            }else{
                $where .= " AND Distribuidores.PaisId = ".$cmb_pais;
                $cmbdistribuidora ="<option  value='0'>".$this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_distribuidora')."</option>";
            }
        }
        $distribuidoras         = $this->usuarios_participantes_altas_model->usuarios_participante_alta_model_combo_lista_distribuidoras($where);
        foreach ($distribuidoras as $distribuidora) {            
                $cmbdistribuidora .="<option value=$distribuidora->DistribuidorId>".$distribuidora->DistribuidorDetalleCodigo." ".utf8_encode(strtoupper($distribuidora->DistribuidorDetalleRazonSocial))."</option>";
            }        
        echo json_encode($cmbdistribuidora);
    }
    public function usuarios_participantes_altas_controllers_combo_perfil() {        
        $perfilesid = "";
        if ($this->input->post('DistribuidorId',true)!=""){
            $cmbperfil ="";
            $perfilesid="8";
        } else {
            $cmbperfil ="<option  value='0'>".$this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_perfil')."</option>";
            if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 8){
                $perfilesid = "9,10";
            }else{
                $perfilesid="8,9,10";
            }
        }
        $perfiles         = $this->usuarios_participantes_altas_model->usuarios_participante_alta_model_combo_lista_perfiles($perfilesid);
        foreach ($perfiles as $perfil) {            
             $cmbperfil .="<option value=$perfil->PerfilId>$perfil->PerfilDescripcion</option>";
        }
        echo json_encode($cmbperfil);
    }   
    public function usuarios_participantes_altas_controller_guarda() {
        $this->usuarios_participantes_altas_controller_set_rules();
        $res_errors = $this->usuarios_participantes_altas_controller_form_error();
        if ($res_errors==1){                    
            echo json_encode($this->usuarios_participantes_altas_controller_guardar_participante());
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }        
    }    
    public function usuarios_participantes_altas_controller_set_rules() {
        $this->form_validation->set_rules('cmb_pais', $this->lang->line('usuarios_participantes_altas_controller_combo_selecciona_pais'), 'required|callback_usuarios_participantes_altas_controller_check_default_pais');
        $this->form_validation->set_rules('cmb_perfil', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_perfil'), 'required|callback_usuarios_participantes_altas_controller_check_default_perfil');
        $this->form_validation->set_rules('cmb_distribuidoras', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_distribuidora'), 'required|callback_usuarios_participantes_altas_controller_check_default_distribuidora');              
        $this->form_validation->set_rules('txtnombre', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_nombre'), 'required|xss_clean|min_length[1]|regex_match[/^[A-ZÑÁÉÍÓÚÜ ,.]*$/u]');
        $this->form_validation->set_rules('txtsegundonombre', $this->lang->line('participantes_altas_placeholder_segundo_nombre'), 'trim|xss_clean|min_length[1]|regex_match[/^[A-ZÑÁÉÍÓÚÜ ,.]*$/u]');
        $this->form_validation->set_rules('txtapellidopaterno', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_apellido_paterno'), 'required|xss_clean|trim|min_length[1]');
        $this->form_validation->set_rules('txtemail', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_email'), 'trim|required|xss_clean|valid_email|callback_usuarios_participantes_altas_controller_valida_email');
        $this->form_validation->set_rules('texttelefono', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_telefono'), 'numeric|xss_clean|min_length[8]|max_length[20]');
        $this->form_validation->set_rules('txtextencion', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_extencion'), 'numeric|xss_clean|min_length[3]|max_length[10]');
        $this->form_validation->set_rules('txtcelular', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_celular'), 'required|numeric|min_length[8]|max_length[15]|callback_usuarios_participantes_altas_controller_valida_celular');
        $this->form_validation->set_rules('txtrfc', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_rfc'), 'trim|min_length[4]|max_length[25]');   
    }
    public function usuarios_participantes_altas_controller_form_error() {
        $json_pais = $json = $json_perfil = $json_distribuidoras = $json_nombre = $json_segundo_nombre = $json_apellido_paterno = $json_email = $json_telefono = $json_extencion = $json_rfc =$json_celular = array();
        if (!$this->form_validation->run()) {
            if (!empty(form_error('cmb_pais'))) { $json_pais =  array('cmb_pais' => form_error('cmb_perfil', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_perfil'))) { $json_perfil =  array('cmb_perfil' => form_error('cmb_perfil', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_distribuidoras'))) { $json_distribuidoras =  array('cmb_distribuidoras' => form_error('cmb_distribuidoras', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txtnombre'))) { $json_nombre =  array('txtnombre' => form_error('txtnombre', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txtsegundonombre'))) { $json_segundo_nombre =  array('txtsegundonombre' => form_error('txtsegundonombre', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txtapellidopaterno'))) { $json_apellido_paterno =  array('txtapellidopaterno' => form_error('txtapellidopaterno', '<small class="mt-3 text-danger">', '</small>')); }                        
            if (!empty(form_error('txtemail'))) { $json_email =  array('txtemail' => form_error('txtemail', '<small class="mt-3 text-danger">', '</p>')); }        
            if (!empty(form_error('texttelefono'))) { $json_telefono =  array('texttelefono' => form_error('texttelefono', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txtextencion'))) { $json_extencion =  array('txtextencion' => form_error('txtextencion', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txtcelular'))) { $json_celular =  array('txtcelular' => form_error('txtcelular', '<small class="mt-3 text-danger">', '</small>')); } 
            if (!empty(form_error('txtrfc'))) { $json_rfc =  array('txtrfc' => form_error('txtrfc', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_pais,$json_nombre,$json_segundo_nombre,$json_apellido_paterno,$json_email,$json_telefono,$json_extencion,$json_celular,$json_perfil,$json_distribuidoras,$json_rfc);
            return $json;
        } else {             
            return 1; 
        }             
    }
    private function usuarios_participantes_altas_controller_valida_perfil($perfil,$distribuidoras) {
        switch ($perfil) {
             case 7:
                $resultado = $this->usuarios_participantes_altas_model->participantes_altas_model_get_valida_participantes_perfil($perfil,$distribuidoras);
                if($resultado>=1){ return 1;} else { return 0; }
                break;
            case 8:
                $resultado = $this->usuarios_participantes_altas_model->participantes_altas_model_get_valida_participantes_perfil($perfil,$distribuidoras);
                if($resultado>=4){ return 1;} else { return 0; }
                break;
            case 9:
                $resultado = $this->usuarios_participantes_altas_model->participantes_altas_model_get_valida_participantes_perfil($perfil,$distribuidoras);
                if($resultado>=1){ return 1;} else { return 0; }
                break;
            default:
                $resultado = $this->usuarios_participantes_altas_model->participantes_altas_model_get_valida_participantes_perfil($perfil,$distribuidoras); //por si se limita los otros perfiles
                return 0;
                break;
        }
        return 0;
    }
    public function usuarios_participantes_altas_controller_valida_email($txtemail) {
        if($txtemail == ""){
            $this->form_validation->set_message('usuarios_participantes_altas_controller_valida_email', sprintf('EL CAMPO CORREO ELECTRÓNICO ES OBLIGATORIO.',$txtemail));
            $response = FALSE;
             }else{
        if ($this->usuarios_participantes_altas_model->participantes_altas_model_get_valida_email($txtemail)>=1){        
            $this->form_validation->set_message('usuarios_participantes_altas_controller_valida_email', sprintf($this->lang->line('usuarios_participantes_altas_controller_lang_msg_email_repetido'),$txtemail));
            $response = FALSE;
        } else {
            $response = TRUE;
        }
    }
        return $response;
    }    
    public function usuarios_participantes_altas_controller_valida_celular($txtcelular) {
        if($txtcelular == ""){
            $this->form_validation->set_message('usuarios_participantes_altas_controller_valida_celular', sprintf('EL CAMPO CELULAR ES OBLIGATORIO.',$txtcelular));
            $response = FALSE;
             }else{
        if ($this->usuarios_participantes_altas_model->participantes_altas_model_get_valida_celular($txtcelular)>=1){        
            $this->form_validation->set_message('usuarios_participantes_altas_controller_valida_celular', sprintf($this->lang->line('usuarios_participantes_altas_controller_lang_msg_celular_repetido'),$txtcelular));
            $response = FALSE;
        } else {
            $response = TRUE;
        }
    }
        return $response;
    }
    public function usuarios_participantes_altas_controller_valida_rfc($txtrfc) {
        $response = TRUE; 
        if($txtrfc == ""){
//            $this->form_validation->set_message('participantes_altas_valida_rfc', sprintf($this->lang->line('participantes_altas_error_rfc'),$txtrfc));
//            $response = FALSE;
        }else{
            if ($this->usuarios_participantes_altas_model->participantes_altas_model_get_valida_rfc($txtrfc)>=1){        
                $this->form_validation->set_message('usuarios_participantes_altas_controller_valida_rfc', sprintf($this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_rfc'),$txtrfc));
                $response = FALSE;
            } else {
                $response = TRUE;
            }
        }
        return $response;
    } 
    public function usuarios_participantes_altas_controller_check_default_pais($post_string){
        if ($post_string==0){ $this->form_validation->set_message('usuarios_participantes_altas_controller_check_default_pais', $this->lang->line('usuarios_participantes_altas_controller_combo_selecciona_pais')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function usuarios_participantes_altas_controller_check_default_perfil($post_string){
        if ($post_string==0){ $this->form_validation->set_message('usuarios_participantes_altas_controller_check_default_perfil', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_perfil')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function usuarios_participantes_altas_controller_check_default_distribuidora($post_string){
        if ($post_string==0){ $this->form_validation->set_message('usuarios_participantes_altas_controller_check_default_distribuidora', $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_distribuidora')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function usuarios_participantes_altas_controller_guardar_participante() {
        $dataHead       = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",".$this->input->post('cmb_perfil',TRUE).",".$this->input->post('cmb_pais',TRUE).",'".$this->uniqueId."'";
        $txt_rfc_trim           = trim($this->input->post('txtrfc',TRUE)); $txt_rfc_utf8_decode = utf8_decode($txt_rfc_trim); $txt_rfc = strtoupper($txt_rfc_utf8_decode);
        $dataDetalle    = "'".trim($this->input->post('txtnombre',TRUE))."','".trim($this->input->post('txtsegundonombre',TRUE))."','".trim($this->input->post('txtapellidopaterno',TRUE))."','".trim($this->input->post('txtapellidomaterno',TRUE))."','".trim($this->input->post('txtemail',TRUE))."','".trim($this->input->post('texttelefono',TRUE))."','".trim($this->input->post('txtextencion',TRUE))."','".$txt_rfc."','".trim($this->input->post('txtcelular',TRUE))."',".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",'".$this->uniqueId."'";
        $UsuarioId = $this->usuarios_participantes_altas_model->participantes_altas_model_insert_participante($dataHead, utf8_decode($dataDetalle),$this->input->post('cmb_perfil',TRUE),$this->input->post('cmb_distribuidoras',TRUE));
        if($UsuarioId!=0){
            $division = $this->usuarios_participantes_altas_model->participantes_altas_model_get_division($UsuarioId);
            $user           = creatUserName(trim($this->input->post('txtnombre',TRUE)),trim($this->input->post('txtapellidopaterno',TRUE)),$UsuarioId);
            $this->usuarios_participantes_altas_model->participantes_altas_model_update_usaurio_clave($UsuarioId,$user);
            $resultado_envio_correo = $this->usuarios_participantes_altas_controller_envio_correo_bienvenida($this->input->post('txtnombre',TRUE),$this->input->post('txtsegundonombre',TRUE),$this->input->post('txtapellidopaterno',TRUE),$this->input->post('txtapellidomaterno',TRUE),$this->input->post('txtemail',TRUE),$user,$division);
            if($resultado_envio_correo==1){$this->usuarios_participantes_altas_model->participantes_altas_model_update_email($UsuarioId); return 1; } else { return 4; }
        }
    }
    public function usuarios_participantes_altas_controller_envio_correo_bienvenida($nombre,$segundonombre,$apellidopaterno,$apellidomaterno,$email,$usuario,$division) {
        $nombrecompleto = $nombre.' '.$segundonombre.' '.$apellidopaterno.' '.$apellidomaterno;
        $datos      = array('nombre'=>$nombrecompleto,'usuario'=>$usuario,'sessionId'=>$this->uniqueId);
        if($division==1){
            $mail       = $this->load->view('mails/mails_usuarios/mails_usuarios_participantes/mails_usuarios_participantes_alta_bienvenida_arquitectonico_view' ,$datos, TRUE);
        }else{
            $mail       = $this->load->view('mails/mails_usuarios/mails_usuarios_participantes/mails_usuarios_participantes_alta_bienvenida_refinish_view' ,$datos, TRUE);
        }       
        $to         = array('to' => $email,'cc'=>'','bcc'=>'');
        $status_msg = $this->base_controller_envio_correos($to,'Bienvenido a Axalta Club del Pintor LATAM', $mail, '');
        return $status_msg;
    }
}
