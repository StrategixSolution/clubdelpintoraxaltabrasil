<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_usuarios_participantes_controller extends Base_Controller
{
    public function __construct()    {
        parent::__construct();
        $this->load->model('reportes/reportes_usuarios_participantes/reportes_usuarios_participantes_model');
    }
    public function index()    {//Pagina de Inicio  
        $data['perfil'] = $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));
        $data['cuenta_tabla'] = 0;
        $this->base_controller_create_view_sistema('reportes/reportes_usuarios_participantes/reportes_usuarios_participantes_form_view', $data, true);
    }
    public function reportes_usuarios_participantes_controller_combo_distribuidoras()    {
        $where = "";
        $distribuidores = $this->reportes_usuarios_participantes_model->reportes_usuarios_participantes_model_combo_distribuidor($where);
        $cmbdistribuidora = "<option  value='0'>" . $this->lang->line('reportes_usuarios_participantes_controller_lang_select_distribuidoras') . "</option>";
        foreach ($distribuidores as $distribuidora) {
            $cmbdistribuidora .= "<option value=$distribuidora->DistribuidorId>" . utf8_encode(strtoupper($distribuidora->DistribuidorDetalleCodigo)) . "-" . utf8_encode(strtoupper($distribuidora->DistribuidorDetalleRazonSocial)) . "</option>";
        }
        echo json_encode($cmbdistribuidora);
    }
    public function reportes_usuarios_participantes_controller_tabla()    {
        $reporte_usuarios_participantes_view_cmb_distribuidoras = $this->input->post('reporte_usuarios_participantes_view_cmb_distribuidoras', TRUE);
        $cmb_estatus = $this->input->post('reporte_usuarios_participantes_view_cmb_estatus', TRUE);
        $lista = $nombre = $txt_distribuidor = $where = "";
        switch ($cmb_estatus) {
            case 1:
                $where .= " AND (UsuarioFechaBajaParticipante IS NULL) AND (UsuarioFechaBajaDistribuidora IS NULL) ";
                break;
            case 2:
                $where .= " AND (UsuarioFechaBajaParticipante IS NOT NULL OR UsuarioFechaBajaDistribuidora IS NOT NULL)";
                break;
        }
        $where .= ($reporte_usuarios_participantes_view_cmb_distribuidoras != 0) ? " AND UsuariosDistribuidores.DistribuidorId = $reporte_usuarios_participantes_view_cmb_distribuidoras" : "";
        $participantes = $this->reportes_usuarios_participantes_model->reportes_usuarios_participantes_model_tabla($where);
        foreach ($participantes as $participante) {
            $nombre = utf8_encode(strtoupper($participante->UsuarioDetalleNombre));
            $estatus = ($participante->UsuarioFechaBajaParticipante == "" and $participante->UsuarioFechaBajaDistribuidora == "") ? $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_estatus_activo') : $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_estatus_baja');
            $estatusdis = ($participante->UsuarioFechaBajaDistribuidora == "") ? $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_estatus_activo') : ($participante->UsuarioFechaBajaDistribuidora == "");
            $fecha_registro = date("Y-m-d", strtotime($participante->UsuarioFechaRegistro));
           $nitPax = ($participante->UsuarioDetalleRFC != "") ? utf8_encode(strtoupper($participante->UsuarioDetalleRFC)) : "&nbsp";
          //  $telefono = ($participante->UsuarioDetalleTelefono != "") ? utf8_encode(strtoupper($participante->UsuarioDetalleTelefono)) : "&nbsp";
          //  $extension = ($participante->UsuarioDetalleExtension != "") ? utf8_encode(strtoupper($participante->UsuarioDetalleExtension)) : "&nbsp";
            $nitDistribuidor = ($participante->DistribuidorDetalleRegistroFederal != "") ? utf8_encode(strtoupper($participante->DistribuidorDetalleRegistroFederal)) : "&nbsp";
            $estDistribuidor = ($participante->DistribuidorDetalleInscripcionEstatal != "") ? utf8_encode(strtoupper($participante->DistribuidorDetalleInscripcionEstatal)) : "&nbsp";
            $lista .= '<tr id="id-usuario-td-' . $participante->UsuarioId . '">                         
                        <td>' . utf8_encode(strtoupper($participante->DistribuidorId)) . '</td>
                        <td>' . utf8_encode(strtoupper($participante->DistribuidorDetalleCodigo)) . '</td>                        
                        <td>' . utf8_encode(strtoupper($participante->DistribuidorDetalleRazonSocial)) . '</td>                        
                        <td>' . utf8_encode(strtoupper($participante->DistribuidorDetalleNombreComercial)) . '</td>                        
                        <td>' . $nitDistribuidor . '</td>
                        <td>' . $estDistribuidor . '</td>
                        <td>' . utf8_encode(strtoupper($participante->UsuarioId)) . '</td>
                        <td>' . utf8_encode(strtoupper($participante->UsuarioDetalleNombre)) . '</td>
                        <td>' . $nitPax . '</td>                        
                        <td>' . utf8_encode($participante->UsuarioDetalleEmail) . '</td>
                        <td>' . utf8_encode(strtoupper($participante->UsuarioDetalleCelular)) . '</td>
                        <td>' . utf8_encode(strtoupper($participante->PerfilDescripcion)) . '</td>
                        <td>' . $fecha_registro . '</td>
                        <td>' . $estatus . '</td>
                        <td>' . $estatusdis . '</td>
                        </tr>';
        }
        $data['tabla'] = $lista;
        $tabla_participante['tabla'] = $this->load->view('reportes/reportes_usuarios_participantes/reportes_usuarios_participantes_tabla_view', $data, true);
        echo json_encode($tabla_participante);
    }
}
