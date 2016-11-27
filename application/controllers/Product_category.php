<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Product_category extends MY_Controller
{
    public function __construct()
    {
        parent::__construct("Product_category");
    }

    public function category($id_danhmuc)
    {
        if (check_url(array($id_danhmuc), $id_danhmuc)) {
            if (!isset($_POST['ajax'])) {
                $this->load->model(array("module_model"));
                $danhmuc = $this->module_model->category();
                $menu = $this->module_model->menu();
                $footer = null;
                $this->model->setProductCategory($danhmuc);
                if ($concapmot = search_all_child_first_level($danhmuc, $id_danhmuc, array()))
                    $this->category_more($id_danhmuc, $concapmot, $menu, $danhmuc, $footer);
                else {
                    // ORDER BY
                    if (isset($_GET['orderby']))
                        $orderby = $_GET['orderby'];
                    else
                        $orderby = 'product_index';
                    // end ORDER BY

                    // FITER
                    if (isset($_GET['filter']))
                        $filter = $_GET['filter'];
                    else
                        $filter = '';
                    // end FITER;
                    // PAGE
                    if (isset($_GET['page']))
                        $page = $_GET['page'];
                    else
                        $page = 1;
                    //end PAGE

                    // Nổi bật
                    if (isset($_GET['noibat']))
                        $noibat = $_GET['noibat'];
                    else
                        $noibat = '';
                    // end noi bat

                    // Giảm giá
                    if (isset($_GET['giamgia']))
                        $giamgia = $_GET['giamgia'];
                    else
                        $giamgia = '';
                    // end giảm giá
                    // type
                    if (isset($_GET['type']))
                        $type = string_input($_GET['type']);
                    else
                        $type = "desc";
                    $this->category_one($id_danhmuc, $menu, $danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type, $footer);
                }
            } else {
                // ORDER BY
                if (isset($_GET['orderby']))
                    $orderby = $_GET['orderby'];
                else
                    $orderby = 'product_index';
                // end ORDER BY

                // FITER
                if (isset($_GET['filter']))
                    $filter = $_GET['filter'];
                else
                    $filter = '';
                // end FITER;
                // PAGE
                if (isset($_GET['page']))
                    $page = $_GET['page'];
                else
                    $page = 1;
                //end PAGE

                // Nổi bật
                if (isset($_GET['noibat']))
                    $noibat = $_GET['noibat'];
                else
                    $noibat = '';
                // end noi bat

                // Giảm giá
                if (isset($_GET['giamgia']))
                    $giamgia = $_GET['giamgia'];
                else
                    $giamgia = '';
                // end giảm giá
                // type
                if (isset($_GET['type']))
                    $type = string_input($_GET['type']);
                else
                    $type = "desc";
                $this->category_one_ajax($id_danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type);
            }
        } else
            $this->error();
    }

    public function category_more($id_danhmuc, $concapmot, $menu, $danhmuc, $footer)
    {
        $data = $this->model->data_product_moreCategory($id_danhmuc, $concapmot);

        $meta = array();
        $meta['title'] = $data['thongtindanhmuc']['productcategory_name'];
//        $meta['mieuta'] = $data['thongtindanhmuc']['productcategory_name'] . "/ " . SDT . "/ " . DIACHI;
//        $meta['image'] = LOGO;
//        $data['meta'] = $meta;

        $data['menu'] = $menu;
//        $data['footer'] = $footer;
        $data['category'] = $danhmuc;

        $this->load->model(array("module_model"));
        $data['module'] = $this->module_model->run("product");

        $this->data = $data;
        $this->data["meta"] = array("title" => "Home", "description" => "Home", "image" => "image");
        $this->load->view(THEME . '/header');
        $this->load->view(THEME . '/sanpham/danhmucnhieu');
        $this->load->view(THEME . '/footer');
    }

    public function category_one($id_danhmuc, $menu, $danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type, $footer)
    {
        // load sap xep
        $sapxep = array("stt" => array("ten" => "STT"), "gia" => array("ten" => "Giá"), "ngaytao" => array("ten" => "Ngày"), "daxem" => array("ten" => "Lượt Xem"), "yeuthich" => array("ten" => "Yêu Thích"));
        foreach ($sapxep as $key => $value) {
            if ($key == $orderby)
                $sapxep[$key]['selected'] = "selected";
            else
                $sapxep[$key]['selected'] = false;
        }

        // end load sap xep
        $data = $this->model->data_product_oneCategory($id_danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type);

//        $meta = array();
//        $meta['title'] = $data['thongtindanhmuc']['productcategory_name'];
//        $meta['mieuta'] = $data['thongtindanhmuc']['productcategory_name'] . "/ " . SDT . "/ " . DIACHI;
//        $meta['image'] = LOGO;
//        $data['meta'] = $meta;

        $data['menu'] = $menu;
        $data['category'] = $danhmuc;
//        $data['footer'] = $footer;

        $this->load->model(array("module_model"));
        $data['module'] = $this->module_model->run("product");

//        $this->view->data = $data;
//
        $this->sapxep = $sapxep;
        $this->data = $data;
        $this->data["meta"] = array("title" => "Home", "description" => "Home", "image" => "image");
        $this->load->view(THEME . "/header");
        $this->load->view(THEME . "/sanpham/danhmuc");
        $this->load->view(THEME . "/footer");
    }

    public function category_one_ajax($id_danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type)
    {
        echo json_encode($this->data = $this->model->data_product_oneCategory($id_danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type, true));
    }

    public function product($id_sanpham, $i = false)
    {
//        $xuly = new Xulydulieu;
//        if (isset($_GET['vip'])) {
//            $backlink = new backlink_controller();
//            $data = $xuly->input($_GET['vip']);
//            $arrdata = explode(",", $data);
//
//            if (count($arrdata) == 2) {
//
//                $para1 = $xuly->input($arrdata[0]);
//                $para2 = $xuly->input($id_sanpham);
//                $para3 = $xuly->input($arrdata[1]);
//                // id_taikhoan,id_sanpham,id_share
//                $para4 = (new \lib\MaHoa())->createsha1(array($para1, $para2));
//
//                $backlink->action($para1, $para2, $para3, $para4);
//            }
//
//        }
        if (check_url(array($id_sanpham), $id_sanpham)) {
            $this->load->model(array("module_model"));
            $danhmuc = $this->module_model->category();
            $this->model->setProductCategory($danhmuc);
            $data = $this->model->loadinfo($id_sanpham);//----------------------------------------------toi day

            $meta = array();
            $meta['title'] = $data['sanpham']['product_name'];
            $meta['description'] = neods($data['sanpham']['product_description'], 120);
            $meta['image'] = BASE_URL . "public/upload/images/thumb_hinhsanpham/" . $data['sanpham']['product_avatar'];
            $data['meta'] = $meta;
            $data['menu'] = $this->module_model->menu();
            $data['category'] = $danhmuc;
//            $data['footer'] = $header->loadfooter();

            $this->load->model(array("module_model"));
            $data['module'] = $this->module_model->run("product");

            $this->data = $data;

            $this->load->view(THEME . '/header');
            $this->load->view(THEME . '/sanpham/chitiet');
            $this->load->view(THEME . '/footer');
        } else
            $this->error();
    }

    public function error()
    {
    }
}
