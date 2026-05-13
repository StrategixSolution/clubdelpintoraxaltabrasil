<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 May 2026 09:00:00                         * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="auditoria_ventas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?=$this->lang->line('ventas_promociones_cargas_controller_titulo')?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="panel-white" id="div_carga">
                <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for=""><?=$this->lang->line('ventas_promociones_cargas_controller_texto_xls_carga_productos')?></label><br>
                                <a href="<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/archivos/excel/ventas_promociones_cargas/ventas_promociones_cargas.xlsx") ?>">
                                    <button type="button" class="btn btn-axalta">
                                        <i class="fas fa-download"></i> <?=$this->lang->line('ventas_promociones_cargas_link_excel_carga_productos')?>
                                    </button>
                                </a>
                            </div>
                        </div>
                </div>
                <form action="ventas/ventas_promociones/ventas_promociones_cargas/ventas_promociones_cargas_controller/ventas_promociones_cargas_controller_guarda_promocion" id="frm_ventas_promociones_cargas_controller" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="row">
                        <div class="col-lg-4"> 
                            <div class="form-group">
                                <label for="txt_promocion"><?=$this->lang->line('ventas_promociones_cargas_etiqueta_promocion')?><span data-toggle='tooltip' title='<?=$this->lang->line('ventas_promociones_cargas_tooltip_promocion')?>'><i class="fas fa-question-circle"></i></span></label>
                                <input type="text" name="txt_promocion" id="txt_promocion" class="form-control txt-mayus" placeholder="<?=$this->lang->line('ventas_promociones_cargas_placeholder_promocion')?>" onKeyPress="return js_general_solo_alfanumerico(event,this)" maxlength="100">
                                <div id="error"></div>
                            </div>
                        </div>        
                        <div class="col-lg-3"> 
                            <div class="form-group">
                                <label for="fechas"><?=$this->lang->line('ventas_promociones_cargas_etiqueta_rango_fechas')?><span data-toggle='tooltip' title='<?=$this->lang->line('ventas_promociones_cargas_tooltip_rango_fechas')?>'><i class="fas fa-question-circle"></i></span></label>
                                <input type="text" id="fechas" class="form-control" name="fechas" placeholder="<?=$this->lang->line('ventas_promociones_cargas_placeholder_rango_fechas')?>">
                                <div id="error"></div>
                            </div>
                        </div>                        
                        <div class="col-lg-3">                
                            <div id="uploadsFiles" class="form-group">
                                <label for="ventas_promociones_cargas_controller_carga_file_excel" class="label"><?=$this->lang->line('ventas_promociones_cargas_etiqueta_archivo')?><span data-toggle='tooltip' title='<?=$this->lang->line('ventas_promociones_cargas_tooltip_archivo')?>'><i class="fas fa-question-circle"></i></span></label>
                                <div class="input-group mb-3">
                                    <input type="file" name="ventas_promociones_cargas_controller_carga_file_excel" id="ventas_promociones_cargas_controller_carga_file_excel" class="form-control" placeholder="<?=$this->lang->line('ventas_promociones_cargas_placeholder_archivo')?>">                                        
                                </div>
                                <div id="error"></div>
                            </div>  
                        </div>
                        <div class="col-lg-2"> 
                            <div class="form-group" id="div_ventas_promociones_cargas_controller_btn_guardar" style="margin-top:20px;">
                                <button type="submit" class="btn btn-black-sm" id="ventas_promociones_cargas_controller_guardar"><?=$this->lang->line('ventas_promociones_cargas_btn_guardar')?></button>
                            </div>
                            <div class="form-group"  style="display: none; margin-top:20px;" id="div_ventas_promociones_cargas_controller_btn_refrescar">
                                <button type="submit" class="btn btn-black-sm" onClick="window.location.reload();"><?=$this->lang->line('ventas_promociones_cargas_btn_refrescar')?></button>
                            </div>                            
                        </div>                          
                    </div>  
                </form>
            </div>
            <br>
            <div class="panel-white" id="div_carga_tabla">
                <div class="table-responsive">
                    <div id="tabla_cargas"></div>     
                </div>
            </div>
        </div>    
    </div>
</section>
<script>
    var fecha_inicio;
    var fecha_fin;    
    $(document).ready(function(){
        $('#fechas').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Cancelar', applyLabel: 'Aplicar' } });
        $('#fechas').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            fecha_inicio = picker.startDate.format('YYYY-MM-DD');
            fecha_fin = picker.endDate.format('YYYY-MM-DD');
        });
        $('#fechas').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            fecha_inicio = '';
            fecha_fin = '';
        });        
        $("#frm_ventas_promociones_cargas_controller").submit(function(event){ event.preventDefault(); });
        js_general_valida_uploads_archivos('ventas_promociones_cargas_controller_carga_file_excel',['xlsx'],'<?=$this->lang->line('ventas_promociones_cargas_js_msg_archivo_tamanio')?>','<?=$this->lang->line('ventas_promociones_cargas_js_msg_archivo_extenciones')?>');
        $("#ventas_promociones_cargas_controller_guardar").click(function() { ventas_promociones_cargas_controller_excel(); });    
        /********************************************MSG ERROR******************************************************************************************/
        $('#frm_ventas_promociones_cargas_controller input').on('keyup', function ()  { js_general_limpiar_errores(this); });
        $('#frm_ventas_promociones_cargas_controller input').on('click', function ()  { js_general_limpiar_errores(this); });
        $('#frm_ventas_promociones_cargas_controller select').on('click', function () { js_general_limpiar_errores(this); });  
        $('#frm_ventas_promociones_cargas_controller input').on('change', function () { js_general_limpiar_errores(this); });
        /**************************************************************************************************************************************/            
    });
    function ventas_promociones_cargas_controller_excel(){
        $("#tabla_cargas").html('');
        $("#ventas_promociones_cargas_controller_guardar").attr('disabled',true);
        var formData = new FormData($("#frm_ventas_promociones_cargas_controller")[0]);
        var ventas_promociones_cargas_controller_carga_file_excel  = $('#ventas_promociones_cargas_controller_carga_file_excel').val();
        if (ventas_promociones_cargas_controller_carga_file_excel!=""){
            $('#loader_panel').show();
            $.ajax({
                type: $('#frm_ventas_promociones_cargas_controller').attr('method'),
                url: $('#frm_ventas_promociones_cargas_controller').attr('action'),
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData:false,
                success: function(data){
//                    console.log('entro success');
//                    console.log(data);
                    switch(data.resultados){
                        case 0: 
                            Swal.fire({ icon: 'error',title: '',text: data.msg}); $("#ventas_promociones_cargas_controller_guardar").attr('disabled',false); 
                            $("#ventas_promociones_cargas_controller_guardar").attr('disabled',false);
                            break;
                        case 1: 
                            $("#ventas_promociones_cargas_controller_guardar").attr('disabled',false);
                             $("#div_ventas_promociones_cargas_controller_btn_guardar").hide();
                              $("#div_ventas_promociones_cargas_controller_btn_refrescar").show();
                            break;
                        default:
                            $("#ventas_promociones_cargas_controller_guardar").attr('disabled',false);
                            $.each(data, function(key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key).parents('.form-group').find('#error').html(value);
                            });     
                            $("#ventas_promociones_cargas_controller_guardar").attr('disabled',false);
                            break;
                    }
                    $('#tabla_cargas').html(data.tabla);
                    $("#ventas_promociones_cargas_controller_guardar").attr('disabled',false);
                },
                error: function(data){
//                    console.log('entro error');
//                    console.log(data);
                    $("#ventas_promociones_cargas_controller_guardar").attr('disabled',false);
                },
                complete: function(){
                    $('#loader_panel').hide();
                }
            });
        } else {
            $("#ventas_promociones_cargas_controller_guardar").attr('disabled',false);
            Swal.fire({ icon: 'error', allowOutsideClick:false, text: "<?=$this->lang->line('ventas_promociones_cargas_js_msg_archivo')?>"});
        }
    }
    'use strict';
    ;(function(document,window,index){
        var inputs = document.querySelectorAll( '.inputfile' );
        Array.prototype.forEach.call( inputs, function( input )
        {
            var label	 = input.nextElementSibling,
            labelVal = label.innerHTML;
            input.addEventListener( 'change', function( e ){
                var fileName = '';
                if( this.files && this.files.length > 1 ){
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                } else {
                    fileName = e.target.value.split( '\\' ).pop();
                }
                if( fileName ){
                    label.querySelector( 'span' ).innerHTML = fileName;
                } else {
                    label.innerHTML = labelVal;
                }
            });
        });
    }( document, window, 0 ));

</script>