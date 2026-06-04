<hr class="separador">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive table-axalta">
            <table class="table table-bordered" id="TbReporteDistribuidores">
                <thead>
                    <th>ID</th>
                    <th>Codigo</th>
                    <th>Razao Social</th>
                    <th>Nome Comercial</th>
                    <th>Regiao</th>
                    <th>Cidade / UF</th>
                    <th>Segmento</th>
                    <th>Endereco</th>
                    <th>Bairro</th>
                    <th>Municipio</th>
                    <th>CEP</th>
                    <th>Tickets Registrados</th>
                    <th>Mestres Pintores Registrados</th>
                    <th>Valor dos Tickets</th>
                    <th>Executivo</th>
                </thead>
                <tbody>
                    <?php if (!empty($distribuidores)): ?>
                        <?php foreach ($distribuidores as $distribuidor): ?>
                            <?php
                                // Determinar segmento
                                $segmento = ($distribuidor->DistribuidorMatriz === NULL) ? 'Filial' : 'MATRIZ';
                                $razon_social = (string)($distribuidor->DistribuidorDetalleRazonSocial ?? '');
                                $nombre_comercial = (string)($distribuidor->DistribuidorDetalleNombreComercial ?? '');
                                $ciudad = (string)($distribuidor->DistribuidorDetalleCiudad ?? '');
                                $estado = (string)($distribuidor->DistribuidorDetalleEstado ?? '');
                                
                                // Formatear ejecutivos (convertir delimitador | a <br> y reemplazar guiones bajos por espacios)
                                $ejecutivos = $distribuidor->ejecutivos ?? '';
                                $ejecutivos = str_replace('_', ' ', $ejecutivos);
                                $ejecutivos = str_replace(' | ', '<br>', $ejecutivos);
                            ?>
                            <tr class="text-left">
                                <td><?= $distribuidor->DistribuidorId ?></td>
                                <td><?= utf8_encode($distribuidor->DistribuidorDetalleCodigo) ?></td>
                                <td><?= utf8_encode(ucwords(mb_strtolower($razon_social))) ?></td>
                                <td><?= utf8_encode(ucwords(mb_strtolower($nombre_comercial))) ?></td>
                                <td><?= utf8_encode($distribuidor->DistribuidorDetalleRegionNombre) ?></td>
                                <td><?= utf8_encode(ucwords(mb_strtolower($ciudad))) ?> / <?= utf8_encode(ucwords(mb_strtolower($estado))) ?></td>
                                <td><?= utf8_encode($segmento) ?></td>
                                <td><?= utf8_encode($distribuidor->DistribuidorDetalleCalle) ?></td>
                                <td><?= utf8_encode($distribuidor->DistribuidorDetalleColonia) ?></td>
                                <td><?= utf8_encode($distribuidor->DistribuidorDetalleMunicipio) ?></td>
                                <td><?= utf8_encode($distribuidor->DistribuidorDetalleCP) ?></td>
                                <td><?= $distribuidor->num_ventas ?></td>
                                <td><?= $distribuidor->total_maestros_pintores ?></td>
                                <td>$<?= number_format($distribuidor->total_ventas, 2) ?></td>
                                <td style="font-size: 8px;"><?php echo utf8_encode($ejecutivos); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="15" class="text-center">
                                <?= $this->lang->line('data_table_js_lang_zeroRecords') ?? 'Nenhum registro encontrado' ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#TbReporteDistribuidores').DataTable({
            "scrollX": 3500,
            "scrollY": 350,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "<?= $this->lang->line('data_table_js_lang_combo_todos') ?>"]
            ],
            "language": {
                "lengthMenu": "<?= $this->lang->line('data_table_js_lang_lengthMenu') ?>",
                "zeroRecords": "<?= $this->lang->line('data_table_js_lang_zeroRecords') ?>",
                "info": "<?= $this->lang->line('data_table_js_lang_info') ?>",
                "infoEmpty": "<?= $this->lang->line('data_table_js_lang_infoEmpty') ?>",
                "infoFiltered": "<?= $this->lang->line('data_table_js_lang_infoFiltered') ?>",
                "search": "<?= $this->lang->line('data_table_js_lang_search') ?>",
                "paginate": {
                    "first": "<?= $this->lang->line('data_table_js_lang_first') ?>",
                    "last": "<?= $this->lang->line('data_table_js_lang_last') ?>",
                    "next": "<?= $this->lang->line('data_table_js_lang_next') ?>",
                    "previous": "<?= $this->lang->line('data_table_js_lang_previous') ?>"
                }
            },
            dom: '<"row"<"col-xs-4 col-md-4"l><"col-xs-4 col-md-4 botones"B><"col-md-4"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
            buttons: [{
                extend: 'excelHtml5',
                text: '<?= $this->lang->line('data_table_js_lang_btn_descarga') ?> <span class="iconify" data-icon="file-icons:microsoft-excel" style=font-size:20px;"></span>',
                className: 'btn btn-axalta',
                title: '',
                filename: '<?= $this->lang->line('reportes_distribuidores_controller_lang_etiqueta_distribuidor') ?>',
                sheetName: '<?= $this->lang->line('reportes_distribuidores_controller_lang_etiqueta_distribuidor') ?>',
                excelStyles: [{
                        "cells": "1",
                        style: { // The style block
                            font: { // Style the font
                                name: "Calibri", // Font name
                                size: "12", // Font size
                                color: "FFFFFF", // Font Color
                                b: true // Remove bolding from header row
                            },
                            fill: { // Style the cell fill (background)
                                pattern: { // Type of fill (pattern or gradient)
                                    color: "C82127" // Fill color
                                }
                            }
                        }
                    },
                    {
                        cells: "A:Q:",
                        style: {
                            border: {
                                top: "thin", // Thin black border at top of cell/s
                                bottom: "thin",
                                left: "thin",
                                right: "thin"
                            }
                        }
                    }
                ]
            }]
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>