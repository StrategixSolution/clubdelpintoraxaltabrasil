<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['ventas_auditoria_envio_correos_controller_lang_pagina_titulo']                                         = 'ENVIO DE E-MAILS – TICKETS RECUSADOS NA AUDITORIA';
$lang['ventas_auditoria_envio_correos_controller_lang_modal_ticket_titulo']                                   = 'TICKET';
$lang['ventas_auditoria_envio_correos_controller_lang_etiqueta_distribuidor']                                 = 'DISTRIBUIDOR';
$lang['ventas_auditoria_envio_correos_controller_lang_etiqueta_estatus']                                      = 'STATUS';
$lang['ventas_auditoria_envio_correos_controller_lang_etiqueta_total']                                        = 'TOTAL';
$lang['ventas_auditoria_envio_correos_controller_lang_etiqueta_auditadas']                                    = 'AUDITADAS';
$lang['ventas_auditoria_envio_correos_controller_lang_etiqueta_sin_auditar']                                  = 'SEM AUDITAR';
$lang['ventas_auditoria_envio_correos_controller_lang_etiqueta_mes']                                          = 'MÊS:';
$lang['ventas_auditoria_envio_correos_controller_lang_etiqueta_anio']                                         = 'ANO:';
$lang['ventas_auditoria_envio_correos_controller_lang_placeholder_distribuidor']                              = 'TODOS';
$lang['ventas_auditoria_envio_correos_controller_lang_placeholder_estatus']                                   = 'TODOS';
$lang['ventas_auditoria_envio_correos_controller_lang_placeholder_mes']                                       = 'SELECIONE UM MÊS';
$lang['ventas_auditoria_envio_correos_controller_lang_placeholder_anio']                                      = 'SELECIONE UM ANO';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_ventano']                                         = 'Nº';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_ventaid']                                         = 'ID';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_pintor']                                          = 'PINTOR';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_distribuidor']                                    = 'DISTRIBUIDOR';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_nombre']                                          = 'NOME';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_numero_ticket']                                   = 'Nº DO TICKET';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_monto_ticket']                                    = 'VALOR DO TICKET';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_fecha_registro']                                  = 'DATA DE CADASTRO';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_ticket']                                          = 'TICKET';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_estatus_auditoria']                               = 'STATUS AUDITORIA';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_fecha_auditoria']                                 = 'DATA AUDITORIA';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_observaciones']                                   = 'OBSERVAÇÕES';
$lang['ventas_auditoria_primera_controller_lang_tabla_accion']                                                = 'AÇÃO';
$lang['ventas_auditoria_primera_controller_lang_tabla_fecha_auditoria']                                       = 'DATA DE AUDITORIA';
$lang['ventas_auditoria_primera_controller_lang_tabla_fecha_envio_correo']                                    = 'DATA ENVIO DE E-MAIL';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_motivo']                                          = 'MOTIVO';
$lang['ventas_auditoria_envio_correos_controller_lang_tabla_ticket_monto_repetido']                           = 'TICKETS COM VALOR REPETIDO';
$lang['ventas_auditoria_envio_correos_controller_lang_alerta_pregunta_aceptar']                               = 'DESEJA APROVAR A VENDA?';
$lang['ventas_auditoria_envio_correos_controller_lang_alerta_pregunta_rechazar']                              = 'DESEJA RECUSAR A VENDA?';
$lang['ventas_auditoria_envio_correos_controller_lang_alerta_respuesta_aprobada']                             = 'VENDA APROVADA';
$lang['ventas_auditoria_envio_correos_controller_lang_alerta_respuesta_rechazo']                              = 'VENDA RECUSADA';
$lang['ventas_auditoria_envio_correos_controller_lang_alerta_cancelar']                                       = 'CANCELAR';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_promocion']                          = 'PROMOÇÃO';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_descripcion']                        = 'DESCRIÇÃO';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_gms']                                = 'GMS';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_codigo']                             = 'CÓDIGO';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_presentacion']                       = 'APRESENTAÇÃO';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_cantidad']                           = 'QUANTIDADE';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_id']                                 = 'ID';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_nombre']                             = 'NOME';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_folio']                              = 'FOLIO';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_monto']                              = 'VALOR';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_fecha']                              = 'DATA';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_sector']                             = 'SETOR';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_clase']                              = 'CLASSE';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_marca']                              = 'MARCA';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_cantidad']                           = 'QUANTIDADE';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_litros']                             = 'LITROS';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_galones']                            = 'GALÕES';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_precio_unitario']                    = 'PREÇO UNITÁRIO';
$lang['ventas_auditoria_envio_correos_controller_lang_model_tabla_titulo_precio_unitario_total']              = 'PREÇO UNITÁRIO TOTAL';

