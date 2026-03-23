<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['usuarios_maestro_pintor_registro_controller_lang_pagina_titulo'] = 'CADASTRO DE MESTRE PINTOR';
$lang['usuarios_maestro_pintor_registro_controller_lang_sub_datos_usuario'] = 'DADOS DO MESTRE PINTOR';
$lang['usuarios_maestro_pintor_registro_controller_lang_sub_datos_direccion'] = 'ENDEREÇO';
$lang['usuarios_maestro_pintor_registro_controller_lang_sub_datos_archivos'] = 'ARQUIVOS';
$lang['usuarios_maestro_pintor_registro_controller_lang_sub_datos_firma'] = 'ASSINATURA';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_nombre'] = '*NOME:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_segundo_nombre'] = 'SEGUNDO NOME:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_apaterno'] = '*SOBRENOME PATERNO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_amaterno'] = 'SOBRENOME MATERNO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_telefono'] = '*TELEFONE:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_extencion'] = '*RAMAL:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_celular'] = '*CELULAR:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_compania'] = '*EMPRESA:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_email'] = '*E-MAIL:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_puesto'] = '*CARGO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_taller'] = 'NOME DA OFICINA:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_aprox_personas'] = 'PESSOAS NA OFICINA:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_aprox_autos'] = 'CARROS REPARADOS POR SEMANA:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_talla'] = '*TAMANHO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_fecha_nacimiento'] = '*DATA DE NASCIMENTO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_rfc'] = 'NIT:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_identificacion'] = '*IDENTIFICAÇÃO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_ciudad'] = '*CIDADE:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_codigoqr'] = '*NÚMERO DO CARTÃO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_frase_identificacion'] = '*SELECIONE UMA OPÇÃO PARA ADICIONAR SUA IDENTIFICAÇÃO:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_camara'] = 'CÂMERA';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_archivo'] = 'ARQUIVO';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_btn_terminos'] = 'AVISO DE PRIVACIDADE E TERMOS E CONDIÇÕES';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_firma'] = '"ASSINATURA"';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_acepto_terminos'] = 'ACEITO OS TERMOS E O AVISO DE PRIVACIDADE';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_frase_duenio'] = '"O PROPRIETÁRIO DAS INFORMAÇÕES DEVE ACEITAR":';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_btn_limpiar'] = 'LIMPAR';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_btn_guardar'] = 'SALVAR';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_nombre'] = 'NOME';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_segundo_nombre'] = 'SEGUNDO NOME';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_apaterno'] = 'SOBRENOME PATERNO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_amaterno'] = 'SOBRENOME MATERNO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_telefono'] = 'TELEFONE';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_extencion'] = 'RAMAL';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_celular'] = 'CELULAR';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_compania'] = 'SELECIONE UMA EMPRESA';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_email'] = 'E-MAIL';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_puesto'] = 'SELECIONE UM CARGO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_taller'] = 'NOME DA OFICINA';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_aprox_personas'] = 'QUANTIDADE DE PESSOAS';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_aprox_autos'] = 'QUANTIDADE DE CARROS';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_talla'] = 'SELECIONE UM TAMANHO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_rfc'] = 'NIT';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_ciudad'] = 'CIDADE';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_codigoqr'] = 'NÚMERO DO CARTÃO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_identificacion'] = 'IDENTIFICAÇÃO';
$lang['usuarios_maestro_pintor_registro_controller_lang_placeholder_fecha_nacimiento'] = 'DATA DE NASCIMENTO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_nombre'] = '*MÁXIMO 100 CARACTERES *CAMPO OBRIGATÓRIO *SOMENTE TEXTO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_segundo_nombre'] = '*MÁXIMO 100 CARACTERES *SOMENTE TEXTO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_apaterno'] = '*MÁXIMO 50 CARACTERES *CAMPO OBRIGATÓRIO *SOMENTE TEXTO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_amaterno'] = '*MÁXIMO 50 CARACTERES *SOMENTE TEXTO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_telefono'] = '*MÍNIMO 6 CARACTERES MÁXIMO 20 CARACTERES *CAMPO OBRIGATÓRIO *SOMENTE NÚMEROS';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_extencion'] = '*MÍNIMO 1 CARACTERE MÁXIMO 10 CARACTERES *CAMPO OBRIGATÓRIO *SOMENTE NÚMEROS';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_celular'] = '*MÍNIMO 6 CARACTERES MÁXIMO 15 CARACTERES *CAMPO OBRIGATÓRIO *SOMENTE NÚMEROS';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_compania'] = '*CAMPO OBRIGATÓRIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_email'] = '*FORMATO "usuario@dominio.com" *MÁXIMO 100 CARACTERES *CAMPO OBRIGATÓRIO ';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_puesto'] = '*CAMPO OBRIGATÓRIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_taller'] = '*MÁXIMO 100 CARACTERES *ALFANUMÉRICO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_rfc'] = '*MÍNIMO 4 CARACTERES MÁXIMO 12 *ALFANUMÉRICO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_ciudad'] = '*MÁXIMO 100 CARACTERES *CAMPO OBRIGATÓRIO *ALFANUMÉRICO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_aprox_personas'] = '*SOMENTE NÚMEROS *MÁXIMO 3 CARACTERES';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_aprox_autos'] = '*SOMENTE NÚMEROS *MÁXIMO 3 CARACTERES';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_talla'] = '*CAMPO OBRIGATÓRIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_fecha_nacimiento'] = '*CAMPO OBRIGATÓRIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_codigoqr'] = '*CAMPO OBRIGATÓRIO *SOMENTE NÚMEROS';
$lang['usuarios_maestro_pintor_registro_controller_lang_tooltips_identificacion'] = '*FORMATO PNG';
$lang['usuarios_maestro_pintor_registro_controller_lang_alerta_firma_vacia'] = 'CAPTURE SUA ASSINATURA';
$lang['usuarios_maestro_pintor_registro_controller_lang_alerta_termino'] = 'ACEITE OS TERMOS E CONDIÇÕES E O AVISO DE PRIVACIDADE';
$lang['usuarios_maestro_pintor_registro_controller_error_rfc'] = 'O CAMPO NIT É OBRIGATÓRIO';
$lang['usuarios_maestro_pintor_registro_controller_error_tarjeta'] = 'O CAMPO NÚMERO DO CARTÃO É OBRIGATÓRIO';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_rfc_repetido'] = 'O NIT %1$s JÁ FOI CADASTRADO';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_email_repetido'] = 'O E-MAIL %1$s JÁ FOI CADASTRADO';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_celular_repetido'] = 'O CELULAR %1$s JÁ FOI CADASTRADO';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_uno'] = 'O NÚMERO DO CARTÃO %1$s JÁ ESTÁ ATRIBUÍDO.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_tres'] = 'O NÚMERO DO CARTÃO %1$s ESTÁ CANCELADO POR REPOSIÇÃO.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_cuatro'] = 'O NÚMERO DO CARTÃO %1$s ESTÁ CANCELADO POR ERRO.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_tarjeta_estatus_no_existe'] = 'O NÚMERO DO CARTÃO %1$s NÃO EXISTE.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_maestro_pintor_registrado'] = 'MESTRE PINTOR CADASTRADO.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_error_envio_correo'] = 'O E-MAIL DO USUÁRIO NÃO PÔDE SER ENVIADO.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_error_archivo_identificacion'] = 'O ARQUIVO DE IDENTIFICAÇÃO NÃO PÔDE SER ENVIADO.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_error_formato_identificacion'] = 'O FORMATO ESTÁ INCORRETO, SOMENTE PNG, JPG E PDF SÃO PERMITIDOS.';
$lang['usuarios_maestro_pintor_registro_controller_lang_msg_error_tamanio_identificacion'] = 'O TAMANHO DO ARQUIVO É MUITO GRANDE, SOMENTE ARQUIVOS MENORES QUE 4MB SÃO PERMITIDOS';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_enviar_por']      = 'ENVIAR POR:';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_enviar_por_mail']      = 'E-MAIL';
$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_legal_aviso_titulo']      = 'AVISO DE PRIVACIDADE - TERMOS E CONDIÇÕES';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_welcome']      = 'Bem-vindo ao Axalta Club do Pintor Brasil';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_1']      = 'É uma honra tê-lo como parte do Club do Pintor, onde reconhecemos seu esforço e lealdade.';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_2']      = 'Com prazer atenderemos suas dúvidas sobre o programa de incentivos, promoções, resultados ou temas relacionados ao funcionamento do site, a partir da página do programa <a href="https://www.clubdelpintoraxaltabrasil.com.br" style="mso-line-height-rule:exactly;text-decoration:none;color:#2690CE;font-size:14px">www.clubdelpintoraxaltabrasil.com.br</a> na aba de contato.';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_user']    = 'Usuário: ';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_pass']    = 'Senha: ';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_button_1']    = 'Club do Pintor';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_3']      = 'Você conhece as regras do programa?';
$lang['usuarios_maestro_pintor_registro_controller_lang_mail_body_button_2']    = 'Ir para o site';

$lang['usuarios_maestro_pintor_registro_controller_lang_etiqueta_legal_aviso_texto']      = '
<h2>TERMOS E CONDIÇÕES DE USO</h2>
<p>
    O uso de qualquer benefício....
</p>
<p>
    Os presentes Termos e Condições .....
</p>
<p>
    Axalta poderá prestar os benefícios .....
</p>
<p>
    Os termos “você”, “usuário” e qualquer ......
</p>
<h3>
I.	Consentimento dos Termos e Condições
</h3>
<p>
    Ao criar uma conta de usuário ....
</p>
<p>
    Tome em conta que, ....
</p>
<p>
    Axalta poderá modificar e.....
</p>
<p>
    O uso do Programa ....
</p>
<h3>
    II.	Verificação de identidade
</h3>
<p>
    O uso da sua conta de ....
</p>
<p>
    Você se encontra ....
</p>
<h3>
    III.	Uso do Cartão Club do Pintor e demais benefícios do Programa
</h3>
<p>
    Ao contar com o Cartão ....
</p>
<p>
    Você é responsável ....
</p>
<p>
    Os benefícios gerados .....
</p>
<p>
    Os Distribuidores deverão ...
</p>
<p>
    Em caso de perda ....
</p>
';
