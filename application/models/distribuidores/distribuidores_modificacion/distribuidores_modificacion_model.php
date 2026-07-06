<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Enrique Arce Rosas                          * 
 * @CreateDate 01 Jun. 2024 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Distribuidores_modificacion_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    } 
    public function distribuidores_modificacion_model_row($DistribuidorId){
        $SQL    = "SELECT Distribuidores.DistribuidorId, Distribuidores.PaisId, Distribuidores.DivisionId, DistribuidoresDetalles.DistribuidorDetalleId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleNombreComercial, DistribuidoresDetalles.DistribuidorDetalleCP, DistribuidoresDetalles.DistribuidorDetalleEstado, DistribuidoresDetalles.DistribuidorDetalleCiudad, DistribuidoresDetalles.DistribuidorDetalleMunicipio, DistribuidoresDetalles.DistribuidorDetalleCalle, DistribuidoresDetalles.DistribuidorDetalleRFC, DistribuidoresDetalles.DistribuidorDetalleTelefono, DistribuidoresDetalles.DistribuidorDetalleRegionId, DistribuidoresDetalles.DistribuidorDetalleFechaBaja, DistribuidoresDetallesRegiones.DistribuidorDetalleRegionNombre, Divisiones.DivisionNombre, Paises.PaisNombre FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId INNER JOIN Divisiones ON Distribuidores.DivisionId = Divisiones.DivisionId INNER JOIN Paises ON Distribuidores.PaisId = Paises.PaisId 
                   WHERE  (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Distribuidores.DistribuidorId = $DistribuidorId)";
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