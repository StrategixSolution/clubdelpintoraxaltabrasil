<?php

/* 
 * Sistema Web Responsivo CDPMEX                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<form id="frm_ventas_auditoria_rechazados_actualiza_view" role="form" method="post" accept-charset="utf-8">
  <input type="hidden" id="VentasId" name="VentasId" value="<?= $VentasId ?>">
  <section class="auditoria_ventas">
    <div class="panel-title">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_pagina_titulo_actualiza') ?></h2>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="panel-white">
        <div class="form-rf-1" id="form-rf-1">
          <div class="row row-validator">
            <div class="col-sm-4 align-self-center">
              <div><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_etiqueta_etiqueta_msg_ticket') ?>
              </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
              <div class="form-check form-check-inline">
                <input type="checkbox" id="chk_camara" name="chk_camara" value="1">
                <label for="chk_camara">
                  <?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_etiqueta_camara') ?></label>
              </div>
              <div class="form-check form-check-inline">
                <input type="checkbox" id="chk_archivo" name="chk_archivo" value="1">
                <label for="chk_archivo">
                  <?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_etiqueta_archivo') ?></label>
              </div>
              <br>
            </div>
          </div>
          <P>
            <!-- CABEZAL -->
            <input type="hidden" name="txt_url_ticket" id="txt_url_ticket" value="<?= $fototicket ?>">
          <div class="row row-validator">
            <div class="col-lg-3">
              <div class="form-group">
                <label
                  for="txt_qr"><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_input_numero_tarjeta') ?></label>
                <div class="input-group">
                  <input type="text" name="txt_qr" value="<?= $txt_qr ?>" id="txt_qr" class="form-control"
                    placeholder="<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_placeholder_numero_tarjeta') ?>"
                    onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false"
                    onDrop="return false" autocomplete="off" onKeyPress='return js_general_solo_numeros(event)'
                    readonly="true">
                </div>
                <div id="error"></div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label
                  for="txt_numero_ticket"><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_input_numero_ticket') ?><span
                    data-toggle='tooltip'
                    title='<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tooltip_numero_ticket') ?>'><i
                      class="fas fa-question-circle"></i></span></label>
                <input type="text" name="txt_numero_ticket" id="txt_numero_ticket" class="form-control txt-mayus"
                  placeholder="<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_placeholder_numero_ticket') ?>"
                  onKeyPress='return js_general_solo_alfanumerico(event,this)' onpaste="return false;"
                  onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false"
                  autocomplete="off" maxlength="20" value="<?= $numeroticket ?>">
                <div id="error"></div>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label
                  for="txt_monto_ticket"><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_input_monto_ticket') ?><span
                    data-toggle='tooltip'
                    title='<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tooltip_monto_ticket') ?>'><i
                      class="fas fa-question-circle"></i></span></label>
                <input type="text" name="txt_monto_ticket" id="txt_monto_ticket" class="form-control"
                  placeholder="<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_placeholder_monto_ticket') ?>"
                  onkeypress="return js_general_solo_decimal(this,event);" onpaste="return false;" onCopy="return false"
                  onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" maxlength="18"
                  value="<?= $montoticket ?>">
                <div id="error"></div>
              </div>
            </div>
            <div class="col-lg-3" id="div_ticket_foto">
              <div class="form-group">
                <label
                  for="txt_ticket_foto"><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_input_ticket') ?><span
                    data-toggle='tooltip'
                    title='<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tooltip_ticket_foto') ?>'><i
                      class="fas fa-question-circle"></i></span></label>
                <div class="input-group">
                  <input type="text" name="txt_ticket_foto" id="txt_ticket_foto"
                    value="<?= $this->session->userdata('s_venta_foto'); ?>" class="form-control"
                    placeholder="<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_placeholder_ticket') ?>"
                    onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false"
                    onDrop="return false" autocomplete="off" disabled>
                  <button type="button" id="ventas_auditoria_rechazados_actualiza_view_boton_guardar_foto"
                    class="btn btn-axalta-sm"><i class="fas fa-camera"></i></button>
                </div>
                <div id="error"></div>
              </div>
            </div>
            <div class="col-lg-3" id="div_ticket_archivo" style="display: none;">
              <div class="form-group">
                <label
                  for="txt_ticket_archivo"><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_input_ticket') ?><span
                    data-toggle='tooltip'
                    title='<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_msg_archivo') ?>'><i
                      class="fas fa-question-circle"></i></span></label>
                <input type="file" name="txt_ticket_archivo" id="txt_ticket_archivo" class="form-control"
                  placeholder="<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_placeholder_ticket') ?>">
                <small class="txt-8"><b>Verifique se a foto não está fora de foco. Arquivos permitidos PDF, JPG, PNG,
                    JPEG (O arquivo não deve exceder 4 MB)</b></small>
                <div id="error"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-5">
              <div class="panel-red" style="display: none; padding:10px;" id="div_maestro_pintor">
                <div id="div_datos_maestro_pintor"></div>
              </div>
            </div>
          </div>


           <div class="col-lg-12">
            <br>
            <p class="txt-center txt-700" style="color: red;">
              Produtos inseridos anteriormente</p>
          </div>
          <div class="row" id="div_tabla_anterior">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-axalta" id="TablaProductosAnterior">
                  <thead>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_clase') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_marca') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_monto') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_cantidad') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_litros') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_borrar') ?></th>
                  </thead>
                  <tbody id="tabla_productos_anterior">
                  </tbody>
                </table>
              </div>
            </div>
          </div>



<hr class="separador">
          <div class="col-lg-12">
            <br>
            <p class="txt-center txt-700" style="color: red;">
              <?= $this->lang->line('ventas_registro_controller_lang_etiqueta_aviso_2') ?></p>
          </div>
          <hr class="separador">
          <div class="mb-3" id="div_detalle">
            <div class="row row-validator" id="div_sector">
              <div class="col-lg-4" id="div_clase">
                <div class="form-group">
                  <label for="cmd_clase"><?= $this->lang->line('ventas_registro_controller_lang_input_clase') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('ventas_registro_controller_lang_tooltip_clase') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <select id="cmd_clase" name="cmd_clase" class="form-select"></select>
                </div>
              </div>
              <div class="col-lg-4" style="display: none;" id="div_marca">
                <div class="form-group">
                  <label for="cmb_marca"><?= $this->lang->line('ventas_registro_controller_lang_input_marca') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('ventas_registro_controller_lang_tooltip_marca') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <select id="cmb_marca" name="cmb_marca" class="form-select"></select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3" style="display: none;" id="div_marca_monto">
                <div class="form-group">
                  <label
                    for="txt_marca_monto"><?= $this->lang->line('ventas_registro_controller_lang_input_monto') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('ventas_registro_controller_lang_tooltip_monto_ticket') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_marca_monto" id="txt_marca_monto" class="form-control"
                    placeholder="<?= $this->lang->line('ventas_registro_controller_lang_placeholder_monto') ?>"
                    onKeyPress="return js_general_solo_decimal(this,event);" onpaste="return false;"
                    onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false"
                    autocomplete="off" maxlength="18">
                </div>
              </div>
              <div class="col-lg-2" style="display: none;" id="div_marca_cantidad">
                <div class="form-group">
                  <label
                    for="txt_marca_cantidad"><?= $this->lang->line('ventas_registro_controller_lang_input_cantidad') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('ventas_registro_controller_lang_tooltip_cantidad') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <input type="text" name="txt_marca_cantidad" id="txt_marca_cantidad" class="form-control"
                    placeholder="<?= $this->lang->line('ventas_registro_controller_lang_placeholder_cantidad') ?>"
                    onKeyPress="return js_general_solo_numeros(event)" onpaste="return false;" onCopy="return false"
                    onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" maxlength="2">
                </div>
              </div>
              <div class="col-lg-3" style="display: none;" id="div_marca_litros">
                <div class="form-group">
                  <label
                    for="cmb_marca_litros"><?= $this->lang->line('ventas_registro_controller_lang_input_litros') ?><span
                      data-toggle='tooltip'
                      title='<?= $this->lang->line('ventas_registro_controller_lang_tooltip_litros') ?>'><i
                        class="fas fa-question-circle"></i></span></label>
                  <select id="cmb_marca_litros" name="cmb_marca_litros" class="form-select"></select>
                </div>
              </div>
              <div class="col-lg-2" style="display: none;" id="div_btn_agregar">
                <div class="form-group">
                  <button type="button" id="ventas_registro_boton_agregar" class="btn btn-axalta"
                    style="margin-top:20px;"><i class="fas fa-plus" style="margin-right:10px;"></i>
                    <?= $this->lang->line('ventas_registro_controller_lang_boton_agregar') ?></button>
                </div>
              </div>
              <div class="col-lg-2" style="display: none;" id="div_btn_limpiar">
                <div class="form-group">
                  <button type="button" id="ventas_registro_boton_limpiar_carito" class="btn btn-axalta"
                    style="margin-top:20px;"><i class="fas fa-trash"
                      style="margin-right:10px;"></i><?= $this->lang->line('ventas_registro_controller_lang_boton_limpiar_carrito') ?></button>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="div_tabla">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-axalta" id="TablaParticipantes">
                  <thead>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_clase') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_marca') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_monto') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_cantidad') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_litros') ?></th>
                    <th><?= $this->lang->line('ventas_registro_controller_lang_placeholder_borrar') ?></th>
                  </thead>
                  <tbody id="tabla_productos">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <hr class="separador">
        <div class="row justify-content-end mt-20">
          <div class="col-lg-2 col-6">
            <div class="d-grid gap-2">
              <button type="button"
                onclick="window.location.href='<?= funciones_strategix_version_url_random_base_url("TicketsRechazados") ?>'"
                class="btn btn-gray"><i class="far fa-caret-square-left"></i> Voltar</button>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <div class="d-grid gap-2">
              <button type="button" id="ventas_auditoria_rechazados_actualiza_view_guardar_venta"
                class="btn btn-axalta"><i class="far fa-save"></i> Manter</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
</form>
<script>
  $(document).ready(function () {
    ventas_auditoria_rechazados_actualiza_view_js_maestro_pintor();
    ventas_auditoria_rechazados_actualiza_view_js_combo_clase();
    ventas_auditoria_rechazados_actualiza_view_js_combo_litros();
     ventas_auditoria_rechazados_actualiza_view_js_agregar_producto_inicial();
    /********************************************ON CLICK******************************************************************************************/
    $("#ventas_auditoria_rechazados_actualiza_view_boton_guardar_foto").click(function () { ventas_auditoria_rechazados_actualiza_view_js_camara(); });
    $("#ventas_auditoria_rechazados_actualiza_view_guardar_venta").click(function () { ventas_auditoria_rechazados_actualiza_view_js_guardar_venta(); });
    $("#ventas_registro_boton_agregar").click(function () {
      ventas_auditoria_rechazados_actualiza_view_js_agregar_producto();
    });
    $("#ventas_registro_boton_limpiar_carito").click(function () {
      ventas_auditoria_rechazados_actualiza_view_js_limpiar_carito();
    });
    /********************************************ON CHANGE******************************************************************************************/
    $('#chk_camara').prop('checked', true);
    js_general_valida_uploads_archivos('txt_ticket_archivo', ['png', 'jpg', 'jpeg', 'pdf'], '<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_msg_error_tamanio_identificacion') ?>', '<?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_msg_archivo') ?>');
    /********************************************ON CHANGE CHECKS******************************************************************************************/
    /********************************************ON CHANGE******************************************************************************************/
    $('#txt_qr').on('change', function () {
      ventas_registro_view_js_valida_qr();
    });
    $('#cmb_sector').on('change', function () {
      ventas_auditoria_rechazados_actualiza_view_js_combo_clase();
    });
    $('#cmd_clase').on('change', function () {
      ventas_auditoria_rechazados_actualiza_view_js_combo_marca();
    });
    $('#cmb_marca').on('change', function () {
      $('#div_marca_monto').show();
      $('#div_marca_litros').show();
      $('#div_marca_cantidad').show();
      $('#div_btn_agregar').show();
      $('#div_btn_limpiar').show();
      $('#txt_marca_monto').val('');
      $('#cmb_marca_litros').val(0);
      $('#txt_marca_cantidad').val('');
    });
    $('#chk_camara').prop('checked', true);
    js_general_valida_uploads_archivos('txt_ticket_archivo', ['png', 'jpg', 'jpeg', 'pdf'], '<?= $this->lang->line('ventas_registro_controller_lang_msg_error_tamanio_identificacion') ?>', '<?= $this->lang->line('ventas_registro_controller_lang_msg_error_formato_identificacion') ?>');
    /********************************************ON CHANGE CHECKS******************************************************************************************/


    $('#chk_detalle').on('change', function () {
      if ($('#chk_detalle').prop('checked') == true) {
        $('#div_sector').show();
        $.ajax({
          type: 'POST',
          url: 'ventas/ventas_registro/ventas_registro_controller/ventas_registro_cart_muestra_tabla',
          dataType: 'json',
          data: { id: 0 },
          success: function (data) {
            $('#tabla_productos').html('');
            $('#tabla_productos').html(data.tabla);
          },
          error: function (data) { },
          complete: function () { $('#loader_panel').hide(); }
        });
        $('#div_tabla').show();
      } else {
        $('#cmb_sector').val(0);
        $('#cmd_clase').val(0);
        $('#cmb_marca').val(0);
        $('#div_sector').hide();
        $('#div_clase').hide();
        $('#div_marca').hide();
        $('#txt_marca_monto').val('');
        $('#div_marca_monto').hide();
        $('#cmb_marca_litros').val(0);
        $('#txt_marca_cantidad').val('');
        $('#div_marca_litros').hide();
        $('#div_marca_cantidad').hide();
        $('#div_btn_agregar').hide();
        $('#div_btn_limpiar').hide();
        $('#div_tabla').hide();
        $('#loader_panel').show();
        $.ajax({
          type: 'POST',
          url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_cart_limpiar',
          dataType: 'json',
          data: { id: 0 },
          success: function (data) {
            $('#tabla_productos').html('');
          },
          error: function (data) { },
          complete: function () { $('#loader_panel').hide(); }
        });

      };
    });
    $('#chk_camara').on('change', function () {
      if ($('#chk_camara').prop('checked', true)) {
        $('#chk_archivo').prop('checked', false).removeAttr('checked').val('0');
        $('#ventas_auditoria_rechazados_actualiza_view_boton_guardar_foto').prop('disabled', false);
        $('#txt_ticket_foto').prop('disabled', false);
        $('#txt_ticket_foto').val('<?= $this->session->userdata('s_venta_foto'); ?>');
        $('#txt_ticket_archivo').prop('disabled', true);
        $('#chk_camara').val('1');
        $('#txt_ticket_archivo').removeClass('is-invalid').addClass('');
        $('#txt_ticket_archivo').parents('.form-group').find('#error').html(" ");
        $('#txt_ticket_foto').removeClass('is-invalid').addClass('');
        $('#txt_ticket_foto').parents('.form-group').find('#error').html(" ");
        $('#div_ticket_archivo').hide();
        $('#ventas_auditoria_rechazados_actualiza_view_boton_guardar_foto').show();
        $('#div_ticket_foto').show();
        $("#txt_ticket_foto").attr('disabled', true);
      }
    });
    $('#chk_archivo').on('change', function () {
      if ($('#chk_archivo').prop('checked', true)) {
        $('#chk_camara').prop('checked', false).removeAttr('checked').val('0');
        $('#txt_ticket_archivo').prop('disabled', false);
        $('#ventas_auditoria_rechazados_actualiza_view_boton_guardar_foto').prop('disabled', true);
        $('#txt_ticket_archivo').val('');
        $('#btn_registro_maestro_pintor_modal_identificacion').val('');
        $('#chk_archivo').val('1');
        $('#txt_ticket_foto').removeClass('is-invalid').addClass('');
        $('#txt_ticket_foto').parents('.form-group').find('#error').html(" ");
        $('#txt_ticket_archivo').removeClass('is-invalid').addClass('');
        $('#txt_ticket_archivo').parents('.form-group').find('#error').html(" ");
        $('#ventas_auditoria_rechazados_actualiza_view_boton_guardar_foto').hide();
        $('#div_ticket_foto').hide();
        $('#div_ticket_archivo').show();
        $('#txt_ticket_foto').val('');
        ventas_auditoria_rechazados_actualiza_view_js_valida_session_foto();
        $("#txt_ticket_archivo").attr('disabled', false);
      }
    });
    /********************************************MSG ERROR******************************************************************************************/
    $('#frm_ventas_auditoria_rechazados_actualiza_view input').on('keyup', function () { js_general_limpiar_errores(this); });
    $('#frm_ventas_auditoria_rechazados_actualiza_view input').on('click', function () { js_general_limpiar_errores(this); });
    $('#frm_ventas_auditoria_rechazados_actualiza_view select').on('click', function () { js_general_limpiar_errores(this); });
    $('#frm_ventas_auditoria_rechazados_actualiza_view input').on('change', function () { js_general_limpiar_errores(this); });
    /********************************************ELIMINAR PRODUCTO ANTERIOR******************************************************************************************/
    $(document).on('click', '[name="eliminar_prod_ant"]', function () {
      var id_prod = $(this).attr("id");
  Swal.fire({
        title: '<?= $this->lang->line('ventas_registro_controller_lang_baja_prodcuto_titulo') ?>',
        html: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#fd7e14',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<?= $this->lang->line('ventas_registro_controller_lang_btn_aceptar') ?>',
        cancelButtonText: '<?= $this->lang->line('ventas_registro_controller_lang_btn_cancelar') ?>',
        allowOutsideClick: false
      }).then((validacion) => {
        if (validacion.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_baja_producto_anterior',
            dataType: 'json',
            data: {
              id_prod: id_prod
            },
            success: function(data) {
              $('#tabla_productos_anterior').html('');
              ventas_auditoria_rechazados_actualiza_view_js_agregar_producto_inicial();
            },
            error: function() {
              console.log("error");
            },
            complete: function() {
              //Code
            }
          });
          return 1;
        } else {
          return 0;
        }
      });
     // alert(row_id);
    });
  });
  $(document).on('click', '.romove_cart', function() {
      var row_id = $(this).attr("id");
      Swal.fire({
        title: '<?= $this->lang->line('ventas_registro_controller_lang_baja_prodcuto_titulo') ?>',
        html: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#fd7e14',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<?= $this->lang->line('ventas_registro_controller_lang_btn_aceptar') ?>',
        cancelButtonText: '<?= $this->lang->line('ventas_registro_controller_lang_btn_cancelar') ?>',
        allowOutsideClick: false
      }).then((validacion) => {
        if (validacion.isConfirmed) {
          $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_cart_borrar_producto',
            dataType: 'json',
            data: {
              row_id: row_id
            },
            success: function(data) {
              $('#tabla_productos').html('');
              $('#tabla_productos').html(data.tabla);
            },
            error: function() {
              console.log("error");
            },
            complete: function() {
              //Code
            }
          });
          return 1;
        } else {
          return 0;
        }
      });
    });
  function ventas_auditoria_rechazados_actualiza_view_js_valida_session_foto() {
    //ventas_auditoria_rechazados_actualiza_view_js_limpiar_errores('#div_ticket_foto'); 
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_valida_session_foto',
      dataType: 'json',
      data: { id: 0 },
      success: function (data) {
        $('#div_ticket_foto').val('');
      },
      error: function (data) { },
      complete: function () { $('#loader_panel').hide(); }
    });
  }
  function ventas_auditoria_rechazados_actualiza_view_js_camara() {
    //ventas_auditoria_rechazados_actualiza_view_js_limpiar_errores('#txt_ticket_foto');        
    $('#loader_panel').show();
    switch (js_general_sistema_operativo()) {
      case "iOS": var modal = 1; break;
      default: var modal = 2; break;
    }
    $.ajax({
      type: 'POST',
      url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_modal_foto',
      dataType: 'json',
      data: { modal: modal },
      success: function (data) {
        $('#myModal').html(data).modal('show');
      },
      error: function (data) { console.log(data); },
      complete: function () { $('#loader_panel').hide(); }
    });
  }
  function ventas_auditoria_rechazados_actualiza_view_js_guardar_venta() {
    $("#txt_ticket_foto").attr('disabled', false);
    var formData = new FormData($("#frm_ventas_auditoria_rechazados_actualiza_view")[0]);
    var foto = $('#txt_ticket_foto').val();
    var archivo = $('#txt_ticket_archivo').val();
    $('#loader_panel').show();
    if (ventas_auditoria_rechazados_actualiza_view_js_valida_foto_archivo(foto, archivo) == 1) {
      $.ajax({
        type: 'POST',
        url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_valida_venta',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
          console.log(data);
          switch (data.resultado) {
            case "0": Swal.fire({ icon: 'error', title: '', text: '<?= $this->lang->line('ventas_registro_js_msg_error_guardar_venta') ?>' }); break;
            case 1:
              Swal.fire({
                title: '',
                text: "A MUDANÇA FOI SALVA COM SUCESSO",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#fd7e14',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'OK',
                cancelButtonText: ''
              }).then((result) => {
                if (result.isConfirmed) {
                  $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url("TicketsRechazados") ?>");
                }
              });
              break;
            case 2:
              Swal.fire({ icon: 'error', title: '', text: '<?= $this->lang->line('ventas_registro_js_msg_error_guardar_detalle_venta') ?>' }); break;
              break;
            case 3:
              Swal.fire({ icon: 'error', title: '', text: '<?= $this->lang->line('ventas_registro_js_msg_error_guardar_ticket_repetido') ?>' }); break;
              break;
            default:
              $("#txt_ticket_foto").attr('disabled', true);
              $.each(data, function (key, value) {
                $('#' + key).addClass('is-invalid');
                $('#' + key).parents('.form-group').find('#error').html(value);
              });
              $('#loader_panel').hide();
              break;
          }
        },
        error: function (data) { },
        complete: function () { $('#loader_panel').hide(); }
      });
    } else {
      $('#loader_panel').hide();
      $("#txt_ticket_foto").attr('disabled', true);
      ventas_auditoria_rechazados_actualiza_view_js_valida_campos();
    }
  }
  function ventas_auditoria_rechazados_actualiza_view_js_valida_campos() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_valida_campos',
      dataType: 'json',
      data: $("#frm_ventas_auditoria_rechazados_actualiza_view").serialize(),
      success: function (data) {
        if (data == 1) {
          $('#loader_panel').hide();
        } else {
          $.each(data, function (key, value) {
            $('#' + key).addClass('is-invalid');
            $('#' + key).parents('.form-group').find('#error').html(value);
          });
          $('#loader_panel').hide();
        }
      },
      error: function (data) { },
      complete: function () { $('#loader_panel').hide(); }
    });
  }
  function ventas_auditoria_rechazados_actualiza_view_js_valida_foto_archivo(foto, archivo) {
    var validacion = 1;
      /*  if (foto=="" && archivo==""){ 
            validacion = 0;
            if (foto==""){  
                $('#txt_ticket_foto').addClass('is-invalid');
                $('#txt_ticket_foto').parents('.form-group').find('#error').html('<?= $this->lang->line('ventas_registro_ticket_controller_lang_js_msg_error_archivo') ?>');                
  }
  if (archivo == "") {
    $('#txt_ticket_archivo').addClass('is-invalid');
    $('#txt_ticket_archivo').parents('.form-group').find('#error').html('<?= $this->lang->line('ventas_registro_ticket_controller_lang_js_msg_error_archivo') ?>');
  }
        }*/  if (foto!="" && archivo==""){ validacion = 1;
        } else if (foto == "" && archivo != "") { validacion = 1; }
  return validacion;
    }
  function ventas_auditoria_rechazados_actualiza_view_js_maestro_pintor() {
    var code_qr = $('#txt_qr').val();
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_qr_retorno',
      dataType: 'json',
      data: { code_qr: code_qr },
      success: function (data) {
        if (data.resultado == 0) {
          Swal.fire({ icon: 'error', title: '', text: '<?= $this->lang->line('ventas_registro_ticket_controller_lang_msg_qr_error') ?>' });
          $("#txt_qr").val('');
          $("#div_datos_maestro_pintor").html('');
          //$("#div_detalle").hide();
          $("#div_maestro_pintor").hide();
        } else {
          $("#div_datos_maestro_pintor").html(data.datos_maestro_pintor);
          $("#div_maestro_pintor").show();
          $("#txt_qr").val(data.qr);
          //                    $("#div_detalle").show();
        }
      },
      error: function (data) { },
      complete: function () { $('#loader_panel').hide(); }
    });
  }
  function ventas_auditoria_rechazados_actualiza_view_js_combo_clase() {
    var cmb_sector = $('#cmb_sector').val();
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',

      url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_ajax_combo_lista_clase',
      dataType: 'json',
      data: {
        cmb_sector: cmb_sector
      },
      success: function (data) {
        $('#cmd_clase').html(data);
        $('#div_clase').show();
        $('#cmb_marca').val(0);
        $('#div_sector').show();
        $('#div_marca').hide();
        $('#txt_marca_monto').val('');
        $('#div_marca_monto').hide();
        $('#cmb_marca_litros').val(0);
        $('#div_marca_litros').hide();
        $('#div_marca_cantidad').hide();
        $('#txt_marca_cantidad').val('');
      },
      error: function (data) { },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }
  function ventas_auditoria_rechazados_actualiza_view_js_combo_litros() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_ajax_combo_lista_litros',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function (data) {
        $('#cmb_marca_litros').html(data);
      },
      error: function (data) { },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }
  function ventas_auditoria_rechazados_actualiza_view_js_combo_marca() {
    var cmd_clase = $('#cmd_clase').val();
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_ajax_combo_lista_marca',
      dataType: 'json',
      data: {
        cmd_clase: cmd_clase
      },
      success: function (data) {
        $('#cmb_marca').html(data);
        $('#div_marca').show();
        $('#txt_marca_monto').val('');
        $('#div_marca_monto').hide();
        $('#cmb_marca_litros').val(0);
        $('#div_marca_litros').hide();
        $('#div_marca_cantidad').hide();
        $('#txt_marca_cantidad').val('');
      },
      error: function (data) { },
      complete: function () {
        $('#loader_panel').hide();
      }
    });
  }
  function ventas_auditoria_rechazados_actualiza_view_js_agregar_producto_inicial() {
    var ventaId = "<?php echo $VentasId; ?>";
  $('#loader_panel').show();
  $.ajax({
    type: 'POST',
    url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_cart_agregar_producto_inicial',
    dataType: 'json',
    data: { ventaId: ventaId },
    success: function (data) {
      $('#tabla_productos_anterior').html(data.tabla);
    },
    error: function (data) { },
    complete: function () {
      $('#loader_panel').hide();
    }
  });
  }
  function ventas_auditoria_rechazados_actualiza_view_js_agregar_producto() {
    var txt_marca_monto = $('#txt_marca_monto').val();
    var cmb_marca_litros = $('#cmb_marca_litros').val();
    var txt_marca_cantidad = $('#txt_marca_cantidad').val();
    if (txt_marca_monto != "" && cmb_marca_litros != "" && txt_marca_cantidad != "" && txt_marca_monto != 0 && cmb_marca_litros != 0 && txt_marca_cantidad != 0 && txt_marca_monto > 0 && cmb_marca_litros > 0 && txt_marca_cantidad > 0) {
      $('#loader_panel').show();
      $.ajax({
        type: 'POST',
        url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_cart_agregar_producto',
        dataType: 'json',
        data: $("#frm_ventas_auditoria_rechazados_actualiza_view").serialize(),
        success: function (data) {
          $('#tabla_productos').html(data.tabla);
          $('#txt_marca_monto').val('');
          $('#cmb_marca_litros').val(0);
          $('#txt_marca_cantidad').val('');
        },
        error: function (data) { },
        complete: function () {
          $('#loader_panel').hide();
        }
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: '',
        text: '<?= $this->lang->line('ventas_registro_controller_lang_msg_error_marca') ?>'
      });
    }
  }
  function ventas_auditoria_rechazados_actualiza_view_js_limpiar_carito() {
    Swal.fire({
      title: '',
      html: '<?= $this->lang->line('ventas_registro_controller_lang_msg_limpiar_carrito') ?>',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#fd7e14',
      cancelButtonColor: '#6c757d',
      confirmButtonText: '<?= $this->lang->line('ventas_registro_controller_lang_btn_aceptar') ?>',
      cancelButtonText: '<?= $this->lang->line('ventas_registro_controller_lang_btn_cancelar') ?>',
      allowOutsideClick: false
    }).then((validacionlimpiacarrito) => {
      if (validacionlimpiacarrito.isConfirmed) {
        $.post("ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_cart_limpiar", {}, function (data, status) {
          $('#tabla_productos').html('');
        });
        return 1;
      } else {
        return 0;
      }
    });
  }
</script>