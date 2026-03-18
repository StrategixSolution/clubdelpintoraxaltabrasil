<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');


$lang['usuarios_actualizar_datos_controller_lang_pagina_titulo']                            = 'ACTUALIZAR DATOS DE USUARIO';
$lang['usuarios_actualizar_datos_controller_lang_input_nombre']                             = '*NOMBRE:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_nombre']                       = 'NOMBRE';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_nombre']                           = '*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO ';
$lang['usuarios_actualizar_datos_controller_lang_input_segundo_nombre']                     = 'SEGUNDO NOMBRE:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_segundo_nombre']               = 'SEGUNDO NOMBRE';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_segundo_nombre']                   = '*MÁXIMO 50 CARACTERES *SOLO TEXTO ';
$lang['usuarios_actualizar_datos_controller_lang_input_apellido_paterno']                   = '*APELLIDO PATERNO:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_apellido_paterno']             = 'APELLIDO PATERNO';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_apellido_paterno']                 = '*MÁXIMO 50 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO ';
$lang['usuarios_actualizar_datos_controller_lang_input_apellido_materno']                   = 'APELLIDO MATERNO:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_apellido_materno']             = 'APELLIDO MATERNO';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_apellido_materno']                 = '*MÁXIMO 50 CARACTERES *SOLO TEXTO ';
$lang['usuarios_actualizar_datos_controller_lang_input_email']                              = '*CORREO ELECTRÓNICO:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_email']                        = 'CORREO ELECTRÓNICO';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_email']                            = '*FORMATO "usuario@dominio.com" *MÁXIMO 50 CARACTERES *CAMPO OBLIGATORIO ';
$lang['usuarios_actualizar_datos_controller_lang_msg_email_repetido']                       = 'EL CORREO ELECTRÓNICO %1$s YA EXISTE EN LA BASE DE DATOS FAVOR DE CAPTURAR OTRO';
$lang['usuarios_actualizar_datos_controller_lang_input_telefono']                           = 'TELÉFONO:';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_telefono']                         = '*DEBE SER 10 CARACTERES *SOLO NÚMEROS';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_telefono']                     = 'TELÉFONO';
$lang['usuarios_actualizar_datos_controller_lang_input_extencion']                          = 'EXTENSIÓN:';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_extencion']                        = '*MÁXIMO 10 - MÍNIMO 3 CARACTERES *SOLO NÚMEROS';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_extencion']                    = 'EXTENSIÓN';
$lang['usuarios_actualizar_datos_controller_lang_input_celular']                            = 'CELULAR:';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_celular']                          = '*DEBE SER 10 CARACTERES *SOLO NÚMEROS *AGREGAR EL LADA SIN ESPACIOS';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_celular']                      = 'CELULAR';
$lang['usuarios_actualizar_datos_controller_lang_msg_celular_repetido']                     = 'EL CELULAR %1$s YA EXISTE EN LA BASE DE DATOS FAVOR DE CAPTURAR OTRO';
$lang['usuarios_actualizar_datos_controller_lang_input_rfc']                                = 'RFC:';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_rfc']                              = '*MÍNIMO 4 CARACTERES MÁXIMO 12 *ALFANUMÉRICO';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_rfc']                          = 'RFC';
$lang['usuarios_actualizar_datos_controller_lang_input_clave']                              = '*CLAVE:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_clave']                        = 'CLAVE';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_clave']                            = '*MÁXIMO 20 CARACTERES *CAMPO OBLIGATORIO *LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UNA LETRA MINÚSCULA, UNA LETRA MAYÚSCULA,UN CARÁCTER NUMÉRICO';
$lang['usuarios_actualizar_datos_controller_lang_msg_rfc_repetido']                         = 'EL RFC %1$s YA EXISTE EN LA BASE DE DATOS FAVOR DE CAPTURAR OTRO';
$lang['usuarios_actualizar_datos_controller_lang_boton_guardar']                            = 'ACTUALIZAR';
$lang['usuarios_actualizar_datos_controller_lang_boton_regresar']                           = 'REGRESAR';
$lang['usuarios_actualizar_datos_controller_lang_boton_salir']                              = 'SALIR';
$lang['usuarios_actualizar_datos_controller_lang_js_confirm_boton_aprobado']                = 'ACEPTAR';
$lang['usuarios_actualizar_datos_controller_lang_js_confirm_boton_rechazado']               = 'RECHAZAR';
$lang['usuarios_actualizar_datos_controller_lang_js_confirm_titulo']                        = 'VALIDACIÓN DE DATOS';
$lang['usuarios_actualizar_datos_controller_lang_js_confirm_texto']                         = '¿LOS DATOS CAPTURADOS SON CORRECTOS?';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_limite_participante']               = 'HAS LLEGADO AL LÍMITE DE USUARIOS POR PERFIL';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_participante_inserto']              = 'ACTUALIZACIÓN CORRECTA';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_participante_no_inserto']           = 'PARTICIPANTE NO SE GUARDADO SATISFACTORIAMENTE';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_participante_error_corroe']         = 'EL CORREO NO SE ENVIÓ, FAVOR DE CONTACTAR A contacto@fandeliconmigo.com';
$lang['usuarios_actualizar_datos_controller_lang_js_titulo_swal_error']                     = 'ERROR DE ENVIÓ DE CORREO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_error']                        = 'ERROR';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_guardado']                     = 'GUARDADO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_ok']                           = 'OK';
$lang['usuarios_actualizar_datos_controller_lang_validar']                                  = 'VALIDAR';
$lang['usuarios_actualizar_datos_controller_lang_espera']                                   = 'ESPERA';
$lang['usuarios_actualizar_datos_controller_lang_validado']                                 = 'VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_email']                = 'EL CORREO NO HA SIDO VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_celular']              = 'EL NÚMERO CELULAR NO HA SIDO VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_nueva_valida_clave_nueva_confirma_msg_min']= 'LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UNA LETRA MINÚSCULA';
$lang['usuarios_actualizar_datos_controller_lang_nueva_valida_clave_nueva_confirma_msg_may']= 'LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UNA LETRA MAYÚSCULA';
$lang['usuarios_actualizar_datos_controller_lang_nueva_valida_clave_nueva_confirma_msg_num']= 'LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UN CARÁCTER NUMÉRICO';
$lang['usuarios_actualizar_datos_controller_lang_mail_titulo']                              = 'VALIDACIÓN DE CORREO ELECTRÓNICO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_email_activo']         = 'SE HA ENVIADO UN CORREO ELECTRÓNICO PARA ACTIVAR SU CORREO, ESPERE 10 MINUTOS PARA VOLVER A ENVIAR OTRO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_email_enviado']        = 'SE HA ENVIADO UN CORREO ELECTRÓNICO PARA VALIDAR, ESPERE 10 MINUTOS PARA VOLVER A ENVIAR OTRO';
$lang['usuarios_actualizar_datos_controller_lang_mail_texto1']                              = 'Estimado';
$lang['usuarios_actualizar_datos_controller_lang_mail_texto2']                              = 'Para validar el correo eléctronico, solo da clic en el siguiente link:';
$lang['usuarios_actualizar_datos_controller_lang_mail_fuera_tiempo']                        = 'YA PASARON LOS 10 MINUTOS, FAVOR DE REENVIAR LA VALIDACIÓN';
$lang['usuarios_actualizar_datos_controller_lang_mail_valido']                              = 'SU CORREO ELECTRÓNICO FUE VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_mail_no_token']                            = 'ERROR ESTA ACCIÓN NO ESTÁ PERMITIDA';
$lang['usuarios_actualizar_datos_controller_lang_mail_ya_valido']                           = 'SU CORREO ELÉCTRONIO YA FUE VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_msg_email_repetido']                       = 'EL CORREO ELÉCTRONIO CAPTURADO YA ESTÁ EN EL SISTEMA';
$lang['usuarios_actualizar_datos_controller_lang_msg_celular_repetido']                     = 'EL CELULAR CAPTURADO YA ESTÁ EN EL SISTEMA';