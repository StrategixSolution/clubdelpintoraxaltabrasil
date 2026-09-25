<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
$puedeVerTodas = isset($puede_ver_todas) && $puede_ver_todas === true;
$esCallCenter  = isset($es_callcenter) && $es_callcenter === true;
$textoTodas    = $puedeVerTodas ? 'TODOS OS DISTRIBUIDORES' : 'TODOS OS MEUS DISTRIBUIDORES';
?>

<section class="reportes_personal_tienda">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>RELATÓRIO DA EQUIPE DA LOJA</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="form-rf-1" id="form-rf-1">
                    <div class="row row-validator">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>DISTRIBUIDOR</label>
                                <select id="reporte_personal_tienda_cmb_distribuidor" class="form-select">
                                    <option value="">SELECIONE UM DISTRIBUIDOR</option>
                                    <option value="0"><?= htmlspecialchars(utf8_encode($textoTodas), ENT_QUOTES) ?></option>
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

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>CÓDIGO DISTRIBUIDOR</label>
                                <input type="text" id="reporte_personal_tienda_txt_codigo" class="form-control" maxlength="100" placeholder="CÓDIGO">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>RAZÃO SOCIAL / NOME COMERCIAL</label>
                                <input type="text" id="reporte_personal_tienda_txt_nombre" class="form-control" maxlength="250" placeholder="DISTRIBUIDORA">
                            </div>
                        </div>
                        <div class="col-lg-2 col-12 text-right">
                            <button type="button" id="reporte_personal_tienda_btn_buscar" class="btn btn-axalta btn-buscar-ancho btn-buscar-posicion">
                                <i class="fas fa-search"></i><span class="btn-buscar-texto">PROCURAR</span>
                            </button>
                        </div>
                    </div>

                </div>
                <div id="reporte_personal_tienda_tabla_contenedor"></div>
            </div>

            
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $('.distribuidor').hide();

    $('#reporte_personal_tienda_cmb_distribuidor').on('change', function(){
        $('#reporte_personal_tienda_tabla_contenedor').empty();
        $('.distribuidor').hide();
    });

    $('#reporte_personal_tienda_txt_codigo, #reporte_personal_tienda_txt_nombre').on('keyup', function(e){
        if (e.keyCode === 13) {
            reporte_personal_tienda_buscar();
        }
    });

    $('#reporte_personal_tienda_btn_buscar').click(function(){
        reporte_personal_tienda_buscar();
    });
});

function reporte_personal_tienda_buscar(){
    var distribuidor = $('#reporte_personal_tienda_cmb_distribuidor').val();
    var codigo       = $.trim($('#reporte_personal_tienda_txt_codigo').val());
    var nombre       = $.trim($('#reporte_personal_tienda_txt_nombre').val());

    $('.distribuidor').hide();

    if (typeof distribuidor === 'undefined' || distribuidor === null || distribuidor === '') {
        $('.distribuidor').show();
        return false;
    }

    $('#loader_panel').show();

    $.ajax({
        type: 'POST',
        url: '<?= base_url("ReportePersonalTiendaBuscar"); ?>',
        data: {
            distribuidor: distribuidor,
            codigo: codigo,
            nombre: nombre
        },
        success: function(data){
            $('#reporte_personal_tienda_tabla_contenedor').html(data).show(300);
        },
        error: function(xhr){
            console.log(xhr.responseText);
            $('#loader_panel').hide();
        }
    });
}
</script>
