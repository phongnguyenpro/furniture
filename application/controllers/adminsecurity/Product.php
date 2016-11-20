<?php

class Product extends MY_Controller {

    function __construct() {
        parent::__construct("Product", "admin");
    }

    function index() {
        if (isset($_GET['id_danhmuc'])) {
            $id_danhmuc = $_GET['id_danhmuc'];
        }
        $this->load->model(array("adminsecurity/productcategory_model"));
        $this->data["category"] = $this->productcategory_model->load_category_condition();
        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/product/index");
    }

    function load_data_ssp($category_id = "") {
        $_POST['category_id'] = $category_id;
        $this->model->load_data_ssp($_POST);
    }

    function create() {
        if (isset($_GET['career_id'])) {
            $this->load->model(array("adminsecurity/product_prop_model", "adminsecurity/productcategory_model", "adminsecurity/productattr_model", "adminsecurity/tag_model"));
            $career_id = $_GET['career_id'];
            $this->data["property"] = $this->product_prop_model->load_prop_condition($career_id);
            $this->data["category"] = $this->productcategory_model->load_category_condition($career_id);
            $this->data["attribute"] = $this->productattr_model->load_attr_condition($career_id);
            $this->data["tag"] = $this->tag_model->index();
        }
        $this->load->model("adminsecurity/career_model");
        $this->data["career"] = $this->career_model->index();

        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/product/create");
        $this->load->view("adminsecurity/footer");
    }

    function delete_temp_forder() {
        $files1 = array();
        $files1 = scandir("public/upload/images/temp");
        foreach ($files1 as $img) {
            delete_image($img, "temp");
        }
        echo json_encode(array("status" => 1));
    }

    function delete_image() {
        $id_hinh = $_POST['id_hinh'];
        $tenhinh = $_POST['tenhinh'];
        echo json_encode($this->model->delete_image($id_hinh, $tenhinh));
    }

    function avatar() {
        $this->load->library("image");
        $image = $this->image;
        $config = load_config();
        $width = intval($config["width"]);
        $width_thumb = intval($config["width"]);
        $height = intval($config["height"]);
        $height_thumb = intval($config["heightthumb"]);
        $type_crop = $config["typeimage"];
        $type_add_logo = $config["kieuchen"];
        $product_id = $_POST['id_sanpham'];

        if ($_POST['id_sanpham'] != "") {

            $thongtin = $this->model->product_info($product_id);
            $thongtin = $thongtin[0];
            $file = $_FILES['avatar'];

            $name = slug($thongtin['product_name']) . "-" . rand(0, 9000) . time() . "." . $image->getExtension($file['name']);
            $image->crop($file['tmp_name'], "public/upload/images/thumb_product/" . $name, $width_thumb, $height_thumb, $type_crop);
            $image->crop($file['tmp_name'], "public/upload/images/product/" . $name, $width, $height, $type_crop);
            if ($config["chenlogo"] == 1)
                $image->chenlogo("public/upload/images/product/" . $name, $config["kieuchen"]);
            echo json_encode($this->model->avatar($product_id, $name));
        } else {
            $id_sanpham = "";
            $file = $_FILES['avatar'];

            $name = rand(0, 9000) . time() . "." . $image->getExtension($file['name']);
            $image->crop($file['tmp_name'], "public/upload/images/thumb_temp/" . $name, $width, $height, $type_crop);
            $image->crop($file['tmp_name'], "public/upload/images/temp/" . $name, $width, $height, $type_crop);
            if ($config["chenlogo"] == 1)
                $image->chenlogo("public/upload/images/temp/" . $name, $type_add_logo);
            echo json_encode($this->model->avatar($product_id, $name));
        }
    }

    function sort_image() {
        $obj = $_POST['list_images']; 
        $this->model->sort_images($obj);
    }

    function upload_image() {
        $this->load->library("image");
        $image = $this->image;
        $config = load_config();
        $width = intval($config["width"]);
        $width_thumb = intval($config["width"]);
        $height = intval($config["height"]);
        $height_thumb = intval($config["heightthumb"]);
        $type_crop = $config["typeimage"];
        $type_add_logo = $config["kieuchen"];
        $product_id = $_POST['id_sanpham'];

        if ($height > $width) {
            $tyle = $height / $width;
            $width_thumb = 100;
            $height_thumb = $width_thumb * $tyle;
        } else {
            $tyle = $width / $height;
            $height_thumb = 100;
            $width_thumb = $height_thumb * $tyle;
        }

        if ($_POST['id_sanpham'] != "") {
            $id_sanpham = $_POST['id_sanpham'];
            $thongtin = $this->model->product_info($product_id)[0];
            $file = $_FILES['hinhanh'];
            $name = slug($thongtin['product_name']) . "-" . rand(0, 9000) . time() . "." . $image->getExtension($file['name']);
            // tính thumb ảnh sản phẩm

            $image->crop($file['tmp_name'], "public/upload/images/thumb_product/" . $name, $width_thumb, $height_thumb, $type_crop);
            $image->crop($file['tmp_name'], "public/upload/images/product/" . $name, $width, $height, $type_crop);
            if ($config["chenlogo"] == 1)
                $image->chenlogo("public/upload/images/product/" . $name, $type_add_logo);

            echo json_encode($this->model->upload_image($id_sanpham, $name));
        } else {
            $id_sanpham = "";
            $file = $_FILES['hinhanh'];
            $name = rand(0, 9000) . time() . "." . $image->getExtension($file['name']);
            // tính thumb ảnh sản phẩm
            $image->crop($file['tmp_name'], "public/upload/images/thumb_temp/" . $name, $width_thumb, $height_thumb, $type_crop);
            $image->crop($file['tmp_name'], "public/upload/images/temp/" . $name, $width, $height, $type_crop);
            if ($config["chenlogo"] == 1)
                $image->chenlogo("public/upload/images/temp/" . $name, $type_add_logo);
            echo json_encode($this->model->upload_image($id_sanpham, $name));
        }
    }

    function insert() {
        echo json_encode($this->model->insert($_POST));
    }

    function sort_product() {
        $obj = $_POST['product'];
        $this->model->sort_product($obj);
    }

    function edit($product_id) {

        $this->data["product"] = $this->model->edit($product_id);
        $career_id = $this->data["product"]["product"]["career_id"];
        $this->load->model(array("adminsecurity/product_prop_model", "adminsecurity/productcategory_model", "adminsecurity/productattr_model", "adminsecurity/tag_model"));
        $this->data["property"] = $this->product_prop_model->load_prop_condition($career_id);
        $this->data["category"] = $this->productcategory_model->load_category_condition($career_id);
        $this->data["attribute"] = $this->productattr_model->load_attr_condition($career_id);
        $this->data["tag"] = $this->tag_model->index();

        $this->load->view("adminsecurity/header");
        $this->load->view("adminsecurity/product/edit");
        $this->load->view("adminsecurity/footer");
    }

    function update() {
        
        echo json_encode($this->model->update($_POST));
    }
    
    function add_product_detail()
    {
        echo json_encode($this->model->add_product_detail($_POST));
    }

}
