<?php

class Header_model  extends MY_Model{

    public function __construct() {
        
    }

    function category(){
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
    
    function menu()
    {
          $menuData = array();
        $sql = "select * from menu  order by menu_index";
        $kq = $this->mydb->select($sql);

        foreach ($kq as $value) {
            $menuData['item'][$value['menu_id']] = $value; //Lưu dữ liệu các biến có id khác nh
            $menuData['parent'][$value['menu_parent']][] = $value['menu_id'];
         
        }
      
        return $menuData;
    }

}
