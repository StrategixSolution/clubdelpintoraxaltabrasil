<?php

defined('BASEPATH') or exit('No direct script access allowed');
?>
<form enctype="multipart/form-data" id="promocion_bimestral_form_view" role="form" method="post" accept-charset="utf-8">
    <section class="PromocionBimestral">
       <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('mail_promocion_bimestral_controller_lang_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
        <div class="container">
            <div class="panel-white">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="form-group"  id="div_anio">
                            <label
                                for="cmb_anio"><?= $this->lang->line('mail_promocion_bimestral_controller_lang_etiqueta_anio') ?></label>
                            <select name="cmb_anio" id="cmb_anio" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group" style="display: none;" id="div_mes">
                            <label
                                for="cmb_mes">Mes:</label>
                            <select name="cmb_mes" id="cmb_mes" class="form-select"></select>
                        </div>
                    </div>
                    <div class="col-lg-5" id="promocion_archivo">
                        <div class="form-group" style="display: none;" id="div_archivo">
                            <label
                                for="promocion_bimestral_form_view_file"><?= $this->lang->line('mail_promocion_bimestral_controller_lang_etiqueta_archivo') ?></label>
                            <input type="file" name="promocion_bimestral_form_view_file"
                                id="promocion_bimestral_form_view_file" class="form-control"
                                placeholder="<?= $this->lang->line('mail_promocion_bimestral_controller_lang_etiqueta_archivo') ?>">
                        </div>
                    </div>
                    <div class="col-lg-2" style="text-align: right; display: none;" id="div_buscar">
                        <div class="form-group">
                            <button type="submit" id="ventas_registradas_mp_btn_buscar" class="btn btn-axalta btn-buscar-ancho"
                                style="margin-top: 1.68em;"><i class="far fa-save"></i><span class="btn-buscar-texto"><?= $this->lang->line('mail_promocion_bimestral_controller_lang_etiqueta_btn_guardar') ?></span>
                                </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12" id="div_perfil" style="display: none;">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div id="check_perfil">
                                    <div class="row"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tablaPromocionBimestral"></div>
            </div>
        </div>
    </section>
</form>
<script>
    $(document).ready(function () {
        promocion_bimestral_controller_js_crear_cmbanio();
        promocion_bimestral_controller_check_perfil();
        $("#promocion_bimestral_form_view").submit(function (event) {
            event.preventDefault();
        });

        $('#cmb_anio').on('change', function () {
            var anio = $('#cmb_anio').val();
            if (anio == 0) {
                $('#div_mes').hide(300);
                $('#div_archivo').hide(300);
                $('#div_perfil').hide(300);
                $('#promocion_bimestral_form_view_file').val('');
            } else {
                promocion_bimestral_controller_js_crear_cmbmes();
                $('#div_mes').show(300);
            }
        });
        $('#cmb_mes').on('change', function () {
            var mes = $('#cmb_mes').val();
            if (mes == 0) {
                $('#div_archivo').hide(300);
                $('#div_perfil').hide(300);
                $('#div_buscar').hide(300);
                $('#promocion_bimestral_form_view_file').val('');
            } else {
                $('#div_archivo').show(300);
                $('#div_perfil').show(300);
                $('#div_buscar').show(300);
            }
        });
        $("#ventas_registradas_mp_btn_buscar").click(function () {
            promocion_bimestral_controller_js_crear_tabla();
        });
    });

    function promocion_bimestral_controller_js_crear_cmbanio() {
        $.ajax({
            type: 'POST',
            url: 'promocion/promocion_bimestral/mail_promocion_bimestral_controller/mail_promocion_bimestral_controller_cmbanios',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function (data) {
                $('#cmb_anio').empty();
                $('#cmb_anio').html(data);
                $('#div_anio').show(300);
            },
            error: function (data) { },
            complete: function () { }
        });
    }

    function promocion_bimestral_controller_js_crear_cmbmes() {
        var anio = $('#cmb_anio').val();
        $.ajax({
            type: 'POST',
            url: 'promocion/promocion_bimestral/mail_promocion_bimestral_controller/mail_promocion_bimestral_controller_cmbmes',
            dataType: 'json',
            data: {
                anio: anio
            },
            success: function (data) {
                $('#cmb_mes').empty();
                $('#cmb_mes').html(data);
            },
            error: function (data) { },
            complete: function () { }
        });
    }

    function promocion_bimestral_controller_js_crear_tabla() {
        var archivo = document.getElementById('promocion_bimestral_form_view_file');
        var archivoRuta = archivo.value;
        var extPermitidas = /(.jpeg|.jpg|.png|.gif)$/i;
        var formData = new FormData($("#promocion_bimestral_form_view")[0]);
        var checkbox = document.getElementsByName('perfil[]');
       var contador = 0;
    for(var i=0; i< checkbox.length; i++) {
        if(checkbox[i].checked)
            contador++ }
        var cmb_tipo = $('#cmb_tipo').val();
        var fecha_inicio = $('#fecha_inicio').val();
        var fecha_fin = $('#fecha_fin').val();
        var text_area = $('#text_area').val();
        var file = $('#file').val();
        if(contador ==0){
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "SELECIONE PELO MENOS UM PERFIL"
            });
            return;
        }
        if (archivoRuta == "") {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "SELECIONE UMA IMAGEM"
            });
            archivo.value = '';
            return false;
        } else if (!extPermitidas.exec(archivoRuta)) {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "O ARQUIVO NÃO É UMA IMAGEM"
            });
            archivo.value = '';
            return false;
        } else {
            $('#loader_panel').show();
            $.ajax({
                type: $('#promocion_bimestral_form_view').attr('method'),
                url: 'promocion/promocion_bimestral/mail_promocion_bimestral_controller/mail_promocion_bimestral_controller_tabla',
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.resultados == 1) {
                        Swal.fire({
                            icon: 'error',
                            allowOutsideClick: false,
                            text: "A PROMOÇÃO JÁ FOI ENVIADA COM OS PARÂMETROS SELECIONADOS"
                        });
                    } else if (data.resultados == 2) {
                        Swal.fire({
                            icon: 'error',
                            allowOutsideClick: false,
                            text: "ERRO AO SALVAR O ARQUIVO"
                        });
                    } else if (data.resultados == 3) {
                        Swal.fire({
                            icon: 'error',
                            allowOutsideClick: false,
                            text: "NÃO EXISTE NENHUM EMAIL REGISTRADO PARA O PAÍS SELECIONADO"
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            allowOutsideClick: false,
                            text: 'PROMOÇÃO ENVIADA'
                        });
                        $('#tablaPromocionBimestral').html(data);
                    }
                },
                error: function (data) { },
                complete: function () {
                    $('#loader_panel').hide();
                }
            });
        }
    }
    function promocion_bimestral_controller_check_perfil() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'promocion/promocion_bimestral/mail_promocion_bimestral_controller/mail_promocion_bimestral_controller_perfil',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function (data) {
                $.each(data, function (d, v) {
                    let htmlTags = `<div class="col"  style="border:1px solid #c82127; border-radius:10px; margin:5px 10px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="${d}" name="perfil[]" value="${d}" style="margin:6px 0px 0px 0px;">
                                            <label class="form-check-label ml-10 btn-buscar-texto" for="${d}"> ${v}</label></div>
                                        </div> 
                                    </div> 
                                   `;
                    $('#check_perfil .row').append(htmlTags);
                });
            },
            error: function (data) { console.log(data); },
            complete: function () {
                $('#loader_panel').hide();
            }
        });
    }
</script>