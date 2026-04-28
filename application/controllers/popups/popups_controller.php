<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 May. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Popups_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
    }    
    public function index(){//Pagina de Inicio
        $popup_array = $this->session->userdata(funciones_strategix_sitio_alias('s_popups'));
        $pagina = "";$popupids = array();
        foreach ($popup_array as $clave => $valor) {
            if ($valor['activo']==1){
                $data['div_inicio'] = '<div class="modal fade" id="'.$clave.'" tabindex="-1" aria-labelledby="'.$clave.'Label" aria-hidden="true" data-backdrop="static" data-keyboard="false">';
                $data['div_fin']    = "</div>";
                $data['archivo']    = $valor['CargaMultimediaRuta'];
                $data['texto_html'] = $valor['CargaMultimediaTexto'];
                $data['modalId']    = $clave;
                $data['download']   = $valor['CargaMultimediaDownload'];
                 $data['extension']   = $valor['CargaMultimediaExtension'];
                $popupids[]    = $clave;
                switch ($valor['CargaMultimediaTipoId']) {
                    case 1: $pag = 'modals/modals_popups/modals_popups_video_view';   $data['titulo'] = "VIDEO";  break;
                    case 2: $pag = 'modals/modals_popups/modals_popups_pdf_view';     $data['titulo'] = "PDF";    break;
                    case 3: $pag = 'modals/modals_popups/modals_popups_imagen_view';  $data['titulo'] = "IMAGEN"; break;
                    case 4: $pag = 'modals/modals_popups/modals_popups_texto_view';   $data['titulo'] = "TEXT - HTML"; break;
                }
                $pagina .= $this->load->view($pag, $data, true);  
            }
        }
        $datos['popupids']  = $popupids;
        $datos['pagina']    = $pagina;
        echo json_encode($datos);            
    }
   
 public function popups_controller_baja()
    {
        $popup_id = $this->input->post("popup_id", true);
        $popup_array = $this->session->userdata(funciones_strategix_sitio_alias('s_popups'));
        $popup_array[$popup_id]['activo'] = 0;
        $this->session->unset_userdata(funciones_strategix_sitio_alias('s_popups'));
        $this->session->set_userdata(funciones_strategix_sitio_alias('s_popups'), $popup_array);
        echo 1;
    }
    public function popup_baja()
    {
        $popup_id = $this->input->post("popup_id", true);
        $this->session->unset_userdata(funciones_strategix_sitio_alias($popup_id));
        $this->session->set_userdata(funciones_strategix_sitio_alias($popup_id), 0);
        echo 1;
    }

}