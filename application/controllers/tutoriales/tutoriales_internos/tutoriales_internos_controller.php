<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutoriales_internos_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
         $this->load->model('tutoriales/tutoriales_internos/tutoriales_internos_model');
    }    
    public function index(){
        $tarjeta = "";
        $pag = "tutoriales/tutoriales_internos/tutoriales_internos_view";
        $tutoriales =  $this->tutoriales_internos_model->tutoriales_internos_model_datos();
        foreach ($tutoriales as $row) {
            $data['archivo'] = str_replace("\\",'/',$row->CargaMultimediaRuta);
           $data['texto']= ($row->htmltext!="")?utf8_encode($row->htmltext):"";
            $data['tipo'] = $row->CargaMultimediaTipoId;
             $data['download']   = $row->CargaMultimediaDownload;
            $data['extension']   = $row->CargaMultimediaExtension;
            $tarjeta .= $this->load->view('tutoriales/tutoriales_internos/tutoriales_internos_detalle_view', $data,true); 
        }
        $dato['tabla'] = $tarjeta;                
        $this->base_controller_create_view_sistema($pag,$dato);
    }
    public function tutoriales_internos_controller_modal(){
        $data['archivo']        = $this->input->post('archivo',true);
        $tipo                   = $this->input->post('tipo',true);
        $data['download']       = $this->input->post('download',true);
        $data['extension']      = $this->input->post('extension',true);
        $data['div_inicio']        = "";$data['div_fin']        = "";$data['modalId']    = "myModal";
        switch ($tipo) {
            case 1: $pag = 'modals/modals_popups/modals_popups_video_view';  $data['titulo'] = "VIDEO";  break;
            case 2: $pag = 'modals/modals_popups/modals_popups_pdf_view';    $data['titulo'] = "PDF";    break;
            case 3: $pag = 'modals/modals_popups/modals_popups_imagen_view';  $data['titulo'] = "IMAGEN"; break;
        }
        $pagina = $this->load->view($pag, $data, true);
        echo json_encode($pagina);   
    }      
}