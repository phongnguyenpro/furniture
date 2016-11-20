<?php

class Header_model  extends MY_Model{

    public function __construct() {
        
    }

    function category() {
        // lấy danh mục sản phẩm

        $menuData = array();
        //    $filecache="public/cache/sql_".NGONNGU."_danhmucsanpham.html";
        // if($this->cache->kiemtra($filecache))
        //{
        //   $menuData=$this->cache->getcachesql($filecache);
        //}
        //else
        //{
        $sql = "select * from productcategory where productcategory_show=1 order by productcategory_index";
        $kq = $this->mydb->select($sql, array());

        foreach ($kq as $value) {
            $menuData['item'][$value['productcategory_id']] = $value; //Lưu dữ liệu các biến có id khác nh
            $menuData['parent'][$value['productcategory_parent']][] = $value['productcategory_id'];
        }
        // $this->cache->putcachesql($filecache,$menuData);
        //}
        return $menuData;
    }

}
