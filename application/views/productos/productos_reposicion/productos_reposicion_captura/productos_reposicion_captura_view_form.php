<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>
<section id="reposicionCaptura">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('productos_reposicion_captura_controller_lang_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel-white">
            <div class="form-rf-1" id="form-rf-1">
                <div class="row row-validator">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                            <label for="cmb_distribuidor"><?= $this->lang->line('productos_reposicion_captura_controller_lang_etiqueta_distribuidor') ?></label><br>
                            <select id="cmb_distribuidor" name="cmb_distribuidor" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                            <label for="cmb_anio"><?= $this->lang->line('productos_reposicion_captura_controller_lang_etiqueta_anio') ?></label><br>
                            <?= $anio ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                            <label for="cmb_mes"><?= $this->lang->line('productos_reposicion_captura_controller_lang_etiqueta_mes') ?></label>
                            <select id="cmb_mes" name="cmb_mes" class="form-select"></select>
                            <div id="error"></div>
                        </div>
                    </div>
                </div>
                <div class="row row-validator">
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                            <label for="cmb_participantes"><?= $this->lang->line('productos_reposicion_captura_controller_lang_etiqueta_participante') ?></label>
                            <select id="cmb_participantes" name="cmb_participantes" class="form-select">
                                <option value='0'><?= $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_participante') ?></option>
                            </select>
                            <div id="error"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="form-group">
                            <label for="cmb_premio"><?= $this->lang->line('productos_reposicion_captura_controller_lang_etiqueta_premmio') ?></label>
                            <select id="cmb_premio" name="cmb_premio" class="form-select">
                                <option value='0'><?= $this->lang->line('productos_reposicion_captura_controller_lang_placeholder_premio') ?></option>
                            </select>
                            <div id="error"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12" id="div_fecha_entrega" style="display: none;">
                        <div class="form-group">
                            <label for="fecha_entrega"><?= $this->lang->line('productos_reposicion_captura_controller_lang_etiqueta_fecha_entrega') ?></label>
                            <input type="date" name="fecha_entrega" id="fecha_entrega" max="<?= date("Y-m-d") ?>" class="form-control" onkeydown="return false">
                            <div id="error"></div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-12" style="margin-top:20px;" id="btn_guardar">
                        <button type="button" id="reposicionCaptura_boton_guardar" class="btn btn-axalta btn-buscar-ancho"><i class="far fa-save"></i><span class="btn-buscar-texto">GUARDAR</span></button>
                    </div> -->
                </div>
            </div>
            <P>
            <div id="tabla_productosReposicionCaptura"></div>
            <div id="reposiciom_captura_carga_fotos" style="display: none;">
                <main>
                    <article class="cargaDocumentos">
                        <div class="modal-header">
                            <h3 class="red-text titulos"><?= $this->lang->line('productos_reposicion_captura_controller_lang_titulo_carga') ?></h3>
                        </div>
                        <div class="carga panel-gray">
                            <div class="row row-validator">
                                <div class="col-sm-4 align-self-center">
                                    <div><?= $this->lang->line('productos_reposicion_captura_controller_lang_etiqueta_frase') ?></div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-3">
                                    <div class="form-check">
                                        <input type="checkbox" id="chk_ganador" name="chk_ganador" class="form-check-input">
                                        <label for="chk_ganador" class="form-check-label"> <?= $this->lang->line('productos_reposicion_captura_controller_lang_etiqueta_ganador') ?></label>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-3">
                                    <div class="form-check">
                                        <input type="checkbox" id="chk_firma" name="chk_firma" class="form-check-input">
                                        <label for="chk_firma" class="form-check-label"> <?= $this->lang->line('productos_reposicion_captura_controller_lang_etiqueta_firma') ?></label>
                                    </div>
                                </div>
                            </div>
                            <P>
                            <div id="zonaUpload">
                                <form action="<?= base_url('productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_controller/productos_reposicion_captura_controller_cargas_upload_archivo_fisico') ?>" class="dropzone" id="frmProductosReposicionCaptura">
                                    <input type="hidden" name="check_tipo" id="check_tipo" value="1" />
                                    <input type="hidden" name="anio_foto" id="anio_foto" value="" />
                                    <input type="hidden" name="mes_foto" id="mes_foto" value="" />
                                    <input type="hidden" name="id_dist" id="id_dist" value="" />
                                </form>

                                <div id="bodyCargas"></div>
                                <div class="txt-center"><br><small class="txt-center"><?= $this->lang->line('productos_reposicion_captura_controller_lang_msg_tipo_archivos') ?></small></div>
                            </div>
                    </article>
                </main>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-2 col-12" style="margin-top:20px;" id="btn_guardar">
                    <button type="button" id="reposicionCaptura_boton_guardar" class="btn btn-axalta btn-buscar-ancho"><i class="far fa-save"></i><span class="btn-buscar-texto">SALVAR</span></button>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var chk_ganador = $('#chk_ganador').val();
    var anio = <?= $anio ?>;
    Dropzone.options.frmProductosReposicionCaptura = {
        acceptedFiles: 'application/pdf,.zip,.JPG,.JPEG,.PNG',
        maxFilesize: 4,
        init: function(drop) {
            this.on("queuecomplete", function(file, chk_ganador, anio, mes) {
                Swal.fire({
                    title: '',
                    html: '<?= $this->lang->line('productos_reposicion_captura_controller_lang_msg_succes_fotos') ?>',
                    icon: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#fd7e14',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<?= $this->lang->line('productos_reposicion_captura_controller_lang_ok') ?>',
                    cancelButtonText: ''
                }).then((validacionaltaparticipante) => {
                    if (validacionaltaparticipante.isConfirmed) {
                        this.removeAllFiles();
                    }
                });
            });
        }
    };
    $(document).ready(function() {
        ProductosReposicionCaptura_js_combo_distribuidora();
        $('#cmb_distribuidor').on('click', function() {
            js_general_limpiar_errores(this);
        });
        $('#cmb_mes').on('click', function() {
            js_general_limpiar_errores(this);
        });
        $('#cmb_participantes').on('click', function() {
            js_general_limpiar_errores(this);
        });
        $('#cmb_premio').on('click', function() {
            js_general_limpiar_errores(this);
        });
        $('#fecha_entrega').on('click', function() {
            js_general_limpiar_errores(this);
        });

        $('#cmb_distribuidor').on('change', function() {
            ProductosReposicionCaptura_js_combo_mes();
            $('#cmb_participantes').empty().val(0);
            $('#cmb_premio').empty().val(0);
            $('#fecha_entrega').val('');
        });

        ProductosReposicionCaptura_js_combo_mes();
        $('#cmb_mes').on('change', function() {
            var mes = $('#cmb_mes').val();
            $('#anio_foto').val(anio);
            $('#mes_foto').val(mes);
            $('#id_dist').val($('#cmb_distribuidor').val());
            ProductosReposicionCaptura_js_combo_participante();
            ProductosReposicionCaptura_js_fecha_inicio();
        });
        $('#cmb_participantes').on('change', function() {
            ProductosReposicionCaptura_js_combo_premio();
        });
        $('#chk_ganador').prop('checked', true);
        $('#chk_ganador').val('1');
        $('#chk_ganador').on('change', function() {
            if ($('#chk_ganador').prop('checked', true)) {
                $('#chk_firma').prop('checked', false).removeAttr('checked').val('0');
                $('#chk_ganador').val('1');
                $('#check_tipo').val('1');
            }
        });
        $('#chk_firma').on('change', function() {
            if ($('#chk_firma').prop('checked', true)) {
                $('#chk_ganador').prop('checked', false).removeAttr('checked').val('0');
                $('#chk_firma').val('1');
                $('#check_tipo').val('2');
            }
        });
        $("#reposicionCaptura_boton_guardar").click(function() {
            ProductosReposicionCaptura_js_validar();
        });
    });

    function ProductosReposicionCaptura_js_combo_distribuidora() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_controller/productos_reposicion_captura_controller_cmb_distribuidor',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_distribuidor').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function ProductosReposicionCaptura_js_combo_mes() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_controller/productos_reposicion_captura_controller_cmb_mes',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_mes').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function ProductosReposicionCaptura_js_update_fotos() {
        $('#loader_panel').show();
        var chk_ganador = $('#chk_ganador').val();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_controller/productos_reposicion_captura_controller_cargas_upload_nombre_foto',
            dataType: 'json',
            data: {
                chk_ganador: chk_ganador
            },
            success: function(data) {},
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function ProductosReposicionCaptura_js_fecha_inicio() {
        $('#loader_panel').show();
        var mes = $('#cmb_mes').val();
        var cmb_distribuidor = $("#cmb_distribuidor").val();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_controller/productos_reposicion_captura_controller_fecha_inicio',
            dataType: 'json',
            data: {
                mes: mes,
                cmb_distribuidor: cmb_distribuidor
            },
            success: function(data) {
                var fecha_inicio = '';
                if (typeof data === 'string') {
                    fecha_inicio = data;
                } else if (data && data.fecha_inicio) {
                    fecha_inicio = data.fecha_inicio;
                }
                if (fecha_inicio) {
                    $('#fecha_entrega').attr('min', String(fecha_inicio).substring(0, 10));
                }
                $('#div_fecha_entrega').show(300);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function ProductosReposicionCaptura_js_combo_participante() {
        $('#loader_panel').show();
        var mes = $('#cmb_mes').val();
        var cmb_distribuidor = $("#cmb_distribuidor").val();
        if (mes != 0) {
            $('#reposiciom_captura_carga_fotos').show(300);
        } else {
            $('#reposiciom_captura_carga_fotos').hide();
        }
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_controller/productos_reposicion_captura_controller_cmb_participantes',
            dataType: 'json',
            data: {
                mes: mes,
                cmb_distribuidor: cmb_distribuidor
            },
            success: function(data) {
                $('#cmb_participantes').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function ProductosReposicionCaptura_js_combo_premio() {
        var cmb_mes = $("#cmb_mes").val();
        var cmb_participantes = $("#cmb_participantes").val();
        $.ajax({
            type: "POST",
            url: 'productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_controller/productos_reposicion_captura_controller_cmb_premio',
            dataType: 'json',
            data: {
                cmb_mes: cmb_mes,
                cmb_participantes: cmb_participantes
            },
            success: function(data) {
                if (data.res == 1) {
                    $('#cmb_premio').html(data.lista).prop('disabled', false);
                    $('#fecha_entrega').val(data.fecha).prop('disabled', false);
                    $('#btn_guardar').show();
                } else {
                    $('#cmb_premio').html(data.lista).prop('disabled', true);
                    $('#fecha_entrega').val(data.fecha).prop('disabled', true);
                    $('#btn_guardar').hide();
                }
            },
            error: function() { //Code
            },
            complete: function() { //Code
            }
        });
    }

    function ProductosReposicionCaptura_js_validar() {
        $('#error').html(" ");
        $('#loader_panel').show();
        $('#txt_total').prop('disabled', false);
        var cmb_distribuidor = $("#cmb_distribuidor").val();
        var cmb_mes = $("#cmb_mes").val();
        var cmb_participantes = $("#cmb_participantes").val();
        var cmb_premio = $("#cmb_premio").val();
        var fecha_entrega = $("#fecha_entrega").val();
        var txt_total = $("#txt_total").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("productos/productos_reposicion/productos_reposicion_captura/productos_reposicion_captura_controller/productos_reposicion_captura_controller_form_validate") ?>",
            data: {
                cmb_distribuidor: cmb_distribuidor,
                cmb_mes: cmb_mes,
                cmb_participantes: cmb_participantes,
                cmb_premio: cmb_premio,
                fecha_entrega: fecha_entrega,
                txt_total: txt_total
            },
            dataType: "json",
            success: function(data) {
                switch (data) {
                    case 1:
                        Swal.fire({
                            title: '',
                            html: '<?= $this->lang->line('productos_reposicion_captura_controller_lang_msg_succes') ?>',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#fd7e14',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: '<?= $this->lang->line('productos_reposicion_captura_controller_lang_ok') ?>',
                            cancelButtonText: ''
                        }).then((validacionaltaparticipante) => {
                            if (validacionaltaparticipante.isConfirmed) {
                                $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url("ReposicionProductoCaptura") ?>");
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
                console.log(data);
            },
            complete: function() {
                $('#loader_panel').hide();
                $('#txt_total').prop('disabled', true);
            }
        });
    }
</script>