<?php

/* 
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 09 MARZO 2026 09:00:00                       * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="menuprincipal" id="menuprincipal">
    <div class="main-menu">
        <div class="header-menu">
            <div class="container">
                <section class="row top-bar">
                    <div class="col-lg-3">
                        <div class="logo">
                            <a href="inicio">
                                <img src="<?= funciones_strategix_version_url_random_base_url('application/views/template/sistema/imagenes/logo.png') ?>" alt="" class="mainlogo">
                                <img src="<?= funciones_strategix_version_url_random_base_url('application/views/template/sistema/imagenes/cdp2.png') ?>" alt="" class="logocdp">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 pt-10">
                        <div class="row justify-content-end">
                            <div class="col-lg-4">
                                <?PHP if ($this->session->userdata(funciones_strategix_sitio_alias("s_perfil_id"))<=5){ ?>
                                    <span class="txt-amarillo iconos-header"></span>
                                <?PHP } else { ?>
                                    <span class="txt-amarillo iconos-header"> <?PHP if ($this->session->userdata(funciones_strategix_sitio_alias("s_autos"))==1){ ?><a href="SegmentoAuto"> <i class="fas fa-car-side"></i> </a><?PHP } if ($this->session->userdata(funciones_strategix_sitio_alias("s_camiones"))==1){?>  <a href="SegmentoCamion"><i class="fas fa-truck-moving"></i> </a> <?PHP } if ($this->session->userdata(funciones_strategix_sitio_alias("s_industrial"))==1){?><a href="SegmentoIndustrial"><i class="fas fa-industry"></i> </a><?PHP } ?></span>
                                <?PHP } ?>    
                            </div>
                            <div class="col-lg-5" style="display: flex; align-items: center;">
                                <div class="profile txt-left">
                                    <span><b><?= $usuario_nombre ?></b><br><?= $perfil_nombre ?></i></span>
                                </div>
                            </div>
                            <div class="col-lg-2 logout">
                                <a href="logout"><span>SALIR </span> | <i class="fas fa-sign-out-alt" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg bg-mobile home-content" id="menu-home">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars" style="color: #fff;"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item" id="nav_contacto"><a class="nav-link" aria-current="page" href="<?php echo funciones_strategix_version_url_random_base_url("Reglas") ?>"><?=$this->lang->line('menu_reglas')?></a></li>  
                        <li class="nav-item" id="nav_contacto"><a class="nav-link" aria-current="page" href="<?php echo funciones_strategix_version_url_random_base_url("Productos") ?>"><?=$this->lang->line('menu_productos')?></a></li>  
                      <!--  <li class="nav-item" id="nav_noticias"><a class="nav-link" href="<?php echo funciones_strategix_version_url_random_base_url("NoticiasCirculares") ?>">NOTICIAS</a></li> 
                        <li class="nav-item" id="nav_tutoriales"><a class="nav-link" href="<?php echo funciones_strategix_version_url_random_base_url("TutorialesInternos") ?>">TUTORIALES</a></li> -->
                        <!-- <li class="nav-item dropdown" id="nav_catalogos">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_bases_programas')?></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="Reglas"><?=$this->lang->line('menu_bases_programas_submenu_reglas')?></a></li> 
                                <li><a class="dropdown-item" href="ProductosParticipantes"><?=$this->lang->line('menu_bases_programas_submenu_productos_participantes')?></a></li> 
                            </ul>
                        </li> -->
                        <!--<li class="nav-item dropdown" id="nav_catalogos">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_noticias_comunicados')?></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#"><?=$this->lang->line('menu_noticias_comunicados_submenu_promociones_especiales')?></a></li> 
                                <li><a class="dropdown-item" href="#"><?=$this->lang->line('menu_noticias_comunicados_submenu_calendario')?></a></li> 
                            </ul>
                        </li>-->
                        <?= $menu ?>
                        <!--<li class="nav-item" id="nav_redes_sociales"><a class="nav-link" href="#"><?=$this->lang->line('menu_dashboard')?></a></li>--> 
                        <li class="nav-item" id="nav_contacto"><a class="nav-link" aria-current="page" href="<?php echo funciones_strategix_version_url_random_base_url("Contacto") ?>"><?=$this->lang->line('menu_contacto')?></a></li>   
                        <!-- <li class="nav-item dropdown" id="nav_catalogos">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?=$this->lang->line('menu_legal')?></a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="AvisoPrivacidad"><?=$this->lang->line('menu_aviso_privacidad')?></a></li>                                 
                            </ul>
                        </li>                         -->
                        
                        <li class="nav-item" id="nav_contacto"><a class="nav-link" aria-current="page" href="<?php echo funciones_strategix_version_url_random_base_url("UsuariosActualizarDatos") ?>"><?=$this->lang->line('menu_perfil')?></a></li>
                    </ul>
                </div>                        
            </div>
        </nav>

    </div>
</div>
<script>
    $(document).ready(function() {
        var menu_hide = '<?= $menu_hide ?>';
        if (menu_hide == 1) {
            $("#menu-home").show();
            $("#menuCampana").show();
        } else {
            $("#menu-home").hide();
            $("#menuCampana").hide();
        }
    });
</script>
<div class="maincontent">