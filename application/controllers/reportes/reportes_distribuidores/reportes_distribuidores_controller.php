<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reportes_distribuidores_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
         valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('reportes/reportes_distribuidores/reportes_distribuidores_model');
        
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('reportes/reportes_distribuidores/reportes_distribuidores_form_view');
    }

    
    public function reportes_distribuidores_controller_cmb_distribuidor() {
        $perfil_id = $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));
        $distribuidores = $this->reportes_distribuidores_model->reportes_distribuidores_model_combo_distribuidor($perfil_id);
        $combo_distribuidores = "<option  value='0'>".$this->lang->line('reportes_distribuidores_controller_lang_select_combo_distribuidor')."</option>";
        foreach ($distribuidores as $distribuidor) { 
            if($distribuidor->DistribuidorDetalleNombreComercial!=NULL){
                $nombre = utf8_encode($distribuidor->DistribuidorDetalleNombreComercial);
            } else {
                $nombre = utf8_encode($distribuidor->DistribuidorDetalleRazonSocial);
            }



            $combo_distribuidores .= '<option value="'.$distribuidor->DistribuidorId.'">'.$distribuidor->DistribuidorDetalleCodigo.' - '.utf8_encode(strtoupper($nombre)).'</option>'; 
        } 
        echo json_encode($combo_distribuidores);
    }    
    public function reportes_distribuidores_controller_cmb_anio() {
        $cmb_anio ="<option  value='0'>".$this->lang->line('reportes_distribuidores_controller_lang_combo_selecciona_anio_all')."</option>";       
        $anios        = $this->reportes_distribuidores_model->reportes_distribuidores_model_cmbanios();
        foreach ($anios as $row) {            
             $cmb_anio .="<option value=$row->anio>".$row->anio."</option>";
        }
        echo json_encode($cmb_anio);
    }

    public function reportes_distribuidores_controller_cmbmes() {
        $cmb_Anio              = $this->input->post('cmb_anio',true);
        $cmb_mes ="<option  value='0'>".$this->lang->line('reportes_distribuidores_controller_lang_combo_selecciona_mes_all')."</option>";       
        $meses        = $this->reportes_distribuidores_model->reportes_distribuidores_model_cmbmes($cmb_Anio);
        foreach ($meses as $row) {            
             $cmb_mes .="<option value=$row->mes>".strtoupper(funciones_strategix_mes_numero_texto($row->mes))."</option>";
        }
        echo json_encode($cmb_mes);
    }
    public function reportes_distribuidores_controller_tabla() {
        $cmb_pais = $this->input->post('cmb_pais', true);
        $cmb_segmento = $this->input->post('cmb_segmento', true);
        $cmb_Anio  = $this->input->post('cmb_anio',true);
        if($cmb_Anio!=0){$cmb_Mes = $this->input->post('cmb_mes',true); }else{$cmb_Mes = 0;}
        $cmb_distribuidor = $this->input->post('cmb_distribuidor',true);
        $cmb_estatus = $this->input->post('cmb_estatus',true);
        $cmb_actividad = $this->input->post('cmb_actividad',true);
        $txt_distribuidor=null;
        $lista=$where="";
        if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) <= 4) {
            $where .=($cmb_distribuidor==0)?"":" AND DistribuidoresDetalles.DistribuidorId = $cmb_distribuidor ";
            $where .= ($cmb_pais == 0) ? "" : " AND Distribuidores.PaisId = $cmb_pais ";
        $where .= ($cmb_segmento == 0) ? "" : " AND Distribuidores.DivisionId = $cmb_segmento ";
        }else{
            $distribuidoresid = $this->reportes_distribuidores_model->reportes_distribuidores_model_usuario_ditribuidor();
            foreach ($distribuidoresid as $distribuidor) { $txt_distribuidor .= $distribuidor->DistribuidorId.","; } $txtDistribuidor = substr ($txt_distribuidor, 0, strlen($txt_distribuidor) - 1);            
            $where .= ($cmb_distribuidor==0)?" AND DistribuidoresDetalles.DistribuidorId in ($txtDistribuidor)":" AND DistribuidoresDetalles.DistribuidorId = $cmb_distribuidor ";
        }
        switch ($cmb_estatus) {
            case 1: $where .= " AND (DistribuidorFechaBaja IS NULL)"; break;
            case 2: $where .= " AND (DistribuidorFechaBaja IS NOT NULL)"; break;
        }
        switch ($cmb_actividad) {
            case 0: 
                $distribuidores      = $this->reportes_distribuidores_model->reportes_distribuidores_model_crea_tabla($where); 
                break;
            case 1: 
                $where .= ($cmb_Anio!=0)?" AND DistribuidoresActivos.DistribuidorActivoAnio = $cmb_Anio":"";
                $where .= ($cmb_Mes!=0)?" AND DistribuidoresActivos.DistribuidorActivoMes = $cmb_Mes":"";
                $distribuidores      = $this->reportes_distribuidores_model->reportes_distribuidores_model_crea_tabla($where); 
                break;
            case 2: 
                $dis_activos      = $this->reportes_distribuidores_model->reportes_distribuidores_model_distribuidores_activos($cmb_Anio,$cmb_Mes);
                $txt_distribuidoras = "";
                foreach ($dis_activos as $v_dist) {$txt_distribuidoras .= $v_dist->DistribuidorId.",";}
                $txtDistribuidoras = substr ($txt_distribuidoras, 0, strlen($txt_distribuidoras) - 1);
                $whereinactivo       = " AND (Distribuidores.DistribuidorId NOT IN ($txtDistribuidoras))";
                $distribuidores      = $this->reportes_distribuidores_model->reportes_distribuidores_model_crea_tabla_inactivos($whereinactivo,$where);
            break;
        }        
        $i = 1;
        foreach ($distribuidores as $row) { 
            $distribuidor_activo   = $this->reportes_distribuidores_model->reportes_distribuidores_model_distribuidor_activo($row->DistribuidorId,$cmb_Anio,$cmb_Mes);
            $actividad = (empty($distribuidor_activo))?"INACTIVO":"ACTIVO";
            $ejecutivo = $this->reportes_distribuidores_model->reportes_distribuidores_model_ejecutivo($row->DistribuidorId);
            $ventas    = $this->reportes_distribuidores_model->reportes_distribuidores_model_ventas($row->DistribuidorDetalleId);
            $maestros    = $this->reportes_distribuidores_model->reportes_distribuidores_model_total_maestros_pintor($row->DistribuidorId);
            if ($row->DistribuidorFechaBaja == "") {$estatus = "HABILITADO";}else{$estatus = "BAJA";}
            $totalTicket       = ($ventas->totalticket!="")?($ventas->totalticket):"0";
            $totalMonto        = ($ventas->totalmonto!="")?utf8_encode(strtoupper($ventas->totalmonto)):"0";
            $totalMaestros     = ($maestros->totmaestros!="")?($maestros->totmaestros):"0";
            $calle             = ($row->DistribuidorDetalleCalle!="")?utf8_encode(strtoupper($row->DistribuidorDetalleCalle)):"&nbsp";
            $lista.= '<tr>                    
                    <td>'.utf8_encode(strtoupper($row->DistribuidorId)).'</td>
                    <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleCodigo)).'</td>
                    <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleRazonSocial)).'</td>
                    <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleNombreComercial)).'</td>
                    <td>'.utf8_encode(strtoupper($row->PaisNombre)).'</td>
                    <td>'.utf8_encode(strtoupper($row->DivisionNombre)).'</td>
                    <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleRegionNombre)).'</td>
                    <td>'.$calle.'</td>
                    <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleMunicipio)).'</td>
                    <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleCiudad)).'</td>
                    <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleEstado)).'</td>
                    <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleCP)).'</td>
                    <td>'.utf8_encode(strtoupper($ejecutivo)).'</td>
                    <td>'.utf8_encode(strtoupper($estatus)).'</td>
                    <td>'.$totalTicket.'</td>
                    <td>'.$totalMaestros.'</td>
                    <td>'.$totalMonto.'</td>';
                        if($cmb_Anio !=0 && $cmb_Mes!=0){
                            $lista.= '<td>'.utf8_encode(strtoupper($actividad)).'</td>';
                        }
                    $lista.= '</tr>' ;
           $i++;
        }    
        $data['anio']           = $cmb_Anio;
        $data['mes']            = $cmb_Mes;
        $data['tabla']          = $lista;
        $tablareporte = $this->load->view('reportes/reportes_distribuidores/reportes_distribuidores_tabla_view', $data, true);
        echo json_encode($tablareporte);
    }        
}

