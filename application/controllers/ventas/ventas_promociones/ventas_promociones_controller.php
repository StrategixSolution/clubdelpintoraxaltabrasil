<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_promociones_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('ventas/ventas_promociones/ventas_promociones_model');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }    
    public function index(){//Pagina de Inicio  
        $data['VentaId'] = $this->input->get('IDVENT',TRUE);        
        if ($this->ventas_promociones_model->ventas_promociones_model_valida_venta($data['VentaId'])==0){
            $data['msg'] = $this->lang->line('ventas_promociones_controller_lang_js_msg_error_venta_sin_promocion');
            $this->base_controller_create_view_sistema('ventas/ventas_promociones/ventas_promociones_error_view',$data);
        } else if ($this->ventas_promociones_model->ventas_promociones_model_valida_venta_registrada($data['VentaId'])==0){            
            $this->base_controller_create_view_sistema('ventas/ventas_promociones/ventas_promociones_form_view',$data);
        } else {
            $data['msg'] = $this->lang->line('ventas_promociones_controller_lang_js_msg_error_venta_capturada');
            $this->base_controller_create_view_sistema('ventas/ventas_promociones/ventas_promociones_error_view',$data);
        }
    }
    public function ventas_promociones_controller_combo_promociones() {
        $combo_promociones  = "<option value='0'>".$this->lang->line('ventas_promociones_controller_lang_placeholder_promociones')."</option>";
        $promociones        = $this->ventas_promociones_model->ventas_promociones_model_combo_promociones();
        foreach ($promociones as $promocion) { $combo_promociones   .='<option value="'.$promocion->VentaPromocionId.'">'.utf8_encode(strtoupper($promocion->VentaPromocionNombre)).'</option>'; } 
        echo json_encode($combo_promociones);
    }
    public function ventas_promociones_controller_buscar_tabla() {
        $cmb_promocion = $this->input->post('cmb_promocion',TRUE);
        $where = $lista="";
        $where .=($cmb_promocion==0)?"":" AND (VentasPromociones.VentaPromocionId = $cmb_promocion)";
        $resultados_tabla_distribuidores = $this->ventas_promociones_model->ventas_promociones_model_promociones($where); 
        foreach ($resultados_tabla_distribuidores as $row) {  
            $input_name_monto = "txt_cantidad_".$row->VentaPromocionDetalleId;
            $lista.= '<tr>
                        <td>'.utf8_encode(strtoupper($row->VentaPromocionNombre)).'</td>
                        <td>'.utf8_encode(strtoupper($row->VentaPromocionDetalleDescripcion)).'</td>
                        <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetalleGMC)).'</td>
                        <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetalleCodigo)).'</td>   
                        <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetallePresentacion)).'</td>
                        <td class="txt-center" style="margin: auto auto;"><input type="text" name="'.$input_name_monto.'" id="$input_name_monto" class="form-control" placeholder="'.$this->lang->line('ventas_promociones_controller_lang_tabla_titulo_cantidad').'" maxlength="3" style="width:80px; margin:0 auto;" onKeyPress=\'return js_general_solo_numeros(event)\'></td>
                    </tr>' ;
        }
        $data['tabla'] = $lista;
        $tabla_participante['tabla'] = $this->load->view('ventas/ventas_promociones/ventas_promociones_tabla_view', $data, true);
        echo json_encode($tabla_participante);
    }
    public function ventas_promociones_controller_guardar_promocion() {
        $cmb_promocion = $this->input->post('cmb_promocion',TRUE);
        $VentaId = $this->input->post('VentaId',TRUE);
        $where = $lista="";$total_monto_capturado=$input_monto_capturado=0;
        $where .=($cmb_promocion==0)?"":" AND (VentasPromociones.VentaPromocionId = $cmb_promocion)";
        $resultados_tabla_distribuidores = $this->ventas_promociones_model->ventas_promociones_model_promociones($where); 
        foreach ($resultados_tabla_distribuidores as $row) {  
            $input_name_monto = "txt_cantidad_".$row->VentaPromocionDetalleId;
            $input_monto_capturado 	= $this->input->post($input_name_monto);
            if ($input_monto_capturado!="" or $input_monto_capturado!=0){
                $total_monto_capturado = $total_monto_capturado + $input_monto_capturado;
                $data = "$VentaId,".$row->VentaPromocionDetalleId.",$input_monto_capturado";
                $this->ventas_promociones_model->ventas_promociones_model_guardar_promocion($data,$VentaId,$cmb_promocion);
            }
        }
        $total = ($total_monto_capturado==0)?0:1;
        echo json_encode($total);        
    }
    public function ventas_promociones_controller_modal_validar_promociones() {
        $cmb_promocion = $this->input->post('cmb_promocion',TRUE);
        $VentaId = $this->input->post('VentaId',TRUE);
        $where = $lista="";$total_monto_capturado=$input_monto_capturado=0;
        $where .=($cmb_promocion==0)?"":" AND (VentasPromociones.VentaPromocionId = $cmb_promocion)";
        $resultados_tabla_distribuidores = $this->ventas_promociones_model->ventas_promociones_model_promociones($where); 
        foreach ($resultados_tabla_distribuidores as $row) {  
            $input_name_monto = "txt_cantidad_".$row->VentaPromocionDetalleId;
            $input_monto_capturado 	= $this->input->post($input_name_monto);
            if ($input_monto_capturado!="" or $input_monto_capturado!=0){
                $total_monto_capturado = $total_monto_capturado + $input_monto_capturado;                         
                $lista.= '<tr>
                            <td>'.utf8_encode(strtoupper($row->VentaPromocionNombre)).'</td>
                            <td>'.utf8_encode(strtoupper($row->VentaPromocionDetalleDescripcion)).'</td>
                            <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetalleGMC)).'</td>
                            <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetalleCodigo)).'</td>   
                            <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetallePresentacion)).'</td>
                            <td class="txt-center" style="margin: auto auto;">'.$input_monto_capturado.'</td>
                        </tr>' ;
            }
        }
        $datos['tabla'] = $lista;
        $data['total'] = ($total_monto_capturado==0)?0:1;
        $data['pag'] = $this->load->view('modals/modals_ventas/modals_ventas_promociones/modals_ventas_promociones_view', $datos, true);
        echo json_encode($data);       
    }
 
}