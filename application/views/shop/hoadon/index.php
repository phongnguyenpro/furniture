<html>

    <?php
    $xuly=new \lib\Xulydulieu();
    $thongtin = $this->data['thongtin'];
    $sanpham = $this->data['sanpham'];
    ?>
    <!-- Mirrored from kutethemes.com/demo/kuteshop/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Aug 2015 18:10:16 GMT -->
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="<?= URL . "view/" . THEME ?>/hoadon/css/hoadon.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL . "view/" . THEME ?>/assets/lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= URL . "view/" . THEME ?>/hoadon/css/print.css" type="text/css" media="print" />
         <title><?= $this->data['meta']['title'] ?></title>
    </head>
    <body>

        <div class="boxhoadon clearfix ">
            
            <div class="logo ">
                <img alt="Kute Shop" src="<?= LOGO ?>" />
            </div>
            <div class="info ">

                <p><i class="glyphicon glyphicon-phone"></i><?= SDT ?></p>
                <p><i class="glyphicon glyphicon-send"></i> <?= EMAIL ?></p>
                <p><b>Mã hóa đơn:</b> <i class="label label-info"><?= $thongtin['mahoadon'] ?></i></p>

            </div>
            <div class="clearfix"></div>
            <div class="thongtinkhachhang">

                <h4>Thông tin khách hàng</h4>

                <div class="boxthongtinkhachhang">
                    <div class="col-1">
                        <p> <b>Tên:</b> <?= $thongtin['tenkhachhang'] ?> </p>
                        <p> <b>Địa chỉ :</b> <?= $thongtin['diachi'] ?> </p>
                        
                    </div>
                    <div class="col-2">
                        <p> <b>SDT:</b> <?= $thongtin['sdt'] ?> </p>
                        <p> <b>Email:</b> <?= $thongtin['email'] ?> </p>
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
                          $tongtien=0;  foreach ($sanpham as $value) {
                                ?>
                                <tr>
                                    <td class="cart_product">

                                        <img width="50" class="img-responsive" src="<?= URL . "public/upload/images/thumb_hinhsanpham/" . $value['hinhsanpham'] ?>" alt="p10">

                                        <small><?= $value['tensanpham'] ?></small><br>
                                      <?php if(kiemtranull($value['masanpham'])){ ?>   <small class="cart_ref">Mã SP: <?= $value['masanpham'] ?></small><br><?php } ?>
                                      <?php if(kiemtranull($value['tengiatrithuoctinhchon'])){ ?>
                                      <small>Thuộc tính:
                                            <?= $value['tengiatrithuoctinhchon'] ?>
                                        </small> <br>
                                      <?php }?>
                                    </td>

                                    <td class="qty">
                                        <?= $value['soluongthem'] ?>

                                    </td>
                                    <td class="action">
                                        <b>$<?= tien($value['dongia']) ?>VND</b><br>
                                        <small class="cart_ref">Giảm giá : <?= $value['giamgia'] ?>%</small><br>

                                    </td>
                                    <td class="price">
                                        <span>   $<?php
                                        $tongtiensanpham = $value['dongia'] * $value['soluongthem'];
                                        $tiengiamgia = ($value['dongia'] * $value['soluongthem']) * ($value['giamgia'] / 100);
                                        $tien = $tongtiensanpham - $tiengiamgia;
                                        echo tien($tien)
                                        ?>VND</span>
                                    </td>

                                </tr>

<?php $tongtien=$tongtien+$tien;  } ?>


                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="2" rowspan="2"></td>
                                <td colspan="1"><strong>Tổng tiền s.phẩm</strong></td>
                                <td colspan="1"><strong class="tientotal">$<?= tien($tongtien-$thongtin['tonggiamgia']) ?>VND</strong></td>
                            </tr>
                        </tfoot>    
                    </table>

                    <h4>Thông tin hóa đơn</h4>
                  
                    <div class="col-1">
                    
                        <p> <b>Trạng thái hóa đơn:</b><b class="label label-danger"><?= $this->data['tinhtrang'][$thongtin['tinhtrang']] ?> </b></p>
                                                <p> <b>Hình thức thanh toán:</b> <?= $this->data['hinhthucthanhtoan'][$thongtin['hinhthucthanhtoan']] ?> </p>

                            <?php
                        if(kiemtranull($thongtin['magiaodich']))
                        {
                        ?>
                        <p><b>Mã giao dịch: </b> <b class="label label-success"><?= $thongtin['magiaodich'] ?></b></p>
                        <?php }?>
                      
                    </div>
                    <div class="col-1">
                          <p> <b>Ngày tạo hóa đơn :</b> <?= $thongtin['ngaytao'] ?></p>
                         <?php if(kiemtranull($thongtin['ngaythanhtoan'])){ ?>
                         <p> <b>Ngày thanh toán :</b> <?= $thongtin['ngaythanhtoan'] ?></p>
                         <?php }?>
                      <?php 
                      if($thongtin['tonggiamgia']>0){
                      ?>
                        <p> <b>Tổng giảm giá:</b> <?= $thongtin['tonggiamgia'] ?>%</p>
                      <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                    
                     <?php if(kiemtranull($thongtin['ghichu'])){ ?>
                    <hr>
                    <p> <b>Ghi chú:</b>

                      <?= $xuly->output($thongtin['ghichu']) ?>
                    </p>
                     <?php }?>
                     <?php if($thongtin['tiencong']!='' && $thongtin['tiencong']!=0 ) {?>
                     <hr>
                     <p> <b>Phí phát sinh:</b> <?= tien($thongtin['tiencong']) ?>VND</p>
                     <p> <b>Ghi chú phí phát sinh:</b> <?= $thongtin['ghichucong'] ?></p>
                     <?php } ?>
                        <?php if($thongtin['tientru']!='' && $thongtin['tientru']!=0) {?>
                     <hr>
                     <p> <b>Tiền trừ:</b> <?= tien($thongtin['tientru']) ?>VND</p>
                     <p> <b>Ghi chú trừ:</b> <?= $thongtin['ghichutru'] ?></p>
                     <?php } ?>
                     <div class="tongtien"><b>Tổng tiền:</b> $<?= tien($thongtin['tongtien']) ?>VND</div>
                </div>
            </div>

        </div>



        <?php if($thongtin['tinhtrang']!=3 && $thongtin['hinhthucthanhtoan']==3){ ?>
        <div class=" text-center no-print">
            <?php if($this->data['chophepthanhtoan']){ ?>
            <br>       
            <a  href="<?= URL ?>hoadon/baokim/createurl/<?= $thongtin['mahoadon'] ?>/<?= $thongtin['mabaove'] ?>"><img src="http://www.baokim.vn/developers/uploads/baokim_btn/thanhtoanantoan-l.png" alt="Thanh toán an toàn với Bảo Kim !" border="0" title="Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn" ></a>
            <br><br>
            <div class="huongdanthanhtoan" style="width: 500px;margin: auto">
                <img src="<?= URL ?>view/<?= THEME ?>/assets/images/thanhtoanantoan.jpg">
                <b>Hướng dẫn thanh toán an toàn:</b>
                <ol class="text-left">
                      <li>Click vào nút thanh toán an toàn qua Bảo Kim.</li>
                      <li>Điền đầy đủ thông tin 'Người thanh toán'</li>
                      <li>Xem kỹ các 'thông tin thanh toán' có chính xác với hóa đơn của bạn</li>
                      <li>Tiến hành thanh toán an toàn theo hướng dẫn của BẢO KIM.</li>
                      <li>Khi thanh toán thành công. Hóa đơn của bạn sẽ chuyển sang trạng thái <b>đã thanh toán</b> và xuất hiện <b>mã giao dịch</b>.</li>
                      <li><b style="color: red">Bạn lưu lại mã giao dịch để giải quyết những khiếu nại phát sinh nếu có giữa 2 bên.</b></li>
                </ol>
            </div>
            <br>
            <?php } else{?>
            <hr>
            <div class="alert alert-danger" style="width: 600px;margin: auto">
                <h4>Bạn không thể thanh toán cho hóa đơn của mình vì: </h4>
                <ul class="text-left">
                <?php foreach ($this->data['error'] as $value){ ?>
                     <li><?= $value ?></li>
                <?php } ?>
                 </ul>
            </div>
            <?php } ?>
        </div>
        <?php }?>
        
        <div class=" text-center no-print">
            <hr>
            <button class="btn btn-danger" onclick="window.print();">IN / LƯU HÓA ĐƠN</button>
             <hr>
        </div>

    </body>
</html>
