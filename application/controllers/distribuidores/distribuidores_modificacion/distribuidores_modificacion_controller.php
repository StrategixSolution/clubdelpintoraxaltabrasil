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
        $row = $this->distribuidores_modificacion_model->distribuidores_modificacion_model_row($this->input->post('DistribuidorId',true));
        $datos = array();
        if (!empty($row)) {
            $datos['DistribuidorId'] = $row['DistribuidorId'];
            $datos['DistribuidorDetalleId'] = $row['DistribuidorDetalleId']; 
            $datos['DistribuidorDetalleCodigo'] = utf8_encode(strtoupper($row['DistribuidorDetalleCodigo'])); 
            $datos['DistribuidorDetalleRazonSocial'] = utf8_encode(strtoupper($row['DistribuidorDetalleRazonSocial']));
            $datos['DistribuidorDetalleNombreComercial'] = utf8_encode(strtoupper($row['DistribuidorDetalleNombreComercial'])); 
            $datos['DistribuidorDetalleCEP'] = $row['DistribuidorDetalleCEP']; 
            $datos['DistribuidorDetalleUnidadFederativa'] = $row['DistribuidorDetalleUnidadFederativa']; 
            $datos['UnidadFederativaDescripcion'] = utf8_encode(strtoupper($row['UnidadFederativaDescripcion'])); 
            $datos['DistribuidorDetalleCiudad'] = utf8_encode(strtoupper($row['DistribuidorDetalleCiudad']));
            $datos['DistribuidorDetalleBarrio'] = utf8_encode(strtoupper($row['DistribuidorDetalleBarrio']));
            $datos['DistribuidorDetalleDireccion'] = utf8_encode(strtoupper($row['DistribuidorDetalleDireccion']));
            $datos['DistribuidorDetalleRegistroFederal'] = utf8_encode(strtoupper($row['DistribuidorDetalleRegistroFederal']));
            $datos['DistribuidorDetalleInscripcionEstatal'] = utf8_encode(strtoupper($row['DistribuidorDetalleInscripcionEstatal']));
            $datos['DistribuidorDetalleTelefono'] = $row['DistribuidorDetalleTelefono']; 
            $datos['DistribuidorDetalleRegionId'] = $row['DistribuidorDetalleRegionId'];
            $datos['DistribuidorDetalleRegionNombre'] = utf8_encode(strtoupper($row['DistribuidorDetalleRegionNombre']));     
            $datos['DistribuidorDetalleAgrupamientosId'] = $row['DistribuidorDetalleAgrupamientosId'];
            $datos['DistribuidoresDetallesAgrupamientosNombre'] = utf8_encode(strtoupper($row['DistribuidoresDetallesAgrupamientosNombre']));
            $datos['DistribuidorDetalleOficinasVentasId'] = $row['DistribuidorDetalleOficinasVentasId'];
            $datos['DistribuidoresDetallesOficinasVentasNombre'] = utf8_encode(strtoupper($row['DistribuidoresDetallesOficinasVentasNombre']));
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
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
        $this->form_validation->set_rules('cmb_oficinas_ventas', $this->lang->line('distribuidores_alta_controller_lang_combo_etiqueta_oficinas_venta'), 'required|callback_distribuidores_alta_controller_valida_combo_oficinas_venta');
     }
    private function distribuidores_modificacion_controller_valida_distribuidor_form_error() {
           $json_txt_razon_social = $json_txt_nombre_comercial = $json_txt_codigo_distribuidor = $json_cmb_agrupamiento = $json_txt_registro_federal = $json_txt_inscripcion_estatal = $json_cmb_unidad_federativa = $json_txt_ciudad = $json_txt_barrio = $json_txt_direccion = $json_txt_codigo_postal = $json_txt_telefono = $json_cmb_regiones = $json_cmb_oficinas_ventas =array();
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
            if (!empty(form_error('cmb_oficinas_ventas'))) { $json_cmb_oficinas_ventas =  array('cmb_oficinas_ventas' => form_error('cmb_oficinas_ventas', '<small class="mt-3 text-danger">', '</small>')); }         
             $json = array_merge($json_txt_razon_social, $json_txt_nombre_comercial, $json_txt_codigo_distribuidor, $json_cmb_agrupamiento, $json_txt_registro_federal, $json_txt_inscripcion_estatal, $json_cmb_unidad_federativa, $json_txt_ciudad, $json_txt_barrio, $json_txt_direccion, $json_txt_codigo_postal, $json_txt_telefono, $json_cmb_regiones, $json_cmb_oficinas_ventas);
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
    public function distribuidores_modificacion_controller_guardar() {
       $where = "DistribuidorId=".$this->input->post('DistribuidorId',TRUE);
       $dataDetalle            = "DistribuidorDetalleRazonSocial='".utf8_decode(strtoupper(trim($this->input->post('txt_razon_social',TRUE))))."',DistribuidorDetalleNombreComercial='".utf8_decode(strtoupper(trim($this->input->post('txt_nombre_comercial',TRUE))))."',DistribuidorDetalleCodigo='".utf8_decode(strtoupper(trim($this->input->post('txt_codigo_distribuidor',TRUE))))."',DistribuidorDetalleAgrupamientosId=".trim($this->input->post('cmb_agrupamiento',TRUE)).",DistribuidorDetalleRegistroFederal='".utf8_decode(strtoupper(trim($this->input->post('txt_registro_federal',TRUE))))."',DistribuidorDetalleInscripcionEstatal='".utf8_decode(strtoupper(trim($this->input->post('txt_inscripcion_estatal',TRUE))))."',DistribuidorDetalleUnidadFederativa=".trim($this->input->post('cmb_unidad_federativa',TRUE)).",DistribuidorDetalleCiudad='".utf8_decode(strtoupper(trim($this->input->post('txt_ciudad',TRUE))))."',DistribuidorDetalleBarrio='".trim($this->input->post('txt_barrio',TRUE))."',DistribuidorDetalleDireccion='".trim($this->input->post('txt_direccion',TRUE))."',DistribuidorDetalleCEP='".trim($this->input->post('txt_codigo_postal',TRUE))."',DistribuidorDetalleTelefono='".trim($this->input->post('txt_telefono',TRUE))."',DistribuidorDetalleRegionId=".trim($this->input->post('cmb_regiones',TRUE)).",DistribuidorDetalleOficinasVentasId=".trim($this->input->post('cmb_oficinas_ventas',TRUE)).",DistribuidorDetalleUsuarioIdCapturo=".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        $data['DistribuidorId'] = $this->distribuidores_modificacion_model->distribuidores_modificacion_model_update_distribuidor($where,$dataDetalle);
      //  return 1;
       $data['res'] = 1;
        return $data;
    }
}