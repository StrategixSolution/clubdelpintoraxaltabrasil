<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form id="frm_usuarios_participantes_altas_view" role="form" method="post" accept-charset="utf-8">
  <section id="altaferretera">
    <div style="background: linear-gradient(rgba(5, 7, 12, 0.75), rgba(5, 7, 12, 0.50)), url(<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/usuarios/personal_tienda/" . $this->session->userdata(funciones_strategix_sitio_alias('s_segmento_id')) . "/bg-title.jpg") ?>)  center center / cover no-repeat;">
      <div class="container">
        <div class="title-modulo">
          <h2><?= $this->lang->line('usuarios_participantes_altas_controller_lang_pagina_titulo') ?></h2>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row panel-white panel-white-alt">
        <div class="col-lg-9">
          <div class="form-rf-1 form-pr" id="form-rf-1">
            <div class="row row-validator">
              <div class="col-lg-3" id="div_pais">
                <div class="form-group">
                  <label for="cmb_pais"><?= $this->lang->line('usuarios_participantes_altas_controller_combo_etiqueta_pais') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_combo_tooltip_pais') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <select id="cmb_pais" name="cmb_pais" class="form-select"></select>
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-6" id="div_distribuidoras">
                <div class="form-group">
                  <label for="cmb_distribuidoras"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_etiqueta_distribuidora') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_distribuidora') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <select id="cmb_distribuidoras" name="cmb_distribuidoras" class="form-select"></select>
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-3" id="div_perfiles">
                <div class="form-group">
                  <label for="cmb_perfil"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_etiqueta_perfil') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_perfil') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <select id="cmb_perfil" name="cmb_perfil" class="form-select"></select>
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div class="row row-validator">
              <div class="dyncol col-lg-3">
                <div class="form-group">
                  <label for="txtnombre"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_nombre') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_nombre') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtnombre" id="txtnombre" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_nombre') ?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-3" id="div_segundo_nombre">
                <div class="form-group">
                  <label for="txtsegundonombre"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_segundo_nombre') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_segundo_nombre') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtsegundonombre" id="txtsegundonombre" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_segundo_nombre') ?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-3">
                <div class="form-group">
                  <label for="txtapellidopaterno"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_apellido_paterno') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_apellido_paterno') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtapellidopaterno" id="txtapellidopaterno" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_apellido_paterno') ?>" style="text-transform: uppercase;" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-3">
                <div class="form-group">
                  <label for="txtapellidomaterno"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_apellido_materno') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_apellido_materno') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtapellidomaterno" id="txtapellidomaterno" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_apellido_materno') ?>" onKeyPress="return js_general_solo_texto(event,this)" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div class="row row-validator">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="txtemail"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_email') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_email') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtemail" id="txtemail" class="form-control" placeholder="<?= $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_email') ?>" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="texttelefono"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_telefono') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_telefono') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="texttelefono" id="texttelefono" class="form-control" placeholder="<?= $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_telefono') ?>" onKeyPress="return js_general_solo_numeros(event)" maxlength="20">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  <label for="txtextencion"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_extencion') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_extencion') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtextencion" id="txtextencion" class="form-control" placeholder="<?= $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_extencion') ?>" onKeyPress="return js_general_solo_numeros(event)" maxlength="10">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="txtcelular"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_celular') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_celular') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtcelular" id="txtcelular" class="form-control" placeholder="<?= $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_celular') ?>" onKeyPress="return js_general_solo_numeros(event)" maxlength="15">
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div class="row row-validator">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="txtrfc"><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_rfc') ?><span data-toggle='tooltip' title='<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tooltip_rfc') ?>'><i class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txtrfc" id="txtrfc" class="form-control txt-mayus" placeholder="<?= $this->lang->line('usuarios_participantes_altas_controller_lang_placeholder_rfc') ?>" onKeyPress="return js_general_nit(event)" maxlength="25">
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div>
              <hr class="separador">
            </div>
            <div class="row" style="margin-top:20px; text-align:center;">
              <div class="col-lg-2 offset-lg-8 col-6">
                <button type="button" onclick="window.location.href='<?= funciones_strategix_version_url_random_base_url("UsuariosParticipantes") ?>'" class="btn btn-gray"><i class="far fa-caret-square-left pr-5"></i> <?= $this->lang->line('usuarios_participantes_altas_controller_lang_boton_regresar') ?></button>
              </div>
              <div class="col-lg-2 col-6">
                <button type="button" id="usuarios_participantes_altas_view_boton_guardar" class="btn btn-axalta"><i class="far fa-save pr-5"></i> <?= $this->lang->line('usuarios_participantes_altas_controller_lang_boton_guardar') ?></button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 no-cel" style=" margin-top: -20px; margin-bottom: -20px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; background: url(<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/usuarios/personal_tienda/" . $this->session->userdata(funciones_strategix_sitio_alias('s_segmento_id')) . "/bg-form.jpg") ?>)  center center / cover no-repeat;"></div>
      </div>
    </div>
  </section>
</form>
<script>
  $(document).ready(function() {
    /********************************************MSG ERROR******************************************************************************************/
    $('#frm_usuarios_participantes_altas_view input').on('keyup', function() {
      js_general_limpiar_errores(this);
    });
    $('#frm_usuarios_participantes_altas_view input').on('click', function() {
      js_general_limpiar_errores(this);
    });
    $('#frm_usuarios_participantes_altas_view select').on('click', function() {
      js_general_limpiar_errores(this);
    });
    $('#frm_usuarios_participantes_altas_view input').on('change', function() {
      js_general_limpiar_errores(this);
    });
    /**************************************************************************************************************************************/
    usuarios_participantes_altas_view_js_combo_pais();
    usuarios_participantes_altas_view_js_combo_perfil();
    <?php if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 8) {
      echo "usuarios_participantes_altas_view_js_combo_distribuidora();";
    } ?>

    $('#cmb_pais').change(function() {
      usuarios_participantes_altas_view_js_combo_distribuidora();
    });
    $("#usuarios_participantes_altas_view_boton_guardar").click(function() {
      usuarios_participantes_altas_view_js_guardar();
    });
  });

  function usuarios_participantes_altas_view_js_combo_pais() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_participantes/usuarios_participantes_altas/usuarios_participantes_altas_controller/usuarios_participantes_altas_controller_combo_lista_pais',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function(data) {
        $('#cmb_pais').html(data);
      },
      error: function(data) {
        console.log(data);
      },
      complete: function() {
        $('#loader_panel').hide();
      }
    });
  }

  function usuarios_participantes_altas_view_js_combo_distribuidora() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_participantes/usuarios_participantes_altas/usuarios_participantes_altas_controller/usuarios_participantes_altas_controller_combo_distribuidoras',
      dataType: 'json',
      data: {
        cmb_pais: $('#cmb_pais').val()
      },
      success: function(data) {
        $('#cmb_distribuidoras').html(data);
      },
      error: function(data) {
        console.log(data);
      },
      complete: function() {
        $('#loader_panel').hide();
      }
    });
  }

  function usuarios_participantes_altas_view_js_combo_perfil() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_participantes/usuarios_participantes_altas/usuarios_participantes_altas_controller/usuarios_participantes_altas_controllers_combo_perfil',
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

  function usuarios_participantes_altas_view_js_guardar() {
    var cmb_perfil = $('#cmb_perfil option:selected').text();
    var distribuidoras = $('#cmb_distribuidoras option:selected').text();
    var txtnombre = $('#txtnombre').val();
    var txtsegundonombre = $('#txtsegundonombre').val();
    var txtapellidopaterno = $('#txtapellidopaterno').val();
    var txtapellidomaterno = $('#txtapellidomaterno').val();
    var txtemail = $('#txtemail').val();
    var texttelefono = $('#texttelefono').val();
    var txtextencion = $('#txtextencion').val();
    var txtcelular = $('#txtcelular').val();
    var txtrfc = $('#txtrfc').val();
    var data = '<table class="table table-striped table-bordered" style="text-align:left; font-size:12px;"><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_etiqueta_perfil') ?></b></td><td>' + cmb_perfil + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_etiqueta_distribuidora') ?></b></td><td>' + distribuidoras + '</td></tr>';
    data = data + '<tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_nombre') ?></b></td><td>' + txtnombre + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_segundo_nombre') ?></b></td><td>' + txtsegundonombre + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_apellido_paterno') ?></b></td><td>' + txtapellidopaterno + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_apellido_materno') ?></b></td><td>' + txtapellidomaterno + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_email') ?></b></td><td>' + txtemail + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_telefono') ?></b></td><td>' + texttelefono + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_extencion') ?></b></td><td>' + txtextencion + '</td></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_celular') ?></b></td><td>' + txtcelular + '</td></tr></tr><tr><td class="txt-right"><b><?= $this->lang->line('usuarios_participantes_altas_controller_lang_input_rfc') ?></b></td><td>' + txtrfc + '</td></tr>';
    Swal.fire({
      title: '<?= $this->lang->line('usuarios_participantes_altas_controller_lang_js_confirm_titulo') ?>',
      html: data,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#fd7e14',
      cancelButtonColor: '#6c757d',
      confirmButtonText: '<?= $this->lang->line('usuarios_participantes_altas_controller_lang_js_confirm_boton_aprobado') ?>',
      cancelButtonText: '<?= $this->lang->line('usuarios_participantes_altas_controller_lang_js_confirm_boton_rechazado') ?>',
      allowOutsideClick: false
    }).then((confirma_guardado) => {
      if (confirma_guardado.isConfirmed) {
        $('#error').html(" ");
        $('#loader_panel').show();
        $.ajax({
          type: "POST",
          url: "<?php echo funciones_strategix_version_url_random_base_url("usuarios/usuarios_participantes/usuarios_participantes_altas/usuarios_participantes_altas_controller/usuarios_participantes_altas_controller_guarda") ?>",
          data: $("#frm_usuarios_participantes_altas_view").serialize(),
          dataType: "json",
          success: function(data) {
            switch (data) {
              case 0:
                Swal.fire({
                  icon: 'error',
                  title: '',
                  text: '<?= $this->lang->line('usuarios_participantes_altas_controller_lang_js_msg_participante_no_inserto') ?>'
                });
                $("#usuarios_participantes_altas_view_boton_guardar").attr('disabled', false);
                $('#loader_panel').hide();
                break;
              case 1:
                Swal.fire({
                  title: '',
                  html: '<?= $this->lang->line('usuarios_participantes_altas_controller_lang_js_msg_participante_inserto') ?>',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#fd7e14',
                  cancelButtonColor: '#6c757d',
                  confirmButtonText: '<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tabla_js_msg_swal_ok') ?>',
                  cancelButtonText: ''
                }).then((confirma_participante) => {
                  if (confirma_participante.isConfirmed) {
                    $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url("UsuariosParticipantes") ?>");
                    $('#loader_panel').hide();
                  }
                });
                break;
              case 4:
                Swal.fire({
                  title: '',
                  html: '<?= $this->lang->line('usuarios_participantes_altas_controller_lang_js_msg_participante_error_corroe') ?>',
                  icon: 'error',
                  showCancelButton: false,
                  confirmButtonColor: '#fd7e14',
                  cancelButtonColor: '#6c757d',
                  confirmButtonText: '<?= $this->lang->line('usuarios_participantes_altas_controller_lang_tabla_js_msg_swal_ok') ?>',
                  cancelButtonText: ''
                }).then((confirma_participante) => {
                  if (confirma_participante.isConfirmed) {
                    $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url("UsuariosParticipantes") ?>");
                    $('#loader_panel').hide();
                  }
                });
                break;
              case 5:
                Swal.fire({
                  icon: 'error',
                  title: '',
                  text: '<?= $this->lang->line('usuarios_participantes_altas_controller_lang_js_msg_limite_participante') ?>'
                });
                $('#loader_panel').hide();
                break;
              default:
                $.each(data, function(key, value) {
                  $('#' + key).addClass('is-invalid');
                  $('#' + key).parents('.form-group').find('#error').html(value);
                });
                $('#loader_panel').hide();
                break;
            }
          },
          error: function(data) {
            console.log(data);
          },
          complete: function() {
            $('#loader_panel').hide();
          }
        });
        return 1;
      } else {
        return 0;
      }
    });
  }
</script>