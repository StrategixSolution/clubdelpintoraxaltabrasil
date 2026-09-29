<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive table-axalta">
            <table class="table table-bordered" id="TbReporteMaestrosPintores">
                <thead>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_id')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_nombre')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_email')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_celular')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_ntarjeta')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_ciudad')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_talla')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_iddistribuidor')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_codigo')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_razon_social')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_nombre_comercial')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_cp')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_region')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_ejecutivo')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_fecha_registro')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_tabla_firma')?></th>
                    <th><?=$this->lang->line('reportes_maestro_pintores_controller_lang_identificacion')?></th>
                </thead>
                <tbody>
                    <?=$tabla?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
$(document).ready( function () {
    $('#TbReporteMaestrosPintores').DataTable( {
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
             }
    } );
    $('.dataTables_length').addClass('bs-select');
} ); 
 function reportes_maestros_pintores_js_modal_firma(archivo){
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_maestro_pintores/reportes_maestro_pintores_controller/reportes_maestro_pintores_controller_modal_firma',
            dataType: 'json',
            data: {archivo:archivo},
            success: function(data){
                $('#myModal').html(data).modal('show');
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide();}
        });
    } 
    function reportes_maestros_pintores_js_modal_identificacion(archivo){
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'reportes/reportes_maestro_pintores/reportes_maestro_pintores_controller/reportes_maestro_pintores_controller_modal_identificacion',
            dataType: 'json',
            data: {archivo:archivo},
            success: function(data){
                $('#myModal').html(data).modal('show');
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide();}
        });
    } 
</script>
