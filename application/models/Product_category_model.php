<?php

class Product_category_model extends MY_Model
{

    function __construct($type = null)
    {
        parent::__construct($type);
    }

    public $danhmucsanpham;
    public $thuoctinhchon;

    public function setProductCategory($data)
    {
        $this->danhmucsanpham = $data;
    }

    public function findChildCategory_FirstLevel($data, $id_danhmuc, $danhsach)
    {
        if (isset($data['parent'][$id_danhmuc])) {
            return $data['parent'][$id_danhmuc];
        } else
            return false;
    }

    public function findChildCategory_AllLevel($data, $id_danhmuc, $danhsach)
    {
        if (isset($data['parent'][$id_danhmuc])) {
            foreach ($data['parent'][$id_danhmuc] as $value) {
                $danhsach[] = $value;
                $danhsach = $this->findChildCategory_AllLevel($data, $value, $danhsach);
            }
        }
        return $danhsach;
    }

    public function findParentAll($data, $id_danhmuc, $danhsach)
    {
        if (isset($data['item'][$id_danhmuc]['productcategory_id'])) {
            // thong tin cho bre
            $temp['productcategory_id'] = $data['item'][$id_danhmuc]['productcategory_id'];
            $temp['ten'] = $data['item'][$id_danhmuc]['productcategory_name'];
            $temp['slug'] = BASE_URL . "danh-muc/" . $temp['productcategory_id'] . "/" . $data['item'][$id_danhmuc]['productcategory_slug'];
            $danhsach['info'][] = $temp;

            //$danhsach['itemdanhmucsanpham'][$data['item'][$id_danhmuc]['productcategory_id']]=$temp;
            $cha = $data['item'][$id_danhmuc]['productcategory_parent'];
            if ($cha != 0) {
                $danhsach = $this->findParentAll($this->danhmucsanpham, $cha, $danhsach);
            }
        }
        return $danhsach;
    }

    public function data_product_moreCategory($id_danhmuc, $concapmot)
    {
        $data = array();
        $sql = ""; // Tạo sql cho lệnh select id
        $strdanhmuc = ""; // tạo str productcategory_id=? or ...
        $listdanhmuc = array();
        foreach ($concapmot as $value) {
            $danhsachcon = array(); // liet ke danh sach con
            if (empty($danhsachcon = $this->findChildCategory_AllLevel($this->danhmucsanpham, $value, array())))
                $danhsachcon = array($value);
            else {
                $listdanhmuc[$value] = $danhsachcon;   // để sau này add sản phẩm vô
                array_push($danhsachcon, $value);
            }
            $sqlwhere = " productcategory_id=" . implode(" or productcategory_id=", $danhsachcon);// tạo lệnh where cục bộ
            $strdanhmuc .= $sqlwhere . " or ";
            $limit = LIMITDANHMUCNHIEU;
            $sql .= "( SELECT * FROM (
select DISTINCT(product.product_id) from  product,productcategory_detail 
where product.product_id=productcategory_detail.product_id and product_show=1 and product_date_create < now() and ( $sqlwhere )
order by product_index desc limit $limit ) as t
) or  product.product_id in ";
        }

        $sql = " select product.product_id,productcategory_id,product_price,product_sale,product_feature,product_date_create,product_new, CAST((product_price-((product_sale/100)*product_price))  AS UNSIGNED ) as product_price_new,product_name,product_slug,product_avatar,product_code,product_description  from product,productcategory_detail where product.product_id=productcategory_detail.product_id and ( product.product_id in " . $sql . " (-1) ) order by product_index desc";

        $kq = $this->mydb->select($sql, array());

//         $stridsanpham="";
//         foreach ($kq as $value)
//         {
//             $stridsanpham.=" sanpham.product_id=".$value['product_id']." or ";
//         }
//         $stridsanpham=$stridsanpham." sanpham.product_id=-1";

        //  $sql="select sanpham.product_id,productcategory_id,gia,giamgia,noibat,ngaytao,moi, CAST((gia-((giamgia/100)*gia))  AS UNSIGNED ) as giamoi,tensanpham,slugsanpham,hinhdaidien,masanpham,ngangon  from sanpham,danhmucsanphamchitiet where sanpham.product_id=danhmucsanphamchitiet.product_id and (".$stridsanpham.")   order by stt desc";
        // $kq=  $this->select($sql,array());
        // Group by product_id
        foreach ($concapmot as $value) {
            $thongtin = $this->danhmucsanpham['item'][$value];
            $data['data'][$value]['thongtin'] = $thongtin;
        }

        $id_sanpham = "";
        $dathem = array();
        foreach ($kq as $key => $value) {

            if (in_array($value['productcategory_id'], $concapmot)) {
                $data['data'][$value['productcategory_id']]['data'][] = $value;
                $dathem[$value['productcategory_id']][] = $value['product_id'];
            } else {
                foreach ($listdanhmuc as $key => $value2) {
                    if (in_array($value['productcategory_id'], $value2)) {

                        if (isset($dathem[$key])) {
                            if (!in_array($value['product_id'], $dathem[$key])) {
                                $data['data'][$key]['data'][] = $value;
                                $dathem[$key][] = $value['product_id'];
                                break;
                            }
                        } else {
                            $data['data'][$key]['data'][] = $value;
                            $dathem[$key][] = $value['product_id'];
                            break;
                        }
                    }
                }
            }
        }

        //  Load bre
        $bre = $this->findParentAll($this->danhmucsanpham, $id_danhmuc, array());
        $data['bre'] = $bre;

        // end load bre
        $data['thongtindanhmuc'] = $this->danhmucsanpham['item'][$id_danhmuc];
        return $data;
    }

    public function data_product_oneCategory($id_danhmuc, $orderby, $filter, $noibat = '', $giamgia = '', $page = 1, $type = "desc", $ajax = false)// trang danh muc it
    {
        //$xuly = new Xulydulieu();
        $id_danhmuc = string_input($id_danhmuc);
        $orderby = string_input($orderby);
        $filter = string_input($filter);
        $type = string_input($type);
        if (!check_url(array(), $id_danhmuc))
            $this->error();
        // kiem tra orderby
        $sapxep = array("stt" => array("ten" => "STT"), "gia" => array("ten" => "Giá"), "ngaytao" => array("ten" => "Ngày"), "daxem" => array("ten" => "Lượt Xem"), "yeuthich" => array("ten" => "Yêu Thích"));
        if (!key_exists($orderby, $sapxep))
            $this->error();
// kiem tra filter
        if ($filter != '') {
            $temp = explode(",", $filter);
            foreach ($temp as $value) {
                if (!is_numeric($value))
                    $this->error();
            }
        }
        if (($noibat != '' && $noibat != 1))
            $this->error();
        if (($giamgia != '' && $giamgia != 1))
            $this->error();
        if (!is_numeric($page))
            $this->error();
        if ($type != "asc" && $type != "desc")
            $this->error();
        if (!$ajax) {
            if (!isset($this->danhmucsanpham['item'][$id_danhmuc]))
                Header("Location:" . BASE_URL . "error");
        }
        // Tạo order by
        $orderby = $orderby;
        if (strtolower($orderby) == "stt")
            $orderby = "product_index";
        else if (strtolower($orderby) == "gia")
            $orderby = "product_price";
        else if (strtolower($orderby) == "ngaytao")
            $orderby = "product_date_create";
        else if (strtolower($orderby) == "daxem")
            $orderby = "product_view";
        else if (strtolower($orderby) == "yeuthich")
            $orderby = "product_like";
        // end tạo order by
        // Tạo các str lộc
        $limit = LIMITDANHMUCIT;
        $filter = explode(",", $filter);
        if (!empty($filter[0]) != '') {
            // xu ly thuoc tinh loc
            $sqlgetfilter = " ( " . implode(",", $filter) . ")";
            $kq = $this->mydb->select("select productattr_id,attr_val_id from attr_val where attr_val_id IN $sqlgetfilter", array());
            $arrfilter = array();
            $from = '';
            $where = '';
            foreach ($kq as $k => $v) {
                $arrfilter[$v['productattr_id']][] = $v['attr_val_id'];
                if (!isset($table[$v['productattr_id']])) {
                    $table['from'][$v['productattr_id']] = "t" . $v['productattr_id'];
                    $table['where'][$v['productattr_id']] = "t" . $v['productattr_id'] . ".product_id ";
                }
            }
            $where .= "product.product_id=productcategory_detail.product_id and ";
            $where .= "product.product_id=" . implode(" and product.product_id=", $table['where']);
            $i = 0;
            foreach ($arrfilter as $k => $v) {
                $where .= " and  t" . $k . ".attr_val_id IN (" . implode(",", $v) . ") ";
                $i = 1;
            }
            $from = "productattr_detail " . implode(", productattr_detail ", $table['from']);
            // end trinh xu ly
        }
// end tạo các str lọc
        $data['tuychonsanpham'] = 'tatca';
        // Tao noi bat
        if ($noibat == 1) {
            $noibat = " and product_feature=1 ";
            $data['tuychonsanpham'] = 'noibat';
        }
        // end tao noi bat
        // Tao giam gia
        if ($giamgia == 1) {
            $giamgia = " and product_sale!=0 ";
            $data['tuychonsanpham'] = 'giamgia';
        }
        // end tao giam gia
        if (!empty($filter[0]) != '') {
            // Tính phân trang tại đây
//            $sql="select  count(DISTINCT(danhmucsanphamchitiet.product_id)) as row
//from thuoctinhchonchitiet,danhmucsanphamchitiet,sanpham
//where sanpham.product_id=danhmucsanphamchitiet.product_id and thuoctinhchonchitiet.product_id=danhmucsanphamchitiet.product_id and  danhmucsanphamchitiet.productcategory_id=:productcategory_id and hienthi=1  and ngaytao<now()  $giamgia $noibat  $sqlwherefilter ";
//
            $sql = "select count(DISTINCT( product.product_id)) as row  from product,productcategory_detail, " . $from . " where " . $where . " and productcategory_id=:productcategory_id and product_show=1  and product_date_create<now()  $giamgia $noibat";
            $kq = $this->mydb->select($sql, array("productcategory_id" => $id_danhmuc));
            if (!empty($kq))
                $totalRow = $kq[0]['row'];
            else
                $totalRow = 0;
            $nowpage = 3;
            $total_page = $totalRow == 0 ? 1 : ceil($totalRow / $limit);
            $start = $page == 1 ? 0 : ($page - 1) * $limit;
            $data['phantrang'] = array("totalpage" => $total_page, "nowpage" => $nowpage, "currentpage" => $page);

            $sql = "select  product.product_id,product_date_sale,product_price,product_sale,product_feature,product_date_create,product_new, CAST((product_price-((product_sale/100)*product_price))  AS UNSIGNED ) as product_price_new,product_name,product_slug,product_avatar,product_code,product_description"
                . " from product,productcategory_detail, " . $from . " where " . $where . " and productcategory_id=:productcategory_id and product_show=1  and product_date_create<now()  $giamgia $noibat  group by  product.product_id  order by $orderby $type limit $start,$limit";
            $data['sanpham'] = $this->mydb->select($sql, array("productcategory_id" => $id_danhmuc));
        } else {
            // Tính phân trang tại đây
            $sql = "select  count(DISTINCT( product.product_id)) as row  
from productcategory_detail,product
where product.product_id=productcategory_detail.product_id  and  productcategory_detail.productcategory_id=:productcategory_id and product_show=1  and product_date_create<now()  $giamgia $noibat  ";
            $kq = $this->mydb->select($sql, array("productcategory_id" => $id_danhmuc));
            if (!empty($kq))
                $totalRow = $kq[0]['row'];
            else
                $totalRow = 0;
            $nowpage = 3;
            $total_page = $totalRow == 0 ? 1 : ceil($totalRow / $limit);
            $start = $page == 1 ? 0 : ($page - 1) * $limit;
            $data['phantrang'] = array("totalpage" => $total_page, "nowpage" => $nowpage, "currentpage" => $page);
// end phan trang
            $sql = "select product.product_id,product_date_sale,product_price,product_sale,product_feature,product_date_create,product_new, CAST((product_price-((product_sale/100)*product_price))  AS UNSIGNED ) as product_price_new,product_name,product_slug,product_avatar,product_code,product_description
from productcategory_detail,product
where product.product_id=productcategory_detail.product_id  and  productcategory_detail.productcategory_id=:productcategory_id and product_show=1  and product_date_create<now() $giamgia $noibat  group by  product.product_id  order by $orderby $type limit $start,$limit";
            $data['sanpham'] = $this->mydb->select($sql, array("productcategory_id" => $id_danhmuc));
        }
        //  Load trinh loc
        if (!$ajax) {
            $id_nganhnghe = $this->danhmucsanpham['item'][$id_danhmuc]['career_id'];
            $data['boloc'] = $this->loadFilter($id_nganhnghe);
            // Lấy thông tin danh muc
            $data['thongtindanhmuc'] = $this->danhmucsanpham['item'][$id_danhmuc];
            //End lấy thông tin danh mục
        }
        // end load trinh loc
        $data['filter'] = $filter;
        $data['orderby'] = $orderby;
        $data['sortby'] = $type;
        $data["totalrow"] = $totalRow;
        // Load bre
        $bre = $this->findParentAll($this->danhmucsanpham, $id_danhmuc, array());
        $data['bre'] = $bre;
        // end load bre
        return $data;
    }

    public function loadFilter($id_nganhnghe)
    {
        $thuoctinhchon = array();
        $this->thuoctinhchon = $this->mydb->select("select  productattr.productattr_id,productattr_name,attr_val_id,attr_val_value,attr_val.attr_val_index from productattr,attr_val where productattr.productattr_id=attr_val.productattr_id and career_id=:career_id and productattr_showfilter=1 order by productattr.productattr_index", array("career_id" => $id_nganhnghe));
        foreach ($this->thuoctinhchon as $value) {
            $thuoctinhchon[$value['productattr_id']]['thongtin'] = array("productattr_id" => $value['productattr_id'], "productattr_name" => $value['productattr_name']);
            $thuoctinhchon[$value['productattr_id']]['data'][$value['attr_val_index']] = array("attr_val_id" => $value['attr_val_id'], "attr_val_value" => $value['attr_val_value'], "attr_val_index" => $value['attr_val_index']);
        }
        foreach ($this->thuoctinhchon as $value) {
            ksort($thuoctinhchon[$value['productattr_id']]['data']);;
        }
        return $thuoctinhchon;
    }

    public function error(){}
}
