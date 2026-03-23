<?php

/* 
 * Sistema Web Responsivo CDPMEX                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 ABRIL 2025 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>


<form action="<?= base_url('usuarios/usuarios_recupera_clave/usuarios_recupera_clave_nueva_controller/usuarios_recupera_clave_nueva_controller_actualizacion')?>" id="frm_recupera_clave_nueva" role="form" method="post" accept-charset="utf-8">
    <?=$token;?>
<section id="login">
    <div class="login-container animate__animated animate__fadeIn">
        <div class="row">            
            <div class="col-lg-6 col-12 txt-center">
                <div class="logo-main">
                    <img src="application/views/template/login/imagenes/logo.png" alt="">
                    <h2><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_marca')?></h2>
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
                        <h2><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_marca')?></h2>
                    </div>
                    <div class="col-12">
                        <h3><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_titulo')?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="logo-secondary">
                            <img src="application/views/template/login/imagenes/cdp.png" alt="">
                            <h2><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_titulo')?></h2>
                        </div>
                        <div class="logo-secondary-responsive">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-20 form-login">
                    <div class="col-lg-12">
                        <h2><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_ingreso_nueva_contraseña')?></h2>
                        <p><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_instrucciones')?></p>
                    </div>
                </div>
                <div class="row justify-content-center mt-20 form-login">
                    <div class="col-lg-8 col-11">
                        <div class="form-recovery animate__animated animate__zoomIn" id="axa-form">
                            <p></p>  
                            <div class="form-group mb-0">
                                <label><?=$this->lang->line('login_controller_lang_input_clave')?><span data-toggle='tooltip' title='<?=$this->lang->line('login_controller_lang_input_tooltip_clave')?>'> <i class="fas fa-question-circle"></i></span></label>
                                <div class="input-password">
                                    <input type="password" class="form-control trans" name="clave_nueva" value="" id="clave_nueva" placeholder='<?=$this->lang->line('recupera_clave_input_clave_nueva_placeholder')?>' aria-describedby="basic-addon1"  onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" >
                                    <i class="far fa-eye-slash seepwd icon-password" id="eyeclave1"></i>
                                </div>
                                <p id="error"></p>
                            </div>
                            <div class="form-group mt-40 mb-0">
                                <label><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_confirme_contraseña')?><span data-toggle='tooltip' title='<?=$this->lang->line('login_controller_lang_input_tooltip_clave')?>'> <i class="fas fa-question-circle"></i></span></label>
                                <div class="input-password">
                                    <input type="password" name="clave_nueva_confirma" value="" id="clave_nueva_confirma" class="form-control trans" placeholder="<?=$this->lang->line('recupera_clave_input_clave_nueva_confirma_placeholder')?>" pb-role="clave_nueva_confirma"  onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" >
                                    <i class="far fa-eye-slash seepwd icon-password" id="eyeclave2"></i>
                                </div>
                                <p id="error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-8 mt-30">
                        <div class="botones animate__animated animate__zoomIn">
                            <button type="button" id="button_crea_clave" class="btn btn-axalta btn-lg" pb-role="submit"><?=$this->lang->line('usuarios_recupera_clave_controller_lang_msg_btn_guardar')?></button>
                        </div>
                    </div>
                </div>             
            </div>
        </div>
    </div>
</section>
</form>
<script>
    $(document).ready(function(){
        $("#frm_recupera_clave_nueva").keypress(function(e) { if (e.which == 13) { return false; } });
        $('#button_crea_clave').click(function() { usuarios_recupera_clave_nueva_view_js_actualizacion(); });
        $("#eyeclave1").click(function(){
        if($("#clave_nueva").prop('type')=='text'){
            $("#clave_nueva").prop('type','password');
            $("#eyeclave1").removeClass("fa-eye");
            $("#eyeclave1").addClass("fa-eye-slash");
        }else{
            $("#clave_nueva").prop('type','text');
            $("#eyeclave1").removeClass("fa-eye-slash");
            $("#eyeclave1").addClass("fa-eye");
            }
        });
        $("#eyeclave2").click(function(){
            if($("#clave_nueva_confirma").prop('type')=='text'){
                $("#clave_nueva_confirma").prop('type','password');
                $("#eyeclave2").removeClass("fa-eye");
                $("#eyeclave2").addClass("fa-eye-slash");
            }else{
                $("#clave_nueva_confirma").prop('type','text');
                $("#eyeclave2").removeClass("fa-eye-slash");
                $("#eyeclave2").addClass("fa-eye");
            }
        });
        /********************************************MSG ERROR******************************************************************************************/
        $('#frm_recupera_clave_nueva input').on('keyup', function ()  { js_general_limpiar_errores(this); });
        $('#frm_recupera_clave_nueva input').on('click', function ()  { js_general_limpiar_errores(this); });
        $('#frm_recupera_clave_nueva select').on('click', function () { js_general_limpiar_errores(this); });  
        $('#frm_recupera_clave_nueva input').on('change', function () { js_general_limpiar_errores(this); });
        /**************************************************************************************************************************************/           
    });
    function usuarios_recupera_clave_nueva_view_js_actualizacion(){
        var clave_nueva = $("#clave_nueva").val();
        var clave_nueva_confirma = $("#clave_nueva_confirma").val();
        var ssfvr = getQueryVariable("ssfvr");
        // CSRF Hash
        var csrfName = $('#csrf_test_name').attr('name'); // Value specified in $config['csrf_token_name']
        var csrfHash = $('#csrf_test_name').val(); // CSRF hash
        $.ajax({
            type: 	$('#frm_recupera_clave_nueva').attr('method'),
            url: 	$('#frm_recupera_clave_nueva').attr('action'),
            dataType:   'json',
            data: 	{clave_nueva:clave_nueva,clave_nueva_confirma:clave_nueva_confirma,ssfvr:ssfvr,[csrfName]: csrfHash},
            success: function(data){
                switch (data){
                case 0:
                    $('#clave_nueva').focus();
                        Swal.fire({
                            icon: 'error',
                            title: '',
                            text: '<?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_valida_clave_nueva_confirma_no_concuerdan')?>'
                        });
                    break;
                case 1:
                    Swal.fire({
                        title: '',
                        html: '<?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_actualizada')?>',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#fd7e14',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_msg_btn_ok')?>',
                        cancelButtonText: ''
                    }).then((validacionaltaparticipante) => {
                        if (validacionaltaparticipante.isConfirmed) {
                            $(location).attr("href","<?=funciones_strategix_version_url_random_base_url("Login")?>");
                        } 
                    });  
                    break;
                default:
                    $.each(data, function(key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key).parents('.form-group').find('#error').html(value);
                        $('#txtUsuarioNombre').focus();
                    });
                    break;                    
                }
            },
            error: function(data){
            console.log(data);
            },
            complete: function(){ }
        });
    }
        function getQueryVariable(variable) {
           var query = window.location.search.substring(1);
           var vars = query.split("&");
           for (var i=0; i < vars.length; i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable) {
                   return pair[1];
               }
           }
           return false;
        }   
</script>