<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Amaury Leon Jimenez  * 
 * @CreateDate  15 junio 2026 1:03:17 *  
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['recompensas_controller_titulo']                                          = 'CARGA DE FAIXAS DE RECOMPENSAS';
$lang['recompensas_controller_texto_seleccion']                                 = 'SELECIONE UMA OPÇÃO PARA INSERIR SUAS FAIXAS DE RECOMPENSAS:';

$lang['recompensas_controller_etiqueta_simple']                                 = 'CADASTRO';
$lang['recompensas_controller_etiqueta_multiple']                               = 'CARGA';
$lang['recompensas_controller_etiqueta_ano']                                    = '*ANO:';
$lang['recompensas_controller_etiqueta_mes']                                    = '*MÊS:';
$lang['recompensas_controller_etiqueta_lugar']                                  = '*LUGAR:';
$lang['recompensas_controller_etiqueta_tipo']                                   = '*TIPO:';
$lang['recompensas_controller_etiqueta_rango_ini']                              = 'FAIXA INICIAL:';
$lang['recompensas_controller_etiqueta_rango_fin']                              = 'FAIXA FINAL:';
$lang['recompensas_controller_etiqueta_excel']                                  = 'ARQUIVO EXCEL:';
$lang['recompensas_controller_etiqueta_ejemplo']                                = 'BAIXAR EXEMPLO';

$lang['recompensas_controller_placeholder_anio']                                = 'SELECIONE UM ANO';
$lang['recompensas_controller_placeholder_mes']                                 = 'SELECIONE UM MÊS';
$lang['recompensas_controller_placeholder_lugar']                               = 'SELECIONE UM LUGAR';
$lang['recompensas_controller_placeholder_tipo']                                = 'SELECIONE UM TIPO';
$lang['recompensas_controller_placeholder_rango_ini']                           = 'FAIXA INICIAL';
$lang['recompensas_controller_placeholder_rango_fin']                           = 'FAIXA FINAL';

$lang['recompensas_controller_tabla_id']                                        = 'ID';
$lang['recompensas_controller_tabla_anio']                                      = 'ANO';
$lang['recompensas_controller_tabla_mes']                                       = 'MÊS';
$lang['recompensas_controller_tabla_lugar']                                     = 'LUGAR';
$lang['recompensas_controller_tabla_tipo']                                      = 'TIPO';
$lang['recompensas_controller_tabla_rango_ini']                                 = 'FAIXA INICIAL';
$lang['recompensas_controller_tabla_rango_fin']                                 = 'FAIXA FINAL';
$lang['recompensas_controller_tabla_observaciones']                             = 'OBSERVAÇÕES';

$lang['recompensas_controller_msg_carga_exitosa']                               = 'CARGA CONCLUÍDA';
$lang['recompensas_controller_msg_error_archivo']                               = 'O ARQUIVO CARREGADO TEM ERROS, VERIFIQUE O RELATÓRIO';
$lang['recompensas_controller_no_cargo']                                        = 'O ARQUIVO NÃO FOI CARREGADO';
$lang['recompensas_controller_mes_repetido']                                    = 'ESTE PERÍODO JÁ FOI CADASTRADO';
$lang['recompensas_controller_mes_valores_mayores']                             = 'O VALOR DA FAIXA INICIAL';
$lang['recompensas_controller_mes_valores_mayores_2']                           = 'É MAIOR QUE A FAIXA INICIAL';
$lang['recompensas_controller_mes_valores_mayores_3']                           = 'OU É MAIOR QUE A FAIXA FINAL';
$lang['recompensas_controller_mes_valores_menores']                             = 'O VALOR DA FAIXA FINAL';
$lang['recompensas_controller_mes_valores_menores_2']                           = 'É MAIOR QUE A FAIXA INICIAL';
$lang['recompensas_controller_mes_valores_menores_3']                           = 'OU É MAIOR QUE A FAIXA FINAL';
$lang['recompensas_controller_mes_select_archivo']                              = 'SELECIONE UM ARQUIVO';

$lang['recompensas_controller_msg_error_archivo_vacio']                         = 'O ARQUIVO CARREGADO ESTÁ VAZIO';

$lang['recompensas_controller_js_msg_archivo_tamanio']                          = 'O TAMANHO DO ARQUIVO É MUITO GRANDE, SÓ SÃO PERMITIDOS ARQUIVOS MENORES DE 4MB';
$lang['recompensas_controller_js_msg_archivo_extenciones']                      = 'TIPO DE ARQUIVO INVÁLIDO, USE APENAS XLSX.';