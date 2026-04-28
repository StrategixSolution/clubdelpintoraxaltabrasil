<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 09 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>

   <li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_admin')?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                 <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Tarjetas"); ?>"><?=$this->lang->line('menu_submenu_admin_cortes_bimestral')?></a></li> 
                 <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("CargaMultimedios"); ?>"><?=$this->lang->line('menu_submenu_admin_carga_multimedia')?></a></li>
                 <!-- <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Distribuidores"); ?>"><?=$this->lang->line('menu_admin_submenu_distribuidores')?></a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Participantes"); ?>"><?=$this->lang->line('menu_admin_submenu_usuarios')?></a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("AltaTarjetas"); ?>"><?=$this->lang->line('menu_admin_submenu_tarjetas')?></a></li>
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Recompensas"); ?>"><?=$this->lang->line('menu_submenu_admin_recompensas')?></a></li>
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("CargaProductosPremios"); ?>">CARGA DE PRODUCTOS DE PREMIOS</a></li>
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("CargaPromociones"); ?>"><?=$this->lang->line('menu_submenu_admin_carga_promociones')?></a></li>
               <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("CorteAuditoriaVentas"); ?>"><?=$this->lang->line('menu_submenu_admin_cortes')?></a></li>-->
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
<!--<li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_reportes')?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteVentasPersonalTop"); ?>"><?=$this->lang->line('menu_submenu_ventas_personal_top')?></a></li> 
				<li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteGanadores"); ?>"><?=$this->lang->line('menu_submenu_reporte_ganadores')?></a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("DescargaReposicionProductos"); ?>">DESCARGA DE ARCHIVOS REPOSICIÓN DE PRODUCTOS </a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteReposicionProductos"); ?>">REPORTE DE REPOSICIÓN DE PRODUCTOS </a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteReposicionProductoZonas"); ?>">REPORTE DE REPOSICIÓN DE PRODUCTOS POR ZONA </a></li>
				<li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteDistribuidoresAdmin1"); ?>">REPORTE DISTRIBUIDORES ADMINISTRADOR 1</a></li>
            </ul>
        </li>

        <?php if ($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))==12427){ ?>
        <li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">DISTRIBUIDORA ADJs</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("DistribuidorasAdjsExcel"); ?>">CARGA EXCEL DISTRIBUIDORA ADJs</a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("DistribuidorasAdjsMail"); ?>">ENVÍO DE MAILS ADJs</a></li>
            </ul>
        </li>
        <?php } ?>-->
