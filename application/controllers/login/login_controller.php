<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 09 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
    }
    public function index(){ 
        if ($this->session->userdata(funciones_strategix_sitio_alias("logged_in"))){ 
            redirect(funciones_strategix_version_url_random('Inicio')); 
        } else {
            $data['frm_action'] = "frm_login_view";
            $this->base_controller_create_view_login('template/login/login_view', $data);
        } 
    }
    public function login_controller_crea_cookie() {       
        $data = $this->base_controller_datos_usuario_web();
        $this->input->set_cookie(array('name'=>$this->config->item('cookie_name'),'value'=>$this->config->item('cookie_value'),'expire'=>'2147483647','secure'=>TRUE));
        $this->input->set_cookie(array('name'=>'ARS','value'=>$data['ip_address'],'expire'=>'2147483647','secure'=>TRUE));
        $this->input->set_cookie(array('name'=>'FECHA','value'=> funciones_strategix_formato_fecha_hora_actual(),'expire'=>'2147483647','secure'=>TRUE));
        echo 1;
    }
}