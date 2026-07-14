<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title><?=$this->lang->line('recupera_clave_mail_titulo')?></title>
</head>
<style>
  @font-face {
    font-family: poppins;
    src: url('<?=funciones_strategix_version_url_random_base_url("application/views/template/login/fonts/poppins/Poppins-Regular.ttf")?>');
}
</style>
<body style="font-family:'poppins',sans-serif;">
  <table width='600' border='0' align='center' cellpadding='0' cellspacing='0' style='border:thin solid #CCC; border-radius:5px 5px 0px 0px;'>
  <tr>
    <td><img src ="<?=funciones_strategix_version_url_random_base_url("application/views/template/login/imagenes/mail_header.png")?>" width='600' style='border-radius:5px 5px 0px 0px;'></td>
  </tr>  
   <tr>
    <td>
      <table width='550' border='0' align='center' cellpadding='0' cellspacing='0' style='padding: 0px 10px 40px 10px; text-align: center;'>
        <tr style="margin:20px 0px 0px 0px; text-align: center;">
          <td>
            <h4 style="text-align: center; margin:0px;"><?=$nombre?></h4>
            <p style="font-size: 18px; text-align: center; margin:20px 0px;">Ya eres parte de la familia de <b style="color:#c82127">Axalta Club del Pintor</b></p>
            <h4 style="text-align: center;">Este es tu usuario:<b style="color:#000000;"> <span><?=$usuario?></span></b></h4>
            <p style="font-size: 18px; text-align: center; margin:20px 0px;">Para generar tu contraseña, da click <b style="color:#c82127"><a href="<?=funciones_strategix_version_url_random_base_url("UsuariosRecuperaCrearClave")?>ssfvr=<?=$sessionId?>" style=" text-decoration: none; ">aquí</a></b></p>
            <p style="font-size: 14px; text-align: center; margin:20px 0px;">Disfruta los beneficios que tenemos para ti.</p>
          </td> 
        </tr>
      </table>
    </td>
  </tr>
 <tr>
    <td><img src ="<?=funciones_strategix_version_url_random_base_url("application/views/template/login/imagenes/mail_footer.png")?>" width='600'></td>
  </tr>  
  </table>
  </font>
</body>
</html>
