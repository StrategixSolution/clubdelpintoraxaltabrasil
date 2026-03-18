<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['ventas_auditoria_rechazados_controller_lang_pagina_titulo']                                          = 'TICKETS RECUSADOS';
$lang['ventas_auditoria_rechazados_controller_lang_pagina_titulo_actualiza']                                = 'EDIÇÃO DO TICKET RECUSADO';
$lang['ventas_auditoria_rechazados_controller_lang_modal_ticket_titulo']                                    = 'TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_ventano']                                          = 'Nº';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_ventaid']                                          = 'ID';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_pintor']                                           = 'PINTOR';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_distribuidor']                                     = 'DISTRIBUIDOR';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_nombre']                                           = 'NOME';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_numero_ticket']                                    = 'Nº DO TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_monto_ticket']                                     = 'VALOR DO TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_fecha_registro']                                   = 'DATA DE CADASTRO';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_ticket']                                           = 'TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_estatus_auditoria']                                = 'STATUS AUDITORIA';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_fecha_auditoria']                                  = 'DATA AUDITORIA';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_observaciones']                                    = 'OBSERVAÇÕES';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_motivo']                                           = 'MOTIVO';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_fecha_notificacion']                               = 'DATA DE NOTIFICAÇÃO';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_fecha_limite']                                     = 'DATA LIMITE DE CORREÇÃO';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_accion']                                           = 'AÇÃO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_promocion']                          = 'PROMOÇÃO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_descripcion']                        = 'DESCRIÇÃO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_gms']                                = 'GMS';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_codigo']                             = 'CÓDIGO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_presentacion']                       = 'APRESENTAÇÃO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_cantidad']                           = 'QUANTIDADE';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_id']                                 = 'ID';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_nombre']                             = 'NOME';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_folio']                              = 'FOLIO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_monto']                              = 'VALOR';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_fecha']                              = 'DATA';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_sector']                             = 'SETOR';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_clase']                              = 'CLASSE';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_marca']                              = 'MARCA';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_cantidad']                           = 'QUANTIDADE';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_litros']                             = 'LITROS';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_galones']                            = 'GALÕES';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_precio_unitario']                    = 'PREÇO UNITÁRIO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_precio_unitario_total']              = 'PREÇO UNITÁRIO TOTAL';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_etiqueta_msg_ticket']                           = 'SELECIONE UMA OPÇÃO PARA ADICIONAR SEU TICKET:';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_camara']                                        = 'CÂMERA';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_archivo']                                       = 'ARQUIVO';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_detalle']                                       = 'DESEJA ADICIONAR PRODUTOS?';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_maestro_pintor_nombre']                         = 'NOME:';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_maestro_pintor_email']                          = 'E-MAIL:';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_maestro_pintor_celular']                        = 'CELULAR:';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_maestro_pintor_rfc']                            = 'NIT:';
$lang['ventas_auditoria_rechazados_controller_lang_input_numero_tarjeta']                                   = '*NÚMERO DO CARTÃO:';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_numero_tarjeta']                                 = '*CAMPO OBRIGATÓRIO *ESCANEIE O NÚMERO COM SUA CÂMERA OU ESCREVA SOMENTE NÚMEROS MÁXIMO 6 DÍGITOS';
$lang['ventas_auditoria_rechazados_controller_lang_placeholder_numero_tarjeta']                             = 'NÚMERO DO CARTÃO';
$lang['ventas_auditoria_rechazados_controller_lang_input_numero_ticket']                                    = '*NÚMERO DO TICKET:';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_numero_ticket']                                  = '*CAMPO OBRIGATÓRIO *MÁXIMO 20 CARACTERES';
$lang['ventas_auditoria_rechazados_controller_lang_placeholder_numero_ticket']                              = 'NÚMERO DO TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_input_monto_ticket']                                     = '*VALOR DO TICKET:';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_monto_ticket']                                   = '*SOMENTE NUMÉRICO *CAMPO OBRIGATÓRIO';
$lang['ventas_auditoria_rechazados_controller_lang_placeholder_monto_ticket']                               = 'VALOR DO TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_input_ticket']                                           = '*TICKET:';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_ticket_foto']                                    = '*CLIQUE NO ÍCONE PARA ATIVAR A CÂMERA *CAMPO OBRIGATÓRIO';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_ticket_archivo']                                 = '*O FORMATO DO ARQUIVO DEVE SER PNG E SEU TAMANHO MENOR QUE 2MB. *CAMPO OBRIGATÓRIO';
$lang['ventas_auditoria_rechazados_controller_lang_placeholder_ticket']                                     = 'TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_boton_regresar']                                         = 'VOLTAR';
$lang['ventas_auditoria_rechazados_controller_lang_msg_archivo']                                            = 'O FORMATO DO ARQUIVO DEVE SER PNG, JPG, JPEG, PDF E SEU TAMANHO MENOR QUE 2MB.';
$lang['ventas_auditoria_rechazados_controller_lang_msg_archivo_error']                                      = 'O FORMATO DO ARQUIVO SELECIONADO NÃO É VÁLIDO, POR FAVOR INSIRA UM ARQUIVO PNG, JPG, PDF, JPEG MENOR QUE 2MB.';
$lang['ventas_auditoria_rechazados_controller_lang_msg_error_tamanio_identificacion']                       = 'O TAMANHO DO ARQUIVO É MUITO GRANDE, SOMENTE SÃO PERMITIDOS ARQUIVOS MENORES QUE 4MB';