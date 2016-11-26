<?php

function getrole() {
    return array(
        "administrator" => array(
            "label" => "Quản trị tối cao",
            "rank" => 1
        ),
        "admin" => array(
            "label" => "Quản trị viên",
            "rank" => 2
        ),
        "user" => array(
            "label" => "Người dùng",
            "rank" => 3
        ),
    );
}

function get_format_menu() {
    return array("link" => "Liên kết", "productcategory" => "Danh mục sản phẩm");
}

function get_type_module() {

    return array("slider"=>"slider","product"=>"product");
}

function get_page() {
    return array("-1"=>"Tất cả","home"=>"Home","productcategory"=>"ProductCategory","productdetail"=>"ProductDetail");
}

function get_module_type() {
    return array("slider" => "Trình chiếu ảnh", "product" => "Sản phẩm");
}
function get_module_location()
{
   return array("header"=>"Top đầu trang","menu"=>"Menu, Danh mục sản phẩm","main"=>"Chính giữa trang","left"=>"Phía bên trái","right"=>"Phía bên phải","footer"=>"Phía dưới trang");
}