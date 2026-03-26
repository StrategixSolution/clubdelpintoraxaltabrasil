<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>
<section class="TarjetasAltasFormView">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('tarjetas_altas_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row panel-white panel-white-alt">
            <div class="col-lg-9">
                <div class="form-pr">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label
                                    for="cmb_distribuidor"><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_distribuidor') ?></label>
                                <select id="cmb_distribuidor" name="cmb_distribuidor" class="form-select"></select>
                                <div id="error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label
                                    for="lbl_txt"><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_inicial') ?></label>
                                <input type="text" id="txt_No_Inicial" class="form-control" name="txt_No_Inicial"
                                    placeholder="<?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_inicial') ?>">
                                <div id="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label
                                    for="lbl_txt"><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_final') ?></label>
                                <input type="text" id="txt_No_Final" class="form-control" name="txt_No_Final"
                                    placeholder="<?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_final') ?>">
                                <div id="error"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr class="separador">
                    </div>
                    <div class="row" style="margin-top:20px; text-align:center;">
                        <div class="col-lg-2 offset-lg-8 col-6">
                            <button type="button"
                                onclick="window.location.href='<?= funciones_strategix_version_url_random_base_url("Tarjetas") ?>'"
                                class="btn btn-gray"><i class="far fa-caret-square-left pr-5"></i>
                                <?= $this->lang->line('tarjetas_altas_controller_lang_btn_regresar') ?></button>
                        </div>
                        <div class="col-lg-2 col-6">
                            <button type="button" id="tarjetas_altas_form_view_btn_buscar" class="btn btn-axalta"><i
                                    class="far fa-save pr-5"></i><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_boton') ?></button>
                        </div>
                    </div>
                    <div id="tablaAltaTarjetas"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var fecha_inicio;
    var fecha_fin;
    $(document).ready(function () {
      tarjetas_altas_form_view_js_combo_distribuidor();
        $("#tarjetas_altas_form_view_btn_buscar").click(function () {
            var cmb_distribuidor = $('#cmb_distribuidor').val();
            if (parseInt(cmb_distribuidor) == -1 || cmb_distribuidor > 0)  {
                tarjetas_altas_form_view_js_crear_tabla();
            } else {
                Swal.fire({
                    icon: 'error',
                    allowOutsideClick: false,
                    text: "<?= $this->lang->line('tarjetas_altas_controller_lang_js_error_combos') ?>"
                });
            }
        });
    });
function tarjetas_altas_form_view_js_combo_distribuidor() {
        $.ajax({
            type: 'POST',
            url: 'tarjetas/tarjetas_altas/tarjetas_altas_controller/tarjetas_altas_controller_combo_distribuidor',
            dataType: 'json',
            data: {
                1: 1
            },
            success: function(data) {
                $('#cmb_distribuidor').empty().html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }
   

    function tarjetas_altas_form_view_js_crear_tabla() {
        var cmb_distribuidor = $('#cmb_distribuidor').val();
        var cmb_pais = $('#cmb_pais').val();
        var inicio = $('#txt_No_Inicial').val();
        var fin = $('#txt_No_Final').val();
        var cmb_division = $('#cmb_division').val();
        if (cmb_distribuidor == 0) {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "<?= $this->lang->line('tarjetas_altas_controller_lang_tabla_combo_distribuidor_selecciona') ?>"
            });
        } else if (inicio == "") {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "<?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_inicial') ?>"
            });
        } else if (fin == "") {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "<?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_final') ?>"
            });
        } else if (parseInt(inicio) > parseInt(fin)) {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "<?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_valida_numero') ?>"
            });
        } else {
            $('#loader_panel').show();
            $.ajax({
                type: 'POST',
                url: 'tarjetas/tarjetas_altas/tarjetas_altas_controller/tarjetas_altas_controller_tabla',
                dataType: 'json',
                data: {
                    cmb_distribuidor: cmb_distribuidor,
                    inicio: inicio,
                    fin: fin,
                    cmb_pais: cmb_pais,
                    cmb_division: cmb_division
                },
                success: function (data) {
                    $('#tablaAltaTarjetas').html(data);
                },
                error: function (data) {
                    console.log(data);
                },
                complete: function () {
                    $('#loader_panel').hide();
                }
            });
        }
    }
</script>