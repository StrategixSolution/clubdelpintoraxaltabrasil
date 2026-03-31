<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>
<section id="tarjetas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('tarjetas_controller_lang_titulo') ?></h2>
                </div>
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
                                <label for="cmb_estatus"><?= $this->lang->line('tarjetas_controller_lang_combo_estatus') ?></label>
                                <select id="cmb_estatus" name="cmb_estatus" class="form-select">
                                    <option value="0">TODOS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 btn-buscar-posicion">
                            <div class="form-group">
                                <button type="button" id="tarjetas_form_view_boton_buscar" class="btn btn-axalta btn-buscar-ancho"><i class="fas fa-search"></i><span class="btn-buscar-texto"></span> PESQUISAR</button>
                            </div>
                        </div>
                        <div class="col-lg-2 btn-buscar-posicion" id="div_alta">
                            <div class="row btn-agregar-dist">
                                <div class="btn-modulo">
                                    <a href="<?php echo funciones_strategix_version_url_random_base_url("TarjetasAltas") ?>">
                                        <button type="button" class="btn btn-axalta fs-btn-plus btn-buscar-ancho">
                                            <i class="fas fa-credit-card"></i><span class="btn-buscar-texto"></span> CADASTRO
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabla_tarjetas"></div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        tarjetas_form_view_js_combo_estatus();
        $("#tarjetas_form_view_boton_buscar").click(function() {
            tarjetas_form_view_js_buscar_tabla();
        });
    });

    function tarjetas_form_view_js_combo_estatus() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'tarjetas/tarjetas_controller/tarjetas_controller_combo_estatus',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_estatus').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function tarjetas_form_view_js_buscar_tabla() {
        var cmb_estatus = $('#cmb_estatus').val();
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'tarjetas/tarjetas_controller/tarjetas_controller_buscar_tabla',
            dataType: 'json',
            data: {
                cmb_estatus: cmb_estatus
            },
            success: function(data) {
                $('#tabla_tarjetas').html(data.tabla);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
</script>