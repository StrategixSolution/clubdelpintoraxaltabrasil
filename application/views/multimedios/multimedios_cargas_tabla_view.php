<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                         * 
 * @CreateDate 01 May. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script>
    $(document).ready(function() {        
        $('#tabla_resultado').DataTable({
            "scrollX": 3000,
            "scrollY": 300,  
            stateSave: true,
            "bDestroy": true,
            "lengthMenu":[[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_all')?>"]],
            "language": {
                "lengthMenu": "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_lengthMenu')?>",
                "zeroRecords": "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_zeroRecords')?>",
                "info": "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_info')?>",
                "infoEmpty": "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_infoEmpty')?>",
                "infoFiltered": "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_infoFiltered')?>",
                "search": "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_search')?>",
                "paginate": {
                    "first":      "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_first')?>",
                    "last":       "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_last')?>",
                    "next":       "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_next')?>",
                    "previous":   "<?=$this->lang->line('multimedios_cargas_controller_lang_tabla_js_previous')?>"
                }
            }
        });
        $('.dataTables_length').addClass('bs-select');
    });   
    function multimedios_cargas_tabla_view_js_modal_imagen(archivo,CargaMultimediaTipoId){
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'multimedios/multimedios_cargas_controller/multimedios_cargas_controller_modal_imagen',
            dataType: 'json',
            data: {archivo:archivo,CargaMultimediaTipoId:CargaMultimediaTipoId},
            success: function(data){
                $('#myModal').html(data).modal('show');
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide();}
        });
    } 
</script>
    <hr class="separador">  
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-axalta" id="tabla_resultado">
                    <thead>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_id')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_perfil')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_fecha_i')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_fecha_f')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_descarga')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_ver')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_thumbnail')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_texto')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_fecha')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_tipo')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_modulo')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_tipo_video')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_estatus')?></th>
                        <th><?=$this->lang->line('multimedios_cargas_controller_lang_tabla_titulo_baja')?></th>   
                    </thead>
                    <tbody>
                        <?=$tabla?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
