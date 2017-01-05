<?php
$data = $this->data_invoice;

?>
<script src="<?= load_admin_public("assets/js/common.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/uikit_custom.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/altair_admin_common.min.js") ?>"></script>
<script src="<?= load_admin_public("bower_components/ionrangeslider/js/ion.rangeSlider.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/pages/forms_advanced.min.js") ?>"></script>

<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i> Quản trị
    </li>
    <li class="active">
        <i class="fa fa-list"></i> Hóa đơn
    </li>
</ol>
<div class="md-card">

    <div class="md-card-toolbar">
        <h3 class="md-card-toolbar-heading-text">
            Danh sách sản phẩm
        </h3>
    </div>
    <div class="md-card-content">
        <table class="table table-bordered sanpham ">
            <thead>
            <tr>
                <th class="cart_product">Sản phẩm</th>
                <th>Miêu tả</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Cộng tác viên</th>
                <th class="action"><i class="uk-icon-trash-o"></i></th>
            </tr>
            </thead>
            <tbody>
            <?php $tongtien = 0;
            foreach ($data['sanpham'] as $key => $value) { ?>
                <tr>
                    <td class="cart_product">
                        <a href="<?= BASE_URL . $value['product_slug'] . '-' . $value['product_id'] . '.html' ?>">
                            <img class="img-responsive"
                                 src="<?= BASE_URL . "public/upload/images/thumb_product/" . $value['product_avatar'] ?>"
                                 alt="p10">
                        </a>
                    </td>
                    <td class="cart_description">
                        <p class="product-name"><a
                                    href="<?= BASE_URL . $value['product_slug'] . '-' . $value['product_id'] . '.html' ?>"><?= $value['product_name'] ?> </a>
                        </p>
                        <small class="cart_ref">Mã SP : <?= $value['product_code'] ?></small>
                        <br>
                        <small>Thuộc tính: <?= $value['attr_val_labels'] ?></small>
                        <br>


                    </td>
                    <td class="price">
                        <span>$<?= tien($value['product_price']) ?>VND</span><br>
                        <small class="cart_ref">Giảm giá : <?= $value['invoice_detail_discount'] ?>%</small>
                    </td>
                    <td class="qty text-center">
                        <?php if ($data['thongtin']['invoice_status'] != 3) { ?>
                            <input min="1" class="form-control input-sm" type="number" id="quantityInput"
                                   value="<?= $value['quantity'] ?>">

                            <a class="btn btn-default btn-capnhatsoluong"
                               data-id_sanpham="<?= $value['product_id'] ?>"
                               data-dongia="<?= $value['product_price'] ?>"
                               data-id_hoadon="<?= $value['invoice_id'] ?>"
                               data-soluonghientai="<?= $value['quantity'] ?>"
                               data-id_sanphamchitiet="<?= $value['product_detail_id'] ?>"
                               data-id_hoadonchitiet="<?= $value['invoice_detail_id'] ?>">Cập nhật</a>
                        <?php } else { ?>
                            <?= $value['quantity'] ?>
                        <?php } ?>

                    </td>
                    <td class="price">
                                <span>   $<?php
                                    $tongtiensanpham = $value['product_price'] * $value['quantity'];
                                    $tiengiamgia = ($value['product_price'] * $value['quantity']) * ($value['invoice_detail_discount'] / 100);
                                    $tien = $tongtiensanpham - $tiengiamgia;
                                    echo tien($tien)

                                    ?>VND</span>
                    </td>
                    <td><?= $value['user_email'] ?></td>
                    <td class="congcu">
                        <?php if ($data['thongtin']['invoice_status'] != 3) { ?>
                            <a data-id_hoadon="<?= $data['thongtin']['invoice_id'] ?>"
                               data-id_hoadonchitiet="<?= $value['invoice_detail_id'] ?>"
                               class="label label-danger xoasanphamhoadon">Xóa</a>
                        <?php } ?>
                    </td>

                </tr>

                <?php $tongtien += (int)$tien;
            } ?>
            </tbody>
            <tfoot>

            <tr>
                <td colspan="2" rowspan="2"></td>
                <td colspan="3"><strong>Tổng tiền sản phẩm</strong></td>
                <td colspan="2"><strong class="tientotal">$<?= tien($tongtien) ?>VND</strong></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="md-card">

    <div class="md-card-toolbar">
        <h3 class="md-card-toolbar-heading-text">
            Thông tin hóa đơn
        </h3>
    </div>
    <form id="capnhathoadon" class="form-horizontal">
        <div class="md-card-content">
            <div class="uk-grid uk-grid-divider" data-uk-grid-margin="">

                <div class="uk-width-large-1-3 uk-width-medium-1-2">
                    <?php if ($data['taikhoan'] == 1) { ?>
                        <ul class="md-list">
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><b>Tên KH</b></span>
                                    <span class="uk-text-small uk-text-muted"><?= $data['thongtin']['user_name'] ?></span>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><b>SDT</b></span>
                                    <span class="uk-text-small uk-text-muted">Consectetur sunt </span>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><b>Địa chỉ</b></span>
                                    <span class="uk-text-small uk-text-muted">Consectetur sunt </span>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><b>Email</b></span>
                                    <span class="uk-text-small uk-text-muted">Consectetur sunt </span>
                                </div>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <ul class="md-list ">
                            <?php if ($data['thongtin']['user_id'] != '') { ?>
                                <li>Tạo bởi tài khoản:
                                    <a target="_bank"
                                       href="<?= ADMIN_URL ?>user/edit/<?= $data['thongtin']['user_id'] ?>"> <?= kiemtranull($data['thongtin']['user_email']) == true ? $data['thongtin']['user_email'] : $data['thongtin']['user_name'] ?></a>
                                </li>
                            <?php } ?>
                            <hr>
                            <label class="label label-primary"> THÔNG TIN THANH TOÁN</label>
                            <li>
                                <div class="md-list-content">
                                        <span class="md-list-heading"><b>Mã HĐ</b>
                                            <a href="<?= BASE_URL ?>hoadon?mahoadon=<?= $data['thongtin']['invoice_id'] ?>&token=<?= $data['thongtin']['invoice_protect_code'] ?> "
                                               target="_blank"><i class="glyphicon glyphicon-eye-open"></i> </a>
                                        </span>

                                    <input readonly="" required="" name="invoice_code" class="form-control"
                                           value='<?= $data['thongtin']['invoice_code'] ?>'>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-content">
                                        <span class="md-list-heading"><b>Hình thức thanh toán</b>
                                            <select class="form-control" name="invoice_type_pay">

    <?php foreach ($data['hinhthucthanhtoan'] as $key => $value) { ?>

        <option <?= $data['thongtin']['invoice_type_pay'] == $key ? "selected" : "" ?>
                value="<?= $key ?>"><?= $value ?></option>
    <?php } ?>


                                            </select>
                                        </span>
                                </div>
                            </li>
                            <?php if (kiemtranull($data['thongtin']['invoice_deal_code'])) { ?>
                                <li>
                                    <div class="md-list-content">
                                        <span class="md-list-heading"><b>Mã giao dịch</b></span>
                                        <input required="" name="magiaodich" class="form-control"
                                               value='<?= $data['thongtin']['invoice_deal_code'] ?>'>
                                    </div>
                                </li>
                            <?php } ?>
                            <hr>
                            <label class="label label-primary"> THÔNG TIN KHÁCH HÀNG</label>
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><b>Tên KH</b></span>
                                    <input required="" name="user_name" class="form-control"
                                           value='<?= $data['thongtin']['user_name'] ?>'>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><b>SDT</b></span>
                                    <input name="user_phone" class="form-control"
                                           value='<?= $data['thongtin']['user_phone'] ?>'>

                                </div>
                            </li>
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><b>Địa chỉ</b></span>
                                    <input name="user_address" class="form-control"
                                           value='<?= $data['thongtin']['user_address'] ?>'>
                                </div>
                            </li>
                            <li>
                                <div class="md-list-content">
                                    <span class="md-list-heading"><b>Email</b></span>
                                    <input name="user_email" class="form-control"
                                           value='<?= $data['thongtin']['user_email'] ?>'>
                                </div>
                            </li>
                            <li>

                                <div class="md-list-content">
                                    <span class="md-list-heading"> <i class="md-list-addon-icon material-icons"></i> Ghi chú</span>
                                    <textarea name="invoice_note" class="form-control"
                                              rows="5"><?= $data['thongtin']['invoice_note'] ?></textarea>

                                </div>
                            </li>
                        </ul>
                    <?php } ?>
                </div>

                <div class="uk-width-large-1-3 uk-width-medium-1-2">
                    <ul class="md-list">
                        <label class="label label-primary"> THÔNG TIN PHÍ</label>
                        <li>
                            <div class="md-list-content">
                                <span class="md-list-heading"><b>Phí phát sinh</b></span>
                                <input name="invoice_money_plus" class="form-control tien"
                                       value='<?= tien($data['thongtin']['invoice_money_plus']); ?>'>
                                <span class="md-list-heading"><b>Ghi chú phát sinh</b></span>
                                <textarea name="invoice_note_money_plus" class="form-control"
                                          rows="5"><?= string_output($data['thongtin']['invoice_note_money_plus']) ?></textarea>

                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <span class="md-list-heading"><b>Phí trừ đi</b></span>
                                <input name="invoice_money_subtract" class="form-control tien"
                                       value='<?= tien($data['thongtin']['invoice_money_subtract']) ?>'>
                                <span class="md-list-heading"><b>Ghi chú phí trừ đi</b></span>
                                <textarea name="invoice_note_money_subtract" class="form-control"
                                          rows="5"><?= string_output($data['thongtin']['invoice_note_money_subtract']) ?></textarea>

                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <span class="md-list-heading"><b>Tổng giảm giá(%):</b></span>
                                <input name="invoice_total_discount" class="form-control" type="number"
                                       value='<?= $tonggiamgia = $data['thongtin']['invoice_total_discount']; ?>'>

                            </div>
                        </li>
                    </ul>
                </div>
                <div class="uk-width-large-1-3 uk-width-medium-1-2">
                    <ul class="md-list">
                        <label class="label label-primary">TÌNH TRẠNG HÓA ĐƠN</label>
                        <li>
                            <div class="md-list-content">
                                <span class="md-list-heading"><b>Ngày tạo:</b> <?= $data['thongtin']['invoice_date_create'] ?></span>

                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <span class="md-list-heading"><b>Ngày thanh toán:</b> <?= $data['thongtin']['invoice_date_pay'] ?></span>

                            </div>
                        </li>
                        <?php
                        $tiencong = $data['thongtin']['invoice_money_plus'];
                        $tientru = $data['thongtin']['invoice_money_subtract'];
                        $tien1 = $tongtien + $tiencong - $tientru;
                        $tien2 = $tien1 * ($tonggiamgia / 100);
                        $tongtienhoadon = $tien1 - $tien2;
                        ?>
                        <li>
                            <div class="md-list-content">
                                <div class="alert alert-success ">Tổng tiền hóa đơn: <b
                                            class="totalhoadon"><?= tien($tongtienhoadon) ?></b>VND
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">

                                <?php if ($data['thongtin']['invoice_status'] == 3) { ?>
                                    <div class=" alert alert-success"><i class='glyphicon glyphicon-ok'></i> Hóa
                                        đơn đã được thanh toán
                                    </div>
                                    <input id="tinhtrang" value="3" class="hidden">
                                <?php } else { ?>
                                    <button data-id="<?= $data['thongtin']['invoice_id'] ?>" type="button"
                                            class="btn btn-warning btn-lg btnthanhtoan">
                                        <span><i class="glyphicon glyphicon-usd"></i></span>
                                        <b> Thanh Toán Hóa Đơn</b>
                                    </button>
                                    <input id="tinhtrang" value="2" class="hidden">
                                    <hr>
                                    <div class="alert thongbaothanhtoan ">
                                        Yes
                                    </div>
                                <?php } ?>

                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <span class="md-list-heading"><b>Hàng đã được giao:</b></span>
                                <div class="md-input-wrapper md-input-filled">
                                    <input name="invoice_shipping_status" type="checkbox" data-switchery
                                           data-switchery-color="449D44" <?= $data['thongtin']['invoice_shipping_status'] == 1 ? "checked" : "" ?>
                                           id="switch_demo_danger"/>
                                    <label for="switch_demo_danger" class="inline-label"></label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class=" uk-width-large-1-1 text-center">
                    <input name="id_hoadon" class="hidden" value="<?= $data['thongtin']['invoice_id'] ?>">
                    <button class="btn btn-success">Cập nhật</button>
                </div>

            </div>

        </div>
    </form>


</div>
</div>
</div>
<script src="<?= load_admin_view("invoice/js/view.js") ?>"></script>
