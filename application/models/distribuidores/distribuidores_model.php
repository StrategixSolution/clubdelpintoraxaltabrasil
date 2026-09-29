<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distribuidores_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function distribuidores_model_combo_distribuidor_administradores($where){
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL $where";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function distribuidores_model_combo_distribuidor_regionales($where){
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM UsuariosDistribuidores INNER JOIN Usuarios ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId WHERE (Usuarios.PerfilId in (4)) AND (Distribuidores.DistribuidorFechaBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Usuarios.UsuarioId = " . $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')) . ") $where";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function distribuidores_model_combo_distribuidor_ejecutrivos($where){
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial  FROM UsuariosDistribuidores INNER JOIN Usuarios ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId WHERE (Usuarios.PerfilId in (5)) AND (Distribuidores.DistribuidorFechaBaja IS NULL) AND (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) AND (Usuarios.UsuarioId = " . $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')) . ") $where";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }   
  /*  public function distribuidores_model_combo_distribuidores($where){
        $SQL    = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId "
                . "WHERE (DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL) $where ";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>";
        return $query->result();
    }*/
    public function distribuidores_model_tabla($where){
        $SQL    = "SELECT 
                    Distribuidores.DistribuidorId, 
                    DistribuidoresDetalles.DistribuidorDetalleCodigo, 
                    DistribuidoresDetalles.DistribuidorDetalleRegionId,
                    DistribuidoresDetallesRegiones.DistribuidorDetalleRegionNombre,
                    DistribuidoresDetalles.DistribuidorDetalleOficinasVentasId,
                    DistribuidoresDetallesOficinasVentas.DistribuidoresDetallesOficinasVentasNombre,
                    DistribuidoresDetalles.DistribuidorDetalleAgrupamientosId,
                    DistribuidoresDetallesAgrupamientos.DistribuidoresDetallesAgrupamientosNombre,
                    DistribuidoresDetalles.DistribuidorDetalleRazonSocial, 
                    DistribuidoresDetalles.DistribuidorDetalleNombreComercial,
                    DistribuidoresDetalles.DistribuidorDetalleUnidadFederativa,
                    UnidadFederativas.UnidadFederativaDescripcion,
                    DistribuidoresDetalles.DistribuidorDetalleCiudad, 
                    DistribuidoresDetalles.DistribuidorDetalleBarrio,
                    DistribuidoresDetalles.DistribuidorDetalleDireccion, 
                    DistribuidoresDetalles.DistribuidorDetalleCEP, 
                    DistribuidoresDetalles.DistribuidorDetalleTelefono,
                    DistribuidoresDetalles.DistribuidorDetalleRegistroFederal, 
                    DistribuidoresDetalles.DistribuidorDetalleInscripcionEstatal,
                    DistribuidoresDetalles.DistribuidorDetalleFechaAlta,
                    DistribuidoresDetalles.DistribuidorDetalleFechaActivacion,
                    Distribuidores.DistribuidorFechaBaja
                    FROM Distribuidores 
                    INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    INNER JOIN DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId 
                    INNER JOIN DistribuidoresDetallesOficinasVentas ON DistribuidoresDetallesOficinasVentas.DistribuidoresDetallesOficinasVentasId = DistribuidoresDetalles.DistribuidorDetalleOficinasVentasId
                    INNER JOIN DistribuidoresDetallesAgrupamientos ON DistribuidoresDetallesAgrupamientos.DistribuidoresDetallesAgrupamientosId = DistribuidoresDetalles.DistribuidorDetalleAgrupamientosId
                    INNER JOIN UnidadFederativas ON UnidadFederativas.UnidadFederativaId = DistribuidoresDetalles.DistribuidorDetalleUnidadFederativa
                    WHERE 0=0 $where";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function distribuidores_model_baja($distribuidorid) {
        $DistribuidorId_clean = $this->security->xss_clean($distribuidorid); 
        $SQL = "UPDATE Distribuidores set DistribuidorFechaBaja = DATEADD(hour, 3, GETDATE()),DistribuidorUsuarioIdBaja = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." where DistribuidorId = $DistribuidorId_clean";
        $this->db->query($SQL);
        $SQL2 = "UPDATE u set u.UsuarioFechaBajaDistribuidora = DATEADD(hour, 3, GETDATE()),u.UsuarioBajaDistribuidoraUsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'))." FROM Usuarios u INNER JOIN UsuariosDistribuidores ud ON u.UsuarioId = ud.UsuarioId where u.PerfilId in (7,8,9) AND ud.DistribuidorId = $DistribuidorId_clean";
        $this->db->query($SQL2);        
//        echo  $this->db->last_query()."<br>";
        return 1;    
    }
    public function distribuidores_model_usuario_ditribuidor() {
        $SQL = "SELECT DistribuidorId FROM UsuariosDistribuidores WHERE  (UsuariosDistribuidores.UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    } 

   
}
