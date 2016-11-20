
<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i>Quản trị
    </li>
    <li class="active">
        <i class="fa fa-list"></i> Chỉnh sửa sản phẩm
    </li>
</ol>

<?php
$product_prop = $this->data["property"];
$attribute = $this->data["attribute"];
$category = $this->data["category"];
$tag = $this->data["tag"];
$product = $this->data["product"];

function buiding_menu($parent, $menuData, $data) {
    $html = "";
    if (isset($menuData['parent'][$parent])) {
        $html .= "<ul >";
        foreach ($menuData['parent'][$parent] as $value) {
            $html .= "<li>";
            $temp = in_array($menuData['items'][$value]['productcategory_id'], $data) == true ? "checked" : "";
            $html .= " <span> <input $temp class='id_danhmuc' type='checkbox' name='productcategory_id[]'  id='" . $menuData['items'][$value]['productcategory_id'] . "' value='" . $menuData['items'][$value]['productcategory_id'] . "' data-md-icheck>    <label for='" . $menuData['items'][$value]['productcategory_id'] . "'>" . $menuData['items'][$value]['productcategory_name'] . "   </label> </span>";
            $html .= buiding_menu($value, $menuData, $data);
            $html .= "</li>";
        }
        $html .= "</ul>";
    }
    return $html;
}
?>

        <!-- modal hinh anh -->
        <div id='chonhinhanh' class="uk-modal">
            <div class="uk-modal-dialog">

                <div class="uk-modal-header">Chọn hình ảnh</div>

                <ul class="uk-grid uk-grid-small uk-grid-width-1-4 listchonhinh">

                    <li data-name="<?= $product["product"]['product_avatar'] ?>" class="uk-grid-margin itemhinhchon">
                        <img title="<?= $product["product"]['product_avatar'] ?>"
                             src="<?= BASE_URL ?>public/upload/images/product/<?= $product["product"]['product_avatar'] ?>"
                             alt="" class="img-responsive img_small">
                    </li>
                    <?php foreach ($product['product_images'] as $key => $value) { ?>

                        <li data-name="<?= $value['product_images_name'] ?>" class="uk-grid-margin itemhinhchon">
                            <img title="<?= $value['product_images_name'] ?>"
                                 src="<?= BASE_URL ?>public/upload/images/product/<?= $value['product_images_name'] ?>" alt=""
                                 class="img-responsive img_small">
                        </li>

                    <?php } ?>


                </ul>

                <div class="uk-modal-footer ">
                    <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
                    <a class="pull-right md-btn md-btn-primary btnchonhinh">Chọn hình</a>
                </div>

            </div>
        </div>


        <!-- modal edit -->
        <div id='showedit' class="uk-modal">
            <div class="uk-modal-dialog">

                <div class="uk-modal-header">EDIT</div>


                <fieldset>
                    <?php

                    foreach ($attribute as $value) { ?>
                        <div class="uk-form-row">
                            <label class="uk-form-label"
                                   for="product_edit_tags_control"><?= $value['productattr_name'] ?></label>

                            <select class=" chonthuoctinhsanphamchitietedit form-control ">
                                <option value="-1">Không chọn</option>
                                <?php foreach ($value['value'] as $giatri) { ?>
                                    <option
                                        value="<?= $giatri['attr_val_id'] ?>"><?= $giatri['attr_val_label'] ?></option>
                                <?php } ?>
                            </select>

                        </div>

                    <?php } ?>
                    <div class="form-group uk-form-row">
                        <label class="control-label col-sm-3" for="email">Giá sản phẩm:</label>
                        <div class="col-sm-8">
                            <input class="form-control  txtgia" id="giasanphamchitietedit" type="text" placeholder="">
                        </div>
                    </div>
                    <div class="form-group uk-form-row">
                        <label class="control-label col-sm-3" for="email">Số lượng:</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="soluongsanphamchitietedit" type="text" placeholder="">
                            <input class="form-control hidden" id="idsanphamchitietedit" type="number" min="1"
                                   placeholder="">
                            <input class="form-control hidden" id="hinhsanphamchitiet" placeholder="">
                        </div>
                    </div>

                    <div class="uk-form-row text-center ">
                        <button class="uk-button btnlink btncapnhatsanphamchitiet">Cập nhật</button>
                    </div>
                </fieldset>

                <div class="uk-modal-footer"><a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

            </div>
        </div>







<form action="<?= ADMIN_URL ?>product/update" class="uk-form-stacked" id="formcapnhatsanpham"
      method="post">

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

                            <input class="hidden" name="product_id" value="<?= $product["product"]["product_id"] ?>">
                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon">
                                        <i class="uk-icon-edit"></i>
                                    </span>
                                    <label for="product_edit_name_control">Mã sản phẩm</label>
                                    <input type="text" class="md-input" id="product_edit_name_control"
                                           name="product_code" value='<?= $product["product"]["product_code"] ?>'/>
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon">
                                        <i class="uk-icon-edit"></i>
                                    </span>
                                    <label for="product_edit_name_control">Tên sản phẩm</label>
                                    <input required="" type="text" class="md-input"
                                           id="product_edit_name_control" name="product_name" value='<?= $product["product"]["product_name"] ?>' />
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon">
                                        <i class="uk-icon-edit"></i>
                                    </span>
                                    <label for="product_edit_name_control">Slug</label>
                                    <input required="" type="text" class="md-input"
                                           id="product_edit_name_control" name="product_slug" value='<?= $product["product"]["product_slug"] ?>'/>
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon">
                                        <i class="uk-icon-edit"></i>
                                    </span>
                                    <label for="product_edit_name_control">Giá</label>
                                    <input required="" type="text" class="md-input input_price"
                                           id="product_edit_name_control" name="product_price" value='<?= $product["product"]["product_price"] ?>'/>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon">
                                        <i class="uk-icon-edit"></i>
                                    </span>
                                    <label for="product_edit_name_control">Đơn vị tính</label>
                                    <input type="text" class="md-input" id="product_edit_name_control"
                                           name="product_unit" value='<?= $product["product"]["product_unit"] ?>'/>
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon">
                                        <i class="uk-icon-edit"></i>
                                    </span>
                                    <label for="product_edit_name_control">Số lượng</label>
                                    <input required="" type="number" class="md-input"
                                           id="product_edit_name_control" name="product_total"  value='<?= $product["product"]["product_total"] ?>'  />
                                </div>
                            </div>
                        </div>

                        <div class="uk-width-large-1-2">

<?php foreach ($attribute as $value) { ?>

                                <div class="uk-form-row">
                                    <label class="uk-form-label"
                                           for="product_edit_tags_control"><?= $value['productattr_name'] ?></label>

                                    <label class="label label-default sethienthi "
                                           set="<?= $value['productattr_id'] ?>"><i
                                            class="glyphicon glyphicon-eye-open"> </i></label>
                                    <input class="hienthichitiet"
                                    <?php
                              
                                    if (isset($product['hienthichitiet'][$value['productattr_id']]))
                                        if ($product['hienthichitiet'][$value['productattr_id']] == -2)
                                            echo "checked";
                                    ?>
                                           type="checkbox" value="<?= $value['productattr_id'] ?>"
                                           id="<?= $value['productattr_id'] ?>" name="hienthichitiet[]">
                                    <select name="<?= $value['productattr_id'] ?>[]"
                                            class="<?= $value['productattr_id'] ?> form-control "
                                            multiple="multiple">
                                        <?php foreach ($value['value'] as $giatri) { ?>
                                            <option <?= in_array($giatri['attr_val_id'], $product['attr_val_id']) == true ? "selected" : "" ?> value="<?= $giatri['attr_val_id'] ?>"><?= $giatri['attr_val_label'] ?></option>
    <?php } ?>
                                    </select>
                                    <script type="text/javascript">
                                        $(".<?= $value['productattr_id'] ?>").select2({
                                            placeholder: "Chọn <?= $value['productattr_name'] ?>"
                                        });
                                    </script>
                                </div>

<?php } ?>



                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon">
                                        <i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                    <div class="md-input-wrapper md-input-filled">
                                        <label for="uk_dp_1">Ngày tạo</label>
                                        <input class="md-input datetime" type="text" id="uk_dp_1" name="product_date_create"
                                               value="<?= $product["product"]["product_date_create"] ?>"
                                               data-uk-datepicker="{format:'DD/MM/YYYY',i18n:{ months:['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],weekdays:['Chủ nhật','TH2','TH3','TH4','TH5','TH6','TH7']}}">
                                        <span class="md-input-bar"></span></div>

                                </div>
                            </div>

                            <div style="border: 1px solid #F1E8E8;margin: 30px 0px 0px 0px;padding: 10px;">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            Nổi bật</span>
                                        <div  class="md-input-wrapper md-input-filled">
                                            <input <?= $product['product']['product_feature'] == 1 ? "checked" : "" ?> name="product_feature" type="checkbox" data-switchery
                                                                                                                       data-switchery-color="#d32f2f" id="switch_demo_danger" />
                                            <label for="switch_demo_danger" class="inline-label"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            Sản phẩm mới</span>
                                        <div class="md-input-wrapper md-input-filled">
                                            <input <?= $product['product']['product_feature'] == 1 ? "checked" : "" ?> name="product_new" type="checkbox" data-switchery
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
                                            <input <?= $product['product']['product_selling'] == 1 ? "checked" : "" ?> name="product_selling" type="checkbox" data-switchery
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
                                            <input <?= $product['product']['product_show'] == 1 ? "checked" : "" ?> name="product_show" type="checkbox" data-switchery
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
                                Sản phẩm chi tiết
                            </h3>
                        </div>
                        <div class="md-card-content">
                            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                                <div class="uk-width-large-7-10">


                                    <?php

                                    $html = '';
                                    foreach ($attribute as $value) {
                                        $idthuoctinhchon[] = $value['productattr_id'];
                                        $html .= '<th>' . $value['productattr_name'] . "</th>";
                                        ?>
                                        <div class="uk-form-row">
                                            <label class="uk-form-label"
                                                   for="product_edit_tags_control"><?= $value['productattr_name'] ?></label>

                                            <select
                                                class="<?= $value['productattr_id'] ?> thuoctinhchon form-control ">
                                                <option value="-1">Không chọn</option>
                                                <?php foreach ($value['value'] as $giatri) { ?>
                                                    <option
                                                        value="<?= $giatri['attr_val_id'] ?>"><?= $giatri['attr_val_label'] ?></option>
                                                    <?php $productattr_name[$giatri['attr_val_id']] = $giatri['attr_val_label'];
                                                } ?>
                                            </select>
                                            <script type="text/javascript">
                                                $(".<?= $value['productattr_id'] ?>").select2({
                                                    placeholder: "Chọn <?= $value['productattr_name'] ?>"
                                                });
                                            </script>
                                        </div>

                                    <?php } ?>
                                </div>

                                <script type="text/javascript">
                                    $(".chonthuoctinhthemgia").select2({
                                        placeholder: "Chọn thuộc tính",
                                    });
                                </script>
                                <div class=" uk-width-large-3-10">
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                                  <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                            <label for="product_edit_name_control">Giá</label>
                                            <input type="text" class="md-input  txtgia input_price" id="giasanpham"/>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="uk-input-group">
                                                  <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                            <label for="product_edit_name_control">Số lượng</label>
                                            <input type="number" class="md-input" id="soluong"/>
                                        </div>
                                    </div>
                                    <div class="uk-form-row">
                                        <div class="boxanhdaidien hinhsanphamchitiet showmodalhinhanh"
                                             style="width: 100px;height: 100px">

                                            <img title="" class="img-responsive" id="hinhsanpham" src="">

                                        </div>
                                        <input id="inputhinhsanpham" class="hidden" type="text">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="button" class="md-btn-success md-btn btn-themgia">+</button>
                            </div>
                            <hr>
                            <table class="table table-bordered  ">
                                <thead>
                                <?= $html ?>

                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Hình</th>
                                <th>Công cụ</th>
                                </thead>
                                <tbody class="listgiasanpham">

                                <?php foreach ($product['product_detail'] as $key => $value) { ?>
                                    <tr>

                                        <?php foreach ($idthuoctinhchon as $value2) { ?>

                                            <td class="attr_val_value"
                                                data-giatri="<?= isset($value['attr_val_value'][$value2]) == true ? $value['attr_val_value'][$value2] : "-1" ?>"><?= isset($value['attr_val_value'][$value2]) == true ? $productattr_name[$value['attr_val_value'][$value2]] : "Null" ?></td>
                                        <?php } ?>
                                        <td><?= $value['product_detail_price'] ?></td>
                                        <td><?= $value['product_detail_total'] ?></td>
                                        <td><a type="button" data-id_sanphamchitiet="<?= $key ?>"
                                               ref='<?= $value['product_detail_avatar'] ?>'
                                               class="xoahinhsanphamchitiet uk-modal-close uk-close uk-close-alt uk-position-absolute"></a>

                                            <div data-id_sanphamchitiet="<?= $key ?>" data-type="2"
                                                 class="boxanhdaidien showmodalhinhanh"
                                                 style="width: 100%;height:50px">
                                                <img class="img-responsive " title="<?= $value['product_detail_avatar'] ?>"
                                                     id="hinhsanpham"
                                                     src="<?= BASE_URL ?>public/upload/images/product/<?= $value['product_detail_avatar'] ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <a data-hinhsanphamchitiet="<?= $value['product_detail_avatar'] ?>"
                                               data-idsanphamchitiet="<?= $key ?>"
                                               data-giasanpham="<?= $value['product_detail_price'] ?>"
                                               data-soluongsanpham="<?= $value['product_detail_total'] ?>"
                                               class=" label label-info suasanphamchitiet">Sửa</a>
                                            <a data-id_sanphamchitiet="<?= $key ?>"
                                               class="label label-danger xoasanphamchitiet">Xóa</a>

                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
         
            
            
            <div class="md-card">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text">
                        Miêu tả
                    </h3>
                </div>
                <div class="md-card-content">
                    <textarea name="product_content" class="form-control" id="mieuta"> <?= $product['product']['product_content'] ?></textarea>
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
                                       name="property[<?= $value['product_prop_id'] ?>]" 
                                       value='<?= isset($product["product_prop_detail"][$value['product_prop_id']]) == true ? $product["product_prop_detail"][$value['product_prop_id']] : "" ?>' />
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
<?= buiding_menu(0, $category, $product["productcategory_detail"]) ?>

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
                            <?php
                            foreach ($product['product_tag'] as $key => $value) {
                                ?>
                                <option selected="" value='<?= $value ?>'><?= $value ?></option>
                        <?php } ?>
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
                                 src="<?= BASE_URL."public/upload/images/product/".$product["product"]["product_avatar"] ?>">
                            <a class="changeavatar">
                                <input type="file" class="form-control" id="doiavatar">
                                <i class="glyphicon glyphicon-camera"></i>
                                Cập nhật ảnh đại diện
                            </a>
                           

                        </div>

                    </div>
                        <ul class="uk-sortable uk-grid uk-grid-small uk-grid-width-1-3"
                                data-uk-sortable="{group:'connected-group'}">

                                <?php foreach ($product['product_images'] as $key => $value) { ?>

                                <li data-id="<?= $value['product_images_id'] ?>" class="uk-grid-margin  ">
                                    <a type="button" tenhinh='<?= $value['product_images_name'] ?>'
                                       ref='<?= $value['product_images_id'] ?>'
                                       class="xoaanh uk-modal-close uk-close uk-close-alt uk-position-absolute"></a>
                                    <div>
                                        <img
                                            src="<?= BASE_URL ?>public/upload/images/product/<?= $value['product_images_name'] ?>"
                                            alt="" class="img-responsive">
                                    </div>
                                </li>

                                <?php } ?>


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
        <div class="ketqua"></div>
    </div>
</form>
<script> id_sanpham =<?= $product['product']['product_id'] ?>; </script>
<script src="<?= load_public("lib/ckeditor/ckeditor.js") ?>"></script>
<script src="<?= load_admin_view("product/js/edit.js") ?>"></script>
<script type="text/javascript">CKEDITOR.replace('mieuta');</script>
