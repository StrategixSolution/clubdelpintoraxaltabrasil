<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                           * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['usuarios_recupera_clave_controller_lang_titulo']                                                  = 'RECUPERA TU CONTRASEÑA';
$lang['usuarios_recupera_clave_controller_lang_nueva_titulo']                                            = 'GENERA TU NUEVA CONTRASEÑA';
$lang['usuarios_recupera_clave_controller_lang_msg_email']                                               = 'INTRODUCE EL CORREO ELECTRÓNICO CON EL QUE TE REGISTRASTE PARA RECUPERAR TU CONTRASEÑA.';
$lang['usuarios_recupera_clave_controller_lang_msg_whatsapp']                                            = 'INTRODUCE EL NÚMERO DE TU MÓVIL CON EL QUE TE REGISTRASTE PARA RECUPERAR TU CONTRASEÑA, JUNTO CON SU CÓDIGO DE ÁREA.';
$lang['usuarios_recupera_clave_controller_lang_instruciones_captcha']                                    = 'ESCRIBE EL CAPTCHA';
$lang['usuarios_recupera_clave_controller_lang_input_correo_electronico_placeholder']                    = 'ESCRIBE EL CORREO ELECTRÓNICO';
$lang['usuarios_recupera_clave_controller_lang_input_whatsapp_placeholder']                              = 'ESCRIBE EL NÚMERO DE WHATSAPP';
$lang['usuarios_recupera_clave_controller_lang_input_captcha_placeholder']                               = 'ESCRIBE EL CAPTCHA';
$lang['usuarios_recupera_clave_controller_lang_btn_login']                                               = 'REGRESAR A LOGIN';
$lang['usuarios_recupera_clave_controller_lang_js_error_usuario']                                        = 'USUAIRO NO VALIDO';
$lang['usuarios_recupera_clave_controller_lang_msg_btn_ok']                                              = 'OK';
$lang['usuarios_recupera_clave_controller_lang_js_msg_text_email']                                       = 'SE HA ENVIADO UN CORREO ELECTRÓNICO A TU CUENTA CON LAS INSTRUCCIONES PARA RESTAURAR TU CONTRASEÑA, El CORREO CONTIENE UN LINK QUE SOLO SERÁ VÁLIDO POR 60 MINUTOS.';
$lang['usuarios_recupera_clave_controller_lang_js_msg_text_whatsapp']                                    = 'SE HA ENVIADO UN WHATSAPP A TU MÓVIL CON LAS INSTRUCCIONES PARA RESTAURAR TU CONTRASEÑA, El MENSAJE CONTIENE UN LINK QUE SOLO SERÁ VÁLIDO POR 60 MINUTOS.';
$lang['usuarios_recupera_clave_controller_lang_correo_invalido']                                         = 'EL CORREO ELECTRÓNICO NO ES VÁLIDO';
$lang['usuarios_recupera_clave_controller_lang_msg_validacion_correo_electronico']                       = 'CORREO ELECTRÓNICO';
$lang['usuarios_recupera_clave_controller_lang_whatsapp_invalido']                                       = 'EL WHATSAPP NO ES VÁLIDO';
$lang['usuarios_recupera_clave_controller_lang_msg_validacion_whatsapp']                                 = 'WHATSAPP';
$lang['usuarios_recupera_clave_controller_lang_msg_validacion_captcha']                                  = 'CAPTCHA';
$lang['usuarios_recupera_clave_controller_lang_titulo_crea_clave']                                       = 'ACCESO DENEGADO';
$lang['usuarios_recupera_clave_controller_lang_msg_acceso_denegado']                                     = 'ACCIÓN ILEGAL, NO SE TIENE PERMISO PARA ACCEDER A ESTA SECCIÓN.';
$lang['usuarios_recupera_clave_controller_lang_msg_tiempo_caduco']                                       = 'EL TIEMPO DE RESTAURACIÓN PARA REGENERAR LA CONTRASEÑA A CADUCADO, REANUDA EL PROCESO.';
$lang['usuarios_recupera_clave_controller_lang_msg_btn_guardar']                                         = 'GUARDAR';
$lang['usuarios_recupera_clave_controller_lang_nueva_instrucciones']                                     = 'INTRODUCE TU NUEVA CONTRASEÑA, MÍNIMO 6 CARACTERES, DEBERÁ CONTENER UNA LETRA MAYÚSCULA, UNA MINÚSCULA Y UN NÚMERO:';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva']                                       = 'CONTRASEÑA NUEVA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_placeholder']                           = 'CONTRASEÑA NUEVA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_error']                                 = 'CONTRASEÑA NUEVA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_confirma']                              = 'CONFIRMA LA CONTRASEÑA NUEVA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_confirma_placeholder']                  = 'CONFIRMA LA CONTRASEÑA NUEVA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_confirma_error']                        = 'CONFIRMA LA CONTRASEÑA NUEVA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_msg_min']                        = 'LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UNA LETRA MINÚSCULA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_msg_may']                        = 'LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UNA LETRA MAYÚSCULA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_msg_num']                        = 'LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UN CARÁCTER NUMÉRICO';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_confirma_msg_min']               = 'LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UNA LETRA MINÚSCULA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_confirma_msg_may']               = 'LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UNA LETRA MAYÚSCULA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_confirma_msg_num']               = 'LA CONTRASEÑA NUEVA DEBE TENER AL MENOS UN CARÁCTER NUMÉRICO';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_confirma_no_concuerdan']         = 'LAS CONTRASEÑAS TECLEADAS NO SON IGUALES.';
$lang['usuarios_recupera_clave_controller_lang_nueva_actualizada']                                       = 'LA CONTRASEÑA HA SIDO RESTAURADA.';
$lang['usuarios_recupera_clave_controller_lang_mail_titulo']                                             = 'RECUPERACIÓN DE CONTRASEÑA';
$lang['usuarios_recupera_clave_controller_lang_mail_texto1']                                             = 'Estimado';
$lang['usuarios_recupera_clave_controller_lang_mail_texto2']                                             = 'Para poder recuperar tu contraseña, solo da clic en el siguiente link:';
$lang['usuarios_recupera_clave_controller_lang_mail_texto3']                                             = 'El link solo será válido por <b>1 Hora</b>, después de ese tiempo, tendrás que comunicarte con nuestro equipo de atención a clientes para poder recuperar tu cuenta.';
$lang['usuarios_recupera_clave_controller_lang_mail_texto4']                                             = 'Recuerda que es importante preservar la seguridad de tu cuenta, por lo que te recomendamos no compartir tu contraseña y recordarla para evitar contratiempos';
$lang['usuarios_recupera_clave_controller_lang_mail_texto5']                                             = 'Atte:<br>Administración del Programa ';
$lang['usuarios_recupera_clave_controller_lang_mail_link']                                               = 'Recuperar Contraseña';
$lang['usuarios_recupera_clave_controller_lang_msg_captcha_erroneo']                                     = 'CAPTCHA ERRONEO';
$lang['usuarios_recupera_clave_controller_lang_marca']                                               = 'Axalta® Pinturas';
$lang['usuarios_recupera_clave_controller_lang_label_check_mail']                                               = 'CORREO ELECTRÓNICO';
$lang['usuarios_recupera_clave_controller_lang_label_check_whatsapp']                                               = 'WHATSAPP';
$lang['usuarios_recupera_clave_controller_lang_label_button_send']                                               = 'ENVIAR';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_titulo']                                                = 'RECUPERACIÓN DE CONTRASEÑA';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_link']                                                  = 'RECUPERAR CONTRASEÑA';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_linea_1']                                               = 'Para poder recuperar tu contraseña, solo da clic en el siguiente link:';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_linea_2']                                               = 'El link solo será válido por <b>1 Hora</b>, después de ese tiempo, tendrás que comunicarte con nuestro equipo de atención a clientes para poder recuperar tu cuenta.';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_linea_3']                                               = 'Recuerda que es importante preservar la seguridad de tu cuenta, por lo que te recomendamos no compartir tu contraseña y recordarla para evitar contratiempos';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_linea_4']                                               = 'Atte:<br>Administración del Programa ';