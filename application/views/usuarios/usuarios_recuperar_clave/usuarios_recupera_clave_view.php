<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 marzo 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<section id="password">
    <form action="<?= funciones_strategix_version_url_random_base_url('usuarios/usuarios_recupera_clave/usuarios_recupera_clave_controller/usuarios_recupera_clave_controller_email')?>" id="frm_recupera_clave" role="form" method="post" accept-charset="utf-8">
        <?=$token;?>
        <div class="login-container animate__animated animate__fadeIn">
            <div class="row">            
                <div class="col-lg-6 col-12 txt-center d-flex align-items-center justify-content-center">
                    <div class="logo-main">
                        <img src="application/views/template/login/imagenes/logo.png" alt="">
                        <h2><?=$this->lang->line('usuarios_recupera_clave_controller_lang_marca')?></h2>
                    </div>
                    <div class="logo-main-responsive">
                        <div class="row">
                            <div class="col-6">
                                <img src="application/views/template/login/imagenes/logo.png" alt="" class="logo1">
                            </div>
                            <div class="col-6">
                                <img src="application/views/template/login/imagenes/cdp.png" alt="" class="logo2">
                            </div>
                        </div>
                        <div class="col-12">
                            <h2><?=$this->lang->line('usuarios_recupera_clave_controller_lang_marca')?></h2>
                        </div>
                        <div class="col-12">
                            <h3><?=$this->lang->line('usuarios_recupera_clave_controller_lang_titulo')?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="logo-secondary">
                                <img src="application/views/template/login/imagenes/cdp.png" alt="">
                                <h2><?=$this->lang->line('usuarios_recupera_clave_controller_lang_titulo')?></h2>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-20 form-login">
                        <div class="col-lg-3">
                            <p>ENVIAR POR:</p>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="usuarios_crea_clave_view_chk_email" name="usuarios_crea_clave_view_chk_email" value="1" class="form-check-input">
                                <label for="" class="form-check-label"><?=$this->lang->line('usuarios_recupera_clave_controller_lang_label_check_mail')?></label>
                            </div>
                           <!-- <div class="form-check form-check-inline">
                                <input type="checkbox" id="usuarios_crea_clave_view_chk_whatsapp" name="usuarios_crea_clave_view_chk_whatsapp" value="1" class="form-check-input">
                                <label for="" class="form-check-label"><?=$this->lang->line('usuarios_recupera_clave_controller_lang_label_check_whatsapp')?></label>
                            </div>-->
                        </div>
                        <div class="col-lg-8" id="usuarios_crea_clave_view_div_email">
                            <p><?=$this->lang->line('usuarios_recupera_clave_controller_lang_msg_email')?></p>    
                            <div class="form-group">
                                <input type="text" name="usuarios_crea_clave_view_txt_email" id="usuarios_crea_clave_view_txt_email" class="form-control trans" placeholder="<?=$this->lang->line('usuarios_recupera_clave_controller_lang_input_correo_electronico_placeholder')?>" pb-role="username" autocomplete="off" >
                                <div id="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-8" id="usuarios_crea_clave_view_div_whatsapp" style="display: none;">
                            <p><?=$this->lang->line('usuarios_recupera_clave_controller_lang_msg_whatsapp')?></p>    
                            <div class="form-group">
                                <input type="text" name="usuarios_crea_clave_view_txt_whatsapp" id="usuarios_crea_clave_view_txt_whatsapp" class="form-control trans" placeholder="<?=$this->lang->line('usuarios_recupera_clave_controller_lang_input_whatsapp_placeholder')?>" pb-role="username" autocomplete="off" >
                                <div id="error"></div>
                            </div>
                        </div>                                
                        <div class="botones">
                            <div class="row">
                                <div class="col-lg-6 col-12 center">
                                    <button type="button" id="btn_envio_mail" class="btn btn-black" pb-role="submit"><span class="iconify" data-icon="bx:bx-mail-send"></span> <?=$this->lang->line('usuarios_recupera_clave_controller_lang_label_button_send')?></button>
                                </div>
                                <div class="col-lg-6 col-12 center">
                                    <a href="<?php echo funciones_strategix_version_url_random_base_url("login") ?>"><button type="button" class="btn btn-gray"><?=$this->lang->line('usuarios_recupera_clave_controller_lang_btn_login')?></button></a>
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>
        </div>
    </form>
</section>

<script>
    $(document).ready(function(){
        $("#frm_recupera_clave").keypress(function(e) { if (e.which == 13) { return false; } });    
        $('#btn_envio_mail').click(function() { usuarios_recupera_clave_controller_lang_envio(); });

        /********************************************MSG ERROR******************************************************************************************/
        $('#frm_recupera_clave input').on('keyup', function ()  { js_general_limpiar_errores(this); });
        $('#frm_recupera_clave input').on('click', function ()  { js_general_limpiar_errores(this); });
        $('#frm_recupera_clave select').on('click', function () { js_general_limpiar_errores(this); });  
        $('#frm_recupera_clave input').on('change', function () { js_general_limpiar_errores(this); });
        /**************************************************************************************************************************************/     
        $('#usuarios_crea_clave_view_chk_email').prop('checked',true);
        $('#usuarios_crea_clave_view_chk_email').on('change', function(){
            if($('#usuarios_crea_clave_view_chk_email').prop('checked',true)){
                $('#usuarios_crea_clave_view_chk_whatsapp').prop('checked',false).removeAttr('checked');     
                $('#usuarios_crea_clave_view_div_whatsapp').hide(); 
                $('#usuarios_crea_clave_view_txt_whatsapp').val(''); 
                $('#usuarios_crea_clave_view_div_email').show();
            }
        });
        $('#usuarios_crea_clave_view_chk_whatsapp').on('change', function(){
            if($('#usuarios_crea_clave_view_chk_whatsapp').prop('checked',true)){
                $('#usuarios_crea_clave_view_chk_email').prop('checked',false).removeAttr('checked');
                $('#usuarios_crea_clave_view_div_email').hide();
                $('#usuarios_crea_clave_view_txt_email').val('');
                $('#usuarios_crea_clave_view_div_whatsapp').show();
            }
        });        
    });
    function usuarios_recupera_clave_controller_lang_envio(){
        grecaptcha.ready(function() {
            grecaptcha.execute('<?=$this->config->item('google_key')?>', { action: '<?=$frm_action?>'}).then(function(token) {
                // Add your logic to submit to your backend server here.
                var frm_action = '<?=$frm_action?>';
                var usuarios_crea_clave_view_txt_email = $("#usuarios_crea_clave_view_txt_email").val();
                var usuarios_crea_clave_view_txt_whatsapp = $("#usuarios_crea_clave_view_txt_whatsapp").val();
                var usuarios_crea_clave_view_chk_email = $("#usuarios_crea_clave_view_chk_email:checked").val();
                var usuarios_crea_clave_view_chk_whatsapp = $("#usuarios_crea_clave_view_chk_whatsapp:checked").val();
                if (usuarios_crea_clave_view_chk_email===undefined){ usuarios_crea_clave_view_chk_email=0; }
                if (usuarios_crea_clave_view_chk_whatsapp===undefined){ usuarios_crea_clave_view_chk_whatsapp=0; }
//                alert("email: "+usuarios_crea_clave_view_chk_email+" whatsapp: "+usuarios_crea_clave_view_chk_whatsapp);
                $("#btnEnviarEmail").attr('disabled',true);
                $('#loader_panel').show();
                $.ajax({
                    type: 	$('#frm_recupera_clave').attr('method'),
                    url: 	$('#frm_recupera_clave').attr('action'),
                    dataType:   'json',
//                    data: 	$('#frm_recupera_clave').serialize(),
                    data: {usuarios_crea_clave_view_txt_email:usuarios_crea_clave_view_txt_email,action:frm_action,token:token,usuarios_crea_clave_view_txt_whatsapp:usuarios_crea_clave_view_txt_whatsapp,usuarios_crea_clave_view_chk_email:usuarios_crea_clave_view_chk_email,usuarios_crea_clave_view_chk_whatsapp:usuarios_crea_clave_view_chk_whatsapp},
                    success: function(data){
                        var msg = '<?=$this->lang->line('usuarios_recupera_clave_controller_lang_js_msg_text_email')?>';
                        switch (data.tipo){
                            case 1:         
                                msg = '<?=$this->lang->line('usuarios_recupera_clave_controller_lang_js_msg_text_email')?>';
                                break
                            case 2: 
                                msg = '<?=$this->lang->line('usuarios_recupera_clave_controller_lang_js_msg_text_whatsapp')?>';
                                break                                
                        }
                        switch (data.res){
                            case 0:
                                Swal.fire({ icon: 'error', allowOutsideClick:false, text: '<?=$this->lang->line('usuarios_recupera_clave_controller_lang_msg_captcha_erroneo')?>'});
                                break                    
                            case 1:
                                Swal.fire({
                                    title: '',
                                    html: msg,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#fd7e14',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: '<?=$this->lang->line('usuarios_recupera_clave_controller_lang_msg_btn_ok')?>',
                                    cancelButtonText: ''
                                }).then((validacionaltaparticipante) => {
                                    if (validacionaltaparticipante.isConfirmed) {
                                        $(location).attr("href","<?=funciones_strategix_version_url_random_base_url("Login")?>");
                                    } 
                                });                                

                                break
                            case 2:
                                Swal.fire({ icon: 'error', allowOutsideClick:false, text: '<?=$this->lang->line('login_usuario_captcha_erroneo')?>'});
                                break                                       
                            default:
                                $.each(data, function(key, value) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key).parents('.form-group').find('#error').html(value);
                                    $('#txt_captcha').focus();
                                });
                                break;
                        }
                    },
                    error: function(){ },
                    complete: function(){  $("#btnEnviarEmail").attr('disabled',false); $('#loader_panel').hide(); }
                });
            });
        });                
    }       
</script>