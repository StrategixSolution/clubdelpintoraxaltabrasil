<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                           * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['ventas_registro_controller_lang_titulo']                                      = 'RECORDE DE VENDAS';
$lang['ventas_registro_controller_lang_etiqueta_etiqueta_msg_ticket']                = 'SELECCIONA UMA OPÇÃO PARA ADICIONAR SEU TICKET:';
$lang['ventas_registro_controller_lang_etiqueta_camara']                             = 'CÂMERA';
$lang['ventas_registro_controller_lang_etiqueta_archivo']                            = 'ARQUIVO';
$lang['ventas_registro_controller_lang_etiqueta_detalle']                            = 'DESEJA ADICIONAR PRODUTOS?';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor_nombre']              = 'NOME:';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor_email']               = 'EMAIL:';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor_celular']             = 'CELULAR:';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor_rfc']                 = 'NIT:';
$lang['ventas_registro_controller_lang_input_numero_tarjeta']                        = '*NÚMERO DO CARTÃO:';
$lang['ventas_registro_controller_lang_tooltip_numero_tarjeta']                      = '*CAMPO OBRIGATÓRIO *ESCANEIE O NÚMERO COM SUA CÂMERA OU DIGITE APENAS NÚMEROS MÁXIMO 6 DÍGITOS';
$lang['ventas_registro_controller_lang_placeholder_numero_tarjeta']                  = 'NÚMERO DO CARTÃO';
$lang['ventas_registro_controller_lang_input_numero_ticket']                         = '*NÚMERO DO BILHETE:';
$lang['ventas_registro_controller_lang_tooltip_numero_ticket']                       = '*CAMPO OBRIGATÓRIO *MÁXIMO 20 CARACTERES';
$lang['ventas_registro_controller_lang_placeholder_numero_ticket']                   = 'NÚMERO DO BILHETE';
$lang['ventas_registro_controller_lang_input_monto_ticket']                          = '*VALOR DO BILHETE:';
$lang['ventas_registro_controller_lang_tooltip_monto_ticket']                        = '*APENAS NÚMEROS *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_controller_lang_placeholder_monto_ticket']                    = 'VALOR DO BILHETE';
$lang['ventas_registro_controller_lang_input_ticket']                                = '*BILHETE:';
$lang['ventas_registro_controller_lang_tooltip_ticket_foto']                         = '*DA CLICK EN EL ICONO PARA ACTIVAR LA CÂMERA *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_controller_lang_tooltip_ticket_archivo']                      = '*O FORMATO DO ARQUIVO DEVE SER PNG E SEU TAMANHO MENOR QUE 2MB. *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_controller_lang_placeholder_ticket']                          = 'BILHETE';
$lang['ventas_registro_controller_lang_boton_regresar']                              = 'VOLTAR';
$lang['ventas_registro_controller_lang_boton_guardar']                               = 'SALVAR';
$lang['ventas_registro_controller_lang_input_sector']                                = 'SETOR:';
$lang['ventas_registro_controller_lang_tooltip_sector']                              = '*SELECIONE UM SETOR';
$lang['ventas_registro_controller_lang_placeholder_sector']                          = 'SETOR';
$lang['ventas_registro_controller_lang_input_clase']                                 = 'CLASSE:';
$lang['ventas_registro_controller_lang_tooltip_clase']                               = '*SELECIONE UMA CLASSE';
$lang['ventas_registro_controller_lang_placeholder_clase']                           = 'CLASSE';
$lang['ventas_registro_controller_lang_input_marca']                                 = 'MARCA:';
$lang['ventas_registro_controller_lang_tooltip_marca']                               = '*SELECIONE UMA MARCA';
$lang['ventas_registro_controller_lang_placeholder_marca']                           = 'MARCA';
$lang['ventas_registro_controller_lang_input_monto']                                 = '*PREÇO UNITÁRIO:';
$lang['ventas_registro_controller_lang_tooltip_monto']                               = '*SOMENTE NÚMEROS COM DECIMAIS *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_controller_lang_placeholder_monto']                           = 'PREÇO UNITÁRIO';
$lang['ventas_registro_controller_lang_input_cantidad']                              = 'QUANTIDADE:';
$lang['ventas_registro_controller_lang_tooltip_cantidad']                            = '*SOMENTE NÚMEROS *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_controller_lang_placeholder_cantidad']                        = 'QUANTIDADE';
$lang['ventas_registro_controller_lang_input_litros']                                = 'GALÕES:';
$lang['ventas_registro_controller_lang_tooltip_litros']                              = '*SELECIONE UMA OPÇÃO *CAMPO OBRIGATÓRIO';
$lang['ventas_registro_controller_lang_placeholder_litros']                          = 'GALÕES';
$lang['ventas_registro_controller_lang_combo_selecciona_sector']                     = 'SELECIONE UM SETOR';
$lang['ventas_registro_controller_lang_combo_selecciona_clase']                      = 'SELECIONE UMA CLASSE';
$lang['ventas_registro_controller_lang_combo_selecciona_marca']                      = 'SELECIONE UMA MARCA';
$lang['ventas_registro_controller_lang_combo_selecciona_litros']                     = 'SELECIONE UMA OPÇÃO';
$lang['ventas_registro_controller_lang_boton_agregar']                               = 'ADICIONAR';
$lang['ventas_registro_controller_lang_boton_limpiar_carrito']                       = 'LIMPAR';
$lang['ventas_registro_controller_lang_msg_limpiar_carrito']                         = 'DESEJA EXCLUIR TODOS OS PRODUTOS?';
$lang['ventas_registro_controller_lang_msg_qr_error']                                = 'O NÚMERO DO CARTÃO OU QR ESTÁ INCORRETO';
$lang['ventas_registro_controller_lang_msg_archivo']                                 = 'O FORMATO DO ARQUIVO DEVE SER PNG, JPG, JPEG E SEU TAMANHO MENOR QUE 4MB.';
$lang['ventas_registro_controller_lang_msg_archivo_error']                           = 'O FORMATO DO ARQUIVO SELECIONADO NÃO É VÁLIDO, POR FAVOR INSIRA UM ARQUIVO PNG, JPG, JPEG MENOR QUE 4MB.';
$lang['ventas_registro_controller_lang_msg_error_formato_identificacion']            = 'O FORMATO ESTÁ INCORRETO, APENAS PNG, JPG E PDF SÃO PERMITIDOS.';
$lang['ventas_registro_controller_lang_msg_error_tamanio_identificacion']            = 'O TAMANHO DO ARQUIVO É MUITO GRANDE, APENAS ARQUIVOS MENORES QUE 4MB SÃO PERMITIDOS';
$lang['ventas_registro_controller_lang_msg_error_numeros_negativos']                 = 'APENAS NÚMEROS POSITIVOS MAIORES QUE ZERO SÃO PERMITIDOS';
$lang['ventas_registro_controller_lang_msg_error_marca']                             = 'CAPTURE O PREÇO UNITÁRIO, A QUANTIDADE E OS GALÕES';
$lang['ventas_registro_controller_lang_placeholder_borrar']                          = 'APAGAR';
$lang['ventas_registro_controller_lang_btn_aceptar']                                 = 'ACEITAR';
$lang['ventas_registro_controller_lang_btn_cancelar']                                = 'CANCELAR';
$lang['ventas_registro_controller_lang_baja_prodcuto_titulo']                        = 'DESEJA DAR BAIXA NO PRODUTO?';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor']                     = 'MAESTRO PINTOR: ';
$lang['ventas_registro_controller_lang_js_msg_error_archivo']                        = 'O CAMPO TICKET É OBRIGATÓRIO.';
$lang['ventas_registro_controller_lang_js_msg_error_guardar_venta']                  = 'ERRO, A VENDA NÃO FOI SALVA';
$lang['ventas_registro_controller_lang_js_msg_venta_guardada_promociones_titulo']    = 'O TICKET FOI REGISTRADO CORRETAMENTE COM O VALOR TOTAL';
$lang['ventas_registro_controller_lang_js_msg_venta_guardada_promociones_msg']       = 'SEU TICKET CONTÉM PRODUTOS DA PROMOÇÃO?';
$lang['ventas_registro_controller_lang_js_msg_error_guardar_detalle_venta']          = 'FALTA A CAPTURA DE ARTIGOS';
$lang['ventas_registro_controller_lang_js_msg_error_guardar_ticket_repetido']        = 'O TICKET JÁ ESTÁ REGISTRADO NO SISTEMA PARA SEU DISTRIBUIDOR';
$lang['ventas_registro_controller_lang_btn_si']                                      = 'SIM';
$lang['ventas_registro_controller_lang_btn_no']                                      = 'NÃO';
$lang['ventas_registro_controller_lang_etiqueta_aviso']                                      = 'Lembre-se de que você deve registrar as vendas no mês em que são geradas, caso contrário, serão rejeitadas na auditoria.<br>Certifique-se de sempre inserir o preço unitário, este valor é o que soma para seus Maestros Pintores.<br>';
$lang['ventas_registro_controller_lang_etiqueta_aviso_2']                                      = 'Adicione todos os produtos do seu bilhete clicando no botão +ADICIONAR e, ao terminar, clique no botão SALVAR.';
$lang['ventas_registro_controller_lang_input_distribuidor']                          = 'DISTRIBUIDOR:';