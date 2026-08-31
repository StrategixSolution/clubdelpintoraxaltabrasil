<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
    $(document).ready(function() {        
        $('#tabla_resultado').DataTable({
            //"scrollX": 1000,
            //"scrollY": 300, 
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"]],
            stateSave: true,
            "bDestroy": true,
            "language": {
                "lengthMenu": "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_lengthMenu')?>",
                "zeroRecords": "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_zeroRecords')?>",
                "info": "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_info')?>",
                "infoEmpty": "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_infoEmpty')?>",
                "infoFiltered": "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_infoFiltered')?>",
                "search": "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_search')?>",
                "paginate": {
                    "first":      "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_first')?>",
                    "last":       "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_last')?>",
                    "next":       "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_next')?>",
                    "previous":   "<?=$this->lang->line('ventas_promociones_cargas_tabla_js_previous')?>"
                }
            },
        dom: '<"row"<"col-xs-4 col-md-4"l><"col-xs-4 col-md-4 botones"B><"col-md-4"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
        buttons: [{
            extend: 'excelHtml5',           
            text: 'Baixar <span class="iconify" data-icon="file-icons:microsoft-excel" style=font-size:20px;"></span>',
            className:'btn btn-axalta',
            title: '',
            filename: 'Carga_promociones',
            sheetName: 'Carga_promociones',
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

<hr class="separador">
<table class="table table-bordered table-striped table-axalta" id="tabla_resultado">
    <thead>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_id_carga')?></th>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_nombre')?></th>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_titulo_gms')?></th>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_titulo_codigo')?></th>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_titulo_descripcion')?></th>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_titulo_presentacion')?></th>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_titulo_fecha_inicio')?></th>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_titulo_fecha_fin')?></th>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_estatus')?></th>
        <th><?=$this->lang->line('ventas_promociones_cargas_tabla_accion')?></th>
    </thead>
    <tbody>
        <?=$tabla?>
    </tbody>
</table>