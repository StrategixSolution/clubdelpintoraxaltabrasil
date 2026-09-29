<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="reporte_auditoria_ventas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?=$this->lang->line('reportes_ventas_auditoria_titulo')?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="panel-white">
            <div class="row">

                <div class="col-lg-2">
                    <div class="form-group">
                        <label><?=$this->lang->line('reportes_ventas_auditoria_filtro_anio')?></label>
                        <select id="anio" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="form-group">
                        <label><?=$this->lang->line('reportes_ventas_auditoria_filtro_mes')?></label>
                        <select id="mes" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label><?=$this->lang->line('reportes_ventas_auditoria_filtro_distribuidor')?></label>
                        <select id="distribuidor" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-2">
                    <div class="form-group">
                        <label><?=$this->lang->line('reportes_ventas_auditoria_filtro_estatus')?></label>
                        <select id="estatus" class="form-select">
                            <option value="0"><?=$this->lang->line('reportes_ventas_auditoria_estatus_todos')?></option>
                            <option value="1"><?=$this->lang->line('reportes_ventas_auditoria_estatus_en_auditoria')?></option>
                            <option value="2"><?=$this->lang->line('reportes_ventas_auditoria_estatus_aprobada')?></option>
                            <option value="3"><?=$this->lang->line('reportes_ventas_auditoria_estatus_rechazada')?></option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-2 btn-buscar-posicion">
                    <button type="button" id="btn_buscar" class="btn btn-axalta btn-buscar-ancho">
                        <i class="fas fa-search"></i><span class="btn-buscar-texto"><?= $this->lang->line('reportes_ventas_auditoria_btn_buscar') ?></span> 
                    </button>
                </div>

            </div>
            <div id="tabla_reporte_auditoria_ventas"></div>
        </div>

        

        <!-- Modal container (reutiliza el modal existente) -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

    </div>
</section>

<script>
$(document).ready(function(){

    combo_anio();

    $('#anio').on('change', function(){
		combo_mes(function(){
			combo_distribuidor();
		});
	});

    $('#mes').on('change', function(){
        combo_distribuidor();
    });

    $('#btn_buscar').click(function(){
        tabla();
    });

});

function combo_anio(){
    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/reportes_ventas_auditoria_controller/reportes_ventas_auditoria_controller_combo_anio',
        dataType: 'json',
        data: {id:0},
        success: function(data){
            $('#anio').html(data);

            // Primero carga meses, después distribuidores
            combo_mes(function(){
                combo_distribuidor();
            });
        },
        error: function(xhr){
            console.log('Error combo_anio:', xhr.responseText);
        }
    });
}

function combo_mes(callback){
    var anio = $('#anio').val();

    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/reportes_ventas_auditoria_controller/reportes_ventas_auditoria_controller_combo_mes',
        dataType: 'json',
        data: {anio:anio},
        success: function(data){
            $('#mes').html(data);

            if (typeof callback === 'function') {
                callback();
            }
        },
        error: function(xhr){
            console.log('Error combo_mes:', xhr.responseText);
        }
    });
}

function combo_distribuidor(){
    var anio = $('#anio').val();
    var mes  = $('#mes').val();

    if (typeof mes === 'undefined' || mes === null || mes === '') {
        mes = 0;
    }

    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/reportes_ventas_auditoria_controller/reportes_ventas_auditoria_controller_combo_distribuidor',
        dataType: 'json',
        data: {anio:anio, mes:mes},
        success: function(data){
            $('#distribuidor').html(data);
        },
        error: function(xhr){
            console.log('Error combo_distribuidor:', xhr.responseText);
        }
    });
}

function tabla(){
    $('#loader_panel').show();

    var anio = $('#anio').val();
    var mes  = $('#mes').val();
    var distribuidor = $('#distribuidor').val();
    var estatus = $('#estatus').val();

    $.ajax({
        type: 'POST',
        url: 'reportes/ventas/reportes_ventas_auditoria_controller/reportes_ventas_auditoria_controller_tabla',
        dataType: 'json',
        data: {anio:anio, mes:mes, distribuidor:distribuidor, estatus:estatus},
        success: function(data){
            $('#tabla_reporte_auditoria_ventas').html(data);
        },
        complete: function(){
            $('#loader_panel').hide();
        }
    });
}

// Modal ticket (reutiliza modal existente)
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
