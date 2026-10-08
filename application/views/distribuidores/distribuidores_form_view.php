<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<section id="distribuidores">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('distribuidores_controller_lang_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-5 col-12" id="div_distribuidres">
                            <div class="form-group">
                                <label for="cmb_distribuidres"><?= $this->lang->line('distribuidores_controller_lang_combo_distribuidores') ?></label>
                                <select id="cmb_distribuidres" name="cmb_distribuidres" class="form-select">
                                    <option value="0">TODOS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12">
                            <div class="form-group">
                                <label for="cmb_estatus"><?= $this->lang->line('distribuidores_controller_lang_combo_estatus') ?></label>
                                <select id="cmb_estatus" name="cmb_estatus" class="form-select">
                                    <option value="0">TODOS</option>
                                    <option value="1">HABILITADO</option>
                                    <option value="2">DESATIVADO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <button type="button" id="distribuidores_form_view_boton_buscar" class="btn btn-axalta btn-buscar-ancho"><i class="fas fa-search"></i><span class="btn-buscar-texto">PESQUISAR</span></button>
                            <!-- <div class="form-group">
                                
                            </div> -->
                        </div>
                        <div class="col-lg-2 col-12" id="div_alta">
                            <div class="row btn-agregar-dist">
                                <div class="btn-modulo">
                                    <a href="<?php echo funciones_strategix_version_url_random_base_url("DistribuidoresAlta") ?>">
                                        <button type="button" class="btn btn-axalta btn-buscar-ancho">
                                            <i class="fas fa-store"></i><span class="btn-buscar-texto">CADASTRAR</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-2 col-12" id="div_alta">
                    <div class="row btn-agregar-dist">
                        <div class="btn-modulo">
                            <a href="<?php echo funciones_strategix_version_url_random_base_url("DistribuidoresAlta") ?>">
                                <button type="button" class="btn btn-axalta btn-buscar-ancho fs-btn-plus">
                                    <i class="fas fa-store"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div> -->
            </div>
            <div id="tabla_distribuidores"></div>
        </div>

    </div>
</section>
<script>
    $(document).ready(function() {
        distribuidores_form_view_js_combo_lista_distribuidres();
        $("#distribuidores_form_view_boton_buscar").click(function() {
            distribuidores_form_view_js_buscar_tabla();
        });
    });

    function distribuidores_form_view_js_combo_lista_distribuidres() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'distribuidores/distribuidores_controller/distribuidores_controller_combo_lista_distribuidores',
            dataType: 'json',
            data: {},
            success: function(data) {
                $('#cmb_distribuidres').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function distribuidores_form_view_js_buscar_tabla() {
        var cmb_distribuidres = $('#cmb_distribuidres').val();
        var cmb_estatus = $('#cmb_estatus').val();
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'distribuidores/distribuidores_controller/distribuidores_controller_buscar_tabla',
            dataType: 'json',
            data: {
                cmb_distribuidres: cmb_distribuidres,
                cmb_distribuidres: cmb_distribuidres,
                cmb_estatus: cmb_estatus
            },
            success: function(data) {
                $('#tabla_distribuidores').html(data.tabla);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
</script>