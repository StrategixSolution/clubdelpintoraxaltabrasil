<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?= $div_inicio ?>
<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <!-- <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">CDP BR</h5>
            !-- <h5 class="modal-title" id="exampleModalLabel"><?= $titulo ?></h5> --
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-id="<?= $modalId ?>"></button>
        </div>-->
        <div class="modal-body">
            <img src="<?= funciones_strategix_version_url_random_base_url($archivo) ?>" style='width: 100%'>
        </div>
        <div class="modal-footer">
             <?PHP if ($download == 1) { ?>
                <a href="<?= funciones_strategix_version_url_random_base_url($archivo) ?>" download="Imagen<?= $extension ?>"> <button type="button"
                        class="btn btn-axalta-alt" aria-hidden="true">Descarga</button></a>
                <button type="button" id="close_button_i_<?= $modalId ?>" class="btn btn-danger" data-dismiss="modal"
                    aria-hidden="true" data-id="<?= $modalId ?>">Aceitar</button>
            <?PHP } else { ?>
                <button type="button" id="close_button_i_<?= $modalId ?>" class="btn btn-danger" data-dismiss="modal"
                    aria-hidden="true" data-id="<?= $modalId ?>">Aceitar</button>
            <?PHP } ?>
        </div>
    </div>
</div>
<?= $div_fin ?>
<script>
    $(document).ready(function() {
        $('#<?= $modalId ?>').modal({backdrop: 'static', keyboard: false });
        $('#close_button_i_<?= $modalId ?>').on('click', function() {
            var popup_id = $(this).data("id");
            if (popup_id != "") { popup_baja_i(popup_id);}
        });
    });

    function popup_baja_i(popup_id) {
        $.ajax({
            type: 'POST',
            url: 'popups/popups_controller/popups_controller_baja',
            dataType: 'json',
            data: { popup_id: popup_id},
            success: function(data) { $('#' + popup_id).modal('hide'); },
            error: function() {},
            complete: function() {}
        });
    }
</script>