<?php

class Product_like_model extends MY_Model
{

    function __construct($type = null)
    {
        parent::__construct($type);
    }

    function like($id_sanpham)
    {
        $this->mydb->exec("update product set product_like=product_like+1  where product_id=$id_sanpham");
        if (isset($_COOKIE['yeuthich'])) {
            $yeuthich = unserialize($_COOKIE['yeuthich']);
            if (!in_array($id_sanpham, $yeuthich)) {
                $yeuthich[] = $id_sanpham;
                create_cook("yeuthich", serialize($yeuthich));
            }
        } else {
            $yeuthich[] = $id_sanpham;
            create_cook("yeuthich", serialize($yeuthich));
        }
        return array("status" => 1, "data" => $yeuthich);
    }

    function deletelike($id_sanpham)
    {
        if (isset($_COOKIE['yeuthich'])) {
            $yeuthich = unserialize($_COOKIE['yeuthich']);

            if (in_array($id_sanpham, $yeuthich)) {
                $key = array_keys($yeuthich, $id_sanpham);
                unset($yeuthich[$key[0]]);
                if (empty($yeuthich))
                    delete_cook("yeuthich");
                else
                    create_cook("yeuthich", serialize($yeuthich));
                return array("status" => 1);
            }

        }
    }

}
