<?php

class MY_Model extends CI_Model {

    public function __construct($type = null) {
        parent::__construct();
        // thừa kế dữ liệu class parent, ko lấy dữ liệu của controller gọi nó
    }

}
