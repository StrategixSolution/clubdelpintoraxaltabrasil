<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<section class="TbReporteMaestroPintores">   
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('reportes_maestro_pintores_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-5" id="div_distribuidor">
                    <div class="form-group">
                        <label
                            for="cmb_distribuidor"><?= $this->lang->line('reportes_maestro_pintores_controller_lang_etiqueta_distribuidor') ?></label>
                        <select id="cmb_distribuidor" name="cmb_distribuidor" class="form-select"></select>
                        <div id="error"></div>
                    </div>
                </div>
                <div class="col-lg-5" id="div_nombre">
                    <div class="form-group">
                                <label><?=$this->lang->line('reportes_maestro_pintores_controller_lang_etiqueta_nombre')?></label>
                                <input type="text" name="txt_nombre_mp" id="txt_nombre_mp" class="form-control trans" placeholder="<?=$this->lang->line('reportes_maestro_pintores_controller_lang_placeholder_nombre')?>" />
                                <div id="error"></div>
                    </div>
                </div>
                <div class="col-lg-2 col-12" style="text-align: right;" id="div_buscar">
                    <div class="form-group">
                        <button type="button" id="Reporte_maestroPintores_btn_buscar" class="btn btn-axalta btn-buscar-ancho"
                            style="margin-top:20px;"><i class="fas fa-search"></i><span class="btn-buscar-texto">BUSCAR</span></button>
                    </div>
                </div>
            </div>
            <div id="div_excel" style="display: none;">
                <hr class="separador">
                <div class="row mb-5 vertical-center" style="justify-content: flex-end; margin-top: 20px;">
                    <div class="col-lg-2 col-12">
                        <div class="btn-modulo">
                            <button type="button" class="btn btn-axalta btn-buscar-ancho" id="reporte_maestros_pintores_boton_excel">
                                <i class="fas fa-download"></i><span class="btn-buscar-texto">BAIXAR</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="tablaReportemaestroPintores"></div>    
        </div>        
    </div>
</section>

<script>    
 $(document).ready(function() {
 cargarComboDistribuidor();
  $("#Reporte_maestroPintores_btn_buscar").click(function() {
    $('#div_excel').show(300);
            reportesMaestroPintoresControllerTabla();
        });
         $("#reporte_maestros_pintores_boton_excel").click(function() {
            reportes_maestros_pintores_js_excel()
        });
  });

  function cargarComboDistribuidor() {
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_maestro_pintores/reportes_maestro_pintores_controller/reportes_maestro_pintores_controller_cmb_distribuidor',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_distribuidor').empty();
                $('#cmb_distribuidor').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function reportesMaestroPintoresControllerTabla() {
        $('#loader_panel').show();
        var cmb_distribuidor = $("#cmb_distribuidor").val();
        var txt_nombre_mp = $("#txt_nombre_mp").val();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_maestro_pintores/reportes_maestro_pintores_controller/reportes_maestro_pintores_controller_tabla',
            dataType: 'json',
            data: {
                cmb_distribuidor: cmb_distribuidor,
                txt_nombre_mp: txt_nombre_mp
            },
            success: function(data) {
                $('#tablaReportemaestroPintores').empty();
                $('#tablaReportemaestroPintores').html(data);
            },
            error: function(data) {},
            complete: function() {  $('#loader_panel').hide();}
        });
    }

    function reportes_maestros_pintores_js_excel() {
        $('#loader_panel').show();
        var cmb_distribuidor = $("#cmb_distribuidor").val();
        var txt_nombre_mp = $("#txt_nombre_mp").val();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_maestro_pintores/reportes_maestro_pintores_controller/reportes_maestro_pintores_controller_export_excel',
            dataType: 'json',
            data: {
                cmb_distribuidor: cmb_distribuidor,
                txt_nombre_mp: txt_nombre_mp
            },
            success: function(data) {
                    $(location).attr('href', '<?= funciones_strategix_version_url_random_base_url("uploads/maestros_pintores/excel/Relatorio_sobre_grandes_pintores.xlsx") ?>');
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

</script>

