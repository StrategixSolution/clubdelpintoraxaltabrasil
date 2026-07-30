<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

   <li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_admin')?></a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                 <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Distribuidores")?>"><?=$this->lang->line('menu_submenu_admin_distribuidores')?></a></li>
                 <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("UsuariosParticipantes")?>"><?=$this->lang->line('menu_submenu_admin_usuarios')?></a></li>
                <!-- <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Tarjetas"); ?>"><?=$this->lang->line('menu_submenu_admin_tarjetas')?></a></li> -->
                 <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("CargaMultimedios"); ?>"><?=$this->lang->line('menu_submenu_admin_carga_multimedia')?></a></li>
                 <!-- <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Distribuidores"); ?>"><?=$this->lang->line('menu_admin_submenu_distribuidores')?></a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Participantes"); ?>"><?=$this->lang->line('menu_admin_submenu_usuarios')?></a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("AltaTarjetas"); ?>"><?=$this->lang->line('menu_admin_submenu_tarjetas')?></a></li>-->
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("Recompensas"); ?>"><?=$this->lang->line('menu_submenu_admin_recompensas')?></a></li>
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("CargaProductosPremios"); ?>"><?=$this->lang->line('menu_submenu_admin_carga_producto_premios')?></a></li>
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("CargaPromociones"); ?>"><?=$this->lang->line('menu_submenu_admin_carga_promociones')?></a></li>
               <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("CorteAuditoriaVentas"); ?>"><?=$this->lang->line('menu_submenu_admin_cortes')?></a></li>
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
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteReposicionProductos"); ?>">RELATÓRIO DE SUBSTITUIÇÃO DE PRODUTO</a></li> 
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteGanadores"); ?>"><?=$this->lang->line('menu_submenu_reporte_ganadores')?></a></li> 
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReportePersonalTienda"); ?>">RELATÓRIO DA EQUIPE DA LOJA</a></li>
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteAuditoriaVentas"); ?>">RELATÓRIO DE AUDITORIA DE VENDAS</a></li>
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteSegundaVueltaAuditoria"); ?>">RELATÓRIO DE SEGUNDA VOLTA DE AUDITORIA</a></li>
            <!-- <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteVentasPersonalTop"); ?>"><?=$this->lang->line('menu_submenu_ventas_personal_top')?></a></li>
				
                
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteReposicionProductoZonas"); ?>">REPORTE DE REPOSICIÓN DE PRODUCTOS POR ZONA </a></li>
				<li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteDistribuidoresAdmin1"); ?>">REPORTE DISTRIBUIDORES ADMINISTRADOR 1</a></li>-->
            </ul>
        </li>

      <!--  <?php if ($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))==12427){ ?>
        <li class="nav-item dropdown" id="nav_catalogos">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">DISTRIBUIDORA ADJs</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("DistribuidorasAdjsExcel"); ?>">CARREGAR EXCEL DISTRIBUIDORA ADJs</a></li> 
                <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("DistribuidorasAdjsMail"); ?>">ENVIO DE MAILS ADJs</a></li>
            </ul>
        </li>
        <?php } ?>-->
