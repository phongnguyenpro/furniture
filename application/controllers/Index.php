<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Index extends MY_Controller {

    public function __construct() {
        parent::__construct("Index");
    }

    function home() {
        $this->load->model(array("module_model"));
        $this->data["category"] = $this->module_model->category();
        
        
    
      $this->load->view("shop/header");
 
            debug(1);
    }

}
