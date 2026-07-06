<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Distribuidores_modificacion_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('distribuidores/distribuidores_modificacion/distribuidores_modificacion_model');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }    
    public function index(){//Pagina de Inicio
        $distribuidor_encode = md5('IDDIS'.funciones_strategix_formato_fecha_actual());
        $data['DistribuidorId'] =$this->input->get($distribuidor_encode,true);
        $this->base_controller_create_view_sistema('distribuidores/distribuidores_modificacion/distribuidores_modificacion_view',$data);
    }
    public function distribuidores_modificacion_controller_datos() {
        $row = $this->distribuidores_modificacion_model->distribuidores_modificacion_model_row($this->input->post('DistribuidorId',true)); $datos = array();
        $datos['DistribuidorId'] = $row['DistribuidorId'];
        $datos['DistribuidorDetalleId'] = $row['DistribuidorDetalleId']; 
        $datos['DistribuidorDetalleCodigo'] = utf8_encode(strtoupper($row['DistribuidorDetalleCodigo'])); 
        $datos['DistribuidorDetalleRazonSocial'] = utf8_encode(strtoupper($row['DistribuidorDetalleRazonSocial']));
        $datos['DistribuidorDetalleNombreComercial'] = utf8_encode(strtoupper($row['DistribuidorDetalleNombreComercial'])); 
        $datos['DistribuidorDetalleCP'] = $row['DistribuidorDetalleCP']; 
        $datos['DistribuidorDetalleEstado'] = utf8_encode(strtoupper($row['DistribuidorDetalleEstado'])); 
        $datos['DistribuidorDetalleCiudad'] = utf8_encode(strtoupper($row['DistribuidorDetalleCiudad']));
        $datos['DistribuidorDetalleMunicipio'] = utf8_encode(strtoupper($row['DistribuidorDetalleMunicipio']));
        $datos['DistribuidorDetalleCalle'] = utf8_encode(strtoupper($row['DistribuidorDetalleCalle']));
        $datos['DistribuidorDetalleRFC'] = utf8_encode(strtoupper($row['DistribuidorDetalleRFC']));
        $datos['DistribuidorDetalleTelefono'] = $row['DistribuidorDetalleTelefono']; 
        $datos['DistribuidorDetalleRegionId'] = $row['DistribuidorDetalleRegionId'];
        $datos['DistribuidorDetalleRegionNombre'] = utf8_encode(strtoupper($row['DistribuidorDetalleRegionNombre']));     
        echo json_encode($datos);
    }
    public function distribuidores_modificacion_controller_combo_lista_regiones() {
        $combo_regiones = "<option value='0'>".$this->lang->line('distribuidores_modificacion_controller_lang_combo_selecciona_regiones')."</option>";
        $regiones         = $this->distribuidores_modificacion_model->distribuidores_modificacion_model_combo_regiones();
        foreach ($regiones as $region) { $combo_regiones   .='<option value="'.$region->DistribuidorDetalleRegionId.'">'.utf8_encode(strtoupper($region->DistribuidorDetalleRegionNombre)).'</option>'; } 
        echo json_encode($combo_regiones);
    }
    public function distribuidores_modificacion_controller_valida_guarda_distribuidor() {
        $this->distribuidores_modificacion_controller_valida_distribuidor_set_rules();
        $res_errors = $this->distribuidores_modificacion_controller_valida_distribuidor_form_error();
        if ($res_errors==1){                    
            echo json_encode($this->distribuidores_modificacion_controller_guardar());
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }        
    }
    private function distribuidores_modificacion_controller_valida_distribuidor_set_rules() {
        $this->form_validation->set_rules('txt_razon_social', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_razon_social'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_nombre_comercial', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_nombre_comercial'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_codigo_distribuidor', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_codigo_distribuidor'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_codigo_postal', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_codigo_postal'), 'xss_clean');
        $this->form_validation->set_rules('txt_estado', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_estado'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_municipio', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_municipio'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_ciudad', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_ciudad'), 'xss_clean');
        $this->form_validation->set_rules('txt_calle', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_calle'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_rfc', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_rfc'), 'min_length[4]|max_length[25]|xss_clean');
        $this->form_validation->set_rules('txt_telefono', $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_telefono'), 'required|min_length[8]|max_length[15]|xss_clean');
        $this->form_validation->set_rules('cmb_regiones', $this->lang->line('distribuidores_modificacion_controller_lang_combo_etiqueta_regiones'), 'required|callback_distribuidores_modificacion_controller_valida_combo_region');
    }
    private function distribuidores_modificacion_controller_valida_distribuidor_form_error() {
       $json_txt_razon_social = $json_txt_razon_social = $json_txt_nombre_comercial = $json_txt_codigo_distribuidor = $json_txt_codigo_postal = $json_txt_estado = $json_txt_municipio = $json_txt_colonia = $json_txt_calle = $json_txt_rfc = $json_txt_telefono = $json_txt_telefono = $json_txt_longitud =  $json_txt_longitud = $json_txt_latitud = $json_cmb_regiones =array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('txt_razon_social'))) { $json_txt_razon_social =  array('txt_razon_social' => form_error('txt_razon_social', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_nombre_comercial'))) { $json_txt_nombre_comercial =  array('txt_nombre_comercial' => form_error('txt_nombre_comercial', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_codigo_distribuidor'))) { $json_txt_codigo_distribuidor =  array('txt_codigo_distribuidor' => form_error('txt_codigo_distribuidor', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_codigo_postal'))) { $json_txt_codigo_postal =  array('txt_codigo_postal' => form_error('txt_codigo_postal', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_estado'))) { $json_txt_estado =  array('txt_estado' => form_error('txt_estado', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_municipio'))) { $json_txt_municipio =  array('txt_municipio' => form_error('txt_municipio', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_ciudad'))) { $json_txt_colonia =  array('txt_ciudad' => form_error('txt_ciudad', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_calle'))) { $json_txt_calle =  array('txt_calle' => form_error('txt_calle', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rfc'))) { $json_txt_rfc =  array('txt_rfc' => form_error('txt_rfc', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_telefono'))) { $json_txt_telefono =  array('txt_telefono' => form_error('txt_telefono', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_longitud'))) { $json_txt_longitud =  array('txt_longitud' => form_error('txt_longitud', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_latitud'))) { $json_txt_latitud =  array('txt_latitud' => form_error('txt_latitud', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_regiones'))) { $json_cmb_regiones =  array('cmb_regiones' => form_error('cmb_regiones', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_txt_razon_social,$json_txt_nombre_comercial,$json_txt_codigo_distribuidor,$json_txt_codigo_postal,$json_txt_estado,$json_txt_municipio,$json_txt_colonia,$json_txt_calle,$json_txt_rfc,$json_txt_telefono,$json_txt_longitud,$json_txt_latitud,$json_cmb_regiones);
            return $json;
        } else {             
            return 1; 
        }                
    }
   
    public function distribuidores_modificacion_controller_valida_combo_segmento($post_string){
        if ($post_string==0){ $this->form_validation->set_message('distribuidores_modificacion_controller_valida_combo_segmento', $this->lang->line('distribuidores_modificacion_controller_lang_combo_selecciona_segmento')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function distribuidores_modificacion_controller_valida_combo_region($post_string){
        if ($post_string==0){ $this->form_validation->set_message('distribuidores_modificacion_controller_valida_combo_region', $this->lang->line('distribuidores_modificacion_controller_lang_combo_selecciona_regiones')); $response = FALSE; } else { $response = TRUE; }return $response;
    }    
    public function distribuidores_modificacion_controller_guardar() {
       $where = "DistribuidorId=".$this->input->post('DistribuidorId',TRUE);
      //  $txt_rfc_trim           = trim($this->input->post('txt_rfc',TRUE)); $txt_rfc_utf8_decode = utf8_decode($txt_rfc_trim); $txt_rfc = strtoupper($txt_rfc_utf8_decode);
                                                 //DistribuidorId,DistribuidorDetalleCodigo,                                      DistribuidorDetalleRazonSocial,                                           DistribuidorDetalleNombreComercial,                                             DistribuidorDetalleCP,                                              DistribuidorDetalleEstado,                                                DistribuidorDetalleCiudad,                                                      DistribuidorDetalleMunicipio,                                                 DistribuidorDetalleCalle,       DistribuidorDetalleRFC,         DistribuidorDetalleTelefono,                                                DistribuidorDetalleUsuarioIdCapturo,                    DistribuidorDetalleRegionId
       // $dataDetalle            =  .utf8_decode(strtoupper(trim($this->input->post('txt_estado',TRUE))))."','".utf8_decode(strtoupper(trim($this->input->post('txt_ciudad',TRUE))))."','".utf8_decode(strtoupper(trim($this->input->post('txt_municipio',TRUE))))."','".utf8_decode(strtoupper(trim($this->input->post('txt_calle',TRUE))))."','".$txt_rfc."','".trim($this->input->post('txt_telefono',TRUE))."','".$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))."',".trim($this->input->post('cmb_regiones',TRUE));
        $dataDetalle            = "DistribuidorDetalleCodigo=".trim($this->input->post('txt_codigo_distribuidor',TRUE)).",".
        "DistribuidorDetalleRazonSocial='". utf8_decode(strtoupper(trim($this->input->post('txt_razon_social',TRUE))))."',". 
        "DistribuidorDetalleNombreComercial='". utf8_decode(strtoupper(trim($this->input->post('txt_nombre_comercial',TRUE))))."',". 
       "DistribuidorDetalleCP='".trim($this->input->post('txt_codigo_postal',TRUE))."',".
       "DistribuidorDetalleEstado='".utf8_decode(strtoupper(trim($this->input->post('txt_estado',TRUE))))."',".
       "DistribuidorDetalleCiudad='".utf8_decode(strtoupper(trim($this->input->post('txt_ciudad',TRUE))))."',".
       "DistribuidorDetalleMunicipio='".utf8_decode(strtoupper(trim($this->input->post('txt_municipio',TRUE))))."',".
       "DistribuidorDetalleCalle='".utf8_decode(strtoupper(trim($this->input->post('txt_calle',TRUE))))."',".
       "DistribuidorDetalleRFC='".utf8_decode(strtoupper(trim($this->input->post('txt_rfc',TRUE))))."',".
       "DistribuidorDetalleTelefono='".trim($this->input->post('txt_telefono',TRUE))."',".
       "DistribuidorDetalleRegionId=".trim($this->input->post('cmb_regiones',TRUE));
        $data['DistribuidorId'] = $this->distribuidores_modificacion_model->distribuidores_modificacion_model_update_distribuidor($where,$dataDetalle);
        return 1;
    }
}