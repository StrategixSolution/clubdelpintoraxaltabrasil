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
          url: 'usuarios/usuarios_registro_maestro_pintor/usuarios_registro_maestro_pintor/usuarios_registro_maestro_pintor_ajax_add_qr',
          dataType: 'json',
          data: {code_qr:qrCodeMessage},
          success: function(dat){           
           $("#myModal").modal("hide");
           $("#txt_qr").val(dat);
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
