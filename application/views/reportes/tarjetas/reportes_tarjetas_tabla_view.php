<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
if (!function_exists('rtarjetas_out')) {
    function rtarjetas_out($valor) {
        return htmlspecialchars(utf8_encode((string) $valor), ENT_QUOTES);
    }
}

$totalTarjetas = is_array($tabla) ? count($tabla) : 0;
?>

<section class="reportes_tarjetas_tabla_view">
    <div class="panel-white">
        <div class="row mb-10 text-right">
            <div class="col-lg-12 text-right">
                <div class="alert alert-danger text-right" style="margin-bottom:10px; text-align:end;">
                    <strong>TOTAL DE CARTÃO:</strong>
                    <span id="lbl_total_tarjetas_backend"><?= number_format($totalTarjetas) ?></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table-axalta">
                    <table class="table table-bordered" id="tb_reporte_tarjetas">
                        <thead>
                            <tr>
                                <th>Nº DO CARTÃO</th>
                                <th>DISTRIBUIDOR</th>
                                <th>DATA DE INSCRIÇÃO</th>
                                <th>DATA DE CANCELAMENTO</th>
                                <th>ESTATUS DO CARTÃO</th>
                                <th>PARTICIPANTE</th>
                                <th>ESTATUS PARTICIPANTE</th>
                                <th>PERFIL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tabla as $r): ?>
                                <tr>
                                    <td><?= rtarjetas_out($r->TarjetaNumero) ?></td>
                                    <td><?= rtarjetas_out($r->Distribuidor) ?></td>
                                    <td><?= rtarjetas_out($r->TarjetaFechaRegistro) ?></td>
                                    <td><?= rtarjetas_out($r->TarjetaFechaBaja) ?></td>
                                    <td><?= rtarjetas_out($r->TarjetaEstatusDescripcion) ?></td>
                                    <td><?= rtarjetas_out($r->Participante) ?></td>
                                    <td><?= rtarjetas_out($r->EstatusParticipante) ?></td>
                                    <td><?= rtarjetas_out($r->PerfilDescripcion) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $('#tb_reporte_tarjetas').DataTable({
        scrollX: 1800,
        scrollY: 350,
        lengthMenu: [
            [10,25,50,100,-1],
            [10,25,50,100,"<?= $this->lang->line('data_table_js_lang_combo_todos') ?>"]
        ],
        stateSave: true,
        bDestroy: true,
        deferRender: true,
        language: {
            lengthMenu: "<?= $this->lang->line('data_table_js_lang_lengthMenu') ?>",
            zeroRecords: "<?= $this->lang->line('data_table_js_lang_zeroRecords') ?>",
            info: "<?= $this->lang->line('data_table_js_lang_info') ?>",
            infoEmpty: "<?= $this->lang->line('data_table_js_lang_infoEmpty') ?>",
            infoFiltered: "<?= $this->lang->line('data_table_js_lang_infoFiltered') ?>",
            search: "<?= $this->lang->line('data_table_js_lang_search') ?>",
            paginate: {
                first: "<?= $this->lang->line('data_table_js_lang_first') ?>",
                last: "<?= $this->lang->line('data_table_js_lang_last') ?>",
                next: "<?= $this->lang->line('data_table_js_lang_next') ?>",
                previous: "<?= $this->lang->line('data_table_js_lang_previous') ?>"
            }
        },
        dom: '<"row"<"col-xs-4 col-md-4"l><"col-xs-4 col-md-4 botones"B><"col-md-4"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
        buttons: [{
            extend: 'excelHtml5',
            text: '<?= $this->lang->line('data_table_js_lang_btn_descarga') ?> <span class="iconify" data-icon="file-icons:microsoft-excel" style="font-size:20px;"></span>',
            className: 'btn btn-axalta',
            title: '',
            filename: 'RELATORIO_DO_CARTAO',
            sheetName: 'RELATORIO_DO_CARTAO',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7],
                format: {
                    body: function (data, row, column, node) {
                        var texto = $('<div>').html(data).text();
                        return (texto === '' || texto === null || texto === undefined) ? ' ' : texto;
                    }
                }
            },
            excelStyles: [{
                cells: "1",
                style: {
                    font: { name: "Calibri", size: "12", color: "FFFFFF", b: true },
                    fill: { pattern: { color: "C82127" } }
                }
            },{
                cells: "A:H",
                style: {
                    border: {
                        top: "thin",
                        bottom: "thin",
                        left: "thin",
                        right: "thin"
                    }
                }
            }]
        }],
        initComplete: function(){
            $('#loader_panel').hide();
        }
    });

    $('.dataTables_length').addClass('bs-select');
});
</script>
