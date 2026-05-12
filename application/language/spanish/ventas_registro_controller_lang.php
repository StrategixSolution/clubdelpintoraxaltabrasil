<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');
 
$lang['ventas_registro_controller_lang_titulo']                                      = 'REGISTRO DE VENTAS';
$lang['ventas_registro_controller_lang_etiqueta_etiqueta_msg_ticket']                = 'SELECCIONA UNA OPCIÓN PARA AGREGAR TU TICKET:';
$lang['ventas_registro_controller_lang_etiqueta_camara']                             = 'CÁMARA';
$lang['ventas_registro_controller_lang_etiqueta_archivo']                            = 'ARCHIVO';
$lang['ventas_registro_controller_lang_etiqueta_detalle']                            = '¿DESEAS AGREGAR PRODUCTOS?';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor_nombre']              = 'NOMBRE:';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor_email']               = 'EMAIL:';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor_celular']             = 'CELULAR:';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor_rfc']                 = 'NIT:';
$lang['ventas_registro_controller_lang_input_numero_tarjeta']                        = '*NÚMERO DE TARJETA:';
$lang['ventas_registro_controller_lang_tooltip_numero_tarjeta']                      = '*CAMPO OBLIGATORIO *ESCANEA EL NÚMERO CON TU CÁMARA O ESCRIBE SOLO NÚMEROS MÁXIMO 6 DÍGITOS';
$lang['ventas_registro_controller_lang_placeholder_numero_tarjeta']                  = 'NÚMERO DE TARJETA';
$lang['ventas_registro_controller_lang_input_numero_ticket']                         = '*NÚMERO DE TICKET:';
$lang['ventas_registro_controller_lang_tooltip_numero_ticket']                       = '*CAMPO OBLIGATORIO *MÁXIMO 20 CARACTERES';
$lang['ventas_registro_controller_lang_placeholder_numero_ticket']                   = 'NÚMERO DE TICKET';
$lang['ventas_registro_controller_lang_input_monto_ticket']                          = '*MONTO TICKET:';
$lang['ventas_registro_controller_lang_tooltip_monto_ticket']                        = '*SOLO NUMÉRICO *CAMPO OBLIGATORIO';
$lang['ventas_registro_controller_lang_placeholder_monto_ticket']                    = 'MONTO TICKET';
$lang['ventas_registro_controller_lang_input_ticket']                                = '*TICKET:';
$lang['ventas_registro_controller_lang_tooltip_ticket_foto']                         = '*DA CLICK EN EL ICONO PARA ACTIVAR LA CÁMARA *CAMPO OBLIGATORIO';
$lang['ventas_registro_controller_lang_tooltip_ticket_archivo']                      = '*EL FORMATO DEL ARCHIVO DEBE SER PNG Y SU TAMAÑO MENOR A 2MB. *CAMPO OBLIGATORIO';
$lang['ventas_registro_controller_lang_placeholder_ticket']                          = 'TICKET';
$lang['ventas_registro_controller_lang_boton_regresar']                              = 'REGRESAR';
$lang['ventas_registro_controller_lang_boton_guardar']                               = 'GUARDAR';
$lang['ventas_registro_controller_lang_input_sector']                                = 'SECTOR:';
$lang['ventas_registro_controller_lang_tooltip_sector']                              = '*SELECCIONA UN SECTOR';
$lang['ventas_registro_controller_lang_placeholder_sector']                          = 'SECTOR';
$lang['ventas_registro_controller_lang_input_clase']                                 = 'CLASE:';
$lang['ventas_registro_controller_lang_tooltip_clase']                               = '*SELECCIONA UNA CLASE';
$lang['ventas_registro_controller_lang_placeholder_clase']                           = 'CLASE';
$lang['ventas_registro_controller_lang_input_marca']                                 = 'MARCA:';
$lang['ventas_registro_controller_lang_tooltip_marca']                               = '*SELECCIONA UNA MARCA';
$lang['ventas_registro_controller_lang_placeholder_marca']                           = 'MARCA';
$lang['ventas_registro_controller_lang_input_monto']                                 = '*PRECIO UNITARIO:';
$lang['ventas_registro_controller_lang_tooltip_monto']                               = '*SOLO NÚMEROS CON DECIMALES *CAMPO OBLIGATORIO';
$lang['ventas_registro_controller_lang_placeholder_monto']                           = 'PRECIO UNITARIO';
$lang['ventas_registro_controller_lang_input_cantidad']                              = 'CANTIDAD:';
$lang['ventas_registro_controller_lang_tooltip_cantidad']                            = '*SOLO NÚMEROS *CAMPO OBLIGATORIO';
$lang['ventas_registro_controller_lang_placeholder_cantidad']                        = 'CANTIDAD';
$lang['ventas_registro_controller_lang_input_litros']                                = 'GALONES:';
$lang['ventas_registro_controller_lang_tooltip_litros']                              = '*SELECCIONE UNA OPCIÓN *CAMPO OBLIGATORIO';
$lang['ventas_registro_controller_lang_placeholder_litros']                          = 'GALONES';
$lang['ventas_registro_controller_lang_combo_selecciona_sector']                     = 'SELECCIONA UN SECTOR';
$lang['ventas_registro_controller_lang_combo_selecciona_clase']                      = 'SELECCIONA UNA CLASE';
$lang['ventas_registro_controller_lang_combo_selecciona_marca']                      = 'SELECCIONA UNA MARCA';
$lang['ventas_registro_controller_lang_combo_selecciona_litros']                     = 'SELECCIONA UNA OPCIÓN';
$lang['ventas_registro_controller_lang_boton_agregar']                               = 'AGREGAR';
$lang['ventas_registro_controller_lang_boton_limpiar_carrito']                       = 'LIMPIAR';
$lang['ventas_registro_controller_lang_msg_limpiar_carrito']                         = '¿DESEAS BORRAR TODOS LOS PRODUCTOS?';
$lang['ventas_registro_controller_lang_msg_qr_error']                                = 'EL NÚMERO DE TARJETA O QR ES ERRÓNEO';
$lang['ventas_registro_controller_lang_msg_archivo']                                 = 'EL FORMATO DEL ARCHIVO DEBE SER PNG, JPG, JPEG Y SU TAMAÑO MENOR A 4MB.';
$lang['ventas_registro_controller_lang_msg_archivo_error']                           = 'EL FORMATO DEL ARCHIVO SELECCIONADO NO ES VÁLIDO, POR FAVOR INGRESA UN ARCHIVO PNG, JPG, JPEG MENOR A 4MB.';
$lang['ventas_registro_controller_lang_msg_error_formato_identificacion']            = 'EL FORMATO ES INCORRECTO SOLO SE PERMITE PNG, JPG Y PDF.';
$lang['ventas_registro_controller_lang_msg_error_tamanio_identificacion']            = 'EL TAMAÑO DEL ARCHIVO ES DEMASIADO GRANDE, SOLO SE PERMITE ARCHIVOS MENORES DE 4MB';
$lang['ventas_registro_controller_lang_msg_error_numeros_negativos']                 = 'SOLO SE PERMITEN NÚMEROS POSITIVOS SUPERIOR A CERO';
$lang['ventas_registro_controller_lang_msg_error_marca']                             = 'CAPTURA EL PRECIO UNITARIO, LA CANTIDAD Y GALONES';
$lang['ventas_registro_controller_lang_placeholder_borrar']                          = 'BORRAR';
$lang['ventas_registro_controller_lang_btn_aceptar']                                 = 'ACEPTAR';
$lang['ventas_registro_controller_lang_btn_cancelar']                                = 'CANCELAR';
$lang['ventas_registro_controller_lang_baja_prodcuto_titulo']                        = '¿DESEAS DAR DE BAJA EL PRODUCTO?';
$lang['ventas_registro_controller_lang_etiqueta_maestro_pintor']                     = 'MAESTRO PINTOR: ';
$lang['ventas_registro_controller_lang_js_msg_error_archivo']                        = 'EL CAMPO TICKET ES OBLIGATORIO.';
$lang['ventas_registro_controller_lang_js_msg_error_guardar_venta']                  = 'ERROR, LA VENTA NO FUE GUARDADA';
$lang['ventas_registro_controller_lang_js_msg_venta_guardada_promociones_titulo']    = 'EL TICKET SE REGISTRÓ CORRECTAMENTE CON MONTO TOTAL';
$lang['ventas_registro_controller_lang_js_msg_venta_guardada_promociones_msg']       = '¿TU TICKET CONTIENE PRODUCTOS DE LA PROMOCIÓN?';
$lang['ventas_registro_controller_lang_js_msg_error_guardar_detalle_venta']          = 'FALTA LA CAPTURA DE ARTICULOS';
$lang['ventas_registro_controller_lang_js_msg_error_guardar_ticket_repetido']        = 'EL TICKET YA ESTÁ REGISTRADO EN EL SISTEMA PARA TU DISTRIBUIDOR';
$lang['ventas_registro_controller_lang_btn_si']                                      = 'SI';
$lang['ventas_registro_controller_lang_btn_no']                                      = 'NO';
$lang['ventas_registro_controller_lang_etiqueta_aviso']                                      = 'Recuerda que debes registrar las ventas en el mes que se generan, de lo contrario serán rechazadas en auditoría.<br>Asegúrate de ingresar siempre el precio unitario, este monto es el que suma para tus Maestros Pintores.<br>';
$lang['ventas_registro_controller_lang_etiqueta_aviso_2']                                      = 'Agrega todos los productos de tu ticket dando click en el botón +AGREGAR y al terminar da click en el botón GUARDAR.';
$lang['ventas_registro_controller_lang_input_distribuidor']                          = 'DISTRIBUIDOR:';