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
}