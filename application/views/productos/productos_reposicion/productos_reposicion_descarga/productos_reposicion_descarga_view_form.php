<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<section id="reposicionCaptura">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('productos_reposicion_descarga_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>  
    <div class="container">
        <div class="row" style="margin:20px 0px;">
            <?= $sub_menu ?>
        </div>
        <div class="panel-white">
            <div class="form-rf-1" id="form-rf-1">
                <div class="row row-validator">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="cmb_anio"><?= $this->lang->line('productos_reposicion_descarga_controller_lang_etiqueta_anio') ?></label>
                            <select name="cmb_anio" id="cmb_anio" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group" style="display: none;" id="div_mes">
                            <label for="cmb_mes"><?= $this->lang->line('productos_reposicion_descarga_controller_lang_etiqueta_periodo') ?></label>
                            <select name="cmb_mes" id="cmb_mes" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-5" style="display: none;" id="div_cmbdistribuidora">
                        <div class="form-group">
                            <label for="cmb_distribuidora"><?= $this->lang->line('productos_reposicion_descarga_controller_lang_etiqueta_distribuidor') ?></label>
                            <select name="cmb_distribuidora" id="cmb_distribuidora" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-2" style="display: none;" id="div_cmbtipo">
                        <div class="form-group">
                            <label for="cmb_tipo"><?= $this->lang->line('productos_reposicion_descarga_controller_lang_etiqueta_tipo') ?></label>
                            <select name="cmb_tipo" id="cmb_tipo" class="form-select"></select>
                        </div>
                    </div>
                </div>
                <!-- <div class="row row-validator">
                    <div class="col-lg-5" style="display: none;" id="div_cmbdistribuidora">
                        <div class="form-group">
                            <label for="cmb_distribuidora"><?= $this->lang->line('productos_reposicion_descarga_controller_lang_etiqueta_distribuidor') ?></label>
                            <select name="cmb_distribuidora" id="cmb_distribuidora" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-3" style="display: none;" id="div_cmbtipo">
                        <div class="form-group">
                            <label for="cmb_tipo"><?= $this->lang->line('productos_reposicion_descarga_controller_lang_etiqueta_tipo') ?></label>
                            <select name="cmb_tipo" id="cmb_tipo" class="form-select"></select>
                        </div>
                    </div>
                </div> -->
                <div class="row row-validator justify-content-end">
                    <div class="col-lg-2" style="display: none;" id="div_buscar">
                        <div class="">
                            <button type="button" id="productos_reposicion_descarga_view_btn_descarga" class="btn btn-axalta btn-buscar-ancho"><i class="fas fa-download"></i><span class="btn-buscar-texto"><?= $this->lang->line('productos_reposicion_descarga_controller_lang_etiqueta_descarga') ?></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        productos_reposicion_descarga_view_js_combo_anio();
        $('#cmb_anio').on('change', function() {
            productos_reposicion_descarga_view_js_crear_cmb_tipo();
            var anio = $('#cmb_anio').val();
            if (anio == 0) {
                $('#div_mes').hide(300);
              //  $('#div_cmbdistribuidora').hide(300);
              //  $('#div_cmbtipo').hide(300);
             //   $('#div_buscar').hide(300);
            } else {
                productos_reposicion_descarga_view_js_combo_mes();
                $('#div_mes').show(300);
              //  $('#div_buscar').show(300);
             //   $('#div_cmbtipo').show(300); 
            }
        });
        $('#cmb_mes').on('change', function() {
            var mes = $('#cmb_mes').val();
            if (mes == 0) {
                $('#div_cmbdistribuidora').hide(300);
                $('#div_cmbtipo').hide(300);
                $('#div_buscar').hide(300);  
            } else {
                productos_reposicion_descarga_view_js_combo_distribuidora();
               // $('#div_cmbdistribuidora').show(300);

            }
        });
        $('#cmb_distribuidora').on('change', function() {
            var cmb_distribuidora = $('#cmb_distribuidora').val();
            if (cmb_distribuidora == 0) {
              //  $('#div_cmbtipo').hide(300);
                //$('#div_buscar').hide(300); 
            } else {
                productos_reposicion_descarga_view_js_crear_cmb_tipo();
                $('#div_cmbtipo').show(300);
                $('#div_buscar').show(300);
            }
        });
        $("#productos_reposicion_descarga_view_btn_descarga").click(function() {
            productos_reposicion_descarga_view_js_descargar();
        });
    });

    function productos_reposicion_descarga_view_js_combo_anio() {
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_descarga/productos_reposicion_descarga_controller/productos_reposicion_descarga_controller_cmb_anio',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_anio').empty();
                $('#cmb_anio').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function productos_reposicion_descarga_view_js_combo_mes() {
        var anio = $('#cmb_anio').val();
        $('#div_cmbdistribuidora').hide(300);
        $('#div_cmbtipo').hide(300);
        $("#cmb_distribuidora").find('option').not(':first').remove();
       // $("#cmb_tipo").find('option').not(':first').remove();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_descarga/productos_reposicion_descarga_controller/productos_reposicion_descarga_controller_cmb_mes',
            dataType: 'json',
            data: {
                anio: anio
            },
            success: function(data) {
                $('#cmb_mes').empty();
                $('#cmb_mes').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function productos_reposicion_descarga_view_js_combo_distribuidora() {
        var anio = $('#cmb_anio').val();
        var mes = $('#cmb_mes').val();
      //  $("#cmb_tipo").find('option').not(':first').remove();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_descarga/productos_reposicion_descarga_controller/productos_reposicion_descarga_controller_cmb_distribuidora',
            dataType: 'json',
            data: {
                anio: anio,
                mes: mes
            },
            success: function(data) {
                if(data==""){
                Swal.fire({
                title: '',
                html: 'SIN REGISTROS ENCONTRADOS',
                icon: 'error',
                allowOutsideClick: false,
                showCancelButton: false,
                confirmButtonColor: '#fd7e14',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'OK',
                cancelButtonText: ''
            });
                    $('#div_cmbdistribuidora').hide(300);
                    $('#div_cmbtipo').hide(300);
                    $('#div_buscar').hide(300);  
                } else {
                     $('#div_cmbdistribuidora').show(300);
                     $('#div_cmbtipo').show(300);
                    $('#div_buscar').show(300);  
                }
                $('#cmb_distribuidora').empty();
                $('#cmb_distribuidora').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function productos_reposicion_descarga_view_js_crear_cmb_tipo() {
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_descarga/productos_reposicion_descarga_controller/productos_reposicion_descarga_controller_cmb_tipo',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_tipo').empty();
                $('#cmb_tipo').html(data);
            },
            error: function(data) {},
            complete: function() {}
        });
    }

    function productos_reposicion_descarga_view_js_descargar() {
        $('#error').html(" ");
        $('#loader_panel').show();
        var cmb_mes = $("#cmb_mes").val();
        var cmb_anio = $("#cmb_anio").val();
        var cmb_tipo = $("#cmb_tipo").val();
        var cmb_distribuidora = $("#cmb_distribuidora").val();
        $.ajax({
            type: "POST",
            url: 'productos/productos_reposicion/productos_reposicion_descarga/productos_reposicion_descarga_controller/productos_reposicion_descarga_controller_descargar',
            data: {
                cmb_mes: cmb_mes,
                cmb_anio: cmb_anio,
                cmb_tipo: cmb_tipo,
                cmb_distribuidora: cmb_distribuidora
            },
            dataType: "json",
            success: function(data) {
                console.log('success');
                if (data == 0) {
                    Swal.fire('NO SE ENCONTRÓ NINGÚN REGISTRO CON LOS PARÁMETROS INGRESADOS')
                    $('#loader_panel').hide();
                }
                $(location).attr('href', data.url);
            },
            error: function(data) {
                console.log('Error');
                console.log(data);
            },
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
</script>