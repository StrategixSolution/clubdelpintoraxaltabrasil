<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="ventas_registradas_tabla">
    <div class="panel-white">
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
                                        <th>NOMBRE PINTOR</th>
                                    <?php } ?>

                                    <th>EVENTO</th>
                                    <th>ID DISTRIBUIDORA</th>
                                    <th>CÓDIGO</th>
                                    <th>RAZÓN SOCIAL</th>
                                    <th>NOMBRE COMERCIAL</th>
                                    <th>TIPO DISTRIBUIDORA</th>
                                    <th>REGIÓN</th>
                                    <th>CATEGORÍA</th>
                                    <th>EJECUTIVO</th>
                                    <th>CIUDAD / ESTADO</th>
                                    <th>NÚM. TICKET</th>
                                    <th>TOTAL TICKET</th>
                                    <th>FECHA DE REGISTRO</th>

                                    <?php if (empty($ocultarVentaCompletada)) { ?>
                                        <th>VENTA COMPLETADA</th>
                                    <?php } ?>

                                    <th>AUDITORÍA</th>

                                    <?php if (empty($ocultarPintorTicketObs)) { ?>
                                        <th>TICKET</th>
                                      <!--  <th>EDITAR</th> -->
                                        <th>OBSERVACIONES</th>
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
    </div>
</section>

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
    $columnasExport = array_values(array_filter($columnasExport, function($col) use ($indiceTicket) {
        return $col !== $indiceTicket;
    }));
}
?>

        $('#tabla_ventas_registradas').DataTable({
            "scrollX": 2500,
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
        columns: <?= json_encode($columnasExport) ?>
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