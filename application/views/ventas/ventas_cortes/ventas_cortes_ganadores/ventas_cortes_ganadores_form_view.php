<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <section id="reposicionCaptura">
        <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_titulo')?></h2>
                </div>
            </div>
        </div>
    </div>    
        <div class="container">
            <div class="row justify-content-center" style="margin:20px 0px;">
                <?=$sub_menu?>
            </div>              
            <div class="panel-white">
                <div class="form-rf-1" id="form-rf-1">
                    <div class="row row-validator">
                         <div class="col-lg-5">
                            <div class="form-group">
                                <label for="cmb_anio_ventas_auditoria_form_view"><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_etiqueta_anio')?></label>
                                <select name="cmb_anio_ventas_auditoria_form_view" id="cmb_anio_ventas_auditoria_form_view" class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group" style="display: none;" id="div_mes">
                                <label for="cmb_mes_ventas_auditoria_form_view"><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_etiqueta_mes')?></label>
                                <select name="cmb_mes_ventas_auditoria_form_view" id="cmb_mes_ventas_auditoria_form_view" class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-lg-2" style="display: none;" id="div_buscar">
                            <div class="form-group">
                                <button type="button" id="ventas_auditoria_form_view_btn_corte" class="btn btn-axalta btn-buscar-ancho" style="margin-top: 1.68em;"><i class="fas fa-trophy"></i><span class="btn-buscar-texto"><?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_btn_corte')?></span></button>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
            <div id="tabla">
                
            </div>
        </div>
    </section>
<script>
    $(document).ready( function () {
        ventas_auditoria_form_view_combo_anio();   
        $('#cmb_anio_ventas_auditoria_form_view').on('change', function(){
            var anio = $('#cmb_anio_ventas_auditoria_form_view').val();
            if (anio==0){
                $('#div_mes').hide(); 
            } else {
                ventas_auditoria_form_view_combo_mes(); 
                $('#div_mes').show(300); 
            }
        });
        $('#cmb_mes_ventas_auditoria_form_view').on('change', function(){
            var mes = $('#cmb_mes_ventas_auditoria_form_view').val();
            if (mes==0){
                $('#div_buscar').hide();  
            } else { 
                $('#div_buscar').show(300);  
            }
        });
        $("#ventas_auditoria_form_view_btn_corte").click(function(){ ventas_auditoria_form_view_corte_ganadores(); });
    } );
    function ventas_auditoria_form_view_combo_anio(){
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_ganadores/ventas_cortes_ganadores_contoller/ventas_cortes_ganadores_contoller_combo_anio',
            dataType: 'json',
            data: {id:0},
            success: function(data){   
                $('#cmb_anio_ventas_auditoria_form_view').empty().html(data);
            },
            error: function(data){ },
            complete: function(){  }
        });
    }
    function ventas_auditoria_form_view_combo_mes(){
    var anio = $('#cmb_anio_ventas_auditoria_form_view').val();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_ganadores/ventas_cortes_ganadores_contoller/ventas_cortes_ganadores_contoller_combo_mes',
            dataType: 'json',
             data: {anio:anio},
            success: function(data){                 
                $('#cmb_mes_ventas_auditoria_form_view').empty().html(data);
            },
            error: function(data){ },
            complete: function(){  }
        });
    }
    function ventas_auditoria_form_view_corte_ganadores(){
        var anio = $('#cmb_anio_ventas_auditoria_form_view').val();
        var mes = $('#cmb_mes_ventas_auditoria_form_view').val();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_cortes/ventas_cortes_ganadores/ventas_cortes_ganadores_contoller/ventas_cortes_ganadores_contoller_corte',
            dataType: 'json',
            data: {anio:anio,mes:mes},
            success: function(data){                
                switch (data.res) {
                    case 1:
                        Swal.fire({ title: '', html: '<?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_js_msg_error_corte_creado')?>', icon: 'error', showCancelButton: false, confirmButtonColor: '#fd7e14', cancelButtonColor: '#6c757d', confirmButtonText: '<?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_js_msg_error_btn_ok')?>', cancelButtonText: '' }).then((valida) => { });
                        break;
                    case 2:
                        Swal.fire({ title: '', html: '<?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_js_msg_error_corte_ventas')?>', icon: 'error', showCancelButton: false, confirmButtonColor: '#fd7e14', cancelButtonColor: '#6c757d', confirmButtonText: '<?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_js_msg_error_btn_ok')?>', cancelButtonText: '' }).then((valida) => { });
                        break;                        
                    case 3:
                        Swal.fire({ title: '', html: '<?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_js_msg_error_corte_auditoria')?>', icon: 'error', showCancelButton: false, confirmButtonColor: '#fd7e14', cancelButtonColor: '#6c757d', confirmButtonText: '<?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_js_msg_error_btn_ok')?>', cancelButtonText: '' }).then((valida) => { });
                        break;
                    case 4: 
                        Swal.fire({ title: '', html: '<?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_js_msg_error_corte_correcto')?>', icon: 'success', showCancelButton: false, confirmButtonColor: '#fd7e14', cancelButtonColor: '#6c757d', confirmButtonText: '<?=$this->lang->line('ventas_cortes_ganadores_contoller_lang_js_msg_error_btn_ok')?>', cancelButtonText: '' }).then((valida) => { });
                        $('#tabla').html(data.tabla);
                        break;
                }
            },
            error: function(data){ },
            complete: function(){  }
        });
    }
</script>