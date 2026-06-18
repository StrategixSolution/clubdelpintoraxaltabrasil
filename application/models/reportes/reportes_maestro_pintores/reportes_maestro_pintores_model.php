<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_maestro_pintores_model extends Base_Model {	
    public function __construct(){ parent::__construct(); }
  
  public function reportes_maestro_pintores_model_combo_distribuidor($perfil_id){
        // Sanitizar parámetros
        $perfil_id = (int)$perfil_id;
        $usuario_id = (int)$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id'));
        
        // Perfiles 1,2,3: Administradores (todos los distribuidores)
        if (in_array($perfil_id, [1, 2, 3])) {
            $SQL = "SELECT Distribuidores.DistribuidorId, 
                           DistribuidoresDetalles.DistribuidorDetalleCodigo, 
                           DistribuidoresDetalles.DistribuidorDetalleRazonSocial,
                           DistribuidoresDetalles.DistribuidorDetalleNombreComercial
                    FROM Distribuidores 
                    INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    WHERE DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL
                    ORDER BY DistribuidoresDetalles.DistribuidorDetalleCodigo";
        } 
        // Perfiles 4 o 5: Regionales/Ejecutivos/personal (solo sus distribuidores)
        else {
            $SQL = "SELECT Distribuidores.DistribuidorId, 
                           DistribuidoresDetalles.DistribuidorDetalleCodigo, 
                           DistribuidoresDetalles.DistribuidorDetalleRazonSocial,
                           DistribuidoresDetalles.DistribuidorDetalleNombreComercial
                    FROM UsuariosDistribuidores 
                    INNER JOIN Usuarios ON UsuariosDistribuidores.UsuarioId = Usuarios.UsuarioId 
                    INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    INNER JOIN Distribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId 
                    WHERE Usuarios.PerfilId = $perfil_id 
                    AND Distribuidores.DistribuidorFechaBaja IS NULL 
                    AND DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL 
                    AND Usuarios.UsuarioId = $usuario_id
                    ORDER BY DistribuidoresDetalles.DistribuidorDetalleCodigo";
        }
        
        $query = $this->db->query($SQL);
        return $query->result();
    }
  
  
  
  
  
  /*
    public function get_pintor_detalle($where1){
        $SQL = "SELECT DISTINCT
  u.UsuarioId,
  u.UsuarioNombre,
  u.UsuarioSegundoNombre,
  u.UsuarioApellidoPaterno,
  u.UsuarioApellidoMaterno,
  u.UsuarioUsuario,
  u.UsuarioClave,
  u.UsuarioEmail,
  u.UsuarioTelefono1,
  u.UsuarioExtension1,
  u.UsuarioTelefono2,
  u.UsuarioExtension2,
  u.UsuarioCelular,
  u.CompaniaCelularId,
  u.UsuarioFechaRegistro,
  u.UsuarioMaestroPintorExterno,
  p.PerfilId,
  p.PerfilDescripcion,
  up.UsuarioParticipantePuesto,
  up.UsuarioParticipanteNombreTaller,
  up.UsuarioParticipanteRFC,
  up.UsuarioParticipanteHomoclave,
  up.UsuarioParticipanteCURP,
  up.UsuarioParticipanteCP,
  up.UsuarioParticipanteEstado,
  up.UsuarioParticipanteCiudad,
  up.UsuarioParticipanteDelegacionMunicipio,
  up.UsuarioParticipanteColonia,
  up.UsuarioParticipanteCalle,
  up.UsuarioParticipanteNumeroExterior,
  up.UsuarioParticipanteNumeroInterior,
  up.UsuarioParticipanteEntreCalles,
  up.UsuarioParticipanteFechaNacimiento,
  up.UsuarioTallaId,
  up.UsuarioParticipantePersonasTaller,
  up.UsuarioParticipanteAutosPorsemana,
  d.DistribuidoraId,
  d.DistribuidoraCP,
  d.DistribuidoraCodigo,
  d.DistribuidoraRazonSocial,
  d.DistribuidoraNombreComercial,
  d.DistribuidoraEvento,
  d.DistribuidoraFechaBaja,
  d.DistribuidoraFechaAlta,
  d.DistribuidoraFechaActivacion,
  r.RegionId,
  r.RegionNombre,
  t.TarjetaNumero,
  d.DistribuidoraCiudad,
  d.DistribuidoraEstado,
  ej.UsuarioNombre as ej_nom,
  ej.UsuarioSegundoNombre as ej_segnom,
  ej.UsuarioApellidoPaterno as ej_ap,
  ej.UsuarioApellidoMaterno as ej_am,
  ut.UsuarioTallaDescripcion,
  ut.UsuarioTallaClave,
  u.UsuarioFechaEntegaTarjeta,
  u.UsuarioEntregaTarjetaUsuarioId,
  u.UsuarioFechaTerminosVirtuales,
  tt.TarjetasTipoDescripcion
FROM
  usuarios u
  INNER JOIN usuarioparticipantes up ON (u.UsuarioId = up.UsuarioId)
  INNER JOIN perfiles p ON (u.PerfilId = p.PerfilId)
  INNER JOIN usuariosdistribuidoras ud ON (u.UsuarioId = ud.UsuarioId)
  INNER JOIN distribuidoras d ON (ud.DistribuidoraId = d.DistribuidoraId)
  LEFT OUTER JOIN regiones r ON (d.RegionId = r.RegionId)
  LEFT OUTER JOIN tarjetas t ON (u.UsuarioId = t.UsuarioId) 
  LEFT OUTER JOIN tarjetastipos tt ON (tt.TarjetasTipoId = t.TarjetasTipoId) 
  LEFT OUTER JOIN usuariotallas ut ON (up.UsuarioTallaId = ut.UsuarioTallaId)
  LEFT JOIN (select ud2.DistribuidoraId,u2.UsuarioNombre,u2.UsuarioSegundoNombre,u2.UsuarioApellidoPaterno,u2.UsuarioApellidoMaterno
  FROM usuarios u2 
  INNER JOIN usuariosdistribuidoras ud2 ON (u2.UsuarioId = ud2.UsuarioId)  
  INNER JOIN distribuidoras d2 ON (ud2.DistribuidoraId = d2.DistribuidoraId) 
  WHERE   u2.UsuarioFechaBajaParticipante IS NULL AND 
  u2.UsuarioFechaBajaDistribuidora IS NULL AND
    u2.PerfilId = 3 AND 
  d2.DistribuidoraFechaBaja IS NULL) ej ON ej.DistribuidoraId = d.DistribuidoraId
WHERE
  u.UsuarioFechaBajaParticipante IS NULL AND 
  u.PerfilId = 7 AND t.TarjetaEstatusId = 1 AND t.TarjetaFechaBaja IS NULL 
  $where1 
                ORDER BY u.UsuarioNombre";
        $query	= $this->db->query($SQL);
        return $query->result();
    }
    public function maestrosPintoresExternosSinTarjeta($where1){
        $SQL = "SELECT DISTINCT
  u.UsuarioId,
  u.UsuarioNombre,
  u.UsuarioSegundoNombre,
  u.UsuarioApellidoPaterno,
  u.UsuarioApellidoMaterno,
  u.UsuarioUsuario,
  u.UsuarioClave,
  u.UsuarioEmail,
  u.UsuarioTelefono1,
  u.UsuarioExtension1,
  u.UsuarioTelefono2,
  u.UsuarioExtension2,
  u.UsuarioCelular,
  u.CompaniaCelularId,
  u.UsuarioFechaRegistro,
  u.UsuarioMaestroPintorExterno,
  p.PerfilId,
  p.PerfilDescripcion,
  up.UsuarioParticipantePuesto,
  up.UsuarioParticipanteNombreTaller,
  up.UsuarioParticipanteRFC,
  up.UsuarioParticipanteHomoclave,
  up.UsuarioParticipanteCURP,
  up.UsuarioParticipanteCP,
  up.UsuarioParticipanteEstado,
  up.UsuarioParticipanteCiudad,
  up.UsuarioParticipanteDelegacionMunicipio,
  up.UsuarioParticipanteColonia,
  up.UsuarioParticipanteCalle,
  up.UsuarioParticipanteNumeroExterior,
  up.UsuarioParticipanteNumeroInterior,
  up.UsuarioParticipanteEntreCalles,
  up.UsuarioParticipanteFechaNacimiento,
  up.UsuarioTallaId,
  up.UsuarioParticipantePersonasTaller,
  up.UsuarioParticipanteAutosPorsemana,
  d.DistribuidoraId,
  d.DistribuidoraCP,
  d.DistribuidoraCodigo,
  d.DistribuidoraRazonSocial,
  d.DistribuidoraNombreComercial,
  d.DistribuidoraEvento,
  d.DistribuidoraFechaBaja,
  d.DistribuidoraFechaAlta,
  d.DistribuidoraFechaActivacion,
  r.RegionId,
  r.RegionNombre,
  t.TarjetaNumero,
  d.DistribuidoraCiudad,
  d.DistribuidoraEstado,
  ej.UsuarioNombre as ej_nom,
  ej.UsuarioSegundoNombre as ej_segnom,
  ej.UsuarioApellidoPaterno as ej_ap,
  ej.UsuarioApellidoMaterno as ej_am,
  ut.UsuarioTallaDescripcion,
  ut.UsuarioTallaClave,
  u.UsuarioFechaEntegaTarjeta,
  u.UsuarioEntregaTarjetaUsuarioId,
  mpd.DistribuidoraId as UDistribuidoraId
FROM
  usuarios u
  INNER JOIN usuarioparticipantes up ON (u.UsuarioId = up.UsuarioId)
  INNER JOIN perfiles p ON (u.PerfilId = p.PerfilId)
  LEFT OUTER JOIN maestropintordistribuidoras mpd ON (u.UsuarioId = mpd.UsuarioId)
  LEFT OUTER JOIN distribuidoras d ON (mpd.DistribuidoraId = d.DistribuidoraId)
  LEFT OUTER JOIN regiones r ON (d.RegionId = r.RegionId)
  LEFT OUTER JOIN tarjetas t ON (u.UsuarioId = t.UsuarioId) 
  LEFT OUTER JOIN usuariotallas ut ON (up.UsuarioTallaId = ut.UsuarioTallaId)
  LEFT JOIN (select ud2.DistribuidoraId,u2.UsuarioNombre,u2.UsuarioSegundoNombre,u2.UsuarioApellidoPaterno,u2.UsuarioApellidoMaterno
  FROM usuarios u2 
  INNER JOIN usuariosdistribuidoras ud2 ON (u2.UsuarioId = ud2.UsuarioId)  
  INNER JOIN distribuidoras d2 ON (ud2.DistribuidoraId = d2.DistribuidoraId) 
  WHERE   u2.UsuarioFechaBajaParticipante IS NULL AND 
  u2.UsuarioFechaBajaDistribuidora IS NULL AND
    u2.PerfilId = 3 AND 
  d2.DistribuidoraFechaBaja IS NULL) ej ON ej.DistribuidoraId = d.DistribuidoraId
WHERE
  u.UsuarioFechaBajaParticipante IS NULL AND 
  u.PerfilId = 7 AND 
  u.UsuarioMaestroPintorExterno = 1
  $where1 
                ORDER BY u.UsuarioNombre";
        $query	= $this->db->query($SQL);
        return $query->result();
    }    
}*/

}

								