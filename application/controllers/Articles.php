<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Articles extends MY_Controller
{

    public function __construct()
    {
        parent::__construct("Articles");
    }

    function category($id_danhmuc = "", $slug = "")
    {
        if (check_url(array($id_danhmuc, $slug), $id_danhmuc)) {            
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $trang = string_input($_GET['page']);
            } else
                $trang = 1;
            
            $this->load->model(array("module_model"));

            $this->model->set_article_category($this->module_model->articles_category());    
            $data = $this->model->load_data_category($id_danhmuc, $trang);

            $data['menu'] = $this->module_model->menu();
            $data['category'] = $this->module_model->category();

            $this->load->model(array("module_model"));
            $data['module'] = $this->module_model->run("articlescategory");


            $data['footer'] = $this->module_model->footer();

            $data['bre'] = $this->model->load_bre($id_danhmuc);


            $meta['title'] = $data['bre']['thongtindanhmucchinh']['articlescategory_name'];
            $meta['description'] = $data['bre']['thongtindanhmucchinh']['articlescategory_name'] . "/ " . SDT . "/ " . DIACHI;
            $meta['image'] = LOGO;
            $data['meta'] = $meta;

            $this->data = $data;
            $this->load->view(THEME . '/header');
            $this->load->view(THEME . '/baiviet/danhmuc');
            $this->load->view(THEME . '/footer');
        } else
            $this->error();
    }

    function details($id_baiviet)
    {
        if (check_url(array($id_baiviet), $id_baiviet)) {
            $this->load->model(array("module_model"));

            $this->model->set_article_category($this->module_model->articles_category());
            $data = $this->model->load_articles_details($id_baiviet);

            $data['menu'] = $this->module_model->menu();
            $data['category'] = $this->module_model->category();

            $this->load->model(array("module_model"));
            $data['module'] = $this->module_model->run("articles");


            $data['footer'] = $this->module_model->footer();
            $meta['title'] = $data['baiviet']['articles_name'];
            $meta['description'] = neods($data['baiviet']['articles_description'], 120);
            $meta['image'] = BASE_URL . "public/upload/images/thumb_articles/" . $data['baiviet']['articles_avatar'];
            $data['meta'] = $meta;

            $this->data = $data;
            $this->load->view(THEME . '/header');
            $this->load->view(THEME . '/baiviet/chitiet');
            $this->load->view(THEME . '/footer');
        } else
            $this->error();
    }

    function tag($id_tag)
    {
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = string_input($_GET['page']);
        } else
            $page = 1;

        $this->load->model(array("module_model"));

        $data = $this->model->tag($id_tag, $page);

        $data['menu'] = $this->module_model->menu();
        $data['category'] = $this->module_model->category();
        $data['footer'] = $this->module_model->footer();

        $this->load->model(array("module_model"));
        $data['module'] = $this->module_model->run("articlescategory");

        $meta = array();
        $meta['title'] = $data['thongtintag']['tag_name'];
        $meta['description'] = "Bạn đang cần tìm: " . $data['thongtintag']['tag_name'];
        $meta['image'] = LOGO;
        $data['meta'] = $meta;

        $this->data = $data;
        $this->load->view(THEME . '/header');
        $this->load->view(THEME . '/baiviet/tag');
        $this->load->view(THEME . '/footer');
    }

}
