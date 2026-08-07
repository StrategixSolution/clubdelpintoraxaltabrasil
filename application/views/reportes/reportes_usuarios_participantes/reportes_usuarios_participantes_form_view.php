<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>
<section id="participantes">
 <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">        
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-3" style="display: none;" id="div_segmento">
                    <div class="form-group">
                        <label
                            for="cmb_segmento"><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_etiqueta_segmento') ?></label>
                        <select id="cmb_segmento" name="cmb_segmento" class="form-select"></select>
                        <div id="error"></div>
                    </div>
                </div>
                <div class="col-lg-6"  id="div_distribuidoras">
                    <div class="form-group">
                        <label
                            for="reporte_usuarios_participantes_view_cmb_distribuidoras"><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_etiqueta_distribuidoras') ?></label>
                        <select id="reporte_usuarios_participantes_view_cmb_distribuidoras"
                            name="reporte_usuarios_participantes_view_cmb_distribuidoras" class="form-select"></select>
                    </div>
                </div>
                <div class="col-lg-4" id="div_estatus">
                    <div class="form-group">
                        <label
                            for="reporte_usuarios_participantes_view_cmb_estatus"><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_combo_estatus') ?></label>
                        <select id="reporte_usuarios_participantes_view_cmb_estatus"
                            name="reporte_usuarios_participantes_view_cmb_estatus" class="form-select">
                            <option value="0">
                                <?= $this->lang->line('reportes_usuarios_participantes_controller_lang_combo_estatus_TODOS') ?>
                            </option>
                            <option value="1">
                                <?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_estatus_activo') ?>
                            </option>
                            <option value="2">
                                <?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_estatus_baja') ?>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2" id="div_buscar">
                    <div class="form-group">
                        <button type="button" id="reporte_usuarios_participantes_view_boton_buscar"
                            class="btn btn-axalta"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div id="reporte_usuarios_participantes_view_tabla_participante"></div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        reporte_usuarios_participantes_js_combo_distribuidora();
      /*  $('#cmb_pais').on('change', function() {
            var cmb_pais = $('#cmb_pais').val();
            if (cmb_pais == '') {
                $('#div_segmento').hide(300);
                $('#div_distribuidoras').hide(300);
                $('#div_estatus').hide(300);
                $('#div_buscar').hide(300);
            } else {
                reportes_usuarios_participantes_form_view_js_combo_segmento();
                $('#div_segmento').hide(300);
                $('#div_distribuidoras').hide(300);
                $('#div_estatus').hide(300);
                $('#div_buscar').hide(300);
            }
        });*/

       /* $('#cmb_segmento').on('change', function() {
            var cmb_pais = $('#cmb_pais').val();
            var cmb_segmento = $('#cmb_segmento').val();
            if (cmb_segmento == '') {
                $('#div_distribuidoras').hide(300);
                $('#div_estatus').hide(300);
                $('#div_buscar').hide(300);
            } else {
                reporte_usuarios_participantes_js_combo_distribuidora(cmb_pais, cmb_segmento);
                $('#div_distribuidoras').show(300);
                $('#div_estatus').show(300);
                $('#div_buscar').show(300);
            }
        });*/


        $('#reporte_usuarios_participantes_view_cmb_distribuidoras').on('change', function() {
            $('#reporte_usuarios_participantes_view_tabla_participante').empty();
        });
        $("#reporte_usuarios_participantes_view_boton_buscar").click(function() {
            reporte_usuarios_participantes_js_buscar_tabla();
        });
    });

    function reporte_usuarios_participantes_js_combo_distribuidora() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_usuarios_participantes/reportes_usuarios_participantes_controller/reportes_usuarios_participantes_controller_combo_distribuidoras',

            dataType: 'json',
            data: {
               1:1
            },
            success: function(data) {
                $('#reporte_usuarios_participantes_view_cmb_distribuidoras').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function reporte_usuarios_participantes_js_buscar_tabla() {
        $('#loader_panel').show();
        var cmb_pais = $('#cmb_pais').val();
        var cmb_segmento = $('#cmb_segmento').val();
        var reporte_usuarios_participantes_view_cmb_distribuidoras = $('#reporte_usuarios_participantes_view_cmb_distribuidoras').val();
        var reporte_usuarios_participantes_view_cmb_estatus = $('#reporte_usuarios_participantes_view_cmb_estatus').val();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_usuarios_participantes/reportes_usuarios_participantes_controller/reportes_usuarios_participantes_controller_tabla',
            dataType: 'json',
            data: {
                cmb_pais: cmb_pais,
                cmb_segmento: cmb_segmento,
                reporte_usuarios_participantes_view_cmb_distribuidoras: reporte_usuarios_participantes_view_cmb_distribuidoras,
                reporte_usuarios_participantes_view_cmb_estatus: reporte_usuarios_participantes_view_cmb_estatus
            },
            success: function(data) {
                $('#reporte_usuarios_participantes_view_tabla_participante').html(data.tabla);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
</script>