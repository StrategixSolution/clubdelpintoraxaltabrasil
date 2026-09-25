<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribuidores_alta_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
           public function distribuidores_alta_model_combo_regiones(){
        $SQL    = "SELECT DistribuidorDetalleRegionId,DistribuidorDetalleRegionNombre FROM DistribuidoresDetallesRegiones";
        $query	= $this->db->query($SQL);
        return $query->result();
    }    

          public function distribuidores_alta_model_combo_agrupamientos(){
        $SQL    = "SELECT DistribuidoresDetallesAgrupamientosId,DistribuidoresDetallesAgrupamientosCodigo,DistribuidoresDetallesAgrupamientosNombre FROM DistribuidoresDetallesAgrupamientos";
        $query	= $this->db->query($SQL);
        return $query->result();
    } 

     public function distribuidores_alta_model_combo_oficinas_venta(){
        $SQL    = "SELECT DistribuidoresDetallesOficinasVentasId,DistribuidoresDetallesOficinasVentasCodigo,DistribuidoresDetallesOficinasVentasNombre FROM DistribuidoresDetallesOficinasVentas";
        $query	= $this->db->query($SQL);
        return $query->result();
    } 

         public function distribuidores_alta_model_combo_unidad_federativa(){
        $SQL    = "SELECT UnidadFederativaId,UnidadFederativaDescripcion FROM UnidadFederativas";
        $query	= $this->db->query($SQL);
        return $query->result();
    } 
    public function distribuidores_alta_model_insert_distribuidor($dataHead,$dataDetalle){
        $SQL1    = "INSERT INTO Distribuidores (DistribuidorUsuarioIdCapturo,DistribuidorSessionId) VALUES ($dataHead)"; $this->db->query($SQL1); $query  = $this->db->query("SELECT IDENT_CURRENT('Distribuidores') as last_id"); $res = $query->result(); $id = $res[0]->last_id;      
        $SQL2    = "INSERT INTO DistribuidoresDetalles (DistribuidorId,DistribuidorDetalleRazonSocial,DistribuidorDetalleNombreComercial,DistribuidorDetalleCodigo,DistribuidorDetalleAgrupamientosId,DistribuidorDetalleRegistroFederal,DistribuidorDetalleInscripcionEstatal,DistribuidorDetalleUnidadFederativa,DistribuidorDetalleCiudad,DistribuidorDetalleBarrio,DistribuidorDetalleDireccion,DistribuidorDetalleCEP,DistribuidorDetalleTelefono,DistribuidorDetalleRegionId,DistribuidorDetalleOficinasVentasId,DistribuidorDetalleUsuarioIdCapturo) VALUES ($id,$dataDetalle)";
        $this->db->query($SQL2);
        return $id;
    }
}