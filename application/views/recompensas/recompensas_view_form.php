<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<form id="frm_recompensas_view_form"  role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <section id="Recompensas">
        <div class="panel-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><?=$this->lang->line('recompensas_controller_titulo')?></h2>
                    </div>
                </div>
            </div>
        </div> 
        <div class="container">
            <div class="panel-white">
                <div class="row justify-content-center row-validator">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="txt-center"><b><?=$this->lang->line('recompensas_controller_texto_seleccion')?></b></div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="center-elements">
                                <div class="col-lg-2 col-6 txt-center">
                                    <div class="form-check">
                                        <label for="chk_simple" class="form-check-label"> 
                                            <?=$this->lang->line('recompensas_controller_etiqueta_simple')?>
                                            <input type="checkbox" id="chk_simple" name="chk_simple" class="form-check-input"> <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-6 txt-center">
                                    <div class="form-check">
                                        <label for="chk_multi" class="form-check-label"> 
                                            <?=$this->lang->line('recompensas_controller_etiqueta_multiple')?>
                                            <input type="checkbox" id="chk_multi" name="chk_multi" class="form-check-input"> <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div id="div_simple">
                            <div class="row row-validator justify-content-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="cmb_anio"><?=$this->lang->line('recompensas_controller_etiqueta_ano')?></label>
                                        <select id="cmb_anio" name="cmb_anio" class="form-select"></select>
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="cmb_mes"><?=$this->lang->line('recompensas_controller_etiqueta_mes')?></label>
                                        <select id="cmb_mes" name="cmb_mes" class="form-select"></select>
                                        <div id="error"></div>
                                    </div>
                                </div>           
                            </div>   
                            <div class="row row-validator justify-content-center">
                                <div class="col-lg-1 col-1" style="width:20px;">
                                    <div class="form-group">
                                        <label for="cmb_lugar">1°</label>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_inicial_1"><?=$this->lang->line('recompensas_controller_etiqueta_rango_ini')?></label>
                                        <input type="text" name="txt_rango_inicial_1" id="txt_rango_inicial_1" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_ini')?>" onKeyPress="return js_general_solo_numeros(event)" >
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_final_1"><?=$this->lang->line('recompensas_controller_etiqueta_rango_fin')?></label>
                                        <input type="text" name="txt_rango_final_1" id="txt_rango_final_1" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_fin')?>" value="999999" disabled >
                                        <div id="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-validator justify-content-center">
                                <div class="col-lg-1 col-1" style="width:20px;">
                                    <div class="form-group">
                                        <label for="cmb_lugar">2°</label>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_inicial_2"><?=$this->lang->line('recompensas_controller_etiqueta_rango_ini')?></label>
                                        <input type="text" name="txt_rango_inicial_2" id="txt_rango_inicial_2" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_ini')?>" onKeyPress="return js_general_solo_numeros(event)" >
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_final_2"><?=$this->lang->line('recompensas_controller_etiqueta_rango_fin')?></label>
                                        <input type="text" name="txt_rango_final_2" id="txt_rango_final_2" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_fin')?>" onKeyPress="return js_general_solo_numeros(event)" >
                                        <div id="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-validator justify-content-center">
                                <div class="col-lg-1 col-1" style="width:20px;">
                                    <div class="form-group">
                                        <label for="cmb_lugar">3°</label>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_inicial_3"><?=$this->lang->line('recompensas_controller_etiqueta_rango_ini')?></label>
                                        <input type="text" name="txt_rango_inicial_3" id="txt_rango_inicial_3" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_ini')?>" onKeyPress="return js_general_solo_numeros(event)" >
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_final_3"><?=$this->lang->line('recompensas_controller_etiqueta_rango_fin')?></label>
                                        <input type="text" name="txt_rango_final_3" id="txt_rango_final_3" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_fin')?>" onKeyPress="return js_general_solo_numeros(event)" >
                                        <div id="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-validator justify-content-center">
                                <div class="col-lg-1 col-1" style="width:20px;">
                                    <div class="form-group">
                                        <label for="cmb_lugar">4°</label>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_inicial_4"><?=$this->lang->line('recompensas_controller_etiqueta_rango_ini')?></label>
                                        <input type="text" name="txt_rango_inicial_4" id="txt_rango_inicial_4" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_ini')?>" onKeyPress="return js_general_solo_numeros(event)" >
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_final_4"><?=$this->lang->line('recompensas_controller_etiqueta_rango_fin')?></label>
                                        <input type="text" name="txt_rango_final_4" id="txt_rango_final_4" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_fin')?>" onKeyPress="return js_general_solo_numeros(event)" >
                                        <div id="error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-validator justify-content-center">
                                <div class="col-lg-1 col-1" style="width:20px;">
                                    <div class="form-group">
                                        <label for="cmb_lugar">5°</label>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_inicial_5"><?=$this->lang->line('recompensas_controller_etiqueta_rango_ini')?></label>
                                        <input type="text" name="txt_rango_inicial_5" id="txt_rango_inicial_5" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_ini')?>" onKeyPress="return js_general_solo_numeros(event)" >
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="dyncol col-lg-5 col-5">
                                    <div class="form-group">
                                        <label for="txt_rango_final_5"><?=$this->lang->line('recompensas_controller_etiqueta_rango_fin')?></label>
                                        <input type="text" name="txt_rango_final_5" id="txt_rango_final_5" class="form-control" placeholder="<?=$this->lang->line('recompensas_controller_placeholder_rango_fin')?>" onKeyPress="return js_general_solo_numeros(event)" >
                                        <div id="error"></div>
                                    </div>
                                </div>
                                <div class="row justify-content-center" style="margin:20px 0px;">
                                    <div class="col-lg-2 col-12">
                                        <button type="submit" id="btn_Recompensas_Guardar_simple" class="btn btn-axalta btn-buscar-ancho"><i class="far fa-save"></i><span class="btn-buscar-texto">GUARDAR</span></button>
                                    </div>     
                                </div>    
                            </div>
                        </div>      
                        <div id="div_multiple" style="display: none;">
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">ARCHIVO LAYOUT</label><br>
                                        <a href="<?= base_url('application/views/template/sistema/archivos/excel/recompensas_carga/recompensas_carga.xlsx')?>">
                                            <button type="button" class="btn btn-axalta"><i class="fas fa-download"></i><span class="btn-buscar-texto"><?=$this->lang->line('recompensas_controller_etiqueta_ejemplo')?></span> </button>
                                        </a>
                                    </div>       
                                </div>       
                                <div class="col-lg-9" id="div_identificacion_file">
                                    <label for="productos_reposicion_carga_file_excel" class="label">SELECCIONA UN ARCHIVO<span class="tooltip-pl" data-toggle='tooltip' title='<?=$this->lang->line('ventas_registro_controller_msg_archivo')?>'><i class="fas fa-question-circle"></i></span></label>
                                    <div class="input-group mb-3">
                                        <input type="file" name="recompensas_view_form_file_excel" id="recompensas_view_form_file_excel" class="form-control" placeholder="<?=$this->lang->line('usuarios_registro_maestro_pintor_placeholder_identificacion')?>" >
                                        <button type="submit" id="btn_Recompensas_Guardar_multiple" class="btn btn-black-sm" style="border-radius:0px 5px 5px 0px;"><i class="far fa-save"></i><span class="btn-buscar-texto" >SUBIR</span></button>
                                        <div id="error"></div>
                                    </div>
                                </div>   
                            </div>   
                        <div id="tabla_carga"></div>
                    </div>              
                </div>
            </div>
        </div>
    </section>
</form>
        
   

<script>
    $(document).ready(function(){
        /********************************************MSG ERROR******************************************************************************************/
        $('#frm_recompensas_view_form input').on('keyup', function ()  { js_general_limpiar_errores(this); });
        $('#frm_recompensas_view_form input').on('click', function ()  { js_general_limpiar_errores(this); });
        $('#frm_recompensas_view_form select').on('click', function () { js_general_limpiar_errores(this); });  
        $('#frm_recompensas_view_form input').on('change', function () { js_general_limpiar_errores(this); });
        /**************************************************************************************************************************************/        
        recompensas_view_form_js_combo_anio();
        recompensas_view_form_js_combo_mes();
        $('#chk_simple').prop('checked',true);
        $('#chk_simple').val('1');     
        $("#frm_recompensas_view_form").submit(function(event){ event.preventDefault(); });
        $("#btn_Recompensas_Guardar_simple").click(function() {recompensas_js_carga_simple();});
        $("#btn_Recompensas_Guardar_multiple").click(function() {recompensas_js_carga_excel(); });
        js_general_valida_uploads_archivos('recompensas_view_form_file_excel',['xlsx'],'<?=$this->lang->line('recompensas_controller_js_msg_archivo_tamanio')?>','<?=$this->lang->line('recompensas_controller_js_msg_archivo_extenciones')?>');       
        $('#chk_simple').on('change', function(){
            if($('#chk_simple').prop('checked',true)){
                $('#chk_multi').prop('checked',false).removeAttr('checked').val('0');               
                $('#file_excel').val('');
                $('#div_simple').show();
                $('#div_multiple').hide();
                $('#chk_simple').val('1');
                $('#tabla_carga').empty(); 
            }
        });
        $('#chk_multi').on('change', function(){
            if($('#chk_multi').prop('checked',true)){
                $('#chk_simple').prop('checked',false).removeAttr('checked').val('0');                
                $('#txt_identificacion').val('');               
                $('#div_simple').hide();
                $('#div_multiple').show();
                $('#chk_multi').val('1');
            }
        });
    });
    function recompensas_view_form_js_combo_anio(){
        $.ajax({
            type: 'POST',
            url: 'recompensas/recompensas_controller/recompensas_controller_cmb_ano',
            dataType: 'json',
            data: {id:0},
            success: function(data){   
                $('#cmb_anio').empty(); 
                $('#cmb_anio').html(data);  
            },
            error: function(data){ },
            complete: function(){  }
        });
    }
    function recompensas_view_form_js_combo_mes(){   
        $.ajax({
            type: 'POST',
            url: 'recompensas/recompensas_controller/recompensas_controller_cmb_mes',
            dataType: 'json',
             data: {id:0},
            success: function(data){                 
                $('#cmb_mes').empty(); 
                $('#cmb_mes').html(data);  
            },
            error: function(data){ },
            complete: function(){  }
        });
    }
    function recompensas_js_carga_simple(){       
        $('#error').html(" ");
        $('#loader_panel').show();
        $('#txt_rango_final_1').prop('disabled',false);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("recompensas/recompensas_controller/recompensas_controller_form_validate") ?>", 
            data: $("#frm_recompensas_view_form").serialize(),
            dataType: "json",  
            success: function(data){
                switch(data.resultados){
                    case 0: Swal.fire({ icon: 'error', allowOutsideClick:false, text: data.msg}); break;
                    case 1: 
                        Swal.fire({
                            title: '',
                            html: "<?=$this->lang->line('recompensas_controller_msg_carga_exitosa')?>",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#008dab',
                            allowOutsideClick:false,
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'OK',
                            cancelButtonText: ''
                        }).then((validaestatus) => {
                            if (validaestatus.isConfirmed) {
                                var href = '$(location).attr("href","<?php echo funciones_strategix_version_url_random_base_url("Recompensas") ?>")';
                                setTimeout(href, 300);
                            }
                        });                                   
                        break;
                    default: 
                        $.each(data, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key).parents('.form-group').find('#error').html(value);
                        });                        
                        break;
                }
            },
            error: function(data){ console.log(data);},
            complete: function(){ $('#loader_panel').hide(); }              
        });        
         $('#txt_rango_final_1').prop('disabled',true);
    }
    function recompensas_js_carga_excel(){
        $("#tabla_carga").html('');
        var formData = new FormData($("#frm_recompensas_view_form")[0]);
        var recompensas_view_form_file_excel  = $('#recompensas_view_form_file_excel').val();
        if (recompensas_view_form_file_excel!=""){
            $('#loader_panel').show();
            $.ajax({
                type: $('#frm_recompensas_view_form').attr('method'),
                url: "recompensas/recompensas_controller/recompensas_controller_extraer_datos_excel",
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData:false,
                success: function(data){
                    if (data.resultados == 1){
                        console.log("tablaJS:"+data.tabla);
                        $('#tabla_carga').html(data.tabla);
                        Swal.fire({
                            title: '',
                            html: data.msg,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#008dab',
                            allowOutsideClick:false,
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'OK',
                            cancelButtonText: ''
                        }).then((validaestatus) => {
                            if (validaestatus.isConfirmed) {
                                
                            }
                        });                                                          
                    }else{
                        Swal.fire({ icon: 'error', allowOutsideClick:false, text: data.msg});
                    }
                    $('#tabla_carga').html(data.tabla);
                    $('#recompensas_view_form_file_excel').val("");
                },
                error: function(){
                    //alert("error");
                    //Code
                },
                complete: function(){
                    $('#loader_panel').hide();
                }
            });
        } else {
            Swal.fire({ icon: 'error', allowOutsideClick:false, text: "<?=$this->lang->line('recompensas_controller_mes_select_archivo')?>"});
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

