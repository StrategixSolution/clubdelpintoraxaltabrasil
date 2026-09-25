<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="reporte_segunda_vuelta_auditoria">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>RELATÓRIO DE AUDITORIA DA SEGUNDA RODADA</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="segunda_vuelta_cmb_anio"><?=$this->lang->line('reportes_ventas_auditoria_filtro_anio')?></label>
                        <select id="segunda_vuelta_cmb_anio" name="segunda_vuelta_cmb_anio" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-3" id="segunda_vuelta_div_mes" style="display:none;">
                    <div class="form-group">
                        <label for="segunda_vuelta_cmb_mes"><?=$this->lang->line('reportes_ventas_auditoria_filtro_periodo')?></label>
                        <select id="segunda_vuelta_cmb_mes" name="segunda_vuelta_cmb_mes" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-4" id="segunda_vuelta_div_distribuidor" style="display:none;">
                    <div class="form-group">
                        <label for="segunda_vuelta_cmb_distribuidor"><?=$this->lang->line('reportes_ventas_auditoria_filtro_distribuidor')?></label>
                        <select id="segunda_vuelta_cmb_distribuidor" name="segunda_vuelta_cmb_distribuidor" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-2" id="segunda_vuelta_div_buscar" style="text-align:left;margin-top:20px;display:none;">
                    <button type="button" id="segunda_vuelta_btn_buscar" class="btn btn-axalta btn-buscar-ancho">
                        <i class="fas fa-search"></i><span class="btn-buscar-texto"><?=$this->lang->line('reportes_ventas_auditoria_btn_buscar')?></span>
                    </button>
                </div>
            </div>
            <div id="segunda_vuelta_tabla_contenedor"></div>
        </div>
    </div>
</section>

<script>
$(document).ready(function () {
    segunda_vuelta_combo_anio();

    $('#segunda_vuelta_cmb_anio').on('change', function () {
        let anio = $('#segunda_vuelta_cmb_anio').val();
        segunda_vuelta_limpiar_tabla();
        $('#segunda_vuelta_div_distribuidor').hide(300);
        $('#segunda_vuelta_div_buscar').hide(300);

        if (anio === '') {
            $('#segunda_vuelta_div_mes').hide(300);
            $('#segunda_vuelta_cmb_mes').html('');
            return;
        }

        segunda_vuelta_combo_mes(anio);
        $('#segunda_vuelta_div_mes').show(300);
    });

    $('#segunda_vuelta_cmb_mes').on('change', function () {
        let mes = $('#segunda_vuelta_cmb_mes').val();
        segunda_vuelta_limpiar_tabla();

        if (mes === '') {
            $('#segunda_vuelta_div_distribuidor').hide(300);
            $('#segunda_vuelta_div_buscar').hide(300);
            return;
        }

        segunda_vuelta_combo_distribuidor();
        $('#segunda_vuelta_div_distribuidor').show(300);
        $('#segunda_vuelta_div_buscar').show(300);
    });

    $('#segunda_vuelta_cmb_distribuidor').on('change', function () {
        segunda_vuelta_limpiar_tabla();
    });

    $('#segunda_vuelta_btn_buscar').on('click', function () {
        segunda_vuelta_buscar_tabla();
    });
});

function segunda_vuelta_limpiar_tabla() {
    $('#segunda_vuelta_tabla_contenedor').hide(300).empty();
}

function segunda_vuelta_combo_anio() {
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/reportes_segunda_vuelta_auditoria_controller/reportes_segunda_vuelta_auditoria_controller_combo_anio',
        dataType: 'json',
        data: { id: 0 },
        success: function (data) {
            $('#segunda_vuelta_cmb_anio').html(data);
        },
        complete: function () {
            $('#loader_panel').hide();
        }
    });
}

function segunda_vuelta_combo_mes(anio) {
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/reportes_segunda_vuelta_auditoria_controller/reportes_segunda_vuelta_auditoria_controller_combo_mes',
        dataType: 'json',
        data: { anio: anio },
        success: function (data) {
            $('#segunda_vuelta_cmb_mes').html(data);
        },
        complete: function () {
            $('#loader_panel').hide();
        }
    });
}

function segunda_vuelta_combo_distribuidor() {
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/reportes_segunda_vuelta_auditoria_controller/reportes_segunda_vuelta_auditoria_controller_combo_distribuidor',
        dataType: 'json',
        data: {
            anio: $('#segunda_vuelta_cmb_anio').val(),
            mes: $('#segunda_vuelta_cmb_mes').val()
        },
        success: function (data) {
            $('#segunda_vuelta_cmb_distribuidor').html(data);
        },
        complete: function () {
            $('#loader_panel').hide();
        }
    });
}

function segunda_vuelta_buscar_tabla() {
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/reportes_segunda_vuelta_auditoria_controller/reportes_segunda_vuelta_auditoria_controller_tabla',
        dataType: 'json',
        data: {
            anio: $('#segunda_vuelta_cmb_anio').val(),
            mes: $('#segunda_vuelta_cmb_mes').val(),
            distribuidor: $('#segunda_vuelta_cmb_distribuidor').val()
        },
        success: function (data) {
            $('#segunda_vuelta_tabla_contenedor').empty().html(data.tabla).show(300);
        },
        error: function (data) {
            console.log('Error al cargar reporte de segunda vuelta de auditoría', data);
        },
        complete: function () {
            $('#loader_panel').hide();
        }
    });
}
function reportes_ventas_auditoria_form_view_js_modal_ticket(id){
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/reportes_ventas_auditoria_controller/reportes_ventas_auditoria_controller_ticket_modal',
        dataType: 'json',
        data: {id:id},
        success: function(data){
            $('#myModal').html(data).modal('show');
        },
        complete: function(){
            $('#loader_panel').hide();
        }
    });
}
</script>
