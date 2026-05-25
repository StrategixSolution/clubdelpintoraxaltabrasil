<hr class="separador">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive table-axalta">
            <table class="table table-bordered" id="TbReporteDistribuidores">
                <thead>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_id') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_codigo') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_razon_social') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_nombre_comercial') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_nombre_pais') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_nombre_segmento') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_region') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_calle') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_municipio') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_ciudad') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_estado') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_cp') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_ejecutivo') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_estatus') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_tickets_registrados') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_maestros_registrados') ?></th>
                    <th><?= $this->lang->line('reportes_distribuidores_controller_lang_tabla_monto_tickets') ?></th>
                    <?PHP if ($anio != 0 && $mes != 0) { ?>
                        <th><?= $this->lang->line('reportes_distribuidores_controller_lang_actividad') ?></th>
                    <?PHP } ?>
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