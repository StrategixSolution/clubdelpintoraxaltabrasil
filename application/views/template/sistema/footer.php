<?php
/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala  *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 11 abr. 2026 15:31:56                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="modal fade" id="myModal" role="dialog"></div>
<div class="modal fade" id="myModalPDF" role="dialog"></div>
<div class="modal fade" id="myModalVideo" role="dialog"></div>
<div id="modalPopups"></div>
<script>
    
    $(document).ready(function() {
        $("#btn_close").click(function() {
            footer_js_view_close_modal();
        });
    });
    footer_js_view_modal();
    function footer_js_view_modal(archivo, tipo) {
        $.ajax({
            type: 'POST',
            url: 'popups/popups_controller/index',
            dataType: 'json',
            data: {
                archivo: archivo,
                tipo: tipo
            },
            success: function(data) {
                $('#modalPopups').html(data.pagina);
                $.each(data.popupids, function(key, value) {
                    $('#' + value).modal('show');
                });
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function footer_js_view_close_modal() {
        $.ajax({
            type: 'POST',
            url: 'popups/popups_controller/popups_controller_btn_close_dist',
            dataType: 'json',
            data: {
                id: 1
            },
            success: function(data) {
                $("#footer_js_view_modal_distribuidores").modal('hide');
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }
</script>
</div>
<footer>
    <div class="row">
        <div class="col-lg-12">
            <img src="application/views/template/sistema/imagenes/footer.png" alt="" width="800px">
        </div>
    </div>
</footer>
</body>

</html>