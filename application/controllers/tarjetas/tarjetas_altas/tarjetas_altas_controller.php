<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
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
    public function tarjetas_altas_controller_combo_lista_pais() {
        $where = "";
        switch ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))) {
         case 1:
         case 2:
         case 3:
            $combo_pais = "<option value='0'>".$this->lang->line('distribuidores_controller_lang_combo_pais_todos')."</option>";
            $paises         = $this->tarjetas_altas_model->distribuidores_alta_model_combo_pais($where);
             break;//ADMINISTRADORES
             case 4:
             case 5:
             case 6:
             case 7:
                case 8:
                    case 9:
                    case 10:
                $combo_pais = "<option value='0'>".$this->lang->line('distribuidores_controller_lang_combo_pais_todos')."</option>";
             $where .= " AND Usuarios.UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." ";
             $paises = $this->tarjetas_altas_model->distribuidores_alta_model_combo_pais($where);
             break;//ADMINISTRADORES AXALTA PAIS, AXALTA REGION Y GERENTE REGIONAL
             }
        foreach ($paises as $pais) { $combo_pais   .='<option value="'.$pais->PaisId.'">'.utf8_encode(strtoupper($pais->PaisNombre)).'</option>'; } 
        echo json_encode($combo_pais);
    }    
    public function tarjetas_altas_controller_combo_distribuidor(){
        $where = $combo_distribuidores= ""; $cmb_pais = $this->input->post('cmb_pais',true);
        if ($this->input->post('DistribuidorId',true)!=""){
            $combo_distribuidores ="";
            $where .= "AND Distribuidores.DistribuidorId = ".$this->input->post('DistribuidorId',true);
        } else {
            if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 7){
                $distribuidorid = $this->tarjetas_altas_model->distribuidores_alta_model_usuario_comercio($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));
                $where .= "AND Distribuidores.DistribuidorId = $distribuidorid->DistribuidorId AND Distribuidores.PaisId = ".$cmb_pais;
            }else{
                $where .= " AND Distribuidores.PaisId = ".$cmb_pais;
                $combo_distribuidores = "<option  value='0'>".$this->lang->line('tarjetas_altas_controller_lang_tabla_combo_distribuidor_selecciona')."</option>";
            }
        }
        $distribuidoras         = $this->tarjetas_altas_model->distribuidores_alta_model_combo_distribuidores($where);
        foreach ($distribuidoras as $distribuidora) {            
                $combo_distribuidores .="<option value=$distribuidora->DistribuidorId>".$distribuidora->DistribuidorDetalleCodigo." ".utf8_encode(strtoupper($distribuidora->DistribuidorDetalleNombreComercial))."</option>";
            }        
        echo json_encode($combo_distribuidores);
    }

    public function tarjetas_altas_controller_combo_division(){
        $where = $combo_division= ""; $cmb_distribuidor = $this->input->post('cmb_distribuidor',true);
        if ($cmb_distribuidor != - 1){
            $combo_division ="";
            $where .= "AND Distribuidores.DistribuidorId = $cmb_distribuidor";
            $combo_division ="";
        } else {
            $combo_division = "<option  value='0'>".$this->lang->line('tarjetas_altas_controller_lang_tabla_combo_division_selecciona')."</option>";
            $where .= "";
        }
        $divisiones         = $this->tarjetas_altas_model->distribuidores_alta_model_combo_division($where);
        foreach ($divisiones as $division) {            
                $combo_division .="<option value=$division->DivisionId>".utf8_encode(strtoupper($division->DivisionNombre))."</option>";
            }        
        echo json_encode($combo_division);
    }
    public function tarjetas_altas_controller_tabla(){
        $txt_tarjeta_inicial            = trim($this->input->post('inicio', true));
        $txt_tarjeta_final              = trim($this->input->post('fin', true));
        $combo_distribuidores           = $this->input->post('cmb_distribuidor', true);
        $cmb_pais                       = $this->input->post('cmb_pais',true);
        $cmb_divisiones                   = $this->input->post('cmb_division',true);
        $combo_distribuidores = ($combo_distribuidores==-1)?"NULL":$combo_distribuidores;
        $cmb_divisiones = ($cmb_divisiones==-1)?"NULL":$cmb_divisiones;
        $lista = $where = ""; 
        $where = 'AND  Tarjetas.TarjetaNumero BETWEEN ' . $txt_tarjeta_inicial . ' AND ' . $txt_tarjeta_final  . ' AND Tarjetas.PaisId=' .$cmb_pais . ' AND Tarjetas.DivisionId=' .$cmb_divisiones;
        $tarjetas      = $this->tarjetas_altas_model->tarjetas_altas_model_crea_tabla($where);
      // print_r(count($tarjetas));die;
        if (count($tarjetas) == 0) {
            for ($tarjeta_count = $txt_tarjeta_inicial; $tarjeta_count <= $txt_tarjeta_final; $tarjeta_count++) {
                $data_inserta_tarjetas = $tarjeta_count . "," . $combo_distribuidores . "," . $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) . ", 1"  . ",".$cmb_pais . ",".$cmb_divisiones;
                $tarjetasId = $this->tarjetas_altas_model->tarjetas_altas_model_crea_tarjetas($data_inserta_tarjetas);
                $where = 'AND  Tarjetas.TarjetaNumero =' . $tarjeta_count . ' AND Tarjetas.PaisId=' .$cmb_pais . ' AND Tarjetas.DivisionId=' .$cmb_divisiones;
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
                <td>". utf8_encode(strtoupper($datos->PaisNombre))."</td> 
                <td>". utf8_encode($datos->DivisionNombre)."</td> 
                <td>REGISTRADA</td>
            </tr>";
            }
            $estatus['estatus']    = 1;
        } else {
            for ($tarjeta_count = $txt_tarjeta_inicial; $tarjeta_count <= $txt_tarjeta_final; $tarjeta_count++) {
                $where = 'AND  Tarjetas.TarjetaNumero =' . $tarjeta_count . ' AND Tarjetas.PaisId=' .$cmb_pais . ' AND Tarjetas.DivisionId=' .$cmb_divisiones;
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
                    $Tarjetapais    = strtoupper($datos->PaisNombre);
                    $Tarjetadivision    = $datos->DivisionNombre;
                    $TarjetaReg     = "SIN REGISTRAR";
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
                    $TarjetaReg     = "SIN REGISTRAR";                    
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
                    <td>' . utf8_encode($Tarjetapais) . '</td>
                    <td>' . utf8_encode($Tarjetadivision) . '</td>
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
