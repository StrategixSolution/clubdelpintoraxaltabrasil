<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller de Reportes de Distribuidores
 * 
 * Gestiona la generación de reportes de distribuidores con filtros dinámicos.
 * Optimizado para minimizar consultas a la base de datos mediante una 
 * consulta consolidada con JOINs y subconsultas.
 * 
 * Características de optimización:
 * - Eliminación del problema N+1 queries
 * - Una sola consulta para todos los datos necesarios
 * - Separación de lógica de negocio y presentación
 * - Uso de Query Builder de CodeIgniter para seguridad
 * 
 * @package    CodeIgniter
 * @subpackage Controllers
 * @category   Reportes
 * @author     Strategix
 * @version    2.0 - Optimizada
 */
class Reportes_distribuidores_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
         valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('reportes/reportes_distribuidores/reportes_distribuidores_model');
        
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('reportes/reportes_distribuidores/reportes_distribuidores_form_view');
    }

    
    /**
     * Genera el combo de distribuidores según el perfil del usuario
     */
    public function reportes_distribuidores_controller_cmb_distribuidor() {
        $perfil_id = $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));
        $distribuidores = $this->reportes_distribuidores_model->reportes_distribuidores_model_combo_distribuidor($perfil_id);
        
        $combo_distribuidores = '';
        
        // Solo administradores (perfiles 1,2,3) pueden ver opción "Todos"
        if (in_array($perfil_id, [1, 2, 3,10])) {
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
    /**
     * Genera el combo de años disponibles
     */
    public function reportes_distribuidores_controller_cmb_anio() {
        $anios = $this->reportes_distribuidores_model->reportes_distribuidores_model_cmbanios();
        
        $cmb_anio = '<option value="0">' . 
            $this->lang->line('reportes_distribuidores_controller_lang_combo_selecciona_anio_all') . 
            '</option>';
        
        foreach ($anios as $row) {
            $cmb_anio .= '<option value="' . $row->anio . '">' . $row->anio . '</option>';
        }
        
        echo json_encode($cmb_anio);
    }

    /**
     * Genera el combo de meses según el año seleccionado
     */
    public function reportes_distribuidores_controller_cmbmes() {
        $cmb_anio = $this->input->post('cmb_anio', true);
        $meses = $this->reportes_distribuidores_model->reportes_distribuidores_model_cmbmes($cmb_anio);
        
        $cmb_mes = '<option value="0">' . 
            $this->lang->line('reportes_distribuidores_controller_lang_combo_selecciona_mes_all') . 
            '</option>';
        
        foreach ($meses as $row) {
            $nombre_mes = strtoupper(funciones_strategix_mes_numero_texto($row->mes));
            $cmb_mes .= '<option value="' . $row->mes . '">' . $nombre_mes . '</option>';
        }
        
        echo json_encode($cmb_mes);
    }
    /**
     * Genera la tabla de distribuidores con filtros aplicados
     * Optimizado: Una sola consulta con toda la información necesaria
     */
    public function reportes_distribuidores_controller_tabla() {
        // Obtener y sanitizar datos del formulario
        $cmb_distribuidor = $this->input->post('cmb_distribuidor', true);
        $cmb_anio = $this->input->post('cmb_anio', true);
        $cmb_estatus = $this->input->post('cmb_estatus', true);
        $cmb_actividad = $this->input->post('cmb_actividad', true);
        $cmb_mes = ($cmb_anio != 0) ? $this->input->post('cmb_mes', true) : 0;
        
        // Construir cláusula WHERE con filtros
        $where = $this->_construir_filtros($cmb_distribuidor, $cmb_anio, $cmb_mes, $cmb_estatus, $cmb_actividad);
        
        // Obtener datos (UNA SOLA CONSULTA con toda la información)
        $distribuidores = $this->reportes_distribuidores_model->reportes_distribuidores_model_crea_tabla($where);
        // Preparar datos para la vista
        $data = [
            'anio' => $cmb_anio,
            'mes' => $cmb_mes,
            'distribuidores' => $distribuidores
        ];
        
        // Cargar vista y devolver HTML
        $tablareporte = $this->load->view('reportes/reportes_distribuidores/reportes_distribuidores_tabla_view', $data, true);
        echo json_encode($tablareporte);
    }
    
    /**
     * Construye la cláusula WHERE para los filtros
     * @return string Cláusula WHERE
     */
    private function _construir_filtros($cmb_distribuidor, $cmb_anio, $cmb_mes, $cmb_estatus, $cmb_actividad) {
        $where = '';
        
        // Filtro por distribuidor
        if ($cmb_distribuidor != 0) {
            $where .= ' AND d.DistribuidorId = ' . (int)$cmb_distribuidor;
        }
        
        // Filtro por año
        if ($cmb_anio != 0) {
            $where .= ' AND YEAR(dd.DistribuidorDetalleFechaAlta) = ' . (int)$cmb_anio;
        }
        
        // Filtro por mes
        if ($cmb_mes != 0) {
            $where .= ' AND MONTH(dd.DistribuidorDetalleFechaAlta) = ' . (int)$cmb_mes;
        }
        
        // Filtro por estatus (activo/inactivo)
        if ($cmb_estatus != 0) {
            switch ($cmb_estatus) {
                case 1:
                    $where .= ' AND (d.DistribuidorFechaBaja IS NULL)';
                    break;
                case 2:
                    $where .= ' AND (d.DistribuidorFechaBaja IS NOT NULL)';
                    break;
            }
        }
        
        // Filtro por actividad (activado/no activado)
        if ($cmb_actividad != 0) {
            switch ($cmb_actividad) {
                case 1:
                    $where .= ' AND (dd.DistribuidorDetalleFechaActivacion IS NULL)';
                    break;
                case 2:
                    $where .= ' AND (dd.DistribuidorDetalleFechaActivacion IS NOT NULL)';
                    break;
            }
        }
        
        return $where;
    }
}

