<?php

class Career_model extends MY_Model
{

    public $career_id;
    public $career_name;
    public $career_index;
    public $career_date_update;
    public $career_user_update;

    function __construct($type = null)
    {
        parent::__construct($type);
    }

    function index()
    {
        return $this->mydb->select("select * from career order by career_index");
    }

    function sort_career($data)
    {

        foreach ($data as $value) {
            $dataupdate['career_index'] = $value['career_index'];
            $dataupdate['career_date_update'] = today();
            $this->mydb->update("career", $dataupdate, "career_id=:career_id", array('career_id' => $value['career_id']));
        }
        echo json_encode(array("status" => 1));
    }

    public function insert($career_name)
    {
        $kq = $this->mydb->select("select max(career_index) as max from career", array());
        $max = $kq[0]['max'] + 1;

        $this->mydb->insert("career", array('career_name' => $career_name, 'career_index' => $max, "career_date_update" => today()));
        header("Location:" . ADMIN_URL . "career");
    }

    public function update($career_name, $career_id)
    {
        $this->mydb->update("career", array('career_name' => $career_name, "career_date_update" => today()), "career_id=:career_id", array('career_id' => $career_id));
        header("Location:" . ADMIN_URL . "career");
    }

    public function delete($idxoa)
    {
        $this->load->model(array("adminsecurity/productcategory_model"));
        $this->load->model(array("adminsecurity/product_model"));;
        $this->load->model(array("adminsecurity/productattr_model"));;
        $this->load->model(array("adminsecurity/product_prop_model"));;

        // delete prodcut category
        $kq = $this->mydb->select("select productcategory_id from productcategory where career_id=:career_id", array("career_id" => $idxoa));
        foreach ($kq as $value) {
            $id_danhmuc = $value['productcategory_id'];
            $this->productcategory_model->delete($id_danhmuc);
        }

        // delete product attr
        $kq = $this->mydb->select("select productattr_id from productattr where career_id=:career_id", array("career_id" => $idxoa));
        foreach ($kq as $value) {
            $id_thuoctinhchon = $value['productattr_id'];
            $this->productattr_model->delete($id_thuoctinhchon, 2);
        }

        // delete product prop
        $kq = $this->mydb->select("select product_prop_id from product_prop where career_id=:career_id", array("career_id" => $idxoa));
        foreach ($kq as $value) {
            $id_thuoctinh = $value['product_prop_id'];
            $this->product_prop_model->delete($id_thuoctinh, 2);
        }
//        // Xóa sản phẩm
//        $kq = $this->mydb->select("select product_id from product where career_id=:career_id", array("career_id" => $idxoa));
//        foreach ($kq as $value) {
//            $id_sanpham = $value['product_id'];
//            $this->product_model->delete($id_sanpham);
//        }


        $this->mydb->delete("career", "career_id=:career_id", array("career_id" => $idxoa));
        header("Location:" . ADMIN_URL . "career");
    }

}
