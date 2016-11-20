<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of productcategory
 *
 * @author Phong
 */
class Productcategory extends MY_Controller
{

    function __construct()
    {
        parent::__construct("Productcategory", "admin");
    }

    function index()
    {

        $this->data["productcategory"] = $this->model->index();
        $this->load->model("adminsecurity/career_model");
        $this->data["career"] = $this->career_model->index();
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/productcategory/index");
        $this->load->view("adminsecurity/footer");
    }

    function insert()
    {
        echo json_encode($this->model->insert($_POST));

    }

    function update()
    {
        if (isset($_POST['productcategory_show']))
            $_POST['productcategory_show'] = 1;
        else
            $_POST['productcategory_show'] = 2;
        if (isset($_POST['productcategory_showmenu']))
            $_POST['productcategory_showmenu'] = 1;
        else
            $_POST['productcategory_showmenu'] = 2;
        $data = $_POST;
        echo json_encode($this->model->update($data));
    }

    function delete()
    {
        $id = $_POST['id'];
        echo json_encode($this->model->delete($id));
    }

    function load_category_edit()
    {
        $id = $_POST['id'];
        echo json_encode($this->model->load_category_edit($id));
    }

    function sort_category()
    {
        echo $this->model->sort_category($_POST);

    }

}
