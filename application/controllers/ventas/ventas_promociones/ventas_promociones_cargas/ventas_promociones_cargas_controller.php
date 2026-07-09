<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_promociones_cargas_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->uniqueId = md5(uniqid(rand(), TRUE));
        $this->load->model('ventas/ventas_promociones/ventas_promociones_cargas/ventas_promociones_cargas_model');
    }    
    public function index(){//Pagina de Inicio 
        $this->base_controller_create_view_sistema('ventas/ventas_promociones/ventas_promociones_cargas/ventas_promociones_cargas_view');
    }
    public function ventas_promociones_cargas_controller_guarda_promocion(){
        $this->ventas_promociones_cargas_controller_set_rules();
        $res_errors = $this->ventas_promociones_cargas_controller_form_error();
        if ($res_errors==1){
            $data = $this->ventas_promociones_cargas_controller_cargar_excel();
            echo json_encode($data);
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }   
    }
    private function ventas_promociones_cargas_controller_set_rules() {
        $this->form_validation->set_rules('txt_promocion', $this->lang->line('ventas_promociones_cargas_placeholder_promocion'), 'required|xss_clean');
        $this->form_validation->set_rules('fechas', $this->lang->line('ventas_promociones_cargas_placeholder_rango_fechas'), 'required|xss_clean');
    }
    private function ventas_promociones_cargas_controller_form_error() {
        $json_txt_promocion = $json_fechas = array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('txt_promocion'))) { $json_txt_promocion =  array('txt_promocion' => form_error('txt_promocion', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('fechas'))) { $json_fechas =  array('fechas' => form_error('fechas', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_txt_promocion,$json_fechas);
            return $json;
        } else {             
            return 1; 
        }                
    } 
    public function ventas_promociones_cargas_controller_cargar_excel(){
        $productos_reposicion_carga_file_excel = $_FILES["ventas_promociones_cargas_controller_carga_file_excel"]["name"]; 
        $folder_excel = "ventas_promociones_cargas/";
        $folder = $this->base_controller_valida_crea_carpetas($folder_excel);
        $nombre_archivo = funciones_strategix_fecha_hora_actual()."_ventas_promociones_cargas";
        $resultado_carga = $this->base_controller_cargas_upload_archivo('ventas_promociones_cargas_controller_carga_file_excel',$folder,'xlsx',$nombre_archivo);
        if ($resultado_carga['resultado']==1){
            $resultado_carga_historial = $this->base_controller_historial_carga($productos_reposicion_carga_file_excel,$resultado_carga['file_name'],$folder,3);
            switch ($resultado_carga_historial['error']) {
                case 0:
                    $fechas = explode(" - ", $this->input->post('fechas',true));
                    $this->ventas_promociones_cargas_model->ventas_promociones_cargas_model_insert($resultado_carga_historial['cargaId'],strtoupper(utf8_decode($this->input->post('txt_promocion',true))),$fechas[0],$fechas[1]);
                    $tabla['tabla'] = $resultado_carga_historial['tabla']; $data['tabla'] = $this->load->view('ventas/ventas_promociones/ventas_promociones_cargas/ventas_promociones_cargas_tabla_view', $tabla, TRUE); 
                    $data['msg'] = $this->lang->line('ventas_promociones_cargas_msg_carga_exitosa');
                    $data['resultados'] = 1;
                    break;
                case -1:
                    $data['msg'] = $this->lang->line('ventas_promociones_cargas_msg_error_archivo_vacio');
                    $data['resultados'] = 0;
                    break;
                default:
                    $tabla['tabla'] = $resultado_carga_historial['tabla']; $data['tabla'] = $this->load->view('ventas/ventas_promociones/ventas_promociones_cargas/ventas_promociones_cargas_tabla_view', $tabla, TRUE); 
                    $data['msg'] = $this->lang->line('ventas_promociones_cargas_msg_error_archivo');
                    $data['resultados'] = 0;                    
                    break;
            }            
        } else {
            $data['msg'] = $this->lang->line('ventas_promociones_cargas_no_cargo');
            $data['resultados'] = 0;
            $data['tabla'] = '';
        }                
        return $data;
    } 
}