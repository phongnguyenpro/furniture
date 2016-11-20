<?php

class Product_category extends MY_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public $danhmucsanpham;

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
        if (isset($data['item'][$id_danhmuc]['id_danhmuc'])) {
            // thong tin cho bre
            $temp['id_danhmuc'] = $data['item'][$id_danhmuc]['id_danhmuc'];
            $temp['ten'] = $data['item'][$id_danhmuc]['ten'];
            $temp['slug'] = URL . "danh-muc/" . $temp['id_danhmuc'] . "/" . $data['item'][$id_danhmuc]['slug'];
            $danhsach['info'][] = $temp;

            //$danhsach['itemdanhmucsanpham'][$data['item'][$id_danhmuc]['id_danhmuc']]=$temp;
            $cha = $data['item'][$id_danhmuc]['cha'];
            if ($cha != 0) {
                $danhsach = $this->findParentAll($this->danhmucsanpham, $cha, $danhsach);
            }
        }
        return $danhsach;
    }

    public function data_product_more($id_danhmuc, $concapmot)
    {
        $data = array();
        $sql = ""; // Tạo sql cho lệnh select id
        $strdanhmuc = ""; // tạo str id_danhmuc=? or ...
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
            $limit = load_config()["limitdanhmucnhieu"];
            $sql .= "( SELECT * FROM (
select DISTINCT(product.product_id) from  product,productcategory_detail 
where product.product_id=productcategory_detail.product_id and product_show=1 and product_date_create < now() and ( $sqlwhere )
order by product_index desc limit $limit ) as t
) or  product.product_id in ";
        }

        $sql = " select product.product_id,productcategory_id,product_price,product_sale,product_feature,product_date_create,product_new, CAST((product_price-((product_sale/100)*product_price))  AS UNSIGNED ) as product_price_new,product_name,product_slug,product_avatar,product_code,product_description  from product,productcategory_detail where product.product_id=productcategory_detail.product_id and ( product.product_id in " . $sql . " (-1) ) order by product_index desc";

        $kq = $this->select($sql, array());

//         $stridsanpham="";
//         foreach ($kq as $value)
//         {
//             $stridsanpham.=" sanpham.id_sanpham=".$value['id_sanpham']." or ";
//         }
//         $stridsanpham=$stridsanpham." sanpham.id_sanpham=-1";

        //  $sql="select sanpham.id_sanpham,id_danhmuc,gia,giamgia,noibat,ngaytao,moi, CAST((gia-((giamgia/100)*gia))  AS UNSIGNED ) as giamoi,tensanpham,slugsanpham,hinhdaidien,masanpham,ngangon  from sanpham,danhmucsanphamchitiet where sanpham.id_sanpham=danhmucsanphamchitiet.id_sanpham and (".$stridsanpham.")   order by stt desc";
        // $kq=  $this->select($sql,array());
        // Group by id_sanpham
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
}
