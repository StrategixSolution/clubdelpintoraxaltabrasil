<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="reposicion_productos_tabla_view">
    <div class="panel-white">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table-axalta">
                    <table class="table table-bordered" id="reposicion_productos_tabla_view">
                        <thead>
                            <th>ID</th>
                            <th>CÓDIGO</th>
                            <th>NOME DA EMPRESA</th>
                            <th>NOME COMERCIAL</th>
                            <th>TIPO DE DISTRIBUIDORA</th>
                            <th>PERÍODO</th>
                            <th># CARTÃO</th>
                            <th>NOME MP</th>
                            <th>REGIÃO</th>
                            <th>EXECUTIVO</th>
                            <th>PRÊMIO</th>
                            <th>DATA DE ENTREGA</th>
                            <th>GMS</th>
                            <th>S.C / CODIGO PRODUCTO</th>
                            <th>DESCRIÇÃO DO PRODUTO</th>
                            <th>APRESENTAÇÃO L /KG</th>
                            <th>QUANTIDADE </th>
                            <th>PREÇO SEM IVA</th>
                            <th>TOTAL SEM IVA</th>
                        </thead>
                        <tbody>
                            <?= $tabla ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('#reposicion_productos_tabla_view').DataTable({
            "scrollX": 3000,
            "scrollY": 300,
            stateSave: true,
            "bDestroy": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "TODOS"]],
            "language": {
                "lengthMenu": "EXIBINDO REGISTROS DO _MENU_ POR PÁGINA",
                "zeroRecords": "NENHUM REGISTRO ENCONTRADO",
                "info": "PÁGINA _PAGE_ DE _PAGES_",
                "infoEmpty": "NENHUM REGISTRO DISPONÍVEL",
                "infoFiltered": "(FILTRADO DE _MAX_ REGISTROS)",
                "search": "BUSCAR",
                "paginate": {
                    "first": "PRIMEIRO",
                    "last": "ÚLTIMO",
                    "next": "PRÓXIMO",
                    "previous": "ANTERIOR"
                }
            },
            dom: '<"row"<"col-xs-4 col-md-4"l><"col-xs-4 col-md-4 botones"B><"col-md-4"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
            buttons: [{
                extend: 'excelHtml5',
                text: 'DESCARGAR <span class="iconify" data-icon="file-icons:microsoft-excel" style="font-size:20px;"></span>',
                className: 'btn btn-axalta',
                title: '',
                filename: 'Reporte_Reposicion_Productos',
                sheetName: 'Reporte_Reposicion_Productos',
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
                    cells: "A:S",
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
</script>