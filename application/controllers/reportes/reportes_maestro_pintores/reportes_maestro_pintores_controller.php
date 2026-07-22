<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Reportes_maestro_pintores_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
         valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('reportes/reportes_maestro_pintores/reportes_maestro_pintores_model');
        
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('reportes/reportes_maestro_pintores/reportes_maestro_pintores_form_view');
    }

    public function reportes_maestro_pintores_controller_cmb_distribuidor() {
        $perfil_id = $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));
        $distribuidores = $this->reportes_maestro_pintores_model->reportes_maestro_pintores_model_combo_distribuidor($perfil_id);
        $combo_distribuidores = '';
        if (in_array($perfil_id, [1, 2, 3,10])) {
            $combo_distribuidores .= '<option value="0">' . 
                $this->lang->line('reportes_maestro_pintores_controller_lang_select_combo_distribuidor_todos') . 
                '</option>';
        }
        foreach ($distribuidores as $distribuidor) {
            $nombre = !empty($distribuidor->DistribuidorDetalleNombreComercial)
                ? $distribuidor->DistribuidorDetalleCodigo . ' - ' . $distribuidor->DistribuidorDetalleNombreComercial
                : $distribuidor->DistribuidorDetalleCodigo . ' - ' . $distribuidor->DistribuidorDetalleRazonSocial;
            
            $combo_distribuidores .= '<option value="' . $distribuidor->DistribuidorId . '">' . 
                strtoupper(utf8_encode($nombre)) . 
                '</option>';
        }        
        echo json_encode($combo_distribuidores);
    }    

        public function reportes_maestro_pintores_controller_tabla() {
        $cmb_distribuidor = $this->input->post('cmb_distribuidor',true);
        $txt_nombre_mp = trim($this->input->post('txt_nombre_mp',true));
        $txt_nombre_mp = utf8_decode($txt_nombre_mp);
        $lista = $where = "";
        $where .= ($cmb_distribuidor != 0) ? "AND DistribuidoresDetalles.DistribuidorId =" . $cmb_distribuidor . " " : "";
        $where .= ($txt_nombre_mp != "" ) ? "AND UsuariosDetalles.UsuarioDetalleNombre LIKE '%" . $txt_nombre_mp . "%' " : "";
        $maestros = $this->reportes_maestro_pintores_model->reportes_maestro_pintores_model_crea_tabla($where);
        foreach ($maestros as $row) {
            $fecha_registro = date("Y-m-d", strtotime($row->UsuarioFechaRegistro));
            if ($row->UsuarioFechaBajaParticipante == "") {                $estatus = "HABILITADO";            } else {                $estatus = "DESATIVADO";            }
            $lista .= '<tr id="id-comercio-td-' . $row->UsuarioId . '">                    
                    <td>' . utf8_encode(strtoupper($row->UsuarioId)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->nombre)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->UsuarioDetalleEmail)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->UsuarioDetalleCelular)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->TarjetaNumero)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->UsuarioDetalleCiudad)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->UsuarioDetalleTallaDescripcion)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->DistribuidorId)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->DistribuidorDetalleCodigo)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->DistribuidorDetalleRazonSocial)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->DistribuidorDetalleNombreComercial)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->DistribuidorDetalleCEP)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->DistribuidorDetalleRegionNombre)) . '</td>
                    <td>' . utf8_encode(strtoupper($row->ejecutivo)) . '</td>                    
                    <td>' . $fecha_registro . '</td>
                    <td class="txt-center"><a href= "javascript:reportes_maestros_pintores_js_modal_firma(\'' . $row->UsuarioDetalleArchivoFirma . '\');"><i class="fas fa-ticket-alt"></i></a></td>
                    <td class="txt-center"><a href= "javascript:reportes_maestros_pintores_js_modal_identificacion(\'' . $row->UsuarioDetalleArchivoIdentificacion . '\');"><i class="fas fa-ticket-alt"></i></a></td>
                    </tr>';
        }
        $data['tabla'] = $lista;
        $tablareporte = $this->load->view('reportes/reportes_maestro_pintores/reportes_maestro_pintores_tabla_view', $data, true);
        echo json_encode($tablareporte);
        }

        public function reportes_maestro_pintores_controller_modal_firma()    {
        $data['archivo'] = $this->input->post('archivo', true);
        $data['titulo'] = $this->lang->line('reporte_maestros_pintores_controller_pagina_titulo_modal_firma');
        $data['div_inicio'] = "";
        $data['div_fin'] = "";
        $data['modalId'] = "myModal";
        $tipo = $this->input->post('tipo', true);
        switch ($tipo) {
            case 1:                $pag = 'modals/popups/popupvideo';                $data['titulo'] = "VIDEO";                break;
            case 2:                $pag = 'modals/popups/popuppdf';                $data['titulo'] = "PDF";                break;
            case 3:                $pag = 'modals/popups/popupimage';                $data['titulo'] = "IMAGEN";                break;
        }
        $pag = $this->load->view('modals/popups/popupimage', $data, true);
        echo json_encode($pag);
    }

    public function reportes_maestro_pintores_controller_modal_identificacion()    {
        $data['archivo'] = $this->input->post('archivo', true);
        $data['titulo'] = $this->lang->line('reporte_maestros_pintores_controller_pagina_titulo_modal_identificacion');
        $data['div_inicio'] = "";
        $data['div_fin'] = "";
        $data['modalId'] = "myModal";
        $tipo = $this->input->post('tipo', true);
        switch ($tipo) {
            case 1:                $pag = 'modals/popups/popupvideo';                $data['titulo'] = "VIDEO";                break;
            case 2:                $pag = 'modals/popups/popuppdf';                $data['titulo'] = "PDF";                break;
            case 3:                $pag = 'modals/popups/popupimage';                $data['titulo'] = "IMAGEN";                break;
        }
        $pag = $this->load->view('modals/popups/popupimage', $data, true);
        echo json_encode($pag);
    }


    public function reportes_maestro_pintores_controller_export_excel()    {
         $archivo = "uploads/maestros_pintores/excel/Relatorio_sobre_grandes_pintores.xlsx";
        if (file_exists($archivo)) {
            unlink($archivo);
        }
        $this->base_controller_valida_crea_carpetas('maestros_pintores/');
        $this->base_controller_valida_crea_carpetas('maestros_pintores/excel/');
        $cmb_distribuidor = $this->input->post('cmb_distribuidor',true);
        $txt_nombre_mp = trim($this->input->post('txt_nombre_mp',true));
        $txt_nombre_mp = utf8_decode($txt_nombre_mp);
        $spreadsheet = new Spreadsheet(4);
        $this->reportes_usuarios_maestros_pintores_controller_maestro_pintor($spreadsheet, $cmb_distribuidor, $txt_nombre_mp);
       if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) <= 3 || $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 10){ 
            $this->reportes_usuarios_maestros_pintores_controller_registro_por_mes($spreadsheet, $cmb_distribuidor, $txt_nombre_mp);
            $this->reportes_usuarios_maestros_pintores_controller_bajas_maestros_pintores($spreadsheet, $cmb_distribuidor, $txt_nombre_mp);
            $this->reportes_usuarios_maestros_pintores_controller_por_distribuidora($spreadsheet, $cmb_distribuidor, $txt_nombre_mp);
            $this->reportes_usuarios_maestros_pintores_controller_por_estado($spreadsheet, $cmb_distribuidor, $txt_nombre_mp);
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Relatorio_sobre_grandes_pintores.xls"');

        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save($archivo);
        $url = str_replace("\\", '/', $archivo);
        echo json_encode(2);
    }
    public function reportes_usuarios_maestros_pintores_controller_maestro_pintor($spreadsheet,  $cmb_distribuidor, $txt_nombre_mp)    {
        $sheet = $spreadsheet->getActiveSheet(0);
        $sheet->setTitle("Mestres Pintores");
        $sheet->setCellValue('A1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_id'));
        $sheet->setCellValue('B1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_nombre'));
        $sheet->setCellValue('C1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_email'));
        $sheet->setCellValue('D1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_celular'));
        $sheet->setCellValue('E1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_ntarjeta'));
        $sheet->setCellValue('F1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_ciudad'));
        $sheet->setCellValue('G1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_talla'));
        $sheet->setCellValue('H1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_iddistribuidor'));
        $sheet->setCellValue('I1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_codigo'));
        $sheet->setCellValue('J1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_razon_social'));
        $sheet->setCellValue('K1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_nombre_comercial'));
        $sheet->setCellValue('L1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_cp'));
        $sheet->setCellValue('M1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_region'));
        $sheet->setCellValue('N1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_ejecutivo'));
        $sheet->setCellValue('O1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_fecha_registro'));
        $sheet->getStyle("A1:O1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $where = "";
        $where .= ($cmb_distribuidor != 0) ? "AND DistribuidoresDetalles.DistribuidorId =" . $cmb_distribuidor . " " : "";
        $where .= ($txt_nombre_mp != "" ) ? "AND (UsuariosDetalles.UsuarioDetalleNombre LIKE '%" . $txt_nombre_mp . "%') " : "";
        $maestros = $this->reportes_maestro_pintores_model->reportes_maestro_pintores_model_crea_tabla($where);
        $fila = 2;
        foreach ($maestros as $row) {
        $fecha_registro = date("Y-m-d", strtotime($row->UsuarioFechaRegistro));
            if ($row->UsuarioFechaBajaParticipante == "") {                $estatus = "HABILITADO";            } else {                $estatus = "DESATIVADO";            }
            $sheet->setCellValue('A' . $fila, utf8_encode(strtoupper($row->UsuarioId)));
            $sheet->setCellValue('B' . $fila, utf8_encode(strtoupper($row->nombre)));
            $sheet->setCellValue('C' . $fila, utf8_encode(strtoupper($row->UsuarioDetalleEmail)));
            $sheet->setCellValue('D' . $fila, utf8_encode(strtoupper($row->UsuarioDetalleCelular)));
            $sheet->setCellValue('E' . $fila, utf8_encode(strtoupper($row->TarjetaNumero)));
            $sheet->setCellValue('F' . $fila, utf8_encode(strtoupper($row->UsuarioDetalleCiudad)));
            $sheet->setCellValue('G' . $fila, utf8_encode(strtoupper($row->UsuarioDetalleTallaDescripcion)));
            $sheet->setCellValue('H' . $fila, utf8_encode(strtoupper($row->DistribuidorId)));
            $sheet->setCellValue('I' . $fila, utf8_encode(strtoupper($row->DistribuidorDetalleCodigo)));
            $sheet->setCellValue('J' . $fila, utf8_encode(strtoupper($row->DistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('K' . $fila, utf8_encode(strtoupper($row->DistribuidorDetalleNombreComercial)));
            $sheet->setCellValue('L' . $fila, utf8_encode(strtoupper($row->DistribuidorDetalleCEP)));
            $sheet->setCellValue('M' . $fila, utf8_encode(strtoupper($row->DistribuidorDetalleRegionNombre)));
            $sheet->setCellValue('N' . $fila, utf8_encode(strtoupper($row->ejecutivo)));
            $sheet->setCellValue('O' . $fila, $fecha_registro);
            $fila++;
        }
        $limit = $fila - 1;
        foreach (range('A', 'O') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->getStyle("A1:O1" . $limit)->getFont()->setName('Arial')->setSize(8);

        $rango = "A1:O" . $limit;
        $sheet->getStyle($rango)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'] // negro
                ]
            ]
        ]);
    }
    public function reportes_usuarios_maestros_pintores_controller_registro_por_mes($spreadsheet,  $cmb_distribuidor, $txt_nombre_mp)    {
        $sheet = $spreadsheet->createSheet(1);
        $sheet->setTitle("Pintores Registrados por Mês");
        $sheet->setCellValue('A1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_mes_anio'));
        $sheet->setCellValue('B1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_mes_mes'));
        $sheet->setCellValue('C1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_mes_total'));
        $sheet->getStyle("A1:C1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $where = "";
        $where .= ($cmb_distribuidor != 0) ? "AND DistribuidoresDetalles.DistribuidorId =" . $cmb_distribuidor . " " : "";
        $where .= ($txt_nombre_mp != "" ) ? "AND (UsuariosDetalles.UsuarioDetalleNombre LIKE '%" . $txt_nombre_mp . "%')" : "";
        $maestrospintores = $this->reportes_maestro_pintores_model->reportes_usuarios_maestros_pintores_model_tabla_registros_por_mes($where);
        $x = 2;
        foreach ($maestrospintores as $row) {
            $txtMes = funciones_strategix_mes_numero_texto($row->mes);
            $sheet->setCellValue('A' . $x, $row->anio);
            $sheet->setCellValue('B' . $x, $txtMes);
            $sheet->setCellValue('C' . $x, $row->total);
            $x++;
        }
        $limit = $x - 1;
        foreach (range('A', 'C') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->getStyle("A1:C1" . $limit)->getFont()->setName('Arial')->setSize(8);

        $rango = "A1:C" . $limit;
        $sheet->getStyle($rango)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'] // negro
                ]
            ]
        ]);
    }
    public function reportes_usuarios_maestros_pintores_controller_bajas_maestros_pintores($spreadsheet,  $cmb_distribuidor, $txt_nombre_mp)    {
        $sheet = $spreadsheet->createSheet(2);
        $sheet->setTitle("PERDAS");
        $sheet->setCellValue('A1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_baja_mp_id'));
        $sheet->setCellValue('B1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_baja_mp_nombre'));
        $sheet->setCellValue('C1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_baja_mp_codigo'));
        $sheet->setCellValue('D1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_baja_mp_distribuidor'));
        $sheet->setCellValue('E1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_baja_mp_fecha_registro'));
        $sheet->setCellValue('F1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_baja_mp_fecha_baja'));
        $sheet->getStyle("A1:F1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
          $where = "";
       $where .= ($cmb_distribuidor != 0) ? "AND DistribuidoresDetalles.DistribuidorId =" . $cmb_distribuidor . " " : "";
        $where .= ($txt_nombre_mp != "" ) ? "AND (UsuariosDetalles.UsuarioDetalleNombre LIKE '%" . $txt_nombre_mp . "%')" : "";
        $maestrospintores = $this->reportes_maestro_pintores_model->reportes_usuarios_maestros_pintores_model_tabla_bajas($where);
        $x = 2;
        foreach ($maestrospintores as $row) {
            $fecha_registro = date("Y-m-d", strtotime($row->UsuarioFechaRegistro));
            $fecha_baja = date("Y-m-d", strtotime($row->UsuarioFechaBajaParticipante));
            $sheet->setCellValue('A' . $x, utf8_encode(strtoupper($row->UsuarioId)));
            $sheet->setCellValue('B' . $x, utf8_encode(strtoupper($row->nombre)));
            $sheet->setCellValue('C' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleCodigo)));
            $sheet->setCellValue('D' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('E' . $x, $fecha_registro);
            $sheet->setCellValue('F' . $x, $fecha_baja);
            $x++;
        }
        $limit = $x - 1;
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->getStyle("A1:F1" . $limit)->getFont()->setName('Arial')->setSize(8);
        
        $rango = "A1:F" . $limit;
        $sheet->getStyle($rango)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'] // negro
                ]
            ]
        ]);

    }
    public function reportes_usuarios_maestros_pintores_controller_por_distribuidora($spreadsheet,  $cmb_distribuidor, $txt_nombre_mp)    {
        $sheet = $spreadsheet->createSheet(3);
        $sheet->setTitle("Relatório do distribuidor");
        $sheet->setCellValue('A1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_distribuidora_estado'));
        $sheet->setCellValue('B1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_distribuidora_municipio'));
        $sheet->setCellValue('C1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_distribuidora_codigo'));
        $sheet->setCellValue('D1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_distribuidora_razon_social'));
        $sheet->setCellValue('E1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_distribuidora_total'));
        $sheet->setCellValue('F1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_distribuidora_estatus'));
        $sheet->setCellValue('G1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_distribuidora_ejecutivo'));

       
        $sheet->getStyle("A1:G1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
          $where = "";
        $where .= ($cmb_distribuidor != 0) ? "AND DistribuidoresDetalles.DistribuidorId =" . $cmb_distribuidor . " " : "";
        $where .= ($txt_nombre_mp != "" ) ? "AND (UsuariosDetalles.UsuarioDetalleNombre LIKE '%" . $txt_nombre_mp . "%')" : "";
        $distribiudores = $this->reportes_maestro_pintores_model->reportes_usuarios_maestros_pintores_model_por_distribuidores($where);
        $x = 2;
        foreach ($distribiudores as $row) {
          $totalMP = $this->reportes_maestro_pintores_model->reportes_maestros_pintores_model_total_maestros_pintor($row->DistribuidorId);
            $sheet->setCellValue('A' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleUnidadFederativa)));
            $sheet->setCellValue('B' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleCiudad)));
            $sheet->setCellValue('C' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleCiudad)));
            $sheet->setCellValue('D' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleBarrio)));
            $sheet->setCellValue('E' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleRazonSocial)));
            $sheet->setCellValue('F' . $x, utf8_encode(strtoupper($totalMP->totmaestros)));
            $sheet->setCellValue('G' . $x, utf8_encode(strtoupper($row->ejecutivo)));
            $x++;
        }
        $limit = $x - 1;
        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->getStyle("A1:G1" . $limit)->getFont()->setName('Arial')->setSize(8);
        
        $rango = "A1:G" . $limit;
        $sheet->getStyle($rango)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'] // negro
                ]
            ]
        ]);
    }
    public function reportes_usuarios_maestros_pintores_controller_por_estado($spreadsheet,  $cmb_distribuidor, $txt_nombre_mp)    {
        $sheet = $spreadsheet->createSheet(4);
        $sheet->setTitle("Relatório da cidade");
        $sheet->setCellValue('A1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_ciudad'));
        $sheet->setCellValue('B1', $this->lang->line('reportes_maestro_pintores_controller_lang_tabla_por_mes_total'));
        $sheet->getStyle("A1:B1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
         $where = "";
        $where .= ($cmb_distribuidor != 0) ? "AND DistribuidoresDetalles.DistribuidorId =" . $cmb_distribuidor . " " : "";
        $where .= ($txt_nombre_mp != "" ) ? "AND (UsuariosDetalles.UsuarioDetalleNombre LIKE '%" . $txt_nombre_mp . "%')" : "";
        $estados = $this->reportes_maestro_pintores_model->reportes_usuarios_maestros_pintores_model_por_ciudad($where);
        $x = 2;
        foreach ($estados as $row) {
            $sheet->setCellValue('A' . $x, utf8_encode(strtoupper($row->UsuarioDetalleCiudad)));
            $sheet->setCellValue('B' . $x, utf8_encode(strtoupper($row->total)));
            $x++;
        }
        $limit = $x - 1;
        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->getStyle("A1:B1" . $limit)->getFont()->setName('Arial')->setSize(8);
        // foreach (['A', 'B'] as $col) {
        //     $sheet->getColumnDimension($col)->setAutoSize(false);
        //     $sheet->getColumnDimension($col)->setWidth(10);
        // }
        $rango = "A1:B" . $limit;
        $sheet->getStyle($rango)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'] // negro
                ]
            ]
        ]);
    }
}

