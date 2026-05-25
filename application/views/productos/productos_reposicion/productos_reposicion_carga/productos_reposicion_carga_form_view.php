<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<section class="auditoria_ventas">
    <div class="panel-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->lang->line('productos_reposicion_carga_controller_lang_titulo') ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin:20px 0px;">
            <?= $sub_menu ?>
        </div>
        <div class="row">
            <div class="panel-white" id="div_carga">
                <div class="row mb-4">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for=""><?= $this->lang->line('productos_reposicion_carga_controller_lang_texto_xls_carga_productos') ?></label><br>
                            <a href="<?php echo funciones_strategix_version_url_random_base_url("application/views/template/sistema/archivos/excel/productos_reposicion_carga/productos_reposicion_carga.xlsx") ?>">
                                <button type="button" class="btn btn-axalta">
                                    <i class="fas fa-download"></i> <?= $this->lang->line('productos_reposicion_carga_controller_lang_link_excel_carga_productos') ?>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <form action="productos/productos_reposicion/productos_reposicion_carga_controller/productos_reposicion_carga_controller_excel" id="frm_productos_reposicion_carga_form_view" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <div id="uploadsFiles">
                                <label for="productos_reposicion_carga_controller_lang_file_excel" class="label"><?= $this->lang->line('productos_reposicion_carga_controller_lang_label_selecciona_archivo') ?><span class="tooltip-pl" data-toggle='tooltip' title='<?= $this->lang->line('productos_reposicion_carga_controller_lang_tooltip_archivo') ?>'><i class="fas fa-question-circle"></i></span></label>
                                <div class="input-group mb-3">
                                    <input type="file" name="productos_reposicion_carga_file_excel" id="productos_reposicion_carga_file_excel" class="form-control" placeholder="<?= $this->lang->line('ventas_registro_controller_placeholder_ticket') ?>">
                                    <button type="submit" class="btn btn-black-sm" id="carga_btn_subir_archivo"><?= $this->lang->line('productos_reposicion_carga_controller_lang_btn_subir') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="div_carga_tabla">
                    <div class="table-responsive">
                        <div id="tabla_cargas"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $("#frm_productos_reposicion_carga_form_view").submit(function(event) {
            event.preventDefault();
        });
        $("#carga_btn_subir_archivo").click(function() {
            productos_reposicion_carga_form_view_js_excel();
        });
        js_general_valida_uploads_archivos('productos_reposicion_carga_controller_lang_file_excel', ['xlsx'], '<?= $this->lang->line('productos_reposicion_carga_controller_lang_js_msg_archivo_tamanio') ?>', '<?= $this->lang->line('productos_reposicion_carga_controller_lang_js_msg_archivo_extenciones') ?>');
    });

    function productos_reposicion_carga_form_view_js_excel() {
        $("#tabla_cargas").html('');
        var formData = new FormData($("#frm_productos_reposicion_carga_form_view")[0]);
        var productos_reposicion_carga_controller_lang_file_excel = $('#productos_reposicion_carga_controller_lang_file_excel').val();
        if (productos_reposicion_carga_controller_lang_file_excel != "") {
            $('#loader_panel').show();
            $.ajax({
                type: $('#frm_productos_reposicion_carga_form_view').attr('method'),
                url: $('#frm_productos_reposicion_carga_form_view').attr('action'),
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.resultados == 1) {
                        Swal.fire({
                            title: '',
                            html: data.msg,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#008dab',
                            allowOutsideClick: false,
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'OK',
                            cancelButtonText: ''
                        }).then((validaestatus) => {
                            if (validaestatus.isConfirmed) {

                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            allowOutsideClick: false,
                            text: data.msg
                        });
                    }
                    $('#tabla_cargas').html(data.tabla);
                },
                error: function() {
                    //alert("error");
                    //Code
                },
                complete: function() {
                    $('#loader_panel').hide();
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                allowOutsideClick: false,
                text: "<?= $this->lang->line('productos_reposicion_carga_controller_lang_js_msg_archivo_seleccione') ?>"
            });
        }
    }
    'use strict';;
    (function(document, window, index) {
        var inputs = document.querySelectorAll('.inputfile');
        Array.prototype.forEach.call(inputs, function(input) {
            var label = input.nextElementSibling,
                labelVal = label.innerHTML;
            input.addEventListener('change', function(e) {
                var fileName = '';
                if (this.files && this.files.length > 1) {
                    fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                } else {
                    fileName = e.target.value.split('\\').pop();
                }
                if (fileName) {
                    label.querySelector('span').innerHTML = fileName;
                } else {
                    label.innerHTML = labelVal;
                }
            });
        });
    }(document, window, 0));
</script>