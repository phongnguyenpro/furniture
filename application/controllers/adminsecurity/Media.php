<?php

class Media extends MY_Controller {

       public function __construct()
  {
      parent::__construct("Media","admin");
  } 
    function Index()
    {
          $this->load->view("adminsecurity/extension/media");
           
    }
}