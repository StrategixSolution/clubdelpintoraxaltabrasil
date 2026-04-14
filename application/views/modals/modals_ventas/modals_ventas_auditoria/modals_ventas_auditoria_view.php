<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 1 jun. 2026 11:29:40 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_ticket_titulo')?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                        <table class='table table-lg table-bordered table-axalta' id="mi-tabla1" style="margin:20px 0px;">
                            <thead>
                                <tr>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_id')?></th>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_nombre')?></th>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_folio')?></th>   
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_monto')?></th>    
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_fecha')?></th>    
                                </tr>
                            </thead>
                            <tbody>
                                <?=$tabla_datos?>
                            </tbody>
                        </table>
          
                        <table class='table table-lg table-bordered table-axalta' id="mi-tabla3" style="margin:20px 0px;">
                            <thead>
                                <tr>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_sector')?></th>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_clase')?></th>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_marca')?></th>   
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_cantidad')?></th>    
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_litros')?></th> 
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_precio_unitario')?></th> 
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_precio_unitario_total')?></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?=$tabla_productos?>
                            </tbody>
                        </table>          
          
                        <table class='table table-lg table-bordered table-axalta' id="mi-tabla2" style="margin:20px 0px;">
                            <thead>
                                <tr>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_promocion')?></th>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_descripcion')?></th>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_gms')?></th>   
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_codigo')?></th>  
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_presentacion')?></th>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_modal_tabla_titulo_cantidad')?></th>                
                                </tr>
                            </thead>
                            <tbody>
                                <?=$tabla_productos_promocion?>
                            </tbody>
                        </table>       
        <div class="horizontal-center">
            <?PHP $ext = substr($archivo,-3);?>
                <?PHP 
    if (strtolower(trim($ext)) == "pdf") { 
        $urlFile = funciones_strategix_version_url_random_base_url($archivo);
    ?>
    <embed src="<?=$urlFile?>" type="application/pdf" width="100%" height="600px" />
    <?PHP } else { ?>
    <img src = "<?=funciones_strategix_version_url_random_base_url($archivo)?>" width='500'>
    <?PHP }; ?>
    </div>
      </div>
    </div>
  </div>