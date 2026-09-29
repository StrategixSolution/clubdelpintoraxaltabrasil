<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ventas_cortes_auditoria_ventas_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function ventas_cortes_auditoria_ventas_model_combo_anio(){
        $SQL = "SELECT DISTINCT YEAR(VentaFechaRegistro) AS anio FROM Ventas ORDER BY YEAR(VentaFechaRegistro) ASC";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function ventas_cortes_auditoria_ventas_model_combo_mes($anio){
        $SQL = "SELECT DISTINCT MONTH(VentaFechaRegistro) AS mes FROM Ventas WHERE YEAR(VentaFechaRegistro) = '$anio' ORDER BY MONTH(VentaFechaRegistro) ASC";
        $query	= $this->db->query($SQL);
        return $query->result();
    }      
    public function ventas_cortes_auditoria_ventas_model_valida_auditoria($anio,$mes){
        $xss_clean_anio = $this->security->xss_clean($anio);
        $xss_clean_mes = $this->security->xss_clean($mes);
        $SQL    = "SELECT COUNT(Ventas.VentaId) AS tot FROM Ventas LEFT OUTER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId
                   WHERE (YEAR(Ventas.VentaFechaRegistro) = ?) AND (MONTH(Ventas.VentaFechaRegistro) = ?) AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) AND (VentasAuditorias.VentaAuditoriaId IS NULL) AND (Ventas.VentaFechaBaja IS NULL)";
        $query	= $this->db->query($SQL, array($xss_clean_anio,$xss_clean_mes));
        return $query->row()->tot;
    }
    public function ventas_cortes_auditoria_ventas_model_crea_auditorias($anio,$mes,$CorteId){
        $SQL = "INSERT INTO VentasAuditorias (VentaId,UsuarioIdCapturo,VentaAuditoriaEstatusId,VentaAuditoriaTipoId,VentaAuditoriaFechaAudito,VentaAuditoriaUsuarioAudito,CorteId,VentaAuditoriaEstatusOportunidadId)
                SELECT Ventas.VentaId,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",2,4,DATEADD(hour, 3, GETDATE()),".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",$CorteId,1 FROM Ventas LEFT OUTER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId WHERE  (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) AND 
                (VentasAuditorias.VentaAuditoriaId IS NULL) AND (Ventas.VentaFechaBaja IS NULL) AND  (YEAR(Ventas.VentaFechaRegistro) = $anio) AND (MONTH(Ventas.VentaFechaRegistro) = $mes)                 
                ";
        $query	= $this->db->query($SQL);
        return 1;
    }         
}