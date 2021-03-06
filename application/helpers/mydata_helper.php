<?php

function getrole()
{
    return array(
        "administrator" => array(
            "label" => "Quản trị tối cao",
            "rank" => 1
        ),
        "user" => array(
            "label" => "Người dùng",
            "rank" => 3
        ),
    );
}

function get_format_menu()
{
    return array("link" => "Liên kết", "productcategory" => "Danh mục sản phẩm");
}

function get_page()
{
    return array("-1" => "Tất cả", "home" => "Home", "productcategory" => "ProductCategory", "productdetail" => "ProductDetail", "articlescategory" => "Danh mục bài viết", "articles" => "Bài viết chi tiết");
}

function get_module_type()
{
    return array("slider" => "Trình chiếu ảnh", "banner" => "Quảng cáo", "product" => "Sản phẩm", "articles" => "Bài viết");
}

function get_module_location()
{
    return array("header" => "Top đầu trang", "menu" => "Menu, Danh mục sản phẩm", "main" => "Chính giữa trang", "left" => "Phía bên trái", "right" => "Phía bên phải", "footer" => "Phía dưới trang");
}

function get_product_type()
{
    return array("hot" => "Sản phẩm nổi bật", "selling" => "Sản phẩm bán chạy", "sale" => "Sản phẩm giảm giá", "new" => "Sản phẩm mới");
}

function get_articles_type()
{
    return array("hot" => "Bài viết nổi bật", "view" => "Bài viết xem nhiều");
}

function get_checkout_type()
{
    return array('1' => "Khi nhận được hàng", '2' => "Chuyển khoản ngân hàng");
}

function get_invoice_state()
{
    return array('1' => "Đang chờ xét duyệt", '2' => "Chưa thanh toán", "3" => "Đã thanh toán");
}