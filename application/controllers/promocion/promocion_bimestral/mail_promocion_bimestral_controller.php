<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Mail_promocion_bimestral_controller extends Base_Controller
{
    public function __construct()    {
        parent::__construct();
        valida_menus(get_class(), $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('promocion/promocion_bimestral/mail_promocion_bimestral_model');
    }
    public function index()    {//Pagina de Inicio    
        $this->base_controller_create_view_sistema('promocion/promocion_bimestral/promocion_bimestral_form_view');
    }
    public function mail_promocion_bimestral_controller_cmbanios()    {
        $cmbAnio = "<option  value='0'>" . $this->lang->line('mail_promocion_bimestral_controller_lang_placeholder_anio') . "</option>";
        $anios = $this->mail_promocion_bimestral_model->mail_promocion_bimestral_model_cmbanios();
        foreach ($anios as $anio) {
            $cmbAnio .= "<option value=$anio->anio>$anio->anio</option>";
        }
        echo json_encode($cmbAnio);
    }
    public function mail_promocion_bimestral_controller_cmbmes()    {
        $cmbAnio = $this->input->post('anio', true);
        $cmbMes = "<option  value='0'>" . 'SELECCIONA UN MES' . "</option>";
        $meses = $this->mail_promocion_bimestral_model->mail_promocion_bimestral_model_cmbmes($cmbAnio);
        foreach ($meses as $mes) {
           //$bimestre = $mes->mes;
           // $par = $bimestre % 2;
           // $mesanterior = $bimestre - 1;
          //  if (($par) == 0) {
                $cmbMes .= "<option value=$mes->mes>" . strtoupper(funciones_strategix_mes_numero_texto($mes->mes)) . "</option>";
          //  }
        }
        echo json_encode($cmbMes);
    }

    public function mail_promocion_bimestral_controller_perfil()
    {
        $check_perfiles = array();
        $perfiles = $this->mail_promocion_bimestral_model->mail_promocion_bimestral_model_check_perfil();
        foreach ($perfiles as $key => $value) {
            $check_perfiles[$value->PerfilId] = utf8_encode($value->PerfilDescripcion);
        }
        echo json_encode($check_perfiles);
    }
       public function mail_promocion_bimestral_controller_tabla()    {
        $cmbAnio = $this->input->post('cmb_anio', true);
        $cmbMes = $this->input->post('cmb_mes', true);
        $str = "";
        foreach ($_POST['perfil'] as $perfil) {
            $str .= "$perfil,";
        }
        $perfiles = substr($str, 0, -1);
              //  print_r($perfiles);die;
        $filePromocion = $_FILES["promocion_bimestral_form_view_file"]["name"];
        $extension = explode(".", $filePromocion);
        $ext = $extension[1];
        $valida = $this->valida_envio_mail($cmbAnio, $cmbMes,$perfiles);
        if ($valida >= 1) {
            $data['resultados'] = 1;
            $data['tabla'] = '';
            echo json_encode($data);
        } else {
            $folder_promocion = "promocion_bimestral/";
            $folder = $this->base_controller_valida_crea_carpetas($folder_promocion);
            $nombre_archivo = "PromocionBimestral_" . $cmbAnio . '_' . $cmbMes;
            $resultado_carga = $this->base_controller_cargas_upload_archivo('promocion_bimestral_form_view_file', $folder, $ext, $nombre_archivo);
           //print_r("lista");die;
            if ($resultado_carga['resultado'] == 1) {
                $insertaDatos = $this->mail_promocion_bimestral_model->mail_promocion_bimestral_model_inserta_datos($cmbAnio, $cmbMes, $resultado_carga['file_name'] , $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')),$perfiles);
                $mail = $this->mail_promocion_bimestral_model->mail_promocion_bimestral_model_datos_correo($perfiles);
                $file = funciones_strategix_version_url_random_base_url("uploads/promocion_bimestral/" . $resultado_carga['file_name']);
                if (isset($mail)) { $this->envioCorreoDistribuidora($mail, $file); }else{
                    $data['resultados'] = 3;
                    $data['tabla'] = '';
                    echo json_encode($data);
                }
                $lista = "";
                $datosTabla = $this->mail_promocion_bimestral_model->mail_promocion_bimestral_model_crea_tabla();
                $i = 1;
                foreach ($datosTabla as $row) {
                    if ($row->mailsPromocionesBimestralesFechaRegistro == NULL) {
                        $fecha_envio = "-------------";
                    } else {
                        $date = date_create($row->mailsPromocionesBimestralesFechaRegistro);
                        $fecha_envio = date_format($date, 'd/m/Y');
                    }
                    $mesAnterior = $row->mailsPromocionesBimestralesMes - 1;
                    $cmbMesT = strtoupper(funciones_strategix_mes_numero_texto($row->mailsPromocionesBimestralesMes));
                  //  $mesAnteriorT = strtoupper(funciones_strategix_mes_numero_texto($mesAnterior));
                   // $bimestrte = $mesAnteriorT . ' - ' . $cmbMesT;

                        $perfiles = $this->mail_promocion_bimestral_model->mail_promocion_bimestral_model_perfil_nombre($row->mailsPromocionesBimestralesPerfiles);
                    $perfil = "";
                    foreach ($perfiles as $perfilesrow) {
                        $perfil .= $perfilesrow->PerfilDescripcion . ", ";
                    }  

                    $lista .= '<tr>
                    <td>' . $perfil . '</td>
                    <td>' . $row->mailsPromocionesBimestralesAnio . '</td> 
                    <td>' . $cmbMesT . '</td> 
                    <td>uploads/promocion_bimestral/' . $row->mailsPromocionesBimestralesArchivo . '</td> 
                    <td>' . $fecha_envio . '</td>
                            </tr>';
                    $i++;
                }
                $data['tabla'] = $lista;
                $tablareporte = $this->load->view('promocion/promocion_bimestral/promocion_bimestral_tabla_view', $data, true);
                
                echo json_encode($tablareporte);
            } else {
                $data['msg'] = 'ERROR AL CARGAR LA IMAGEN';
                $data['resultados'] = 2;
                $data['tabla'] = '';
                echo json_encode($data);
            }
        }
    }
    public function valida_envio_mail($cmbAnio, $cmbMes,$perfiles)    {
        $valida = $this->mail_promocion_bimestral_model->mail_promocion_bimestral_model_count( $cmbAnio, $cmbMes,$perfiles);
        if (isset($valida)) {return 1; } else { return 0;}
    }
    public function envioCorreoDistribuidora($mail, $file)    {
        $mail_string = '';
        foreach ($mail as $key => $value) {
            $mail_string .= $value->UsuarioDetalleEmail . ",";
        }
        $mail_string = preg_replace("/\s*\,\s*$/", "", $mail_string);
        $dat = array('file' => $file);
        $mail = $this->load->view('mails/mails_promocion_bimestral/mails_promocion_bimestral_view', $dat, TRUE);
        $to     = array('to' => "servicioalcliente@axaltaclubdelpintor.com", 'cc' => '', 'bcc' => $mail_string.',ivonne.perez@strategix.com.mx,representante@axaltaclubdelpintor.com, jocelyn.milla-davila@axalta.com, rodrigo.guerra@axalta.com, josue.camey-domingo@pinturasvolcan.com, emma.valdivieso@strategix.com.mx, diana.martinez@strategix.com.mx, servicioalcliente@axaltaclubdelpintor.com, patricia.carteno@strategix.com.mx');
        $this->base_controller_envio_correos($to, '¡Saiba mais sobre a promoção válida por dois meses! ', $mail, $file);
        return 1;
    }
}