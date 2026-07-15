<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form id="frm_distribuidores_modificacion" role="form" method="post" accept-charset="utf-8">
  <div class="panel-title">
    <input id="DistribuidorId" name="DistribuidorId" type="hidden" value="<?= $DistribuidorId ?>">
    <section id="editar_distribuidores">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2><?= $this->lang->line('distribuidores_modificacion_controller_lang_titulo') ?></h2>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row panel-white">
          <div class="col-lg-12">
            <div class="form-rf-1 form-pr" id="form-rf-1">
              <div class="form-rf-1" id="form-rf-1">
                <div class="row row-validator">
                  <div class="dyncol col-lg-6">
                    <div class="form-group">
                      <label
                        for="txt_razon_social"><?= $this->lang->line('distribuidores_alta_controller_lang_input_razon_social') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_razon_social') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_razon_social" id="txt_razon_social" class="form-control txt-mayus"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_razon_social') ?>"
                        maxlength="128">
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12" id="div_nombre_comercial">
                    <div class="form-group">
                      <label
                        for="txt_nombre_comercial"><?= $this->lang->line('distribuidores_alta_controller_lang_input_nombre_comercial') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_nombre_comercial') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_nombre_comercial" id="txt_nombre_comercial"
                        class="form-control txt-mayus"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_nombre_comercial') ?>"
                        maxlength="128">
                      <div id="error"></div>
                    </div>
                  </div>
                </div>
                <div class="row row-validator">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="txt_codigo_distribuidor"><?= $this->lang->line('distribuidores_alta_controller_lang_input_codigo_distribuidor') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_codigo_distribuidor') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_codigo_distribuidor" id="txt_codigo_distribuidor"
                        class="form-control"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_codigo_distribuidor') ?>"
                        onKeyPress="return js_general_solo_numeros(event)" maxlength="8">
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="cmb_agrupamiento"><?= $this->lang->line('distribuidores_alta_controller_lang_input_codigo_agrupamiento') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_combo_tooltip_agrupamiento') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <select id="cmb_agrupamiento" name="cmb_agrupamiento" class="form-select"></select>
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="txt_registro_federal"><?= $this->lang->line('distribuidores_alta_controller_lang_input_registro_federal') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_registro_federal') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_registro_federal" id="txt_registro_federal" class="form-control"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_registro_federal') ?>"
                        onKeyPress="return js_general_solo_numeros(event)" maxlength="14">
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="txt_inscripcion_estatal"><?= $this->lang->line('distribuidores_alta_controller_lang_input_inscripcion_estatal') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_inscripcion_estatal') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_inscripcion_estatal" id="txt_inscripcion_estatal"
                        class="form-control"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_inscripcion_estatal') ?>"
                        onKeyPress="return js_general_solo_numeros(event)" maxlength="14">
                      <div id="error"></div>
                    </div>
                  </div>
                </div>
                <div class="row row-validator">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="cmb_unidad_federativa"><?= $this->lang->line('distribuidores_alta_controller_lang_input_unidad_federativa') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_unidad_federativa') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <select id="cmb_unidad_federativa" name="cmb_unidad_federativa" class="form-select"></select>
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="txt_ciudad"><?= $this->lang->line('distribuidores_alta_controller_lang_input_ciudad') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_ciudad') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_ciudad" id="txt_ciudad" class="form-control txt-mayus"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_ciudad') ?>"
                        maxlength="128">
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="txt_barrio"><?= $this->lang->line('distribuidores_alta_controller_lang_input_barrio') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_barrio') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_barrio" id="txt_barrio" class="form-control txt-mayus"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_barrio') ?>"
                        maxlength="128">
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="txt_direccion"><?= $this->lang->line('distribuidores_alta_controller_lang_input_direccion') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_direccion') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_direccion" id="txt_direccion" class="form-control txt-mayus"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_direccion') ?>"
                        maxlength="128">
                      <div id="error"></div>
                    </div>
                  </div>
                </div>
                <div class="row row-validator">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="txt_codigo_postal"><?= $this->lang->line('distribuidores_alta_controller_lang_input_codigo_postal') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_codigo_postal') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_codigo_postal" id="txt_codigo_postal" class="form-control txt-mayus"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_codigo_postal') ?>"
                        onKeyPress="return js_general_cep(event)" maxlength="9">
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="txt_telefono"><?= $this->lang->line('distribuidores_alta_controller_lang_input_telefono') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_tooltip_telefono') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <input type="text" name="txt_telefono" id="txt_telefono" class="form-control txt-mayus"
                        placeholder="<?= $this->lang->line('distribuidores_alta_controller_lang_placeholder_telefono') ?>"
                        onKeyPress="return js_general_solo_numeros(event)" maxlength="11">
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-3" id="div_distribuidoras">
                    <div class="form-group">
                      <label
                        for="cmb_regiones"><?= $this->lang->line('distribuidores_alta_controller_lang_combo_etiqueta_regiones') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_combo_tooltip_regiones') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <select id="cmb_regiones" name="cmb_regiones" class="form-select"></select>
                      <div id="error"></div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label
                        for="cmb_oficinas_ventas"><?= $this->lang->line('distribuidores_alta_controller_lang_combo_etiqueta_oficinas_venta') ?><span
                          data-toggle='tooltip'
                          title='<?= $this->lang->line('distribuidores_alta_controller_lang_combo_tooltip_oficinas_venta') ?>'><i
                            class="fas fa-question-circle"></i></span></label>
                      <select id="cmb_oficinas_ventas" name="cmb_oficinas_ventas" class="form-select"></select>
                      <div id="error"></div>
                    </div>
                  </div>
                </div>
                <div>
                  <hr class="separador">
                </div>
                <div class="row justify-content-end" style="margin-top:20px; text-align:center;">
                  <div class="col-lg-2 col-12">
                    <button type="button"
                      onclick="window.location.href='<?= funciones_strategix_version_url_random_base_url("Distribuidores") ?>'"
                      class="btn btn-gray btn-buscar-ancho"><i class="far fa-caret-square-left pr-5"></i><span
                        class="btn-buscar-texto"><?= $this->lang->line('distribuidores_alta_controller_lang_boton_regresar') ?></span>
                    </button>
                  </div>
                  <div class="col-lg-2 col-12">
                    <button type="button" id="distribuidores_modificacion_boton_guardar"
                      class="btn btn-axalta btn-buscar-ancho"><i class="far fa-save"></i><span
                        class="btn-buscar-texto"><?= $this->lang->line('distribuidores_modificacion_controller_lang_boton_guardar') ?></span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</form>
<script>
  $(document).ready(function () {
    /********************************************MSG ERROR******************************************************************************************/
    $('#frm_distribuidores_modificacion input').on('keyup', function () {
      js_general_limpiar_errores(this);
    });
    $('#frm_distribuidores_modificacion input').on('click', function () {
      js_general_limpiar_errores(this);
    });
    $('#frm_distribuidores_modificacion select').on('click', function () {
      js_general_limpiar_errores(this);
    });
    $('#frm_distribuidores_modificacion input').on('change', function () {
      js_general_limpiar_errores(this);
    });
    /**************************************************************************************************************************************/
    distribuidores_modificacion_view_js_combo_region();
    distribuidores_modificacion_view_js_combo_oficinas_venta();
    distribuidores_alta_view_js_combo_agrupamiento();
    distribuidores_alta_view_js_combo_unidad_federativa();
    //distribuidores_modificacion_view_js_datos();
    $("#distribuidores_modificacion_boton_guardar").click(function () {
      distribuidores_modificacion_view_js_guardar();
    });
  });

  function distribuidores_modificacion_view_js_datos() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'distribuidores/distribuidores_modificacion/distribuidores_modificacion_controller/distribuidores_modificacion_controller_datos',
      dataType: 'json',
      data: $("#frm_distribuidores_modificacion").serialize(),
      success: function (data) {
        $("#txt_razon_social").val(data.DistribuidorDetalleRazonSocial);
        $("#txt_nombre_comercial").val(data.DistribuidorDetalleNombreComercial);
        $("#txt_codigo_distribuidor").val(data.DistribuidorDetalleCodigo);
        $("#cmb_agrupamiento").val(data.DistribuidorDetalleAgrupamientosId);
        $("#txt_registro_federal").val(data.DistribuidorDetalleRegistroFederal);
        $("#txt_inscripcion_estatal").val(data.DistribuidorDetalleInscripcionEstatal);
        $("#cmb_unidad_federativa").val(data.DistribuidorDetalleUnidadFederativa);
        $("#txt_ciudad").val(data.DistribuidorDetalleCiudad);
        $("#txt_barrio").val(data.DistribuidorDetalleBarrio);
        $("#txt_direccion").val(data.DistribuidorDetalleDireccion);
        $("#txt_codigo_postal").val(data.DistribuidorDetalleCEP);
        $("#txt_telefono").val(data.DistribuidorDetalleTelefono);
        $("#cmb_regiones").val(data.DistribuidorDetalleRegionId);
        $("#cmb_oficinas_ventas").val(data.DistribuidorDetalleOficinasVentasId);
        setTimeout('$("#loader_panel").hide();', 5000);
      },
      error: function (data) { },
      complete: function () { $('#loader_panel').hide(); }
    });
  }

  function distribuidores_modificacion_view_js_combo_region() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'distribuidores/distribuidores_modificacion/distribuidores_modificacion_controller/distribuidores_modificacion_controller_combo_lista_regiones',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#cmb_regiones').html(data);
      },
      error: function (data) { },
      complete: function () { }
    });
  }

  function distribuidores_modificacion_view_js_combo_oficinas_venta() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'distribuidores/distribuidores_alta/distribuidores_alta_controller/distribuidores_alta_controller_combo_lista_oficinas_venta',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#cmb_oficinas_ventas').html(data);
      },
      error: function (data) { },
      complete: function () { }
    });
  }

  function distribuidores_alta_view_js_combo_agrupamiento() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'distribuidores/distribuidores_alta/distribuidores_alta_controller/distribuidores_alta_controller_combo_lista_agrupamiento',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#cmb_agrupamiento').html(data);
      },
      error: function (data) { },
      complete: function () { }
    });
  }

  function distribuidores_alta_view_js_combo_unidad_federativa() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'distribuidores/distribuidores_alta/distribuidores_alta_controller/distribuidores_alta_controller_combo_lista_unidad_federativa',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#cmb_unidad_federativa').html(data);
      },
      error: function (data) { },
      complete: function () { distribuidores_modificacion_view_js_datos(); }
    });
  }

  function distribuidores_modificacion_view_js_guardar() {
    $('#error').html(" ");
    var txt_razon_social = $('#txt_razon_social').val();
    var txt_nombre_comercial = $('#txt_nombre_comercial').val();
    var txt_codigo_distribuidor = $('#txt_codigo_distribuidor').val();
    var cmb_agrupamiento = $('#cmb_agrupamiento option:selected').text();
    var txt_registro_federal = $('#txt_registro_federal').val();
    var txt_inscripcion_estatal = $('#txt_inscripcion_estatal').val();
    var cmb_unidad_federativa = $('#cmb_unidad_federativa option:selected').text();
    var txt_ciudad = $('#txt_ciudad').val();
    var txt_barrio = $('#txt_barrio').val();
    var txt_direccion = $('#txt_direccion').val();
    var txt_codigo_postal = $('#txt_codigo_postal').val();
    var txt_telefono = $('#txt_telefono').val();
    var cmb_regiones = $('#cmb_regiones option:selected').text();
    var cmb_oficinas_ventas = $('#cmb_oficinas_ventas option:selected').text();
    var data = '<table class="table table-striped table-bordered" style="text-align:left; font-size:12px;">' +
    '<tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_razon_social') ?></b></td><td>' + txt_razon_social + '</td></tr>' +
    '<tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_nombre_comercial') ?></b></td><td>' + txt_nombre_comercial + '</td></tr>' +
    '<tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_codigo_distribuidor') ?></b></td><td>' + txt_codigo_distribuidor + '</td></tr>' +
    '<tr><td><b><?= $this->lang->line('distribuidores_alta_controller_lang_input_registro_federal') ?></b></td><td>' + txt_registro_federal + '</td></tr>' +
    '<tr><td><b><?= $this->lang->line('distribuidores_alta_controller_lang_input_inscripcion_estatal') ?></b></td><td>' + txt_inscripcion_estatal + '</td></tr>' +
    '<tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_input_ciudad') ?></b></td><td>' + txt_ciudad + '</td></tr>' +
    '<tr><td><b><?= $this->lang->line('distribuidores_alta_controller_lang_input_barrio') ?></b></td><td>' + txt_barrio + '</td></tr>' +
    '<tr><td><b><?= $this->lang->line('distribuidores_alta_controller_lang_input_direccion') ?></b></td><td>' + txt_direccion + '</td></tr>' +
    '<tr><td><b><?= $this->lang->line('distribuidores_alta_controller_lang_input_codigo_postal') ?></b></td><td>' + txt_codigo_postal + '</td></tr>' +
    '<tr><td><b><?= $this->lang->line('distribuidores_alta_controller_lang_input_telefono') ?></b></td><td>' + txt_telefono + '</td></tr>';
    if (cmb_agrupamiento === undefined || cmb_agrupamiento == "") { } else {
      data = data + '<tr><td><b><?= $this->lang->line('distribuidores_alta_controller_lang_input_codigo_agrupamiento') ?></b></td><td>' + cmb_agrupamiento + '</td></tr>';
    };
    if (cmb_unidad_federativa === undefined || cmb_unidad_federativa == "") { } else {
      data = data + '<tr><td><b><?= $this->lang->line('distribuidores_alta_controller_lang_input_unidad_federativa') ?></b></td><td>' + cmb_unidad_federativa + '</td></tr>';
    };
    if (cmb_regiones === undefined || cmb_regiones == "") { } else {
      data = data + '<tr><td><b><?= $this->lang->line('distribuidores_modificacion_controller_lang_combo_etiqueta_regiones') ?></b></td><td>' + cmb_regiones + '</td></tr>';
    };
    if (cmb_oficinas_ventas === undefined || cmb_oficinas_ventas == "") { } else {
      data = data + '<tr><td><b><?= $this->lang->line('distribuidores_alta_controller_lang_combo_etiqueta_oficinas_venta') ?></b></td><td>' + cmb_oficinas_ventas + '</td></tr>';
    };
    data = data + '</table>';
    Swal.fire({
      title: '<?= $this->lang->line('participantes_altas_js_confirm_titulo') ?>',
      html: data,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#fd7e14',
      cancelButtonColor: '#6c757d',
      confirmButtonText: '<?= $this->lang->line('distribuidores_modificacion_controller_lang_confirm_boton_aprobado') ?>',
      cancelButtonText: '<?= $this->lang->line('distribuidores_modificacion_controller_lang_confirm_boton_rechazado') ?>',
      allowOutsideClick: false
    }).then((valida_form_distribuidores) => {
      if (valida_form_distribuidores.isConfirmed) {
        $('#loader_panel').show();
        $.ajax({
          type: "POST",
          url: "<?php echo funciones_strategix_version_url_random_base_url("distribuidores/distribuidores_modificacion/distribuidores_modificacion_controller/distribuidores_modificacion_controller_valida_guarda_distribuidor") ?>",
          data: $("#frm_distribuidores_modificacion").serialize(),
          dataType: "json",
          success: function (data) {
            switch (data.res) {
              case 1:
                Swal.fire({
                  title: '',
                  html: '<?= $this->lang->line('distribuidores_modificacion_controller_lang_guardado_js_msg_swal_texto') ?>',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#fd7e14',
                  cancelButtonColor: '#6c757d',
                  confirmButtonText: '<?= $this->lang->line('distribuidores_modificacion_controller_lang_confirm_boton_aprobado') ?>',
                }).then((validacionaltaparticipante) => {
                  $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url("Distribuidores") ?>");
                });
                break;
              case 2:
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
          },
          complete: function () {
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