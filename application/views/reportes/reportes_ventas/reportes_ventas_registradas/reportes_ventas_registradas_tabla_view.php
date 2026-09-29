<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- <section class="ventas_registradas_tabla"> -->
<!-- <div class="panel-white">
    </div> -->
<!-- </section> -->
<hr class="separador">
<div class="row mb-10 text-right">
    <div class="col-lg-12 text-right">
        <div class="alert alert-danger text-right" style="margin-bottom:10px; text-align: end;">
            <strong>Total de ventas:</strong>
            <span id="lbl_total_ventas_backend"><?= isset($total) ? (int)$total : 0 ?></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive table-axalta">
            <table class="table table-bordered" id="tabla_ventas_registradas">
                <thead>
                    <tr>
                        <th>ID</th>

                        <?php if (empty($ocultarPintorTicketObs)) { ?>
                            <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_nombre_mp') ?></th>
                        <?php } ?>

                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_evento') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_id_dist') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_codigo') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_razon_social') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_nomnbre_comercial') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_region') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_ejecutivo') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_ciudad_edo') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_num_ticket') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_tot_ticket') ?></th>
                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_fecha_reg') ?></th>

                        <?php if (empty($ocultarVentaCompletada)) { ?>
                            <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_venta_comp') ?></th>
                        <?php } ?>

                        <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_auditoria') ?></th>

                        <?php if (empty($ocultarPintorTicketObs)) { ?>
                            <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_ticket') ?></th>
                            <th><?= $this->lang->line('reportes_ventas_registradas_controller_lang_tabla_observacion') ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?= $tabla ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        <?php
        $totalColumnas = 1;

        if (empty($ocultarPintorTicketObs)) {
            $totalColumnas++;
        }

        $totalColumnas += 13;

        if (empty($ocultarVentaCompletada)) {
            $totalColumnas++;
        }

        $totalColumnas += 1;

        if (empty($ocultarPintorTicketObs)) {
            $totalColumnas += 2; // TICKET + OBSERVACIONES (EDITAR está comentada en el HTML)
        }

        $columnasExport = range(0, $totalColumnas - 1);

        if (empty($ocultarPintorTicketObs)) {
            // Excluir columna TICKET visual del Excel.
            // Es la antepenúltima columna cuando sí existe Ticket / Editar / Observaciones.
            $indiceTicket = $totalColumnas - 2; // TICKET es la antepenúltima (TICKET, OBSERVACIONES)
            $columnasExport = array_values(array_filter($columnasExport, function ($col) use ($indiceTicket) {
                return $col !== $indiceTicket;
            }));
        }
        ?>

        $('#tabla_ventas_registradas').DataTable({
            "scrollX": 3500,
            "scrollY": 350,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "<?= $this->lang->line('data_table_js_lang_combo_todos') ?>"]
            ],
            stateSave: true,
            "bDestroy": true,
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
                exportOptions: {
                    // Exporta todas las columnas excepto TICKET (índice 16)
                    columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 13]
                },
                customizeData: function(data) {
                    // Cambiar encabezado ID por ID VENTA en el Excel
                    if (data.header && data.header.length > 0) {
                        data.header[0] = 'ID VENTA';
                    }

                    for (var i = 0; i < data.body.length; i++) {
                        for (var j = 0; j < data.body[i].length; j++) {
                            if (data.body[i][j] === null || data.body[i][j] === "") {
                                data.body[i][j] = " ";
                            }
                        }
                    }
                },
                text: '<?= $this->lang->line('data_table_js_lang_btn_descarga') ?> <span class="iconify" data-icon="file-icons:microsoft-excel" style="font-size:20px;"></span>',
                className: 'btn btn-axalta',
                title: '',
                filename: 'Reporte_Ventas_Registradas',
                sheetName: 'Ventas_Registradas',
                excelStyles: [{
                        "cells": "1",
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
                    },
                    {
                        cells: "A:S",
                        style: {
                            border: {
                                top: "thin",
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