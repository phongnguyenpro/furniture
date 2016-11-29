<?php

class Module extends MY_Controller {

    public function __construct() {
        parent::__construct("Module", "admin");
    }

    function index() {

        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/module/index");
        $this->load->view("adminsecurity/footer");
    }

    function detail($page) {
        $this->data["module"] = $this->model->detail($page);
        $this->data["page"] = $page;
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/module/detail");
        $this->load->view("adminsecurity/footer");
    }

    function insert() {
        $this->model->insert($_POST);
    }

    function config() {
        $type = $_POST["type"];
        $id_module = $_POST["id_module"];
        $this->data = $this->model->config($type, $id_module);
        switch ($type) {
            case "slider":
                $this->load->view("adminsecurity/module/config/slider");
                break;
            case "banner":
                $this->load->view("adminsecurity/module/config/slider");
                break;
            case "product":
                $this->load->view("adminsecurity/module/config/product");
                break;
        }
    }

    function update() {

        $type = $_POST["module_type"];
        $data_update=$_POST;
        switch ($type) {
            case "slider":
                $this->load->model("module/slider_model");
                $this->slider_model->update($data_update);
                break;
            case "banner":
                $this->load->model("module/slider_model");
                $this->slider_model->update($data_update);
                break;
             case "product":
                $this->load->model("module/product_model");
                $this->product_model->update($data_update);
                break;
        }
        $this->model->update($data_update);
    }

    function delete($module_id) {
        $this->model->delete($module_id);
    }

}
