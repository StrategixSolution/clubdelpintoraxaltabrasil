<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-lg-6 menu-cortes mt-3 mb-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("CargaProductosPremios") ?>">
        <button type="button" class="btn btn-axalta">
            <?=$this->lang->line('menu_submenu_admin_reposicion_prodcutos_premios_productros')?>
        </button>    
    </a>
</div>
<div class="col-lg-6 menu-cortes mt-3 mb-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("RelacionPremiosProductos") ?>">
        <button type="button" class="btn btn-axalta">
            <?=$this->lang->line('menu_submenu_admin_reposicion_prodcutos_premios_relacion')?>
        </button>
    </a>
</div>
<!--<div class="col-lg-4 menu-cortes mt-3 mb-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("DescargaReposicionProductos") ?>">
        <button type="button" class="btn btn-axalta"><?=$this->lang->line('menu_submenu_admin_reposicion_prodcutos_descarga')?>
        </button>
    </a>
</div>-->