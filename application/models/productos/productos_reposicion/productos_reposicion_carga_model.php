<?php

/* 
 * Sistema Web Responsivo CDPBR
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 15 May. 2026 16:47:56 * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_reposicion_carga_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function productos_reposicion_carga_model_insert($cargaId){
        $sql= "INSERT INTO ReposicionesProductosPremiosProductos (ReposicionProductoPremioProductoDescripcion,ReposicionProductoPremioProductoGMS,ReposicionProductoPremioProductoCodigo,ReposicionProductoPremioProductoPresentacion,ReposicionProductoPremioProductoPrecio,ReposicionProductoPremioProductoUsuarioIdRegistro) SELECT CargaPremioProductoDescripcion, CargaPremioProductoGMS, CargaPremioProductoCodigo, CargaPremioProductoPresentacion, CargaPremioProductoPrecio,CargaPremioProductoUsuarioIdRegistro FROM CargasPremiosProductos where CargaId = $cargaId";
        $this->db->query($sql);
        return 1;
    }
}