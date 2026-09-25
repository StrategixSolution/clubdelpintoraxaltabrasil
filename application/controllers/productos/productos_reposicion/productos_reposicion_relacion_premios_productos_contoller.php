<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_reposicion_relacion_premios_productos_contoller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('productos/productos_reposicion/productos_reposicion_relacion_premios_productos_model');
    }    
    public function index(){//Pagina de Inicio 
        $data['sub_menu'] = ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==3)?$this->load->view('template/sistema/sub_menu/sub_menu_productos_reposicion_axalta', '', TRUE):$this->load->view('template/sistema/sub_menu/sub_menu_productos_reposicion', '', TRUE); 
        $this->base_controller_create_view_sistema('productos/productos_reposicion/productos_reposicion_relacion_premios_productos/productos_reposicion_relacion_premios_productos_form_view',$data);
    }
    public function productos_reposicion_relacion_premios_productos_contoller_ajax_combo_sector() {
        $combo_sectores = "<option value='0'>".$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_placeholder_sector')."</option>";
        $sectores         = $this->productos_reposicion_relacion_premios_productos_model->productos_reposicion_relacion_premios_productos_model_combo_sectores();
        foreach ($sectores as $sector) { $combo_sectores   .='<option value="'.$sector->ProductoDivisionId.'">'.utf8_encode(strtoupper($sector->ProductoDivisionNombre)).'</option>'; } 
        echo json_encode($combo_sectores);
    }
    public function productos_reposicion_relacion_premios_productos_contoller_ajax_combo_anio() {
        $cmb_sector = 1;//$this->input->post('cmb_sector',true);
        $combo_anio = "<option value='0'>".$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_placeholder_anio')."</option>";
        $anios         = $this->productos_reposicion_relacion_premios_productos_model->productos_reposicion_relacion_premios_productos_model_combo_anio($cmb_sector);
        foreach ($anios as $anio) { $combo_anio   .='<option value="'.$anio->ReposicionProductoPremioAnio.'">'.utf8_encode(strtoupper($anio->ReposicionProductoPremioAnio)).'</option>'; } 
        echo json_encode($combo_anio);
    }
    public function productos_reposicion_relacion_premios_productos_contoller_ajax_combo_mes() {
        $cmb_sector = 1;//$this->input->post('cmb_sector',true);
        $cmb_anio = $this->input->post('cmb_anio',true);
        $combo_mes = "<option value='0'>".$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_placeholder_mes')."</option>";
        $meses         = $this->productos_reposicion_relacion_premios_productos_model->productos_reposicion_relacion_premios_productos_model_combo_mes($cmb_sector,$cmb_anio);
        foreach ($meses as $mes) { $combo_mes   .='<option value="'.$mes->ReposicionProductoPremioMes.'">'.funciones_strategix_mes_numero_texto($mes->ReposicionProductoPremioMes-1).' - '.funciones_strategix_mes_numero_texto($mes->ReposicionProductoPremioMes).'</option>'; } 
        echo json_encode($combo_mes);
    }
    public function productos_reposicion_relacion_premios_productos_contoller_ajax_combo_lugares() {
        $cmb_sector = 1;//$this->input->post('cmb_sector',true);
        $cmb_anio = $this->input->post('cmb_anio',true);
        $cmb_mes = $this->input->post('cmb_mes',true);
        $combo_lugares = "<option value='0'>".$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_placeholder_lugar')."</option>";
        $lugares         = $this->productos_reposicion_relacion_premios_productos_model->productos_reposicion_relacion_premios_productos_model_combo_lugar($cmb_sector,$cmb_anio,$cmb_mes);
        foreach ($lugares as $lugar) { $combo_lugares   .='<option value="'.$lugar->ReposicionProductoPremioId.'">'.utf8_decode(strtoupper($lugar->ReposicionProductoPremioLugar)).'</option>'; } 
        echo json_encode($combo_lugares);
    }
    public function productos_reposicion_relacion_premios_productos_contoller_ajax_lista_productos_premios() {
        $cmb_lugar      = $this->input->post('cmb_lugar',true);$prodcutos_seleccionar_array = $prodcutos_seleccionados_array = array();
        $prodcutos_seleccionar = $this->productos_reposicion_relacion_premios_productos_model->productos_reposicion_relacion_premios_productos_model_lista_productos_seleccionar($cmb_lugar);
        foreach ($prodcutos_seleccionar as $prodcuto) { 
            $descripcion = trim(utf8_encode($prodcuto->ReposicionProductoPremioProductoGMS)).' - '. utf8_encode($prodcuto->ReposicionProductoPremioProductoDescripcion).' - '.utf8_encode(trim($prodcuto->ReposicionProductoPremioProductoPresentacion));
            $prodcutos_seleccionar_array[] = array('value'=>$prodcuto->ReposicionProductoPremioProductoId,'content'=> $descripcion);            
        }
       $prodcutos_seleccionados = $this->productos_reposicion_relacion_premios_productos_model->productos_reposicion_relacion_premios_productos_model_lista_productos_seleccionados($cmb_lugar);
        foreach ($prodcutos_seleccionados as $prodcuto) { 
            $descripcion = trim(utf8_encode($prodcuto->ReposicionProductoPremioProductoGMS)).' - '.utf8_encode($prodcuto->ReposicionProductoPremioProductoDescripcion).' - '.utf8_encode(trim($prodcuto->ReposicionProductoPremioProductoPresentacion));
            $prodcutos_seleccionados_array[] = $prodcuto->ReposicionProductoPremioProductoId;            
        }         
        $data['seleccionar'] = $prodcutos_seleccionar_array;
        $data['seleccionados'] = $prodcutos_seleccionados_array;
//        print_r($data);
        echo json_encode($data);
    }
    public function productos_reposicion_relacion_premios_productos_contoller_ajax_guarda_productos_premios() {
        $cmb_lugar      = $this->input->post('cmb_lugar',true);
        $transfer_array = $this->input->post('transfer_array',true);
        if (empty($transfer_array)){
            echo 0;
        } else {
            $x = 1;
            $this->productos_reposicion_relacion_premios_productos_model->productos_reposicion_relacion_premios_productos_model_update($cmb_lugar);
            foreach ($transfer_array as $row) {
                $data_insert = $cmb_lugar.",".$row.",".$x;
                $this->productos_reposicion_relacion_premios_productos_model->productos_reposicion_relacion_premios_productos_model_insert($data_insert);
                $x++;
            }            
            echo 1;
        }
        
    }
}