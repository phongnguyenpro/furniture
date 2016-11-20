<?php 

$taikhoan=$this->data['taikhoan'];
 $hoadon=$this->data['hoadon'];
?>
<div class="columns-container">
    <div class="container" id="columns">
        
          <h2 class="page-heading">
            <span class="page-heading-title2">Thông tin tài khoản</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box-authentication">
                        <h3>Thông tin cá nhân</h3>
                        <form id="frmcapnhattaikhoan" method="POST" action="<?= URL ?>taikhoan/update">
                           <div class="form-group  has-feedback ">
                             <label for="password_login">Avatar</label>
                             <div class="text-center">  
                             <?php if($taikhoan['hinhdaidien']) {?>
                                 <img class="img-circle" width="100px" height="100px" src="<?= URL ?>public/upload/images/hinhtaikhoan/<?= $taikhoan['hinhdaidien']?>">
                             <?php }else{?>
                                                                  <img class="img-circle" width="100px" height="100px" src="<?= URL ?>lib/public/image/taikhoanmacdinh.png">
                             <?php }?>
                             </div>
                           </div>
                            <div class="form-group  has-feedback ">
                             <label for="password_login">Mật khẩu</label>
                        <input minlength="3" name="matkhau" value='<?= $taikhoan['matkhau2'] ?>' required=""  type="text" class="form-control">   
                            </div>
                          <div class="form-group  has-feedback ">
                        <label for="password_login">Tên</label>
                        <input name="tentaikhoan" value='<?= $taikhoan['tentaikhoan'] ?>'  required=""   type="text" class="form-control">
                          </div>
                             <div class="form-group  has-feedback ">
                        <label for="password_login">Tuổi</label>
                        <input required=""  value='<?= $taikhoan['tuoi'] ?>' type="number" min="10" name="tuoi" class="required form-control" placeholder="Tuổi">
                        <input required=""  value='<?= $_SESSION['token']?>' type="text" min="10" name="token" class="required hidden form-control" placeholder="Tuổi">
                             </div>
                        <label for="password_login">Giới tính</label>
                       <div class="icheck">
            <div class="itemicheck">
                <input id="namup" <?= $taikhoan['gioitinh']==1?"checked":"" ?>  value="1" class="required" name="gioitinh"  type="radio">
                <label  class="view " for="namup">Nam<span class="button"></span></label>
                
            </div>
            <div class="itemicheck">
                <input <?= $taikhoan['gioitinh']==2?"checked":"" ?> class="required" value="2" name="gioitinh" id="nuup" type="radio">
                <label class="view" for="nuup">Nữ<span class="button"></span></label>
            </div>
        </div>
                         <div class="form-group  has-feedback ">
                      
                             <label for="password_login">SDT</label>
                        <input required=""  name="sdt" value='<?= $taikhoan['sdt'] ?>'  type="text" class="form-control">
                   
                       </div>
                         <div class="form-group  has-feedback ">
                         
                           <label for="password_login">Địa chỉ</label>
                         <input required="" name="diachi" value='<?= $taikhoan['diachi'] ?>'  type="text" class="form-control">
                           
                         </div>
                        <button type="submit" id="btncapnhat" class="button"><i class="fa fa-save"></i>Cập nhật</button>
                           </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box-authentication">
                       <h3>Đơn hàng đã đặt</h3>
                       <table class="table table-bordered text-center">
                           <thead>
                           <th>Mã hóa đơn</th>
                           <th>Ngày tạo</th>
                           <th>Xem</th>
                           </thead>
                      
                       <?php foreach ($hoadon as $value){?>
                       <tr>
                           <td><b><?= $value['mahoadon'] ?></b></td>
                           <td><b><?= ngayoutput($value['ngaytao']) ?></b></td>
                           <td><a target="_blank" href="<?= URL ?>hoadon?mahoadon=<?= $value['mahoadon'] ?>&token=<?= $value['mabaove'] ?>"><i class="fa fa-eye"></i></a></td>
                         </tr>
                       
                       <?php }?>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  </div>
    </div>