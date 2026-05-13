<?php

/*
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             *
 * @programmer  Luis Felipe Rangel                          *
 * @CreateDate 01 ABRIL 2026 09:00:00                       *
 */

defined('BASEPATH') OR exit('No direct script access allowed');


?>
<script>
    $(document).ready(function() {        
        $('#tabla_resultado').DataTable({
            "scrollX": 3000,
            "scrollY": 300, 
            "lengthMenu":[[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_all')?>"]],
            stateSave: true,
            "bDestroy": true,
            "language": {
                "lengthMenu": "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_lengthMenu')?>",
                "zeroRecords": "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_zeroRecords')?>",
                "info": "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_info')?>",
                "infoEmpty": "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_infoEmpty')?>",
                "infoFiltered": "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_infoFiltered')?>",
                "search": "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_search')?>",
                "paginate": {
                    "first":      "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_first')?>",
                    "last":       "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_last')?>",
                    "next":       "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_next')?>",
                    "previous":   "<?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_js_previous')?>"
                }
            }
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
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_id_venta')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_id_usuario')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_nombre_pintor')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_id_distribuidor')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_codigo')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_razon_social')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_nombre_comercial')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_numero_ticket')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_total_ticket')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_total_monto')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_total_cantidad')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_total_litros')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_promociones')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_mes')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_estatus')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_auditoria')?></th>
                        <th><?=$this->lang->line('Ventas_corte_bimestral_controller_tabla_titulo_fecha')?></th>
                    </thead>
                    <tbody>
                        <?=$tabla?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>