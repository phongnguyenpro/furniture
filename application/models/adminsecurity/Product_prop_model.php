<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product_prop_model extends MY_Model
{

    function index()
    {
        $result = $this->mydb->select("select * from product_prop,career where  product_prop.career_id=career.career_id order by career_index,product_prop.product_prop_index", array());
        $data = array();
        foreach ($result as $key => $value) {
            $data[$value['career_name']][] = $value;
        }
        return $data;
    }

    function insert($data)
    {
        $kq = $this->mydb->select("select max(product_prop_index) as max from product_prop", array());
        $max = $kq[0]['max'] + 1;
        $data['product_prop_index'] = $max;
        $data['product_prop_date_update'] = today();
        $this->mydb->insert("product_prop", $data);
        header("Location:" . ADMIN_URL . "product_prop/index?career_id=" . $data['career_id']);
    }

    function product_prop_sort($data)
    {

        foreach ($data as $value) {
            $dataupdate['product_prop_id'] = $value['id'];
            $dataupdate['product_prop_index'] = $value['index'];
            $dataupdate['product_prop_date_update'] = today();
            $this->mydb->update("product_prop", $dataupdate, "product_prop_id=:product_prop_id", array('product_prop_id' => $value['id']));
        }
        echo json_encode(array("status" => 1));
    }

    function update($data)
    {

        $result = $this->mydb->select("select career_id from product_prop where product_prop_id=:product_prop_id", array("product_prop_id" => $data["product_prop_id"]));
        $current_career = $result[0]['career_id'];
        if ($current_career != $data['career_id']) {
            //    $this->deleteall("thuoctinhchitiet","id_thuoctinh=:id_thuoctinh",array("id_thuoctinh"=>$idedit)); 
        }
        $this->mydb->update("product_prop", $data, "product_prop_id=:product_prop_id", array('product_prop_id' => $data['product_prop_id']));
        header("Location:" . ADMIN_URL . "product_prop");
    }

    function delete($id, $type = 1)
    {
        $this->mydb->delete("product_prop", "product_prop_id=:product_prop_id", array("product_prop_id" => $id));
        $this->mydb->delete("product_prop_detail", "product_prop_id=:product_prop_id", array("product_prop_id" => $id));
        if ($type == 1)
            header("Location:" . ADMIN_URL . "product_prop");
    }

    function load_prop_condition($career_id)
    {
        return $this->mydb->select("select * from product_prop where career_id=:career_id order by product_prop_index", array("career_id" => $career_id));
    }

}
