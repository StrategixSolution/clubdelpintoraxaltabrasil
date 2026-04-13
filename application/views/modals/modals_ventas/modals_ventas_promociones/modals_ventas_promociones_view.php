<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');


?>
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=$this->lang->line('ventas_promociones_controller_lang_titulo')?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?=$this->lang->line('ventas_promociones_controller_lang_js_msg_validar_productos_capturados')?>
            </div>
            <div class="col-lg-10">
                <div class="table-responsive">
                    <div class="tabla-scroll">
                        <table class='table table-lg table-bordered table-axalta' id="mi-tabla" style="margin:20px 0px;">
                            <thead>
                                <tr>
                                    <th><?=$this->lang->line('ventas_promociones_controller_lang_tabla_titulo_promocion')?></th>
                                    <th><?=$this->lang->line('ventas_promociones_controller_lang_tabla_titulo_descripcion')?></th>
                                    <th><?=$this->lang->line('ventas_promociones_controller_lang_tabla_titulo_gms')?></th>   
                                    <th><?=$this->lang->line('ventas_promociones_controller_lang_tabla_titulo_codigo')?></th>  
                                    <th><?=$this->lang->line('ventas_promociones_controller_lang_tabla_titulo_presentacion')?></th>
                                    <th><?=$this->lang->line('ventas_promociones_controller_lang_tabla_titulo_cantidad')?></th>                
                                </tr>
                            </thead>
                            <tbody>
                                <?=$tabla?>
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
                <div class="row justify-content-end">
                    <div class="col-lg-2">
                        <button type="button" id="ventas_promociones_view_modal_promociones_btn_si" class="btn btn-axalta"><i class="fas fa-check"></i> <?=$this->lang->line('ventas_promociones_controller_lang_js_btn_si')?></button>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" id="ventas_promociones_view_modal_promociones_btn_no" class="btn btn-axalta"><i class="fas fa-times"></i> <?=$this->lang->line('ventas_promociones_controller_lang_js_btn_no')?></button>
                    </div>    
                </div>
        </div>
      </div>
    </div>
  </div>
<script>
    $(document).ready( function () {  
        $("#ventas_promociones_view_modal_promociones_btn_si").click(function(){ ventas_promociones_view_js_guardar(); });
        $("#ventas_promociones_view_modal_promociones_btn_no").click(function(){ $("#myModal").modal("hide"); });
    });
</script>
    

