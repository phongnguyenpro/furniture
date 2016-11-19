<?php

class MY_Model extends CI_Model {

    public function __construct($type = null) {
        parent::__construct();
        $CI = & get_instance();
        if (!isset($CI->mydb)) {
            $this->load->library("mydb");
        }
    }

}
