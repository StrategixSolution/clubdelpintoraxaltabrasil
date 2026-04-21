<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>
<section class="auditoria_ventas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="form-rf-1" id="form-rf-1">
                    <div class="row row-validator">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cmb_distribuidor">Distribuidor:</label><br>
                                <select id="cmb_distribuidor" name="cmb_distribuidor" class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-lg-2" style="text-align: right; margin-top:20px;" id="div_buscar">
                            <div class="form-group">
                                <button type="button" id="ventas_auditoria_rechazados_btn_buscar"
                                    class="btn btn-axalta btn-buscar-ancho"><i class="fas fa-search"></i><span class="btn-buscar-texto">PESQUISAR</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="ventas_auditoria_rechazados_tabla_view"></div>
    </div>
</section>
<script>
    $(document).ready(function() {
        ventas_auditoria_rechazados_controller_combo_distribuidor();
        $("#ventas_auditoria_rechazados_btn_buscar").click(function() {
            ventas_auditoria_rechazados_controller_buscar_tabla();
        });
    });

    function ventas_auditoria_rechazados_controller_combo_distribuidor() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_combo_distribuidor',
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

    function ventas_auditoria_rechazados_controller_buscar_tabla() {
        $('#loader_panel').show();
        var cmb_distribuidor = $('#cmb_distribuidor').val();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_tabla',
            dataType: 'json',
            data: {
                cmb_distribuidor: cmb_distribuidor
            },
            success: function(data) {
                $('#ventas_auditoria_rechazados_tabla_view').html(data.tabla);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
</script>