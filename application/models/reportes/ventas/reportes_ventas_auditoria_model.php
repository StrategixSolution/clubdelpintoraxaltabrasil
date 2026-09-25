<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_ventas_auditoria_model extends Base_Model {

    public function __construct(){
        parent::__construct();
    }

    public function combo_anio(){
        $SQL = "
            SELECT DISTINCT YEAR(VentaFechaRegistro) AS anio
            FROM Ventas
            WHERE VentaFechaBaja IS NULL
            ORDER BY anio DESC
        ";

        return $this->db->query($SQL)->result();
    }

    public function combo_mes($anio){
        $anio = (int)$anio;

        $SQL = "
            SELECT DISTINCT MONTH(VentaFechaRegistro) AS mes
            FROM Ventas
            WHERE VentaFechaBaja IS NULL
              AND YEAR(VentaFechaRegistro) = $anio
            ORDER BY mes ASC
        ";

        return $this->db->query($SQL)->result();
    }

    public function combo_distribuidor($anio, $mes){
        $anio = (int)$anio;
        $mes  = (int)$mes;

        $whereMes = '';
        if ($mes > 0){
            $whereMes = " AND MONTH(V.VentaFechaRegistro) = $mes ";
        }

        $SQL = "
            ;WITH DD_ULT AS (
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

        $where = " AND V.VentaFechaBaja IS NULL ";

        if ($anio > 0){
            $where .= " AND YEAR(V.VentaFechaRegistro) = $anio ";
        }

        if ($mes > 0){
            $where .= " AND MONTH(V.VentaFechaRegistro) = $mes ";
        }

        if ($dist > 0){
            $where .= " AND V.DistribuidorId = $dist ";
        }

        /*
            ESTATUS:
            0 = TODOS
            1 = PENDIENTE / SIN AUDITORÍA
            2 = APROBADA
            3 = RECHAZADA
        */
        if ($estatus > 0){
            if ($estatus == 1){
                $where .= "
                    AND (
                        VA.VentaAuditoriaId IS NULL
                        OR VA.VentaAuditoriaEstatusId = 1
                    )
                ";
            } else {
                $where .= " AND VA.VentaAuditoriaEstatusId = $estatus ";
            }
        }

        $SQL = "SELECT 
            V.VentaId, 
            V.TarjetaId, 
            V.VentaUsuarioIdMP, 
            ud.UsuarioDetalleNombre  as VentaUsuarioNombreMP,
            V.DistribuidorId, 
            dd.DistribuidorDetalleId, 
            dd.DistribuidorDetalleCodigo, dd.DistribuidorDetalleNombreComercial, 
            dd.DistribuidorDetalleRazonSocial, 
            ud.UsuarioDetalleId, 
            V.VentaNumeroTicket, 
            V.VentaMontoTicket, 
            V.VentaFotoTicket,
            V.VentaFechaRegistro, 
            CONVERT(VARCHAR(10), V.VentaFechaRegistro, 23) AS FECHA_REGISTRO, 
            ISNULL(VA.VentaAuditoriaId, 0) AS VentaAuditoriaId, 
            ISNULL(VA.VentaAuditoriaEstatusId, 1) AS VentaAuditoriaEstatusId, 
            ISNULL(VA.VentaAuditoriaTipoId, 0) AS VentaAuditoriaTipoId, 
            ISNULL(VA.VentaAuditoriaEstatusOportunidadId, 0) AS VentaAuditoriaEstatusOportunidadId, 
            ISNULL(VA.VentaAuditoriaObservacionId, 0) AS VentaAuditoriaObservacionId, 
            ISNULL(VAE.VentaAuditoriaEstatusDescripcion, 'PENDIENTE') AS VentaAuditoriaEstatusDescripcion, 
            ISNULL(VAT.VentaAuditoriaTipoDescripcion, '') AS VentaAuditoriaTipoDescripcion, 
            ISNULL(VAO.VentaAuditoriaObservacionDescripcion, '') AS VentaAuditoriaObservacionDescripcion, 
            ISNULL(CONVERT(VARCHAR(10), VA.VentaAuditoriaFechaAudito, 23), '') AS FECHA_AUDITORIA 
            FROM Ventas V 
            INNER JOIN UsuariosDetalles ud on ud.UsuarioId = V.VentaUsuarioIdMP 
            INNER JOIN DistribuidoresDetalles dd ON dd.DistribuidorId = V.DistribuidorId 
            LEFT JOIN ( SELECT VA1.* FROM VentasAuditorias VA1 INNER JOIN ( SELECT VentaId, MAX(VentaAuditoriaId) AS MaxId FROM VentasAuditorias WHERE VentaAuditoriaFechaBaja IS NULL GROUP BY VentaId ) X ON X.VentaId = VA1.VentaId AND X.MaxId = VA1.VentaAuditoriaId WHERE VA1.VentaAuditoriaFechaBaja IS NULL ) VA ON VA.VentaId = V.VentaId 
            LEFT JOIN VentasAuditoriasEstatus VAE ON VAE.VentaAuditoriaEstatusId = VA.VentaAuditoriaEstatusId 
            LEFT JOIN VentasAuditoriasTipos VAT ON VAT.VentaAuditoriaTipoId = VA.VentaAuditoriaTipoId 
            LEFT JOIN VentasAuditoriasObservaciones VAO ON VAO.VentaAuditoriaObservacionId = VA.VentaAuditoriaObservacionId 
            WHERE V.VentaFechaBaja IS NULL 
            AND ud.UsuarioDetalleFechaBaja IS NULL 
            AND dd.DistribuidorDetalleFechaBaja IS NULL
            -- AND VA.VentaAuditoriaEstatusOportunidadId = 1
            $where
            ORDER BY V.VentaId DESC";

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
