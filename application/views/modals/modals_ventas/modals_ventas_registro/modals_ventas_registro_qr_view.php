<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script src="vendors/qrscan/html5-qrcode.min.js"></script>
<style>
  .result{
    background-color: green;
    color:#fff;
    padding:20px;
  }
  .row{
    display:flex;
  }
</style>
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?=$this->lang->line('auditoriaregistroferreteriasext_texto_titulo_modal_factura')?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div style="width:500px;" id="reader"></div>
            </div>
          </div>
        </div>
    </div>  
</div>  


<script type="text/javascript">
    function onScanSuccess(qrCodeMessage) {
      $.ajax({
            type: 'POST',
            url: 'ventas/ventas_registro/ventas_registro_controller/ventas_registro_ajax_qr_retorno',
            dataType: 'json',
            data: {code_qr:qrCodeMessage},
            success: function(data){
                if (data.resultado==0){
                    Swal.fire({ icon: 'error',title: 'Error',text: '<?=$this->lang->line('ventas_registro_controller_msg_qr_error')?>'}); 
                    $("#txt_qr").val('');
                    $("#div_datos_maestro_pintor").html('');
//                    $("#div_detalle").hide();
                    $("#div_maestro_pintor").hide();
                } else {                    
                    $("#div_datos_maestro_pintor").html(data.datos_maestro_pintor);
                    $("#div_maestro_pintor").show();
                    $("#txt_qr").val(data.qr);                    
                    $("#div_detalle").show();
                }
                $("#myModal").modal("hide");
            }
        });
        html5QrcodeScanner.clear();
    }
    
   function onScanError(errorMessage) {
  //handle scan error
}
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>
 