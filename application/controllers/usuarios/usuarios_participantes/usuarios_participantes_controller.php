<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_participantes_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct();        
        valida_menus(get_class(),$this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')));
        $this->load->model('usuarios/usuarios_participantes/usuarios_participantes_model');
    }    
    public function index(){//Pagina de Inicio  
        $data['perfil'] = $this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'));
        $data['cuenta_tabla'] = 0;
        $pag = ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==6)?"usuarios/usuarios_participantes/usuarios_participantes_form_view":"usuarios/usuarios_participantes/usuarios_participantes_admin_form_view";
        $this->base_controller_create_view_sistema($pag,$data,true);
    }
     
    public function usuarios_participantes_controller_combo_perfil() {
        $cmbperfil ="<option  value='0'>".$this->lang->line('usuarios_participantes_controller_lang_select_perfiles')."</option>";
        $perfilesid="6,7,8"; 
        $perfiles         = $this->usuarios_participantes_model->usuarios_participantes_model_perfiles($perfilesid);
        foreach ($perfiles as $perfil) {            
             $cmbperfil .="<option value=$perfil->PerfilId>$perfil->PerfilDescripcion</option>";
        }
        echo json_encode($cmbperfil);
    }    
    public function usuarios_participantes_controller_combo_distribuidoras() {   
     
       $where = $cmbdistribuidora= "";
        if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id')) == 7){
            $distribuidorid = $this->usuarios_participantes_model->usuarios_participantes_model_get_usuario_comercio($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')));
            $where .= "AND Distribuidores.DistribuidorId = $distribuidorid->DistribuidorId ";
        }else{
            $where .= "";
            $cmbdistribuidora ="<option  value='0'>".$this->lang->line('usuarios_participantes_controller_lang_select_distribuidoras')."</option>";
        }
        $distribuidoras         = $this->usuarios_participantes_model->usuarios_participantes_model_distribuidoras($where);
        foreach ($distribuidoras as $distribuidora) {            
                $cmbdistribuidora .="<option value=$distribuidora->DistribuidorId>".$distribuidora->DistribuidorDetalleCodigo." ".utf8_encode(strtoupper($distribuidora->DistribuidorDetalleRazonSocial))."</option>";
            }        
        echo json_encode($cmbdistribuidora);
    }
    public function usuarios_participantes_controller_buscar_tabla() {
        $lista=$nombre=$where="";$idParticipante = md5('IDCDP'.funciones_strategix_formato_fecha_actual());
        if ($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==6){
            $where .= " AND UsuariosDistribuidores.DistribuidorId = ".$this->usuarios_participantes_model->usuarios_participantes_model_usuario_comercio($this->session->userdata(funciones_strategix_sitio_alias('s_usuario_id')))->DistribuidorId;
            $where .= " AND Usuarios.PerfilId in (7,8)";            
        } else {
            $distribuidora  = $this->input->post('cmb_distribuidoras',TRUE);
            $perfil         = $this->input->post('cmb_perfil',TRUE);
            $cmb_estatus    = $this->input->post('cmb_estatus',TRUE);            
            $where .= ($distribuidora!=0)?" AND UsuariosDistribuidores.DistribuidorId = $distribuidora":"";
             if($this->session->userdata(funciones_strategix_sitio_alias('s_perfil_id'))==6){
                  $where .= ($perfil!=0)?" AND Usuarios.PerfilId = $perfil":" AND Usuarios.PerfilId in (7,8)";
            }else{
              $where .= ($perfil!=0)?" AND Usuarios.PerfilId = $perfil":" AND Usuarios.PerfilId in (6,7,8)";
            }   
            switch ($cmb_estatus) {
                case 1: $where .= " AND (UsuarioFechaBajaParticipante IS NULL) AND (UsuarioFechaBajaDistribuidora IS NULL) "; break;
                case 2: $where .= " AND (UsuarioFechaBajaParticipante IS NOT NULL OR UsuarioFechaBajaDistribuidora IS NOT NULL)"; break;
            }            
        }        
        $participantes       = $this->usuarios_participantes_model->usuarios_participantes_model_tabla($where);
        foreach ($participantes as $participante) {      
            $nombre = utf8_encode(strtoupper($participante->UsuarioDetalleNombre));
            if ($participante->UsuarioFechaBajaParticipante=="" AND $participante->UsuarioFechaBajaDistribuidora==""){
                $estatus = $this->lang->line('usuarios_participantes_controller_lang_tabla_estatus_activo');
            } else {
                $estatus = $this->lang->line('usuarios_participantes_controller_lang_tabla_estatus_baja');
            }
            $lista.= '<tr id="id-usuario-td-'.$participante->UsuarioId.'">                        
                        <td>'.utf8_encode(strtoupper($participante->DistribuidorDetalleCodigo)).'</td>                        
                        <td>'.utf8_encode(strtoupper($participante->DistribuidorDetalleRazonSocial)).'</td>                        
                        <td>'.utf8_encode(strtoupper($participante->DistribuidorDetalleNombreComercial)).'</td>                        
                        <td>'.utf8_encode(strtoupper($participante->DistribuidorDetalleRegistroFederal)).'</td>
                        <td>'.utf8_encode(strtoupper($participante->DistribuidorDetalleInscripcionEstatal)).'</td>
                        <td>'.utf8_encode(strtoupper($participante->UsuarioDetalleNombre)).'</td>
                        <td>'.utf8_encode(strtoupper($participante->UsuarioDetalleRFC)).'</td>                        
                        <td>'.utf8_encode($participante->UsuarioDetalleEmail).'</td>
                        <td>'.utf8_encode(strtoupper($participante->UsuarioDetalleCelular)).'</td>
                        <td>'.utf8_encode(strtoupper($participante->PerfilDescripcion)).'</td>
                        <td id="idstatus'.$participante->UsuarioId.'">'.$estatus.'</td>';
                    if ($participante->UsuarioFechaBajaParticipante=="" AND $participante->UsuarioFechaBajaDistribuidora==""){
                        $lista.= '<td class="txt-center"  id="idmodus'.$participante->UsuarioId.'"><a href="'.funciones_strategix_version_url_random_base_url("UsuariosParticipantesModificacion")."&$idParticipante=".$participante->UsuarioId.'"><i class="fas fa-edit"></i></a></td>
                                   <td class="txt-center" id="idbajaus'.$participante->UsuarioId.'"><a href="javascript:usuarios_participantes_tabla_view_js_eliminar('.$participante->UsuarioId.',\''.$nombre.'\')"><i class="fas fa-trash"></i></td>                                                        
                                    </tr>' ;
                    } else {
                        $lista.=    '<td class="txt-center"></td>
                                   <td class="txt-center"></td>                                                        
                                    </tr>' ;
                    }
        }
        $data['tabla'] = $lista;
        $tabla_participante['tabla'] = $this->load->view('usuarios/usuarios_participantes/usuarios_participantes_tabla_view', $data, true);
        echo json_encode($tabla_participante);
    }    
    public function usuarios_participantes_controller_usuario_baja() {
        $usuarioId = $this->input->post('usuarioId',TRUE);
        $data['idUsuario'] = $this->input->post('usuarioId',TRUE);
        $data['status']        = $this->lang->line('usuarios_participantes_controller_lang_tabla_estatus_baja');
        $data['resultado']        = '1';
        $resultado_baja = $this->usuarios_participantes_model->participante_model_baja_usuario($usuarioId);
        if ($resultado_baja==1){echo json_encode($data); } else { echo 0; }
    }
}
