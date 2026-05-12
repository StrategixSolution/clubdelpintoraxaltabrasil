<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala	* 
 * @author	Strategic Solutions S.A. de C.V                 * 
 * @programmer  Enrique Arce Rosas                              * 
 * @CreateDate 21 jul. 2022 20:17:09                            * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
    $(document).ready(function() {        
        $('#tabla_resultado').DataTable({
            "scrollX": 3000,
            "scrollY": 300,  
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"]],
            stateSave: true,
            "bDestroy": true,
            "language": {
                "lengthMenu": "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_lengthMenu')?>",
                "zeroRecords": "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_zeroRecords')?>",
                "info": "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_info')?>",
                "infoEmpty": "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_infoEmpty')?>",
                "infoFiltered": "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_infoFiltered')?>",
                "search": "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_search')?>",
                "paginate": {
                    "first":      "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_first')?>",
                    "last":       "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_last')?>",
                    "next":       "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_next')?>",
                    "previous":   "<?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_tabla_js_previous')?>"
                }
            },
//        dom: '<"row"<"col-xs-4 col-md-4"l><"col-xs-4 col-md-4 botones"B><"col-md-4"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
//        buttons: [{
//            extend: 'excelHtml5',
//            text: 'DESCARGAR <span class="iconify" data-icon="file-icons:microsoft-excel" style=font-size:20px;"></span>',
//            className:'btn btn-axalta',
//            title: '',
//            filename: 'ganadores',
//            sheetName: 'ganadores',
//            excelStyles: 
//            [
//                {
//                    "cells": "1",
//                    style: {                        // The style block
//                        font: {                     // Style the font
//                            name: "Calibri",          // Font name
//                            size: "12",             // Font size
//                            color: "FFFFFF",        // Font Color
//                            b: true              // Remove bolding from header row
//                        },
//                        fill: {                     // Style the cell fill (background)
//                            pattern: {              // Type of fill (pattern or gradient)
//                                color: "C82127"    // Fill color
//                            }
//                        }
//                    }
//                },
//                {
//                    cells: "A:M:",
//                    style: {
//                        border: {
//                            top: "thin",            // Thin black border at top of cell/s
//                            bottom:"thin",
//                            left:"thin",
//                            right:"thin"
//                        }
//                    }
//                }
//            ]
//        }]        
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
                        <th><?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_datatable_titulo_anio')?></th>
                        <th><?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_datatable_titulo_mes')?></th>
                        <th><?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_datatable_titulo_lugar')?></th>
                        <th><?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_datatable_titulo_suma')?></th>
                        <th><?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_datatable_titulo_cuenta')?></th>
                        <th><?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_datatable_titulo_tarjeta')?></th>
                        <th><?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_datatable_titulo_codigo')?></th>
                        <th><?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_datatable_titulo_distribuidor')?></th>
                        <th><?=$this->lang->line('productos_reposicion_corte_ganadores_contoller_datatable_titulo_maestro_pintor')?></th>
                    </thead>
                    <tbody>
                        <?=$tabla?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>