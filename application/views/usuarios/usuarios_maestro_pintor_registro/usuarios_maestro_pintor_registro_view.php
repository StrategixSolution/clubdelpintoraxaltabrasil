<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>
<script src="<?= funciones_strategix_version_url_random_base_url("vendors/signature/signature_pad.umd.js") ?>"
  type="text/javascript"></script>
<link href="<?= funciones_strategix_version_url_random_base_url("vendors/signature/signature-pad.css") ?>"
  rel="stylesheet" type="text/css" />

<form id="frm_usuarios_maestro_pintor_registro_view" role="form" method="post" accept-charset="utf-8">
  <section id="registroMaestroPintor">
<div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_pagina_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
      <div class="row panel-white panel-white-alt">
        <div class="col-lg-9">
          <div class="form-pr">
            <div class="row row-validator">
              <div class="dyncol col-lg-3">
                <div class="form-group">
                  <label
                    for="txt_nombre"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_nombre') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_nombre') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_nombre" id="txt_nombre" class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_nombre') ?>"
                    onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-3" id="div_segundo_nombre">
                <div class="form-group">
                  <label
                    for="txt_segundo_nombre"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_segundo_nombre') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_segundo_nombre') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_segundo_nombre" id="txt_segundo_nombre" class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_segundo_nombre') ?>"
                    onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-3">
                <div class="form-group">
                  <label
                    for="txt_apellido_paterno"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_apaterno') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_apaterno') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_apellido_paterno" id="txt_apellido_paterno"
                    class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_apaterno') ?>"
                    onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-3">
                <div class="form-group">
                  <label
                    for="txt_apellido_materno"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_amaterno') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_amaterno') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_apellido_materno" id="txt_apellido_materno"
                    class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_amaterno') ?>"
                    onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="50">
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div class="row row-validator">
              <div class="dyncol col-lg-4">
                <div class="form-group">
                  <label
                    for="txt_rfc"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_rfc') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_rfc') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_rfc" id="txt_rfc" class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_rfc') ?>"
                    onKeyPress="return js_general_nit(event)" maxlength="25">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-4">
                <div class="form-group">
                  <label
                    for="txt_telefono"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_telefono') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_telefono') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_telefono" id="txt_telefono" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_telefono') ?>"
                    maxlength="20">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-4">
                <div class="form-group">
                  <label
                    for="txt_extencion"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_extencion') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_extencion') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_extencion" id="txt_extencion" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_extencion') ?>"
                    onKeyPress="return js_general_solo_numeros(event)" maxlength="10">
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div class="row row-validator">
              <div class="dyncol col-lg-8">
                <div class="form-group">
                  <label
                    for="txt_email"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_email') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_email') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_email" id="txt_email" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_email') ?>"
                    maxlength="100">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-4">
                <div class="form-group">
                  <label
                    for="txt_celular"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_celular') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_celular') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_celular" id="txt_celular" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_celular') ?>"
                    onKeyPress="return js_general_solo_numeros(event)" maxlength="15">
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div class="row row-validator">
              <div class="col-lg-3">
                <div><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_enviar_por') ?></div>
              </div>
              <div class="col-lg-3">
                <div class="form-check mt-0">
                  <input type="checkbox" id="usuarios_registro_maestro_pintor_view_chk_email"
                    name="usuarios_registro_maestro_pintor_view_chk_email" value="1" class="form-check-input">
                  <label for="" class="form-check-label"> <?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_enviar_por_mail') ?></label>
                </div>
              </div>
             <!-- <div class="col-lg-3">
                <div class="form-check mt-0">
                  <input type="checkbox" id="usuarios_registro_maestro_pintor_view_chk_whatsapp"
                    name="usuarios_registro_maestro_pintor_view_chk_whatsapp" value="1" class="form-check-input">
                  <label for="chk_archivo" class="form-check-label"> WHATSAPP</label><br>
                </div>
              </div>-->
            </div>
            <div>
              <hr class="separador" style="margin-top: 0; margin-bottom: 2rem">
            </div>
            <div class="row row-validator">
              <div class="col-lg-3">
                <div class="form-group">
                  <label
                    for="cmb_talla"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_talla') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_talla') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <select id="cmb_talla" name="cmb_talla" class="form-select"></select>
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-3">
                <div class="form-group">
                  <label
                    for="txt_ciudad"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_ciudad') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_ciudad') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_ciudad" id="txt_ciudad" class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_ciudad') ?>"
                    onKeyPress="return js_general_solo_texto(event,this)" maxlength="100">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label
                    for="fecha_nacimiento"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_fecha_nacimiento') ?><span
                      data-toggle="tooltip"
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_fecha_nacimiento') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control">
                  <div id="error"></div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label
                    for="cmb_puesto"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_puesto') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_puesto') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <select id="cmb_puesto" name="cmb_puesto" class="form-select"></select>
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div class="row row-validator" style="align-items: baseline;">
              <div class="dyncol col-lg-4">
                <div class="form-group">
                  <label
                    for="txt_taller"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_taller') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_taller') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_taller" id="txt_taller" class="form-control txt-mayus"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_taller') ?>"
                    onKeyPress="return js_general_solo_texto_espacios(event,this)" maxlength="100">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-4">
                <div class="form-group">
                  <label
                    for="txt_cantidad_personas"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_aprox_personas') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_aprox_personas') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_cantidad_personas" id="txt_cantidad_personas" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_aprox_personas') ?>"
                    onKeyPress="return js_general_solo_numeros(event)" maxlength="3">
                  <div id="error"></div>
                </div>
              </div>
              <div class="dyncol col-lg-4">
                <div class="form-group">
                  <label
                    for="txt_cantidad_autos"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_aprox_autos') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_aprox_autos') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_cantidad_autos" id="txt_cantidad_autos" class="form-control"
                    placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_aprox_autos') ?>"
                    onKeyPress="return js_general_solo_numeros(event)" maxlength="3">
                  <div id="error"></div>
                </div>
              </div>
            </div>
            <div>
              <hr class="separador">
            </div>
            <div class="row mt-5">
              <div class="col-lg-5">
                <div class="row row-validator">
                  <div class="col-lg-12 align-self-center">
                    <div>
                      <?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_frase_identificacion') ?>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-check">
                      <input type="checkbox" id="chk_camara" name="chk_camara" class="form-check-input" value="1">
                      <label for="chk_camara" class="form-check-label">
                        <?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_camara') ?></label>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-check">
                      <input type="checkbox" id="chk_archivo" name="chk_archivo" class="form-check-input" value="1">
                      <label for="chk_archivo" class="form-check-label">
                        <?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_archivo') ?></label><br>
                    </div>
                  </div>
                </div>
                <div class="row row-validator">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label
                        for="txt_qr"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_codigoqr') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_codigoqr') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <div class="input-group">
                        <input type="text" name="txt_qr" id="txt_qr" class="form-control"
                          onKeyPress="return js_general_solo_numeros(event)"
                          placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_codigoqr') ?>">
                        <button type="button" id="btn_usuarios_registro_maestro_pintor_qr"
                          class="btn btn-axalta-sm"><span class="iconify" data-icon="bi:qr-code"></span></button>
                      </div>
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-12" id="div_identificacion_camara">
                    <div class="form-group">
                      <label
                        for="txt_identificacion"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_identificacion') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_identificacion') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <div class="input-group">
                        <input type="text" name="txt_identificacion" id="txt_identificacion" class="form-control"
                          placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_identificacion') ?>"
                          disabled>
                        <button type="button" id="btn_registro_maestro_pintor_modal_identificacion"
                          class="btn btn-axalta-sm"><span class="iconify" data-icon="ic:baseline-photo-camera"></span>
                        </button>
                      </div>
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-12" id="div_identificacion_file" style="display: none;">
                    <div class="form-group">
                      <label
                        for="file_identificacion"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_identificacion') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_tooltips_identificacion') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="file" name="file_identificacion" id="file_identificacion" class="form-control"
                        placeholder="<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_placeholder_identificacion') ?>"
                        disabled>
                      <div id="error"></div>
                    </div>
                    <input id="ext_file_identificacion" name="ext_file_identificacion" type="hidden" value="">
                  </div>
                </div>
              </div>

              <div class="col-lg-7" id="firma">
                <div class="">
                  <div class="row justify-content-center">
                    <div class="col-lg-12 txt-center">
                      <div>
                        <b><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_firma') ?></b>
                      </div>
                    </div>
                  </div>
                  <div class="row firma-txt">
                    <div class="col-lg-6">
                      <?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_frase_duenio') ?>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="chk_terminos" name="chk_terminos" value="1">
                        <label class="form-check-label" id="btn_registro_maestro_pintor_modal_terminos"
                          for="chk_terminos"><a id="modLink"
                            href="#"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_acepto_terminos') ?>
                            <?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_acepto_aviso') ?></a></label>
                        <!-- <label class="form-check-label" for="chk_terminos"><a id="btn_registro_maestro_pintor_modal_terminos"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_acepto_terminos') ?> <?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_acepto_aviso') ?></a></label> -->
                      </div>
                      <div id="error"></div>
                    </div>
                  </div>

                  <div id="signature-pad" class="signature-pad" style="margin-bottom: 25px;">
                    <div class="signature-pad--body">
                      <canvas></canvas>
                    </div>
                    <div class="signature-pad--footer">
                      <div class="signature-pad--actions justify-content-center">
                        <div class="col-lg-2 col-6">
                          <button type="button" class="btn btn-gray"
                            id="usuarios_registro_maestro_pintor_view_boton_firma_borrar"><?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_btn_limpiar') ?></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div>
              <hr class="separador">
            </div>
            <div class="elemento-alineado-der">
              <div class="col-lg-2">
                <button type="submit" id="usuarios_registro_maestro_pintor_view_boton_buscar" class="btn btn-axalta"><i
                    class="far fa-save"></i>
                  <?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_etiqueta_btn_guardar') ?></button>
              </div>
            </div>
          </div>


        </div>
        <div class="col-lg-3 no-cel"
          style=" margin-top: -20px; margin-bottom: -20px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; background: url(<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/usuarios/registro_mp/bg-form.jpg") ?>)  center center / cover no-repeat;">
        </div>
      </div>
    </div>
  </section>
</form>
<script>
  document.getElementById('modLink').addEventListener('click', function (e) {
    e.preventDefault();
  });
  $(document).ready(function () {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear() - 15;
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("fecha_nacimiento").setAttribute("max", today);
    $('#usuarios_registro_maestro_pintor_view_chk_email').prop('checked', true);
    $('#chk_camara').prop('checked', true);
    /**************************************************************************************************************************************/
    $('#usuarios_registro_maestro_pintor_view_chk_email').on('change', function () {
      if ($('#usuarios_registro_maestro_pintor_view_chk_email').prop('checked', true)) {
        $('#usuarios_registro_maestro_pintor_view_chk_whatsapp').prop('checked', false).removeAttr('checked');
      }
    });
    $('#usuarios_registro_maestro_pintor_view_chk_whatsapp').on('change', function () {
      if ($('#usuarios_registro_maestro_pintor_view_chk_whatsapp').prop('checked', true)) {
        $('#usuarios_registro_maestro_pintor_view_chk_email').prop('checked', false).removeAttr('checked');
      }
    });
    /********************************************MSG ERROR******************************************************************************************/
    $('#frm_usuarios_maestro_pintor_registro_view input').on('keyup', function () {
      js_general_limpiar_errores(this);
    });
    $('#frm_usuarios_maestro_pintor_registro_view input').on('click', function () {
      js_general_limpiar_errores(this);
    });
    $('#frm_usuarios_maestro_pintor_registro_view select').on('click', function () {
      js_general_limpiar_errores(this);
    });
    $('#frm_usuarios_maestro_pintor_registro_view input').on('change', function () {
      js_general_limpiar_errores(this);
    });
    /**************************************************************************************************************************************/
    js_general_valida_uploads_archivos('file_identificacion', ['png', 'jpg', 'jpeg','pdf'], '<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_error_tamanio_identificacion') ?>', '<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_error_formato_identificacion') ?>');
    $('#file_identificacion').on('change', function () {
      var ext = this.value.split('.').pop();
      $("#ext_file_identificacion").val(ext);
    });
    frm_usuarios_maestro_pintor_registro_view_js_combo_puesto();
    //frm_usuarios_maestro_pintor_registro_view_js_combo_compania();
    frm_usuarios_maestro_pintor_registro_view_js_combo_talla();
    $('#chk_camara').on('change', function () {
      if ($('#chk_camara').prop('checked', true)) {
        $('#chk_archivo').prop('checked', false).removeAttr('checked').val('0');
        $('#btn_registro_maestro_pintor_modal_identificacion').prop('disabled', false);
        $('#file_identificacion').prop('disabled', true);
        $('#file_identificacion').val('');
        $('#chk_camara').val('1');
        $('#txt_identificacion').removeClass('is-invalid').addClass('');
        $('#txt_identificacion').parents('.form-group').find('#error').html(" ");
        $('#file_identificacion').removeClass('is-invalid').addClass('');
        $('#file_identificacion').parents('.form-group').find('#error').html(" ");
        $('#div_identificacion_camara').show(300);
        $('#div_identificacion_file').hide(300);
      }
    });
    $('#chk_archivo').on('change', function () {
      if ($('#chk_archivo').prop('checked', true)) {
        $('#chk_camara').prop('checked', false).removeAttr('checked').val('0');
        $('#file_identificacion').prop('disabled', false);
        $('#btn_registro_maestro_pintor_modal_identificacion').prop('disabled', true);
        $('#txt_identificacion').val('',);
        $('#btn_registro_maestro_pintor_modal_identificacion').val('');
        $('#chk_archivo').val('1')
        $('#txt_identificacion').removeClass('is-invalid').addClass('');
        $('#txt_identificacion').parents('.form-group').find('#error').html(" ");
        $('#file_identificacion').removeClass('is-invalid').addClass('');
        $('#file_identificacion').parents('.form-group').find('#error').html(" ");
        $('#div_identificacion_camara').hide(300);
        $('#div_identificacion_file').show(300);
      }
    });
    $("#btn_usuarios_registro_maestro_pintor_qr").click(function () {
      frm_usuarios_maestro_pintor_registro_view_js_modal_qr();
    });
    $("#btn_registro_maestro_pintor_modal_identificacion").click(function () {
      $('#txt_identificacion').removeClass('is-invalid').addClass('');
      $('#txt_identificacion').parents('.form-group').find('#error').html(" ");
      frm_usuarios_maestro_pintor_registro_view_js_modal_id();
    });
    $("#btn_registro_maestro_pintor_modal_aviso").click(function () {
      frm_usuarios_maestro_pintor_registro_view_js_modal_avisoprivacidad();
    });
    $("#btn_registro_maestro_pintor_modal_terminos").click(function () {
      frm_usuarios_maestro_pintor_registro_view_js_modal_terminos();
    });
    $("#usuarios_registro_maestro_pintor_view_boton_firma_borrar").click(function () {
      frm_usuarios_maestro_pintor_registro_view_js_firma_borrar();
    });
    $('#frm_usuarios_maestro_pintor_registro_view').submit(function (e) {
      $('#loader_panel').show();
      e.preventDefault();
      $('#error').html(" ");
      $('#txt_identificacion').prop('disabled', false);
      if (signaturePad.isEmpty()) {
        Swal.fire({
          icon: 'error',
          title: '',
          text: '<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_alerta_firma_vacia') ?>'
        });
        $('#loader_panel').hide();
      } else {
        if (frm_usuarios_maestro_pintor_registro_view_js_valida_form_firma()) {
          $.ajax({
            url: 'usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_guarda',
            type: "post",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: 'json',
            success: function (data) {
              switch (data.estatus) {
                case 1:
                  var dataURL = signaturePad.toDataURL();
                  var xhr = new XMLHttpRequest();
                  xhr.open("POST", "usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_ajax_firma", true);
                  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhr.send(encodeURIComponent(dataURL));
                  xhr.onreadystatechange = function () {
                    var datoJSON = JSON.stringify(xhr.responseText);
                    console.log(datoJSON);
                    if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                      signaturePad.clear();
                      Swal.fire({
                        title: '',
                        html: '<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_maestro_pintor_registrado') ?>',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#fd7e14',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'OK',
                        cancelButtonText: ''
                      }).then((confirma_maestro_pintor) => {
                        if (confirma_maestro_pintor.isConfirmed) {
                          var href = '$(location).attr("href","<?php echo funciones_strategix_version_url_random_base_url("Registromaestropintorinterno") ?>")';
                          setTimeout(href, 300);
                        }
                      });
                    }
                  }
                  break;
                case 2:
                  Swal.fire({
                    title: '',
                    html: '<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_error_envio_correo') ?>',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#fd7e14',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'OK',
                    cancelButtonText: ''
                  }).then((validacionaltaparticipante) => {
                    if (validacionaltaparticipante.isConfirmed) {
                      var href = '$(location).attr("href","<?php echo funciones_strategix_version_url_random_base_url("Registromaestropintorinterno") ?>")';
                      setTimeout(href, 300);
                    }
                  });
                  break;
                case 3:
                  Swal.fire({
                    title: '',
                    html: '<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_msg_error_archivo_identificacion') ?>',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#fd7e14',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'OK',
                    cancelButtonText: ''
                  }).then((validacionaltaparticipante) => {
                    if (validacionaltaparticipante.isConfirmed) {
                      var href = '$(location).attr("href","<?php echo funciones_strategix_version_url_random_base_url("Registromaestropintorinterno") ?>")';
                      setTimeout(href, 300);
                    }
                  });
                  break;
                default:
                  $('#error').html(" ");
                  $.each(data, function (key, value) {
                    $('#' + key).addClass('is-invalid');
                    $('#' + key).parents('.form-group').find('#error').html(value);
                  });
                  break;
              }
            },
            error: function () { },
            complete: function () {
              $('#loader_panel').hide();
            }
          });
        }
        $('#txt_identificacion').prop('disabled', true);
      }
      $('#loader_panel').hide();
    });
  });
  var wrapper = document.getElementById("signature-pad");
  var canvas = wrapper.querySelector("canvas");
  var signaturePad = new SignaturePad(canvas, {});

  function frm_usuarios_maestro_pintor_registro_view_js_combo_puesto() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_combo_puesto',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#cmb_puesto').html(data);
      },
      error: function (data) { },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }

  /*function frm_usuarios_maestro_pintor_registro_view_js_combo_compania() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_combo_compania',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#cmb_compania').html(data);
      },
      error: function (data) { },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }*/

  function frm_usuarios_maestro_pintor_registro_view_js_combo_talla() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_combo_talla',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#cmb_talla').html(data);
      },
      error: function (data) { },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }

  function resizeCanvas() {
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    signaturePad.clear();
  }
  window.onresize = resizeCanvas;
  resizeCanvas();

  function frm_usuarios_maestro_pintor_registro_view_js_firma_borrar() {
    signaturePad.clear();
  }

  function frm_usuarios_maestro_pintor_registro_view_js_modal_terminos() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_modal_terminos_y_condiciones',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#myModal').html(data).modal('show');
      },
      error: function (data) { },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }

  function frm_usuarios_maestro_pintor_registro_view_js_modal_avisoprivacidad() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_modal_aviso_privacidad',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#myModal').html(data).modal('show');
      },
      error: function (data) { },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }

  function frm_usuarios_maestro_pintor_registro_view_js_modal_id() {
    $('#loader_panel').show();
    switch (js_general_sistema_operativo()) {
      case "iOS":
        var modal = 1;
        break;
      default:
        var modal = 2;
        break;
    }
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_modal_identificacion',
      dataType: 'json',
      data: {
        modal: modal
      },
      success: function (data) {
        $('#myModal').html(data).modal('show');
      },
      error: function (data) {
        console.log(data)
      },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }

  function frm_usuarios_maestro_pintor_registro_view_js_modal_qr() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_modal_qr',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#myModal').html(data).modal('show');
      },
      error: function (data) { },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }

  function frm_usuarios_maestro_pintor_registro_view_js_valida_form_firma() {
    if (!$('#chk_terminos').prop('checked')) {
      Swal.fire({
        icon: 'error',
        title: '',
        text: '<?= $this->lang->line('usuarios_maestro_pintor_registro_controller_lang_alerta_termino') ?>'
      });
      $('#chk_terminos').focus();
      return false
    }
    return true;
  }
</script>