 <?php

/* 
 * Sistema Web Responsivo CDPBR 					*
 * @author	Strategic Solutions S.A. de C.V             	* 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Ene. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<header class="headerPublic">
    <div class="row">
        <div class="menusuperior">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-8" style="text-align:center;">
                    <div class="logo">
                        <a href="<?php echo funciones_strategix_version_url_random_base_url("Inicio") ?>"><img src="<?=base_url('application/views/template/sistema/imagenes/logo.png')?>" alt="" class="logoAxalta"></a>
                        <a href="<?php echo funciones_strategix_version_url_random_base_url("Inicio") ?>"><img src="<?=base_url('application/views/template/sistema/imagenes/logoCDP.png')?>" alt="" class="logoCDP"></a>
                    </div>
                </div>
                <div class="col-lg-2 col-3">
                    <div class="salir-desktop">
                        <h3><a  href="login">IR A LOGIN <i class="fas fa-sign-out-alt"></i></a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>