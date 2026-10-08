<?php
class Contacto_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('contacto/contacto_view');
    }
}