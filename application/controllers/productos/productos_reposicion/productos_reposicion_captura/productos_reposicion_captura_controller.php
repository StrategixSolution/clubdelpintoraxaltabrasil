<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_reposicion_captura_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        control_modulos();
        $this->load->model('productos/productos_reposicion/productos_reposicion_captura_model');
    }    
    public function index(){//Pagina de Inicio    
        switch (date('n')) {
            case 1:
            case 2:
                $anio = date('Y')-1;                 
                break;
            default:
                $anio = date('Y');         
        };
      //print_r(date('n'));die;
        $data['anio'] = $anio;
        $data['premio'] = '';
        $data['total'] = '';
        $this->base_controller_create_view_sistema('productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_view_form',$data,true);
    }

      public function productos_reposicion_captura_controller_cmb_distribuidor() {  
        $cmb_dist ="";
        $distribuidor =  $this->productos_reposicion_captura_model->productos_reposicion_captura_model_distribuidor($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))); 
        foreach ($distribuidor as $dist) {      
            if($dist->DistribuidorDetalleNombreComercial!=NULL){
                $nombre = utf8_encode($dist->DistribuidorDetalleNombreComercial);
            } else {
                $nombre = utf8_encode($dist->DistribuidorDetalleRazonSocial);
            }
            $cmb_dist .="<option value=$dist->DistribuidorId>$nombre</option>";
        }
        echo json_encode($cmb_dist);
    }
    public function productos_reposicion_captura_controller_cmb_mes() {   
        switch (date('n')) {
            case 1:
            case 2:
                $anio = date('Y')-1;   
                $mes = 12;               
                break;
            case 3:
            case 4:
                $anio = date('Y');   
                $mes = 2;               
                break;
            case 5:
            case 6:
                $anio = date('Y');   
                $mes = 4;               
                break;
            case 7:
            case 8:
                $anio = date('Y');   
                $mes = 6;               
                break; 
            case 9:
            case 10:
                $anio = date('Y');   
                $mes = 8;               
                break;   
            case 11:
            case 12:
                $anio = date('Y');   
                $mes = 10;               
                break;            
        };
        $cmb_Mes ="<option  value='0'>".$this->lang->line('productos_reposicion_captura_controller_lang_placeholder_mes')."</option>";
        $meses  = $this->productos_reposicion_captura_model->productos_reposicion_captura_model_cmbmes($anio,$mes);
        foreach ($meses as $mes) {            
            $bimestre = $mes->mes;
            $mesanterior = $bimestre-1;
            $cmb_Mes .="<option value=$mes->mes>".strtoupper(funciones_strategix_mes_numero_texto($mesanterior)).' - '.strtoupper(funciones_strategix_mes_numero_texto($bimestre))."</option>";
        }
        echo json_encode($cmb_Mes);
    }
    public function productos_reposicion_captura_controller_cmb_participantes (){  
        switch (date('n')) {
            case 1:
            case 2:
                $anio = date('Y')-1;                 
                break;
            default:
                $anio = date('Y');         
        };
       // $distribuidor =  $this->productos_reposicion_captura_model->productos_reposicion_captura_model_distribuidor($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))); 
        $participante 	= $this->productos_reposicion_captura_model->productos_reposicion_captura_model_cmb_participantes($this->input->post("mes"),$anio,$this->input->post("cmb_distribuidor"));
        $cmbParticipante ="<option  value='0'>".$this->lang->line('productos_reposicion_captura_controller_lang_placeholder_participante')."</option>";      
        foreach ($participante as $par) { 
            $nombre = " LUGAR: ".$par->ReposicionProductoGanadorPremioLugar." - ".utf8_encode($par->UsuarioDetalleNombre);
            $cmbParticipante .= "<option value=$par->ReposicionProductoGanadorId>$nombre</option>";                      
        }
        echo json_encode($cmbParticipante);
    }

     public function productos_reposicion_captura_controller_fecha_inicio (){  
        switch (date('n')) {
            case 1:
            case 2:
                $anio = date('Y')-1;                 
                break;
            default:
                $anio = date('Y');         
        };
        $fecha_inicio 	= $this->productos_reposicion_captura_model->productos_reposicion_captura_model_fecha_inicio($this->input->post("mes"),$anio,$this->input->post("cmb_distribuidor"));
        echo json_encode($fecha_inicio);

    }
    public function productos_reposicion_captura_controller_cmb_premio (){
        $ganadorId = $this->input->post("cmb_participantes",TRUE);
        switch (date('n')) {
            case 1:
            case 2:
                $anio = date('Y')-1;                 
                break;
            default:
                $anio = date('Y');         
        };
        $ganador =  $this->productos_reposicion_captura_model->productos_reposicion_captura_model_ganador_lugar($ganadorId);
        if ($ganador->ReposicionProductoGanadorFechaEntregaTienda!=NULL){
            $cmbPremio['res'] = 0;
            $DescripcionPremios =  $this->productos_reposicion_captura_model->productos_reposicion_captura_model_premio_descripcion($ganador->ReposicionProductoPremioProductoId);
            $cmbPremio['lista'] ="<option value=''>".utf8_encode($DescripcionPremios)."</option>";      
            $cmbPremio['fecha'] = $ganador->ReposicionProductoGanadorFechaEntregaTienda;   
        } else {
            $cmbPremio['res'] = 1;
            $premio 	= $this->productos_reposicion_captura_model->productos_reposicion_captura_model_cmb_premio($this->input->post("cmb_mes"),$anio,$ganador->ReposicionProductoGanadorPremioLugar);
            $cmbPremio['lista'] ="<option value='0'>".$this->lang->line('productos_reposicion_captura_controller_lang_placeholder_premio')."</option>";
            foreach ($premio as $row) { 
                $premio = $row->ReposicionProductoPremioProductoDescripcion;//." - ".utf8_encode($row->ReposicionProductoPremioProductoGMS)." - ".utf8_encode($row->ReposicionProductoPremioProductoCodigo);
                $cmbPremio['lista'] .= "<option value=$row->ReposicionProductoPremioProductoId>".utf8_encode($premio)."</option>";              
            }
        }
        echo json_encode($cmbPremio);
    }   
    public function productos_reposicion_captura_controller_form_validate() {   
        switch (date('n')) {
            case 1:
            case 2:
                $Anio = date('Y')-1;                 
                break;
            default:
                 $Anio = date('Y');         
        };
        $this->productos_reposicion_captura_controller_set_rules();
        $res_errors = $this->productos_reposicion_captura_controller_form_error();
        if ($res_errors==1){         
            $this->productos_reposicion_captura_model->productos_reposicion_captura_model_ganador(1,$this->input->post('fecha_entrega',TRUE),$this->input->post('cmb_participantes',TRUE),$this->input->post('cmb_premio',TRUE),$this->input->post('cmb_distribuidor',TRUE));
            echo json_encode(1);
        }else{       
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }     
    }
    private function productos_reposicion_captura_controller_set_rules() {
        $this->form_validation->set_rules('cmb_distribuidor', $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_distribuidor'), 'required|callback_productos_reposicion_captura_controller_valida_combo_distribuidor');
        $this->form_validation->set_rules('cmb_participantes', $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_participante'), 'required|callback_productos_reposicion_captura_controller_valida_combo_participante');
        $this->form_validation->set_rules('cmb_mes', $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_mes'), 'required|callback_productos_reposicion_captura_controller_valida_combo_mes');
        $this->form_validation->set_rules('cmb_premio', $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_premio'), 'required|callback_productos_reposicion_captura_controller_valida_combo_premio');
        $this->form_validation->set_rules('fecha_entrega', $this->lang->line('productos_reposicion_captura_controller_lang_form_validate_fecha_entrega'), 'required|xss_clean');
    }
    private function productos_reposicion_captura_controller_form_error() {
        $json = $json_cmbmes = $json_cmbparticipantes = $json_cmbpremio = $json_fechaentrega = array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('cmb_participantes'))) { $json_cmbparticipantes =  array('cmb_participantes' => form_error('cmb_participantes', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_mes'))) { $json_cmbmes =  array('cmb_mes' => form_error('cmb_mes', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_premio'))) { $json_cmbpremio =  array('cmb_premio' => form_error('cmb_premio', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('fecha_entrega'))) { $json_fechaentrega =  array('fecha_entrega' => form_error('fecha_entrega', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_cmbmes , $json_cmbparticipantes , $json_cmbpremio , $json_fechaentrega);
            return $json;
        } else {             
            return 1; 
        }                
    }  

    public function productos_reposicion_captura_controller_valida_combo_distribuidor($post_string){
        if ($post_string==0){ $this->form_validation->set_message('productos_reposicion_captura_controller_valida_combo_distribuidor', $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_distribuidor')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function productos_reposicion_captura_controller_valida_combo_participante($post_string){
        if ($post_string==0){ $this->form_validation->set_message('productos_reposicion_captura_controller_valida_combo_participante', $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_participante')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function productos_reposicion_captura_controller_valida_combo_mes($post_string){
        if ($post_string==0){ $this->form_validation->set_message('productos_reposicion_captura_controller_valida_combo_mes', $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_mes')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function productos_reposicion_captura_controller_valida_combo_premio($post_string){
        if ($post_string==0){ $this->form_validation->set_message('productos_reposicion_captura_controller_valida_combo_premio', $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_premio')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function productos_reposicion_captura_controller_cargas_upload_archivo_fisico(){ 
        $anio = ($this->input->post('anio_foto'));
        $mes = ($this->input->post('mes_foto'));
        $id_dist = ($this->input->post('id_dist'));
       // $distribuidor =  $this->productos_reposicion_captura_model->productos_reposicion_captura_model_distribuidor($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))); 
        $this->base_controller_valida_crea_carpetas('reposicion_productos_captura');
        $this->base_controller_valida_crea_carpetas('reposicion_productos_captura/'.$anio);
        $this->base_controller_valida_crea_carpetas('reposicion_productos_captura/'.$anio.'/'.$mes);
        $this->base_controller_valida_crea_carpetas('reposicion_productos_captura/'.$anio.'/'.$mes.'/'.$id_dist);
        $direccion_documentos = $this->base_controller_valida_crea_carpetas('reposicion_productos_captura/'.$anio.'/'.$mes.'/'.$id_dist);
        $file_reposicionCaptura      = funciones_strategix_fecha_hora_actual()."-".$id_dist."-reposicion_productos";
        $resultado_carga = $this->base_controller_cargas_upload_archivo('file', $direccion_documentos, '*', $file_reposicionCaptura);
       // $distribuidor =  $this->productos_reposicion_captura_model->productos_reposicion_captura_model_distribuidor($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))); 
        $distname = $id_dist;
        $tipo = ($this->input->post('check_tipo',TRUE)==1)?1:2;        
        $datos = "'".$anio."','".$mes."','".$_FILES['file']['name']."','".$resultado_carga['file_name']."','".$tipo."','".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."','".$resultado_carga['ext']."','".$distname."'";
        $this->productos_reposicion_captura_model->productos_reposicion_captura_model_datos_foto($datos);
        if($resultado_carga['resultado']==0){echo json_encode(2);return;}       
    }
    
}