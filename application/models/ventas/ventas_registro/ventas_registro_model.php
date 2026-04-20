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

    public function ventas_registro_model_cmb_distribuidor($UsuarioId){
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial, DistribuidoresDetalles.DistribuidorId FROM UsuariosDistribuidores INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE  (UsuariosDistribuidores.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
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
    public function ventas_registro_model_maestro_pintor_informacion($numero_tarjeta){
        $numero_tarjeta_clean = $this->security->xss_clean($numero_tarjeta);
        $SQL    = "SELECT Usuarios.UsuarioId, UsuariosDetalles.UsuarioDetalleId, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidos, Tarjetas.TarjetaNumero, UsuariosDetalles.UsuarioDetalleEmail,UsuariosDetalles.UsuarioDetalleCelular, UsuariosDetalles.UsuarioDetalleRFC,Tarjetas.TarjetaId FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN Tarjetas ON Usuarios.UsuarioId = Tarjetas.UsuarioId WHERE (Usuarios.UsuarioFechaBajaParticipante IS NULL) AND (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) AND (Tarjetas.TarjetaFechaBaja IS NULL) AND (Tarjetas.TarjetaEstatusId = 2) AND (Tarjetas.TarjetaNumero = ?)";
        $query	= $this->db->query($SQL, array($numero_tarjeta_clean));
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
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
    public function ventas_registro_model_guardar_venta($numero_tarjeta,$numero_ticket,$monto_ticket,$imagen,$session_id,$maestro_pintor,$DistribuidorId){
        $numero_tarjeta_clean = $this->security->xss_clean($numero_tarjeta);
        $numero_ticket_clean = $this->security->xss_clean($numero_ticket);
        $monto_ticket_clean = $this->security->xss_clean($monto_ticket);
        $ditribuidor = $this->ventas_registro_model_datos_distribuidor($DistribuidorId);   
        $nombre_maestro_pintor = strtoupper($maestro_pintor->UsuarioDetalleNombre) ." ". strtoupper($maestro_pintor->UsuarioDetalleSegundoNombre)." ". strtoupper($maestro_pintor->UsuarioDetalleApellidos);
        $SQL    = "INSERT INTO Ventas (TarjetaId,TarjetaNumero,VentaUsuarioIdMP,VentaUsuarioNombreMP,DistribuidorId,DistribuidorDetalleId,DistribuidorDetalleCodigo,DistribuidorDetalleRazonSocial,DistribuidorDetalleNombreComercial,UsuarioDetalleId,VentaNumeroTicket,VentaMontoTicket,VentaFotoTicket,VentaUsuarioIdRegistro,VentaUsuarioNombreRegistro,VentaSessionId) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $this->db->query($SQL, array($maestro_pintor->TarjetaId,$numero_tarjeta_clean,$maestro_pintor->UsuarioId,$nombre_maestro_pintor,$ditribuidor->DistribuidorId,$ditribuidor->DistribuidorDetalleId,$ditribuidor->DistribuidorDetalleCodigo,$ditribuidor->DistribuidorDetalleRazonSocial,$ditribuidor->DistribuidorDetalleNombreComercial,$maestro_pintor->UsuarioDetalleId,$numero_ticket_clean,$monto_ticket_clean,$imagen,$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')),strtoupper(utf8_decode($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_nombre')))),$session_id));
//        echo  $this->db->last_query()."<br>"; 
        $query  = $this->db->query("SELECT IDENT_CURRENT('Ventas') as last_id"); $res = $query->result(); $id = $res[0]->last_id;
        return $id;
    }
   public function ventas_registro_model_datos_distribuidor($DistribuidorId){
        $SQL    = "SELECT DISTINCT DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorId,DistribuidoresDetalles.DistribuidorDetalleCodigo,DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial FROM UsuariosDistribuidores INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL AND UsuariosDistribuidores.DistribuidorId = ? ";
        $query	= $this->db->query($SQL, array($DistribuidorId));
        //echo  $this->db->last_query()."<br>"; 
        return $query->row();
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
   /* public function ventas_registro_model_distribuidor_activo($distriubidor,$año,$mes){
        $SQL = "SELECT count(DistribuidorId) AS ACTIVOS FROM DistribuidoresActivos WHERE DistribuidorActivoAnio = $año AND DistribuidorActivoMes = $mes AND DistribuidorId = $distriubidor";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->ACTIVOS;           
    }*/
     public function ventas_registro_model_ventas_totales($distriubidor,$año,$mes){
        $SQL = "SELECT count(VentaId) AS total FROM Ventas WHERE DistribuidorDetalleId = $distriubidor AND VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro) = $año AND MONTH(VentaFechaRegistro) = $mes ";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->total;           
    }
    /* public function ventas_registro_model_ventas_insert_distribuidor_activo($data) {
        $SQL    = "INSERT INTO DistribuidoresActivos (DistribuidorId,DistribuidorActivoAnio,DistribuidorActivoMes,DistribuidorActivoNoVentas) VALUES ($data)";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
    } */
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

    public function ventas_registro_model_auditorias_calculos(){
        $veinte_porciento                       = .2;
        $ochenta_porciento                      = .8;
        /*********************************************** TOTAL DE VENTAS **********************************************/
        $query_total                            = $this->db->query("SELECT COUNT(VentaId) as total FROM Ventas WHERE VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro)= ".funciones_strategix_anio()." AND MONTH(VentaFechaRegistro) = ".funciones_strategix_mes()); 
        //echo  $this->db->last_query()."<br>"; 
        $data["ventas_total"]                   = $query_total->row()->total;
        /*********************************************** TOTAL DE AUDITORIAS REPETIDAS POR MONTO **********************/
        $query_total_monto_repetido             = $this->db->query("SELECT COUNT(Ventas.VentaId) AS total FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (VentasAuditorias.VentaAuditoriaTipoId = 1) AND (YEAR(Ventas.VentaFechaRegistro) = ".funciones_strategix_anio().") AND (MONTH(Ventas.VentaFechaRegistro) = ".funciones_strategix_mes().")"); 
        //echo  $this->db->last_query()."<br>"; 
        $data["ventas_total_monto_repetido"]    = $query_total_monto_repetido->row()->total;
        /*********************************************** TOTAL DE AUDITORIAS CANTIDAD MAXIMA **************************/
        $query_total_cantidad_maxima            = $this->db->query("SELECT COUNT(Ventas.VentaId) AS total FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (VentasAuditorias.VentaAuditoriaTipoId = 2) AND (YEAR(Ventas.VentaFechaRegistro) = ".funciones_strategix_anio().") AND (MONTH(Ventas.VentaFechaRegistro) = ".funciones_strategix_mes().")"); 
        //echo  $this->db->last_query()."<br>"; 
        $data["ventas_total_cantidad_maxima"]   = $query_total_cantidad_maxima->row()->total;
        /*********************************************** TOTAL DE AUDITORIAS ******************************************/
        $query_total_auditorias                 = $this->db->query("SELECT COUNT(Ventas.VentaId) AS total FROM Ventas INNER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaEstatusOportunidadId = 1) AND (YEAR(Ventas.VentaFechaRegistro) = ".funciones_strategix_anio().") AND (MONTH(Ventas.VentaFechaRegistro) = ".funciones_strategix_mes().")"); 
        //echo  $this->db->last_query()."<br>"; 
        $data["ventas_total_auditorias"]        = $query_total_auditorias->row()->total;
        /*********************************************** PORCENTAJES *************************************************/
        $data["porcentaje"]                     = $data["ventas_total"] * $veinte_porciento;
        $data["porcentaje_monto_repetido"]      = $data["porcentaje"] * $veinte_porciento;
        $data["porcentaje_monto_maximo"]        = $data["porcentaje"] * $ochenta_porciento;
        return $data;
    }

     public function ventas_registro_model_crea_auditorias($VentaId,$VentaAuditoriaTipoId){
        $SQL    = "INSERT INTO VentasAuditorias (VentaId,UsuarioIdCapturo,VentaAuditoriaEstatusId,VentaAuditoriaTipoId,VentaAuditoriaEstatusOportunidadId) VALUES (?,?,1,?,1)";
        $this->db->query($SQL, array($VentaId,$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')),$VentaAuditoriaTipoId));
//        echo  $this->db->last_query()."<br>"; 
        $query  = $this->db->query("SELECT IDENT_CURRENT('VentasAuditorias') as last_id"); $res = $query->result(); $id = $res[0]->last_id;      
        return $id;
    }

    public function ventas_registro_model_venta_monto_repetido($DistribuidorId,$VentaUsuarioIdMP,$VentaMontoTicket,$VentaId){
        $DistribuidorId_clean = $this->security->xss_clean($DistribuidorId);
        $VentaUsuarioIdMP_clean = $this->security->xss_clean($VentaUsuarioIdMP);
        $monto_ticket_clean = $this->security->xss_clean($VentaMontoTicket);
        $SQL    = "SELECT COUNT(VentaId) as total FROM Ventas WHERE VentaId <> $VentaId AND VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro)= ".funciones_strategix_anio()." AND MONTH(VentaFechaRegistro) = ".funciones_strategix_mes()." AND DistribuidorDetalleId = $DistribuidorId_clean AND UsuarioDetalleId = $VentaUsuarioIdMP_clean AND VentaMontoTicket = $monto_ticket_clean";
        $query	= $this->db->query($SQL);
        return $query->row()->total;
    }

}