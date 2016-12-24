<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminsecurity
{
    public $controller = "";
    public $action = "";

    public function __construct()
    {
        // tham so truyen kieu mang
//          $this->CI = &get_instance();
//          $this->CI->load->library("mydb");
//
//        //  $this->url =$this->CI->uri->rsegments;
//        $this->mydb =$this->CI->mydb;


    }

    public $list_controller = array(

        "Cấu hình" => array(
            "attr" => "",
            "controller" =>
                array(
                    "menu" => array(
                        "attr" => array("label" => "Menu"),
                        "action" => array(
                            "index", "insert", "delete", "update", "load_menu_edit", "sort_menu"
                        ),
                    ),
                    "footer" => array(
                        "attr" => array("label" => "Footer"),
                        "action" => array(
                            "index", "insert", "delete", "update", "load_footer_edit", "sort_footer"
                        ),
                    ),
                    "config" => array(
                        "attr" => array("label" => "Cấu hình chung"),
                        "action" => array(
                            "index", "update"
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
                        "index", "insert", "delete", "update"
                    )

                ),
                "productcategory" => array(
                    "attr" => array("label" => "Danh mục sản phẩm"),
                    "action" => array(
                        "index", "insert", "delete", "update"
                    )

                ),
                "productattr" => array(
                    "attr" => array("label" => "Thuộc tính sản phẩm"),
                    "action" => array(
                        "index", "insert", "delete", "update", "attr_val", "delete_value", "update_value",
                        ""
                    )

                ), "product_prop" => array(
                    "attr" => array("label" => "Đặc tính sản phẩm"),
                    "action" => array(
                        "index", "insert", "delete", "update"
                    )

                ),
                "product" => array(
                    "attr" => array("label" => "Sản phẩm"),
                    "action" => array(
                        "index", "insert", "delete", "update", "create", "sort_product", "edit", "avatar", "upload_image", "sort_images"
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
                        "index", "insert", "delete", "update"
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
                        "index", "insert", "delete", "update"
                    )
                ),
                "articles" => array(
                    "attr" => array("label" => "Bài viết"),
                    "action" => array(
                        "index", "insert", "delete", "update", "avatar", "sort_articles"
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
                            "index", "v_create", "insert", "delete", "update"
                        ),
                    ),
                    "usergroup" => array(
                        "attr" => array("label" => "Nhóm tài khoản"),
                        "action" => array(
                            "index", "create", "insert", "delete", "update"
                        ),
                    ),
                    "role" => array(
                        "attr" => array("label" => "Phân quyền"),
                        "action" => array(
                            "index", "update"
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
                            "index"
                        )
                    )
                )
        ),
        "Extension" => array(
            "attr" => "",
            "controller" =>
                array(
                    "Tag" => array(
                        "attr" => array("label" => "Tag"),
                        "action" => array(
                            "index", "insert", "delete", "update", "load_tag_edit", "sort_tag"
                        ),
                    ),
                    "Media" => array(
                        "attr" => array("label" => "Quản lý Media"),
                        "action" => array(
                            "index"
                        )
                    )
                )
        )
    );

    public function menu_item()
    {
        $menu = array();
        foreach ($this->list_controller as $k => $v) {
            $menu[$k]["attr"] = $v["attr"];
            foreach ($v["controller"] as $k_item => $v_item) {
                $menu[$k]["item"][] = array("controller" => $k_item, "label" => $v_item["attr"]["label"], "active" => $k_item == $this->controller ? 1 : 0);
            }
        }
        return $menu;
    }

    public function list_role()
    {

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

    public function get_role($role_current)
    {
        $this->myrole = array();
        $result = $this->mydb->select("select role_controller,role_action from role where role_role=:role_role", array("role_role" => $role_current));
        foreach ($result as $k => $v) {
            $this->myrole[$v["role_controller"]][] = $v["role_action"];
        }
        return $this->myrole;
    }

    public function checkrole($controler = "", $action = "")
    {
        $this->controller = string_lower($controler);
        $this->action = string_lower($action);

    }
}

