<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class noticias_circulares_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
    public function promocion_actual_model_datos(){        
        $SQL = "SELECT 
CargasMultimedias.CargaMultimediaId, 
CargasMultimedias.CargaMultimediaRuta, 
CargasMultimedias.CargaMultimediaExtension, 
CargasMultimedias.CargaMultimediaTipoId, 
CargasMultimedias.CargaMultimediaThumbnail, 
CargasMultimedias.CargaMultimediaFechaInicial, 
CargasMultimedias.CargaMultimediaFechaFinal,
CargasMultimedias.CargaMultimediaDownload
FROM CargasMultimedias 
INNER JOIN CargasMultimediasPerfiles ON CargasMultimedias.CargaMultimediaId = CargasMultimediasPerfiles.CargaMultimediaId 
WHERE (CargasMultimedias.CargaMultimediaFechaBaja IS NULL) 
AND (CargasMultimedias.CargaMultimediaModuloId = 2) 
AND (CargasMultimedias.CargaMultimediaNoticiasTipoId = 1) 
AND (CargasMultimediasPerfiles.PerfilId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')).")  
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
    public function promocion_anterior_model_datos(){        
        $SQL = "SELECT 
CargasMultimedias.CargaMultimediaId, 
CargasMultimedias.CargaMultimediaRuta, 
CargasMultimedias.CargaMultimediaExtension, 
CargasMultimedias.CargaMultimediaTipoId, 
CargasMultimedias.CargaMultimediaThumbnail, 
CargasMultimedias.CargaMultimediaFechaInicial, 
CargasMultimedias.CargaMultimediaFechaFinal,
CargasMultimedias.CargaMultimediaDownload
FROM CargasMultimedias 
INNER JOIN CargasMultimediasPerfiles ON CargasMultimedias.CargaMultimediaId = CargasMultimediasPerfiles.CargaMultimediaId 
WHERE (CargasMultimedias.CargaMultimediaFechaBaja IS NULL) 
AND (CargasMultimedias.CargaMultimediaModuloId = 2) 
AND (CargasMultimedias.CargaMultimediaNoticiasTipoId = 2) 
AND (CargasMultimediasPerfiles.PerfilId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')).")  
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
     public function ganadores_model_datos(){        
        $SQL = "SELECT 
CargasMultimedias.CargaMultimediaId, 
CargasMultimedias.CargaMultimediaRuta, 
CargasMultimedias.CargaMultimediaExtension, 
CargasMultimedias.CargaMultimediaTipoId, 
CargasMultimedias.CargaMultimediaThumbnail, 
CargasMultimedias.CargaMultimediaFechaInicial, 
CargasMultimedias.CargaMultimediaFechaFinal,
CargasMultimedias.CargaMultimediaDownload
FROM CargasMultimedias 
INNER JOIN CargasMultimediasPerfiles ON CargasMultimedias.CargaMultimediaId = CargasMultimediasPerfiles.CargaMultimediaId 
WHERE (CargasMultimedias.CargaMultimediaFechaBaja IS NULL) 
AND (CargasMultimedias.CargaMultimediaModuloId = 2) 
AND (CargasMultimedias.CargaMultimediaNoticiasTipoId = 3) 
AND (CargasMultimediasPerfiles.PerfilId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')).")  
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
