<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');


$lang['usuarios_actualizar_datos_controller_lang_pagina_titulo']                            = 'ATUALIZAR DADOS DO USUÁRIO';
$lang['usuarios_actualizar_datos_controller_lang_input_nombre']                             = '*NOME:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_nombre']                       = 'NOME';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_nombre']                           = '*MÁXIMO 100 CARACTERES *CAMPO OBRIGATÓRIO *SOMENTE TEXTO ';
$lang['usuarios_actualizar_datos_controller_lang_input_segundo_nombre']                     = 'SEGUNDO NOME:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_segundo_nombre']               = 'SEGUNDO NOME';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_segundo_nombre']                   = '*MÁXIMO 50 CARACTERES *SOMENTE TEXTO ';
$lang['usuarios_actualizar_datos_controller_lang_input_apellido_paterno']                   = '*SOBRENOME:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_apellido_paterno']             = 'SOBRENOME';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_apellido_paterno']                 = '*MÁXIMO 50 CARACTERES *CAMPO OBRIGATÓRIO *SOMENTE TEXTO ';
$lang['usuarios_actualizar_datos_controller_lang_input_apellido_materno']                   = 'SEGUNDO SOBRENOME:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_apellido_materno']             = 'SEGUNDO SOBRENOME';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_apellido_materno']                 = '*MÁXIMO 50 CARACTERES *SOMENTE TEXTO ';
$lang['usuarios_actualizar_datos_controller_lang_input_email']                              = '*E-MAIL:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_email']                        = 'E-MAIL';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_email']                            = '*FORMATO "usuario@dominio.com" *MÁXIMO 50 CARACTERES *CAMPO OBRIGATÓRIO ';
$lang['usuarios_actualizar_datos_controller_lang_msg_email_repetido']                       = 'O E-MAIL %1$s JÁ EXISTE NA BASE DE DADOS, POR FAVOR INSIRA OUTRO';
$lang['usuarios_actualizar_datos_controller_lang_input_telefono']                           = 'TELEFONE:';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_telefono']                         = '*DEVE TER 10 CARACTERES *SOMENTE NÚMEROS';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_telefono']                     = 'TELEFONE';
$lang['usuarios_actualizar_datos_controller_lang_input_extencion']                          = 'RAMAL:';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_extencion']                        = '*MÁXIMO 10 - MÍNIMO 3 CARACTERES *SOMENTE NÚMEROS';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_extencion']                    = 'RAMAL';
$lang['usuarios_actualizar_datos_controller_lang_input_celular']                            = 'CELULAR:';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_celular']                          = '*DEVE TER 10 CARACTERES *SOMENTE NÚMEROS *INCLUIR O DDD SEM ESPAÇOS';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_celular']                      = 'CELULAR';
$lang['usuarios_actualizar_datos_controller_lang_msg_celular_repetido']                     = 'O CELULAR %1$s JÁ EXISTE NA BASE DE DADOS, POR FAVOR INSIRA OUTRO';
$lang['usuarios_actualizar_datos_controller_lang_input_rfc']                                = 'CPF/CNPJ:';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_rfc']                              = '*MÍNIMO 4 CARACTERES MÁXIMO 12 *ALFANUMÉRICO';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_rfc']                          = 'CPF/CNPJ';
$lang['usuarios_actualizar_datos_controller_lang_input_clave']                              = '*SENHA:';
$lang['usuarios_actualizar_datos_controller_lang_placeholder_clave']                        = 'SENHA';
$lang['usuarios_actualizar_datos_controller_lang_tooltip_clave']                            = '*MÁXIMO 20 CARACTERES *CAMPO OBRIGATÓRIO *A NOVA SENHA DEVE TER PELO MENOS UMA LETRA MINÚSCULA, UMA LETRA MAIÚSCULA E UM CARACTERE NUMÉRICO';
$lang['usuarios_actualizar_datos_controller_lang_msg_rfc_repetido']                         = 'O CPF/CNPJ %1$s JÁ EXISTE NA BASE DE DADOS, POR FAVOR INSIRA OUTRO';
$lang['usuarios_actualizar_datos_controller_lang_boton_guardar']                            = 'ATUALIZAR';
$lang['usuarios_actualizar_datos_controller_lang_boton_regresar']                           = 'VOLTAR';
$lang['usuarios_actualizar_datos_controller_lang_boton_salir']                              = 'SAIR';
$lang['usuarios_actualizar_datos_controller_lang_js_confirm_boton_aprobado']                = 'ACEITAR';
$lang['usuarios_actualizar_datos_controller_lang_js_confirm_boton_rechazado']               = 'REJEITAR';
$lang['usuarios_actualizar_datos_controller_lang_js_confirm_titulo']                        = 'VALIDAÇÃO DE DADOS';
$lang['usuarios_actualizar_datos_controller_lang_js_confirm_texto']                         = 'OS DADOS INSERIDOS ESTÃO CORRETOS?';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_limite_participante']               = 'VOCÊ ATINGIU O LIMITE DE USUÁRIOS POR PERFIL';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_participante_inserto']              = 'ATUALIZAÇÃO REALIZADA COM SUCESSO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_participante_no_inserto']           = 'O PARTICIPANTE NÃO FOI SALVO COM SUCESSO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_participante_error_corroe']         = 'O E-MAIL NÃO FOI ENVIADO, POR FAVOR ENTRE EM CONTATO COM contacto@fandeliconmigo.com';
$lang['usuarios_actualizar_datos_controller_lang_js_titulo_swal_error']                     = 'ERRO NO ENVIO DE E-MAIL';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_error']                        = 'ERRO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_guardado']                     = 'SALVO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_ok']                           = 'OK';
$lang['usuarios_actualizar_datos_controller_lang_validar']                                  = 'VALIDAR';
$lang['usuarios_actualizar_datos_controller_lang_espera']                                   = 'AGUARDE';
$lang['usuarios_actualizar_datos_controller_lang_validado']                                 = 'VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_email']                = 'O E-MAIL NÃO FOI VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_celular']              = 'O NÚMERO DE CELULAR NÃO FOI VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_nueva_valida_clave_nueva_confirma_msg_min']= 'A NOVA SENHA DEVE TER PELO MENOS UMA LETRA MINÚSCULA';
$lang['usuarios_actualizar_datos_controller_lang_nueva_valida_clave_nueva_confirma_msg_may']= 'A NOVA SENHA DEVE TER PELO MENOS UMA LETRA MAIÚSCULA';
$lang['usuarios_actualizar_datos_controller_lang_nueva_valida_clave_nueva_confirma_msg_num']= 'A NOVA SENHA DEVE TER PELO MENOS UM CARACTERE NUMÉRICO';
$lang['usuarios_actualizar_datos_controller_lang_mail_titulo']                              = 'VALIDAÇÃO DE E-MAIL';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_email_activo']         = 'FOI ENVIADO UM E-MAIL PARA ATIVAR SEU ENDEREÇO. AGUARDE 10 MINUTOS ANTES DE ENVIAR NOVAMENTE.';
$lang['usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_email_enviado']        = 'FOI ENVIADO UM E-MAIL PARA VALIDAÇÃO. AGUARDE 10 MINUTOS ANTES DE ENVIAR NOVAMENTE.';
$lang['usuarios_actualizar_datos_controller_lang_mail_texto1']                              = 'Prezado(a)';
$lang['usuarios_actualizar_datos_controller_lang_mail_texto2']                              = 'Para validar o e-mail, clique no link a seguir:';
$lang['usuarios_actualizar_datos_controller_lang_mail_fuera_tiempo']                        = 'OS 10 MINUTOS JÁ PASSARAM, POR FAVOR REENVIE A VALIDAÇÃO';
$lang['usuarios_actualizar_datos_controller_lang_mail_valido']                              = 'SEU E-MAIL FOI VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_mail_no_token']                            = 'ERRO: ESTA AÇÃO NÃO É PERMITIDA';
$lang['usuarios_actualizar_datos_controller_lang_mail_ya_valido']                           = 'SEU E-MAIL JÁ FOI VALIDADO';
$lang['usuarios_actualizar_datos_controller_lang_msg_email_repetido']                       = 'O E-MAIL INSERIDO JÁ ESTÁ NO SISTEMA';
$lang['usuarios_actualizar_datos_controller_lang_msg_celular_repetido']                     = 'O CELULAR INSERIDO JÁ ESTÁ NO SISTEMA';