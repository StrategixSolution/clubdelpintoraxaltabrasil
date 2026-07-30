<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_ventas_auditoria_controller extends Base_Controller {

    public function __construct(){
        parent::__construct();

        valida_menus(get_class(), $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));

        $this->load->model('reportes/ventas/reportes_ventas_auditoria_model');
        $this->load->model('ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_model');
    }

    public function index(){
        $data = [];
        $this->base_controller_create_view_sistema(
            'reportes/ventas/reportes_ventas_auditoria/reportes_ventas_auditoria_form_view',
            $data
        );
    }

    public function reportes_ventas_auditoria_controller_combo_anio(){
        $rows = $this->reportes_ventas_auditoria_model->combo_anio();

        $html = '';
        foreach($rows as $row){
            $html .= '<option value="'.$row->anio.'">'.$row->anio.'</option>';
        }

        echo json_encode($html);
    }

    public function reportes_ventas_auditoria_controller_combo_mes(){
        $anio = (int)$this->input->post('anio');
        $meses = $this->reportes_ventas_auditoria_model->combo_mes($anio);
        $cmbMes = '<option value="0">'.$this->lang->line('data_table_js_lang_combo_todos').'</option>';
        foreach ($meses as $mes) {            
            $cmbMes .="<option value=$mes->mes>".strtoupper(funciones_strategix_mes_numero_texto($mes->mes))."</option>";
        }
        echo json_encode($cmbMes);
    }

    public function reportes_ventas_auditoria_controller_combo_distribuidor(){
        $anio = (int)$this->input->post('anio');
        $mes  = (int)$this->input->post('mes');

        $rows = $this->reportes_ventas_auditoria_model->combo_distribuidor($anio, $mes);

        $html = '<option value="0">'.$this->lang->line('data_table_js_lang_combo_todos').'</option>';

        foreach($rows as $row){
            $id     = (int)$this->obtener_valor_objeto($row, 'ID', 0);
            $codigo = trim((string)$this->obtener_valor_objeto($row, 'CODIGO', ''));
            $nombre = trim((string)$this->obtener_valor_objeto($row, 'NOMBRE', ''));

            if ($nombre === '') {
                $nombre = 'SIN NOMBRE';
            }

            $texto = ($codigo !== '') ? $codigo.' - '.$nombre : $nombre;

            $html .= '<option value="'.$id.'">'.$this->texto_html($texto, false).'</option>';
        }

        echo json_encode($html);
    }

    public function reportes_ventas_auditoria_controller_tabla(){
        $anio = (int)$this->input->post('anio');
        $mes  = (int)$this->input->post('mes');
        $dist = (int)$this->input->post('distribuidor');
        $est  = (int)$this->input->post('estatus');

        $rows = $this->reportes_ventas_auditoria_model->datos($anio, $mes, $dist, $est);

        $tabla = '';
        $contador = 1;

        foreach($rows as $row){
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

        $html = $this->load->view(
            'reportes/ventas/reportes_ventas_auditoria/reportes_ventas_auditoria_tabla_view',
            $data,
            TRUE
        );

        echo json_encode($html);
    }

    public function reportes_ventas_auditoria_controller_ticket_modal(){
           $id                 = $this->input->post('id',true);
        $row                = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_ticket_modal($id);
        $lista=$lista2="";
        $registroventa      = new DateTime($row->VentaFechaRegistro);
        $fecharegistro      = $registroventa->format('Y-m-d');        
        $data['id']         = $id;$total_monto = $total_cantidad_producto=0;
        $data['archivo']    = $row->VentaFotoTicket;
        $data['tabla_datos'] = '<tr>
        <td>'.$id.'</td>
        <td>'.utf8_encode(strtoupper($row->VentaUsuarioNombreMP)).'</td>
        <td class="txt-center">'.utf8_encode(strtoupper($row->VentaNumeroTicket)).'</td>
        <td class="txt-center">'.utf8_encode(strtoupper($row->VentaMontoTicket)).'</td>
        <td class="txt-center">'.utf8_encode(strtoupper($fecharegistro)).'</td></tr>';
        $resultados_tabla_detalle_ventas = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_detalle_ventas($id); 
        foreach ($resultados_tabla_detalle_ventas as $row) {  
            $total_producto =$row->VentaDetalleCantidad * $row->VentaDetalleMonto;
            $total_cantidad_producto = $total_cantidad_producto + $row->VentaDetalleCantidad;
                $lista2.= '<tr>
                    <td>'.utf8_encode(strtoupper($row->ProductoClaseDescripcion)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper($row->ProductoMarcaDescripcion)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaDetalleCantidad)).'</td>   
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaDetalleGalonDescripcion)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper(number_format($row->VentaDetalleMonto,2))).'</td>
                    <td class="txt-center">'.utf8_encode(number_format($total_producto,2)).'</td>
                </tr>' ;
                $total_monto = $total_monto + $total_producto;
        }
                $lista2.= '<tr>
                    <td></td>
                    <td class="txt-center">TOTAL PRODUCTOS:</td>
                    <td class="txt-center">'.$total_cantidad_producto.'</td>   
                    <td class="txt-center"></td>
                    <td class="txt-center">TOTAL TICKET:</td>
                    <td class="txt-center">'.utf8_encode(number_format($total_monto,2)).'</td>
                </tr>' ;         
        $data['tabla_productos'] = $lista2;     
        $resultados_tabla_promociones = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_promociones($id); 
        foreach ($resultados_tabla_promociones as $row) {  
                $lista.= '<tr>
                    <td>'.utf8_encode(strtoupper($row->VentaPromocionNombre)).'</td>
                    <td>'.utf8_encode(strtoupper($row->VentaPromocionDetalleDescripcion)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetalleGMC)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetalleCodigo)).'</td>   
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetallePresentacion)).'</td>
                    <td class="txt-center" style="margin: auto auto;">'.$row->VentaUsuarioPromocionCantidad.'</td>
                </tr>' ;
        }
        $data['tabla_productos_promocion'] = $lista;     
        $pag = $this->load->view('modals/modals_ventas/modals_ventas_auditoria/modals_ventas_auditoria_view', $data, true);
        echo json_encode($pag);   
    }

    private function normalizar_ruta_ticket_venta($archivo){
        $archivo = trim((string)$archivo);

        if ($archivo === '') {
            return '';
        }

        $archivo = str_replace('\\', '/', $archivo);
        $archivo = str_replace('\\\\', '/', $archivo);

        // Si por alguna razón viene una URL absoluta, se deja sólo la ruta relativa.
        $archivo = preg_replace('#^https?://[^/]+/#i', '', $archivo);
        $archivo = preg_replace('#^/+#', '', $archivo);

        // Corrige el caso reportado: uploads/ventas/tickets/uploads/ventas/...
        $archivo = preg_replace('#^uploads/ventas/tickets/(uploads/ventas/)#i', '$1', $archivo);

        // Corrige variantes con doble slash.
        $archivo = preg_replace('#/+#', '/', $archivo);

        // Si ya viene con la nueva estructura, se respeta.
        if (stripos($archivo, 'uploads/ventas/') === 0) {
            return $archivo;
        }

        // Si viene como ventas/2026/01/2532/ticket..., se completa con uploads/.
        if (stripos($archivo, 'ventas/') === 0) {
            return 'uploads/'.$archivo;
        }

        // Si viene sólo el nombre del archivo, se usa la ruta legacy.
        return 'uploads/ventas/tickets/'.$archivo;
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
