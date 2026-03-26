<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Enrique Arce Rosas  * 
 * @CreateDate 1 jun. 2022 11:29:40 * 
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
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_model_tabla_titulo_id')?></th>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_model_tabla_titulo_nombre')?></th>
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_model_tabla_titulo_folio')?></th>   
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_model_tabla_titulo_monto')?></th>    
                                    <th><?=$this->lang->line('ventas_auditoria_primera_controller_lang_model_tabla_titulo_fecha')?></th>    
                                </tr>
                            </thead>
                            <tbody>
                                <?=$tabla_datos?>
                            </tbody>
                        </table>     
            <p>
                <object data="<?=base_url($archivo)?>" type="application/pdf" width="100%" height="500px">
                <p>Tu navegador no tiene el plugin para previsualizar documentos pdf.</p>
                <p>Puedes descargarte el archivo desde <a href="<?=funciones_strategix_version_url_random_base_url($archivo)?>">aquí</a></p>
                </object>
            </p>  
      </div>
    </div>
  </div>