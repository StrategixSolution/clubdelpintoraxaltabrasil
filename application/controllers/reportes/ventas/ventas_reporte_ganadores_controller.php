<?php
/*
 * Sistema Web Responsivo CDPMEX
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_reporte_ganadores_controller extends Base_Controller {

    public function __construct(){
        parent::__construct();
        valida_menus(get_class(), $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        control_modulos();
        $this->load->model('reportes/ventas/ventas_reporte_ganadores_model');
    }

    public function index(){
        // Vista del reporte (en carpeta reportes)
        $this->base_controller_create_view_sistema('reportes/ventas/ventasGanadores/ventas_reporte_ganadores_view');
    }

    public function ventas_reporte_ganadores_controller_combo_anio(){
        $cmb = "<option value=''>" . $this->lang->line('ventas_reporte_ganadores_controller_lang_select_combo_anio') . "</option>";
        $rows = $this->ventas_reporte_ganadores_model->ventas_reporte_ganadores_model_anios();

        foreach ($rows as $r){
            $cmb .= "<option value='{$r->anio}'>{$r->anio}</option>";
        }
        echo json_encode($cmb);
    }

    public function ventas_reporte_ganadores_controller_combo_periodo(){
        $anio = (int)$this->input->post('anio', true);

        $cmb = "<option value=''>" . $this->lang->line('ventas_reporte_ganadores_controller_lang_select_combo_periodo') . "</option>";
        if ($anio <= 0){
            echo json_encode($cmb);
            return;
        }

        $rows = $this->ventas_reporte_ganadores_model->ventas_reporte_ganadores_model_periodos_bimestrales($anio);

        foreach ($rows as $r){
            $mesFin = (int)$r->mes_fin; // 2,4,6,8,10,12
            $mesIni = $mesFin - 1;
            if ($mesIni < 1) { $mesIni = 1; }

            $cmb .= "<option value='{$mesFin}'>"
                . strtoupper(funciones_strategix_mes_numero_texto($mesIni))
                . " - "
                . strtoupper(funciones_strategix_mes_numero_texto($mesFin))
                . "</option>";
        }

        echo json_encode($cmb);
    }

    public function ventas_reporte_ganadores_controller_combo_distribuidor(){
        $cmb = "<option value='0'>TODOS</option>";
        $rows = $this->ventas_reporte_ganadores_model->ventas_reporte_ganadores_model_distribuidores();

        foreach ($rows as $r){
            $texto =$r->ID_DISTRIBUIDOR." - ".$r->CODIGO . " - " . $r->NOMBRE_COMERCIAL;
            $cmb .= "<option value='{$r->ID_DISTRIBUIDOR}'>" . utf8_encode(strtoupper($texto)) . "</option>";
        }

        echo json_encode($cmb);
        
    }

    public function ventas_reporte_ganadores_controller_tabla(){
        $anio   = (int)$this->input->post('cmb_anio', TRUE);
        $mesFin = (int)$this->input->post('cmb_periodo', TRUE);
        $distId = (int)$this->input->post('cmb_distribuidor', TRUE);

        if ($anio <= 0 || $mesFin <= 0){
            echo json_encode(['tabla' => "<div class='alert alert-warning'>Selecione o ANO e o PERÍODO.</div>"]);
            return;
        }

        $mesIni = $mesFin - 1;
        if ($mesIni < 1) { $mesIni = 1; }

        $rows = $this->ventas_reporte_ganadores_model->ventas_reporte_ganadores_model_datos($anio, $mesIni, $mesFin, $distId);

        $lista = "";
        $i = 0;

        foreach ($rows as $r){
            $lista .= '<tr>
                <td>'.$r->ID_MAESTRO_PINTOR.'</td>
                <td>'.utf8_encode(strtoupper($r->MAESTRO_PINTOR)).'</td>
                <td>'.$r->ID_DISTRIBUIDOR.'</td>
                <td>'.utf8_encode(strtoupper($r->CODIGO)).'</td>
                <td>'.utf8_encode(strtoupper($r->NOMBRE_COMERCIAL)).'</td>
                <td>'.utf8_encode(strtoupper($r->TIPO_DISTRIBUIDORA)).'</td>
                <td>'.utf8_encode(strtoupper($r->EJECUTIVO)).'</td>
                <td>'.utf8_encode(strtoupper($r->CIUDAD_ESTADO)).'</td>
                <td>'.utf8_encode(strtoupper($r->LUGAR)).'</td>
                <td  style="white-space: pre-line;">'.trim(utf8_encode(strtoupper($r->DESCRIPCION_PREMIO))).'</td>
            </tr>';
            $i++;
        }

        $data['tabla'] = $lista;
        $data['total'] = $i;

        $resp['tabla'] = $this->load->view('reportes/ventas/ventasGanadores/ventas_reporte_ganadores_tabla_view', $data, true);
        echo json_encode($resp);
    }
}
