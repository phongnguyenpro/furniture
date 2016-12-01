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
        $meta['description'] = $data['thongtindanhmuc']['productcategory_name'] . "/ " . SDT . "/ " . DIACHI;
        $meta['image'] = LOGO;
        $data['meta'] = $meta;

        $data['menu'] = $menu;
//        $data['footer'] = $footer;
        $data['category'] = $danhmuc;

        $this->load->model(array("module_model"));
        $data['module'] = $this->module_model->run("productcategory");

        $this->data = $data;
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

        $meta = array();
        $meta['title'] = $data['thongtindanhmuc']['productcategory_name'];
        $meta['description'] = $data['thongtindanhmuc']['productcategory_name'] . "/ " . SDT . "/ " . DIACHI;
        $meta['image'] = LOGO;
        $data['meta'] = $meta;

        $data['menu'] = $menu;
        $data['category'] = $danhmuc;
//        $data['footer'] = $footer;

        $this->load->model(array("module_model"));
        $data['module'] = $this->module_model->run("productcategory");

//        $this->view->data = $data;
//
        $this->sapxep = $sapxep;
        $this->data = $data;
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
            $data['module'] = $this->module_model->run("productdetail");

            $this->data = $data;
            if (isset($this->data['sanpham'])) {
                $this->load->view(THEME . '/header');
                $this->load->view(THEME . '/sanpham/chitiet');
                $this->load->view(THEME . '/footer');
            } else
                $this->error();
        } else
            $this->error();
    }

    public function add_cart()
    {
        if (check_post($_POST, array("id_sanpham", "soluongthem", "giatri", "id_sanphamchitiet", "checksum"))) {
            if (checksum($_POST)) {
//$cook->huycook("giohang");
//die();
                if (!isset($_POST['id_sanphamchitiet']))
                    $this->error();

                unset($_POST['token']);
                unset($_POST['checksum']);

                foreach ($_POST as $key => $value) {
                    if (in_array($key, array("id_sanpham", "id_sanphamchitiet", "soluongthem", "giatri")))
                        $_data[$key] = string_input($value);
                }
                $soluongthem = $_data['soluongthem'];
                if ($soluongthem < 1) {
                    echo json_encode(array("tinhtrang" => 0));
                    return false;
                }
                if (isset($_COOKIE['giohang'])) {
                    $giohang = unserialize($_COOKIE['giohang']);
                    $id_sanphamchitiet = $_data['id_sanphamchitiet'];

                    if ($id_sanphamchitiet == -1) {
                        unset($_data['id_sanphamchitiet']);
                    }


                    foreach ($giohang as $key => $value) {
                        if ($value['id_sanpham'] == $_data['id_sanpham']) {
                            $giatri = explode(",", $value['giatri']);
                            $giatripost = explode(",", $_data['giatri']);
                            $kiemtra = array_diff($giatri, $giatripost);
                            if (empty($kiemtra)) {
                                // nếu trùng
                                $giohang[$key]['soluongthem'] = $_data['soluongthem'];
                                create_cook("giohang", serialize($giohang));
                                $giohang = $this->model->load_cart($giohang)['giohang'];
                                echo json_encode(array("status" => 1, 'data' => $giohang));
                                return;
                            }
                        }

                    }
                    // nếu chưa tồn tại sp
                    $giohang[] = $_data;
                    create_cook("giohang", serialize($giohang));
                    $giohang = $this->model->load_cart($giohang)['giohang'];
                    echo json_encode(array("status" => 1, 'data' => $giohang));
                    return;
                } else {
                    $temp = $_data['id_sanphamchitiet'];

                    if ($temp == -1) {
                        unset($_data['id_sanphamchitiet']);
                        $data[] = $_data;
                        create_cook("giohang", serialize($data));
                    } else {
                        $data[] = $_POST;
                        create_cook("giohang", serialize($data));
                    }

                    $data = $this->model->loadgiohang($data)['giohang'];
                    echo json_encode(array("status" => 1, 'data' => $data));
                }
            } else        $this->error(); // checksum
        } else        $this->error();

    }

    public function delete_cart()
    {
        if (check_post($_POST, array("key", "token", "checksum"))) {
            if (checksum($_POST)) {
                if (isset($_COOKIE['giohang'])) {
                    if (isset($_POST['checkout'])) {
                        $key = string_input($_POST['key']);
                        $data = unserialize($_COOKIE['giohang']);
                        unset($data[$key]);
                        create_cook("giohang", serialize($data));
                        if (empty($data)) {
                            echo json_encode(array("status" => 1, "tientotal" => 0, "sl" => 0));
                            return;
                        }
                        $kq = $this->model->load_cart($data);
                        $data = $kq['giohang'];
                        $set = $kq['set'];
                        if ($set) {
                            echo json_encode(array("status" => 0));
                            return;
                        }
                        $tientotal = 0;
                        foreach ($data as $value) {
                            $tongtiensanpham = $value['giasanpham'] * $value['soluongthem'];
                            $tiengiamgia = ($value['giasanpham'] * $value['soluongthem']) * ($value['giamgia'] / 100);
                            $tien = $tongtiensanpham - $tiengiamgia;
                            $tientotal += $tien;
                        }

                        echo json_encode(array("status" => 1, "tientotal" => $tientotal, "sl" => count($data)));

                    } else {
                        $key = string_input($_POST['key']);
                        $data = unserialize($_COOKIE['giohang']);
                        unset($data[$key]);
                        $kq = $this->model->load_cart($data);
                        create_cook("giohang", serialize($data));

                        echo json_encode(array("status" => 1, 'data' => $kq['giohang']));
                    }
                } else
                    $this->error();
            } else
                $this->error();
        } else
            $this->error();

    }

    public function checkout()
    {
        $data = $this->model->checkout();
        $data['bre'] = array("item" => "");

        $this->load->model(array("module_model"));
        $data['category'] = $this->module_model->category();
        $data['menu'] = $this->module_model->menu();
//        $data['footer'] = $header->loadfooter();

//        $this->load->model(array("module_model"));
//        $data['module'] = $this->module_model->run("product");

        $data["bre"]['info'][] = array("ten" => "Lập hóa đơn", "slug" => "#");
        $data["bre"]['itemdanhmucsanpham'][] = array();
        $data['checkout'] = true;
        $this->load->helper(array("mydata"));
        $data['hinhthucthanhtoan'] = get_checkout_type();

        $meta = array();
        $meta['title'] = TENSHOP;
        $meta['description'] = MIEUTA;
        $meta['image'] = LOGO;
        $data['meta'] = $meta;
        $this->data = $data;

        $this->load->view(THEME . '/header');
        $this->load->view(THEME . '/sanpham/checkout');
        $this->load->view(THEME . '/footer');
    }

    public function update_cart()
    {
        if (check_post($_POST, array("soluongthem", "key", "token"))) {
            if (checksum($_POST)) {
                if (isset($_COOKIE['giohang'])) {
                    $key = string_input($_POST['key']);
                    $soluongthem = string_input($_POST['soluongthem']);
                    $data = unserialize($_COOKIE['giohang']);
                    $data[$key]['soluongthem'] = $soluongthem;
                    create_cook("giohang", serialize($data));
                    $kq = $this->model->load_cart($data);
                    $data = $kq['giohang'];
                    $set = $kq['set'];
                    if (!$set) {
                        $tienchinhsua = $data[$key]['soluongthem'] * $data[$key]['giasanpham'];
                        $tienchinhsuagiamgia = $tienchinhsua * ($data[$key]['giamgia'] / 100);
                        $tienchinhsua = $tienchinhsua - $tienchinhsuagiamgia;
                        $tientotal = 0;
                        $tien = 0;
                        foreach ($data as $value) {
                            $tongtiensanpham = $value['giasanpham'] * $value['soluongthem'];
                            $tiengiamgia = ($value['giasanpham'] * $value['soluongthem']) * ($value['giamgia'] / 100);
                            $tien = $tongtiensanpham - $tiengiamgia;
                            $tientotal += $tien;
                        }

                        echo json_encode(array("status" => 1, "tien" => $tienchinhsua, "tientotal" => $tientotal));
                    } else
                        echo json_encode(array("status" => 0));
                } else echo json_encode(array("status" => 0));  // khong ton tai gio hang
            } else echo json_encode(array("status" => 0)); // checksum
        } else echo json_encode(array("status" => 0)); // kiem tra post

    }

    function tag($id_tag)
    {
        if (isset($_GET['page'])) {
            $page = string_input($_GET['page']);
        } else
            $page = 1;

        $data = $this->model->tag($id_tag, $page);

        $this->load->model(array("module_model"));
        $data['category'] = $this->module_model->category();
        $data['menu'] = $this->module_model->menu();
//        $data['footer'] = $header->loadfooter();

        $this->load->model(array("module_model"));
        $data['module'] = $this->module_model->run("productcategory");

        $meta = array();
        $meta['title'] = $data['thongtintag']['tag_name'];
        $meta['description'] = "Bạn đang tìm kiếm " . $data['thongtintag']['tag_name'];
        $meta['image'] = LOGO;
        $data['meta'] = $meta;

        $this->data = $data;
        $this->load->view(THEME . '/header');
        $this->load->view(THEME . '/sanpham/tag');
        $this->load->view(THEME . '/footer');
    }

    function product_like()
    {
        $data = $this->model->product_like();
        $data['bre'] = array("item" => "");

        $this->load->model(array("module_model"));
        $data['category'] = $this->module_model->category();
        $data['menu'] = $this->module_model->menu();
//        $data['footer'] = $header->loadfooter();

        $data["bre"]['info'][] = array("ten" => "Sản phẩm yêu thích", "slug" => "#");

        $meta = array();
        $meta['title'] = TENSHOP;
        $meta['description'] = MIEUTA;
        $meta['image'] = LOGO;
        $data['meta'] = $meta;
        $this->data = $data;


        $this->load->view(THEME . '/header');
        $this->load->view(THEME . '/sanpham/yeuthich');
        $this->load->view(THEME . '/footer');
    }

    public function error()
    {
    }
}
