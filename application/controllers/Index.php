<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Index extends MY_Controller {

    public function __construct() {
        parent::__construct("Index");
    }
 
    function home()
    {
        $this->load->library("module");
        $this->module->mydb = $this->mydb;
        
        
        $this->data["category"] = $this->module->category();
        $this->load->view("shop/header");
        
        
    }
}