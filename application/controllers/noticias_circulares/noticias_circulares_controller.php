<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticias_circulares_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
      $this->load->model('noticias_circulares/noticias_circulares_model');
    }    
    public function index(){//Pagina de Inicio
        $tarjetaPA = '';
        $tarjetaPANT = '';
        $tarjetaG = '';
        $promocion_actual =  $this->noticias_circulares_model->promocion_actual_model_datos();
        $promocion_anterior =  $this->noticias_circulares_model->promocion_anterior_model_datos();
        $ganadores =  $this->noticias_circulares_model->ganadores_model_datos();
        foreach ($promocion_actual as $pa_row) {
            $dataPA['thumb'] = str_replace("\\",'/',$pa_row->CargaMultimediaRuta);
            $dataPA['archivo'] = str_replace("\\",'/',$pa_row->CargaMultimediaRuta);
            $dataPA['tipo'] = $pa_row->CargaMultimediaTipoId;
            $dataPA['download']   = $pa_row->CargaMultimediaDownload;
            $dataPA['extension']   = $pa_row->CargaMultimediaExtension;
            $tarjetaPA .= $this->load->view('noticias_circulares/noticias_circulares_detalle_view', $dataPA,true); 
        }
         foreach ($promocion_anterior as $pant_row) {
            $dataPANT['thumb'] = str_replace("\\",'/',$pant_row->CargaMultimediaRuta);
            $dataPANT['archivo'] = str_replace("\\",'/',$pant_row->CargaMultimediaRuta);
            $dataPANT['tipo'] = $pant_row->CargaMultimediaTipoId;
            $dataPANT['download']   = $pant_row->CargaMultimediaDownload;
            $dataPANT['extension']   = $pant_row->CargaMultimediaExtension;
            $tarjetaPANT .= $this->load->view('noticias_circulares/noticias_circulares_detalle_view', $dataPANT,true); 
        }
            foreach ($ganadores as $g_row) {
            $dataG['thumb'] = str_replace("\\",'/',$g_row->CargaMultimediaRuta);
            $dataG['archivo'] = str_replace("\\",'/',$g_row->CargaMultimediaRuta);
            $dataG['tipo'] = $g_row->CargaMultimediaTipoId;
            $dataG['download']   = $g_row->CargaMultimediaDownload;
            $dataG['extension']   = $g_row->CargaMultimediaExtension;
            $tarjetaG .= $this->load->view('noticias_circulares/noticias_circulares_detalle_view', $dataG,true); 
        }
        $data['tablaPA'] = $tarjetaPA;
        $data['tablaPANT'] = $tarjetaPANT;
        $data['tablaG'] = $tarjetaG;
        $this->base_controller_create_view_sistema('noticias_circulares/noticias_circulares_view',$data,true);
    }
    public function noticias_circulares_controller_tipo_modal(){
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
