<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Distribuidores_modificacion_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    } 
    public function distribuidores_modificacion_model_row($DistribuidorId){
        $SQL    = "SELECT 
            Distribuidores.DistribuidorId, 
            DistribuidoresDetalles.DistribuidorDetalleId, 
            DistribuidoresDetalles.DistribuidorDetalleCodigo, 
            DistribuidoresDetalles.DistribuidorDetalleRazonSocial, 
            DistribuidoresDetalles.DistribuidorDetalleNombreComercial, 
            DistribuidoresDetalles.DistribuidorDetalleCEP, 
            DistribuidoresDetalles.DistribuidorDetalleUnidadFederativa , 
            UnidadFederativas.UnidadFederativaDescripcion,
            DistribuidoresDetalles.DistribuidorDetalleCiudad, 
            DistribuidoresDetalles.DistribuidorDetalleBarrio, 
            DistribuidoresDetalles.DistribuidorDetalleDireccion, 
            DistribuidoresDetalles.DistribuidorDetalleRegistroFederal, 
            DistribuidoresDetalles.DistribuidorDetalleInscripcionEstatal, 
            DistribuidoresDetalles.DistribuidorDetalleTelefono, 
            DistribuidoresDetalles.DistribuidorDetalleRegionId, 
            DistribuidoresDetalles.DistribuidorDetalleFechaBaja, 
            DistribuidoresDetallesRegiones.DistribuidorDetalleRegionNombre ,
            DistribuidoresDetalles.DistribuidorDetalleAgrupamientosId,
            DistribuidoresDetallesAgrupamientos.DistribuidoresDetallesAgrupamientosNombre,
            DistribuidoresDetalles.DistribuidorDetalleOficinasVentasId,
            DistribuidoresDetallesOficinasVentas.DistribuidoresDetallesOficinasVentasNombre
            FROM Distribuidores 
            INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
            LEFT JOIN DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId 
            LEFT JOIN DistribuidoresDetallesOficinasVentas  ON DistribuidoresDetalles.DistribuidorDetalleOficinasVentasId = DistribuidoresDetallesOficinasVentas.DistribuidoresDetallesOficinasVentasId 
            LEFT JOIN DistribuidoresDetallesAgrupamientos ON DistribuidoresDetalles.DistribuidorDetalleAgrupamientosId = DistribuidoresDetallesAgrupamientos.DistribuidoresDetallesAgrupamientosId 
            LEFT JOIN UnidadFederativas ON DistribuidoresDetalles.DistribuidorDetalleUnidadFederativa = UnidadFederativas.UnidadFederativaId 
            WHERE  (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL)  AND (Distribuidores.DistribuidorId = $DistribuidorId)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row_array();  
    }
    public function distribuidores_modificacion_model_combo_regiones(){
        $SQL    = "SELECT DistribuidorDetalleRegionId,DistribuidorDetalleRegionNombre FROM DistribuidoresDetallesRegiones";
        $query	= $this->db->query($SQL);
        return $query->result();
    }       
    public function distribuidores_modificacion_model_update_distribuidor($where,$dataDetalle){
        $SQL    = "UPDATE DistribuidoresDetalles SET $dataDetalle WHERE $where";      
        $this->db->query($SQL);
        return 1;
    }    
}