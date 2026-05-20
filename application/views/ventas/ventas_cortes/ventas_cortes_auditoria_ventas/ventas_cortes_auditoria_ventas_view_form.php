<?php

/*
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             *
 * @programmer  Luis Felipe Rangel                          *
 * @CreateDate 01 ABRIL 2026 09:00:00                       *
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>

<section class="auditoria_ventas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center" style="margin:20px 0px;">
            <?= $sub_menu ?>
        </div>
        <div class="panel-white">
            <div class="row row-validator">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label for="anio"><?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_etiqueta_anio') ?></label>
                        <select name="anio" id="anio" class="form-select"></select>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group" style="display: none;" id="div_mes">
                        <label for="mes"><?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_etiqueta_mes') ?></label>
                        <select name="mes" id="mes" class="form-select"></select>
                    </div>
                </div>
                <div class="col-lg-2" style="text-align: right; display: none;" id="div_buscar">
                    <div class="form-group">
                        <button type="button" id="ventas_cambio_estatus_auditar" class="btn btn-axalta btn-buscar-ancho" style="margin-top: 1.68em;"><i class="fas fa-file-invoice-dollar"></i><span class="btn-buscar-texto"><?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_btn_auditar') ?></span></button>
                    </div>
                </div>
            </div>
            <p>
        </div>
        <div id="tabla_ventas_cambio_estatus"></div>
    </div>
</section>
<script>
    $(document).ready(function() {
        ventas_cortes_auditoria_ventas_view_form_js_combo_anio();
        $("#ventas_cambio_estatus_auditar").click(function() {
            ventas_cortes_auditoria_ventas_view_form_js_crea_corte();
        });
        $('#anio').on('change', function() {
            var anio = $('#anio').val();
            if (anio == 0) {
                $('#div_mes').hide(300);
            } else {
                ventas_cortes_auditoria_ventas_view_form_js_combo_mes();
                $('#div_mes').show(300);
            }
        });
        $('#mes').on('change', function() {
            var mes = $('#mes').val();
            if (mes == 0) {
                $('#div_buscar').hide(300);
            } else {
                ventas_cortes_auditoria_ventas_view_form_js_valida_corte();
            }
        });
    });

    function ventas_cortes_auditoria_ventas_view_form_js_combo_anio() {
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_auditoria_ventas/ventas_cortes_auditoria_ventas_controller/ventas_cortes_auditoria_ventas_controller_combo_anio',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#anio').empty().html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function ventas_cortes_auditoria_ventas_view_form_js_combo_mes() {
        var anio = $('#anio').val();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_auditoria_ventas/ventas_cortes_auditoria_ventas_controller/ventas_cortes_auditoria_ventas_controller_combo_mes',
            dataType: 'json',
            data: {
                anio: anio
            },
            success: function(data) {
                $('#mes').empty().html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function ventas_cortes_auditoria_ventas_view_form_js_valida_corte() {
        var anio = $('#anio').val();
        var mes = $('#mes').val();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_auditoria_ventas/ventas_cortes_auditoria_ventas_controller/ventas_cortes_auditoria_ventas_controller_valida_corte',
            dataType: 'json',
            data: {
                anio: anio,
                mes: mes
            },
            success: function(data) {
                if (data == 1) {
                    $('#div_buscar').show(300);
                } else {
                    $('#div_buscar').hide(300);
                    Swal.fire({
                        title: '',
                        html: 'O TRIBUNAL JÁ FOI CRIADO',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#fd7e14',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'OK'
                    }).then((validacionaltaparticipante) => {
                        if (validacionaltaparticipante.isConfirmed) {

                        }
                    });
                }
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function ventas_cortes_auditoria_ventas_view_form_js_crea_corte() {
        Swal.fire({
            title: '',
            html: '<?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_alerta_pregunta') ?>',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_alerta_pregunta_btn_aceptar') ?>',
            cancelButtonText: '<?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_alerta_pregunta_btn_rechazar') ?>'
        }).then((resultadoconfirm) => {
            if (resultadoconfirm.isConfirmed) {
                $('#loader_panel').show();
                var anio = $('#anio').val();
                var mes = $('#mes').val();
                $.ajax({
                    type: 'POST',
                    url: 'ventas/ventas_cortes/ventas_cortes_auditoria_ventas/ventas_cortes_auditoria_ventas_controller/ventas_cortes_auditoria_ventas_controller_corte_auditoria',
                    dataType: 'json',
                    data: {
                        anio: anio,
                        mes: mes
                    },
                    success: function(data) {
                        switch (data.res) {
                            case 1:
                                Swal.fire({
                                    title: '',
                                    html: '<?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_alerta_succes') ?>',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#fd7e14',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: 'OK'
                                }).then((validacionaltaparticipante) => {
                                    if (validacionaltaparticipante.isConfirmed) {
                                        $('#tabla_ventas_cambio_estatus').html(data.tabla);
                                    }
                                });
                                break;
                            case 2:
                                Swal.fire({
                                    title: '',
                                    html: '<?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_alerta_error_corte') ?>',
                                    icon: 'warning',
                                    showCancelButton: false,
                                    confirmButtonColor: '#fd7e14',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: 'OK'
                                }).then((validacionaltaparticipante) => {
                                    if (validacionaltaparticipante.isConfirmed) {
                                        location.reload();
                                    }
                                });
                                break;
                            case 3:
                                Swal.fire({
                                    title: '',
                                    html: '<?= $this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_alerta_error_auditorias') ?>',
                                    icon: 'warning',
                                    showCancelButton: false,
                                    confirmButtonColor: '#fd7e14',
                                    cancelButtonColor: '#6c757d',
                                    confirmButtonText: 'OK'
                                }).then((validacionaltaparticipante) => {
                                    if (validacionaltaparticipante.isConfirmed) {
                                        location.reload();
                                    }
                                });
                                break;
                        }
                    },
                    error: function(data) {},
                    complete: function() {
                        $('#loader_panel').hide();
                    }
                });
            }
        });
    }
</script>