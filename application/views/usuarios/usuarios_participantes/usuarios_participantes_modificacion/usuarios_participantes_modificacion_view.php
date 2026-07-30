<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form id="frrm_usuarios_participantes_modificacion_view" role="form" method="post" accept-charset="utf-8"> <input
    type="hidden" id="ParticipanteId" name="ParticipanteId" value="<?= $ParticipanteId ?>">
  <section id="altausuario">
        <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
      <div class="row panel-white panel-white-alt">
        <div class="col-lg-12">
          <div class="form-rf-1 form-pr" id="form-rf-1">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_etiqueta_distribuidora') ?></label>
                  <p><?= $distribuidora ?></p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_etiqueta_perfil') ?></label>
                  <p><?= $perfil ?></p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label
                    for="txtnombre"><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_nombre') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tooltip_nombre') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtnombre" id="txtnombre" value="<?= $txtnombre ?>"
                    class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_nombre') ?>"
                    onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                  <div id="error"></div>
                </div>
              </div>
            <div class="row row-validator">
              <input type="hidden" name="IdUsuario" id="IdUsuario" value="<?= $UsusarioId ?>" class="form-control">
              <div class="col-lg-4">
                <div class="form-group">
                  <label
                    for="txt_email"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_email') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_email') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_email" id="txt_email" value="<?= $email ?>" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_email') ?>"
                    maxlength="100">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_celular') ?></label>
                  <input type="text" name="txtcelular" id="txtcelular" value="<?= $celular ?>" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_celular') ?>"
                    onKeyPress="return js_general_solo_numeros(event)" maxlength="14">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label
                    for="txtrfc"><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_rfc') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tooltip_rfc') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtrfc" id="txtrfc" value="<?= $txtrfc ?>" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_rfc') ?>"
                    maxlength="14">
                  <div id="error"></div>
                </div>
              </div>

            </div>
   
            <div>
              <hr class="separador">
            </div>
            <div class="row" style="margin-top:20px; text-align:center;">
              <div class="col-lg-2 offset-lg-8 col-6">
                <button type="button"
                  onclick="window.location.href='<?= funciones_strategix_version_url_random_base_url("UsuariosParticipantes") ?>'"
                  class="btn btn-gray"><i class="far fa-caret-square-left"></i>
                  <?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_boton_regresar') ?></button>
              </div>
              <div class="col-lg-2 col-6">
                <button type="button" id="usuarios_participantes_modificacion_view_boton_guardar"
                  class="btn btn-axalta"><i class="far fa-save"></i>
                  <?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_boton_guardar') ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
<script src="https://cdn.jsdelivr.net/npm/inputmask@5/dist/inputmask.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Inputmask("(99)99999-9999").mask(document.querySelectorAll("#txtcelular"));
        Inputmask("999.999.999-99").mask(document.querySelectorAll("#txtrfc"));
    });
</script>
<script>
  $(document).ready(function () {
    /********************************************MSG ERROR******************************************************************************************/
    $('#frrm_usuarios_participantes_modificacion_view input').on('keyup', function () {
      js_general_limpiar_errores(this);
    });
    $('#frrm_usuarios_participantes_modificacion_view input').on('click', function () {
      js_general_limpiar_errores(this);
    });
    $('#frrm_usuarios_participantes_modificacion_view select').on('click', function () {
      js_general_limpiar_errores(this);
    });
    $('#frrm_usuarios_participantes_modificacion_view input').on('change', function () {
      js_general_limpiar_errores(this);
    });
    /**************************************************************************************************************************************/
    $("#usuarios_participantes_modificacion_view_boton_guardar").click(function () {
      usuarios_participantes_modificacion_view_js_guardar();
    });
  });

  function usuarios_participantes_modificacion_view_js_guardar() {
    $('#error').html(" ");
    var txtnombre = $('#txtnombre').val();
    var IdUsuario = $('#IdUsuario').val();
    var txt_email = $('#txt_email').val();
    var txtcelular = $('#txtcelular').val();
    var distribuidora = '<?= $distribuidora ?>';
    var txtrfc = $('#txtrfc').val();
    var datos = '<table class="table table-striped table-bordered" style="text-align:left; font-size:12px;">'+
    '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_etiqueta_perfil') ?></b></td><td><?= $perfil ?></td></tr>';
    if (distribuidora !== '') {
      datos = datos + 
      '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_etiqueta_distribuidora') ?></b></td><td><?= $distribuidora ?></td></tr>';
    }
      datos = datos + 
      '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_nombre') ?></b></td><td>' + txtnombre + '</td></tr>' +
      '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_email') ?></b></td><td>' + txt_email + '</td></tr>' +
      '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_celular') ?></b></td><td>' + txtcelular + '</td></tr>' +
      '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_rfc') ?></b></td><td>' + txtrfc + '</td></tr>';
   
    Swal.fire({
      title: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_js_confirm_titulo') ?>',
      html: datos,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#fd7e14',
      cancelButtonColor: '#6c757d',
      confirmButtonText: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_js_confirm_boton_aprobado') ?>',
      cancelButtonText: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_js_confirm_boton_rechazado') ?>',
      allowOutsideClick: false
    }).then((confirma_modificacion_participante) => {
      if (confirma_modificacion_participante.isConfirmed) {
        $("#participantes_edicion_boton_guardar").attr('disabled', true);
        $('#loader_panel').show();
        $.ajax({
          type: "POST",
          url: "<?php echo funciones_strategix_version_url_random_base_url("usuarios/usuarios_participantes/usuarios_participantes_modificacion/usuarios_participantes_modificacion_controller/usuarios_participantes_modificacion_controller_guarda") ?>",
          data: $("#frrm_usuarios_participantes_modificacion_view").serialize(),
          dataType: "json",
          success: function (data) {
            switch (data) {
              case 0:
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_js_msg_participante_no_inserto') ?>'
                });
                $("#participantes_edicion_boton_guardar").attr('disabled', false);
                break;
              case 1:

                Swal.fire({
                  title: '',
                  html: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_js_msg_participante_inserto') ?>',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#fd7e14',
                  cancelButtonColor: '#6c757d',
                  confirmButtonText: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tabla_js_msg_swal_ok') ?>',
                  cancelButtonText: ''
                }).then((validacionaltaparticipante) => {
                  if (validacionaltaparticipante.isConfirmed) {
                    $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url("UsuariosParticipantes") ?>");
                  }
                });
                break;
              case 4:

                Swal.fire({
                  title: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_datos_js_titulo_swal_error') ?>',
                  html: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_js_msg_participante_error_corroe') ?>',
                  icon: 'error',
                  showCancelButton: false,
                  confirmButtonColor: '#fd7e14',
                  cancelButtonColor: '#6c757d',
                  confirmButtonText: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tabla_js_msg_swal_ok') ?>',
                  cancelButtonText: ''
                }).then((validacionaltaparticipante) => {
                  if (validacionaltaparticipante.isConfirmed) {
                    $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url("UsuariosParticipantes") ?>");
                  }
                });
                break;
              case 5:
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: '<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_js_msg_limite_participante') ?>'
                });
                break;
              default:
                $.each(data, function (key, value) {
                  $('#' + key).addClass('is-invalid');
                  $('#' + key).parents('.form-group').find('#error').html(value);
                });
                break;
            }
          },
          error: function (data) {
            console.log(data);
            $("#participantes_edicion_boton_guardar").attr('disabled', false);
          },
          complete: function () {
            $('#loader_panel').hide();
          }
        });
      } else {
        return 0;
      }
    });
  }
</script>