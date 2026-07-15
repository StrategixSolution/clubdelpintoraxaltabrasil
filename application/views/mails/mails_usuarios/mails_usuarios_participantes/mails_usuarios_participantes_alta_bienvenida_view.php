<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="es">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title><?= $this->lang->line('recupera_clave_mail_titulo') ?></title><!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]>
<noscript>
         <xml>
           <o:OfficeDocumentSettings>
           <o:AllowPNG></o:AllowPNG>
           <o:PixelsPerInch>96</o:PixelsPerInch>
           </o:OfficeDocumentSettings>
         </xml>
      </noscript>
<![endif]-->
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        .es-button {
            mso-style-priority: 100 !important;
            text-decoration: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .es-desk-hidden {
            display: none;
            float: left;
            overflow: hidden;
            width: 0;
            max-height: 0;
            line-height: 0;
            mso-hide: all;
        }

        @media only screen and (max-width:600px) {

            p,
            ul li,
            ol li,
            a {
                line-height: 150% !important
            }

            h1,
            h2,
            h3,
            h1 a,
            h2 a,
            h3 a {
                line-height: 120% !important
            }

            h1 {
                font-size: 30px !important;
                text-align: left
            }

            h2 {
                font-size: 24px !important;
                text-align: left
            }

            h3 {
                font-size: 20px !important;
                text-align: left
            }

            .es-header-body h1 a,
            .es-content-body h1 a,
            .es-footer-body h1 a {
                font-size: 30px !important;
                text-align: left
            }

            .es-header-body h2 a,
            .es-content-body h2 a,
            .es-footer-body h2 a {
                font-size: 24px !important;
                text-align: left
            }

            .es-header-body h3 a,
            .es-content-body h3 a,
            .es-footer-body h3 a {
                font-size: 20px !important;
                text-align: left
            }

            .es-menu td a {
                font-size: 14px !important
            }

            .es-header-body p,
            .es-header-body ul li,
            .es-header-body ol li,
            .es-header-body a {
                font-size: 14px !important
            }

            .es-content-body p,
            .es-content-body ul li,
            .es-content-body ol li,
            .es-content-body a {
                font-size: 14px !important
            }

            .es-footer-body p,
            .es-footer-body ul li,
            .es-footer-body ol li,
            .es-footer-body a {
                font-size: 14px !important
            }

            .es-infoblock p,
            .es-infoblock ul li,
            .es-infoblock ol li,
            .es-infoblock a {
                font-size: 12px !important
            }

            *[class="gmail-fix"] {
                display: none !important
            }

            .es-m-txt-c,
            .es-m-txt-c h1,
            .es-m-txt-c h2,
            .es-m-txt-c h3 {
                text-align: center !important
            }

            .es-m-txt-r,
            .es-m-txt-r h1,
            .es-m-txt-r h2,
            .es-m-txt-r h3 {
                text-align: right !important
            }

            .es-m-txt-l,
            .es-m-txt-l h1,
            .es-m-txt-l h2,
            .es-m-txt-l h3 {
                text-align: left !important
            }

            .es-m-txt-r img,
            .es-m-txt-c img,
            .es-m-txt-l img {
                display: inline !important
            }

            .es-button-border {
                display: inline-block !important
            }

            a.es-button,
            button.es-button {
                font-size: 18px !important;
                display: inline-block !important
            }

            .es-adaptive table,
            .es-left,
            .es-right {
                width: 100% !important
            }

            .es-content table,
            .es-header table,
            .es-footer table,
            .es-content,
            .es-footer,
            .es-header {
                width: 100% !important;
                max-width: 600px !important
            }

            .es-adapt-td {
                display: block !important;
                width: 100% !important
            }

            .adapt-img {
                width: 100% !important;
                height: auto !important
            }

            .es-m-p0 {
                padding: 0 !important
            }

            .es-m-p0r {
                padding-right: 0 !important
            }

            .es-m-p0l {
                padding-left: 0 !important
            }

            .es-m-p0t {
                padding-top: 0 !important
            }

            .es-m-p0b {
                padding-bottom: 0 !important
            }

            .es-m-p20b {
                padding-bottom: 20px !important
            }

            .es-mobile-hidden,
            .es-hidden {
                display: none !important
            }

            tr.es-desk-hidden,
            td.es-desk-hidden,
            table.es-desk-hidden {
                width: auto !important;
                overflow: visible !important;
                float: none !important;
                max-height: inherit !important;
                line-height: inherit !important
            }

            tr.es-desk-hidden {
                display: table-row !important
            }

            table.es-desk-hidden {
                display: table !important
            }

            td.es-desk-menu-hidden {
                display: table-cell !important
            }

            .es-menu td {
                width: 1% !important
            }

            table.es-table-not-adapt,
            .esd-block-html table {
                width: auto !important
            }

            table.es-social {
                display: inline-block !important
            }

            table.es-social td {
                display: inline-block !important
            }

            .es-desk-hidden {
                display: table-row !important;
                width: auto !important;
                overflow: visible !important;
                max-height: inherit !important
            }

            .es-m-p5 {
                padding: 5px !important
            }

            .es-m-p5t {
                padding-top: 5px !important
            }

            .es-m-p5b {
                padding-bottom: 5px !important
            }

            .es-m-p5r {
                padding-right: 5px !important
            }

            .es-m-p5l {
                padding-left: 5px !important
            }

            .es-m-p10 {
                padding: 10px !important
            }

            .es-m-p10t {
                padding-top: 10px !important
            }

            .es-m-p10b {
                padding-bottom: 10px !important
            }

            .es-m-p10r {
                padding-right: 10px !important
            }

            .es-m-p10l {
                padding-left: 10px !important
            }

            .es-m-p15 {
                padding: 15px !important
            }

            .es-m-p15t {
                padding-top: 15px !important
            }

            .es-m-p15b {
                padding-bottom: 15px !important
            }

            .es-m-p15r {
                padding-right: 15px !important
            }

            .es-m-p15l {
                padding-left: 15px !important
            }

            .es-m-p20 {
                padding: 20px !important
            }

            .es-m-p20t {
                padding-top: 20px !important
            }

            .es-m-p20r {
                padding-right: 20px !important
            }

            .es-m-p20l {
                padding-left: 20px !important
            }

            .es-m-p25 {
                padding: 25px !important
            }

            .es-m-p25t {
                padding-top: 25px !important
            }

            .es-m-p25b {
                padding-bottom: 25px !important
            }

            .es-m-p25r {
                padding-right: 25px !important
            }

            .es-m-p25l {
                padding-left: 25px !important
            }

            .es-m-p30 {
                padding: 30px !important
            }

            .es-m-p30t {
                padding-top: 30px !important
            }

            .es-m-p30b {
                padding-bottom: 30px !important
            }

            .es-m-p30r {
                padding-right: 30px !important
            }

            .es-m-p30l {
                padding-left: 30px !important
            }

            .es-m-p35 {
                padding: 35px !important
            }

            .es-m-p35t {
                padding-top: 35px !important
            }

            .es-m-p35b {
                padding-bottom: 35px !important
            }

            .es-m-p35r {
                padding-right: 35px !important
            }

            .es-m-p35l {
                padding-left: 35px !important
            }

            .es-m-p40 {
                padding: 40px !important
            }

            .es-m-p40t {
                padding-top: 40px !important
            }

            .es-m-p40b {
                padding-bottom: 40px !important
            }

            .es-m-p40r {
                padding-right: 40px !important
            }

            .es-m-p40l {
                padding-left: 40px !important
            }
        }

        @media screen and (max-width:384px) {
            .mail-message-content {
                width: 414px !important
            }
        }
    </style>
</head>

<body style="width:100%;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
    <div dir="ltr" class="es-wrapper-color" lang="es" style="background-color:#E9EAE7"><!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#e9eae7"></v:fill>
			</v:background>
		<![endif]-->
        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#E9EAE7">
            <tr>
                <td valign="top" style="padding:0;Margin:0">
                    <table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-header-body" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:800px">
                                    <tr>
                                        <td align="left" style="padding:0;Margin:0">
                                            <table cellspacing="0" cellpadding="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:800px">
                                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center" style="padding:10px;Margin:0;font-size:0">
                                                                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td style="padding:0;Margin:0;border-bottom:1px solid #cccccc;background:unset;height:1px;width:100%;margin:0px"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="padding:0;Margin:0;font-size:0px"><img class="adapt-img" src="<?= funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/header.jpg") ?>" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="800"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:800px">
                                    <tr>
                                        <td align="left" bgcolor="#ffffff" style="padding:0;Margin:0;padding-top:20px;padding-bottom:25px;background-color:#ffffff"><!--[if mso]><table style="width:800px" cellpadding="0" cellspacing="0"><tr><td style="width:475px" valign="top"><![endif]-->
                                            <table cellspacing="0" cellpadding="0" align="left" class="es-left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td class="es-m-p20b" valign="top" align="center" style="padding:0;Margin:0;width:475px">
                                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr class="es-mobile-hidden">
                                                                <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-top:20px;padding-bottom:20px;font-size:0">
                                                                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td style="padding:0;Margin:0;border-bottom:0px solid #ffffff;background:unset;height:1px;width:100%;margin:0px"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-left:10px;padding-right:10px">
                                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:36px;color:#333333;font-size:24px"><strong><?= $nombre ?></strong></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;font-size:0">
                                                                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td style="padding:0;Margin:0;border-bottom:1px solid #ffffff;background:unset;height:1px;width:100%;margin:0px"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="padding:10px;Margin:0">
                                                                    <h4 style="Margin:0;line-height:21.6px;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;font-size:18px">Ya eres parte de la familia de <span style="color:#FF0000"></span><br type="_moz"></h4>
                                                                    <h4 style="Margin:0;line-height:21.6px;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;font-size:18px;color:#ff0000">Axalta Club del Pintor<br type="_moz"></h4>
                                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:27px;color:#333333;font-size:18px"><br></p>
                                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:27px;color:#333333;font-size:18px">Disfruta los beneficios que tenemos para ti.<br type="_moz"></p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td><td style="width:20px"></td><td style="width:305px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:305px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr class="es-mobile-hidden">
                                                                <td align="center" style="padding:0;Margin:0;font-size:0px"><img class="adapt-img" src="<?= funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/bienvenida.png") ?>" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="305"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" bgcolor="#e5e5e5" style="padding:0;Margin:0;background-color:#e5e5e5"><!--[if mso]><table style="width:800px" cellpadding="0" cellspacing="0"><tr><td style="width:400px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:400px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#e5e5e5" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#e5e5e5">
                                                            <tr>
                                                                <td align="center" style="padding:0;Margin:0;font-size:0px"><img class="adapt-img" src="<?= funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/datos.jpeg") ?>" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="400"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td><td style="width:400px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:400px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr class="es-mobile-hidden">
                                                                <td align="center" style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;font-size:0">
                                                                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td style="padding:0;Margin:0;border-bottom:0px solid #e5e5e5;background:unset;height:1px;width:100%;margin:0px"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="padding:10px;Margin:0">
                                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:33px;color:#333333;font-size:22px">Este es tu usuario: <strong><?= $usuario ?></strong><br type="_moz"></p>
                                                                    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:33px;color:#333333;font-size:22px">Para generar tu contraseña, da click en el botón.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="padding:10px;Margin:0"><span class="es-button-border" style="border-style:solid;border-color:#2cb543;background:#d8212f;border-width:0px;display:inline-block;border-radius:5px;width:auto"><a href="<?= funciones_strategix_version_url_random_base_url("UsuariosRecuperaCrearClave") ?>&ssfvr=<?= $sessionId ?>" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:18px;padding:10px 20px 10px 20px;display:inline-block;background:#d8212f;border-radius:5px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:21.6px;width:auto;text-align:center;mso-padding-alt:0;mso-border-alt:10px solid #d8212f">Club del Pintor</a></span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="padding:0;Margin:0"><!--[if mso]><table style="width:800px" cellpadding="0" cellspacing="0"><tr><td style="width:400px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:400px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#000000" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#000000">
                                                            <tr>
                                                                <td align="center" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:40px;padding-bottom:40px;font-size:0">
                                                                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td style="padding:0;Margin:0;border-bottom:1px solid #000000;background:unset;height:1px;width:100%;margin:0px"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="es-m-txt-c" style="Margin:0;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:20px">
                                                                    <h3 style="Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;font-size:30px;font-style:normal;font-weight:normal;color:#ffffff"><strong>¿Conoces las reglas del programa?</strong></h3>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="padding:15px;Margin:0"><span class="es-button-border" style="border-style:solid;border-color:#2cb543;background:#d8212f;border-width:0px;display:inline-block;border-radius:5px;width:auto"><a href="https://axaltaclubdelpintor.com/" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:18px;padding:10px 20px 10px 20px;display:inline-block;background:#d8212f;border-radius:5px;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:21.6px;width:auto;text-align:center;mso-padding-alt:0;mso-border-alt:10px solid #d8212f">Ir al sitio</a></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:35px;font-size:0">
                                                                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td style="padding:0;Margin:0;border-bottom:1px solid #000000;background:unset;height:1px;width:100%;margin:0px"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td><td style="width:400px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:400px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr class="es-mobile-hidden">
                                                                <td align="center" style="padding:0;Margin:0;font-size:0px"><img class="adapt-img" src="<?= funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/sitio.png") ?>" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="400"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" bgcolor="#000000" style="padding:0;Margin:0;background-color:#000000">
                                            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr class="es-mobile-hidden">
                                                    <td align="center" valign="top" style="padding:0;Margin:0;width:800px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center" style="Margin:0;padding-top:15px;padding-bottom:15px;padding-left:20px;padding-right:20px;font-size:0">
                                                                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td style="padding:0;Margin:0;border-bottom:2px solid #d8212f;background:unset;height:1px;width:100%;margin:0px"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="es-m-p10r" align="left" style="padding:0;Margin:0;padding-top:10px;padding-left:10px"><!--[if mso]><table style="width:790px" cellpadding="0" cellspacing="0"><tr><td style="width:469px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" class="es-left" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                                                <tr>
                                                    <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:469px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" bgcolor="#000000" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#000000;border-radius:10px">
                                                            <tr>
                                                                <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;padding-left:15px;font-size:0px"><img class="adapt-img" src="<?= funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/contactolatam.png") ?>" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="454"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td><td style="width:20px"></td><td style="width:301px" valign="top"><![endif]-->
                                            <table cellpadding="0" cellspacing="0" class="es-right" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:301px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr class="es-mobile-hidden">
                                                                <td align="center" style="padding:15px;Margin:0;font-size:0px"><img class="adapt-img" src="<?= funciones_strategix_version_url_random_base_url("application/views/template/sistema/imagenes/callcenter.png") ?>" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="271"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table><!--[if mso]></td></tr></table><![endif]-->
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                        <tr>
                            <td align="center" style="padding:0;Margin:0">
                                <table class="es-footer-body" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:800px">
                                    <tr>
                                        <td align="left" bgcolor="#ffffff" style="padding:0;Margin:0;background-color:#ffffff">
                                            <table cellspacing="0" cellpadding="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="left" style="padding:0;Margin:0;width:800px">
                                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center" style="padding:0;Margin:0;font-size:0px"><img class="adapt-img" src="https://epurhb.stripocdn.email/content/guids/CABINET_7b4fbbf8c15c94c636784625d23fe33b6d2138a2e88430dc5545a55cbce7caa0/images/footermarcas_UgO.png" alt style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic" width="800"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="padding:0;Margin:0">
                                            <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                <tr>
                                                    <td align="center" valign="top" style="padding:0;Margin:0;width:800px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center" style="padding:10px;Margin:0;font-size:0">
                                                                    <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td style="padding:0;Margin:0;border-bottom:1px solid #cccccc;background:unset;height:1px;width:100%;margin:0px"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>






<!-- <!DOCTYPE html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title><?= $this->lang->line('recupera_clave_mail_titulo') ?></title>
</head>
<style>
  @font-face {
    font-family: poppins;
    src: url('<?= funciones_strategix_version_url_random_base_url("application/views/template/login/fonts/poppins/Poppins-Regular.ttf") ?>');
}
</style>
<body style="font-family:'poppins',sans-serif;">
  <table width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='border:thin solid #CCC; border-radius:5px 5px 0px 0px;'>
  <tr>
    <td><img src ="<?= funciones_strategix_version_url_random_base_url("application/views/template/login/imagenes/mail_header.png") ?>" width='600' style='border-radius:5px 5px 0px 0px;'></td>
  </tr>  
   <tr>
    <td>
      <table width='550' border='0' align='center' cellpadding='0' cellspacing='0' style='padding: 0px 10px 40px 10px; text-align: center;'>
        <tr style="margin:20px 0px 0px 0px; text-align: center;">
          <td>
            <h4 style="text-align: center; margin:0px;"><?= $nombre ?></h4>
            <p style="font-size: 18px; text-align: center; margin:20px 0px;">Ya eres parte de la familia de <b style="color:#c82127">Axalta Club del Pintor</b></p>
            <h4 style="text-align: center;">Este es tu usuario:<b style="color:#000000;"> <span><?= $usuario ?></span></b></h4>
            <p style="font-size: 18px; text-align: center; margin:20px 0px;">Para generar tu contraseña, da click <b style="color:#c82127"><a href="<?= funciones_strategix_version_url_random_base_url("UsuariosRecuperaCrearClave") ?>&ssfvr=<?= $sessionId ?>" style=" text-decoration: none; ">aquí</a></b></p>
            <p style="font-size: 14px; text-align: center; margin:20px 0px;">Disfruta los beneficios que tenemos para ti.</p>
          </td> 
        </tr>
      </table>
    </td>
  </tr>
 <tr>
    <td><img src ="<?= funciones_strategix_version_url_random_base_url("application/views/template/login/imagenes/mail_footer.png") ?>" width='600'></td>
  </tr>  
  </table>
  </font>
</body>
</html> -->