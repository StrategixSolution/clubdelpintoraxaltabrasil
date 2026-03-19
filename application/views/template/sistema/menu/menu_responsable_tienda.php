<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 09 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>
<li class="nav-item" id="nav_contacto"><a class="nav-link" aria-current="page" href="<?php echo funciones_strategix_version_url_random_base_url("Registromaestropintorinterno") ?>">REGISTRO DE MAESTRO PINTOR</a></li>  
<li class="nav-item dropdown" id="nav_catalogos">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_tickets')?></a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("RegistroTickets"); ?>"><?=$this->lang->line('menu_submenu_tickets_registro_ventas')?></a></li> 
        <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("TicketsRechazados"); ?>"><?=$this->lang->line('menu_submenu_tickets_rechazados')?></a></li> 
    </ul>
</li> 
<li class="nav-item dropdown" id="nav_catalogos">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_reposicion_prodcutos')?></a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    <?php 
        $control_array = $this->session->userdata(funciones_strategix_sitio_alias('control_modulos'));
        if($control_array[1]['ControlModuloEstatus']==1){?> 
            <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReposicionProductoCaptura"); ?>"><?=$this->lang->line('menu_submenu_reposicion_productos_captura')?></a></li>
    <?php } ?> 
      <li><a class="dropdown-item" href="<?php echo funciones_strategix_version_url_random_base_url("ReporteReposicionProductos"); ?>">REPORTE DE REPOSICIÓN DE PRODUCTOS </a></li> 
    </ul>
</li> 