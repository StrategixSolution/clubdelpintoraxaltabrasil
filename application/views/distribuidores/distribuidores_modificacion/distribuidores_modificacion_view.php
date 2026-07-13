<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form id="frm_distribuidores_modificacion" role="form" method="post" accept-charset="utf-8">

    <section id="editar_distribuidores">
        <div class="panel-title">
            <input id="DistribuidorId" name="DistribuidorId" type="hidden" value="<?= $DistribuidorId ?>">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><?= $this->lang->line('distribuidores_modificacion_controller_lang_titulo') ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="panel-white">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="form-rf-1">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label
                                            for="txt_razon_social"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_razon_social') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_razon_social') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_razon_social" id="txt_razon_social" class="form-control txt-mayus"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_razon_social') ?>"
                                            maxlength="128">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12" id="div_nombre_comercial">
                                    <div class="form-group">
                                        <label
                                            for="txt_nombre_comercial"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_nombre_comercial') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_nombre_comercial') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_nombre_comercial" id="txt_nombre_comercial"
                                            class="form-control txt-mayus"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_nombre_comercial') ?>"
                                            maxlength="128">
                                        <div id="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <label
                                            for="txt_codigo_distribuidor"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_codigo_distribuidor') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_codigo_distribuidor') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_codigo_distribuidor" id="txt_codigo_distribuidor" class="form-control"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_codigo_distribuidor') ?>"
                                            onKeyPress="return js_general_solo_numeros(event)" maxlength="8">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <label
                                            for="txt_codigo_postal"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_codigo_postal') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_codigo_postal') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_codigo_postal" id="txt_codigo_postal" class="form-control txt-mayus"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_codigo_postal') ?>"
                                            onKeyPress="return js_general_solo_numeros(event)" maxlength="10">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <label
                                            for="txt_estado"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_estado') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_estado') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_estado" id="txt_estado" class="form-control txt-mayus"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_estado') ?>"
                                            maxlength="128">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label
                                            for="txt_ciudad"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_ciudad') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_ciudad') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_ciudad" id="txt_ciudad" class="form-control txt-mayus"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_ciudad') ?>"
                                            maxlength="128">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label
                                            for="txt_municipio"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_municipio') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_municipio') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_municipio" id="txt_municipio" class="form-control txt-mayus"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_municipio') ?>"
                                            maxlength="128">
                                        <div id="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label
                                            for="txt_calle"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_calle') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_calle') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_calle" id="txt_calle" class="form-control txt-mayus"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_calle') ?>"
                                            maxlength="128">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                        <label
                                            for="txt_rfc"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_rfc') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_rfc') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_rfc" id="txt_rfc" class="form-control txt-mayus"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_rfc') ?>"
                                            onKeyPress="return js_general_nit(event)" maxlength="25">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                        <label
                                            for="txt_telefono"><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_telefono') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_tooltip_telefono') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <input type="text" name="txt_telefono" id="txt_telefono" class="form-control txt-mayus"
                                            placeholder="<?= $this->lang->line('distribuidores_modificacion_controller_lang_placeholder_telefono') ?>"
                                            onKeyPress="return js_general_solo_numeros(event)" maxlength="15">
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12" id="div_distribuidoras">
                                    <div class="form-group">
                                        <label
                                            for="cmb_regiones"><?= $this->lang->line('distribuidores_modificacion_controller_lang_combo_etiqueta_regiones') ?><span
                                                data-toggle='tooltip'
                                                title='<?= $this->lang->line('distribuidores_modificacion_controller_lang_combo_tooltip_regiones') ?>'><i
                                                    class="fas fa-question-circle"></i></span></label>
                                        <select id="cmb_regiones" name="cmb_regiones" class="form-select"></select>
                                        <div id="error"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <hr class="separador">
                            </div>
                            <div class="row justify-content-end" style="margin-top:20px; text-align:center;">
                                <div class="col-lg-2 col-6">
                                    <button type="button"
                                        onclick="window.location.href='<?= funciones_strategix_version_url_random_base_url("Distribuidores") ?>'"
                                        class="btn btn-gray"><i class="far fa-caret-square-left"></i>
                                        <span class="btn-buscar-texto"><?= $this->lang->line('distribuidores_modificacion_controller_lang_boton_regresar') ?></span></button>
                                </div>
                                <div class="col-lg-2 col-6">
                                    <button type="button" id="distribuidores_modificacion_boton_guardar" class="btn btn-axalta btn-buscar-ancho"><i
                                            class="far fa-save"></i>
                                        <span class="btn-buscar-texto"><?= $this->lang->line('distribuidores_modificacion_controller_lang_boton_guardar') ?></span></button>
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
        /********************************************MSG ERROR******************************************************************************************/
        $('#frm_distribuidores_modificacion input').on('keyup', function() {
            js_general_limpiar_errores(this);
        });
        $('#frm_distribuidores_modificacion input').on('click', function() {
            js_general_limpiar_errores(this);
        });
        $('#frm_distribuidores_modificacion select').on('click', function() {
            js_general_limpiar_errores(this);
        });
        $('#frm_distribuidores_modificacion input').on('change', function() {
            js_general_limpiar_errores(this);
        });
        /**************************************************************************************************************************************/
        distribuidores_modificacion_view_js_combo_region();
        distribuidores_modificacion_view_js_datos();
        $("#distribuidores_modificacion_boton_guardar").click(function() {
            distribuidores_modificacion_view_js_guardar();
        });
    });

    function distribuidores_modificacion_view_js_datos() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'distribuidores/distribuidores_modificacion/distribuidores_modificacion_controller/distribuidores_modificacion_controller_datos',
            dataType: 'json',
            data: $("#frm_distribuidores_modificacion").serialize(),
            success: function(data) {
                $("#txt_razon_social").val(data.DistribuidorDetalleRazonSocial);
                $("#txt_nombre_comercial").val(data.DistribuidorDetalleNombreComercial);
                $("#txt_codigo_distribuidor").val(data.DistribuidorDetalleCodigo);
                $("#txt_codigo_postal").val(data.DistribuidorDetalleCP);
                $("#txt_estado").val(data.DistribuidorDetalleEstado);
                $("#txt_ciudad").val(data.DistribuidorDetalleCiudad);
                $("#txt_municipio").val(data.DistribuidorDetalleMunicipio);
                $("#txt_calle").val(data.DistribuidorDetalleCalle);
                $("#txt_rfc").val(data.DistribuidorDetalleRFC);
                $("#txt_telefono").val(data.DistribuidorDetalleTelefono);
                $("#cmb_regiones").val(data.DistribuidorDetalleRegionId);
                setTimeout('$("#loader_panel").hide();', 9000);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function distribuidores_modificacion_view_js_combo_region() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'distribuidores/distribuidores_modificacion/distribuidores_modificacion_controller/distribuidores_modificacion_controller_combo_lista_regiones',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_regiones').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function distribuidores_modificacion_view_js_guardar() {
        $('#error').html(" ");
        var cmb_regiones = $('#cmb_regiones option:selected').text();
        var txt_razon_social = $('#txt_razon_social').val();
        var txt_nombre_comercial = $('#txt_nombre_comercial').val();
        var txt_codigo_distribuidor = $('#txt_codigo_distribuidor').val();
        var txt_codigo_postal = $('#txt_codigo_postal').val();
        var txt_estado = $('#txt_estado').val();
        var txt_municipio = $('#txt_municipio').val();
        var txt_ciudad = $('#txt_ciudad').val();
        var txt_calle = $('#txt_calle').val();
        var txt_rfc = $('#txt_rfc').val();
        var txt_telefono = $('#txt_telefono').val();
        var data = '<table class="table table-striped table-bordered" style="text-align:left; font-size:12px;"><tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_razon_social') ?></b></td><td>' + txt_razon_social + '</td></tr><tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_nombre_comercial') ?></b></td><td>' + txt_nombre_comercial + '</td></tr><tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_codigo_distribuidor') ?></b></td><td>' + txt_codigo_distribuidor + '</td></tr><tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_codigo_postal') ?></b></td><td>' + txt_codigo_postal + '</td></tr><tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_municipio') ?></b></td><td>' + txt_municipio + '</td></tr><tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_ciudad') ?></b></td><td>' + txt_ciudad + '</td></tr><tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_calle') ?></b></td><td>' + txt_calle + '</td></tr></tr><tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_rfc') ?></b></td><td>' + txt_rfc + '</td></tr><tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_telefono') ?></b></td><td>' + txt_telefono + '</td></tr>';
        if (cmb_regiones === undefined || cmb_regiones == "") {} else {
            data = data + '<tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_combo_etiqueta_regiones') ?></b></td><td>' + cmb_regiones + '</td></tr>';
        };
        data = data + '</table>';
        Swal.fire({
            title: '<?= $this->lang->line('participantes_altas_js_confirm_titulo') ?>',
            html: data,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?= $this->lang->line('distribuidores_modificacion_controller_lang_confirm_boton_aprobado') ?>',
            cancelButtonText: '<?= $this->lang->line('distribuidores_modificacion_controller_lang_confirm_boton_rechazado') ?>',
            allowOutsideClick: false
        }).then((valida_form_distribuidores) => {
            if (valida_form_distribuidores.isConfirmed) {
                $('#loader_panel').show();
                $.ajax({
                    type: "POST",
                    url: "<?php echo funciones_strategix_version_url_random_base_url("distribuidores/distribuidores_modificacion/distribuidores_modificacion_controller/distribuidores_modificacion_controller_valida_guarda_distribuidor") ?>",
                    data: $("#frm_distribuidores_modificacion").serialize(),
                    dataType: "json",
                    success: function(data) {
                        switch (data) {
                            case 1:
                                Swal.fire({
                                    title: '',
                                    html: '<?= $this->lang->line('distribuidores_modificacion_controller_lang_guardado_js_msg_swal_texto') ?>',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#fd7e14',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: '<?= $this->lang->line('distribuidores_modificacion_controller_lang_confirm_boton_aprobado') ?>',
                                }).then((validacionaltaparticipante) => {
                                    $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url("Distribuidores") ?>");
                                });
                                break;
                            case 2:
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
                        console.log(data);
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