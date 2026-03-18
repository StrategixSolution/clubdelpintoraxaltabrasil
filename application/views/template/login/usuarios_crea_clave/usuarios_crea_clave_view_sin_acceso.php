<section id="login">
        <div class="login-container animate__animated animate__fadeIn">
            <div class="login-form">
                <div class="row">            
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="logo-secondary">
                                    <img src="application/views/template/login/imagenes/logo_continental.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-30">
                            <div class="col-lg-8 col-md-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p><?=$this->lang->line('usuarios_crea_clave_controller_lang_titulo')?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p><small><?=$this->lang->line('usuarios_crea_clave_controller_lang_msg_acceso_denegado')?></small</p>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-50">
                                    <div class="col-3">
                                        <div class="d-grid gap-2">
                                        <a href="<?php echo base_url("login") ?>"><button type="button" class="btn btn-conticlub"><?=$this->lang->line('usuarios_crea_clave_controller_lang_btn_login')?></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>