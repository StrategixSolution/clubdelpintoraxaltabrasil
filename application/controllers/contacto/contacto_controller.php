<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala
 * @author	Strategic Solutions S.A. de C.V  * 
 * @programmer  Luis Felipe Rangel  * 
 * @CreateDate 29 jun. 2022 23:35:28 * 
 */

class Contacto_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('contacto/contacto_view');
    }
}