<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages']   = array();
$autoload['libraries']  = array('email','session','form_validation','database','upload','pdf','cart','phpspreadsheet_sx_library','repatcha3_library','infobip_library');
$autoload['drivers']    = array();
$autoload['helper']     = array('url','form','security','path','captcha','download','cookie','funciones_strategix','valida_menus','carga_tabla','carga_validacion','control_modulos');
$autoload['config']     = array();
$autoload['language']   = array(
    'menu_lang',
    'login_controller_lang',
    'usuarios_recupera_clave_controller_lang',
    'usuarios_actualizar_datos_controller_lang',
    'usuarios_crea_clave_controller_lang',
    'usuarios_recupera_clave_controller_lang',
    'usuarios_recupera_clave_nueva_controller_lang',
    'recompensas_controller_lang',
    'productos_reposicion_carga_controller_lang',
    'productos_reposicion_relacion_premios_productos_contoller_lang',
    'ventas_registro_controller_lang',
    'ventas_auditoria_primera_controller_lang',
    'data_table_js_lang',
    'ventas_auditoria_envio_correos_controller_lang',
    'ventas_auditoria_segunda_controller_lang',
    'ventas_auditoria_rechazados_controller_lang',
    'ventas_promociones_cargas_controller_lang',
    'ventas_promociones_controller_lang',
    'ventas_auditoria_promociones_controller_lang',
    'ventas_cortes_auditoria_ventas_controller_lang',
    'ventas_cortes_ganadores_contoller_contoller_lang',
    'productos_reposicion_captura_controller_lang',
    'ventas_cortes_bimestral_controller_lang',
    'productos_reposicion_descarga_controller_lang',
    'ventas_personal_top_controller_lang',
	'ventas_reporte_ganadores_controller_lang',
    'contacto_controller_lang',
    'usuarios_maestro_pintor_registro_controller_lang',
    'reportes_tarjetas_controller_lang',
    'tarjetas_altas_controller_lang',
    'tarjetas_controller_lang',
    'ventas_registro_controller_lang',
    'multimedios_cargas_controller_lang',
    'ventas_cortes_apertura_cierre_controller_lang',
    'reportes_distribuidores_controller_lang',
    'reportes_maestro_pintores_controller_lang',
    'reportes_ventas_registradas_controller_lang',
    'distribuidores_alta_controller_lang',
    'distribuidores_controller_lang',
    'distribuidores_modificacion_controller_lang',
    'usuarios_participantes_altas_controller_lang',
    'usuarios_participantes_controller_lang',
    'usuarios_participantes_modificacion_controller_lang',
    'reportes_ventas_auditoria_controller_lang',
    'reportes_usuarios_participantes_controller_lang',
    'mail_promocion_bimestral_controller_lang',
    'ganadores_bimestrales_controller_lang'
    );
$autoload['model']      = array();
