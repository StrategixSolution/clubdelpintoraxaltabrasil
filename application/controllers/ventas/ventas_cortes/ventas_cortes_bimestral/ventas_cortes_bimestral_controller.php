<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Ventas_cortes_bimestral_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        $this->load->model('ventas/ventas_cortes/ventas_cortes_bimestral/ventas_cortes_bimestral_model');
    }    
    public function index(){//Pagina de Inicio
       $data['sub_menu'] = $this->load->view('template/sistema/sub_menu/sub_menu_ventas_cortes', '', TRUE); 
        $this->base_controller_create_view_sistema('ventas/ventas_cortes/ventas_cortes_bimestral/ventas_cortes_bimestral_view_form',$data,TRUE);
    }
   
    public function ventas_cortes_bimestral_controller_combo_anios() {
        $cmbAnio ="<option  value='0'>".$this->lang->line('ventas_cortes_bimestral_controller_lang_select_combo_anio')."</option>";
        $anios  = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_combo_anios();
        foreach ($anios as $anio) {            
            $cmbAnio .="<option value=$anio->anio>$anio->anio</option>";
        }
        echo json_encode($cmbAnio);
    }
    public function ventas_cortes_bimestral_controller_combo_mes() {
        $cmbAnio = $this->input->post('cmb_anio',true);
        $cmbMes ="<option  value='0'>".$this->lang->line('ventas_cortes_bimestral_controller_lang_select_combo_periodo')."</option>";
        $meses  = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_combo_mes($cmbAnio);
        foreach ($meses as $mes) {            
            $bimestre = $mes->mes; $par = $bimestre%2;$mesanterior = $bimestre-1;
            if(($par)==0){ $cmbMes .="<option value=$mes->mes>".strtoupper(funciones_strategix_mes_numero_texto($mesanterior)).' - '.strtoupper(funciones_strategix_mes_numero_texto($bimestre))."</option>"; }
        }
        echo json_encode($cmbMes);
    }
    public function ventas_cortes_bimestral_controller_valida_boton() {
        echo $this->ventas_cortes_bimestral_controller_valida_corte();
    }
    public function ventas_cortes_bimestral_controller_creacion() { 
        $cmb_anio = $this->input->post('cmb_anio',true);
        $cmb_periodo = $this->input->post('cmb_periodo',true);      
        $mes_anterior=$cmb_periodo-1;
        if ($this->ventas_cortes_bimestral_controller_valida_corte()==1){ echo 1; return false; }
        if ($this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_valida_corte_cambio_estatus($cmb_anio,$cmb_periodo,$mes_anterior)==1){ echo 2; return false; }
        if ($this->base_controller_valida_corte(1, $cmb_anio, $cmb_periodo,0)==0){ echo 4; return false; }
        if ($this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_valida_ventas_auditorias($cmb_anio,$cmb_periodo,$mes_anterior)==1){ echo 3; return false; }
        $corte_id = $this->base_controller_guarda_corte(3,$cmb_anio,$cmb_periodo,0);
        $this->ventas_cortes_bimestral_controller_creacion_ventas($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_creacion_maestro_pintor($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_creacion_distribuidores($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_creacion_productos_registrados($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_creacion_litros_clase($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_creacion_perfiles($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_visualizacion($cmb_anio, $cmb_periodo);
    }
    private function ventas_cortes_bimestral_controller_creacion_ventas($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {
        $ventas = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_ventas($cmb_anio,$cmb_periodo,$mes_anterior);$txt_promociones ="";
        foreach ($ventas as $row) {
            $validapromocion = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_tiene_promociones($row->VentaId);
            $txt_promociones =""; $txt_promociones = ($validapromocion == 1)?$this->ventas_cortes_bimestral_controller_txt_promociones($row->VentaId):""; 
            $nombre = $row->UsuarioDetalleNombre;
            $data = $corte_id.",".$row->TarjetaId.",".$row->VentaId.",".$row->VentaUsuarioIdMP.",".$row->DistribuidorId.",'".$row->VentaNumeroTicket."',".$row->VentaDetalleMontoTicket.",'".mb_strtoupper(funciones_strategix_mes_numero_texto(date("m", strtotime($row->VentaFechaRegistro))))."','ACTIVA',".$row->VentaAuditoriaEstatusId.",'".funciones_strategix_convertir_fecha_hora_actual($row->VentaFechaRegistro)."'";
            $this->base_controller_guarda_corte_detalle("CortesBimestralVentas",$data);
        }
    }
    private function ventas_cortes_bimestral_controller_txt_promociones($VentaId){
        $txt_promociones ="";
        $promociones = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_promociones($VentaId);
        foreach ($promociones as $promocion) { 
            if($promocion->VentaPromocionNombre!=$txt_promociones){
                $txt_promociones = $promocion->VentaPromocionNombre.",";                
                $txt_promociones = substr ($txt_promociones, 0, strlen($txt_promociones) - 1);
            }                
        }
        return $txt_promociones;
    }
   
    private function ventas_cortes_bimestral_controller_creacion_maestro_pintor($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {
        $ventas = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_maestros_pintores($cmb_anio,$cmb_periodo,$mes_anterior);
        foreach ($ventas as $row) {            
            $ganador = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_lugar($cmb_anio,$cmb_periodo,$row->DistribuidorId,$row->UsuarioId);
            $lugar = (empty($ganador))?0:$ganador->ReposicionProductoGanadorPremioLugar;
            if ($lugar==0){
                $ganador2 = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_lugar($cmb_anio,$cmb_periodo,$row->DistribuidorId,$row->UsuarioId);
                $lugar = (empty($ganador2))?0:$ganador2->ReposicionProductoGanadorPremioLugar;
            }
            $data = $corte_id.",".$row->DistribuidorId.",".$row->VentaUsuarioIdMP.",".$row->CountTickets.",".$row->SumaMontoTicket.",'".$lugar."'";
            $this->base_controller_guarda_corte_detalle("CortesBimestralMaestrosPintores",$data);
        } 
    }
    private function ventas_cortes_bimestral_controller_creacion_distribuidores($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {
        $ventas = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_distribuidores($cmb_anio,$cmb_periodo,$mes_anterior);
        foreach ($ventas as $row) {         
            $ganador = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_ganador($cmb_anio,$cmb_periodo,$row->DistribuidorId);
            $ganadores = ($ganador==0)?0:1;
            if ($ganadores==0){
                $ganador2 = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_ganador($cmb_anio,$cmb_periodo,$row->DistribuidorId);
                $ganadores = ($ganador2==0)?0:1;
            }
            $data = $corte_id.",".$row->DistribuidorId.",".$row->CuentaTickete.",".$row->SumaMontoTickets;
            $this->base_controller_guarda_corte_detalle("CortesBimestralDistribuidores",$data);            
        }
    }
    private function ventas_cortes_bimestral_controller_creacion_productos_registrados($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {
        $ventas = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_productos_registrados($cmb_anio,$cmb_periodo,$mes_anterior);
        foreach ($ventas as $row) {         
                switch ($row->VentaAuditoriaEstatusId){
                    case 1: $statusauditoria = "PENDIENTE"; break;
                    case 2: $statusauditoria = "APROBADA"; break;
                    default: $statusauditoria = "RECHAZADA"; break;
                }
            $VentaDetalleMonto = 0;
            $VentaDetalleMonto = $row->VentaDetalleCantidad * $row->VentaDetalleLitros ;
            $data = $corte_id.",".$row->DistribuidorId.",".$row->UsuarioId.",".$row->TarjetaId.",".$row->VentaId.",'".$row->VentaNumeroTicket."',".$row->VentaDetalleMontoTicket.",".$row->ProductoClaseId.",".$row->ProductoMarcaId.",".$row->VentaDetalleLitros.",".$row->VentaDetalleCantidad.",".$VentaDetalleMonto.",".$row->VentaDetalleMonto.",".$row->VentaDetalleTotal.",'".$statusauditoria."','".funciones_strategix_convertir_fecha_hora_actual($row->VentaFechaRegistro)."'";
            $this->base_controller_guarda_corte_detalle("CortesBimestralProductosRegistrados",$data);            
        }
    }    
    private function ventas_cortes_bimestral_controller_creacion_litros_clase($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {
        $ventas = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_litros_clase($cmb_anio,$cmb_periodo,$mes_anterior);
        foreach ($ventas as $row) {  
            $data = $corte_id.",".$row->DistribuidorId.",".$row->ProductoClaseId.",".$row->TotalLitros.",".$row->TotalMonto;
            $this->base_controller_guarda_corte_detalle("CortesBimestralVentasLitrosClases",$data);     
        }
    }
    private function ventas_cortes_bimestral_controller_creacion_perfiles($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {
        $ventas = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_perfiles($cmb_anio,$cmb_periodo,$mes_anterior);
        foreach ($ventas as $row) {
            $data = $corte_id.",".$row->DistribuidorId.",".$row->VentaUsuarioIdRegistro.",".$row->cantidad_tickets.",".$row->monto_ticket;
            $this->base_controller_guarda_corte_detalle("CortesBimestralesPerfiles",$data);
        }
    }
    
    public function ventas_cortes_bimestral_controller_visualizacion($cmb_anio="", $cmb_periodo="") {  
        $cmb_anio = $this->input->post('cmb_anio',true);
        $cmb_periodo = $this->input->post('cmb_periodo',true);    
        $txt_promociones=$lista ="";
        $corteId = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_corte($cmb_anio, $cmb_periodo);
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_visualiza_corte($corteId);
        foreach ($visualiza_corte as $row) {            
            $lista.= '<tr>                    
                    <td>'.$row->CorteBimestralVentaVentaId.'</td>
                    <td>'.$row->CorteBimestralVentaUsuarioId.'</td>
                    <td>'.utf8_encode(strtoupper($row->CorteBimestralVentaNombreMaestroPintor)).'</td>
                    <td>'.$row->CorteBimestralVentaDistribuidorId.'</td>
                    <td>'.$row->CorteBimestralVentaDistribuidorDetalleCodigo.'</td>
                    <td>'.utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleRazonSocial)).'</td>
                    <td>'.utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleNombreComercial)).'</td>
                    <td>'.utf8_encode($row->CorteBimestralVentaVentaNumeroTicket).'</td>
                    <td>'.$row->CorteBimestralVentaVentaMontoTicket.'</td>
                    <td>'.$row->CorteBimestralVentaVentaDetalleMonto.'</td>
                    <td>'.$row->CorteBimestralVentaVentaDetalleCantidad.'</td>
                    <td>'.$row->CorteBimestralVentaVentaDetalleLitros.'</td>
                    <td>'.utf8_encode(strtoupper($row->CorteBimestralVentaPromocion)).'</td>
                    <td>'.$row->CorteBimestralVentaMes.'</td>
                    <td>'.$row->CorteBimestralVentaVentaEstatus.'</td>
                    <td>'.$row->CorteBimestralVentaVentaAuditoriaEstatusDescripcion.'</td>
                    <td>'.date("Y-m-d", strtotime($row->CorteBimestralVentaVentaFechaRegistro)).'</td>                           
                   </tr>' ;
        }
        $data['tabla']          = $lista; 
        $tablareporte = $this->load->view('ventas/ventas_cortes/ventas_cortes_bimestral/ventas_cortees_bimestral_table_view', $data, true);
        echo json_encode($tablareporte);        
    }
    public function ventas_cortes_bimestral_controller_valida_corte() {
        $cmb_anio = $this->input->post('cmb_anio',true);
        $cmb_periodo = $this->input->post('cmb_periodo',true);        
        return ($this->base_controller_valida_corte(3, $cmb_anio, $cmb_periodo,0)==0)?0:1;
    }
    public function ventas_cortes_bimestral_controller_excel() {
        $cmb_anio = $this->input->post('cmb_anio',true);
        $cmb_periodo = $this->input->post('cmb_periodo',true);   
        $mesanterior = $cmb_periodo-1;
        $corteId = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_corte($cmb_anio,$cmb_periodo);
        $carpeta = glob('uploads/excel/cortes/corte_bimestral/*');
        foreach ($carpeta as $archivo) {
            if (is_file($archivo))
                unlink($archivo);
        }
        $nombreArchivo = 'CORTE_VENTAS_'.strtoupper(funciones_strategix_mes_numero_texto($mesanterior)).'-'.strtoupper(funciones_strategix_mes_numero_texto($cmb_periodo)).$cmb_anio.'_'. date("d") . date("m") . date("Y") . ".xlsx";       
        $archivo = "uploads/excel/cortes/corte_bimestral/$nombreArchivo";
       // if (file_exists($archivo)) { unlink($archivo); }
        $this->base_controller_valida_crea_carpetas('excel/');
        $this->base_controller_valida_crea_carpetas('excel/cortes/');
        $this->base_controller_valida_crea_carpetas('excel/cortes/corte_bimestral/');         
        $spreadsheet = new Spreadsheet(3);
        $this->ventas_cortes_bimestral_controller_excel_ventas($spreadsheet,$corteId);
        $this->ventas_cortes_bimestral_controller_excel_maestro_pintor($spreadsheet,$corteId);
        $this->ventas_cortes_bimestral_controller_excel_distribuidor($spreadsheet,$corteId);
        $this->ventas_cortes_bimestral_controller_excel_productos_registrados($spreadsheet,$corteId);
       // $this->ventas_cortes_bimestral_controller_excel_litros_clase($spreadsheet,$corteId);
        $this->ventas_cortes_bimestral_controller_excel_perfiles($spreadsheet,$corteId);
        $direccion = funciones_strategix_version_url_random_base_url($archivo);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save($archivo);   
        $url = str_replace("\\",'/',$archivo);
        echo json_encode($direccion);
    }
    public function ventas_cortes_bimestral_controller_excel_ventas($spreadsheet,$corteId){
        $sheet = $spreadsheet->getActiveSheet(0);
        $sheet->setTitle("Ventas Bimestrales");
        $sheet->setCellValue('A1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_id_venta'));
        $sheet->setCellValue('B1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_id_usuario'));
        $sheet->setCellValue('C1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_nombre_pintor'));
        $sheet->setCellValue('D1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_id_distribuidor'));
        $sheet->setCellValue('E1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_codigo'));
        $sheet->setCellValue('F1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_razon_social'));                
        $sheet->setCellValue('G1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_nombre_comercial'));
        $sheet->setCellValue('H1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_numero_ticket'));
        $sheet->setCellValue('I1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_total_ticket'));
        $sheet->setCellValue('J1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_total_monto'));
        $sheet->setCellValue('K1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_total_cantidad'));
       // $sheet->setCellValue('L1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_total_litros'));
        $sheet->setCellValue('L1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_promociones'));
        $sheet->setCellValue('M1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_mes'));
        $sheet->setCellValue('N1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_estatus'));
        $sheet->setCellValue('O1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_auditoria'));
        $sheet->setCellValue('P1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_fecha'));
        $sheet->getStyle("A1:P1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:P1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_visualiza_corte($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) {      
            $sheet->setCellValue('A'.$fila, $row->CorteBimestralVentaVentaId);
            $sheet->setCellValue('B'.$fila, $row->CorteBimestralVentaUsuarioId);
            $sheet->setCellValue('C'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaNombreMaestroPintor)));
            $sheet->setCellValue('D'.$fila, $row->CorteBimestralVentaDistribuidorId);
            $sheet->setCellValue('E'.$fila, $row->CorteBimestralVentaDistribuidorDetalleCodigo);
            $sheet->setCellValue('F'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('G'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('H'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaVentaNumeroTicket)));
            $sheet->setCellValue('I'.$fila, number_format($row->CorteBimestralVentaVentaMontoTicket,2));
            $sheet->setCellValue('J'.$fila, number_format($row->CorteBimestralVentaVentaDetalleMonto,2));
            $sheet->setCellValue('K'.$fila, $row->CorteBimestralVentaVentaDetalleCantidad);
            // $sheet->setCellValue('L'.$fila, $row->CorteBimestralVentaVentaDetalleLitros);
            $sheet->setCellValue('L'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaPromocion)));
            $sheet->setCellValue('M'.$fila, $row->CorteBimestralVentaMes);
            $sheet->setCellValue('N'.$fila, $row->CorteBimestralVentaVentaEstatus);
            $sheet->setCellValue('O'.$fila, $row->CorteBimestralVentaVentaAuditoriaEstatusDescripcion);            
            $sheet->setCellValue('P'.$fila, date("Y-m-d", strtotime($row->CorteBimestralVentaVentaFechaRegistro)));
            $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','P') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:P1".$limit)->getFont()->setName('Arial')->setSize(8);
    }
    public function ventas_cortes_bimestral_controller_excel_maestro_pintor($spreadsheet,$corteId){
        $sheet = $spreadsheet->createSheet(1); 
        $sheet->setTitle("Montos Acumulados por MP");
        $sheet->setCellValue('A1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_id_distribuidor'));
        $sheet->setCellValue('B1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_codigo'));
        $sheet->setCellValue('C1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_razon_social'));
        $sheet->setCellValue('D1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_nombre_comercial'));
        $sheet->setCellValue('E1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_id_usuario'));
        $sheet->setCellValue('F1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_nombre_pintor'));                
        $sheet->setCellValue('G1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_numero_tickets'));
        $sheet->setCellValue('H1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_monto_tickets'));
        $sheet->setCellValue('I1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_precio_unitario'));
        $sheet->setCellValue('J1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_cantidad_productos'));
        // $sheet->setCellValue('K1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_total_litros'));
        $sheet->setCellValue('K1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_premio'));
        $sheet->getStyle("A1:K1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_visualiza_maestros_pintores($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) {
            $premio = ($row->ReposicionProductoGanadorPremioLugar==0)?"":$row->ReposicionProductoGanadorPremioLugar;
            $sheet->setCellValue('A'.$fila, $row->CorteBimestralMaestroPintorDistribuidorId);
            $sheet->setCellValue('B'.$fila, $row->CorteBimestralMaestroPintorDistribuidorDetalleCodigo);
            $sheet->setCellValue('C'.$fila, utf8_encode(strtoupper($row->CorteBimestralMaestroPintorDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('D'.$fila, utf8_encode(strtoupper($row->CorteBimestralMaestroPintorDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('E'.$fila, $row->CorteBimestralMaestroPintorUsuarioId);
            $sheet->setCellValue('F'.$fila, utf8_encode(strtoupper($row->CorteBimestralMaestroPintorMaestroPintor)));
            $sheet->setCellValue('G'.$fila, $row->CorteBimestralMaestroPintorCantidadTickets);
            $sheet->setCellValue('H'.$fila, number_format($row->CorteBimestralMaestroPintorVentaMontoTicket,2));
            $sheet->setCellValue('I'.$fila, number_format($row->CorteBimestralMaestroPintorVentaDetalleMonto,2));
            $sheet->setCellValue('J'.$fila, $row->CorteBimestralMaestroPintorVentaDetalleCantidad);
           // $sheet->setCellValue('K'.$fila, $row->CorteBimestralMaestroPintorVentaDetalleLitros);
            $sheet->setCellValue('K'.$fila, $premio);
                $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','K') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:K1".$limit)->getFont()->setName('Arial')->setSize(8);
    }
    public function ventas_cortes_bimestral_controller_excel_distribuidor($spreadsheet,$corteId){
        $sheet = $spreadsheet->createSheet(2); 
        $sheet->setTitle("Montos Acumulados por Dist");
        $sheet->setCellValue('A1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_id_distribuidor'));
        $sheet->setCellValue('B1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_codigo'));
        $sheet->setCellValue('C1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_razon_social'));
        $sheet->setCellValue('D1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_nombre_comercial'));
        $sheet->setCellValue('E1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_cantidad_tickets'));
        $sheet->setCellValue('F1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_monto_tickets'));                
        $sheet->setCellValue('G1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_precio_unitario'));
        $sheet->setCellValue('H1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_cantidad_productos'));
       // $sheet->setCellValue('I1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_total_litros'));
        $sheet->getStyle("A1:H1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
         $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_visualiza_ditribuidores($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) { 
            $ganador = ($row->CorteBimestralDistribuidorGanador==0)?"NO":"SI";
            $sheet->setCellValue('A'.$fila, $row->CorteBimestralDistribuidorDistribuidorId);
            $sheet->setCellValue('B'.$fila, $row->CorteBimestralDistribuidorDistribuidorDetalleCodigo);
            $sheet->setCellValue('C'.$fila, utf8_encode(strtoupper($row->CorteBimestralDistribuidorDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('D'.$fila, utf8_encode(strtoupper($row->CorteBimestralDistribuidorDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('E'.$fila, $row->CorteBimestralDistribuidorCantidadTicktes);
            $sheet->setCellValue('F'.$fila, number_format($row->CorteBimestralDistribuidorVentaMontoTicket,2));
            $sheet->setCellValue('G'.$fila, number_format($row->CorteBimestralDistribuidorVentaDetalleMonto,2));
            $sheet->setCellValue('H'.$fila, $row->CorteBimestralDistribuidorVentaDetalleCantidad);
            //$sheet->setCellValue('I'.$fila, $row->CorteBimestralDistribuidorVentaDetalleLitros);
            $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','H') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:H".$limit)->getFont()->setName('Arial')->setSize(8);
    }
    public function ventas_cortes_bimestral_controller_excel_productos_registrados($spreadsheet,$corteId) {
       $sheet = $spreadsheet->createSheet(3); 
        $sheet->setTitle("RP Productos Registrados");
        $sheet->setCellValue('A1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_id_distribuidora'));       
        $sheet->setCellValue('B1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_codigo'));
        $sheet->setCellValue('C1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_razon_social'));
        $sheet->setCellValue('D1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_nombre_distribuidor'));
        $sheet->setCellValue('E1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_id_usuario'));                
        $sheet->setCellValue('F1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_maestro_pintor'));
        $sheet->setCellValue('G1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_tarjeta'));
        $sheet->setCellValue('H1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_ticket'));
        $sheet->setCellValue('I1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_monto_ticket'));
        $sheet->setCellValue('J1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_linea'));
        $sheet->setCellValue('K1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_clase'));
        $sheet->setCellValue('L1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_marca'));
        // $sheet->setCellValue('M1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_presentacion'));
        $sheet->setCellValue('M1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_cantidad'));
        // $sheet->setCellValue('O1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_total_litros'));
        $sheet->setCellValue('N1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_precio'));
        $sheet->setCellValue('O1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_precio_total'));       
        $sheet->setCellValue('P1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_estatus'));
        $sheet->setCellValue('Q1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_fecha_registro'));
        $sheet->getStyle("A1:Q1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:Q1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_visualiza_productos_registrados($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) {

            $sheet->setCellValue('A'.$fila, $row->CorteBimestralProductoRegistradoDistribuidorId);
            $sheet->setCellValue('B'.$fila, $row->CorteBimestralProductoRegistradoDistribuidorDetalleCodigo);
            $sheet->setCellValue('C'.$fila, utf8_encode(strtoupper($row->CorteBimestralProductoRegistradoDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('D'.$fila, utf8_encode(strtoupper($row->CorteBimestralProductoRegistradoDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('E'.$fila, $row->CorteBimestralProductoRegistradoUsuarioId);
            $sheet->setCellValue('F'.$fila, utf8_encode(strtoupper($row->CorteBimestralProductoRegistradoNombreMaestroPintor)));
            $sheet->setCellValue('G'.$fila, $row->CorteBimestralProductoRegistradoTarjetaNumero);
            $sheet->setCellValue('H'.$fila, $row->CorteBimestralProductoRegistradoVentaNumeroTicket);
            $sheet->setCellValue('I'.$fila, number_format($row->CorteBimestralProductoRegistradoVentaMontoTicket,2));
            $sheet->setCellValue('J'.$fila, utf8_encode(strtoupper($row->CorteBimestralProductoRegistradoProductoLineaDescripcion)));
            $sheet->setCellValue('K'.$fila, utf8_encode(strtoupper($row->CorteBimestralProductoRegistradoProductoClaseDescripcion)));
            $sheet->setCellValue('L'.$fila, utf8_encode(strtoupper($row->CorteBimestralProductoRegistradoProductoMarcaDescripcion)));
           // $sheet->setCellValue('M'.$fila, $row->CorteBimestralProductoRegistradoVentaDetalleLitros);
            $sheet->setCellValue('M'.$fila, $row->CorteBimestralProductoRegistradoVentaDetalleCantidad);
           // $sheet->setCellValue('O'.$fila, $row->CorteBimestralProductoRegistradoVentaDetalleLitrosTotal);
            $sheet->setCellValue('N'.$fila, number_format($row->CorteBimestralProductoRegistradoVentaDetalleMonto,2));
            $sheet->setCellValue('O'.$fila, number_format($row->CorteBimestralProductoRegistradoVentaDetalleMontoTotal,2));
            $sheet->setCellValue('P'.$fila, $row->CorteBimestralProductoRegistradoVentaEstatus);
            $sheet->setCellValue('Q'.$fila, $row->CorteBimestralProductoRegistradoVentaFechaRegistro);
            $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','Q') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:Q".$limit)->getFont()->setName('Arial')->setSize(8);
    }
  /* public function ventas_cortes_bimestral_controller_excel_litros_clase($spreadsheet,$corteId) {
        $sheet = $spreadsheet->createSheet(4); 
        $sheet->setTitle("RP Litros por Clases");
        $sheet->setCellValue('A1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excelds_titulo_id_distribuidor'));
        $sheet->setCellValue('B1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excelds_titulo_codigo'));
        $sheet->setCellValue('C1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excelds_titulo_razon_social'));
        $sheet->setCellValue('D1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excelds_titulo_nombre_comercial'));
        $sheet->setCellValue('E1', $this->lang->line('reportes_productos_registrados_controller_lang_tabla_titulo_linea'));
        $sheet->setCellValue('F1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excelds_titulo_clase'));
        $sheet->setCellValue('G1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excelds_titulo_total_litros'));                
        $sheet->setCellValue('H1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excelds_titulo_precio_unitario'));

        $sheet->getStyle("A1:H1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_visualiza_litros_clase($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) {
            $sheet->setCellValue('A'.$fila, $row->CorteBimestralVentaDistribuidorId);
            $sheet->setCellValue('B'.$fila, $row->CorteBimestralVentaDistribuidorDetalleCodigo);
            $sheet->setCellValue('C'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('D'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('E'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaLitroClaseProductoLineaDescripcion)));
            $sheet->setCellValue('F'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaLitroClaseProductoClaseDescripcion)));
            $sheet->setCellValue('G'.$fila, $row->CorteBimestralVentaLitroClaseDetalleLitros);
            $sheet->setCellValue('H'.$fila, number_format($row->CorteBimestralVentaLitroClaseDetalleMonto,2));
            $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','H') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:H1".$limit)->getFont()->setName('Arial')->setSize(8);
    }*/
    public function ventas_cortes_bimestral_controller_excel_perfiles($spreadsheet,$corteId){
        $sheet = $spreadsheet->createSheet(4); 
        $sheet->setTitle("Montos Acumulados por RT|PT|AD");
        $sheet->setCellValue('A1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_id_distribuidor'));
        $sheet->setCellValue('B1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_codigo'));
        $sheet->setCellValue('C1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_razon_social'));
        $sheet->setCellValue('D1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_nombre_comercial'));
        $sheet->setCellValue('E1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_region_distri'));
        $sheet->setCellValue('F1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_estatus_distri'));                
        $sheet->setCellValue('G1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_id_usuario'));
        $sheet->setCellValue('H1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_nombre_registro'));
        $sheet->setCellValue('I1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_perfil'));
        $sheet->setCellValue('J1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_estatus_perfil'));
        $sheet->setCellValue('K1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_cantidad_tickets'));
        $sheet->setCellValue('L1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_monto_tickets'));
        $sheet->getStyle("A1:L1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_corte_perfil($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) {
            $sheet->setCellValue('A'.$fila, $row->CortesBimestralPerfilDistribuidorId);
            $sheet->setCellValue('B'.$fila, $row->CortesBimestralPerfilDistribuidorDetalleCodigo);
            $sheet->setCellValue('C'.$fila, utf8_encode(strtoupper($row->CortesBimestralPerfilDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('D'.$fila, utf8_encode(strtoupper($row->CortesBimestralPerfilDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('E'.$fila, utf8_encode(strtoupper($row->CortesBimestralPerfilDistribuidorDetalleRegionNombre)));
            $sheet->setCellValue('F'.$fila, utf8_encode('ATIVO'));
            $sheet->setCellValue('G'.$fila, $row->CortesBimestralPerfilDetalleUsuarioIdRegistro);
            $sheet->setCellValue('H'.$fila, utf8_encode(strtoupper($row->UsuarioDetalleNombre)));
            $sheet->setCellValue('I'.$fila, utf8_encode(strtoupper($row->CortesBimestralPerfilPerfilDescripcion)));
            $sheet->setCellValue('J'.$fila, utf8_encode(strtoupper('ATIVO')));
            $sheet->setCellValue('K'.$fila, $row->CortesBimestralPerfilDistribuidorCantidadTicktes);
            $sheet->setCellValue('L'.$fila, '$ '.number_format($row->CortesBimestralPerfilDistribuidorVentaMontoTicket,2));
                $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','L') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:L1".$limit)->getFont()->setName('Arial')->setSize(8);
    }    
}