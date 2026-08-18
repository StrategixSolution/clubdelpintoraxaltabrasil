<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="reportes_tarjetas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>RELATÓRIO DO CARTÃO</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="form-rf-1" id="form-rf-1">
                    <div class="row row-validator">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>DISTRIBUIDOR</label>
                                <select id="reporte_tarjetas_cmb_distribuidor" class="form-select">
                                    <option value="">SELECIONE UM DISTRIBUIDOR</option>
                                    <?php foreach($distribuidores as $d): ?>
                                        <?php
                                            $idDist        = (int) $d->DistribuidorId;
                                            $codigo        = isset($d->Codigo) ? trim((string) $d->Codigo) : '';
                                            $nombreMostrar = isset($d->NombreMostrar) ? trim((string) $d->NombreMostrar) : '';
                                            $texto         = $idDist . ' - ' . $codigo . ' - ' . $nombreMostrar;
                                        ?>
                                        <option value="<?= $idDist ?>">
                                            <?= htmlspecialchars(utf8_encode($texto), ENT_QUOTES) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="distribuidor text-danger">* Selecione um distribuidor</span>
                            </div>
                        </div>

                        <div class="col-lg-2" style="margin-top:20px;">
                            <div class="form-group">
                                <button type="button" id="reporte_tarjetas_btn_buscar" class="btn btn-axalta btn-buscar-ancho">
                                    <i class="fas fa-search"></i><span class="btn-buscar-texto">PROCURAR</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="reporte_tarjetas_tabla_contenedor"></div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $('.distribuidor').hide();

    $('#reporte_tarjetas_cmb_distribuidor').on('change', function(){
        $('#reporte_tarjetas_tabla_contenedor').empty();
        $('.distribuidor').hide();
    });

    $('#reporte_tarjetas_btn_buscar').click(function(){
        reporte_tarjetas_buscar();
    });
});

function reporte_tarjetas_buscar(){
    var distribuidor = $('#reporte_tarjetas_cmb_distribuidor').val();

    $('.distribuidor').hide();

    if (typeof distribuidor === 'undefined' || distribuidor === null || distribuidor === '') {
        $('.distribuidor').show();
        return false;
    }

    $('#loader_panel').show();

    $.ajax({
        type: 'POST',
        url: '<?= base_url("ReporteTarjetasBuscar"); ?>',
        data: {
            distribuidor: distribuidor
        },
        success: function(data){
            $('#reporte_tarjetas_tabla_contenedor').html(data).show(300);
        },
        error: function(xhr){
            console.log(xhr.responseText);
            $('#loader_panel').hide();
        }
    });
}
</script>
