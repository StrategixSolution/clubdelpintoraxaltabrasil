<?php

/*
 * Sistema Web Responsivo CDPBR                            *
 * @author	Strategic Solutions S.A. de C.V             *
 * @programmer  Luis Felipe Rangel                          *
 * @CreateDate 01 ABRIL 2026 09:00:00                       *
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_cortes_ganadores_contoller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->uniqueId = md5(uniqid(rand(), TRUE));
        $this->load->model('ventas/ventas_cortes/ventas_cortes_ganadores/ventas_cortes_ganadores_model');
    }    
    public function index(){//Pagina de Inicio 
        $data['sub_menu'] = $this->load->view('template/sistema/sub_menu/sub_menu_ventas_cortes', '', TRUE); 
        $this->base_controller_create_view_sistema('ventas/ventas_cortes/ventas_cortes_ganadores/ventas_cortes_ganadores_form_view',$data);
    }
    public function ventas_cortes_ganadores_contoller_combo_anio() {
        $cmb_anio ="<option  value='0'>".$this->lang->line('ventas_cortes_ganadores_contoller_lang_placeholder_anio')."</option>";
        $anios  = $this->ventas_cortes_ganadores_model->ventas_cortes_ganadores_model_combo_anio();
        foreach ($anios as $anio) {            
            $cmb_anio .="<option value=$anio->anio>$anio->anio</option>";
        }
        echo json_encode($cmb_anio);
    }
    public function ventas_cortes_ganadores_contoller_combo_mes() {
        $cmbAnio = $this->input->post('anio',true);
        $mes = date('m');
        $cmb_mes ="<option  value='0'>".$this->lang->line('ventas_cortes_ganadores_contoller_lang_placeholder_mes')."</option>";     
        $meses  = $this->ventas_cortes_ganadores_model->ventas_cortes_ganadores_model_combo_mes($cmbAnio);
        foreach ($meses as $mes) {            
            $bimestre = $mes->mes; $par = $bimestre%2;$mesanterior = $bimestre-1;
            if(($par)==0){ $cmb_mes .="<option value=$mes->mes>".strtoupper(funciones_strategix_mes_numero_texto($mesanterior)).' - '.strtoupper(funciones_strategix_mes_numero_texto($bimestre))."</option>"; }
        }        
        echo json_encode($cmb_mes);
    }
    public function ventas_cortes_ganadores_contoller_corte() {
        $cmb_anio = $this->input->post('anio',true);
        $cmb_mes = $this->input->post('mes',true);
        $mes_anterior = $cmb_mes - 1; $lista = '';
        if ($this->ventas_cortes_ganadores_contoller_valida_corte($cmb_anio,$cmb_mes)==1){ $data['res'] = 1; echo json_encode($data); return false;}
        if ($this->ventas_cortes_ganadores_contoller_valida_ventas($cmb_anio,$cmb_mes,$mes_anterior)==0){ $data['res'] = 2; echo json_encode($data); return false;}
        if ($this->ventas_cortes_ganadores_contoller_valida_auditoria($cmb_anio,$cmb_mes,$mes_anterior)==1){ $data['res'] = 3; echo json_encode($data); return false;}
        $corte_id = $this->base_controller_guarda_corte(2,$cmb_anio,$cmb_mes,0);
        $ventas_acumuladas  = $this->ventas_cortes_ganadores_model->ventas_cortes_ganadores_model_ganadores($cmb_anio,$cmb_mes,$mes_anterior);
        foreach ($ventas_acumuladas as $row) {
            $recompensas = $this->ventas_cortes_ganadores_model->ventas_cortes_ganadores_model_recompensas($cmb_anio,$cmb_mes,$row->suma_monto);
            if (!empty($recompensas)){ 
                $lugar = $recompensas->RecompensaPremioLugar; 
                $data_corte_ganadores = "$corte_id,$cmb_anio,$cmb_mes,$lugar,".$row->suma_monto.",".$row->cuenta_ventas.",".$row->DistribuidorId.",".$recompensas->RecompensaTipoId.",'".$row->DistribuidorDetalleCodigo."','".$row->DistribuidorDetalleNombreComercial."',".$row->TarjetaId.",".$row->VentaUsuarioIdMP.",'".$row->VentaUsuarioNombreMP."'";
                $this->base_controller_guarda_corte_detalle("CortesGanadores",$data_corte_ganadores);
                $data_reposiciones_productos_ganadores = "$cmb_anio,$cmb_mes,$lugar,".$row->suma_monto.",".$row->cuenta_ventas.",'GENERACION GANADORES',".$row->DistribuidorId.",'".$row->DistribuidorDetalleCodigo."','".$row->DistribuidorDetalleNombreComercial."',".$row->TarjetaId.",".$recompensas->RecompensaTipoId.",".$row->UsuarioId.",'".$row->VentaUsuarioNombreMP."'";
                $this->ventas_cortes_ganadores_model->ventas_cortes_ganadores_model_reposiciones_productos_ganadores($data_reposiciones_productos_ganadores);
            $lista.= '<tr>
                        <td>'.$cmb_anio.'</td>
                        <td>'.$cmb_mes.'</td>
                        <td>'.$lugar.'</td>
                        <td>'.number_format($row->suma_monto,2).'</td>
                        <td>'.$row->cuenta_ventas.'</td>
                        <td>'.$row->TarjetaNumero.'</td>
                        <td>'.$row->DistribuidorDetalleCodigo.'</td>
                        <td>'.utf8_encode(strtoupper($row->DistribuidorDetalleNombreComercial)).'</td>
                        <td>'.utf8_encode(strtoupper($row->VentaUsuarioNombreMP)).'</td>
                    </tr>' ;
            }            
        }
        $this->ventas_cortes_ganadores_model->ventas_cortes_ganadores_model_reposiciones_control_modulo(1);
        $dato['tabla']=$lista;
        $data['res'] = 4;
        $data['tabla'] = $this->load->view('ventas/ventas_cortes/ventas_cortes_ganadores/ventas_cortes_ganadores_tabla_view', $dato, true);
        echo json_encode($data);
    }
    public function ventas_cortes_ganadores_contoller_valida_corte($cmb_anio,$cmb_mes) {
        return $this->base_controller_valida_corte(2,$cmb_anio,$cmb_mes);
    }
    public function ventas_cortes_ganadores_contoller_valida_ventas($cmb_anio,$cmb_mes,$mes_anterior) {
        return $this->base_controller_valida_ventas($cmb_anio,$cmb_mes,$mes_anterior);
    }      
    public function ventas_cortes_ganadores_contoller_valida_auditoria($cmb_anio,$cmb_mes,$mes_anterior) {
        return $this->base_controller_valida_ventas_auditoria($cmb_anio,$cmb_mes,$mes_anterior);
    }
}
