
<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i>Quản trị
    </li>
    <li class="active">
        <i class="fa fa-list"></i> Thêm sản phẩm mới
    </li>
</ol>
<?php if (!isset($_GET['career_id'])) {
    ?>

    <!-- Chọn ngành -->

    <form method="GET">
        <div class="md-card">
            <div class="md-card-content">
                <h3 class="heading_a">Vui lòng chọn</h3>
                <div class="uk-grid" data-uk-grid-margin>

                    <div
                        class="uk-width-medium-1-2 uk-width-large-1-2 <?= count($this->data["career"]) == 1 ? "hidden" : "" ?>">
                        <b>Ngành nghề</b> <select name="career_id" id="select_demo_1" data-md-selectize>
                            <?php foreach ($this->data["career"] as $value) { ?>
                                <option
                                    value="<?= $value['career_id'] ?>"><?= $value['career_name'] ?></option>
                                <?php } ?>
                        </select>

                    </div>
                    <div class="uk-width-medium-1-1 uk-width-large-1-1 text-center">
                        <button class="md-btn md-btn-primary btnchon" type="submit">Chọn</button>
                    </div>
                    <?php
                    if (count($this->data["career"]) == 1) {
                        ?>
                        <script>
                            $(".btnchon").click();
                        </script>
                    <?php } ?>
                </div>
            </div>
        </div>
    </form>

<?php } else { ?>
    <?php
    $product_prop = $this->data["property"];
    $attribute = $this->data["attribute"];
    $category = $this->data["category"];
    $tag  =  $this->data["tag"];

    function buiding_menu($parent, $menuData) {
        $html = "";
        if (isset($menuData['parent'][$parent])) {
            $html .= "<ul >";
            foreach ($menuData['parent'][$parent] as $value) {
                $html .= "<li>";
                $html .= " <span> <input class='productcategory_id' type='checkbox' name='productcategory_id[]'  id='" . $menuData['items'][$value]['productcategory_id'] . "' value='" . $menuData['items'][$value]['productcategory_id'] . "' data-md-icheck>    <label for='" . $menuData['items'][$value]['productcategory_id'] . "'>" . $menuData['items'][$value]['productcategory_name'] . "   </label> </span>";
                $html .= buiding_menu($value, $menuData);
                $html .= "</li>";
            }
            $html .= "</ul>";
        }
        return $html;
    }
    ?>

    <form action="<?= ADMIN_URL ?>product/insert" class="uk-form-stacked" id="formthemsanpham"
          method="post">
        <input name="career_id" value="<?= $_GET['career_id'] ?>" class="hidden">
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
                                        <label for="product_edit_name_control">Mã sản phẩm</label>
                                        <input type="text" class="md-input" id="product_edit_name_control"
                                               name="product_code" value=""/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                        <label for="product_edit_name_control">Tên sản phẩm</label>
                                        <input required="" type="text" class="md-input"
                                               id="product_edit_name_control" name="product_name"/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                        <label for="product_edit_name_control">Slug</label>
                                        <input required="" type="text" class="md-input"
                                               id="product_edit_name_control" name="product_slug" value=" "/>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                        <label for="product_edit_name_control">Giá</label>
                                        <input required="" type="text" class="md-input"
                                               id="product_edit_name_control" name="product_price" value=""/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                        <label for="product_edit_name_control">Đơn vị tính</label>
                                        <input type="text" class="md-input" id="product_edit_name_control"
                                               name="product_unit" value=""/>
                                    </div>
                                </div>
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                        <label for="product_edit_name_control">Số lượng</label>
                                        <input required="" type="number" class="md-input"
                                               id="product_edit_name_control" name="product_total" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-width-large-1-2">

    <?php   foreach ($attribute as $value) { ?>
           
                                        <div class="uk-form-row">
                                            <label class="uk-form-label"
                                                   for="product_edit_tags_control"><?= $value['productattr_name'] ?></label>

                                            <label class="label label-default sethienthi "
                                                   set="<?= $value['productattr_id'] ?>"><i
                                                    class="glyphicon glyphicon-eye-open"> </i></label>
                                            <input class="hienthichitiet"
                                                   type="checkbox" value="<?= $value['productattr_id'] ?>"
                                                   id="<?= $value['productattr_id'] ?>" name="hienthichitiet[]">
                                            <select name="<?= $value['productattr_id'] ?>[]"
                                                    class="<?= $value['productattr_id'] ?> form-control "
                                                    multiple="multiple">
            <?php foreach ($value['value'] as $giatri) { ?>
                                                    <option value="<?= $giatri['attr_val_id'] ?>"><?= $giatri['attr_val_label'] ?></option>
                                                        <?php } ?>
                                            </select>
                                            <script type="text/javascript">
                                                $(".<?= $value['productattr_id'] ?>").select2({
                                                    placeholder: "Chọn <?= $value['productattr_name'] ?>"
                                                });
                                            </script>
                                        </div>

        <?php    }    ?>
 


                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <div class="md-input-wrapper md-input-filled">
                                            <label for="uk_dp_1">Ngày tạo</label>
                                            <input class="md-input datetime" type="text" id="uk_dp_1" name="product_date_create"
                                                   value=""
                                                   data-uk-datepicker="{format:'DD/MM/YYYY',i18n:{ months:['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],weekdays:['Chủ nhật','TH2','TH3','TH4','TH5','TH6','TH7']}}">
                                            <span class="md-input-bar"></span></div>

                                    </div>
                                </div>

                                    <div style="border: 1px solid #F1E8E8;margin: 30px 0px 0px 0px;padding: 10px;">
                                        <div class="uk-form-row">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    Nổi bật</span>
                                                <div class="md-input-wrapper md-input-filled">
                                                    <input name="product_feature" type="checkbox" data-switchery
                                                           data-switchery-color="#d32f2f" id="switch_demo_danger"/>
                                                    <label for="switch_demo_danger" class="inline-label"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="uk-form-row">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    Sản phẩm mới</span>
                                                <div class="md-input-wrapper md-input-filled">
                                                    <input name="product_new" type="checkbox" data-switchery
                                                           data-switchery-color="2faff9" id="switch_demo_danger"/>
                                                    <label for="switch_demo_danger" class="inline-label"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    Bán chạy</span>
                                                <div class="md-input-wrapper md-input-filled">
                                                    <input name="product_selling" type="checkbox" data-switchery
                                                           data-switchery-color="#ed4bda" id="switch_demo_danger"/>
                                                    <label for="switch_demo_danger" class="inline-label"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon">
                                                    Hiển thị</span>
                                                <div class="md-input-wrapper md-input-filled ">
                                                    <input name="product_show" type="checkbox" data-switchery
                                                           data-switchery-color="#1e88e5" checked
                                                           id="switch_demo_primary"/>
                                                    <label for="switch_demo_primary" class="inline-label"></label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                            Miêu tả
                        </h3>
                    </div>
                    <div class="md-card-content">
                        <textarea name="product_content" class="form-control" id="mieuta"></textarea>
                    </div>
                </div>

                <?php if (!empty($product_prop)) { ?>
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Đặc tính sản phẩm
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <?php foreach ($product_prop as $key => $value) { ?>
                                <div class="uk-form-row">
                                    <label for="product_edit_sn_control"><?= $value['product_prop_id'] ?></label>
                                    <input type="text" class="md-input" id="product_edit_sn_control"
                                           name="property[<?= $value['product_prop_id'] ?>]" value=""/>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                <?php } ?>

            </div>

            <div class="uk-width-xLarge-2-10 uk-width-large-3-10">
                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                            Danh mục sản phẩm
                        </h3>
                    </div>
                    <div class="md-card-content">

                        <div class="pre-scrollable">

                            <div class="treedanhmuc">
                                <?= buiding_menu(0, $category)  ?>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="md-card">
                    <div class="md-card-toolbar">
                        <h3 class="md-card-toolbar-heading-text">
                            Tag
                        </h3>
                    </div>
                    <div class="md-card-content">

                        <div class="uk-form-row">
                            <select class="product_edit_tags_control" name="tag[]" multiple>

                            </select>


                            <script>

                                $(function () {

                                    altair_product_edit.init()
                                }),
                                        altair_product_edit = {
                                            init: function () {
                                                altair_product_edit.edit_form(),
                                                        altair_product_edit.product_tags()
                                            },
                                            edit_form: function () {
                                                var t = $(".product_edit_form"),
                                                        i = $(".product_edit_submit"), e = $("#product_edit_name"),
                                                        n = $(".product_edit_name_control"), o = $(".product_edit_sn"),
                                                        d = $(".product_edit_sn_control"), r = $(".product_edit_manufacturer_control"),
                                                        u = $(".product_edit_color_control"), c = $(".product_edit_memory_control"),
                                                        l = function () {
                                                            return e.text(r.val() + " " + n.val() + ", " + c.val() + ", " + u.val())
                                                        };
                                                n.on("keyup", function () {
                                                    l()
                                                }),
                                                        r.on("keyup", function () {
                                                            l()
                                                        }),
                                                        d.on("keyup", function () {
                                                            o.text(d.val())
                                                        }),
                                                        u.on("change", function () {
                                                            l()
                                                        }),
                                                        c.on("change", function () {
                                                            l()
                                                        }),
                                                        i.on("click", function (i) {
                                                            i.preventDefault();
                                                            var e = JSON.stringify(t.serializeObject(), null, 2);
                                                            UIkit.modal.alert("<p>Product data:</p><pre>" + e + "</pre>")
                                                        })
                                            },
                                            product_tags: function () {
                                                $(".product_edit_tags_control").selectize({
                                                    plugins: {remove_button: {label: ""}},
                                                    placeholder: "Nhập tag cho sản phẩm",
                                                    options: [
    <?php foreach ($tag as $key => $value) { ?>
                                                            {
                                                                title: "<?= $value['tag_name'] ?>",
                                                                value: "<?= $value['tag_name'] ?>"
                                                            },
    <?php } ?>
                                                    ],
                                                    render: {
                                                        option: function (t, i) {
                                                            return '<div class="option"><span>' + i(t.title) + "</span></div>"
                                                        }, item: function (t, i) {
                                                            return '<div class="item">' + i(t.title) + "</div>"
                                                        }
                                                    },
                                                    maxItems: null,
                                                    valueField: "value",
                                                    labelField: "title",
                                                    searchField: "title",
                                                    create: !0,
                                                    onDropdownOpen: function (t) {
                                                        t.hide().velocity("slideDown", {
                                                            begin: function () {
                                                                t.css({"margin-top": "0"})
                                                            }, duration: 200, easing: easing_swiftOut
                                                        })
                                                    },
                                                    onDropdownClose: function (t) {
                                                        t.show().velocity("slideUp", {
                                                            complete: function () {
                                                                t.css({"margin-top": ""})
                                                            }, duration: 200, easing: easing_swiftOut
                                                        })
                                                    }
                                                })
                                            }
                                        };
                            </script>
                        </div>

                    </div>
                </div>


                <div class="md-card">
                    <div class="md-card-toolbar">
                        <div class="md-card-toolbar-actions">
                            <i class="boxchonfile md-icon material-icons">
                                <input multiple="" id="chonfile" type="file"></i>
                            <input type="text" style="display: none" name="tmp_photo" id="tmp_photo"/>

                        </div>
                        <h3 class="md-card-toolbar-heading-text">
                            Photos
                        </h3>
                    </div>
                    <div class="md-card-content">

                        <div class="uk-margin-bottom uk-text-center uk-position-relative">
                            <div class="boxanhdaidien">
                                <div class="boxphantram">
                                    <div class="uk-progress uk-progress-striped uk-active">
                                        <div class="uk-progress-bar phantramanhdaidien" style="width:0%;"></div>
                                    </div>
                                </div>
                                <img class="img-responsive" id="imgavatar"
                                     src="">
                                <a class="changeavatar">
                                    <input type="file" class="form-control" id="doiavatar">
                                    <i class="glyphicon glyphicon-camera"></i>
                                    Cập nhật ảnh đại diện
                                </a>
                                <input type="text" style="display: none" name="tmp_ava" id="tmp_ava"/>

                            </div>

                        </div>
                        <ul class="uk-sortable uk-grid uk-grid-small uk-grid-width-1-3"
                            data-uk-sortable="{group:'connected-group'}">


                        </ul>

                    </div>
                    <div id="thongbaoupdate"></div>
                </div>


                <!--                        <div class="md-card">
                                            <div class="md-card-toolbar">
                                                <div class="md-card-toolbar-actions">

                                                        <input multiple="" id="chonfiletest" type="file">


                                                </div>
                                                <h3 class="md-card-toolbar-heading-text">
                                                    Photos
                                                </h3>
                                            </div>
                                            <div class="md-card-content">

                                                <div class="uk-margin-bottom uk-text-center uk-position-relative">


                                                </div>
                                            </div>
                                        </div>-->

            </div>
        </div>
        <br>
        <div class="text-center col-md-12">

            <input type="submit" id="themsanpham" class="md-btn md-btn-primary btnlink" value="THÊM">

        </div>
    </form>

    <script src="<?=  load_public("lib/ckeditor/ckeditor.js" )?>"></script>
    <script src="<?= load_admin_view("product/js/create.js" )?>"></script>
    <script type="text/javascript">CKEDITOR.replace('mieuta');</script>

<?php } ?>