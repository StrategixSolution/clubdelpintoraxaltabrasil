<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_reportes')?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteMaestrosPintores"); ?>"><?=$this->lang->line('menu_submenu_reporte_maestros_pintores')?></a></li>
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReportePersonalTienda"); ?>">RELATÓRIO DA EQUIPE DA LOJA</a></li>
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteDistribuidores"); ?>"><?=$this->lang->line('menu_submenu_reportes_distribuidoras')?></a></li> 
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteVentasRegistradas"); ?>"><?=$this->lang->line('menu_submenu_reporte_ventas_registradas')?></a></li>
        </ul>
        </li>
