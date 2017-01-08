<?php

class Invoice_model extends MY_Model
{
    function __construct($type = null)
    {
        parent::__construct($type);
    }

    function load_data_ssp()
    {
        $table = 'invoice';
// Table's primary key
        $primaryKey = 'invoice_id';
        $columns = array(
            array('db' => 'invoice_protect_code', 'dt' => 0),
            array('db' => 'invoice_id', 'dt' => 1),
            array('db' => 'invoice_code', 'dt' => 2),
            array('db' => 'user_name', 'dt' => 3),
            array('db' => 'invoice_date_create', 'dt' => 4),
            array('db' => 'invoice_date_pay', 'dt' => 5),
            array('db' => 'invoice_amout', 'dt' => 6),
            array('db' => 'invoice_status', 'dt' => 7),
            array('db' => 'invoice_shipping_status', 'dt' => 8)
        );
        $this->load->database();
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname,
        );
        $this->load->library("ssptable");
        echo json_encode(
            $this->ssptable->simple($_POST, $sql_details, $table, '', $primaryKey, $columns, '', 'quanly_hoadon')
        );
    }

    function load_invoice($invoice_id)
    {
        $kq = $this->mydb->select("select * from invoice where invoice_id=:invoice_id", array("invoice_id" => $invoice_id));
        $data['thongtin'] = $kq[0];
        $data['sanpham'] = $this->mydb->select("SELECT invoice_detail.product_id, product_code,product_slug, quantity, product.product_price, product_name, product_detail_id, product.product_avatar, attr_val_labels, invoice_detail_id, invoice_detail_discount, user_email, invoice_id
FROM invoice_detail
LEFT JOIN product ON invoice_detail.product_id = product.product_id AND invoice_id =$invoice_id
LEFT JOIN user ON invoice_detail.user_id_agency = user.user_id", array());
        $data['hinhthucthanhtoan'] = get_checkout_type();
        $data['tinhtrang'] = get_invoice_state();
        $data['taikhoan'] = 0;
        if ($data['thongtin']['invoice_status'] == 1)
            $this->mydb->update("invoice", array("invoice_status" => 2), "invoice_id=:invoice_id", array("invoice_id" => $invoice_id));
        // thong tin nguoi gioi thieu
        return $data;
    }

    function delete_invoice($invoice_id)
    {
        $this->mydb->deleteall("invoice_detail", "invoice_id=:invoice_id", array("invoice_id" => $invoice_id));
        $this->mydb->delete("invoice", "invoice_id=:invoice_id", array("invoice_id" => $invoice_id));
        return array("status" => 1);
    }

    function update_quantity($data)
    {
        $id_sanphamchitiet = $data['id_sanphamchitiet'];
        $id_hoadonchitiet = $data['id_hoadonchitiet'];
        $soluongthem = $data['soluongthem'];
        $id_hoadon = $data['id_hoadon'];
        $dongia = $data['dongia'];
        $id_sanpham = $data['id_sanpham'];
        $tinhtrang = $data['tinhtrang'];
        $soluonghientai = $data['soluonghientai'];
        // kiem tra san pham nay co ton tai hay khong
        if ($tinhtrang == 3)
            $ketquakiemtra = $this->check_invoice_detail($id_hoadonchitiet, -1);
        else
            $ketquakiemtra = $this->check_invoice_detail($id_hoadonchitiet, $soluongthem);
        if ($ketquakiemtra['tinhtrang'] == TRUE) {
            if ($id_sanphamchitiet != '') {
                $this->mydb->update("invoice_detail", array("quantity" => $soluongthem), "invoice_detail_id=:invoice_detail_id", array("invoice_detail_id" => $id_hoadonchitiet));
                $datahoadonchitiet = $ketquakiemtra['data'];
                $giamgia = $datahoadonchitiet['invoice_detail_discount'];
                $dongia = $datahoadonchitiet['product_price'];
                $soluonghientai = $datahoadonchitiet['quantity'];
                $tonggiasanpham = ($dongia * $soluongthem) - ($dongia * $soluongthem * ($giamgia / 100));
                $soluongconlai = $datahoadonchitiet['soluongconlai'];
                if ($tinhtrang == 3) {
                    $soluong = $soluongconlai + ($soluonghientai - $soluongthem);
                    $this->mydb->update("product_detail", array("product_detail_total" => $soluong), "product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
                }
                // load dữ liệu cộng tiền
                $data = $this->update_data_invoice($id_hoadon);
                $data['tonggiasanpham'] = $tonggiasanpham;
                return array("status" => 1, "data" => $data);
            } else {
                $this->mydb->update("invoice_detail", array("quantity" => $soluongthem), "invoice_detail_id=:invoice_detail_id", array("invoice_detail_id" => $id_hoadonchitiet));
                $datahoadonchitiet = $ketquakiemtra['data'];
                $giamgia = $datahoadonchitiet['invoice_detail_discount'];
                $dongia = $datahoadonchitiet['product_price'];
                $soluonghientai = $datahoadonchitiet['quantity'];
                $tonggiasanpham = ($dongia * $soluongthem) - ($dongia * $soluongthem * ($giamgia / 100));
                $soluongconlai = $datahoadonchitiet['soluongconlai'];
                if ($tinhtrang == 3) {
                    $soluong = $soluongconlai + ($soluonghientai - $soluongthem);
                    $this->mydb->update("product", array("product_total" => $soluong), "product_id=:product_id", array("product_id" => $id_sanpham));
                }
                // load dữ liệu cộng tiền
                $data = $this->update_data_invoice($id_hoadon);
                $data['tonggiasanpham'] = $tonggiasanpham;
                return array("status" => 1, "data" => $data);
            }
        } else {
            return array("status" => 0, "tinnhan" => $ketquakiemtra['tinnhan']);
        }
    }

    function check_invoice_detail($invoice_detail_id, $soluongthem = -1)
    {
        $error = array();
        $kq = $this->mydb->select("select invoice_detail.*, product.product_id, product.product_name,product.product_code from invoice_detail JOIN product ON product.product_id=invoice_detail.product_id and invoice_detail_id=:invoice_detail_id", array("invoice_detail_id" => $invoice_detail_id));
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
                $arrthuoctinh = $this->mydb->select("select attr_val_id from productattr_detail where product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
                foreach ($arrthuoctinh as $value) {
                    $giatrisosanh = $value['attr_val_id'];
                    if (!in_array($giatrisosanh, $thuoctinhss))
                        $sosanh = false;
                }
                // trường hợp ngoại lệ
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
            return array("tinhtrang" => false, "tinnhan" => $error);
    }

    function update_data_invoice($id_hoadon)
    {
        $kq = $this->mydb->select("select invoice_money_plus,invoice_money_subtract,invoice_total_discount from invoice where invoice_id=:invoice_id", array("invoice_id" => $id_hoadon));
        $tiencong = $kq[0]['invoice_money_plus'];
        $tientru = $kq[0]['invoice_money_subtract'];
        $tonggiamgia = $kq[0]['invoice_total_discount'];
        $tongtiensanpham = 0;
        $tongtienhoadon = 0;
        $kq = $this->mydb->select("select product_price,quantity,invoice_detail_discount from invoice_detail where invoice_id=:invoice_id", array("invoice_id" => $id_hoadon));
        foreach ($kq as $value) {
            $tien1 = $value['product_price'] * $value['quantity'];
            $tien2 = ($value['product_price'] * $value['quantity']) * ($value['invoice_detail_discount'] / 100);
            $tien = $tien1 - $tien2;
            $tongtiensanpham += (int)$tien;
        }
        $tien1 = $tongtiensanpham + $tiencong - $tientru;
        $tien2 = $tien1 * ($tonggiamgia / 100);
        $tongtienhoadon = $tien1 - $tien2;
        $this->mydb->update("invoice", array("invoice_amout" => $tongtienhoadon), "invoice_id=:invoice_id", array("invoice_id" => $id_hoadon));
        return array("tongtiensanpham" => $tongtiensanpham, "tongtienhoadon" => $tongtienhoadon);
    }

    function delete_invoice_detail($data)
    {
        $id_hoadonchitiet = $data['id_hoadonchitiet'];
        $id_hoadon = $data['id_hoadon'];
        $tinhtrang = $data['tinhtrang'];
        $kq = $this->mydb->select("select quantity,product_detail_id,product_id from invoice_detail where invoice_detail_id=:invoice_detail_id", array("invoice_detail_id" => $id_hoadonchitiet));
        if ($tinhtrang == 3) {
            if ($kq[0]['product_detail_id'] != '') {
                $id_sanphamchitiet = $kq[0]['product_detail_id'];
                $soluongupdate = $kq[0]['quantity'];
                $this->mydb->exec("update product_detail set product_detail_total=product_detail_total+$soluongupdate where product_detail_id=$id_sanphamchitiet");
            } else {
                $id_sanpham = $kq[0]['product_id'];
                $soluongupdate = $kq[0]['quantity'];
                $this->mydb->exec("update product set product_total=product_total+$soluongupdate where product_id=$id_sanpham");
            }
        }
        $this->mydb->delete("invoice_detail", "invoice_detail_id=:invoice_detail_id", array("invoice_detail_id" => $id_hoadonchitiet));
        $data = $this->update_data_invoice($id_hoadon);
        return array("status" => 1, "data" => $data);
    }

    function update_invoice($data)
    {
        $id_hoadon = $data['id_hoadon'];
        $data['invoice_money_plus'] = price_input($data['invoice_money_plus']);
        $data['invoice_money_subtract'] = price_input($data['invoice_money_subtract']);
        if (isset($data['invoice_shipping_status']))
            $data['invoice_shipping_status'] = 1;
        else
            $data['invoice_shipping_status'] = 2;
        if (isset($data['user_name']))
            unset($data['id_hoadon']);
        // tính tiền trước
        $tongtiensanpham = 0;
        $tongtienhoadon = 0;
        $kq = $this->mydb->select("select product_price,quantity,invoice_detail_discount from invoice_detail where invoice_id=:invoice_id", array("invoice_id" => $id_hoadon));
        foreach ($kq as $value) {
            $tien1 = $value['product_price'] * $value['quantity'];
            $tien2 = ($value['product_price'] * $value['quantity']) * ($value['invoice_detail_discount'] / 100);
            $tien = $tien1 - $tien2;
            $tongtiensanpham += (int)$tien;
        }
        $tien1 = $tongtiensanpham + $data['invoice_money_plus'] - $data['invoice_money_subtract'];
        $tien2 = $tien1 * ($data['invoice_total_discount'] / 100);
        $tongtienhoadon = $tien1 - $tien2;
        $data['invoice_amout'] = $tongtienhoadon;
        $this->mydb->update("invoice", $data, "invoice_id=:invoice_id", array("invoice_id" => $id_hoadon));
        $data = array("tongtiensanpham" => $tongtiensanpham, "tongtienhoadon" => $tongtienhoadon);
        return array("status" => 1, "data" => $data);
    }

    function invoice_payment($invoice_id)
    {
        $error = array();
        $kq = $this->mydb->select("select invoice_detail_id,product_detail_id,quantity from invoice_detail where invoice_id=:invoice_id", array("invoice_id" => $invoice_id));
        $dataupdate = array("product_detail" => array(), "product" => array());
        foreach ($kq as $value) {
            $ketquakiemtra = $this->check_invoice_detail($value['invoice_detail_id'], $value['quantity']);
            if ($ketquakiemtra['tinhtrang'] == true) {
                $datasanphamchitiet = $ketquakiemtra['data'];
                $soluonghienco = $datasanphamchitiet['soluongconlai'];
                $soluongthem = $datasanphamchitiet['quantity'];
                $id_sanphamchitiet = $value['product_detail_id'];
                $id_sanpham = $datasanphamchitiet['product_id'];
                if ($id_sanphamchitiet != '') {
                    $soluongupdate = $soluonghienco - $soluongthem;
                    $dataupdate['product_detail'][] = array("product_detail_id" => $id_sanphamchitiet, "product_detail_total" => $soluongupdate);  // nếu không có lỗi
                } else {
                    // thoa mãn
                    $soluongupdate = $soluonghienco - $soluongthem;
                    $dataupdate['product'][] = array("product_id" => $id_sanpham, "product_total" => $soluongupdate);
                }
            } else {
                $error[] = $ketquakiemtra['tinnhan'];
            }
        }
//            $data=$this->capnhatdulieu($id_hoadon);
//            if($data['tongtienhoadon']<0)
//                $error[]="Tổng tiền hóa đơn không được < 0";
        if (empty($error)) {
            foreach ($dataupdate['product_detail'] as $value) {
                $id_sanphamchitiet = $value['product_detail_id'];
                $soluong = $value['product_detail_total'];
                $this->mydb->update("product_detail", array("product_detail_total" => $soluong), "product_detail_id=:product_detail_id", array("product_detail_id" => $id_sanphamchitiet));
            }
            foreach ($dataupdate['product'] as $value) {
                $id_sanpham = $value['product_id'];
                $soluong = $value['product_total'];
                $this->mydb->update("product", array("product_total" => $soluong), "product_id=:product_id", array("product_id" => $id_sanpham));
            }
            $ngaythanhtoan = today();
//            $giaidoan = new \lib\table\giaidoan();
//            $id_giaidoan = $giaidoan->giaidoanhientai()['id_giaidoan'];
//            $this->update("hoadon", array("tinhtrang" => 3, "ngaythanhtoan" => $ngaythanhtoan, "id_giaidoan" => $id_giaidoan), "id_hoadon=:id_hoadon", array("id_hoadon" => $id_hoadon));
            $this->mydb->update("invoice", array("invoice_status" => 3, "invoice_date_pay" => $ngaythanhtoan), "invoice_id=:invoice_id", array("invoice_id" => $invoice_id));
            return array("status" => 1);
        } else {
            return array("status" => 0, "tinnhan" => $error);
        }
    }
}
