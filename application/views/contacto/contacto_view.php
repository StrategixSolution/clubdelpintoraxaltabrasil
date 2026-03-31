<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 29 jun. 2022 23:36:58 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section id="contacto">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?=$this->lang->line('contacto_controller_titulo')?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="panel-white">
                <div class="row">
                    <div class="col-lg-12">
                        <h3><?=$this->lang->line('contacto_controller_linea_1')?></h3>
                    </div>
                </div>
                <div class="row justify-content-center mt-60">
                    <div class="col-lg-4">
                        <div class="contact">
                            <i class="fas fa-headset"></i>
                            <p><?=$this->lang->line('contacto_controller_hiorario')?></p>
                        </div>
                    </div>
                </div>
                <div class="row mt-60">
                    <div class="col-lg-4">
                        <div class="contact">
                            <i class="fas fa-envelope"></i>
                            <p><a href="mailto:contacto@clubdelpintoraxalta.com.br" class="txt-rojo">contacto@clubdelpintoraxalta.com.br</a></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact">
                            <i class="fas fa-phone"></i>
                            <p><a href="tel:9999999999999999">9999999999999999</a></p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="contact">
                            <i class="fab fa-whatsapp"></i>
                            <p><a href="https://wa.me/9999999999999999">9999999999999999</a></p>
                        </div>
                    </div>
                </div>
                <div class="row mt-40">
                    <div class="col-lg-12">
                        <h4><?=$this->lang->line('contacto_controller_comentario')?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>