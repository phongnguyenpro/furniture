<?php

class Invoice_model extends MY_Model
{

    function __construct($type = null)
    {
        parent::__construct($type);
    }

    function load_invoice_detail($mahoadon, $mabaove)
    {
        $kq = $this->mydb->select("select * from invoice where invoice_code=:invoice_code and invoice_protect_code=:invoice_protect_code", array("invoice_code" => $mahoadon, "invoice_protect_code" => $mabaove));

        if (!empty($kq)) {
            $data['thongtin'] = $kq[0];
            $id_hoadon = $kq[0]['invoice_id'];
            $kq = $this->mydb->select("select invoice_detail.*,product.product_name,product.product_code  from invoice_detail JOIN product ON invoice_detail.product_id=product.product_id where invoice_id=:invoice_id", array("invoice_id" => $id_hoadon));
            $data['sanpham'] = $kq;
            // kiem tra hoa don
            $error = array();
            foreach ($kq as $value) {
                $kq = $this->check_invoice_detail($value['invoice_detail_id'], $value['quantity']);
                if (!$kq['tinhtrang']) {
                    $error[] = $kq['tinnhan'];
                }
            }
            if (empty($error)) {
                $data['chophepthanhtoan'] = true;
            } else {
                $data['chophepthanhtoan'] = false;
                $data['error'] = $error;
            }

            return $data;
        } else {
            $this->error();
        }
    }

    function check_invoice_detail($id_hoadonchitiet, $soluongthem = -1)
    {
        $error = array();
        $kq = $this->mydb->select("select invoice_detail.*,product.product_name,product.product_code from invoice_detail JOIN product ON product.product_id=invoice_detail.product_id where invoice_detail_id=:invoice_detail_id", array("invoice_detail_id" => $id_hoadonchitiet));
        $data = $kq[0];
        $id_sanphamchitiet = $data['product_detail_id'];
        $giatrithuoctinhchon = $data['attr_val_ids'];
        $id_sanpham = $data['product_id'];
        $tensanpham = $data['product_name'];
        $tengiatrithuoctinhchon = $data['attr_val_labels'];
        if ($id_sanphamchitiet != '') {
            // neu co ton tai san pham chi tiet
            // kiem tra san pham chi tiet co ton tai hay khong
            $kq = $this->mydb->select("select product_detail_total from product_detail where product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
            if (!empty($kq)) {
                $soluongconlai = $kq[0]['product_detail_total'];
                $thuoctinhss = explode(",", $giatrithuoctinhchon);

                $sosanh = true;
                // kiem tra thuoc tinh
                $arrthuoctinh = $this->mydb->select("select attr_val_id from productattr_detail where product_detail_id=:product_detail_id", array("product_detail_id" => $id_hoadonchitiet));
                foreach ($arrthuoctinh as $value) {
                    $giatrisosanh = $value['attr_val_id'];

                    if (!in_array($giatrisosanh, $thuoctinhss))
                        $sosanh = false;
                }


                $thuoctinhss = explode(",", $giatrithuoctinhchon);
                $sqlwhere = "attr_val_id=" . implode(" or attr_val_id=", $thuoctinhss);
                $kqthuoctinh = $this->mydb->select("select count( DISTINCT(attr_val_id)) as row from productattr_detail where product_id=:product_id and ($sqlwhere)", array("product_id" => $id_sanpham));
                if (empty($kqthuoctinh)) {
                    $sosanh = false;
                } else {
                    if ($kqthuoctinh[0]['row'] != count($thuoctinhss)) {
                        $sosanh = false;
                    }
                }

                if ($sosanh) {
                    if ($soluongconlai >= $soluongthem || $soluongthem == -1) {
                        $data['soluongconlai'] = $soluongconlai;
                        // cho phep theo tac
                        $error = array();
                    } else {
                        // số lượng không cho phép
                        $error[] = "Sản phẩm '" . $tensanpham . "-" . $tengiatrithuoctinhchon . "' chỉ còn " . $soluongconlai . " sản phẩm trong kho";
                    }
                } else {
                    $error[] = "Sản phẩm '" . $tensanpham . "-" . $tengiatrithuoctinhchon . "' không còn tồn tại";
                }
            } else {
                $error[] = "Sản phẩm '" . $tensanpham . "-" . $tengiatrithuoctinhchon . "' không còn tồn tại";
            }
        } else {
            // khong co san pham chi tiet

            // kiem tra san pham co ton tai hay khong
            $kq = $this->mydb->select("select product_total from product where product_id=:product_id", array("product_id" => $id_sanpham));
            if (!empty($kq)) {
                $soluongconlai = $kq[0]['product_total'];

                $sosanh = true;
                if (!empty($giatrithuoctinhchon)) {
                    // neu co chon thuoc tinh
                    $thuoctinhss = explode(",", $giatrithuoctinhchon);
                    $sqlwhere = "attr_val_id=" . implode(" or attr_val_id=", $thuoctinhss);
                    $kqthuoctinh = $this->mydb->select("select count( DISTINCT(attr_val_id)) as row from productattr_detail where product_id=:product_id and ($sqlwhere)", array("product_id" => $id_sanpham));
                    if (empty($kqthuoctinh)) {
                        $sosanh = false;
                    } else {
                        if ($kqthuoctinh[0]['row'] != count($thuoctinhss))
                            $sosanh = false;
                    }
                }

                if ($sosanh) {
                    if ($soluongconlai >= $soluongthem || $soluongthem == -1) {
                        // cho phep theo tac
                        $data['soluongconlai'] = $soluongconlai;
                        $error = array();
                    } else {
                        // số lượng không cho phép
                        $error[] = "Sản phẩm '" . $tensanpham . "-" . $tengiatrithuoctinhchon . "' chỉ còn " . $soluongconlai . " sản phẩm trong kho";
                    }
                } else {
                    $error[] = "Sản phẩm '" . $tensanpham . "-" . $tengiatrithuoctinhchon . "' không còn tồn tại";
                }
            } else {
                $error[] = "Sản phẩm '" . $tensanpham . "-" . $tengiatrithuoctinhchon . "' không còn tồn tại";
            }
        }

        if (empty($error))
            return array("tinhtrang" => true, "data" => $data);
        else
            return array("tinhtrang" => false, "tinnhan" => $error[0]);
    }
}
