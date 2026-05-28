<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inicio_controller extends Base_Controller {
    public function __construct(){ 
        parent::__construct();         
    }    
    public function index(){//Pagina de Inicio
        $pag = 'inicio/inicio_view';
        $this->base_controller_create_view_sistema($pag);
    }
}