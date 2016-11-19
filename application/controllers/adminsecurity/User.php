<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct()
  {
      parent::__construct("User","admin");
  }
  function index()
  {
      Header("Location:".ADMIN_URL."user/v_create");
  }
          function v_create()
     {
           $this->data["user"] =  $this->model->obj_user();
           $this->load->helper(array("mydata"));
           $this->load->view('adminsecurity/header');
           $this->load->view('adminsecurity/user/create');
           $this->load->view('adminsecurity/footer');  
        
     }
     function insert()
     {
         $data =$_POST;
         if($this->model->insert($data))
         {
             Header("Location:".ADMIN_URL."user/v_create");
         }
       
     }
    
    
  }