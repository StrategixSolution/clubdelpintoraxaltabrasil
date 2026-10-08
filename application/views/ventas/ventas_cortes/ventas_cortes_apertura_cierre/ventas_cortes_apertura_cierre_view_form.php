<?php


?>

<section class="auditoria_ventas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_titulo')?></h2>
                </div>
            </div>
        </div>
    </div>    
<div class="container">
    <div class="row justify-content-center" style="margin:20px 0px;"> 
        <?=$sub_menu?>
    </div> 
    <div class="panel-white">
        <div class="row">
<input type="hidden" id="estatusId" name="estatusId" value="<?= $estatus ?>">
        <?php if ($estatus==0){ ?>
            <div class="col-lg-12">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading"><?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_modulo_deshabilitado_titulo')?></h4>
                    <p><?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_modulo_deshabilitado_texto')?></p>                    
                </div>
                <div class="col-lg-2">
                <div class="form-group">
                        <button type="button" id="ventas_cambio_estatus" class="btn btn-axalta btn-buscar-ancho" style="margin-top: 1.68em;"><i class="fas fa-calendar"></i><span class="btn-buscar-texto"><?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_btn_abrir')?></span></button>
                    </div>
                    </div>
            </div>
        <?php } else { ?>
            <div class="col-lg-12">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading"><?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_modulo_habilitado_titulo')?></h4>
                    <p><?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_modulo_habilitado_texto')?></p>                    
                </div>
                <div class="col-lg-2">
                <div class="form-group">
                        <button type="button" id="ventas_cambio_estatus" class="btn btn-axalta btn-buscar-ancho" style="margin-top: 1.68em;"><i class="fas fa-calendar"></i><span class="btn-buscar-texto"><?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_btn_cerrar')?></span></button>
                    </div>
                    </div>
            </div>
        <?php } ?>
        </div> 
    </div>
</div>
</section>
<script>
    $(document).ready( function () {
        $("#ventas_cambio_estatus").click(function(){ ventas_cortes_apertura_cierre_view_form_js_cambia_estatus(); });
    });

    function ventas_cortes_apertura_cierre_view_form_js_cambia_estatus(){
         var estatusId = $('#estatusId').val();
         if (estatusId==0){
            var pregunta = '<?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_alerta_pregunta_abrir')?>';
         } else {
            var pregunta = '<?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_alerta_pregunta_cerrar')?>';
         }
        Swal.fire({
            title: '',
            html: pregunta,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_alerta_pregunta_btn_aceptar')?>',
            cancelButtonText: '<?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_alerta_pregunta_btn_rechazar')?>'
        }).then((resultadoconfirm) => {
            if (resultadoconfirm.isConfirmed) {
               $('#loader_panel').show();
               var estatusId = $('#estatusId').val();
                    $.ajax({
                        type: 'POST',
                        url: 'ventas/ventas_cortes/ventas_cortes_apertura_cierre/ventas_cortes_apertura_cierre_controller/ventas_cortes_apertura_cierre_controller_cambio_estatus',
                        dataType: 'json',
                        data: {estatusId:estatusId},
                        success: function(data){
                            switch(data.res){
                                case 1:
                                    Swal.fire({
                                        title: '',
                                        html: '<?=$this->lang->line('ventas_cortes_apertura_cierre_controller_lang_alerta_succes')?>',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#fd7e14',
                                        cancelButtonColor: '#6c757d',
                                        confirmButtonText: 'OK'
                                    }).then((validaestatus) => {
                                        if (validaestatus.isConfirmed) {
                                           location.reload();
                                        } 
                                    });
                                    break;                                    
                            }
                        },
                        error: function(data){ },
                        complete: function(){ $('#loader_panel').hide(); }
                    });
                } 
            });
    }
</script>
