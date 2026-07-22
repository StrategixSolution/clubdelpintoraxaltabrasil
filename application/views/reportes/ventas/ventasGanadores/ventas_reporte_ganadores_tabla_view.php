<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="ganadores_tabla_view">
    <div class="panel-white">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table-axalta">
                    <table class="table table-bordered" id="ganadores_tabla_view">
                        <thead>
                            <th>ID MESTRE PINTOR</th>
                            <th>MESTRE PINTOR</th>
                            <th>ID DO DISTRIBUIDOR</th>
                            <th>CÓDIGO</th>
                            <th>NOME COMERCIAL</th>
                            <th>TIPO DISTRIBUIDORA</th>
                            <th>EXECUTIVO</th>
                            <th>CIUDAD / ESTADO</th>
                            <th>LUGAR</th>
                            <th>DESCRIÇÃO PRÊMIO</th>
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
        $('#ganadores_tabla_view').DataTable({
            "scrollX": 2500,
            "scrollY": 300,
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
                text: '<?= $this->lang->line('data_table_js_lang_btn_descarga') ?> <span class="iconify" data-icon="file-icons:microsoft-excel" style="font-size:20px;"></span>',
                className: 'btn btn-axalta',
                title: '',
                filename: 'Reporte_Ganadores',
                sheetName: 'Reporte_Ganadores',
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
                        cells: "A:J",
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