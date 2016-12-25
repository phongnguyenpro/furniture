<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminsecurity {

    public $controller = "";
    public $action = "";
    public $isajax = false;

    public function __construct() {
        // tham so truyen kieu mang
//          $this->CI = &get_instance();
//          $this->CI->load->library("mydb");
//
//        //  $this->url =$this->CI->uri->rsegments;
//        $this->mydb =$this->CI->mydb;

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->isajax = TRUE;
        }
    }

    public function menu_item() {

        $menu = array();
        foreach ($this->list_controller as $k => $v) {
            $menu[$k]["attr"] = $v["attr"];
            foreach ($v["controller"] as $k_item => $v_item) {
                $menu[$k]["item"][] = array("controller" => $k_item, "label" => $v_item["attr"]["label"], "active" => $k_item == $this->controller ? 1 : 0);
            }
        }
        return $menu;
    }

    public function list_role() {

        $list_role = array();
        foreach ($this->list_controller as $k => $v) {
            foreach ($v["controller"] as $k_item => $v_item) {
                $list_role[$k_item] = array();
                foreach ($v_item["action"] as $k_action => $val_action) {
                    $list_role[$k_item][] = $val_action;
                }
            }
        }
        return $list_role;
    }

    public function get_role($role_current) {
        $this->myrole = array();
        $result = $this->mydb->select("select role_controller,role_action from role where role_role=:role_role", array("role_role" => $role_current));
        foreach ($result as $k => $v) {
            $this->myrole[$v["role_controller"]][] = $v["role_action"];
        }
        return $this->myrole;
    }

    public function checkrole($controler = "", $action = "") {
        $this->controller = string_lower($controler);
        $this->action = string_lower($action);
    }

    public $list_controller = array(
        "Cấu hình" => array(
            "attr" => "",
            "controller" =>
            array(
                "menu" => array(
                    "attr" => array("label" => "Menu"),
                    "action" => array(
                        array(
                            "label" => "Hiển thị menu",
                            "value" => "index"
                        ),
                        array(
                            "label" => "Thêm menu",
                            "value" => "insert"
                        ),
                        array(
                            "label" => "Xóa menu",
                            "value" => "delete"
                        ),
                        array(
                            "label" => "Cập nhật menu",
                            "value" => "update"
                        ),
                        array(
                            "label" => "Xem chi tiết menu",
                            "value" => "load_menu_edit"
                        ),
                        array(
                            "label" => "Sắp xếp menu",
                            "value" => "sort_menu"
                        ),
                    ),
                ),
                "footer" => array(
                    "attr" => array("label" => "Footer"),
                    "action" => array(
                        array(
                            "label" => "Hiển thị footer",
                            "value" => "index"
                        ),
                        array(
                            "label" => "Thêm footer",
                            "value" => "insert"
                        ),
                        array(
                            "label" => "Xóa footer",
                            "value" => "delete"
                        ),
                        array(
                            "label" => "Cập nhật footer",
                            "value" => "update"
                        ),
                        array(
                            "label" => "Xem thông tin footer",
                            "value" => "load_footer_edit"
                        ),
                        array(
                            "label" => "Sắp xếp footer",
                            "value" => "sort_footer"
                        ),
                    ),
                ),
                "config" => array(
                    "attr" => array("label" => "Cấu hình chung"),
                    "action" => array(
                        array(
                            "label" => "Hiển thị cấu hình",
                            "value" => "index"
                        ),
                        array(
                            "label" => "Cập nhật cấu hình",
                            "value" => "update"
                        ),
                    ),
                )
            )
        ),
        "Sản phẩm" => array(
            "attr" => "",
            "controller" => array(
                "career" => array(
                    "attr" => array("label" => "Ngành nghề"),
                    "action" => array(
                        array(
                            "label" => "Hiển thị ngành nghề",
                            "value" => "index"
                        ),
                        array(
                            "label" => "Thêm ngành nghề",
                            "value" => "insert"
                        ),
                        array(
                            "label" => "Xóa ngành nghề",
                            "value" => "delete"
                        ),
                        array(
                            "label" => "Cập nhật ngành nghề",
                            "value" => "update"
                        ),
                    )
                ),
                "productcategory" => array(
                    "attr" => array("label" => "Danh mục sản phẩm"),
                    "action" => array(
                        array(
                            "label" => "Hiển thị danh mục sản phẩm",
                            "value" => "index"
                        ),
                        array(
                            "label" => "Thêm danh mục sản phẩm",
                            "value" => "insert"
                        ),
                        array(
                            "label" => "Xóa danh mục sản phẩm",
                            "value" => "delete"
                        ),
                        array(
                            "label" => "Cập nhật danh mục sản phẩm",
                            "value" => "update"
                        ),
                        array(
                            "label" => "Xem thông tin danh mục sản phẩm",
                            "value" => "load_category_edit"
                        ),
                        array(
                            "label" => "Sắp xếp danh mục sản phẩm",
                            "value" => "sort_category"
                        ),
                    )
                ),
                "productattr" => array(
                    "attr" => array("label" => "Thuộc tính sản phẩm"),
                    "action" => array(
                        array(
                            "label" => "Hiển thị thuộc tính",
                            "value" => "index"
                        ),
                        array(
                            "label" => "Thêm thuộc tính",
                            "value" => "insert"
                        ),
                        array(
                            "label" => "Xóa thuộc tính",
                            "value" => "delete"
                        ),
                        array(
                            "label" => "Cập nhật thuộc tính",
                            "value" => "update"
                        ),
                        array(
                            "label" => "Sắp xếp danh mục sản phẩm",
                            "value" => "sort_attr"
                        ),
                        array(
                            "label" => "Xem Gg trị thuộc tính",
                            "value" => "v_attr_val"
                        ),
                        array(
                            "label" => "Thêm giá trị thuộc tính",
                            "value" => "attr_val_insert"
                        ),
                        array(
                            "label" => "Xóa giá trị thuộc tính",
                            "value" => "attr_val_delete"
                        ),
                        array(
                            "label" => "Cập nhật giá trị thuộc tính",
                            "value" => "attr_val_delete"
                        ),
                        array(
                            "label" => "Sắp xếp giá trị thuộc tính",
                            "value" => "attr_val_sort"
                        ),
                    )
                ), "product_prop" => array(
                    "attr" => array("label" => "Đặc tính sản phẩm"),
                    "action" => array(
                        array(
                            "label" => "Hiển thị đặc tính",
                            "value" => "index"
                        ),
                        array("label" => "Thêm đặc tính",
                            "value" => "insert"
                        ),
                        array("label" => "Xóa đặc tính",
                            "value" => "delete"
                        ),
                        array("label" => "Cập nhật đặc tính",
                            "value" => "update"
                        ),
                        array("label" => "Sắp xếp đặc tính",
                            "value" => "product_prop_sort"
                        ),
                    )
                ),
                "product" => array(
                    "attr" => array("label" => "Sản phẩm"),
                    "action" => array(
                        array("label" => "Hiển thị sản phẩm",
                            "value" => "index"
                        ),
                        array("label" => "Lọc sản phẩm",
                            "value" => "load_data_ssp"
                        ),
                        array("label" => "Hiển thị thêm sản phẩm",
                            "value" => "create"
                        ),
                        array("label" => "Thêm sản phẩm",
                            "value" => "insert"
                        ),
                        array("label" => " Xóa sản phẩm",
                            "value" => "delete"
                        ),
                        array("label" => " Xem thông tin sản phẩm",
                            "value" => "edit"
                        ),
                        array("label" => " Cập nhật sản phẩm",
                            "value" => "update"
                        ),
                        array("label" => "Sắp xếp sản phẩm",
                            "value" => "sort_product"
                        ),
                        array("label" => "Cập nhật hình đại diện",
                            "value" => "avatar"
                        ),
                        array("label" => "Thêm hình sản phẩm",
                            "value" => "upload_image"
                        ),
                        array("label" => "Sắp xếp hình sản phẩm",
                            "value" => "sort_image"
                        ),
                        array("label" => "Xóa thư mục hình temp",
                            "value" => "delete_temp_forder"
                        ),
                        array("label" => "Xóa hình sản phẩm",
                            "value" => "delete_image"
                        ),
                        array("label" => "Thêm sản phẩm chi tiết",
                            "value" => "add_product_detail"
                        ),
                        array("label" => "Cập nhật sản phẩm chi tiết",
                            "value" => "update_product_detail"
                        ),
                        array("label" => "Xóa sản phẩm chi tiết",
                            "value" => "delete_product_detail"
                        ),
                        array("label" => "Xóa hình sản phẩm chi tiết",
                            "value" => "delete_image_product_detail"
                        ),
                    )
                )
            )
        ),
        "Hóa đơn" => array(
            "attr" => "",
            "controller" => array(
                "invoice" => array(
                    "attr" => array("label" => "Tất cả hóa đơn"),
                    "action" => array(
                        array("label" => "Hiển thị danh sách hóa đơn",
                            "value" => "index"
                        ),
                        array("label" => "Lọc hóa đơn",
                            "value" => "load_data_ssp"
                        ),
                        array("label" => "Xem chi tiết hóa đơn",
                            "value" => "view"
                        ),
                        array("label" => "Xóa hóa đơn",
                            "value" => "delete_invoice"
                        ),
                        array("label" => "Cập nhật hóa đơn",
                            "value" => "update_invoice"
                        ),
                        array("label" => "Cập nhật số lượng sản phẩm",
                            "value" => "update_quantity"
                        ),
                        array("label" => "Xóa hóa đơn chi tiết",
                            "value" => "delete_invoice_detail"
                        ),
                        array("label" => "Thanh toán hóa đơn",
                            "value" => "invoice_payment"
                        ),
                    )
                )
            )
        ),
        "Bài viết" => array(
            "attr" => "",
            "controller" => array(
                "articlescategory" => array(
                    "attr" => array("label" => "Danh mục bài viết"),
                    "action" => array(
                        array("label" => "Hiển thị danh mục bài viết",
                            "value" => "index"
                        ),
                        array("label" => "Tạo danh mục bài viết",
                            "value" => "create_articles_category"
                        ),
                        array("label" => "Xóa danh mục bài viết",
                            "value" => "delete_articles_category"
                        ),
                        array("label" => "Xem thông tin danh mục bài viết",
                            "value" => "load_info_articles_category"
                        ),
                        array("label" => "Cập nhật thông tin danh mục bài viết",
                            "value" => "update_info_articles_category"
                        ),
                        array("label" => "Sắp xếp danh mục bài viết",
                            "value" => "sort"
                        ),
                    )
                ),
                "articles" => array(
                    "attr" => array("label" => "Bài viết"),
                    "action" => array(
                        array("label" => "Hiển thị bài viết",
                            "value" => "index"
                        ),
                        array("label" => "Lọc bài viết",
                            "value" => "articles_ajax"
                        ),
                        array("label" => "Hiển thị thêm",
                            "value" => "create"
                        ),
                        array("label" => "Thêm bài viết",
                            "value" => "insert"
                        ),
                        array("label" => "Hiển thị bài viết",
                            "value" => "show"
                        ),
                        array("label" => "Sắp xếp bài viết",
                            "value" => "sort_articles"
                        ),
                        array("label" => "Xóa bài viết",
                            "value" => "delete_articles"
                        ),
                        array("label" => "Hiển thị chi tiết bài viết",
                            "value" => "edit_articles"
                        ),
                        array("label" => "Cập nhật bài viết",
                            "value" => "update_articles"
                        ),
                    )
                )
            )
        ),
        "User" => array(
            "attr" => "",
            "controller" =>
            array(
                "user" => array(
                    "attr" => array("label" => "Tài khoản"),
                    "action" => array(
                        array("label" => "Hiển thị thêm tài khoản",
                            "value" => "v_create"
                        ),
                        array("label" => "Thêm tài khoản",
                            "value" => "insert"
                        ),
                    ),
                ),
                "usergroup" => array(
                    "attr" => array("label" => "Nhóm tài khoản"),
                    "action" => array(
                        array("label" => "Hiển thị danh sách",
                            "value" => "index"
                        ),
                        array("label" => "Thêm nhóm tài khoản",
                            "value" => "insert"
                        ),
                        array("label" => "Xóa nhóm tài khoản",
                            "value" => "delete"
                        ),
                        array("label" => "Update nhóm tài khoản",
                            "value" => "update"
                        ),
                        array("label" => "Xem thông tin nhóm tài khoản",
                            "value" => "load_usergroup_edit"
                        ),
                        array("label" => "Sắp xếp nhóm tài khoản",
                            "value" => "usergroup_sort"
                        ),
                    ),
                ),
                "role" => array(
                    "attr" => array("label" => "Phân quyền"),
                    "action" => array(
                        array("label" => "Hiển thị danh sách quyền",
                            "value" => "index"
                        ),
                        array("label" => "Cập nhật quyền",
                            "value" => "update"
                        ),
                    )
                )
            )
        ),
        "Module" => array(
            "attr" => "",
            "controller" =>
            array(
                "module" => array(
                    "attr" => array("label" => "Quản lý"),
                    "action" => array(
                        array("label" => "Danh sách trang",
                            "value" => "index"
                        ),
                        array("label" => "Danh sách module",
                            "value" => "detail"
                        ),
                        array("label" => "Thêm module",
                            "value" => "insert"
                        ),
                        array("label" => "Xóa module",
                            "value" => "delete"
                        ),
                        array("label" => "Xem thông tin module",
                            "value" => "config"
                        ),
                        array("label" => "Cập nhật module",
                            "value" => "update"
                        ),
                    )
                )
            )
        ),
        "Extension" => array(
            "attr" => "",
            "controller" =>
            array(
                "tag" => array(
                    "attr" => array("label" => "Tag"),
                    "action" => array(
                        array("label" => "Danh sách tag",
                            "value" => "index"
                        ),
                        array("label" => "Tạo mới",
                            "value" => "create_tag"
                        ),
                        array("label" => " Xóa tag ",
                            "value" => "delete_tag"
                        ),
                        array("label" => "Cập nhật ",
                            "value" => "update_tag"
                        ),
                        array("label" => "Sắp xếp",
                            "value" => "sort_tag"
                        ),
                    ),
                ),
                "media" => array(
                    "attr" => array("label" => "Quản lý Media"),
                    "action" => array(
                        array("label" => "Quản lý media",
                            "value" => "index"
                        ),
                        array("label" => "Quản lý hình ảnh",
                            "value" => "selectphoto"
                        ),
                    )
                )
            )
        )
    );

}
