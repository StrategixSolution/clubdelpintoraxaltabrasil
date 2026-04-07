<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_auditoria_primera_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->uniqueId = md5(uniqid(rand(), TRUE));
        $this->load->model('ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_model');
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_form_view');
    }
    public function ventas_auditoria_primera_controller_combo_anio() {
        $cmbAnio ="<option  value='0'>".$this->lang->line('ventas_auditoria_primera_controller_lang_placeholder_anio')."</option>";
        $anios  = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_combo_anio();
        foreach ($anios as $anio) {            
            $cmbAnio .="<option value=$anio->anio>$anio->anio</option>";
        }
        echo json_encode($cmbAnio);
    }
    public function ventas_auditoria_primera_controller_combo_mes() {
        $cmbAnio = $this->input->post('anio',true);
        $cmbMes ="<option  value='0'>".$this->lang->line('ventas_auditoria_primera_controller_lang_placeholder_mes')."</option>";
        $meses  = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_combo_mes($cmbAnio);
        foreach ($meses as $mes) {            
            $cmbMes .="<option value=$mes->mes>".strtoupper(funciones_strategix_mes_numero_texto($mes->mes))."</option>";
        }
        echo json_encode($cmbMes);
    }

     public function ventas_auditoria_primera_controller_tabla() {
        $cmb_anio                   = $this->input->post('anio',true);
        $cmb_mes                    = $this->input->post('mes',true);       
        $ventastotales              = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_total_ventas($cmb_anio,$cmb_mes);
        $ventasValidasAuditoria     = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_total_ventas_auditoria_random($cmb_anio,$cmb_mes);
        $ventasPorcentaje           = floor($ventastotales *.2);
        $lista=$where="";        
        $where .= ($cmb_anio!=0)?" AND YEAR(VentaFechaRegistro) = $cmb_anio":"";
        $where .= ($cmb_mes!=0)?" AND MONTH(VentaFechaRegistro) = $cmb_mes":"";
       // $where .= ($cmb_pais!=0)?" AND Distribuidores.PaisId = $cmb_pais":"";
        //print_r($ventasValidasAuditoria.'<'.$ventasPorcentaje);die;
        if($ventasValidasAuditoria<$ventasPorcentaje){
           $limite = round($ventasPorcentaje)-$ventasValidasAuditoria;
           $newRamdoms      = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_crea_tabla_sin_validar($where,$limite);
           foreach ($newRamdoms as $newRamdom) { 
               $creaRandoms =  $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_update_random($newRamdom->VentaId);
           }
        }
        $totalauditorias = $totalauditadas = $totalrechazadas = $totalpendientes =0;
        $ventas      = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_crea_tabla($where);
        foreach ($ventas as $venta) { 
          //  $moneda =  $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_pais_moneda($venta->PaisId);
            $registroventa = new DateTime($venta->VentaFechaRegistro);
            $fecharegistro = $registroventa->format('Y-m-d');
            $registrofechaauditoria = new DateTime($venta->VentaAuditoriaFechaRegistro);
            if(empty($venta->VentaAuditoriaFechaRegistro)){$fechacapturaauditoria = "";}else{$fechacapturaauditoria = $registrofechaauditoria->format('Y-m-d');}
             switch ($venta->VentaAuditoriaEstatusId){
                case 1: $statusauditoria = "APROVADO"; $totalauditadas++; break;
                case 2: $statusauditoria = "REJEITADO"; $totalrechazadas++; break;
                default: $statusauditoria = "INCLINAÇÃO"; $totalpendientes++; break;
            }            
            $lista.= '<tr id="id-comercio-td-'.$venta->VentaId.'">                    
                    <td>'.utf8_encode(strtoupper($venta->VentaId)).'</td>
                    <td>'.utf8_encode(strtoupper($venta->DistribuidorDetalleRazonSocial)).'</td>
                    <td>'.utf8_encode(strtoupper($venta->nombrepax)).'</td>
                    <td>'.utf8_encode(strtoupper($venta->VentaNumeroTicket)).'</td>                        
                    <td>'.utf8_encode(strtoupper(number_format($venta->VentaMontoTicket,2))).'</td>
                    <td>'.utf8_encode(strtoupper(number_format($venta->VentaMontoTicketCapturado,2))).'</td>
                    <td>'.utf8_encode(strtoupper($venta->VentaCantidadProdcutos)).'</td>
                    <td>'.utf8_encode(strtoupper($venta->VentaTotalCantidadProdcutos)).'</td>
                    <td>'.utf8_encode(strtoupper($fecharegistro)).'</td>                                    
                    <td class="txt-center"><a href= "javascript:ventas_auditoria_tabla_view_js_modal_ticket('.$venta->VentaId.');"><i class="fas fa-ticket-alt"></i></a></td>
                    <td id="idstatus'.$venta->VentaId.'">'.$statusauditoria.'</td>
                    <td id="fechaauditoria'.$venta->VentaId.'">'.utf8_encode($fechacapturaauditoria).'</td>
                    <td id="observaciones'.$venta->VentaId.'">'.utf8_encode(strtoupper($venta->VentaAuditoriaObservacionDescripcion)).'</td>';
                    if($venta->VentaAuditoriaEstatusId == NULL){
                        $lista.=    '<td class="txt-center" id="ida'.$venta->VentaId.'"><i onClick="javascript:ventas_auditoria_primera_form_view_js_aprobada('.$venta->VentaId.');" class="fas fa-check" id="aprobada"></i></td>
                                     <td class="txt-center" id="idr'.$venta->VentaId.'"><i onClick="javascript:ventas_auditoria_primera_form_view_js_rechazo('.$venta->VentaId.');" class="fas fa-times" id="rechazada"></i></td>
                                  </tr>' ;
                    }else{
                        $lista.=    '<td></td>
                                     <td></td>
                                  </tr>' ;
                    }                
        }         
        $data['totalauditoria']           = $totalauditadas + $totalrechazadas + $totalpendientes;
        $data['totalauditadas']           = $totalauditadas + $totalrechazadas;
        $data['totalsinauditar']          = $totalpendientes;
        $data['tabla']           = $lista;
        //print_r($data);die;
        $tablaauditoriafx = $this->load->view('ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_tabla_view', $data, true);
        echo json_encode($tablaauditoriafx);
    }    

   /* public function ventas_auditoria_primera_controller_tabla() {
        $cmbAnio     = $this->input->post('anio',true);
        $cmbMes      = $this->input->post('mes',true); $i=1;$lista ="";
        $ventas      = $this->ventas_auditoria_primera_model->Ventas_auditoria_primera_model_crea_tabla($cmbAnio,$cmbMes);
        foreach ($ventas["auditoria_tabla"] as $venta) { 
            $registroventa = new DateTime($venta->VentaFechaRegistro);
            $fecharegistro = $registroventa->format('Y-m-d');
            $distribuidora = $venta->DistribuidorId . " - " . utf8_encode(strtoupper($venta->DistribuidorDetalleCodigo)) . " - " . utf8_encode(strtoupper($venta->DistribuidorDetalleNombreComercial));
            if ($venta->VentaAuditoriaTipoId==1){
                $tickets_repetidos = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_tickets_repetidos($venta->VentaId,$cmbAnio,$cmbMes,$venta->DistribuidorId,$venta->VentaUsuarioIdMP,$venta->VentaMontoTicket);
            } else {
                $tickets_repetidos = "&nbsp;";
            }
                
            $lista.= '<tr id="id-comercio-td-'.$venta->VentaId.'">
                    <td>'.$i.'</td>
                    <td>'.utf8_encode(strtoupper($venta->VentaId)).'</td>
                    <td>'.utf8_encode(strtoupper($venta->VentaUsuarioNombreMP)).'</td>
                    <td>'.utf8_encode(strtoupper($venta->VentaNumeroTicket)).'</td>
                    <td>$ '.number_format($venta->VentaMontoTicket,2).'</td>                       
                    <td>'.utf8_encode(strtoupper($fecharegistro)).'</td>
                    <td>'.$distribuidora.'</td>
                    <td class="txt-center"><a href= "javascript:ventas_auditoria_primera_form_view_js_modal_ticket('.$venta->VentaId.');"><i class="fas fa-ticket-alt"></i></a></td>
                    <td>'.utf8_encode(strtoupper($venta->VentaAuditoriaTipoDescripcion)).'</td>
                    <td>'.$tickets_repetidos.'</td>  
                    <td id="idstatus'.$venta->VentaAuditoriaId.'">'.utf8_encode(strtoupper($venta->VentaAuditoriaEstatusDescripcion)).'</td>
                    <td id="observaciones'.$venta->VentaAuditoriaId.'">'.utf8_encode(strtoupper($venta->VentaAuditoriaObservacionDescripcion)).'&nbsp;</td>';
                    if($venta->VentaAuditoriaEstatusId == 1){
                        $lista.=    '<td class="txt-center" id="ida'.$venta->VentaAuditoriaId.'"><i onClick="javascript:ventas_auditoria_primera_form_view_js_aprobada('.$venta->VentaAuditoriaId.');" class="fas fa-check" id="aprobada"></i></td>
                                     <td class="txt-center" id="idr'.$venta->VentaAuditoriaId.'"><i onClick="javascript:ventas_auditoria_primera_form_view_js_rechazo('.$venta->VentaAuditoriaId.');" class="fas fa-times" id="rechazada"></i></td>
                                  </tr>' ;
                    }else{
                        $lista.=    '<td>&nbsp;</td>
                                     <td>&nbsp;</td>
                                  </tr>' ;
                    }   
            $i++;
        }         
        $data['totalauditoria']           = $ventas["auditoria_total"];
        $data['totalauditadas']           = $ventas["auditoria_no_pendientes"];
        $data['totalsinauditar']          = $ventas["auditoria_pendientes"];
        $data['tabla']                    = $lista;
        $tablaauditoriafx = $this->load->view('ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_tabla_view', $data, true);
        echo json_encode($tablaauditoriafx);
    }*/
    public function ventas_auditoria_primera_controller_ticket_modal() {
          $id                 = $this->input->post('id',true);
        $row                = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_fila($id);
       // $moneda =  $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_pais_moneda($row->PaisId);
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
      /*  $id                 = $this->input->post('id',true);
        $row                = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_ticket_modal($id);
        $registroventa = new DateTime($row->VentaFechaRegistro);
        $fecharegistro = $registroventa->format('Y-m-d');
        $data['tabla_datos'] = '<tr>'
                . '<td>'.$id.'</td>'
                . '<td>'.utf8_encode(strtoupper($row->VentaUsuarioNombreMP)).'</td>'
                . '<td class="txt-center">'.utf8_encode(strtoupper($row->VentaNumeroTicket)).'</td>'
                . '<td class="txt-center">$'.number_format($row->VentaMontoTicket,2).'</td>'
                . '<td class="txt-center">'.utf8_encode(strtoupper($fecharegistro)).'</td>'
                . '</tr>';
        $data['archivo'] = $row->VentaFotoTicket;
        $pag = $this->load->view('modals/modals_ventas/modals_ventas_auditoria/modals_ventas_auditoria_view', $data, true);
        echo json_encode($pag);   
        */
    }    
    public function ventas_auditoria_primera_controller_aprobada() {
        $idventa      = $this->input->post('VentaAuditoriaId',true);
        $usuario       = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        $status = 2;
        $act_status = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_status_aprobado($status,$idventa,$usuario);
        $dato['fechacambio']   = date('Y-m-d');
        $dato['idventa'] = $idventa;
        $dato['status'] = 'APROVADO';
        echo json_encode($dato);
    }
    public function ventas_auditoria_primera_controller_rechazada() {
       $Observacionid                = $this->input->post('Observacionid',true);
        $observaciones = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_observacion_descripcion($Observacionid);
        $idventa                 = $this->input->post('VentaAuditoriaId',true);
        $usuario         = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        $status = 3;
        $data['fechacambio']   = date('Y-m-d');
        $data['Observacion']   = strtoupper($observaciones);
        $data['idventa']    = $this->input->post('VentaAuditoriaId',true);
        $data['status']        = 'REJEITADO';
        $act_status = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_status_rechazado($status,$idventa,$usuario,$Observacionid);
        echo json_encode($data);
    }
    public function ventas_auditoria_primera_controller_combo_observaciones() {
        $observaciones = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_observaciones();
        foreach ($observaciones as $observacion) {
            $cmb_observacion[$observacion->VentaAuditoriaObservacionId] = utf8_encode(strtoupper($observacion->VentaAuditoriaObservacionDescripcion));         
        }
        echo json_encode($cmb_observacion);
    }
    public function ventas_auditoria_primera_controller_crea_random(){
        $cmbAnio     = $this->input->post('anio',true);
        $cmbMes      = $this->input->post('mes',true);
        $auditorias_random = $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_auditorias_random($cmbAnio,$cmbMes);
        if ($auditorias_random["auditorias_random_faltantes"]<=0) {
            echo json_encode(0);
        } else {
            $this->ventas_auditoria_primera_model->ventas_auditoria_primera_model_genera_randoms($auditorias_random["auditorias_random_faltantes"],$cmbAnio,$cmbMes);
            echo json_encode(1);
        }
    }
}
