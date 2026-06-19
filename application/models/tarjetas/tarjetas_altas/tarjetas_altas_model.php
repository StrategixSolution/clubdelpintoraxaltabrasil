<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarjetas_altas_model extends Base_Model
{
    public function __construct(){
        parent::__construct();
    }   
    public function distribuidores_alta_model_combo_distribuidores() {
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleNombreComercial, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Distribuidores.DistribuidorFechaBaja IS NULL) ";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function distribuidores_alta_model_usuario_comercio($UsuarioId) {
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT DistribuidorId FROM UsuariosDistribuidores WHERE  (UsuariosDistribuidores.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
       echo  $this->db->last_query()."<br>"; 
        return $query->row();    
    }    
    public function tarjetas_altas_model_crea_tabla($where){
        $SQL = "SELECT Tarjetas.TarjetaId, Tarjetas.TarjetaNumero, Tarjetas.DistribuidorId, FORMAT(Tarjetas.TarjetaFechaRegistro, 'dd/MM/yyyy') AS TarjetaFechaRegistro, Tarjetas.TarjetaEstatusId, TarjetasEstatus.TarjetaEstatusDescripcion, 
                Tarjetas.TarjetaUsuarioIdCaptura, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidos, 
                UsuariosDetalles.UsuarioId,  DistribuidoresDetalles.DistribuidorDetalleNombreComercial,DistribuidoresDetalles.DistribuidorDetalleRazonSocial
                FROM Tarjetas LEFT OUTER JOIN
                Usuarios ON Usuarios.UsuarioId = Tarjetas.UsuarioId LEFT OUTER JOIN
                UsuariosDetalles ON UsuariosDetalles.UsuarioId = Usuarios.UsuarioId LEFT OUTER JOIN
                DistribuidoresDetalles ON DistribuidoresDetalles.DistribuidorId = Tarjetas.DistribuidorId INNER JOIN
                TarjetasEstatus ON TarjetasEstatus.TarjetaEstatusId = Tarjetas.TarjetaEstatusId 
                WHERE (UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL)  $where";
        $query    = $this->db->query($SQL);
            //    echo $this->db->last_query();
        return $query->result();
    }
    public function tarjetas_altas_model_crea_tarjetas($values){
        $SQL = "INSERT INTO Tarjetas (TarjetaNumero, DistribuidorId, TarjetaUsuarioIdCaptura, TarjetaEstatusId,TarjetasTipoId) VALUES ($values)";
        $this->db->query($SQL);
        $SQL2  = "SELECT MAX(TarjetaId) as TarjetaId FROM Tarjetas";
        $query2    = $this->db->query($SQL2);
        //   echo  $this->db->last_query()."<br>"; 
        return $query2->row();
    }
}
