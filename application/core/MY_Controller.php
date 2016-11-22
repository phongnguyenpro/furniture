<?php

class MY_Controller extends CI_Controller
{

    public function __construct($name_controller, $type = null)
    {
        parent::__construct();
        $this->load->helper(array("myfunction"));


        $this->load->library("mydb");

        if ($type == "admin") {
            if (file_exists($file_path = APPPATH . "models/adminsecurity/" . $name_controller . '_model.php')) {
                $this->load->model("adminsecurity/" . $name_controller . '_model', 'model');
            }
            // kiểm tra quyền user theo controller và function
            $this->load->library("adminsecurity");
            $this->adminsecurity->mydb = $this->mydb;
            $this->adminsecurity->checkrole();
            $this->data["menu_item"] = $this->adminsecurity->menu_item();

            load_config(array("CACHE", "URLANHCHEN"));
        } else {
            if (file_exists($file_path = APPPATH . "models/" . $name_controller . '_model.php')) {
                $this->load->model($name_controller . '_model', 'model');
            }
            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

            load_config(array("CACHE", "LIMITDANHMUCIT", "LIMITDANHMUCNHIEU", "TENSHOP", "EMAIL", "LOGO", "SDT", "DIACHI", "WIDTHTHUMB"));
        }
    }


}
