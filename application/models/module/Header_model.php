<?php

class Header_model extends MY_Model
{

    public function __construct()
    {

    }

    function category()
    {
        // lấy danh mục sản phẩm
        $menuData = array();
        $sql = "select * from productcategory where productcategory_show=1 order by productcategory_index";
        $kq = $this->mydb->select($sql, array());

        foreach ($kq as $value) {
            $menuData['item'][$value['productcategory_id']] = $value; //Lưu dữ liệu các biến có id khác nh
            $menuData['parent'][$value['productcategory_parent']][] = $value['productcategory_id'];
        }
        return $menuData;
    }

    function articles_category()
    {
        // lấy danh mục sản phẩm
        $menuData = array();
        $sql = "select * from articlescategory order by articlescategory_index";
        $kq = $this->mydb->select($sql, array());

        foreach ($kq as $value) {
            $menuData['item'][$value['articlescategory_id']] = $value; //Lưu dữ liệu các biến có id khác nh
            $menuData['parent'][$value['articlescategory_parent']][] = $value['articlescategory_id'];
        }
        return $menuData;
    }

    function menu()
    {
        $menuData = array();
        $sql = "select * from menu WHERE menu_type=1 order by menu_index";
        $kq = $this->mydb->select($sql);

        foreach ($kq as $value) {
            $menuData['item'][$value['menu_id']] = $value; //Lưu dữ liệu các biến có id khác nh
            $menuData['parent'][$value['menu_parent']][] = $value['menu_id'];

        }

        return $menuData;
    }

    function footer()
    {
        $menuData = array();
        $sql = "select * from menu where menu_type=2 order by menu_index";
        $kq = $this->mydb->select($sql, array());

        foreach ($kq as $value) {
            $menuData['item'][$value['menu_id']] = $value;//Lưu dữ liệu các biến có id khác nh
            $menuData['parent'][$value['menu_parent']][] = $value['menu_id'];
        }

        return $menuData;
    }

}
