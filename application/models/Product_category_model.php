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
            if (empty($danhsachcon = search_all_child($this->danhmucsanpham, $value, array())))
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

    public function loadinfo($id_sanpham)
    {
        if (isset($_SESSION['daxem'])) {
            if ($_SESSION['daxem'] != $id_sanpham) {
                $this->mydb->exec("update product set product_view=product_view+1  where product_id=$id_sanpham");
            }
        } else {
            $this->mydb->exec("update product set product_view=product_view+1  where product_id=$id_sanpham");
        }
//        $ses = new Session();
//        $ses->set("daxem", $id_sanpham);

        $kq = $this->mydb->select("select *,CAST((product_price-((product_sale/100)*product_price))  AS UNSIGNED ) as product_price_new from product where product_id=:product_id limit 1", array("product_id" => $id_sanpham));
        if (!empty($kq)) {
            $data['sanpham'] = $kq[0];
            $x = strpos($data['sanpham']['product_content'], "{readmore}");
            if ($x > 0) {
                $data['sanpham']['product_description'] = substr($data['sanpham']['product_content'], 0, $x);
                $data['sanpham']['product_content'] = substr($data['sanpham']['product_content'], $x + 10);
            } else {
                $data['sanpham']['product_description'] = '';
            }
            // Load hình sản phẩm

            $kq = $this->mydb->select("select * from product_images where product_id=:product_id order by product_images_index", array("product_id" => $id_sanpham));
            $data['sanpham']['hinh'] = $kq;
            // end load hình sản phẩm
            // Load danh muc san pham
            $danhmuc = $this->mydb->select("select productcategory_id from productcategory_detail where product_id=:product_id ", array("product_id" => $id_sanpham));
            // end load danh muc san pham


            // Load bre
            $data['bre']['info'] = array();
            $data['bre']['itemdanhmucsanpham'] = array();
            if (!empty($danhmuc)) {
                $temp['ten'] = $data['sanpham']['product_name'];
                $temp['slug'] = "#";
                $bre['info'][] = $temp;
                $id_danhmuc = $danhmuc[0]['productcategory_id'];
                $bre = $this->findParentAll($this->danhmucsanpham, $id_danhmuc, $bre);
                $data['bre'] = $bre;
            }
            // End load bre
            //
            // Load thuoc tinh chon
            $kq = $this->mydb->select("select DISTINCT productattr_detail.attr_val_id,product_id,productattr_detail.productattr_id,productattr.productattr_name,attr_val.attr_val_value from productattr_detail JOIN productattr ON productattr.productattr_id=productattr_detail.productattr_id JOIN attr_val ON productattr_detail.attr_val_id=attr_val.attr_val_id and product_id=:product_id and product_detail_id!=-2 order by productattr.productattr_index,attr_val.attr_val_index", array("product_id" => $id_sanpham));
            $thuoctinhchon = array();
            foreach ($kq as $value) {
                $thuoctinhchon[$value['productattr_name']][] = $value;
            }
// load san pham chi tiet
            $kq = $this->mydb->select("select product_detail.product_detail_id,attr_val_id,	product_detail_price,product_detail_avatar,product_detail_total
from product_detail JOIN productattr_detail
ON product_detail.product_detail_id=productattr_detail.product_detail_id
and product_detail.product_id=:product_id", array("product_id" => $id_sanpham));
            $sanphamchitiet = array();
            foreach ($kq as $value) {
                $sanphamchitiet[$value['product_detail_id']]['thuoctinh'][] = $value['attr_val_id'];
                $sanphamchitiet[$value['product_detail_id']]["giasanpham"] = $value['product_detail_price'];
                $sanphamchitiet[$value['product_detail_id']]["soluongsanpham"] = $value['product_detail_total'];
                $sanphamchitiet[$value['product_detail_id']]["hinhsanpham"] = $value['product_detail_avatar'];
                $sanphamchitiet[$value['product_detail_id']]["id_sanphamchitiet"] = $value["product_detail_id"];
            }
            $data['sanpham']['sanphamchitiet'] = $sanphamchitiet;

            // thuoc tinh chi tiet
            $data['sanpham']['thuoctinhchitiet'] = $this->mydb->select("select product_prop_id,product_prop_detail_value from product_prop_detail where product_id=:product_id", array("product_id" => $id_sanpham));
            $kq = $this->mydb->select("select product_prop_id,product_prop_name from product_prop", array());
            $thuoctinh = array();
            foreach ($kq as $value) {
                $thuoctinh[$value['product_prop_id']] = $value['product_prop_name'];
            }
            $data['val']['thuoctinh'] = $thuoctinh;
            $data['sanpham']['thuoctinhchon'] = $thuoctinhchon;

            // load tag
            $kq = $this->mydb->select("select * from tag,product_tag where tag.tag_id=product_tag.tag_id and product_id=:product_id order by tag_index", array("product_id" => $id_sanpham));
            $data['tag'] = $kq;

            // end load thuoc tinh chon
            $data['sanphamlienquan'] = array();
            if (!empty($danhmuc)) {
                // Load san pham lien quan

                $sql = " product_id in ( SELECT * FROM ( select DISTINCT (product.product_id) from product,productcategory_detail where product.product_id=productcategory_detail.product_id and product.product_id!=$id_sanpham and product_show=1 and product_date_create < now() and";
                foreach ($danhmuc as $value) {
                    $listdanhmuc[] = $value['productcategory_id'];
                }
                $limit = LIMITSANPHAMLIENQUAN;
                $sql .= "( productcategory_id=" . implode(" or productcategory_id=", $listdanhmuc) . ") order by product_index desc limit $limit ) as t )";

                if (!empty($data['tag'])) {
                    $sql .= " or product_id in ( SELECT * FROM ( select DISTINCT (product.product_id) from product,product_tag where product.product_id=product_tag.product_id and product.product_id!=$id_sanpham and product_show=1 and product_date_create < now() and";
                    foreach ($data['tag'] as $value) {
                        $listtag[] = $value['tag_id'];
                    }
                    $limit = LIMITSANPHAMLIENQUAN;
                    $sql .= "( tag_id=" . implode(" or tag_id=", $listtag) . ") order by product_index desc limit $limit ) as t )";

                }
                $sql = "select product_id,product_feature,product_sale,product_date_create,product_name,product_slug,product_price,product_avatar,product_code,product_description,product_new,CAST((product_price-((product_sale/100)*product_price))  AS UNSIGNED ) as product_price_new from product where " . $sql;
                $data['sanphamlienquan'] = $this->mydb->select($sql, array());

                // End load san pham lien quan
            }
            // Load san pham apriori

//            $listidgiohang = array();
//            // load apriori khach hang
//            if (isset($_COOKIE['giohang'])) {
//                $giohang = unserialize($_COOKIE['giohang']);
//                foreach ($giohang as $value) {
//                    $listidgiohang[$value["product_id"]] = $value['product_id'];
//                }
//            }
//
//            if (check_login_user(array(1, 2, 3, 4))) {
//                $arrtuoi = Datapublic::getTuoi();
//                $taikhoan = unserialize($_COOKIE['taikhoan']);
//                $goitinh = $taikhoan['gioitinh'];
//                $tuoi = $taikhoan['tuoi'];
//                foreach ($arrtuoi as $key => $value) {
//                    $temp = explode("-", $value);
//                    $min = $temp[0];
//                    $max = $temp[1];
//                    if ($tuoi >= $min && $tuoi <= $max) {
//                        $tuoi = $key;
//                        break;
//                    }
//                }
//
//                $itemleft = $tuoi . "-" . $goitinh;
//                $arr[] = $itemleft;
//                $arr[] = $id_sanpham;
//                asort($arr);
//                $itemleft2 = implode(",", $arr);
//                $arrsql[] = "SELECT * FROM ( select id_apriori from apriori where ( itemleft='$itemleft' or itemleft='$itemleft2' ) order by value desc limit 5 ) as t  ) ";
//
//            }
//
//            $arrsql[] = " SELECT * FROM ( select id_apriori from apriori where itemleft='$id_sanpham'  order by value desc limit 5 ) as t )";
//            $sql = "select itemright from apriori where id_apriori in (" . implode(" or id_apriori in ( ", $arrsql);
//            $kq = $this->select($sql, array());
//
//            $temp = array();
//            if (!empty($kq)) {
//                foreach ($kq as $value) {
//
//                    $temp[] = explode(",", $value['itemright']);
//                }
//                $list = array("-1");
//                foreach ($temp as $value) {
//
//                    foreach ($value as $value2) {
//                        if (($value2 != $id_sanpham) && !in_array($value2, $listidgiohang)) {
//                            $list[$value2] = $value2;
//                        }
//                    }
//                }
//                $sql = "select  id_sanpham,tensanpham,noibat,moi,giamgia,ngaytao,slugsanpham,gia,hinhdaidien,masanpham,ngangon,giamgia,CAST((gia-((giamgia/100)*gia))  AS UNSIGNED ) as giamoi from sanpham where ngaytao<now() and hienthi=1 and id_sanpham!='$id_sanpham' and ( id_sanpham=" . implode(" or id_sanpham=", $list) . " ) order by stt desc limit $limit";
//                $data['apriori'] = $this->select($sql, array());
//
//            } else
//                $data['apriori'] = null;
            // end load apriori


            return $data;
        } else
            $this->error();
    }

    public function error()
    {
    }
}
