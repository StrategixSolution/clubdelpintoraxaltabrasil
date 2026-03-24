<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_registro_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }

    public function ventas_registro_model_combo_clases(){
        $SQL    = "SELECT ProductoClaseId,ProductoClaseDescripcion FROM ProductosClases WHERE ProductoClaseFechaBaja IS NULL";
        $query	= $this->db->query($SQL);
     //   echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_registro_model_combo_marcas($ProductoClaseId){
        $SQL    = "SELECT ProductoMarcaId,ProductoClaseId,ProductoMarcaDescripcion FROM ProductosMarcas WHERE ProductoClaseId=".$ProductoClaseId." AND ProductoMarcaFechaBaja IS NULL";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_registro_model_combo_litros(){
        $SQL    = "SELECT VentaDetalleGalonId,VentaDetalleGalonDescripcion,VentaDetalleGalonEquivalencia FROM VentasDetallesGalones ";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }    
    public function ventas_registro_model_maestro_pintor_informacion($TarjetaNumero){
        $SQL    = "SELECT Usuarios.UsuarioId, UsuariosDetalles.UsuarioDetalleId, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidoPaterno, UsuariosDetalles.UsuarioDetalleApellidoMaterno, Tarjetas.TarjetaNumero, UsuariosDetalles.UsuarioDetalleEmail, UsuariosDetalles.UsuarioDetalleCelular, UsuariosDetalles.UsuarioDetalleRFC
                    FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN Tarjetas ON Usuarios.UsuarioId = Tarjetas.UsuarioId INNER JOIN Distribuidores ON Tarjetas.DistribuidorId = Distribuidores.DistribuidorId 
                    WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (Tarjetas.TarjetaFechaBaja IS NULL) AND (Tarjetas.TarjetaEstatusId = 2) AND (Usuarios.PerfilId = 9)  AND (Tarjetas.TarjetaNumero = '$TarjetaNumero') ";
        $query	= $this->db->query($SQL);
    //        echo  $this->db->last_query()."<br>"; 
        if ($query->num_rows() > 0){ return $query->row(); }  
    }
    public function ventas_registro_model_nombre_clases($ProductoClaseId){
        $SQL    = "SELECT ProductoClaseId,ProductoClaseDescripcion FROM ProductosClases WHERE ProductoClaseId =".$ProductoClaseId;
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->ProductoClaseDescripcion;
    }
    public function ventas_registro_model_nombre_marcas($ProductoMarcaId){
        $SQL    = "SELECT ProductoMarcaId,ProductoClaseId,ProductoMarcaDescripcion FROM ProductosMarcas WHERE ProductoMarcaId=".$ProductoMarcaId;
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->ProductoMarcaDescripcion;
    }
    public function ventas_registro_model_nombre_litros($ProductoMarcaId){
        $SQL    = "SELECT VentaDetalleGalonId,VentaDetalleGalonDescripcion,VentaDetalleGalonEquivalencia FROM VentasDetallesGalones where VentaDetalleGalonEquivalencia=".$ProductoMarcaId;
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->VentaDetalleGalonDescripcion;
    }
    public function ventas_registro_model_guardar_venta($data) {
        $SQL    = "INSERT INTO Ventas (TarjetaNumero,DistribuidorDetalleId,UsuarioDetalleId,UsuarioIdCapturo,VentaNumeroTicket,VentaMontoTicketCapturado,VentaMontoTicket,VentaCantidadProdcutos,VentaTotalCantidadProdcutos,VentaFotoTicket,VentaAuditoriaEntra,VentaSessionId) VALUES ($data)";
        $query	= $this->db->query($SQL);
        $query2 = $this->db->query("SELECT IDENT_CURRENT('Ventas') as last_id");  $res = $query2->result();  $lastId     = $res[0]->last_id; 
        //echo  $this->db->last_query()."<br>"; 
        return $lastId;
    }
    public function ventas_registro_model_guardar_venta_detalle($data) {
        $SQL    = "INSERT INTO VentasDetalles (VentaId,UsuarioIdCapturo,VentaDetalleMonto,VentaDetalleCantidad,VentaDetalleLitros,ProductoMarcaId,VentaDetalleTotal) VALUES ($data)";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
    }    
    public function ventas_registro_model_distribuidor($UsuarioId){
        $SQL    = "SELECT DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorId FROM UsuariosDistribuidores INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL AND UsuariosDistribuidores.UsuarioId = $UsuarioId ";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
    public function ventas_registro_model_auditoria_monto($UsuarioId,$VentaFechaRegistro,$monto){
        $VentaFechaRegistroDate = date_create($VentaFechaRegistro); $VentaFechaRegistroAnio = date_format($VentaFechaRegistroDate, 'Y'); $VentaFechaRegistroMes = date_format($VentaFechaRegistroDate, 'm');
        $SQL    = "SELECT COUNT(VentaId) AS TOTAL FROM Ventas WHERE VentaFechaBaja IS NULL AND VentaMontoTicket = $monto AND YEAR(VentaFechaRegistro) = $VentaFechaRegistroAnio AND MONTH(VentaFechaRegistro) = $VentaFechaRegistroMes AND UsuarioDetalleId = $UsuarioId";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->TOTAL;
    } 
    public function ventas_registro_model_auditoria_monto_update($UsuarioId,$VentaFechaRegistro,$monto) {
        $VentaFechaRegistroDate = date_create($VentaFechaRegistro); $VentaFechaRegistroAnio = date_format($VentaFechaRegistroDate, 'Y'); $VentaFechaRegistroMes = date_format($VentaFechaRegistroDate, 'm');
        $SQL    = "UPDATE Ventas SET VentaAuditoriaEntra = 1 WHERE VentaFechaBaja IS NULL AND VentaMontoTicket = $monto AND YEAR(VentaFechaRegistro) = $VentaFechaRegistroAnio AND MONTH(VentaFechaRegistro) = $VentaFechaRegistroMes AND UsuarioDetalleId = $UsuarioId";
        $query	= $this->db->query($SQL);
    }
        public function ventas_registro_model_venta_promocion($VentaId){
        $SQL    = "UPDATE Ventas SET VentaTienePromocion = 1 WHERE VentaId = $VentaId";
        $this->db->query($SQL);
        return 1;
    }
    public function ventas_registro_model_valida_promocion(){
        $SQL    = "SELECT COUNT(VentaPromocionId) AS TOTAL FROM VentasPromociones WHERE VentaPromocionFechaBaja IS NULL AND '". date('Y-m-d')."'>= VentaPromocionFechaInicio AND '".date('Y-m-d')."'<=VentaPromocionFechaFin " ;
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->TOTAL;
    }    
    public function ventas_registro_model_distribuidor_activo($distriubidor,$año,$mes){
        $SQL = "SELECT count(DistribuidorId) AS ACTIVOS FROM DistribuidoresActivos WHERE DistribuidorActivoAnio = $año AND DistribuidorActivoMes = $mes AND DistribuidorId = $distriubidor";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->ACTIVOS;           
    }
     public function ventas_registro_model_ventas_totales($distriubidor,$año,$mes){
        $SQL = "SELECT count(VentaId) AS total FROM Ventas WHERE DistribuidorDetalleId = $distriubidor AND VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro) = $año AND MONTH(VentaFechaRegistro) = $mes ";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->total;           
    }
     public function ventas_registro_model_ventas_insert_distribuidor_activo($data) {
        $SQL    = "INSERT INTO DistribuidoresActivos (DistribuidorId,DistribuidorActivoAnio,DistribuidorActivoMes,DistribuidorActivoNoVentas) VALUES ($data)";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
    } 
    public function ventas_registro_model_count_ticket($ticket, $id_dist){
        $query	= $this->db->query("SELECT COUNT(VentaNumeroTicket) AS counter FROM ventas WHERE VentaNumeroTicket = '$ticket' AND ventaFechaBaja is null  AND DistribuidorDetalleId= $id_dist");
      //  echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
    public function ventas_registro_model_pais_moneda($PaisId){
        $SQL    = "SELECT PaisMonedaCodigo ,PaisMonedaNombre ,PaisMonedaSimbolo  FROM Paises  WHERE PaisId = $PaisId";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }

}