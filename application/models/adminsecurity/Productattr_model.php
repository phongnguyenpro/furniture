<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Productattr_model
 *
 * @author Phong
 */
class Productattr_model extends MY_Model {

    //put your code here


    function index() {
        $result = $this->mydb->select("select * from productattr,career where  productattr.career_id=career.career_id order by career.career_index,productattr.productattr_index", array());
        $data = array();
        foreach ($result as $key => $value) {
            $data[$value['career_name']][] = $value;
        }
        return $data;
    }

    function insert($data) {
        $kq = $this->mydb->select("select max(productattr_index) as max from productattr", array());
        $max = $kq[0]['max'] + 1;
        $data['productattr_index'] = $max;
        $data['productattr_date_update'] = today();
        $this->mydb->insert("productattr", $data);
        header("Location:" . ADMIN_URL . "productattr/index?career_id=" . $data['career_id']);
    }

    function sort_attr($data) {

        foreach ($data as $value) {
            $dataupdate['productattr_id'] = $value['id'];
            $dataupdate['productattr_index'] = $value['index'];
            $dataupdate['productattr_date_update'] = today();
            $this->mydb->update("productattr", $dataupdate, "productattr_id=:productattr_id", array('productattr_id' => $value['id']));
        }
        echo json_encode(array("status" => 1));
    }

    function update($data) {
        isset($data["productattr_showfilter"]) ? $data["productattr_showfilter"] = 1 : $data["productattr_showfilter"] = 0;
        $productattr_id = $data['productattr_id'];
        $kq = $this->mydb->select("select career_id from productattr where productattr_id=:productattr_id", array("productattr_id" => $productattr_id));
        $current_career = $kq[0]['career_id'];

        if ($current_career != $data['career_id']) {
            // xoa san pham chi tiet 
            //    $kq = $this->select("select id_sanphamchitiet from thuoctinhchonchitiet where id_thuoctinhchon=:id_thuoctinhchon and id_sanphamchitiet!=-1 and id_sanphamchitiet!=-2", array("id_thuoctinhchon" => $id_thuoctinhchon));
//            if (!empty($kq)) {
//                foreach ($kq as $value) {
//                    $temp[] = $value['id_sanphamchitiet'];
//                }
//                $sqlwhere = "id_sanphamchitiet=" . implode(" or id_sanphamchitiet=", $temp);
//                $this->exec("delete from thuoctinhchonchitiet where ($sqlwhere)");
//                $this->exec("delete from sanphamchitiet where ($sqlwhere)");
//            }
            // xoa chung
            //    $this->deleteall("thuoctinhchonchitiet", "id_thuoctinhchon=:id_thuoctinhchon", array("id_thuoctinhchon" => $id_thuoctinhchon));
        }
        $this->mydb->update("productattr", $data, "productattr_id=:productattr_id", array('productattr_id' => $data['productattr_id']));
        header("Location:" . ADMIN_URL . "productattr");
    }

    function delete($productattr_id) {
        // xóa sản phẩm chi tiết
        // select id_sanphamchitiet
        //    $kq = $this->mydb->select("select id_sanphamchitiet from thuoctinhchonchitiet where id_thuoctinhchon=:id_thuoctinhchon and id_sanphamchitiet!=-1 and id_sanphamchitiet!=-2", array("id_thuoctinhchon" => $idxoa));
        //  if (!empty($kq)) {
        //     foreach ($kq as $value) {
        //          $temp[] = $value['id_sanphamchitiet'];
        //    }
        //     $sqlwhere = "id_sanphamchitiet=" . implode(" or id_sanphamchitiet=", $temp);
        //     $this->exec("delete from thuoctinhchonchitiet where ($sqlwhere)");
        //      $this->exec("delete from sanphamchitiet where ($sqlwhere)");
        // }
// xóa thuộc tính chon chi tiết
        // $this->deleteall("thuoctinhchonchitiet", "id_thuoctinhchon=:id_thuoctinhchon", array("id_thuoctinhchon" => $idxoa));
        // xóa giá trị thuộc tính chọn
        //  $this->deleteall("giatrithuoctinhchon", "id_thuoctinhchon=:id_thuoctinhchon", array("id_thuoctinhchon" => $idxoa));
// xóa thuộc tính chọn
        $this->mydb->delete("productattr", "productattr_id=:productattr_id", array("productattr_id" => $productattr_id));
        header("Location:" . ADMIN_URL . "productattr");
    }

    function attr_val($productattr_id) {
        return $this->mydb->select("select * from attr_val where productattr_id=:productattr_id order by attr_val_index",array("productattr_id"=>$productattr_id));
    }

    function attr_val_info($productattr_id) {
        $result = $this->mydb->select("select productattr_name from productattr where productattr_id=:productattr_id", array("productattr_id" => $productattr_id));
        $productattr_name = $result[0]["productattr_name"];
        return array("productattr_id" => $productattr_id, "productattr_name" => $productattr_name);
    }

    function attr_val_insert($data) {
        $result = $this->mydb->select("select max(attr_val_index) as max from attr_val where productattr_id=:productattr_id", array("productattr_id" => $data["productattr_id"]));
        $data["attr_val_index"] = $result[0]['max'] + 1;
        $this->mydb->insert("attr_val", $data);
        header("Location:" . ADMIN_URL . "productattr/v_attr_val/" . $data["productattr_id"]);
    }

    function attr_val_update($data) {
        $this->mydb->update("attr_val", $data, "attr_val_id=:attr_val_id", array("attr_val_id" => $data["attr_val_id"]));
        Header("Location:" . ADMIN_URL . "productattr/v_attr_val/" . $data["productattr_id"]);
    }

    function attr_val_sort($data) {
        foreach ($data as $value) {
            $dataupdate['attr_val_id'] = $value['id'];
            $dataupdate['attr_val_index'] = $value['index'];
            $dataupdate['attr_val_date_update'] = today();
            $this->mydb->update("attr_val", $dataupdate, "attr_val_id=:attr_val_id", array('attr_val_id' => $value['id']));
        }
        echo json_encode(array("status" => 1));
    }

    function attr_val_delete($attr_val_id,$productattr_id) {
        // select id_sanphamchitiet
       // $kq = $this->select("select id_sanphamchitiet from thuoctinhchonchitiet where id_giatrithuoctinhchon=:id_giatrithuoctinhchon and id_sanphamchitiet!=-1 and id_sanphamchitiet!=-2", array("id_giatrithuoctinhchon" => $idxoa));
      //  if (!empty($kq)) {
       //     foreach ($kq as $value) {
       //         $temp[] = $value['id_sanphamchitiet'];
       //     }
       //     $sqlwhere = "id_sanphamchitiet=" . implode(" or id_sanphamchitiet=", $temp);
       //     $this->exec("delete from thuoctinhchonchitiet where ($sqlwhere)");
       //     $this->exec("delete from sanphamchitiet where ($sqlwhere)");
      //  }
      //  $this->deleteall("thuoctinhchonchitiet", "id_giatrithuoctinhchon=:id_giatrithuoctinhchon", array("id_giatrithuoctinhchon" => $idxoa));
        $this->mydb->delete("attr_val", "attr_val_id=:attr_val_id", array("attr_val_id" => $attr_val_id));
        Header("Location:" . ADMIN_URL . "productattr/v_attr_val/" .$productattr_id);
    }
    function load_attr_condition($career_id)
    {
       $result=$this->mydb->select("select * from productattr where career_id=:career_id order by productattr_index",array("career_id"=>$career_id));  

       $product_attr=$result;
       $temp=array();
       foreach ($product_attr as $k=>$v)
       {
           $temp[]=$v['productattr_id'];
       }
       if(!empty($temp))
       {
       $sqlwhere= "productattr_id=".implode(" or productattr_id=", $temp);
       $result=$this->mydb->select("select * from attr_val where ($sqlwhere)  order by attr_val_index",array()); 
       }
else 
{
            $result=$this->mydb->select("select * from attr_val order by attr_val_index",array()); 
}
        
        foreach ($result as $key=>$value)
        {
            $attr_value[$value['productattr_id']][]=$value;
        }
 
        foreach ($product_attr as $key=>$value)
        {
           if(isset($attr_value[$value['productattr_id']]))
            $product_attr[$key]['value']= $attr_value[$value['productattr_id']];
        }
        return $product_attr;
    }
}
