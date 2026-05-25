<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutoriales_externos_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        $this->load->model('tutoriales/tutoriales_externos/tutoriales_externos_model');
    }    
    public function index(){//Pagina de Inicio
        $tarjeta = "";
        $tutoriales =  $this->tutoriales_externos_model->tutoriales_externos_model_datos();
        foreach ($tutoriales as $row) {
            $data['archivo'] = str_replace("\\",'/',$row->CargaMultimediaRuta);
            $data['texto']= ($row->htmltext!="")?utf8_encode($row->htmltext):"";
            $data['tipo'] = $row->CargaMultimediaTipoId;
              $data['download']   = $row->CargaMultimediaDownload;
            $data['extension']   = $row->CargaMultimediaExtension;
            $tarjeta .= $this->load->view('tutoriales/tutoriales_externos/tutoriales_externos_detalle_view', $data,true); 
        }
        $dato['tabla'] = $tarjeta;           
        $this->base_controller_create_view_out("tutoriales/tutoriales_externos/tutoriales_externos_view",$dato);
    }
    public function tutoriales_externos_controller_modal_popup(){
        $data['archivo']        = $this->input->post('archivo',true);
        $data['titulo']        = $this->input->post('titulo',true);
        $tipo                   = $this->input->post('tipo',true);
         $data['download']       = $this->input->post('download',true);
        $data['extension']      = $this->input->post('extension',true);
        $data['div_inicio']        = "";$data['div_fin']        = "";
        $data['modalId']    = "myModal";
        switch ($tipo) {
            case 1: $pag = 'modals/modals_popups/modals_popups_video_view'; break;
            case 2: $pag = 'modals/modals_popups/modals_popups_pdf_view';  break;
            case 3: $pag = 'modals/modals_popups/modals_popups_texto_view'; break;     
            case 4: $pag = 'modals/modals_popups/modals_popups_imagen_view'; break;  
        }
        $pagina = $this->load->view($pag, $data, true);
        echo json_encode($pagina);   
    }
    public function tutoriales_externos_controller_modal(){
        $data['archivo']        = $this->input->post('archivo',true);
        $tipo                   = $this->input->post('tipo',true);
        $data['download']       = $this->input->post('download',true);
        $data['extension']      = $this->input->post('extension',true);
        $data['div_inicio']     = "";$data['div_fin']        = "";$data['modalId']    = "myModal";
        switch ($tipo) {
            case 1: $pag = 'modals/modals_popups/modals_popups_video_view';  $data['titulo'] = "VIDEO";  break;
            case 2: $pag = 'modals/modals_popups/modals_popups_pdf_view';    $data['titulo'] = "PDF";    break;
            case 3: $pag = 'modals/modals_popups/modals_popups_imagen_view';  $data['titulo'] = "IMAGEN"; break;
        }
        $pagina = $this->load->view($pag, $data, true);
        echo json_encode($pagina);   
    }      
}