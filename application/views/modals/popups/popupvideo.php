<?=$div_inicio?>
<div class="modal-dialog modal-lg" id="myModal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><?=$titulo?></h5>
            <button type="button" id="close_btn" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-id="<?=$modalId?>"></button>
        </div>
        <div class="modal-body">
            <p>
                <video id="video1" width="100%" height="400px" controls autoplay="autoplay">
                    <source src="<?=base_url($archivo)?>" type="video/mp4">
                    Seu navegador não suporta a tag <code>video</code>.
                </video>
            </p>
        </div>
    </div>
</div>
<?=$div_fin?>
<script>
    $(document).ready(function () {
        $('#<?=$modalId?>').modal({ backdrop: 'static', keyboard: false });
        $('#close_btn').on('click', function(){ 
            var popup_id = $(this).data("id");            
            if (popup_id!=""){ popup_baja(popup_id); }
        });
        $("#<?=$modalId?>").on("hide.bs.modal", function (e) {
            const video = document.getElementById("video1");
            video.pause();
            var popup_id = '<?=$modalId?>';
            if (popup_id!=""){ popup_baja(popup_id); }            
            popup_baja(popup_id);
        });
    });
    function popup_baja(popup_id) {
        $.ajax({
            type: 'POST',
            url: 'popups/popups_controller/popups_controller_baja',
            dataType: 'json',
            data: {popup_id:popup_id},
            success: function(data){ $('#'+popup_id).modal('hide'); },
            error: function(){},
            complete: function(){}
        }); 
    }
</script>
