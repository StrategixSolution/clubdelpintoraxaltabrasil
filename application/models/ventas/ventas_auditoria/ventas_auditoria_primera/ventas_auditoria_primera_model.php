<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MAR. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_auditoria_primera_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function ventas_auditoria_primera_model_combo_anio(){
        $SQL = "SELECT DISTINCT YEAR(VentaFechaRegistro) AS anio FROM Ventas ORDER BY YEAR(VentaFechaRegistro) ASC";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_auditoria_primera_model_combo_mes($anio){
        $SQL = "SELECT DISTINCT MONTH(VentaFechaRegistro) AS mes FROM Ventas WHERE YEAR(VentaFechaRegistro) = '$anio' ORDER BY MONTH(VentaFechaRegistro) ASC";
        $query	= $this->db->query($SQL);
        return $query->result();
    }    

public function ventas_auditoria_primera_model_total_ventas($cmb_anio,$cmb_mes){
        $SQL = "SELECT count(VentaId) as venta_total FROM Ventas INNER JOIN DistribuidoresDetalles ON DistribuidoresDetalles.DistribuidorDetalleId = Ventas.DistribuidorDetalleId INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE (Ventas.VentaFechaBaja IS NULL)  AND YEAR(Ventas.VentaFechaRegistro)=$cmb_anio AND MONTH(Ventas.VentaFechaRegistro)=$cmb_mes";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->venta_total;           
    }
     public function ventas_auditoria_primera_model_total_ventas_auditoria_random($cmb_anio,$cmb_mes){
        $SQL = "SELECT count(VentaId) as ventas_auditoria FROM Ventas INNER JOIN DistribuidoresDetalles ON DistribuidoresDetalles.DistribuidorDetalleId = Ventas.DistribuidorDetalleId INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE (Ventas.VentaFechaBaja IS NULL) AND (Ventas.VentaAuditoriaEntra = 1 or Ventas.VentaAuditoriaRandom = 1) AND YEAR(Ventas.VentaFechaRegistro)=$cmb_anio AND MONTH(Ventas.VentaFechaRegistro)=$cmb_mes";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->ventas_auditoria;           
    } 

    public function ventas_auditoria_primera_model_crea_tabla_sin_validar($where="",$limite){
        $SQL = "SELECT DISTINCT   TOP $limite    Ventas.VentaId , Ventas.VentaMontoTicket 
        FROM Ventas 
        LEFT JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId 
        LEFT JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId 
        LEFT JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId 
        INNER JOIN DistribuidoresDetalles ON DistribuidoresDetalles.DistribuidorDetalleId  = Ventas.DistribuidorDetalleId  
        INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
        INNER JOIN UsuariosDetalles ON UsuariosDetalles.UsuarioDetalleId  = Ventas.UsuarioDetalleId  
        INNER JOIN Usuarios ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
        INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId
                WHERE (VentaFechaBaja IS NULL) AND (VentaAuditoriaEntra = 0) AND (VentaAuditoriaRandom IS NULL) AND (DistribuidorFechaBaja IS NULL) AND (UsuarioFechaBajaParticipante IS NULL) AND (UsuarioFechaBajaDistribuidora IS NULL) AND (VentaAuditoriaFechaBaja IS NULL) AND (DistribuidorDetalleFechaBaja IS NULL)".$where
            . "GROUP BY Ventas.VentaId , Ventas.VentaMontoTicket ORDER BY VentaMontoTicket DESC";
        $query	= $this->db->query($SQL);
        // echo $this->db->last_query();
        return $query->result();
    }   
     public function ventas_auditoria_primera_model_update_random($idventa){
        $SQL    = "UPDATE Ventas SET VentaAuditoriaRandom = 1 WHERE (VentaId = $idventa)";
        $this->db->query($SQL);
        return 1;
    }   
  
    public function Ventas_auditoria_primera_model_crea_tabla($where=""){
        $SQL = "SELECT DISTINCT Ventas.VentaId, ventas.TarjetaNumero, Ventas.DistribuidorDetalleId, Ventas.UsuarioDetalleId, Ventas.UsuarioIdCapturo, Ventas.VentaNumeroTicket, Ventas.VentaMontoTicketCapturado, Ventas.VentaTotalCantidadProdcutos,Ventas.VentaMontoTicket, Ventas.VentaCantidadProdcutos, Perfiles.PerfilDescripcion, VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion, VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion, DistribuidoresDetalles.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleNombreComercial,Ventas.VentaFechaRegistro,VentasAuditorias.VentaAuditoriaEstatusId,VentasAuditorias.VentaAuditoriaFechaRegistro,CONCAT(UsuariosDetalles.UsuarioDetalleNombre, ' ', UsuariosDetalles.UsuarioDetalleSegundoNombre, ' ', UsuariosDetalles.UsuarioDetalleApellidos) AS nombrepax 
                FROM Ventas LEFT OUTER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId LEFT OUTER JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId LEFT OUTER JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorDetalleId = DistribuidoresDetalles.DistribuidorDetalleId INNER JOIN Distribuidores ON DistribuidoresDetalles.DistribuidorId = Distribuidores.DistribuidorId INNER JOIN UsuariosDetalles ON Ventas.UsuarioDetalleId = UsuariosDetalles.UsuarioDetalleId INNER JOIN Usuarios ON UsuariosDetalles.UsuarioId = Usuarios.UsuarioId INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId 
                WHERE (Ventas.VentaFechaBaja IS NULL) AND ((Ventas.VentaAuditoriaEntra = 1) OR (Ventas.VentaAuditoriaRandom = 1)) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND Distribuidores.DistribuidorFechaBaja IS NULL ".$where;
        $query	= $this->db->query($SQL);
//        echo $this->db->last_query();
        return $query->result();
    }
        public function ventas_auditoria_primera_model_fila($VentaId){
        $SQL = "SELECT DISTINCT Ventas.VentaMontoTicketCapturado, Ventas.VentaId, ventas.TarjetaNumero, Ventas.VentaNumeroTicket, Ventas.VentaMontoTicket, Ventas.VentaFotoTicket, Ventas.VentaFechaRegistro, VentasAuditorias.VentaAuditoriaEstatusId, VentasAuditorias.VentaAuditoriaObservacionId, VentasAuditorias.VentaAuditoriaFechaRegistro, VentasAuditoriasEstatus.VentaAuditoriaEstatusDescripcion, VentasAuditoriasObservaciones.VentaAuditoriaObservacionDescripcion, DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleNombreComercial, DistribuidoresDetalles.DistribuidorDetalleCodigo, Usuarios.PerfilId, Perfiles.PerfilDescripcion, CONCAT(UsuariosDetalles.UsuarioDetalleNombre,' ',UsuariosDetalles.UsuarioDetalleSegundoNombre,' ',UsuariosDetalles.UsuarioDetalleApellidos)AS nombrepax FROM Ventas LEFT JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId LEFT JOIN VentasAuditoriasEstatus ON VentasAuditorias.VentaAuditoriaEstatusId = VentasAuditoriasEstatus.VentaAuditoriaEstatusId LEFT JOIN VentasAuditoriasObservaciones ON VentasAuditorias.VentaAuditoriaObservacionId = VentasAuditoriasObservaciones.VentaAuditoriaObservacionId INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorDetalleId = DistribuidoresDetalles.DistribuidorDetalleId INNER JOIN Distribuidores ON DistribuidoresDetalles.DistribuidorId = Distribuidores.DistribuidorId INNER JOIN UsuariosDetalles ON Ventas.UsuarioDetalleId = UsuariosDetalles.UsuarioDetalleId INNER JOIN Usuarios ON UsuariosDetalles.UsuarioId = Usuarios.UsuarioId INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId 
                WHERE (VentaFechaBaja IS NULL) AND (VentaAuditoriaEntra = 1 or VentaAuditoriaRandom = 1) AND (VentaAuditoriaFechaBaja IS NULL) AND Ventas.VentaId = ".$VentaId;
        $query	= $this->db->query($SQL);
//        echo $this->db->last_query();
        return $query->row();
    }

    public function ventas_auditoria_primera_model_detalle_ventas($VentaId){
        $SQL    = "    SELECT        VentasDetalles.VentaDetalleId, VentasDetalles.VentaId, VentasDetalles.UsuarioIdCapturo, VentasDetalles.VentaDetalleMonto, VentasDetalles.VentaDetalleCantidad, VentasDetalles.VentaDetalleLitros, VentasDetalles.ProductoMarcaId, VentasDetalles.VentaDetalleFechaRegistro, VentasDetalles.VentaDetalleFechaBaja, ProductosMarcas.ProductoMarcaDescripcion, ProductosClases.ProductoClaseDescripcion FROM VentasDetalles INNER JOIN ProductosMarcas ON VentasDetalles.ProductoMarcaId = ProductosMarcas.ProductoMarcaId INNER JOIN ProductosClases ON ProductosMarcas.ProductoClaseId = ProductosClases.ProductoClaseId 
                WHERE (VentasDetalles.VentaDetalleFechaBaja IS NULL) AND (VentasDetalles.VentaId = $VentaId) "; 
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function ventas_auditoria_primera_model_promociones($VentaId){
        $SQL    = "SELECT Ventas.VentaId, VentasPromociones.VentaPromocionNombre, VentasPromocionesDetalles.VentaPromocionDetallePresentacion, VentasPromocionesDetalles.VentaPromocionDetalleGMC, VentasPromocionesDetalles.VentaPromocionDetalleCodigo, VentasPromocionesDetalles.VentaPromocionDetalleDescripcion, VentasUsuariosPromociones.VentaUsuarioPromocionCantidad FROM VentasUsuariosPromociones INNER JOIN Ventas ON VentasUsuariosPromociones.VentaId = Ventas.VentaId INNER JOIN VentasPromocionesDetalles INNER JOIN VentasPromociones ON VentasPromocionesDetalles.VentaPromocionId = VentasPromociones.VentaPromocionId ON VentasUsuariosPromociones.VentaPromocionDetalleId = VentasPromocionesDetalles.VentaPromocionDetalleId
                WHERE (Ventas.VentaFechaBaja IS NULL) AND (VentasPromocionesDetalles.VentaPromocionDetalleFechaBaja IS NULL) AND (Ventas.VentaId = $VentaId) ";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_auditoria_primera_model_observaciones(){
        $SQL = "SELECT VentaAuditoriaObservacionId,VentaAuditoriaObservacionDescripcion FROM VentasAuditoriasObservaciones";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result(); 
    }
    public function ventas_auditoria_primera_model_status_aprobado($status,$idVenta,$usuario){
        $SQL    = "INSERT INTO VentasAuditorias (VentaId,UsuarioIdCapturo,VentaAuditoriaEstatusId,VentaAuditoriaTipoId,VentaAuditoriaEstatusOportunidadId,VentaAuditoriaFechaAudito,VentaAuditoriaUsuarioAudito) VALUES ($idVenta,$usuario,$status,1,1,GETDATE(),$usuario)";
        $this->db->query($SQL);
        return 1;
    }
    public function ventas_auditoria_primera_model_status_rechazado($status,$idVenta,$usuario,$Observacion){
        $SQL    = "INSERT INTO VentasAuditorias (VentaId,UsuarioIdCapturo,VentaAuditoriaEstatusId,VentaAuditoriaObservacionId,VentaAuditoriaTipoId,VentaAuditoriaEstatusOportunidadId,VentaAuditoriaFechaAudito,VentaAuditoriaUsuarioAudito) VALUES ($idVenta,$usuario,$status,$Observacion,1,1,GETDATE(),$usuario)";
        $this->db->query($SQL);
        return 1;
    } 
    public function ventas_auditoria_primera_model_observacion_descripcion($VentaAuditoriaObservacionId){
        $SQL = "SELECT VentaAuditoriaObservacionId,VentaAuditoriaObservacionDescripcion FROM VentasAuditoriasObservaciones WHERE VentaAuditoriaObservacionId = $VentaAuditoriaObservacionId";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return utf8_encode(strtoupper($query->row()->VentaAuditoriaObservacionDescripcion)); 
    }
    public function ventas_auditoria_primera_model_auditorias_random($anio,$mes){
        /*********************************************** TOTAL DE VENTAS **********************************************/
        $query_total                            = $this->db->query("SELECT COUNT(VentaId) as total FROM Ventas WHERE VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro)= ? AND MONTH(VentaFechaRegistro) = ?",array($anio,$mes)); 
        //echo  $this->db->last_query()."<br>"; 
        $data["ventas_total"]                   = $query_total->row()->total;
        /*********************************************** TOTAL DE AUDITORIAS ******************************************/
        $query_total_auditorias                 = $this->db->query("SELECT COUNT(Ventas.VentaId) AS total FROM Ventas WHERE (Ventas.VentaFechaBaja IS NULL) AND (YEAR(Ventas.VentaFechaRegistro) = ?) AND (MONTH(Ventas.VentaFechaRegistro) = ?) AND (VentaAuditoriaEntra=1 OR VentaAuditoriaRandom=1)",array($anio,$mes));
        //echo  $this->db->last_query()."<br>"; 
        $data["ventas_total_auditorias"]        = $query_total_auditorias->row()->total; 
        /*********************************************** PORCENTAJES *************************************************/
        $data["porcentaje"]                     = intval($data["ventas_total"] * .2);
        $data["auditorias_random_faltantes"]    = $data["porcentaje"] - $data["ventas_total_auditorias"];
        return $data;
    }
    public function ventas_auditoria_primera_model_genera_randoms($NumRandom,$Anio,$Mes){
        $this->db->query(" UPDATE Ventas SET VentaAuditoriaRandom = 1 WHERE VentaId IN (SELECT TOP $NumRandom VentaId FROM Ventas WHERE (VentaFechaBaja IS NULL) AND (YEAR(VentaFechaRegistro) = $Anio) AND (MONTH(VentaFechaRegistro) = $Mes) AND (VentaAuditoriaEntra=0 AND VentaAuditoriaRandom=0) ORDER BY NEWID())");
        return 1;
    }
}