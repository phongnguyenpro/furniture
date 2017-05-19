<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Error extends MY_Controller {

    public function __construct() {
        parent::__construct("Index");
    }

    function index() {

        $this->load->model(array("module_model"));
        $this->data["category"] = $this->module_model->category();
        $this->data["menu"] = $this->module_model->menu();
        $this->data["footer"] = $this->module_model->footer();
        $this->data["meta"] = array("title" => TENSHOP, "description" => MIEUTA, "image" => BASE_URL . LOGO);
        $this->data["product"] = $this->model->index();
        $this->data['footer'] = $this->module_model->footer();
        $this->data['bre']["info"] = array("0"=>array("ten"=>"Trang không tồn tại"));
        $this->load->view(THEME . "/header");
        $this->load->view(THEME . "/error/index");
        $this->load->view(THEME . "/footer");
    }

}
