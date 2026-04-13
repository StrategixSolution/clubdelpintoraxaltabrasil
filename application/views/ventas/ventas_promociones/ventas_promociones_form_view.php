<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form id="frm_ventas_promociones_view" role="form" method="post" accept-charset="utf-8">
  <input id="VentaId" name="VentaId" type="hidden" value="<?= $VentaId ?>">
  <section id="ventas_registro_view">
<div class="panel-title">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><?= $this->lang->line('ventas_promociones_controller_lang_titulo') ?></h2>
                    </div>
                </div>
            </div>
        </div>    
    <div class="container">
      <div class="panel-white">
        <div class="row row-validator">
          <div class="col-lg-4">
            <div class="form-group">
              <label for="cmb_promocion"><?= $this->lang->line('ventas_promociones_controller_lang_input_promociones') ?><span data-toggle='tooltip' title='<?= $this->lang->line('ventas_promociones_controller_lang_tooltip_promociones') ?>'><i class="fas fa-question-circle"></i></span></label>
              <select id="cmb_promocion" name="cmb_promocion" class="form-select"></select>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="form-group">
              <button type="button" id="ventas_promociones_boton_buscar" class="btn btn-axalta-sm" style="margin-top:20px;"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div id="tabla"></div>
          </div>
        </div>
      </div>

    </div>
  </section>
</form>
<script>
  $(document).ready(function() {
    ventas_promociones_view_js_combo_promocion();
    $("#ventas_promociones_boton_buscar").click(function() {
      ventas_promociones_view_js_buscar_tabla();
    });
  });

  function ventas_promociones_view_js_combo_promocion() {
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'ventas/ventas_promociones/ventas_promociones_controller/ventas_promociones_controller_combo_promociones',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function(data) {
        $('#cmb_promocion').html(data);
      },
      error: function(data) {},
      complete: function() {
        $('#loader_panel').hide();
      }
    });
  };

  function ventas_promociones_view_js_buscar_tabla() {
    var cmb_promocion = $('#cmb_promocion').val();
    $('#loader_panel').show();
    $.ajax({
      type: 'POST',
      url: 'ventas/ventas_promociones/ventas_promociones_controller/ventas_promociones_controller_buscar_tabla',
      dataType: 'json',
      data: {
        cmb_promocion: cmb_promocion
      },
      success: function(data) {
        $('#tabla').html(data.tabla);
      },
      error: function(data) {},
      complete: function() {
        $('#loader_panel').hide();
      }
    });
  };
</script>