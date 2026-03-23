<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Tarjetas_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('tarjetas/tarjetas_model');
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('tarjetas/tarjetas_form_view');
    }
    public function tarjetas_controller_combo_estatus() {
        $cmb_estatus = "<option value='0'>".$this->lang->line('tarjetas_controller_lang_combo_estatus_todos')."</option>";
        $estatus         = $this->tarjetas_model->tarjetas_model_estatus();
        foreach ($estatus as $estatu) { $cmb_estatus   .='<option value="'.$estatu->TarjetaEstatusId.'">'.utf8_encode(strtoupper($estatu->TarjetaEstatusDescripcion)).'</option>'; } 
        echo json_encode($cmb_estatus);
    }    
    public function tarjetas_controller_buscar_tabla() {//                        <td class="txt-center" id="id-tarjeta-edit-td-'.$row->TarjetaId.'">'.$btn_edicion.'</td>    
        $where = $lista = "";
        $txt_distribuidor=null;
        $cmb_estatus            = $this->input->post('cmb_estatus',TRUE);
        if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) <= 4) {
        $where                 .=($cmb_estatus==0)?"":" AND Tarjetas.TarjetaEstatusId = ".$cmb_estatus;
        }else{
            $distribuidoresid = $this->tarjetas_model->tarjetas_model_usuario_ditribuidor();
            foreach ($distribuidoresid as $distribuidor) { $txt_distribuidor .= $distribuidor->DistribuidorId.","; } $txtDistribuidor = substr ($txt_distribuidor, 0, strlen($txt_distribuidor) - 1);            
           $where .= " AND DistribuidoresDetalles.DistribuidorId in ($txtDistribuidor)";
           $where .=($cmb_estatus==0)?"":" AND Tarjetas.TarjetaEstatusId = ".$cmb_estatus;
        }
        /*$cmb_estatus            = $this->input->post('cmb_estatus',TRUE);
        $where                 .=($cmb_estatus==0)?"":" AND Tarjetas.TarjetaEstatusId = ".$cmb_estatus;*/
        $resultados_tabla_tarjetas = $this->tarjetas_model->tarjetas_model_lista($where); 
        foreach ($resultados_tabla_tarjetas as $row) {

            if ($row->TarjetaFechaBaja==""){
//                $estatus = $this->lang->line('distribuidores_controller_lang_tabla_estatus_activo');
                $btn_edicion    = "edicion";
                $btn_baja       = '<a href="javascript:tarjetas_tabla_view_js_eliminar('.$row->TarjetaId.',\''.$row->TarjetaNumero.'\')"><i class="fas fa-trash"></i>';
             //   $btn_baja       = '<a href="javascript:tarjetas_tabla_view_js_eliminar('.$row->TarjetaId.',\''.$row->TarjetaNumero.'\''.',\''.$row->PaisNombre.'\')"><i class="fas fa-trash"></i>';
            } else {
//                $estatus = $this->lang->line('distribuidores_controller_lang_tabla_estatus_baja');
                $btn_edicion    ='';
                $btn_baja       ='';
            }            
            $nombre_usuario = $row->UsuarioDetalleNombre." ".$row->UsuarioDetalleSegundoNombre." ".$row->UsuarioDetalleApellidoPaterno." ".$row->UsuarioDetalleApellidoMaterno;
            $lista.= '<tr id="id-tarjeta-td-'.$row->TarjetaId.'">
                        <td>'.utf8_encode(strtoupper($row->TarjetaNumero)).'</td>
                        <td>'.utf8_encode(strtoupper($row->PaisNombre)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DivisionNombre)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleCodigo)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleRazonSocial)).'</td> 
                        <td>'.utf8_encode(strtoupper($nombre_usuario)).'</td>
                        <td class="txt-center">'.utf8_encode(strtoupper($row->TarjetaEstatusDescripcion)).'</td>

                        <td class="txt-center" id="id-tarjeta-baja-td-'.$row->TarjetaId.'">'.$btn_baja.'</td>   
                    </tr>' ;
        }
        $data['tabla'] = $lista;
        $tabla_participante['tabla'] = $this->load->view('tarjetas/tarjetas_tabla_view', $data, true);
        echo json_encode($tabla_participante);
    }
    public function tarjetas_controller_baja() {
        $TarjetaId = $this->input->post('tarjetaid',TRUE);
        $resultado_baja = $this->tarjetas_model->tarjetas_model_baja($TarjetaId);
        if ($resultado_baja==1){ echo 1; } else { echo 0; }
    }     
}