<?php

defined('BASEPATH') or exit('No direct script access allowed');
?>
<hr class="separador">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive table-axalta">
            <table class="table table-bordered" id="TbReporteAuditoriaVentas">
                <thead>
                    <tr>
                       <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ventano') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ventaid') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_pintor') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_numero_ticket') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_monto_ticket') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_fecha_registro') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_distribuidor') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ticket') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_promocion') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_motivo') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_estatus_auditoria') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_observaciones') ?></th>
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
        $('#TbReporteAuditoriaVentas').DataTable({
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
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 9, 10, 11]
                },
                customizeData: function(data) {
                    for (var i = 0; i < data.body.length; i++) {
                        for (var j = 0; j < data.body[i].length; j++) {
                            if (data.body[i][j] === null || data.body[i][j] === '') {
                                data.body[i][j] = ' ';
                            }
                        }
                    }
                },
                text: '<?= $this->lang->line('data_table_js_lang_btn_descarga') ?> <span class="iconify" data-icon="file-icons:microsoft-excel" style="font-size:20px;"></span>',
                className: 'btn btn-axalta',
                title: 'RELATÓRIO DE AUDITORIA',
                filename: 'RELATÓRIO DE AUDITORIA',
                sheetName: 'RELATÓRIO DE AUDITORIA',
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
                        "cells": "2",
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
                        cells: "A:M:",
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

    function ventas_auditoria_primera_form_view_js_modal_ticket(id) {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_promociones/ventas_auditoria_promociones_controller/ventas_auditoria_promociones_controller_ticket_modal',
            dataType: 'json',
            data: {
                id: id
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

    function ventas_auditoria_primera_form_view_js_modal_promocion(id) {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_promociones/ventas_auditoria_promociones_controller/ventas_auditoria_promociones_controller_ticket_modal_promocion',
            dataType: 'json',
            data: {
                id: id
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