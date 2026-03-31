<?php

/* 
 * Sistema Web Responsivo CDPBR 					*
 * @author	Strategic Solutions S.A. de C.V             	* 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <link rel="shortcut icon" href="<?=$site_icon?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?=$this->config->item("site_title");?></title>    
        <!-- jquery-3.5.1  --> 
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/jquery/jquery-3.5.1.js")?>" type="text/javascript"></script>          
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?=funciones_strategix_version_url_random_base_url("vendors/bootstrap/bootstrap.min.css")?>"> 
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/bootstrap/bootstrap.bundle.min.js")?>" type="text/javascript"></script>   
        <!-- Fontawesome -->
        <link rel="stylesheet" href="<?=funciones_strategix_version_url_random_base_url("vendors/fontawesome/font-awesome.min.css")?>">  
        <link rel="stylesheet" href="<?=funciones_strategix_version_url_random_base_url("vendors/fontawesome/css/all.min.css")?>">  
        <link rel="stylesheet" href="<?=funciones_strategix_version_url_random_base_url("vendors/fontawesome/js/all.min.js")?>">  
        <!-- Bootstrap Date-Picker Plugin -->
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/datepicker/bootstrap-datepicker.min.js")?>" type="text/javascript"></script>
        <link href="<?=funciones_strategix_version_url_random_base_url("vendors/datepicker/bootstrap-datepicker3.css")?>" rel="stylesheet" type="text/css"/>
        <!-- Chart JS -->
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/chartjs/chart.js")?>" type="text/javascript"></script>
        <!-- Sweet Alert 2 -->
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/sweetalert/sweetalert2.all.min.js")?>" type="text/javascript"></script>
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/sweetalert/sweetalert2.min.js")?>" type="text/javascript"></script>
        <link rel="stylesheet" href="<?=funciones_strategix_version_url_random_base_url("vendors/sweetalert/sweetalert2.min.css")?>"> 
        <!-- Datatables -->
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/datatables/datatables.min.js")?>" type="text/javascript"></script>
        <link href="<?=funciones_strategix_version_url_random_base_url("vendors/datatables/datatables.min.css")?>" rel="stylesheet" type="text/css"/>
        <!-- Chosen -->
        <link rel="stylesheet" href="<?=funciones_strategix_version_url_random_base_url("vendors/chosen/chosen.css")?>">
        <link rel="stylesheet" href="<?=funciones_strategix_version_url_random_base_url("vendors/chosen/docsupport/prism.css")?>">
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/chosen/chosen.jquery.js")?>" type="text/javascript"></script>
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/chosen/docsupport/prism.js")?>" type="text/javascript" charset="utf-8"></script>
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/chosen/docsupport/init.js")?>" type="text/javascript" charset="utf-8"></script>
        <!-- Iconify -->
        <script src="<?=funciones_strategix_version_url_random_base_url("vendors/iconify/iconify.min.js")?>" type="text/javascript"></script>
        <!-- Animate -->
        <link href="<?=funciones_strategix_version_url_random_base_url("vendors/animate/animate.min.css")?>" rel="stylesheet" type="text/css"/> 
        <!-- Stylesheet -->   
        <link rel="stylesheet" href="<?=funciones_strategix_version_url_random_base_url("application/views/template/login/css/styles.css")?>">  
        <link rel="stylesheet" href="<?=funciones_strategix_version_url_random_base_url("application/views/template/login/css/icon-font.min.css")?>">
        <!-- GENERAL -->
        <script src="<?=funciones_strategix_version_url_random_base_url("application/views/template/sistema/js/general.js")?>" type="text/javascript" charset="utf-8"></script>     
        <!-- CAPTCHA -->
        <script src="https://www.google.com/recaptcha/api.js?render=<?=$this->config->item('google_key')?>"></script>   
        </head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-1L8C9MGYW8"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'G-1L8C9MGYW8');
		</script>	        
        <body class="main">
            <div class="row" style="display: none; position: fixed; width: 100%; height: 150%; background-color: #111; z-index: 9999; opacity: .5; margin: -180px 0px 0px 0px;" id='loader_panel'>
                <img src="<?=funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/cargando.gif")?>" style='width: 400px; height: 400px; margin: auto auto;'>
            </div> 
    