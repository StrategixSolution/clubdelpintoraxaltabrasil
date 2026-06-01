<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_reportes')?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("DescargaReposicionProductos"); ?>"><?=$this->lang->line('menu_submenu_reposicion_productos_descarga')?></a></li> 
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteDistribuidores"); ?>"><?=$this->lang->line('menu_submenu_reportes_distribuidoras')?></a></li> 
            <!--  <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteVentasPersonalTop"); ?>"><?=$this->lang->line('menu_submenu_ventas_personal_top')?></a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteGanadores"); ?>"><?=$this->lang->line('menu_submenu_reporte_ganadores')?></a></li>
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteReposicionProductos"); ?>">REPORTE DE REPOSICIÓN DE PRODUCTOS </a></li> 
				<li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteDistribuidoresAdmin1"); ?>">REPORTE DISTRIBUIDORES ADMINISTRADOR 1</a></li>-->
            </ul>
        </li> 