<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_cortes_bimestral_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
        
    public function ventas_cortes_bimestral_model_combo_anios()
    {
        $SQL = "SELECT DISTINCT CorteAnio AS anio FROM Cortes WHERE CorteTipoId = 1";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_combo_mes($anio)
    {
        $SQL = "SELECT DISTINCT CorteMes AS mes FROM Cortes WHERE CorteTipoId = 1 AND CorteAnio = $anio";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    
    public function ventas_cortes_bimestral_model_promociones($VentaId)
    {
        $SQL = "SELECT distinct VentasPromociones.VentaPromocionNombre FROM VentasUsuariosPromociones INNER JOIN Ventas ON VentasUsuariosPromociones.VentaId = Ventas.VentaId INNER JOIN VentasPromocionesDetalles INNER JOIN VentasPromociones ON VentasPromocionesDetalles.VentaPromocionId = VentasPromociones.VentaPromocionId ON VentasUsuariosPromociones.VentaPromocionDetalleId = VentasPromocionesDetalles.VentaPromocionDetalleId WHERE (Ventas.VentaId = $VentaId) ";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_ventas($anio, $mes, $mes_anterior)
    {
        $SQL = "SELECT Ventas.VentaUsuarioIdMP, Ventas.VentaMontoTicket,Ventas.VentaId, Ventas.TarjetaId, Ventas.DistribuidorId, Ventas.VentaNumeroTicket, Ventas.VentaDetalleMontoTicket, Ventas.VentaFechaRegistro, VentasAuditorias.VentaAuditoriaEstatusId,UsuariosDetalles.UsuarioId, UsuariosDetalles.UsuarioDetalleNombre,DistribuidoresDetalles.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleNombreComercial,VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion,vdsuma.monto,vdsuma.cantidad,vdsuma.litros
                FROM Ventas 
                INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
                INNER JOIN Usuarios ON Usuarios.UsuarioId = Ventas.VentaUsuarioIdMP
                INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId
                INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                INNER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId
                INNER JOIN (SELECT  VentasDetalles.VentaId , SUM(VentasDetalles.VentaDetalleMonto * VentasDetalles.VentaDetalleCantidad) AS monto, SUM(VentasDetalles.VentaDetalleCantidad) AS cantidad, SUM(VentasDetalles.VentaDetalleLitros * VentasDetalles.VentaDetalleCantidad) AS litros FROM VentasDetalles WHERE (VentaDetalleFechaBaja IS NULL) GROUP BY VentaId ) AS vdsuma ON vdsuma.VentaId = Ventas.VentaId 
                WHERE (Ventas.VentaFechaBaja IS NULL) 
                AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) 
                AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) 
                AND Usuarios.UsuarioFechaBajaParticipante IS NULL 
                AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) 
                AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) 
                AND YEAR(Ventas.VentaFechaRegistro)='" . $anio . "' AND MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes)";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_maestros_pintores($anio, $mes, $mes_anterior)
    {
        $SQL = "SELECT UsuariosDetalles.UsuarioId, DistribuidoresDetalles.DistribuidorDetalleId,Ventas.DistribuidorId, SUM(Ventas.VentaDetalleMontoTicket) AS SumaMontoTicket,Ventas.VentaUsuarioIdMP, UsuariosDetalles.UsuarioDetalleNombre, DistribuidoresDetalles.DistribuidorDetalleCodigo,DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleNombreComercial, SUM(vdsuma.monto) AS SumaMonto, SUM(vdsuma.cantidad) AS SumaCantidad, SUM(vdsuma.litros) AS SumaLitros,COUNT(Ventas.VentaId) AS CountTickets
                FROM Ventas 
                INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
                INNER JOIN Usuarios ON Usuarios.UsuarioId = Ventas.VentaUsuarioIdMP
                INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId
                INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                INNER JOIN (SELECT VentaId, SUM(VentaDetalleMonto * VentaDetalleCantidad) AS monto, SUM(VentaDetalleCantidad) AS cantidad, SUM(VentaDetalleLitros * VentaDetalleCantidad) AS litros FROM VentasDetalles WHERE (VentaDetalleFechaBaja IS NULL) GROUP BY VentaId) AS vdsuma ON vdsuma.VentaId = Ventas.VentaId
                WHERE (Ventas.VentaFechaBaja IS NULL) 
                AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL)
                 AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL)
                AND Usuarios.UsuarioFechaBajaParticipante IS NULL 
                AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) 
                AND YEAR(Ventas.VentaFechaRegistro)='" . $anio . "' AND MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes) 
                AND VentasAuditorias.VentaAuditoriaFechaBaja IS NULL
                GROUP BY Ventas.DistribuidorId, UsuariosDetalles.UsuarioId, Ventas.VentaUsuarioIdMP, UsuariosDetalles.UsuarioDetalleNombre, DistribuidoresDetalles.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_distribuidores($anio, $mes, $mes_anterior)
    {
        $SQL = "SELECT Ventas.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial, COUNT(Ventas.VentaId) AS CuentaTickete,
         SUM(Ventas.VentaDetalleMontoTicket) AS SumaMontoTickets, 
         SUM(vdsuma.monto) AS SumaMonto, SUM(vdsuma.cantidad) AS SumaCantidad, SUM(vdsuma.litros) AS SumaLitros
                FROM Ventas 
                INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
                INNER JOIN Usuarios ON Usuarios.UsuarioId = Ventas.VentaUsuarioIdMP
                INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId
                INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
               INNER JOIN (SELECT VentaId, SUM(VentaDetalleMonto * VentaDetalleCantidad) AS monto, SUM(VentaDetalleCantidad) AS cantidad, SUM(VentaDetalleLitros * VentaDetalleCantidad) AS litros FROM VentasDetalles WHERE (VentaDetalleFechaBaja IS NULL) GROUP BY VentaId) AS vdsuma ON vdsuma.VentaId = Ventas.VentaId
                WHERE (Ventas.VentaFechaBaja IS NULL) 
                AND Usuarios.UsuarioFechaBajaParticipante IS NULL  
                AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) 
                AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL)
                 AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL)
                 AND YEAR(Ventas.VentaFechaRegistro)='" . $anio . "' AND MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes) 
                AND VentasAuditorias.VentaAuditoriaFechaBaja IS NULL
                GROUP BY Ventas.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_productos_registrados($anio, $mes, $mes_anterior)
    {
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorDetalleCodigo, 
            DistribuidoresDetalles.DistribuidorDetalleRazonSocial, 
DistribuidoresDetalles.DistribuidorDetalleNombreComercial, UsuariosDetalles.UsuarioId, UsuariosDetalles.UsuarioDetalleId, Tarjetas.TarjetaId, 
Tarjetas.TarjetaNumero, VentasDetalles.VentaId, Ventas.VentaNumeroTicket, 
Ventas.VentaDetalleMontoTicket,Ventas.VentaMontoTicket, VentasDetalles.VentaDetalleMonto, VentasDetalles.VentaDetalleTotal, VentasDetalles.VentaDetalleLitros, 
VentasDetalles.VentaDetalleCantidad, Ventas.VentaFechaRegistro, ProductosMarcas.ProductoMarcaId , ProductosMarcas.ProductoMarcaDescripcion,
ProductosMarcas.ProductoMarcaDescripcion,ProductosClases.ProductoClaseId, ProductosClases.ProductoClaseDescripcion, 
VentasAuditorias.VentaAuditoriaEstatusId, 
UsuariosDetalles.UsuarioDetalleNombre AS nombrepax
FROM VentasDetalles 
INNER JOIN Ventas ON VentasDetalles.VentaId = Ventas.VentaId 
INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
INNER JOIN Usuarios ON Usuarios.UsuarioId = Ventas.VentaUsuarioIdMP
INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId  
INNER JOIN Tarjetas ON (Ventas.TarjetaId = Tarjetas.TarjetaId AND Tarjetas.UsuarioId =  Usuarios.UsuarioId ) 
INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId
INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
INNER JOIN ProductosMarcas ON VentasDetalles.ProductoMarcaId = ProductosMarcas.ProductoMarcaId 
INNER JOIN ProductosClases ON ProductosMarcas.ProductoClaseId = ProductosClases.ProductoClaseId 
WHERE  (Ventas.VentaFechaBaja IS NULL) AND VentasDetalles.VentaDetalleFechaBaja IS NULL AND Usuarios.UsuarioFechaBajaParticipante IS NULL  AND (VentasAuditorias.VentaAuditoriaEstatusId = 2)
AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL)
AND YEAR(Ventas.VentaFechaRegistro)='" . $anio . "' AND MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes)
AND VentasAuditorias.VentaAuditoriaFechaBaja IS NULL";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_litros_clase($anio, $mes, $mes_anterior)
    {
        $SQL = "SELECT 
            DistribuidoresDetalles.DistribuidorId, 
            DistribuidoresDetalles.DistribuidorDetalleId, 
            DistribuidoresDetalles.DistribuidorDetalleCodigo, 
            DistribuidoresDetalles.DistribuidorDetalleRazonSocial, 
            DistribuidoresDetalles.DistribuidorDetalleNombreComercial, 
            ProductosClases.ProductoClaseId, 
            ProductosClases.ProductoClaseDescripcion,  
            SUM((VentasDetalles.VentaDetalleCantidad * VentasDetalles.VentaDetalleLitros)) as TotalLitros, 
            SUM((VentasDetalles.VentaDetalleCantidad * VentasDetalles.VentaDetalleMonto)) as TotalMonto
            FROM Ventas 
            INNER JOIN VentasDetalles ON Ventas.VentaId = VentasDetalles.VentaId 
            INNER JOIN Usuarios ON Usuarios.UsuarioId = Ventas.VentaUsuarioIdMP
			INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId  
			INNER JOIN ProductosMarcas ON VentasDetalles.ProductoMarcaId = ProductosMarcas.ProductoMarcaId 
            INNER JOIN ProductosClases ON ProductosMarcas.ProductoClaseId = ProductosClases.ProductoClaseId 
            INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId
			INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
			INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
            WHERE  (VentasDetalles.VentaDetalleFechaBaja IS NULL) 
            AND Usuarios.UsuarioFechaBajaParticipante IS NULL 
            AND (ProductosMarcas.ProductoMarcaFechaBaja IS NULL) 
            AND (ProductosClases.ProductoClaseFechaBaja IS NULL) 
            AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) 
            AND (Distribuidores.DistribuidorFechaBaja IS NULL) AND 
            (Ventas.VentaFechaBaja IS NULL) 
            AND (Ventas.VentaFechaBaja IS NULL)  AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) 
            AND YEAR(Ventas.VentaFechaRegistro)=$anio AND MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes) 
            AND VentasAuditorias.VentaAuditoriaFechaBaja IS NULL                  
            Group BY DistribuidoresDetalles.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial,ProductosClases.ProductoClaseId, ProductosClases.ProductoClaseDescripcion
            ORDER BY DistribuidoresDetalles.DistribuidorId";
        $query = $this->db->query($SQL);
        return $query->result();
    }

    public function ventas_cortes_bimestral_model_perfiles($anio, $mes, $mes_anterior)
    {
        $SQL = "SELECT 
            Ventas.DistribuidorId, 
            Ventas.VentaUsuarioIdRegistro,
            COUNT(Ventas.VentaId) AS cantidad_tickets, 
            SUM(Ventas.VentaMontoTicket) as monto_ticket
            FROM Ventas 
            INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
            WHERE (Ventas.VentaFechaBaja IS NULL) 
            AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) 
            AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) 
        AND YEAR(Ventas.VentaFechaRegistro)=$anio AND MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes) 
        GROUP BY Ventas.DistribuidorId, Ventas.VentaUsuarioIdRegistro";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_lugar($ReposicionProductoGanadorAnio, $ReposicionProductoGanadorMes, $DistribuidorId, $UsuarioId)
    {
        $SQL = "SELECT ReposicionProductoGanadorPremioLugar FROM ReposicionesProductosGanadores WHERE ReposicionProductoGanadorAnio = $ReposicionProductoGanadorAnio AND ReposicionProductoGanadorMes = $ReposicionProductoGanadorMes AND DistribuidorId = $DistribuidorId AND UsuarioId = $UsuarioId";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
    public function ventas_cortes_bimestral_model_ganador($ReposicionProductoGanadorAnio, $ReposicionProductoGanadorMes, $DistribuidorId)
    {
        $SQL = "SELECT COUNT(ReposicionProductoGanadorId) as tot FROM ReposicionesProductosGanadores WHERE ReposicionProductoGanadorAnio = $ReposicionProductoGanadorAnio AND ReposicionProductoGanadorMes = $ReposicionProductoGanadorMes AND DistribuidorId = $DistribuidorId";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;
    }
    public function ventas_cortes_bimestral_model_corte($anio, $mes)
    {
        $SQL = "SELECT CorteId,CorteTipoId,CorteAnio,CorteMes,CorteFechaRegistro,CorteUsuarioIdRegistro,CorteIdOtro FROM Cortes WHERE CorteTipoId = 3 AND CorteAnio =$anio AND CorteMes = $mes";
        $query = $this->db->query($SQL);
        return $query->row()->CorteId;
    }
    public function ventas_cortes_bimestral_model_visualiza_corte($CorteId)
    {
        $SQL = "SELECT 
                    cbv.CorteBimestralVentaId,
                    cbv.CorteId,
                    cbv.CorteBimestralVentaTarjetaId,
                    cbv.CorteBimestralVentaVentaId,
                    cbv.CorteBimestralVentaUsuarioIdMP AS CorteBimestralVentaUsuarioId,
                    ud.UsuarioDetalleNombre AS CorteBimestralVentaNombreMaestroPintor,
                    cbv.CorteBimestralVentaDistribuidorId,
                    dd.DistribuidorDetalleCodigo AS CorteBimestralVentaDistribuidorDetalleCodigo,
                    dd.DistribuidorDetalleRazonSocial AS CorteBimestralVentaDistribuidorDetalleRazonSocial,
                    dd.DistribuidorDetalleNombreComercial AS CorteBimestralVentaDistribuidorDetalleNombreComercial,
                    cbv.CorteBimestralVentaVentaNumeroTicket,
                    cbv.CorteBimestralVentaVentaMontoTicket,
                    ISNULL(vdsuma.monto, 0) AS CorteBimestralVentaVentaDetalleMonto,
                    ISNULL(vdsuma.cantidad, 0) AS CorteBimestralVentaVentaDetalleCantidad,
                    ISNULL(vdsuma.litros, 0) AS CorteBimestralVentaVentaDetalleLitros,
                    '' AS CorteBimestralVentaPromocion,
                    cbv.CorteBimestralVentaMes,
                    cbv.CorteBimestralVentaVentaEstatus,
                    vae.VentaAuditoriaEstatusDescripcion AS CorteBimestralVentaVentaAuditoriaEstatusDescripcion,
                    cbv.CorteBimestralVentaFechaRegistro AS CorteBimestralVentaVentaFechaRegistro
                FROM CortesBimestralesVentas cbv
                INNER JOIN Usuarios u ON cbv.CorteBimestralVentaUsuarioIdMP = u.UsuarioId
                INNER JOIN UsuariosDetalles ud ON u.UsuarioId = ud.UsuarioId AND ud.UsuarioDetalleFechaBaja IS NULL
                INNER JOIN Distribuidores d ON cbv.CorteBimestralVentaDistribuidorId = d.DistribuidorId
                INNER JOIN DistribuidoresDetalles dd ON d.DistribuidorId = dd.DistribuidorId AND dd.DistribuidorDetalleFechaBaja IS NULL
                INNER JOIN Ventas v ON cbv.CorteBimestralVentaVentaId = v.VentaId
                LEFT JOIN VentasAuditorias va ON v.VentaId = va.VentaId AND va.VentaAuditoriaFechaBaja IS NULL
                LEFT JOIN VentasAuditoriasEstatus vae ON va.VentaAuditoriaEstatusId = vae.VentaAuditoriaEstatusId
                LEFT JOIN (
                    SELECT VentaId,
                        SUM(VentaDetalleMonto * VentaDetalleCantidad) AS monto,
                        SUM(VentaDetalleCantidad) AS cantidad,
                        SUM(VentaDetalleLitros * VentaDetalleCantidad) AS litros
                    FROM VentasDetalles
                    WHERE VentaDetalleFechaBaja IS NULL
                    GROUP BY VentaId
                ) AS vdsuma ON vdsuma.VentaId = v.VentaId
                WHERE cbv.CorteId = $CorteId";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_visualiza_maestros_pintores($CorteId)
    {
        $SQL = "SELECT
                    cbmp.CorteBimestralMaestroPintorId,
                    cbmp.CorteId,
                    cbmp.CorteBimestralMaestroPintorDistribuidorId,
                    dd.DistribuidorDetalleCodigo AS CorteBimestralMaestroPintorDistribuidorDetalleCodigo,
                    dd.DistribuidorDetalleRazonSocial AS CorteBimestralMaestroPintorDistribuidorDetalleRazonSocial,
                    dd.DistribuidorDetalleNombreComercial AS CorteBimestralMaestroPintorDistribuidorDetalleNombreComercial,
                    cbmp.CorteBimestralMaestroPintorUsuarioIdMP AS CorteBimestralMaestroPintorUsuarioId,
                    ud.UsuarioDetalleNombre AS CorteBimestralMaestroPintorMaestroPintor,
                    cbmp.CorteBimestralMaestroPintorCantidadTickets,
                    cbmp.CorteBimestralMaestroPintorVentaMontoTicket,
                    ISNULL(pr.TotalMonto, 0) AS CorteBimestralMaestroPintorVentaDetalleMonto,
                    ISNULL(pr.TotalCantidad, 0) AS CorteBimestralMaestroPintorVentaDetalleCantidad,
                    ISNULL(pr.TotalLitros, 0) AS CorteBimestralMaestroPintorVentaDetalleLitros,
                    cbmp.ReposicionProductoGanadorPremioLugar
                FROM CortesBimestralesMaestrosPintores cbmp
                INNER JOIN Distribuidores d ON cbmp.CorteBimestralMaestroPintorDistribuidorId = d.DistribuidorId
                INNER JOIN DistribuidoresDetalles dd ON d.DistribuidorId = dd.DistribuidorId AND dd.DistribuidorDetalleFechaBaja IS NULL
                INNER JOIN Usuarios u ON cbmp.CorteBimestralMaestroPintorUsuarioIdMP = u.UsuarioId
                INNER JOIN UsuariosDetalles ud ON u.UsuarioId = ud.UsuarioId AND ud.UsuarioDetalleFechaBaja IS NULL
                LEFT JOIN (
                    SELECT CorteBimestralProductoRegistradoDistribuidorId, CorteBimestralProductoRegistradoUsuarioId, CorteId,
                        SUM(CorteBimestralProductoRegistradoVentaDetalleMonto) AS TotalMonto,
                        SUM(CorteBimestralProductoRegistradoVentaDetalleCantidad) AS TotalCantidad,
                        SUM(CorteBimestralProductoRegistradoVentaDetalleLitrosTotal) AS TotalLitros
                    FROM CortesBimestralesProductosRegistrados
                    GROUP BY CorteBimestralProductoRegistradoDistribuidorId, CorteBimestralProductoRegistradoUsuarioId, CorteId
                ) AS pr ON pr.CorteBimestralProductoRegistradoDistribuidorId = cbmp.CorteBimestralMaestroPintorDistribuidorId
                        AND pr.CorteBimestralProductoRegistradoUsuarioId = cbmp.CorteBimestralMaestroPintorUsuarioIdMP
                        AND pr.CorteId = cbmp.CorteId
                WHERE cbmp.CorteId = $CorteId";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_visualiza_ditribuidores($CorteId)
    {
        $SQL = "SELECT
                    cbdist.CorteBimestralDistribuidorId,
                    cbdist.CorteId,
                    cbdist.CorteBimestralDistribuidorDistribuidorId,
                    dd.DistribuidorDetalleCodigo AS CorteBimestralDistribuidorDistribuidorDetalleCodigo,
                    dd.DistribuidorDetalleRazonSocial AS CorteBimestralDistribuidorDistribuidorDetalleRazonSocial,
                    dd.DistribuidorDetalleNombreComercial AS CorteBimestralDistribuidorDistribuidorDetalleNombreComercial,
                    cbdist.CorteBimestralDistribuidorCantidadTicktes,
                    cbdist.CorteBimestralDistribuidorVentaMontoTicket,
                    ISNULL(pr.TotalMonto, 0) AS CorteBimestralDistribuidorVentaDetalleMonto,
                    ISNULL(pr.TotalCantidad, 0) AS CorteBimestralDistribuidorVentaDetalleCantidad,
                    ISNULL(lc.TotalLitros, 0) AS CorteBimestralDistribuidorVentaDetalleLitros,
                    0 AS CorteBimestralDistribuidorGanador
                FROM CortesBimestralesDistribuidores cbdist
                INNER JOIN Distribuidores d ON cbdist.CorteBimestralDistribuidorDistribuidorId = d.DistribuidorId
                INNER JOIN DistribuidoresDetalles dd ON d.DistribuidorId = dd.DistribuidorId AND dd.DistribuidorDetalleFechaBaja IS NULL
                LEFT JOIN (
                    SELECT CorteBimestralProductoRegistradoDistribuidorId, CorteId,
                        SUM(CorteBimestralProductoRegistradoVentaDetalleMonto) AS TotalMonto,
                        SUM(CorteBimestralProductoRegistradoVentaDetalleCantidad) AS TotalCantidad
                    FROM CortesBimestralesProductosRegistrados
                    GROUP BY CorteBimestralProductoRegistradoDistribuidorId, CorteId
                ) AS pr ON pr.CorteBimestralProductoRegistradoDistribuidorId = cbdist.CorteBimestralDistribuidorDistribuidorId
                        AND pr.CorteId = cbdist.CorteId
                LEFT JOIN (
                    SELECT CorteBimestralVentaDistribuidorId, CorteId,
                        SUM(CorteBimestralVentaLitroClaseDetalleLitros) AS TotalLitros
                    FROM CortesBimestralesVentasLitrosClases
                    GROUP BY CorteBimestralVentaDistribuidorId, CorteId
                ) AS lc ON lc.CorteBimestralVentaDistribuidorId = cbdist.CorteBimestralDistribuidorDistribuidorId
                        AND lc.CorteId = cbdist.CorteId
                WHERE cbdist.CorteId = $CorteId";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_visualiza_productos_registrados($CorteId)
    {
        $SQL = "SELECT
                    cbpr.CorteBimestralProductoRegistradoId,
                    cbpr.CorteId,
                    cbpr.CorteBimestralProductoRegistradoDistribuidorId,
                    dd.DistribuidorDetalleCodigo AS CorteBimestralProductoRegistradoDistribuidorDetalleCodigo,
                    dd.DistribuidorDetalleRazonSocial AS CorteBimestralProductoRegistradoDistribuidorDetalleRazonSocial,
                    dd.DistribuidorDetalleNombreComercial AS CorteBimestralProductoRegistradoDistribuidorDetalleNombreComercial,
                    cbpr.CorteBimestralProductoRegistradoUsuarioId,
                    ud.UsuarioDetalleNombre AS CorteBimestralProductoRegistradoNombreMaestroPintor,
                    t.TarjetaNumero AS CorteBimestralProductoRegistradoTarjetaNumero,
                    cbpr.CorteBimestralProductoRegistradoVentaNumeroTicket,
                    cbpr.CorteBimestralProductoRegistradoVentaMontoTicket,
                    pl.ProductoLiniaNombre AS CorteBimestralProductoRegistradoProductoLineaDescripcion,
                    pc.ProductoClaseDescripcion AS CorteBimestralProductoRegistradoProductoClaseDescripcion,
                    pm.ProductoMarcaDescripcion AS CorteBimestralProductoRegistradoProductoMarcaDescripcion,
                    cbpr.CorteBimestralProductoRegistradoVentaDetalleLitros,
                    cbpr.CorteBimestralProductoRegistradoVentaDetalleCantidad,
                    cbpr.CorteBimestralProductoRegistradoVentaDetalleLitrosTotal,
                    cbpr.CorteBimestralProductoRegistradoVentaDetalleMonto,
                    cbpr.CorteBimestralProductoRegistradoVentaDetalleMontoTotal,
                    cbpr.CorteBimestralProductoRegistradoVentaEstatus,
                    cbpr.CorteBimestralProductoRegistradoVentaFechaRegistro,
                    cbpr.CorteBimestralProductoRegistradoFechaRegistro,
                    cbpr.CorteBimestralProductoRegistradoUsuarioIdRegistro
                FROM CortesBimestralesProductosRegistrados cbpr
                INNER JOIN Distribuidores d ON cbpr.CorteBimestralProductoRegistradoDistribuidorId = d.DistribuidorId
                INNER JOIN DistribuidoresDetalles dd ON d.DistribuidorId = dd.DistribuidorId AND dd.DistribuidorDetalleFechaBaja IS NULL
                INNER JOIN Usuarios u ON cbpr.CorteBimestralProductoRegistradoUsuarioId = u.UsuarioId
                INNER JOIN UsuariosDetalles ud ON u.UsuarioId = ud.UsuarioId AND ud.UsuarioDetalleFechaBaja IS NULL
                INNER JOIN Tarjetas t ON cbpr.CorteBimestralProductoRegistradoTarjetaId = t.TarjetaId
                INNER JOIN ProductosMarcas pm ON cbpr.CorteBimestralProductoRegistradoProductoMarcaId = pm.ProductoMarcaId
                INNER JOIN ProductosClases pc ON pm.ProductoClaseId = pc.ProductoClaseId
                INNER JOIN ProductosLineas pl ON pc.ProductoLineaId = pl.ProductoLineaId
                WHERE cbpr.CorteId = $CorteId";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_bimestral_model_visualiza_litros_clase($CorteId)
    {
        $SQL = "SELECT
                    cblc.CortesBimestralVentasLitroClaseId,
                    cblc.CorteId,
                    cblc.CorteBimestralVentaDistribuidorId,
                    dd.DistribuidorDetalleCodigo AS CorteBimestralVentaDistribuidorDetalleCodigo,
                    dd.DistribuidorDetalleRazonSocial AS CorteBimestralVentaDistribuidorDetalleRazonSocial,
                    dd.DistribuidorDetalleNombreComercial AS CorteBimestralVentaDistribuidorDetalleNombreComercial,
                    cblc.CorteBimestralVentaLitroClaseProductoClaseId,
                    pl.ProductoLiniaNombre AS CorteBimestralVentaLitroClaseProductoLineaDescripcion,
                    pc.ProductoClaseDescripcion AS CorteBimestralVentaLitroClaseProductoClaseDescripcion,
                    cblc.CorteBimestralVentaLitroClaseDetalleLitros,
                    cblc.CorteBimestralVentaLitroClaseDetalleMonto,
                    cblc.CorteBimestralVentaLitroClaseUsuarioIdRegistro
                FROM CortesBimestralesVentasLitrosClases cblc
                INNER JOIN Distribuidores d ON cblc.CorteBimestralVentaDistribuidorId = d.DistribuidorId
                INNER JOIN DistribuidoresDetalles dd ON d.DistribuidorId = dd.DistribuidorId AND dd.DistribuidorDetalleFechaBaja IS NULL
                INNER JOIN ProductosClases pc ON cblc.CorteBimestralVentaLitroClaseProductoClaseId = pc.ProductoClaseId
                INNER JOIN ProductosLineas pl ON pc.ProductoLineaId = pl.ProductoLineaId
                WHERE cblc.CorteId = $CorteId";
        $query = $this->db->query($SQL);
        return $query->result();
    }

    public function ventas_cortes_bimestral_model_corte_perfil($CorteId) {
        $SQL = "SELECT 
            CBP.CorteId,
            CBP.CortesBimestralPerfilDistribuidorId,
            CBP.CortesBimestralPerfilDetalleUsuarioIdRegistro,
            CBP.CortesBimestralPerfilId,
            CBP.CortesBimestralPerfilDistribuidorCantidadTicktes,
            CBP.CortesBimestralPerfilDistribuidorVentaMontoTicket,
            CBP.CortesBimestralPerfilDistribuidorUsuarioIdRegistroCorte,
            DD.DistribuidorDetalleCodigo AS CortesBimestralPerfilDistribuidorDetalleCodigo,
            DD.DistribuidorDetalleRazonSocial AS CortesBimestralPerfilDistribuidorDetalleRazonSocial,
            DD.DistribuidorDetalleNombreComercial AS CortesBimestralPerfilDistribuidorDetalleNombreComercial,
            DDR.DistribuidorDetalleRegionNombre AS CortesBimestralPerfilDistribuidorDetalleRegionNombre,
            P.PerfilDescripcion AS CortesBimestralPerfilPerfilDescripcion
        FROM CortesBimestralesPerfiles CBP
        LEFT OUTER JOIN DistribuidoresDetalles DD ON CBP.CortesBimestralPerfilDistribuidorId = DD.DistribuidorId
        LEFT OUTER JOIN DistribuidoresDetallesRegiones DDR ON DD.DistribuidorDetalleRegionId = DDR.DistribuidorDetalleRegionId
        LEFT OUTER JOIN Perfiles P ON CBP.CortesBimestralPerfilId = P.PerfilId
        WHERE CBP.CorteId = $CorteId";
        $query	= $this->db->query($SQL);
        return $query->result();        
    }    
    public function ventas_cortes_bimestral_model_valida_ventas_auditorias($anio, $mes, $mes_anterior)
    {
        $SQL1 = "SELECT COUNT(VentaId) tot 
                FROM Ventas 
                  INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId
                WHERE VentaFechaBaja IS NULL AND YEAR(Ventas.VentaFechaRegistro)='" . $anio . "' AND (MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes));";
        $query1 = $this->db->query($SQL1);
        //        echo  $this->db->last_query()."<br>"; 
        $total_ventas = $query1->row()->tot;
        $SQL2 = "SELECT COUNT(Ventas.VentaId) AS tot 
                FROM Ventas 
                 INNER JOIN Distribuidores ON Ventas.DistribuidorId = Distribuidores.DistribuidorId
                 LEFT OUTER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
                WHERE  (Ventas.VentaFechaBaja IS NULL)  AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaId IS NOT NULL)  AND YEAR(Ventas.VentaFechaRegistro)='" . $anio . "' AND (MONTH(Ventas.VentaFechaRegistro) IN ($mes_anterior, $mes))";
        $query2 = $this->db->query($SQL2);
        //        echo  $this->db->last_query()."<br>"; 
        $total_auditoria = $query2->row()->tot;
        //        echo $total_ventas." - ".$total_auditoria;
        return ($total_ventas == $total_auditoria) ? 0 : 1;
    }
    public function ventas_cortes_bimestral_model_valida_corte_cambio_estatus($anio, $mes, $mes_anterior)
    {
        $SQL1 = "SELECT COUNT(CorteId) as tot1 FROM Cortes WHERE CorteTipoId = 1 AND CorteAnio = $anio AND CorteMes = $mes ";
        $query1 = $this->db->query($SQL1);
        //        echo  $this->db->last_query()."<br>"; 
        $mesactual = $query1->row()->tot1;
        $SQL2 = "SELECT COUNT(CorteId) as tot2 FROM Cortes WHERE CorteTipoId = 1 AND CorteAnio = $anio AND CorteMes in ($mes_anterior)";
        $query2 = $this->db->query($SQL2);
        //        echo  $this->db->last_query()."<br>"; 
        $mesanterior = $query2->row()->tot2;
        return ($mesactual > 0 && $mesanterior > 0) ? 0 : 1;
    }
    public function ventas_cortes_bimestral_model_tiene_promociones($VentaId)
    {
        $SQL = "SELECT       count( VentaId) as tot FROM Ventas where VentaTienePromocion =1 and VentaId = $VentaId";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;
    }
    
}