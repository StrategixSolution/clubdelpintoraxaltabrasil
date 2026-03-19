<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['usuarios_recupera_clave_controller_lang_titulo']                                                  = 'RECUPERE SUA SENHA';
$lang['usuarios_recupera_clave_controller_lang_nueva_titulo']                                            = 'GERE SUA NOVA SENHA';
$lang['usuarios_recupera_clave_controller_lang_msg_email']                                               = 'INSIRA O E-MAIL COM O QUAL SE CADASTROU PARA RECUPERAR SUA SENHA.';
$lang['usuarios_recupera_clave_controller_lang_msg_whatsapp']                                            = 'INSIRA O NÚMERO DO SEU CELULAR COM O QUAL SE CADASTROU PARA RECUPERAR SUA SENHA, JUNTO COM O CÓDIGO DE ÁREA.';
$lang['usuarios_recupera_clave_controller_lang_instruciones_captcha']                                    = 'DIGITE O CAPTCHA';
$lang['usuarios_recupera_clave_controller_lang_input_correo_electronico_placeholder']                    = 'DIGITE O E-MAIL';
$lang['usuarios_recupera_clave_controller_lang_input_whatsapp_placeholder']                              = 'DIGITE O NÚMERO DE WHATSAPP';
$lang['usuarios_recupera_clave_controller_lang_input_captcha_placeholder']                               = 'DIGITE O CAPTCHA';
$lang['usuarios_recupera_clave_controller_lang_btn_login']                                               = 'VOLTAR AO LOGIN';
$lang['usuarios_recupera_clave_controller_lang_js_error_usuario']                                        = 'USUÁRIO INVÁLIDO';
$lang['usuarios_recupera_clave_controller_lang_msg_btn_ok']                                              = 'OK';
$lang['usuarios_recupera_clave_controller_lang_js_msg_text_email']                                       = 'FOI ENVIADO UM E-MAIL PARA SUA CONTA COM AS INSTRUÇÕES PARA RESTAURAR SUA SENHA. O E-MAIL CONTÉM UM LINK QUE SERÁ VÁLIDO POR APENAS 60 MINUTOS.';
$lang['usuarios_recupera_clave_controller_lang_js_msg_text_whatsapp']                                    = 'FOI ENVIADO UM WHATSAPP PARA SEU CELULAR COM AS INSTRUÇÕES PARA RESTAURAR SUA SENHA. A MENSAGEM CONTÉM UM LINK QUE SERÁ VÁLIDO POR APENAS 60 MINUTOS.';
$lang['usuarios_recupera_clave_controller_lang_correo_invalido']                                         = 'O E-MAIL NÃO É VÁLIDO';
$lang['usuarios_recupera_clave_controller_lang_msg_validacion_correo_electronico']                       = 'E-MAIL';
$lang['usuarios_recupera_clave_controller_lang_whatsapp_invalido']                                       = 'O WHATSAPP NÃO É VÁLIDO';
$lang['usuarios_recupera_clave_controller_lang_msg_validacion_whatsapp']                                 = 'WHATSAPP';
$lang['usuarios_recupera_clave_controller_lang_msg_validacion_captcha']                                  = 'CAPTCHA';
$lang['usuarios_recupera_clave_controller_lang_titulo_crea_clave']                                       = 'ACESSO NEGADO';
$lang['usuarios_recupera_clave_controller_lang_msg_acceso_denegado']                                     = 'AÇÃO ILEGAL, NÃO HÁ PERMISSÃO PARA ACESSAR ESTA SEÇÃO.';
$lang['usuarios_recupera_clave_controller_lang_msg_tiempo_caduco']                                       = 'O TEMPO DE RESTAURAÇÃO PARA REGENERAR A SENHA EXPIROU, REINICIE O PROCESSO.';
$lang['usuarios_recupera_clave_controller_lang_msg_btn_guardar']                                         = 'SALVAR';
$lang['usuarios_recupera_clave_controller_lang_nueva_instrucciones']                                     = 'INSIRA SUA NOVA SENHA, MÍNIMO 6 CARACTERES, DEVENDO CONTER UMA LETRA MAIÚSCULA, UMA MINÚSCULA E UM NÚMERO:';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva']                                       = 'NOVA SENHA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_placeholder']                           = 'NOVA SENHA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_error']                                 = 'NOVA SENHA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_confirma']                              = 'CONFIRME A NOVA SENHA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_confirma_placeholder']                  = 'CONFIRME A NOVA SENHA';
$lang['usuarios_recupera_clave_controller_lang_input_clave_nueva_confirma_error']                        = 'CONFIRME A NOVA SENHA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_msg_min']                        = 'A NOVA SENHA DEVE TER PELO MENOS UMA LETRA MINÚSCULA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_msg_may']                        = 'A NOVA SENHA DEVE TER PELO MENOS UMA LETRA MAIÚSCULA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_msg_num']                        = 'A NOVA SENHA DEVE TER PELO MENOS UM CARACTERE NUMÉRICO';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_confirma_msg_min']               = 'A NOVA SENHA DEVE TER PELO MENOS UMA LETRA MINÚSCULA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_confirma_msg_may']               = 'A NOVA SENHA DEVE TER PELO MENOS UMA LETRA MAIÚSCULA';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_confirma_msg_num']               = 'A NOVA SENHA DEVE TER PELO MENOS UM CARACTERE NUMÉRICO';
$lang['usuarios_recupera_clave_controller_lang_nueva_valida_clave_nueva_confirma_no_concuerdan']         = 'AS SENHAS DIGITADAS NÃO SÃO IGUAIS.';
$lang['usuarios_recupera_clave_controller_lang_nueva_actualizada']                                       = 'A SENHA FOI RESTAURADA.';
$lang['usuarios_recupera_clave_controller_lang_mail_titulo']                                             = 'RECUPERAÇÃO DE SENHA';
$lang['usuarios_recupera_clave_controller_lang_mail_texto1']                                             = 'Prezado(a)';
$lang['usuarios_recupera_clave_controller_lang_mail_texto2']                                             = 'Para recuperar sua senha, clique no link a seguir:';
$lang['usuarios_recupera_clave_controller_lang_mail_texto3']                                             = 'O link será válido por <b>1 Hora</b>. Após esse período, você deverá entrar em contato com nossa equipe de atendimento ao cliente para recuperar sua conta.';
$lang['usuarios_recupera_clave_controller_lang_mail_texto4']                                             = 'Lembre-se de preservar a segurança de sua conta. Recomendamos não compartilhar sua senha e memorizá-la para evitar contratempos.';
$lang['usuarios_recupera_clave_controller_lang_mail_texto5']                                             = 'Att:<br>Administração do Programa ';
$lang['usuarios_recupera_clave_controller_lang_mail_link']                                               = 'Recuperar Senha';
$lang['usuarios_recupera_clave_controller_lang_msg_captcha_erroneo']                                     = 'CAPTCHA INCORRETO';
$lang['usuarios_recupera_clave_controller_lang_marca']                                               = 'Axalta® Pinturas';
$lang['usuarios_recupera_clave_controller_lang_label_check_mail']                                               = 'E-MAIL';
$lang['usuarios_recupera_clave_controller_lang_label_check_whatsapp']                                               = 'WHATSAPP';
$lang['usuarios_recupera_clave_controller_lang_label_button_send']                                               = 'ENVIAR';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_titulo']                                                = 'RECUPERAÇÃO DE SENHA';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_link']                                                  = 'RECUPERAR SENHA';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_linea_1']                                               = 'Para recuperar sua senha, clique no link a seguir:';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_linea_2']                                               = 'O link só será válido por <b>1 Hora</b>. Após esse período, você deverá entrar em contato com nossa equipe de atendimento ao cliente para recuperar sua conta.';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_linea_3']                                               = 'Lembre-se de preservar a segurança de sua conta. Recomendamos não compartilhar sua senha e memorizá-la para evitar contratempos.';
$lang['usuarios_recupera_clave_controller_lang_texto_mail_linea_4']                                               = 'Atte:<br>Administração do Programa ';