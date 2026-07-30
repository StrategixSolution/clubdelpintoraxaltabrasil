<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_segunda_vuelta_auditoria_controller extends Base_Controller
{
    public function __construct()
    {
        parent::__construct();
        valida_menus(get_class(), $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('reportes/ventas/reportes_segunda_vuelta_auditoria_model');
    }

    public function index()
    {
        $this->base_controller_create_view_sistema(
            'reportes/ventas/reportes_segunda_vuelta_auditoria/reportes_segunda_vuelta_auditoria_view'
        );
    }

    public function reportes_segunda_vuelta_auditoria_controller_combo_anio()
    {
        $html = "<option value=''>SELECIONE UM ANO</option>";
        $rows = $this->reportes_segunda_vuelta_auditoria_model->combo_anio();

        foreach ($rows as $row) {
            $html .= "<option value='{$row->anio}'>{$row->anio}</option>";
        }

        echo json_encode($html);
    }

    public function reportes_segunda_vuelta_auditoria_controller_combo_mes()
    {
        $anio = (int) $this->input->post('anio', true);
        $html = "<option value=''>SELECIONE UM MÊS</option>";
        $rows = $this->reportes_segunda_vuelta_auditoria_model->combo_mes($anio);

        foreach ($rows as $row) {
            $mes = (int) $row->mes;
            $html .= "<option value='{$mes}'>" . strtoupper(funciones_strategix_mes_numero_texto($mes)) . "</option>";
        }

        echo json_encode($html);
    }

    public function reportes_segunda_vuelta_auditoria_controller_combo_distribuidor()
    {
        $anio = (int) $this->input->post('anio', true);
        $mes  = (int) $this->input->post('mes', true);

        $html = "<option value='0'>TODOS</option>";
        $rows = $this->reportes_segunda_vuelta_auditoria_model->combo_distribuidor($anio, $mes);

        foreach ($rows as $row) {
            $codigo = $this->formato_texto($row->codigo);
            $nombre = $this->formato_texto($row->nombre_comercial);
            $html .= "<option value='{$row->id_distribuidora}'>{$codigo} - {$nombre}</option>";
        }

        echo json_encode($html);
    }

    public function reportes_segunda_vuelta_auditoria_controller_tabla()
    {
        $anio = (int) $this->input->post('anio', true);
        $mes  = (int) $this->input->post('mes', true);
        $dist = (int) $this->input->post('distribuidor', true);

        $rows = $this->reportes_segunda_vuelta_auditoria_model->datos($anio, $mes, $dist);
        $tabla = '';
         $contador = 1;

        foreach ($rows as $row) {
              $ventaId = (int)$this->obtener_valor_objeto($row, 'VentaId', 0);

            $pintor = trim((string)$this->obtener_valor_objeto($row, 'VentaUsuarioNombreMP', ''));
            if ($pintor === '') {
                $pintor = 'SIN NOMBRE';
            }

            $numeroTicket = trim((string)$this->obtener_valor_objeto($row, 'VentaNumeroTicket', ''));
            $montoTicket = (float)$this->obtener_valor_objeto($row, 'VentaMontoTicket', 0);
            $fechaRegistro = trim((string)$this->obtener_valor_objeto($row, 'FECHA_REGISTRO', ''));

            $distribuidorId = (int)$this->obtener_valor_objeto($row, 'DistribuidorId', 0);
            $codigoDistribuidor = trim((string)$this->obtener_valor_objeto($row, 'DistribuidorDetalleCodigo', ''));
            $nombreDistribuidor = trim((string)$this->obtener_valor_objeto($row, 'DistribuidorDetalleNombre', ''));

            if ($nombreDistribuidor === '') {
                $nombreDistribuidor = 'SIN NOMBRE';
            }

            $distribuidor = $distribuidorId.' - '.$codigoDistribuidor.' - '.$nombreDistribuidor;

            $fotoTicket = trim((string)$this->obtener_valor_objeto($row, 'VentaFotoTicket', ''));
            $iconTicket = '&nbsp;';
            if ($fotoTicket !== '') {
                $iconTicket = '<a href="javascript:reportes_ventas_auditoria_form_view_js_modal_ticket('.$ventaId.');"><i class="fas fa-ticket-alt"></i></a>';
            }

            $ventaAuditoriaTipoId = (int)$this->obtener_valor_objeto($row, 'VentaAuditoriaTipoId', 0);
            $motivo = trim((string)$this->obtener_valor_objeto($row, 'VentaAuditoriaTipoDescripcion', ''));

            $ticketsRepetidos = '&nbsp;';
            if ($ventaAuditoriaTipoId === 1) {
                $repetidos = $this->reportes_ventas_auditoria_model->tickets_repetidos(
                    $ventaId,
                    $anio,
                    $mes,
                    $distribuidorId,
                    (int)$this->obtener_valor_objeto($row, 'VentaUsuarioIdMP', 0),
                    $montoTicket
                );

                if ($repetidos !== '') {
                    $ticketsRepetidos = $this->texto_html($repetidos, false);
                }
            }

            $estatusAuditoria = trim((string)$this->obtener_valor_objeto($row, 'VentaAuditoriaEstatusDescripcion', ''));
            if ($estatusAuditoria === '') {
                $estatusAuditoria = 'PENDIENTE';
            }

            $observaciones = trim((string)$this->obtener_valor_objeto($row, 'VentaAuditoriaObservacionDescripcion', ''));
            $observacionesHtml = ($observaciones !== '') ? $this->texto_html($observaciones) : '&nbsp;';

            $tabla .= '<tr id="id-reporte-auditoria-ventas-'.$ventaId.'">
                <td>'.$contador.'</td>
                <td>'.$ventaId.'</td>
                <td>'.$this->texto_html($pintor).'</td>
                <td>'.$this->texto_html($numeroTicket, false).'</td>
                <td>$ '.number_format($montoTicket, 2).'</td>
                <td>'.$this->texto_html($fechaRegistro, false).'</td>
                <td>'.$this->texto_html($distribuidor).'</td>
                <td class="txt-center">'.$iconTicket.'</td>
                <td>'.($motivo !== '' ? $this->texto_html($motivo) : '&nbsp;').'</td>
                <td>'.$ticketsRepetidos.'</td>
                <td>'.$this->texto_html($estatusAuditoria).'</td>
                <td>'.$observacionesHtml.'</td>
            </tr>';

            $contador++;
        }

        $data['tabla'] = $tabla;
       // $data['total'] = count($rows);

        $html = $this->load->view(
            'reportes/ventas/reportes_segunda_vuelta_auditoria/reportes_segunda_vuelta_auditoria_tabla_view',
            $data,
            true
        );

        echo json_encode(array('tabla' => $html, 'total' => count($rows)));
    }

    private function formato_texto($texto)
    {
        $texto = trim((string) $texto);
        if ($texto === '') {
            return '&nbsp;';
        }

        return htmlspecialchars(utf8_encode(strtoupper($texto)), ENT_QUOTES, 'UTF-8');
    }
    private function obtener_valor_objeto($obj, $campo, $default = ''){
        if (!is_object($obj)) {
            return $default;
        }

        $vars = get_object_vars($obj);

        if (array_key_exists($campo, $vars)) {
            return $vars[$campo];
        }

        $campoLower = strtolower(trim($campo));

        foreach ($vars as $key => $value) {
            if (strtolower(trim($key)) === $campoLower) {
                return $value;
            }
        }

        return $default;
    }
    private function texto_html($valor, $mayusculas = true){
        $valor = trim((string)$valor);

        if ($valor === '') {
            return '';
        }

        if (function_exists('mb_check_encoding') && !mb_check_encoding($valor, 'UTF-8')) {
            $valor = utf8_encode($valor);
        }

        if ($mayusculas) {
            if (function_exists('mb_strtoupper')) {
                $valor = mb_strtoupper($valor, 'UTF-8');
            } else {
                $valor = strtoupper($valor);
            }
        }

        return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
    }
}
