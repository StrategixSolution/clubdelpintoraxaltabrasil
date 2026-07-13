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
  
  public function reportes_maestro_pintores_model_crea_tabla($where=""){
        $SQL = "SELECT 
                  Usuarios.UsuarioId,
                  Usuarios.UsuarioFechaRegistro, 
                  UsuariosDetalles.UsuarioDetalleNombre as nombre, 
                  UsuariosDetalles.UsuarioDetalleEmail, 
                  UsuariosDetalles.UsuarioDetalleCelular,
                  UsuariosDetalles.UsuarioDetalleCiudad, 
                  UsuariosDetalles.UsuarioDetalleArchivoIdentificacion,
                  UsuariosDetalles.UsuarioDetalleArchivoFirma, 
                  Usuarios.UsuarioFechaBajaParticipante, 
                  UsuariosDetallesTallas.UsuarioDetalleTallaDescripcion, 
                  DistribuidoresDetalles.DistribuidorId, 
                  DistribuidoresDetalles.DistribuidorDetalleCodigo, 
                  DistribuidoresDetalles.DistribuidorDetalleRazonSocial,
                  DistribuidoresDetalles.DistribuidorDetalleNombreComercial, 
                  DistribuidoresDetalles.DistribuidorDetalleCEP, 
                  DistribuidoresDetallesRegiones.DistribuidorDetalleRegionNombre, 
                  Tarjetas.TarjetaNumero, 
                  Perfiles.PerfilId ,
                  Perfiles.PerfilDescripcion ,
                  (SELECT  ud2.UsuarioDetalleNombre
                                  FROM usuarios u_ej
                                  INNER JOIN UsuariosDetalles ud2 ON ud2.UsuarioId = u_ej.UsuarioId
                                  INNER JOIN perfiles p ON u_ej.PerfilId = p.PerfilId
                                  INNER JOIN UsuariosDistribuidores ud_ej ON u_ej.UsuarioId = ud_ej.UsuarioId
                                  WHERE ud_ej.DistribuidorId = DistribuidoresDetalles.DistribuidorId
                                      AND u_ej.UsuarioFechaBajaParticipante IS NULL
                                      AND u_ej.UsuarioFechaBajaDistribuidora IS NULL
                                      AND ud2.UsuarioDetalleFechaBaja IS NULL
                                      AND u_ej.PerfilId = 5
                                  FOR XML PATH('')) AS ejecutivo
                  FROM Usuarios 
                  INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                  INNER JOIN Perfiles ON Usuarios.PerfilId = Perfiles.PerfilId 
                  LEFT JOIN UsuariosDetallesTallas ON UsuariosDetalles.UsuarioDetalleTallaId = UsuariosDetallesTallas.UsuarioDetalleTallaId 
                  INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId 
                  INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                  INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                  INNER JOIN DistribuidoresDetallesRegiones ON DistribuidoresDetalles.DistribuidorDetalleRegionId = DistribuidoresDetallesRegiones.DistribuidorDetalleRegionId 
                  INNER JOIN Tarjetas ON Usuarios.UsuarioId = Tarjetas.UsuarioId 
                  WHERE UsuarioFechaBajaParticipante IS NULL 
                  AND UsuarioDetalleFechaBaja IS NULL 
                  AND DistribuidoresDetalles.DistribuidorDetalleFechaBaja IS NULL
                  AND Usuarios.PerfilId=9 ".$where;
        $query	= $this->db->query($SQL);
//        echo $this->db->last_query();
        return $query->result();
    }

    public function reportes_usuarios_maestros_pintores_model_tabla_registros_por_mes($where){
        $SQL    = "SELECT 
                  YEAR(Usuarios.UsuarioFechaRegistro) AS anio, 
                  MONTH(Usuarios.UsuarioFechaRegistro) AS mes, 
                  COUNT(Usuarios.UsuarioId) AS total
                  FROM Usuarios 
                  INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                  INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId 
                  INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                  INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                  INNER JOIN Tarjetas ON Usuarios.UsuarioId = Tarjetas.UsuarioId 
                  WHERE Usuarios.PerfilId=9
                  AND Usuarios.UsuarioFechaBajaParticipante IS NULL 
                  AND UsuarioDetalleFechaBaja IS NULL  ".$where." 
                  GROUP BY YEAR(Usuarios.UsuarioFechaRegistro),MONTH(Usuarios.UsuarioFechaRegistro) 
                  ORDER BY YEAR(Usuarios.UsuarioFechaRegistro),MONTH(Usuarios.UsuarioFechaRegistro)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function reportes_usuarios_maestros_pintores_model_tabla_bajas($where){
        $SQL    = "SELECT 
                    Usuarios.UsuarioId,
                    Usuarios.UsuarioFechaBajaParticipante, 
                    Usuarios.UsuarioFechaRegistro, 
                    UsuariosDetalles.UsuarioDetalleNombre as nombre, 
                    DistribuidoresDetalles.DistribuidorDetalleCodigo, 
                    DistribuidoresDetalles.DistribuidorDetalleRazonSocial 
                    FROM Usuarios 
                    INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                    INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId 
                    INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    WHERE PerfilId = 9
                    AND Usuarios.UsuarioFechaBajaParticipante IS NOT NULL  ".$where;
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function reportes_usuarios_maestros_pintores_model_por_distribuidores($where){
        $SQL    = "SELECT DISTINCT 
                    Distribuidores.DistribuidorId, 
                    DistribuidoresDetalles.DistribuidorDetalleCodigo, 
                    DistribuidoresDetalles.DistribuidorDetalleRazonSocial, 
                    DistribuidoresDetalles.DistribuidorDetalleUnidadFederativa, 
                    DistribuidoresDetalles.DistribuidorDetalleCiudad, 
                    DistribuidoresDetalles.DistribuidorDetalleBarrio,
                    (SELECT  ud2.UsuarioDetalleNombre
                FROM usuarios u_ej
                INNER JOIN UsuariosDetalles ud2 ON ud2.UsuarioId = u_ej.UsuarioId
                INNER JOIN perfiles p ON u_ej.PerfilId = p.PerfilId
                INNER JOIN UsuariosDistribuidores ud_ej ON u_ej.UsuarioId = ud_ej.UsuarioId
                WHERE ud_ej.DistribuidorId = DistribuidoresDetalles.DistribuidorId
                    AND u_ej.UsuarioFechaBajaParticipante IS NULL
                    AND u_ej.UsuarioFechaBajaDistribuidora IS NULL
                    AND ud2.UsuarioDetalleFechaBaja IS NULL
                    AND u_ej.PerfilId = 5
                FOR XML PATH('')) AS ejecutivo
                    FROM Distribuidores 
                    INNER JOIN DistribuidoresDetalles ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    INNER JOIN UsuariosDistribuidores ON UsuariosDistribuidores.DistribuidorId = Distribuidores.DistribuidorId 
                    INNER JOIN Usuarios ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId 
                    INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                    WHERE DistribuidorFechaBaja IS NULL 
                    AND Usuarios.UsuarioFechaBajaParticipante IS NULL 
                    AND UsuarioDetalleFechaBaja IS NULL ".$where;
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function reportes_usuarios_maestros_pintores_model_por_ciudad($where){
        $SQL    = "SELECT 
                    COUNT( Usuarios.UsuarioId) AS total, 
                    UsuariosDetalles.UsuarioDetalleCiudad 
                    FROM Usuarios 
                    INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                    INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId 
                    INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    INNER JOIN Distribuidores ON Distribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
                    INNER JOIN Tarjetas ON Usuarios.UsuarioId = Tarjetas.UsuarioId 
                    WHERE PerfilId = 9
                    AND UsuarioFechaBajaParticipante IS NULL 
                    AND UsuarioDetalleFechaBaja IS NULL  ".$where." 
                    GROUP BY UsuariosDetalles.UsuarioDetalleCiudad";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function reportes_maestros_pintores_model_total_maestros_pintor ($iddist) {
        $SQL ="SELECT        count(Usuarios.PerfilId) as totmaestros 
        FROM Usuarios 
        INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
        INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId  
        INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
        WHERE PerfilId = 9
        AND UsuarioFechaBajaParticipante IS NULL 
        AND UsuarioDetalleFechaBaja IS NULL 
        AND UsuariosDistribuidores.DistribuidorId =  $iddist";
        $query	= $this->db->query($SQL);
        return $query->row();
    }
}

								