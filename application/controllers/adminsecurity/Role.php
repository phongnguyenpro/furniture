<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Role extends MY_Controller
{

    public function __construct()
    {
        parent::__construct("Role", "admin");
    }

    public function index()
    {
        $role_current = 'administrator';
        if (isset($_POST['role_current']) || isset($_POST['role_not_update'])) {
            if (!isset($_POST["role_not_update"])) {
                $role_current = $_POST['role_current'];
                $this->update($_POST);
            } else
                $role_current = $_POST['role_not_update'];
        }
        $this->load->helper(array("mydata"));
        $this->data["get_role"] = $this->adminsecurity->get_role($role_current);
        $this->data["list_role"] = $this->adminsecurity->list_role();

        $this->data["role_current"] = $role_current;


        $this->load->view('adminsecurity/header');
        $this->load->view('adminsecurity/role/index');
        $this->load->view('adminsecurity/footer');

    }

    public function update($data)
    {
        $this->model->update($data);

    }
}
