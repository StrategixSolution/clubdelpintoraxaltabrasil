<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<section id="actualizadatosperfil">
    <form id="frm_usuarios_actualizar_datos_admin_view" role="form" method="post" accept-charset="utf-8">
        <?= $token; ?>    
        <div class="panel-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_pagina_titulo') ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row panel-gray">
                <div class="col-lg-12">
                    <div class="form-rf-1 form-pr" id="form-rf-1">
                        <div class="line-dashed-gray"></div>
                        <div class="row row-validator">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txtnombre"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_nombre') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_tooltip_nombre') ?>'><i class="fas fa-question-circle"></i></span></label>
                                    <input type="text" name="txt_nombre" id="txt_nombre" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_nombre') ?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                                    <div id="error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3" id="div_segundo_nombre">
                                <div class="form-group">
                                    <label for="txt_segundo_nombre"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_segundo_nombre') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_tooltip_segundo_nombre') ?>'><i class="fas fa-question-circle"></i></span></label>
                                    <input type="text" name="txt_segundo_nombre" id="txt_segundo_nombre" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_segundo_nombre') ?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="50">
                                    <div id="error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txt_apellido_paterno"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_apellido_paterno') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_tooltip_apellido_paterno') ?>'><i class="fas fa-question-circle"></i></span></label>
                                    <input type="text" name="txt_apellido_paterno" id="txt_apellido_paterno" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_apellido_paterno') ?>" onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="50">
                                    <div id="error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txt_apellido_materno"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_apellido_materno') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_tooltip_apellido_materno') ?>'><i class="fas fa-question-circle"></i></span></label>
                                    <input type="text" name="txt_apellido_materno" id="txt_apellido_materno" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_apellido_materno') ?>" onkeyup="return js_general_solo_texto_espacios(event,this)" maxlength="50">
                                    <div id="error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-validator">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txt_email"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_email') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_tooltip_email') ?>'><i class="fas fa-question-circle"></i></span></label>
                                    <input type="text" name="txt_email" id="txt_email" class="form-control" placeholder="<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_email') ?>" maxlength="50"> 
                                    <div id="error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txt_telefono"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_telefono') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_tooltip_telefono') ?>'><i class="fas fa-question-circle"></i></span></label>
                                    <input type="text" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_telefono') ?>" onKeyPress="return js_general_solo_numeros(event)" maxlength="10">
                                    <div id="error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txt_celular"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_celular') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_tooltip_celular') ?>'><i class="fas fa-question-circle"></i></span></label>
                                    <input type="text" name="txt_celular" id="txt_celular" class="form-control" placeholder="<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_celular') ?>" onKeyPress="return js_general_solo_numeros(event)" maxlength="10">
                                    <!--<label id="validar_celular"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_validar') ?></label>-->
                                    <div id="error"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="txt_telefono"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_clave') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_tooltip_clave') ?>'><i class="fas fa-question-circle"></i></span></label>
                                    <input type="password" class="form-control trans" name="txt_clave_nueva" value="" id="txt_clave_nueva" placeholder='<?=$this->lang->line('usuarios_actualizar_datos_controller_lang_placeholder_clave')?>' aria-describedby="basic-addon1">
                                    <div class="input-ver"id="eyeclave"> <span class=""><i class="far fa-eye-slash eyeclave" id="eyeclave1" aria-hidden="true"></i></span></div>
                                    <div id="error"></div>
                                </div>
                            </div>                            
                        </div>
                        <di>
                            <hr class="separador">
                        </di>
                        <div class="row" style="margin-top:20px; text-align:center;">
                            <div class="col-lg-2 offset-lg-8 col-6">
                                <?PHP if (funciones_strategix_valida_terminos_condiciones_aviso_privacidad_actualiza_datos($this->session->userdata(funciones_strategix_sitio_alias('s_actualiza_datos'))) == 1) {
                                    $pag = "Inicio";
                                    $regresar = $this->lang->line('usuarios_actualizar_datos_controller_lang_boton_regresar');
                                } else {
                                    $pag = "logout";
                                    $regresar = $this->lang->line('usuarios_actualizar_datos_controller_lang_boton_salir');
                                } ?>
                                <button type="button" onclick="window.location.href='<?= funciones_strategix_version_url_random_base_url($pag) ?>'" class="btn btn-gray"><i class="far fa-caret-square-left"></i> <?= $regresar ?></button>
                            </div>
                            <div class="col-lg-2 col-6">
                                <div class="d-grid gap-2">
                                    <button type="button" id="usuarios_actualizar_datos_admin_boton_guardar" class="btn btn-axalta"><i class="far fa-save"></i> <?= $this->lang->line('usuarios_actualizar_datos_controller_lang_boton_guardar') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<script>
    $(document).ready(function() {
        //setInterval(usuarios_actualizar_datos_admin_js_validar_correo_celular, 10000);
        /********************************************MSG ERROR******************************************************************************************/
        $('#frm_usuarios_actualizar_datos_admin_view input').on('keyup', function()  { js_general_limpiar_errores(this); });
        $('#frm_usuarios_actualizar_datos_admin_view input').on('click', function()  { js_general_limpiar_errores(this); });
        $('#frm_usuarios_actualizar_datos_admin_view select').on('click', function() { js_general_limpiar_errores(this); });
        $('#frm_usuarios_actualizar_datos_admin_view input').on('change', function() { js_general_limpiar_errores(this); });
        /********************************************EYE PARA LA CLAVE******************************************************************************************/
        $("#eyeclave1").click(function(){
        if($("#txt_clave_nueva").prop('type')=='text'){
            $("#txt_clave_nueva").prop('type','password');
            $("#eyeclave1").removeClass("fa-eye");
            $("#eyeclave1").addClass("fa-eye-slash");
        }else{
            $("#txt_clave_nueva").prop('type','text');
            $("#eyeclave1").removeClass("fa-eye-slash");
            $("#eyeclave1").addClass("fa-eye");
            }
        });        
        /*********************************************BOTON DE GUARDADO*****************************************************************************************/
        $("#usuarios_actualizar_datos_admin_boton_guardar").click(function() { usuarios_actualizar_datos_admin_js_guardar(); });
        /*********************************************SE MANDA A LLAMAR LOS DATOS DEL FORMULARIO*****************************************************************************************/
        usuarios_actualizar_datos_admin_js_datos();
        /*********************************************VALIDAR EMAI Y CELULAR*****************************************************************************************/
        usuarios_actualizar_datos_admin_js_validar_campos();
        $('#txt_email').on('change', function() { usuarios_actualizar_datos_admin_js_validar_campos(); });
        $('#txt_celular').on('change', function() { usuarios_actualizar_datos_admin_js_validar_campos(); });
    });
    function usuarios_actualizar_datos_admin_js_validar_campos(){
        if ($('#txt_email').val()==""){
            $('#validar_email').hide();
        } else {
            $('#validar_email').show();
        }
        if ($('#txt_celular').val()==""){
            $('#validar_celular').hide();
        } else {
            $('#validar_celular').show();
        }        
    }
    function usuarios_actualizar_datos_admin_js_datos() {
        $('#loader_panel').show();
        $.ajax({
            type: "POST",
            url: "<?php echo funciones_strategix_version_url_random_base_url("usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_datos") ?>",
            data: $("#frm_usuarios_actualizar_datos_admin_view").serialize(),
            dataType: "json",
            success: function(data) {
                $.each(data, function(key, value) {
                    $('#' + key).val(value);
                });
                usuarios_actualizar_datos_admin_js_validar_correo_celular();
                setTimeout('$("#loader_panel").hide();', 10000);
            },
            error: function() {},
            complete: function() {}
        });
    }
    function usuarios_actualizar_datos_admin_js_validar_correo_celular() {    
        $.ajax({
            type: "POST",
            url: "<?php echo funciones_strategix_version_url_random_base_url("usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_validar_correo_celular") ?>",
            data: $("#frm_usuarios_actualizar_datos_admin_view").serialize(),
            dataType: "json",
            success: function(data) {
                const fechaActual = new Date();
                switch (data.validar_email) {
                    case 0:
                        $('#validar_email').html('<a href="javascript:usuarios_actualizar_datos_admin_js_envia_email()"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_validar') ?></a>');
                        break;
                    case 1:
                        $('#validar_email').html('<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_espera') ?>');
                        break;
                    case 2:
                        $('#validar_email').html('<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_validado') ?>');
                        break;                        
                }
//                switch (data.validar_celular) {
//                    case 0:
//                        $('#validar_celular').html('<a href="javascript:()"><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_validar') ?></a>');
//                        break;
//                    case 1:
//                        $('#validar_celular').html('<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_espera') ?>');
//                        break;
//                    case 2:
//                        $('#validar_celular').html('<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_validado') ?>');
//                        break;                        
//                }                
                usuarios_actualizar_datos_admin_js_validar_campos();
            },
            error: function() {},
            complete: function() {}
        });
    }    
    function usuarios_actualizar_datos_admin_js_envia_email(){
        $.ajax({
            type: "POST",
            url: "<?php echo funciones_strategix_version_url_random_base_url("usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_enviar_correo_validacion") ?>",
            data: $("#frm_usuarios_actualizar_datos_admin_view").serialize(),
            dataType: "json",
            success: function(data) {
                switch (data) {
                    case 1:
                            Swal.fire({icon: 'info',title: '',text: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_email_activo') ?>'});
                            usuarios_actualizar_datos_admin_js_validar_correo_celular();
                        break;
                    case 2:
                            Swal.fire({icon: 'info',title: '',text: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_email_enviado') ?>'});
                            usuarios_actualizar_datos_admin_js_validar_correo_celular();
                        break;
                }
            },
            error: function(data) {
            },
            complete: function() {
                $('#loader_panel').hide();
            }
        });    
    }
    function usuarios_actualizar_datos_admin_js_valida_celular(){
        $.ajax({
            type: "POST",
            url: "<?php echo funciones_strategix_version_url_random_base_url("usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_validar_celular") ?>",
            data: $("#frm_usuarios_actualizar_datos_admin_view").serialize(),
            dataType: "json",
            success: function(data) {

            },
            error: function(data) {
            },
            complete: function() {
                $('#loader_panel').hide();
            }
        });  
    }
    function usuarios_actualizar_datos_admin_js_guardar() {
        $('#error').html(" ");
        var datos = '<table class="table txt-left txt-12"><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_nombre') ?></b></td><td>' + $('#txt_nombre').val().toUpperCase() + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_segundo_nombre') ?></b></td><td>' + $('#txt_segundo_nombre').val().toUpperCase() + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_apellido_paterno') ?></b></td><td>' + $('#txt_apellido_paterno').val().toUpperCase() + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_apellido_materno') ?></b></td><td>' + $('#txt_apellido_materno').val().toUpperCase() + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_email') ?></b></td><td>' + $('#txt_email').val() + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_telefono') ?></b></td><td>' + $('#txt_telefono').val() + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_actualizar_datos_controller_lang_input_celular') ?></b></td><td>' + $('#txt_celular').val() + '</td></tr></table>';
        Swal.fire({
            title: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_confirm_texto') ?>',
            html: datos,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_confirm_boton_aprobado') ?>',
            cancelButtonText: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_confirm_boton_rechazado') ?>',
            allowOutsideClick: false
        }).then((confirma_actualiza_datos) => {
            if (confirma_actualiza_datos.isConfirmed) {
                $("#usuarios_actualizar_datos_admin_boton_guardar").attr('disabled', true);
                $('#loader_panel').show();
                $.ajax({
                    type: "POST",
                    url: "<?php echo funciones_strategix_version_url_random_base_url("usuarios/usuarios_actualizar_datos/usuarios_actualizar_datos_controller/usuarios_actualizar_datos_controller_guardar") ?>",
                    data: $("#frm_usuarios_actualizar_datos_admin_view").serialize(),
                    dataType: "json",
                    success: function(data) {
                        <?PHP $pag = (funciones_strategix_valida_terminos_condiciones_aviso_privacidad_actualiza_datos($this->session->userdata(funciones_strategix_sitio_alias('s_actualiza_datos')))) ? "UsuariosActualizarDatos" : "Inicio"; ?>
                        switch (data) {
                            case 0:
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_participante_no_inserto') ?>'
                                });
                                $("#usuarios_actualizar_datos_admin_boton_guardar").attr('disabled', false);
                                break;
                            case 1:
                                Swal.fire({
                                    title: '',
                                    html: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_participante_inserto') ?>',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#fd7e14',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_swal_ok') ?>',
                                    cancelButtonText: '',
                                }).then((validacionaltaparticipante) => {
                                    if (validacionaltaparticipante.isConfirmed) {
                                        $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url($pag) ?>");
                                    }
                                });
                                break;
                            case 2:
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_limite_participante') ?>'
                                });
                                break;
                            case 3:
                                Swal.fire({
                                    title: '',
                                    html: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_participante_error_corroe') ?>',
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#fd7e14',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_swal_ok') ?>',
                                    cancelButtonText: ''
                                }).then((validacionaltaparticipante) => {
                                    if (validacionaltaparticipante.isConfirmed) {
                                        $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url($pag) ?>");
                                    }
                                });
                                break;
                            case 4:
                                Swal.fire({
                                    title: '',
                                    html: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_email') ?>',
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#fd7e14',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_swal_ok') ?>',
                                    cancelButtonText: ''
                                }).then((validacionaltaparticipante) => {
                                    if (validacionaltaparticipante.isConfirmed) {
                                        
                                    }
                                });
                                break;
                            case 5:
                                Swal.fire({
                                    title: '',
                                    html: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_swal_validar_celular') ?>',
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#fd7e14',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: '<?= $this->lang->line('usuarios_actualizar_datos_controller_lang_js_msg_swal_ok') ?>',
                                    cancelButtonText: ''
                                }).then((validacionaltaparticipante) => {
                                    if (validacionaltaparticipante.isConfirmed) {
                                       
                                    }
                                });
                                break;                                
                            default:
                                $.each(data, function(key, value) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key).parents('.form-group').find('#error').html(value);
                                });
                                $("#usuarios_actualizar_datos_admin_boton_guardar").attr('disabled', false);
                                break;
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        $("#usuarios_actualizar_datos_boton_guardar").attr('disabled', false);
                    },
                    complete: function() {
                        $('#loader_panel').hide();
                    }
                });
                return 1;
            } else {
                return 0;
            }
        });
    }
</script>