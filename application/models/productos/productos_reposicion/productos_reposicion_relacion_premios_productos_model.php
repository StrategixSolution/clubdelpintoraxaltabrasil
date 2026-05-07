<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 May 2026 09:00:00                         * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_reposicion_relacion_premios_productos_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function productos_reposicion_relacion_premios_productos_model_combo_sectores(){
        $SQL    = "SELECT ProductoDivisionId,ProductoDivisionNombre FROM ProductosDivisiones";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function productos_reposicion_relacion_premios_productos_model_combo_anio($cmb_sector){
        $SQL    = "SELECT DISTINCT ReposicionProductoPremioAnio FROM ReposicionesProductosPremios where ProductoDivisionId = ".$cmb_sector;
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function productos_reposicion_relacion_premios_productos_model_combo_mes($cmb_sector,$cmb_anio){
        $SQL    = "SELECT DISTINCT ReposicionProductoPremioMes FROM ReposicionesProductosPremios where ProductoDivisionId = $cmb_sector AND ReposicionProductoPremioAnio = $cmb_anio";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function productos_reposicion_relacion_premios_productos_model_combo_lugar($cmb_sector,$cmb_anio,$cmb_mes){
        $SQL    = "SELECT DISTINCT ReposicionProductoPremioLugar,ReposicionProductoPremioId FROM ReposicionesProductosPremios where ProductoDivisionId = $cmb_sector AND ReposicionProductoPremioAnio = $cmb_anio AND ReposicionProductoPremioMes = $cmb_mes";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function productos_reposicion_relacion_premios_productos_model_lista_productos_seleccionar($cmb_lugar){
        $SQL    = "SELECT ReposicionProductoPremioProductoId, ReposicionProductoPremioProductoDescripcion, ReposicionProductoPremioProductoGMS, ReposicionProductoPremioProductoPresentacion FROM ReposicionesProductosPremiosProductos WHERE (ReposicionProductoPremioProductoFechaBaja IS NULL)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function productos_reposicion_relacion_premios_productos_model_lista_productos_seleccionados($cmb_lugar){
        $SQL    = "SELECT ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioProductoId, ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoDescripcion,ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoGMS, ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoCodigo,ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoPresentacion FROM ReposicionesProductosPremiosProductosRelaciones INNER JOIN ReposicionesProductosPremiosProductos ON ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioProductoId = ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoId WHERE (ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioProductoRelacionFechaBaja IS NULL)  AND (ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioId = $cmb_lugar)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }    
    public function productos_reposicion_relacion_premios_productos_model_update($cmb_lugar) {
        $SQL    = "UPDATE ReposicionesProductosPremiosProductosRelaciones SET ReposicionProductoPremioProductoRelacionFechaBaja =  GETDATE(),ReposicionProductoPremioProductoRelacionUsuarioIdBaja = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." WHERE ReposicionProductoPremioId = $cmb_lugar";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return 1;
    }
    public function productos_reposicion_relacion_premios_productos_model_insert($data) {
        $sql= "INSERT INTO ReposicionesProductosPremiosProductosRelaciones (ReposicionProductoPremioId,ReposicionProductoPremioProductoId,ReposicionProductoPremioProductoRelacionNumero,ReposicionProductoPremioProductoRelacionUsuarioIdRegistro) VALUES ($data,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";
        $this->db->query($sql);
        return 1;
    }
}