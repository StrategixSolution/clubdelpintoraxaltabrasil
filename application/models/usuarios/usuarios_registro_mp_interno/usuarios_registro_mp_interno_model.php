<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class usuarios_registro_mp_interno_model extends Base_Model {	
    public function usuarios_participantes_interno_alta_obtener_distribuidora(){
        $query = "SELECT 
                    d.DistribuidorId,
                    dd.DistribuidorDetalleNombreComercial
                  FROM Distribuidores d
                  INNER JOIN DistribuidoresDetalles dd ON d.DistribuidorId = dd.DistribuidorId 
                  WHERE d.DistribuidorFechaBaja IS NULL AND d.DistribuidorUsuarioIdBaja IS NULL";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function usuarios_participantes_interno_alta_obtener_companias_telefonicas(){
        $query = "SELECT 
                    CompaniaCelularId,
                    CompaniaCelularNombre
                  FROM CompaniasCelulares";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function usuarios_participantes_interno_alta_obtener_datos_cp($cp){
        $sx_db = $this->load->database('sx', TRUE);
        $query = "SELECT CodigoPostalAsentacion,CodigoPostalDelegacionMunicipio,CodigoPostalEstado,CodigoPostalCiudad FROM CodigosPostales WHERE CodigoPostal = ?";
        $result = $sx_db->query($query, array($cp));
        $rows = $result->result();

        foreach ($rows as $row) {
            foreach ($row as $key => $value) {
                $row->$key = utf8_encode($value);
            }
        }
        return $rows;
    }

    public function usuarios_participantes_interno_alta_obtener_datos_distribuidora($iduser){
        $SQL = "SELECT DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial, DistribuidoresDetalles.DistribuidorId FROM UsuariosDistribuidores INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE  (UsuariosDistribuidores.UsuarioId = $iduser)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }

    public function usuarios_participantes_interno_alta_validar_celular($celular){
        if (empty($celular)) {
            return 0;
        }
        $query = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE Usuarios.UsuarioFechaBajaParticipante IS NULL AND Usuarios.UsuarioFechaBajaDistribuidora IS NULL AND UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL AND UsuariosDetalles.UsuarioDetalleCelular = ?";
        $result = $this->db->query($query, array($celular));
        return $result->row()->tot;
    }

    public function usuarios_participantes_interno_alta_validar_tarjeta($tarjeta){
        if (empty($tarjeta)) {
            return 0;
        }
        $query = "SELECT count(TarjetaNumero) AS tot FROM Tarjetas WHERE (Tarjetas.TarjetaFechaBaja IS NULL) AND (Tarjetas.TarjetaEstatusId > 2) AND (Tarjetas.TarjetaNumero = ?)";
        $result = $this->db->query($query, array($tarjeta));
        return $result->row()->tot;
    }

    public function usuarios_participantes_interno_alta_obtener_usuarioSesionId($UsuarioSessionId = null){
        // Volver a consulta directa, pero con una sentencia preparada para la seguridad.
        // Usamos '?' como placeholder para el valor.
        $query = "SELECT UsuarioId FROM Usuarios WHERE UsuarioSessionId = ?";
        // Pasamos el valor como un array al método query() para que CodeIgniter lo enlace de forma segura.
        $result = $this->db->query($query, array($UsuarioSessionId));
        return $result->result();
    }

    public function usuarios_participantes_interno_alta_insert_usuario($data = null){
        if (!empty($data)) {
            // Usar placeholders (?) para los valores que vienen de variables.
            // GETDATE() es una función de SQL Server, así que no necesita placeholder.
            $sql = "INSERT INTO Usuarios(
                            UsuarioFechaActualizoDatos,
                            UsuarioFechaAceptoTerminos,
                            UsuarioFechaAceptoAvisoPrivacidad,
                            UsuarioFechaRegistro,
                            UsuarioCapturaId,
                            UsuarioTipoRegistroId,
                            PerfilId,
                            UsuarioSessionId)
                        VALUES(
                            GETDATE(),
                            GETDATE(),
                            GETDATE(),
                            GETDATE(),
                            ?, ?, ?, ?)"; // Placeholders para los valores variables.

            // Pasar los valores como un array al método query(), en el orden de los placeholders.
            $this->db->query($sql, array(
                $data['UsuarioCapturaId'],
                $data['UsuarioTipoRegistroId'],
                $data['PerfilId'],
                $data['UsuarioSessionId']
            ));
            
            // Después de la inserción, obtener el último ID para SQL Server.
            // IDENT_CURRENT es generalmente robusto para SQL Server.
            $query = $this->db->query("SELECT IDENT_CURRENT('Usuarios') as last_id");
            $result = $query->row(); // Usar row() ya que esperas un único resultado.
            return $result->last_id;
        } else {
            return false;
        }
    }

    public function usuarios_participantes_interno_alta_insert_usuarioDetalle($data = null)
    {
        if (!empty($data)) {
            // Usar placeholders (?) para los valores que vienen de variables.
            // GETDATE() es una función de SQL Server, así que no necesita placeholder.
            $sql = "INSERT INTO UsuariosDetalles(
                        UsuarioId, UsuarioDetalleNombre, UsuarioDetalleSegundoNombre,
                        UsuarioDetalleApellidoPaterno, UsuarioDetalleApellidoMaterno,
                        UsuarioDetalleUsuario, UsuarioDetalleClave, UsuarioDetalleEmail,
                        UsuarioDetalleTelefono, UsuarioDetalleCelular, UsuarioDetalleCompaniaCelularId,
                        UsuarioDetalleCP, UsuarioDetalleEstado, UsuarioDetalleCiudad,
                        UsuarioDetalleMunicipio, UsuarioDetalleColonia, UsuarioDetalleFechaRegistro,
                        UsuarioDetalleUsuarioIdRegistro, UsuarioDetalleArchivoIdentificacion, UsuarioDetalleObservaciones, UsuarioDetalleSessionId
                    )
                    VALUES(
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, GETDATE(), ?, ?, ?, ?
                    )";
            
            // Preparar los valores en el orden correcto para los placeholders.
            $values = array(
                $data['UsuarioId'],
                $data['UsuarioDetalleNombre'],
                $data['UsuarioDetalleSegundoNombre'],
                $data['UsuarioDetalleApellidoPaterno'],
                $data['UsuarioDetalleApellidoMaterno'],
                $data['UsuarioDetalleUsuario'],
                $data['UsuarioDetalleClave'],
                $data['UsuarioDetalleEmail'],
                $data['UsuarioDetalleTelefono'],
                $data['UsuarioDetalleCelular'],
                $data['UsuarioDetalleCompania'],
                $data['UsuarioDetalleCp'],
                $data['UsuarioDetalleEstado'],
                $data['UsuarioDetalleCiudad'],
                $data['UsuarioDetalleMunicipio'],
                $data['UsuarioDetalleColonia'],
                $data['UsuarioDetalleIdRegistro'],
                $data['UsuarioDetalleArchivoIdentificacion'],
                $data['UsuarioDetalleObservaciones'],
                $data['UsuarioDetalleSessionId']
            );

            $this->db->query($sql, $values);
            
            // Obtener el último ID insertado para esta tabla si es necesario
            $query = $this->db->query("SELECT IDENT_CURRENT('UsuariosDetalles') as last_id");
            $result = $query->row();
            return $result->last_id;

        } else {
            return false;
        }
    }

    public function usuarios_participantes_interno_alta_insert_usuarioDistribuidores($data = null){
        if (!empty($data)) {
            $sql = "INSERT INTO UsuariosDistribuidores(
                            UsuarioId,
                            DistribuidorId
                        )
                        VALUES(?, ?)"; // Placeholders

            $values = array(
                $data['UsuarioId'],
                $data['DistribuidorId']
            );
            
            $this->db->query($sql, $values);
            
            // Obtener el último ID insertado para esta tabla si es necesario
            $query = $this->db->query("SELECT IDENT_CURRENT('UsuariosDistribuidores') as last_id");
            $result = $query->row();
            return $result->last_id;
        } else {
            return false;
        }
    }

    public function usuarios_participantes_interno_alta_obtener_siguiente_tarjeta_numero() {
        // Obtener el último TarjetaNumero
        $query = $this->db->query("SELECT MAX(TarjetaNumero) as last_card_number FROM Tarjetas");
        $result = $query->row();

        $last_card_number = (int)$result->last_card_number; // Asegúrate de que sea un entero
        $next_card_number = $last_card_number + 1;

        // Si la tabla está vacía, el primer número sería 1
        if ($next_card_number === 1 && $last_card_number === 0) {
            $next_card_number = 1;
        }

        return $next_card_number;
    }

    public function usuarios_participantes_interno_alta_insert_tarjeta($data = null) {
        if (!empty($data)) {
            $sql = "UPDATE Tarjetas SET
                        UsuarioId = ?,
                        TarjetaEstatusId = ?,
                        TarjetaUsuarioIdAsigno = ?,
                        TarjetasTipoId = ?,
                        TarjetaFechaAsigno = GETDATE()
                    WHERE TarjetaNumero = ?";

            $values = array(
                $data['UsuarioId'],
                $data['TarjetaEstatusId'],
                $data['TarjetaUsuarioIdAsigno'],
                $data['TarjetasTipoId'],
                $data['TarjetaNumero'],
            );

            return $this->db->query($sql, $values);
        } else {
            return false;
        }
    }
    public function usuarios_registro_mp_interno_model_maestro_pintor_informacion($id_dist, $numero_tarjeta){
        $numero_tarjeta_clean = $this->security->xss_clean($numero_tarjeta);
        $SQL    = "SELECT Tarjetas.TarjetaNumero,Tarjetas.TarjetaId
                    FROM Tarjetas
                    WHERE (Tarjetas.TarjetaFechaBaja IS NULL) AND (Tarjetas.TarjetaEstatusId = 1) AND (Tarjetas.DistribuidorId = ?) AND (Tarjetas.TarjetaNumero = ?)";
        $query	= $this->db->query($SQL, array($id_dist,$numero_tarjeta_clean));
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }  
}


