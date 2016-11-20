<?php

class Product_prop extends MY_Controller

{

    function __construct()
    {
        parent::__construct("Product_prop", "admin");
    }

    function index()
    {
        $this->data["product_prop"] = $this->model->index();
        $this->load->model("adminsecurity/career_model");
        $this->data["career"] = $this->career_model->index();
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/product_prop/index");
        $this->load->view("adminsecurity/footer");
    }

    function insert()
    {
        $this->model->insert($_POST);
    }

    function update()
    {
        $this->model->update($_POST);
    }

    function delete()
    {
        $this->model->delete($_POST["product_prop_id"]);
    }

    function product_prop_sort()
    {
        $data = sort_data($_POST["data"]);
        echo $this->model->product_prop_sort($data);
    }
}