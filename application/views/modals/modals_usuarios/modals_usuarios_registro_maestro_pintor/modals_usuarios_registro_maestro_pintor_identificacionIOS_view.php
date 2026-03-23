<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<style type="text/css">
  #boton{
    background-color: #bbbbbb;
    padding: 10px;
    border-radius: 20px;
    border:none;
    color: #EEEEEE;
    font-size: 28px
  }
  #video{
    border:solid 2px #bbbbbb;
    border-radius: 10px
  }
</style>

<script type="text/javascript" src=<?=funciones_strategix_version_url_random_base_url("/vendors/iphonecam/webcam.js")?>></script>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="my_camera"></div>
            <br>
            <button id="boton"><span  class="iconify" data-icon="ant-design:camera-filled"></span></button>
            <p id="estado" style="display: none;"></p>
            <canvas id="canvas" style="display: none;"></canvas>
        </div>
    </div>
</div>
<script language="JavaScript">
    $('#boton').click(function(){take_snapshot();});     
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'png',
        jpeg_quality: 100
    });
    Webcam.attach( '#my_camera' );
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
          $(".image-tag").val(data_uri);
          Swal.fire({ icon: 'info',title: '',text: 'Enviando foto, por favor espera'});
          $("#myModal").modal("hide");
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "usuarios/usuarios_maestro_pintor_registro/usuarios_maestro_pintor_registro_controller/usuarios_maestro_pintor_registro_controller_ajaxFotoId", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.send(encodeURIComponent(data_uri));
          xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
              Swal.fire({ icon: 'info',title: '',text: 'La foto se envió correctamente, espere a que refresque la página para continuar'});
              console.log(xhr);
              $("#txt_identificacion").val(xhr.responseText);
            }
          };
        });
    }
</script>
