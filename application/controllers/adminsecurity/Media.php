<?php

class Media extends MY_Controller {

       public function __construct()
  {
      parent::__construct("Media","admin");
  } 
    function index()
    {
          $this->load->view("adminsecurity/header");
          $this->load->view("adminsecurity/extension/index");
          $this->load->view("adminsecurity/footer");
           
    }
    
      function selectphoto()
    {
          $this->load->view("adminsecurity/extension/media");
           
    }
}