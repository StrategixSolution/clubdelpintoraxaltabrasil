<?php
/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate  15 junio 2026 1:03:17 *  
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
    $(document).ready(function() {
        $('#Tabla_carga').DataTable( {
            paging: false,
            searching: false,
            stateSave: true,
            "bDestroy": true,             
            //"scrollX": true,
            //"scrollY": 300,    
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"]],
            "language": {
                "lengthMenu": "<?=$this->lang->line('carga_tabla_js_lengthMenu')?>",
                "zeroRecords": "<?=$this->lang->line('carga_tabla_js_zeroRecords')?>",
                "info": "<?=$this->lang->line('carga_tabla_js_info')?>",
                "infoEmpty": "<?=$this->lang->line('carga_tabla_js_infoEmpty')?>",
                "infoFiltered": "<?=$this->lang->line('carga_tabla_js_infoFiltered')?>",
                "search": "<?=$this->lang->line('carga_tabla_js_search')?>",
                "paginate": {
                    "first":      "<?=$this->lang->line('carga_tabla_js_first')?>",
                    "last":       "<?=$this->lang->line('carga_tabla_js_last')?>",
                    "next":       "<?=$this->lang->line('carga_tabla_js_next')?>",
                    "previous":   "<?=$this->lang->line('carga_tabla_js_previous')?>"
                }
            }
        });
    });
</script>
<div class="card">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-axalta" id="Tabla_carga">
                    <thead>
                        <th><?=$this->lang->line('recompensas_controller_tabla_id')?></th>
                        <th><?=$this->lang->line('recompensas_controller_tabla_anio')?></th>
                        <th><?=$this->lang->line('recompensas_controller_tabla_mes')?></th>
                        <th><?=$this->lang->line('recompensas_controller_tabla_lugar')?></th> 
                        <th><?=$this->lang->line('recompensas_controller_tabla_rango_ini')?></th>
                        <th><?=$this->lang->line('recompensas_controller_tabla_rango_fin')?></th>                                
                        <th><?=$this->lang->line('recompensas_controller_tabla_observaciones')?></th>                                
                    </thead>
                    <tbody>
                        <?=$tabla?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>