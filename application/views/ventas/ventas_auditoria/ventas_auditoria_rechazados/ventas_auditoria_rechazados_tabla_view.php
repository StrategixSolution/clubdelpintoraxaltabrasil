<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<section class="auditoria_ventas">
    <div class="container">
        <div class="panel-white">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table-axalta">
                        <table class="table table-bordered" id="TbVentasAuditoria">
                            <thead>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_ventano') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_ventaid') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_pintor') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_numero_ticket') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_monto_ticket') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_fecha_registro') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_distribuidor') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_ticket') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_motivo') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_observaciones') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_fecha_auditoria') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_fecha_notificacion') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_fecha_limite') ?>
                                </th>
                                <th><?= $this->lang->line('ventas_auditoria_rechazados_controller_lang_tabla_accion') ?>
                                </th>
                            </thead>
                            <tbody>
                                <?= $tabla ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function ventas_auditoria_rechazados_tabla_view_js_modal_ticket(id) {
        $('#loader_panel').show();
        $.ajax({
            type: 'POST',
            url: 'ventas/ventas_auditoria/ventas_auditoria_rechazados/ventas_auditoria_rechazados_controller/ventas_auditoria_rechazados_controller_ticket_modal',
            dataType: 'json',
            data: { id: id },
            success: function (data) {
                $('#myModal').html(data).modal('show');
            },
            error: function (data) { },
            complete: function () { $('#loader_panel').hide(); }
        });
    }
</script>