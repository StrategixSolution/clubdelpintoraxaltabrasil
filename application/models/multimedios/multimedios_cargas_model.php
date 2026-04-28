<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Multimedios_cargas_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function multimedios_cargas_model_combo_modulos(){
        $SQL    = "SELECT CargaMultimediaModuloId,CargaMultimediaModuloDescripcion FROM CargasMultimediasModulos";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function multimedios_cargas_model_combo_tipos($where){
        $SQL    = "SELECT CargaMultimediaTipoId,CargaMultimediaTipoDescripcion FROM CargasMultimediasTipos $where";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function multimedios_cargas_model_combo_noticia_tipos(){
        $SQL    = "SELECT CargaMultimediaNoticiasTipoId,CargaMultimediaNoticiasTipoDescripcion FROM CargasMultimediasNoticiasTipos";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function multimedios_cargas_model_combo_division(){
        $SQL    = "SELECT DivisionId, DivisionNombre FROM Divisiones WHERE DivisionFechaBaja IS NULL";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function multimedios_cargas_model_lista_paises($where){
        $SQL    = "SELECT DISTINCT Paises.PaisId,Paises.PaisCodigo,Paises.PaisNombre,Paises.PaisFechaRegistro,Paises.PaisFechaBaja FROM Paises inner join Usuarios on paises.PaisId= Usuarios.PaisId where PaisFechaBaja IS NULL $where";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }    
    public function multimedios_cargas_model_lista_perfiles(){
        $SQL    = "SELECT PerfilId ,PerfilDescripcion FROM Perfiles";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function multimedios_cargas_model_combo_tipos_videos(){
        $SQL    = "SELECT CargaMultimediaVideoTipoId,CargaMultimediaVideoTipoDescripcion FROM CargasMultimediasVideosTipos";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }    
    public function multimedios_cargas_model_multimedios($CargaMultimediaModuloId){
        $SQL    = "SELECT CargasMultimedias.CargaMultimediaModuloId, CargasMultimedias.CargaMultimediaId, CargasMultimedias.CargaMultimediaRuta, CargasMultimedias.CargaMultimediaExtension, CargasMultimedias.CargaMultimediaTipoId, CargasMultimedias.CargaMultimediaThumbnail, CargasMultimedias.CargaMultimediaFechaInicial, CargasMultimedias.CargaMultimediaFechaFinal, CargasMultimedias.CargaMultimediaFechaRegistro, CargasMultimedias.CargaMultimediaUsuarioId, CargasMultimedias.CargaMultimediaFechaBaja, CargasMultimedias.CargaMultimediaDownload, CargasMultimedias.CargaMultimediaModuloId, CargasMultimedias.CargaMultimediaVideoTipoId, CargasMultimediasTipos.CargaMultimediaTipoDescripcion, CargasMultimediasModulos.CargaMultimediaModuloDescripcion, CargasMultimediasVideosTipos.CargaMultimediaVideoTipoDescripcion,(select cm.CargaMultimediaTexto from CargasMultimedias cm where cm.CargaMultimediaId = CargasMultimedias.CargaMultimediaId) as htmltext
                FROM CargasMultimedias 
                INNER JOIN CargasMultimediasPerfiles ON CargasMultimedias.CargaMultimediaId = CargasMultimediasPerfiles.CargaMultimediaId INNER JOIN CargasMultimediasTipos ON CargasMultimedias.CargaMultimediaTipoId = CargasMultimediasTipos.CargaMultimediaTipoId INNER JOIN CargasMultimediasModulos ON CargasMultimedias.CargaMultimediaModuloId = CargasMultimediasModulos.CargaMultimediaModuloId LEFT OUTER JOIN CargasMultimediasVideosTipos ON CargasMultimedias.CargaMultimediaVideoTipoId = CargasMultimediasVideosTipos.CargaMultimediaVideoTipoId
                WHERE CargasMultimedias.CargaMultimediaModuloId = $CargaMultimediaModuloId
                GROUP BY CargasMultimedias.CargaMultimediaId, CargasMultimedias.CargaMultimediaRuta, CargasMultimedias.CargaMultimediaExtension, CargasMultimedias.CargaMultimediaTipoId, CargasMultimedias.CargaMultimediaThumbnail, CargasMultimedias.CargaMultimediaFechaInicial, CargasMultimedias.CargaMultimediaFechaFinal, CargasMultimedias.CargaMultimediaFechaRegistro, CargasMultimedias.CargaMultimediaUsuarioId, CargasMultimedias.CargaMultimediaFechaBaja, CargasMultimedias.CargaMultimediaDownload, CargasMultimedias.CargaMultimediaModuloId, CargasMultimedias.CargaMultimediaVideoTipoId, CargasMultimediasTipos.CargaMultimediaTipoDescripcion, CargasMultimediasModulos.CargaMultimediaModuloDescripcion, CargasMultimediasVideosTipos.CargaMultimediaVideoTipoDescripcion
                ";
        $query	= $this->db->query($SQL);
       // echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function multimedios_cargas_model_insert_datos($data) {
        $clave_data = trim($this->security->xss_clean($data)); 
        $SQL = "INSERT INTO CargasMultimedias (CargaMultimediaRuta,CargaMultimediaExtension,CargaMultimediaThumbnail,CargaMultimediaTexto,CargaMultimediaTipoId,CargaMultimediaModuloId,CargaMultimediaVideoTipoId,CargaMultimediaFechaInicial,CargaMultimediaFechaFinal,CargaMultimediaDownload,CargaMultimediaNoticiasTipoId,CargaMultimediaUsuarioId) VALUES ($clave_data,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";                
        $this->db->query($SQL); 
      // echo  $this->db->last_query()."<br>"; 
        $res  = $this->db->query("SELECT IDENT_CURRENT('CargasMultimedias') as last_id")->result(); 
        $id = $res[0]->last_id;                     
        return $id;
    }
    public function multimedios_cargas_model_insert_perfiles($CargaMultimediaId,$PerfilId) {
        $SQL = "INSERT INTO CargasMultimediasPerfiles (CargaMultimediaId,PerfilId) VALUES ($CargaMultimediaId,$PerfilId)";                
        $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return 1;
    }    
    public function multimedios_cargas_model_baja_datos($id) {
        $SQL = "UPDATE CargasMultimedias SET CargaMultimediaFechaBaja = GETDATE() WHERE CargaMultimediaId = ".$id;
        $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return 1;
    }
    public function multimedios_cargas_model_perfiles($CargaMultimediaId){
        $SQL    = "SELECT Perfiles.PerfilDescripcion FROM Perfiles
                    INNER JOIN CargasMultimediasPerfiles ON CargasMultimediasPerfiles.PerfilId = Perfiles.PerfilId
                    WHERE CargasMultimediasPerfiles.CargaMultimediaId =$CargaMultimediaId";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }  
    public function multimedios_actualiza_estatus(){
        $SQL    = "SELECT CargaMultimediaId,CargaMultimediaModuloId,CargaMultimediaFechaFinal from CargasMultimedias
        where CargaMultimediaFechaBaja is null";
        $query	= $this->db->query($SQL);
       // echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
}