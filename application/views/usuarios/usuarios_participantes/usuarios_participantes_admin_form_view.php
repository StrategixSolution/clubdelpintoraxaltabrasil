<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<section id="participantes">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('usuarios_participantes_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-10 borde-r-pt">
                    <div class="row" id="div_distribuidoras">
                        <div class="col-lg-7" id="div_distribuidoras">
                            <div class="form-group">
                                <label for="cmb_distribuidoras"><?= $this->lang->line('usuarios_participantes_controller_lang_etiqueta_distribuidoras') ?></label>
                                <select id="cmb_distribuidoras" name="cmb_distribuidoras" class="form-select"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5" id="div_perfiles">
                            <div class="form-group">
                                <label for="cmb_perfil"><?= $this->lang->line('usuarios_participantes_controller_lang_etiqueta_perfiles') ?></label>
                                <select id="cmb_perfil" name="cmb_perfil" class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-lg-5" id="div_estatus">
                            <div class="form-group">
                                <label for="cmb_estatus"><?= $this->lang->line('usuarios_participantes_controller_lang_combo_estatus') ?></label>
                                <select id="cmb_estatus" name="cmb_estatus" class="form-select">
                                    <option value="0">TODOS</option>
                                    <option value="1">HABILITADO</option>
                                    <option value="2">BAJA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2" id="div_buscar">
                            <div class="form-group">
                                <button type="button" id="usuarios_participantes_controller_lang_boton_buscar" class="btn btn-axalta"><i class="fas fa-search"></i></button><a href="<?php echo funciones_strategix_version_url_random_base_url("ParticipantesAlta") ?>"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2" id="div_alta">
                    <div class="row">
                        <div class="">
                            <div class="btn-modulo">
                                <a href="<?php echo funciones_strategix_version_url_random_base_url("UsuariosParticipantesAltas") ?>">
                                    <button type="button" class="btn btn-axalta">
                                        <i class="fas fa-user-plus"></i>
                                    </button><br>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabla_participante"></div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        var perfil = '<?= $perfil ?>';
        if (perfil == 8) {
            $('#div_distribuidoras').hide();
            $('#div_perfiles').hide();
            $('#div_estatus').hide();
            $('#div_buscar').hide();
            usuarios_participantes_form_view_js_buscar_tabla();
        } else {
         usuarios_participantes_form_view_js_combo_distribuidora();
            usuarios_participantes_form_view_js_combo_perfil();
         
          
            $('#cmb_distribuidoras').on('change', function() {
                $('#tabla_participante').empty();
            });
            $('#cmb_perfil').on('change', function() {
                $('#tabla_participante').empty();
            });
            $("#usuarios_participantes_controller_lang_boton_buscar").click(function() {
                usuarios_participantes_form_view_js_buscar_tabla();
            });
        }
    });

    function usuarios_participantes_form_view_js_combo_distribuidora() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'usuarios/usuarios_participantes/usuarios_participantes_controller/usuarios_participantes_controller_combo_distribuidoras',
            dataType: 'json',
            data: {
                1: 1
            },
            success: function(data) {
                $('#cmb_distribuidoras').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
    function usuarios_participantes_form_view_js_combo_perfil() {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'usuarios/usuarios_participantes/usuarios_participantes_controller/usuarios_participantes_controller_combo_perfil',
            dataType: 'json',
            data: {
                id: 0
            },
            success: function(data) {
                $('#cmb_perfil').html(data);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
    function usuarios_participantes_form_view_js_buscar_tabla() {
        $('#loader_panel').show();
        var cmb_distribuidoras = $('#cmb_distribuidoras').val();
        var cmb_perfil = $('#cmb_perfil').val();
        var cmb_estatus = $('#cmb_estatus').val();
        $.ajax({
            type: 'POST',
            url: 'usuarios/usuarios_participantes/usuarios_participantes_controller/usuarios_participantes_controller_buscar_tabla',
            dataType: 'json',
            data: {
                cmb_distribuidoras: cmb_distribuidoras,
                cmb_estatus: cmb_estatus,
                cmb_perfil: cmb_perfil
            },
            success: function(data) {
                $('#tabla_participante').html(data.tabla);
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
</script>