<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                         * 
 * @CreateDate 01 May. 2026 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>
<div class="col-lg-4 col-12">
    <div class="form-group">
        <label for="multimedios_cargas_form_view_cmb_tipos"><?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_tipos')?></label>
        <select id="multimedios_cargas_form_view_cmb_tipos" name="multimedios_cargas_form_view_cmb_tipos" class="chosen-select form-select" data-placeholder="<?=$this->lang->line('multimedios_cargas_controller_lang_placeholder_tipos')?>" tabindex="2"></select>
        <div id="error"></div>
    </div>
</div>
<span id="popup_view_form" style="display:contents; display: none;">
    <!-- <div class="col-lg-3 col-12">
                <div class="form-group">
                    <label for="multimedios_cargas_form_view_cmb_division"><?= $this->lang->line('multimedios_cargas_controller_lang_etiqueta_division') ?></label>
                    <select id="multimedios_cargas_form_view_cmb_division" name="multimedios_cargas_form_view_cmb_division" class="chosen-select form-select" data-placeholder="<?= $this->lang->line('multimedios_cargas_controller_lang_placeholder_division') ?>" tabindex="2"></select>
                    <div id="error"></div>
                </div>
            </div>-->
    <div class="col-lg-6 col-12" id="popup_view_form_archivo" style="display: none;">
        <div class="form-group">
            <label for="multimedios_cargas_form_view_file"><?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_archivo')?></label>
            <input type="file" name="multimedios_cargas_form_view_file" id="multimedios_cargas_form_view_file" class="form-control" placeholder="<?=$this->lang->line('multimedios_cargas_controller_lang_placeholder_archivo')?>">
            <div id="error"></div>
        </div>
    </div>
    <div class="col-lg-12 col-12" id="popup_view_form_text" style="display: none;">
        <div class="form-group">
            <label for="multimedios_cargas_form_view_text_area">HTML:</label>
            <textarea id="multimedios_cargas_form_view_text_area" name="multimedios_cargas_form_view_text_area" class="form-control"></textarea>
            <div id="error"></div>
        </div>
    </div>
    <div class="col-lg-2 col-12">
        <div class="form-group">
            <button type="submit" id="multimedios_cargas_popup_form_view_btn_guardar" class="btn btn-axalta btn-buscar-ancho" style="margin-top:20px;"><i class="far fa-save pr-5"></i> GUARDAR</button>
        </div>
    </div>
</span>
<script>
    $(document).ready(function() {
        /********************************************MSG ERROR******************************************************************************************/
        js_general_valida_uploads_archivos('multimedios_cargas_form_view_file', ['mp4', 'pdf', 'png', 'jpg', 'jpeg'], 'EL ARCHIVO SUPERA EL LÍMITE PERMITIDO', 'ARCHIVO CON EXTENSIÓN NO PERMITIDA');
        $('#frm_multimedios_cargas_form_view input').on('keyup', function() {
            js_general_limpiar_errores(this);
        });
        $('#frm_multimedios_cargas_form_view input').on('click', function() {
            js_general_limpiar_errores(this);
        });
        $('#frm_multimedios_cargas_form_view select').on('click', function() {
            js_general_limpiar_errores(this);
        });
        $('#frm_multimedios_cargas_form_view input').on('change', function() {
            js_general_limpiar_errores(this);
        });
        $('#frm_multimedios_cargas_form_view textarea').on('click', function() {
            js_general_limpiar_errores(this);
        });
        /**************************************************************************************************************************************/
        $("#multimedios_cargas_popup_form_view_btn_guardar").click(function(e) {
            e.preventDefault();
            if (multimedios_cargas_form_view_js_valida_perfiles() == 0) {
                Swal.fire({
                    title: '',
                    html: '<?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_sel_perfil')?>',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#008dab',
                    allowOutsideClick: false,
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'OK',
                    cancelButtonText: ''
                }).then((validaestatus) => {
                    if (validaestatus.isConfirmed) {
                        return false;
                    }
                });
            } else if (multimedios_cargas_form_view_js_valida_fechas() == 0) {
                Swal.fire({
                    title: '',
                    html: '<?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_sel_fechas')?>',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#008dab',
                    allowOutsideClick: false,
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'OK',
                    cancelButtonText: ''
                }).then((validaestatus) => {
                    if (validaestatus.isConfirmed) {
                        return false;
                    }
                });
            } else if (multimedios_cargas_form_view_js_valida_fechas() == 1) {
                Swal.fire({
                    title: '',
                    html: '<?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_valida_fechas')?>',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#008dab',
                    allowOutsideClick: false,
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'OK',
                    cancelButtonText: ''
                }).then((validaestatus) => {
                    if (validaestatus.isConfirmed) {
                        return false;
                    }
                });
            } else {
                var tipos = $('#multimedios_cargas_form_view_cmb_tipos').val();
                if (tipos == 4) {
                    multimedios_cargas_form_view_js_guarda_texto();
                } else {
                    multimedios_cargas_form_view_js_guarda_archivo();
                }
            }
        });
        multimedios_cargas_form_view_js_combo_tipos();
        // multimedios_cargas_form_notificaciones_view_js_combo_division();
        $('#multimedios_cargas_form_view_cmb_tipos').on('change', function() {
            $('#multimedios_cargas_form_view_file').val('');
            var tipos = $('#multimedios_cargas_form_view_cmb_tipos').val();
            if (tipos == 0) {
                $('#popup_view_form').hide();
            } else if (tipos == 4) {
                $('#popup_view_form').show();
                $('#popup_view_form').css("display", "contents");
                $('#popup_view_form_text').show();
                $('#popup_view_form_archivo').hide();
            } else {
                $('#popup_view_form').show();
                $('#popup_view_form').css("display", "contents");
                $('#popup_view_form_text').hide();
                $('#popup_view_form_archivo').show();
            }
        });
    });

    function multimedios_cargas_form_view_js_valida_paises() {
        var cont = 0;
        $("input:checkbox[id='check_pais[]']").each(function() {
            if ($(this).is(':checked') == true) {
                cont++;
            }
        });
        return cont;
    }

    function multimedios_cargas_form_view_js_valida_perfiles() {
        var cont = 0;
        $("input:checkbox[id='check_perfil[]']").each(function() {
            if ($(this).is(':checked') == true) {
                cont++;
            }
        });
        return cont;
    }

    function multimedios_cargas_form_view_js_valida_fechas() {
        if ($("#multimedios_cargas_form_view_fecha_inicio").val() != "" && $("#multimedios_cargas_form_view_fecha_fin").val() != "") {
            if ($("#multimedios_cargas_form_view_fecha_inicio").val() > $("#multimedios_cargas_form_view_fecha_fin").val()) {
                return 1;
            }
        } else {
            return 0;
        }

    }

    function multimedios_cargas_form_view_js_combo_tipos() {
        $('#loader_panel').show();
        var modulos = $('#multimedios_cargas_form_view_cmb_modulos').val();
        $.ajax({
            type: 'POST',
            url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_combo_tipos',
            dataType: 'json',
            data: {
                multimedios_cargas_form_view_cmb_modulos: modulos
            },
            success: function(data) {
                $('#multimedios_cargas_form_view_cmb_tipos').empty();
                $('#multimedios_cargas_form_view_cmb_tipos').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
    /*function multimedios_cargas_form_notificaciones_view_js_combo_division() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_combo_division',
            dataType: 'json',
            data: {1:1 },
            success: function(data) {
                $('#multimedios_cargas_form_view_cmb_division').empty();
                $('#multimedios_cargas_form_view_cmb_division').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }*/
    function multimedios_cargas_form_view_js_guarda_texto() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_guarda',
            dataType: 'json',
            data: $("#frm_multimedios_cargas_form_view").serialize(),
            success: function(data) {
                switch (data.resultado) {
                    case 1:
                        Swal.fire({
                            title: '',
                            html: '<?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_popup_creado')?>',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#008dab',
                            allowOutsideClick: false,
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'OK',
                            cancelButtonText: ''
                        }).then((validaestatus) => {
                            if (validaestatus.isConfirmed) {
                                location.reload();
                                /*    $('#multimedios_cargas_form_view_tabla').empty();
                                    $('#multimedios_cargas_form_view_tabla').html(data.tabla);
                                    $('#popup_view_form').hide();
                                    $('#popup_view_form_text').hide();
                                    $('#popup_view_form_archivo').hide();   
                                    $('#multimedios_cargas_form_view_cmb_tipos').val(0);     
                                    $('#div_opciones').hide(); 
                                    $('#div_fechas').hide();  
                                    $('input[name="check_pais_0"]').prop('checked', false);
                                    $('input[id="check_perfil[]"]').each(function() { this.checked = false; });  */
                            }
                        });

                        break;
                    default:
                        $.each(data, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).parents('.form-group').find('#error').html(value);
                        });
                        break;
                }
            },
            error: function(data) {
                console.log("error");
                console.log(data);
            },
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function multimedios_cargas_form_view_js_guarda_archivo() {
        var formData = new FormData($("#frm_multimedios_cargas_form_view")[0]);
        var multimedios_cargas_form_view_file = $('#multimedios_cargas_form_view_file').val();
        if (multimedios_cargas_form_view_file != "") {
            $('#loader_panel').show();
            $.ajax({
                type: 'POST',
                url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_guarda',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    switch (data.resultado) {
                        case 1:
                            Swal.fire({
                                title: '',
                                html: '<?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_archivo_cargado')?>',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#008dab',
                                allowOutsideClick: false,
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: 'OK',
                                cancelButtonText: ''
                            }).then((validaestatus) => {
                                if (validaestatus.isConfirmed) {
                                    location.reload();
                                    /*    $('#multimedios_cargas_form_view_tabla').empty();
                                        $('#multimedios_cargas_form_view_tabla').html(data.tabla);
                                        $('#popup_view_form').hide();
                                        $('#popup_view_form_text').hide();
                                        $('#popup_view_form_archivo').hide();   
                                        $('#multimedios_cargas_form_view_cmb_tipos').val(0);     
                                        $('#div_opciones').hide(); 
                                        $('#div_fechas').hide();  
                                        $('input[name="check_pais_0"]').prop('checked', false);
                                        $('input[id="check_pais[]"]').each(function() { this.checked = false; });
                                        $('input[name="check_perfil0"]').prop('checked', false);
                                        $('input[id="check_perfil[]"]').each(function() { this.checked = false; });*/
                                }
                            });
                            break;
                        default:
                            $.each(data, function(key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key).parents('.form-group').find('#error').html(value);
                            });
                            break;
                    }
                },
                error: function() {
                    //alert("error");
                    //Code
                },
                complete: function() {
                    $('#loader_panel').hide();
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "<?=$this->lang->line('multimedios_cargas_controller_lang_js_archivo_validar')?>"
            });
        }
    }
    'use strict';;
    (function(document, window, index) {
        var inputs = document.querySelectorAll('.inputfile');
        Array.prototype.forEach.call(inputs, function(input) {
            var label = input.nextElementSibling,
                labelVal = label.innerHTML;
            input.addEventListener('change', function(e) {
                var fileName = '';
                if (this.files && this.files.length > 1) {
                    fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                } else {
                    fileName = e.target.value.split('\\').pop();
                }
                if (fileName) {
                    label.querySelector('span').innerHTML = fileName;
                } else {
                    label.innerHTML = labelVal;
                }
            });
        });
    }(document, window, 0));
</script>