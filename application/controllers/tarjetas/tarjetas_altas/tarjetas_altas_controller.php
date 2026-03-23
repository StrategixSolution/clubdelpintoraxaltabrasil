<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');
class Tarjetas_altas_controller extends Base_Controller
{
    public function __construct(){
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('tarjetas/tarjetas_altas/tarjetas_altas_model');
    }
    public function index(){
        $this->base_controller_create_view_sistema('tarjetas/tarjetas_altas/tarjetas_altas_form_view');
    }
  
    public function tarjetas_altas_controller_combo_distribuidor(){
        $combo_distribuidores= ""; 
        $distribuidoras         = $this->tarjetas_altas_model->distribuidores_alta_model_combo_distribuidores();
        foreach ($distribuidoras as $distribuidora) {            
                $combo_distribuidores .="<option value=$distribuidora->DistribuidorId>".$distribuidora->DistribuidorDetalleCodigo." ".utf8_encode(strtoupper($distribuidora->DistribuidorDetalleNombreComercial))."</option>";
            }        
        echo json_encode($combo_distribuidores);
    }
    public function tarjetas_altas_controller_tabla(){
        $txt_tarjeta_inicial            = trim($this->input->post('inicio', true));
        $txt_tarjeta_final              = trim($this->input->post('fin', true));
        $combo_distribuidores           = $this->input->post('cmb_distribuidor', true);
        $lista = $where = ""; 
        $where = 'AND  Tarjetas.TarjetaNumero BETWEEN ' . $txt_tarjeta_inicial . ' AND ' . $txt_tarjeta_final . ' AND Tarjetas.DistribuidorId = ' . $combo_distribuidores;
        $tarjetas      = $this->tarjetas_altas_model->tarjetas_altas_model_crea_tabla($where);
      // print_r(count($tarjetas));die;
        if (count($tarjetas) == 0) {
            for ($tarjeta_count = $txt_tarjeta_inicial; $tarjeta_count <= $txt_tarjeta_final; $tarjeta_count++) {
                $data_inserta_tarjetas = $tarjeta_count . "," . $combo_distribuidores . "," . $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) . ", 1";
                $tarjetasId = $this->tarjetas_altas_model->tarjetas_altas_model_crea_tarjetas($data_inserta_tarjetas);
                $where = 'AND  Tarjetas.TarjetaNumero =' . $tarjeta_count ;
                $res2 = $this->tarjetas_altas_model->tarjetas_altas_model_crea_tabla($where);
                $datos = $res2[0];
                $idMP  = "&nbsp";
                $NomMP = "&nbsp";
                $lista .=
                    "<tr class='text-left'>      
                <td>". utf8_encode($tarjetasId->TarjetaId)."</td>                          
                <td>". utf8_encode($tarjeta_count)."</td>
                <td>". utf8_encode($combo_distribuidores)."</td>
                <td>". utf8_encode($datos->DistribuidorDetalleNombreComercial)."</td>                        
                <td>". utf8_encode($idMP)."</td>
                <td>". utf8_encode($NomMP)."</td>
                <td>". utf8_encode($datos->TarjetaFechaRegistro)."</td>
                <td>". utf8_encode($datos->TarjetaEstatusDescripcion)."</td> 
                <td>REGISTRADO</td>
            </tr>";
            }
            $estatus['estatus']    = 1;
        } else {
            for ($tarjeta_count = $txt_tarjeta_inicial; $tarjeta_count <= $txt_tarjeta_final; $tarjeta_count++) {
                $where = 'AND  Tarjetas.TarjetaNumero =' . $tarjeta_count ;
                $res2 = $this->tarjetas_altas_model->tarjetas_altas_model_crea_tabla($where);           
                if (isset($res2[0])) {
                    $datos = $res2[0];
                    $TarjetaId      = $datos->TarjetaId;
                    $TarjetaNo      = $tarjeta_count;
                    $TarjetaDis     = $datos->DistribuidorId;
                    $TarjetaRS      = $datos->DistribuidorDetalleRazonSocial;
                    $TarjetaUsId    = ($datos->UsuarioId)?$datos->UsuarioId:"&nbsp";
                    $nombreMP       = $datos->UsuarioDetalleNombre . ' ' . $datos->UsuarioDetalleSegundoNombre . ' ' . $datos->UsuarioDetalleApellidoPaterno . ' ' . $datos->UsuarioDetalleApellidoMaterno;
                    $TarjetaNombre  = ($datos->UsuarioDetalleNombre) ? $nombreMP : "&nbsp";
                    $Tarjetafecha   = $datos->TarjetaFechaRegistro;
                    $TarjetaStatus  = $datos->TarjetaEstatusDescripcion;
                    $TarjetaReg     = "NÃO REGISTRADO";
                    $idMP  = "&nbsp";
                    $NomMP = "&nbsp";
                } else {
                    $TarjetaId       = "";
                    $TarjetaNo      = "";
                    $TarjetaDis     = "";
                    $TarjetaRS      = "";
                    $TarjetaUsId    = "";
                    $TarjetaNombre  = "";
                    $Tarjetafecha   = "";
                    $TarjetaStatus  = "";
                    $TarjetaReg     = "NÃO REGISTRADO";                    
                }
                $lista .= '<tr class="text-left">
                    <td>' . utf8_encode($TarjetaId) . '</td>                          
                    <td>' . utf8_encode($TarjetaNo) . '</td>
                    <td>' . utf8_encode($TarjetaDis) . '</td>
                    <td>' . utf8_encode($TarjetaRS) . '</td>                        
                    <td>' . utf8_encode($TarjetaUsId) . '</td>
                    <td>' . utf8_encode($TarjetaNombre) . '</td>
                    <td>' . utf8_encode($Tarjetafecha) . '</td>                       
                    <td>' . utf8_encode($TarjetaStatus) . '</td>
                    <td>' . utf8_encode($TarjetaReg) . '</td>   
                </tr>';
            }
            $estatus['estatus']    = 0;
        }
        $tabla['tabla']  = $lista;
        $data = array_merge($estatus, $tabla);
       // print_r($data);die;
        $tablareporte = $this->load->view('tarjetas/tarjetas_altas/tarjetas_altas_tabla_view', $data, true);
        echo json_encode($tablareporte);
    }
}
