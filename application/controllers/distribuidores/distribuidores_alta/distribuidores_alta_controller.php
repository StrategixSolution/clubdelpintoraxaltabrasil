<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribuidores_alta_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('distribuidores/distribuidores_alta/distribuidores_alta_model');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('distribuidores/distribuidores_alta/distribuidores_alta_view');
    }

        public function distribuidores_alta_controller_combo_lista_regiones() {
        $combo_regiones = "<option value='0'>".$this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_regiones')."</option>";
        $regiones         = $this->distribuidores_alta_model->distribuidores_alta_model_combo_regiones();
        foreach ($regiones as $region) { $combo_regiones   .='<option value="'.$region->DistribuidorDetalleRegionId.'">'.utf8_encode(strtoupper($region->DistribuidorDetalleRegionNombre)).'</option>'; } 
        echo json_encode($combo_regiones);
    }
        public function distribuidores_alta_controller_combo_lista_oficinas_venta() {
        $combo_oficinas_venta = "<option value='0'>".$this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_oficinas_venta')."</option>";
        $oficinas_venta         = $this->distribuidores_alta_model->distribuidores_alta_model_combo_oficinas_venta();
        foreach ($oficinas_venta as $oficina) { $combo_oficinas_venta   .='<option value="'.$oficina->DistribuidoresDetallesOficinasVentasId.'">'.utf8_encode(strtoupper($oficina->DistribuidoresDetallesOficinasVentasCodigo.' - '.$oficina->DistribuidoresDetallesOficinasVentasNombre)).'</option>'; } 
        echo json_encode($combo_oficinas_venta);
    }

         public function distribuidores_alta_controller_combo_lista_agrupamiento() {
        $combo_agrupamiento = "<option value='0'>".$this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_agrupamiento')."</option>";
        $agrupamientos         = $this->distribuidores_alta_model->distribuidores_alta_model_combo_agrupamientos();
        foreach ($agrupamientos as $agrupamiento) { $combo_agrupamiento   .='<option value="'.$agrupamiento->DistribuidoresDetallesAgrupamientosId.'">'.utf8_encode(strtoupper($agrupamiento->DistribuidoresDetallesAgrupamientosCodigo.' - '.$agrupamiento->DistribuidoresDetallesAgrupamientosNombre)).'</option>'; } 
        echo json_encode($combo_agrupamiento);
    }

    public function distribuidores_alta_controller_combo_lista_unidad_federativa() {
        $combo_unidad_federativa = "<option value='0'>".$this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_unidad_federativa')."</option>";
        $unidad_federativa         = $this->distribuidores_alta_model->distribuidores_alta_model_combo_unidad_federativa();
        foreach ($unidad_federativa as $uf) { $combo_unidad_federativa   .='<option value="'.$uf->UnidadFederativaId.'">'.utf8_encode(strtoupper($uf->UnidadFederativaDescripcion)).'</option>'; } 
        echo json_encode($combo_unidad_federativa);
    }
    public function distribuidores_alta_controller_valida_guarda_distribuidor() {
        $this->distribuidores_alta_controller_valida_distribuidor_set_rules();
        $res_errors = $this->distribuidores_alta_controller_valida_distribuidor_form_error();
        if ($res_errors==1){                    
            echo json_encode($this->distribuidores_alta_controller_guardar());
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }        
    }
    private function distribuidores_alta_controller_valida_distribuidor_set_rules() {
        $this->form_validation->set_rules('txt_razon_social', $this->lang->line('distribuidores_alta_controller_lang_placeholder_razon_social'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_nombre_comercial', $this->lang->line('distribuidores_alta_controller_lang_placeholder_nombre_comercial'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_codigo_distribuidor', $this->lang->line('distribuidores_alta_controller_lang_placeholder_codigo_distribuidor'), 'required|xss_clean');
        $this->form_validation->set_rules('cmb_agrupamiento', $this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_agrupamiento'), 'required|callback_distribuidores_alta_controller_valida_combo_agrupamiento');
        $this->form_validation->set_rules('txt_registro_federal', $this->lang->line('distribuidores_alta_controller_lang_placeholder_registro_federal'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_inscripcion_estatal', $this->lang->line('distribuidores_alta_controller_lang_placeholder_inscripcion_estatal'), 'required|xss_clean');
        $this->form_validation->set_rules('cmb_unidad_federativa', $this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_unidad_federativa'), 'required|callback_distribuidores_alta_controller_valida_combo_unidad_federativa');
        $this->form_validation->set_rules('txt_ciudad', $this->lang->line('distribuidores_alta_controller_lang_placeholder_ciudad'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_barrio', $this->lang->line('distribuidores_alta_controller_lang_placeholder_barrio'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_direccion', $this->lang->line('distribuidores_alta_controller_lang_placeholder_direccion'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_codigo_postal', $this->lang->line('distribuidores_alta_controller_lang_placeholder_codigo_postal'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_telefono', $this->lang->line('distribuidores_alta_controller_lang_placeholder_telefono'), 'required|min_length[8]|max_length[15]|xss_clean');
        $this->form_validation->set_rules('cmb_regiones', $this->lang->line('distribuidores_alta_controller_lang_combo_etiqueta_regiones'), 'required|callback_distribuidores_alta_controller_valida_combo_region');
        $this->form_validation->set_rules('cmb_oficinas_venta', $this->lang->line('distribuidores_alta_controller_lang_combo_etiqueta_oficinas_venta'), 'required|callback_distribuidores_alta_controller_valida_combo_oficinas_venta');
     }
    private function distribuidores_alta_controller_valida_distribuidor_form_error() {
            $json_txt_razon_social = $json_txt_nombre_comercial = $json_txt_codigo_distribuidor = $json_cmb_agrupamiento = $json_txt_registro_federal = $json_txt_inscripcion_estatal = $json_cmb_unidad_federativa = $json_txt_ciudad = $json_txt_barrio = $json_txt_direccion = $json_txt_codigo_postal = $json_txt_telefono = $json_cmb_regiones = $json_cmb_oficinas_venta =array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('txt_razon_social'))) { $json_txt_razon_social =  array('txt_razon_social' => form_error('txt_razon_social', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_nombre_comercial'))) { $json_txt_nombre_comercial =  array('txt_nombre_comercial' => form_error('txt_nombre_comercial', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_codigo_distribuidor'))) { $json_txt_codigo_distribuidor =  array('txt_codigo_distribuidor' => form_error('txt_codigo_distribuidor', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_agrupamiento'))) { $json_cmb_agrupamiento =  array('cmb_agrupamiento' => form_error('cmb_agrupamiento', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_registro_federal'))) { $json_txt_registro_federal =  array('txt_registro_federal' => form_error('txt_registro_federal', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_inscripcion_estatal'))) { $json_txt_inscripcion_estatal =  array('txt_inscripcion_estatal' => form_error('txt_inscripcion_estatal', '<small class="mt-3 text-danger">', '</small>')); }
           if (!empty(form_error('cmb_unidad_federativa'))) { $json_cmb_unidad_federativa =  array('cmb_unidad_federativa' => form_error('cmb_unidad_federativa', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_ciudad'))) { $json_txt_ciudad =  array('txt_ciudad' => form_error('txt_ciudad', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_barrio'))) { $json_txt_barrio =  array('txt_barrio' => form_error('txt_barrio', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_direccion'))) { $json_txt_direccion =  array('txt_direccion' => form_error('txt_direccion', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_codigo_postal'))) { $json_txt_codigo_postal =  array('txt_codigo_postal' => form_error('txt_codigo_postal', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_telefono'))) { $json_txt_telefono =  array('txt_telefono' => form_error('txt_telefono', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_regiones'))) { $json_cmb_regiones =  array('cmb_regiones' => form_error('cmb_regiones', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_oficinas_venta'))) { $json_cmb_oficinas_venta =  array('cmb_oficinas_venta' => form_error('cmb_oficinas_venta', '<small class="mt-3 text-danger">', '</small>')); }         
             $json = array_merge($json_txt_razon_social, $json_txt_nombre_comercial, $json_txt_codigo_distribuidor, $json_cmb_agrupamiento, $json_txt_registro_federal, $json_txt_inscripcion_estatal, $json_cmb_unidad_federativa, $json_txt_ciudad, $json_txt_barrio, $json_txt_direccion, $json_txt_codigo_postal, $json_txt_telefono, $json_cmb_regiones, $json_cmb_oficinas_venta);
            return $json;
        } else {             
            return 1; 
        }                
    }
       public function distribuidores_alta_controller_valida_combo_region($post_string){
        if ($post_string==0){ $this->form_validation->set_message('distribuidores_alta_controller_valida_combo_region', $this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_regiones')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function distribuidores_alta_controller_valida_combo_agrupamiento($post_string){
        if ($post_string==0){ $this->form_validation->set_message('distribuidores_alta_controller_valida_combo_agrupamiento', $this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_agrupamiento')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function distribuidores_alta_controller_valida_combo_unidad_federativa($post_string){
        if ($post_string==0){ $this->form_validation->set_message('distribuidores_alta_controller_valida_combo_unidad_federativa', $this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_unidad_federativa')); $response = FALSE; } else { $response = TRUE; }return $response;
    }

    public function distribuidores_alta_controller_valida_combo_oficinas_venta($post_string){
        if ($post_string==0){ $this->form_validation->set_message('distribuidores_alta_controller_valida_combo_oficinas_venta', $this->lang->line('distribuidores_alta_controller_lang_combo_selecciona_oficinas_venta')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function distribuidores_alta_controller_guardar() {
        $dataHead               = $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')).",'".$this->uniqueId."'";
       // $txt_rfc_trim           = trim($this->input->post('txt_rfc',TRUE)); $txt_rfc_utf8_decode = utf8_decode($txt_rfc_trim); $txt_rfc = strtoupper($txt_rfc_utf8_decode);
        $dataDetalle            = "'".utf8_decode(strtoupper(trim($this->input->post('txt_razon_social',TRUE))))."','". utf8_decode(strtoupper(trim($this->input->post('txt_nombre_comercial',TRUE))))."','".utf8_decode(strtoupper(trim($this->input->post('txt_codigo_distribuidor',TRUE))))."',".trim($this->input->post('cmb_agrupamiento',TRUE)).",'".utf8_decode(strtoupper(trim($this->input->post('txt_registro_federal',TRUE))))."','".utf8_decode(strtoupper(trim($this->input->post('txt_inscripcion_estatal',TRUE))))."',".trim($this->input->post('cmb_unidad_federativa',TRUE)).",'".utf8_decode(strtoupper(trim($this->input->post('txt_ciudad',TRUE))))."','".trim($this->input->post('txt_barrio',TRUE))."','".trim($this->input->post('txt_direccion',TRUE))."','".trim($this->input->post('txt_codigo_postal',TRUE))."','".trim($this->input->post('txt_telefono',TRUE))."',".trim($this->input->post('cmb_regiones',TRUE)).",".trim($this->input->post('cmb_oficinas_venta',TRUE)).",".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."";
        $data['DistribuidorId'] = $this->distribuidores_alta_model->distribuidores_alta_model_insert_distribuidor($dataHead,$dataDetalle);
        $data['res'] = 1;
        return $data;
    }
}