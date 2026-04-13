<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 ABRIL 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_auditoria_envio_correos_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->uniqueId = md5(uniqid(rand(), TRUE));
        $this->load->model('ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_model');
         $this->load->model('ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_model');
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_form_view');
    }
    public function ventas_auditoria_envio_correos_controller_combo_anio() {
        $cmbAnio ="<option  value='0'>".$this->lang->line('ventas_auditoria_envio_correos_controller_lang_placeholder_anio')."</option>";
        $anios  = $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_combo_anio();
        foreach ($anios as $anio) {            
            $cmbAnio .="<option value=$anio->anio>$anio->anio</option>";
        }
        echo json_encode($cmbAnio);
    }
    public function ventas_auditoria_envio_correos_controller_combo_mes() {
        $cmbAnio = $this->input->post('anio',true);
        $cmbMes ="<option  value='0'>".$this->lang->line('ventas_auditoria_envio_correos_controller_lang_placeholder_mes')."</option>";
        $meses  = $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_combo_mes($cmbAnio);
        foreach ($meses as $mes) {            
            $cmbMes .="<option value=$mes->mes>".strtoupper(funciones_strategix_mes_numero_texto($mes->mes))."</option>";
        }
        echo json_encode($cmbMes);
    }
    public function ventas_auditoria_envio_correos_controller_tabla() {
        $cmbAnio                                = $this->input->post('anio',true);$cmbMes      = $this->input->post('mes',true); $i=1;$lista ="";
        $ventas                                 = $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_crea_tabla($cmbAnio,$cmbMes);
        $data["total_auditorias_rechazadas"]    = count($ventas);
        foreach ($ventas["auditoria_tabla"] as $venta) { 
            $rows                               = $this->ventas_auditoria_envio_correos_controller_tabla_rows($venta,$cmbAnio,$cmbMes);                
            $lista.= '<tr id="id-comercio-td-'.$rows["VentaId"].'">
                    <td>'.$i.'</td> <td>'.$rows["VentaId"].'</td><td>'.$rows["VentaUsuarioNombreMP"].'</td>
                    <td>'.$rows["VentaNumeroTicket"].'</td> <td>'.$rows["VentaMontoTicket"].'</td>                       
                    <td>'.$rows["fecharegistro"].'</td> <td>'.$rows["distribuidora"].'</td>
                    <td class="txt-center">'.$rows["link_modal_ticket"].'</td>
                    <td>'.$rows["VentaAuditoriaTipoDescripcion"].'</td> 
                    <td id="idstatus'.$rows["VentaAuditoriaId"].'">'.$rows["VentaAuditoriaEstatusDescripcion"].'</td>
                    <td id="observaciones'.$rows["VentaAuditoriaId"].'">'.$rows["VentaAuditoriaObservacionDescripcion"].'</td>
                    <td>'.$rows["fechaauditoria"].'</td>
                    <td id="IdFechaEnvioCorreo'.$rows["VentaId"].'">'.$rows["VentaAuditoriaFechaEnvioCorreo"].'</td>
                    <td id="IdFechaEnvioCorreoCierre'.$rows["VentaId"].'">'.$rows["VentaAuditoriaFechaEnvioCorreoCierre"].'</td>
                    <td id="AccionEnvioCorreo'.$rows["VentaId"].'">'.$rows["link_envio_correo"].'</td>
                    </tr>';$i++;  
            
        }         
        $data['tabla']                          = $lista;
        echo json_encode($this->load->view('ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_tabla_view', $data, true));
    }
    private function ventas_auditoria_envio_correos_controller_tabla_rows($venta,$cmbAnio,$cmbMes) {
            $registroventa = new DateTime($venta->VentaFechaRegistro); $data["fecharegistro"] = $registroventa->format('Y-m-d');
            $data["distribuidora"] = $venta->DistribuidorId . " - " . utf8_encode(strtoupper($venta->DistribuidorDetalleCodigo)) . " - " . utf8_encode(strtoupper($venta->DistribuidorDetalleNombreComercial));
            $fechaauditoriaformato = new DateTime($venta->VentaAuditoriaFechaAudito);
            $data["fechaauditoria"] = $fechaauditoriaformato->format('Y-m-d');
            $data["VentaId"] = $venta->VentaId;
            $data["VentaUsuarioNombreMP"] = utf8_encode(strtoupper($venta->NombreMP));
            $data["VentaNumeroTicket"] = utf8_encode(strtoupper($venta->VentaNumeroTicket));
            $data["VentaMontoTicket"] = "$ ".number_format($venta->VentaMontoTicket,2);
            $data["VentaAuditoriaTipoDescripcion"] = utf8_encode(strtoupper($venta->VentaAuditoriaTipoDescripcion));
            $data["VentaAuditoriaEstatusDescripcion"] = utf8_encode(strtoupper($venta->VentaAuditoriaEstatusDescripcion));
            $data["VentaAuditoriaObservacionDescripcion"] = utf8_encode(strtoupper($venta->VentaAuditoriaObservacionDescripcion));
            $data["VentaAuditoriaId"] = $venta->VentaAuditoriaId;
            $fechaEnvioCorreo = new DateTime($venta->VentaAuditoriaFechaEnvioCorreo);
            $data["VentaAuditoriaFechaEnvioCorreo"] = ($venta->VentaAuditoriaFechaEnvioCorreo=="")?"":$fechaEnvioCorreo->format('Y-m-d H:i:s');
            $fechaEnvioCorreoCierre = new DateTime($venta->VentaAuditoriaFechaEnvioCorreoCierre);
            $data["VentaAuditoriaFechaEnvioCorreoCierre"] = ($venta->VentaAuditoriaFechaEnvioCorreoCierre=="")?"":$fechaEnvioCorreoCierre->format('Y-m-d H:i:s');
            $data["link_modal_ticket"] = '<a href= "javascript:ventas_auditoria_envio_correos_tabla_view_js_modal_ticket('.$venta->VentaId.');"><i class="fas fa-ticket-alt"></i></a>';
            $data["link_envio_correo"] = ($venta->VentaAuditoriaFechaEnvioCorreo=="")?'<a href= "javascript:ventas_auditoria_envio_correos_tabla_view_js_envio_correo('.$venta->VentaId.');"> ENVIAR CORREO </a>':"";
            return $data;
    }
    public function ventas_auditoria_envio_correos_controller_ticket_modal() {
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
    public function ventas_auditoria_envio_correos_controller_envio_correos() {
        $cmbAnio     = $this->input->post('anio',true);
        $cmbMes      = $this->input->post('mes',true);
        $distId = $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_distribuidora_Id($cmbAnio, $cmbMes);
        $data["VentaId"] = '';
        $data["FechaEnvioCorreo"]   = '';
        foreach ($distId as $distribuidora) {
            $ventas = $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_ventas($cmbAnio,$cmbMes,$distribuidora->DistribuidorId);
            $lista = $this->ventas_auditoria_envio_correos_controller_envio_correo_distribuidoras_tabla($ventas);
            $cuerpo_mail = $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_cuerpocorreo($cmbAnio, $cmbMes, $distribuidora->DistribuidorId);
            $correo = $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_datoscorreo($cmbAnio, $cmbMes, $distribuidora->DistribuidorId);
            $mestxt=funciones_strategix_mes_numero_texto($cmbMes);
            $this->ventas_auditoria_envio_correos_controller_envio_Correo_Distribuidora($correo, $lista, $mestxt, $cuerpo_mail); 
             foreach ($ventas as $venta) {
                    $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_actualiza_envio($venta->VentaAuditoriaId,2);
                   $data["VentaId"] .= $venta->VentaId;
                    $data["FechaEnvioCorreo"] .= funciones_strategix_formato_fecha_actual_txt();
                }
        }
         echo json_encode($data);
    }
    public function ventas_auditoria_envio_correos_controller_envio_correo() {
        $VentaId                    = $this->input->post('id', true);
        $this->ventas_auditoria_envio_correos_controller_envio_correo_simple($VentaId,1);
        $data["FechaEnvioCorreo"]   = funciones_strategix_formato_fecha_actual_txt();
        $data["id"]                 = $VentaId;
        echo json_encode($data);
    }
    private function ventas_auditoria_envio_correos_controller_envio_correo_simple($VentaId,$tipo) {
        $datos_tabla = $this->ventas_auditoria_envio_correos_controller_envio_correo_tabla($VentaId);$correo='';
        $distirbuidores = $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_datos_distribuidor($datos_tabla["DistribuidorId"]);
        foreach ($distirbuidores as $row) {
            $nombre = utf8_encode(strtoupper($row->UsuarioDetalleNombre)) . " " . utf8_encode(strtoupper($row->UsuarioDetalleSegundoNombre)) . " " . utf8_encode(strtoupper($row->UsuarioDetalleApellidos));
            $correo .= $row->UsuarioDetalleEmail.',';            
        }
        $correo = substr ($correo, 0, strlen($correo) - 1);  
        $this->ventas_auditoria_envio_correos_controller_email($correo,$datos_tabla["ditribuidor"],$nombre,$datos_tabla["lista"],$datos_tabla["mes"]);
        //update auditoria
        $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_actualiza_envio($datos_tabla["VentaAuditoriaId"],$tipo);
    }
    private function ventas_auditoria_envio_correos_controller_envio_correo_tabla($VentaId) {
        $rows= $this->ventas_auditoria_envio_correos_model->ventas_auditoria_envio_correos_model_crea_tabla_email($VentaId);
        $data["lista"] = "";
        $registroventa = new DateTime($rows->VentaFechaRegistro); $fecha_registro = $registroventa->format('Y-m-d');
        $data["ditribuidor"] = $rows->DistribuidorId . " - " . utf8_encode(strtoupper($rows->DistribuidorDetalleCodigo)) . " - " . utf8_encode(strtoupper($rows->DistribuidorDetalleNombreComercial));
        $data["lista"] .= '<tr>
            <td>' . $rows->VentaId . '</td>
            <td>' . utf8_encode(strtoupper($rows->VentaUsuarioNombreMP)) . '</td>
            <td>' . utf8_encode(strtoupper($rows->VentaNumeroTicket)) . '</td>
            <td>$ ' . number_format($rows->VentaMontoTicket, 2) . '</td>
            <td>' . $fecha_registro . '</td>
            <td>' . utf8_encode(strtoupper($data["ditribuidor"])) . '</td>
            <td>' . $rows->VentaAuditoriaEstatusDescripcion . '</td>
            <td>' . utf8_encode(strtoupper($rows->VentaAuditoriaObservacionDescripcion)) . '</td></tr>';
        $data["mes"] =  funciones_strategix_mes_numero_texto($registroventa->format('m'));
        $data["DistribuidorId"] = $rows->DistribuidorId;
        $data["VentaAuditoriaId"] = $rows->VentaAuditoriaId;
        return $data;
    }
    private function ventas_auditoria_envio_correos_controller_email($email,$distribuidor,$nombre,$lista,$mes) {
        $datos      = array('distribuidora' => $distribuidor, 'nombre' => $email, 'tabla' => $lista, 'mestxt' => $mes);
        $mail       = $this->load->view('mails/mails_ventas/mails_ventas_auditoria/mails_ventas_auditoria_envio_correos/mails_ventas_auditoria_envio_correos_view' ,$datos, TRUE);
        $to         = array('to' => $email,'cc'=>'','bcc'=>$this->config->item('bcc'));
        $this->base_controller_envio_correos($to,'AUDITORÍA CLUB DEL PINTOR AXALTA', $mail, '');
        return 1;
    }

    private function ventas_auditoria_envio_correos_controller_envio_correo_distribuidoras_tabla($ventas) {
       $lista = "";
       foreach ($ventas as $rows) {
        $registroventa = new DateTime($rows->VentaFechaRegistro); 
        $fecha_registro = $registroventa->format('Y-m-d');
        $data["ditribuidor"] = $rows->DistribuidorId . " - " . utf8_encode(strtoupper($rows->DistribuidorDetalleCodigo)) . " - " . utf8_encode(strtoupper($rows->DistribuidorDetalleNombreComercial));
         $lista .='<tr>
            <td>' . $rows->VentaId . '</td>
            <td>' . utf8_encode(strtoupper($rows->VentaUsuarioNombreMP)) . '</td>
            <td>' . utf8_encode(strtoupper($rows->VentaNumeroTicket)) . '</td>
            <td>$ ' . number_format($rows->VentaMontoTicket, 2) . '</td>
            <td>' . $fecha_registro . '</td>
            <td>' . utf8_encode(strtoupper($data["ditribuidor"])) . '</td>
            <td>' . $rows->VentaAuditoriaEstatusDescripcion . '</td>
            <td>' . utf8_encode(strtoupper($rows->VentaAuditoriaObservacionDescripcion)) . '</td></tr>';
       }
        return $lista;
    }

    public function ventas_auditoria_envio_correos_controller_envio_Correo_Distribuidora($correo, $lista, $mestxt,$cuerpo_mail) {
        $mail_string = '';
        foreach ($correo as $key => $value) {
            $mail_string .=$value->UsuarioDetalleEmail.",";
        }
        $nom_dist = $cuerpo_mail->DistribuidorId . " - " . utf8_encode(strtoupper($cuerpo_mail->DistribuidorDetalleCodigo)) . " - " . utf8_encode(strtoupper($cuerpo_mail->DistribuidorDetalleNombreComercial));
            $dat     = array('distribuidora' => "$nom_dist", 'tabla' => $lista, 'mestxt' => $mestxt,'nombre' => $mail_string);
            $mail       = $this->load->view('mails/mails_ventas/mails_ventas_auditoria/mails_ventas_auditoria_envio_correos/mails_ventas_auditoria_envio_correos_view' ,$dat, TRUE);
        $to         = array('to' => $mail_string,'cc'=>'ejecutivodecuenta@clubdelpintoraxalta.com.mx','bcc'=>$this->config->item('bcc'));
          $this->base_controller_envio_correos($to,'AUDITORÍA CLUB DEL PINTOR AXALTA', $mail, '');
        return 1;
    }
}



   