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
        if (kiemtraurl(array($id_danhmuc), $id_danhmuc)) {
            if (!isset($_POST['ajax'])) {
                $this->load->model(array("module_model"));
                $danhmuc = $this->module_model->category();
                $menu = $this->module_model->menu();
                $footer = $this->module_model->footer();
                $this->model->setProductCategory($danhmuc);
                if ($concapmot = $this->model->findChildCategory_FirstLevel($danhmuc, $id_danhmuc, array()))
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
                    $this->danhmucit($id_danhmuc, $menu, $danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type, $footer);
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
                $this->danhmucitajax($id_danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type);
            }
            die();
        } else
            $this->error();
    }

    public function category_more($id_danhmuc, $concapmot, $menu, $danhmuc, $footer)
    {
        $data = $this->model->data_product_moreCategory($id_danhmuc, $concapmot);

        $meta = array();
        $meta['title'] = $data['thongtindanhmuc']['ten'];
        $meta['mieuta'] = $data['thongtindanhmuc']['ten'] . "/ " . SDT . "/ " . DIACHI;
        $meta['image'] = LOGO;
        $data['meta'] = $meta;

        $data['menu'] = $menu;
        $data['footer'] = $footer;
        $data['danhmucsanpham'] = $danhmuc;

//        $module = new Module();
//        $data['module'] = $module->loadmodule("danhmucsanpham");

        $this->view->data = $data;

//        $this->view->render(THEME, 'header');
//        $this->view->render(THEME, 'sanpham/danhmucnhieu');
//        $this->view->render(THEME, 'footer');
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
        $data = $this->model->loaddatadanhmucit($id_danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type);

        $meta = array();
        $meta['title'] = $data['thongtindanhmuc']['ten'];
        $meta['mieuta'] = $data['thongtindanhmuc']['ten'] . "/ " . SDT . "/ " . DIACHI;
        $meta['image'] = LOGO;
        $data['meta'] = $meta;

        $data['menu'] = $menu;
        $data['danhmucsanpham'] = $danhmuc;
        $data['footer'] = $footer;

        $module = new Module();
        $data['module'] = $module->loadmodule("danhmucsanpham");

        $this->view->data = $data;

        $this->view->sapxep = $sapxep;
        $this->view->render(THEME, 'header');
        $this->view->render(THEME, 'sanpham/danhmuc');
        $this->view->render(THEME, 'footer');
    }

    public function danhmucitajax($id_danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type)
    {
        echo json_encode($this->view->data = $this->model->loaddatadanhmucit($id_danhmuc, $orderby, $filter, $noibat, $giamgia, $page, $type, true));
    }
}
