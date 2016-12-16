<?php

class Articles extends MY_Controller
{
    function __construct()
    {
        parent::__construct("Articles", "admin");
    }

    function index($id_danhmucbaiviet = "FALSE")
    {
        if (isset($_GET['id_danhmuc'])) {
            $id_danhmuc = string_input($_GET['id_danhmuc']);
        }
        $this->danhmuc = $this->model->load_articles_category();
        $this->id_danhmuc = $id_danhmucbaiviet;
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/articles/index");
    }

    public function articles_ajax($id_danhmuc)
    {
        $_POST['articlescategory_id'] = $id_danhmuc;
        $this->model->articles_ajax($_POST);
    }

    function create()
    {
        $this->danhmuc = $this->model->load_articles_category();
        $this->tag = $this->model->load_tag();

        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/articles/create");
        $this->load->view("adminsecurity/footer");
    }

    function insert()
    {
        $data = $_POST;
        if (isset($_FILES['articles_avatar']))
            $data['articles_avatar'] = $_FILES['articles_avatar'];
        $this->model->insert($data);
        Header("Location:" . ADMIN_URL . "articles");
    }

    function show()
    {
        if (isset($_POST['hienthi']))
            $col = "articles_show";
        else
            $col = "articles_feature";
        $giatri = $_POST['giatri'];
        $id_baiviet = $_POST['id_baiviet'];
        echo json_encode($this->model->update_show($col, $id_baiviet, $giatri));
    }

    function sort_articles()
    {
        $obj = $_POST['baiviet'];
        $this->model->sort_articles($obj);
    }

    function delete_articles()
    {
        $id_baiviet = string_input($_POST['id_baiviet']);
        echo json_encode($this->model->delete_articles($id_baiviet));
    }

    function edit_articles($id_baiviet)
    {
        $this->data_baiviet = $this->model->edit_articles($id_baiviet);
        $this->danhmuc = $this->model->load_articles_category();
        $this->tag = $this->model->load_tag();

        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/articles/edit");
        $this->load->view("adminsecurity/footer");
    }

    function update_articles()
    {
        $data = $_POST;
        if (isset($_FILES['filehinhdaidien']))
            $data['filehinhdaidien'] = $_FILES['filehinhdaidien'];

        $this->model->update_articles($data);

    }
}