<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 //$CI = &get_instance();
class Login extends MY_Controller {

    public function __construct()
  {
      parent::__construct("Login","admin");
  }   
      public function index()
	{
         
           $this->load->view('adminsecurity/login/index');
          
        }
      function check_login()
    { 
        if(check_post($_POST,array("email","pass","checksum","token")))
        {
            if(checksum($_POST))
            {
        $email= string_input($_POST['email']);
        $pass=  string_input($_POST['pass']);
        echo json_encode($this->model->check_login($email,$pass));
            
            } else echo json_encode(array("status"=>0,"message"=>"Lỗi xác thực, vui lòng tải lại trang"));
        }
        else echo json_encode(array("status"=>0,"message"=>"Lỗi xác thực, vui lòng tải lại trang"));
    }

    function logout()
    {
        $this->model->logout();
    }
         
}