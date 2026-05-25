<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_reposicion_descarga_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('productos/productos_reposicion/productos_reposicion_descarga/productos_reposicion_descarga_model');
    }    
    public function index(){//Pagina de Inicio    
        $data['sub_menu'] = '';//;($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==3)?$this->load->view('template/sistema/sub_menu/sub_menu_productos_reposicion_axalta', '', TRUE):$this->load->view('template/sistema/sub_menu/sub_menu_productos_reposicion', '', TRUE); 
        $this->base_controller_create_view_sistema('productos/productos_reposicion/productos_reposicion_descarga/productos_reposicion_descarga_view_form',$data);
    }

    //Obtenemos el año
    public function productos_reposicion_descarga_controller_cmb_anio (){       
        $cmb_anio ="<option  value='0'>".$this->lang->line('productos_reposicion_descarga_controller_lang_placeholder_anio')."</option>";         
        $anios = $this->productos_reposicion_descarga_model->productos_reposicion_descarga_model_fotos_anio();
        foreach ($anios as $row) {     
            $cmb_anio .="<option value=$row->ReposicionProductoFotoAnio>".$row->ReposicionProductoFotoAnio."</option>";
        }
        echo json_encode($cmb_anio);
    }

    //Obtenemos los bimestres a consultar
    public function productos_reposicion_descarga_controller_cmb_mes (){   
        $cmb_anio = $this->input->post('anio',true);
        $cmb_Mes ="<option  value='0'>".$this->lang->line('productos_reposicion_descarga_controller_lang_placeholder_mes')."</option>";   
        $meses = $this->productos_reposicion_descarga_model->productos_reposicion_descarga_model_fotos_mes($cmb_anio);
        foreach ($meses as $mes) {               
            if( ($mes->ReposicionProductoFotoMes % 2) == 0){
                //echo $actual ."-". $anterior."<br>";
                $cmb_Mes   .='<option value="'.$mes->ReposicionProductoFotoMes.'">'. funciones_strategix_mes_numero_texto($mes->ReposicionProductoFotoMes-1).' - '.funciones_strategix_mes_numero_texto($mes->ReposicionProductoFotoMes).'</option>';
            } 
        }
        echo json_encode($cmb_Mes);
    }
    
    public function productos_reposicion_descarga_controller_cmb_distribuidora() { 
         $cmb_anio = $this->input->post('anio',true);
        $cmb_mes = $this->input->post('mes',true);
       
       if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 6 or $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 7 or $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 8) {
            $cmbdistribuidora = '';
             $distribuidoras   = $this->productos_reposicion_descarga_model->productos_reposicion_descarga_model_distribuidoras_tienda($cmb_anio,$cmb_mes);
            foreach ($distribuidoras as $distribuidora) {         
               if($distribuidora->DistribuidorDetalleNombreComercial!=NULL){
                    $nombre = utf8_encode($distribuidora->DistribuidorDetalleNombreComercial);
                } else {
                    $nombre = utf8_encode($distribuidora->DistribuidorDetalleRazonSocial);
                }
             $cmbdistribuidora .="<option value=$distribuidora->DistribuidorId>".utf8_encode(strtoupper($distribuidora->DistribuidorDetalleCodigo))."-".$nombre."</option>";
        }
        } else {
             $distribuidoras  = $this->productos_reposicion_descarga_model->productos_reposicion_descarga_model_distribuidoras($cmb_anio,$cmb_mes);
        $cmbdistribuidora ="<option  value='0'>".$this->lang->line('productos_reposicion_descarga_controller_lang_placeholder_distribuidor')."</option>";
        foreach ($distribuidoras as $distribuidora) {         
               if($distribuidora->DistribuidorDetalleNombreComercial!=NULL){
                    $nombre = utf8_encode($distribuidora->DistribuidorDetalleNombreComercial);
                } else {
                    $nombre = utf8_encode($distribuidora->DistribuidorDetalleRazonSocial);
                }
             $cmbdistribuidora .="<option value=$distribuidora->DistribuidorId>".utf8_encode(strtoupper($distribuidora->DistribuidorDetalleCodigo))."-".$nombre."</option>";
        }
        }
        echo json_encode($cmbdistribuidora);
    }
    public function productos_reposicion_descarga_controller_cmb_tipo() {
        $cmb_tipo ="<option  value='0'>".$this->lang->line('productos_reposicion_descarga_controller_lang_placeholder_tipo')."</option>";
        $tipos  = $this->productos_reposicion_descarga_model->productos_reposicion_descarga_model_fotos_tipos();
        foreach ($tipos as $row) {            
            $cmb_tipo .="<option value=$row->ReposicionProductoFotoTipoId>$row->ReposicionProductoFotoTipoDescripcion</option>";
        }
        echo json_encode($cmb_tipo);
    }
    public function productos_reposicion_descarga_controller_descargar(){
        $archivos_zip = glob("uploads/reposicion_productos_captura/*.zip");
        if ($archivos_zip !== false) {
            foreach ($archivos_zip as $archivo_zip) {
                if (file_exists($archivo_zip)) {
                    unlink($archivo_zip);
                }
            }
        }

        $cmbAnio = $this->input->post("cmb_anio");
        $cmbMes  = $this->input->post("cmb_mes");
        $cmbDistribuidor = $this->input->post("cmb_distribuidora");
        $cmbtipo = $this->input->post("cmb_tipo");    

        if($cmbMes!=0){
            $mesAnt = $cmbMes - 1;
        }
        
        $lista=$where="";        
        $where .= ($cmbAnio!=0)?" AND ReposicionProductoFotoAnio = $cmbAnio":"";
        $where .= ($cmbMes!=0)?" AND ReposicionProductoFotoMes IN ( $cmbMes , $mesAnt  )":"";
        $where .= ($cmbDistribuidor!=0)?" AND DistribuidorId = $cmbDistribuidor":"";
        $where .= ($cmbtipo!=0)?" AND ReposicionProductoFotoTipoId = $cmbtipo":"";
        $descargas  = $this->productos_reposicion_descarga_model->productos_reposicion_descarga_model_datos_descarga($where);
        
        if ($descargas) {
        $zip = new ZipArchive();
        $this->base_controller_valida_crea_carpetas('reposicion_productos_captura');
        $this->base_controller_valida_crea_carpetas('reposicion_productos_captura/'.date('Y'));
        $this->base_controller_valida_crea_carpetas('reposicion_productos_captura/'.date('Y').'/'.date('m'));
        $direccion_documentos = $this->base_controller_valida_crea_carpetas('reposicion_productos_captura/'.date('Y').'/'.date('m').'/'.$cmbDistribuidor);
        $nombre = "productos_reposicion_descarga-".$cmbDistribuidor."-". funciones_strategix_fecha_hora_actual().".zip";
        $zip->open("uploads/reposicion_productos_captura/".$nombre,ZipArchive::CREATE);
        $data['nombre'] = "Productos_reposicion_descarga-".$cmbDistribuidor."-". funciones_strategix_fecha_hora_actual().".zip";
        switch ($this->input->post("cmb_tipo")) {
            case 0:
                $dir = 'TODOS';
                break;
            case 1:
                $dir = 'FOTOS';
                break;
            case 2:
            $dir = 'FIRMAS';
                break;
        };
        //$zip->addEmptyDir($dir);
        
        foreach ($descargas as $row) {
            #$mes = ( $cmbMes < 10 ) ? "0". $cmbMes:$cmbMes;     
            $mes = ( (int) $row->ReposicionProductoFotoMes < 10 ) ? "". $row->ReposicionProductoFotoMes : $row->ReposicionProductoFotoMes;      
            //if($zip->addEmptyDir($dir."/".$cmbAnio.'/'.$mes.'/'.$row->DistribuidorId)){
                $archivo = 'uploads/reposicion_productos_captura/'.$cmbAnio.'/'.$mes.'/'.$row->DistribuidorId.'/'.$row->ReposicionProductoFotoModificada;
                $carpeta = $dir."/".$cmbAnio.'/'.$mes.'/'.$row->DistribuidorId.'/'.$row->ReposicionProductoFotoModificada;
                $zip->addFile($archivo , $carpeta);            
            //};       
        }
        $zip->close();
        $direccion = funciones_strategix_version_url_random_base_url('uploads/reposicion_productos_captura/'.$nombre);
        $data['url'] = $direccion;
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment; filename=".$nombre);
        }
        else{
            $data = 0;
        }

      //  print_r($this->db->last_query()) ;
      // die;

        
        
//        readfile('uploads/reposicion_productos_captura/Productos_reposicion_descarga.zip');
        echo json_encode($data);
    }
}