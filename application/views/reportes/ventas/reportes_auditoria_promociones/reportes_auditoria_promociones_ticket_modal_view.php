<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">TICKET</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body" style="text-align:center;">
            <?php if (empty($url_ticket)): ?>
                <div class="alert alert-warning" role="alert">
                    No hay ticket disponible para esta venta.
                </div>
            <?php else: ?>
                <img src="<?=$url_ticket?>" style="max-width:100%; height:auto; border:1px solid #ddd; border-radius:6px;">
            <?php endif; ?>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>

    </div>
</div>
