<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ventas_promociones_cargas_model extends Base_Model {	
    public function __construct(){
        parent::__construct();
    }
    public function ventas_promociones_cargas_model_insert($cargaId,$txt_promocion,$fecha_inicio,$fecha_final){
        $SQL1 = "INSERT INTO VentasPromociones (VentaPromocionNombre,VentaPromocionFechaInicio,VentaPromocionFechaFin,UsuarioIdCapturo) VALUES ('$txt_promocion','$fecha_inicio','$fecha_final',".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).")";
        $this->db->query($SQL1);
        $query2 = $this->db->query("SELECT IDENT_CURRENT('VentasPromociones') as last_id");  $res = $query2->result();  $lastId = $res[0]->last_id; 
        $SQL2 = "INSERT INTO VentasPromocionesDetalles (VentaPromocionId,VentaPromocionDetalleGMC,VentaPromocionDetalleCodigo,VentaPromocionDetalleDescripcion,VentaPromocionDetallePresentacion) SELECT $lastId,CargaVentaPromocionDetalleGMC,CargaVentaPromocionDetalleCodigo,CargaVentaPromocionDetalleDescripcion,CargaVentaPromocionDetallePresentacion FROM CargasVentasPromocionesDetalles WHERE CargaId =$cargaId";
        $this->db->query($SQL2);
        return 1;
    }    
    public function ventas_promociones_cargas_model_obtener_tabla()
    {
        $SQL = "select 
                VentaPromocionDetalleId,
                VentaPromocionNombre,                
                VentaPromocionDetalleGMC,
                VentaPromocionDetalleCodigo,
                VentaPromocionDetalleDescripcion,
                VentaPromocionDetallePresentacion,
                VentaPromocionFechaInicio,
                VentaPromocionFechaFin,
                VentaPromocionDetalleFechaBaja
                from VentasPromocionesDetalles vpd
                inner join VentasPromociones vp on vp.VentaPromocionId = vpd.VentaPromocionId";
        $query = $this->db->query($SQL);
        //        echo  $this->db->last_query()."<br>"; 
        return $query->result();
    }
    public function ventas_promociones_cargas_model_baja_datos($id) {
        $SQL = "UPDATE VentasPromocionesDetalles SET VentaPromocionDetalleFechaBaja = DATEADD(hour, 3, GETDATE()) WHERE VentaPromocionDetalleId = ".$id;
        $this->db->query($SQL);
        //echo  $this->db->last_query()."<br>"; 
        return 1;
    }
} 






