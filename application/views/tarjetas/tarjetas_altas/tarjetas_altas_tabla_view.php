<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>
<hr class="separador mt-5">

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive table-axalta">
            <input type="hidden" id="txt_estatus" class="form-control" name="txt_estatus" value="<?= $estatus ?>">
            <table class="table table-bordered" id="TbAltatarjetas">
                <thead>
                    <th><?= $this->lang->line('tarjetas_altas_controller_lang_tabla_idtarjeta') ?></th>
                    <th><?= $this->lang->line('tarjetas_altas_controller_lang_tabla_ntarjeta') ?></th>
                    <th><?= $this->lang->line('tarjetas_altas_controller_lang_tabla_id') ?></th>
                    <th><?= $this->lang->line('tarjetas_altas_controller_lang_tabla_razon_social') ?></th>
                    <th><?= $this->lang->line('tarjetas_altas_controller_lang_tabla_id_maestro_pintor') ?></th>
                    <th><?= $this->lang->line('tarjetas_altas_controller_lang_tabla_maestro_pintor') ?></th>
                    <th><?= $this->lang->line('tarjetas_altas_controller_lang_tabla_fecha_registro') ?></th>
                    <th><?= $this->lang->line('tarjetas_altas_controller_lang_tabla_estatus_tarjeta') ?></th>
                    <th><?= $this->lang->line('tarjetas_altas_controller_lang_tabla_estatus_accion') ?></th>
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
        var estatusval = $('#txt_estatus').val();
        if (estatusval == 0) {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: '<?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_rango_registrados') ?>',
            });
        } else {
            Swal.fire({
                title: '',
                html: '<?= $this->lang->line('tarjetas_altas_controller_lang_etiqueta_rango_registrados_success') ?>',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#fd7e14',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'OK',
                cancelButtonText: ''
            });
        };

        $('#TbAltatarjetas').DataTable({
            "scrollX": 3500,
            "scrollY": 250,
            "lengthMenu": [
                [-1, 10, 25, 50, 100],
                ["<?= $this->lang->line('data_table_js_lang_combo_todos') ?>", 10, 25, 50, 100]
            ],
            "language": {
                "lengthMenu": "<?= $this->lang->line('data_table_js_lang_lengthMenu') ?>",
                "zeroRecords": "<?= $this->lang->line('data_table_js_lang_zeroRecords') ?>",
                "info": "<?= $this->lang->line('tarjetas_altas_controller_lang_tabla_js_info') ?>",
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
            dom: '<"row"<"col-xs-4 col-md-4"l><"col-xs-4 col-md-4 botones txt-right"B><"col-md-4"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
            buttons: [{
                extend: 'excelHtml5',
                text: '<?= $this->lang->line('data_table_js_lang_btn_descarga') ?> <span class="iconify" data-icon="file-icons:microsoft-excel" style=font-size:20px;"></span>',
                className: 'btn btn-axalta',
                title: '',
                filename: '<?= $this->lang->line('tarjetas_altas_controller_lang_pagina_titulo') ?>',
                sheetName: '<?= $this->lang->line('tarjetas_altas_controller_lang_pagina_titulo') ?>',
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
                        cells: "A:I:",
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