<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Index extends MY_Controller {

    public function __construct() {
        parent::__construct("Index");
    }

    function home(){
        $this->load->model(array("module_model"));
        $this->data["category"] = $this->module_model->category();
        $this->data["menu"] = $this->module_model->menu();
        $this->data["footer"] = $this->module_model->footer();
        $this->data["module"] = $this->module_model->run("home");
        $this->data["meta"] =array("title"=>TENSHOP,"description"=>MIEUTA,"image"=>BASE_URL.LOGO);
        $this->data["home"]=true;
        $this->data["product"]=$this->model->index();
        $this->data['footer'] = $this->module_model->footer();
        $this->load->view( THEME."/header");
        $this->load->view( THEME."/index/home");
        $this->load->view(THEME."/footer");
    }



}
