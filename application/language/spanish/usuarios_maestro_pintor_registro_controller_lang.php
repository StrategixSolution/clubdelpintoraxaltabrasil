<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['usuarios_maestro_pintor_registro_controller_lang_pagina_titulo']                         = 'REGISTRO DE MAESTRO PINTOR';
$lang['usuarios_maestro_pintor_registro_controller_lang_sub_datos_usuario']                     = 'DATOS MAESTRO PINTOR';
$lang['usuarios_maestro_pintor_registro_controller_lang_sub_datos_direccion']                   = 'DIRECCIÓN';
$lang['usuarios_maestro_pintor_registro_controller_lang_sub_datos_archivos']                    = 'ARCHIVOS';
$lang['usuarios_maestro_pintor_registro_controller_lang_sub_datos_firma']                       = 'FIRMA';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_nombre']                       = '*NOMBRE:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_segundo_nombre']               = 'SEGUNDO NOMBRE:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_apaterno']                     = '*APELLIDO PATERNO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_amaterno']                     = 'APELLIDO MATERNO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_telefono']                     = '*TELÉFONO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_extencion']                    = '*EXTENSIÓN:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_celular']                      = '*CELULAR:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_compañia']                     = '*COMPAÑIA:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_email']                        = '*CORREO ELECTRÓNICO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_puesto']                       = '*PUESTO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_taller']                       = 'NOMBRE DEL TALLER:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_aprox_personas']               = 'PERSONAS EN EL TALLER:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_aprox_autos']                  = 'AUTOS REPARADOS POR SEMANA:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_talla']                        = '*TALLA:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_fecha_nacimiento']             = '*FECHA DE NACIMIENTO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_rfc']                          = 'NIT:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_identificacion']               = '*IDENTIFICACIÓN:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_ciudad']                       = '*CIUDAD:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_codigoqr']                     = '*NÚMERO DE TARJETA:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_frase_identificacion']         = '*SELECCIONA UNA OPCIÓN PARA AGREGAR SU IDENTIFICACIÓN:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_camara']                       = 'CÁMARA';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_archivo']                      = 'ARCHIVO';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_btn_terminos']                 = 'AVISO DE PRIVACIDAD Y TÉRMINOS Y CONDICIONES';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_firma']                        = '"FIRMA"';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_acepto_terminos']              = 'ACEPTO TÉRMINOS Y AVISO DE PRIVACIDAD';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_frase_duenio']                 = '“EL DUEÑO DE LA INFORMACIÓN DEBE DE ACEPTAR”:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_btn_limpiar']                  = 'LIMPIAR';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_btn_guardar']                  = 'GUARDAR';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_nombre']                    = 'NOMBRE';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_segundo_nombre']            = 'SEGUNDO NOMBRE';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_apaterno']                  = 'APELLIDO PATERNO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_amaterno']                  = 'APELLIDO MATERNO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_telefono']                  = 'TELÉFONO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_extencion']                 = 'EXTENSIÓN';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_celular']                   = 'CELULAR';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_compañia']                  = 'SELECCIONA UNA COMPAÑIA';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_email']                     = 'CORREO ELECTRÓNICO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_puesto']                    = 'SELECCIONA UN PUESTO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_taller']                    = 'NOMBRE DEL TALLER';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_aprox_personas']            = 'CANTIDAD DE PERSONAS';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_aprox_autos']               = 'CANTIDAD DE AUTOS';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_talla']                     = 'SELECCIONA UNA TALLA';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_rfc']                       = 'NIT';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_ciudad']                    = 'CIUDAD';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_codigoqr']                  = 'NÚMERO DE TARJETA';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_identificacion']            = 'IDENTIFICACIÓN';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_fecha_nacimiento']          = 'FECHA DE NACIMIENTO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_nombre']                       = '*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_segundo_nombre']               = '*MÁXIMO 100 CARACTERES *SOLO TEXTO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_apaterno']                     = '*MÁXIMO 50 CARACTERES *CAMPO OBLIGATORIO *SOLO TEXTO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_amaterno']                     = '*MÁXIMO 50 CARACTERES *SOLO TEXTO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_telefono']                     = '*MÍNIMO 6 CARACTERES MÁXIMO 20 CARACTERES *CAMPO OBLIGATORIO *SOLO NÚMEROS';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_extencion']                    = '*MÍNIMO 1 CARACTERES MÁXIMO 10 CARACTERES *CAMPO OBLIGATORIO *SOLO NÚMEROS';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_celular']                      = '*MÍNIMO 6 CARACTERES MÁXIMO 15 CARACTERES *CAMPO OBLIGATORIO *SOLO NÚMEROS';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_compañia']                     = '*CAMPO OBLIGATORIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_email']                        = '*FORMATO "usuario@dominio.com" *MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_puesto']                       = '*CAMPO OBLIGATORIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_taller']                       = '*MÁXIMO 100 CARACTERES *ALFANUMÉRICO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_rfc']                          = '*MÍNIMO 4 CARACTERES MÁXIMO 12 *ALFANUMÉRICO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_ciudad']                       = '*MÁXIMO 100 CARACTERES *CAMPO OBLIGATORIO *ALFANUMÉRICO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_aprox_personas']               = '*SOLO NÚMEROS *MÁXIMO 3 CARACTERES';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_aprox_autos']                  = '*SOLO NÚMEROS *MÁXIMO 3 CARACTERES';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_talla']                        = '*CAMPO OBLIGATORIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_fecha_nacimiento']             = '*CAMPO OBLIGATORIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_codigoqr']                     = '*CAMPO OBLIGATORIO *SOLO NÚMEROS';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_identificacion']               = '*FORMATO PNG';
$lang['usuarios_maestro_pintor_registro_controller_lang_alerta_firma_vacia']                    = 'CAPTURA TU FIRMA';
$lang['usuarios_maestro_pintor_registro_controller_lang_alerta_termino']                        = 'ACEPTA LOS TÉRMINOS Y CONDICIONES Y EL AVISO DE PRIVACIDAD';
$lang['usuarios_maestro_pintor_registro_controller_error_rfc']                                  = 'EL CAMPO NIT ES OBLIGATORIO';
$lang['usuarios_maestro_pintor_registro_controller_error_tarjeta']                              = 'EL CAMPO NÚMERO DE TARJETA ES OBLIGATORIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_rfc_repetido']                      = 'EL NIT %1$s YA FUE REGISTRADO';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_email_repetido']                    = 'EL CORREO ELECTRÓNICO %1$s YA FUE REGISTRADO';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_celular_repetido']                  = 'EL CELULAR %1$s YA FUE REGISTRADO';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_uno']               = 'EL NÚMERO DE TARJETA %1$s YA ESTÁ ASIGNADA.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_tres']              = 'EL NÚMERO DE TARJETA %1$s ESTÁ CANCELADO POR REPOSICIÓN.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_cuatro']            = 'EL NÚMERO DE TARJETA %1$s ESTÁ CANCELADO POR ERROR.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_no_existe']         = 'EL NÚMERO DE TARJETA %1$s NO EXISTE.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_maestro_pintor_registrado']         = 'MAESTRO PINTOR REGISTRADO.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_error_envio_correo']                 = 'EL CORREO DE USUARIO NO SE PUDO MANDAR.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_error_archivo_identificacion']      = 'EL ARCHIVO DE IDENTIFICACIÓN NO SE PUDO SUBIR.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_error_formato_identificacion']      = 'EL FORMATO ES INCORRECTO SOLO SE PERMITE PNG, JPG Y PDF.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_error_tamanio_identificacion']      = 'EL TAMAÑO DEL ARCHIVO ES DEMASIADO GRANDE, SOLO SE PERMITE ARCHIVOS MENORES DE 4MB';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_enviar_por']      = 'ENVIAR POR:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_enviar_por_mail']      = 'CORREO ELECTRÓNICO';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_legal_aviso_titulo']      = 'AVISO DE PRIVACIDAD - TÉRMINOS Y CONDICIONES';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_welcome']      = 'Bienvenido a Axalta Club del Pintor Brasil';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_1']      = 'Es un honor tenerte como parte del Club del Pintor, donde reconocemos tu esfuerzo y lealtad.';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_2']      = 'Con gusto atenderemos tus dudas sobre el programa de incentivos, promociones, resultados o temas relacionados con el funcionamiento del sitio, desde la página del programa <a href="https://www.clubdelpintoraxaltabrasil.com.br" style="mso-line-height-rule:exactly;text-decoration:none;color:#2690CE;font-size:14px">www.clubdelpintoraxaltabrasil.com.br</a> en la pestaña de contacto.';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_user']    = 'Usuario: ';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_pass']    = 'Contraseña: ';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_button_1']    = 'Club del Pintor';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_3']      = '¿Conoces las reglas del programa?';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_button_2']    = 'Ir al sitio';

$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_legal_aviso_texto']      = '
<h2>TÉRMINOS Y CONDICIONES DE USO</h2>
<p>
    El uso de cualquier beneficio....
</p>
<p>
    Los presentes Términos y Condiciones .....
</p>
<p>
    Axalta podrá prestar los beneficios .....
</p>
<p>
    Los términos “usted”, “usuario” y cualquier ......
</p>
<h3>
I.	Consentimiento de los Términos y Condiciones
</h3>
<p>
    Al crear una cuenta de usuario ....
</p>
<p>
    Tome en cuenta que, ....
</p>
<p>
    Axalta podrá modificar e.....
</p>
<p>
    El uso del Programa ....
</p>
<h3>
    II.	Verificación de identidad
</h3>
<p>
    El uso de su cuenta de ....
</p>
<p>
    Usted se encuentra ....
</p>
<h3>
    III.	Uso de la Tarjeta Club del Pintor y demás beneficios del Programa
</h3>
<p>
    Al contar con la Tarjeta ....
</p>
<p>
    Usted es responsable ....
</p>
<p>
    Los beneficios generados .....
</p>
<p>
    Los Distribuidores deberán ...
</p>
<p>
    En caso de pérdida ....
</p>
';
