<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<style type="text/css">
  #cam_boton_foto {
    background-color: #bbbbbb;
    padding: 10px;
    border-radius: 20px;
    border: none;
    color: #EEEEEE;
    font-size: 28px;
  }
  #cam_boton_voltear {
    background-color: #555555;
    padding: 10px;
    border-radius: 20px;
    border: none;
    color: #EEEEEE;
    font-size: 22px;
    margin-left: 8px;
  }
  #cam_video {
    border: solid 2px #bbbbbb;
    border-radius: 10px;
    width: 100%;
    max-width: 490px;
    display: block;
  }
  #cam_canvas { display: none; }
  #cam_error  { color: #cc0000; margin-top: 8px; display: none; }
</style>

<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <video id="cam_video" autoplay playsinline muted></video>
            <canvas id="cam_canvas"></canvas>
            <p id="cam_error"></p>
            <br>
            <button id="cam_boton_foto">
                <span class="iconify" data-icon="ant-design:camera-filled"></span>
            </button>
            <button id="cam_boton_voltear" title="Cambiar cámara">
                <span class="iconify" data-icon="ant-design:sync-outlined"></span>
            </button>
        </div>
    </div>
</div>

<script>
(function () {
    var _facingMode  = 'environment'; // trasera por defecto
    var _stream      = null;
    var video        = document.getElementById('cam_video');
    var canvas       = document.getElementById('cam_canvas');
    var errorEl      = document.getElementById('cam_error');

    function mostrarError(msg) {
        errorEl.textContent = msg;
        errorEl.style.display = 'block';
    }

    function iniciarCamara() {
        // Detener stream anterior si existe
        if (_stream) {
            _stream.getTracks().forEach(function (t) { t.stop(); });
            _stream = null;
        }
        errorEl.style.display = 'none';

        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            mostrarError('Tu navegador no soporta acceso a la cámara.');
            return;
        }

        navigator.mediaDevices.getUserMedia({
            audio: false,
            video: { facingMode: { ideal: _facingMode } }
        })
        .then(function (stream) {
            _stream = stream;
            video.srcObject = stream;
            video.play();
        })
        .catch(function (err) {
            // Si falla con ideal, intentar sin restricción de facingMode
            navigator.mediaDevices.getUserMedia({ audio: false, video: true })
            .then(function (stream) {
                _stream = stream;
                video.srcObject = stream;
                video.play();
            })
            .catch(function (err2) {
                mostrarError('No se pudo acceder a la cámara: ' + err2.message);
            });
        });
    }

    function tomarFoto() {
        if (!_stream) { mostrarError('La cámara no está activa.'); return; }
        canvas.width  = video.videoWidth  || 490;
        canvas.height = video.videoHeight || 390;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        var dataUri = canvas.toDataURL('image/png');

        $('#loader_panel').show();
        $(".image-tag").val(dataUri);
        $("#myModal").modal("hide");

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "ventas/ventas_registro/ventas_registro_controller/ventas_registro_controller_ajax_guarda_foto", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(encodeURIComponent(dataUri));
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                $("#txt_ticket_foto").val(xhr.responseText);
                $('#loader_panel').hide();
            }
        };
    }

    document.getElementById('cam_boton_foto').addEventListener('click', tomarFoto);

    document.getElementById('cam_boton_voltear').addEventListener('click', function () {
        _facingMode = (_facingMode === 'environment') ? 'user' : 'environment';
        iniciarCamara();
    });

    // Liberar cámara al cerrar el modal
    $('#myModal').on('hide.bs.modal', function () {
        if (_stream) {
            _stream.getTracks().forEach(function (t) { t.stop(); });
            _stream = null;
        }
    });

    // Iniciar al cargar el modal
    $('#myModal').on('shown.bs.modal', function () {
        iniciarCamara();
    });

    // Si el modal ya está visible al cargar este script
    if ($('#myModal').hasClass('show')) {
        iniciarCamara();
    } else {
        iniciarCamara();
    }
})();
</script>
