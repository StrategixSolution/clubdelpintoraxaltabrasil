<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<section id="tutoriales">
    <div class="panel-title-ext">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 title-div-align-l">
                    <h1>TUTORIAIS</h1>
                </div>
                <div class="col-lg-6 title-div-align-r">
                    <img src="<?= funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/cdp.png") ?>" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel-white">
            <div class="row justify-content-center">
                <?= $tabla ?>
            </div>
        </div>
    </div>
</section>
<script>
    function tutoriales_externos_view_js_modal(archivo, tipo, download, extension) {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'tutoriales/tutoriales_externos/tutoriales_externos_controller/tutoriales_externos_controller_modal',
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