<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 15 jun. 2026 16:59:17 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-lg-4">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("CargaProductosPremios") ?>">
        <button type="button" class="btn btn-gray">
            <?=$this->lang->line('menu_submenu_admin_reposicion_prodcutos_premios_productros')?>
        </button>    
    </a>
</div>
<div class="col-lg-4">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("RelacionPremiosProductos") ?>">
        <button type="button" class="btn btn-gray">
            <?=$this->lang->line('menu_submenu_admin_reposicion_prodcutos_premios_relacion')?>
        </button>
    </a>
</div>
<!--<div class="col-lg-4">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("DescargaReposicionProductos") ?>">
        <button type="button" class="btn btn-gray"><?=$this->lang->line('menu_submenu_admin_reposicion_prodcutos_descarga')?>
        </button>
    </a>
</div>-->