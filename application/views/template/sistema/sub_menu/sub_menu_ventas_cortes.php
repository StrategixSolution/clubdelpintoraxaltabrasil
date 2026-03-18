<?php

/*
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             *
 * @programmer  Luis Felipe Rangel                          *
 * @CreateDate 09 MARZO 2026 09:00:00                       *
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>


<div class="col-lg-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("CorteAuditoriaVentas") ?>">
        <button type="button" class="btn btn-gray"><?=$this->lang->line('menu_submenu_admin_corte_auditoria_ventas')?>
        </button>
    </a>
</div>
<div class="col-lg-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("CorteGanadoresVentas") ?>">
        <button type="button" class="btn btn-gray"><?=$this->lang->line('menu_submenu_admin_reposicion_prodcutos_generacion_ganadores')?>
        </button>
    </a>
</div>
<div class="col-lg-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("CorteVentasBimestral") ?>">
        <button type="button" class="btn btn-gray">
            <?=$this->lang->line('menu_submenu_admin_cortes_bimestral')?>
        </button>
    </a>
</div>
<!--<div class="col-lg-3">
    <a href="<?php echo funciones_strategix_version_url_random_base_url("CortesVentasPromociones") ?>">
        <button type="button" class="btn btn-gray">
            <?=$this->lang->line('menu_submenu_admin_cortes_promociones')?>
        </button>    
    </a>
</div>-->


 
