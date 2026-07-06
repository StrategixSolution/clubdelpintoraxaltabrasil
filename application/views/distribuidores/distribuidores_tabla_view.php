<script>
    $(document).ready(function() {
        $('#TablaParticipantes').DataTable({
            "scrollX": 3000,
            "scrollY": 300,
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

    function distribuidores_tabla_view_js_eliminar(distribuidorid, nombre) {
        var datos = '<?= $this->lang->line('distribuidores_controller_lang_tabla_js_confirm_texto') ?> "' + nombre + '"';
        Swal.fire({
            title: '',
            text: datos,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?= $this->lang->line('distribuidores_controller_lang_tabla_js_confirm_boton_aprobado') ?>',
            cancelButtonText: '<?= $this->lang->line('distribuidores_controller_lang_tabla_js_confirm_boton_rechazado') ?>'
        }).then((resultadobajaparticipante) => {
            if (resultadobajaparticipante.isConfirmed) {
                $('#loader_panel').show();
                var idtdr = "#id-distribuidor-td-" + distribuidorid;
                var idtde = "#id-dist-edit-td-" + distribuidorid;
                var idtdb = "#id-dist-baja-td-" + distribuidorid;
                $.ajax({
                    type: 'POST',
                    url: 'distribuidores/distribuidores_controller/distribuidores_controller_baja',
                    dataType: 'json',
                    data: {
                        distribuidorid: distribuidorid
                    },
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                title: '',
                                html: '<?= $this->lang->line('distribuidores_controller_lang_tabla_js_msg_texto_success') ?>',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#fd7e14',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: '<?= $this->lang->line('distribuidores_controller_lang_tabla_js_msg_swal_ok') ?>',
                                cancelButtonText: ''
                            }).then((validacionaltaparticipante) => {
                                if (validacionaltaparticipante.isConfirmed) {
                                    $(idtde).html('<?= $this->lang->line('distribuidores_controller_lang_tabla_estatus_baja') ?>');
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
            <table class="table table-bordered table-striped table-axalta" id="TablaParticipantes">
                <thead>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_id') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_codigo') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_razon_social') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_nombre_comercial') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_nombre_region') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_nombre_oficina_ventas') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_nombre_agrupamiento') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_nombre_unidad_federativa') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_ciudad') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_barrio') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_direccion') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_CEP') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_telefono') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_registro_federal') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_inscripcion_estatal') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_estatus') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_editar') ?></th>
                    <th><?= $this->lang->line('distribuidores_controller_lang_tabla_titulo_baja') ?></th>

                </thead>
                <tbody>
                    <?= $tabla ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
