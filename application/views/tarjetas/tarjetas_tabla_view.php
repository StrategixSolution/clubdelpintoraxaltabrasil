<script>
    $(document).ready(function() {
        $('#tarjetas_tabla_view_lista').DataTable({
            "columnDefs": '16.66%',
            "scrollX": true,
            "scrollY": 350,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "<?= $this->lang->line('data_table_js_lang_combo_todos') ?>"]
            ],
            "language": {
                "lengthMenu": "<?= $this->lang->line('data_table_js_lang_lengthMenu') ?>",
                "zeroRecords": "<?= $this->lang->line('data_table_js_lang_zeroRecords') ?>",
                "info": "<?= $this->lang->line('data_table_js_lang_info') ?>",
                "infoEmpty": "<?= $this->lang->line('data_table_js_lang_infoEmpty') ?>",
                "infoFiltered": "<?= $this->lang->line('data_table_js_lang_infoFiltered') ?>",
                "search": "<?= $this->lang->line('data_table_js_lang_search') ?>",
                "paginate": {
                    "first": "<?= $this->lang->line('data_table_js_lang_first') ?>",
                    "last": "<?= $this->lang->line('data_table_js_lang_last') ?>",
                    "next": "<?= $this->lang->line('data_table_js_lang_next') ?>",
                    "previous": "<?= $this->lang->line('data_table_js_lang_previous') ?>"
                }
            }
        });
    });
    function tarjetas_tabla_view_js_eliminar(tarjetaid, tarjeta) {
        var datos = '<?= $this->lang->line('tarjetas_controller_lang_lang_tabla_js_confirm_texto') ?> "' + tarjeta + '"';
   // function tarjetas_tabla_view_js_eliminar(tarjetaid, tarjeta,PaisNombre) {
    //    var datos = '<?= $this->lang->line('tarjetas_controller_lang_lang_tabla_js_confirm_texto') ?> "' + tarjeta + '" DEL PAÍS: ' + PaisNombre.toUpperCase();
        Swal.fire({
            title: '',
            text: datos,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?= $this->lang->line('tarjetas_controller_lang_lang_tabla_js_confirm_boton_aprobado') ?>',
            cancelButtonText: '<?= $this->lang->line('tarjetas_controller_lang_lang_tabla_js_confirm_boton_rechazado') ?>'
        }).then((resultadobajaparticipante) => {
            if (resultadobajaparticipante.isConfirmed) {
                $('#loader_panel').show();
                var idtdr = "#id-tarjeta-td-" + tarjetaid;
                var idtde = "#id-tarjeta-edit-td-" + tarjetaid;
                var idtdb = "#id-tarjeta-baja-td-" + tarjetaid;
                $.ajax({
                    type: 'POST',
                    url: 'tarjetas/tarjetas_controller/tarjetas_controller_baja',
                    dataType: 'json',
                    data: {
                        tarjetaid: tarjetaid
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                title: '',
                                html: '<?= $this->lang->line('tarjetas_controller_lang_lang_tabla_js_msg_texto_success') ?>',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#fd7e14',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: '<?= $this->lang->line('tarjetas_controller_lang_lang_tabla_js_msg_swal_ok') ?>',
                                cancelButtonText: ''
                            }).then((validacionaltaparticipante) => {
                                if (validacionaltaparticipante.isConfirmed) {
                                    $(idtde).html('<?= $this->lang->line('tarjetas_controller_lang_lang_tabla_estatus_baja') ?>');
                                    $(idtdb).html('');
                                    if ($('#cmb_estatus').val() == 1) {
                                        $(idtdr).remove();
                                    }
                                }
                            });
                        } else {}
                    },
                    error: function(data) {},
                    complete: function() {
                        $('#loader_panel').hide();
                    }
                });
            }
        });
    }
</script>
<hr class="separador">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-axalta" id="tarjetas_tabla_view_lista" style="width: 100%;">
                <thead>
                    <th><?= $this->lang->line('tarjetas_controller_lang_tabla_titulo_folio') ?></th>
                    <th><?= $this->lang->line('tarjetas_controller_lang_tabla_titulo_pais') ?></th>
                    <th><?= $this->lang->line('tarjetas_controller_lang_tabla_titulo_division') ?></th>
                    <th><?= $this->lang->line('tarjetas_controller_lang_tabla_titulo_distribuidor_codigo') ?></th>
                    <th><?= $this->lang->line('tarjetas_controller_lang_tabla_titulo_distribuidor_razon_social') ?></th>
                    <th><?= $this->lang->line('tarjetas_controller_lang_tabla_titulo_usuario_nombre') ?></th>
                    <th><?= $this->lang->line('tarjetas_controller_lang_tabla_titulo_estatus') ?></th>
<!--                    <th><?= $this->lang->line('tarjetas_controller_lang_tabla_titulo_boton_modificar') ?></th>-->
                    <th><?= $this->lang->line('tarjetas_controller_lang_tabla_titulo_boton_baja') ?></th>
                </thead>
                <tbody>
                    <?= $tabla ?>
                </tbody>
            </table>
        </div>
    </div>
</div>