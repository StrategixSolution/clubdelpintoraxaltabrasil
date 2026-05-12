<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 ABRIL 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Recompensas_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct();        
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->uniqueId = md5(uniqid(rand(), TRUE));
        $this->load->model('recompensas/recompensas_model');
    }    
    public function index(){//Pagina de Inicio  
        $this->base_controller_create_view_sistema('recompensas/recompensas_view_form');
    }
    public function recompensas_controller_cmb_ano(){
       // $ano = date('Y');
	   $ano = date('Y')-5;
        $cmb_Ano ="<option  value='0'>".$this->lang->line('recompensas_controller_placeholder_anio')."</option>";         
        for($limit = 0;$limit<6;$limit++) {    
            $fechaAno = $ano+$limit;
            $cmb_Ano .="<option value=$fechaAno>$fechaAno</option>";
        }
        echo json_encode($cmb_Ano);
    }
    public function recompensas_controller_cmb_mes (){       
        $cmb_Mes ="<option  value='0'>".$this->lang->line('recompensas_controller_placeholder_mes')."</option>";         
        for($limit = 2;$limit<=12;$limit=$limit+2) {    
           $cmb_Mes .="<option value=$limit>".strtoupper(funciones_strategix_mes_numero_texto($limit-1))."-".strtoupper(funciones_strategix_mes_numero_texto($limit))."</option>";
        }
        echo json_encode($cmb_Mes);
    }
    public function recompensas_controller_form_validate() {   
        $this->recompensas_controller_set_rules();
        $res_errors = $this->recompensas_controller_form_error();
        if ($res_errors==1){             
            for($i=1;$i<=5;$i++){                
                if ($this->recompensas_model->recompensas_model_repetidos($this->input->post('cmb_anio',TRUE),$this->input->post('cmb_mes',TRUE),$i)==0){
                    if (trim($this->input->post('txt_rango_inicial_'.$i,TRUE))!="" && trim($this->input->post('txt_rango_final_'.$i,TRUE))!="") {                    
                        $a = $i-1;
                        if ($a==0){
                            $validacion  = trim($this->input->post('txt_rango_inicial_'.$i,TRUE)) < trim($this->input->post('txt_rango_final_'.$i,TRUE));                                 
                        }else{
                           $validacion = trim($this->input->post('txt_rango_inicial_'.$i,TRUE)) < trim($this->input->post('txt_rango_final_'.$i,TRUE)) && trim($this->input->post('txt_rango_inicial_'.$a,TRUE)) > trim($this->input->post('txt_rango_inicial_'.$i,TRUE)) && trim($this->input->post('txt_rango_final_'.$i,TRUE)) < trim($this->input->post('txt_rango_final_'.$a,TRUE)) && trim($this->input->post('txt_rango_inicial_'.$a,TRUE)) > trim($this->input->post('txt_rango_final_'.$i,TRUE));
                        }
                        if ($validacion) {
                            $valido = true;
                        }else{
                            $data['msg'] = $this->lang->line('recompensas_controller_mes_valores_mayores')." ".$i." ".$this->lang->line('recompensas_controller_mes_valores_mayores_2')." ".$a." ".$this->lang->line('recompensas_controller_mes_valores_mayores_3')." ".$i;
                            $data['resultados'] = 0;
                            $valido = false; echo json_encode($data); return false;
                        }
                    }
                }else{                              
                    $data['msg'] = $this->lang->line('recompensas_controller_mes_repetido');
                    $data['resultados'] = 0;
                    $valido = false; echo json_encode($data); return false;
                }
            }
            if($valido = true){
                for($x=1;$x<=5;$x++){
                    if (trim($this->input->post('txt_rango_inicial_'.$x,TRUE))!="" && trim($this->input->post('txt_rango_final_'.$x,TRUE))!=""){
                        $valoresProductos= "".trim($this->input->post('cmb_anio',TRUE)).",".trim($this->input->post('cmb_mes',TRUE)).",".$x.",".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
                        $valores = trim($this->input->post('cmb_anio',TRUE)).",".trim($this->input->post('cmb_mes',TRUE)).",".$x.",".trim($this->input->post('txt_rango_inicial_'.$x,TRUE)).",".trim($this->input->post('txt_rango_final_'.$x,TRUE)).",".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",2";
                        $this->recompensas_model->recompensas_model_carga_simple($valores);                   
                        $this->recompensas_model->recompensas_model_carga_ReposicionesProductosPremios_simple($valoresProductos);
                    }
                }
                $data['resultados'] = 1;    echo json_encode($data);                        
            }
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }     
    }
    private function recompensas_controller_set_rules() {
        $this->form_validation->set_rules('cmb_anio', $this->lang->line('recompensas_controller_placeholder_anio'), 'required|callback_recompensas_controller_valida_combo_anio');
        $this->form_validation->set_rules('cmb_mes', $this->lang->line('recompensas_controller_placeholder_mes'), 'required|callback_recompensas_controller_valida_combo_mes');
        $this->form_validation->set_rules('txt_rango_inicial_1', $this->lang->line('recompensas_controller_tabla_rango_ini'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_rango_final_1', $this->lang->line('recompensas_controller_tabla_rango_fin'), 'required|xss_clean');
        if(trim($this->input->post('txt_rango_inicial_2',TRUE)!= "")){
             $this->form_validation->set_rules('txt_rango_inicial_2', $this->lang->line('recompensas_controller_tabla_rango_ini'), 'required|xss_clean');
             $this->form_validation->set_rules('txt_rango_final_2', $this->lang->line('recompensas_controller_tabla_rango_fin'), 'required|xss_clean');
        }
        if(trim($this->input->post('txt_rango_inicial_3',TRUE)!= "")){
             $this->form_validation->set_rules('txt_rango_inicial_3', $this->lang->line('recompensas_controller_tabla_rango_ini'), 'required|xss_clean');
             $this->form_validation->set_rules('txt_rango_final_3', $this->lang->line('recompensas_controller_tabla_rango_fin'), 'required|xss_clean');
        }
        if(trim($this->input->post('txt_rango_inicial_4',TRUE)!= "")){
             $this->form_validation->set_rules('txt_rango_inicial_4', $this->lang->line('recompensas_controller_tabla_rango_ini'), 'required|xss_clean');
             $this->form_validation->set_rules('txt_rango_final_4', $this->lang->line('recompensas_controller_tabla_rango_fin'), 'required|xss_clean');
        }
        if(trim($this->input->post('txt_rango_inicial_5',TRUE)!= "")){
             $this->form_validation->set_rules('txt_rango_inicial_5', $this->lang->line('recompensas_controller_tabla_rango_ini'), 'required|xss_clean');
             $this->form_validation->set_rules('txt_rango_final_5', $this->lang->line('recompensas_controller_tabla_rango_fin'), 'required|xss_clean');
        }
    }
    private function recompensas_controller_form_error() {
        $json = $json_cmbanio = $json_cmbmes = $json_rango_inicial1 = $json_rango_inicial2 = $json_rango_inicial3 = $json_rango_inicial4 = $json_rango_inicial5 = $json_rango_final1 = $json_rango_final2 = $json_rango_final3 = $json_rango_final4 = $json_rango_final5 = array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('cmb_anio'))) { $json_cmbanio =  array('cmb_anio' => form_error('cmb_anio', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('cmb_mes'))) { $json_cmbmes =  array('cmb_mes' => form_error('cmb_mes', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_inicial_1'))) { $json_rango_inicial1 =  array('txt_rango_inicial_1' => form_error('txt_rango_inicial_1', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_final_1'))) { $json_rango_final1 =  array('txt_rango_final_1' => form_error('txt_rango_final_1', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_inicial_2'))) { $json_rango_inicial1 =  array('txt_rango_inicial_2' => form_error('txt_rango_inicial_2', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_final_2'))) { $json_rango_final1 =  array('txt_rango_final_2' => form_error('txt_rango_final_2', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_inicial_3'))) { $json_rango_inicial1 =  array('txt_rango_inicial_3' => form_error('txt_rango_inicial_3', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_final_3'))) { $json_rango_final1 =  array('txt_rango_final_3' => form_error('txt_rango_final_3', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_inicial_4'))) { $json_rango_inicial1 =  array('txt_rango_inicial_4' => form_error('txt_rango_inicial_4', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_final_4'))) { $json_rango_final1 =  array('txt_rango_final_4' => form_error('txt_rango_final_4', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_inicial_5'))) { $json_rango_inicial1 =  array('txt_rango_inicial_5' => form_error('txt_rango_inicial_5', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_rango_final_5'))) { $json_rango_final1 =  array('txt_rango_final_5' => form_error('txt_rango_final_5', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_cmbanio , $json_cmbmes , $json_rango_inicial1 , $json_rango_inicial2 , $json_rango_inicial3 , $json_rango_inicial4 , $json_rango_inicial5 , $json_rango_final1 , $json_rango_final2 , $json_rango_final3 , $json_rango_final4 , $json_rango_final5);
            return $json;
        } else {             
            return 1; 
        }                
    }
    public function recompensas_controller_valida_combo_anio($post_string){
        if ($post_string==0){ $this->form_validation->set_message('recompensas_controller_valida_combo_anio', $this->lang->line('recompensas_controller_placeholder_anio')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function recompensas_controller_valida_combo_mes($post_string){
        if ($post_string==0){ $this->form_validation->set_message('recompensas_controller_valida_combo_mes', $this->lang->line('recompensas_controller_placeholder_mes')); $response = FALSE; } else { $response = TRUE; }return $response;
    }
    public function recompensas_controller_extraer_datos_excel(){
        $recompensas_carga_file_excel = $_FILES["recompensas_view_form_file_excel"]["name"]; 
        $folder_excel = "recompensas_carga/";
        $folder = $this->base_controller_valida_crea_carpetas($folder_excel);
        $nombre_archivo = funciones_strategix_fecha_hora_actual()."_recompensas_carga";
        $resultado_carga = $this->base_controller_cargas_upload_archivo('recompensas_view_form_file_excel',$folder,'xlsx',$nombre_archivo);
        if ($resultado_carga['resultado']==1){
            $resultado_carga_historial = $this->base_controller_historial_carga($recompensas_carga_file_excel,$resultado_carga['file_name'],$folder,2);
            switch ($resultado_carga_historial['error']) {
                case 0:
                    $this->recompensas_model->recompensas_model_carga_excel($resultado_carga_historial['cargaId']);                   
                    $this->recompensas_model->recompensas_model_carga_ReposicionesProductosPremios($resultado_carga_historial['cargaId']);
                    $tabla['tabla'] = $resultado_carga_historial['tabla']; $data['tabla'] = $this->load->view('recompensas/recompensas_view_tabla', $tabla, TRUE); 
                    $data['msg'] = $this->lang->line('recompensas_controller_msg_carga_exitosa');
                    $data['resultados'] = 1;
                    break;
                case 1:
                    $data['msg'] = $this->lang->line('recompensas_controller_msg_error_archivo_vacio');
                    $data['resultados'] = 0;
                    break;
                default:
                    $tabla['tabla'] = $resultado_carga_historial['tabla']; $data['tabla'] = $this->load->view('recompensas/recompensas_view_tabla', $tabla, TRUE); 
                    $data['msg'] = $this->lang->line('recompensas_controller_msg_error_archivo');
                    $data['resultados'] = 0;                    
                    break;
            }
        } else {
            $data['msg'] = $this->lang->line('recompensas_controller_no_cargo');
            $data['resultados'] = 0;
            $data['tabla'] = '';
        }                
        echo json_encode($data);
    }
}