<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutoriales_externos_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
    public function tutoriales_externos_model_datos(){     
        $SQL = "SELECT 
                CargasMultimedias.CargaMultimediaId, 
                CargasMultimedias.CargaMultimediaRuta, 
                CargasMultimedias.CargaMultimediaExtension, 
                CargasMultimedias.CargaMultimediaTipoId, 
                CargasMultimedias.CargaMultimediaThumbnail, 
                CargasMultimedias.CargaMultimediaFechaInicial, 
                CargasMultimedias.CargaMultimediaFechaFinal,
                CargasMultimedias.CargaMultimediaDownload,
                (select cm.CargaMultimediaTexto from CargasMultimedias cm where cm.CargaMultimediaId = CargasMultimedias.CargaMultimediaId) as htmltext 
                FROM CargasMultimedias 
                INNER JOIN CargasMultimediasPerfiles ON CargasMultimedias.CargaMultimediaId = CargasMultimediasPerfiles.CargaMultimediaId 
                WHERE (CargasMultimedias.CargaMultimediaFechaBaja IS NULL) 
                AND (CargasMultimedias.CargaMultimediaModuloId = 3) 
                AND (CargasMultimediasPerfiles.PerfilId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')).")  
                AND (CargasMultimedias.CargaMultimediaVideoTipoId IN (1,3)) 
                GROUP BY CargasMultimedias.CargaMultimediaId, 
                CargasMultimedias.CargaMultimediaRuta, 
                CargasMultimedias.CargaMultimediaExtension, 
                CargasMultimedias.CargaMultimediaTipoId, 
                CargasMultimedias.CargaMultimediaThumbnail, 
                CargasMultimedias.CargaMultimediaFechaInicial, 
                CargasMultimedias.CargaMultimediaFechaFinal,
                CargasMultimedias.CargaMultimediaDownload,
                CargasMultimedias.CargaMultimediaFechaRegistro
                ORDER BY CargasMultimedias.CargaMultimediaFechaRegistro desc";                        
        $query	= $this->db->query($SQL);
        return $query->result();
    }
}
