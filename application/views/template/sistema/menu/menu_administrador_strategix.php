<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>
   <li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_admin')?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                 <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Distribuidores")?>"><?=$this->lang->line('menu_submenu_admin_distribuidores')?></a></li> 
            </ul>
        </li> 
     
        <li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_auditorias')?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("AuditoriaPrimera"); ?>"><?=$this->lang->line('menu_submenu_auditorias_primera')?></a></li> 
               <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("EnvioCorreos"); ?>"><?=$this->lang->line('menu_submenu_auditorias_envio_correos')?></a></li> 
                 <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("AuditoriaSegunda"); ?>"><?=$this->lang->line('menu_submenu_auditorias_segunda')?></a></li>
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("AuditoriaPromociones"); ?>"><?=$this->lang->line('menu_submenu_auditorias_promociones')?></a></li> 
            </ul>
        </li> 
        <li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_reportes')?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("DescargaReposicionProductos"); ?>"><?=$this->lang->line('menu_submenu_reposicion_productos_descarga')?></a></li> 
             <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteDistribuidores"); ?>"><?=$this->lang->line('menu_submenu_reportes_distribuidoras')?></a></li> 
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteMaestrosPintores"); ?>"><?=$this->lang->line('menu_submenu_reporte_maestros_pintores')?></a></li>
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteVentasRegistradas"); ?>"><?=$this->lang->line('menu_submenu_reporte_ventas_registradas')?></a></li>
             <!--    <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteVentasPersonalTop"); ?>"><?=$this->lang->line('menu_submenu_ventas_personal_top')?></a></li> 
				<li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteGanadores"); ?>"><?=$this->lang->line('menu_submenu_reporte_ganadores')?></a></li>
				<li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteVentasRegistradas"); ?>">REPORTE VENTAS REGISTRADAS</a></li> 
               <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteReposicionProductos"); ?>">REPORTE DE REPOSICIÓN DE PRODUCTOS </a></li> 
                  <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteReposicionProductoZonas"); ?>">REPORTE DE REPOSICIÓN DE PRODUCTOS POR ZONA </a></li>
				  <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteDistribuidoresAdmin1"); ?>">REPORTE DISTRIBUIDORES ADMINISTRADOR 1</a></li>-->
            </ul>
        </li>