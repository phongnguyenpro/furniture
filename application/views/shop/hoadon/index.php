<html>

<?php
$thongtin = $this->data['thongtin'];
$sanpham = $this->data['sanpham'];
?>
<!-- Mirrored from kutethemes.com/demo/kuteshop/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Aug 2015 18:10:16 GMT -->
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?= load_frontend_view("hoadon/css/hoadon.css"); ?>"/>
    <link rel="stylesheet" type="text/css"
          href="<?= load_frontend_view("assets/lib/bootstrap/css/bootstrap.min.css") ?>"/>
    <link rel="stylesheet" href="<?= load_frontend_view("hoadon/css/print.css"); ?>" type="text/css" media="print"/>
    <title><?= $this->data['meta']['title'] ?></title>
</head>
<body>

<div class="boxhoadon clearfix ">

    <div class="logo ">
        <img alt="Kute Shop" src="<?= LOGO ?>"/>
    </div>
    <div class="info ">

        <p><i class="glyphicon glyphicon-phone"></i><?= SDT ?></p>
        <p><i class="glyphicon glyphicon-send"></i> <?= EMAIL ?></p>
        <p><b>Mã hóa đơn:</b> <i class="label label-info"><?= $thongtin['invoice_code'] ?></i></p>

    </div>
    <div class="clearfix"></div>
    <div class="thongtinkhachhang">

        <h4>Thông tin khách hàng</h4>

        <div class="boxthongtinkhachhang">
            <div class="col-1">
                <p><b>Tên:</b> <?= $thongtin['user_name'] ?> </p>
                <p><b>Địa chỉ :</b> <?= $thongtin['user_address'] ?> </p>

            </div>
            <div class="col-2">
                <p><b>SDT:</b> <?= $thongtin['user_phone'] ?> </p>
                <p><b>Email:</b> <?= $thongtin['user_email'] ?> </p>
            </div>
        </div>


    </div>
    <div class="clearfix"></div>
    <div class="thongtinsanpham">
        <h4>Thông tin sản phẩm</h4>
        <div class="boxtthongtinsanpham">
            <table class="table table-bordered">
                <thead>
                <th>Thông tin</th>

                <th>SL</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>

                </thead>
                <tbody>
                <?php
                $tongtien = 0;
                foreach ($sanpham as $value) {
                    ?>
                    <tr>
                        <td class="cart_product">

                            <img width="50" class="img-responsive"
                                 src="<?= BASE_URL . "public/upload/images/thumb_product/" . $value['product_avatar'] ?>"
                                 alt="p10">

                            <small><?= $value['product_name'] ?></small>
                            <br>
                            <?php if (kiemtranull($value['product_code'])) { ?>
                                <small class="cart_ref">Mã SP: <?= $value['product_code'] ?></small><br><?php } ?>
                            <?php if (kiemtranull($value['attr_val_labels'])) { ?>
                                <small>Thuộc tính:
                                    <?= $value['attr_val_labels'] ?>
                                </small> <br>
                            <?php } ?>
                        </td>

                        <td class="qty">
                            <?= $value['quantity'] ?>

                        </td>
                        <td class="action">
                            <b>$<?= tien($value['product_price']) ?>VND</b><br>
                            <small class="cart_ref">Giảm giá : <?= $value['invoice_detail_discount'] ?>%</small>
                            <br>

                        </td>
                        <td class="price">
                                        <span>   $<?php
                                            $tongtiensanpham = $value['product_price'] * $value['quantity'];
                                            $tiengiamgia = ($value['product_price'] * $value['quantity']) * ($value['invoice_detail_discount'] / 100);
                                            $tien = $tongtiensanpham - $tiengiamgia;
                                            echo tien($tien)
                                            ?>VND</span>
                        </td>

                    </tr>

                    <?php $tongtien = $tongtien + $tien;
                } ?>


                </tbody>
                <tfoot>

                <tr>
                    <td colspan="2" rowspan="2"></td>
                    <td colspan="1"><strong>Tổng tiền s.phẩm</strong></td>
                    <td colspan="1"><strong
                                class="tientotal">$<?= tien($tongtien - $thongtin['invoice_total_discount']) ?>
                            VND</strong></td>
                </tr>
                </tfoot>
            </table>

            <h4>Thông tin hóa đơn</h4>

            <div class="col-3">

                <p><b>Trạng thái hóa đơn:</b> <b
                            class="label label-danger"><?= $this->data['tinhtrang'][$thongtin['invoice_status']] ?> </b>
                </p>
                <p><b>Hình thức thanh toán:</b> <?= $this->data['hinhthucthanhtoan'][$thongtin['invoice_type_pay']] ?>
                </p>

                <?php
                if (kiemtranull($thongtin['invoice_deal_code'])) {
                    ?>
                    <p><b>Mã giao dịch: </b> <b class="label label-success"><?= $thongtin['invoice_deal_code'] ?></b>
                    </p>
                <?php } ?>

            </div>
            <div class="col-3">
                <p><b>Ngày tạo hóa đơn :</b> <?= $thongtin['invoice_date_create'] ?></p>
                <?php if (kiemtranull($thongtin['invoice_date_pay'])) { ?>
                    <p><b>Ngày thanh toán :</b> <?= $thongtin['invoice_date_pay'] ?></p>
                <?php } ?>
                <?php
                if ($thongtin['invoice_total_discount'] > 0) {
                    ?>
                    <p><b>Tổng giảm giá:</b> <?= $thongtin['invoice_total_discount'] ?>%</p>
                <?php } ?>
            </div>
            <div class="clearfix"></div>

            <?php if (kiemtranull($thongtin['invoice_note'])) { ?>
                <hr>
                <p><b>Ghi chú:</b>

                    <?= string_output($thongtin['invoice_note']) ?>
                </p>
            <?php } ?>
            <?php if ($thongtin['invoice_money_plus'] != '' && $thongtin['invoice_money_plus'] != 0) { ?>
                <hr>
                <p><b>Phí phát sinh:</b> <?= tien($thongtin['invoice_money_plus']) ?>VND</p>
                <p><b>Ghi chú phí phát sinh:</b> <?= $thongtin['invoice_note_money_plus'] ?></p>
            <?php } ?>
            <?php if ($thongtin['invoice_money_subtract'] != '' && $thongtin['invoice_money_subtract'] != 0) { ?>
                <hr>
                <p><b>Tiền trừ:</b> <?= tien($thongtin['invoice_money_subtract']) ?>VND</p>
                <p><b>Ghi chú trừ:</b> <?= $thongtin['invoice_note_money_subtract'] ?></p>
            <?php } ?>
            <div class="tongtien"><b>Tổng tiền:</b> $<?= tien($thongtin['invoice_amout']) ?>VND</div>
        </div>
    </div>

</div>


<div class=" text-center no-print">
    <hr>
    <button class="btn btn-danger" onclick="window.print();">IN / LƯU HÓA ĐƠN</button>
    <hr>
</div>

</body>
</html>
