<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class usuarios_registro_mp_externo_controller extends Base_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('usuarios/usuarios_registro_mp_externo/usuarios_registro_mp_externo_model');
        $this->load->library('form_validation');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }

    /*public function index(){
        $data['frm_action'] = "frm_login_view";
        $this->base_controller_create_view_login('usuarios/usuarios_registro_participante_externo/usuarios_registro_participante_externo_view',$data);
    }*/

    public function index()
{
    // si vienen remp*, reinicia tracking
    if ($this->input->get('rempfacebook') != "" || $this->input->get('rempgoogle') != "" || $this->input->get('rempweb') != "") {
        $this->session->unset_userdata('idLog');
        $this->session->unset_userdata('idLog2');
    }

    $idLog  = (string)$this->session->userdata('idLog');
    $idLog2 = (string)$this->session->userdata('idLog2');

    // 1) crear idLog SOLO si viene remp*
    if ($idLog == "" && $this->input->get('facebook') == "") {
        if ($this->input->get('rempfacebook') != "") {
            $idLog = $this->saveLogHistoryRegistro(9,  '', '');
        } else if ($this->input->get('rempgoogle') != "") {
            $idLog = $this->saveLogHistoryRegistro(10, '', '');
        } else if ($this->input->get('rempweb') != "") {
            $idLog = $this->saveLogHistoryRegistro(11, '', '');
        }

        if ($idLog != "") {
            $this->session->set_userdata('idLog', $idLog);
        }
    }

    // 2) crear idLog2 (pagina 2) y colgarlo de idLog si existe
    if ($idLog2 == "") {
        $parent = $idLog != "" ? $idLog : '';
        $idLog2 = $this->saveLogHistoryRegistro(2, '', $parent);
        $this->session->set_userdata('idLog2', $idLog2);
    }

    $data['frm_action'] = "frm_login_view";
    $this->base_controller_create_view_login('usuarios/usuarios_registro_participante_externo/usuarios_registro_participante_externo_view',$data);
}



    public function usuarios_registro_mp_externo_controller_cmb_distribuidora(){
        $data = '<option value="0">Seleccione...</option>';
        $distribuidoras = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_obtener_distribuidora();
        foreach ($distribuidoras as $distribuidora) {
            $data .= '<option value="' . $distribuidora->DistribuidorId . '">' . utf8_encode($distribuidora->DistribuidorDetalleEstado) . ' - ' . utf8_encode($distribuidora->DistribuidorDetalleNombreComercial) . '</option>';
        }
        echo json_encode($data);
    }

    public function usuarios_registro_mp_externo_controller_cmb_telefonias(){
        $data = '<option value="0">Seleccione...</option>';
        $companias = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_obtener_companias_telefonicas();
        foreach ($companias as $compania) {
            $data .= '<option value="' . $compania->CompaniaCelularId . '">' . utf8_encode($compania->CompaniaCelularNombre) . '</option>';
        }

        echo json_encode($data);
    }

    public function usuarios_registro_mp_externo_controller_valida_cp(){
        $cp = $_POST['cp'];
        $datos = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_obtener_datos_cp($cp);

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
            // Si no se encontraron resultados
            $respuesta = array(
                "estado" => "",
                "ciudad" => "",
                "municipio" => "",
                "colonias" => []
            );
        }

        echo json_encode($respuesta);
    }

   public function usuarios_participantes_externo_alta_obtener_datos_distribuidora(){
        $idd = $_POST['idd'];
        $datos = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_obtener_datos_distribuidora($idd);
        $resultado = (array) $datos[0];
        foreach ($resultado as $key => $value) {
            if (is_string($value) && !mb_check_encoding($value, 'UTF-8')) {
                $resultado[$key] = utf8_encode($value);
            }
        }
        echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
    }

    public function usuarios_participantes_externo_alta_validar_formulario(){
        $config = array(
            array(
                'field' => 'txt_nombre',
                'label' => $this->lang->line('usuarios_participantes_externo_controller_lang_campo_nombre'),
                'rules' => 'required|min_length[1]|max_length[100]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ]*$/u]'
            ),
            array(
                'field' => 'txt_segundonombre',
                'label' => $this->lang->line('usuarios_participantes_externo_controller_lang_campo_segundo_nombre'),
                'rules' => 'max_length[100]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ]*$/u]'
            ),
            array(
                'field' => 'txt_apellidopaterno',
                'label' => $this->lang->line('usuarios_participantes_externo_controller_lang_campo_aPaterno'),
                'rules' => 'required|min_length[1]|max_length[50]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ]*$/u]'
            ),
            array(
                'field' => 'txt_apellidomaterno',
                'label' => $this->lang->line('usuarios_participantes_externo_controller_lang_campo_aMaterno'),
                'rules' => 'required|min_length[1]|max_length[50]|regex_match[/^[a-zA-ZÑÁÉÍÓÚÜñáéíóú ]*$/u]'
            ),
            array(
                'field' => 'txt_celular',
                'label' => $this->lang->line('usuarios_participantes_externo_controller_lang_campo_celular'),
                'rules' => 'required|numeric|exact_length[10]|callback_usuarios_participantes_externo_alta_validar_celular',
                'errors' => [
                    'required' => 'El campo Celular es obligatorio.', 
                    'usuarios_participantes_externo_alta_validar_celular' => 'El teléfono ya se encuentra registrado',
                    'numeric' => 'El campo Celular debe contener solo números.',
                    'exact_length' => 'El campo Celular debe tener exactamente 10 dígitos.'
                ],
            ),
            array(
                'field' => 'cmb_compania',
                'label' => $this->lang->line('usuarios_registro_maestro_pintor_tooltips_compañia'),
                'rules' => '',
                'errors' => [
                    'is_natural_no_zero' => 'Por favor, selecciona una compañía telefónica válida.',
                ],
            ),
            array(
                'field' => 'txt_email',
                'label' => $this->lang->line('usuarios_participantes_externo_controller_lang_campo_email'),
                'rules' => 'valid_email|min_length[10]|max_length[50]|callback_usuarios_participantes_externo_alta_validar_formato_email|callback_usuarios_participantes_externo_alta_validar_email',
                'errors' => [
                    'usuarios_participantes_externo_alta_validar_formato_email' => 'FORMATO DE EMAIL INVÁLIDO',
                    'usuarios_participantes_externo_alta_validar_email' => 'EMAIL YA ESTÁ REGISTRADO',
                ],
            ),
            array(
                'field' => 'txt_calle',
                'label' => $this->lang->line('usuarios_registro_maestro_pintor_tooltips_calle'),
                'rules' => 'required|min_length[1]|max_length[50]'
            ),
            array(
                'field' => 'txt_cp',
                'label' => $this->lang->line('usuarios_registro_maestro_pintor_tooltips_cp'),
                'rules' => 'required|numeric|min_length[4]|max_length[5]'
            ),
            array(
                'field' => 'txt_estado',
                'label' => $this->lang->line('usuarios_registro_maestro_pintor_tooltips_estado'),
                'rules' => 'required|min_length[1]|max_length[50]'
            ),
            array(
                'field' => 'txt_ciudad',
                'label' => $this->lang->line('usuarios_registro_maestro_pintor_tooltips_ciudad'),
                'rules' => 'required|min_length[1]|max_length[50]'
            ),
            array(
                'field' => 'txt_municipio',
                'label' => $this->lang->line('usuarios_registro_maestro_pintor_tooltips_municipio'),
                'rules' => 'required|min_length[1]|max_length[50]'
            ),
            array(
                'field' => 'txt_colonia',
                'label' => $this->lang->line('usuarios_registro_maestro_pintor_tooltips_colonia'),
                'rules' => 'required'
            ),
            array(
                'field' => 'txt_noext',
                'label' => $this->lang->line('usuarios_registro_maestro_pintor_tooltips_noext'),
                'rules' => 'required|min_length[1]|max_length[50]'
            ),
            array(
                'field' => 'txt_noint',
                'label' => $this->lang->line('usuarios_registro_maestro_pintor_tooltips_noint'),
                'rules' => 'max_length[50]'
            ),
            array(
                'field' => 'txt_distribuidor',
                'label' => $this->lang->line('usuarios_participantes_externo_controller_lang_form_label_distribuidora'),
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Debes seleccionar un distribuidor.',
                    'is_natural_no_zero' => 'Debes seleccionar un distribuidor.',
                ],
            ),
        );

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

    public function usuarios_participantes_externo_alta_validar_formato_email($email){
        if (empty($email)) {
            return TRUE;
        }
        return funciones_strategix_validar_formato_email($email);
    }

    public function usuarios_participantes_externo_alta_validar_email($email){
            $model_count = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_validar_email($email);
            return ($model_count == 0); 
    }

    public function usuarios_participantes_externo_alta_validar_celular($txt_celular){
        $model_count = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_validar_celular($txt_celular);
        return ($model_count == 0); 
    }

    public function usuarios_participantes_externo_alta_registro(){
        $usuarios_registro_maestro_pintor_view_chk_whatsapp = $this->input->post('usuarios_registro_maestro_pintor_view_chk_whatsapp',true);
        $usuarios_registro_maestro_pintor_view_chk_email = $this->input->post('usuarios_registro_maestro_pintor_view_chk_email',true);        
        $participante['nombre'] = trim(mb_strtoupper($this->input->post('txt_nombre', true)));
        $participante['segundo_nombre'] = trim(mb_strtoupper($this->input->post('txt_segundonombre', true)));
        $participante['paterno'] = trim(mb_strtoupper($this->input->post('txt_apellidopaterno', true)));
        $participante['materno'] = trim(mb_strtoupper($this->input->post('txt_apellidomaterno', true)));
        $participante['celular'] = trim($this->input->post('txt_celular', true));
        $participante['compania'] = trim(mb_strtoupper($this->input->post('cmb_compania', true)));
        $participante['email'] = trim($this->input->post('txt_email', true));
        $participante['perfil'] = 9;
        $participante['calle'] = trim(mb_strtoupper($this->input->post('txt_calle', true)));
        $participante['cp'] = trim($this->input->post('txt_cp', true));
        $participante['estado'] = trim(mb_strtoupper($this->input->post('txt_estado', true)));
        $participante['ciudad'] = trim(mb_strtoupper($this->input->post('txt_ciudad', true)));
        $participante['municipio'] = trim(mb_strtoupper($this->input->post('txt_municipio', true)));
        $participante['colonia'] = trim(mb_strtoupper($this->input->post('txt_colonia', true)));
        $participante['noext'] = trim($this->input->post('txt_noext', true));
        $participante['noint'] = trim($this->input->post('txt_noint', true));
        $participante['distribuidor'] = trim($this->input->post('txt_distribuidor', true));

        $dataUsuario['UsuarioCapturaId'] = 1;
        $dataUsuario['UsuarioTipoRegistroId'] = 2;
        $dataUsuario['PerfilId'] = $participante['perfil'];
        $dataUsuario['UsuarioSessionId'] = trim(mb_strtoupper($this->usuarios_participantes_externo_alta_validar_usuarioSesion(), "UTF-8"));        
       
        $queryDataUsuario = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_insert_usuario($dataUsuario);

        $this->session->set_userdata('UsuarioId', (int)$queryDataUsuario);
        $this->session->set_userdata('DistribuidorId', (int)$participante['distribuidor']);

        //Igual que MySQL: al final amarra el UsuarioId al log idLog2
        $logId2 = (int)$this->session->userdata('idLog2');
        if ($logId2 > 0) {
            $this->db->query(
                "UPDATE dbo.LogRegistros SET UsuarioId = ? WHERE LogRegistroID = ?",
                array((int)$queryDataUsuario, $logId2)
            );
        }

        $parent = (int)($this->session->userdata('idLog') ?: $this->session->userdata('idLog2'));

        if ((string)$this->session->userdata('idLog3') === "") {
            $idLog3 = $this->saveLogHistoryRegistro(3, (int)$queryDataUsuario, $parent);
            $this->session->set_userdata('idLog3', $idLog3);
        }

        if ((string)$this->session->userdata('idLog4') === "") {
            $idLog4 = $this->saveLogHistoryRegistro(4, (int)$queryDataUsuario, $parent);
            $this->session->set_userdata('idLog4', $idLog4);
        }
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
        $dataUsuarioDetalles['UsuarioDetalleCalle'] = utf8_decode($participante['calle']);
        $dataUsuarioDetalles['UsuarioDetalleExterior'] = $participante['noext'];
        $dataUsuarioDetalles['UsuarioDetalleInterior'] = $participante['noint'];
        $dataUsuarioDetalles['UsuarioDetalleIdRegistro'] = 1;
        $dataUsuarioDetalles['UsuarioDetalleObservaciones'] = "REGISTRO EXTERNO";
        $dataUsuarioDetalles['UsuarioDetalleSessionId'] = trim(mb_strtoupper($this->usuarios_participantes_externo_alta_validar_usuarioSesion(), "UTF-8"));  
        $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_insert_usuarioDetalle($dataUsuarioDetalles);
        
        $dataUsuariosDistribuidores['UsuarioId'] = $queryDataUsuario;
        $dataUsuariosDistribuidores['DistribuidorId'] = $participante['distribuidor'];
        $querydataUsuariosDistribuidores = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_insert_usuarioDistribuidores($dataUsuariosDistribuidores);

        $tarjeta = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_obtener_siguiente_tarjeta_numero();

        $dataUsuarioTarjeta['TarjetaNumero'] = $tarjeta;
        $dataUsuarioTarjeta['DistribuidorId'] = $participante['distribuidor'];
        $dataUsuarioTarjeta['UsuarioId'] = $queryDataUsuario;
        $dataUsuarioTarjeta['TarjetaEstatusId'] = 2;
        $dataUsuarioTarjeta['TarjetaUsuarioIdCaptura'] = 1;
        $dataUsuarioTarjeta['TarjetasTipoId'] = 2;
        $dataUsuarioTarjeta['Observaciones'] = "TARJETA GENERADA POR REGISTRO EXTERNO";
        $querydataUsuarioTarjeta = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_insert_tarjeta($dataUsuarioTarjeta);
        $nombre_participante = $participante['paterno'] . " " . $participante['materno'] . " " . $participante['nombre'] . " " . $participante['segundo_nombre'];


        if ($usuarios_registro_maestro_pintor_view_chk_whatsapp==1){
            $celular = $this->input->post('txt_celular',TRUE);
            $nombre = $this->input->post('txt_nombre',TRUE)." ".$this->input->post('txt_segundo_nombre',TRUE)." ".$this->input->post('txt_apellido_paterno',TRUE)." ".$this->input->post('txt_apellidomaterno',TRUE);
                    $res_curl =   $this->infobip_library->infobip_library_send_whatsapp(8,"+52".$this->input->post('txt_celular', true),'contrasena_bienvenida','"'.$nombre.'","'.$dataUsuarioDetalles['UsuarioDetalleUsuario'].'"','es',$this->uniqueId);
                         if($res_curl['messages'][0]['status']['groupId'] != 1)
                            {
                             $valuemp['estatus'] = 2;
                              $valuemp['res_text']= $res_curl['messages'][0]['status']['name'] .' - '. $res_curl['messages'][0]['status']['description'];
                                return $valuemp;
                            }
        }else{
                 $usuarios_participantes_externo_envio_correos_asesor = $this->usuarios_participantes_externo_alta_enviar_correo_registro_asesor($nombre_participante, $participante['email'],$tarjeta,$dataUsuarioDetalles['UsuarioDetalleUsuario'],$contrasena_texto_plano);
             }       
        
        echo json_encode([
            'status' => 1,
            'tarjeta' => $tarjeta,
            'usuario' => $dataUsuarioDetalles['UsuarioDetalleUsuario'],
            'contrasena' => $contrasena_texto_plano
        ]);

    }

   

    public function registro_exitoso_maestro_pintor()
    {
        $usuarioId = (int)$this->session->userdata('UsuarioId');
        if ($usuarioId <= 0) {
            redirect(base_url("Login"));
            return;
        }

        $parent = (int)($this->session->userdata('idLog') ?: $this->session->userdata('idLog2'));

        // Paso 3 (tarjeta)
        if ((string)$this->session->userdata('idLog3') === "") {
            $idLog3 = $this->saveLogHistoryRegistro(3, $usuarioId, $parent);
            $this->session->set_userdata('idLog3', $idLog3);
        }

        // Paso 4 (credenciales)
        if ((string)$this->session->userdata('idLog4') === "") {
            $idLog4 = $this->saveLogHistoryRegistro(4, $usuarioId, $parent);
            $this->session->set_userdata('idLog4', $idLog4);
        }

        $data = $this->session->flashdata('registro_exitoso_data') ?: [];
        $this->load->view('usuarios/usuarios_registro_participante_externo/usuarios_registro_participante_externo_datosregistro_view', $data);
    }

    public function usuarios_participantes_externo_alta_validar_usuarioSesion()
    {
        $dataUserSesion = '';
        $max_attempts = 20; // Aumentar un poco los intentos de seguridad, aunque no deberían ser necesarios.
        $attempt = 0;

        do {
            $attempt++;
            // Genera un *nuevo* ID único en CADA intento del bucle.
            // Añadimos una verificación para asegurarnos que el ID generado no sea vacío.
            $generatedId = md5(uniqid(rand(), TRUE));
            $dataUserSesion = trim(mb_strtoupper($generatedId, "UTF-8")); // Aplica trim y mayúsculas

            // **Añade una verificación de seguridad aquí:**
            if (empty($dataUserSesion)) {
                // Si por alguna razón extraña se genera un ID vacío, regenerar y registrar.
                // Esto NO DEBERÍA OCURRIR con md5(uniqid()), pero es una defensa.
                error_log("ADVERTENCIA CRÍTICA: UsuarioSessionId generado es vacío en intento " . $attempt);
                continue; // Saltar al siguiente intento
            }
            
            // Llama al modelo para verificar si este *nuevo* ID ya existe.
            $result_from_model = $this->usuarios_registro_mp_externo_model->usuarios_participantes_externo_alta_obtener_usuarioSesionId($dataUserSesion);
            
            // Si $result_from_model no está vacío, significa que el ID ya existe, y $response será true.
            (!empty($result_from_model)) ? $response = true : $response = false;

            // Si se excede el número máximo de intentos, salimos para evitar un bucle infinito
            if ($attempt >= $max_attempts && $response) {
                // Manejar un error crítico aquí
                throw new Exception("No se pudo generar un UsuarioSessionId único después de " . $max_attempts . " intentos. Último ID generado: " . $dataUserSesion);
            }

        } while ($response); 
        
        return $dataUserSesion;
    }

    public function usuarios_participantes_externo_alta_enviar_correo_registro_asesor($nombre_participante, $email,$tarjeta,$user,$pwd)
    {
        $data['nombre'] = $nombre_participante;
        $data['email'] = $email;
        $data['tarjeta'] = $tarjeta;
        $data['user'] = $user;
        $data['pwd'] = $pwd;
        $mail = $this->load->view('mails\mails_usuarios\mails_usuarios_participantes\mails_usuarios_participantes_externo\mails_usuarios_participantes_interno_registro_bienvenida', $data, true);
        $to = array('to' => $data['email']);
        $status_msg = $this->base_controller_envio_correos($to,'BIENVENIDO AL CLUB DEL PINTOR', $mail, '');
        ($status_msg) ? $result = true : $result = false;
        return $result;
    }

    public function usuarios_registro_mp_externo_controller_aceptar_registro()
    {
        $usuarioId = (int)$this->session->userdata('UsuarioId');
        if ($usuarioId <= 0) {
            echo json_encode(['status' => 0]);
            return;
        }

        $parent = (int)($this->session->userdata('idLog') ?: $this->session->userdata('idLog2'));

        if ((string)$this->session->userdata('idLog5') === "") {
            $idLog5 = $this->saveLogHistoryRegistro(5, $usuarioId, $parent);
            $this->session->set_userdata('idLog5', $idLog5);
        }

        echo json_encode(['status' => 1]);
    }

}