<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>

  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=$this->lang->line('usuarios_registro_maestro_pintor_etiqueta_btn_aviso')?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <object data="<?=funciones_strategix_version_url_random_base_url($archivo)?>" type="application/pdf" width="100%" height="500px">
                <p>Tu navegador no tiene el plugin para previsualizar documentos pdf.</p>
                <p>Puedes descargarte el archivo desde <a href="<?=base_url($archivo)?>?v=1">aquí</a></p>
            </object>
      </div>
    </div>
  </div>
