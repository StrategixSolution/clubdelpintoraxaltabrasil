<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['multimedios_cargas_controller_lang_titulo']                                       = 'CARREGAMENTO MULTIMÍDIA';
$lang['multimedios_cargas_controller_lang_etiqueta_modulos']                             = 'MÓDULO:';
$lang['multimedios_cargas_controller_lang_etiqueta_tipos']                               = 'TIPO:';
$lang['multimedios_cargas_controller_lang_etiqueta_tipo_video']                          = 'TIPO DE VÍDEO:';
$lang['multimedios_cargas_controller_lang_etiqueta_archvivo_multimedia_principal']       = 'ARQUIVO:';
$lang['multimedios_cargas_controller_lang_etiqueta_archvivo_multimedia_secundario']      = 'THUMBNAIL:';
$lang['multimedios_cargas_controller_lang_etiqueta_texto']                               = 'TEXTO:';
$lang['multimedios_cargas_controller_lang_etiqueta_titulo']                              = 'TÍTULO:';
$lang['multimedios_cargas_controller_lang_etiqueta_html']                                = 'HTML:';
$lang['multimedios_cargas_controller_lang_placeholder_modulos']                          = 'SELECIONE UM MÓDULO';
$lang['multimedios_cargas_controller_lang_placeholder_tipos']                            = 'SELECIONE UM TIPO';
$lang['multimedios_cargas_controller_lang_placeholder_pais']                             = 'SELECIONE OS PAÍSES';
$lang['multimedios_cargas_controller_lang_placeholder_perfil']                           = 'SELECIONE OS PERFIS';
$lang['multimedios_cargas_controller_lang_placeholder_tipos_videos']                     = 'TIPO TUTORIAL';
$lang['multimedios_cargas_controller_lang_placeholder_archvivo_multimedia_principal']    = 'ARQUIVO';
$lang['multimedios_cargas_controller_lang_placeholder_archvivo_multimedia_secundario']   = 'THUMBNAIL';
$lang['multimedios_cargas_controller_lang_placeholder_texto']                            = 'TEXTO';
$lang['multimedios_cargas_controller_lang_placeholder_titulo']                           = 'TÍTULO';
$lang['multimedios_cargas_controller_lang_placeholder_html']                             = 'HTML';
$lang['multimedios_cargas_controller_lang_btn_guardar']                                  = 'SALVAR';
$lang['multimedios_cargas_controller_lang_tabla_titulo_id']                              = 'ID';
$lang['multimedios_cargas_controller_lang_tabla_titulo_ruta']                            = 'CAMINHO DO ARQUIVO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_extencion']                       = 'EXTENSÃO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_thumbnail']                       = 'IMAGEM INICIAL';
$lang['multimedios_cargas_controller_lang_tabla_titulo_texto']                           = 'TEXTO, TÍTULO OU HTML';
$lang['multimedios_cargas_controller_lang_tabla_titulo_fecha']                           = 'DATA DE REGISTRO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_tipo']                            = 'TIPO DE MULTIMÍDIA';
$lang['multimedios_cargas_controller_lang_tabla_titulo_modulo']                          = 'MÓDULO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_tipo_video']                      = 'TIPO DE VÍDEO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_baja']                            = 'BAIXA';
$lang['multimedios_cargas_controller_lang_js_archivo_validar']                           = 'SELECIONE UM ARQUIVO';
$lang['multimedios_cargas_controller_lang_js_archivo_valida_video']                      = 'TIPO DE ARQUIVO INVÁLIDO, USE APENAS MP4.';
$lang['multimedios_cargas_controller_lang_js_archivo_valida_pdf']                        = 'TIPO DE ARQUIVO INVÁLIDO, USE APENAS PDF.';
$lang['multimedios_cargas_controller_lang_js_archivo_valida_imagen']                     = 'TIPO DE ARQUIVO INVÁLIDO, USE APENAS JPG E PNG.';
$lang['multimedios_cargas_controller_lang_placeholder_division']                         = 'TODOS';
$lang['multimedios_cargas_controller_lang_tabla_titulo_perfil']                          = 'PERFIL';
$lang['multimedios_cargas_controller_lang_tabla_titulo_fecha_i']                          = 'DATA INÍCIO';
$lang['multimedios_cargas_controller_lang_tabla_titulo_fecha_f']                          = 'DATA FIM';
$lang['multimedios_cargas_controller_lang_js_baja_confirm']                          = 'VOCÊ QUER CANCELAR A INSCRIÇÃO?';
$lang['multimedios_cargas_controller_lang_js_aceptar']                          = 'ACEITAR';
$lang['multimedios_cargas_controller_lang_js_cancelar']                          = 'CANCELAR';
$lang['multimedios_cargas_controller_lang_js_baja_exitosa']                          = 'BAIXA EFETUADA COM SUCESSO';
$lang['multimedios_cargas_controller_lang_tabla_js_all']                            = 'TODOS';
$lang['multimedios_cargas_controller_lang_tabla_js_lengthMenu']                          = 'EXIBINDO _MENU_ REGISTROS POR PÁGINA';
$lang['multimedios_cargas_controller_lang_tabla_js_zeroRecords']                         = 'NENHUM REGISTRO ENCONTRADO';
$lang['multimedios_cargas_controller_lang_tabla_js_info']                                = 'PÁGINA _PAGE_ DE _PAGES_';
$lang['multimedios_cargas_controller_lang_tabla_js_infoEmpty']                           = 'REGISTROS NÃO DISPONÍVEIS';
$lang['multimedios_cargas_controller_lang_tabla_js_infoFiltered']                        = '(FILTRADO DE _MAX_ REGISTROS)';
$lang['multimedios_cargas_controller_lang_tabla_js_search']                              = 'PESQUISAR:';
$lang['multimedios_cargas_controller_lang_tabla_js_first']                               = 'PRIMEIRO';
$lang['multimedios_cargas_controller_lang_tabla_js_last']                                = 'ÚLTIMO';
$lang['multimedios_cargas_controller_lang_tabla_js_next']                                = 'PRÓXIMO';
$lang['multimedios_cargas_controller_lang_tabla_js_previous']                            = 'ANTERIOR';
$lang['multimedios_cargas_controller_lang_etiqueta_sel_perfil']                               = 'SELECIONE UM PERFIL';
$lang['multimedios_cargas_controller_lang_etiqueta_sel_fechas']                               = 'SELECIONE AS DATAS';
$lang['multimedios_cargas_controller_lang_etiqueta_valida_fechas']                               = 'A DATA INICIAL DEVE SER MAIOR QUE A FINAL';
$lang['multimedios_cargas_controller_lang_etiqueta_archivo_cargado']                               = 'O ARQUIVO FOI CARREGADO COM SUCESSO';
$lang['multimedios_cargas_controller_lang_etiqueta_popup_creado']                               = 'O POPUP FOI CRIADO COM SUCESSO';
$lang['multimedios_cargas_controller_lang_etiqueta_si']                               = 'SIM';
$lang['multimedios_cargas_controller_lang_etiqueta_no']                               = 'NÃO';
$lang['multimedios_cargas_controller_lang_etiqueta_todos']                               = 'TODOS';
$lang['multimedios_cargas_controller_lang_etiqueta_descarga']                               = 'DESCARGAR';
$lang['multimedios_cargas_controller_lang_tabla_titulo_descarga']                               = 'DESCARGAR';
$lang['multimedios_cargas_controller_lang_tabla_titulo_ver']                               = 'VER';
$lang['multimedios_cargas_controller_lang_tabla_titulo_estatus']                               = 'STATUS';

