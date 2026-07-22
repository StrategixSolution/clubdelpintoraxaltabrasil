<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="reporte_ganadores">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>RELATÓRIO DE SUBSTITUIÇÃO DE PRODUTO</h2>
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
                                <label for="ganadores_cmb_anio">Ano</label><br>
                                <select id="ganadores_cmb_anio" name="ganadores_cmb_anio" class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-lg-3" style="display:none;" id="div_periodo">
                            <div class="form-group">
                                <label for="ganadores_cmb_periodo">Periodo (MÊS DE REFERÊNCIA)</label><br>
                                <select id="ganadores_cmb_periodo" name="ganadores_cmb_periodo"
                                    class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-lg-5" style="display:none;" id="div_distribuidor">
                            <div class="form-group">
                                <label for="ganadores_cmb_distribuidor">Distribuidor</label><br>
                                <select id="ganadores_cmb_distribuidor" name="ganadores_cmb_distribuidor"
                                    class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-lg-2" style="text-align:left;margin-top:20px;display:none;" id="div_buscar">
                            <div class="form-group">
                                <button type="button" id="ganadores_btn_buscar" class="btn btn-axalta btn-buscar-ancho">
                                    <i class="fas fa-search"></i><span class="btn-buscar-texto">PROCURAR</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="reposicion_productos_tabla_contenedor"></div>
    </div>
</section>

<script>
    $(document).ready(function () {
        ganadores_combo_anio();
        $('#ganadores_cmb_anio').on('change', function () {
            let anio = $('#ganadores_cmb_anio').val();
            $('#reposicion_productos_tabla_contenedor').hide(300).empty();
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

        $('#ganadores_cmb_periodo').on('change', function () {
            let periodo = $('#ganadores_cmb_periodo').val();
            $('#reposicion_productos_tabla_contenedor').hide(300).empty();
            if (periodo === '') {
                $('#div_distribuidor').hide(300);
                $('#div_buscar').hide(300);
                return;
            }
            ganadores_combo_distribuidor();
            $('#div_distribuidor').show(300);
            $('#div_buscar').show(300);
        });

        $("#ganadores_btn_buscar").click(function () {
            ganadores_buscar_tabla();
        });

    });

    function ganadores_combo_anio() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reposicion_productos/reporte_reposicion_productos_controller/reporte_reposicion_productos_controller_combo_anio',
            dataType: 'json',
            data: { id: 0 },
            success: function (data) {
                $('#ganadores_cmb_anio').html(data);
            },
            complete: function () {
                $('#loader_panel').hide();
            }
        });
    }

    function ganadores_combo_periodo(anio) {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reposicion_productos/reporte_reposicion_productos_controller/reporte_reposicion_productos_controller_combo_periodo',
            dataType: 'json',
            data: { anio: anio },
            success: function (data) {
                $('#ganadores_cmb_periodo').html(data);
            },
            complete: function () {
                $('#loader_panel').hide();
            }
        });
    }

    function ganadores_combo_distribuidor() {
        var anio = $('#ganadores_cmb_anio').val();
        var periodo = $('#ganadores_cmb_periodo').val();
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reposicion_productos/reporte_reposicion_productos_controller/reporte_reposicion_productos_controller_combo_distribuidor',
            dataType: 'json',
            data: { anio: anio, periodo: periodo },
            success: function (data) {
                $('#ganadores_cmb_distribuidor').html(data);
            },
            complete: function () {
                $('#loader_panel').hide();
            }
        });
    }

    function ganadores_buscar_tabla() {
        $('#loader_panel').show();
        let cmb_anio = $('#ganadores_cmb_anio').val();
        let cmb_periodo = $('#ganadores_cmb_periodo').val();
        let cmb_distribuidor = $('#ganadores_cmb_distribuidor').val();
        $.ajax({
            type: 'POST',
            url: 'reportes/reposicion_productos/reporte_reposicion_productos_controller/reporte_reposicion_productos_controller_tabla',
            dataType: 'json',
            data: {
                cmb_anio: cmb_anio,
                cmb_periodo: cmb_periodo,
                cmb_distribuidor: cmb_distribuidor
            },
            success: function (data) {
                $('#reposicion_productos_tabla_contenedor').empty().html(data.tabla).show(300);
            },
            complete: function () {
                $('#loader_panel').hide();
            }
        });
    }
</script>