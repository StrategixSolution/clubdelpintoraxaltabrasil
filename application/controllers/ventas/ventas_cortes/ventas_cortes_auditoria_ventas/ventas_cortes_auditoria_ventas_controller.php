<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_cortes_auditoria_ventas_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct();        
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('ventas/ventas_cortes/ventas_cortes_auditoria_ventas/ventas_cortes_auditoria_ventas_model');
    }    
    public function index(){//Pagina de Inicio 
        $data['sub_menu'] = ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==3)?$this->load->view('template/sistema/sub_menu/sub_menu_productos_reposicion_axalta', '', TRUE):$this->load->view('template/sistema/sub_menu/sub_menu_ventas_cortes', '', TRUE); 
        $this->base_controller_create_view_sistema('ventas/ventas_cortes/ventas_cortes_auditoria_ventas/ventas_cortes_auditoria_ventas_view_form',$data);
    }
    public function  ventas_cortes_auditoria_ventas_controller_combo_anio() {
        $cmbAnio ="<option  value='0'>".$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_placeholder_anio')."</option>";
        $anios  = $this->ventas_cortes_auditoria_ventas_model->ventas_cortes_auditoria_ventas_model_combo_anio();
        foreach ($anios as $anio) {            
            $cmbAnio .="<option value=$anio->anio>$anio->anio</option>";
        }
        echo json_encode($cmbAnio);
    }
    public function  ventas_cortes_auditoria_ventas_controller_combo_mes() {
        $cmbAnio = $this->input->post('anio',true);
        $cmbMes ="<option  value='0'>".$this->lang->line('ventas_cortes_auditoria_ventas_controller_lang_placeholder_mes')."</option>";
        $meses  = $this->ventas_cortes_auditoria_ventas_model->ventas_cortes_auditoria_ventas_model_combo_mes($cmbAnio);
        foreach ($meses as $mes) {            
            $cmbMes .="<option value=$mes->mes>".strtoupper(funciones_strategix_mes_numero_texto($mes->mes))."</option>";
        }
        echo json_encode($cmbMes);
    }
    public function ventas_cortes_auditoria_ventas_controller_valida_corte() {
        $anio = $this->input->post('anio',true); $mes = $this->input->post('mes',true);
        ($this->base_controller_valida_corte(1, $anio, $mes,'')==0)? $res = 1: $res = 0;
        echo json_encode($res);
    }
    public function ventas_cortes_auditoria_ventas_controller_corte_auditoria() {   
        $anio = $this->input->post('anio',true); $mes = $this->input->post('mes',true);$dato[]=array();
        if ($this->base_controller_valida_corte(1, $anio, $mes,'')!=0){ $dato['res']   = 2;  echo json_encode($dato); return false;}
        if ($this->ventas_cortes_auditoria_ventas_model->ventas_cortes_auditoria_ventas_model_valida_auditoria($anio, $mes)==0){$dato['res']   = 3;  echo json_encode($dato); return false;}
        $CorteId = $this->base_controller_guarda_corte(1,$anio, $mes,0);
        $data = "".$this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')).",".$CorteId.",Ventas.VentaId, Ventas.TarjetaId, Ventas.VentaUsuarioIdMP,  Ventas.DistribuidorId, 
            Ventas.VentaNumeroTicket, Ventas.VentaMontoTicket, Ventas.VentaFotoTicket, Ventas.VentaFechaRegistro, Ventas.VentaUsuarioIdRegistro, Ventas.VentaFechaBaja, 
            Ventas.VentaUsuarioIdBaja, Ventas.VentaTienePromocion, Ventas.VentaSessionId FROM Ventas 
            INNER JOIN Tarjetas ON Ventas.TarjetaId = Tarjetas.TarjetaId 
            INNER JOIN DistribuidoresDetalles ON Ventas.DistribuidorId = DistribuidoresDetalles.DistribuidorId 
            LEFT JOIN UsuariosDetalles AS UsuariosMaestroPintor ON (Ventas.VentaUsuarioIdMP = UsuariosMaestroPintor.UsuarioId AND UsuariosMaestroPintor.UsuarioDetalleFechaBaja IS NULL) 
            LEFT JOIN UsuariosDetalles AS UsuariosRegistro ON Ventas.VentaUsuarioIdRegistro = UsuariosRegistro.UsuarioId 
            LEFT OUTER JOIN VentasAuditorias ON Ventas.VentaId = VentasAuditorias.VentaId
                    WHERE (VentasAuditorias.VentaAuditoriaFechaBaja IS NULL) AND (VentasAuditorias.VentaAuditoriaFechaActualizado IS NULL) AND (VentasAuditorias.VentaAuditoriaId IS NULL) AND (Ventas.VentaFechaBaja IS NULL) AND (YEAR(Ventas.VentaFechaRegistro) = $anio) 
                    AND (MONTH(Ventas.VentaFechaRegistro) = $mes)";
        $this->base_controller_guarda_corte_detalle('CortesCambioEstatusVentasAuditoria',$data);
        $this->ventas_cortes_auditoria_ventas_model->ventas_cortes_auditoria_ventas_model_crea_auditorias($anio, $mes,$CorteId);
        $dato['res']   = 1;  
        echo json_encode($dato);
    }
}
