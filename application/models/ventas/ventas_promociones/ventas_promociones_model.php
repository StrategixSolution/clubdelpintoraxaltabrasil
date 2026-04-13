<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_promociones_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function ventas_promociones_model_valida_venta($VentaId){
        $SQL    = "SELECT COUNT(VentaId) AS total FROM Ventas WHERE VentaTienePromocion = 1 AND VentaId = $VentaId" ;
        $query	= $this->db->query($SQL);
//       echo  $this->db->last_query()."<br>"; 
        return $query->row()->total;
    }      
    public function ventas_promociones_model_valida_venta_registrada($VentaId){
        $SQL    = "SELECT COUNT(VentaId) AS total FROM VentasUsuariosPromociones WHERE VentaId = $VentaId" ;
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->total;
    }   
    public function ventas_promociones_model_combo_promociones(){
        $SQL    = "SELECT VentaPromocionId,VentaPromocionNombre,VentaPromocionFechaRegistro,VentaPromocionFechaBaja,VentaPromocionFechaInicio,VentaPromocionFechaFin,UsuarioIdCapturo FROM VentasPromociones "
                . "WHERE VentaPromocionFechaBaja IS NULL AND '". date('Y-m-d')."'>= VentaPromocionFechaInicio AND '".date('Y-m-d')."'<=VentaPromocionFechaFin ";
        $query	= $this->db->query($SQL);
      //  echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_promociones_model_promociones($where){
        $SQL    = "SELECT VentasPromociones.VentaPromocionFechaBaja, VentasPromociones.VentaPromocionFechaInicio, VentasPromociones.VentaPromocionFechaFin, VentasPromocionesDetalles.VentaPromocionDetalleId,VentasPromocionesDetalles.VentaPromocionId, VentasPromocionesDetalles.VentaPromocionDetalleGMC, VentasPromocionesDetalles.VentaPromocionDetalleCodigo,VentasPromocionesDetalles.VentaPromocionDetalleDescripcion, VentasPromocionesDetalles.VentaPromocionDetallePresentacion, VentasPromocionesDetalles.VentaPromocionDetalleFechaBaja, VentasPromociones.VentaPromocionNombre FROM VentasPromociones INNER JOIN VentasPromocionesDetalles ON VentasPromociones.VentaPromocionId = VentasPromocionesDetalles.VentaPromocionId 
WHERE (VentasPromociones.VentaPromocionFechaBaja IS NULL) AND ('". date('Y-m-d')."' >= VentasPromociones.VentaPromocionFechaInicio) AND ('". date('Y-m-d')."' <= VentasPromociones.VentaPromocionFechaFin) $where";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_promociones_model_guardar_promocion($data,$VentaId,$VentaPromocionId) {
        $SQL    = "INSERT INTO VentasUsuariosPromociones (VentaId,VentaPromocionDetalleId,VentaUsuarioPromocionCantidad) VALUES ($data)";
        $query	= $this->db->query($SQL);
        $SQL2    = "UPDATE Ventas SET VentaPromocionId = $VentaPromocionId WHERE VentaId = $VentaId";
        $this->db->query($SQL2);        
    }
}