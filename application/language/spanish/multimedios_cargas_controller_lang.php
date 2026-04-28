<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['multimedios_cargas_controller_lang_titulo']                                       = 'CARGA DE MULTIMEDIOS';
$lang['multimedios_cargas_controller_lang_etiqueta_modulos']                             = 'MÓDULO:';
$lang['multimedios_cargas_controller_lang_etiqueta_tipos']                               = 'TIPO:';
$lang['multimedios_cargas_controller_lang_etiqueta_tipo_video']                          = 'TIPO VIDEO:';
$lang['multimedios_cargas_controller_lang_etiqueta_archvivo_multimedia_principal']       = 'ARCHIVO:';
$lang['multimedios_cargas_controller_lang_etiqueta_archvivo_multimedia_secundario']      = 'THUMBNAIL:';
$lang['multimedios_cargas_controller_lang_etiqueta_texto']                               = 'TEXTO:';
$lang['multimedios_cargas_controller_lang_etiqueta_titulo']                              = 'TITULO:';
$lang['multimedios_cargas_controller_lang_etiqueta_html']                                = 'HTML:';
$lang['multimedios_cargas_controller_lang_placeholder_modulos']                          = 'SELECCIONE UN MÓDULO';
$lang['multimedios_cargas_controller_lang_placeholder_tipos']                            = 'SELECCIONE UN TIPO';
$lang['multimedios_cargas_controller_lang_placeholder_pais']                             = 'SELECCIONE LOS PAÍSES';
$lang['multimedios_cargas_controller_lang_placeholder_perfil']                           = 'SELECCIONE LOS PERFILES';
$lang['multimedios_cargas_controller_lang_placeholder_tipos_videos']                     = 'TIPO TUTORIAL';
$lang['multimedios_cargas_controller_lang_placeholder_archvivo_multimedia_principal']    = 'ARCHIVO';
$lang['multimedios_cargas_controller_lang_placeholder_archvivo_multimedia_secundario']   = 'THUMBNAIL';
$lang['multimedios_cargas_controller_lang_placeholder_texto']                            = 'TEXTO';
$lang['multimedios_cargas_controller_lang_placeholder_titulo']                           = 'TITULO';
$lang['multimedios_cargas_controller_lang_placeholder_html']                             = 'HTML';
$lang['multimedios_cargas_controller_lang_btn_guardar']                                  = 'GUARDAR';
$lang['multimedios_cargas_controller_lang_tabla_titulo_id']                              = 'ID';
$lang['multimedios_cargas_controller_lang_tabla_titulo_ruta']                            = 'RUTA DE ARCHIVO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_extencion']                       = 'EXTENSIÓN';
$lang['multimedios_cargas_controller_lang_tabla_titulo_thumbnail']                       = 'IMAGEN INICIAL';
$lang['multimedios_cargas_controller_lang_tabla_titulo_texto']                           = 'TEXTO, TITULO O HTML';
$lang['multimedios_cargas_controller_lang_tabla_titulo_fecha']                           = 'FECHA DE REGISTRO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_tipo']                            = 'TIPO DE MULTIMEDIO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_modulo']                          = 'MÓDULO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_tipo_video']                      = 'TIPO DE VIDEO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_baja']                            = 'BAJA';
$lang['multimedios_cargas_controller_lang_js_archivo_validar']                           = 'SELECCIONE UN ARCHIVO';
$lang['multimedios_cargas_controller_lang_js_archivo_valida_video']                      = 'TIPO DE ARCHIVO INVÁLIDO, SOLO USE MP4.';
$lang['multimedios_cargas_controller_lang_js_archivo_valida_pdf']                        = 'TIPO DE ARCHIVO INVÁLIDO, SOLO USE PDF.';
$lang['multimedios_cargas_controller_lang_js_archivo_valida_imagen']                     = 'TIPO DE ARCHIVO INVÁLIDO, SOLO USE JPG Y PNG.';
$lang['multimedios_cargas_controller_lang_placeholder_division']                         = 'TODOS';
$lang['multimedios_cargas_controller_lang_tabla_titulo_perfil']                          = 'PERFIL';
$lang['multimedios_cargas_controller_lang_tabla_titulo_fecha_i']                          = 'FECHA INICIO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_fecha_f']                          = 'FECHA FIN';
$lang['multimedios_cargas_controller_lang_js_baja_confirm']                          = '¿DESEA DAR DE BAJA?';
$lang['multimedios_cargas_controller_lang_js_aceptar']                          = 'ACEPTAR';
$lang['multimedios_cargas_controller_lang_js_cancelar']                          = 'CANCELAR';
$lang['multimedios_cargas_controller_lang_js_baja_exitosa']                          = 'BAJA EXITOSA';
$lang['multimedios_cargas_controller_lang_tabla_js_all']                            = 'TODOS';
$lang['multimedios_cargas_controller_lang_tabla_js_lengthMenu']                          = 'MOSTRANDO _MENU_ REGISTROS POR PÁGINA';
$lang['multimedios_cargas_controller_lang_tabla_js_zeroRecords']                         = 'SIN REGISTROS ENCONTRADOS';
$lang['multimedios_cargas_controller_lang_tabla_js_info']                                = 'PÁGINA _PAGE_ DE _PAGES_';
$lang['multimedios_cargas_controller_lang_tabla_js_infoEmpty']                           = 'REGISTROS NO DISPONIBLES';
$lang['multimedios_cargas_controller_lang_tabla_js_infoFiltered']                        = '(FILTRADO DE _MAX_ REGISTROS)';
$lang['multimedios_cargas_controller_lang_tabla_js_search']                              = 'BUSCAR:';
$lang['multimedios_cargas_controller_lang_tabla_js_first']                               = 'PRIMERO';
$lang['multimedios_cargas_controller_lang_tabla_js_last']                                = 'ÚLTIMO';
$lang['multimedios_cargas_controller_lang_tabla_js_next']                                = 'SIGUIENTE';
$lang['multimedios_cargas_controller_lang_tabla_js_previous']                            = 'ANTERIOR';
$lang['multimedios_cargas_controller_lang_etiqueta_sel_perfil']                               = 'SELECCIONE UN PERFIL';
$lang['multimedios_cargas_controller_lang_etiqueta_sel_fechas']                               = 'SELECCIONE LAS FECHAS';
$lang['multimedios_cargas_controller_lang_etiqueta_valida_fechas']                               = 'LA FECHA INICIAL DEBE SER MAYOR A LA FINAL';
$lang['multimedios_cargas_controller_lang_etiqueta_archivo_cargado']                               = 'EL ARCHIVO SE HA CARGADO CORRECTAMENTE';
$lang['multimedios_cargas_controller_lang_etiqueta_popup_creado']                               = 'EL POPUP SE HA CREADO CORRECTAMENTE';
$lang['multimedios_cargas_controller_lang_etiqueta_si']                               = 'SÍ';
$lang['multimedios_cargas_controller_lang_etiqueta_no']                               = 'NO';
$lang['multimedios_cargas_controller_lang_etiqueta_todos']                               = 'TODOS';
$lang['multimedios_cargas_controller_lang_etiqueta_descarga']                               = 'DESCARGAR';
$lang['multimedios_cargas_controller_lang_tabla_titulo_descarga']                               = 'DESCARGAR';
$lang['multimedios_cargas_controller_lang_tabla_titulo_ver']                               = 'VER';
$lang['multimedios_cargas_controller_lang_tabla_titulo_estatus']                               = 'ESTATUS';
