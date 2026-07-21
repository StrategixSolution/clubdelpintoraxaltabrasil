<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="reporte_ganadores">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('ventas_reporte_ganadores_controller_lang_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="form-rf-1" id="form-rf-1">
                    <div class="row row-validator">

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="ganadores_cmb_anio"><?= $this->lang->line('ventas_reporte_ganadores_controller_lang_combo_anio') ?></label><br>
                                <select id="ganadores_cmb_anio" name="ganadores_cmb_anio" class="form-select"></select>
                            </div>
                        </div>

                        <div class="col-lg-3" style="display:none;" id="div_periodo">
                            <div class="form-group">
                                <label for="ganadores_cmb_periodo"><?= $this->lang->line('ventas_reporte_ganadores_controller_lang_combo_periodo') ?></label><br>
                                <select id="ganadores_cmb_periodo" name="ganadores_cmb_periodo" class="form-select"></select>
                            </div>
                        </div>

                        <!-- <div class="col-lg-12" style="height:10px;"></div> -->

                        <div class="col-lg-5" style="display:none;" id="div_distribuidor">
                            <div class="form-group">
                                <label for="ganadores_cmb_distribuidor"><?= $this->lang->line('ventas_reporte_ganadores_controller_lang_combo_distribuidor') ?></label><br>
                                <select id="ganadores_cmb_distribuidor" name="ganadores_cmb_distribuidor" class="form-select"></select>
                            </div>
                        </div>

                        <div class="col-lg-2 btn-buscar-posicion" style="display:none;" id="div_buscar">
                            <div class="form-group">
                                <button type="button" id="ganadores_btn_buscar" class="btn btn-axalta btn-buscar-ancho">
                                    <i class="fas fa-search"></i><span class="btn-buscar-texto"><?= $this->lang->line('ventas_reporte_ganadores_controller_lang_btn_buscar') ?></span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div id="ganadores_tabla_contenedor"></div>
        
    </div>
</section>

<script>
$(document).ready(function() {

    ganadores_combo_anio();

    $('#ganadores_cmb_anio').on('change', function() {
        let anio = $('#ganadores_cmb_anio').val();

        $('#ganadores_tabla_contenedor').hide(300).empty();
        $('#div_distribuidor').hide(300);
        $('#div_buscar').hide(300);

        if (anio === '') {
            $('#div_periodo').hide(300);
            $('#ganadores_cmb_periodo').val('');
            return;
        }

        ganadores_combo_periodo(anio);
        $('#div_periodo').show(300);
    });

    $('#ganadores_cmb_periodo').on('change', function() {
        let periodo = $('#ganadores_cmb_periodo').val();

        $('#ganadores_tabla_contenedor').hide(300).empty();

        if (periodo === '') {
            $('#div_distribuidor').hide(300);
            $('#div_buscar').hide(300);
            return;
        }

        ganadores_combo_distribuidor();
        $('#div_distribuidor').show(300);
        $('#div_buscar').show(300);
    });

    $("#ganadores_btn_buscar").click(function() {
        ganadores_buscar_tabla();
    });

});

function ganadores_combo_anio() {
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/ventas_reporte_ganadores_controller/ventas_reporte_ganadores_controller_combo_anio',
        dataType: 'json',
        data: {id: 0},
        success: function(data){
            $('#ganadores_cmb_anio').html(data);
        },
        complete: function() {
            $('#loader_panel').hide();
        }
    });
}

function ganadores_combo_periodo(anio) {
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/ventas_reporte_ganadores_controller/ventas_reporte_ganadores_controller_combo_periodo',
        dataType: 'json',
        data: {anio: anio},
        success: function(data){
            $('#ganadores_cmb_periodo').html(data);
        },
        complete: function() {
            $('#loader_panel').hide();
        }
    });
}

function ganadores_combo_distribuidor() {
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/ventas_reporte_ganadores_controller/ventas_reporte_ganadores_controller_combo_distribuidor',
        dataType: 'json',
        data: {id: 0},
        success: function(data){
            $('#ganadores_cmb_distribuidor').html(data);
        },
        complete: function() {
            $('#loader_panel').hide();
        }
    });
}

function ganadores_buscar_tabla() {
    $('#loader_panel').show();

    let cmb_anio = $('#ganadores_cmb_anio').val();
    let cmb_periodo = $('#ganadores_cmb_periodo').val(); // mesFin
    let cmb_distribuidor = $('#ganadores_cmb_distribuidor').val();

    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/ventas_reporte_ganadores_controller/ventas_reporte_ganadores_controller_tabla',
        dataType: 'json',
        data: {
            cmb_anio: cmb_anio,
            cmb_periodo: cmb_periodo,
            cmb_distribuidor: cmb_distribuidor
        },
        success: function(data) {
            $('#ganadores_tabla_contenedor').empty().html(data.tabla).show(300);
        },
        complete: function() {
            $('#loader_panel').hide();
        }
    });
}
</script>
