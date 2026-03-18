<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 09 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<section id="login">
    <form id="<?=$frm_action?>" name="<?=$frm_action?> " role="form" method="post" accept-charset="utf-8">
        <div class="login-container animate__animated animate__fadeIn">
            <div class="row">            
                <div class="col-lg-6 col-12 txt-center d-flex align-items-center justify-content-center">
                    <div class="logo-main">
                        <img src="application/views/template/login/imagenes/logo.png" alt="">
                        <h2><?=$this->lang->line('login_controller_lang_marca')?></h2>
                       <!-- <div class="linkslogin">
                            <p><?=$this->lang->line('login_controller_lang_enlace_responsive_1')?> <b><a href="<?php echo funciones_strategix_version_url_random_base_url("Registromaestropintorexterno") ?>"><?=$this->lang->line('login_controller_lang_enlace_responsive_2')?></a></b></p>
                        </div>-->
                    </div>
                    <div class="logo-main-responsive">
                        <div class="row">
                            <div class="col-6">
                                <img src="application/views/template/login/imagenes/logo.png" alt="" class="logo1">
                            </div>
                            <div class="col-6">
                                <img src="application/views/template/login/imagenes/cdp2.png" alt="" class="logo2">
                            </div>
                        </div>
                        <div class="col-12">
                            <h2><?=$this->lang->line('login_controller_lang_marca')?></h2>
                        </div>
                        <div class="col-12">
                            <h3><?=$this->lang->line('login_controller_lang_ingreso_marca')?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="logo-secondary">
                                <img src="application/views/template/login/imagenes/cdp.png" alt="">
                                <h2><?=$this->lang->line('login_controller_lang_ingreso_marca')?></h2>
                              <!--  <a href="https://www.facebook.com/clubdelpintor" target="_blank"><img src="application/views/template/login/imagenes/likefb.png" alt="" class="btnfb mt-20"></a>-->
                           <br>
                            </div>
                            <div class="logo-secondary-responsive">

                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-20 form-login">
                        <div class="col-lg-8 col-11">                            
                            <?=$token;?>
                            <div class="form-group">
                                <label><?=$this->lang->line('login_controller_lang_input_usuario')?><span data-toggle='tooltip' title='<?=$this->lang->line('login_controller_lang_input_tooltip_usuario')?>'> <i class="fas fa-question-circle"></i></span></label>
                                <input type="text" name="txt_usuario" id="txt_usuario" class="form-control trans" placeholder="<?=$this->lang->line('login_controller_lang_input_placeholder_usuario')?>" />
                                <div id="error"></div>
                            </div>
                            <div class="form-group mb-0">
                                <label><?=$this->lang->line('login_controller_lang_input_clave')?><span data-toggle='tooltip' title='<?=$this->lang->line('login_controller_lang_input_label_clave')?>'> <i class="fas fa-question-circle"></i></span></label>
                                <div class="input-password">
                                    <input type="password" name="txt_clave" id="txt_clave" class="form-password trans" value="Abc123" placeholder="<?=$this->lang->line('login_controller_lang_input_placeholder_clave')?>"/>
                                    <i class="far fa-eye-slash seepwd icon-password" id="eyeclave1"></i>
                                </div>
                                <div id="error"></div>
                            </div>      
                        </div>
                        <div class="col-lg-8 txt-right">
                            <a href="<?php echo funciones_strategix_version_url_random_base_url("UsuariosRecuperaClave") ?>"><?=$this->lang->line('login_controller_lang_recupera_clave')?></a>
                        </div>
                        <div class="col-lg-5 col-8 mt-30">
                            <div class="d-grid gap-2">
                                <button type="button" name="button_login" id="button_login" class="btn btn-black" ><?=$this->lang->line('login_controller_lang_btn_ingresar')?></button>
                            </div>         
                        </div>
                    </div>
                 <!--   <div class="row">
                        <div class="col-12">
                            <div class="enlaces-responsive">
                                <p><?=$this->lang->line('login_controller_lang_enlace_responsive_1')?> <b><a href="<?php echo funciones_strategix_version_url_random_base_url("Registromaestropintorexterno") ?>"><?=$this->lang->line('login_controller_lang_enlace_responsive_2')?></a></b></p>
                            </div>
                        </div>
                    </div>   -->          
                </div>
            </div>
        </div>
    </form>
</section>
 <div class="aviso-cookies animate__animated animate__fadeInUp" id="aviso-cookies">
    <h3 class="titulo"><?=$this->lang->line('login_controller_lang_cookie_titulo')?></h3>
    <p class="parrafo"><?=$this->lang->line('login_controller_lang_cookie_texto')?></p>
    <button type="button" class="btn btn-black" id="avisocookies1" aria-hidden="true"><?=$this->lang->line('login_controller_lang_cookie_btn_acuerdo')?></button>
    <a class="enlace" href='/site/login' data-bs-toggle="modal" data-bs-target="#ModalCookies"><?=$this->lang->line('login_controller_lang_cookie_btn_aviso_cookie')?></a>
</div>
<div class="fondo-aviso-cookies" id="fondo-aviso-cookies"></div> 
        
<!-- Modal Aviso de Cookies -->
<div class="modal fade" id="ModalCookies" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$this->lang->line('login_controller_lang_cookie_titulo')?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                      <div class="modal-body">
           
        <?=$this->lang->line('login_controller_lang_informacion_cookies')?>

      </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gray" data-bs-dismiss="modal"><?=$this->lang->line('login_controller_lang_cookie_aviso_cookie_cerrar')?></button>
                <button type="button" class="btn btn-black" id="avisocookies2"><?=$this->lang->line('login_controller_lang_cookie_aviso_cookie_acepto')?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        /***************************************  eye clave  ***************************************/
        $("#eyeclave1").click(function(){
        if($("#txt_clave").prop('type')=='text'){
            $("#txt_clave").prop('type','password');
            $("#eyeclave1").removeClass("fa-eye");
            $("#eyeclave1").addClass("fa-eye-slash");
        }else{
            $("#txt_clave").prop('type','text');
            $("#eyeclave1").removeClass("fa-eye-slash");
            $("#eyeclave1").addClass("fa-eye");
            }
        })    
        /***************************************  COOKIES  ***************************************/
        var getCookie = function(name) {
            var cookies = document.cookie.split(';');
            for(var i=0 ; i < cookies.length ; ++i) {
                var pair = cookies[i].trim().split('=');
                if(pair[0] == name)
                    return pair[1];
            }
            return null;
        };
        if (getCookie('<?=$this->config->item('cookie_name')?>')== '<?=$this->config->item('cookie_value')?>') {} else { $('#aviso-cookies').show();$('#fondo-aviso-cookies').show(); }        
        $('#ModalCookies').modal({backdrop: 'static', keyboard: false}); 
        $('#aviso-cookies').modal({backdrop: 'static'});       
        $('.enlace').on('click', function(e){
            e.preventDefault();
            $('#ModalCookies').modal({backdrop: 'static', keyboard: false});            
        }); 
        $('#avisocookies1').on('click', function(e){
            $("#aviso-cookies").hide(); 
            $("#fondo-aviso-cookies").hide(); 
            $("#cookies1").val(1);
            login_cookie_axalta();            
        });        
        $('#avisocookies2').on('click', function(e){ 
            $("#ModalCookies").modal("hide"); 
            $("#aviso-cookies").hide(); 
            $("#fondo-aviso-cookies").hide();             
            $("#cookies2").val(1);            
            $("#cookies1").val(1);
            login_cookie_axalta();
        });        

        function login_cookie_axalta(){
            localStorage.clear("<?=$this->config->item('cookie_name')?>");
            $.ajax({
                type: 'POST',
                url: 'login/login_controller/login_controller_crea_cookie',
                dataType: 'json',
                data: {id:0},
                success: function(data){ console.log(data);},
                error: function(data){ console.log("Error"); console.log(data); },
                complete: function(){  }
            });        
        }
        /***************************************  VALIDACION USUARIO Y CLAVE  ***************************************/
        $('#<?=$frm_action?> input').on('keyup', function ()  { js_general_limpiar_errores(this); });
        $('#<?=$frm_action?> input').on('click', function ()  { js_general_limpiar_errores(this); });
        $('#<?=$frm_action?> select').on('click', function () { js_general_limpiar_errores(this); });  
        $('#v input').on('change', function () { js_general_limpiar_errores(this); });       
        /***************************************  OTROS  ***************************************/
        $('#txt_usuario').focus();
        $('#button_login').click(function() { login_autenticacion(); });
        $('#refreshCaptcha').on('click', function(){ login_captcha_refresh(); });
    });
    /***************************************  login_autenticacion  ***************************************/
    function login_autenticacion(){
        grecaptcha.ready(function() {
            grecaptcha.execute('<?=$this->config->item('google_key')?>', { action: '<?=$frm_action?>'}).then(function(token) {
                // Add your logic to submit to your backend server here.
                var frm_action = '<?=$frm_action?>';
                var rememberme = $("#rememberme:checked").val();
                var txt_usuario = $("#txt_usuario").val();
                var txt_clave = $("#txt_clave").val();
                $.ajax({
                    type: 'POST',
                    url: '<?=funciones_strategix_version_url_random_base_url("autenticacion/autenticacion_controller")?>',
                    dataType:   'json',
                    data: {txt_usuario:txt_usuario,txt_clave:txt_clave,action:frm_action,token: token },
                    success: function(data){
                        console.log('success:');console.log(data);
                        switch (data.res){                    
                            case 0:
                                $('#txt_usuario').focus();
                                $('#txt_usuario').val('');
                                $('#txt_clave').val('');
                                Swal.fire({ icon: 'error', allowOutsideClick:false, text: '<?=$this->lang->line('login_controller_lang_usuario_erroneo')?>'});
                                break
                            case 1:
                                $(location).attr('href','<?=funciones_strategix_version_url_random_base_url("Inicio")?>');
                                break
                            case 2:
                                Swal.fire({ icon: 'error', allowOutsideClick:false, text: '<?=$this->lang->line('login_controller_lang_usuario_captcha_erroneo')?>'});
                                break                                
                            default: 
                                $.each(data, function(key, value) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key).parents('.form-group').find('#error').html(value);
                                });
                                return 0;
                                break;                            
                        }
                    },
                    error: function(data){ console.log(data); },
                    complete: function(){ 
                        $('#loader_panel').hide(); 
                    }
                });

            });
        });    
        $('#error').html(" ");
        $('#loader_panel').show();        

    }   
</script>