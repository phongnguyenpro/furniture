<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Tag extends MY_Controller
{

    public function __construct()
    {
        parent::__construct("Tag", "admin");
    }

    function index()
    {
        $this->data_item = $this->model->index();
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/tag/index");
        $this->load->view("adminsecurity/footer");
    }

    function create_tag()
    {
        if ($this->model->create_tag($_POST))
            Header("Location:" . ADMIN_URL . "tag");
    }

    function update_tag()
    {
        if ($this->model->update_tag($_POST))
            Header("Location:" . ADMIN_URL . "tag");
    }

    function delete_tag($tag_id)
    {

        if ($this->model->delete_tag($tag_id))
            Header("Location:" . ADMIN_URL . "tag");
    }

    function sort_tag()
    {
        $obj = $_POST['tag'];

        $sort = json_decode($obj);
        $stt = 1;

        foreach ($sort as $key => $item) {
            if ($item->id != -1) {
                $data[$item->id]['tag_id'] = $item->id;
                $data[$item->id]['tag_index'] = $stt;
                $stt++;
            }
        }
        $this->model->sort_tag($data);

    }
}
