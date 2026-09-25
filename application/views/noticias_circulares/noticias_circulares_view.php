<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="promociones_ganadores">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>PROMOÇÕES E VENCEDORES</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row panel-white">
            <div class="col-lg-12">
                <h2>PROMOÇÃO ATUAL</h2>
            </div>
            <?= $tablaPA ?>
        </div>
    </div>
    <div class="container">
        <div class="row panel-white">
            <div class="col-lg-12">
                <h2>PROMOÇÃO ANTERIOR</h2>
            </div>
            <?= $tablaPANT ?>
        </div>
    </div>
    <div class="container">
        <div class="row panel-white">
            <div class="col-lg-12">
                <h2>VENCEDORES</h2>
            </div>
            <?= $tablaG ?>
        </div>
    </div>
</section>
<script>
    function noticias_circulares_js_view_modal(archivo, tipo, download, extension) {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'noticias_circulares/noticias_circulares_controller/noticias_circulares_controller_tipo_modal',
            dataType: 'json',
            data: {
                archivo: archivo,
                tipo: tipo,
                download: download,
                extension: extension
            },
            success: function(data) {
                $('#myModal').html(data).modal('show');
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
</script>