<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multimedios_cargas_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('multimedios/multimedios_cargas_model');
    }    
    public function index(){//Pagina de Inicio
        $this->multimedios_cargas_controller_actualiza_estatus();
        $this->base_controller_create_view_sistema('multimedios/multimedios_cargas_form_view');        
    }
    public function multimedios_cargas_controller_combo_modulos() {
        $cmb_modulos ="<option  value='0'>".$this->lang->line('multimedios_cargas_controller_lang_placeholder_modulos')."</option>";       
        $modulos        = $this->multimedios_cargas_model->multimedios_cargas_model_combo_modulos();
        foreach ($modulos as $row) { $cmb_modulos .="<option value=$row->CargaMultimediaModuloId>".utf8_encode($row->CargaMultimediaModuloDescripcion)."</option>"; }
        echo json_encode($cmb_modulos);
    }
    public function multimedios_cargas_controller_combo_tipos() {
        $modulo = $this->input->post("multimedios_cargas_form_view_cmb_modulos",true);$where="";
        switch ($modulo) {
            case 2: $where=" WHERE CargaMultimediaTipoId =3"; break; 
            case 3: $where=" WHERE CargaMultimediaTipoId IN (1,2)"; break; 
        }
        $cmb_tipos ="<option  value='0'>".$this->lang->line('multimedios_cargas_controller_lang_placeholder_tipos')."</option>";       
        $tipos     = $this->multimedios_cargas_model->multimedios_cargas_model_combo_tipos($where);
        foreach ($tipos as $row) {  $cmb_tipos .="<option value=$row->CargaMultimediaTipoId>".utf8_encode($row->CargaMultimediaTipoDescripcion)."</option>"; }
        echo json_encode($cmb_tipos);
    }
    public function multimedios_cargas_controller_combo_noticia_tipos() {
        $cmb_noticia_tipos ="";//"<option  value='0'>SELECCIONE UN TIPO</option>";       
        $noticia_tipos     = $this->multimedios_cargas_model->multimedios_cargas_model_combo_noticia_tipos();
        foreach ($noticia_tipos as $row) {  $cmb_noticia_tipos .="<option value=$row->CargaMultimediaNoticiasTipoId>".utf8_encode($row->CargaMultimediaNoticiasTipoDescripcion)."</option>"; }
        echo json_encode($cmb_noticia_tipos);
    }
    public function multimedios_cargas_controller_lista_perfiles() {   
        $perfiles     = $this->multimedios_cargas_model->multimedios_cargas_model_lista_perfiles();
        $check_perfiles[0] = $this->lang->line('multimedios_cargas_controller_lang_etiqueta_todos');
        foreach ($perfiles as $row) { $check_perfiles[$row->PerfilId] =utf8_encode(strtoupper($row->PerfilDescripcion)); }
//        print_r($check_perfiles);
        echo json_encode($check_perfiles);
    }
    public function multimedios_cargas_controller_combo_tipo_video() {
        $cmb_tipo_video = "";       
        $tipos_videos   = $this->multimedios_cargas_model->multimedios_cargas_model_combo_tipos_videos();
        foreach ($tipos_videos as $row) { if($row->CargaMultimediaVideoTipoId==1){ $sel = "SELECTED"; } else { $sel = ""; } $cmb_tipo_video .="<option value='$row->CargaMultimediaVideoTipoId' $sel>".$row->CargaMultimediaVideoTipoDescripcion."</option>"; }
        echo json_encode($cmb_tipo_video);
    }    
    public function multimedios_cargas_controller_form_tabla() {
        $modulos = $this->input->post("modulos",true);
        switch ($modulos) {
            case 1: $form2 = $this->load->view('multimedios/multimedios_cargas_form_popups_view','',true); break;
            case 2: $form2 = $this->load->view('multimedios/multimedios_cargas_form_notificaciones_view','',true); break;
            case 3: $form2 = $this->load->view('multimedios/multimedios_cargas_form_tutoriales_view','',true); break;
        }
        $datos['form2'] = $form2;
        $datos['tabla'] = $this->multimedios_cargas_controller_tabla($modulos);
        echo json_encode($datos);
    }
    private function multimedios_cargas_controller_tabla($modulos) {
        $lista = "";
        $multimedios        = $this->multimedios_cargas_model->multimedios_cargas_model_multimedios($modulos);
        foreach ($multimedios as $row) {  
               if ($row->CargaMultimediaDownload == 1) {                    
                      $download = $this->lang->line('multimedios_cargas_controller_lang_etiqueta_si');
                 } else {
                      $download = $this->lang->line('multimedios_cargas_controller_lang_etiqueta_no');
                 }
            $perfiles = $this->multimedios_cargas_model->multimedios_cargas_model_perfiles($row->CargaMultimediaId);
            $perfil = "";
            foreach ($perfiles as $perfilesrow) {$perfil .= $perfilesrow->PerfilDescripcion . ", "; }
            $perfil = substr($perfil, 0, -2);
            $dateI = date_create($row->CargaMultimediaFechaInicial);
            $dateF = date_create($row->CargaMultimediaFechaFinal);
            $fecha_inicio = date_format($dateI, 'Y/m/d');
            $fecha_fin = date_format($dateF, 'Y/m/d');
            if ($row->CargaMultimediaFechaBaja==""){
                $baja_btn = '<a href="javascript:multimedios_cargas_form_view_js_baja('.$row->CargaMultimediaId.','.$modulos.')"><i class="fas fa-trash"></i></a>';
                $estatus = $this->lang->line('multimedios_cargas_controller_lang_etiqueta_si');
            } else {
                $baja_btn = "";
                $estatus = $this->lang->line('multimedios_cargas_controller_lang_etiqueta_no');
            }
            $CargaMultimediaFechaRegistro = date("Y-m-d", strtotime($row->CargaMultimediaFechaRegistro));
            $lista.= '<tr">                    
                        <td>'.$row->CargaMultimediaId.'</td>
                          <td>'.utf8_encode($perfil).'</td> 
                           <td>'.$fecha_inicio.'</td> 
                            <td>'.$fecha_fin.'</td>
                            <td>'.$download.'</td>
                            <td class="txt-center"><a href= "javascript:multimedios_cargas_tabla_view_js_modal_imagen(\'' . $row->CargaMultimediaRuta . '\', ' . $row->CargaMultimediaTipoId . ');"><i class="fas fa-eye"></i></a></td>'. 
                        '<td>'.$row->CargaMultimediaThumbnail.'</td> 
                        <td>'.utf8_encode($row->htmltext).'</td>
                        <td>'.$CargaMultimediaFechaRegistro.'</td>
                        <td>'.utf8_encode($row->CargaMultimediaTipoDescripcion).'</td>
                        <td>'.utf8_encode($row->CargaMultimediaModuloDescripcion).'</td>
                        <td>'.utf8_encode($row->CargaMultimediaVideoTipoDescripcion).'</td>        
                        <td>'.$estatus.'</td>
                        <td class="linkbaja txt-center">'.$baja_btn.'</td>  
                      </tr>' ;
        } 
        $data['tabla']  = $lista;
        return $this->load->view('multimedios/multimedios_cargas_tabla_view', $data, true);        
    }
    public function multimedios_cargas_controller_guarda() {
        $folder_archivo = $textarea = $tipos = $modulos = $fecha_inicio = $fecha_fin = $download = $folder = $extension = $extension2 ="";
        $modulos = $this->input->post("multimedios_cargas_form_view_cmb_modulos",true);
        $tipos = $this->input->post("multimedios_cargas_form_view_cmb_tipos",true); 
        $tipo_noticias = $this->input->post("multimedios_cargas_form_view_cmb_noticia_tipos",true); 
        $fecha_inicio = $this->input->post("multimedios_cargas_form_view_fecha_inicio",true); 
        $fecha_fin = $this->input->post("multimedios_cargas_form_view_fecha_fin",true); 
        $download = $this->input->post("multimedios_cargas_form_view_chk_descarga",true);
        switch ($modulos) {
            case 1:  
                $folder_archivo = "popups/";
                $folder = $this->base_controller_valida_crea_carpetas($folder_archivo);
                if ($tipos==4){
                    $textarea = $this->input->post("multimedios_cargas_form_view_text_area",true);
                    $resultado = $this->multimedios_cargas_controller_valida_popup_html($textarea, $tipos, $modulos,$fecha_inicio,$fecha_fin,$download); 
                } else {
                    if ($_FILES["multimedios_cargas_form_view_file"]["name"]=="")
                        { $extension = ""; } 
                    else { $file_array = pathinfo($_FILES["multimedios_cargas_form_view_file"]["name"]); $extension = $file_array["extension"];}
                    $resultado = $this->multimedios_cargas_controller_valida_popup_archivos($tipos, $modulos,$folder_archivo,$folder,$extension,1,$fecha_inicio,$fecha_fin,$download); 
                }              
                break;
            case 2:
                $folder_archivo = "noticias/";
                $folder = $this->base_controller_valida_crea_carpetas($folder_archivo);   
               // $texto = $this->input->post("multimedios_cargas_form_view_txt_titulo",true);
                if ($tipos==4){
                   // if ($_FILES["multimedios_cargas_form_view_file2"]["name"]==""){ $extension2 = ""; } else { $file_array2 = pathinfo($_FILES["multimedios_cargas_form_view_file2"]["name"]); $extension2 = $file_array2["extension"];}
                } else {
                    if ($_FILES["multimedios_cargas_form_view_file"]["name"]=="")
                        { $extension = ""; } 
                    else { $file_array = pathinfo($_FILES["multimedios_cargas_form_view_file"]["name"]); $extension = $file_array["extension"];}
                  //  if ($_FILES["multimedios_cargas_form_view_file2"]["name"]==""){ $extension2 = ""; } else { $file_array2 = pathinfo($_FILES["multimedios_cargas_form_view_file2"]["name"]); $extension2 = $file_array2["extension"];}
                $resultado = $this->multimedios_cargas_controller_valida_notificaciones_archivos($tipos, $modulos,$folder_archivo,$folder,$extension,1,$fecha_inicio,$fecha_fin,$download,$tipo_noticias);        
                }      
                break;
            case 3:
                $tipos_videos = $this->input->post("multimedios_cargas_form_view_cmb_tipo_video",true); 
                $texto = $this->input->post("multimedios_cargas_form_view_txt_titulo",true); 
                $folder_archivo = "tutoriales/";
                $folder = $this->base_controller_valida_crea_carpetas($folder_archivo); 
                if ($_FILES["multimedios_cargas_form_view_file"]["name"]==""){ $extension = ""; } else { $file_array = pathinfo($_FILES["multimedios_cargas_form_view_file"]["name"]); $extension = $file_array["extension"];}
                $resultado = $this->multimedios_cargas_controller_valida_tutoriales_archivos($tipos, $modulos,$folder_archivo,$folder,$extension,$tipos_videos,strtoupper($texto),$fecha_inicio,$fecha_fin,$download);                
                break;
        }
        if ($resultado==1){
            $datos['resultado'] = 1;
            $datos['tabla'] = $this->multimedios_cargas_controller_tabla($modulos);
            echo json_encode($datos);
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($resultado)); 
        }
    }
    private function multimedios_cargas_controller_guarda_base_datos($CargaMultimediaRuta,$CargaMultimediaExtencion,$CargaMultimediaThumbnail,$CargaMultimediaTexto,$CargaMultimediaTipoId,$CargaMultimediaModuloId,$tipos_videos=1,$fecha_inicio,$fecha_fin,$download,$tipo_noticias) {        
        $datos_insert   = "'$CargaMultimediaRuta','$CargaMultimediaExtencion','$CargaMultimediaThumbnail','$CargaMultimediaTexto',$CargaMultimediaTipoId,$CargaMultimediaModuloId,$tipos_videos,'".$fecha_inicio."','".$fecha_fin."','".$download."',$tipo_noticias";
        $id             = $this->multimedios_cargas_model->multimedios_cargas_model_insert_datos($datos_insert);
        $perfiles       = $this->multimedios_cargas_model->multimedios_cargas_model_lista_perfiles();
        foreach ($perfiles as $row) { 
            if ($this->input->post("check_perfil_".$row->PerfilId)==$row->PerfilId){ $this->multimedios_cargas_model->multimedios_cargas_model_insert_perfiles($id,$row->PerfilId); }     
        }
        return 1;
    }
    public function multimedios_cargas_controller_valida_popup_html($textarea, $tipos, $modulos,$fecha_inicio,$fecha_fin,$download) {
        $this->multimedios_cargas_controller_valida_popup_html_set_rules();
        $res_errors = $this->multimedios_cargas_controller_valida_popup_html_form_error();
        if ($res_errors==1){ 
            $textarea_trim = trim($textarea); $textarea_utf8_decode = utf8_decode($textarea_trim); $textarea = strtoupper($textarea_utf8_decode);
            $this->multimedios_cargas_controller_guarda_base_datos("-","-","-",$textarea, $tipos, $modulos,1,$fecha_inicio,$fecha_fin,$download,0);
            return 1;
        } else {
            return $res_errors; 
        }        
    }
    private function multimedios_cargas_controller_valida_popup_html_set_rules() {
        $this->form_validation->set_rules('multimedios_cargas_form_view_text_area', 'TEXTO', 'required');
    }
    private function multimedios_cargas_controller_valida_popup_html_form_error() {
        $json_multimedios_cargas_form_view_text_area =array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('multimedios_cargas_form_view_text_area'))) { $json_multimedios_cargas_form_view_text_area =  array('multimedios_cargas_form_view_text_area' => form_error('multimedios_cargas_form_view_text_area', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_multimedios_cargas_form_view_text_area);
            return $json;
        } else {             
            return 1; 
        }                
    }
    public function multimedios_cargas_controller_valida_popup_archivos($tipos, $modulos,$folder_archivo,$folder,$extencion,$tipos_videos=1,$fecha_inicio,$fecha_fin,$download) {
        $this->multimedios_cargas_controller_valida_popup_archivo_set_rules($tipos);
        $res_errors = $this->multimedios_cargas_controller_valida_popup_archivo_form_error();
        if ($res_errors==1){        
                switch ($tipos) {
                    case 1:
                        $nombre_archivo = funciones_strategix_fecha_hora_actual()."_popup_video";                      
                        break;
                    case 2: 
                        $nombre_archivo = funciones_strategix_fecha_hora_actual()."_popup_pdf";
                        break;
                    case 3: 
                        $nombre_archivo = funciones_strategix_fecha_hora_actual()."_popup_imagen";
                        break;
                }
               //  print_r($nombre_archivo);die;
                $resultado_carga = $this->base_controller_cargas_upload_archivo('multimedios_cargas_form_view_file',$folder,$extencion,$nombre_archivo);
             /*   if($resultado_carga!=1){
                    return $resultado_carga;
                }else{
                    $resultado = $this->multimedios_cargas_controller_guarda_base_datos("uploads/".$folder_archivo.$nombre_archivo.".".$extencion,".".$extencion,"-","-", $tipos, $modulos,$tipos_videos,$fecha_inicio,$fecha_fin);                  
                    return 1;
                }*/
                $resultado = $this->multimedios_cargas_controller_guarda_base_datos("uploads/".$folder_archivo.$nombre_archivo.".".$extencion,".".$extencion,"-","-", $tipos, $modulos,$tipos_videos,$fecha_inicio,$fecha_fin,$download,0);                  
            return 1;
        } else {
            return $res_errors; 
        }        
    }
    private function multimedios_cargas_controller_valida_popup_archivo_set_rules() {    
        $this->form_validation->set_rules('multimedios_cargas_form_view_file', 'ARCHIVO', 'callback_multimedios_cargas_controller_valida_popup_archivo_tipo');
    }
    private function multimedios_cargas_controller_valida_popup_archivo_form_error() {
        $json_multimedios_cargas_form_view_file =array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('multimedios_cargas_form_view_file'))) { $json_multimedios_cargas_form_view_file =  array('multimedios_cargas_form_view_file' => form_error('multimedios_cargas_form_view_file', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_multimedios_cargas_form_view_file);
            return $json;
        } else {             
            return 1; 
        }                
    }
    public function multimedios_cargas_controller_valida_popup_archivo_tipo(){ 
        if ($_FILES["multimedios_cargas_form_view_file"]["name"]==""){ 
            $this->form_validation->set_message('multimedios_cargas_controller_valida_popup_archivo_tipo', $this->lang->line('multimedios_cargas_controller_lang_js_archivo_validar')); return FALSE;          
        } else { 
            $tipos = $this->input->post("multimedios_cargas_form_view_cmb_tipos",true);
            $file_array = pathinfo($_FILES["multimedios_cargas_form_view_file"]["name"]);
            switch ($tipos) {
                case 1:
                    $msg_error = $this->lang->line('multimedios_cargas_controller_lang_js_archivo_valida_video');
                    if ("mp4"!=$file_array["extension"]){ $this->form_validation->set_message('multimedios_cargas_controller_valida_popup_archivo_tipo', $msg_error); $response = FALSE;  } else { $response = TRUE; }
                    break;
                case 2: 
                    $msg_error = $this->lang->line('multimedios_cargas_controller_lang_js_archivo_valida_pdf');
                    if ("pdf"!=$file_array["extension"]){ $this->form_validation->set_message('multimedios_cargas_controller_valida_popup_archivo_tipo', $msg_error); $response = FALSE;  } else { $response = TRUE; }
                    break;
                case 3: 
                    $msg_error = $this->lang->line('multimedios_cargas_controller_lang_js_archivo_valida_imagen');
                    if ("jpg"==$file_array["extension"] or "png"==$file_array["extension"]){ $response = TRUE; } else { $this->form_validation->set_message('multimedios_cargas_controller_valida_popup_archivo_tipo', $msg_error); $response = FALSE;  }
                    break;
            }           
            return $response;
        }
    }   
    public function multimedios_cargas_controller_valida_tutoriales_archivos($tipos, $modulos,$folder_archivo,$folder,$extencion,$tipos_videos=1,$texto,$fecha_inicio,$fecha_fin,$download) {
        $this->multimedios_cargas_controller_valida_tutoriales_archivo_set_rules($tipos);
        $res_errors = $this->multimedios_cargas_controller_valida_tutoriales_archivo_form_error();
        if ($res_errors==1){        
                switch ($tipos) {
                    case 1:
                        $nombre_archivo = funciones_strategix_fecha_hora_actual()."_tutoriales_video";                      
                        break;
                    case 2: 
                        $nombre_archivo = funciones_strategix_fecha_hora_actual()."_tutoriales_pdf";
                        break;
                    case 3: 
                        $nombre_archivo = funciones_strategix_fecha_hora_actual()."_tutoriales_imagen";
                        break;
                }
                $resultado_carga = $this->base_controller_cargas_upload_archivo('multimedios_cargas_form_view_file',$folder,$extencion,$nombre_archivo);
                $texto_trim = trim($texto); $texto_utf8_decode = utf8_decode($texto_trim); $texto = strtoupper($texto_utf8_decode);
                $resultado = $this->multimedios_cargas_controller_guarda_base_datos("uploads/".$folder_archivo.$nombre_archivo.".".$extencion,".".$extencion,"-",$texto, $tipos, $modulos,$tipos_videos,$fecha_inicio,$fecha_fin,$download,0);                  
            return 1;
        } else {
            return $res_errors; 
        }        
    }
    private function multimedios_cargas_controller_valida_tutoriales_archivo_set_rules() {    
        $this->form_validation->set_rules('multimedios_cargas_form_view_file', 'ARCHIVO', 'callback_multimedios_cargas_controller_valida_popup_archivo_tipo');
        $this->form_validation->set_rules('multimedios_cargas_form_view_txt_titulo', 'TITULO', 'required|xss_clean');
    }
    private function multimedios_cargas_controller_valida_tutoriales_archivo_form_error() {
        $json_multimedios_cargas_form_view_file = $json_multimedios_cargas_form_view_txt_titulo = array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('multimedios_cargas_form_view_file'))) { $json_multimedios_cargas_form_view_file =  array('multimedios_cargas_form_view_file' => form_error('multimedios_cargas_form_view_file', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('multimedios_cargas_form_view_txt_titulo'))) { $json_multimedios_cargas_form_view_txt_titulo =  array('multimedios_cargas_form_view_txt_titulo' => form_error('multimedios_cargas_form_view_txt_titulo', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_multimedios_cargas_form_view_file,$json_multimedios_cargas_form_view_txt_titulo);
            return $json;
        } else {             
            return 1; 
        }                
    } 
    public function multimedios_cargas_controller_valida_notificaciones_archivos($tipos, $modulos,$folder_archivo,$folder,$extencion,$tipos_videos=1,$fecha_inicio,$fecha_fin,$download,$tipo_noticias) {        
        $this->multimedios_cargas_controller_valida_notificaciones_archivo_set_rules($tipos);        
        $res_errors = $this->multimedios_cargas_controller_valida_notificaciones_archivo_form_error($tipos);        
        if ($res_errors==1){        
            $nombre_archivo2 = funciones_strategix_fecha_hora_actual()."_notificaciones_thumbnail";
            switch ($tipos) {
                case 1:
                    $nombre_archivo = funciones_strategix_fecha_hora_actual()."_notificaciones_video"; 
                    $this->base_controller_cargas_upload_archivo('multimedios_cargas_form_view_file',$folder,$extencion,$nombre_archivo);
                  //  $this->base_controller_cargas_upload_archivo('multimedios_cargas_form_view_file2',$folder,$extencion2,$nombre_archivo2);
                    break;
                case 2: 
                    $nombre_archivo = funciones_strategix_fecha_hora_actual()."_notificaciones_pdf";
                    $this->base_controller_cargas_upload_archivo('multimedios_cargas_form_view_file',$folder,$extencion,$nombre_archivo);
                  //  $this->base_controller_cargas_upload_archivo('multimedios_cargas_form_view_file2',$folder,$extencion2,$nombre_archivo2);                    
                    break;
                case 3: 
                    $nombre_archivo = funciones_strategix_fecha_hora_actual()."_notificaciones_imagen";
                    $this->base_controller_cargas_upload_archivo('multimedios_cargas_form_view_file',$folder,$extencion,$nombre_archivo);
                  //  $this->base_controller_cargas_upload_archivo('multimedios_cargas_form_view_file2',$folder,$extencion2,$nombre_archivo2);                    
                    break;
                case 4: 
                    $nombre_archivo = "";
                 //   $this->base_controller_cargas_upload_archivo('multimedios_cargas_form_view_file2',$folder,$extencion2,$nombre_archivo2);                    
                    break;                    
            }
           // $texto_trim = trim($texto); $texto_utf8_decode = utf8_decode($texto_trim); $texto = strtoupper($texto_utf8_decode);
           $texto='';$extencion2='';
            $resultado = $this->multimedios_cargas_controller_guarda_base_datos("uploads/".$folder_archivo.$nombre_archivo.".".$extencion,".".$extencion,"-","-", $tipos, $modulos,$tipos_videos,$fecha_inicio,$fecha_fin,$download,$tipo_noticias);                  
            return 1;
        } else {            
            return $res_errors; 
        }        
    }
    private function multimedios_cargas_controller_valida_notificaciones_archivo_set_rules($tipos) {
        if ($tipos==4){
         //   $this->form_validation->set_rules('multimedios_cargas_form_view_file2', 'THUMBNAIL', 'callback_multimedios_cargas_controller_valida_notificaciones_archivo_secundario');
          //  $this->form_validation->set_rules('multimedios_cargas_form_view_txt_titulo', 'TITULO', 'required|xss_clean');
        } else {
            $this->form_validation->set_rules('multimedios_cargas_form_view_file', 'ARCHIVO', 'callback_multimedios_cargas_controller_valida_popup_archivo_tipo');
           // $this->form_validation->set_rules('multimedios_cargas_form_view_file2', 'THUMBNAIL', 'callback_multimedios_cargas_controller_valida_notificaciones_archivo_secundario');
           // $this->form_validation->set_rules('multimedios_cargas_form_view_txt_titulo', 'TITULO', 'required|xss_clean');
        }
    }
    private function multimedios_cargas_controller_valida_notificaciones_archivo_form_error($tipos) {
        $json_multimedios_cargas_form_view_file = array();
        if (!$this->form_validation->run()) {
            if (!empty(form_error('multimedios_cargas_form_view_file'))) { $json_multimedios_cargas_form_view_file =  array('multimedios_cargas_form_view_file' => form_error('multimedios_cargas_form_view_file', '<small class="mt-3 text-danger">', '</small>')); }
           // if (!empty(form_error('multimedios_cargas_form_view_file2'))) { $json_multimedios_cargas_form_view_file2 =  array('multimedios_cargas_form_view_file2' => form_error('multimedios_cargas_form_view_file2', '<small class="mt-3 text-danger">', '</small>')); }
           // if (!empty(form_error('multimedios_cargas_form_view_txt_titulo'))) { $json_multimedios_cargas_form_view_txt_titulo =  array('multimedios_cargas_form_view_txt_titulo' => form_error('multimedios_cargas_form_view_txt_titulo', '<small class="mt-3 text-danger">', '</small>')); }
            $json = array_merge($json_multimedios_cargas_form_view_file);
            return $json;
        } else {
            return 1; 
        }                
    }
    public function multimedios_cargas_controller_valida_notificaciones_archivo_secundario(){     
        if ($_FILES["multimedios_cargas_form_view_file2"]["name"]==""){  
            $this->form_validation->set_message('multimedios_cargas_controller_valida_notificaciones_archivo_secundario', 'THUMBNAIL'); return FALSE;          
        } else { 
            $tipos = $this->input->post("multimedios_cargas_form_view_cmb_tipos",true);
            $file_array = pathinfo($_FILES["multimedios_cargas_form_view_file2"]["name"]);
            $msg_error = 'TIPO DE ARCHIVO INVÁLIDO, SOLO USE JPG Y PNG.';
            if ("jpg"==$file_array["extension"] or "png"==$file_array["extension"]){ $response = TRUE; } else {
                $this->form_validation->set_message('multimedios_cargas_controller_valida_notificaciones_archivo_secundario', $msg_error); 
                $response = FALSE;                 
            }       
            return $response;
        }
    }  
    public function multimedios_cargas_controller_baja() {
        $id = $this->input->post("id",true);
        $modulos = $this->input->post("modulos",true);
        $this->multimedios_cargas_model->multimedios_cargas_model_baja_datos($id);
        $datos['tabla'] = $this->multimedios_cargas_controller_tabla($modulos);
        echo json_encode($datos);
    }
    public function multimedios_cargas_controller_modal_imagen()    {
        $data['archivo'] = $this->input->post('archivo', true);
        $data['titulo'] = '';
        $data['div_inicio'] = "";
        $data['div_fin'] = "";
        $data['modalId'] = "myModal";
        $tipo = $this->input->post('CargaMultimediaTipoId', true);
     // print_r($tipo);die;
        switch ($tipo) {
            case 1:                $pag = 'modals/popups/popupvideo';                $data['titulo'] = "VIDEO";                break;
            case 2:                $pag = 'modals/popups/popuppdf';                $data['titulo'] = "PDF";                break;
            case 3:                $pag = 'modals/popups/popupimage';                $data['titulo'] = "IMAGEN";                break;
        }
        $pag = $this->load->view($pag, $data, true);
        echo json_encode($pag);
    }
    public function multimedios_cargas_controller_actualiza_estatus(){
        $estatus        = $this->multimedios_cargas_model->multimedios_actualiza_estatus();
       $current_date = date('Y-m-d');
        foreach ($estatus as $row) {  
            if($current_date > $row->CargaMultimediaFechaFinal) {
                $this->multimedios_cargas_model->multimedios_cargas_model_baja_datos($row->CargaMultimediaId);
            }
        }
       return 1;
    }
}