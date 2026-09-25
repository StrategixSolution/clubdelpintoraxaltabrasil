<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<section id="tutoriales">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>TUTORIAIS</h2>
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
    function tutoriales_internos_view_js_modal(archivo, tipo, download, extension) {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'tutoriales/tutoriales_internos/tutoriales_internos_controller/tutoriales_internos_controller_modal',
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