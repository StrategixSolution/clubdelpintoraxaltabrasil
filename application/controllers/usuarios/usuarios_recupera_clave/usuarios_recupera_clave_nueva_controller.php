<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_recupera_clave_nueva_controller extends Base_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('usuarios/usuarios_recuperar_clave/usuarios_recupera_clave_model');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }
    public function index(){
        $sessionId = $this->input->get('ssfvr',true);
        if (empty($sessionId)){
            $this->usuarios_recupera_clave_nueva_controller_pagina(1);
        } else {
            $this->usuarios_recupera_clave_nueva_controller_valida_sesion($sessionId);
        }                
    }
    private function usuarios_recupera_clave_nueva_controller_pagina($id) {
        $URL = "";
        switch ($id) {
            case 1: $URL = "usuarios/usuarios_recuperar_clave/usuarios_recupera_clave_nueva_sin_acceso_view"; break;
            case 2: $URL = "usuarios/usuarios_recuperar_clave/usuarios_recupera_clave_nueva_tiempo_caduco_view"; break;
            case 3: $URL = "usuarios/usuarios_recuperar_clave/usuarios_recupera_clave_nueva_view"; break;
        }
        $this->base_controller_create_view_login($URL);
    }
    private function usuarios_recupera_clave_nueva_controller_valida_sesion($sessionId) {
        $recupera_clave_model_sesion_usuarios_recuperacion_clave = $this->usuarios_recupera_clave_model->usuarios_recupera_clave_model_sesion_usuarios_recuperacion_clave($sessionId);
        if (empty($recupera_clave_model_sesion_usuarios_recuperacion_clave)){
            $this->usuarios_recupera_clave_nueva_controller_pagina(1);
        } else {
            $this->usuarios_recupera_clave_nueva_controller_valida_sesion_tiempo($recupera_clave_model_sesion_usuarios_recuperacion_clave);
        }
    }
    private function usuarios_recupera_clave_nueva_controller_valida_sesion_tiempo($recupera_clave_model_sesion_usuarios_recuperacion_clave) {
        $promedioMeses      = funciones_strategix_promedio_fechas_meses($recupera_clave_model_sesion_usuarios_recuperacion_clave->UsuarioRecuperacionClaveFechaRegistro, funciones_strategix_formato_fecha_hora_actual());
        $promedioDias       = funciones_strategix_promedio_fechas_dias_naturales($recupera_clave_model_sesion_usuarios_recuperacion_clave->UsuarioRecuperacionClaveFechaRegistro, funciones_strategix_formato_fecha_hora_actual());
        $promedioMinutos    = funciones_strategix_promedio_fechas_minutos($recupera_clave_model_sesion_usuarios_recuperacion_clave->UsuarioRecuperacionClaveFechaRegistro, funciones_strategix_formato_fecha_hora_actual());
        if ($promedioMeses>0 or $promedioDias>0 or $promedioMinutos>59){
            $this->usuarios_recupera_clave_nueva_controller_pagina(2);
        }else{
            $this->usuarios_recupera_clave_nueva_controller_pagina(3);
        }  
    }
    public function usuarios_recupera_clave_nueva_controller_actualizacion() {
        $this->usuarios_recupera_clave_nueva_controller_valida_usuario_set_rules();
        $res_errors = $this->usuarios_recupera_clave_nueva_valida_usuario_form_error();
        if ($res_errors==1){  
            $clave_nueva = $this->input->post('clave_nueva',true);
            $clave_nueva_confirma = $this->input->post('clave_nueva_confirma',true);
            $sessionId = $this->input->post('ssfvr',true);            
            if ($clave_nueva===$clave_nueva_confirma){ 
                $recupera_clave_model_sesion_usuarios_recuperacion_clave = $this->usuarios_recupera_clave_model->usuarios_recupera_clave_model_sesion_usuarios_recuperacion_clave($sessionId);
                $UsuarioId = $recupera_clave_model_sesion_usuarios_recuperacion_clave->UsuarioId;
                $Clave = hash('sha256', trim($clave_nueva));
                $res_usuario = $this->usuarios_recupera_clave_model->usuarios_recupera_clave_model_usuario_detalle($UsuarioId);   
                $this->usuarios_recupera_clave_model->usuarios_recupera_clave_model_actualizar_clave($UsuarioId,$Clave,$res_usuario->PerfilId,$sessionId);
                echo json_encode(1);
            }else{
                echo json_encode(0);
            }
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }        
    }
    private function usuarios_recupera_clave_nueva_controller_valida_usuario_set_rules() { 
        $this->form_validation->set_rules('clave_nueva', $this->lang->line('recupera_clave_input_clave_nueva_error'), 'required|xss_clean|trim|min_length[6]|callback_usuarios_recupera_clave_nueva_controller_valida_clave_nueva');
        $this->form_validation->set_rules('clave_nueva_confirma', $this->lang->line('recupera_clave_input_clave_nueva_confirma_error'), 'required|xss_clean|trim|min_length[6]|callback_usuarios_recupera_clave_nueva_controller_valida_clave_nueva_confirma');    
    }
    private function usuarios_recupera_clave_nueva_valida_usuario_form_error() {
        $json_clave_nueva=$json_clave_nueva_confirma= array();
        if (!$this->form_validation->run()) {
            if (!empty(form_error('clave_nueva'))) { $json_clave_nueva =  array('clave_nueva' => form_error('clave_nueva', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('clave_nueva_confirma'))) { $json_clave_nueva_confirma =  array('clave_nueva_confirma' => form_error('clave_nueva_confirma', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_clave_nueva,$json_clave_nueva_confirma);
            return $json;
        } else {             
            return 1; 
        }         
    }
    public function usuarios_recupera_clave_nueva_controller_valida_clave_nueva($clave_nueva){        
        if ($clave_nueva!=""){ 
            if (!preg_match('`[a-z]`',$clave_nueva)){
                $this->form_validation->set_message('usuarios_recupera_clave_nueva_controller_valida_clave_nueva', $this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_valida_clave_nueva_confirma_msg_min')); $response = FALSE;
            } else if (!preg_match('`[A-Z]`',$clave_nueva)){
                $this->form_validation->set_message('usuarios_recupera_clave_nueva_controller_valida_clave_nueva', $this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_valida_clave_nueva_confirma_msg_may')); $response = FALSE;
            } else if (!preg_match('`[0-9]`',$clave_nueva)){
                $this->form_validation->set_message('usuarios_recupera_clave_nueva_controller_valida_clave_nueva', $this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_valida_clave_nueva_confirma_msg_num')); $response = FALSE;                  
            } else {
                $response = TRUE; 
            }            
        } else { 
            $response = TRUE; 
        }
        return $response;
    }
    public function usuarios_recupera_clave_nueva_controller_valida_clave_nueva_confirma($clave_nueva_confirma){
        if ($clave_nueva_confirma!=""){ 
            if (!preg_match('`[a-z]`',$clave_nueva_confirma)){
                $this->form_validation->set_message('usuarios_recupera_clave_nueva_controller_valida_clave_nueva_confirma', $this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_valida_clave_nueva_confirma_msg_min')); $response = FALSE;
            } else if (!preg_match('`[A-Z]`',$clave_nueva_confirma)){
                $this->form_validation->set_message('usuarios_recupera_clave_nueva_controller_valida_clave_nueva_confirma', $this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_valida_clave_nueva_confirma_msg_may')); $response = FALSE;
            } else if (!preg_match('`[0-9]`',$clave_nueva_confirma)){
                $this->form_validation->set_message('usuarios_recupera_clave_nueva_controller_valida_clave_nueva_confirma', $this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_valida_clave_nueva_confirma_msg_num')); $response = FALSE;                  
            } else {
                $response = TRUE; 
            }           
        } else { 
            $response = TRUE; 
        }
        return $response;
    }    
}