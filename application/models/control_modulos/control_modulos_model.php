<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Control_modulos_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
    public function control_modulos_model_datos(){
        $SQL = "SELECT ControlModuloId, ControlModuloNombre, ControlModuloEstatus FROM ControlModulos";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
}
