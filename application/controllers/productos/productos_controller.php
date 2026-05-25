<?php
class Productos_controller extends Base_Controller {
    public function __construct(){         
        parent::__construct();
    }    
    public function index(){//Pagina de Inicio
        $this->base_controller_create_view_sistema('productos/productos_view');
    }
}