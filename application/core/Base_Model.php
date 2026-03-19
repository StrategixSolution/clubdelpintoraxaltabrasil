<?php

/*
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             *
 * @programmer  Luis Felipe Rangel                          *
 * @CreateDate 09 MARZO 2026 09:00:00                       *
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Model extends CI_Model {
    public function __construct(){ parent::__construct(); 
    $this->db_sx = $this->load->database('sx', TRUE);
    } 
    public function base_model_get_pais($id=""){
        $sql= "SELECT PaisId,PaisCodigo,PaisNombre FROM paises WHERE PaisId in ($id)";
        $query	=  $this->db_sx->query($sql);
//        echo  $this->db->last_query()."<br>";         
        return $query->row();
    }
    public function base_model_insert_cargas($CargaTipo,$CargaNombreArchivoOriginal,$CargaNombreArchivoModificado){
        $sql= "INSERT INTO Cargas (CargaTipoId,CargaNombreArchivoOriginal,CargaNombreArchivoModificado,CargaUsuarioIdRegistro) VALUES ($CargaTipo,'$CargaNombreArchivoOriginal','$CargaNombreArchivoModificado',".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";
        $this->db->query($sql);
//        echo  $this->db->last_query()."<br>";         
        $query2  = $this->db->query("SELECT IDENT_CURRENT('Cargas') as last_id"); 
        $res = $query2->result(); 
        $id = $res[0]->last_id;      
        return $id;
    }
    public function base_model_insert_cargas_detalle($row,$tipo,$CargaId){
        $error_validacion_helper = carga_validacion_helper($tipo, $row);
        $error_validacion_helper .= ($error_validacion_helper=="")?$this->base_model_valida_cargas_repetido($tipo, $row):NULL;
        if ($error_validacion_helper==NULL){ $error = "NULL"; } else { $error = "'$error_validacion_helper'";}
        switch ($tipo) {
            case 1: $sql= "INSERT INTO CargasPremiosProductos (CargaId,CargaPremioProductoDescripcion,CargaPremioProductoGMS,CargaPremioProductoCodigo,CargaPremioProductoPresentacion,CargaPremioProductoPrecio,CargaPremioProductoUsuarioIdRegistro,CargaPremioProductoObservaciones) VALUES ($CargaId,'". strtoupper(utf8_decode($row[0]))."','".strtoupper(utf8_decode($row[1]))."','".strtoupper(utf8_decode($row[2]))."','".strtoupper(utf8_decode($row[3]))."','".strtoupper(utf8_decode($row[4]))."',".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",$error)"; break;
            case 2: $sql= "INSERT INTO CargasRecompensas (CargaId,CargaRecompensaAnio,CargaRecompensaMes,CargaRecompensaPremioLugar,CargaRecompensaRangoInicial,CargaRecompensaRangoFinal,CargaRecompensaUsuarioIdRegistro,CargaRecompensObservaciones) VALUES ($CargaId,'". strtoupper(utf8_decode($row[0]))."','".strtoupper(utf8_decode($row[1]))."','".strtoupper(utf8_decode($row[2]))."','".strtoupper(utf8_decode($row[3]))."','".strtoupper(utf8_decode($row[4]))."',".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",$error)"; break;
            case 3: $sql= "INSERT INTO CargasVentasPromocionesDetalles (CargaId,CargaVentaPromocionDetalleGMC,CargaVentaPromocionDetalleCodigo,CargaVentaPromocionDetalleDescripcion,CargaVentaPromocionDetallePresentacion,CargaVentaPromocionDetalleUsuarioIdRegistro,CargaVentaPromocionDetalleObservaciones) VALUES ($CargaId,'". strtoupper(utf8_decode($row[0]))."','".strtoupper(utf8_decode($row[1]))."','".strtoupper(utf8_decode($row[2]))."','".strtoupper(utf8_decode($row[3]))."',".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",$error)"; break;
        }        
        $this->db->query($sql);
//        echo  $this->db->last_query()."<br>"; 
        return $error;
    }
    public function base_model_valida_cargas_repetido($tipo, $row){
        switch ($tipo) {
            case 1: $sql = "SELECT COUNT(ReposicionProductoPremioProductoId) AS total FROM ReposicionesProductosPremiosProductos WHERE ReposicionProductoPremioProductoDescripcion = '". utf8_decode(trim($row[0]))."' AND ReposicionProductoPremioProductoGMS = '". trim($row[1])."' AND ReposicionProductoPremioProductoCodigo = '". trim($row[2])."' AND ReposicionProductoPremioProductoPresentacion = '". trim($row[3])."' AND ReposicionProductoPremioProductoPrecio = ". $row[4]; break;
            case 2: $sql = "SELECT COUNT(RecompensaId) AS total FROM Recompensas WHERE RecompensaAnio = ". trim($row[0])." AND RecompensaMes = ". trim($row[1])." AND RecompensaPremioLugar = ". trim($row[2]); break;
            case 3: $sql = "SELECT total = 0"; break;
        }        
        $query	=  $this->db->query($sql);
        $error = ($query->row()->total!=0)?"REPETIDO BD":NULL;
        return $error;
    }
    public function base_model_valida_carga_error($tipo,$CargaId) {
      switch ($tipo) {
            case 1: $sql= "SELECT COUNT(CargaPremioProductoId) as total FROM CargasPremiosProductos WHERE CargaPremioProductoObservaciones IS NOT NULL AND CargaId = $CargaId"; break;
            case 2: $sql= "SELECT COUNT(CargaRecompensaId) as total FROM CargasRecompensas WHERE CargaRecompensObservaciones IS NOT NULL AND CargaId = $CargaId"; break;
            case 3: $sql= "SELECT COUNT(CargaVentaPromocionDetalleId) as total FROM CargasVentasPromocionesDetalles WHERE CargaVentaPromocionDetalleObservaciones IS NOT NULL AND CargaId = $CargaId"; break;
        }        
        $query	=  $this->db->query($sql);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->total;
    }
    public function base_model_valida_corte($CorteTipoId,$CorteAnio='',$CorteMes='',$CorteIdOtro='') {
        switch ($CorteTipoId) {
            case 1: $SQL = "SELECT COUNT(CorteId) as tot FROM Cortes WHERE CorteTipoId = $CorteTipoId AND CorteAnio = $CorteAnio AND CorteMes = $CorteMes "; break;
            case 2: $SQL = "SELECT COUNT(CorteId) as tot FROM Cortes WHERE CorteTipoId = $CorteTipoId AND CorteAnio = $CorteAnio AND CorteMes = $CorteMes "; break;
            case 3: $SQL = "SELECT COUNT(CorteId) as tot FROM Cortes WHERE CorteTipoId = $CorteTipoId AND CorteAnio = $CorteAnio AND CorteMes = $CorteMes "; break;
            case 4: $SQL = "SELECT COUNT(CorteId) as tot FROM Cortes WHERE CorteTipoId = $CorteTipoId AND CorteIdOtro = $CorteIdOtro "; break;
        }        
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;
    }
    public function base_model_valida_ventas($CorteAnio,$CorteMes,$CorteMesAnterior){
        $SQL = "SELECT COUNT(Ventas.VentaId) AS tot FROM Ventas WHERE (Ventas.VentaFechaBaja IS NULL) AND YEAR(Ventas.VentaFechaRegistro)=$CorteAnio AND MONTH(Ventas.VentaFechaRegistro) in ($CorteMesAnterior,$CorteMes)";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;
    }
    public function base_model_valida_ventas_auditorias($CorteAnio,$CorteMes,$CorteMesAnterior){
        $SQL1 = "SELECT COUNT(VentaId) tot FROM Ventas WHERE VentaFechaBaja IS NULL AND YEAR(VentaFechaRegistro)=$CorteAnio AND MONTH(VentaFechaRegistro) in ($CorteMesAnterior,$CorteMes)";
        $query1	= $this->db->query($SQL1);
        //echo  $this->db->last_query()."<br>"; 
        $total_ventas = $query1->row()->tot;
        $SQL2 = "SELECT COUNT(Ventas.VentaId) AS tot FROM Ventas LEFT OUTER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId WHERE (Ventas.VentaFechaBaja IS NULL)  AND (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaId IS NOT NULL) AND (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) AND YEAR(Ventas.VentaFechaRegistro)=$CorteAnio AND MONTH(Ventas.VentaFechaRegistro) in ($CorteMesAnterior,$CorteMes)";
        $query2	= $this->db->query($SQL2);
        //echo  $this->db->last_query()."<br>"; 
        $total_auditoria = $query2->row()->tot;
        return ($total_ventas==$total_auditoria)?0:1;
    }
    public function base_model_valida_ventas_promocion($VentaPromocionId){
        $promociones = $this->base_model_promocion($VentaPromocionId);
        $SQL = "SELECT COUNT(Ventas.VentaId) AS tot FROM Ventas WHERE VentaTienePromocion = 1 AND (Ventas.VentaFechaBaja IS NULL) AND Ventas.VentaFechaRegistro>='".$promociones->VentaPromocionFechaInicio."T00:00:00' AND Ventas.VentaFechaRegistro<='".$promociones->VentaPromocionFechaFin."T23:59:59'";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row()->tot;
    }
    public function base_model_valida_ventas_auditorias_promocion($VentaPromocionId){
        $promociones = $this->base_model_promocion($VentaPromocionId);
        $SQL1 = "SELECT COUNT(VentaId) tot FROM Ventas WHERE VentaTienePromocion = 1 AND VentaFechaBaja IS NULL AND Ventas.VentaFechaRegistro>='".$promociones->VentaPromocionFechaInicio."T00:00:00' AND Ventas.VentaFechaRegistro<='".$promociones->VentaPromocionFechaFin."T23:59:59'";
        $query1	= $this->db->query($SQL1);
//        echo  $this->db->last_query()."<br>"; 
        $total_ventas = $query1->row()->tot;
        $SQL2 = "SELECT COUNT(Ventas.VentaId) AS tot FROM Ventas LEFT OUTER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId WHERE Ventas.VentaTienePromocion = 1 AND (Ventas.VentaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaId IS NOT NULL) AND Ventas.VentaFechaRegistro>='".$promociones->VentaPromocionFechaInicio."T00:00:00' AND Ventas.VentaFechaRegistro<='".$promociones->VentaPromocionFechaFin."T23:59:59'";
        $query2	= $this->db->query($SQL2);
//        echo  $this->db->last_query()."<br>"; 
        $total_auditoria = $query2->row()->tot;
        return ($total_ventas==$total_auditoria)?0:1;
    }
    public function base_model_promocion($VentaPromocionId) {
        $SQL = "SELECT VentaPromocionId,VentaPromocionNombre,VentaPromocionFechaRegistro,VentaPromocionFechaBaja,VentaPromocionFechaInicio,VentaPromocionFechaFin,UsuarioIdCapturo FROM VentasPromociones WHERE VentaPromocionId = $VentaPromocionId";
        $query	= $this->db->query($SQL);
//        echo  $this->db->last_query()."<br>"; 
        return $query->row();
    }
    public function base_model_guarda_cortes($tipo,$CorteAnio,$CorteMes,$id=0){
        $SQL = "INSERT INTO Cortes (CorteTipoId,CorteAnio,CorteMes,CorteIdOtro,CorteUsuarioIdRegistro) VALUES ($tipo,$CorteAnio,$CorteMes,$id,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")"; $query = $this->db->query($SQL);
        $query2 = $this->db->query("SELECT IDENT_CURRENT('Cortes') as last_id");  $res = $query2->result();  $lastId = $res[0]->last_id; 
        return $lastId;
    }
    public function base_model_guarda_cortes_detalle($tabla,$data){
        switch ($tabla) {
            case "CortesGanadores": $SQL = "INSERT INTO CortesGanadores (CorteId,CorteGanadorAnio,CorteGanadorMes,CorteGanadorPremioLugar,CorteGanadorTotalSumaVentas,CorteGanadorTotalCuentaVentas,DistribuidorId,RecompensaTipoId,DistribuidorDetalleCodigo,DistribuidorDetalleNombreComercial,TarjetaId,UsuarioId,UsuarioNombre,CorteGanadorUsuarioIdRegistro,CorteGanadorUsuarioNombreRegistro) VALUES ($data,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",'".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_nombre'))."')";  break;
            case "CortesPromocionesVentas": $SQL = "INSERT INTO CortesPromocionesVentas (CorteId,CortePromocionVentaTarjetaId,CortePromocionVentaVentaId,CortePromocionVentaUsuarioDetalleId,CortePromocionVentaUsuarioId,CortePromocionVentaNombreMaestroPintor,CortePromocionVentaDistribuidorDetalleId,CortePromocionVentaDistribuidorId,CortePromocionVentaDistribuidorDetalleCodigo,CortePromocionVentaDistribuidorDetalleRazonSocial,CortePromocionVentaDistribuidorDetalleNombreComercial,CortePromocionVentaVentaNumeroTicket,CortePromocionVentaVentaMontoTicket,CortePromocionVentaVentaDetalleMonto,CortePromocionVentaVentaDetalleCantidad,CortePromocionVentaVentaDetalleLitros,CortePromocionVentaPromociones,CortePromocionVentaMes,CortePromocionVentaVentaEstatus,CortePromocionVentaVentaAuditoriaEstatusId,CortePromocionVentaVentaAuditoriaEstatusDescripcion,CortePromocionVentaVentaFechaRegistro,CortePromocionVentaUsuarioIdRegistro) VALUES ($data,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")"; break;
            case "CortesPromocionesMaestrosPintores": $SQL = "INSERT INTO CortesPromocionesMaestrosPintores(CorteId,CortePromocionMaestroPintorDistribuidorDetalleId,CortePromocionMaestroPintorDistribuidorId,CortePromocionMaestroPintorDistribuidorDetalleCodigo,CortePromocionMaestroPintorDistribuidorDetalleRazonSocial,CortePromocionMaestroPintorDistribuidorDetalleNombreComercial,CortePromocionMaestroPintorUsuarioDetalleId,CortePromocionMaestroPintorUsuarioId,CortePromocionMaestroPintorMaestroPintor,CortePromocionMaestroPintorCantidadTickets,CortePromocionMaestroPintorVentaMontoTicket,CortePromocionMaestroPintorVentaDetalleMonto,CortePromocionMaestroPintorVentaDetalleCantidad,CortePromocionMaestroPintorVentaDetalleLitros,ReposicionProductoGanadorPremioLugar,CortePromocionMaestroPintorUsuarioIdRegistro) VALUES ($data,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")"; break;
            case "CortesPromocionesDistribuidores": $SQL = "INSERT INTO CortesPromocionesDistribuidores (CorteId,CortePromocionDistribuidorDistribuidorDetalleId,CortePromocionDistribuidorDistribuidorId,CortePromocionDistribuidorDistribuidorDetalleCodigo,CortePromocionDistribuidorDistribuidorDetalleRazonSocial,CortePromocionDistribuidorDistribuidorDetalleNombreComercial,CortePromocionDistribuidorCantidadTicktes,CortePromocionDistribuidorVentaMontoTicket,CortePromocionDistribuidorVentaDetalleMonto,CortePromocionDistribuidorVentaDetalleCantidad,CortePromocionDistribuidorVentaDetalleLitros,CortePromocionDistribuidorGanador,CortePromocionDistribuidorUsuarioIdRegistro) VALUES ($data,".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")"; break;
            case "CortesCambioEstatusVentasAuditoria": $SQL = "INSERT INTO CortesCambioEstatusVentasAuditoria (CortesCambioEstatusVentaAuditoriaUsuarioIdRegistro,CorteId,VentaId,TarjetaId,TarjetaNumero,VentaUsuarioIdMP,VentaUsuarioNombreMP,DistribuidorId,DistribuidorDetalleId,DistribuidorDetalleCodigo,DistribuidorDetalleRazonSocial,DistribuidorDetalleNombreComercial,UsuarioDetalleId,VentaNumeroTicket,VentaMontoTicket,VentaFotoTicket,VentaFechaRegistro,VentaUsuarioIdRegistro,VentaUsuarioNombreRegistro,VentaFechaBaja,VentaUsuarioIdBaja,VentaTienePromocion,VentaSessionId) $data"; break;
            case "CortesBimestralesVentas": $SQL = "INSERT INTO CortesBimestralesVentas (CorteId,CorteBimestralVentaTarjetaId,CorteBimestralVentaVentaId,CorteBimestralVentaUsuarioDetalleId,CorteBimestralVentaUsuarioIdMP,CorteBimestralVentaNombreMaestroPintor,CorteBimestralVentaUsuarioIdMPEstatus,CorteBimestralVentaDistribuidorDetalleId,CorteBimestralVentaDistribuidorId,CorteBimestralVentaDistribuidorDetalleCodigo,CorteBimestralVentaDistribuidorDetalleRazonSocial,CorteBimestralVentaDistribuidorDetalleNombreComercial,CorteBimestralVentaDistribuidorDetalleRegionId,CorteBimestralVentaDistribuidorDetalleRegionNombre,CorteBimestralVentaDistribuidorDetalleEstatus,CorteBimestralVentaVentaNumeroTicket,CorteBimestralVentaVentaMontoTicket,CorteBimestralVentaMes,CorteBimestralVentaVentaEstatus,CorteBimestralVentaVentaEstatusAuditoria,CorteBimestralVentaFechaRegistro,CorteBimestralVentaUsuarioIdCorte) $data"; break;
            case "CortesBimestralesMaestrosPintores": $SQL = "INSERT INTO CortesBimestralesMaestrosPintores (CorteId,CorteBimestralMaestroPintorDistribuidorDetalleId,CorteBimestralMaestroPintorDistribuidorId,CorteBimestralMaestroPintorDistribuidorDetalleCodigo,CorteBimestralMaestroPintorDistribuidorDetalleRazonSocial,CorteBimestralMaestroPintorDistribuidorDetalleNombreComercial,CorteBimestralMaestroPintorDistribuidorEstatus,CorteBimestralMaestroPintorDistribuidorDetalleRegionId,CorteBimestralMaestroPintorDistribuidorDetalleRegionNombre,CorteBimestralMaestroPintorUsuarioDetalleIdMP,CorteBimestralMaestroPintorUsuarioIdMP,CorteBimestralMaestroPintorMaestroPintor,CorteBimestralMaestroPintorEstatusMaestroPintor,CorteBimestralMaestroPintorCantidadTickets,CorteBimestralMaestroPintorVentaMontoTicket,ReposicionProductoGanadorPremioLugar,CorteBimestralMaestroPintorUsuarioIdRegistroCorte) $data"; break;
            case "CortesBimestralesPerfiles": $SQL = "INSERT INTO CortesBimestralesPerfiles (CorteId,CortesBimestralPerfilDistribuidorDetalleId,CortesBimestralPerfilDistribuidorId,CortesBimestralPerfilDistribuidorDetalleCodigo,CortesBimestralPerfilDistribuidorDetalleRazonSocial,CortesBimestralPerfilDistribuidorDetalleNombreComercial,CortesBimestralPerfilDistribuidorDetalleRegionId,CortesBimestralPerfilDistribuidorDetalleRegionNombre,CortesBimestralPerfilDistribuidorEstatus,CortesBimestralPerfilDetalleUsuarioIdRegistro,CortesBimestralPerfilDetalleUsuarioRegistroNombre,CortesBimestralPerfilDistribuidorPerfilId,CortesBimestralPerfilDistribuidorPerfilDescripcion,CortesBimestralPerfilDetalleUsuarioRegistroEstatus,CortesBimestralPerfilDistribuidorCantidadTicktes,CortesBimestralPerfilDistribuidorVentaMontoTicket,CortesBimestralPerfilDistribuidorUsuarioIdRegistroCorte) $data"; break;
            case "CortesBimestralesDistribuidores": $SQL = "INSERT INTO CortesBimestralesDistribuidores (CorteId,CorteBimestralDistribuidorDistribuidorDetalleId,CorteBimestralDistribuidorDistribuidorId,CorteBimestralDistribuidorDistribuidorDetalleCodigo,CorteBimestralDistribuidorDistribuidorDetalleRazonSocial,CorteBimestralDistribuidorDistribuidorDetalleNombreComercial,CorteBimestralDistribuidorDistribuidorDetalleRegionId,CorteBimestralDistribuidorDistribuidorDetalleRegionNombre,CorteBimestralDistribuidorDistribuidorEstatus,CorteBimestralDistribuidorCantidadTicktes,CorteBimestralDistribuidorVentaMontoTicket,CorteBimestralDistribuidorUsuarioIdRegistroCorte) $data"; break;
        }
        $query	= $this->db->query($SQL);
        return 1;
    }   
}