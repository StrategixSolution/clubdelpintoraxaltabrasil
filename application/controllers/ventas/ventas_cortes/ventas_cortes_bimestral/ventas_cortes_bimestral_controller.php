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
    public function ventas_cortes_bimestral_controller_cmb_anios() {
        $cmbAnio ="<option  value='0'>".$this->lang->line('ventas_cortes_bimestral_controller_lang_select_combo_anio')."</option>";
        $anios  = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_cmbanios();
        foreach ($anios as $anio) {            
            $cmbAnio .="<option value=$anio->anio>$anio->anio</option>";
        }
        echo json_encode($cmbAnio);
    }
    public function ventas_cortes_bimestral_controller_cmb_mes() {
        $cmbAnio = $this->input->post('cmb_anio',true);
        $cmbMes ="<option  value='0'>".$this->lang->line('ventas_cortes_bimestral_controller_lang_select_combo_periodo')."</option>";
        $meses  = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_cmbmes($cmbAnio);
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
        $cmb_anio = $this->input->post('anio',true);$cmb_periodo = $this->input->post('mes',true);$mes_anterior=$cmb_periodo-1;
        
        if ($this->ventas_cortes_bimestral_controller_valida_corte($cmb_anio,$cmb_periodo)==1){ echo 1; return false; }     
        if ($this->ventas_cortes_bimestral_controller_valida_ventas($cmb_anio,$cmb_periodo,$mes_anterior)==0){ echo 2; return false; }
        if ($this->ventas_cortes_bimestral_controller_valida_auditoria($cmb_anio,$cmb_periodo,$mes_anterior)==1){ echo 3; return false; } 
        $corte_id = $this->base_controller_guarda_corte(3,$cmb_anio,$cmb_periodo,0);
        $this->ventas_cortes_bimestral_controller_creacion_ventas($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_creacion_maestro_pintor($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_creacion_perfiles($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_creacion_distribuidores($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id);
        $this->ventas_cortes_bimestral_controller_excel();
    }
    private function ventas_cortes_bimestral_controller_creacion_ventas($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {
        $data = "SELECT $corte_id, Ventas.TarjetaId, Ventas.VentaId, Ventas.VentaUsuarioIdMP, Ventas.DistribuidorId, Ventas.VentaNumeroTicket, Ventas.VentaMontoTicket, MONTH(Ventas.VentaFechaRegistro), 1, VentasAuditorias.VentaAuditoriaEstatusId, Ventas.VentaFechaRegistro, ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."
        FROM Ventas INNER JOIN Usuarios ON Ventas.VentaUsuarioIdMP = Usuarios.UsuarioId INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId LEFT JOIN UsuariosDetalles AS UsuariosMaestroPintor ON Ventas.VentaUsuarioIdMP = UsuariosMaestroPintor.UsuarioId INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
        WHERE (Ventas.VentaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) AND (VentasAuditorias.VentaAuditoriaId IS NOT NULL) AND (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) AND 
        (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (Distribuidores.DistribuidorUsuarioIdBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND 
        (YEAR(Ventas.VentaFechaRegistro) = $cmb_anio) AND (MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $cmb_periodo))";
        $this->base_controller_guarda_corte_detalle("CortesBimestralesVentas",$data);
    }
    private function ventas_cortes_bimestral_controller_creacion_maestro_pintor($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {
        $data = "SELECT $corte_id, 
            Ventas.DistribuidorId, 
            Ventas.VentaUsuarioIdMP, 
            COUNT(Ventas.VentaId), 
            SUM(Ventas.VentaMontoTicket), 
            (SELECT ReposicionProductoGanadorPremioLugar FROM ReposicionesProductosGanadores WHERE  (ReposicionProductoGanadorAnio = $cmb_anio) AND (ReposicionProductoGanadorMes IN ($mes_anterior, $cmb_periodo)) AND (UsuarioId = Ventas.VentaUsuarioIdMP) AND (DistribuidorId = Ventas.DistribuidorId)) as ReposicionProductoGanadorPremioLugar
            ,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."
            FROM 
            Ventas INNER JOIN Usuarios ON Ventas.VentaUsuarioIdMP = Usuarios.UsuarioId 
            INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId 
            INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
            INNER JOIN DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId 
            LEFT JOIN UsuariosDetalles AS UsuariosMaestroPintor ON Ventas.VentaUsuarioIdMP = UsuariosMaestroPintor.UsuarioId 
            INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
            WHERE (Ventas.VentaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) AND (VentasAuditorias.VentaAuditoriaId IS NOT NULL) AND (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) AND (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (Distribuidores.DistribuidorUsuarioIdBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (YEAR(Ventas.VentaFechaRegistro) = $cmb_anio) AND (MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $cmb_periodo)) 
            GROUP BY 
            Ventas.DistribuidorId, 
            Ventas.VentaUsuarioIdMP, 
            UsuariosMaestroPintor.UsuarioDetalleNombre, 
            UsuariosMaestroPintor.UsuarioDetalleSegundoNombre, 
            UsuariosMaestroPintor.UsuarioDetalleApellidos
            ORDER BY ReposicionProductoGanadorPremioLugar ";
        $this->base_controller_guarda_corte_detalle("CortesBimestralesMaestrosPintores",$data);
    }
    private function ventas_cortes_bimestral_controller_creacion_perfiles($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {        
        $data = "SELECT $corte_id, Ventas.DistribuidorId, Ventas.VentaUsuarioIdRegistro, COUNT(Ventas.VentaId), SUM(Ventas.VentaMontoTicket), ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."
                FROM Ventas INNER JOIN Usuarios ON Ventas.VentaUsuarioIdMP = Usuarios.UsuarioId INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId INNER JOIN Usuarios AS Usuarios_1 ON Ventas.VentaUsuarioIdRegistro = Usuarios_1.UsuarioId LEFT JOIN UsuariosDetalles AS UsuariosRegistro ON Ventas.VentaUsuarioIdRegistro = UsuariosRegistro.UsuarioId INNER JOIN Perfiles ON Usuarios_1.PerfilId = Perfiles.PerfilId
                WHERE (Ventas.VentaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) AND (VentasAuditorias.VentaAuditoriaId IS NOT NULL) AND (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) AND (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (Distribuidores.DistribuidorUsuarioIdBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (YEAR(Ventas.VentaFechaRegistro) = $cmb_anio) AND (MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $cmb_periodo))
                GROUP BY Ventas.DistribuidorId, Ventas.VentaUsuarioIdRegistro, UsuariosRegistro.UsuarioDetalleNombre, UsuariosRegistro.UsuarioDetalleSegundoNombre, UsuariosRegistro.UsuarioDetalleApellidos, Usuarios_1.UsuarioFechaBajaParticipante, Usuarios_1.UsuarioFechaBajaDistribuidora, Perfiles.PerfilId";
        $this->base_controller_guarda_corte_detalle("CortesBimestralesPerfiles",$data);
    }    
    private function ventas_cortes_bimestral_controller_creacion_distribuidores($cmb_anio,$cmb_periodo,$mes_anterior,$corte_id) {
        $data = "SELECT $corte_id, Ventas.DistribuidorId, COUNT(Ventas.VentaId), SUM(Ventas.VentaMontoTicket), ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))."
                FROM Ventas INNER JOIN Usuarios ON Ventas.VentaUsuarioIdMP = Usuarios.UsuarioId INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
                WHERE (Ventas.VentaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) AND (VentasAuditorias.VentaAuditoriaId IS NOT NULL) AND (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) AND (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (Usuarios.UsuarioFechaBajaDistribuidora IS NULL) AND (Distribuidores.DistribuidorFechaBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND 
                (YEAR(Ventas.VentaFechaRegistro) = $cmb_anio) AND (MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $cmb_periodo))
                GROUP BY Ventas.DistribuidorId";
        $this->base_controller_guarda_corte_detalle("CortesBimestralesDistribuidores",$data);            
    }
    public function ventas_cortes_bimestral_controller_valida_corte() { 
        $cmb_anio = $this->input->post('anio',true);$cmb_periodo = $this->input->post('mes',true);
        return ($this->base_controller_valida_corte(3, $cmb_anio, $cmb_periodo,0)==0)?0:1;
    }
    public function ventas_cortes_bimestral_controller_valida_ventas($cmb_anio,$cmb_mes,$mes_anterior) {
        return $this->base_controller_valida_ventas($cmb_anio,$cmb_mes,$mes_anterior);
    }      
    public function ventas_cortes_bimestral_controller_valida_auditoria($cmb_anio,$cmb_mes,$mes_anterior) {
        return $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_valida_ventas_auditorias($cmb_anio,$cmb_mes,$mes_anterior);
    }    
    public function ventas_cortes_bimestral_controller_excel() {
        $cmb_anio = $this->input->post('anio',true);$cmb_periodo = $this->input->post('mes',true);
        $corteId = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_corte($cmb_anio,$cmb_periodo);
        $archivo = "uploads/excel/cortes/corte_bimestral/CorteVentasBimestral.xlsx";
        if (file_exists($archivo)) { unlink($archivo); }
        $this->base_controller_valida_crea_carpetas('excel/');
        $this->base_controller_valida_crea_carpetas('excel/cortes/');
        $this->base_controller_valida_crea_carpetas('excel/cortes/corte_bimestral/');         
        $spreadsheet = new Spreadsheet(4);
        $this->ventas_cortes_bimestral_controller_excel_ventas($spreadsheet,$corteId);         
        $this->ventas_cortes_bimestral_controller_excel_maestro_pintor($spreadsheet,$corteId);
        $this->ventas_cortes_bimestral_controller_excel_perfiles($spreadsheet,$corteId);
        $this->ventas_cortes_bimestral_controller_excel_distribuidor($spreadsheet,$corteId);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="CorteVentasBimestral.xls"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save($archivo);   
        $url = str_replace("\\",'/',$archivo);
        echo json_encode($archivo);
    }
    public function ventas_cortes_bimestral_controller_excel_ventas($spreadsheet,$corteId){
        $sheet = $spreadsheet->getActiveSheet(0);
        $sheet->setTitle("Ventas");
        $sheet->setCellValue('A1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_id_venta'));
        $sheet->setCellValue('B1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_id_usuario'));
        $sheet->setCellValue('C1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_id_distribuidor'));
        $sheet->setCellValue('D1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_codigo'));                
        $sheet->setCellValue('E1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_razon_social'));
        $sheet->setCellValue('F1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_nombre_comercial'));
        $sheet->setCellValue('G1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_region_distri'));
        $sheet->setCellValue('H1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_numero_ticket'));
        $sheet->setCellValue('I1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_total_ticket'));
        $sheet->setCellValue('J1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_mes'));
        $sheet->setCellValue('K1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ventas_titulo_fecha'));
        $sheet->getStyle("A1:K1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_corte_ventas($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) {
            $CorteBimestralVentaFechaRegistro = new DateTime($row->CorteBimestralVentaFechaRegistro);
            $fecha = $CorteBimestralVentaFechaRegistro->format('Y-m-d');  
            $txtmes = funciones_strategix_mes_numero_texto($row->CorteBimestralVentaMes);  			
            $sheet->setCellValue('A'.$fila, $row->CorteBimestralVentaVentaId);
            $sheet->setCellValue('B'.$fila, $row->CorteBimestralVentaUsuarioIdMP);
            $sheet->setCellValue('C'.$fila, $row->CorteBimestralVentaDistribuidorId);
            $sheet->setCellValue('D'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleCodigo)));
            $sheet->setCellValue('E'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('F'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('G'.$fila, utf8_encode(strtoupper($row->CorteBimestralVentaDistribuidorDetalleRegionNombre)));
            $sheet->setCellValue('H'.$fila, $row->CorteBimestralVentaVentaNumeroTicket);
            $sheet->setCellValue('I'.$fila, '$ '.number_format($row->CorteBimestralVentaVentaMontoTicket,2));          
            $sheet->setCellValue('J'.$fila, utf8_encode(strtoupper($txtmes)));
            $sheet->setCellValue('K'.$fila, $fecha);
            $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','K') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:K1".$limit)->getFont()->setName('Arial')->setSize(8);
    }
    public function ventas_cortes_bimestral_controller_excel_maestro_pintor($spreadsheet,$corteId){
        $sheet = $spreadsheet->createSheet(1); 
        $sheet->setTitle("Montos Acumulados por MP");
        $sheet->setCellValue('A1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_id_distribuidor'));
        $sheet->setCellValue('B1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_codigo'));
        $sheet->setCellValue('C1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_razon_social'));
        $sheet->setCellValue('D1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_nombre_comercial'));
        $sheet->setCellValue('E1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_region_distri'));               
        $sheet->setCellValue('F1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_id_usuario'));
        $sheet->setCellValue('G1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_cantidad_tickets'));
        $sheet->setCellValue('H1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_monto_tickets'));
        $sheet->setCellValue('I1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_mp_titulo_premio'));
        $sheet->getStyle("A1:I1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_corte_maestros_pintores($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) {            
            $sheet->setCellValue('A'.$fila, $row->CorteBimestralMaestroPintorDistribuidorId);
            $sheet->setCellValue('B'.$fila, $row->CorteBimestralMaestroPintorDistribuidorDetalleCodigo);
            $sheet->setCellValue('C'.$fila, utf8_encode(strtoupper($row->CorteBimestralMaestroPintorDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('D'.$fila, utf8_encode(strtoupper($row->CorteBimestralMaestroPintorDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('E'.$fila, utf8_encode(strtoupper($row->CorteBimestralMaestroPintorDistribuidorDetalleRegionNombre)));
            $sheet->setCellValue('F'.$fila, $row->CorteBimestralMaestroPintorUsuarioIdMP);
            $sheet->setCellValue('G'.$fila, $row->CorteBimestralMaestroPintorCantidadTickets);
            $sheet->setCellValue('H'.$fila, '$ '.number_format($row->CorteBimestralMaestroPintorVentaMontoTicket,2));
            $sheet->setCellValue('I'.$fila, $row->ReposicionProductoGanadorPremioLugar);
                $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','I') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:I1".$limit)->getFont()->setName('Arial')->setSize(8);
    }
    public function ventas_cortes_bimestral_controller_excel_perfiles($spreadsheet,$corteId){
        $sheet = $spreadsheet->createSheet(2); 
        $sheet->setTitle("Montos Acumulados por RT|PT|AD");
        $sheet->setCellValue('A1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_id_distribuidor'));
        $sheet->setCellValue('B1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_codigo'));
        $sheet->setCellValue('C1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_razon_social'));
        $sheet->setCellValue('D1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_nombre_comercial'));
        $sheet->setCellValue('E1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_region_distri'));              
        $sheet->setCellValue('F1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_id_usuario'));
        $sheet->setCellValue('G1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_perfil'));
        $sheet->setCellValue('H1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_cantidad_tickets'));
        $sheet->setCellValue('I1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_perfil_titulo_monto_tickets'));
        $sheet->getStyle("A1:I1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_corte_perfil($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) {
            $sheet->setCellValue('A'.$fila, $row->CortesBimestralPerfilDistribuidorId);
            $sheet->setCellValue('B'.$fila, $row->CortesBimestralPerfilDistribuidorDetalleCodigo);
            $sheet->setCellValue('C'.$fila, utf8_encode(strtoupper($row->CortesBimestralPerfilDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('D'.$fila, utf8_encode(strtoupper($row->CortesBimestralPerfilDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('E'.$fila, utf8_encode(strtoupper($row->CortesBimestralPerfilDistribuidorDetalleRegionNombre)));
            $sheet->setCellValue('F'.$fila, $row->CortesBimestralPerfilDetalleUsuarioIdRegistro);
            $sheet->setCellValue('G'.$fila, utf8_encode(strtoupper($row->CortesBimestralPerfilPerfilDescripcion)));
            $sheet->setCellValue('H'.$fila, $row->CortesBimestralPerfilDistribuidorCantidadTicktes);
            $sheet->setCellValue('I'.$fila, '$ '.number_format($row->CortesBimestralPerfilDistribuidorVentaMontoTicket,2));
                $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','I') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:I1".$limit)->getFont()->setName('Arial')->setSize(8);
    }    
    public function ventas_cortes_bimestral_controller_excel_distribuidor($spreadsheet,$corteId){
        $sheet = $spreadsheet->createSheet(3); 
        $sheet->setTitle("Montos Acumulados por Dist");
        $sheet->setCellValue('A1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_id_distribuidor'));
        $sheet->setCellValue('B1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_codigo'));
        $sheet->setCellValue('C1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_razon_social'));
        $sheet->setCellValue('D1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_nombre_comercial'));
        $sheet->setCellValue('E1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_region_distri'));              
        $sheet->setCellValue('F1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_cantidad_tickets'));
        $sheet->setCellValue('G1', $this->lang->line('ventas_cortes_bimestral_controller_lang_excel_ds_titulo_monto_tickets'));
        $sheet->getStyle("A1:G1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $visualiza_corte = $this->ventas_cortes_bimestral_model->ventas_cortes_bimestral_model_corte_ditribuidores($corteId);
        $fila = 2;
        foreach ($visualiza_corte as $row) {
            $sheet->setCellValue('A'.$fila, $row->CorteBimestralDistribuidorDistribuidorId);
            $sheet->setCellValue('B'.$fila, $row->CorteBimestralDistribuidorDistribuidorDetalleCodigo);
            $sheet->setCellValue('C'.$fila, utf8_encode(strtoupper($row->CorteBimestralDistribuidorDistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('D'.$fila, utf8_encode(strtoupper($row->CorteBimestralDistribuidorDistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('E'.$fila, utf8_encode(strtoupper($row->CorteBimestralDistribuidorDistribuidorDetalleRegionNombre)));
            $sheet->setCellValue('F'.$fila, $row->CorteBimestralDistribuidorCantidadTicktes);
            $sheet->setCellValue('G'.$fila, '$ '.number_format($row->CorteBimestralDistribuidorVentaMontoTicket,2));
            $fila++;
        }
        $limit = $fila-1;
        foreach(range('A','G') as $columnID) { $sheet->getColumnDimension($columnID)->setAutoSize(true); }
        $sheet->getStyle("A1:G1".$limit)->getFont()->setName('Arial')->setSize(8);        
    }     
}