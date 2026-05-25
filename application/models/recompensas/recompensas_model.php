<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recompensas_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
    
    public function recompensas_model_carga_excel($cargaId){
        $sql= "INSERT INTO Recompensas (RecompensaAnio,RecompensaMes,RecompensaPremioLugar,RecompensaRangoInicial,RecompensaRangoFinal,RecompensaUsuarioIdRegistro,RecompensaTipoId) SELECT CargaRecompensaAnio, CargaRecompensaMes, CargaRecompensaPremioLugar, CargaRecompensaRangoInicial, CargaRecompensaRangoFinal,CargaRecompensaUsuarioIdRegistro,2 FROM CargasRecompensas where CargaId = $cargaId";
        $this->db->query($sql);        
        return 1;
    }
    public function recompensas_model_carga_simple($valores){
        $sql= "INSERT INTO Recompensas (RecompensaAnio,RecompensaMes,RecompensaPremioLugar,RecompensaRangoInicial,RecompensaRangoFinal,RecompensaUsuarioIdRegistro,RecompensaTipoId) values ($valores)";
        $this->db->query($sql);
        return 1;
    }
    public function recompensas_model_repetidos($anio,$mes,$lugar){
        $sql= "SELECT COUNT(RecompensaId) AS total FROM Recompensas WHERE RecompensaAnio = '".$anio."' AND RecompensaMes = '".$mes."' AND RecompensaPremioLugar = ".$lugar;
        $query = $this->db->query($sql);
        return $query->row()->total;
    }
    public function recompensas_model_carga_ReposicionesProductosPremios($cargaId){
        $sql1= "INSERT INTO ReposicionesProductosPremios (ReposicionProductoPremioAnio,ReposicionProductoPremioMes,ReposicionProductoPremioLugar,ReposicionProductoPremioUsuarioIdRegistro,ProductoDivisionId) SELECT CargaRecompensaAnio, CargaRecompensaMes, CargaRecompensaPremioLugar, CargaRecompensaUsuarioIdRegistro,1 FROM CargasRecompensas where CargaId = $cargaId";
        $sql2= "INSERT INTO ReposicionesProductosPremios (ReposicionProductoPremioAnio,ReposicionProductoPremioMes,ReposicionProductoPremioLugar,ReposicionProductoPremioUsuarioIdRegistro,ProductoDivisionId) SELECT CargaRecompensaAnio, CargaRecompensaMes, CargaRecompensaPremioLugar, CargaRecompensaUsuarioIdRegistro,2 FROM CargasRecompensas where CargaId = $cargaId";
        $this->db->query($sql1);
        $this->db->query($sql2);
        return 1;
    }
    public function recompensas_model_carga_ReposicionesProductosPremios_simple($valores){
        $sql1= "INSERT INTO ReposicionesProductosPremios (ReposicionProductoPremioAnio,ReposicionProductoPremioMes,ReposicionProductoPremioLugar,ReposicionProductoPremioUsuarioIdRegistro,ProductoDivisionId) values ($valores,1)";
        $sql2= "INSERT INTO ReposicionesProductosPremios (ReposicionProductoPremioAnio,ReposicionProductoPremioMes,ReposicionProductoPremioLugar,ReposicionProductoPremioUsuarioIdRegistro,ProductoDivisionId) values ($valores,2)";
        $this->db->query($sql1);
        $this->db->query($sql2);
        return 1;
    }
}