<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mail_promocion_bimestral_model extends Base_Model{
    public function __construct()    {
        parent::__construct();
    }
    public function mail_promocion_bimestral_model_cmbanios()    {
        $SQL = "SELECT DATEPART(YY,GETDATE())-1 as anio UNION ALL SELECT DATEPART(YY,GETDATE()) as anio ORDER BY anio ASC";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function mail_promocion_bimestral_model_cmbmes($anio)    {
        $SQL = "SELECT DATEPART(mm,GETDATE())-1 as mes UNION ALL SELECT DATEPART(mm,GETDATE()) as mes ORDER BY mes ASC";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    public function mail_promocion_bimestral_model_crea_tabla()    {
        $SQL = "SELECT        MailsPromocionesBimestrales.mailsPromocionesBimestralesPerfiles,   MailsPromocionesBimestrales.mailsPromocionesBimestralesAnio ,        MailsPromocionesBimestrales.mailsPromocionesBimestralesMes ,        MailsPromocionesBimestrales.mailsPromocionesBimestralesArchivo ,        MailsPromocionesBimestrales.mailsPromocionesBimestralesFechaRegistro         
        FROM MailsPromocionesBimestrales        
        WHERE MailsPromocionesBimestrales.mailsPromocionesBimestralesFechaBaja IS NULL";
        $query = $this->db->query($SQL);
        //echo $this->db->last_query();
        return $query->result();
    }
    public function mail_promocion_bimestral_model_inserta_datos($cmbAnio, $cmbMes, $nombreArachivo, $idUsuario,$perfiles)    {
        $SQL = "INSERT INTO MailsPromocionesBimestrales            (mailsPromocionesBimestralesAnio, mailsPromocionesBimestralesMes, mailsPromocionesBimestralesArchivo, mailsPromocionesBimestralesUsuarioIdCaptura, mailsPromocionesBimestralesFechaRegistro,mailsPromocionesBimestralesPerfiles)            VALUES($cmbAnio, $cmbMes, '$nombreArachivo',$idUsuario,DATEADD(hour, 3, GETDATE()), '$perfiles')";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return 1;
    }
    public function mail_promocion_bimestral_model_count($cmbAnio, $cmbMes,$perfiles)    {
        $SQL = "SELECT mailsPromocionesBimestralesId from MailsPromocionesBimestrales WHERE mailsPromocionesBimestralesAnio =$cmbAnio AND mailsPromocionesBimestralesMes = $cmbMes AND mailsPromocionesBimestralesPerfiles LIKE '%$perfiles%' AND mailsPromocionesBimestralesFechaBaja IS NULL";
        $query = $this->db->query($SQL);
        //       echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
    public function mail_promocion_bimestral_model_datos_correo($perfiles)    {
        $SQL = "SELECT DISTINCT UsuariosDetalles.UsuarioDetalleEmail 
        FROM Usuarios 
        INNER JOIN UsuariosDetalles ON UsuariosDetalles.UsuarioId = Usuarios.UsuarioId  
        INNER JOIN UsuariosDistribuidores ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId 
        INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = UsuariosDistribuidores.DistribuidorId
        WHERE Usuarios.UsuarioFechaBajaParticipante IS NULL  
        AND UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL 
        AND UsuariosDetalles.UsuarioDetalleEmail IS NOT NULL 
        AND UsuariosDetalles.UsuarioDetalleEmail LIKE '%@%' 
        AND UsuariosDetalles.UsuarioDetalleEmail NOT LIKE '%@sincorreo%' 
        AND Usuarios.PerfilId IN ($perfiles)";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function mail_promocion_bimestral_model_check_perfil(){
        $SQL    = "SELECT PerfilId, PerfilDescripcion FROM Perfiles where PerfilId IN (5,6,7,8) order by PerfilDescripcion";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function mail_promocion_bimestral_model_perfil_nombre($mailsPromocionesBimestralesPerfiles){
        $SQL    = "SELECT PerfilDescripcion from perfiles where PerfilId in($mailsPromocionesBimestralesPerfiles)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }  

}