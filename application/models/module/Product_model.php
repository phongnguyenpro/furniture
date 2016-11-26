<?php

class Product_model extends MY_Model {

    function update(&$data) {
        $module_product_type = isset($data["module_product_type"]) ?$data["module_product_type"] :"hot";
        unset($data["module_product_type"]);
         $module_product_limit = isset($data["module_product_limit"]) ? $data["module_product_limit"] :1;
        unset($data["module_product_limit"]);
      
        $data["module_config"] = serialize(array("module_product_type"=>$module_product_type,
                                                 "module_product_limit"=>$module_product_limit
                                                            ));
    }

    function load_product($config) {
        $product_type = $config["module_product_type"];
        if ( $config["module_product_limit"] != '' &&  $config["module_product_limit"] != 0)
            $limit = $config["module_product_limit"];
        else
            $limit = LIMITMODULE;
        $data = array();

        switch ($product_type) {
            case "hot":
                $data = $this->select("select  id_sanpham,tensanpham,noibat,moi,giamgia,ngaytao,slugsanpham,gia,hinhdaidien,masanpham,ngangon,giamgia,CAST((gia-((giamgia/100)*gia))  AS UNSIGNED ) as giamoi from sanpham where ngaytao<now() and noibat=1 and hienthi=1 and (id_ngonngu=:id_ngonngu or id_ngonngu=-1) order by stt desc limit $limit ", array("id_ngonngu" => NGONNGU));
                break;
            case "selling":
                $data = $this->select("select  id_sanpham,tensanpham,noibat,moi,giamgia,ngaytao,slugsanpham,gia,hinhdaidien,masanpham,ngangon,giamgia,CAST((gia-((giamgia/100)*gia))  AS UNSIGNED ) as giamoi from sanpham where ngaytao<now() and banchay=1 and hienthi=1 and (id_ngonngu=:id_ngonngu or id_ngonngu=-1) order by stt desc limit $limit ", array("id_ngonngu" => NGONNGU));
                break;
            case "new":
                $data = $this->select("select  id_sanpham,tensanpham,noibat,moi,giamgia,ngaytao,slugsanpham,gia,hinhdaidien,masanpham,ngangon,giamgia,CAST((gia-((giamgia/100)*gia))  AS UNSIGNED ) as giamoi from sanpham where ngaytao<now() and moi=1 and hienthi=1 and (id_ngonngu=:id_ngonngu or id_ngonngu=-1) order by stt desc limit $limit ", array("id_ngonngu" => NGONNGU));
                break;
            case "sale":
                $data = $this->select("select  id_sanpham,tensanpham,noibat,moi,giamgia,ngaytao,slugsanpham,gia,hinhdaidien,masanpham,ngangon,giamgia,CAST((gia-((giamgia/100)*gia))  AS UNSIGNED ) as giamoi from sanpham where ngaytao<now() and giamgia>0 and hienthi=1 and (id_ngonngu=:id_ngonngu or id_ngonngu=-1) order by stt desc limit $limit ", array("id_ngonngu" => NGONNGU));
                break;

            default :

                break;
        }
    }

}
