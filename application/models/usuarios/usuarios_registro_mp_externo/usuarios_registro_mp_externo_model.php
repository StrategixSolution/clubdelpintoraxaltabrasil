<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class usuarios_registro_mp_externo_model extends Base_Model {	
    public function usuarios_participantes_externo_alta_obtener_distribuidora(){
        $query = "SELECT 
                    d.DistribuidorId,
                    dd.DistribuidorDetalleNombreComercial,
                    dd.DistribuidorDetalleEstado
                  FROM Distribuidores d
                  INNER JOIN DistribuidoresDetalles dd ON d.DistribuidorId = dd.DistribuidorId
                  INNER JOIN DistribuidoresActivasRE da ON d.DistribuidorId = da.DistribuidorId
                  WHERE da.DistribuidorActivaREFechaBaja IS NULL AND d.DistribuidorUsuarioIdBaja IS NULL";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function usuarios_participantes_externo_alta_obtener_companias_telefonicas(){
        $query = "SELECT 
                    CompaniaCelularId,
                    CompaniaCelularNombre
                  FROM CompaniasCelulares";
        $result = $this->db->query($query);
        return $result->result();
    }

    public function usuarios_participantes_externo_alta_obtener_datos_cp($cp){
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

    public function usuarios_participantes_externo_alta_obtener_datos_distribuidora($idd){
        $query = "SELECT 
                    dd.DistribuidorDetalleCalle,
                    dd.DistribuidorDetalleNumeroExterior,
                    dd.DistribuidorDetalleNumeroInterior,
                    dd.DistribuidorDetalleColonia,
                    dd.DistribuidorDetalleMunicipio,
                    dd.DistribuidorDetalleCiudad,
                    dd.DistribuidorDetalleEstado,
                    dd.DistribuidorDetalleCP
                  FROM DistribuidoresDetalles dd WHERE dd.DistribuidorId = ?";
        $result = $this->db->query($query,array($idd));
        return $result->result();
    }

    public function usuarios_participantes_externo_alta_validar_email($email){
        if (empty($email)) {
            return 0;
        }
        $query = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE Usuarios.UsuarioFechaBajaParticipante IS NULL AND Usuarios.UsuarioFechaBajaDistribuidora IS NULL AND UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL AND UsuariosDetalles.UsuarioDetalleEmail = ?";
        $result = $this->db->query($query, array($email)); // ¡Consulta preparada!
        return $result->row()->tot;
    }

    public function usuarios_participantes_externo_alta_validar_celular($celular){
        if (empty($celular)) {
            return 0;
        }
        $query = "SELECT count(Usuarios.UsuarioId) AS tot FROM Usuarios INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId WHERE Usuarios.UsuarioFechaBajaParticipante IS NULL AND Usuarios.UsuarioFechaBajaDistribuidora IS NULL AND UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL AND UsuariosDetalles.UsuarioDetalleCelular = ?";
        $result = $this->db->query($query, array($celular));
        return $result->row()->tot;
    }

    public function usuarios_participantes_externo_alta_obtener_usuarioSesionId($UsuarioSessionId = null){
        // Volver a consulta directa, pero con una sentencia preparada para la seguridad.
        // Usamos '?' como placeholder para el valor.
        $query = "SELECT UsuarioId FROM Usuarios WHERE UsuarioSessionId = ?";
        // Pasamos el valor como un array al método query() para que CodeIgniter lo enlace de forma segura.
        $result = $this->db->query($query, array($UsuarioSessionId));
        return $result->result();
    }

    public function usuarios_participantes_externo_alta_insert_usuario($data = null){
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

    public function usuarios_participantes_externo_alta_insert_usuarioDetalle($data = null)
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
                        UsuarioDetalleMunicipio, UsuarioDetalleColonia, UsuarioDetalleCalle,
                        UsuarioDetalleExterior, UsuarioDetalleInterior, UsuarioDetalleFechaRegistro,
                        UsuarioDetalleUsuarioIdRegistro, UsuarioDetalleObservaciones, UsuarioDetalleSessionId
                    )
                    VALUES(
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, GETDATE(), ?, ?, ?
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
                $data['UsuarioDetalleCompania'], // Asegúrate que este mapee a CompaniaCelularId en tu DB
                $data['UsuarioDetalleCp'],
                $data['UsuarioDetalleEstado'],
                $data['UsuarioDetalleCiudad'],
                $data['UsuarioDetalleMunicipio'],
                $data['UsuarioDetalleColonia'],
                $data['UsuarioDetalleCalle'],
                $data['UsuarioDetalleExterior'],
                $data['UsuarioDetalleInterior'],
                // La fecha se maneja con GETDATE() en el SQL, no aquí
                $data['UsuarioDetalleIdRegistro'],
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

    public function usuarios_participantes_externo_alta_insert_usuarioDistribuidores($data = null){
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

    public function usuarios_participantes_externo_alta_obtener_siguiente_tarjeta_numero() {
        // Convertimos TarjetaNumero a INT en la consulta
        $query = $this->db->query("SELECT MAX(CAST(TarjetaNumero AS INT)) AS last_card_number FROM Tarjetas");
        $result = $query->row();

        // Si no hay registros, asumimos 0
        $last_card_number = isset($result->last_card_number) ? (int)$result->last_card_number : 0;
        $next_card_number = $last_card_number + 1;

        return $next_card_number;
    }

    public function usuarios_participantes_externo_alta_insert_tarjeta($data = null) {
    if (!empty($data)) {
        $sql = "INSERT INTO Tarjetas (
                        TarjetaNumero
                        ,DistribuidorId
                        ,UsuarioId
                        ,TarjetaEstatusId
                        ,TarjetaFechaRegistro
                        ,TarjetaUsuarioIdCaptura
                        ,TarjetasTipoId
                        ,observaciones
                    )
                    VALUES (?, ?, ?, ?, GETDATE(), ?, ?, ?)"; // Asegúrate de que GETDATE() esté en la posición correcta

        $values = array(
                    $data['TarjetaNumero'],
                    $data['DistribuidorId'],
                    $data['UsuarioId'],
                    $data['TarjetaEstatusId'],
                    $data['TarjetaUsuarioIdCaptura'],
                    $data['TarjetasTipoId'],
                    $data['Observaciones']
                  );

        $this->db->query($sql, $values);

        // Obtener el ID de la última inserción para la tabla 'Tarjetas'
        // Asumiendo que 'Tarjetas' tiene una columna IDENTITY
        $query = $this->db->query("SELECT IDENT_CURRENT('Tarjetas') as last_id");
        $result = $query->row();
        return $result->last_id;
    } else {
        return false;
    }
}
}


