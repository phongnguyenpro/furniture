<?php
$user =$this->data["user"];
?>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Quản trị
            </li>
            <li class="active">
                <i class="fa fa-list"></i> Tài khoản
            </li>
        </ol>     
        <!-- FORM THONG TIN -->
        <form action="<?= ADMIN_URL ?>user/insert"  class="uk-form-stacked" name="updateuser" id="form_validation" method="post" enctype="multipart/form-data">
            
        
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>

                <div class="uk-width-xLarge-8-10  uk-width-large-7-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Thông tin
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                <div class="uk-width-large-1-2">


                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon">
                                                <i class="uk-icon-edit"></i>
                                            </span>
                                            <label for="product_edit_name_control">Emai đăng nhập</label>
                                            <input  required="" type="email"  name="user_email"  class="md-input" id="product_edit_name_control"  value='<?= $this->data['user']["user_email"] ?>'/>
                                        </div>
                                    </div>

                                   <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon">
                                                <i class="uk-icon-edit"></i>
                                            </span>
                                            <label for="product_edit_name_control">Mật khẩu:</label>
                                            <input  type="password"   class="md-input" id="password_confirmation" required="" name="user_password"  value='<?= $this->data['user']["user_password"] ?>'/>
                                        </div>
                                    </div>
                                        <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon">
                                                <i class="uk-icon-edit"></i>
                                            </span>
                                            <label for="product_edit_name_control">Nhập lại mật khẩu:</label>
                                            <input  type="password" data-parsley-equalto="#password_confirmation" required="" class="md-input"  name="user_password"  value='<?= $this->data['user']["user_password"] ?>'/>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                              <span class="uk-input-group-addon">
                                                <i class="uk-icon-edit"></i>
                                            </span>
                                            <select class="basic" name="user_role">
                                                <?php foreach (getrole() as $k=>$v){?>
                                                <option <?= $user["user_role"]==$k?"selected":"" ?> value="<?= $k ?>"><?= $v["label"] ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="uk-width-large-1-2">

<div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon">
                                                <i class="uk-icon-edit"></i>
                                            </span>
                                            <label for="product_edit_name_control">Tên tài khoản</label>
                                            <input  type="text"  class="md-input" required="" id="product_edit_name_control" name="user_name"  value='<?= $user["user_name"] ?>'/>
                                        </div>
                                    </div>
 <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon">
                                                <i class="uk-icon-select"></i>
                                            </span>
                                            <label for="product_edit_name_control">Giới tính</label>
                             <div class="uk-form-row parsley-row">
                                    <span class="icheck-inline">
                                        <input value="1" type="radio" <?= $user["user_sex"]==1?"checked":"" ?> name="user_sex" id="val_radio_male" data-md-icheck required />
                                        <label for="val_radio_male" class="inline-label">Male</label>
                                    </span>
                                    <span class="icheck-inline">
                                        <input  type="radio" name="user_sex" <?= $user["user_sex"]==2?"checked":"" ?> id="val_radio_female" data-md-icheck />
                                        <label for="val_radio_female" class="inline-label">Female</label>
                                    </span>
                                </div>
                                        </div>
                                    </div>

                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon">
                                                <i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                            <div class="md-input-wrapper md-input-filled">
                                                <label for="uk_dp_1">Ngày sinh</label>
                                                <input class="md-input datetime" type="text" id="uk_dp_1" name="user_birthday" value="<?= $user["user_birthday"] ?>" data-uk-datepicker="{format:'DD/MM/YYYY',i18n:{ months:['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],weekdays:['Chủ nhật','TH2','TH3','TH4','TH5','TH6','TH7']}}"  >
                                                <span class="md-input-bar"></span></div>

                                        </div>
                                    </div>


                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon">
                                                <i class="uk-icon-edit"></i>
                                            </span>
                                            <label for="product_edit_name_control">Địa chỉ</label>
                                            <input  type="text"  class="md-input" id="product_edit_name_control" name="user_address"  value='<?= $user["user_address"] ?>'/>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon">
                                                <i class="uk-icon-edit"></i>
                                            </span>
                                            <label for="product_edit_name_control">SDT</label>
                                            <input  type="text"  class="md-input" id="product_edit_name_control" name="user_phone"  value='<?= $user["user_phone"] ?>'/>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon">
                                                <i class="uk-icon-edit"></i>
                                            </span>
                                            <label for="product_edit_name_control">Ghi chú</label>
                                            <textarea id="product_edit_name_control"  class="md-input" name="user_note"><?= $user["user_note"] ?></textarea>

                                        </div>
                                    </div>
 
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="uk-width-xLarge-2-10 uk-width-large-3-10">

                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Ảnh đại diện
                            </h3>
                        </div>
                        <div class="md-card-content">

                            <div class="uk-margin-bottom uk-text-center uk-position-relative">
                                <div class="boxanhdaidien">
                                    <img class="img-responsive" id="imgavatar" src="">

                                    <a class="changeavatar">
                                        <input id="input_avatar" type="file" class="form-control" name="user_avatar">
                                        <i class="glyphicon glyphicon-camera"></i> 
                                        Cập nhật ảnh đại diện  
                                    </a>


                                </div>

                            </div>
                        </div>
                    </div>




                </div>


            </div>
            <br>

            <div class="text-center col-md-12">

                <input type="button" id="btn_update_user" class="md-btn md-btn-primary " value="CẬP NHẬT" >

            </div>
<script src="<?= load_admin_view("user/js/create.js") ?>"></script>
