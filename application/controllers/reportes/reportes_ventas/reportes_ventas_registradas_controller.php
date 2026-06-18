<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_ventas_registradas_controller extends Base_Controller {

    public function __construct(){
        parent::__construct();
        valida_menus(get_class(), $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        control_modulos();
        $this->load->model('reportes/reportes_ventas/reportes_ventas_registradas_model');
    }

    private function session_value($key, $default = null)
    {
        $value = null;

        if (function_exists('funciones_strategix_sitio_alias')) {
            $alias = funciones_strategix_sitio_alias($key);
            $value = $this->session->userdata($alias);
        }

        if ($value === null || $value === '') {
            $value = $this->session->userdata($key);
        }

        return ($value === null || $value === '') ? $default : $value;
    }

    private function perfil_id_actual()
    {
        $perfilId = $this->session_value('s_perfil_id');

        if ($perfilId === null || $perfilId === '') {
            $perfilId = $this->session_value('s_id_perfil');
        }

        return (int)$perfilId;
    }

    private function perfil_nombre_actual()
    {
        $nombre = $this->session_value('s_perfil_nombre', '');

        if ($nombre === '') {
            $nombre = $this->session_value('s_perfil', '');
        }

        if ($nombre === '') {
            $nombre = $this->session_value('s_nombre_perfil', '');
        }

        return $this->texto_mayusculas($nombre);
    }

    /*
    |--------------------------------------------------------------------------
    | REGLAS DE COLUMNAS SEGÚN PROYECTO VIEJO
    |--------------------------------------------------------------------------
    |
    | Equivalencia detectada en migración:
    |
    | Proyecto viejo PerfilId 3 -> Proyecto nuevo PerfilId 5
    | Proyecto viejo PerfilId 4 -> Proyecto nuevo PerfilId 4
    | Proyecto viejo PerfilId 6 -> Proyecto nuevo PerfilId 7
    |
    | En el proyecto viejo:
    | - Perfil 3 y 4 no veían: Nombre Pintor, Ticket, Editar, Observaciones.
    | - Perfil 6 no veía: Venta Completa.
    |--------------------------------------------------------------------------
    */

    private function ocultar_columnas_pintor_ticket_observaciones()
    {
        $perfilId = $this->perfil_id_actual();
        $perfilNombre = $this->perfil_nombre_actual();

        // Viejo 3 y 4 => Nuevo 5 y 4
        if (in_array($perfilId, array(4, 5))) {
            return true;
        }

        // Respaldo por nombre de perfil
        if (strpos($perfilNombre, 'GERENTE') !== false) {
            return true;
        }

        if (strpos($perfilNombre, 'EJECUTIVO') !== false) {
            return true;
        }

        return false;
    }

    private function ocultar_columna_venta_completada()
    {
        $perfilId = $this->perfil_id_actual();
        $perfilNombre = $this->perfil_nombre_actual();

        // Viejo 6 => Nuevo 7
        if (in_array($perfilId, array(7))) {
            return true;
        }

        // Respaldo por nombre de perfil
        if (strpos($perfilNombre, 'PERSONAL') !== false && strpos($perfilNombre, 'TIENDA') !== false) {
            return true;
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS DE TEXTO
    |--------------------------------------------------------------------------
    */

    private function normalizar_texto($valor)
    {
        if ($valor === null) {
            return '';
        }

        $texto = trim((string)$valor);

        if ($texto === '') {
            return '';
        }

        /*
         * Evita doble codificación.
         * Si el texto ya viene en UTF-8, NO se aplica utf8_encode.
         * Esto corrige casos tipo: ÃNGEL.
         */
        if (function_exists('mb_detect_encoding')) {
            if (!mb_detect_encoding($texto, 'UTF-8', true)) {
                $texto = utf8_encode($texto);
            }
        }

        return $texto;
    }

    private function texto_mayusculas($valor)
    {
        $texto = $this->normalizar_texto($valor);

        if ($texto === '') {
            return '';
        }

        if (function_exists('mb_strtoupper')) {
            return mb_strtoupper($texto, 'UTF-8');
        }

        return strtoupper($texto);
    }

    private function celda($valor)
    {
        return htmlspecialchars($this->texto_mayusculas($valor), ENT_QUOTES, 'UTF-8');
    }

    /*
    |--------------------------------------------------------------------------
    | VISTAS / COMBOS
    |--------------------------------------------------------------------------
    */

    public function index(){
        $this->base_controller_create_view_sistema('reportes/reportes_ventas/reportes_ventas_registradas/reportes_ventas_registradas_view');
    }

    public function reportes_ventas_registradas_controller_combo_anio(){
        $cmb = "<option value=''>Año</option>";
        $rows = $this->reportes_ventas_registradas_model->combo_anios();

        foreach($rows as $r){
            $cmb .= "<option value='{$r->anio}'>{$r->anio}</option>";
        }

        echo json_encode($cmb);
    }

    public function reportes_ventas_registradas_controller_combo_mes(){
        $anio = (int)$this->input->post('anio', true);
        $cmb = "<option value='0'>Todo</option>";
        if ($anio <= 0){echo json_encode($cmb); return;}
        $rows = $this->reportes_ventas_registradas_model->combo_meses($anio);
        foreach($rows as $r){
            $mes = (int)$r->mes;
            $cmb .= "<option value='{$mes}'>".$this->celda(funciones_strategix_mes_numero_texto($mes))."</option>";
        }
        echo json_encode($cmb);
    }

    public function reportes_ventas_registradas_controller_combo_distribuidor(){
        $anio = (int)$this->input->post('anio', true);
        $mes  = (int)$this->input->post('mes', true);
        $perfil_id = $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));
        $distribuidores = $this->reportes_ventas_registradas_model->combo_distribuidores($anio, $mes,$perfil_id);
$combo_distribuidores = '';
        
        // Solo administradores (perfiles 1,2,3) pueden ver opción "Todos"
        if (in_array($perfil_id, [1, 2, 3])) {
            $combo_distribuidores .= '<option value="0">' . 
                $this->lang->line('reportes_distribuidores_controller_lang_select_combo_distribuidor') . 
                '</option>';
        }
        
        // Construir opciones del combo
        foreach ($distribuidores as $distribuidor) {
            $nombre = !empty($distribuidor->DistribuidorDetalleNombreComercial)
                ? $distribuidor->DistribuidorDetalleCodigo . ' - ' . $distribuidor->DistribuidorDetalleNombreComercial
                : $distribuidor->DistribuidorDetalleCodigo . ' - ' . $distribuidor->DistribuidorDetalleRazonSocial;
            
            $combo_distribuidores .= '<option value="' . $distribuidor->DistribuidorId . '">' . 
                strtoupper(utf8_encode($nombre)) . 
                '</option>';
        }
        
        echo json_encode($combo_distribuidores);
    }

    public function reportes_ventas_registradas_controller_combo_estatus(){
        $cmb = "<option value='0'>Todo</option>";
        $rows = $this->reportes_ventas_registradas_model->combo_estatus();

        foreach ($rows as $r){
            $cmb .= "<option value='{$r->id}'>".$this->celda($r->descripcion)."</option>";
        }

        echo json_encode($cmb);
    }

    /*
    |--------------------------------------------------------------------------
    | TABLA
    |--------------------------------------------------------------------------
    */

    public function reportes_ventas_registradas_controller_tabla(){
        $anio       = (int)$this->input->post('anio', TRUE);
        $mes        = (int)$this->input->post('mes', TRUE); // 0 = todo
        $distId     = (int)$this->input->post('distribuidor', TRUE); // 0 = todo
        $estatus    = (int)$this->input->post('estatus', TRUE); // 0 = todo

        /*if ($anio <= 0){
            echo json_encode(array(
                'tabla' => "<div class='alert alert-warning'>Selecciona el AÑO.</div>",
                'total' => 0
            ));
            return;
        }*/

        $rows = $this->reportes_ventas_registradas_model->datos($anio, $mes, $distId, $estatus);
        $totalVentas = count($rows);

        $ocultarPintorTicketObs = $this->ocultar_columnas_pintor_ticket_observaciones();
        $ocultarVentaCompletada = $this->ocultar_columna_venta_completada();

        $lista = "";

        foreach($rows as $r){
            $btnTicket = '<button type="button" class="btn btn-axalta btn-sm btn_ticket" data-venta="'.$r->ID.'">
                            <i class="txt-white fas fa-receipt"></i> <span class="txt-white">Ver ticket</span>
                        </button>';

            $totalTicket = '$ '.number_format((float)$r->TOTAL_TICKET, 2);

            $lista .= '<tr>';

            $lista .= '<td>'.$r->ID.'</td>';

            if (!$ocultarPintorTicketObs) {
                $lista .= '<td>'.$this->celda($r->NOMBRE_PINTOR).'</td>';
            }

            $lista .= '<td>'.$this->celda($r->EVENTO).'</td>';
            $lista .= '<td>'.$r->ID_DISTRIBUIDORA.'</td>';
            $lista .= '<td>'.$this->celda($r->CODIGO).'</td>';
            $lista .= '<td>'.$this->celda($r->RAZON_SOCIAL).'</td>';
            $lista .= '<td>'.$this->celda($r->NOMBRE_COMERCIAL).'</td>';
            $lista .= '<td>'.$this->celda($r->TIPO_DISTRIBUIDORA).'</td>';
            $lista .= '<td>'.$this->celda($r->REGION).'</td>';
            $lista .= '<td>'.$this->celda($r->CATEGORIA).'</td>';
            $lista .= '<td>'.$this->celda($r->EJECUTIVO).'</td>';
            $lista .= '<td>'.$this->celda($r->CIUDAD_ESTADO).'</td>';
            $lista .= '<td>'.$this->celda($r->NUM_TICKET).'</td>';
            $lista .= '<td>'.$totalTicket.'</td>';
            $lista .= '<td>'.$this->celda($r->FECHA_REGISTRO).'</td>';

            if (!$ocultarVentaCompletada) {
                $lista .= '<td>'.$this->celda($r->VENTA_COMPLETADA).'</td>';
            }

            $lista .= '<td>'.$this->celda($r->AUDITORIA).'</td>';

            if (!$ocultarPintorTicketObs) {
                $lista .= '<td>'.$btnTicket.'</td>';
              //  $lista .= '<td>----</td>';
                $lista .= '<td>'.$this->celda($r->OBSERVACIONES).'</td>';
            }

            $lista .= '</tr>';
        }

        $resp['tabla'] = $this->load->view(
            'reportes/reportes_ventas/reportes_ventas_registradas/reportes_ventas_registradas_tabla_view',
            array(
                'tabla' => $lista,
                'total' => $totalVentas,
                'ocultarPintorTicketObs' => $ocultarPintorTicketObs,
                'ocultarVentaCompletada' => $ocultarVentaCompletada
            ),
            true
        );

        $resp['total'] = $totalVentas;

        echo json_encode($resp);
    }

    /*
    |--------------------------------------------------------------------------
    | MODAL TICKET
    |--------------------------------------------------------------------------
    */

    public function reportes_ventas_registradas_controller_ticket(){
        $ventaId = (int)$this->input->post('ventaId', true);

        if ($ventaId <= 0){
            echo json_encode(array('html' => "<div class='alert alert-warning'>Ticket no válido.</div>"));
            return;
        }

        $data = $this->reportes_ventas_registradas_model->obtener_ticket($ventaId);

        if (!$data){
            echo json_encode(array('html' => "<div class='alert alert-warning'>No hay ticket disponible.</div>"));
            return;
        }

        if (!empty($data['base64'])){
            $mime = !empty($data['mime']) ? $data['mime'] : 'image/jpeg';
            $html = "<div class='text-center'>
                        <img src='data:{$mime};base64,{$data['base64']}' style='max-width:100%;border-radius:6px;' />
                    </div>";

            echo json_encode(array('html' => $html));
            return;
        }

        if (!empty($data['url'])){
            $url = funciones_strategix_version_url_random_base_url($data['url']);
            $html = "<div class='text-center'>
                        <img src='{$url}' style='max-width:100%;border-radius:6px;' />
                    </div>";

            echo json_encode(array('html' => $html));
            return;
        }

        echo json_encode(array('html' => "<div class='alert alert-warning'>No hay ticket disponible.</div>"));
    }
}