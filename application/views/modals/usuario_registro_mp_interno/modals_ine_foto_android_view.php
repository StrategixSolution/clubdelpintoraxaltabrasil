<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Enrique Arce Rosas  * 
 * @CreateDate 1 jun. 2022 11:29:40 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <video id="video" style="width: 100%" muted playsinline autoplay></video>
            <br>
            <button id="boton"><span  class="iconify" data-icon="ant-design:camera-filled"></span></button>
            <p id="estado" style="display: none;"></p>
            <canvas id="canvas" style="display: none;"></canvas>
        </div>
    </div>
</div>

<script type="text/javascript">
  function tieneSoporteUserMedia() {
      return !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia);
  }
  function _getUserMedia() {
      return (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);
  }
  var $video = document.getElementById("video"),
      $canvas = document.getElementById("canvas"),
      $boton = document.getElementById("boton"),
      $estado = document.getElementById("estado");
  if (tieneSoporteUserMedia()) {
    _getUserMedia({video:{facingMode:"environment"/*{exact:"environment"}*/}},
      function(stream) {
        
        //console.log("Permiso concedido");
        $video.srcObject = stream;
        $video.play();
        $boton.addEventListener("click", function() {
            $('#loader_panel').show();
          $("#boton").attr('disabled',true);
          $video.pause();
          var contexto = $canvas.getContext("2d");
          $canvas.width = $video.videoWidth;
          $canvas.height = $video.videoHeight;
          contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);
          var foto = $canvas.toDataURL(); //Esta es la foto, en base 64
          $("#myModal").modal("hide");
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "usuarios/usuarios_registro_mp_interno/usuarios_registro_mp_interno_controller/ine_controller_guarda_foto", true);
          xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhr.send(encodeURIComponent(foto));
          xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
              $("#txt_ine_foto").val(xhr.responseText);
              
              for (let track of stream.getTracks()) { 
               track.stop();
                $('#loader_panel').hide();
              }
            }
          };
          //$video.stop();
        });
      },
      function(error) {
        Swal.fire({ icon: 'error',title: '',text: 'No se puede acceder a la cámara, o no diste permiso.'});
        setTimeout('$("#myModal").modal("hide")', 350);
      }
    );
  } else {
    Swal.fire({ icon: 'error',title: '',text: 'Lo siento. Tu navegador no soporta esta característica'});
    setTimeout('$("#myModal").modal("hide")', 350);
  }

  function cerrar(){
    $("#myModal").modal("hide");
  }
</script>