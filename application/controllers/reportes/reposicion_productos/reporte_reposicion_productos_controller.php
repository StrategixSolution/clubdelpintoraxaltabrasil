<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_reposicion_productos_controller extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();
        valida_menus(get_class(), $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        control_modulos();
        $this->load->model('reportes/reposicion_productos/reporte_reposicion_productos_model');
    }

    public function index()
    {
        $this->base_controller_create_view_sistema('reportes/reposicion_productos/reportes_reposicion_productos_view');
    }

    public function reporte_reposicion_productos_controller_combo_anio()
    {
        $cmb_anio = "";
        $anios = $this->reporte_reposicion_productos_model->reporte_reposicion_productos_model_anios();
        $cmb_anio = "<option value=''>SELECIONE UM ANO</option>";
        foreach ($anios as $anio) {
            $cmb_anio .= "<option value=$anio->anio>" . $anio->anio . "</option>";
        }
        echo json_encode($cmb_anio);
    }
    public function reporte_reposicion_productos_controller_combo_periodo()
    {
        $anio = (int) $this->input->post('anio', true);
        $cmb_periodo = "";
        $meses = $this->reporte_reposicion_productos_model->reporte_reposicion_productos_model_periodos_bimestrales($anio);
        $cmb_periodo = "<option value=''>SELECIONE UM PERÍODO</option>";
        foreach ($meses as $mes) {
            $bimestre = $mes->mes;
            $mesanterior = $mes->mes - 1;
            if (($bimestre % 2) == 0) {
                $cmb_periodo .= "<option value=$mes->mes>" . strtoupper(funciones_strategix_mes_numero_texto($mesanterior)) . ' - ' . strtoupper(funciones_strategix_mes_numero_texto($bimestre)) . "</option>";
            }
        }
        echo json_encode($cmb_periodo);
    }
    public function reporte_reposicion_productos_controller_combo_distribuidor()
    {
        $anio = (int) $this->input->post('anio', true);
        $periodo = (int) $this->input->post('periodo', true);
        if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 6 or $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 7 or $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 8) {
            $cmb_distribuidor = '';
            $distribuidoras = $this->reporte_reposicion_productos_model->reporte_reposicion_productos_model_distribuidores_personal_tienda($anio, $periodo);
            foreach ($distribuidoras as $distribuidor) {
                $cmb_distribuidor .= "<option value='{$distribuidor->DistribuidorId}'>" . $distribuidor->DistribuidorId . ' - ' . $distribuidor->DistribuidorDetalleCodigo . ' - ' . utf8_encode(strtoupper($distribuidor->DistribuidorDetalleNombreComercial)) . "</option>";
            }
        } else {
            $cmb_distribuidor = "<option value='0'>TODOS</option>";
            $distribuidoras = $this->reporte_reposicion_productos_model->reporte_reposicion_productos_model_distribuidores($anio, $periodo);
            foreach ($distribuidoras as $distribuidor) {
                $cmb_distribuidor .= "<option value='{$distribuidor->DistribuidorId}'>" . $distribuidor->DistribuidorId . ' - ' . $distribuidor->DistribuidorDetalleCodigo . ' - ' . utf8_encode(strtoupper($distribuidor->DistribuidorDetalleNombreComercial)) . "</option>";
            }
        }
        echo json_encode($cmb_distribuidor);
    }
    public function reporte_reposicion_productos_controller_tabla()
    {
        $anio = (int) $this->input->post('cmb_anio', TRUE);
        $mes = (int) $this->input->post('cmb_periodo', TRUE);
        $mesanterior = $mes - 1;
        $periodo = strtoupper(funciones_strategix_mes_numero_texto($mesanterior)) . ' - ' . strtoupper(funciones_strategix_mes_numero_texto($mes));
        $distId = (int) $this->input->post('cmb_distribuidor', TRUE);
        $where = "";
        $where .= ($anio != 0) ? " WHERE rpg.ReposicionProductoGanadorAnio = $anio   " : "";
        $where .= ($mes != 0) ? "  AND rpg.ReposicionProductoGanadorMes = $mes " : "";
        $where .= ($distId != 0) ? "  AND rpg.DistribuidorId = $distId " : "";
        $rows = $this->reporte_reposicion_productos_model->reporte_reposicion_productos_model_datos($where);
        $lista = "";
        $i = 0;
        foreach ($rows as $r) {
            if ($r->NombreComercial == null) {
                $NombreComercial = '&nbsp;';
            } else {
                $NombreComercial = utf8_encode(strtoupper($r->NombreComercial));
            }
            if ($r->fechaEntrega == null) {
                $fecha_entrega = '&nbsp;';
            } else {
                $fecha_entrega = $r->fechaEntrega;
            }
            if ($r->ReposicionProductoPremioProductoGMS == null) {
                $gsm = '&nbsp;';
            } else {
                $gsm = $r->ReposicionProductoPremioProductoGMS;
            }
            if ($r->ReposicionProductoPremioProductoCodigo == null) {
                $codigo = '&nbsp;';
            } else {
                $codigo = $r->ReposicionProductoPremioProductoCodigo;
            }
            if ($r->ReposicionProductoPremioProductoDescripcion == null) {
                $descripcion = '&nbsp;';
            } else {
                $descripcion = utf8_encode(strtoupper($r->ReposicionProductoPremioProductoDescripcion));
            }
            if ($r->ReposicionProductoPremioProductoPresentacion == null) {
                $presentacion = '&nbsp;';
            } else {
                $presentacion = utf8_encode(strtoupper($r->ReposicionProductoPremioProductoPresentacion));
            }
            if ($r->ReposicionProductoPremioProductoPrecio == null) {
                $precio = '&nbsp;';
            } else {
                $precio = $r->ReposicionProductoPremioProductoPrecio;
            }
            if ($r->precioTotal == null) {
                $precio_total = '&nbsp;';
            } else {
                $precio_total = $r->precioTotal;
            }
            $lista .= '<tr>
                <td>' . $r->DistribuidorId . '</td>
                <td>' . $r->DistribuidorDetalleCodigo . '</td>
                <td>' . utf8_encode(strtoupper($r->RazonSocial)) . '</td>
                <td>' . utf8_encode(strtoupper($r->NombreComercial)) . '</td>
                <td>' . utf8_encode(strtoupper($r->TipoDistribuidora)) . '</td>
                <td>' . utf8_encode(strtoupper($periodo)) . '</td>
                <td>' . $r->TarjetaId . '</td>
                <td>' . utf8_encode(strtoupper($r->nombreMP)) . '</td>
                <td>' . utf8_encode(strtoupper($r->region)) . '</td>
                <td>' . utf8_encode(strtoupper($r->nombre_ejecutivo)) . '</td>
                <td>' . $r->lugar . '</td>
                <td>' . $fecha_entrega . '</td>
                <td>' . $gsm . '</td>
                <td>' . $codigo . '</td>
                <td>' . $descripcion . '</td>
                <td>' . $presentacion . '</td>
                <td>' . $r->cantidad . '</td>
                <td>' . $precio . '</td>
                <td>' . $precio_total . '</td>
            </tr>';
            $i++;
        }
        $data['tabla'] = $lista;
        $data['total'] = $i;
        $resp['tabla'] = $this->load->view('reportes/reposicion_productos/reportes_reposicion_productos_tabla_view', $data, true);
        echo json_encode($resp);
    }
}
