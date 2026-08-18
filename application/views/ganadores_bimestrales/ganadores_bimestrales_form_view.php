<section class="TbGanadoresBimestrales">
  <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('ganadores_bimestrales_controller_lang_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
  <div class="container">
    <div class="panel-white">
      <div class="row">
        <div class="col-lg-4" id="div_cmbdistribuidora">
          <div class="form-group">
            <label
              for="cmb_distribuidora"><?= $this->lang->line('ganadores_bimestrales_controller_lang_etiqueta_distribuidora') ?></label>
            <select name="cmb_distribuidora" id="cmb_distribuidora" class="form-select"></select>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group" id="div_anio">
            <label
              for="cmb_anio"><?= $this->lang->line('ganadores_bimestrales_controller_lang_etiqueta_anio') ?></label>
            <select name="cmb_anio" id="cmb_anio" class="form-select"></select>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group" style="display: none;" id="div_mes">
            <label
              for="cmb_mes"><?= $this->lang->line('ganadores_bimestrales_controller_lang_etiqueta_periodo') ?></label>
            <select name="cmb_mes" id="cmb_mes" class="form-select"></select>
          </div>
        </div>
        <div class="col-lg-2" style="text-align: right; display: none;" id="div_buscar">
          <div class="form-group">
            <button type="button" id="reporte_ventas_ganadores_btn_buscar" class="btn btn-axalta" style="margin-top: 20px;"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>
      <div id="tablaGanadoresBimestrales"></div>
    </div>

  </div>
</section>
<script>
  $(document).ready(function() {
reporte_ventas_ganadores_js_Combodistribuidora();
reporte_ventas_ganadores_js_crear_cmbanio();
   /* $('#cmb_pais').on('change', function() {
      var cmb_pais = $('#cmb_pais').val();
      if (cmb_pais == '') {
        $('#div_region').hide(300);
        $('#div_segmento').hide(300);
        $('#div_cmbdistribuidora').hide(300);
        $('#div_anio').hide(300);
        $('#div_mes').hide(300);
        $('#div_buscar').hide(300);
                $('#tablaGanadoresBimestrales').hide(300);                
      } else {
        reporte_ventas_ganadores_js_combo_segmento();
        $('#div_region').hide(300);
        $('#div_segmento').hide(300);
        $('#div_cmbdistribuidora').hide(300);
        $('#div_anio').hide(300);
        $('#div_mes').hide(300);
        $('#div_buscar').hide(300);
                $('#tablaGanadoresBimestrales').hide(300);
      }
    });
    $('#cmb_segmento').on('change', function() {
      var cmb_pais = $('#cmb_pais').val();
      var cmb_segmento = $('#cmb_segmento').val();
      if (cmb_segmento == '') {
        $('#div_cmbdistribuidora').hide(300);
        $('#div_anio').hide(300);
        $('#div_mes').hide(300);
        $('#div_buscar').hide(300);
                $('#tablaGanadoresBimestrales').hide(300);
      } else {
        reporte_ventas_ganadores_js_crear_cmbanio();
        reporte_ventas_ganadores_js_Combodistribuidora();
        $('#div_cmbdistribuidora').show(300);
        $('#div_anio').show(300);
      }
    });*/
    $('#cmb_anio').on('change', function() {
      var anio = $('#cmb_anio').val();
      if (anio == 0) {
        $('#div_mes').hide(300);
      } else {
        reporte_ventas_ganadores_js_crear_crearCombomes();
        $('#div_mes').show(300);
      }
    });
    $('#cmb_mes').on('change', function() {
      var mes = $('#cmb_mes').val();
      if (mes == 0) {
        $('#div_buscar').hide(300);
                $('#tablaGanadoresBimestrales').hide(300);
      } else {
        $('#div_buscar').show(300);
      }
    });
    $("#reporte_ventas_ganadores_btn_buscar").click(function() {
      reporte_ventas_ganadores_js_crear_tabla();
    });
  });

  
  function reporte_ventas_ganadores_js_crear_cmbanio() {
    $.ajax({
      type: 'POST',
      url: 'ganadores_bimestral/ganadores_bimestrales_controller/ganadores_bimestrales_controller_cmbanios',
      dataType: 'json',
      data: {
        id: 0
      },
      success: function(data) {
        $('#cmb_anio').empty();
        $('#cmb_anio').html(data);
      },
      error: function(data) {},
      complete: function() {}
    });
  }

  function reporte_ventas_ganadores_js_crear_crearCombomes() {
    var anio = $('#cmb_anio').val();
    $.ajax({
      type: 'POST',
      url: 'ganadores_bimestral/ganadores_bimestrales_controller/ganadores_bimestrales_controller_cmbmes',
      dataType: 'json',
      data: {
        anio: anio
      },
      success: function(data) {
        $('#cmb_mes').empty();
        $('#cmb_mes').html(data);
      },
      error: function(data) {},
      complete: function() {}
    });
  }

  function reporte_ventas_ganadores_js_Combodistribuidora() {
    $.ajax({
      type: 'POST',
      url: 'ganadores_bimestral/ganadores_bimestrales_controller/ganadores_bimestrales_controller_cmbdistribuidora',
      dataType: 'json',
      data: {
      1: 1
      },
      success: function(data) {
        $('#cmb_distribuidora').empty();
        $('#cmb_distribuidora').html(data);
      },
      error: function(data) {},
      complete: function() {}
    });
  }

  function reporte_ventas_ganadores_js_crear_tabla() {
    $('#loader_panel').show();
    var cmb_region = $('#cmb_region').val();
    var mes = $('#cmb_mes').val();
    var anio = $('#cmb_anio').val();
    var cmbdistribuidora = $('#cmb_distribuidora').val();
    $.ajax({
      type: 'POST',
      url: 'ganadores_bimestral/ganadores_bimestrales_controller/ganadores_bimestrales_controller_tabla',
      dataType: 'json',
      data: {
        cmb_region: cmb_region,
        cmbdistribuidora: cmbdistribuidora,
        mes: mes,
        anio: anio
      },
      success: function(data) {
                $('#tablaGanadoresBimestrales').show(300);
        $('#tablaGanadoresBimestrales').html(data);
      },
      error: function(data) {},
      complete: function() {
        $('#loader_panel').hide();
      }
    });
  }
</script>