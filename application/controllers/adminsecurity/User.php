<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct("User", "admin");
    }

    function index() {
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/user/index");
    }

    function load_data_ssp() {
        $this->model->load_data_ssp($_POST);
    }

    function insert() {
        if (isset($_POST["user_email"])) {
            $this->insert_post(generate_key("insert_post"));
        } else {
            $this->insert_view(generate_key("insert_view"));
        }
    }

    function insert_post($key) {
        if (generate_key("insert_post") == $key) {
            $data = $_POST;
            if ($this->model->insert($data)) {
                Header("Location:" . ADMIN_URL . "user/insert");
            }
        } else
            $this->error();
    }

    function insert_view($key) {
        if (generate_key("insert_view") == $key) {
            $this->data["user"] = $this->model->obj_user();
            $this->data["list_role"] = $this->model->list_role();
            $this->load->helper(array("mydata"));
            $this->load->view('adminsecurity/header');
            $this->load->view('adminsecurity/user/create');
            $this->load->view('adminsecurity/footer');
        } else
            $this->error();
    }

    function update($user_id = "") {
       
        if (isset($_POST["user_id"])) {
            $this->update_post($_POST["user_id"], generate_key("update_post"));
        } else {
            $this->update_view($user_id, generate_key("update_view"));
        }
    }

    function update_post($id_user, $key) {
        if (generate_key("update_post") == $key) {
            $data = $_POST;
            if ($this->model->update($data)) { 
                Header("Location:" . ADMIN_URL . "user/update/" . $data["user_id"]);
            }
        } else
            $this->error();
    }

    function update_view($id_user, $key) {
        if (generate_key("update_view") == $key) {
            $this->data["user"] = $this->model->obj_user($id_user);
            $this->data["list_role"] = $this->model->list_role($this->data["user"]["user_role"]);
            $this->load->helper(array("mydata"));
            $this->data["is_edit"] = TRUE;
            $this->load->view('adminsecurity/header');
            $this->load->view('adminsecurity/user/create');
            $this->load->view('adminsecurity/footer');
        }
    }
    
    function delete() {
        if(isset($_POST["user_id"]))
            echo json_encode ($this->model->delete($_POST["user_id"]));    
    }

}
