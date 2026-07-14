<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form id="frrm_usuarios_participantes_modificacion_view" role="form" method="post" accept-charset="utf-8"> <input
    type="hidden" id="ParticipanteId" name="ParticipanteId" value="<?= $ParticipanteId ?>">
  <section id="altaferretera">
    <div
      style="background: linear-gradient(rgba(5, 7, 12, 0.75), rgba(5, 7, 12, 0.50)), url(<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/usuarios/personal_tienda/" . $this->session->userdata(funciones_strategix_sitio_alias('s_segmento_id')) . "/bg-title.jpg") ?>)  center center / cover no-repeat;">
      <div class="container">
        <div class="title-modulo">
          <h2><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_pagina_titulo') ?></h2>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row panel-white panel-white-alt">
        <div class="col-lg-9">
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
            </div>
            <!-- <div class="line-dashed-gray"></div> -->
            <div class="row row-validator">
              <div class="col-lg-3">
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
              <div class="col-lg-3" id="div_segundo_nombre">
                <div class="form-group">
                  <label
                    for="txtsegundonombre"><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_segundo_nombre') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tooltip_segundo_nombre') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtsegundonombre" id="txtsegundonombre" value="<?= $txtsegundonombre ?>"
                    class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_segundo_nombre') ?>"
                    onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label
                    for="txtapellidopaterno"><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_apellido_paterno') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tooltip_apellido_paterno') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtapellidopaterno" id="txtapellidopaterno"
                    value="<?= $txtapellidopaterno ?>" class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_apellido_paterno') ?>"
                    onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label
                    for="txtapellidomaterno"><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_apellido_materno') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tooltip_apellido_materno') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtapellidomaterno" id="txtapellidomaterno"
                    value="<?= $txtapellidomaterno ?>" class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_apellido_materno') ?>"
                    onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div class="row row-validator">
              <input type="hidden" name="IdUsuario" id="IdUsuario" value="<?= $UsusarioId ?>" class="form-control">
              <?php if ($UsusarioId == 118) { ?>
                <div class="col-lg-4">
                  <div class="form-group">
                  <label
                    for="txt_email"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_email') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_email') ?>'><i
                        class="fas fa-question-circle"></i></span></label>  
                  <input type="text" name="txt_email" id="txt_email"  value="<?= $email ?>" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_email') ?>"
                    maxlength="100">
                  <div id="error"></div>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_celular') ?></label>
                    <input type="text" name="txtcelular" id="txtcelular" value="<?= $celular ?>" class="form-control"
                      placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_celular') ?>"
                      onKeyPress="return js_general_solo_numeros(event)" maxlength="20">
                    <div id="error"></div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_email') ?></label>
                    <p><?= $email ?></p>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_celular') ?></label>
                    <p><?= $celular ?></p>
                  </div>
                </div>
              <?php } ?>
              <div class="col-lg-3">
                <div class="form-group">
                  <label
                    for="texttelefono"><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_telefono') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tooltip_telefono') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="texttelefono" id="texttelefono" value="<?= $texttelefono ?>"
                    class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_telefono') ?>"
                    maxlength="20">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <label
                    for="txtextencion"><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_extencion') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tooltip_extencion') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtextencion" id="txtextencion" value="<?= $txtextencion ?>"
                    class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_extencion') ?>"
                    maxlength="10">
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div class="row row-validator">
              <div class="col-lg-3">
                <div class="form-group">
                  <label
                    for="txtrfc"><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_rfc') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_tooltip_rfc') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtrfc" id="txtrfc" value="<?= $txtrfc ?>" class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_placeholder_rfc') ?>"
                    onKeyPress="return js_general_nit(event)" maxlength="25">
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
        <div class="col-lg-3 no-cel"
          style=" margin-top: -20px; margin-bottom: -20px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; background: url(<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/usuarios/personal_tienda/" . $this->session->userdata(funciones_strategix_sitio_alias('s_segmento_id')) . "/bg-form.jpg") ?>)  center center / cover no-repeat;">
        </div>
      </div>
    </div>
  </section>
</form>
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
    var txtsegundonombre = $('#txtsegundonombre').val();
    var txtapellidopaterno = $('#txtapellidopaterno').val();
    var txtapellidomaterno = $('#txtapellidomaterno').val();
    var texttelefono = $('#texttelefono').val();
    var txtextencion = $('#txtextencion').val();
    var IdUsuario = $('#IdUsuario').val();
    var txt_email = $('#txt_email').val();
    var txtcelular = $('#txtcelular').val();
    var distribuidora = '<?= $distribuidora ?>';
    var txtrfc = $('#txtrfc').val();
    var datos = '<table class="table table-striped table-bordered" style="text-align:left; font-size:12px;"><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_etiqueta_perfil') ?></b></td><td><?= $perfil ?></td></tr>';
    if (distribuidora !== '') {
      datos = datos + '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_etiqueta_distribuidora') ?></b></td><td><?= $distribuidora ?></td></tr>';
    }
    if (IdUsuario == 118) {
      datos = datos + '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_nombre') ?></b></td><td>' + txtnombre + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_segundo_nombre') ?></b></td><td>' + txtsegundonombre + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_apellido_paterno') ?></b></td><td>' + txtapellidopaterno + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_apellido_materno') ?></b></td><td>' + txtapellidomaterno + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_email') ?></b></td><td>' + txt_email + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_telefono') ?></b></td><td>' + texttelefono + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_extencion') ?></b></td><td>' + txtextencion + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_celular') ?></b></td><td>' + txtcelular + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_rfc') ?></b></td><td>' + txtrfc + '</td></tr>';
    } else {
      datos = datos + '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_nombre') ?></b></td><td>' + txtnombre + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_segundo_nombre') ?></b></td><td>' + txtsegundonombre + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_apellido_paterno') ?></b></td><td>' + txtapellidopaterno + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_apellido_materno') ?></b></td><td>' + txtapellidomaterno + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_email') ?></b></td><td><?= $email ?></td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_telefono') ?></b></td><td>' + texttelefono + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_extencion') ?></b></td><td>' + txtextencion + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_celular') ?></b></td><td><?= $celular ?></td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_modificacion_controller_lang_input_rfc') ?></b></td><td>' + txtrfc + '</td></tr>';
    }
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