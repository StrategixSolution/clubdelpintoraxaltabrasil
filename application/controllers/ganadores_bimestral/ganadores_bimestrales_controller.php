<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class Ganadores_bimestrales_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct(); 
        $this->load->model('ganadores_bimestrales/ganadores_bimestrales_model');
    }    
    public function index(){//Pagina de Inicio
        $data['sub_menu'] = ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==1 OR $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==2)?$this->load->view('template/sistema/sub_menu/sub_menu_ventas_cortes', '', TRUE):""; 
        $data['perfil'] = $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));
        $this->base_controller_create_view_sistema('ganadores_bimestrales/ganadores_bimestrales_form_view',$data);
    }

    public function ganadores_bimestrales_controller_cmbdistribuidora() { 
        $where = "";
        switch ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))) {
            case 1:            case 2:            case 3:  case 10:
            $distribuidores = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_combo_distribuidor_administradores($where);                break;
        }
        $combo_distribuidores = "<option  value='0'>" . $this->lang->line('ganadores_bimestrales_controller_lang_select_combo_distribuidor') . "</option>";
        foreach ($distribuidores as $distribuidor) {
            $combo_distribuidores .= '<option value="' . $distribuidor->DistribuidorId . '">' . $distribuidor->DistribuidorDetalleCodigo . ' ' . utf8_encode(strtoupper($distribuidor->DistribuidorDetalleRazonSocial)) . '</option>';
        }
        echo json_encode($combo_distribuidores);
    }
    public function ganadores_bimestrales_controller_cmbanios() {
        $cmbAnio ="<option  value='0'>".$this->lang->line('ganadores_bimestrales_controller_lang_placeholder_anio')."</option>";
        $anios  = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_cmbanios();
        foreach ($anios as $anio) {            
            $cmbAnio .="<option value=$anio->anio>$anio->anio</option>";
        }
        echo json_encode($cmbAnio);
    }
    public function ganadores_bimestrales_controller_cmbmes() {
        $cmbAnio = $this->input->post('anio',true);
        $cmbMes ="<option  value='0'>".$this->lang->line('ganadores_bimestrales_controller_lang_placeholder_periodo')."</option>";
        $meses  = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_cmbmes($cmbAnio);
        foreach ($meses as $mes) {            
            $bimestre = $mes->mes;
            $mesanterior = $bimestre-1;
            $cmbMes .="<option value=$mes->mes>".strtoupper(funciones_strategix_mes_numero_texto($mesanterior)).' - '.strtoupper(funciones_strategix_mes_numero_texto($bimestre))."</option>";
        }
        echo json_encode($cmbMes);
    }
    public function ganadores_bimestrales_controller_tabla() {
        $cmbAnio              = $this->input->post('anio',true);
        $cmbMes               = $this->input->post('mes',true);                
        $cmbdistribuidora     = $this->input->post('cmbdistribuidora',true);       
        $lista=$where=$txt_distribuidor="";      
        $where .= ($cmbdistribuidora != 0) ? " AND ReposicionesProductosGanadores.DistribuidorId = $cmbdistribuidora" : "";
        $where .= ($cmbAnio!=0)?" AND ReposicionProductoGanadorAnio = $cmbAnio":"";
        $where .= ($cmbMes!=0)?" AND ReposicionProductoGanadorMes = $cmbMes":"";
        $ganadores      = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_crea_tabla($where);        
        $cuenta = count( $ganadores);
        $i = 1;
        foreach ($ganadores as $ganador) {            
            $ejecutivo = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_ejecutivo($ganador->DistribuidorId);
             $descripcion = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_descripcion_producto($ganador->ReposicionProductoGanadorPremioLugar,$cmbAnio,$cmbMes);
            $lista.= '<tr>
                    <td>'.utf8_encode(strtoupper($ganador->UsuarioId)).'</td> 
                    <td>'.utf8_encode(strtoupper($ganador->nombrepax)).'</td>
                    <td>'.utf8_encode(strtoupper($ganador->DistribuidorId)).'</td>
                    <td>'.utf8_encode(strtoupper($ganador->DistribuidorDetalleCodigo)).'</td>
                    <td>'.utf8_encode(strtoupper($ganador->DistribuidorDetalleNombreComercial)).'</td>                                          
                    <td>'.utf8_encode(strtoupper($ejecutivo)).'</td>
                    <td>'.utf8_encode(strtoupper($ganador->DistribuidorDetalleCiudad.' / '.$ganador->DistribuidorDetalleEstado)).'</td>
                    <td>'.utf8_encode(strtoupper($ganador->ReposicionProductoGanadorPremioLugar)).'</td>
                    <td>'.utf8_encode(strtoupper($descripcion)).'</td>
                    </tr>' ;
           $i++;
        }    
        $data['cuenta']=$cuenta;
        $data['tabla']           = $lista;
        $tablaganadores = $this->load->view('ganadores_bimestrales/ganadores_bimestrales_tabla_view', $data, true);
        echo json_encode($tablaganadores);
    }      
    public function ganadores_bimestrales_controller_mail_all()    {
        $anio = $this->input->post('anio', true);
        $mes = $this->input->post('mes', true);
        $mesAnterior = $mes - 1;
        $cmbdistribuidora = $this->input->post('cmbdistribuidora', true);
        $where = "";
        $where .= ($cmbdistribuidora != 0) ? " AND ReposicionesProductosGanadores.DistribuidorId = $cmbdistribuidora" : "";
        $where .= ($anio!=0)?" AND ReposicionProductoGanadorAnio = $anio":"";
        $where .= ($mes!=0)?" AND ReposicionProductoGanadorMes = $mes":"";
        $mailDistribuidora = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_distribuidora($where);
        foreach ($mailDistribuidora as $row) {
            $this->ganadores_bimestrales_controller_envio_mails_all($row->DistribuidorId, $anio, $mes);
        }
        echo json_encode(1);
    }
    public function ganadores_bimestrales_controller_envio_mails_all($idDist, $anio, $mes)    {
        $mesanterior = $mes - 1;
        $mestxt = strtoupper(funciones_strategix_mes_numero_texto($mes));
        $mesanteriortxt = strtoupper(funciones_strategix_mes_numero_texto($mesanterior));
        $bimestre = $mesanteriortxt . '-' . $mestxt;
        switch ($mes) {
            case 2: $fecha_cierre = "17 de abril"; break;
            case 4: $fecha_cierre = "17 de junho"; break;
            case 6: $fecha_cierre = "17 de agosto"; break;
            case 8: $fecha_cierre = "17 de outubro"; break;
            case 10: $fecha_cierre = "17 de dezembro"; break;
            case 12: $fecha_cierre = "17 de fevereiro"; break;
        }
        $carpeta = glob('uploads/excel/ganadores/*');
        foreach ($carpeta as $archivo) {
            if (is_file($archivo))
                unlink($archivo);
        }
        $file = "";
        $file = $this->ganadores_bimestrales_controller_excel($anio, $mes, $mesanterior, $idDist);
        $correo = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_datoscorreo($idDist);
        if (isset($correo)) {
            $this->envioCorreoDistribuidora($correo, $file, $bimestre, $fecha_cierre);
        }
        return 1;
    }
  
    public function envioCorreoDistribuidora($correo, $file, $bimestre, $fecha_cierre)    {
        $mail_string = '';
        foreach ($correo as $key => $value) {
            $mail_string .= $value->UsuarioDetalleEmail . ",";
        }
        $mail_string = preg_replace("/\s*\,\s*$/", "", $mail_string);
        $dat = array('bimestre' => $bimestre,'fecha_cierre' => $fecha_cierre);
        $mail = $this->load->view('mails/ganadores_bimestrales/mails_ganadores_bimestrales_view', $dat, TRUE);
       // $to = array('to' => 'luis.rangel@strategix.com.mx', 'cc' => '', 'bcc' => '');
        $to     = array('to' => "$mail_string", 'cc' => '', 'bcc' => 'servicioalcliente@axaltaclubdelpintor.com,jocelyn.milla-davila@axalta.com,otto.fernandez-castillo@axalta.com,rodrigo.guerra@axalta.com,josue.camey-domingo@pinturasvolcan.com, emma.valdivieso@strategix.com.mx, diana.martinez@strategix.com.mx, patricia.carteno@strategix.com.mx');
        $this->base_controller_envio_correos($to, 'Lembramos os vencedores do período de dois meses '.$bimestre, $mail, $file);
        return 1;
    }
    public function ganadores_bimestrales_controller_excel($anio, $mes, $mesanterior, $DistribuidoraId)    {
        $archivo = "";
        $dist = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_nombre_dist($DistribuidoraId);
        $mesanterior = $mes - 1;
        $bimestre = strtoupper(funciones_strategix_mes_numero_texto($mesanterior)) . '-' . strtoupper(funciones_strategix_mes_numero_texto($mes));
        $nombreArchivo = $this->lang->line('ganadores_bimestrales_controller_lang_archivo_excel_nombre') . $bimestre . '_' . $this->eliminar_acentos(utf8_encode($dist->DistribuidorDetalleRazonSocial)) . "-" . date("d") . date("m") . date("Y") . ".xlsx";
        $archivo = "uploads/excel/ganadores/$nombreArchivo";
        $spreadsheet = new Spreadsheet(1);
        $objPHPExcel = $spreadsheet->getActiveSheet(0);
        $objPHPExcel->setTitle(substr($this->eliminar_acentos($dist->DistribuidorDetalleRazonSocial), 0, 30));
        $objPHPExcel->setCellValue('A1', $this->lang->line('ganadores_bimestrales_controller_lang_tabla_id_maestro_pintor'));
        $objPHPExcel->setCellValue('B1', $this->lang->line('ganadores_bimestrales_controller_lang_tabla_maestro_pintor'));
        $objPHPExcel->setCellValue('C1', $this->lang->line('ganadores_bimestrales_controller_lang_tabla_id'));
        $objPHPExcel->setCellValue('D1', $this->lang->line('ganadores_bimestrales_controller_lang_tabla_codigo'));
        $objPHPExcel->setCellValue('E1', $this->lang->line('ganadores_bimestrales_controller_lang_tabla_nombre_comercial'));
        $objPHPExcel->setCellValue('F1', $this->lang->line('ganadores_bimestrales_controller_lang_tabla_ejecutivo'));
        $objPHPExcel->setCellValue('G1', $this->lang->line('ganadores_bimestrales_controller_lang_tabla_ciudad'));
        $objPHPExcel->setCellValue('H1', $this->lang->line('ganadores_bimestrales_controller_lang_tabla_premio'));
        $objPHPExcel->setCellValue('I1', $this->lang->line('ganadores_bimestrales_controller_lang_tabla_descripcion_premio'));
        $objPHPExcel->getStyle("A1:I1")->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $objPHPExcel->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('C82127');
        $where="";  
            $where .= ($DistribuidoraId != 0) ? " AND ReposicionesProductosGanadores.DistribuidorId = $DistribuidoraId" : "";
            $where .= ($anio!=0)?" AND ReposicionProductoGanadorAnio = $anio":"";
            $where .= ($mes!=0)?" AND ReposicionProductoGanadorMes = $mes":"";        
        $ganadores = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_crea_tabla($where);
        $x = 2;
        foreach ($ganadores as $row) {
            $ejecutivo = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_ejecutivo($row->DistribuidorId);
            $descripcion = $this->ganadores_bimestrales_model->ganadores_bimestrales_model_descripcion_producto($row->ReposicionProductoGanadorPremioLugar,$anio,$mes);
            $objPHPExcel->setCellValue('A' . $x, utf8_encode(strtoupper($row->UsuarioId)));
            $objPHPExcel->setCellValue('B' . $x, utf8_encode(strtoupper($row->nombrepax)));
            $objPHPExcel->setCellValue('C' . $x, utf8_encode(strtoupper($row->DistribuidorId)));
            $objPHPExcel->setCellValue('D' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleCodigo)));
            $objPHPExcel->setCellValue('E' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleNombreComercial)));
            $objPHPExcel->setCellValue('F' . $x, utf8_encode(strtoupper($ejecutivo)));
            $objPHPExcel->setCellValue('G' . $x, utf8_encode(strtoupper($row->DistribuidorDetalleCiudad.' / '.$row->DistribuidorDetalleEstado)));
            $objPHPExcel->setCellValue('H' . $x, utf8_encode(strtoupper($row->ReposicionProductoGanadorPremioLugar)));
            $objPHPExcel->setCellValue('I' . $x, utf8_encode(strtoupper($descripcion)));
            $x++;
        }
        $limit = $x - 1;
        foreach (range('A', 'I') as $columnID) {
            $objPHPExcel->getColumnDimension($columnID)->setAutoSize(true);
        }
        $objPHPExcel->getStyle("A1:I1" . $limit)->getFont()->setName('Arial')->setSize(8);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save($archivo);
        $url = str_replace("\\", '/', $archivo);
        return $archivo;
    }
    function eliminar_acentos($cadena)    {
        $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
        );
        $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena
        );
        $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena
        );
        $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena
        );
        $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena
        );
        $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
        );
        $cadena = str_replace(
            array('/'),
            array('-'),
            $cadena
        );
        return $cadena;
    }
    
    
}

