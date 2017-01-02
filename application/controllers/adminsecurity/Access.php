<?php

class Access extends MY_Controller {

       public function __construct()
  {
      parent::__construct("Access","admin");
  } 
    function notaccess()
    {
          $this->load->view("adminsecurity/header");
          $this->load->view("adminsecurity/access/notaccess");
          $this->load->view("adminsecurity/footer");      
    }
}