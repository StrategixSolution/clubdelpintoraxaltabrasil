<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_registro_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
       $this->load->model('ventas/ventas_registro/ventas_registro_model');
        $this->uniqueId = md5(uniqid(rand(), TRUE));
    }    
    public function index(){//Pagina de Inicio    
        $this->ventas_registro_controller_cart_limpiar();
        $this->base_controller_create_view_sistema('ventas/ventas_registro/ventas_registro_view');
    }
    public function ventas_registro_controller_ajax_qr_modal(){
        $pag = $this->load->view('modals/modals_ventas/modals_ventas_registro/modals_ventas_registro_qr_view', '', true);
        echo json_encode($pag);   
    }
    public function ventas_registro_controller_ajax_combo_lista_clase() {
        $cmb_sector = $this->input->post('cmb_sector',TRUE);
        $combo_clase = "<option value='0'>".$this->lang->line('ventas_registro_controller_lang_combo_selecciona_clase')."</option>";
        $clases         = $this->ventas_registro_model->ventas_registro_model_combo_clases();
        foreach ($clases as $clase) { $combo_clase   .='<option value="'.$clase->ProductoClaseId.'">'.utf8_encode(strtoupper($clase->ProductoClaseDescripcion)).'</option>'; } 
        echo json_encode($combo_clase);
    }
    public function ventas_registro_controller_ajax_combo_lista_marca() {
        $cmd_clase = $this->input->post('cmd_clase',TRUE);
        $combo_marca = "<option value='0'>".$this->lang->line('ventas_registro_controller_lang_combo_selecciona_marca')."</option>";
        $marcas         = $this->ventas_registro_model->ventas_registro_model_combo_marcas($cmd_clase);
        foreach ($marcas as $marca) { $combo_marca   .='<option value="'.$marca->ProductoMarcaId.'">'.utf8_encode(strtoupper($marca->ProductoMarcaDescripcion)).'</option>'; } 
        echo json_encode($combo_marca);
    }
    public function ventas_registro_controller_ajax_combo_lista_litros() {
        $combo_litros = "<option value='0'>".$this->lang->line('ventas_registro_controller_lang_combo_selecciona_litros')."</option>";
        $marcas         = $this->ventas_registro_model->ventas_registro_model_combo_litros();
        foreach ($marcas as $marca) { $combo_litros   .='<option value="'.$marca->VentaDetalleGalonEquivalencia.'">'.utf8_encode(strtoupper($marca->VentaDetalleGalonDescripcion)).'</option>'; } 
        echo json_encode($combo_litros);
    }    
    public function ventas_registro_controller_ajax_qr_retorno() {
        $data['qr'] = intval($this->input->post('code_qr'));
        if ($data['qr']!=""){ 
            $datos_maestro_pintor = $this->ventas_registro_maestro_pintor_informacion($data['qr']);
            if (empty($datos_maestro_pintor)){
                $data['resultado'] = 0;
            } else {
                $data['resultado'] = 1;
                $data['datos_maestro_pintor'] = $datos_maestro_pintor;
            }      
        }
        echo json_encode($data);
    }
    private function ventas_registro_maestro_pintor_informacion($TarjetaNumero) {   
        $maestro_pintor = $this->ventas_registro_model->ventas_registro_model_maestro_pintor_informacion(trim($TarjetaNumero));
        // $array_Division = $this->session->userdata(funciones_strategix_sitio_alias('control_division'));
        if (empty($maestro_pintor)){           
            return '';
        } else {            
            $nombre = utf8_encode($maestro_pintor->UsuarioDetalleNombre)." ".utf8_encode($maestro_pintor->UsuarioDetalleSegundoNombre)." ".utf8_encode($maestro_pintor->UsuarioDetalleApellidoPaterno)." ".utf8_encode($maestro_pintor->UsuarioDetalleApellidoMaterno);
                $maestro_pintor_texto = $this->lang->line('ventas_registro_controller_lang_etiqueta_maestro_pintor')." ".$nombre;
            return $maestro_pintor_texto;
        }        
    }
    public function ventas_registro_controller_ajax_modal_foto(){
        $modal               = $this->input->post('modal');
        $data['archivo']       = "";
        $url ="";
        switch ($modal){
            case 1: $url = 'modals/modals_ventas/modals_ventas_registro/modals_ventas_registro_foto_iphone_view'; break;
            case 2: $url = 'modals/modals_ventas/modals_ventas_registro/modals_ventas_registro_foto_android_view'; break;
        }
        $pag = $this->load->view($url,$data,TRUE);
        echo json_encode($pag);   
    }
    public function ventas_registro_controller_ajax_guarda_foto(){
        $this->ventas_registro_controller_ajax_valida_session_foto();
        $imagenCodificada = file_get_contents("php://input");
        if(strlen($imagenCodificada) <= 0) exit("NO SE RECIBIO IMAGEN, REVISE POR FAVOR");
        $imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
        $imagenDecodificada 	= base64_decode($imagenCodificadaLimpia);
        $nombreImagenGuardada 	= $this->uniqueId.".png";        
        $this->base_controller_valida_crea_carpetas('temporal');
        $this->base_controller_valida_crea_carpetas('temporal/ventas');
        $this->base_controller_valida_crea_carpetas('temporal/ventas/fotos');
        file_put_contents('uploads/temporal/ventas/fotos/'.$nombreImagenGuardada, $imagenDecodificada);
        $this->session->unset_userdata('s_venta_foto');
        $this->session->set_userdata('s_venta_foto',$nombreImagenGuardada);
        echo $nombreImagenGuardada;		
    }
    public function ventas_registro_controller_ajax_valida_session_foto() {
        if ($this->session->userdata('s_venta_foto')!=""){
            if (file_exists('uploads/temporal/ventas/fotos/'.$this->session->userdata('s_venta_foto'))){ unlink('uploads/temporal/ventas/fotos/'.$this->session->userdata('s_venta_foto')); }
            $this->session->unset_userdata('s_venta_foto');
        }
    }
    public function ventas_registro_controller_valida_venta() {        
        $txt_numero_ticket = $this->input->post('txt_numero_ticket');
        $ditribuidor = $this->ventas_registro_model->ventas_registro_model_distribuidor($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));
        $idDistribuidor = $ditribuidor->DistribuidorDetalleId;
        $count_ticket  = $this->ventas_registro_model->ventas_registro_model_count_ticket($txt_numero_ticket, $idDistribuidor);
        if ($count_ticket->counter>0){
            $data['resultado'] = 3;
            echo json_encode($data);
        }else{
        if (count($this->cart->contents())==0){
            $data['resultado'] = 2;
            echo json_encode($data);
        }else {
           
            $this->ventas_registro_valida_set_rules();
            $res_errors = $this->ventas_registro_valida_form_error();
            if ($res_errors==1){
                $VentaId = $this->ventas_registro_guardar_venta();            
                if ($this->ventas_registro_model->ventas_registro_model_valida_promocion()==0){
                    $data['promocion'] = 0;
                } else {
                    $data['promocion'] = 1;
                }            
                $data['resultado'] = 1;
                $data['VentaId'] = $VentaId;
                echo json_encode($data);
            } else {
                $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
            }    
        }
    }
    }
    public function ventas_registro_controller_valida_campos() {
        $this->ventas_registro_valida_set_rules();
        $res_errors = $this->ventas_registro_valida_form_error();
        if ($res_errors==1){
            echo json_encode(1);
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }   
    }
    private function ventas_registro_guardar_venta() {
        $this->ventas_registro_guardar_venta_valida_carpetas();$total_monto_detalle=$total=$total_cantidad=0;  
        $maestro_pintor = $this->ventas_registro_model->ventas_registro_model_maestro_pintor_informacion($this->input->post('txt_qr',TRUE));
        $ditribuidor = $this->ventas_registro_model->ventas_registro_model_distribuidor($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));        
        if($this->input->post('chk_camara')){ $imagen_ticket = $this->ventas_registro_guardar_venta_foto(); }
        if($this->input->post('chk_archivo')){ $imagen_ticket = $this->ventas_registro_guardar_venta_archivo(); }
        $VentaCantidadProdcutos = count($this->cart->contents());
        foreach ($this->cart->contents() as $items) { $total = $items['monto'] * $items['qty']; $total_monto_detalle = $total_monto_detalle + $total; $total_cantidad = $total_cantidad + $items['qty']; }     
        $entra_auditoria = $this->ventas_registro_entra_auditoria($maestro_pintor->UsuarioId,$total_monto_detalle);
        $data = trim($this->input->post('txt_qr',TRUE)).",".$ditribuidor->DistribuidorDetalleId.",".$maestro_pintor->UsuarioDetalleId.",".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",'".utf8_decode(strtoupper(trim($this->input->post('txt_numero_ticket',TRUE))))."','".strtoupper(trim($this->input->post('txt_monto_ticket',TRUE)))."','".$total_monto_detalle."',".$VentaCantidadProdcutos.",".$total_cantidad.",'".$imagen_ticket."',".$entra_auditoria.",'".$this->uniqueId."'";              
        $VentaId = $this->ventas_registro_model->ventas_registro_model_guardar_venta($data);
        $this->ventas_registro_guardar_venta_detalle($VentaId);
        $this->ventas_registro_controller_distribuidor_activo($ditribuidor->DistribuidorId,$ditribuidor->DistribuidorDetalleId);
        return $VentaId;
    }
    private function ventas_registro_guardar_venta_valida_carpetas() {
        $this->base_controller_valida_crea_carpetas('ventas');
        $this->base_controller_valida_crea_carpetas('ventas/'.$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));
    }
    private function ventas_registro_guardar_venta_foto() {
        $foto_temp = 'uploads/temporal/ventas/fotos/'.$this->session->userdata('s_venta_foto');
        $foto_final = 'uploads/ventas/'.$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."/ticket-".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."-".funciones_strategix_fecha_hora_actual().".png";
        if (file_exists($foto_temp)){ rename ($foto_temp ,$foto_final); }       
        $this->session->unset_userdata('s_venta_foto');
        return $foto_final;
    }
    private function ventas_registro_guardar_venta_archivo() {
        $archivo   = "/ticket-".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."-".funciones_strategix_fecha_hora_actual();
        $direccion = $this->base_controller_valida_crea_carpetas('ventas/'.$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));        
        $archivo_array = $this->base_controller_cargas_upload_archivo('txt_ticket_archivo', $direccion, '*', $archivo);
        $archivo_final = $archivo_array['file_name'];
        return "uploads/".'ventas/'.$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).$archivo_final;
    }
    private function ventas_registro_guardar_venta_detalle($VentaId) {
        $total=0;
        foreach ($this->cart->contents() as $items) {
            $total = $items['monto'] * $items['qty'];
            $data = $VentaId.",".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",".$items['monto'] .",".$items['qty'] .",".$items['litros'].",".$items['marca'].",".$total;
            $this->ventas_registro_model->ventas_registro_model_guardar_venta_detalle($data);
        }
        $this->ventas_registro_controller_cart_limpiar();
    } 
    private function ventas_registro_entra_auditoria($UsuarioId,$monto) {        
        $total_ventas_mismo_monto = $this->ventas_registro_model->ventas_registro_model_auditoria_monto($UsuarioId,funciones_strategix_formato_fecha_hora_actual(),$monto);
        if ($total_ventas_mismo_monto!=0){ $this->ventas_registro_model->ventas_registro_model_auditoria_monto_update($UsuarioId,funciones_strategix_formato_fecha_hora_actual(),$monto); return 1; }
        if ($this->ventas_registro_entra_auditoria_pais($monto)==1){ return 1; }
        return 0;
    }
    private function ventas_registro_entra_auditoria_pais($monto) {     
                if($monto>=5000.00 AND $monto<=6000.00){ return 1; }
               // if($monto>=101122.89 AND $monto<=168538.16){ return 1; }
                if($monto>=8000.00){ return 1; }     
    }    
    private function ventas_registro_valida_set_rules() {
        $this->form_validation->set_rules('txt_qr', $this->lang->line('ventas_registro_controller_lang_placeholder_numero_tarjeta'), 'required|numeric');
        $this->form_validation->set_rules('txt_numero_ticket', $this->lang->line('ventas_registro_controller_lang_placeholder_numero_ticket'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_monto_ticket', $this->lang->line('ventas_registro_controller_lang_placeholder_monto_ticket'), 'required|numeric|xss_clean');
        if($this->input->post('chk_camara')){ $this->form_validation->set_rules('txt_ticket_foto', $this->lang->line('ventas_registro_controller_lang_placeholder_ticket'), 'required|xss_clean'); }
    }
    private function ventas_registro_valida_form_error() {
        $json_txt_qr = $json_txt_numero_ticket = $json_txt_monto_ticket = $json_txt_ticket_foto = $json_txt_ticket_archivo = array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('txt_qr'))) { $json_txt_qr =  array('txt_qr' => form_error('txt_qr', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_numero_ticket'))) { $json_txt_numero_ticket =  array('txt_numero_ticket' => form_error('txt_numero_ticket', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_monto_ticket'))) { $json_txt_monto_ticket =  array('txt_monto_ticket' => form_error('txt_monto_ticket', '<small class="mt-3 text-danger">', '</small>')); }
            if($this->input->post('chk_camara')){
                if (!empty(form_error('txt_ticket_foto'))) { $json_txt_ticket_foto =  array('txt_ticket_foto' => form_error('txt_ticket_foto', '<small class="mt-3 text-danger">', '</small>')); }
                $json = array_merge($json_txt_qr,$json_txt_numero_ticket,$json_txt_monto_ticket,$json_txt_ticket_foto);
            } else {
                $json = array_merge($json_txt_qr,$json_txt_numero_ticket,$json_txt_monto_ticket);
            }
            return $json;
        } else {             
            return 1; 
        }                
    }
    public function ventas_registro_controller_cart_limpiar() {
        $this->load->library("cart");
        $this->cart->destroy();
    }
    public function ventas_registro_controller_cart_agregar_producto() {
        $id = md5(uniqid(rand(), TRUE));
        $data = array('id' => $id,'name' => 0,'price' => 0,'qty' => $this->input->post('txt_marca_cantidad'),'clase' => $this->input->post('cmd_clase'),'marca' => $this->input->post('cmb_marca'),'monto' => $this->input->post('txt_marca_monto'),'litros'=>$this->input->post('cmb_marca_litros'));        
        $this->cart->insert($data);
        //print_r($this->cart->contents());  
        $tabla = $this->ventas_registro_controller_cart_tabla();
        echo json_encode($tabla);
    } 
    public function ventas_registro_controller_cart_borrar_producto() {
        $data = array('rowid' => $this->input->post('row_id'),'qty' => 0);
        $this->cart->update($data);
        $tabla = $this->ventas_registro_controller_cart_tabla();
        echo json_encode($tabla);
    }
    public function ventas_registro_controller_cart_muestra_tabla() {
        $tabla = $this->ventas_registro_controller_cart_tabla();
        echo json_encode($tabla);
    }
    public function ventas_registro_controller_cart_tabla() {
        $data['tabla'] = "";
        foreach ($this->cart->contents() as $items) {
            $clase  = utf8_encode($this->ventas_registro_model->ventas_registro_model_nombre_clases($items['clase']));
            $marca  = utf8_encode($this->ventas_registro_model->ventas_registro_model_nombre_marcas($items['marca']));
            $litros = utf8_encode($this->ventas_registro_model->ventas_registro_model_nombre_litros($items['litros']));
            $data['tabla'] .='
                <tr class="grey-text">
                    <td>'.strtoupper($clase).'</td>
                    <td>'.strtoupper($marca).'</td>
                    <td> '.number_format($items['monto'],2).'</td>
                    <td>'.$items['qty'].'</td>
                    <td>'.$litros.' GALÃO</td>
                    <td class="txt-center"><button type="button" id="'.$items['rowid'].'" data-position="left" data-tooltip="Eliminar" name="agregar" class="romove_cart btn waves-effect waves-light tooltipped red"><i class="fas fa-trash"></i></button></td>                                            
                </tr> ';            
        }
        return $data;
    }
    public function ventas_registro_controller_guardar_promocion_ventas() {
        $VentaId = $this->input->post('VentaId',TRUE);
        $this->ventas_registro_model->ventas_registro_model_venta_promocion($VentaId);
        echo $VentaId;
    }    
    public function ventas_registro_controller_distribuidor_activo($ditribuidorid,$ditribuidordetalleid) {
        $distribuidor_activo = $this->ventas_registro_model->ventas_registro_model_distribuidor_activo($ditribuidorid,date('Y'),date('m'));
        $Ventas_totales = $this->ventas_registro_model->ventas_registro_model_ventas_totales($ditribuidordetalleid,date('Y'),date('m'));
        if(empty($distribuidor_activo)){
            if($Ventas_totales>=15){
                $data_activos = $ditribuidorid.",".date('Y').",".date('m').",15";
                $this->ventas_registro_model->ventas_registro_model_ventas_insert_distribuidor_activo($data_activos);
            }    
        }        
       return 1;
    }    
}