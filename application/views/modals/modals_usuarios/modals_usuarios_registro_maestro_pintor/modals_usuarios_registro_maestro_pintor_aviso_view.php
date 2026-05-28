<?php
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
