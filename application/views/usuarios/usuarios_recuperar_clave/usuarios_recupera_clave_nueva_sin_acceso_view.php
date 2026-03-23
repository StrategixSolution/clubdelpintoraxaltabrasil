<?php

/* 
 * Sistema Web Responsivo CDPMEX                            *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 ABRIL 2025 09:00:00                       * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<section id="login">
    <div class="login-container animate__animated animate__fadeIn">
        <div class="row">            
            <div class="col-lg-6 col-12 txt-center">
                <div class="logo-main">
                    <img src="application/views/template/login/imagenes/logo.png" alt="">
                    <h2><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_titulo_crea_clave')?></h2>
                </div>
                <div class="logo-main-responsive">
                    <div class="row">
                        <div class="col-6">
                            <img src="application/views/template/login/imagenes/logo.png" alt="" class="logo1">
                        </div>
                        <div class="col-6">
                            <img src="application/views/template/login/imagenes/cdp.png" alt="" class="logo2">
                        </div>
                    </div>
                    <div class="col-12">
                        <h2><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_marca')?></h2>
                    </div>
                    <div class="col-12">
                        <h3><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_nueva_ingreso')?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="logo-secondary">
                            <img src="application/views/template/login/imagenes/cdp.png" alt="">
                        </div>
                        <div class="logo-secondary-responsive">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-20 form-login">
                    <div class="col-lg-12">
                        <h2><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_titulo_crea_clave')?></h2>
                        <p><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_msg_acceso_denegado')?></p>
                    </div>
                    <div class="col-lg-6 col-8 mt-30">
                        <a href="<?php echo funciones_strategix_version_url_random_base_url("login") ?>">
                            <div class="d-grid gap-2">                            
                                <button type="button" class="btn btn-black"><?=$this->lang->line('usuarios_recupera_clave_nueva_controller_lang_btn_login')?></button>
                            </div>    
                        </a>
                    </div>
                </div>            
            </div>
        </div>
    </div>
</section>