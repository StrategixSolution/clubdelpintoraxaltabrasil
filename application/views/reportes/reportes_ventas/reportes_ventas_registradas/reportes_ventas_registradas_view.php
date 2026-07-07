<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="reporte_ventas_registradas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('reportes_ventas_registradas_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="cmb_anio"><?= $this->lang->line('reportes_ventas_registradas_controller_lang_etiqueta_año') ?></label>
                        <select id="cmb_anio" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-2" id="div_mes" style="display: none;">
                    <div class="form-group">
                        <label for="cmb_mes"><?= $this->lang->line('reportes_ventas_registradas_controller_lang_etiqueta_mes') ?></label>
                        <select id="cmb_mes" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-4" id="div_distribuidor" style="display: none;">
                    <div class="form-group">
                        <label for="cmb_distribuidor"><?= $this->lang->line('reportes_ventas_registradas_controller_lang_etiqueta_distribuidor') ?></label>
                        <select id="cmb_distribuidor" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-2" id="div_estatus" style="display: none;">
                    <div class="form-group">
                        <label for="cmb_estatus"><?= $this->lang->line('reportes_ventas_registradas_controller_lang_etiqueta_status') ?></label>
                        <select id="cmb_estatus" class="form-select"></select>
                    </div>
                </div>

                <div class="col-lg-2" id="div_btn_buscar" style="display: none;">
                    <div class="form-group">
                        <button type="button" id="btn_buscar" class="btn btn-axalta btn-buscar-ancho btn-buscar-posicion">
                            <i class="fas fa-search"></i><span class="btn-buscar-texto"><?= $this->lang->line('reportes_ventas_registradas_controller_lang_boton_buscar') ?></span>
                        </button>
                    </div>
                </div>
            </div>
            <div id="contenedor_tabla" style="margin-top:15px; display: none;"></div>
        </div>
        
    </div>
</section>

<!-- Modal Ticket -->
<div class="modal fade" id="modal_ticket" tabindex="-1" role="dialog" aria-labelledby="modalTicketLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTicketLabel"><?= $this->lang->line('reportes_ventas_registradas_controller_lang_modal_ticket') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar">
                    <!-- <span aria-hidden="true">&times;</span> -->
                </button>
            </div>
            <div class="modal-body" id="modal_ticket_body">
                <div class="text-center"><?= $this->lang->line('reportes_ventas_registradas_controller_lang_cargando') ?></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        cargar_anios();
        cargar_estatus();

        $('#cmb_anio').on('change', function() {
            const anio = $('#cmb_anio').val();
            if (anio == 0) {
                $('#div_mes').hide(300);
                $('#cmb_mes').val(0);
                $('#div_distribuidor').hide(300);
                $('#cmb_distribuidor').val(0);
                $('#div_estatus').hide(300);
                $('#cmb_estatus').val(0);
                $('#div_btn_buscar').hide(300);
                $('#contenedor_tabla').hide(300);
                $('#contenedor_tabla').empty();
            } else {
                cargar_meses(anio);
                cargar_distribuidores(anio, 0);
                $('#div_mes').show(300);
                $('#div_distribuidor').show(300);
                $('#div_estatus').show(300);
                $('#div_btn_buscar').show(300);
            }

            // cargar_meses();
            // cargar_distribuidores(); // por año y mes (mes todo por default)
        });

        $('#cmb_mes').on('change', function() {
            const anio = $('#cmb_anio').val();
            const mes = $('#cmb_mes').val();
            $('#contenedor_tabla').empty();
            cargar_distribuidores(anio, mes);
        });

        $('#btn_buscar').on('click', function() {
            buscar();
        });

        // Delegado para botones de ticket dentro de la tabla
        $(document).on('click', '.btn_ticket', function() {
            let ventaId = $(this).data('venta');
            ver_ticket(ventaId);
        });
    });

    function cargar_anios() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_ventas/reportes_ventas_registradas_controller/reportes_ventas_registradas_controller_combo_anio',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(html) {
                $('#cmb_anio').html(html);
                // precarga meses/distribuidores si ya hay valor
                //  cargar_meses();
                // cargar_distribuidores();
            },
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function cargar_meses() {
        let anio = $('#cmb_anio').val();
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_ventas/reportes_ventas_registradas_controller/reportes_ventas_registradas_controller_combo_mes',
            dataType: 'json',
            data: {
                anio: anio
            },
            success: function(html) {
                $('#cmb_mes').html(html);
            },
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function cargar_distribuidores(anio, mes) {
        //  let anio = $('#cmb_anio').val();
        //  let mes  = $('#cmb_mes').val() || 0;

        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_ventas/reportes_ventas_registradas_controller/reportes_ventas_registradas_controller_combo_distribuidor',
            dataType: 'json',
            data: {
                anio: anio,
                mes: mes
            },
            success: function(html) {
                $('#cmb_distribuidor').html(html);
            },
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function cargar_estatus() {
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_ventas/reportes_ventas_registradas_controller/reportes_ventas_registradas_controller_combo_estatus',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(html) {
                $('#cmb_estatus').html(html);
            }
        });
    }

    function buscar() {
        let anio = $('#cmb_anio').val();
        let mes = $('#cmb_mes').val();
        let dist = $('#cmb_distribuidor').val();
        let est = $('#cmb_estatus').val();

        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_ventas/reportes_ventas_registradas_controller/reportes_ventas_registradas_controller_tabla',
            dataType: 'json',
            data: {
                anio: anio,
                mes: mes,
                distribuidor: dist,
                estatus: est
            },
            success: function(resp) {
                $('#contenedor_tabla').html(resp.tabla);
                $('#contenedor_tabla').show(300);
            },
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function ver_ticket(ventaId) {
        $('#modal_ticket_body').html("<div class='text-center'>Cargando...</div>");
        $('#modal_ticket').modal('show');

        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_ventas/reportes_ventas_registradas_controller/reportes_ventas_registradas_controller_ticket',
            dataType: 'json',
            data: {
                ventaId: ventaId
            },
            success: function(resp) {
                $('#modal_ticket_body').html(resp.html);
            },
            error: function() {
                $('#modal_ticket_body').html("<div class='alert alert-danger'>No se pudo cargar el ticket.</div>");
            }
        });
    }
</script>