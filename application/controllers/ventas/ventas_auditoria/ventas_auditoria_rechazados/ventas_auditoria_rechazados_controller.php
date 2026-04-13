<?php

/* 
 * Sistema Web Responsivo CDPMEX                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_auditoria_rechazados_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->uniqueId = md5(uniqid(rand(), TRUE));
        $this->load->model('ventas/ventas_registro/ventas_registro_model');
        $this->load->model('ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_model');
        $this->load->model('ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_model');
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_view');
    }
    
    public function ventas_auditoria_rechazados_controller_combo_distribuidor() {
        $cmb_dist ="";
        $distribuidor =  $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_combo_distribuidor($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))); 
        foreach ($distribuidor as $dist) {  
            if($dist->DistribuidorDetalleNombreComercial!=NULL){
                $nombre = utf8_encode($dist->DistribuidorDetalleNombreComercial);
            } else {
                $nombre = utf8_encode($dist->DistribuidorDetalleRazonSocial);
            }      
            $cmb_dist .="<option value=$dist->DistribuidorId>".$nombre."</option>";
        }
        echo json_encode($cmb_dist);
    }

    public function ventas_auditoria_rechazados_controller_tabla() {
        $cmb_distribuidor= $this->input->post('cmb_distribuidor',TRUE);
        $i=0;$j=1;$lista = "";
        $ventas     = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_tabla($cmb_distribuidor);
        foreach ($ventas as $venta) { 
            $rows   = $this->ventas_auditoria_rechazados_controller_tabla_rows($venta);                
            $lista .= '<tr id="id-comercio-td-'.$rows["VentaId"].'">
                    <td>'.$j.'</td> <td>'.$rows["VentaId"].'</td><td>'.$rows["VentaUsuarioNombreMP"].'</td>
                    <td>'.$rows["VentaNumeroTicket"].'</td> <td>'.$rows["VentaMontoTicket"].'</td>                       
                    <td>'.$rows["fecharegistro"].'</td> <td>'.$rows["distribuidora"].'</td>
                    <td class="txt-center">'.$rows["link_modal_ticket"].'</td>
                    <td>'.$rows["VentaAuditoriaTipoDescripcion"].'</td> 
                    <td>'.$rows["VentaAuditoriaObservacionDescripcion"].'</td>
                    <td>'.$rows["fechaauditoria"].'</td>
                    <td>'.$rows["VentaAuditoriaFechaEnvioCorreo"].'</td>
                    <td>'.$rows["VentaAuditoriaFechaEnvioCorreoCierre"].'</td>
                    <td>'.$rows["link_actualiza_venta"].'</td>
                    </tr>';$i++; $j++;
        }
$data['tabla'] = $lista;
$data['total'] = $i;
if ($data['total']==0){
    $tabla_participante['tabla'] = $this->load->view('ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_tabla_view_empty', $data, true);
        echo json_encode($tabla_participante);
     }else{
$tabla_participante['tabla'] = $this->load->view('ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_tabla_view', $data, true);
        echo json_encode($tabla_participante);
     }
    }
    public function ventas_auditoria_rechazados_controller_ticket_modal() {
         $id                 = $this->input->post('id',true);
        $row                = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_fila($id);
        $lista=$lista2="";
        $registroventa      = new DateTime($row->VentaFechaRegistro);
        $fecharegistro      = $registroventa->format('Y-m-d');        
        $data['id']         = $id;$total_monto = $total_cantidad_producto=0;
        $data['archivo']    = $row->VentaFotoTicket;
        $data['tabla_datos'] = '<tr>
        <td>'.$id.'</td>
        <td>'.utf8_encode(strtoupper($row->nombrepax)).'</td>
        <td class="txt-center">'.utf8_encode(strtoupper($row->VentaNumeroTicket)).'</td>
        <td class="txt-center">'.utf8_encode(strtoupper($row->VentaMontoTicketCapturado)).'</td>
        <td class="txt-center">'.utf8_encode(strtoupper($fecharegistro)).'</td></tr>';
        $resultados_tabla_detalle_ventas = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_detalle_ventas($id); 
        foreach ($resultados_tabla_detalle_ventas as $row) {  
            $total_producto =$row->VentaDetalleCantidad * $row->VentaDetalleMonto;
            $total_cantidad_producto = $total_cantidad_producto + $row->VentaDetalleCantidad;
                $lista2.= '<tr>
                    <td>'.utf8_encode(strtoupper($row->ProductoClaseDescripcion)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper($row->ProductoMarcaDescripcion)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaDetalleCantidad)).'</td>   
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaDetalleLitros)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper(number_format($row->VentaDetalleMonto,2))).'</td>
                    <td class="txt-center">'.utf8_encode(number_format($total_producto,2)).'</td>
                </tr>' ;
                $total_monto = $total_monto + $total_producto;
        }
                $lista2.= '<tr>
                    <td></td>
                    <td class="txt-center">TOTAL PRODUCTOS:</td>
                    <td class="txt-center">'.$total_cantidad_producto.'</td>   
                    <td class="txt-center"></td>
                    <td class="txt-center">TOTAL TICKET:</td>
                    <td class="txt-center">'.utf8_encode(number_format($total_monto,2)).'</td>
                </tr>' ;         
        $data['tabla_productos'] = $lista2;     
        $resultados_tabla_promociones = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_promociones($id); 
        foreach ($resultados_tabla_promociones as $row) {  
                $lista.= '<tr>
                    <td>'.utf8_encode(strtoupper($row->VentaPromocionNombre)).'</td>
                    <td>'.utf8_encode(strtoupper($row->VentaPromocionDetalleDescripcion)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetalleGMC)).'</td>
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetalleCodigo)).'</td>   
                    <td class="txt-center">'.utf8_encode(strtoupper($row->VentaPromocionDetallePresentacion)).'</td>
                    <td class="txt-center" style="margin: auto auto;">'.$row->VentaUsuarioPromocionCantidad.'</td>
                </tr>' ;
        }
        $data['tabla_productos_promocion'] = $lista;        
        $pag = $this->load->view('modals/modals_ventas/modals_ventas_auditoria/modals_ventas_auditoria_view', $data, true);
        echo json_encode($pag);   
    }
    private function ventas_auditoria_rechazados_controller_tabla_rows($venta) {
            $VentaVariableGet = md5('IDVEN'.funciones_strategix_formato_fecha_actual());
            $registroventa = new DateTime($venta->VentaFechaRegistro); $data["fecharegistro"] = $registroventa->format('Y-m-d');
            $data["distribuidora"] = $venta->DistribuidorId . " - " . utf8_encode(strtoupper($venta->DistribuidorDetalleCodigo)) . " - " . utf8_encode(strtoupper($venta->DistribuidorDetalleNombreComercial));
            $fechaauditoriaformato = new DateTime($venta->VentaAuditoriaFechaAudito);
            $data["fechaauditoria"] = $fechaauditoriaformato->format('Y-m-d');
            $data["VentaId"] = $venta->VentaId;
            $data["VentaUsuarioNombreMP"] = utf8_encode(strtoupper($venta->VentaUsuarioNombreMP));
            $data["VentaNumeroTicket"] = utf8_encode(strtoupper($venta->VentaNumeroTicket));
            $data["VentaMontoTicket"] = "$ ".number_format($venta->VentaMontoTicket,2);
            $data["VentaAuditoriaTipoDescripcion"] = utf8_encode(strtoupper($venta->VentaAuditoriaTipoDescripcion));
            $data["VentaAuditoriaEstatusDescripcion"] = utf8_encode(strtoupper($venta->VentaAuditoriaEstatusDescripcion));
            $data["VentaAuditoriaObservacionDescripcion"] = utf8_encode(strtoupper($venta->VentaAuditoriaObservacionDescripcion));
            $data["VentaAuditoriaId"] = $venta->VentaAuditoriaId;
            $fechaEnvioCorreo = new DateTime($venta->VentaAuditoriaFechaEnvioCorreo);
            $data["VentaAuditoriaFechaEnvioCorreo"] = $fechaEnvioCorreo->format('Y-m-d H:i:s');
            $fechaEnvioCorreoCierre = new DateTime($venta->VentaAuditoriaFechaEnvioCorreoCierre);
            $data["VentaAuditoriaFechaEnvioCorreoCierre"] = $fechaEnvioCorreoCierre->format('Y-m-d H:i:s');
            $data["link_modal_ticket"] = '<a href= "javascript:ventas_auditoria_rechazados_tabla_view_js_modal_ticket('.$venta->VentaId.');"><i class="fas fa-ticket-alt"></i></a>';
            $data["link_actualiza_venta"] = '<a href= "'.funciones_strategix_version_url_random_base_url("TicketsActualiza").'&'.$VentaVariableGet.'='.$venta->VentaId.'"> ACTUALIZAR</a>';
            return $data;
    }
    public function ventas_auditoria_rechazados_controller_actualiza_venta(){
        $VentasIdVariableGet = md5('IDVEN'.funciones_strategix_formato_fecha_actual());
        $data["VentasId"]   = $this->input->get($VentasIdVariableGet);
        $datos = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_folio_tarjeta($data["VentasId"]);
        $data["txt_qr"]    = $datos->TarjetaNumero;
        $data["ventaId"]    = $datos->VentaId;
        $data["numeroticket"]    = $datos->VentaNumeroTicket;
        $data["montoticket"]    = $datos->VentaMontoTicket;
        $data["fototicket"]    = $datos->VentaFotoTicket;
        $this->base_controller_create_view_sistema('ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_actualiza_view',$data);
    }   
    public function ventas_auditoria_rechazados_controller_cart_agregar_producto_inicial() {
        $ventaId = $this->input->post('ventaId',TRUE);
        $data = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_venta_detalles($ventaId);
        $tabla = $this->ventas_auditoria_rechazados_controller_tabla_productos_ingresados_anteriores($data);
        echo json_encode($tabla);
    } 
     public function ventas_auditoria_rechazados_controller_tabla_productos_ingresados_anteriores($data) {
        $tabla = "";
        foreach ($data as $items) {
            $clase  = utf8_encode($this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_nombre_clases($items->ProductoClaseId));
            $marca  = utf8_encode($this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_nombre_marcas($items->ProductoMarcaId));
            $litros = utf8_encode($this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_nombre_litros($items->VentaDetalleLitros));
            $tabla .='
                <tr class="grey-text">
                    <td>'.strtoupper($clase).'</td>
                    <td>'.strtoupper($marca).'</td>
                    <td> '.number_format($items->VentaDetalleMonto,2).'</td>
                    <td>'.$items->VentaDetalleCantidad.'</td>
                    <td>'.$litros.' GALÃO</td>
                    <td class="txt-center"><button type="button" id="'.$items->VentaDetalleId.'" data-position="left" data-tooltip="Eliminar" name="eliminar_prod_ant" class="romove_cart btn waves-effect waves-light tooltipped red"><i class="fas fa-trash"></i></button></td>                                            
                </tr> ';            
        }
        $data['tabla'] = $tabla;
        return $data;
    }
    public function ventas_auditoria_rechazados_controller_modal_foto(){
        $modal               = $this->input->post('modal',TRUE);
        $data['archivo']       = "";
        $url ="";
        switch ($modal){
            case 1: $url = 'modals/modals_ventas/modals_ventas_registro_ticket/modals_ventas_registro_ticket_foto_iphone_view'; break;
            case 2: $url = 'modals/modals_ventas/modals_ventas_registro_ticket/modals_ventas_registro_ticket_foto_android_view'; break;
        }
        $pag = $this->load->view($url,$data,TRUE);
        echo json_encode($pag);   
    }
    public function ventas_auditoria_rechazados_controller_guarda_foto(){
        $this->ventas_auditoria_rechazados_controller_valida_session_foto();
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
    public function ventas_auditoria_rechazados_controller_valida_session_foto() {
        if ($this->session->userdata('s_venta_foto')!=""){
            if (file_exists('uploads/temporal/ventas/fotos/'.$this->session->userdata('s_venta_foto'))){ unlink('uploads/temporal/ventas/fotos/'.$this->session->userdata('s_venta_foto')); }
            $this->session->unset_userdata('s_venta_foto');
        }
    }    
    public function ventas_auditoria_rechazados_controller_valida_venta() {
if ($this->input->post('txt_ticket_foto',TRUE) || !empty($_FILES['txt_ticket_archivo']['name'])) {
    $cargaarchivo = 1;
} else {
    $cargaarchivo = 0;
}
        $this->ventas_auditoria_rechazados_controller_set_rules($cargaarchivo);
        $res_errors = $this->ventas_auditoria_rechazados_controller_form_error($cargaarchivo);
        if ($res_errors==1){
            $data['venta_id']   = $this->ventas_auditoria_rechazados_controller_guardar_venta($cargaarchivo);
            $data['resultado']  = 1;
            echo json_encode($data);   
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }   
    }     
    public function ventas_auditoria_rechazados_controller_valida_campos() {
      if ($this->input->post('txt_ticket_foto',TRUE) || !empty($_FILES['txt_ticket_archivo']['name'])) {
    $cargaarchivo = 1;
} else {
    $cargaarchivo = 0;
}
        $this->ventas_auditoria_rechazados_controller_set_rules($cargaarchivo);
        $res_errors = $this->ventas_auditoria_rechazados_controller_form_error($cargaarchivo);
        if ($res_errors==1){
            echo json_encode(1);
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode($res_errors)); 
        }   
    }
    private function ventas_auditoria_rechazados_controller_maestro_pintor_informacion($TarjetaId) {
        $maestro_pintor = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_maestro_pintor_informacion(trim($TarjetaId));
        if (empty($maestro_pintor)){           
            return '';
        } else {            
            $nombre = utf8_encode($maestro_pintor->UsuarioDetalleNombre)." ".utf8_encode($maestro_pintor->UsuarioDetalleSegundoNombre)." ".utf8_encode($maestro_pintor->UsuarioDetalleApellidos);
            $maestro_pintor_texto = $this->lang->line('ventas_auditoria_rechazados_controller_lang_etiqueta_maestro_pintor')." ".$nombre;
            return $maestro_pintor_texto;
        }        
    }
    private function ventas_auditoria_rechazados_controller_set_rules($cargaarchivo) {
         
        $this->form_validation->set_rules('txt_numero_ticket', $this->lang->line('ventas_auditoria_rechazados_controller_lang_placeholder_numero_ticket'), 'required|xss_clean');
        $this->form_validation->set_rules('txt_monto_ticket', $this->lang->line('ventas_auditoria_rechazados_controller_lang_placeholder_monto_ticket'), 'required|numeric|xss_clean');
        if($cargaarchivo==1){
        if($this->input->post('chk_camara',TRUE)){ $this->form_validation->set_rules('txt_ticket_foto', $this->lang->line('ventas_auditoria_rechazados_controller_lang_placeholder_ticket'), 'required|xss_clean'); }
        }
    }  
    private function ventas_auditoria_rechazados_controller_form_error($cargaarchivo) {
        $json_txt_numero_ticket = $json_txt_monto_ticket = $json_txt_ticket_foto = $json_txt_ticket_archivo = array();
        if (!$this->form_validation->run()) {        
            if (!empty(form_error('txt_numero_ticket'))) { $json_txt_numero_ticket =  array('txt_numero_ticket' => form_error('txt_numero_ticket', '<small class="mt-3 text-danger">', '</small>')); }
            if (!empty(form_error('txt_monto_ticket'))) { $json_txt_monto_ticket =  array('txt_monto_ticket' => form_error('txt_monto_ticket', '<small class="mt-3 text-danger">', '</small>')); }
            if($this->input->post('chk_camara',TRUE)){
               if($cargaarchivo==1){
            if (!empty(form_error('txt_ticket_foto'))) { $json_txt_ticket_foto =  array('txt_ticket_foto' => form_error('txt_ticket_foto', '<small class="mt-3 text-danger">', '</small>')); }
             $json = array_merge($json_txt_numero_ticket,$json_txt_monto_ticket,$json_txt_ticket_foto); 
            }
            } else {
                $json = array_merge($json_txt_numero_ticket,$json_txt_monto_ticket);
            }
            return $json;
        } else {             
            return 1; 
        }                
    }    
    private function ventas_auditoria_rechazados_controller_guardar_venta($cargaarchivo) {    
        $this->ventas_auditoria_rechazados_controller_guardar_venta_valida_carpetas();
        if($cargaarchivo==1){
        if($this->input->post('chk_camara',TRUE)){ $imagen_ticket = $this->ventas_auditoria_rechazados_controller_guardar_venta_foto(); }
        if($this->input->post('chk_archivo',TRUE)){ $imagen_ticket = $this->ventas_auditoria_rechazados_controller_guardar_venta_archivo(); }
       }else{$imagen_ticket ='';}
        $ventaInsert = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_guardar_venta($this->input->post('VentasId',TRUE),trim($this->input->post('txt_numero_ticket',TRUE)),strtoupper(trim($this->input->post('txt_monto_ticket',TRUE))),$imagen_ticket,$this->uniqueId,$cargaarchivo);
        if($ventaInsert && $this->cart->contents()>0){
            $total=0;
        foreach ($this->cart->contents() as $items) {
            $total = $items['monto'] * $items['qty'];
            $data = $this->input->post('VentasId',TRUE).",".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",".$items['monto'] .",".$items['qty'] .",".$items['litros'].",".$items['marca'].",".$total;
            $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_guardar_venta_detalle($data);
        }
        $this->ventas_auditoria_rechazados_controller_cart_limpiar();
        }
        return 1;
    }
    private function ventas_auditoria_rechazados_controller_guardar_venta_foto() {
        $foto_temp = 'uploads/temporal/ventas/fotos/'.$this->session->userdata('s_venta_foto');
        $foto_final = 'uploads/ventas/'.funciones_strategix_anio().'/'. funciones_strategix_mes().'/'.$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."/ticket-".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."-".funciones_strategix_fecha_hora_actual().".png";
        if (file_exists($foto_temp)){ rename ($foto_temp ,$foto_final); }       
        $this->session->unset_userdata('s_venta_foto');
        return $foto_final;
    }
    private function ventas_auditoria_rechazados_controller_guardar_venta_archivo() {
        $archivo   = "/ticket-".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."-".funciones_strategix_fecha_hora_actual();
        $direccion = $this->base_controller_valida_crea_carpetas('ventas/'.funciones_strategix_anio().'/'. funciones_strategix_mes().'/'.$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));        
        $archivo_array = $this->base_controller_cargas_upload_archivo('txt_ticket_archivo', $direccion, '*', $archivo);
        $archivo_final = $archivo_array['file_name'];
        return "uploads/".'ventas/'.funciones_strategix_anio().'/'. funciones_strategix_mes().'/'.$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).$archivo_final;
    }    
    private function ventas_auditoria_rechazados_controller_guardar_venta_valida_carpetas() {
        $this->base_controller_valida_crea_carpetas('ventas');
        $this->base_controller_valida_crea_carpetas('ventas/'.funciones_strategix_anio());
        $this->base_controller_valida_crea_carpetas('ventas/'.funciones_strategix_anio().'/'. funciones_strategix_mes());
        $this->base_controller_valida_crea_carpetas('ventas/'.funciones_strategix_anio().'/'. funciones_strategix_mes().'/'.$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));
    }
    public function ventas_auditoria_rechazados_controller_qr_retorno() {
        $data['qr'] = intval($this->input->post('code_qr',TRUE));
        if ($data['qr']!=""){ 
            $datos_maestro_pintor = $this->ventas_auditoria_rechazados_controller__maestro_pintor_informacion($data['qr']);
            if (empty($datos_maestro_pintor)){
                $data['resultado'] = 0;
            } else {
                $data['resultado'] = 1;
                $data['datos_maestro_pintor'] = $datos_maestro_pintor;
            }      
        }
        echo json_encode($data);
    }
    private function ventas_auditoria_rechazados_controller__maestro_pintor_informacion($TarjetaId) {
        $maestro_pintor = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_maestro_pintor_informacion(trim($TarjetaId));
        if (empty($maestro_pintor)){           
            return '';
        } else {            
            $nombre = utf8_encode($maestro_pintor->UsuarioDetalleNombre)." ".utf8_encode($maestro_pintor->UsuarioDetalleSegundoNombre)." ".utf8_encode($maestro_pintor->UsuarioDetalleApellidos);
            $maestro_pintor_texto = $this->lang->line('ventas_registro_ticket_controller_lang_etiqueta_maestro_pintor')." ".$nombre;
            return $maestro_pintor_texto;
        }        
    }
     public function ventas_auditoria_rechazados_controller_ajax_combo_lista_clase() {
        $cmb_sector = $this->input->post('cmb_sector',TRUE);
        $combo_clase = "<option value='0'>".$this->lang->line('ventas_registro_controller_lang_combo_selecciona_clase')."</option>";
        $clases         = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_combo_clases();
        foreach ($clases as $clase) { $combo_clase   .='<option value="'.$clase->ProductoClaseId.'">'.utf8_encode(strtoupper($clase->ProductoClaseDescripcion)).'</option>'; } 
        echo json_encode($combo_clase);
    }
    public function ventas_auditoria_rechazados_controller_ajax_combo_lista_litros() {
        $combo_litros = "<option value='0'>".$this->lang->line('ventas_registro_controller_lang_combo_selecciona_litros')."</option>";
        $marcas         = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_combo_litros();
        foreach ($marcas as $marca) { $combo_litros   .='<option value="'.$marca->VentaDetalleGalonEquivalencia.'">'.utf8_encode(strtoupper($marca->VentaDetalleGalonDescripcion)).'</option>'; } 
        echo json_encode($combo_litros);
    } 
    public function ventas_auditoria_rechazados_controller_ajax_combo_lista_marca() {
        $cmd_clase = $this->input->post('cmd_clase',TRUE);
        $combo_marca = "<option value='0'>".$this->lang->line('ventas_registro_controller_lang_combo_selecciona_marca')."</option>";
        $marcas         = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_combo_marcas($cmd_clase);
        foreach ($marcas as $marca) { $combo_marca   .='<option value="'.$marca->ProductoMarcaId.'">'.utf8_encode(strtoupper($marca->ProductoMarcaDescripcion)).'</option>'; } 
        echo json_encode($combo_marca);
    }


     public function ventas_auditoria_rechazados_controller_cart_limpiar() {
        $this->load->library("cart");
        $this->cart->destroy();
    }
    public function ventas_auditoria_rechazados_controller_cart_agregar_producto() {
        $id = md5(uniqid(rand(), TRUE));
        $data = array('id' => $id,'name' => 0,'price' => 0,'qty' => $this->input->post('txt_marca_cantidad'),'clase' => $this->input->post('cmd_clase'),'marca' => $this->input->post('cmb_marca'),'monto' => $this->input->post('txt_marca_monto'),'litros'=>$this->input->post('cmb_marca_litros'));        
        $this->cart->insert($data);
        $tabla = $this->ventas_auditoria_rechazados_controller_cart_tabla();
        echo json_encode($tabla);
    } 
    public function ventas_auditoria_rechazados_controller_cart_borrar_producto() {
        $data = array('rowid' => $this->input->post('row_id'),'qty' => 0);
        $this->cart->update($data);
        $tabla = $this->ventas_auditoria_rechazados_controller_cart_tabla();
        echo json_encode($tabla);
    }
    public function ventas_auditoria_rechazados_controller_cart_muestra_tabla() {
        $tabla = $this->ventas_auditoria_rechazados_controller_cart_tabla();
        echo json_encode($tabla);
    }
    public function ventas_auditoria_rechazados_controller_cart_tabla() {
        $data['tabla'] = "";
        foreach ($this->cart->contents() as $items) {
            $clase  = utf8_encode($this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_nombre_clases($items['clase']));
            $marca  = utf8_encode($this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_nombre_marcas($items['marca']));
            $litros = utf8_encode($this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_nombre_litros($items['litros']));
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
    public function ventas_auditoria_rechazados_controller_baja_producto_anterior() {
        $id_prod = $this->input->post('id_prod',TRUE);
        $marcas         = $this->ventas_auditoria_rechazados_model->ventas_auditoria_rechazados_model_baja_venta_detalle($id_prod);
      echo json_encode(1);
    }
}
