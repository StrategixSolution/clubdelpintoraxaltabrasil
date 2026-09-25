<?php
class ventas_cortes_apertura_cierre_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }

    public function ventas_cortes_apertura_cierre_model_estatus(){
        $SQL = "SELECT ControlModuloEstatus FROM ControlModulos WHERE ControlModuloId = 1";
        $query	= $this->db->query($SQL);
        return $query->row()->ControlModuloEstatus;
    }
    public function ventas_cortes_apertura_cierre_model_cambio_estatus($updatetipo) {
        $SQL = "UPDATE ControlModulos SET ControlModuloEstatus = ".$updatetipo." WHERE ControlModuloId = 1";
        $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return 1;
    }
}