<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class usuarios_registro_mp_interno_controller extends Base_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_model');
        $this->load->library('form_validation');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }
    public function index(){
        $data['frm_action'] = "frm_login_view";
        $this->base_controller_create_view_sistema('usuarios/usuarios_registro_participante_interno/usuarios_registro_participante_interno_view',$data);
    }

    public function usuarios_registro_mp_interno_controller_valida_cp(){
        $cp = $_POST['cp'];
        $datos = $this->usuarios_registro_mp_interno_model->usuarios_participantes_interno_alta_obtener_datos_cp($cp);

        if (!empty($datos)) {
            $estado = $datos[0]->CodigoPostalEstado;
            $ciudad = $datos[0]->CodigoPostalCiudad;
            $municipio = $datos[0]->CodigoPostalDelegacionMunicipio;

            $colonias = array_map(function($item){
                return $item->CodigoPostalAsentacion;
            }, $datos);

            $respuesta = array(
                "estado" => $estado,
                "ciudad" => $ciudad,
                "municipio" => $municipio,
                "colonias" => $colonias
            );
        } else {
            $respuesta = array(
                "estado" => "",
                "ciudad" => "",
                "municipio" => "",
                "colonias" => []
            );
        }

        echo json_encode($respuesta);
    }

    public function usuarios_registro_mp_interno_controller_cmb_distribuidora(){
        $iduser = $_POST['iduser'];
         $cmb_dist ="";
        $distribuidor = $this->usuarios_registro_mp_interno_model->usuarios_participantes_interno_alta_obtener_datos_distribuidora($iduser);
       //print_r($distribuidor);die;
        foreach ($distribuidor as $dist) {   
            if($dist->DistribuidorDetalleNombreComercial!=NULL){
                $nombre = utf8_encode($dist->DistribuidorDetalleNombreComercial);
            } else {
                $nombre = utf8_encode($dist->DistribuidorDetalleRazonSocial);
            }   
            $cmb_dist .="<option value=$dist->DistribuidorId>".$nombre."</option>";
        }
        echo json_encode($cmb_dist);
    }

    public function usuarios_participantes_interno_alta_validar_celular($txt_celular){
        $model_count = $this->usuarios_registro_mp_interno_model->usuarios_participantes_interno_alta_validar_celular($txt_celular);
        return ($model_count == 0); 
    }

    public function usuarios_participantes_interno_alta_validar_tarjeta($txt_numeroTarjeta){
        $model_count = $this->usuarios_registro_mp_interno_model->usuarios_participantes_interno_alta_validar_tarjeta($txt_numeroTarjeta);
        return ($model_count == 0); 
    }


    public function usuarios_participantes_interno_alta_validar_formulario(){
        $config = array(
            array(
                'field' => 'txt_nombre',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_campo_nombre'),
                'rules' => 'required|min_length[1]|max_length[100]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ]*$/u]'
            ),
            array(
                'field' => 'txt_segundonombre',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_campo_segundo_nombre'),
                'rules' => 'max_length[100]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ]*$/u]'
            ),
            array(
                'field' => 'txt_apellidopaterno',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_campo_aPaterno'),
                'rules' => 'required|min_length[1]|max_length[50]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ]*$/u]'
            ),
            array(
                'field' => 'txt_apellidomaterno',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_campo_aMaterno'),
                'rules' => 'required|min_length[1]|max_length[50]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ]*$/u]'
            ),
            array(
                'field' => 'txt_celular',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_campo_celular'),
                'rules' => 'required|numeric|exact_length[10]|callback_usuarios_participantes_interno_alta_validar_celular',
                'errors' => [
                    'required' => 'El campo Celular es obligatorio.', 
                    'usuarios_participantes_interno_alta_validar_celular' => 'El teléfono ya se encuentra registrado',
                    'numeric' => 'El campo Celular debe contener solo números.',
                    'exact_length' => 'El campo Celular debe tener exactamente 10 dígitos.'
                ],
            ),
            array(
                'field' => 'txt_cp',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_tooltips_cp'),
                'rules' => 'required|numeric|min_length[4]|max_length[5]'
            ),
            array(
                'field' => 'txt_estado',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_tooltips_estado'),
                'rules' => 'required|min_length[1]|max_length[50]'
            ),
            array(
                'field' => 'txt_ciudad',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_tooltips_ciudad'),
                'rules' => 'required|min_length[1]|max_length[50]'
            ),
            array(
                'field' => 'txt_municipio',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_tooltips_municipio'),
                'rules' => 'required|min_length[1]|max_length[50]'
            ),
            array(
                'field' => 'txt_colonia',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_tooltips_colonia'),
                'rules' => 'required'
            ),
            array(
                'field' => 'txt-qr',
                'label' => $this->lang->line('usuario_registro_mp_interno_controller_lang_label_no_tarjeta'),
                'rules' => 'required|numeric|callback_usuarios_participantes_interno_alta_validar_tarjeta',
                'errors' => [
                    'required' => $this->lang->line('usuario_registro_mp_interno_controller_lang_label_error_tarjeta_required'), 
                    'usuarios_participantes_interno_alta_validar_tarjeta' => $this->lang->line('usuario_registro_mp_interno_controller_lang_label_error_tarjeta_validar'),
                    'numeric' => $this->lang->line('usuario_registro_mp_interno_controller_lang_label_error_tarjeta_numeric')
                ],
            )
        );

        if ($this->input->post('chk_camara')) {
            $config[] = array(
                'field' => 'txt_ine_foto',
                'label' => 'INE',
                'rules' => 'required'
            );
        }

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('', ''); 

        if (!$this->form_validation->run()) {
            $errors = array();

            foreach ($config as $field_rule) {
                $field_name = $field_rule['field'];
                $error_message = form_error($field_name);
                if (!empty($error_message)) {
                    $errors[$field_name] = $error_message;
                }
            }
            
            $this->output->set_content_type('application/json')->set_output(json_encode($errors));
        } else {
            echo json_encode(1);
        }
    }

    public function usuarios_participantes_interno_alta_registro(){

        // ESTA FUNCIÓN ES CRÍTICA: SE ENCARGA DE CREAR LA ESTRUCTURA DE CARPETAS PASO A PASO.
        $this->ventas_registro_guardar_ine_valida_carpetas(); 
        
        // Asumiendo que ventas_registro_guardar_ine también necesita esta estructura,
        // o la crea de forma incremental si es para otra ruta.
        $imagen_ticket = $this->ventas_registro_guardar_ine(); // Revisa si esta función está causando otro mkdir

        $imagen_ine = null; // Inicializar para evitar "Undefined variable" si ninguna condición se cumple
        if($this->input->post('chk_camara')){
            $imagen_ine = $this->mp_registro_interno_guardar_ine_foto();
        }
        if($this->input->post('chk_archivo')){
            $imagen_ine = $this->mp_registro_interno_guardar_ine_archivo();
        } 

        $participante['nombre'] = trim(mb_strtoupper($this->input->post('txt_nombre', true)));
        $participante['segundo_nombre'] = trim(mb_strtoupper($this->input->post('txt_segundonombre', true)));
        $participante['paterno'] = trim(mb_strtoupper($this->input->post('txt_apellidopaterno', true)));
        $participante['materno'] = trim(mb_strtoupper($this->input->post('txt_apellidomaterno', true)));
        $participante['celular'] = trim($this->input->post('txt_celular', true));
        $participante['compania'] = 1;
        $participante['email'] = "tienda@axalta.com.mx";
        $participante['perfil'] = 9;
        $participante['cp'] = trim($this->input->post('txt_cp', true));
        $participante['estado'] = trim(mb_strtoupper($this->input->post('txt_estado', true)));
        $participante['ciudad'] = trim(mb_strtoupper($this->input->post('txt_ciudad', true)));
        $participante['municipio'] = trim(mb_strtoupper($this->input->post('txt_municipio', true)));
        $participante['colonia'] = trim(mb_strtoupper($this->input->post('txt_colonia', true)));
        $participante['distribuidor'] = trim($this->input->post('cmb_distribuidor', true));
        $participante['tarjeta'] = trim($this->input->post('txt-qr', true));
        $participante['usercaptura'] = trim($this->input->post('idu', true));

        $dataUsuario['UsuarioCapturaId'] = $participante['usercaptura'];
        $dataUsuario['UsuarioTipoRegistroId'] = 1;
        $dataUsuario['PerfilId'] = $participante['perfil'];
        $dataUsuario['UsuarioSessionId'] = trim(mb_strtoupper($this->usuarios_participantes_interno_alta_validar_usuarioSesion(), "UTF-8"));          
        $queryDataUsuario = $this->usuarios_registro_mp_interno_model->usuarios_participantes_interno_alta_insert_usuario($dataUsuario);

        $dataUsuarioDetalles['UsuarioId'] = $queryDataUsuario;
        $dataUsuarioDetalles['UsuarioDetalleNombre'] = utf8_decode($participante['nombre']);
        $dataUsuarioDetalles['UsuarioDetalleSegundoNombre'] = utf8_decode($participante['segundo_nombre']);
        $dataUsuarioDetalles['UsuarioDetalleApellidoPaterno'] = utf8_decode($participante['paterno']);
        $dataUsuarioDetalles['UsuarioDetalleApellidoMaterno'] = utf8_decode($participante['materno']);
        $dataUsuarioDetalles['UsuarioDetalleUsuario'] = trim(funciones_strategix_crear_user(funciones_strategix_normalizar_cadena($participante['nombre']), funciones_strategix_normalizar_cadena($participante['paterno']), $queryDataUsuario));
        $contrasena_texto_plano = funciones_strategix_crear_password(6);
        $dataUsuarioDetalles['UsuarioDetalleClave'] = hash('sha256', $contrasena_texto_plano);
        $dataUsuarioDetalles['UsuarioDetalleEmail'] = $participante['email'];
        $dataUsuarioDetalles['UsuarioDetalleTelefono'] = $participante['celular'];
        $dataUsuarioDetalles['UsuarioDetalleCelular'] = $participante['celular'];
        $dataUsuarioDetalles['UsuarioDetalleCompania'] = $participante['compania'];
        $dataUsuarioDetalles['UsuarioDetalleCp'] = $participante['cp'];
        $dataUsuarioDetalles['UsuarioDetalleEstado'] = utf8_decode($participante['estado']);
        $dataUsuarioDetalles['UsuarioDetalleCiudad'] = utf8_decode($participante['ciudad']);
        $dataUsuarioDetalles['UsuarioDetalleMunicipio'] = utf8_decode($participante['municipio']);
        $dataUsuarioDetalles['UsuarioDetalleColonia'] = utf8_decode($participante['colonia']);
        $dataUsuarioDetalles['UsuarioDetalleIdRegistro'] = 1;
        $dataUsuarioDetalles['UsuarioDetalleArchivoIdentificacion'] = $imagen_ine;
        $dataUsuarioDetalles['UsuarioDetalleObservaciones'] = "REGISTRO INTERNO";
        $dataUsuarioDetalles['UsuarioDetalleSessionId'] = trim(mb_strtoupper($this->usuarios_participantes_interno_alta_validar_usuarioSesion(), "UTF-8"));   
        $this->usuarios_registro_mp_interno_model->usuarios_participantes_interno_alta_insert_usuarioDetalle($dataUsuarioDetalles);
        
        $dataUsuariosDistribuidores['UsuarioId'] = $queryDataUsuario;
        $dataUsuariosDistribuidores['DistribuidorId'] = $participante['distribuidor'];
        $querydataUsuariosDistribuidores = $this->usuarios_registro_mp_interno_model->usuarios_participantes_interno_alta_insert_usuarioDistribuidores($dataUsuariosDistribuidores);

        $dataUsuarioTarjeta['TarjetaNumero'] = $participante['tarjeta'];
        $dataUsuarioTarjeta['UsuarioId'] = $queryDataUsuario;
        $dataUsuarioTarjeta['TarjetaEstatusId'] = 2;
        $dataUsuarioTarjeta['TarjetaUsuarioIdAsigno'] = $participante['usercaptura'];
        $dataUsuarioTarjeta['TarjetasTipoId'] = 1;
        $querydataUsuarioTarjeta = $this->usuarios_registro_mp_interno_model->usuarios_participantes_interno_alta_insert_tarjeta($dataUsuarioTarjeta);


        $nombre_participante = $participante['paterno'] . " " . $participante['materno'] . " " . $participante['nombre'] . " " . $participante['segundo_nombre'];

        $usuarios_participantes_interno_envio_correos_asesor = $this->usuarios_participantes_interno_alta_enviar_correo_registro_asesor($nombre_participante, $participante['email'],$dataUsuarioDetalles['UsuarioDetalleUsuario'], $contrasena_texto_plano);

        $this->session->set_flashdata('registro_exitoso', [
            'numero_tarjeta' => $participante['tarjeta'],
            'usuario_login' => $dataUsuarioDetalles['UsuarioDetalleUsuario'],
            'contrasena_login' => $contrasena_texto_plano // ¡Contraseña en texto plano para mostrar!
        ]);
        
        echo json_encode([
            'success' => true, 
            'message' => '¡Maestro Pintor registrado exitosamente!',
            'redirect_url' => site_url('index') 
        ]);
    }

    public function usuarios_participantes_interno_alta_validar_usuarioSesion(){
        $dataUserSesion = '';
        $max_attempts = 20; 
        $attempt = 0;

        do {
            $attempt++;
            $generatedId = md5(uniqid(rand(), TRUE));
            $dataUserSesion = trim(mb_strtoupper($generatedId, "UTF-8")); 

            if (empty($dataUserSesion)) {
                error_log("ADVERTENCIA CRÍTICA: UsuarioSessionId generado es vacío en intento " . $attempt);
                continue; 
            }
            
            $result_from_model = $this->usuarios_registro_mp_interno_model->usuarios_participantes_interno_alta_obtener_usuarioSesionId($dataUserSesion);
            
            (!empty($result_from_model)) ? $response = true : $response = false;

            if ($attempt >= $max_attempts && $response) {
                throw new Exception("No se pudo generar un UsuarioSessionId único después de " . $max_attempts . " intentos. Último ID generado: " . $dataUserSesion);
            }

        } while ($response); 
        
        return $dataUserSesion;
    }

    public function usuarios_participantes_interno_alta_enviar_correo_registro_asesor($nombre_participante, $email, $usuario, $contrasena){
        $data['nombre'] = $nombre_participante;
        $data['email'] = $email;
        $data['user'] = $usuario;
        $data['pwd'] = $contrasena;
        $mail = $this->load->view('mails\mails_usuarios\mails_usuarios_participantes\mails_usuarios_participantes_interno\mails_usuarios_participantes_interno_registro_bienvenida', $data, true);
        $to = array('to' => $data['email']);
        $status_msg = $this->base_controller_envio_correos($to,'BIENVENIDO AL CLUB DEL PINTOR', $mail, '');
        ($status_msg) ? $result = true : $result = false;
        return $result;
    }

    public function registro_exitoso_maestro_pintor() {
        $registro_data = $this->session->flashdata('registro_exitoso');

        if ($registro_data) {
            $data['numero_tarjeta'] = $registro_data['numero_tarjeta'];
            $data['usuario_login'] = $registro_data['usuario_login'];
            $data['contrasena_login'] = $registro_data['contrasena_login'];
            
            $this->load->view('inicio/inicio_view', $data); 
        } else {
            redirect('Login');
        }
    }

    // --- FUNCIÓN ORIGINAL PARA GUARDAR TICKETS/IMÁGENES GENERALES ---
    // Si esta función también debe usar la estructura de carpetas INE, asegúrate de que use el realpath
    // obtenido de base_controller_valida_crea_carpetas.
    private function ventas_registro_guardar_ine() {
        $usuario_id = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        $anio       = funciones_strategix_anio();
        $mes        = funciones_strategix_mes();
        
        $archivo_base_nombre = "/ine-".$usuario_id."-".funciones_strategix_fecha_hora_actual();
        
        // Obtener el realpath de la carpeta que ya debería haber sido creada por ventas_registro_guardar_ine_valida_carpetas
        $direccion_realpath = $this->base_controller_valida_crea_carpetas('ine/'. $anio .'/'. $mes .'/'. $usuario_id);
        
        $archivo_array = $this->base_controller_cargas_upload_archivo('txt_fotoINE', $direccion_realpath, '*', $archivo_base_nombre); // Usar $direccion_realpath
        
        if (isset($archivo_array['resultado']) && $archivo_array['resultado'] == 1) {
            $archivo_final = $archivo_array['file_name'];
            return "uploads/".'ine/'.funciones_strategix_anio().'/'. funciones_strategix_mes().'/'.$usuario_id.'/'.$archivo_final;
        } else {
            log_message('error', 'Error al subir archivo de ticket (ventas_registro_guardar_ine): ' . ($archivo_array['msg'] ?? 'Error desconocido.'));
            return null;
        }
    }

    // --- FUNCIÓN QUE VALIDA Y CREA LA ESTRUCTURA DE CARPETAS PASO A PASO ---
    private function ventas_registro_guardar_ine_valida_carpetas() {
        $usuario_id = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        $anio       = funciones_strategix_anio();
        $mes        = funciones_strategix_mes();

        $this->base_controller_valida_crea_carpetas('ine');
        $this->base_controller_valida_crea_carpetas('ine/'. $anio);
        $this->base_controller_valida_crea_carpetas('ine/'. $anio .'/'. $mes);
        $this->base_controller_valida_crea_carpetas('ine/'. $anio .'/'. $mes .'/'. $usuario_id);
    }

    public function ine_controller_valida_session_foto() {
        if ($this->session->userdata('s_ine_foto')!=""){
            if (file_exists('uploads/temporal/ine/'.$this->session->userdata('s_ine_foto'))){ unlink('uploads/temporal/ine/'.$this->session->userdata('s_ine_foto')); }
            $this->session->unset_userdata('s_ine_foto');
        }
    }

    public function usuario_registro_mp_interno_controller_qr_retorno() {
        $data['qr'] = intval($this->input->post('code_qr'));
        if ($data['qr']!=""){ 
            $datos_maestro_pintor = $this->usuario_registro_mp_interno_controller_maestro_pintor_informacion($data['qr']);
            if (empty($datos_maestro_pintor)){
                $data['resultado'] = 0;
            } else {
                $data['resultado'] = 1;
                $data['datos_maestro_pintor'] = $datos_maestro_pintor;
            }       
        }
        echo json_encode($data);
    }

    public function ine_controller_qr_modal(){
        $pag = $this->load->view('modals/usuario_registro_mp_interno/modals_ine_qr_view', '', true);
        echo json_encode($pag);   
    }

    public function ine_controller_modal_foto(){
        $modal           = $this->input->post('modal');
        $data['archivo']     = "";
        $url ="";
        switch ($modal){
            case 1: $url = 'modals/usuario_registro_mp_interno/modals_ine_foto_iphone_view'; break;
            case 2: $url = 'modals/usuario_registro_mp_interno/modals_ine_foto_android_view'; break;
        }
        $pag = $this->load->view($url,$data,TRUE);
        echo json_encode($pag);   
    }

    public function ine_controller_guarda_foto(){
        $this->ine_controller_valida_session_foto();
        $imagenCodificada = file_get_contents("php://input");
        if(strlen($imagenCodificada) <= 0) exit("NO SE RECIBIO IMAGEN, REVISE POR FAVOR");
        $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        $imagenDecodificada     = base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada   = $this->uniqueId.".png";         
        
        // Asegurar que las carpetas temporales existan de forma incremental
        $this->base_controller_valida_crea_carpetas('temporal');
        $this->base_controller_valida_crea_carpetas('temporal/ine');

        file_put_contents('uploads/temporal/ine/'.$nombreImagenGuardada, $imagenDecodificada);
        $this->session->unset_userdata('s_ine_foto');
        $this->session->set_userdata('s_ine_foto',$nombreImagenGuardada);
        echo $nombreImagenGuardada;      
    }   

    private function usuario_registro_mp_interno_controller_maestro_pintor_informacion($TarjetaId) {
        $id_dist = $this->session->userdata(funciones_strategix_sitio_alias('s_distribuidor_id'));
        $maestro_pintor = $this->usuarios_registro_mp_interno_model->usuarios_registro_mp_interno_model_maestro_pintor_informacion($id_dist,trim($TarjetaId));
        if (empty($maestro_pintor)){           
            return '';
        } else {            
            return 1;
        }       
    }

    // --- Versión mejorada de mp_registro_interno_guardar_ine_foto ---
    private function mp_registro_interno_guardar_ine_foto() {
        $usuario_id = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        $anio       = funciones_strategix_anio();
        $mes        = funciones_strategix_mes();
        $fecha_hora = funciones_strategix_fecha_hora_actual();

        $nombre_archivo_temporal = $this->session->userdata('s_ine_foto');
        if (empty($nombre_archivo_temporal)) {
            log_message('error', 'mp_registro_interno_guardar_ine_foto: No se encontró el nombre de la foto temporal en la sesión (s_ine_foto).');
            return null;
        }

        $foto_temp = 'uploads/temporal/ine/' . $nombre_archivo_temporal;

        // Obtener el realpath de la carpeta de destino.
        // Asumimos que ventas_registro_guardar_ine_valida_carpetas() ya creó esta estructura.
        $directorio_final_realpath = $this->base_controller_valida_crea_carpetas('ine/' . $anio . '/' . $mes . '/' . $usuario_id);
        
        // Definir la ruta final para el archivo (realpath y web_path)
        $foto_final_realpath = $directorio_final_realpath . "ine-" . $usuario_id . "-" . $fecha_hora . ".png";
        $foto_final_web_path = "uploads/ine/" . $anio . "/" . $mes . "/" . $usuario_id . "/ine-" . $usuario_id . "-" . $fecha_hora . ".png";


        if (file_exists($foto_temp)) {
            if (rename($foto_temp, $foto_final_realpath)) {
                $this->session->unset_userdata('s_ine_foto');
                return $foto_final_web_path;
            } else {
                log_message('error', 'mp_registro_interno_guardar_ine_foto: Error al mover el archivo de ' . $foto_temp . ' a ' . $foto_final_realpath);
                return null;
            }
        } else {
            log_message('error', 'mp_registro_interno_guardar_ine_foto: Archivo temporal no encontrado en: ' . $foto_temp);
            return null;
        }
    }

    // --- Versión mejorada de mp_registro_interno_guardar_ine_archivo ---
    private function mp_registro_interno_guardar_ine_archivo() {
        $usuario_id = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        $anio       = funciones_strategix_anio();
        $mes        = funciones_strategix_mes();

        $archivo_base_nombre = "ine-" . $usuario_id . "-" . funciones_strategix_fecha_hora_actual();

        // Obtener el realpath de la carpeta de destino.
        // Asumimos que ventas_registro_guardar_ine_valida_carpetas() ya creó esta estructura.
        $direccion_realpath = $this->base_controller_valida_crea_carpetas('ine/' . $anio . '/' . $mes . '/' . $usuario_id);

        $archivo_array = $this->base_controller_cargas_upload_archivo('txt_ine_archivo', $direccion_realpath, 'jpg|jpeg|png|pdf', $archivo_base_nombre);

        if (isset($archivo_array['resultado']) && $archivo_array['resultado'] == 1) {
            $archivo_final = $archivo_array['file_name'];
            return "uploads/" . 'ine/' . $anio . '/' . $mes . '/' . $usuario_id . '/' . $archivo_final;
        } else {
            log_message('error', 'Error al subir archivo INE (mp_registro_interno_guardar_ine_archivo): ' . ($archivo_array['msg'] ?? 'Error desconocido en la carga del archivo.'));
            return null;
        }
    }
}