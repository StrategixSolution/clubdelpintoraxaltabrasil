<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>


<div class="col-lg-3 menu-cortes mt-3 mb-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("CorteAuditoriaVentas") ?>">
        <button type="button" class="btn btn-axalta"><?= $this->lang->line('menu_submenu_admin_corte_auditoria_ventas') ?>
        </button>
    </a>
</div>
<div class="col-lg-3 menu-cortes mt-3 mb-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("CorteGanadoresVentas") ?>">
        <button type="button"
            class="btn btn-axalta"><?= $this->lang->line('menu_submenu_admin_reposicion_prodcutos_generacion_ganadores') ?>
        </button>
    </a>
</div>
<div class="col-lg-3 menu-cortes mt-3 mb-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("CorteVentasBimestral") ?>">
        <button type="button" class="btn btn-axalta">
            <?= $this->lang->line('menu_submenu_admin_cortes_bimestral') ?>
        </button>
    </a>
</div>
<div class="col-lg-3 menu-cortes mt-3 mb-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("AperturaCierreRepProd") ?>">
        <button type="button" class="btn btn-axalta">
            <?= $this->lang->line('menu_submenu_admin_apertura_cierre_reposicion_producto') ?>
        </button>
    </a>
</div>