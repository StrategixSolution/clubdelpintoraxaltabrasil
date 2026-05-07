<?php

/* 
 * Sistema Web Responsivo CDPBR
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 15 jun. 2026 16:46:09 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_reposicion_carga_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('productos/productos_reposicion/productos_reposicion_carga_model');
    }    
    public function index(){//Pagina de Inicio 
        $data['sub_menu'] = ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==3)?$this->load->view('template/sistema/sub_menu/sub_menu_productos_reposicion_axalta', '', TRUE):$this->load->view('template/sistema/sub_menu/sub_menu_productos_reposicion', '', TRUE); 
        $this->base_controller_create_view_sistema('productos/productos_reposicion/productos_reposicion_carga/productos_reposicion_carga_form_view',$data);
    }
    public function productos_reposicion_carga_controller_excel(){
        $productos_reposicion_carga_file_excel = $_FILES["productos_reposicion_carga_file_excel"]["name"]; 
        $folder_excel = "productos_reposicion_carga/";
        $folder = $this->base_controller_valida_crea_carpetas($folder_excel);
        $nombre_archivo = funciones_strategix_fecha_hora_actual()."_productos_reposicion_carga";
        $resultado_carga = $this->base_controller_cargas_upload_archivo('productos_reposicion_carga_file_excel',$folder,'xlsx',$nombre_archivo);
        if ($resultado_carga['resultado']==1){
            $resultado_carga_historial = $this->base_controller_historial_carga($productos_reposicion_carga_file_excel,$resultado_carga['file_name'],$folder,1);
            switch ($resultado_carga_historial['error']) {
                case 0:
                    $this->productos_reposicion_carga_model->productos_reposicion_carga_model_insert($resultado_carga_historial['cargaId']);    
                    $tabla['tabla'] = $resultado_carga_historial['tabla']; $data['tabla'] = $this->load->view('productos/productos_reposicion/productos_reposicion_carga/productos_reposicion_carga_tabla_view', $tabla, TRUE); 
                    $data['msg'] = $this->lang->line('productos_reposicion_carga_controller_lang_msg_carga_exitosa');
                    $data['resultados'] = 1;
                    break;
                case -1:
                    $data['msg'] = $this->lang->line('productos_reposicion_carga_controller_lang_msg_error_archivo_vacio');
                    $data['resultados'] = 0;
                    break;
                default:
                    $tabla['tabla'] = $resultado_carga_historial['tabla']; $data['tabla'] = $this->load->view('productos/productos_reposicion/productos_reposicion_carga/productos_reposicion_carga_tabla_view', $tabla, TRUE); 
                    $data['msg'] = $this->lang->line('productos_reposicion_carga_controller_lang_msg_error_archivo');
                    $data['resultados'] = 0;                    
                    break;
            }            
        } else {
            $data['msg'] = $this->lang->line('productos_reposicion_carga_controller_lang_no_cargo');
            $data['resultados'] = 0;
            $data['tabla'] = '';
        }                
        echo json_encode($data);
    } 
}