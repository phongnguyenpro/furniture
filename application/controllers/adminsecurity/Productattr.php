<?php

class Productattr extends MY_Controller {

    function __construct() {
        parent::__construct("Productattr", "admin");
    }

    function index() {
        $this->data["productattr"] = $this->model->index();
        $this->load->model("adminsecurity/career_model");
        $this->data["career"] = $this->career_model->index();
        $this->load->view('adminsecurity/header');
        $this->load->view('adminsecurity/productattr/index');
        $this->load->view('adminsecurity/footer');
    }
    function v_attr_val($productattr_id)
    {   $this->data["info"]=  $this->model->attr_val_info($productattr_id);
        $this->data["attr_val"]=  $this->model->attr_val($productattr_id);
        $this->load->view('adminsecurity/header');
        $this->load->view('adminsecurity/productattr/value_attr');
        $this->load->view('adminsecurity/footer');
    }
  function  attr_val_insert()
  {
      $this->model->attr_val_insert($_POST);
  }
                function insert() {
        $data = $_POST;
        isset($data["productattr_showfilter"]) ? $data["productattr_showfilter"] = 1 : $data["productattr_showfilter"] = 2;
        $this->model->insert($data);
    }
    function attr_val_update()
    {
        $this->model->attr_val_update($_POST);
    }
    function attr_val_delete()
    {
        $this->model->attr_val_delete($_POST["attr_val_id"],$_POST["productattr_id"]);
    }
            
            function sort_attr() {
        $json_obj = $_POST['data'];
        $data=sort_data($json_obj);
        $this->model->sort_attr($data);
    }
    function attr_val_sort()
    {
     $data=sort_data($_POST['data']);
     $this->model->attr_val_sort($data);
    }
            function update()
    {
        
       $this->model->update($_POST);
    }
    function delete()
    {
       $this->model->delete($_POST['productcatgory_id']);
        
    }

}
