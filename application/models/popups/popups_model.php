<?php

/* 
 * Sistema Web Responsivo CDPBR                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Popups_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
    public function popups_model_datos($usuario_PerfilId){
        $SQL = "SELECT 
        CargasMultimedias.CargaMultimediaId, 
        CargasMultimedias.CargaMultimediaRuta, 
        CargasMultimedias.CargaMultimediaExtension, 
        CargasMultimedias.CargaMultimediaTipoId, 
        CargasMultimedias.CargaMultimediaThumbnail,
        CargasMultimedias.CargaMultimediaTexto, 
        CargasMultimediasPerfiles.PerfilId, 
        CargasMultimedias.CargaMultimediaFechaInicial, 
        CargasMultimedias.CargaMultimediaFechaFinal,
        CargasMultimedias.CargaMultimediaDownload,
        CargasMultimedias.CargaMultimediaExtension
        FROM CargasMultimedias 
        INNER JOIN CargasMultimediasPerfiles ON CargasMultimedias.CargaMultimediaId = CargasMultimediasPerfiles.CargaMultimediaId
        WHERE (CargasMultimedias.CargaMultimediaFechaBaja IS NULL) 
        AND (CargasMultimedias.CargaMultimediaModuloId = 1) 
        AND (CargasMultimediasPerfiles.PerfilId = $usuario_PerfilId) 
        AND CAST(getdate() AS DATE) between CargasMultimedias.CargaMultimediaFechaInicial and CargasMultimedias.CargaMultimediaFechaFinal;";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
}
