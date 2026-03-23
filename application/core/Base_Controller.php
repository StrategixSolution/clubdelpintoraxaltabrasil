<?php

/*
 * Sistema Web Responsivo CDPBR                        *
 * @author	Strategic Solutions S.A. de C.V         *
 * @programmer  Luis Felipe Rangel                      *
 * @CreateDate 09 MARZO 2026 09:00:00                   *
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Base_Model');
        $this->site_icon = funciones_strategix_version_url_random_base_url('favicon.ico');
        $this->base_controller_valida_usuario();
    }
    public function base_controller_create_view_sistema($view, $data = array()){//Estructura de Sitio
        $data['token']                      = $this->base_controller_csrf_input_token(); 
        $datafooter                         = "";             
        $dataheader['site_title']           = $this->config->item('site_title');
        $dataheader['site_icon']            = $this->site_icon;
        $datanav['perfil_nombre']           = mb_strtoupper($this->session->userdata(funciones_strategix_sitio_alias("s_perfil_nombre")));
        $datanav['usuario_nombre']          = mb_strtoupper($this->session->userdata(funciones_strategix_sitio_alias("s_usuario_nombre")));
        $datanav['menu']                    = $this->base_controller_menus();
        $datanav['menu_hide']               = (funciones_strategix_valida_terminos_condiciones_aviso_privacidad_actualiza_datos($this->session->userdata(funciones_strategix_sitio_alias('s_actualiza_datos'))))?1:0;
        $this->load->view('template/sistema/header',$dataheader);
        $this->load->view('template/sistema/menu/menu', $datanav);
        $this->load->view($view, $data);
        $this->load->view('template/sistema/footer', $datafooter); 
    }
    public function base_controller_create_view_login($view, $data = array()){  
        $data['token']                      = $this->base_controller_csrf_input_token(); 
        $dataheader['site_icon']            = $this->site_icon;
        $this->load->view('template/login/header',$dataheader);        
        $this->load->view($view, $data);
        $this->load->view('template/login/footer');         
    }
    public function base_controller_create_view_out($view, $data = array()){
        $data['token']                      = $this->base_controller_csrf_input_token(); 
        $dataheader['site_title']           = $this->config->item('site_title');
        $dataheader['site_icon']            = $this->site_icon;
        $this->load->view('template/publico/header',$dataheader);
        $this->load->view($view, $data);
        $this->load->view('template/publico/footer'); 
    }
    private function base_controller_menus(){
        $menu = '';
        switch ($this->session->userdata(funciones_strategix_sitio_alias("s_perfil_id"))) {            
            case 1: $menu = 'menu_administrador_strategix'; break;//ADMINISTRADORES STRATEGIX
            case 2: $menu = 'menu_atencion_clientes'; break;//ATENCIÓN A CLIENTES
            case 3: $menu = 'menu_administrador_axalta'; break;//ADMINISTRADORES AXALTA
            case 4: $menu = 'menu_gerente_regional'; break;//GERENTE REGIONAL
            case 5: $menu = 'menu_ejecutivo'; break;//EJECUTIVOS
            case 6: $menu = 'menu_administrador_distribuidor'; break;//ADMINISTRADOR DE DISTRIBUIDOR
            case 7: $menu = 'menu_personal_tienda'; break;//PERSONAL DE TIENDA
            case 8: $menu = 'menu_responsable_tienda'; break;//RESPONSABLE DE TIENDA
            case 9: $menu = 'menu_maestro_pintor'; break;//MAESTRO PINTOR        
        }
        return $this->load->view('template/sistema/menu/'.$menu,'',true);
    }
    public function base_controller_envio_correos($to = array(), $subject, $content, $file = '' ){//Cunfiguracion y envío de Mail
        // echo "<pre>"; print_r($to['to']); echo "</pre>"; die();
        
        $this->load->library('email');
        $config = array('smtp_timeout'  => "60",
            'protocol'      => "smtp",
            'smtp_host'     => "smtp-legacy.office365.com",
            'smtp_user'     => "contacto@clubdelpintoraxalta.com.mx",
            'smtp_pass'     => "Goh62389",
            'smtp_port'     => "587",
            'smtp_crypto'   => "tls",
            'mailtype'      => "html",
            'wordwrap'      => TRUE,
            'charset'       => "utf-8",
            'newline'       => "\r\n",
            'crlf'          => "\r\n");             
        $this->email->initialize($config);
        $this->email->from('contacto@clubdelpintoraxalta.com.mx', 'AXALTA');
        $this->email->subject($subject);
        $this->email->message($content);
        if ($file != ''){ $this->email->attach($file); }
		$this->email->to('luis.rangel@strategix.com.mx');
		/*$this->email->to($to['to']); 
		if (array_key_exists('cc',$to) && $to['cc'] != "" ){ $this->email->cc($to['cc']); };
        $this->email->bcc('contacto@clubdelpintoraxalta.com.mx,patricia.carteno@strategix.com.mx');*/
        $estatus_msg = $this->email->send(FALSE);
//        if($estatus_msg){
//            echo "enviado<br/>";
//            echo $this->email->print_debugger(array('headers'));
//        }else {
//            echo "fallo <br/>";
//            echo "error: ".$this->email->print_debugger(array('headers'));
//        }
        return $estatus_msg;
    }
    public function base_controller_codigo_postal($cp){
        $d_col = $this->Base_Model->base_model_busca_asentamiento($cp);
        $d_mun = $this->Base_Model->base_model_busca_delegacion($cp);
        $d_est = $this->Base_Model->base_model_busca_estado($cp);
        $d_ciu = $this->Base_Model->base_model_busca_ciudad($cp);          
        $colonia = $munic = $estado = $ciudad = $est = "";
        foreach ($d_col as $val_col){ $colonia 	.= '<option value="'.utf8_encode(strtoupper($val_col->CodigoPostalAsentacion)).'">'.utf8_encode(strtoupper($val_col->CodigoPostalAsentacion)).'</option>';}
        foreach ($d_mun as $val_mun){ $munic 	.= '<option value="'.utf8_encode(strtoupper($val_mun->CodigoPostalDelegacionMunicipio)).'">'.utf8_encode(strtoupper($val_mun->CodigoPostalDelegacionMunicipio)).'</option>'; }
        foreach ($d_est as $val_est){ $estado   .= '<option value="'.utf8_encode(strtoupper( $val_est->CodigoPostalEstado)).'">'.utf8_encode(strtoupper($val_est->CodigoPostalEstado)).'</option>'; $est = $val_est->CodigoPostalEstado; }
        foreach ($d_ciu as $val_ciu){ $ciudad   .= '<option value="'.utf8_encode(strtoupper($val_ciu->CodigoPostalCiudad)).'">'.utf8_encode(strtoupper($val_ciu->CodigoPostalCiudad)).'</option>'; }
        $entrada = ($estado == "")?0:1;
        $data = array('entrada'=> $entrada, 'colonia' => $colonia, 'munic' => $munic, 'estado' => $estado, 'ciudad'=>$ciudad );
        return $data;
    }
    public function base_controller_valida_crea_carpetas($carpeta){
        $folder = set_realpath('uploads/'.$carpeta); if(!is_dir($folder)){ mkdir($folder,777); } return $folder;
    }
    public function base_controller_cargas_upload_archivo($input_file_name,$directorio,$extenciones,$nombre_archivo){
        if(!empty($_FILES[$input_file_name]['name'])){
            $filename = $_FILES[$input_file_name]["name"];
            $ext = ".".pathinfo($filename,PATHINFO_EXTENSION);
            $filenewname = $nombre_archivo.$ext;
            $config['upload_path'] = $directorio;
            $config['allowed_types'] = strtolower($extenciones);
            $config['file_name'] = $filenewname;
            $this->upload->initialize($config);
            $this->load->library('upload',$config);
            if($this->upload->do_upload($input_file_name)){
                $res['resultado']  = 1;
                $res['file_name']  = strtolower($filenewname);
                $res['ext']  = strtolower($ext);
            } else {                
                $res['msg'] = "Error al cargar el archivo ".$this->upload->display_errors();
                $res['resultado']  = 0; 
            }
        } else {
            $res['msg'] = "FileInput no definido"; $res['resultado']  = 0;
        }
        return $res;
    }
    public function base_controller_datos_usuario_web() {
        $this->load->library('user_agent');
        if ($this->agent->is_browser()){
            $navegador = $this->agent->browser().' '.$this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $navegador = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $navegador = $this->agent->mobile();
        } else { $navegador = 'Unidentified User Agent';
        }
        $data['sitemaOperativo'] = $this->agent->platform();
        $data['ip_address'] =  $this->input->ip_address();
        return $data;
    }
    private function base_controller_valida_usuario() {       
        if ($this->base_controller_check_session()){ redirect(funciones_strategix_version_url_random_base_url("login")); }
//        if ($this->base_controller_paginas_publicas()==true and $this->uri->segment(1)!="AvisoPrivacidad" and funciones_strategix_valida_terminos_condiciones_aviso_privacidad_actualiza_datos($this->session->userdata(funciones_strategix_sitio_alias('s_aviso_privacidad')))==0){ redirect(funciones_strategix_version_url_random_base_url("AvisoPrivacidad"));}        
        if ($this->base_controller_paginas_publicas()==true and $this->uri->segment(1)!="AvisoPrivacidad" and $this->uri->segment(1)!="UsuariosActualizarDatos"  and funciones_strategix_valida_terminos_condiciones_aviso_privacidad_actualiza_datos($this->session->userdata(funciones_strategix_sitio_alias('s_actualiza_datos')))==0){ redirect(funciones_strategix_version_url_random_base_url("UsuariosActualizarDatos")); }   
    }
    private function base_controller_check_session(){//Valida session de participante
        if  ($this->base_controller_paginas_publicas()==false){
            return false;
        }else{
            if ($this->session->userdata(funciones_strategix_sitio_alias("logged_in"))) {
                return false;
            }else { 
                return true;
            }
        }
    }
    private function base_controller_paginas_publicas() {
        if  (uri_string()==''                 
                || uri_string() == 'login' 
                || uri_string() == 'Login'
                || uri_string() == 'logout'
                || uri_string() == 'logout/logout_controller'
                || uri_string() == 'autenticacion/autenticacion_controller'
                || uri_string() == 'legal/legal_aviso_privacidad/legal_aviso_privacidad_controller' 
                || uri_string() == 'legal/legal_aviso_privacidad/legal_aviso_privacidad_controller/legal_aviso_privacidad_controller_guarda_acepto' 
                || uri_string() == 'login/login_controller/login_controller_crea_cookie'
                || uri_string() == 'usuarios/usuarios_crea_clave/usuarios_crea_clave_controller/usuarios_crea_clave_controller_clave_nueva'
                || uri_string() == 'usuarios/usuarios_recupera_clave/usuarios_recupera_clave_controller/usuarios_recupera_clave_controller_email' 
                || uri_string() == 'usuarios/usuarios_recupera_clave/usuarios_recupera_clave_nueva_controller/usuarios_recupera_clave_nueva_controller_actualizacion' 
                || uri_string() == 'UsuariosCrearClave'
                || uri_string() == 'UsuariosRecuperaClave' 
                || uri_string() == 'UsuariosRecuperaClaveNueva'
                || uri_string() == 'UsuariosRecuperaCrearClave'
                || uri_string() == 'usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_datos' 
                || uri_string() == 'usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_guardar'
                || uri_string() == 'usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_validar_correo_celular'
                || uri_string() == 'usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_enviar_correo_validacion'
                || uri_string() == 'usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_enviar_celular_validacion' 
                || uri_string() == 'usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_validar_correo_token'
                || uri_string() == 'UsuariosActualizarDatosValidaEmail'
                || uri_string() == 'usuarios/usuarios_participantes/usuarios_participantes_cargar_cartas_controller/usuarios_participantes_cargar_cartas_controller_cargar_pdf'
                || uri_string() == 'Registromaestropintorexterno'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_registro_mp_externo_controller_cmb_telefonias'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_registro_mp_externo_controller_cmb_distribuidora'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_registro_mp_externo_controller_valida_cp'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_participantes_externo_alta_obtener_datos_distribuidora'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_participantes_externo_alta_validar_formulario'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_participantes_externo_alta_registro'
                || uri_string() == 'mails/mails_usuarios/mails_usuarios_participantes/mails_usuarios_participantes_externo/mails_usuarios_participantes_interno_registro_bienvenida'
                || uri_string() == 'Registroexitoso'
                || uri_string() == 'Registromaestropintorexternodatos'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_datosregistro_controller'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/registro_exitoso_maestro_pintor'
                || uri_string() == 'usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_controller/usuarios_registro_mp_externo_controller_aceptar_registro'
                || uri_string() == 'TutorialesAxaltaCDP'
                ){
            return false;
        } else {
            return true;
        }
    }   
    public function base_controller_csrf_input_token() {
        return "<input type=\"hidden\" id=\"".$this->security->get_csrf_token_name()."\" name=\"".$this->security->get_csrf_token_name()."\" value=\"".$this->security->get_csrf_hash()."\" />";
    }  
    public function base_controller_historial_carga($nombre_archvio_original,$nombre_archivo_nuevo,$folder,$tipo) {
        $tabla = "";$x=$cargaId=0;
        $sheets = $this->phpspreadsheet_sx_library->phpspreadsheet_sx_library_lee_archivo($folder.$nombre_archivo_nuevo);
        if (count($sheets)>1){
            $cargaId = $this->Base_Model->base_model_insert_cargas($tipo,$nombre_archvio_original,$nombre_archivo_nuevo);
            foreach ($sheets as $row) {   
                if($x!=0){
                    $error = $this->Base_Model->base_model_insert_cargas_detalle($row,$tipo,$cargaId);
                    $tabla.=carga_tabla_helper($tipo,$row,$error,$cargaId);
                }
                $x++;
            }
            $data['cargaId'] = $cargaId;
            $data['tabla'] = $tabla;
            $data['error'] = $this->Base_Model->base_model_valida_carga_error($tipo,$cargaId);
        } else {
            $data['cargaId'] = 0;
            $data['tabla'] = "";
            $data['error'] = -1;
        }
        return $data;
    } 
    public function base_controller_valida_corte($tipo,$anio='',$mes='',$CorteIdOtro='') {
        return ($this->Base_Model->base_model_valida_corte($tipo,$anio,$mes,$CorteIdOtro)==0)?0:1;
    }
    public function base_controller_valida_ventas($anio,$mes,$mes_anterior) {
        return ($this->Base_Model->base_model_valida_ventas($anio,$mes,$mes_anterior)==0)?0:1;
    }    
    public function base_controller_valida_ventas_auditoria($anio,$mes,$mes_anterior) {
        return $this->Base_Model->base_model_valida_ventas_auditorias($anio,$mes,$mes_anterior);
    }
    public function base_controller_valida_ventas_promocion($VentaPromocionId) {
        return ($this->Base_Model->base_model_valida_ventas_promocion($VentaPromocionId)==0)?0:1;
    }    
    public function base_controller_valida_ventas_auditoria_promocion($VentaPromocionId) {
        return $this->Base_Model->base_model_valida_ventas_auditorias_promocion($VentaPromocionId);
    }
    public function base_controller_guarda_corte($tipo,$anio,$mes,$id=0) {
        return $this->Base_Model->base_model_guarda_cortes($tipo,$anio,$mes,$id);
    }
    public function base_controller_guarda_corte_detalle($tabla,$data) {
        return $this->Base_Model->base_model_guarda_cortes_detalle($tabla,$data);
    }  

    /**
     * Guarda log de origen de registro/ingreso (equivalente a MySQL logregistros)
     * @param int|string $idRegistroOrigen  Ej: 2 web, 9 facebook remp, 10 google remp, 11 web remp (según lógica original)
     * @param int|string $idUsuario         (en original se guardaba en UsuarioTipoRegistroId)
     * @param int|string $idLog             Log padre (idLog) si existe
     * @return int                          ID insertado (LogRegistroId)
     */
   /**/

    public function saveLogHistoryRegistro($paginaAccesadaId, $usuarioId = '', $parentId = '')
    {
        $paginaAccesadaId = ($paginaAccesadaId === '' || $paginaAccesadaId === null) ? null : (int)$paginaAccesadaId;
        $usuarioId        = ($usuarioId === '' || $usuarioId === null) ? null : (int)$usuarioId;
        $parentId         = ($parentId === '' || $parentId === null) ? null : (int)$parentId;

        // IP
        $ip = (isset($this->input) && is_object($this->input))
            ? $this->input->ip_address()
            : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');

        // Sistema Operativo / Plataforma (User Agent)
        $plataforma = '';
        if (!isset($this->agent) || !is_object($this->agent)) {
            if (isset($this->load) && is_object($this->load)) {
                $this->load->library('user_agent');
            }
        }
        if (isset($this->agent) && is_object($this->agent) && method_exists($this->agent, 'platform')) {
            $plataforma = (string)$this->agent->platform();
        }
        if ($plataforma === '') {
            $plataforma = isset($_SERVER['HTTP_USER_AGENT']) ? (string)$_SERVER['HTTP_USER_AGENT'] : '';
        }

        // Host (equivalente a lo que guardaban como Aspel-SS / Strsrvr2)
        // En IIS normalmente te conviene el hostname real del server:
        $host = function_exists('gethostname') ? gethostname() : php_uname('n');
        if ($host === '' || $host === false) {
            $host = isset($_SERVER['SERVER_NAME']) ? (string)$_SERVER['SERVER_NAME'] : '';
        }

        // Validación mínima (en MySQL era NOT NULL)
        if ($paginaAccesadaId === null) {
            return 0;
        }
        log_message('error', 'LOG INSERT pagina='.$paginaAccesadaId.' usuario='.$usuarioId.' parent='.$parentId);

        // INSERT compatible con CI_DB_odbc_driver (sin $this->db->insert())
        $sqlInsert = "
            INSERT INTO dbo.LogRegistros
            (
                LogRegistroIP,
                LogRegistroSistemaOperativo,
                LogRegistroHost,
                UsuarioId,
                LogRegistroParentId,
                PaginaAccesadaId,
                LogRegistroAvisoCookie1,
                LogRegistroAvisoCookie2
            )
            VALUES
            (
                ?, ?, ?, ?, ?, ?, NULL, NULL
            )
        ";

        $params = array(
            $ip,
            $plataforma,
            $host,
            $usuarioId,
            $parentId,
            $paginaAccesadaId
        );

        $ok = $this->db->query($sqlInsert, $params);

        if ($ok === FALSE) {
            $err = $this->db->error();
            log_message('error', 'saveLogHistoryRegistro INSERT FAIL: ' . print_r($err, true));
            log_message('error', 'saveLogHistoryRegistro LAST QUERY: ' . $this->db->last_query());
            return 0;
        }

        // Último ID insertado en SQL Server
        $q = $this->db->query("SELECT CAST(SCOPE_IDENTITY() AS INT) AS insert_id");

        if ($q && method_exists($q, 'num_rows') && $q->num_rows() > 0) {
            return (int)$q->row()->insert_id;
        }

        return 0;
    }

    public function logRegistroMarcarAvisoCookie($logId, $numAviso = 1)
    {
        $logId = (int)$logId;
        $numAviso = (int)$numAviso;

        if ($logId <= 0) return false;

        if ($numAviso === 1) {
            return $this->db->query("UPDATE dbo.LogRegistros SET LogRegistroAvisoCookie1 = GETDATE() WHERE LogRegistroID = ?", array($logId));
        }

        if ($numAviso === 2) {
            return $this->db->query("UPDATE dbo.LogRegistros SET LogRegistroAvisoCookie2 = GETDATE() WHERE LogRegistroID = ?", array($logId));
        }

        return false;
    }



}
