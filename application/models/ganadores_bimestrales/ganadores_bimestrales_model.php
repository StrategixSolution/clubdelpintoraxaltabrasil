<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ganadores_bimestrales_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }  
    public function ganadores_bimestrales_model_cmbanios(){
        $SQL = "SELECT DISTINCT ReposicionProductoGanadorAnio AS anio FROM ReposicionesProductosGanadores ORDER BY ReposicionProductoGanadorAnio";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function ganadores_bimestrales_model_cmbmes($anio){
        $SQL = "SELECT DISTINCT ReposicionProductoGanadorMes AS mes FROM ReposicionesProductosGanadores WHERE ReposicionProductoGanadorAnio = $anio ORDER BY ReposicionProductoGanadorMes";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function ganadores_bimestrales_model_combo_distribuidor_administradores($where){
        $SQL    = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL $where";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ganadores_bimestrales_model_usuario_ditribuidor() {
        $SQL = "SELECT DistribuidorId FROM UsuariosDistribuidores WHERE  (UsuariosDistribuidores.UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }    
    public function ganadores_bimestrales_model_crea_tabla($where=""){
        $SQL = "SELECT 
UsuariosDetalles.UsuarioId, 
UsuariosDetalles.UsuarioDetalleNombre AS nombrepax,
DistribuidoresDetalles.DistribuidorId,
DistribuidoresDetalles.DistribuidorDetalleCodigo, 
DistribuidoresDetalles.DistribuidorDetalleRazonSocial, 
DistribuidoresDetalles.DistribuidorDetalleNombreComercial, 
DistribuidoresDetalles.DistribuidorDetalleCiudad, 
UnidadFederativas.UnidadFederativaDescripcion as DistribuidorDetalleEstado, 
ReposicionesProductosGanadores.ReposicionProductoGanadorPremioLugar, 
ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoDescripcion AS ReposicionProductoPremioProductoDescripcion 
FROM ReposicionesProductosGanadores 
INNER JOIN UsuariosDetalles ON ReposicionesProductosGanadores.UsuarioId = UsuariosDetalles.UsuarioId 
INNER JOIN DistribuidoresDetalles ON ReposicionesProductosGanadores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
INNER JOIN UnidadFederativas ON UnidadFederativas.UnidadFederativaId = DistribuidoresDetalles.DistribuidorDetalleUnidadFederativa
LEFT JOIN ReposicionesProductosPremios ON ReposicionesProductosGanadores.ReposicionProductoGanadorTotalProductoPremio = ReposicionesProductosPremios.ReposicionProductoPremioId 
LEFT JOIN ReposicionesProductosPremiosProductosRelaciones ON ReposicionesProductosPremios.ReposicionProductoPremioId = ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioId 
LEFT JOIN ReposicionesProductosPremiosProductos ON ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioProductoId = ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoId 
         WHERE (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) ". $where;
        $query	= $this->db->query($SQL);
      //  echo $this->db->last_query();
        return $query->result();
    }
    public function ganadores_bimestrales_model_descripcion_producto($lugar,$anio,$mes){
           $SQL = "SELECT        ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoDescripcion 
        FROM ReposicionesProductosPremios 
        INNER JOIN ReposicionesProductosPremiosProductosRelaciones ON ReposicionesProductosPremios.ReposicionProductoPremioId = ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioId 
        INNER JOIN ReposicionesProductosPremiosProductos ON ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioProductoId = ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoId						 
        WHERE ReposicionProductoPremioLugar = $lugar 
        AND ReposicionProductoPremioAnio = $anio 
        AND ReposicionProductoPremioMes = $mes";
         
        $query	= $this->db->query($SQL);
      //  echo $this->db->last_query();
        if(isset($query->row()->ReposicionProductoPremioProductoDescripcion)){
            return $query->row()->ReposicionProductoPremioProductoDescripcion;
        }else{ return '-----';}
    }
    public function ganadores_bimestrales_model_ejecutivo($iddist){	
        $SQL = "SELECT        UsuariosDetalles.UsuarioDetalleNombre  FROM            Usuarios INNER JOIN                         UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN                         UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId                WHERE PerfilId = 7 AND UsuarioFechaBajaParticipante IS NULL AND UsuarioFechaBajaDistribuidora IS NULL AND UsuariosDistribuidores.DistribuidorId = $iddist";     
        $query	= $this->db->query($SQL);
        if ($query->num_rows() > 0){
            $ejecutivo = $query->row()->UsuarioDetalleNombre;
            return $ejecutivo; } else {        return "SIN EJECUTIVO";     }  
        }
    public function ganadores_bimestrales_model_distribuidora($where){	
        $SQL = "SELECT DISTINCT             DistribuidoresDetalles.DistribuidorId  FROM ReposicionesProductosGanadores INNER JOIN UsuariosDetalles ON ReposicionesProductosGanadores.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN DistribuidoresDetalles ON ReposicionesProductosGanadores.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId LEFT JOIN ReposicionesProductosPremios ON ReposicionesProductosGanadores.ReposicionProductoGanadorTotalProductoPremio = ReposicionesProductosPremios.ReposicionProductoPremioId  LEFT JOIN ReposicionesProductosPremiosProductosRelaciones ON ReposicionesProductosPremios.ReposicionProductoPremioId = ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioId LEFT JOIN ReposicionesProductosPremiosProductos ON ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioProductoId = ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoId WHERE (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL) ". $where;  
        $query	= $this->db->query($SQL);
      // echo $this->db->last_query();
        return $query->result();
    }
    public function ganadores_bimestrales_model_nombre_dist($DistribuidoraId)    {
        $SQL = "SELECT DistribuidorDetalleRazonSocial FROM DistribuidoresDetalles WHERE DistribuidorId = $DistribuidoraId AND DistribuidorDetalleFechaBaja IS NULL";
        $query    = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
    public function ganadores_bimestrales_model_datoscorreo($DistribuidoraId)    {
        $SQL = "SELECT DISTINCT UsuariosDetalles.UsuarioDetalleEmail  FROM UsuariosDetalles        INNER JOIN Usuarios ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId         WHERE UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL         AND Usuarios.UsuarioFechaBajaParticipante IS NULL         AND UsuariosDetalles.UsuarioDetalleEmail IS NOT NULL         AND UsuariosDetalles.UsuarioDetalleEmail LIKE '%@%'        AND UsuariosDetalles.UsuarioDetalleEmail NOT LIKE '%@sincorreo%'        AND Usuarios.PerfilId IN(7,8,9,10)        AND Usuarios.UsuarioId IN(select UsuarioId from UsuariosDistribuidores where DistribuidorId= $DistribuidoraId )";
        $query    = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
}