<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 ABRIL 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="row">
    <?php if ($total_auditorias_rechazadas > 0) { ?>
        <div>
            <p style="text-align: right;">
                <img src="<?= funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/iconos/email.png") ?>" width="30"> &nbsp;
                <button id="ventas_auditoria_envio_correos_tabla_view_btn_envio" class="btn btn-dark btn-sm" style="color: #FFFFFF">ENVIAR E-MAILS</button>
            </p>
        </div>
    <?php } ?>
</div>
    <div class="panel-white">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table-axalta">
                    <table class="table table-bordered" id="TbVentasAuditoria">
                        <thead>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ventano')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ventaid')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_pintor')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_numero_ticket')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_monto_ticket')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_fecha_registro')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_distribuidor')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ticket')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_motivo')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_estatus_auditoria')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_observaciones')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_fecha_auditoria')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_fecha_envio_correo')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_fecha_limite_correo')?></th>
                            <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_tabla_accion')?></th>
                        </thead>
                        <tbody>
                            <?=$tabla?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready( function () {
    $("#ventas_auditoria_envio_correos_tabla_view_btn_envio").click(function(){ ventas_auditoria_envio_correos_tabla_view_js_envios_correos(); });
    $('#TbVentasAuditoria').DataTable( {
            "scrollX": 3500,
            "scrollY": 350,     
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
        buttons: [
        {
            extend: 'excelHtml5',
            exportOptions: {columns: [0,1,2,3,4,5,6,8,9,10,11]},
            text: '<?=$this->lang->line('data_table_js_lang_btn_descarga')?> <span class="iconify" data-icon="file-icons:microsoft-excel" style=font-size:20px;"></span>',
            className:'btn btn-axalta',
            title: 'AUDITORIA_REJEITADA',
            filename: 'AUDITORIA_REJEITADA',
            sheetName: 'AUDITORIA_REJEITADA',
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
        }
        ]        
    } );
    $('.dataTables_length').addClass('bs-select');
});
function ventas_auditoria_envio_correos_tabla_view_js_modal_ticket(id){
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_controller/ventas_auditoria_envio_correos_controller_ticket_modal',
        dataType: 'json',
        data: {id:id},
        success: function(data){
            $('#myModal').html(data).modal('show');
        },
        error: function(data){ },
        complete: function(){ $('#loader_panel').hide();}
    });
}
function ventas_auditoria_envio_correos_tabla_view_js_envios_correos(){
    var mes = $('#mes').val();
    var anio = $('#anio').val();
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_controller/ventas_auditoria_envio_correos_controller_envio_correos',
        dataType: 'json',
        data: {mes:mes,anio:anio},
        success: function(data){
            ventas_auditoria_envio_correos_form_tabla();
        },
        error: function(data){ },
        complete: function(){ }
    });
}
function ventas_auditoria_envio_correos_tabla_view_js_envio_correo(id){
    $('#loader_panel').show();
    $.ajax({
        type: 'POST',
        url: 'ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_controller/ventas_auditoria_envio_correos_controller_envio_correo',
        dataType: 'json',
        data: {id:id},
        success: function(data){
             ventas_auditoria_envio_correos_form_tabla();
        },
        error: function(data){ },
        complete: function(){ $('#loader_panel').hide();}
    });
}
function ventas_auditoria_envio_correos_form_tabla(){
        $('#loader_panel').show();        
        var mes = $('#mes').val();
        var anio = $('#anio').val();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_controller/ventas_auditoria_envio_correos_controller_tabla',
            dataType: 'json',
            data: {mes:mes,anio:anio},
            success: function(data){
                $('#tabla_auditoria_ventas').html(data);
                Swal.fire({icon: 'success',title: '',text: 'E-MAILS ENVIADOS'});
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
</script>
