<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>
<section class="TbReporteReposicionProductos">
    <div style="background: linear-gradient(rgba(5, 7, 12, 0.75), rgba(5, 7, 12, 0.50)), url(<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/tarjetas/" . $this->session->userdata(funciones_strategix_sitio_alias('s_segmento_id')) . "/bg-title.jpg") ?>)  center center / cover no-repeat;">
        <div class="container">
            <div class="title-modulo">
                <h2><?= $this->lang->line('tarjetas_altas_controller_lang_pagina_titulo') ?></h2>
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
                                <label for="cmb_pais"><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_pais') ?></label>
                                <select id="cmb_pais" name="cmb_pais" class="form-select"></select>
                                <div id="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="cmb_distribuidor"><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_distribuidor') ?></label>
                                <select id="cmb_distribuidor" name="cmb_distribuidor" class="form-select"></select>
                                <div id="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="cmb_division"><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_division') ?></label>
                                <select id="cmb_division" name="cmb_division" class="form-select"></select>
                                <div id="error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lbl_txt"><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_inicial') ?></label>
                                <input type="text" id="txt_No_Inicial" class="form-control" name="txt_No_Inicial" placeholder="<?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_inicial') ?>">
                                <div id="error"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lbl_txt"><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_final') ?></label>
                                <input type="text" id="txt_No_Final" class="form-control" name="txt_No_Final" placeholder="<?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_no_final') ?>">
                                <div id="error"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr class="separador">
                    </div>
                    <div class="row" style="margin-top:20px; text-align:center;">
                        <div class="col-lg-2 offset-lg-8 col-6">
                            <button type="button" onclick="window.location.href='<?= funciones_strategix_version_url_random_base_url("Tarjetas") ?>'" class="btn btn-gray"><i class="far fa-caret-square-left pr-5"></i> <?= $this->lang->line('tarjetas_altas_controller_lang_btn_regresar') ?></button>
                        </div>
                        <div class="col-lg-2 col-6">
                            <button type="button" id="tarjetas_altas_form_view_btn_buscar" class="btn btn-axalta"><i class="far fa-save pr-5"></i><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_boton') ?></button>
                        </div>
                    </div>
                    <div id="tablaAltaTarjetas"></div>
                </div>
                <!-- <div class="col-lg-2" style="text-align: right;">
                    <div class="form-group">
                        <button type="button" id="tarjetas_altas_form_view_btn_buscar" class="btn btn-axalta" style="margin-top:20px;"><?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_boton') ?></button>
                        <button type="button" onclick="window.location.href='<?= funciones_strategix_version_url_random_base_url("Tarjetas") ?>'" class="btn btn-gray"><i class="far fa-caret-square-left"></i> <?= $this->lang->line('tarjetas_altas_controller_lang_btn_regresar') ?></button>
                    </div>
                </div> -->
                
            </div>
            <div class="col-lg-3 no-cel" style=" margin-top: -20px; margin-bottom: -20px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; background: url(<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/tarjetas/" . $this->session->userdata(funciones_strategix_sitio_alias('s_segmento_id')) . "/bg-form.jpg") ?>)  center center / cover no-repeat;"></div>
        </div>
        
    </div>
</section>
<script>
    var fecha_inicio;
    var fecha_fin;
    $(document).ready(function() {
        tarjetas_altas_form_view_js_combo_pais();
        $('#cmb_pais').change(function() {
            $('#cmb_division').empty().html('');
            tarjetas_altas_form_view_js_combo_distribuidor();
        });
        $('#cmb_distribuidor').change(function() {
            tarjetas_altas_form_view_js_combo_division();
        });
        $("#tarjetas_altas_form_view_btn_buscar").click(function() {
            var cmb_distribuidor = $('#cmb_distribuidor').val();
            var cmb_pais = $('#cmb_pais').val();
            console.log(cmb_pais);
            console.log(cmb_distribuidor);
            if ((parseInt(cmb_distribuidor) == -1 || cmb_distribuidor > 0) && cmb_pais > 0) {
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

    function tarjetas_altas_form_view_js_combo_pais() {
        $.ajax({
            type: 'POST',
            url: 'tarjetas/tarjetas_altas/tarjetas_altas_controller/tarjetas_altas_controller_combo_lista_pais',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_pais').empty().html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function tarjetas_altas_form_view_js_combo_distribuidor() {
        var cmb_pais = $('#cmb_pais').val();
        $.ajax({
            type: 'POST',
            url: 'tarjetas/tarjetas_altas/tarjetas_altas_controller/tarjetas_altas_controller_combo_distribuidor',
            dataType: 'json',
            data: {
                cmb_pais: cmb_pais
            },
            success: function(data) {
                $('#cmb_distribuidor').empty().html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function tarjetas_altas_form_view_js_combo_division() {
        var cmb_distribuidor = $('#cmb_distribuidor').val();
        if(cmb_distribuidor!=0){
        $.ajax({
            type: 'POST',
            url: 'tarjetas/tarjetas_altas/tarjetas_altas_controller/tarjetas_altas_controller_combo_division',
            dataType: 'json',
            data: {
                cmb_distribuidor: cmb_distribuidor
            },
            success: function(data) {
                $('#cmb_division').empty().html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }
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
                text: "SELECCIONE UN DISTRIBUIDOR"
            });
        } else if (cmb_division == 0) {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "SELECCIONE UNA DIVISIÓN"
            });
        }else if (inicio == "") {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "INGRESE NUMERO INICIAL"
            });
        } else if (fin == "") {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "INGRESE NUMERO FINAL"
            });
        } else if (parseInt(inicio) > parseInt(fin)) {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "EL NUMERO FINAL TIENE QUE SER MAYOR O IGUAL QUE EL INICIAL"
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
                success: function(data) {
                    $('#tablaAltaTarjetas').html(data);
                },
                error: function(data) {
                    console.log(data);
                },
                complete: function() {
                    $('#loader_panel').hide();
                }
            });
        }
    }
</script>