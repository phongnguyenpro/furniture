<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class UserGroup extends MY_Controller {

    public function __construct() {
        parent::__construct("UserGroup", "admin");
    }

    function index() {
        $this->data["usergroup"] = $this->model->loadusergroup();
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/usergroup/index");
        $this->load->view("adminsecurity/footer");
    }

    function insert() {
        $data = array("menu_parent" => 0);
        foreach ($_POST['data'] as $key => $value) {

            $data[$value['name']] = $value['value'];
        }
        echo json_encode($this->model->insert($data));
    }

    function update() {
        $data = $_POST;
        echo json_encode($this->model->update($data));
    }

    function delete() {
        $id = $_POST['id'];
        echo json_encode($this->model->delete($id));
    }

    function load_menu_edit() {
        $id = $_POST['id'];
        echo json_encode($this->model->load_menu_edit($id));
    }

    function sort_menu() {
        $this->model->menu_update_sort($_POST["menu"]);
    }

}
