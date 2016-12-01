<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//$CI = &get_instance();
class Product_like extends MY_Controller
{
    public function __construct()
    {
        parent::__construct("Product_like");
    }

    function like()
    {
        if (check_post($_POST, array("id_sanpham"))) {
            if (checksum($_POST)) {
                $id_sanpham = string_input($_POST['id_sanpham']);
                echo json_encode($this->model->like($id_sanpham));
            }
        }
    }

    function deletelike()
    {
        if (check_post($_POST, array("id_sanpham"))) {
            $id_sanpham = string_input($_POST['id_sanpham']);
            echo json_encode($this->model->deletelike($id_sanpham));
        }
    }
}
