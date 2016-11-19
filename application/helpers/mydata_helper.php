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

function get_format_menu()
{
  return array("link"=>"Liên kết","productcategory"=>"Danh mục sản phẩm");
}
