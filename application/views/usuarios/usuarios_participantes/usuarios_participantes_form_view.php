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
      <div class="row" style="justify-content: flex-start;">
        <div class="col-lg-2" id="div_alta">
          <div class="row vertical-center">
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
        cmb_perfil: cmb_perfil,
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