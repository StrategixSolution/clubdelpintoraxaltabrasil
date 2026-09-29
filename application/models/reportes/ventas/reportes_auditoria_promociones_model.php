<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_auditoria_promociones_model extends Base_Model {

    public function __construct(){
        parent::__construct();
    }

    public function combo_anio(){
        $SQL = "
            SELECT DISTINCT YEAR(v.VentaFechaRegistro) AS anio
            FROM Ventas v
            WHERE v.VentaFechaBaja IS NULL
            AND v.VentaTienePromocion = 1
            ORDER BY anio DESC
        ";

        return $this->db->query($SQL)->result();
    }

    public function combo_mes($anio){
        $anio = (int)$anio;

        $SQL = "SELECT DISTINCT MONTH(v.VentaFechaRegistro) AS mes
            FROM Ventas v
            WHERE v.VentaFechaBaja IS NULL
            AND v.VentaTienePromocion = 1
              AND YEAR(v.VentaFechaRegistro) = $anio
            ORDER BY mes ASC";

        return $this->db->query($SQL)->result();
    }

    public function combo_distribuidor($anio, $mes){
        $anio = (int)$anio;
        $mes  = (int)$mes;

        $whereMes = '';
        if ($mes > 0){
            $whereMes = " AND MONTH(V.VentaFechaRegistro) = $mes ";
        }

        $SQL = ";WITH DD_ULT AS (
                SELECT
                    DD.*,
                    ROW_NUMBER() OVER (
                        PARTITION BY DD.DistribuidorId
                        ORDER BY DD.DistribuidorDetalleId DESC
                    ) AS rn
                FROM DistribuidoresDetalles DD
                WHERE DD.DistribuidorDetalleFechaBaja IS NULL
                  AND DD.DistribuidorDetalleFechaActivacion IS NOT NULL
            )
            SELECT DISTINCT
                V.DistribuidorId AS ID,
                ISNULL(DD.DistribuidorDetalleCodigo, '') AS CODIGO,
                COALESCE(
                    NULLIF(LTRIM(RTRIM(CONVERT(NVARCHAR(300), DD.DistribuidorDetalleNombreComercial))), ''),
                    NULLIF(LTRIM(RTRIM(CONVERT(NVARCHAR(300), DD.DistribuidorDetalleRazonSocial))), ''),
                    'SIN NOMBRE'
                ) AS NOMBRE
            FROM Ventas V
            INNER JOIN DD_ULT DD
                ON DD.DistribuidorId = V.DistribuidorId
               AND DD.rn = 1
            WHERE V.VentaFechaBaja IS NULL
                            AND V.VentaTienePromocion = 1
              AND YEAR(V.VentaFechaRegistro) = $anio
              $whereMes
            ORDER BY NOMBRE ASC
        ";

        return $this->db->query($SQL)->result();
    }

    public function datos($anio, $mes, $dist, $estatus){
        $anio    = (int)$anio;
        $mes     = (int)$mes;
        $dist    = (int)$dist;
        $estatus = (int)$estatus;

        $where = " AND Ventas.VentaFechaBaja IS NULL ";

        if ($anio > 0){
            $where .= " AND YEAR(Ventas.VentaFechaRegistro) = $anio ";
        }

        if ($mes > 0){
            $where .= " AND MONTH(Ventas.VentaFechaRegistro) = $mes ";
        }

        if ($dist > 0){
            $where .= " AND Ventas.DistribuidorId = $dist ";
        }

    
        if ($estatus > 0){
                $where .= " AND VentasAuditoriasPromociones.VentaAuditoriaPromocionesEstatusId = $estatus ";
        }

        $SQL = "SELECT 
                Ventas.VentaId, 
                VentasAuditoriasPromociones.VentaAuditoriaPromocionesId, 
                Ventas.TarjetaId, 
                Tarjetas.TarjetaNumero, 
                Ventas.VentaUsuarioIdMP, 
                RTRIM(ISNULL(UsuariosMaestroPintor.UsuarioDetalleNombre,'')) AS VentaUsuarioNombreMP, 
                Ventas.DistribuidorId, 
                DistribuidoresDetalles.DistribuidorDetalleId,
                DistribuidoresDetalles.DistribuidorDetalleCodigo, 
                DistribuidoresDetalles.DistribuidorDetalleRazonSocial, 
                DistribuidoresDetalles.DistribuidorDetalleNombreComercial, 
                Ventas.VentaUsuarioIdMP AS UsuarioDetalleId, 
                Ventas.VentaNumeroTicket, 
                Ventas.VentaMontoTicket, 
                Ventas.VentaFotoTicket, 
                Ventas.VentaFechaRegistro, 
                VentasAuditoriasPromociones.VentaAuditoriaPromocionesEstatusId, 
                VentasAuditoriasPromociones.VentaAuditoriaPromocionesObservacionId, 
                VentasAuditoriasPromosionesEstatus.VentaAuditoriaEstatusPromosionesDescripcion, 
                VentasAuditoriasTipos.VentaAuditoriaTipoDescripcion, 
                VentasAuditoriasPromosionesObservaciones.VentaAuditoriaPromosionesObservacionDescripcion 
                FROM Ventas 
                INNER JOIN Tarjetas ON Ventas.TarjetaId = Tarjetas.TarjetaId 
                INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                LEFT JOIN UsuariosDetalles AS UsuariosMaestroPintor ON (Ventas.VentaUsuarioIdMP = UsuariosMaestroPintor.UsuarioId AND UsuariosMaestroPintor.UsuarioDetalleFechaBaja IS NULL) 
                INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId
                INNER JOIN VentasAuditoriasPromociones ON Ventas.VentaId = VentasAuditoriasPromociones.VentaId 
                INNER JOIN VentasAuditoriasPromosionesEstatus ON VentasAuditoriasPromociones.VentaAuditoriaPromocionesEstatusId = VentasAuditoriasPromosionesEstatus.VentaAuditoriaPromosionesEstatusId  
                INNER JOIN VentasAuditoriasTipos ON VentasAuditorias.VentaAuditoriaTipoId = VentasAuditoriasTipos.VentaAuditoriaTipoId 
                LEFT OUTER JOIN VentasAuditoriasPromosionesObservaciones ON VentasAuditoriasPromociones.VentaAuditoriaPromocionesObservacionId = VentasAuditoriasPromosionesObservaciones.VentaAuditoriaPromosionesObservacionId 
                WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) 
                AND (Ventas.VentaFechaBaja IS NULL)
                $where
                ORDER BY Ventas.VentaId ASC";

        return $this->db->query($SQL)->result();
    }

    public function tickets_repetidos($VentaId, $anio, $mes, $DistribuidorId, $VentaUsuarioIdMP, $VentaMontoTicket){
        $VentaId          = (int)$VentaId;
        $anio             = (int)$anio;
        $mes              = (int)$mes;
        $DistribuidorId   = (int)$DistribuidorId;
        $VentaUsuarioIdMP = (int)$VentaUsuarioIdMP;
        $VentaMontoTicket = (float)$VentaMontoTicket;

        if ($VentaId <= 0 || $anio <= 0 || $DistribuidorId <= 0 || $VentaUsuarioIdMP <= 0) {
            return '';
        }

        $whereMes = '';
        if ($mes > 0) {
            $whereMes = " AND MONTH(VentaFechaRegistro) = $mes ";
        }

        $SQL = "
            SELECT VentaId
            FROM Ventas
            WHERE VentaId <> $VentaId
              AND VentaFechaBaja IS NULL
              AND YEAR(VentaFechaRegistro) = $anio
              $whereMes
              AND DistribuidorId = $DistribuidorId
              AND VentaUsuarioIdMP = $VentaUsuarioIdMP
              AND VentaMontoTicket = $VentaMontoTicket
            ORDER BY VentaId ASC
        ";

        $query = $this->db->query($SQL);
        $tickets = [];

        foreach ($query->result() as $row) {
            $tickets[] = $row->VentaId;
        }

        return implode(',', $tickets);
    }

    public function ticket_modal($ventaId){
        $ventaId = (int)$ventaId;

        $SQL = "SELECT TOP 1
                VentaId,
                COALESCE(
                    NULLIF(LTRIM(RTRIM(CONVERT(NVARCHAR(300), ud.UsuarioDetalleNombre))), ''),
                    'SIN NOMBRE'
                ) AS VentaUsuarioNombreMP,
                ISNULL(VentaNumeroTicket, '') AS VentaNumeroTicket,
                ISNULL(VentaMontoTicket, 0) AS VentaMontoTicket,
                VentaFechaRegistro,
                ISNULL(VentaFotoTicket, '') AS VentaFotoTicket
            FROM Ventas
            INNER JOIN UsuariosDetalles ud on ud.UsuarioId = Ventas.VentaUsuarioIdMP 
            WHERE Ventas.VentaId = $ventaId
        ";

        return $this->db->query($SQL)->row();
    }
}
