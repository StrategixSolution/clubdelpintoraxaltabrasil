<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
if (!function_exists('rpersonal_tienda_out')) {
    function rpersonal_tienda_out($valor)
    {
        return htmlspecialchars(utf8_encode((string) $valor), ENT_QUOTES);
    }
}

$totalParticipantes = is_array($tabla) ? count($tabla) : 0;
$esCallCenter       = isset($es_callcenter) && $es_callcenter === true;
?>

<section class="reportes_personal_tienda_tabla_view">
    <hr class="separador">
    <div class="row mb-10 text-right">
        <div class="col-lg-12 text-right">
            <div class="alert alert-danger text-right" style="margin-bottom:10px; text-align:end;">
                <strong>NÚMERO TOTAL DE PARTICIPANTES:</strong>
                <span id="lbl_total_personal_tienda_backend"><?= number_format($totalParticipantes) ?></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive table-axalta">
                <table class="table table-bordered" id="tb_reporte_personal_tienda">
                    <thead>
                        <?php if ($esCallCenter): ?>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>EMAIL</th>
                                <th>PERFIL</th>
                                <th>CELULAR</th>
                                <th>DISTRIBUIDORAS</th>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>EMAIL</th>
                                <th>PERFIL</th>
                                <th>CELULAR</th>
                                <th>ID DISTRIBUIDOR</th>
                                <th>DISTRIBUIDOR CÓDIGO</th>
                                <th>DISTRIBUIDOR RAZÃO SOCIAL</th>
                                <th>DISTRIBUIDOR NOME COMERCIAL</th>
                                <th>ID EXECUTIVO</th>
                                <th>EXECUTIVO</th>
                            </tr>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php foreach ($tabla as $r): ?>
                            <?php if ($esCallCenter): ?>
                                <tr>
                                    <td><?= rpersonal_tienda_out($r->UsuarioId) ?></td>
                                    <td><?= rpersonal_tienda_out($r->Nombre) ?></td>
                                    <td><?= rpersonal_tienda_out($r->Email) ?></td>
                                    <td><?= rpersonal_tienda_out($r->PerfilDescripcion) ?></td>
                                    <td><?= rpersonal_tienda_out($r->Celular) ?></td>
                                    <td><?= rpersonal_tienda_out($r->Distribuidoras) ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td><?= rpersonal_tienda_out($r->UsuarioId) ?></td>
                                    <td><?= rpersonal_tienda_out($r->Nombre) ?></td>
                                    <td><?= rpersonal_tienda_out($r->Email) ?></td>
                                    <td><?= rpersonal_tienda_out($r->PerfilDescripcion) ?></td>
                                    <td><?= rpersonal_tienda_out($r->Celular) ?></td>
                                    <td><?= rpersonal_tienda_out($r->DistribuidorId) ?></td>
                                    <td><?= rpersonal_tienda_out($r->DistribuidorDetalleCodigo) ?></td>
                                    <td><?= rpersonal_tienda_out($r->DistribuidorDetalleRazonSocial) ?></td>
                                    <td><?= rpersonal_tienda_out($r->DistribuidorDetalleNombreComercial) ?></td>
                                    <td><?= rpersonal_tienda_out($r->EjecutivoId) ?></td>
                                    <td><?= rpersonal_tienda_out($r->Ejecutivo) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        var esCallCenter = <?= $esCallCenter ? 'true' : 'false' ?>;
        var rangoExcel = esCallCenter ? 'A:F' : 'A:K';

        $('#tb_reporte_personal_tienda').DataTable({
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "<?= $this->lang->line('data_table_js_lang_combo_todos') ?>"]
            ],
            stateSave: false,
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
                filename: esCallCenter ? 'Reporte_Personal_Tienda_CallCenter' : 'Reporte_Personal_Tienda',
                sheetName: esCallCenter ? 'Personal_Tienda_CC' : 'Personal_Tienda',
                exportOptions: {
                    columns: ':not(.noExport)',
                    format: {
                        body: function(data, row, column, node) {
                            var texto = $('<div>').html(data).text();
                            return (texto === '' || texto === null || texto === undefined) ? ' ' : texto;
                        }
                    }
                },
                excelStyles: [{
                    cells: "1",
                    style: {
                        font: {
                            name: "Calibri",
                            size: "12",
                            color: "FFFFFF",
                            b: true
                        },
                        fill: {
                            pattern: {
                                color: "C82127"
                            }
                        }
                    }
                }, {
                    cells: rangoExcel,
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
            initComplete: function() {
                $('#loader_panel').hide();
            }
        });

        $('.dataTables_length').addClass('bs-select');
    });
</script>