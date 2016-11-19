<?php

class Main extends MY_Controller {

       public function __construct()
  {
      parent::__construct("Main","admin");
  } 
    function Index()
    {
          $this->load->view("adminsecurity/header");
          $this->load->view("adminsecurity",'main/index');
          $this->load->view("adminsecurity/footer");
           
    }
}