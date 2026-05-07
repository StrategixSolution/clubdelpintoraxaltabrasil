<?php

/*
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             *
 * @programmer  Luis Felipe Rangel                          *
 * @CreateDate 01 ABRIL 2026 09:00:00 
 */

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
            text: 'DESCARGAR <span class="iconify" data-icon="file-icons:microsoft-excel" style=font-size:20px;"></span>',
            className:'btn btn-axalta',
            title: '',
            filename: 'CorteGanadores',
            sheetName: 'CorteGanadores',
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
                        <th><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_datatable_titulo_anio')?></th>
                        <th><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_datatable_titulo_mes')?></th>
                        <th><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_datatable_titulo_lugar')?></th>
                        <th><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_datatable_titulo_suma')?></th>
                        <th><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_datatable_titulo_cuenta')?></th>
                        <th><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_datatable_titulo_tarjeta')?></th>
                        <th><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_datatable_titulo_codigo')?></th>
                        <th><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_datatable_titulo_distribuidor')?></th>
                        <th><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_datatable_titulo_maestro_pintor')?></th>
                    </thead>
                    <tbody>
                        <?=$tabla?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>