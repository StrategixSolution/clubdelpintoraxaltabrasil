<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuarios_registro_mp_externo_datosregistro_controller extends Base_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_datosregistro_model');
        $this->load->library('form_validation');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }

    public function index(){
        $data['frm_action'] = "frm_login_view";
        $this->base_controller_create_view_login('usuarios/usuarios_registro_participante_externo/usuarios_registro_participante_externo_datosregistro_view',$data);
    }
    
}

?>