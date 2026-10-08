<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script>
    $(document).ready(function() {        
        $('#tabla_resultado').DataTable({
            "scrollX": 3000,
            "scrollY": 300,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=$this->lang->line('data_table_js_lang_combo_todos')?>"]],
            "language": {
                "lengthMenu": "<?=$this->lang->line('data_table_js_lang_lengthMenu')?>",
                "zeroRecords": "<?=$this->lang->line('data_table_js_lang_zeroRecords')?>",
                "info": "<?=$this->lang->line('data_table_js_lang_info')?>",
                "infoEmpty": "<?=$this->lang->line('data_table_js_lang_infoEmpty')?>",
                "infoFiltered": "<?=$this->lang->line('data_table_js_lang_infoFiltered')?>",
                "search": "<?=$this->lang->line('data_table_js_lang_search')?>",
                "paginate": {
                    "first":      "<?=$this->lang->line('data_table_js_lang_first')?>",
                    "last":       "<?=$this->lang->line('data_table_js_lang_last')?>",
                    "next":       "<?=$this->lang->line('data_table_js_lang_next')?>",
                    "previous":   "<?=$this->lang->line('data_table_js_lang_previous')?>"
                }
            },
        dom: '<"row"<"col-xs-4 col-md-4"l><"col-xs-4 col-md-4 botones"B><"col-md-4"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
        buttons: [{
            extend: 'excelHtml5',  
            customizeData: function(data) {
                    for (var i = 0; i < data.body.length; i++) {
                        for (var j = 0; j < data.body[i].length; j++) {
                            if (data.body[i][j] === null || data.body[i][j] === '') {
                                data.body[i][j] = ' ';
                            }
                        }
                    }
                },
            text: 'DESCARGA <span class="iconify" data-icon="file-icons:microsoft-excel" style=font-size:20px;"></span>',
            className:'btn btn-axalta',
            title: '',
            filename: 'MudançaDeStatus',
            sheetName: 'MudançaDeStatus',
            excelStyles: 
            [
                {
                    "cells": "1",
                    style: {                        // The style block
                        font: {                     // Style the font
                            name: "Calibri",          // Font name
                            size: "12",             // Font size
                            color: "FFFFFF",        // Font Color
                            b: true              // Remove bolding from header row
                        },
                        fill: {                     // Style the cell fill (background)
                            pattern: {              // Type of fill (pattern or gradient)
                                color: "C82127"    // Fill color
                            }
                        }
                    }
                },
                {
                    cells: "A:M:",
                    style: {
                        border: {
                            top: "thin",            // Thin black border at top of cell/s
                            bottom:"thin",
                            left:"thin",
                            right:"thin"
                        }
                    }
                }
            ]
        }]        
        });
        $('.dataTables_length').addClass('bs-select');
    }); 
</script>
<div class="panel-white">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-axalta" id="tabla_resultado">
                    <thead>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_nombre_pintor')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_codigo')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_distribudor')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_region')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_ciudad')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_ejecutivo')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_numero_ticket')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_total_ticket')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_total_monto')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_total_cantidad')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_total_litros')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_auditoria')?></th>
                        <th><?=$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_tabla_titulo_fecha')?></th>
                    </thead>
                    <tbody>
                        <?=$tabla?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>