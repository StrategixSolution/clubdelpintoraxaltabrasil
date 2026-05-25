<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_distribuidores_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }  

    public function reportes_distribuidores_model_cmbanios(){
     $SQL = "SELECT YEAR(DistribuidorFechaAlta) AS anio FROM Distribuidores GROUP BY YEAR(DistribuidorFechaAlta) ORDER BY YEAR(DistribuidorFechaAlta) ASC";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function reportes_distribuidores_model_cmbmes($anio){
        $SQL = "SELECT MONTH(DistribuidorFechaAlta) AS mes FROM Distribuidores WHERE YEAR(DistribuidorFechaAlta) = $anio GROUP BY MONTH(DistribuidorFechaAlta) ORDER BY MONTH(DistribuidorFechaAlta) ASC";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function reportes_distribuidores_model_combo_distribuidor($perfil_id){
        $usuario_id = $this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        
        // Perfiles 1,2,3: Administradores (todos los distribuidores)
        if (in_array($perfil_id, [1, 2, 3])) {
            $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial ,DistribuidoresDetalles.DistribuidorDetalleNombreComercial
                    FROM Distribuidores 
                    INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL";
        } 
        // Perfiles 4 o 5: Regionales/Ejecutivos (solo sus distribuidores)
        else {
            $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial ,DistribuidoresDetalles.DistribuidorDetalleNombreComercial
                    FROM UsuariosDistribuidores 
                    INNER JOIN Usuarios ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId 
                    INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId 
                    WHERE Usuarios.PerfilId = $perfil_id 
                    AND Distribuidores.DistribuidorFechaBaja IS NULL 
                    AND DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL 
                    AND Usuarios.UsuarioId = $usuario_id";
        }
        
        $query = $this->db->query($SQL);
        return $query->result();
    }   
    public function reportes_distribuidores_model_usuario_ditribuidor() {
        $SQL = "SELECT DistribuidorId FROM UsuariosDistribuidores WHERE  (UsuariosDistribuidores.UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }    
    public function reportes_distribuidores_model_crea_tabla($where){
        $SQL = "SELECT   distinct Paises.PaisNombre,Divisiones.DivisionNombre,Distribuidores.DistribuidorId,DistribuidoresDetalles.DistribuidorDetalleId, Distribuidores.DistribuidorFechaBaja, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleCP, 
                         DistribuidoresDetalles.DistribuidorDetalleNombreComercial, DistribuidoresDetalles.DistribuidorDetalleEstado, DistribuidoresDetalles.DistribuidorDetalleCiudad, DistribuidoresDetalles.DistribuidorDetalleMunicipio, 
                         DistribuidoresDetalles.DistribuidorDetalleCalle, 
                         DistribuidoresDetallesRegiones.DistribuidorDetalleRegionNombre
                FROM            Distribuidores LEFT JOIN
                         DistribuidoresActivos ON Distribuidores.DistribuidorId = DistribuidoresActivos.DistribuidorId INNER JOIN
                         DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN
                         DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId 
                         INNER JOIN Paises ON Paises.PaisId = Distribuidores.PaisId
                         INNER JOIN Divisiones ON Divisiones.DivisionId = Distribuidores.DivisionId 
                         WHERE   (0=0)". $where;
        $query	= $this->db->query($SQL);
       // echo $this->db->last_query();
        return $query->result();
    }
    public function reportes_distribuidores_model_crea_tabla_inactivos($where1="",$where2=""){
        $SQL = "SELECT   distinct Paises.PaisNombre,Divisiones.DivisionNombre,Distribuidores.DistribuidorId,DistribuidoresDetalles.DistribuidorDetalleId, Distribuidores.DistribuidorFechaBaja, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial, DistribuidoresDetalles.DistribuidorDetalleCP, 
                         DistribuidoresDetalles.DistribuidorDetalleNombreComercial, DistribuidoresDetalles.DistribuidorDetalleEstado, DistribuidoresDetalles.DistribuidorDetalleCiudad, DistribuidoresDetalles.DistribuidorDetalleMunicipio, 
                         DistribuidoresDetalles.DistribuidorDetalleCalle, 
                         DistribuidoresDetallesRegiones.DistribuidorDetalleRegionNombre
                FROM            Distribuidores LEFT JOIN
                         DistribuidoresActivos ON Distribuidores.DistribuidorId = DistribuidoresActivos.DistribuidorId INNER JOIN
                         DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId INNER JOIN
                         DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId 
                         INNER JOIN Paises ON Paises.PaisId = Distribuidores.PaisId
                         INNER JOIN Divisiones ON Divisiones.DivisionId = Distribuidores.DivisionId 
                         WHERE   (0=0)".$where1." ".$where2;
        $query	= $this->db->query($SQL);
//        echo $this->db->last_query();
        return $query->result();
    }
    public function reportes_distribuidores_model_distribuidor_activo($iddist,$año=0,$mes=0){
        $SQL = "SELECT count(DistribuidorId) AS ACTIVOS FROM DistribuidoresActivos WHERE DistribuidorActivoAnio = $año AND DistribuidorActivoMes = $mes and DistribuidorId = $iddist";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->ACTIVOS;           
    }
    public function reportes_distribuidores_model_distribuidores_activos($año,$mes){
        $SQL = "SELECT DistribuidorId FROM DistribuidoresActivos WHERE DistribuidorActivoAnio = $año AND DistribuidorActivoMes = $mes ";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->result();           
    }
    public function reportes_distribuidores_model_ejecutivo($iddist){	
        $SQL = "SELECT        UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidoPaterno, UsuariosDetalles.UsuarioDetalleApellidoMaterno
                FROM            Usuarios INNER JOIN
                         UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId INNER JOIN
                         UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId
                WHERE PerfilId = 7 AND UsuarioFechaBajaParticipante IS NULL AND UsuarioFechaBajaDistribuidora IS NULL AND UsuariosDistribuidores.DistribuidorId = $iddist";     
        $query	= $this->db->query($SQL);
        if ($query->num_rows() > 0){
            $ejecutivo = $query->row()->UsuarioDetalleNombre . " " . $query->row()->UsuarioDetalleSegundoNombre . " " . $query->row()->UsuarioDetalleApellidoPaterno . " " . $query->row()->UsuarioDetalleApellidoMaterno;
            return $ejecutivo;
        } else {
            return "SIN EJECUTIVO";
        }  
    }
    public function reportes_distribuidores_model_ventas ($iddist) {
        $SQL ="SELECT       count(distinct Ventas.VentaId) as totalticket,SUM( Ventas.VentaMontoTicket) AS totalmonto FROM Ventas INNER JOIN VentasDetalles ON Ventas.VentaId = VentasDetalles.VentaId LEFT JOIN
                         VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId WHERE DistribuidorDetalleId = $iddist AND VentaFechaBaja IS NULL AND VentaAuditoriaEstatusId = 1";
        $query	= $this->db->query($SQL);
        return $query->row();
    }
    public function reportes_distribuidores_model_total_maestros_pintor ($iddist) {
        $SQL ="SELECT        count(Usuarios.PerfilId) as totmaestros FROM Usuarios INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId
                WHERE PerfilId = 10 AND UsuarioFechaBajaParticipante IS NULL AND UsuariosDistribuidores.DistribuidorId =  $iddist";
        $query	= $this->db->query($SQL);
        return $query->row();
    }
}
