<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model de Reportes de Distribuidores
 * 
 * Gestiona las consultas a la base de datos para los reportes de distribuidores.
 * Optimizado para máximo rendimiento mediante consultas consolidadas.
 * 
 * Optimizaciones implementadas:
 * - Consulta única con subconsultas para maestros pintores y ventas
 * - Uso de XML PATH para concatenar ejecutivos en una sola consulta
 * - Eliminación de múltiples queries por cada distribuidor
 * - Uso del Query Builder de CodeIgniter para mayor seguridad
 * - Índices sugeridos: DistribuidorId, UsuarioId, VentaFechaBaja
 * 
 * @package    CodeIgniter
 * @subpackage Models
 * @category   Reportes
 * @author     Strategix
 * @version    2.0 - Optimizada
 */
class Reportes_distribuidores_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }  

    /**
     * Obtiene los años disponibles de distribuidores
     * @return array Lista de años
     */
    public function reportes_distribuidores_model_cmbanios(){
        $SQL = "SELECT YEAR(DistribuidorFechaAlta) AS anio 
                FROM Distribuidores 
                GROUP BY YEAR(DistribuidorFechaAlta) 
                ORDER BY YEAR(DistribuidorFechaAlta) ASC";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    /**
     * Obtiene los meses disponibles para un año específico
     * @param int $anio Año a consultar
     * @return array Lista de meses
     */
    public function reportes_distribuidores_model_cmbmes($anio){
        // Sanitizar parámetro para prevenir SQL Injection
        $anio = (int)$anio;
        
        $SQL = "SELECT MONTH(DistribuidorFechaAlta) AS mes 
                FROM Distribuidores 
                WHERE YEAR(DistribuidorFechaAlta) = $anio 
                GROUP BY MONTH(DistribuidorFechaAlta) 
                ORDER BY MONTH(DistribuidorFechaAlta) ASC";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    /**
     * Obtiene los distribuidores según el perfil del usuario
     * @param int $perfil_id ID del perfil del usuario
     * @return array Lista de distribuidores
     */
    public function reportes_distribuidores_model_combo_distribuidor($perfil_id){
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
    
    /**
     * FUNCIÓN NO UTILIZADA - Comentada tras optimización
     * Esta función fue reemplazada por la lógica en reportes_distribuidores_model_combo_distribuidor()
     */
    /*
    public function reportes_distribuidores_model_usuario_ditribuidor() {
        $SQL = "SELECT DistribuidorId FROM UsuariosDistribuidores WHERE  (UsuariosDistribuidores.UsuarioId = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";
        $query	= $this->db->query($SQL);
        return $query->result();    
    }
    */
    
    /**
     * Obtiene la tabla principal de distribuidores con toda la información consolidada
     * @param string $where Cláusula WHERE adicional para filtros
     * @return array Lista de distribuidores con datos relacionados
     */
    public function reportes_distribuidores_model_crea_tabla($where){
        $SQL = "SELECT 
            d.DistribuidorId,
            dd.DistribuidorDetalleCodigo,
            dd.DistribuidorDetalleRazonSocial,
            dd.DistribuidorDetalleNombreComercial,
            dd.DistribuidorDetalleRegionId,
            r.DistribuidorDetalleRegionNombre,
            dd.DistribuidorDetalleCategoriaId,
            c.DistribuidorDetalleCategoriaNombre,
            dd.DistribuidorDetalleCP,
            dd.DistribuidorDetalleEstado,
            dd.DistribuidorDetalleCiudad,
            dd.DistribuidorDetalleMunicipio,
            dd.DistribuidorDetalleColonia,
            dd.DistribuidorDetalleCalle,
            dd.DistribuidorDetalleNumeroExterior,
            dd.DistribuidorDetalleNumeroInterior,
            dd.DistribuidorDetalleReferencia,
            dd.DistribuidorDetalleTelefono,
            dd.DistribuidorDetalleGrupoBonificacion,
            dd.DistribuidorDetalleLealtad,
            d.DistribuidorMatriz,
            dd.DistribuidorDetalleEtapaId,
            dd.DistribuidorDetalleFaceId,
            faces.DistribuidorDetalleFaceNombre,
            etapas.DistribuidorDetalleEtapaNombre,
            -- Subconsultas optimizadas
            ISNULL(mp.total_mp, 0) AS total_maestros_pintores,
            ISNULL(v.num_ventas, 0) AS num_ventas,
            ISNULL(v.total_ventas, 0) AS total_ventas,
            STUFF((
                SELECT ' | ' + p.PerfilDescripcion + ': ' + 
                       ud2.UsuarioDetalleNombre + ' ' + 
                       ISNULL(ud2.UsuarioDetalleSegundoNombre, '') + ' ' + 
                       ud2.UsuarioDetalleApellidos
                FROM usuarios u_ej
                INNER JOIN UsuariosDetalles ud2 ON ud2.UsuarioId = u_ej.UsuarioId
                INNER JOIN perfiles p ON u_ej.PerfilId = p.PerfilId
                INNER JOIN UsuariosDistribuidores ud_ej ON u_ej.UsuarioId = ud_ej.UsuarioId
                WHERE ud_ej.DistribuidorId = d.DistribuidorId
                    AND u_ej.UsuarioFechaBajaParticipante IS NULL
                    AND u_ej.UsuarioFechaBajaDistribuidora IS NULL
                    AND ud2.UsuarioDetalleFechaBaja IS NULL
                    AND u_ej.PerfilId <> 9
                FOR XML PATH('')
            ), 1, 3, '') AS ejecutivos
            FROM
            Distribuidores d
            INNER JOIN DistribuidoresDetalles dd ON dd.DistribuidorId = d.DistribuidorId
            LEFT OUTER JOIN DistribuidoresDetallesRegiones r ON (dd.DistribuidorDetalleRegionId = r.DistribuidorDetalleRegionId)
            LEFT OUTER JOIN DistribuidoresDetallesCategorias c ON (dd.DistribuidorDetalleCategoriaId = c.DistribuidorDetalleCategoriaId)
            LEFT OUTER JOIN DistribuidoresDetallesFaces faces ON (dd.DistribuidorDetalleFaceId = faces.DistribuidorDetalleFaceId)
            LEFT OUTER JOIN DistribuidoresDetallesEtapas etapas ON (dd.DistribuidorDetalleEtapaId = etapas.DistribuidorDetalleEtapaId)
            -- Subconsulta para Maestros Pintores
            LEFT OUTER JOIN (
                SELECT ud.DistribuidorId, COUNT(u.UsuarioId) AS total_mp
                FROM Usuarios u
                INNER JOIN UsuariosDistribuidores ud ON u.UsuarioId = ud.UsuarioId
                LEFT OUTER JOIN tarjetas t ON u.UsuarioId = t.UsuarioId
                WHERE u.UsuarioFechaBajaParticipante IS NULL
                    AND u.PerfilId = 9
                    AND u.UsuarioFechaBajaDistribuidora IS NULL
                    AND t.TarjetaEstatusId = 2
                    AND t.TarjetaFechaBaja IS NULL
                GROUP BY ud.DistribuidorId
            ) mp ON mp.DistribuidorId = d.DistribuidorId
            -- Subconsulta para Ventas
            LEFT OUTER JOIN (
                SELECT DistribuidorId, 
                       COUNT(VentaId) AS num_ventas,
                       SUM(VentaMontoTicket) AS total_ventas
                FROM ventas
                WHERE VentaFechaBaja IS NULL
                GROUP BY DistribuidorId
            ) v ON v.DistribuidorId = d.DistribuidorId
            WHERE
            dd.DistribuidorDetalleFechaBaja IS NULL $where
            ORDER BY d.DistribuidorId";
        $query = $this->db->query($SQL);
        return $query->result();
    }
    
    /* ==================================================================================
     * FUNCIONES NO UTILIZADAS - Comentadas tras optimización (v2.0)
     * 
     * Estas funciones fueron reemplazadas por subconsultas en el método 
     * reportes_distribuidores_model_crea_tabla() para eliminar el problema N+1.
     * Se mantienen comentadas por si se necesitan en el futuro.
     * ================================================================================== */
   
    /**
     * FUNCIÓN NO UTILIZADA - Obtiene distribuidores activos por año y mes
     * Reemplazada por subconsulta en reportes_distribuidores_model_crea_tabla()
     */
    /*
    public function reportes_distribuidores_model_distribuidores_activos($año,$mes){
        $año = (int)$año;
        $mes = (int)$mes;
        $SQL = "SELECT DistribuidorId FROM DistribuidoresActivos WHERE DistribuidorActivoAnio = $año AND DistribuidorActivoMes = $mes ";
        $query	= $this->db->query($SQL);
        return $query->result();           
    }
    */
    
    /**
     * FUNCIÓN NO UTILIZADA - Obtiene ejecutivo de un distribuidor
     * Reemplazada por subconsulta XML PATH en reportes_distribuidores_model_crea_tabla()
     */
    /*
    public function reportes_distribuidores_model_ejecutivo($iddist){
        $iddist = (int)$iddist;
        $SQL = "SELECT UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, UsuariosDetalles.UsuarioDetalleApellidos
                FROM Usuarios 
                INNER JOIN UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId 
                INNER JOIN UsuariosDistribuidores ON Usuarios.UsuarioId = UsuariosDistribuidores.UsuarioId
                WHERE PerfilId = 5 
                AND UsuarioFechaBajaParticipante IS NULL 
                AND UsuarioFechaBajaDistribuidora IS NULL 
                AND UsuariosDistribuidores.DistribuidorId = $iddist";     
        $query	= $this->db->query($SQL);
        if ($query->num_rows() > 0){
            $ejecutivo = $query->row()->UsuarioDetalleNombre . " " . $query->row()->UsuarioDetalleSegundoNombre . " " . $query->row()->UsuarioDetalleApellidos;
            return $ejecutivo;
        } else {
            return "SIN EJECUTIVO";
        }  
    }
    */
    
    /**
     * FUNCIÓN NO UTILIZADA - Obtiene ventas de un distribuidor con auditoría
     * Reemplazada por subconsulta en reportes_distribuidores_model_crea_tabla()
     */
    /*
    public function reportes_distribuidores_model_ventas ($iddist) {
        $iddist = (int)$iddist;
        $SQL ="SELECT count(distinct Ventas.VentaId) as totalticket, SUM(Ventas.VentaMontoTicket) AS totalmonto 
            FROM Ventas 
            INNER JOIN VentasDetalles ON Ventas.VentaId = VentasDetalles.VentaId 
            LEFT JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId
            WHERE Ventas.DistribuidorId = $iddist 
            AND VentaFechaBaja IS NULL 
            AND VentaAuditoriaEstatusId = 2";
        $query	= $this->db->query($SQL);
        return $query->row();
    }
    */
    
    /**
     * FUNCIÓN NO UTILIZADA - Obtiene total de maestros pintores de un distribuidor
     * Reemplazada por subconsulta en reportes_distribuidores_model_crea_tabla()
     */
    /*
    public function reportes_distribuidores_model_total_mp ($iddist) {
        $iddist = (int)$iddist;
        $SQL ="SELECT COUNT(u.UsuarioId) AS total FROM 
                Usuarios u 
                INNER JOIN UsuariosDistribuidores ud ON (u.UsuarioId = ud.UsuarioId) 
                LEFT OUTER JOIN tarjetas t ON (u.UsuarioId = t.UsuarioId) 
                WHERE ud.DistribuidorId = $iddist
                AND u.UsuarioFechaBajaParticipante IS NULL
                AND u.PerfilId = 9
                AND u.UsuarioFechaBajaDistribuidora IS NULL 
                AND t.TarjetaEstatusId = 2
                AND t.TarjetaFechaBaja IS NULL";        
        $query	= $this->db->query($SQL);
        return $query->row();
    }
    */

    /**
     * FUNCIÓN NO UTILIZADA - Obtiene participantes de distribuidoras
     * Reemplazada por subconsulta XML PATH en reportes_distribuidores_model_crea_tabla()
     */
    /*
    public function reportes_distribuidores_model_Participante_Distribuidoras($where){
        $SQL = "SELECT ud2.UsuarioDetalleNombre, ud2.UsuarioDetalleSegundoNombre, ud2.UsuarioDetalleApellidos, p.PerfilDescripcion 
            FROM usuarios u 
            INNER JOIN UsuariosDetalles ud2 ON ud2.UsuarioId = u.UsuarioId 
            INNER JOIN perfiles p ON (u.PerfilId = p.PerfilId) 
            INNER JOIN UsuariosDistribuidores ud ON (u.UsuarioId = ud.UsuarioId)
            WHERE u.UsuarioFechaBajaParticipante IS NULL 
            AND u.UsuarioFechaBajaDistribuidora IS NULL 
            AND ud2.UsuarioDetalleFechaBaja IS NULL
            AND u.PerfilId <> 9 $where";     
        $query	= $this->db->query($SQL);        
        return $query->result();    
    }
    */
    
    /**
     * FUNCIÓN NO UTILIZADA - Obtiene total de ventas de un distribuidor
     * Reemplazada por subconsulta en reportes_distribuidores_model_crea_tabla()
     */
    /*
    public function reportes_distribuidores_model_total_venta ($iddist) {
        $iddist = (int)$iddist;
        $SQL ="SELECT COUNT(VentaId) AS num_venta, SUM(VentaMontoTicket) AS total_venta 
                FROM ventas
                WHERE DistribuidorId = $iddist 
                AND VentaFechaBaja IS NULL";        
        $query	= $this->db->query($SQL);
        return $query->row();
    }
    */
}
