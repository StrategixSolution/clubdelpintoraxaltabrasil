<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<section id="distribuidores">
    <div style="background: linear-gradient(rgba(5, 7, 12, 0.75), rgba(5, 7, 12, 0.50)), url(<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/tarjetas/" . $this->session->userdata(funciones_strategix_sitio_alias('s_segmento_id')) . "/bg-title.jpg") ?>)  center center / cover no-repeat;">
        <div class="container">
            <div class="title-modulo">
                <h2><?=$this->lang->line('tarjetas_controller_lang_titulo')?></h2>
            </div>
        </div>
    </div>
    <div class="container">    
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-10"> 
                    <div class="row">
                        <div class="col-lg-6" id="div_paises">
                            <div class="form-group">
                                <label for="cmb_estatus"><?=$this->lang->line('tarjetas_controller_lang_combo_estatus')?></label>
                                <select id="cmb_estatus" name="cmb_estatus" class="form-select"><option value="0">TODOS</option></select>
                            </div>
                        </div>                           
                        <div class="col-lg-2" >
                            <div class="form-group">                        
                                <button type="button" id="tarjetas_form_view_boton_buscar" class="btn btn-axalta"><i class="fas fa-search"></i></button>                
                            </div>
                        </div>      
                    </div>      
                </div>
                <div class="col-lg-2" id="div_alta">
                    <div class="row btn-agregar-dist">
                        <div class="btn-modulo">
                            <a href="<?php echo funciones_strategix_version_url_random_base_url("TarjetasAltas") ?>">
                                <button type="button" class="btn btn-axalta fs-btn-plus">
                                <i class="fas fa-credit-card"></i>
                                </button><br>
                            </a>
                        </div>
                    </div>
                </div> 
            </div>  
            <div id="tabla_tarjetas"></div>
        </div>        
    </div>
</section>
<script>
    $(document).ready( function () {
        tarjetas_form_view_js_combo_estatus();
        $("#tarjetas_form_view_boton_buscar").click(function(){ tarjetas_form_view_js_buscar_tabla(); });
    });
    function tarjetas_form_view_js_combo_estatus(){
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'tarjetas/tarjetas_controller/tarjetas_controller_combo_estatus',
            dataType: 'json',
            data: {id:0},
            success: function(data){ 
                $('#cmb_estatus').html(data);                
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }    
    function tarjetas_form_view_js_buscar_tabla(){
        var cmb_estatus = $('#cmb_estatus').val();         
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'tarjetas/tarjetas_controller/tarjetas_controller_buscar_tabla',
            dataType: 'json',
            data: {cmb_estatus:cmb_estatus},
            success: function(data){
                $('#tabla_tarjetas').html(data.tabla);
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    }
</script>