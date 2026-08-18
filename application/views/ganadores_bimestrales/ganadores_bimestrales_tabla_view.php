<hr class="separador">
<div class="row mb-5" style="justify-content: flex-end; margin-top:20px;">
  <div class="col-lg-2">
    <?php if($cuenta>0){?>
    <button type="button" id="ganadores_bimestrales_btn_mail" class="btn btn-axalta"><i class="fas fa-envelope pr-5"></i> ENVIAR MAIL</button>
        <?php } ?>  
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="table-responsive table-axalta">
      <table class="table table-bordered" id="TbGanadoresBimestrales">
        <thead>
          <th><?= $this->lang->line('ganadores_bimestrales_controller_lang_tabla_id_maestro_pintor') ?></th>
          <th><?= $this->lang->line('ganadores_bimestrales_controller_lang_tabla_maestro_pintor') ?></th>
          <th><?= $this->lang->line('ganadores_bimestrales_controller_lang_tabla_id') ?></th>
          <th><?= $this->lang->line('ganadores_bimestrales_controller_lang_tabla_codigo') ?></th>
          <th><?= $this->lang->line('ganadores_bimestrales_controller_lang_tabla_nombre_comercial') ?></th>
          <th><?= $this->lang->line('ganadores_bimestrales_controller_lang_tabla_ejecutivo') ?></th>
          <th><?= $this->lang->line('ganadores_bimestrales_controller_lang_tabla_ciudad') ?></th>
          <th><?= $this->lang->line('ganadores_bimestrales_controller_lang_tabla_premio') ?></th>
          <th><?= $this->lang->line('ganadores_bimestrales_controller_lang_tabla_descripcion_premio') ?></th>
        </thead>
        <tbody>
          <?= $tabla ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $("#ganadores_bimestrales_btn_mail").click(function() {
      ganadores_bimestrales_js_enviar_mail();
    });
    $('#TbGanadoresBimestrales').DataTable({
      "scrollX": 3500,
      "scrollY": 350,
      "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "<?= $this->lang->line('data_table_js_lang_combo_todos') ?>"]
      ],
      "language": {
        "lengthMenu": "<?= $this->lang->line('data_table_js_lang_lengthMenu') ?>",
        "zeroRecords": "<?= $this->lang->line('data_table_js_lang_zeroRecords') ?>",
        "info": "<?= $this->lang->line('data_table_js_lang_info') ?>",
        "infoEmpty": "<?= $this->lang->line('data_table_js_lang_infoEmpty') ?>",
        "infoFiltered": "<?= $this->lang->line('data_table_js_lang_infoFiltered') ?>",
        "search": "<?= $this->lang->line('data_table_js_lang_search') ?>",
        "paginate": {
          "first": "<?= $this->lang->line('data_table_js_lang_first') ?>",
          "last": "<?= $this->lang->line('data_table_js_lang_last') ?>",
          "next": "<?= $this->lang->line('data_table_js_lang_next') ?>",
          "previous": "<?= $this->lang->line('data_table_js_lang_previous') ?>"
        }
      },
      dom: '<"row"<"col-xs-4 col-md-4"l><"col-xs-4 col-md-4 botones"B><"col-md-4"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
      buttons: [{
        extend: 'excelHtml5',
        text: '<?= $this->lang->line('data_table_js_lang_btn_descarga') ?> <span class="iconify" data-icon="file-icons:microsoft-excel" style=font-size:20px;"></span>',
        className: 'btn btn-axalta',
        title: '',
        filename: 'GANADORES BIMESTRALES',
        sheetName: 'GANADORES BIMESTRALES',
        excelStyles: [{
            "cells": "1",
            style: { // The style block
              font: { // Style the font
                name: "Calibri", // Font name
                size: "12", // Font size
                color: "FFFFFF", // Font Color
                b: true // Remove bolding from header row
              },
              fill: { // Style the cell fill (background)
                pattern: { // Type of fill (pattern or gradient)
                  color: "C82127" // Fill color
                }
              }
            }
          },
          {
            cells: "A:K:",
            style: {
              border: {
                top: "thin", // Thin black border at top of cell/s
                bottom: "thin",
                left: "thin",
                right: "thin"
              }
            }
          }
        ]
      }]
    });
    $('.dataTables_length').addClass('bs-select');
  });

  function ganadores_bimestrales_js_enviar_mail() {
    $('#loader_panel').show();
    var mes = $('#cmb_mes').val();
    var anio = $('#cmb_anio').val();
    var cmbdistribuidora = $('#cmb_distribuidora').val();
    $.ajax({
      type: 'POST',
      url: 'ganadores_bimestral/ganadores_bimestrales_controller/ganadores_bimestrales_controller_mail_all',
      dataType: 'json',
      data: {
        cmbdistribuidora: cmbdistribuidora,
        mes: mes,
        anio: anio
      },
      success: function(data) {
        if (data == 1) {
          Swal.fire({
            icon: 'success',
            title: '',
            text: 'SE HA ENVIADO EL MAIL A TODOS LOS  DISTRIBUIDORES DEL PAíS SELECCIONADO'
          });
        }
      },
      error: function(data) {},
      complete: function() {
        $('#loader_panel').hide();
      }
    });
  }
</script>