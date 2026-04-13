<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>
<div class="row justify-content-center">
  <div class="col-lg-12">
    <div class="table-responsive">
      <div class="tabla-scroll">
        <table class='table table-lg table-bordered table-axalta' id="mi-tabla" style="margin:20px 0px;">
          <thead>
            <tr>
              <th><?= $this->lang->line('ventas_promociones_controller_lang_tabla_titulo_promocion') ?></th>
              <th><?= $this->lang->line('ventas_promociones_controller_lang_tabla_titulo_descripcion') ?></th>
              <th><?= $this->lang->line('ventas_promociones_controller_lang_tabla_titulo_gms') ?></th>
              <th><?= $this->lang->line('ventas_promociones_controller_lang_tabla_titulo_codigo') ?></th>
              <th><?= $this->lang->line('ventas_promociones_controller_lang_tabla_titulo_presentacion') ?></th>
              <th><?= $this->lang->line('ventas_promociones_controller_lang_tabla_titulo_cantidad') ?></th>
            </tr>
          </thead>
          <tbody>
            <?= $tabla ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div>
  <hr class="separador">
</div>
<div class="row justify-content-end">
  <div class="col-lg-2">
    <button type="button" id="ventas_promociones_boton_guardar_inferior" class="btn btn-axalta"><i class="far fa-save"></i> <?= $this->lang->line('ventas_promociones_controller_lang_boton_guardar') ?></button>
  </div>
</div>
<script>
    $(document).ready( function () {  
      //  ventas_promociones_view_js_combo_promocion();
     //   $("#ventas_promociones_boton_buscar").click(function(){ ventas_promociones_view_js_buscar_tabla(); });
        $("#ventas_promociones_boton_guardar_inferior").click(function(){ ventas_promociones_view_js_modal_validar(); });
    });
    function ventas_promociones_view_js_modal_validar(){
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_promociones/ventas_promociones_controller/ventas_promociones_controller_modal_validar_promociones',
            dataType: 'json',
            data: $("#frm_ventas_promociones_view").serialize(),
            success: function(data){
                if(data.total!=0){
                    $('#myModal').html(data.pag).modal('show');
                    $("#myModal").attr("data-bs-backdrop","static");
                    $("#myModal").attr("data-bs-keyboard","false");
                } else {
                    Swal.fire({
                        title: '',
                        html: '<?=$this->lang->line('ventas_promociones_controller_lang_js_msg_error_son_productos_capturados')?>',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#fd7e14',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<?=$this->lang->line('ventas_promociones_controller_lang_js_btn_aceptar')?>',
                        cancelButtonText: '<?=$this->lang->line('ventas_promociones_controller_lang_js_btn_cancelar')?>',
                        allowOutsideClick: false
                    }).then((validacion) => {  });
                }
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide();}
        });
    };
    function ventas_promociones_view_js_guardar(){
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_promociones/ventas_promociones_controller/ventas_promociones_controller_guardar_promocion',
            dataType: 'json',
            data: $("#frm_ventas_promociones_view").serialize(),
            success: function(data){ 
                    Swal.fire({
                        title: '',
                        html: '<?=$this->lang->line('ventas_promociones_controller_lang_js_msg_promocion_guardada')?>',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#fd7e14',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<?=$this->lang->line('ventas_promociones_controller_lang_js_btn_aceptar')?>',
                        cancelButtonText: '<?=$this->lang->line('ventas_promociones_controller_lang_js_btn_cancelar')?>',
                        allowOutsideClick: false
                    }).then((validacion) => {
                            $(location).attr("href","<?=funciones_strategix_version_url_random_base_url("RegistroTickets")?>");
                    });
            },
            error: function(data){ },
            complete: function(){ $('#loader_panel').hide(); }
        });
    };    
</script>