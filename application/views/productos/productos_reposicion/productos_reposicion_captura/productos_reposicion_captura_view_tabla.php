<?php

/* 
 * Sistema Web Responsivo CDPBR  *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 4 May. 2026 15:31:56                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<table class="table table-bordered table-striped table-axalta" id="tabla_resultado">
    <thead>
        <th><?=$this->lang->line('productos_reposicion_captura_controller_lang_tabla_premio')?></th>
        <th><?=$this->lang->line('productos_reposicion_captura_controller_lang_tabla_descripcion')?></th>
        <th><?=$this->lang->line('productos_reposicion_captura_controller_lang_tabla_codigo')?></th>
        <th><?=$this->lang->line('productos_reposicion_captura_controller_lang_tabla_presentacion')?></th>
        <th><?=$this->lang->line('productos_reposicion_captura_controller_lang_tabla_precio')?></th>        
    </thead>
    <tbody>
        <?=$tabla?>
    </tbody>
</table>

  