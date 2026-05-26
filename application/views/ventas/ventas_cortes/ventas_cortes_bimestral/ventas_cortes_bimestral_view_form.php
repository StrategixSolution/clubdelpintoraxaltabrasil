<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<section class="auditoria_ventas">
            <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?=$this->lang->line('ventas_cortes_bimestral_controller_lang_titulo')?></h2>
                </div>
            </div>
        </div>
    </div>    
<div class="container">
    <div class="row justify-content-center" style="margin:20px 0px;">
        <?=$sub_menu?>
    </div> 
    <div class="panel-white">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="cmb_anio"><?=$this->lang->line('ventas_cortes_bimestral_controller_lang_combo_anio')?></label>
                    <select name="cmb_anio" id="cmb_anio" class="form-select"></select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group" style="display: none;" id="div_mes">
                    <label for="cmb_periodo"><?=$this->lang->line('ventas_cortes_bimestral_controller_lang_combo_periodo')?></label>
                    <select name="cmb_periodo" id="cmb_periodo" class="form-select"></select>
                </div>
            </div>            
            <div class="col-lg-2">
                <div class="form-group">
                    <div id="div_btn_crear_corte" style="display: none;"><button type="button" id="ventas_cortes_bimestral_view_form_btn_crear" class="btn btn-axalta" style="margin-top: 1.68em;">CREAR CORTE</button></div>
                </div>
            </div>
            
            <div class="col-lg-2" id="div_excel" style="display:none">
                    <div class="btn-modulo" style="margin-top:20px;">
                        <button type="button"  class="btn btn-axalta" id="ventas_cortes_bimestral_view_form_btn_excel">DESCARGAR <i class="fas fa-download"></i></button>                                
                    </div>
                </div>
        </div> 
        <p>
    </div>
    <div id="ventas_cortes_bimestral_view_form_tabla"></div>
</div>
</section>
<script>
    $(document).ready( function () {        
        ventas_cortes_bimestral_view_form_js_anio();
        $("#ventas_cortes_bimestral_view_form_btn_crear").click(function(){ ventas_cortes_bimestral_view_form_js_crear_corte(); });
        $("#ventas_cortes_bimestral_view_form_btn_excel").click(function(){ ventas_cortes_bimestral_view_form_js_excel();});
        $('#cmb_anio').on('change', function(){
            $('#div_btn_crear_corte').hide();
            $('#div_btn_ver_corte').hide();
            $('#div_excel').hide();
            var anio = $('#cmb_anio').val();
            if (anio==0){
                $('#div_mes').hide(300);                 
            } else {
                ventas_cortes_bimestral_view_form_js_peroiodo();
                $('#div_mes').show(300); 
            }
        });
        $('#cmb_periodo').on('change', function(){
            $('#div_btn_crear_corte').hide();
            $('#div_btn_ver_corte').hide();
            $('#div_excel').hide();
            var anio = $('#cmb_anio').val();
            var mes = $('#cmb_periodo').val();
            if (mes==0){                
                $('#div_btn_crear_corte1').hide();
                $('#div_btn_ver_corte').hide();    
            } else {                                      
                $('#loader_panel').show();  
                $.ajax({
                    type: 'POST',
                    url: 'ventas/ventas_cortes/ventas_cortes_bimestral/ventas_cortes_bimestral_controller/ventas_cortes_bimestral_controller_valida_boton',
                    dataType: 'json',
                     data: {anio:anio,mes:mes},
                    success: function(data){                 
                        if(data==0){
                            $('#div_btn_crear_corte').show();
                            $('#div_excel').hide();                                 
                        } else {
                            $('#div_btn_crear_corte').hide();
                            $('#div_excel').show();     
                        }
                    },
                    error: function(data){ },
                    complete: function(){ $('#loader_panel').hide(); }
                });
            }
        });     
    });
    function ventas_cortes_bimestral_view_form_js_anio(){
        $('#loader_panel').show();  
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_bimestral/ventas_cortes_bimestral_controller/ventas_cortes_bimestral_controller_cmb_anios',
            dataType: 'json',
             data: {id:0},
            success: function(data){                 
                $('#cmb_anio').empty().html(data);     
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
    function ventas_cortes_bimestral_view_form_js_peroiodo(){
        $('#loader_panel').show();  
        var cmb_anio = $('#cmb_anio').val();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_bimestral/ventas_cortes_bimestral_controller/ventas_cortes_bimestral_controller_cmb_mes',
            dataType: 'json',
             data: {cmb_anio:cmb_anio},
            success: function(data){                 
                $('#cmb_periodo').empty().html(data);
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
    function ventas_cortes_bimestral_view_form_js_crear_corte(){  
        var anio = $('#cmb_anio').val();
        var mes = $('#cmb_periodo').val();
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_bimestral/ventas_cortes_bimestral_controller/ventas_cortes_bimestral_controller_creacion',
            dataType: 'json',
             data: {anio:anio,mes:mes},
            success: function(data){
                switch (data) {
                    case 1: Swal.fire({ icon: 'error',title: '',text: '<?=$this->lang->line('ventas_cortes_bimestral_controller_lang_js_msg_error_corte')?>'});break;                    
                    case 2: Swal.fire({ icon: 'error',title: '',text: '<?=$this->lang->line('ventas_cortes_bimestral_controller_lang_js_msg_error_cambio_estatus')?>'});break;
                    case 3: Swal.fire({ icon: 'error',title: '',text: '<?=$this->lang->line('ventas_cortes_bimestral_controller_lang_js_msg_error_auditoria')?>'});break;
                    case 4: Swal.fire({ icon: 'error',title: '',text: '<?=$this->lang->line('ventas_cortes_bimestral_controller_lang_js_msg_error_corte_ganadores')?>'});break;
                    default: 
                        $('#div_btn_crear_corte').hide();                 
                        $('#div_excel').show();  
                        $(location).attr('href','<?=funciones_strategix_version_url_random_base_url("uploads/excel/cortes/corte_bimestral/CorteVentasBimestral.xlsx")?>');
                        Swal.fire({ icon: 'success',title: '',text: '<?=$this->lang->line('ventas_cortes_bimestral_controller_lang_js_msg_creacion_corte')?>'});
                        break;
                }                
            },
            error: function(data){ console.log('error');console.log(data); },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
    function ventas_cortes_bimestral_view_form_js_excel(){
        $('#loader_panel').show();
        var anio = $('#cmb_anio').val();
        var mes = $('#cmb_periodo').val();      
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_bimestral/ventas_cortes_bimestral_controller/ventas_cortes_bimestral_controller_excel',
            dataType: 'json',
            data: {anio:anio,mes:mes},
            success: function(data){                
               $(location).attr('href','<?=funciones_strategix_version_url_random_base_url("uploads/excel/cortes/corte_bimestral/CorteVentasBimestral.xlsx")?>');
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
</script>
