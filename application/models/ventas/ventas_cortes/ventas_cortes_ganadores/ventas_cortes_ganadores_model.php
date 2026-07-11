<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_cortes_ganadores_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function ventas_cortes_ganadores_model_combo_anio(){
        $SQL = "SELECT DISTINCT YEAR(VentaFechaRegistro) AS anio FROM Ventas";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_cortes_ganadores_model_combo_mes($anio){
        $SQL = "SELECT distinct RecompensaMes as mes FROM Recompensas where RecompensaAnio= $anio";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_cortes_ganadores_model_ganadores($CorteAnio,$CorteMes,$CorteMesAnterior){
        $SQL = "SELECT DistribuidoresDetalles.DistribuidorId, UsuariosMaestroPintor.UsuarioId, COUNT(Ventas.VentaId) AS cuenta_ventas, SUM(Ventas.VentaDetalleMontoTicket) AS suma_monto, Ventas.TarjetaId, Tarjetas.TarjetaNumero, Ventas.VentaUsuarioIdMP, RTRIM(ISNULL(UsuariosMaestroPintor.UsuarioDetalleNombre,'')) AS VentaUsuarioNombreMP, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleNombreComercial 
				FROM Ventas 
				INNER JOIN Tarjetas ON Ventas.TarjetaId = Tarjetas.TarjetaId 
				INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
				INNER JOIN UsuariosDetalles AS UsuariosMaestroPintor ON Ventas.VentaUsuarioIdMP = UsuariosMaestroPintor.UsuarioId 
				INNER JOIN Usuarios ON UsuariosMaestroPintor.UsuarioId = Usuarios.UsuarioId
				INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId
				WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) 
				AND (Ventas.VentaFechaBaja IS NULL) 
				AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) 
				AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) 
				AND (YEAR(Ventas.VentaFechaRegistro) = $CorteAnio) 
				AND (MONTH(Ventas.VentaFechaRegistro) IN ($CorteMes,$CorteMesAnterior)) 
				GROUP BY DistribuidoresDetalles.DistribuidorId, UsuariosMaestroPintor.UsuarioId, Ventas.TarjetaId, Tarjetas.TarjetaNumero, Ventas.VentaUsuarioIdMP, UsuariosMaestroPintor.UsuarioDetalleNombre, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleNombreComercial";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_cortes_ganadores_model_recompensas($CorteAnio,$CorteMes,$monto){
        $SQL = "SELECT RecompensaPremioLugar,RecompensaTipoId FROM Recompensas where RecompensaFechaBaja is null and RecompensaAnio = $CorteAnio and RecompensaMes = $CorteMes and $monto >= RecompensaRangoInicial and $monto <= RecompensaRangoFinal ;";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }  
    public function ventas_cortes_ganadores_model_reposiciones_productos_ganadores($data){
        $SQL = "INSERT INTO ReposicionesProductosGanadores (ReposicionProductoGanadorAnio,ReposicionProductoGanadorMes,ReposicionProductoGanadorPremioLugar,ReposicionProductoGanadorTotalSumaVentas,ReposicionProductoGanadorTotalCuentaVentas,ReposicionProductoGanadorObservaciones,DistribuidorId,TarjetaId,RecompensaTipoId,UsuarioId,ReposicionProductoGanadorUsuarioIdRegistro) VALUES ($data,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")"; 
        $query	= $this->db->query($SQL);
        return 1;
    }
    public function ventas_cortes_ganadores_model_tarejeta($UsuarioId){
        $SQL = "SELECT TarjetaId,TarjetaNumero FROM Tarjetas WHERE (TarjetaEstatusId = 2) AND (TarjetaFechaBaja IS NULL) AND (UsuarioId = $UsuarioId)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
    public function ventas_cortes_ganadores_model_distribuidor($DistribuidorId){
        $SQL    = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Distribuidores.DistribuidorId = $DistribuidorId)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }  
    public function ventas_cortes_ganadores_model_usuario($UsuarioId){
        $SQL    = "SELECT UsuarioDetalleId, UsuarioId, UsuarioDetalleNombre  FROM UsuariosDetalles WHERE (UsuarioId = $UsuarioId) AND (UsuarioDetalleFechaBaja IS NULL)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    } 
    public function ventas_cortes_ganadores_model_ventas_detalle($CorteAnio,$CorteMes,$CorteMesAnterior,$UsuarioId,$DistribuidorId){
        $SQL = "SELECT Ventas.VentaId, DistribuidoresDetalles.DistribuidorId, UsuariosMaestroPintor.UsuarioId, VentasDetalles.VentaDetalleMonto, VentasDetalles.VentaDetalleCantidad
                FROM Ventas INNER JOIN VentasDetalles ON Ventas.VentaId = VentasDetalles.VentaId INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN UsuariosDetalles AS UsuariosMaestroPintor ON Ventas.VentaUsuarioIdMP = UsuariosMaestroPintor.UsuarioId INNER JOIN Usuarios ON UsuariosMaestroPintor.UsuarioId = Usuarios.UsuarioId INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId
                WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL)  AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.2) AND (Ventas.VentaFechaBaja IS NULL) AND (YEAR(Ventas.VentaFechaRegistro) = $CorteAnio) AND (MONTH(Ventas.VentaFechaRegistro) IN ($CorteMesAnterior, $CorteMes)) and DistribuidoresDetalles.DistribuidorId = $DistribuidorId and  UsuariosMaestroPintor.UsuarioId =$UsuarioId ";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function ventas_cortes_ganadores_model_reposiciones_control_modulo($data){
        $SQL = "UPDATE ControlModulos SET ControlModuloEstatus =1 WHERE ControlModuloId = $data"; 
        $query	= $this->db->query($SQL);
        return 1;
    }

    public function ventas_cortes_ganadores_model_ventas_total($CorteAnio,$CorteMes,$CorteMesAnterior,$UsuarioId,$DistribuidorId){
        $SQL = "SELECT sum(Ventas.VentaDetalleMontoTicket) as tot
                FROM Ventas 
               INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = Ventas.DistribuidorId
                INNER JOIN Usuarios ON Ventas.VentaUsuarioIdMP  = Usuarios.UsuarioId 
                INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
                WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) 
                AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) 
                AND (VentasAuditorias.VentaAuditoriaEstatusId = 2) 
                AND (Ventas.VentaFechaBaja IS NULL) AND (YEAR(Ventas.VentaFechaRegistro) = $CorteAnio) AND (MONTH(Ventas.VentaFechaRegistro) IN ($CorteMesAnterior, $CorteMes)) AND (Distribuidores.DistribuidorId = $DistribuidorId) AND (Usuarios.UsuarioId = $UsuarioId)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;
    }
}