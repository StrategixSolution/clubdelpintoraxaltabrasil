<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_cortes_apertura_cierre_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct();        
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('ventas/ventas_cortes/ventas_cortes_apertura_cierre/ventas_cortes_apertura_cierre_model');
    }    
    public function index(){//Pagina de Inicio 
        $data['sub_menu'] = ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==3)?$this->load->view('template/sistema/sub_menu/sub_menu_productos_reposicion_axalta', '', TRUE):$this->load->view('template/sistema/sub_menu/sub_menu_ventas_cortes', '', TRUE); 
       $data['estatus'] = $this->ventas_cortes_apertura_cierre_model->ventas_cortes_apertura_cierre_model_estatus();
        $this->base_controller_create_view_sistema('ventas/ventas_cortes/ventas_cortes_apertura_cierre/ventas_cortes_apertura_cierre_view_form',$data);
    }
    public function ventas_cortes_apertura_cierre_controller_cambio_estatus() {   
        $estatusId = $this->input->post('estatusId',true);
        if($estatusId == 1){
            $updatetipo = 0;
        }else{
            $updatetipo = 1;
        }
        $this->ventas_cortes_apertura_cierre_model->ventas_cortes_apertura_cierre_model_cambio_estatus($updatetipo);
        $dato['res']   = 1;  
        echo json_encode($dato);
    }    
}
