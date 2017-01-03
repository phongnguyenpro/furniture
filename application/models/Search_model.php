<?php

class Search_model extends MY_Model
{

    function __construct($type = null)
    {
        parent::__construct($type);
    }


    function index($str, $category_id = -1)
    {
        if (is_numeric($str)) {
            $sqlgia = " or (" . ($str) . " >= product_price )";
        } else $sqlgia = '';

        $sqltag = "or ( product.product_id in 
(
select product_id from product_tag,tag  where tag.tag_id=product_tag.tag_id and (tag_name like '%$str%' or tag_search like '%$str%')
)
)";

        if ($category_id == -1) {

            $sql = "select product_avatar,product_id,product_code,product_name,product_slug,product_price,product_description from product where product_show=1 and ( product_id='$str' or product_name like '%$str%' or product_code like '%$str%' or product_price like '%$str%' or product_search like '%$str%' $sqlgia ) $sqltag limit 10";

        } else {

            $this->load->model("module/header_model");
            $danhsachcon = search_all_child($this->header_model->category(), $category_id, array($category_id));
            $sqlwhere = "productcategory_id=" . implode(" or category_id=", $danhsachcon);
            debug($sqlwhere);
            $sql = "select product_avatar,product.product_id,product_code,product_name,product_slug,product_price,product_description  from product,productcategory_detail where product_show=1 and product.product_id=productcategory_detail.product_id  and ($sqlwhere) and ( product.product_id='$str' or product_name like '%$str%' or product_code like '%$str%' or product_price like '%$str%' or product_search like '%$str%' $sqlgia $sqltag)
GROUP by product.product_id limit 10";
        }
        if (!empty($kq = $this->mydb->select($sql))) {
            $data = array("tinhtrang" => 1);
            $data['data'] = $kq;
        } else {
            $data = array("tinhtrang" => 0);
        }
        return $data;
    }

}