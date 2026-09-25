<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_tarjetas_controller extends Base_Controller {

    public function __construct(){
        parent::__construct();
        valida_menus(get_class(), $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('reportes/tarjetas/reportes_tarjetas_model', 'reporte_model');
    }

    public function index(){
        $perfilId = (int) $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));

        $data = array();
        $data['distribuidores'] = $this->reporte_model->cmb_distribuidores();
        $data['permite_tarjetas_sin_distribuidor'] = in_array($perfilId, array(1, 2, 3), true);

        $this->base_controller_create_view_sistema(
            'reportes/tarjetas/reportes_tarjetas_view',
            $data
        );
    }

    public function buscar(){
        $distribuidorId = (int) $this->input->post('distribuidor', TRUE);

        $tabla = $this->reporte_model->datos($distribuidorId);

        $html = $this->load->view(
            'reportes/tarjetas/reportes_tarjetas_tabla_view',
            array('tabla' => $tabla),
            TRUE
        );

        echo $html;
    }
}
