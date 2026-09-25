<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_reposicion_descarga_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function productos_reposicion_descarga_model_fotos_anio(){
        $SQL = "SELECT  distinct      ReposicionProductoFotoAnio FROM ReposicionesProductosFotos";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function productos_reposicion_descarga_model_fotos_mes($cmb_anio){
        $SQL = "SELECT  distinct     ReposicionProductoFotoMes FROM ReposicionesProductosFotos where  ReposicionProductoFotoAnio = $cmb_anio";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function productos_reposicion_descarga_model_fotos(){
        $SQL = "SELECT ReposicionProductoFotoModificada FROM ReposicionesProductosFotos";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function productos_reposicion_descarga_model_fotos_tipos(){
        $SQL = "SELECT ReposicionProductoFotoTipoId, ReposicionProductoFotoTipoDescripcion FROM ReposicionesProductosFotosTipos";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function productos_reposicion_descarga_model_distribuidoras_tienda($cmb_anio,$cmb_mes){
    $meses = $cmb_mes - 1 .",".$cmb_mes;
        $SQL    = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleNombreComercial 
        FROM Distribuidores 
        INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId
        INNER JOIN ReposicionesProductosFotos ON Distribuidores.DistribuidorId = ReposicionesProductosFotos.DistribuidorId 
        INNER JOIN UsuariosDistribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId 
        INNER JOIN Usuarios ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId      
        WHERE (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) 
        AND (Usuarios.PerfilId in (6,7,8)) 
        AND (ReposicionesProductosFotos.DistribuidorId = " . $this->session->userdata(funciones_strategix_sitio_alias('s_distribuidor_id')) . ") 
        AND (Usuarios.UsuarioFechaBajaParticipante IS NULL)
        AND (Distribuidores.DistribuidorFechaBaja IS NULL) 
        and ReposicionesProductosFotos.ReposicionProductoFotoMes in ($meses) 
        and ReposicionesProductosFotos.ReposicionProductoFotoAnio = $cmb_anio
        group by Distribuidores.DistribuidorId,DistribuidoresDetalles.DistribuidorDetalleCodigo,DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function productos_reposicion_descarga_model_distribuidoras($cmb_anio,$cmb_mes){
        $meses = $cmb_mes - 1 .",".$cmb_mes;
        $SQL    = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleNombreComercial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId
                    INNER JOIN ReposicionesProductosFotos ON Distribuidores.DistribuidorId = ReposicionesProductosFotos.DistribuidorId 
                    WHERE (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Distribuidores.DistribuidorFechaBaja IS NULL) and ReposicionesProductosFotos.ReposicionProductoFotoMes in ($meses) and ReposicionesProductosFotos.ReposicionProductoFotoAnio = $cmb_anio
                    group by Distribuidores.DistribuidorId,DistribuidoresDetalles.DistribuidorDetalleCodigo,DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function productos_reposicion_descarga_model_datos_descarga($where){
        $SQL = "SELECT ReposicionesProductosFotos.ReposicionProductoFotoModificada, ReposicionesProductosFotos.DistribuidorId, ReposicionesProductosFotos.ReposicionProductoFotoMes FROM ReposicionesProductosFotos WHERE 0=0 $where";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
}