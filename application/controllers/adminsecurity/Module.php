<?php

class Module extends MY_Controller {

       public function __construct()
  {
      parent::__construct("Module","admin");
    
    } 
  
    function index()
    {
        
          $this->load->view("adminsecurity/header");
          $this->load->view("adminsecurity/module/index");
          $this->load->view("adminsecurity/footer");
           
    }
    
    function detail($page)
    {
          $this->data["module"] = $this->model->detail($page);
          $this->data["page"]=$page;
          $this->load->view("adminsecurity/header");
          $this->load->view("adminsecurity/module/detail");
          $this->load->view("adminsecurity/footer");
    }
    
    function insert()
    {
        $this->model->insert($_POST);
    }
    
    function config()
    {
        $type =$_POST["type"];
        $id_module = $_POST["id_module"];
        
        switch ($type)
        {
            case "slider":
               $this->data=$this->model->config($type,$id_module);
               $this->load->view("adminsecurity/module/config/slider");    
            break;
            
            
        }
        
       
    }
    
    function update()
    {
        $type =$_POST["module_type"];
        switch ($type)
        {
            case "slider":
               $this->load->model("module/slider_model");
               $this->slider_model->update($_POST);    
            break;
            
            
        }
    } 
    function delete($module_id)
    {
        $this->model->delete($module_id);
    }
}