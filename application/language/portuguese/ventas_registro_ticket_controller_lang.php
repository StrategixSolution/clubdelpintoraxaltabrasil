<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 26 may. 2022 1:03:17 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['ventas_registro_ticket_controller_lang_titulo']                                      = 'CADASTRO DE VENDAS';
$lang['ventas_registro_ticket_controller_lang_etiqueta_etiqueta_msg_ticket']                = 'SELECIONE UMA OPÇÃO PARA ADICIONAR SEU TICKET:';
$lang['ventas_registro_ticket_controller_lang_etiqueta_camara']                             = 'CÂMERA';
$lang['ventas_registro_ticket_controller_lang_etiqueta_archivo']                            = 'ARQUIVO';
$lang['ventas_registro_ticket_controller_lang_etiqueta_detalle']                            = 'DESEJA ADICIONAR PRODUTOS?';
$lang['ventas_registro_ticket_controller_lang_etiqueta_maestro_pintor_nombre']              = 'NOME:';
$lang['ventas_registro_ticket_controller_lang_etiqueta_maestro_pintor_email']               = 'E-MAIL:';
$lang['ventas_registro_ticket_controller_lang_etiqueta_maestro_pintor_celular']             = 'CELULAR:';
$lang['ventas_registro_ticket_controller_lang_etiqueta_maestro_pintor_rfc']                 = 'NIT:';
$lang['ventas_registro_ticket_controller_lang_input_numero_tarjeta']                        = '*NÚMERO DO CARTÃO:';
$lang['ventas_registro_ticket_controller_lang_tooltip_numero_tarjeta']                      = '*CAMPO OBRIGATÓRIO *ESCANEIE O NÚMERO COM SUA CÂMERA OU ESCREVA SOMENTE NÚMEROS MÁXIMO 6 DÍGITOS';
$lang['ventas_registro_ticket_controller_lang_placeholder_numero_tarjeta']                  = 'NÚMERO DO CARTÃO';
$lang['ventas_registro_ticket_controller_lang_input_numero_ticket']                         = '*NÚMERO DO TICKET:';
$lang['ventas_registro_ticket_controller_lang_tooltip_numero_ticket']                       = '*CAMPO OBRIGATÓRIO *MÁXIMO 20 CARACTERES';
$lang['ventas_registro_ticket_controller_lang_placeholder_numero_ticket']                   = 'NÚMERO DO TICKET';
$lang['ventas_registro_ticket_controller_lang_input_monto_ticket']                          = '*VALOR DO TICKET:';
$lang['ventas_registro_ticket_controller_lang_tooltip_monto_ticket']                        = '*SOMENTE NUMÉRICO *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_ticket_controller_lang_placeholder_monto_ticket']                    = 'VALOR DO TICKET';
$lang['ventas_registro_ticket_controller_lang_input_ticket']                                = '*TICKET:';
$lang['ventas_registro_ticket_controller_lang_tooltip_ticket_foto']                         = '*CLIQUE NO ÍCONE PARA ATIVAR A CÂMERA *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_ticket_controller_lang_tooltip_ticket_archivo']                      = '*O FORMATO DO ARQUIVO DEVE SER PNG E SEU TAMANHO MENOR QUE 2MB. *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_ticket_controller_lang_placeholder_ticket']                          = 'TICKET';
$lang['ventas_registro_ticket_controller_lang_boton_regresar']                              = 'VOLTAR';
$lang['ventas_registro_ticket_controller_lang_boton_guardar']                               = 'SALVAR';
$lang['ventas_registro_ticket_controller_lang_input_sector']                                = 'SETOR:';
$lang['ventas_registro_ticket_controller_lang_tooltip_sector']                              = '*SELECIONE UM SETOR';
$lang['ventas_registro_ticket_controller_lang_placeholder_sector']                          = 'SETOR';
$lang['ventas_registro_ticket_controller_lang_input_clase']                                 = 'CLASSE:';
$lang['ventas_registro_ticket_controller_lang_tooltip_clase']                               = '*SELECIONE UMA CLASSE';
$lang['ventas_registro_ticket_controller_lang_placeholder_clase']                           = 'CLASSE';
$lang['ventas_registro_ticket_controller_lang_input_marca']                                 = 'MARCA:';
$lang['ventas_registro_ticket_controller_lang_tooltip_marca']                               = '*SELECIONE UMA MARCA';
$lang['ventas_registro_ticket_controller_lang_placeholder_marca']                           = 'MARCA';
$lang['ventas_registro_ticket_controller_lang_input_monto']                                 = '*PREÇO UNITÁRIO:';
$lang['ventas_registro_ticket_controller_lang_tooltip_monto']                               = '*SOMENTE NÚMEROS COM DECIMAIS *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_ticket_controller_lang_placeholder_monto']                           = 'PREÇO UNITÁRIO';
$lang['ventas_registro_ticket_controller_lang_input_cantidad']                              = 'QUANTIDADE:';
$lang['ventas_registro_ticket_controller_lang_tooltip_cantidad']                            = '*SOMENTE NÚMEROS *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_ticket_controller_lang_placeholder_cantidad']                        = 'QUANTIDADE';
$lang['ventas_registro_ticket_controller_lang_input_litros']                                = 'GALÕES:';
$lang['ventas_registro_ticket_controller_lang_tooltip_litros']                              = '*SELECIONE UMA OPÇÃO *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_ticket_controller_lang_placeholder_litros']                          = 'GALÕES';
$lang['ventas_registro_ticket_controller_lang_combo_selecciona_sector']                     = 'SELECIONE UM SETOR';
$lang['ventas_registro_ticket_controller_lang_combo_selecciona_clase']                      = 'SELECIONE UMA CLASSE';
$lang['ventas_registro_ticket_controller_lang_combo_selecciona_marca']                      = 'SELECIONE UMA MARCA';
$lang['ventas_registro_ticket_controller_lang_combo_selecciona_litros']                     = 'SELECIONE UMA OPÇÃO';
$lang['ventas_registro_ticket_controller_lang_boton_agregar']                               = 'ADICIONAR';
$lang['ventas_registro_ticket_controller_lang_boton_limpiar_carrito']                       = 'LIMPAR';
$lang['ventas_registro_ticket_controller_lang_msg_limpiar_carrito']                         = 'DESEJA EXCLUIR TODOS OS PRODUTOS?';
$lang['ventas_registro_ticket_controller_lang_msg_qr_error']                                = 'O NÚMERO DO CARTÃO OU QR É INVÁLIDO';
$lang['ventas_registro_ticket_controller_lang_msg_archivo']                                 = 'O FORMATO DO ARQUIVO DEVE SER PNG, JPG, JPEG, PDF E SEU TAMANHO MENOR QUE 4MB.';
$lang['ventas_registro_ticket_controller_lang_msg_archivo_error']                           = 'O FORMATO DO ARQUIVO SELECIONADO NÃO É VÁLIDO, POR FAVOR INSIRA UM ARQUIVO PNG, JPG, PDF, JPEG MENOR QUE 2MB.';
$lang['ventas_registro_ticket_controller_lang_msg_error_formato_identificacion']            = 'O FORMATO ESTÁ INCORRETO, SOMENTE PNG E JPG SÃO PERMITIDOS.';
$lang['ventas_registro_ticket_controller_lang_msg_error_tamanio_identificacion']            = 'O TAMANHO DO ARQUIVO É MUITO GRANDE, SOMENTE SÃO PERMITIDOS ARQUIVOS MENORES QUE 4MB';
$lang['ventas_registro_ticket_controller_lang_msg_error_numeros_negativos']                 = 'SOMENTE NÚMEROS POSITIVOS MAIORES QUE ZERO SÃO PERMITIDOS';
$lang['ventas_registro_ticket_controller_lang_msg_error_marca']                             = 'INSIRA O VALOR E OS LITROS';
$lang['ventas_registro_ticket_controller_lang_placeholder_borrar']                          = 'EXCLUIR';
$lang['ventas_registro_ticket_controller_lang_btn_aceptar']                                 = 'ACEITAR';
$lang['ventas_registro_ticket_controller_lang_btn_cancelar']                                = 'CANCELAR';
$lang['ventas_registro_ticket_controller_lang_baja_prodcuto_titulo']                        = 'DESEJA REMOVER O PRODUTO?';
$lang['ventas_registro_ticket_controller_lang_etiqueta_maestro_pintor']                     = 'MESTRE PINTOR: ';
$lang['ventas_registro_ticket_controller_lang_js_msg_error_archivo']                        = 'O CAMPO TICKET É OBRIGATÓRIO.';
$lang['ventas_registro_ticket_controller_lang_js_msg_error_guardar_venta']                  = 'ERRO, A VENDA NÃO FOI SALVA';
$lang['ventas_registro_ticket_controller_lang_js_msg_venta_guardada_promociones_titulo']    = 'O TICKET FOI CADASTRADO COM SUCESSO COM VALOR TOTAL';
$lang['ventas_registro_ticket_controller_lang_js_msg_venta_guardada_promociones_msg']       = 'SEU TICKET CONTÉM PRODUTOS DA PROMOÇÃO?';
$lang['ventas_registro_ticket_controller_lang_btn_si']                                      = 'SIM';
$lang['ventas_registro_ticket_controller_lang_btn_no']                                      = 'NÃO';
$lang['ventas_registro_ticket_controller_lang_js_msg_error_guardar_detalle_venta']          = 'FALTAM ARTIGOS PARA ADICIONAR';
$lang['ventas_registro_ticket_controller_lang_msg_numero_ticket_repetido']                  = 'O FOLIO %1$s JÁ EXISTE NA BASE DE DADOS';
$lang['ventas_registro_ticket_controller_lang_input_distribuidor']                          = 'DISTRIBUIDOR:';