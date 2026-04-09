<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 ABRIL 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<section class="auditoria_ventas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?=$this->lang->line('ventas_auditoria_envio_correos_controller_lang_pagina_titulo')?></h2>
                </div>
            </div>
        </div>
    </div>
<div class="container">
    <div class="panel-white">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="anio"><?=$this->lang->line('ventas_auditoria_envio_correos_controller_lang_etiqueta_anio')?></label>
                    <select name="anio" id="anio" class="form-select"></select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group" style="display: none;" id="div_mes">
                    <label for="mes"><?=$this->lang->line('ventas_auditoria_envio_correos_controller_lang_etiqueta_mes')?></label>
                    <select name="mes" id="mes" class="form-select"></select>
                </div>
            </div>
            <div class="col-lg-1" style="text-align: right; margin-top:20px; display: none;" id="div_buscar">
                <div class="form-group">
                    <button type="button" id="auditoria_ventas_btn_buscar" class="btn btn-axalta"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div> 
        <p>
    </div>
    <div id="tabla_auditoria_ventas"></div>
</div>
</section>
<script>
    $(document).ready( function () {
       ventas_auditoria_envio_correos_form_viewjs_combo_anio();   
       $('#anio').on('change', function(){
            var anio = $('#anio').val();
            if (anio==0){
                $('#div_mes').hide(300); 
            } else {
                ventas_auditoria_envio_correos_form_viewjs_combo_mes(); 
                $('#div_mes').show(300); 
            }
        });
        $('#mes').on('change', function(){
            var mes = $('#mes').val();
            if (mes==0){
                $('#div_cmbdistribuidora').hide(300); 
                $('#div_cmbestatus').hide(300);  
                $('#div_buscar').hide(300);  
            } else {  
                $('#div_buscar').show(300);  
            }
        });
        $("#auditoria_ventas_btn_buscar").click(function(){ ventas_auditoria_envio_correos_form_viewjs_tabla(); });
    } );
    function ventas_auditoria_envio_correos_form_viewjs_combo_anio(){
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_controller/ventas_auditoria_envio_correos_controller_combo_anio',
            dataType: 'json',
            data: {id:0},
            success: function(data){   
                $('#anio').empty().html(data);
            },
            error: function(data){ },
            complete: function(){  }
        });
    }
    function ventas_auditoria_envio_correos_form_viewjs_combo_mes(){
    var anio = $('#anio').val();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_envio_correos/ventas_auditoria_envio_correos_controller/ventas_auditoria_envio_correos_controller_combo_mes',
            dataType: 'json',
             data: {anio:anio},
            success: function(data){                 
                $('#mes').empty(); 
                $('#mes').html(data);  
            },
            error: function(data){ },
            complete: function(){  }
        });
    }
    function ventas_auditoria_envio_correos_form_viewjs_tabla(){
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
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
</script>
