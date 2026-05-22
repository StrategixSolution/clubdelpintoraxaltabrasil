<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 May 2026 09:00:00                         * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link href="<?=base_url("vendors/bootstrap-transfer/bootstrap-transfer.css")?>" rel="stylesheet" type="text/css"/>
<script src="<?=base_url("vendors/bootstrap-transfer/bootstrap-transfer.js")?>" type="text/javascript"></script>
<form id="frm_productos_reposicion_relacion_premios_productos_view" role="form" method="post" accept-charset="utf-8">
    <section id="registroMaestroPintor">
        <div class="panel-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_titulo')?></h2>
                    </div>
                </div>
            </div>
        </div> 
        <div class="container">
            <div class="row" style="margin:20px 0px;">
                <?=$sub_menu?>
            </div>               

            <div class="panel-white">
                <div class="row row-validator" id="div_simple">
                    <div class="col-lg-4" id="div_anio" style="display: none;">
                        <div class="form-group">
                            <label for="cmb_anio"><?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_etiqueta_anio')?><span data-toggle='tooltip' title='<?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_tooltip_anio')?>'><i class="fas fa-question-circle"></i></span></label>
                            <select id="cmb_anio" name="cmb_anio" class="form-select"></select>
                            <div id="error"></div>
                        </div>
                    </div>
                    <div class="col-lg-4" id="div_mes" style="display: none;">
                        <div class="form-group">
                            <label for="cmb_mes"><?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_etiqueta_mes')?><span data-toggle='tooltip' title='<?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_tooltip_mes')?>'><i class="fas fa-question-circle"></i></span></label>
                            <select id="cmb_mes" name="cmb_mes" class="form-select"></select>
                            <div id="error"></div>
                        </div>
                    </div>
                    <div class="col-lg-4" id="div_lugar" style="display: none;">
                        <div class="form-group">
                            <label for="cmb_lugar"><?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_etiqueta_lugar')?><span data-toggle='tooltip' title='<?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_tooltip_lugar')?>'><i class="fas fa-question-circle"></i></span></label>
                            <select id="cmb_lugar" name="cmb_lugar" class="form-select"></select>
                            <div id="error"></div>
                        </div>
                    </div>
                </div>   
                <div id="transfer_lugares_productos" class=" mt-5 mb-5" style="width:100%; display: none;"></div> 
                <div class="row justify-content-end" id="div_btn_actualizar" style="display: none;">
                    <div class="col-lg-2 col-12">
                        <button type="button" id="productos_reposicion_relacion_premios_productos_view_btn_guardar" name="productos_reposicion_relacion_premios_productos_view_btn_guardar" class="btn btn-axalta btn-buscar-ancho"><i class="far fa-save"></i><span class="btn-buscar-texto"><?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_btn_actualizar')?></span></button>
                    </div>
                </div>                       
        </div>        
    </section>
</form>
<script> 
    $(document).ready( function () {     
        productos_reposicion_relacion_premios_productos_view_js_anio(1);  
        $('#cmb_anio').on('change', function(){ 
            var cmb_sector = $('#cmb_sector option:selected').val();
            var cmb_anio = $('#cmb_anio option:selected').val();
            $('#transfer_lugares_productos').empty();
            $('#div_lugar').hide();
            $('#transfer_lugares_productos').hide();
            $('#div_btn_actualizar').hide();
            if (cmb_anio!=0){
                productos_reposicion_relacion_premios_productos_view_js_mes(cmb_sector,cmb_anio);      
            } else {
                $('#div_mes').hide();  
            }
        });
        $('#cmb_mes').on('change', function(){            
            var cmb_sector = $('#cmb_sector option:selected').val();
            var cmb_anio = $('#cmb_anio option:selected').val();
            var cmb_mes = $('#cmb_mes option:selected').val();
            $('#div_lugar').hide();
            $('#transfer_lugares_productos').empty();
            $('#transfer_lugares_productos').hide();
            $('#div_btn_actualizar').hide();
            if (cmb_mes!=0){
                productos_reposicion_relacion_premios_productos_view_js_lugares(cmb_sector,cmb_anio,cmb_mes);
            }
        });
        $('#cmb_lugar').on('change', function(){
            var cmb_lugar = $('#cmb_lugar option:selected').val();
            $('#transfer_lugares_productos').hide();
            $('#transfer_lugares_productos').empty();
            $('#div_btn_actualizar').hide();
            if (cmb_lugar!=0){
                productos_reposicion_relacion_premios_productos_view_js_transfer();
                $('#transfer_lugares_productos').show();        
            } else {
                      
            }
        });
        $('#productos_reposicion_relacion_premios_productos_view_btn_guardar').click(function() { productos_reposicion_relacion_premios_productos_view_js_guardar(); });
    });
    function productos_reposicion_relacion_premios_productos_view_js_combo_sector(){       
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_relacion_premios_productos_contoller/productos_reposicion_relacion_premios_productos_contoller_ajax_combo_sector',
            dataType: 'json',
            data: {id:0},
            success: function(data){ 
                $('#cmb_sector').html(data);
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
    function productos_reposicion_relacion_premios_productos_view_js_anio(cmb_sector){       
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_relacion_premios_productos_contoller/productos_reposicion_relacion_premios_productos_contoller_ajax_combo_anio',
            dataType: 'json',
            data: {cmb_sector:cmb_sector},
            success: function(data){ 
                $('#cmb_anio').html(data);
                $('#div_anio').show();
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
    function productos_reposicion_relacion_premios_productos_view_js_mes(cmb_sector,cmb_anio){
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_relacion_premios_productos_contoller/productos_reposicion_relacion_premios_productos_contoller_ajax_combo_mes',
            dataType: 'json',
            data: {cmb_sector:cmb_sector,cmb_anio:cmb_anio},
            success: function(data){
                $('#cmb_mes').html(data);
                $('#div_mes').show();                
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
    function productos_reposicion_relacion_premios_productos_view_js_lugares(cmb_sector,cmb_anio,cmb_mes){       
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_relacion_premios_productos_contoller/productos_reposicion_relacion_premios_productos_contoller_ajax_combo_lugares',
            dataType: 'json',
            data: {cmb_sector:cmb_sector,cmb_anio:cmb_anio,cmb_mes:cmb_mes},
            success: function(data){ 
                $('#cmb_lugar').html(data);
                $('#div_lugar').show();      
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    } 
    function productos_reposicion_relacion_premios_productos_view_js_transfer(){       
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_relacion_premios_productos_contoller/productos_reposicion_relacion_premios_productos_contoller_ajax_lista_productos_premios',
            dataType: 'json',
            data: $("#frm_productos_reposicion_relacion_premios_productos_view").serialize(),
            success: function(data){ 
                $('#transfer_lugares_productos').show();
                $('#transfer_lugares_productos').bootstrapTransfer({'target_id': 'multi-select-input','height': '20em','hilite_selection': false});
                $('#transfer_lugares_productos').data().bootstrapTransfer.populate(data.seleccionar);
                $('#transfer_lugares_productos').data().bootstrapTransfer.set_values(data.seleccionados);
                $('#div_btn_actualizar').show();
            },
            error: function(data){ console.log(data); },
            complete: function(){ $('#loader_panel').hide(); }
        });
        $('#loader_panel').hide();
    }
    function productos_reposicion_relacion_premios_productos_view_js_guardar(){
        var cmb_sector = $('#cmb_sector option:selected').val();
        var cmb_anio = $('#cmb_anio option:selected').val();
        var cmb_mes = $('#cmb_mes option:selected').val();
        var cmb_lugar = $('#cmb_lugar option:selected').val();
        var transfer_array = $('#transfer_lugares_productos').data().bootstrapTransfer.get_values();        
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'productos/productos_reposicion/productos_reposicion_relacion_premios_productos_contoller/productos_reposicion_relacion_premios_productos_contoller_ajax_guarda_productos_premios',
            dataType: 'json',
            data: {cmb_sector:cmb_sector,cmb_anio:cmb_anio,cmb_mes:cmb_mes,cmb_lugar:cmb_lugar,transfer_array:transfer_array},
            success: function(data){ 
                if (data==1){
                    Swal.fire({
                        title: '',
                        html: "<?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_js_msg_susses')?>",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#fd7e14',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_js_ok')?>',
                        cancelButtonText: '',
                        allowOutsideClick: false
                    }).then((validacion) => {
                        
                    });
                } else {
                    Swal.fire({
                        title: '',
                        html: "<?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_js_msg_error')?>",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#fd7e14',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<?=$this->lang->line('productos_reposicion_relacion_premios_productos_contoller_lang_js_ok')?>',
                        cancelButtonText: '',
                        allowOutsideClick: false
                    }).then((validacion) => {
                        
                    });
                }
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
        $('#loader_panel').hide();
    }
</script>