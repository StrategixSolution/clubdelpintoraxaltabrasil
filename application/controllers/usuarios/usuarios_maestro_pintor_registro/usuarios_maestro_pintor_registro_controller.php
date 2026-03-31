<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_maestro_pintor_registro_controller extends Base_Controller {
public function __construct(){ 
        parent::__construct();        
        $this->uniqueId = md5(uniqid(rand(), TRUE));
        $this->load->model('usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_model');
    }    
    public function index(){//Pagina de Inicio  
        $this->base_controller_create_view_sistema('usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_view');
    }
    public function usuarios_maestro_pintor_registro_controller_combo_puesto() {
        $cmbpuesto ="<option  value='0'>".$this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_puesto')."</option>";
        $puestos        = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_puestos();
        $valmp=''; $div =0;
       // $pais = $this->session->userdata(funciones_strategix_sitio_alias('s_pais_id'));
      //   $array_Division = $this->session->userdata(funciones_strategix_sitio_alias('control_division'));
       // if (is_array($array_Division)) {
       //  foreach ($array_Division as $division) { $div = $division; }   }
        foreach ($puestos as $puesto) {     
                $cmbpuesto .="<option value=$puesto->UsuarioDetallePuestoId>$puesto->UsuarioDetallePuestoDescripcion</option>";
        }
        echo json_encode($cmbpuesto);
    }    
   /*  public function usuarios_maestro_pintor_registro_controller_combo_compania() {
        $cmbcompania ="<option  value='0'>".$this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_compañia')."</option>";
        $companias         = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_compania();
        foreach ($companias as $compania) {            
             $cmbcompania .="<option value=$compania->UsuarioDetalleCompaniaCelularId>$compania->UsuarioDetalleCompaniaCelularDescripcion</option>";
        }
        echo json_encode($cmbcompania);
    }    */
     public function usuarios_maestro_pintor_registro_controller_combo_talla() {
        $cmbtalla ="<option  value='0'>".$this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_talla')."</option>";
        $tallas         = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_tallas();
        foreach ($tallas as $talla) {            
             $cmbtalla .="<option value=$talla->UsuarioDetalleTallaId>".$talla->UsuarioDetalleTallaClave." - ".$talla->UsuarioDetalleTallaDescripcion."</option>";
        }
        echo json_encode($cmbtalla);
    }    
     public function usuarios_maestro_pintor_registro_controller_modal_terminos_y_condiciones(){
        $data['archivo']       = 'application/views/template/sistema/legal/terminos_y_condiciones.pdf';
        $pag = $this->load->view('modals/modals_usuarios/modals_usuarios_registro_maestro_pintor/modals_usuarios_registro_maestro_pintor_termino_view', $data, true);
        echo json_encode($pag);   
    }    
     public function usuarios_maestro_pintor_registro_controller_modal_aviso_privacidad(){
        $data['archivo']       = 'application/views/template/sistema/legal/aviso_privacidad.pdf';
        $pag = $this->load->view('modals/modals_usuarios/modals_usuarios_registro_maestro_pintor/modals_usuarios_registro_maestro_pintor_aviso_view', $data, true);
        echo json_encode($pag);   
    }    
    public function usuarios_maestro_pintor_registro_controller_modal_qr(){
        $data['archivo']       = "";
        $pag = $this->load->view('modals/modals_usuarios/modals_usuarios_registro_maestro_pintor/modals_usuarios_registro_maestro_pintor_qr_view', $data, true);
        echo json_encode($pag);   
    }   
     public function usuarios_maestro_pintor_registro_controller_modal_identificacion(){
        $modal               = $this->input->post('modal');
        $data['archivo']       = "";
        $url ="";
        switch ($modal){
            case 1: $url = 'modals/modals_usuarios/modals_usuarios_registro_maestro_pintor/modals_usuarios_registro_maestro_pintor_identificacionIOS_view'; break;
            case 2: $url = 'modals/modals_usuarios/modals_usuarios_registro_maestro_pintor/modals_usuarios_registro_maestro_pintor_identificacion_view'; break;
        }
        $pag = $this->load->view($url,$data,TRUE);
        echo json_encode($pag);   
    }    
    public function usuarios_maestro_pintor_registro_controller_ajax_add_qr(){
        $code_qr = $this->input->post('code_qr');
        echo json_encode($code_qr);
    }
    public function usuarios_maestro_pintor_registro_controller_ajaxFotoId(){
        $imagenCodificada = file_get_contents("php://input");
        if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
        $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        $imagenDecodificada 	= base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada 	= $this->uniqueId.".png";
        $iddistribuidora = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_distribuidora_id($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));
        $this->base_controller_valida_crea_carpetas('temporal');
        $this->base_controller_valida_crea_carpetas('temporal/maestros_pintores');
        $direccion_documentos = $this->base_controller_valida_crea_carpetas('temporal/maestros_pintores/fotos');
        file_put_contents('uploads/temporal/maestros_pintores/fotos/'.$nombreImagenGuardada, $imagenDecodificada);
        $this->session->unset_userdata('s_identificacion');
        $this->session->set_userdata('s_identificacion',$nombreImagenGuardada);
        echo $nombreImagenGuardada;		
    }
    public function usuarios_maestro_pintor_registro_controller_ajax_firma(){
        $imagenCodificada = file_get_contents("php://input");
        if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
        $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        $imagenDecodificada 	= base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada 	= funciones_strategix_fecha_hora_actual()."_".$this->session->userdata('s_maestropintorid')."_firma.png";
        $this->base_controller_valida_crea_carpetas('maestros_pintores');
        $this->base_controller_valida_crea_carpetas('maestros_pintores/'.$this->session->userdata('s_maestropintorid'));
        file_put_contents("uploads/maestros_pintores/".$this->session->userdata('s_maestropintorid')."/".$nombreImagenGuardada, $imagenDecodificada);   
        $firma           = "uploads/maestros_pintores/".$this->session->userdata('s_maestropintorid')."/".$nombreImagenGuardada;
        $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_update_firma($firma,$this->session->userdata('s_maestropintorid'));
        $this->session->unset_userdata('s_maestropintorid');
        echo 0;      
    }
    public function usuarios_maestro_pintor_registro_controller_guarda(){
        $this->usuarios_maestro_pintor_registro_controller_set_rules();
        $res_errors = $this->usuarios_maestro_pintor_registro_controller_form_error();
        if ($res_errors==1){                    
            echo json_encode($this->usuarios_maestro_pintor_registro_controller_guardar());
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }
    }
    public function usuarios_maestro_pintor_registro_controller_set_rules(){
        $this->form_validation->set_rules('txt_nombre', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_nombre'), 'required|xss_clean|min_length[1]|max_length[100]|regex_match[/^[0-9A-ZÑÁÉÍÓÚÜ ,.]*$/u]');
        $this->form_validation->set_rules('txt_segundo_nombre', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_segundo_nombre'), 'xss_clean|min_length[1]|max_length[100]|regex_match[/^[0-9A-ZÑÁÉÍÓÚÜ ,.]*$/u]');
        $this->form_validation->set_rules('txt_apellidos', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_apaterno'), 'required|xss_clean|min_length[1]|max_length[50]|regex_match[/^[0-9A-ZÑÁÉÍÓÚÜ ,.]*$/u]');
        $this->form_validation->set_rules('txt_rfc', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_rfc'), 'xss_clean|min_length[4]|max_length[25]|callback_usuarios_maestro_pintor_registro_controller_valida_rfc');
        $this->form_validation->set_rules('txt_email', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_email'), 'required|valid_email|xss_clean|min_length[6]|max_length[100]|callback_usuarios_maestro_pintor_registro_controller_valida_email');  
        $this->form_validation->set_rules('txt_telefono', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_telefono'), 'required|numeric|xss_clean|min_length[6]|max_length[10]');
        $this->form_validation->set_rules('txt_extencion', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_extencion'), 'required|numeric|xss_clean|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('txt_celular', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_celular'), 'required|numeric|xss_clean|min_length[6]|max_length[10]|callback_usuarios_maestro_pintor_registro_controller_valida_celular');
//        $this->form_validation->set_rules('cmb_compania', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_compañia'), 'required|callback_usuarios_maestro_pintor_registro_controller_valida_default_compania');
        $this->form_validation->set_rules('cmb_puesto', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_puesto'), 'required|callback_usuarios_maestro_pintor_registro_controller_valida_default_puesto');            
        $this->form_validation->set_rules('cmb_talla', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_talla'), 'required|callback_usuarios_maestro_pintor_registro_controller_valida_default_talla');
        $this->form_validation->set_rules('txt_ciudad', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_ciudad'), 'required|trim|xss_clean|min_length[1]|max_length[100]|regex_match[/^[0-9A-ZÑÁÉÍÓÚÜ,. ]*$/u]');
        $this->form_validation->set_rules('txt_cantidad_personas', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_fecha_nacimiento'), 'numeric|max_length[3]|xss_clean');
        $this->form_validation->set_rules('txt_cantidad_autos', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_fecha_nacimiento'), 'numeric|max_length[3]|xss_clean');
        $this->form_validation->set_rules('fecha_nacimiento', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_fecha_nacimiento'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_qr', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_codigoqr'), 'required|trim|xss_clean|min_length[1]|regex_match[/^[0-9A-ZÑÁÉÍÓÚÜ,.]*$/u]|callback_usuarios_maestro_pintor_registro_controller_valida_tarjeta');
        if ($this->input->post('chk_camara',true)== 1){ $this->form_validation->set_rules('txt_identificacion', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_identificacion'), 'required|trim|xss_clean|min_length[1]'); }
        if ($this->input->post('chk_archivo',true)== 1){ if(empty($_FILES['file_identificacion']['name'])){ $this->form_validation->set_rules('file_identificacion',$this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_identificacion'), 'required'); } }
    }    
    public function usuarios_maestro_pintor_registro_controller_form_error(){
        $json = $json_txt_telefono = $json_txt_extencion = $json_txt_cantidad_personas = $json_txt_cantidad_autos = $json_fecha_nacimiento = $json_txt_nombre = $json_txt_segundo_nombre = $json_txt_apellidos = $json_txt_rfc = $json_txt_email = $json_txt_celular = $json_cmb_compania = $json_cmb_puesto = $json_cmb_talla = $json_txt_ciudad = $json_fecha_nacimiento = $json_txt_qr = $json_txt_identificacion= $json_file_identificacion = array();
        if (!$this->form_validation->run()) {
            if (!empty(form_error('txt_nombre'))) { $json_txt_nombre =  array('txt_nombre' => form_error('txt_nombre', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_segundo_nombre'))) { $json_txt_segundo_nombre =  array('txt_segundo_nombre' => form_error('txt_segundo_nombre', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_apellidos'))) { $json_txt_apellidos =  array('txt_apellidos' => form_error('txt_apellidos', '<small class="mt-3 text-danger">', '</small>')); }            
            if (!empty(form_error('txt_rfc'))) { $json_txt_rfc =  array('txt_rfc' => form_error('txt_rfc', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_email'))) { $json_txt_email =  array('txt_email' => form_error('txt_email', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_telefono'))) { $json_txt_telefono =  array('txt_telefono' => form_error('txt_telefono', '<small class="mt-3 text-danger">','</p>')); }
            if (!empty(form_error('txt_extencion'))) { $json_txt_extencion =  array('txt_extencion' => form_error('txt_extencion', '<small class="mt-3 text-danger">','</p>')); }
            if (!empty(form_error('txt_celular'))) { $json_txt_celular =  array('txt_celular' => form_error('txt_celular', '<small class="mt-3 text-danger">','</p>')); }
//            if (!empty(form_error('cmb_compania'))) { $json_cmb_compania =  array('cmb_compania' => form_error('cmb_compania', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_puesto'))) { $json_cmb_puesto =  array('cmb_puesto' => form_error('cmb_puesto', '<small class="mt-3 text-danger">', '</small>')); }            
            if (!empty(form_error('cmb_talla'))) { $json_cmb_talla =  array('cmb_talla' => form_error('cmb_talla', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_ciudad'))) { $json_txt_ciudad =  array('txt_ciudad' => form_error('txt_ciudad', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_cantidad_personas'))) { $json_txt_cantidad_personas =  array('txt_cantidad_personas' => form_error('txt_cantidad_personas', '<small class="mt-3 text-danger">', '</small>' )); }
            if (!empty(form_error('txt_cantidad_autos'))) { $json_txt_cantidad_autos =  array('txt_cantidad_autos' => form_error('txt_cantidad_autos', '<small class="mt-3 text-danger">', '</small>' )); }
            if (!empty(form_error('fecha_nacimiento'))) { $json_fecha_nacimiento =  array('fecha_nacimiento' => form_error('fecha_nacimiento', '<small class="mt-3 text-danger">', '</small>' )); }
            if (!empty(form_error('txt_qr'))) { $json_txt_qr =  array('txt_qr' => form_error('txt_qr', '<small class="mt-3 text-danger">', '</small>' )); }
            if (!empty(form_error('file_identificacion'))) { $json_txt_identificacion =  array('file_identificacion' => form_error('file_identificacion', '<small class="mt-3 text-danger">', '</small>' )); }
            if (!empty(form_error('txt_identificacion'))) { $json_file_identificacion =  array('txt_identificacion' => form_error('txt_identificacion', '<small class="mt-3 text-danger">', '</small>' )); }
        $json = array_merge($json_txt_telefono,$json_txt_extencion,$json_txt_cantidad_autos,$json_txt_cantidad_personas,$json_txt_nombre , $json_txt_segundo_nombre , $json_txt_apellidos , $json_txt_rfc , $json_txt_email , $json_txt_celular , $json_cmb_compania , $json_cmb_puesto , $json_cmb_talla , $json_txt_ciudad , $json_fecha_nacimiento , $json_txt_qr , $json_txt_identificacion,$json_file_identificacion);
            return $json; } else { return 1; 
        }   
    }
    public function usuarios_maestro_pintor_registro_controller_guardar() {      
        
        $valmp=''; $div =0;
     //   $pais = $this->session->userdata(funciones_strategix_sitio_alias('s_pais_id'));
      //   $array_Division = $this->session->userdata(funciones_strategix_sitio_alias('control_division'));
        //if (is_array($array_Division)) {
        // foreach ($array_Division as $division) { $div = $division; }   //}
        //if($pais==83 && $div==1){$valmp=1;}else{$valmp=0;}
        //$valuemp['valmp'] = $valmp;
       //echo $valuemp; 





        $usuarios_registro_maestro_pintor_view_chk_whatsapp = $this->input->post('usuarios_registro_maestro_pintor_view_chk_whatsapp',true);
        $usuarios_registro_maestro_pintor_view_chk_email = $this->input->post('usuarios_registro_maestro_pintor_view_chk_email',true);        
        $fechanac           = $this->input->post('fecha_nacimiento',TRUE);
        $txt_rfc_trim       = trim($this->input->post('txt_rfc',TRUE)); $txt_rfc_utf8_decode = utf8_decode($txt_rfc_trim); $txt_rfc = strtoupper($txt_rfc_utf8_decode);
        $iddistribuidora    = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_distribuidora_id($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));
        $observaciones      = "DISTRIBUIDORA_ID: ".$iddistribuidora.", ID_USUARIO_CAPTURA:".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).", No. DE TARJETA ".$this->input->post('txt_qr',TRUE);
        $dataHead           = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",9,'".$this->uniqueId."'";
                                                //UsuarioDetalleNombre,                             UsuarioDetalleSegundoNombre,                                UsuarioDetalleApellidos,                          UsuarioDetalleApellidoMaterno,                  ,UsuarioDetalleEmail,                         UsuarioDetalleTelefono,                                         UsuarioDetalleExtension,                        UsuarioDetalleCelular,                      ,              UsuarioDetalleRFC,                  UsuarioDetalleCiudad,                       UsuarioDetalleTallaId,           UsuarioDetalleFechaNacimiento,                UsuarioDetallePuestoId,                 UsuarioDetalleNombreTaller,                                 UsuarioDetalleAproxPeronasTaller,                       UsuarioDetalleAproxAutosTaller,                             UsuarioDetalleUsuarioIdRegistro,                     UsuarioDetalleObservaciones,UsuarioDetalleSessionId
        $last_id = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_last_id();
       // $UsuarioDetalleUsuario = trim(funciones_strategix_crear_user(funciones_strategix_normalizar_cadena($this->input->post('txt_nombre',TRUE)), funciones_strategix_normalizar_cadena($this->input->post('txt_apellidos',TRUE)), $last_id));
        $contrasena_texto_plano = funciones_strategix_crear_password(6);
        $UsuarioDetalleClave = hash('sha256', $contrasena_texto_plano);
        $dataDetalle        = "'".trim($this->input->post('txt_nombre',TRUE))."','".trim($this->input->post('txt_segundo_nombre',TRUE))."','".trim($this->input->post('txt_apellidos',TRUE))."','".trim($this->input->post('txt_email',TRUE))."','".trim($this->input->post('txt_telefono',TRUE))."','".trim($this->input->post('txt_extencion',TRUE))."','".trim($this->input->post('txt_celular',TRUE))."','".$txt_rfc."','".trim($this->input->post('txt_ciudad',TRUE))."','".trim($this->input->post('cmb_talla',TRUE))."','".$fechanac."','".trim($this->input->post('cmb_puesto',TRUE))."','".trim($this->input->post('txt_taller',TRUE))."','".trim($this->input->post('txt_cantidad_personas',TRUE))."','".trim($this->input->post('txt_cantidad_autos',TRUE))."','".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."','".$this->uniqueId."','".$observaciones."','".$UsuarioDetalleClave."'";    
        $UsuarioId = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_insert_participante($dataHead, utf8_decode($dataDetalle),$iddistribuidora);
        if($UsuarioId!=0){
            if($this->input->post('chk_camara',true)== 1){
                $this->base_controller_valida_crea_carpetas('maestros_pintores');
                $this->base_controller_valida_crea_carpetas('maestros_pintores/'.$UsuarioId);
                $identificacion_temp    = 'uploads/temporal/maestros_pintores/fotos/'.$this->session->userdata('s_identificacion');
                $identificacion         = 'uploads/maestros_pintores/'.$UsuarioId."/".funciones_strategix_fecha_hora_actual()."_".$UsuarioId."_identificacion.png";
                if (file_exists($identificacion_temp)){ rename ($identificacion_temp , $identificacion); }       
                $this->session->unset_userdata('s_identificacion');
            }else{
                $identificacion           = "uploads/maestros_pintores/".$UsuarioId."/".funciones_strategix_fecha_hora_actual()."_".$UsuarioId."_identificacion.".$this->input->post('ext_file_identificacion',TRUE);
                $this->base_controller_valida_crea_carpetas('maestros_pintores');
                $direccion_documentos     = $this->base_controller_valida_crea_carpetas('maestros_pintores/'.$UsuarioId);
                $file_identificacion      = funciones_strategix_fecha_hora_actual()."-".$UsuarioId."-identificacion";
                $resultado_identificacion = $this->base_controller_cargas_upload_archivo('file_identificacion', $direccion_documentos, '*', $file_identificacion);
                if($resultado_identificacion['resultado']==0){
                    $valuemp['estatus'] = 2;
                    echo json_encode($valuemp);
                    return;
                }
            }
            $this->session->set_userdata('s_maestropintorid',$UsuarioId);
           // $user           = creatUserName(trim($this->input->post('txt_nombre',TRUE)),trim($this->input->post('txt_apellidos',TRUE)),$UsuarioId);
            $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_update_usaurio_clave($UsuarioId,$identificacion);
//            $datos_tarjeta = "'".trim($this->input->post('txt_qr',TRUE))."','".$iddistribuidora."','".$UsuarioId."','2','".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."','".$this->session->userdata(funciones_strategix_sitio_alias('s_pais_id'))."'";
            $updateTarjeta = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_update_tarjeta($UsuarioId,$iddistribuidora,trim($this->input->post('txt_qr',TRUE)));
            if ($usuarios_registro_maestro_pintor_view_chk_email==1){
              
              //  $division = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_get_division($UsuarioId);
                $resultado_envio_correo = $this->usuarios_maestro_pintor_registro_controller_envio_correo_bienvenida($this->input->post('txt_nombre',TRUE),$this->input->post('txt_segundo_nombre',TRUE),$this->input->post('txt_apellidos',TRUE),$this->input->post('txt_email',TRUE),$contrasena_texto_plano);                 
            }
           /* if ($usuarios_registro_maestro_pintor_view_chk_whatsapp==1){
                $celular = $this->input->post('txt_celular',TRUE);
                $nombre = $this->input->post('txt_nombre',TRUE)." ".$this->input->post('txt_segundo_nombre',TRUE)." ".$this->input->post('txt_apellidos',TRUE)." ".$this->input->post('txt_apellidomaterno',TRUE);
                $this->infobip_library->infobip_library_send_whatsapp(8,$celular,'contrasena_bienvenida','"'.$nombre.'","'.$user.'"','es',$this->uniqueId);
                $resultado_envio_correo =1;
            }*/
            if($resultado_envio_correo){ 
                $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_update_email($UsuarioId); 
                $valuemp['estatus'] = 1;
                return $valuemp;
              //  return 1;                
            } else {
                $valuemp['estatus'] = 2;
              //  return 2;  
              return $valuemp;              
            }
        }
    }
    public function usuarios_maestro_pintor_registro_controller_valida_rfc($txt_rfc) {
        $response = TRUE; 
        if($txt_rfc == ""){
//            $this->form_validation->set_message('usuarios_registro_maestro_pintor_valida_rfc', sprintf($this->lang->line('usuarios_registro_maestro_error_rfc'),$txt_rfc));
//            $response = FALSE;
        }else{
            if ($this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_valida_rfc($txt_rfc)>=1){        
                $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_rfc', sprintf($this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_rfc_repetido'),$txt_rfc));
                $response = FALSE;
            } else {
                $response = TRUE;
            }
        }
        return $response;
    }
    public function usuarios_maestro_pintor_registro_controller_valida_email($txt_email) {
        if($txt_email == ""){
            $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_email', sprintf('O CAMPO CORREO ELECTRÓNICO É OBRIGATÓRIO.',$txt_email));
            $response = FALSE;
             }else{
        if ($this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_valida_email($txt_email)==1){        
            $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_email', sprintf($this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_email_repetido'),$txt_email));
            $response = FALSE;
        } else {
            $response = TRUE;
        }
    }
        return $response;
    }    
    public function usuarios_maestro_pintor_registro_controller_valida_celular($txt_celular) {
        if($txt_celular == ""){
            $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_celular', sprintf('O CAMPO CELULAR É OBRIGATÓRIO.',$txt_celular));
            $response = FALSE;
             }else{
        if ($this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_valida_celular($txt_celular)>=1){        
            $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_celular', sprintf($this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_celular_repetido'),$txt_celular));
            $response = FALSE;
        } else {
            $response = TRUE;
        }
    }
        return $response;
    }
    public function usuarios_maestro_pintor_registro_controller_valida_default_compania($post_string){
        if ($post_string==0){ $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_default_compania', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_compañia')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function usuarios_maestro_pintor_registro_controller_valida_default_puesto($post_string){
        if ($post_string==0){ $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_default_puesto', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_puesto')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function usuarios_maestro_pintor_registro_controller_valida_default_talla($post_string){
        if ($post_string==0){ $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_default_talla', $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_talla')); $response = FALSE; } else { $response = TRUE; }return $response;
    }    
    public function usuarios_maestro_pintor_registro_controller_valida_tarjeta($txt_qr){
        if($txt_qr == ""){
            $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_tarjeta', sprintf($this->lang->line('usuarios_maestro_pintor_registro_controller_error_tarjeta'),$txt_qr));
            $response = FALSE;
        }else{
            $iddistribuidora = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_distribuidora_id($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));
            $tarjeta = $this->usuarios_maestro_pintor_registro_model->usuarios_maestro_pintor_registro_model_valida_tarjeta($txt_qr,$iddistribuidora);
            if (!empty($tarjeta)){ 
                switch ($tarjeta->TarjetaEstatusId) {
                    case 1:  $response = TRUE;  break;
                    case 2:  
                            $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_tarjeta', sprintf($this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_uno'),$txt_qr));
                            $response = false;
                        break;
                    case 3:  
                        $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_tarjeta', sprintf($this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_tres'),$txt_qr));
                        $response = FALSE;
                        break;
                    case 4:  
                        $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_tarjeta', sprintf($this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_cuatro'),$txt_qr));
                        $response = FALSE;
                        break;
                }
            }else{ 
                $this->form_validation->set_message('usuarios_maestro_pintor_registro_controller_valida_tarjeta', sprintf($this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_no_existe'),$txt_qr));
                $response = FALSE;
            }   
        }    
        return $response;
    }    
    public function usuarios_maestro_pintor_registro_controller_envio_correo_bienvenida($nombre,$segundonombre,$apellidos,$email,$contrasena) {
        $nombrecompleto = $nombre.' '.$segundonombre.' '.$apellidos;
        $data['nombre'] = $nombrecompleto;
        $data['email'] = $email;
      //  $data['user'] = $usuario;
        $data['pwd'] = $contrasena;
        //$datos      = array('nombre'=>$nombrecompleto,'usuario'=>$usuario,'sessionId'=>$this->uniqueId);
            $mail       = $this->load->view('mails/mails_usuarios/mails_usuarios_participantes/mails_usuarios_participantes_interno_registro_bienvenida' ,$data, TRUE);
        $to         = array('to' => $email,'cc'=>'','bcc'=>'');
        $status_msg = $this->base_controller_envio_correos($to,$this->lang->line('usuarios_maestro_pintor_registro_controller_lang_mail_welcome'), $mail, '');        
        ($status_msg) ? $result = true : $result = false;
        return $result;
    }
}
