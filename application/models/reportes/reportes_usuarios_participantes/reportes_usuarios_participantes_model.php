<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reportes_usuarios_participantes_model extends Base_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function reportes_usuarios_participantes_model_combo_distribuidor($where)    {
        $SQL = "SELECT Distribuidores.DistribuidorId, DistribuidoresDetalles.DistribuidorDetalleCodigo, DistribuidoresDetalles.DistribuidorDetalleRazonSocial FROM Distribuidores INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL $where";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function reportes_usuarios_participantes_model_tabla($where = "")    {
        $SQL = "SELECT 
                UsuariosDetalles.UsuarioDetalleId, 
                Usuarios.UsuarioId, 
                Usuarios.UsuarioFechaRegistro, 
                Usuarios.PerfilId, 
                UsuariosDetalles.UsuarioDetalleNombre, 
                DistribuidoresDetalles.DistribuidorId, 
                UsuariosDetalles.UsuarioDetalleEmail, 
                UsuariosDetalles.UsuarioDetalleCelular, 
                UsuariosDetalles.UsuarioDetalleRFC, 
                DistribuidoresDetalles.DistribuidorDetalleCodigo,
                DistribuidoresDetalles.DistribuidorDetalleRazonSocial,
                DistribuidoresDetalles.DistribuidorDetalleNombreComercial,
                DistribuidoresDetalles.DistribuidorDetalleRegistroFederal,
                DistribuidoresDetalles.DistribuidorDetalleInscripcionEstatal,
                Perfiles.PerfilDescripcion, 
                Usuarios.UsuarioFechaBajaParticipante,
                Usuarios.UsuarioFechaBajaDistribuidora 
                FROM Usuarios
                INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId 
                INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId 
                INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId 
                WHERE (UsuarioDetalleFechaBaja IS NULL) 
                AND (DistribuidorDetalleFechaBaja IS NULL) 
                AND (Usuarios.PerfilId IN(4,5,6,7,8,9)) $where ";
        $query = $this->db->query($SQL);
        //  echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
}
