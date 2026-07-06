<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Distribuidores_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
         valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('distribuidores/distribuidores_model');
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('distribuidores/distribuidores_form_view');
    }
   
    public function distribuidores_controller_combo_lista_distribuidores() {
        $where = "";
        switch ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))) {
            case 1://ADMINISTRADORES STRATEGIX
            case 2://ATENCIÓN A CLIENTES
            case 3://ADMINISTRADORES AXALTA
                $distribuidores = $this->distribuidores_model->distribuidores_model_combo_distribuidor_administradores($where);
                break;
            case 4://GERENTE REGIONAL
                $distribuidores = $this->distribuidores_model->distribuidores_model_combo_distribuidor_regionales($where);
                break;
            case 5://EJECUTIVOS
                $distribuidores = $this->distribuidores_model->distribuidores_model_combo_distribuidor_ejecutrivos($where);
                break;
        }
        $combo_distribuidores = "<option  value='0'>".$this->lang->line('distribuidores_controller_lang_combo_distribuidores_todos')."</option>";
        foreach ($distribuidores as $distribuidor) { $combo_distribuidores   .='<option value="'.$distribuidor->DistribuidorId.'">'.$distribuidor->DistribuidorDetalleCodigo.' '.utf8_encode(strtoupper($distribuidor->DistribuidorDetalleRazonSocial)).'</option>'; } 
        echo json_encode($combo_distribuidores);
    }
    public function distribuidores_controller_buscar_tabla() {
        $where = $lista = "";
        $cmb_distribuidres      = $this->input->post('cmb_distribuidres',TRUE);
        $cmb_estatus            = $this->input->post('cmb_estatus',TRUE);
        $distribuidor_encode    = md5('IDDIS'.funciones_strategix_formato_fecha_actual());
        $where                 .=($cmb_distribuidres==0)?"":" AND Distribuidores.DistribuidorId = $cmb_distribuidres";
        $where                 .=($cmb_estatus==0)?"":"";
        $txt_distribuidor=null;
        if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) <= 3) {
            $where .=($cmb_distribuidres==0)?"":" AND DistribuidoresDetalles.DistribuidorId = $cmb_distribuidres ";
        }else{
            $distribuidoresid = $this->distribuidores_model->distribuidores_model_usuario_ditribuidor();
            foreach ($distribuidoresid as $distribuidor) { $txt_distribuidor .= $distribuidor->DistribuidorId.","; } $txtDistribuidor = substr ($txt_distribuidor, 0, strlen($txt_distribuidor) - 1);            
           $where .= ($cmb_distribuidres==0)?" AND DistribuidoresDetalles.DistribuidorId in ($txtDistribuidor)":" AND DistribuidoresDetalles.DistribuidorId = $cmb_distribuidres ";
        }
        switch ($cmb_estatus) {
            case 0: $where .=""; break;
            case 1: $where .=" AND Distribuidores.DistribuidorFechaBaja IS NULL "; break;
            case 2: $where .=" AND Distribuidores.DistribuidorFechaBaja IS NOT NULL "; break;
        }
        $resultados_tabla_distribuidores = $this->distribuidores_model->distribuidores_model_tabla($where); 
        foreach ($resultados_tabla_distribuidores as $row) {            
            if ($row->DistribuidorFechaBaja==""){
                $estatus = $this->lang->line('distribuidores_controller_lang_tabla_estatus_activo');
                $btn_edicion    = '<a href="'.funciones_strategix_version_url_random_base_url("DistribuidoresModificacion")."&$distribuidor_encode=".$row->DistribuidorId.'"><i class="fas fa-edit"></i></a>';
                $btn_baja       = '<a href="javascript:distribuidores_tabla_view_js_eliminar('.$row->DistribuidorId.',\''.utf8_encode(strtoupper($row->DistribuidorDetalleRazonSocial)).'\')"><i class="fas fa-trash"></i>';
            } else {
                $estatus = $this->lang->line('distribuidores_controller_lang_tabla_estatus_baja');
                $btn_edicion    ='';
                $btn_baja       ='';
            }
            $lista.= '<tr id="id-distribuidor-td-'.$row->DistribuidorId.'">
                        <td>'.utf8_encode(strtoupper($row->DistribuidorId)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleCodigo)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleRazonSocial)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleNombreComercial)).'</td>   
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleRegionNombre)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidoresDetallesOficinasVentasNombre)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidoresDetallesAgrupamientosNombre)).'</td>
                        <td>'.utf8_encode(strtoupper($row->UnidadFederativaDescripcion)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleCiudad)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleBarrio)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleDireccion)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleCEP)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleTelefono)).'</td>                        
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleRegistroFederal)).'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleInscripcionEstatal)).'</td>  
                        <td class="txt-center">'.utf8_encode(strtoupper($estatus)).'</td>
                        <td class="txt-center" id="id-dist-edit-td-'.$row->DistribuidorId.'">'.$btn_edicion.'</td>    
                        <td class="txt-center" id="id-dist-baja-td-'.$row->DistribuidorId.'">'.$btn_baja.'</td>   
                    </tr>' ;
        }
        $data['tabla'] = $lista;
        $tabla_participante['tabla'] = $this->load->view('distribuidores/distribuidores_tabla_view', $data, true);
        echo json_encode($tabla_participante);
    }    
    public function distribuidores_controller_baja() {
        $distribuidorid = $this->input->post('distribuidorid',TRUE);
        $resultado_baja = $this->distribuidores_model->distribuidores_model_baja($distribuidorid);
        if ($resultado_baja==1){ echo 1; } else { echo 0; }
    }    
}