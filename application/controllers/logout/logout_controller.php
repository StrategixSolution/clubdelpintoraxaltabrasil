<?php

/* 
 * Sistema Web Responsivo CDPMEX                    *
 * @author	Strategic Solutions S.A. de C.V             * 
 * @programmer  Luis Felipe Rangel                          * 
 * @CreateDate 01 MARZO 2026 09:00:00                        * 
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout_controller extends Base_Controller {
    public function __construct(){ parent::__construct(); }
    public function index(){ $this->session->sess_destroy(); redirect('login'); }	
}