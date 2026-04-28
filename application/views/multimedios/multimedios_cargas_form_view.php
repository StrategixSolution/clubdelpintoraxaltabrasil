<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>
<form action="" id="frm_multimedios_cargas_form_view" role="form" enctype="multipart/form-data" method="post"
    accept-charset="utf-8">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?=$this->lang->line('multimedios_cargas_controller_lang_titulo')?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="multimedios_cargas_form_view_cmb_modulos"><?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_modulos')?></label>
                        <select id="multimedios_cargas_form_view_cmb_modulos"
                            name="multimedios_cargas_form_view_cmb_modulos" class="chosen-select form-select"
                            data-placeholder="<?=$this->lang->line('multimedios_cargas_controller_lang_placeholder_modulos')?>" tabindex="2"></select>
                        <div id="error"></div>
                    </div>
                </div>
                <div class="" style="display: none;" id="div_opciones">
                    <hr class="separador">
                    <!-- <label for="">PAÍS</label>
                    <div id="check_pais" class="row mb-3"></div>-->
                    <label for=""><?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_perfil')?></label>
                    <div id="check_perfil" class="row mb-3"></div>
                </div>
                <div class="" style="display: none;" id="div_fechas">
                    <div class="row">
                        <div class="col-lg-5" id="div_fecha_inicio">
                            <div class="form-group">
                                <label for="fecha_inicio"><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_fecha_i')?></label>
                                <input type="date" name="multimedios_cargas_form_view_fecha_inicio"
                                    id="multimedios_cargas_form_view_fecha_inicio" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-5" id="div_fecha_fin">
                            <div class="form-group">
                                <label for="fecha_fin"><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_fecha_f')?></label>
                                <input type="date" name="multimedios_cargas_form_view_fecha_fin"
                                    id="multimedios_cargas_form_view_fecha_fin" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2 btn-buscar-posicion" style="text-align: left;" id="div_download">
                            <div class="form-group">
                                <input type="checkbox" id="multimedios_cargas_form_view_chk_descarga" name="multimedios_cargas_form_view_chk_descarga" value=1 />
                                <label for="multimedios_cargas_form_view_chk_descarga"><?=$this->lang->line('multimedios_cargas_controller_lang_etiqueta_descarga')?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="multimedios_cargas_form_view_form2" class="row" style="display:contents;"></div>
            </div>
            <div id="multimedios_cargas_form_view_tabla"></div>
        </div>
    </div>
    </section>
</form>
<script>
    $(document).ready(function () {
        multimedios_cargas_form_view_js_combo_modulos();
        // multimedios_cargas_form_view_js_check_paises();
        multimedios_cargas_form_view_js_check_perfiles();
        $('#multimedios_cargas_form_view_cmb_modulos').on('change', function () {
            $('#multimedios_cargas_form_view_form2').empty();
            $('#multimedios_cargas_form_view_tabla').empty();
            var modulos = $('#multimedios_cargas_form_view_cmb_modulos').val();
            if (modulos != 0) {
                multimedios_cargas_form_view_tabla();
                $('#div_opciones').show();
                //    if (modulos == 1) {
                $('#div_fechas').show();
                //  } else {
                //  $('#div_fechas').hide();
                // }
            } else {
                $('#div_opciones').hide();
                $('#div_fechas').hide();
            }
        });
    });

    function multimedios_cargas_form_view_js_combo_modulos() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_combo_modulos',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function (data) {
                $('#multimedios_cargas_form_view_cmb_modulos').empty();
                $('#multimedios_cargas_form_view_cmb_modulos').html(data);
            },
            error: function (data) { },
            complete: function () {
                $('#loader_panel').hide();
            }
        });
    }

    /*function multimedios_cargas_form_view_js_revisa_paises(check_pais) {
        if (check_pais.attr("name") == "check_pais_0") {
            if (check_pais.is(':checked') == true) {
                $('input[id="check_pais[]"]').each(function () {
                    this.checked = true;
                });
            } else {
                $('input[id="check_pais[]"]').each(function () {
                    this.checked = false;
                });
            }
        } else {
            multimedios_cargas_form_view_js_revisa_paises_all();
        }
    }*/

    /*  function multimedios_cargas_form_view_js_revisa_paises_all() {
          $("input:checkbox[id='check_pais[]']").each(function () {
              if ($(this).is(':checked') == false && ($(this).attr("name") != "check_pais_0")) {
                  $('input[name="check_pais_0"]').prop('checked', false);
                  return false;
              } else {
                  $('input[name="check_pais_0"]').prop('checked', true);
              }
          });
      }*/

    function multimedios_cargas_form_view_js_revisa_perfiles(check_perfil) {
        if (check_perfil.attr("name") == "check_perfil_0") {
            if (check_perfil.is(':checked') == true) {
                $('input[id="check_perfil[]"]').each(function () {
                    this.checked = true;
                });
            } else {
                $('input[id="check_perfil[]"]').each(function () {
                    this.checked = false;
                });
            }
        } else {
            multimedios_cargas_form_view_js_revisa_perfiles_all();
        }
    }

    function multimedios_cargas_form_view_js_revisa_perfiles_all() {
        $("input:checkbox[id='check_perfil[]']").each(function () {
            if ($(this).is(':checked') == false && ($(this).attr("name") != "check_perfil_0")) {
                $('input[name="check_perfil_0"]').prop('checked', false);
                return false;
            } else {
                $('input[name="check_perfil_0"]').prop('checked', true);
            }
        });
    }

    /*function multimedios_cargas_form_view_js_check_paises() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_lista_paises',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function (data) {
                $.each(data, function (d, v) {
                    let htmlTags = `<div class="col-lg-3">
                                        <div class="form-check" style="border:1px solid #c82127; border-radius:10px; padding:5px 10px; margin:10px 0px;">
                                            <input type="checkbox" class="form-check-input" id="check_pais[]" name="check_pais_${d}" value="${d}" style="margin-left:2px;" onclick="multimedios_cargas_form_view_js_revisa_paises($(this))">
                                            <label class="form-check-label fs-11" style="padding-left: 5px;" for="${d}">${v}</label></div>
                                        </div> 
                                    </div> 
                                    `;
                    $('#check_pais').append(htmlTags);
                });
            },
            error: function (data) { },
            complete: function () {
                $('#loader_panel').hide();
            }
        });
    }*/

    function multimedios_cargas_form_view_js_check_perfiles() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_lista_perfiles',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function (data) {
                $.each(data, function (d, v) {
                    let htmlTags = `<div class="col-lg-3">
                                        <div class="form-check" style="border:1px solid #c82127; border-radius:10px; padding:5px 10px; margin:10px 0px;">
                                            <input type="checkbox" class="form-check-input" id="check_perfil[]" name="check_perfil_${d}" value="${d}" style="margin-left:2px;" onclick="multimedios_cargas_form_view_js_revisa_perfiles($(this))">
                                            <label class="form-check-label fs-11" style="padding-left: 5px;" for="${d}">${v}</label></div>
                                        </div> 
                                    </div> 
                                    `;
                    $('#check_perfil').append(htmlTags);
                });
            },
            error: function (data) { },
            complete: function () {
                $('#loader_panel').hide();
            }
        });
    }

    function multimedios_cargas_form_view_tabla() {
        $('#loader_panel').show();
        $('#multimedios_cargas_form_view_form2').empty();
        $('#multimedios_cargas_form_view_tabla').empty();
        var modulos = $("#multimedios_cargas_form_view_cmb_modulos").val();
        $.ajax({
            type: 'POST',
            url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_form_tabla',
            dataType: 'json',
            data: {
                modulos: modulos
            },
            success: function (data) {
                $('#multimedios_cargas_form_view_form2').html(data.form2);
                $('#multimedios_cargas_form_view_tabla').html(data.tabla);
            },
            error: function (data) {
                console.log("error");
                console.log(data);
            },
            complete: function () {
                $('#loader_panel').hide();
            }
        });
    }

    function multimedios_cargas_form_view_js_baja(id, modulos) {
        Swal.fire({
            title: '',
            html: "<?=$this->lang->line('multimedios_cargas_controller_lang_js_baja_confirm')?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?=$this->lang->line('multimedios_cargas_controller_lang_js_aceptar')?>',
            cancelButtonText: '<?=$this->lang->line('multimedios_cargas_controller_lang_js_cancelar')?>',
            allowOutsideClick: false
        }).then((valida) => {
            if (valida.isConfirmed) {
                $('#loader_panel').show();
                $.ajax({
                    type: 'POST',
                    url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_baja',
                    dataType: 'json',
                    data: {
                        id: id,
                        modulos: modulos
                    },
                    success: function (data) {
                        $('#multimedios_cargas_form_view_tabla').empty();
                        $('#multimedios_cargas_form_view_tabla').html(data.tabla);
                        Swal.fire({
                            icon: 'success',
                            title: '',
                            text: '<?=$this->lang->line('multimedios_cargas_controller_lang_js_baja_exitosa')?>'
                        });
                    },
                    error: function (data) { },
                    complete: function () {
                        $('#loader_panel').hide();
                    }
                });
            }
        });

    }
</script>