<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Search extends MY_Controller {

    public function __construct() {
        parent::__construct("Search");
    }

    function index(){
 if(check_post($_POST,array("str","id_danhmuc")))
          {
          $str=  string_input($_POST['str']);
          $id_danhmuc=-1;
          if(isset($_POST['id_danhmuc']))
          $id_danhmuc=string_input($_POST['id_danhmuc']);
echo json_encode($this->model->index($str,$id_danhmuc));   

          }
    }
    
}