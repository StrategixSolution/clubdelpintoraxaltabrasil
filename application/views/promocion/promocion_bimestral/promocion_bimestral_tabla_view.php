<hr class="separador">
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive table-axalta">
            <table class="table table-bordered table-striped table-axalta" id="tbVentasRegistradasMp" style="width: 100%;">
                <thead>
                    <th><?= $this->lang->line('mail_promocion_bimestral_controller_lang_tabla_perfil') ?></th>
                    <th><?= $this->lang->line('mail_promocion_bimestral_controller_lang_tabla_anio') ?></th>
                    <th>MÊS</th>
                    <th><?= $this->lang->line('mail_promocion_bimestral_controller_lang_tabla_promocion') ?></th>
                    <th><?= $this->lang->line('mail_promocion_bimestral_controller_lang_tabla_fecha') ?></th>
                </thead>
                <tbody>
                    <?= $tabla ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tbVentasRegistradasMp').DataTable({
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
            },
            dom: '<"row"<"col-xs-4 col-md-4"l><"col-xs-4 col-md-4 botones"B><"col-md-4"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
            buttons: []
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>