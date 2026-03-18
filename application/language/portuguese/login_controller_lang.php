<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['login_controller_lang_input_usuario']                                    = 'USUÁRIO:';
$lang['login_controller_lang_input_placeholder_usuario']                        = 'USUÁRIO';
$lang['login_controller_lang_input_tooltip_usuario']                            = '*O CAMPO É OBRIGATÓRIO *MAIS DE QUATRO DÍGITOS *SEM ESPAÇOS';
$lang['login_controller_lang_input_clave']                                      = 'SENHA:';
$lang['login_controller_lang_input_placeholder_clave']                          = 'SENHA';
$lang['login_controller_lang_input_tooltip_clave']                              = '*O CAMPO É OBRIGATÓRIO *MAIS DE SEIS DÍGITOS *SEM ESPAÇOS';
$lang['login_controller_lang_btn_ingresar']                                     = 'ENTRAR';
$lang['login_controller_lang_usuario_erroneo']                                  = 'USUÁRIO INCORRETO';
$lang['login_controller_lang_usuario_captcha_erroneo']                          = 'FOI DETECTADO QUE É UM ROBÔ';
$lang['login_controller_lang_input_captcha']                                    = 'DIGITE O CAPTCHA';
$lang['login_controller_lang_captcha_erroneo']                                  = 'CAPTCHA INCORRETO';
$lang['login_controller_lang_captcha_tooltip']                                  = '*O CAMPO É OBRIGATÓRIO';
$lang['login_controller_lang_recupera_clave']                                   = 'RECUPERE SUA SENHA';
$lang['login_controller_lang_copyright']                                        = 'company® ';
$lang['login_controller_lang_cookie_titulo']                                    = 'AVISO DE COOKIES';
$lang['login_controller_lang_cookie_texto']                                     = 'UTILIZAMOS COOKIES PRÓPRIOS E DE TERCEIROS PARA MELHORAR NOSSOS SERVIÇOS.';
$lang['login_controller_lang_cookie_btn_acuerdo']                               = 'DE ACORDO';
$lang['login_controller_lang_cookie_btn_aviso_cookie']                          = 'AVISO DE COOKIES';
$lang['login_controller_lang_cookie_aviso_cookie_cerrar']                       = 'FECHAR';
$lang['login_controller_lang_cookie_aviso_cookie_acepto']                       = 'ACEITO';
$lang['login_controller_lang_registro']                                         = 'REGISTRO';
$lang['login_controller_lang_marca']                                            = 'Axalta® Pinturas';
$lang['login_controller_lang_ingreso_marca']                                    = 'Entre com sua conta';
$lang['login_controller_lang_input_label_clave']                                = '*O CAMPO É OBRIGATÓRIO *MAIS DE 5 DÍGITOS *SEM ESPAÇO';
$lang['login_controller_lang_enlace_responsive_1']                              = 'Quer fazer parte do Clube do Pintor?';
$lang['login_controller_lang_enlace_responsive_2']                              = 'Cadastre-se aqui!';
$lang['login_controller_lang_informacion_cookies']                              = 
'<p>Em nosso site utilizamos "cookies". Os cookies são pequenos arquivos de dados que são armazenados no disco rígido do seu computador ou do dispositivo de comunicação eletrônica que você utiliza quando navega em nosso site. Esses arquivos de dados permitem trocar informações de estado entre nosso site e o navegador que você utiliza. As "informações de estado" podem revelar meios de identificação de sessão, meios de autenticação ou suas preferências como usuário, bem como qualquer outro dado armazenado pelo navegador em relação ao site.</p>
        <p>Os cookies nos permitem monitorar o comportamento de um usuário on-line. Utilizamos as informações obtidas por meio de cookies para nos ajudar a otimizar sua experiência no site. Por meio do uso de cookies podemos, por exemplo, personalizar em seu favor nossa página inicial de forma que nossas telas sejam exibidas de maneira mais adequada de acordo com o tipo de navegador. Os cookies também nos permitem oferecer recomendações personalizadas.</p>
        <p>Os cookies não são spyware, e a Axalta não coleta dados de vários sites nem compartilha com terceiros as informações obtidas por meio de cookies.</p>
        <p>Como a maioria dos sites, nossos servidores registram seu endereço IP, a URL a partir da qual acessou nosso site, o tipo de navegador e a data e hora de suas compras e outras atividades. Utilizamos essas informações para administração do sistema, solução de problemas técnicos, investigação de fraudes e para nossas comunicações com você.</p>
        <p>Por fim, informamos que o site utiliza web BEACONS. Os web BEACONS também nos permitem monitorar seu comportamento em meios eletrônicos. Utilizamos web BEACONS para determinar quando e quantas vezes uma página foi visualizada. Utilizamos essas informações para fins de marketing, mas somente para nossas próprias práticas de marketing.</p>
            
        <p>Seu navegador aceitará os cookies e permitirá a coleta automática de informações, a menos que você altere as configurações padrão do navegador. A maioria dos navegadores web permite que você gerencie suas preferências de cookies.</p>
        <p>Você pode ajustar seu navegador para recusar ou excluir cookies. Os links a seguir mostram como ajustar as configurações do navegador nos navegadores mais utilizados:</p>
        <p><a href="https://support.mozilla.org/pt/kb/impedir-que-los-sitios-web-guarden-sus-preferencia" target="_blank">FIREFOX</a></p>
        <p><a href="https://support.apple.com/pt-br/guide/safari/sfri11471/mac#:~:text=En%20la%20app%20Safari%20del,%E2%80%9CImpedir%20seguimiento%20entre%20sitios%E2%80%9D" target="_blank">SAFARI</a></p>
        <p><a href="https://support.google.com/chrome/answer/95647?hl=pt" target="_blank">CHROME</a></p>
        <p>Se os cookies do site forem desativados, nosso site não será carregado corretamente.</p>
        <br>
        <table class="table table-bordered">
        	<thead>
                    <tr>
                        <th>Categorias de Cookies</th>
                        <th>Por que utilizamos esses cookies?</th>
                    </tr>
        	</thead>
        	<tbody>
                    <tr>
                        <td>Técnicos</td>
                        <td>São cookies necessários para o funcionamento de um site. Incluem, por exemplo, cookies que permitem que você faça login em áreas seguras.</td>
                    </tr>
                    <tr>
                        <td>Análise</td>
                        <td>Esses cookies nos permitem entender melhor como nossos usuários interagem com nosso site. Eles nos permitem reconhecer e contar o número de visitas e saber como os usuários navegam no site. Esses cookies nos ajudam a melhorar o funcionamento do site, por exemplo, garantindo que os usuários encontrem facilmente o que procuram. Podemos usar esses cookies para saber mais sobre quais funcionalidades são mais populares entre nossos usuários e onde precisamos melhorar.</td>
                    </tr>
        	</tbody>
        </table>
        
        <br>
        <p>Se em algum momento você decidir revogar seu consentimento para o uso de Cookies, isso significa que novos Cookies não serão adicionados. No entanto, você deverá excluir os Cookies existentes em seu navegador. Para isso, consulte a seção de ajuda ou o site oficial do seu navegador.</p>
        <p>Configuração de cookies</p>
        <p>Utilizamos cookies próprios e de terceiros para analisar nossos serviços e exibir publicidade relacionada às suas preferências com base em um perfil elaborado a partir de seus hábitos de navegação (por exemplo, páginas visitadas). Você pode obter mais informações e configurar suas preferências.</p>
            
        <p>Necessários</p>
        <p>Os cookies necessários são absolutamente essenciais para que o site funcione corretamente. Esta categoria inclui apenas cookies que garantem funcionalidades básicas e características de segurança do site. Esses cookies não armazenam nenhuma informação pessoal.</p>';