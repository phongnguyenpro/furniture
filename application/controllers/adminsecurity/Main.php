<?php

class Main extends MY_Controller {

    function __construct() {
        parent::__construct("Index", "admin");
    }
    function Index()
    {
          $this->load->view("adminsecurity/header");
          $this->view->render("adminsecurity",'main/index');
          $this->load->view("adminsecurity/footer");
           
    }
}