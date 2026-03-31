<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Latam      *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer Luis Felipe Rangel                          * 
 * @CreateDate 01 Mar. 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Tarjetas_model extends Base_Model
{
    public function __construct(){
        parent::__construct();
    }
    public function tarjetas_model_estatus(){
        $SQL    = "SELECT TarjetaEstatusId,TarjetaEstatusDescripcion FROM TarjetasEstatus";
        $query    = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function tarjetas_model_lista($where){
        $SQL    = "SELECT Tarjetas.TarjetaId, Tarjetas.TarjetaNumero, Tarjetas.DistribuidorId, Tarjetas.UsuarioId, Tarjetas.TarjetaEstatusId, Tarjetas.TarjetaFechaRegistro, Tarjetas.TarjetaUsuarioIdCaptura, Tarjetas.TarjetaFechaBaja, Tarjetas.TarjetaUsuarioIdBaja, Tarjetas.TarjetaFechaAsigno, Tarjetas.TarjetaUsuarioIdAsigno,  TarjetasEstatus.TarjetaEstatusDescripcion, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleFechaBaja, UsuariosDetalles.UsuarioDetalleFechaBaja, UsuariosDetalles.UsuarioDetalleNombre,UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidos
        FROM Tarjetas 
        INNER JOIN TarjetasEstatus ON Tarjetas.TarjetaEstatusId = TarjetasEstatus.TarjetaEstatusId 
        LEFT OUTER JOIN DistribuidoresDetalles ON Tarjetas.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
        LEFT OUTER JOIN UsuariosDetalles ON Tarjetas.UsuarioId = UsuariosDetalles.UsuarioId 
        WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL AND UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL $where";
        $query    = $this->db->query($SQL);
          //      echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function tarjetas_model_baja($TarjetaId) {
        $TarjetaId_clean = $this->security->xss_clean($TarjetaId); 
        $SQL = "UPDATE Tarjetas set TarjetaFechaBaja = GETDATE(),TarjetaUsuarioIdBaja = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." where TarjetaId = $TarjetaId_clean";
        $this->db->query($SQL);     
//        echo  $this->db->last_query()."<br>";
        return 1;    
    }    
    public function tarjetas_model_usuario_ditribuidor() {
        $SQL = "SELECT DistribuidorId FROM UsuariosDistribuidores WHERE  (UsuariosDistribuidores.UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    } 
}