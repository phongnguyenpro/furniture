<?php

class Career extends MY_Controller {

    function __construct() {
        parent::__construct("Career", "admin");
    }

    function index() {
        $this->data["career"] = $this->model->index();
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/career/index");
        $this->load->view("adminsecurity/footer");
    }

    function insert() {
        $career_name = string_input($_POST['career_name']);
        $this->model->insert($career_name);
    }

    function update()
    {
        $career_name= string_input($_GET['career_name']);
        $career_id=  string_input($_GET['career_id']);
        $this->model->update($career_name,$career_id);
    }
            function sort_career() {
        $obj = $_POST['nganhnghe'];

        $sort = json_decode($obj);
        $index = 1;

        foreach ($sort as $key => $item) {

            if ($item->id != -1) {
                $data[$item->id]['career_id'] = $item->id;
                $data[$item->id]['career_index'] = $index;
                $index++;
            }
        }
        $this->model->sort_career($data);
    }

}
