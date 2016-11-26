<?php

class Index_model extends MY_Model {

    function __construct($type = null) {
        parent::__construct($type);
    }

    public function category_first_parent($data, $productcategory_id, $danhsach) {
        if (isset($data['parent'][$productcategory_id])) {
            return $data['parent'][$productcategory_id];
        } else
            return array();
    }

    public function category_all_child($data, $productcategory_id, $danhsach) {
        if (isset($data['parent'][$productcategory_id])) {
            foreach ($data['parent'][$productcategory_id] as $value) {
                if ($this->data["category"]['item'][$value]['productcategory_show'] == 1) {
                    $danhsach[] = $value;
                    $danhsach = $this->category_all_child($data, $value, $danhsach);
                }
            }
        }

        return $danhsach;
    }

    public function index() {

        $data = array();
        $concapmot = $this->category_first_parent($this->data["category"], 0, array());
        $limit = LIMITDANHMUCTRANGCHU;

        if (!$data["home_productcategory_data"] = $this->cache->get("sql/home_productcategory_data")) {

            $sql = ""; // Tạo sql cho lệnh select id
            $strdanhmuc = ""; // tạo str productcategory_id=? or ...
            foreach ($concapmot as $value) {
                if ($this->data["category"]['item'][$value]['productcategory_show'] == 1) {
                    $danhsachcon = array(); // liet ke danh sach con
                    if (empty($danhsachcon = $this->category_all_child($this->data["category"], $value, array())))
                        $danhsachcon = array($value);
                    else {
                        $listdanhmuc[$value] = $danhsachcon;   // để sau này add sản phẩm vô
                        array_push($danhsachcon, $value);
                    }
                }
                $sqlwhere = "  productcategory_id=" . implode(" or productcategory_id=", $danhsachcon); // tạo lệnh where cục bộ
                $strdanhmuc .= $sqlwhere . " or ";
                $sql .= "( SELECT * FROM (
select DISTINCT(product.product_id) from  product JOIN productcategory_detail ON product.product_id=productcategory_detail.product_id
where product_show=1 and product_date_create < now() and ( $sqlwhere )
order by product_index desc limit $limit  ) as t
) or  product.product_id in ";
            }
            
               
            $sql = "select product.product_id,productcategory_id,product_price,product_sale,product_feature,product_date_create,product_new, CAST((product_price-((product_sale/100)*product_price))  AS UNSIGNED ) as product_pricenew,product_name,product_slug,product_avatar,product_code,product_description from product JOIN productcategory_detail ON product.product_id=productcategory_detail.product_id where ( product.product_id in " . $sql . " (-1) ) GROUP by product.product_id order by product_index desc ";
            $kq = $this->mydb->select($sql, array());
            $kq = $this->mydb->select($sql, array());
            $data['home_productcategory_data'] = array();
            foreach ($concapmot as $value) {
                $thongtin = $this->data["category"]['item'][$value];
                $data['home_productcategory_data'][$value]['thongtin'] = $thongtin;
            }
            foreach ($kq as $key => $value) {


                if (in_array($value['productcategory_id'], $concapmot))
                    $data['home_productcategory_data'][$value['productcategory_id']]['data'][] = $value;
                else {
                    foreach ($listdanhmuc as $key => $value2) {
                        if (in_array($value['productcategory_id'], $value2)) {
                            $data['home_productcategory_data'][$key]['data'][] = $value;
                            break;
                        }
                    }
                }
            }
            CACHE == 1 ? $this->cache->save('sql/home_productcategory_data', $data["home_productcategory_data"], 300) : NULL;
        }
        return $data;
    }

}
