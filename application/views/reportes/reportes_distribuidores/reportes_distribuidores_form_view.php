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
            <div class="row justify-content-end">
                <div class="col-lg-4" id="div_distribuidor">
                    <div class="form-group">
                        <label
                            for="cmb_distribuidor"><?= $this->lang->line('reportes_distribuidores_controller_lang_etiqueta_distribuidor') ?></label>
                        <select id="cmb_distribuidor" name="cmb_distribuidor" class="form-select"></select>
                        <div id="error"></div>
                    </div>
                </div>
                <div class="col-lg-2"  id="div_estatus">
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
                <div class="col-lg-2"  id="div_actividad">
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
                        <button type="button" id="Reporte_distribuidores_btn_buscar" class="btn btn-axalta btn-buscar-ancho"
                            style="margin-top:20px;"><i class="fas fa-search"></i><span class="btn-buscar-texto">PESQUISAR</span></button>
                    </div>
                </div>
            </div>
            <div id="tablaReportedistribuidores"></div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        // Inicializar combos
        inicializarCombos();
        
        // Event listeners
        $('#cmb_anio').on('change', manejarCambioAnio);
        $('#Reporte_distribuidores_btn_buscar').on('click', generarReporte);
    });

    /**
     * Inicializa los combos de distribuidor y año
     */
    function inicializarCombos() {
        cargarComboDistribuidor();
        cargarComboAnio();
    }

    /**
     * Maneja el cambio en el combo de año
     */
    function manejarCambioAnio() {
        const anio = $('#cmb_anio').val();
        
        if (anio == 0) {
            $('#div_mes').hide(300);
            $('#cmb_mes').val(0);
        } else {
            cargarComboMes(anio);
            $('#div_mes').show(300);
        }
    }

    /**
     * Carga el combo de distribuidores
     */
    function cargarComboDistribuidor() {
        realizarPeticionAjax(
            'reportes/reportes_distribuidores/reportes_distribuidores_controller/reportes_distribuidores_controller_cmb_distribuidor',
            {},
            function(data) {
                $('#cmb_distribuidor').html(data);
            }
        );
    }

    /**
     * Carga el combo de años
     */
    function cargarComboAnio() {
        realizarPeticionAjax(
            'reportes/reportes_distribuidores/reportes_distribuidores_controller/reportes_distribuidores_controller_cmb_anio',
            {},
            function(data) {
                $('#cmb_anio').html(data);
            }
        );
    }

    /**
     * Carga el combo de meses según el año seleccionado
     * @param {number} anio - Año seleccionado
     */
    function cargarComboMes(anio) {
        realizarPeticionAjax(
            'reportes/reportes_distribuidores/reportes_distribuidores_controller/reportes_distribuidores_controller_cmbmes',
            { cmb_anio: anio },
            function(data) {
                $('#cmb_mes').html(data);
            }
        );
    }

    /**
     * Genera el reporte con los filtros seleccionados
     */
    function generarReporte() {
        $('#loader_panel').show();
        
        const parametros = {
            cmb_distribuidor: $('#cmb_distribuidor').val(),
            cmb_anio: $('#cmb_anio').val(),
            cmb_mes: $('#cmb_mes').val(),
            cmb_estatus: $('#cmb_estatus').val(),
            cmb_actividad: $('#cmb_actividad').val()
        };

        realizarPeticionAjax(
            'reportes/reportes_distribuidores/reportes_distribuidores_controller/reportes_distribuidores_controller_tabla',
            parametros,
            function(data) {
                $('#tablaReportedistribuidores').html(data);
            },
            function() {
                $('#loader_panel').hide();
            }
        );
    }

    /**
     * Función auxiliar para realizar peticiones AJAX
     * @param {string} url - URL del endpoint
     * @param {object} data - Datos a enviar
     * @param {function} successCallback - Callback de éxito
     * @param {function} completeCallback - Callback de completado
     */
    function realizarPeticionAjax(url, data, successCallback, completeCallback) {
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            data: data,
            success: successCallback,
            error: function(xhr, status, error) {
                console.error('Error en petición AJAX:', error);
            },
            complete: completeCallback || function() {}
        });
    }
</script>