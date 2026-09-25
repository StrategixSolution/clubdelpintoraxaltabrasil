<script>
    $(document).ready(function() {
        $('#TablaParticipantes').DataTable({
            "scrollX": 3000,
            "scrollY": 300,
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
                filename: '<?= $this->lang->line('reportes_usuarios_participantes_controller_lang_pagina_titulo') ?>',
                sheetName: '<?= $this->lang->line('reportes_usuarios_participantes_controller_lang_pagina_titulo') ?>',
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
                        cells: "A:O:",
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
    });
</script>
<hr class="separador">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-axalta" id="TablaParticipantes">
                <thead>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_id_distribuidor') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_codigo') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_distribuidora') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_nomcomercial') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_rfc') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_estatal') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_id_usuario') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_nombre') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_rfc_pax') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_email') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_celular') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_perfil') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_fecha_registro') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_estatus') ?></th>
                    <th><?= $this->lang->line('reportes_usuarios_participantes_controller_lang_tabla_titulo_estatus_distribuidor') ?></th>
                </thead>
                <tbody>
                    <?= $tabla ?>
                </tbody>
            </table>
        </div>
    </div>
</div>