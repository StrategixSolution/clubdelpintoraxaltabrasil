<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['login_controller_lang_input_usuario']                                    = 'USUARIO:';
$lang['login_controller_lang_input_placeholder_usuario']                        = 'USUARIO';
$lang['login_controller_lang_input_tooltip_usuario']                            = '*El CAMPO ES OBLIGATORIO *MAYOR A CUATRO DÍGITOS *SIN ESPACIOS';
$lang['login_controller_lang_input_clave']                                      = 'CONTRASEÑA:';
$lang['login_controller_lang_input_placeholder_clave']                          = 'CONTRASEÑA';
$lang['login_controller_lang_input_tooltip_clave']                              = '*El CAMPO ES OBLIGATORIO *MAYOR A SEIS DÍGITOS *SIN ESPACIOS';
$lang['login_controller_lang_btn_ingresar']                                     = 'INGRESAR';
$lang['login_controller_lang_usuario_erroneo']                                  = 'USUARIO INCORRECTO';
$lang['login_controller_lang_usuario_captcha_erroneo']                          = 'SE DETECTA QUE ES UN ROBOT';
$lang['login_controller_lang_input_captcha']                                    = 'ESCRIBA EL CAPTCHA';
$lang['login_controller_lang_captcha_erroneo']                                  = 'CAPTCHA ERRÓNEO';
$lang['login_controller_lang_captcha_tooltip']                                  = '*El CAMPO ES OBLIGATORIO';
$lang['login_controller_lang_recupera_clave']                                   = 'RECUPERA TU CONTRASEÑA';
$lang['login_controller_lang_copyright']                                        = 'company® ';
$lang['login_controller_lang_cookie_titulo']                                    = 'AVISO DE COOKIES';
$lang['login_controller_lang_cookie_texto']                                     = 'UTILIZAMOS COOKIES PROPIAS Y DE TERCEROS PARA MEJORAR NUESTROS SERVICIOS.';
$lang['login_controller_lang_cookie_btn_acuerdo']                               = 'DE ACUERDO';
$lang['login_controller_lang_cookie_btn_aviso_cookie']                          = 'AVISO DE COOKIES';
$lang['login_controller_lang_cookie_aviso_cookie_cerrar']                       = 'CERRAR';
$lang['login_controller_lang_cookie_aviso_cookie_acepto']                       = 'ACEPTO';
$lang['login_controller_lang_registro']                                         = 'REGISTRO';
$lang['login_controller_lang_marca']                                            = 'Axalta® Pinturas';
$lang['login_controller_lang_ingreso_marca']                                    = 'Ingrese con su cuenta';
$lang['login_controller_lang_input_label_clave']                                = '*EL CAMPO ES OBLIGATORIO *MAYOR A 5 DÍGITOS *SIN ESPACIO';
$lang['login_controller_lang_enlace_responsive_1']                                = '¿Quieres formar parte del Club del Pintor?';
$lang['login_controller_lang_enlace_responsive_2']                                = '¡Regístrate aquí!';
$lang['login_controller_lang_informacion_cookies']                              = 
'<p>En nuestro Sitio web utilizamos "cookies". Las cookies son pequeños archivos de datos que se almacenan en el disco duro de su equipo de cómputo o del dispositivo de comunicación electrónica que usted utiliza cuando navega en nuestro Sitio. Estos archivos de datos permiten intercambiar información de estado entre nuestro Sitio web y el navegador que usted utiliza. La "información de estado" puede revelar medios de identificación de sesión, medios de autenticación o sus preferencias como usuario, así como cualquier otro dato almacenado por el navegador respecto del Sitio web.</p>
        <p>Las cookies nos permiten monitorear el comportamiento de un usuario en línea. Utilizamos la información que es obtenida a través de cookies para ayudarnos a optimizar su experiencia en el sitio. A través del uso de cookies podemos, por ejemplo, personalizar en su favor nuestra página de inicio de manera que nuestras pantallas se desplieguen de mejor manera de acuerdo con su tipo de navegador. Las cookies también nos permiten ofrecerle recomendaciones personalizadas.</p>
        <p>Las cookies no son software espía, y Axalta no recopila datos de múltiples sitios o comparte con terceros la información que obtenemos a través de cookies.</p>
        <p>Como la mayoría de los sitios web, nuestros servidores registran su dirección IP, la dirección URL desde la que accedió a nuestro Sitio web, el tipo de navegador, y la fecha y hora de sus compras y otras actividades. Utilizamos esta información para la administración del sistema, solución de problemas técnicos, investigación de fraudes y para nuestras comunicaciones con usted.</p>
        <p>Por último, le informamos que el Sitio web utiliza web BEACONS. Los webs BEACONS también nos permiten monitorear su comportamiento en medios electrónicos Utilizamos web BEACONS para determinar cuándo y cuántas veces una página ha sido vista. Utilizamos esta información para fines de mercadotecnia, pero únicamente para nuestras propias prácticas de mercadotecnia.</p>
            
        <p>Su navegador aceptará las cookies y permitirá la recolección automática de información a menos que usted cambie la configuración predeterminada del navegador. La mayoría de los navegadores web permiten que usted pueda gestionar sus preferencias de cookies.</p>
        <p>Puede ajustar su navegador para que rechace o elimine cookies. Los siguientes links muestran como ajustar la configuración del navegador de los navegadores que son utilizados con más frecuencia:</p>
        <p><a href="https://support.mozilla.org/es/kb/impedir-que-los-sitios-web-guarden-sus-preferencia" target="_blank">FIREFOX</a></p>
        <p><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac#:~:text=En%20la%20app%20Safari%20del,%E2%80%9CImpedir%20seguimiento%20entre%20sitios%E2%80%9D" target="_blank">SAFARI</a></p>
        <p><a href="https://support.google.com/chrome/answer/95647?hl=es" target="_blank">CHROME</a></p>
        <p>Si se inhabilitan las cookies del Sitio web, nuestro Sitio no se cargará apropiadamente.</p>
        <br>
        <table class="table table-bordered">
        	<thead>
                    <tr>
                        <th>Categorías de Cookies</th>
                        <th>¿Por qué utilizamos estas cookies?</th>
                    </tr>
        	</thead>
        	<tbody>
                    <tr>
                        <td>Técnicas</td>
                        <td>Son cookies necesarias para el funcionamiento de un sitio web. Incluyen, por ejemplo, cookies que le permiten iniciar sesión en áreas seguras.</td>
                    </tr>
                    <tr>
                        <td>Análisis</td>
                        <td>Estas cookies nos permiten entender mejor cómo interactúan nuestros usuarios con nuestro sitio web. Nos permiten reconocer y contar el número de visitas y saber cómo navegan en un sitio web cuando lo utilizan. Estas cookies nos ayudan a mejorar el modo en que funciona un sitio web, por ejemplo, garantizando que los usuarios encuentren lo que buscan fácilmente. Podemos utilizar estas cookies para conocer más sobre qué funcionalidades son las más populares entre nuestros usuarios y dónde necesitamos mejorar.</td>
                    </tr>
        	</tbody>
        </table>
        
        <br>
        <p>Si en algún momento decides revocar tu consentimiento para el uso de Cookies, esto significa que no se agregarán nuevas Cookies. Sin embargo, deberás eliminar las Cookies existentes en tu navegador. Para hacerlo, consulta la sección de ayuda o el sitio oficial de tu navegador.</p>
        <p>Configuración de cookies</p>
        <p>Utilizamos cookies propias y de terceros para analizar nuestros servicios y mostrarte publicidad relacionada con tus preferencias en base a un perfil elaborado a partir de tus hábitos de navegación (por ejemplo, páginas visitadas). Puedes obtener más información y configurar tus preferencias.</p>
            
        <p>Necesarias</p>
        <p>Las cookies necesarias son absolutamente esenciales para que el sitio web funcione correctamente. Esta categoría solo incluye cookies que garantizan funcionalidades básicas y características de seguridad del sitio web. Estas cookies no almacenan ninguna información personal.</p>';