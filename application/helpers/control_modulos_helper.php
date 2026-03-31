<?php
/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel Martinez  * 
 * @CreateDate 19 jun. 2023 12:23:40 * 
 */
defined('BASEPATH') or exit('No direct script access allowed');

function control_modulos()
{
    $url = $_SERVER["REQUEST_URI"];
    $CI = &get_instance();
    $data = array();
    $CI->load->model('productos/control_modulos_model');
    $control =  $CI->control_modulos_model->control_modulos_model_datos();
    foreach ($control as $row) {
        $data[$row->ControlModuloId] = array("ControlModuloId" => $row->ControlModuloId, "ControlModuloNombre" => $row->ControlModuloNombre, "ControlModuloEstatus" => $row->ControlModuloEstatus);
    }
    if ($data[1]['ControlModuloEstatus'] == 0) {
        $_SESSION['control_modulos_cdpg'][1]['ControlModuloEstatus'] = 0;
        if (strpos($url, 'ReposicionProductoCaptura') !== false) {
            $inicio_url = "Inicio" . urlVersion();
            redirect($inicio_url);
        }
    } else {
        $_SESSION['control_modulos_cdpg'][1]['ControlModuloEstatus'] = 1;
    }
}
