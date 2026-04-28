<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 ABRIL 2026 09:00:00                        * 
 */

defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="panel-white">
    <div class="row flex-column align-items-center mb-3">
        <div class="col-lg-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <th style="font-size:12px; text-align: center;"><?= $this->lang->line('ventas_auditoria_primera_controller_lang_etiqueta_total') ?></th>
                        <th style="font-size:12px; text-align: center;"><?= $this->lang->line('ventas_auditoria_primera_controller_lang_etiqueta_auditadas') ?></th>
                        <th style="font-size:12px; text-align: center;"><?= $this->lang->line('ventas_auditoria_primera_controller_lang_etiqueta_sin_auditar') ?></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:12px; text-align: center;"><?= $totalauditoria ?></td>
                            <td style="font-size:12px; text-align: center;"><?= $totalauditadas ?></td>
                            <td style="font-size:12px; text-align: center;"><?= $totalsinauditar ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-2" style="margin-top:20px;">
            <div class="form-group">
                <button type="button" id="auditoria_ventas_btn_crea_random" class="btn btn-axalta btn-buscar-ancho">CREAR RANDOM</button>
            </div>
        </div>
    </div>
    <hr class="separador mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive table-axalta">
                <table class="table table-bordered" id="TbVentasAuditoria">
                    <thead>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ventano') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ventaid') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_pintor') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_numero_ticket') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_monto_ticket') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_fecha_registro') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_distribuidor') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ticket') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_motivo') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_ticket_monto_repetido') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_estatus_auditoria') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_observaciones') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_aprovar') ?></th>
                        <th><?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_rechazar') ?></th>
                    </thead>
                    <tbody>
                        <?= $tabla ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#auditoria_ventas_btn_crea_random").click(function() {
            ventas_auditoria_primera_form_view_js_crea_random();
        }); // botón y función JS comentados
        $('#TbVentasAuditoria').DataTable({
            "scrollX": 3500,
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
            buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 10, 11]
                },
                text: '<?= $this->lang->line('data_table_js_lang_btn_descarga') ?> <span class="iconify" data-icon="file-icons:microsoft-excel" style=font-size:20px;"></span>',
                className: 'btn btn-axalta',
                title: 'AUDITORIA',
                filename: 'AUDITORIA',
                sheetName: 'AUDITORIA',
                excelStyles: [{
                        "cells": "1",
                        style: {
                            font: {
                                name: "Calibri",
                                size: "12",
                                color: "FFFFFF",
                                b: true
                            },
                            fill: {
                                pattern: {
                                    color: "C82127"
                                }
                            }
                        }
                    },
                    {
                        "cells": "2",
                        style: {
                            font: {
                                name: "Calibri",
                                size: "12",
                                color: "FFFFFF",
                                b: true
                            },
                            fill: {
                                pattern: {
                                    color: "C82127"
                                }
                            }
                        }
                    },
                    {
                        cells: "A:M:",
                        style: {
                            border: {
                                top: "thin",
                                bottom: "thin",
                                left: "thin",
                                right: "thin"
                            }
                        }
                    }
                ]
            }]
        });
        $('.dataTables_length').addClass('bs-select');
    });

    function ventas_auditoria_primera_form_view_js_crea_random() {
        var mes = $('#mes').val();
        var anio = $('#anio').val();
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_controller/ventas_auditoria_primera_controller_crea_random',
            dataType: 'json',
            data: {
                mes: mes,
                anio: anio
            },
            success: function(data) {
                console.log(data);
                switch (data) {
                    case 0:
                        Swal.fire('', 'NENHUMA AUDITORIA ALEATÓRIA FOI GERADA', 'warning');
                        break;
                    case 1:
                        Swal.fire({
                            title: '',
                            text: "AUDITORIAS ALEATÓRIAS FORAM GERADAS COM SUCESSO",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#fd7e14',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'OK',
                            cancelButtonText: ''
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(location).attr("href", "<?= funciones_strategix_version_url_random_base_url("AuditoriaPrimera") ?>");
                            }
                        });
                        break;
                }
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function ventas_auditoria_tabla_view_js_modal_ticket(id) {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_controller/ventas_auditoria_primera_controller_ticket_modal',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(data) {
                $('#myModal').html(data).modal('show');
            },
            error: function(data) {},
            complete: function() {
                $('#loader_panel').hide();
            }
        });
    }

    function ventas_auditoria_primera_form_view_js_aprobada(VentaAuditoriaId) {
        Swal.fire({
            title: '',
            text: "<?= $this->lang->line('ventas_auditoria_primera_controller_lang_alerta_pregunta_aceptar') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<?= $this->lang->line('ventas_auditoria_primera_controller_lang_tabla_aprovar') ?>',
            cancelButtonText: '<?= $this->lang->line('ventas_auditoria_primera_controller_lang_alerta_cancelar') ?>'
            //backdrop: 'rgba(108,117,125,0.4)'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loader_panel').show();
                $.ajax({
                    type: 'POST',
                    url: 'ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_controller/ventas_auditoria_primera_controller_aprobada',
                    dataType: 'json',
                    data: {
                        VentaAuditoriaId: VentaAuditoriaId
                    },
                    success: function(data) {
                        console.log(data);
                        $('#idstatus' + data.VentaAuditoriaId).html(data.status);
                        $('#fechaauditoria' + data.VentaAuditoriaId).html(data.fechacambio);
                        $('#ida' + data.VentaAuditoriaId).html('');
                        $('#idr' + data.VentaAuditoriaId).html('');
                        Swal.fire('', '<?= $this->lang->line('ventas_auditoria_primera_controller_lang_alerta_respuesta_aprobada') ?>', 'success');
                    },
                    error: function(data) {},
                    complete: function() {
                        $('#loader_panel').hide();
                    }
                });
            }
        });
    }
    async function ventas_auditoria_primera_form_view_js_rechazo(VentaAuditoriaId) {
        var inputOptionsPromise = new Promise(function(resolve) {
            // get your data and pass it to resolve()
            setTimeout(function() {
                $.getJSON("ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_controller/ventas_auditoria_primera_controller_combo_observaciones", function(data) {
                    resolve(data);
                });
            }, 200);
        });
        const {
            value: Observacionid
        } = await Swal.fire({
            title: 'OBSERVAÇÕES',
            input: 'select',
            inputOptions: inputOptionsPromise,
            inputPlaceholder: 'SELECIONE UMA OBSERVAÇÃO',
            showCancelButton: true,
            confirmButtonText: 'ACEITAR',
            cancelButtonText: 'CANCELAR',
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value !== '') {
                        resolve();
                    } else {
                        resolve('ESCOLHA UMA OPÇÃO');
                    }
                });
            }
        });
        if (Observacionid != "") {
            $('#loader_panel').show();
            $.ajax({
                type: 'POST',
                url: 'ventas/ventas_auditoria/ventas_auditoria_primera/ventas_auditoria_primera_controller/ventas_auditoria_primera_controller_rechazada',
                dataType: 'json',
                data: {
                    VentaAuditoriaId: VentaAuditoriaId,
                    Observacionid: Observacionid
                },
                success: function(data) {
                    $('#idstatus' + data.VentaAuditoriaId).html(data.status);
                    $('#fechaauditoria' + data.VentaAuditoriaId).html(data.fechacambio);
                    $('#observaciones' + data.VentaAuditoriaId).html(data.Observacion);
                    $('#ida' + data.VentaAuditoriaId).html('');
                    $('#idr' + data.VentaAuditoriaId).html('');

                    $('#TbVentasAuditoria').DataTable().columns.adjust().draw();
                    Swal.fire('', '<?= $this->lang->line('ventas_auditoria_primera_controller_lang_alerta_respuesta_rechazo') ?>', 'success');
                },
                error: function(data) {},
                complete: function() {
                    $('#loader_panel').hide();
                }
            });
        }
    }
</script>