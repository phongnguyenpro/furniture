<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Login extends MY_Controller {

    public function __construct() {
        parent::__construct("Login", "admin");
    }

    public function index() {           
        if(isset($_COOKIE["user"]))
            Header("Location:".ADMIN_URL);
        else
        $this->load->view('adminsecurity/login/index');
    }

    function check_login() {
        if (check_post($_POST, array("email", "pass", "checksum", "token"))) {
            if (checksum($_POST)) {
                $email = string_input($_POST['email']);
                $pass = string_input($_POST['pass']);
                $this->load->model("adminsecurity/user_model");
                $data = $this->user_model->check_login_user($email, $pass);
                if ($data) {
                    // tao cookie
                    $user["user_id"] = $data["user_id"];
                    $user["user_email"] = $data["user_email"];
                    $user["user_name"] = $data["user_name"];
                    $user["user_avatar"] = $data["user_avatar"];
                    $user["user_password"] = $data["user_password"];
                    $user["user_role"] = $data["user_role"];
                    $user["user_role_name"] = $data["user_role_name"];
                    SetUserLogin($user);
                    echo json_encode(array("status" => 2));
                } else
                    echo json_encode(array("status" => 1, "message" => "Tài khoản hoặc mật khẩu chưa chính xác"));
            } else
                echo json_encode(array("status" => 0, "message" => "Lỗi xác thực, vui lòng tải lại trang"));
        } else
            echo json_encode(array("status" => 0, "message" => "Lỗi xác thực, vui lòng tải lại trang"));
    }

    function logout() {
        delete_cook("user");
        Header("Location:".ADMIN_URL."login");
    }

}
