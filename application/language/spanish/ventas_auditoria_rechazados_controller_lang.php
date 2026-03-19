<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['ventas_auditoria_rechazados_controller_lang_pagina_titulo']                                          = 'TICKETS RECHAZADOS';
$lang['ventas_auditoria_rechazados_controller_lang_pagina_titulo_actualiza']                                = 'EDICIÓN DEL TICKET RECHAZADO';
$lang['ventas_auditoria_rechazados_controller_lang_modal_ticket_titulo']                                    = 'TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_ventano']                                          = 'NO.';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_ventaid']                                          = 'ID';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_pintor']                                           = 'PINTOR';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_distribuidor']                                     = 'DISTRIBUIDOR';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_nombre']                                           = 'NOMBRE';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_numero_ticket']                                    = 'No DE TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_monto_ticket']                                     = 'MONTO DE TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_fecha_registro']                                   = 'FECHA REGISTRO';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_ticket']                                           = 'TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_estatus_auditoria']                                = 'ESTATUS AUDITORÍA';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_fecha_auditoria']                                  = 'FECHA AUDITORÍA';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_observaciones']                                    = 'OBSERVACIONES';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_motivo']                                           = 'MOTIVO';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_fecha_notificacion']                               = 'FECHA DE NOTIFICACIÓN';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_fecha_limite']                                     = 'FECHA LÍMITE DE CORRECCIÓN';
$lang['ventas_auditoria_rechazados_controller_lang_tabla_accion']                                           = 'ACCIÓN';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_promocion']                          = 'PROMOCIÓN';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_descripcion']                        = 'DESCRIPCIÓN';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_gms']                                = 'GMS';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_codigo']                             = 'CÓDIGO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_presentacion']                       = 'PRESENTACIÓN';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_cantidad']                           = 'CANTIDAD';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_id']                                 = 'ID';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_nombre']                             = 'NOMBRE';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_folio']                              = 'FOLIO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_monto']                              = 'MONTO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_fecha']                              = 'FECHA';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_sector']                             = 'SECTOR';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_clase']                              = 'CLASE';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_marca']                              = 'MARCA';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_cantidad']                           = 'CANTIDAD';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_litros']                             = 'LITROS';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_galones']                            = 'GALONES';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_precio_unitario']                    = 'PRECIO UNITARIO';
$lang['ventas_auditoria_rechazados_controller_lang_model_tabla_titulo_precio_unitario_total']              = 'PRECIO UNITARIO TOTAL';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_etiqueta_msg_ticket']                           = 'SELECCIONA UNA OPCIÓN PARA AGREGAR SU TICKET:';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_camara']                                        = 'CÁMARA';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_archivo']                                       = 'ARCHIVO';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_detalle']                                       = '¿DESEAS AGREGAR PRODUCTOS?';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_maestro_pintor_nombre']                         = 'NOMBRE:';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_maestro_pintor_email']                          = 'EMAIL:';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_maestro_pintor_celular']                        = 'CELULAR:';
$lang['ventas_auditoria_rechazados_controller_lang_etiqueta_maestro_pintor_rfc']                            = 'NIT:';
$lang['ventas_auditoria_rechazados_controller_lang_input_numero_tarjeta']                                   = '*NÚMERO DE TARJETA:';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_numero_tarjeta']                                 = '*CAMPO OBLIGATORIO *ESCANEA EL NÚMERO CON TU CÁMARA O ESCRIBE SOLO NÚMEROS MÁXIMO 6 DÍGITOS';
$lang['ventas_auditoria_rechazados_controller_lang_placeholder_numero_tarjeta']                             = 'NÚMERO DE TARJETA';
$lang['ventas_auditoria_rechazados_controller_lang_input_numero_ticket']                                    = '*NÚMERO DE TICKET:';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_numero_ticket']                                  = '*CAMPO OBLIGATORIO *MÁXIMO 20 CARACTERES';
$lang['ventas_auditoria_rechazados_controller_lang_placeholder_numero_ticket']                              = 'NÚMERO DE TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_input_monto_ticket']                                     = '*MONTO TICKET:';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_monto_ticket']                                   = '*SOLO NUMÉRICO *CAMPO OBLIGATORIO';
$lang['ventas_auditoria_rechazados_controller_lang_placeholder_monto_ticket']                               = 'MONTO TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_input_ticket']                                           = '*TICKET:';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_ticket_foto']                                    = '*DA CLICK EN EL ICONO PARA ACTIVAR LA CÁMARA *CAMPO OBLIGATORIO';
$lang['ventas_auditoria_rechazados_controller_lang_tooltip_ticket_archivo']                                 = '*EL FORMATO DEL ARCHIVO DEBE SER PNG Y SU TAMAÑO MENOR A 2MB. *CAMPO OBLIGATORIO';
$lang['ventas_auditoria_rechazados_controller_lang_placeholder_ticket']                                     = 'TICKET';
$lang['ventas_auditoria_rechazados_controller_lang_boton_regresar']                                         = 'REGRESAR';
$lang['ventas_auditoria_rechazados_controller_lang_msg_archivo']                                            = 'EL FORMATO DEL ARCHIVO DEBE SER PNG, JPG, JPEG, PDF Y SU TAMAÑO MENOR A 2MB.';
$lang['ventas_auditoria_rechazados_controller_lang_msg_archivo_error']                                      = 'EL FORMATO DEL ARCHIVO SELECCIONADO NO ES VÁLIDO, POR FAVOR INGRESA UN ARCHIVO PNG, JPG, PDF, JPEG MENOR A 2MB.';
$lang['ventas_auditoria_rechazados_controller_lang_msg_error_tamanio_identificacion']                       = 'EL TAMAÑO DEL ARCHIVO ES DEMASIADO GRANDE, SOLO SE PERMITE ARCHIVOS MENORES DE 4MB';