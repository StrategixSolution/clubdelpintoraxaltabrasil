<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_reposicion_captura_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function productos_reposicion_captura_model_ganador($ReposicionProductoGanadorTotalProductoPremio,$ReposicionProductoGanadorFechaEntregaTienda,$ReposicionProductoGanadorId,$ReposicionProductoPremioProductoId,$DistribuidorId){
        $sql= "UPDATE ReposicionesProductosGanadores SET ReposicionProductoGanadorUsuarioNombreEntregaTienda='".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_nombre'))."',ReposicionProductoGanadorFechaEntregaRegistro=GETDATE(),ReposicionProductoGanadorFechaEntregaTienda = '$ReposicionProductoGanadorFechaEntregaTienda', ReposicionProductoGanadorUsuarioIdEntregaTienda = ".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",ReposicionProductoGanadorTotalProductoPremio = $ReposicionProductoGanadorTotalProductoPremio,ReposicionProductoPremioProductoId=$ReposicionProductoPremioProductoId WHERE ReposicionProductoGanadorId=$ReposicionProductoGanadorId AND DistribuidorId=$DistribuidorId";
        $this->db->query($sql);
//        echo  $this->db->last_query()."<br>";         
        return 1;
    }
    public function productos_reposicion_captura_model_datos_foto($values){
        $sql= "INSERT INTO ReposicionesProductosFotos (ReposicionProductoFotoAnio,ReposicionProductoFotoMes,ReposicionProductoFotoOriginal,ReposicionProductoFotoModificada,ReposicionProductoFotoTipoId,ReposicionProductoFotoUsuarioIdCapturo,ReposicionProductoFotoExtencion,DistribuidorId) VALUES ($values)";
        $this->db->query($sql);
//        echo  $this->db->last_query()."<br>";         
        return 1;
    }
    public function productos_reposicion_captura_model_cmbmes($anio,$mes){
//        $SQL = "SELECT DISTINCT ReposicionProductoGanadorMes AS mes FROM ReposicionesProductosGanadores WHERE ReposicionProductoGanadorAnio = $anio AND ReposicionProductoGanadorMes=$mes"; 
        $SQL = "SELECT DISTINCT ReposicionProductoGanadorMes AS mes FROM ReposicionesProductosGanadores WHERE ReposicionProductoGanadorAnio = $anio AND ReposicionProductoGanadorMes=$mes"; //para las pruebas de septiembre se harcodea, borrar esta linea al liberar a productivo
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>";         
        return $query->result();
    }
    public function productos_reposicion_captura_model_distribuidor($UsuarioId){
        $UsuarioId_clean = $this->security->xss_clean($UsuarioId); 
        $SQL = "SELECT DistribuidoresDetalles.DistribuidorDetalleRazonSocial,DistribuidoresDetalles.DistribuidorDetalleNombreComercial, DistribuidoresDetalles.DistribuidorId FROM UsuariosDistribuidores INNER JOIN DistribuidoresDetalles ON UsuariosDistribuidores.DistribuidorId = DistribuidoresDetalles.DistribuidorId WHERE  (UsuariosDistribuidores.UsuarioId = $UsuarioId_clean)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function productos_reposicion_captura_model_cmb_division(){
        $SQL = "SELECT        ProductoDivisionNombre, ProductoDivisionId FROM ProductosDivisiones";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function productos_reposicion_captura_model_cmb_participantes($mes,$anio,$idDitri){
        $SQL = "SELECT distinct       ReposicionesProductosGanadores.ReposicionProductoGanadorId, ReposicionesProductosGanadores.ReposicionProductoGanadorPremioLugar, ReposicionesProductosGanadores.TarjetaId, UsuariosDetalles.UsuarioDetalleNombre, UsuariosDetalles.UsuarioDetalleSegundoNombre, 
                         UsuariosDetalles.UsuarioDetalleApellidos
                FROM     ReposicionesProductosGanadores INNER JOIN
                         Tarjetas ON ReposicionesProductosGanadores.TarjetaId = Tarjetas.TarjetaId INNER JOIN
                         Usuarios ON Tarjetas.UsuarioId = Usuarios.UsuarioId INNER JOIN
                         UsuariosDetalles ON Usuarios.UsuarioId = UsuariosDetalles.UsuarioId
                WHERE ReposicionesProductosGanadores.DistribuidorId = $idDitri AND ReposicionesProductosGanadores.ReposicionProductoGanadorMes = $mes AND ReposicionesProductosGanadores.ReposicionProductoGanadorAnio = $anio AND UsuariosDetalles.UsuarioDetalleFechaBaja IS NULL  AND Usuarios.UsuarioFechaBajaParticipante IS NULL AND Usuarios.UsuarioFechaBajaDistribuidora IS NULL AND Tarjetas.TarjetaFechaBaja IS NULL order by ReposicionProductoGanadorPremioLugar";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }

        public function productos_reposicion_captura_model_fecha_inicio($mes,$anio,$idDitri){
        $SQL = "SELECT  distinct CAST(ReposicionesProductosGanadores.ReposicionProductoGanadorFechaRegistro AS DATE) AS fecha_inicio
FROM ReposicionesProductosGanadores
WHERE ReposicionesProductosGanadores.DistribuidorId = $idDitri
AND ReposicionesProductosGanadores.ReposicionProductoGanadorMes = $mes
AND ReposicionesProductosGanadores.ReposicionProductoGanadorAnio = $anio ;";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->fecha_inicio;    
    }
    public function productos_reposicion_captura_model_cmb_premio($mes,$anio,$lugar){
        $SQL = "SELECT  ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoId,ReposicionesProductosPremios.ReposicionProductoPremioId, ReposicionesProductosPremios.ReposicionProductoPremioAnio, ReposicionesProductosPremios.ReposicionProductoPremioMes,ReposicionesProductosPremios.ReposicionProductoPremioLugar, ReposicionesProductosPremios.ReposicionProductoPremioFechaRegistro, ReposicionesProductosPremios.ReposicionProductoPremioUsuarioIdRegistro, ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoDescripcion, ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoGMS, ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoCodigo 
                FROM ReposicionesProductosPremios INNER JOIN ReposicionesProductosPremiosProductosRelaciones ON ReposicionesProductosPremios.ReposicionProductoPremioId = ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioId INNER JOIN ReposicionesProductosPremiosProductos ON ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioProductoId = ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoId
                WHERE (ReposicionesProductosPremios.ReposicionProductoPremioAnio = $anio) AND (ReposicionesProductosPremios.ReposicionProductoPremioMes = $mes) AND (ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoFechaBaja IS NULL) AND (ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioProductoRelacionFechaBaja IS NULL) AND (ReposicionesProductosPremios.ReposicionProductoPremioLugar = $lugar)";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->result();    
    }
    public function productos_reposicion_captura_model_premio_descripcion($ReposicionProductoPremioProductoId){
        $SQL = "SELECT ReposicionProductoPremioProductoDescripcion FROM ReposicionesProductosPremiosProductos WHERE ReposicionProductoPremioProductoId = $ReposicionProductoPremioProductoId";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row()->ReposicionProductoPremioProductoDescripcion;    
    }
    public function productos_reposicion_captura_model_ganador_lugar($ReposicionProductoGanadorId){
        $SQL = "SELECT ReposicionProductoGanadorId,ReposicionProductoPremioProductoId,ReposicionProductoGanadorAnio,ReposicionProductoGanadorMes,ReposicionProductoGanadorPremioLugar,ReposicionProductoGanadorFechaRegistro,ReposicionProductoGanadorUsuarioIdRegistro,ReposicionProductoGanadorFechaEntregaTienda,ReposicionProductoGanadorUsuarioIdEntregaTienda,ReposicionProductoGanadorUsuarioNombreEntregaTienda,ReposicionProductoGanadorTotalProductoPremio,ReposicionProductoGanadorTotalSumaVentas,ReposicionProductoGanadorTotalCuentaVentas,ReposicionProductoGanadorObservaciones,DistribuidorId,TarjetaId,RecompensaTipoId,UsuarioId FROM ReposicionesProductosGanadores
                WHERE ReposicionProductoGanadorId = $ReposicionProductoGanadorId";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return $query->row();    
    } 
    public function productos_reposicion_captura_model_tabla_productos_Premios($mes,$anio,$lugar,$division){
        $SQL="SELECT        ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoId, ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoDescripcion, 
                         ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoGMS, ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoCodigo, 
                         ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoPresentacion, ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoPrecio
            FROM            ReposicionesProductosPremios INNER JOIN
                         ReposicionesProductosPremiosProductosRelaciones ON ReposicionesProductosPremios.ReposicionProductoPremioId = ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioId INNER JOIN
                         ReposicionesProductosPremiosProductos ON ReposicionesProductosPremiosProductosRelaciones.ReposicionProductoPremioProductoId = ReposicionesProductosPremiosProductos.ReposicionProductoPremioProductoId
            WHERE ReposicionProductoPremioAnio = $anio AND ReposicionProductoPremioMes = $mes AND ReposicionProductoPremioLugar = $lugar AND ReposicionesProductosPremios.ProductoDivisionId = $division AND ReposicionProductoPremioProductoFechaBaja IS NULL ORDER BY ReposicionProductoPremioProductoId";
        $query	= $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>";         
        return $query->result();
    }
    public function productos_reposicion_captura_model_lugar($idganador){
        $SQL = "SELECT        ReposicionProductoGanadorPremioLugar FROM ReposicionesProductosGanadores WHERE ReposicionProductoGanadorId=$idganador";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->ReposicionProductoGanadorPremioLugar;    
    }
    public function productos_reposicion_captura_model_entrega($idganador){
        $SQL = "SELECT        ReposicionProductoGanadorFechaEntregaTienda FROM ReposicionesProductosGanadores WHERE ReposicionProductoGanadorId=$idganador";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->ReposicionProductoGanadorFechaEntregaTienda;    
    }
    public function productos_reposicion_captura_model_producto_premioId($mes,$anio,$lugar,$division){
        $SQL = "SELECT ReposicionProductoPremioId FROM ReposicionesProductosPremios WHERE ReposicionProductoPremioAnio = $anio AND ReposicionProductoPremioMes = $mes AND ReposicionProductoPremioLugar = $lugar AND ProductoDivisionId = $division";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->ReposicionProductoPremioId;    
    }
}
