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

    function usuarios_participantes_tabla_view_js_eliminar(usuarioId, nombre) {
        var datos = '<?= $this->lang->line('usuarios_participantes_controller_lang_tabla_js_confirm_texto') ?> "' + nombre + '"';
        Swal.fire({
            title: '',
            text: datos,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?= $this->lang->line('usuarios_participantes_controller_lang_tabla_js_confirm_boton_aprobado') ?>',
            cancelButtonText: '<?= $this->lang->line('usuarios_participantes_controller_lang_tabla_js_confirm_boton_rechazado') ?>'
        }).then((resultadobajaparticipante) => {
            if (resultadobajaparticipante.isConfirmed) {
                $('#loader_panel').show();
                var idtd = "#id-usuario-td-" + usuarioId;
                $.ajax({
                    type: 'POST',
                    url: 'usuarios/usuarios_participantes/usuarios_participantes_controller/usuarios_participantes_controller_usuario_baja',
                    dataType: 'json',
                    data: {
                        usuarioId: usuarioId
                    },
                    success: function(data) {
                        if (data.resultado == 1) {
                            Swal.fire({
                                title: '',
                                html: '<?= $this->lang->line('usuarios_participantes_controller_lang_tabla_js_msg_texto_success') ?>',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#fd7e14',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: '<?= $this->lang->line('usuarios_participantes_controller_lang_tabla_js_msg_swal_ok') ?>',
                                cancelButtonText: ''
                            }).then((validacionaltaparticipante) => {
                                if (validacionaltaparticipante.isConfirmed) {
                                    $('#idstatus' + data.idUsuario).html(data.status);
                                    $('#idmodus' + data.idUsuario).html('');
                                    $('#idbajaus' + data.idUsuario).html('');
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
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_codigo') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_distribuidora') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_nomcomercial') ?></th>

                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_registro_federal') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_inscripcion_estatal') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_nombre') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_rfc_pax') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_email') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_celular') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_perfil') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_estatus') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_editar') ?></th>
                    <th><?= $this->lang->line('usuarios_participantes_controller_lang_tabla_titulo_eliminar') ?></th>
                </thead>
                <tbody>
                    <?= $tabla ?>
                </tbody>
            </table>
        </div>
    </div>
</div>