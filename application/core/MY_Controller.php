<?php

class MY_Controller extends CI_Controller {

    public function __construct($name_controller, $type = null) {
        parent::__construct();
        $this->load->helper(array("myfunction"));
     
        if ($type == "admin") {
               if (file_exists($file_path = APPPATH . "models/adminsecurity/" . $name_controller . '_model.php')) {
            $this->load->model("adminsecurity/".$name_controller . '_model', 'model');
        }
            // kiểm tra quyền user theo controller và function
            $this->load->library("adminsecurity");
            $this->adminsecurity->checkrole();
            $this->data["menu_item"] = $this->adminsecurity->menu_item();
        }
    }
    

}
