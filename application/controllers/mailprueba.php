<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mailprueba extends Base_Controller {
    public function __construct(){parent::__construct(); }    
    public function index(){//Pagina de Inicio
        $to         = array('to' => 'luis.rangel@strategix.com.mx','cc' => 'patricia.carteno@strategix.com.mx','bcc'=>'');
        $this->base_controller_envio_correos($to, 'Correo de prueba CDP brasil  - '. funciones_strategix_fecha_hora_actual(), 'Este es un correo de prueba sencillo para validar que si se estan enviando.','');
    }
}    