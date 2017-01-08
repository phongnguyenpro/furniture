<?php
$data = $this->data["config"];
?>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Quản trị
            </li>
            <li class="active">
                <i class="fa fa-list"></i> Cấu hình website
            </li>
        </ol>
        <form action="<?= ADMIN_URL ?>config/save" method="post">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-8-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                THÔNG TIN CHUNG
                            </h3>
                        </div>
                        <br>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">


                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Tên Shop: </label>
                                        <input value='<?= $data['tenshop'] ?>' required="" type="text" class="md-input"
                                               id="product_edit_name_control" name="tenshop"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Miêu tả: </label>
                                        <input value='<?= $data['mieuta'] ?>' required="" type="text" class="md-input"
                                               id="product_edit_name_control" name="mieuta"/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <a title="Đổi logo" id="openCKf"
                                   onclick="BrowseServer('product_edit_name_control_logo','Images');"><i
                                        style="color:blue" class="uk-icon-edit uk-margin-small-top"></i></a>
                            </span>
                                        <label for="product_edit_name_control_logo">LOGO: </label>
                                        <input title="Click hình bên trái để đổi logo" value='<?= $data['logo'] ?>'
                                               required="" type="text" class="md-input"
                                               id="product_edit_name_control_logo" name="logo"/>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="uk-width-medium-1-2">
                             <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">SDT: </label>
                                        <input value='<?= $data['sdt'] ?>' required="" type="text" class="md-input"
                                               id="product_edit_name_control" name="sdt"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Địa chỉ: </label>
                                        <input value='<?= $data['diachi'] ?>' required="" type="text" class="md-input"
                                               id="product_edit_name_control" name="diachi"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Email: </label>
                                        <input value='<?= $data['email'] ?>' required="" type="text" class="md-input"
                                               id="product_edit_name_control" name="email"/>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                HÌNH ẢNH
                            </h3>
                        </div>
                        <br>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">


                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">WIDTH ảnh sản phẩm: </label>
                                        <input value='<?= $data['width'] ?>' required="" type="number" class="md-input"
                                               id="product_edit_name_control" name="width"/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">HEIGHT ảnh sản phẩm: </label>
                                        <input value='<?= $data['height'] ?>' required="" type="number" class="md-input"
                                               id="product_edit_name_control" name="height"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">WIDTH ảnh thu nhỏ sản phẩm: </label>
                                        <input value='<?= $data['widththumb'] ?>' required="" type="number"
                                               class="md-input" id="product_edit_name_control" name="widththumb"/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">HEIGHT ảnh thu nhỏ sản phẩm: </label>
                                        <input value='<?= $data['heightthumb'] ?>' required="" type="number"
                                               class="md-input" id="product_edit_name_control" name="heightthumb"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">WIDTH ảnh bài viết: </label>
                                        <input value='<?= $data['widthanhbaiviet'] ?>' required="" type="number"
                                               class="md-input" id="product_edit_name_control" name="widthanhbaiviet"/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">HEIGHT ảnh bài viết: </label>
                                        <input value='<?= $data['heightanhbaiviet'] ?>' required="" type="number"
                                               class="md-input" id="product_edit_name_control" name="heightanhbaiviet"/>
                                    </div>
                                </div>
                                <br>
                            </div>

                            <div class="uk-width-medium-1-2">

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Xử lý ảnh: </label><br>
                                        <span class="icheck-inline">
                                <input <?= $data['typeimage'] == "resize" ? "checked" : "" ?> value="resize"
                                                                                              data-md-icheck
                                                                                              name="typeimage"
                                                                                              id="resize" type="radio">
                                <label for="resize">Resize</label>
                            </span>
                                        <span class="icheck-inline">
                                <input <?= $data['typeimage'] == "resizeauto" ? "checked" : "" ?> value="resizeauto"
                                                                                                  id="resizeauto"
                                                                                                  data-md-icheck
                                                                                                  name="typeimage"
                                                                                                  type="radio">
                                <label for="resizeauto">Resize auto</label>
                            </span>
                                        <span class="icheck-inline">
                                <input <?= $data['typeimage'] == "fit" ? "checked" : "" ?> value="fit" data-md-icheck
                                                                                           name="typeimage" type="radio"
                                                                                           id="fit">
                                <label for="fit">Fit</label>
                            </span>
                                        <span class="icheck-inline">
                                <input <?= $data['typeimage'] == "fill" ? "checked" : "" ?> value="fill" id="fill"
                                                                                            data-md-icheck
                                                                                            name="typeimage"
                                                                                            type="radio">
                                <label for="fill">Fill</label>
                            </span>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Chèn logo: </label><br>
                                        <span class="icheck-inline">
                                <input <?= $data['chenlogo'] == "1" ? "checked" : "" ?> value="1" data-md-icheck
                                                                                        name="chenlogo" id="chenlogo"
                                                                                        type="radio">
                                <label for="chenlogo">Cho phép</label>
                            </span>
                                        <span class="icheck-inline">
                                <input <?= $data['chenlogo'] == "0" ? "checked" : "" ?> value="0" data-md-icheck
                                                                                        name="chenlogo"
                                                                                        id="khongchenlogo" type="radio">
                                <label for="khongchenlogo">Không cho phép</label>
                            </span>
                                        <br>
                                        <label for="product_edit_name_control">Vị trí chèn: </label><br>
                                        <span class="icheck-inline">
                                <input <?= $data['kieuchen'] == "topleft" ? "checked" : "" ?> value="topleft"
                                                                                              data-md-icheck
                                                                                              name="kieuchen"
                                                                                              id="topleft" type="radio">
                                <label for="topleft">Top-Left</label>
                            </span>
                                        <span class="icheck-inline">
                                <input <?= $data['kieuchen'] == "topright" ? "checked" : "" ?> value="topright"
                                                                                               id="topright"
                                                                                               data-md-icheck
                                                                                               name="kieuchen"
                                                                                               type="radio">
                                <label for="topright">Top-Right</label>
                            </span>
                                        <span class="icheck-inline">
                                <input <?= $data['kieuchen'] == "center" ? "checked" : "" ?> value="center"
                                                                                             data-md-icheck
                                                                                             name="kieuchen"
                                                                                             type="radio" id="center">
                                <label for="center">Center</label>
                            </span>
                                        <span class="icheck-inline">
                                <input <?= $data['kieuchen'] == "botleft" ? "checked" : "" ?> value="botleft"
                                                                                              id="botleft"
                                                                                              data-md-icheck
                                                                                              name="kieuchen"
                                                                                              type="radio">
                                <label for="botleft">Bot-Left</label>
                            </span>
                                        <span class="icheck-inline">
                                <input <?= $data['kieuchen'] == "botright" ? "checked" : "" ?> value="botright"
                                                                                               id="botright"
                                                                                               data-md-icheck
                                                                                               name="kieuchen"
                                                                                               type="radio">
                                <label for="botright">Bot-Right</label>
                            </span>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
								<a title="Đổi logo" id="openCKf"
                                   onclick="BrowseServer('product_edit_name_control_urlanhchen','Images');"><i
                                        style="color:blue" class="uk-icon-edit uk-margin-small-top"></i></a>
                            </span>
                                        <label for="product_edit_name_control">Ảnh chèn: </label>
                                        <input value='<?= $data['urlanhchen'] ?>' required="" class="md-input"
                                               id="product_edit_name_control_urlanhchen" name="urlanhchen"/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="uk-width-xLarge-8-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Sản phẩm
                            </h3>

                        </div>
                        <br>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">SL sản phẩm module: </label>
                                        <input min="1" value='<?= $data['limitmodule'] ?>' required="" type="number"
                                               class="md-input" id="product_edit_name_control" name="limitmodule"/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">SL sản phẩm nhiều danh mục: </label>
                                        <input min="1" value='<?= $data['limitdanhmucnhieu'] ?>' required=""
                                               type="number" class="md-input" id="product_edit_name_control"
                                               name="limitdanhmucnhieu"/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">SL sản phẩm danh mục: </label>
                                        <input min="1" value='<?= $data['limitdanhmucit'] ?>' required="" type="number"
                                               class="md-input" id="product_edit_name_control" name="limitdanhmucit"/>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">SL sản phẩm danh mục trang chủ: </label>
                                        <input min="1" value='<?= $data['limitdanhmuctrangchu'] ?>' required=""
                                               type="number" class="md-input" id="product_edit_name_control"
                                               name="limitdanhmuctrangchu"/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">SL sản phẩm liên quan: </label>
                                        <input min="1" value='<?= $data['limitsanphamlienquan'] ?>' required=""
                                               type="number" class="md-input" id="product_edit_name_control"
                                               name="limitsanphamlienquan"/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">SL bài viết module: </label>
                                        <input min="1" value='<?= $data['limitmodulebaiviet'] ?>' required=""
                                               type="number" class="md-input" id="product_edit_name_control"
                                               name="limitmodulebaiviet"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">SL bài viết danh mục: </label>
                                        <input min="1" value='<?= $data['limitbaiviet'] ?>' required="" type="number"
                                               class="md-input" id="product_edit_name_control" name="limitbaiviet"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    <div class="uk-width-xLarge-8-10  uk-width-large-10-10">
                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                            Cấu hình EMAIL
                        </h3>
                          
                    </div>
                     <br>
                         <div class="uk-grid">
                        <div class="uk-width-medium-1-2">
                          <div class="uk-form-row">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                            <label for="product_edit_name_control">Tài khoản mail</label>
                            <input value='<?= $data['taikhoanmail'] ?>'  type="text" class="md-input" id="product_edit_name_control" name="taikhoanmail" />
                        </div>
                    </div>  
                            
                                <div class="uk-form-row">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                            <label for="product_edit_name_control">Mật khẩu</label>
                            <input  value='<?= $data['matkhaumail'] ?>'  type="password" class="md-input" id="product_edit_name_control" name="matkhaumail" />
                        </div>
                    </div>
                            
                     
                            
                    </div>
                             <div class="uk-width-medium-1-2">
                                 
                              <div class="uk-form-row">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-send"></i>
                            </span>
                            
                            <button type="button" class="md-btn md-btn-primary btntest">Test send mail</button> 
                        </div>
                    </div>    
                             </div>
                </div>
              </div>
              </div>
                <div class="uk-width-xLarge-8-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Mạng xã hội
                            </h3>

                        </div>
                        <br>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Google Client ID: </label>
                                        <input value='<?= $data['googleclientid'] ?>' type="text" class="md-input"
                                               id="product_edit_name_control" name="googleclientid"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Google Secret: </label>
                                        <input value='<?= $data['googleclientsecret'] ?>' type="text" class="md-input"
                                               id="product_edit_name_control" name="googleclientsecret"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Google map Lat-Lng </label>
                                        <input value='<?= $data['maplat'] ?>' type="text" class="md-input"
                                               id="product_edit_name_control" name="maplat"/>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Facebook Client ID: </label>
                                        <input value='<?= $data['facebookclientid'] ?>' type="text" class="md-input"
                                               id="product_edit_name_control" name="facebookclientid"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Facebook Client Secret: </label>
                                        <input value='<?= $data['facebookclientsecret'] ?>' type="text" class="md-input"
                                               id="product_edit_name_control" name="facebookclientsecret"/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <i class="uk-icon-edit"></i>
                            </span>
                                        <label for="product_edit_name_control">Facebook page URL: </label>
                                        <input value='<?= $data['facebookpageurl'] ?>' type="text" class="md-input"
                                               id="product_edit_name_control" name="facebookpageurl"/>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-xLarge-8-10  uk-width-large-10-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Cache
                            </h3>
                        </div>
                        <br>
                        <div class="uk-grid">
                            <div class="uk-width-medium-1-2">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                             <span class="uk-input-group-addon">
                                <i class="uk-icon-database"></i>
                            </span>
                                        <label for="product_edit_name_control">Cho phép cache</label>
                                        <input <?= $data['cache'] == 1 ? "checked" : "" ?> name="cache" type="checkbox"
                                                                                           data-md-icheck/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              


                <div class="uk-width-xLarge-8-10  uk-width-large-10-10">




                    <div class="md-card uk-width-1-1 text-center">
                        <br>
                        <button class=" md-btn md-btn-primary">LƯU</button>
                        <hr>
                    </div>
                </div>


            </div>

        </form>
<script src="<?= load_admin_view("config/js/index.js") ?>"></script>
