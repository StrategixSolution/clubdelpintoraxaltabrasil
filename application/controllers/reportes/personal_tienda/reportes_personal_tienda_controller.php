<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_personal_tienda_controller extends Base_Controller {

    public function __construct(){
        parent::__construct();
        valida_menus(get_class(), $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('reportes/personal_tienda/reportes_personal_tienda_model', 'reporte_model');
    }

    public function index(){
        $data = array();
        $data['distribuidores']     = $this->reporte_model->cmb_distribuidores();
        $data['puede_ver_todas']    = $this->reporte_model->puede_ver_todas_distribuidoras();
        $data['es_callcenter']      = $this->reporte_model->es_callcenter();
        $data['perfil_id_actual']   = $this->reporte_model->perfil_actual_publico();

        $this->base_controller_create_view_sistema(
            'reportes/personal_tienda/reportes_personal_tienda_view',
            $data
        );
    }

    public function buscar(){
        $distribuidorId = (int) $this->input->post('distribuidor', TRUE);
        $codigo         = trim((string) $this->input->post('codigo', TRUE));
        $nombre         = trim((string) $this->input->post('nombre', TRUE));

        $tabla = $this->reporte_model->datos($distribuidorId, $codigo, $nombre);

        $html = $this->load->view(
            'reportes/personal_tienda/reportes_personal_tienda_tabla_view',
            array(
                'tabla'         => $tabla,
                'es_callcenter' => $this->reporte_model->es_callcenter()
            ),
            TRUE
        );

        echo $html;
    }
}
