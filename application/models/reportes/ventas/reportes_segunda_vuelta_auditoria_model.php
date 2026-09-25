<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_segunda_vuelta_auditoria_model extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function combo_anio()
    {
        $SQL = " SELECT DISTINCT YEAR(V.VentaFechaRegistro) AS anio
            FROM Ventas V
            INNER JOIN VentasAuditorias VA
                ON VA.VentaId = V.VentaId
               AND VA.VentaAuditoriaFechaBaja IS NULL
               AND VA.VentaAuditoriaEstatusOportunidadId = 2
            OUTER APPLY (
                SELECT TOP 1
                    DD2.DistribuidorDetalleFechaActivacion
                FROM DistribuidoresDetalles DD2
                WHERE DD2.DistribuidorId = V.DistribuidorId
                ORDER BY DD2.DistribuidorDetalleId DESC
            ) DD_ACT
            WHERE V.VentaFechaBaja IS NULL
              AND DD_ACT.DistribuidorDetalleFechaActivacion IS NOT NULL
            ORDER BY anio DESC
        ";

        return $this->db->query($SQL)->result();
    }

    public function combo_mes($anio)
    {
        $anio = (int) $anio;

        $SQL = "SELECT DISTINCT MONTH(V.VentaFechaRegistro) AS mes
            FROM Ventas V
            INNER JOIN VentasAuditorias VA
                ON VA.VentaId = V.VentaId
               AND VA.VentaAuditoriaFechaBaja IS NULL
               AND VA.VentaAuditoriaEstatusOportunidadId = 2
            OUTER APPLY (
                SELECT TOP 1
                    DD2.DistribuidorDetalleFechaActivacion
                FROM DistribuidoresDetalles DD2
                WHERE DD2.DistribuidorId = V.DistribuidorId
                ORDER BY DD2.DistribuidorDetalleId DESC
            ) DD_ACT
            WHERE V.VentaFechaBaja IS NULL
              AND DD_ACT.DistribuidorDetalleFechaActivacion IS NOT NULL
              AND YEAR(V.VentaFechaRegistro) = ?
            ORDER BY mes ASC
        ";

        return $this->db->query($SQL, array($anio))->result();
    }

    public function combo_distribuidor($anio, $mes)
    {
        $anio = (int) $anio;
        $mes  = (int) $mes;

        $SQL = "SELECT DISTINCT
                                dd.DistribuidorId AS id_distribuidora,
                dd.DistribuidorDetalleCodigo AS codigo,
                dd.DistribuidorDetalleNombreComercial AS nombre_comercial
            FROM Ventas V
            INNER JOIN DistribuidoresDetalles dd ON dd.DistribuidorId = V.DistribuidorId and dd.DistribuidorDetalleFechaBaja IS NULL
            INNER JOIN VentasAuditorias VA
                ON VA.VentaId = V.VentaId
               AND VA.VentaAuditoriaFechaBaja IS NULL
               AND VA.VentaAuditoriaEstatusOportunidadId = 2
            OUTER APPLY (
                SELECT TOP 1
                    DD2.DistribuidorDetalleFechaActivacion
                FROM DistribuidoresDetalles DD2
                WHERE DD2.DistribuidorId = V.DistribuidorId
                ORDER BY DD2.DistribuidorDetalleId DESC
            ) DD_ACT
            WHERE V.VentaFechaBaja IS NULL
              AND DD_ACT.DistribuidorDetalleFechaActivacion IS NOT NULL
              AND YEAR(V.VentaFechaRegistro) = ?
              AND MONTH(V.VentaFechaRegistro) = ?
            ORDER BY dd.DistribuidorDetalleNombreComercial ASC
        ";

        return $this->db->query($SQL, array($anio, $mes))->result();
    }

    public function datos($anio, $mes, $dist)
    {
        $anio = (int) $anio;
		$mes  = (int) $mes;
		$dist = (int) $dist;

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
            AND VA.VentaAuditoriaEstatusOportunidadId = 2
            $where
            ORDER BY V.VentaId DESC";

        return $this->db->query($SQL)->result();
    }
}
