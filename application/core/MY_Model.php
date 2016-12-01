<?php

class MY_Model extends CI_Model {

    public function __construct($type = null) {
        parent::__construct();
       
    }

    public function error(){
        Header("Location:" . BASE_URL . "error");
        die();
    }

}
