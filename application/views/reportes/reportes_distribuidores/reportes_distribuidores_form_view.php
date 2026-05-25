<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<section class="TbReporteDistribuidores">
  <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('reportes_distribuidores_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-6" id="div_distribuidor">
                    <div class="form-group">
                        <label
                            for="cmb_distribuidor"><?= $this->lang->line('reportes_distribuidores_controller_lang_etiqueta_distribuidor') ?></label>
                        <select id="cmb_distribuidor" name="cmb_distribuidor" class="form-select"></select>
                        <div id="error"></div>
                    </div>
                </div>
                <div class="col-lg-3"  id="div_estatus">
                    <div class="form-group">
                        <label
                            for="cmb_estatus"><?= $this->lang->line('reportes_distribuidores_controller_lang_etiqueta_estatus') ?></label>
                        <select name="cmb_estatus" id="cmb_estatus" class="form-select">
                            <option value="0">
                                <?= $this->lang->line('reportes_distribuidores_controller_lang_placeholder_estatus_0') ?>
                            </option>
                            <option value="1">
                                <?= $this->lang->line('reportes_distribuidores_controller_lang_placeholder_estatus_1') ?>
                            </option>
                            <option value="2">
                                <?= $this->lang->line('reportes_distribuidores_controller_lang_placeholder_estatus_2') ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2"  id="div_anio">
                    <div class="form-group">
                        <label
                            for="cmb_anio"><?= $this->lang->line('reportes_distribuidores_controller_lang_etiqueta_anio') ?></label>
                        <select name="cmb_anio" id="cmb_anio" class="form-select"></select>
                    </div>
                </div>
                <div class="col-lg-2" style="display: none;" id="div_mes">
                    <div class="form-group">
                        <label
                            for="cmb_mes"><?= $this->lang->line('reportes_distribuidores_controller_lang_etiqueta_mes') ?></label>
                        <select name="cmb_mes" id="cmb_mes" class="form-select"></select>
                    </div>
                </div>
                <div class="col-lg-3"  id="div_actividad">
                    <div class="form-group">
                        <label
                            for="cmb_actividad"><?= $this->lang->line('reportes_distribuidores_controller_lang_etiqueta_actividad') ?></label>
                        <select name="cmb_actividad" id="cmb_actividad" class="form-select">
                            <option value="0">
                                <?= $this->lang->line('reportes_distribuidores_controller_lang_placeholder_actividad_0') ?>
                            </option>
                            <option value="1">
                                <?= $this->lang->line('reportes_distribuidores_controller_lang_placeholder_actividad_1') ?>
                            </option>
                            <option value="2">
                                <?= $this->lang->line('reportes_distribuidores_controller_lang_placeholder_actividad_2') ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2" style="text-align: right;" id="div_buscar">
                    <div class="form-group">
                        <button type="button" id="Reporte_distribuidores_btn_buscar" class="btn btn-axalta"
                            style="margin-top:20px;"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div id="tablaReportedistribuidores"></div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        reportes_distribuidores_form_view_js_combo_distribuidor();
        reportes_distribuidores_form_view_js_combo_anio();

       
        $('#cmb_anio').on('change', function() {
            var anio = $('#cmb_anio').val();
            if (anio == 0) {
                $('#div_mes').hide(300);
                $('#cmb_mes').val(0).trigger("chosen:updated");
              //  $('#div_actividad').hide(300);
            } else {
                reporte_distribuidores_js_Cmb_mes();
             //   $('#div_actividad').hide(300);
                $('#div_mes').show(300);
            }
        });
      /*  $('#cmb_mes').on('change', function() {
            var mes = $('#cmb_mes').val();
            if (mes == 0) {
                $('#div_actividad').hide(300);
            } else {
                $('#div_actividad').show(300);
            }
        });*/
        $("#Reporte_distribuidores_btn_buscar").click(function() {
            reporte_distribuidores_js_crear_tabla();
        });
    });

    function reportes_distribuidores_form_view_js_combo_distribuidor() {
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_distribuidores/reportes_distribuidores_controller/reportes_distribuidores_controller_cmb_distribuidor',
            dataType: 'json',
            data: {
               1:1
            },
            success: function(data) {
                $('#cmb_distribuidor').empty();
                $('#cmb_distribuidor').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function reportes_distribuidores_form_view_js_combo_anio() {
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_distribuidores/reportes_distribuidores_controller/reportes_distribuidores_controller_cmb_anio',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_anio').empty();
                $('#cmb_anio').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function reporte_distribuidores_js_Cmb_mes() {
        var cmb_anio = $('#cmb_anio').val();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_distribuidores/reportes_distribuidores_controller/reportes_distribuidores_controller_cmbmes',
            dataType: 'json',
            data: {
                cmb_anio: cmb_anio
            },
            success: function(data) {
                $('#cmb_mes').empty();
                $('#cmb_mes').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function reporte_distribuidores_js_crear_tabla() {
        $('#loader_panel').show();
        var cmb_pais = $('#cmb_pais').val();
        var cmb_segmento = $('#cmb_segmento').val();
        var cmb_anio = $('#cmb_anio').val();
        var cmb_mes = $('#cmb_mes').val();
        var cmb_distribuidor = $('#cmb_distribuidor').val();
        var cmb_estatus = $('#cmb_estatus').val();
        var cmb_actividad = $('#cmb_actividad').val();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_distribuidores/reportes_distribuidores_controller/reportes_distribuidores_controller_tabla',
            dataType: 'json',
            data: {
                cmb_pais: cmb_pais,
                cmb_segmento: cmb_segmento,
                cmb_distribuidor: cmb_distribuidor,
                cmb_mes: cmb_mes,
                cmb_anio: cmb_anio,
                cmb_estatus: cmb_estatus,
                cmb_actividad: cmb_actividad
            },
            success: function(data) {
                $('#tablaReportedistribuidores').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
</script>