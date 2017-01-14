<?php
$danhmuc = $this->danhmuc;
$tag = $this->tag;
$data = $this->data_baiviet;

function buiding_menu($parent, $menuData, $data)
{
    $html = "";
    if (isset($menuData['parent'][$parent])) {
        $html .= "<ul >";
        foreach ($menuData['parent'][$parent] as $value) {
            $html .= "<li>";
            $temp = in_array($menuData['items'][$value]['articlescategory_id'], $data) == true ? "checked" : "";
            $html .= " <span> <input class='id_danhmuc' " . $temp . " type='checkbox' name='articlescategory_id[]'  id='" . $menuData['items'][$value]['articlescategory_id'] . "' value='" . $menuData['items'][$value]['articlescategory_id'] . "' data-md-icheck>    <label for='" . $menuData['items'][$value]['articlescategory_id'] . "'>" . $menuData['items'][$value]['articlescategory_name'] . "   </label> </span>";
            $html .= buiding_menu($value, $menuData, $data);
            $html .= "</li>";
        }
        $html .= "</ul>";
    }
    return $html;
}

?>

<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i> Quản trị
    </li>
    <li class="active">
        <i class="fa fa-list"></i> Chỉnh sửa bài viết
    </li>
</ol>


<form action="<?= ADMIN_URL ?>articles/update_articles" id="frmcapnhat" class="uk-form-stacked"
      enctype="multipart/form-data" id="formeditbaiviet" method="post">
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
                                    <label for="product_edit_name_control">Tên bài viết</label>
                                    <input type="text" class="md-input" id="product_edit_name_control"
                                           name="articles_name" value='<?= $data['baiviet']['articles_name'] ?>'/>
                                    <input type="text" class="form-control hidden" name="articles_id"
                                           value='<?= $data['baiviet']['articles_id'] ?>'>

                                </div>
                            </div>

                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                    <label for="product_edit_name_control">Slug</label>
                                    <input type="text" class="md-input" id="product_edit_name_control"
                                           name="articles_slug" value='<?= $data['baiviet']['articles_slug'] ?>'/>
                                </div>
                            </div>

                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                                  <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                    <label for="product_edit_name_control">Đường dẫn</label>
                                    <input required="" type="text" class="md-input"
                                           id="product_edit_name_control"
                                           value='<?= BASE_URL ?>bai-viet/<?= $data['baiviet']['articles_slug']."-".$data['baiviet']['articles_id'] ?>'/>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-large-1-2">

                            <div class="uk-form-row">
                                <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                    <div class="md-input-wrapper md-input-filled">
                                        <label for="uk_dp_1">Ngày tạo</label>
                                        <input class="md-input datetime" type="text" id="uk_dp_1"
                                               name="articles_date_create"
                                               value='<?= date_out($data['baiviet']['articles_date_create']) ?>'
                                               data-uk-datepicker="{format:'DD/MM/YYYY',i18n:{ months:['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],weekdays:['Chủ nhật','TH2','TH3','TH4','TH5','TH6','TH7']}}">
                                        <span class="md-input-bar"></span></div>

                                </div>
                            </div>
                            <div class="uk-form-row">
                                <div class="boxanhdaidien">

                                    <img class="img-responsive" id="imgavatar"
                                         src="<?= BASE_URL ?>public/upload/images/thumb_articles/<?= $data['baiviet']['articles_avatar'] ?>">
                                    <input readonly="" class="hidden" name="articles_avatar"
                                           value='<?= $data['baiviet']['articles_avatar'] ?>'>
                                    <a class="changeavatar">
                                        <input type="file" class="form-control" name="filehinhdaidien"
                                               id="doiavatar">

                                        <i class="glyphicon glyphicon-camera"></i>
                                        Cập nhật ảnh đại diện
                                    </a>


                                </div>
                            </div>

                            <div style="border: 1px solid #F1E8E8;
    margin: 30px 0px 0px 0px;
    padding: 10px;">
                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                           Nổi bật</span>
                                        <div class="md-input-wrapper md-input-filled">
                                            <input name="articles_feature" type="checkbox" data-switchery
                                                   data-switchery-color="#d32f2f" <?= $data['baiviet']['articles_feature'] == 1 ? "checked" : "" ?>
                                                   id="switch_demo_danger"/>
                                            <label for="switch_demo_danger" class="inline-label"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-form-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                           Hiển thị</span>
                                        <div class="md-input-wrapper md-input-filled ">
                                            <input name="articles_show" type="checkbox" data-switchery
                                                   data-switchery-color="#1e88e5" <?= $data['baiviet']['articles_show'] == 1 ? "checked" : "" ?>
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
        </div> <!-- Box to -->

        <div class="uk-width-xLarge-2-10 uk-width-large-3-10">
            <div class="md-card">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text">
                        Danh mục bài viết
                    </h3>
                </div>
                <div class="md-card-content">

                    <div class="pre-scrollable">

                        <div class="tree">
                            <?= buiding_menu(0, $danhmuc, $data['baiviet']['danhmucbaivietchitiet']) ?>

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
                            foreach ($data['baiviet']['tagbaiviet'] as $key => $value) {
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
                                            i = $(".product_edit_submit"), e = $(".product_edit_name"),
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
                                                <?php  foreach ($data['baiviet']['tag'] as $key=>$value){ ?>
                                                {title: "<?= $value ?>", value: "<?= $value ?>"},
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


        </div>

        <div class="uk-width-xLarge-1-1">
            <div class="md-card">
                <div class="md-card-toolbar">
                    <h3 class="md-card-toolbar-heading-text">
                        Bài viết
                    </h3>
                </div>
                <div class="md-card-content">
                            <textarea name="articles_content" class="form-control"
                                      id="mieuta"><?= $data['baiviet']['articles_content'] ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="text-center col-md-12">

        <input type="button" id="capnhatbaiviet" class="md-btn md-btn-primary btnlink" value="CẬP NHẬT">
        <a href="<?= ADMIN_URL ?>articles" class="md-btn md-btn-flat-warning">Hủy|Trở về</a>
    </div>
</form>

</div>
</div>

<script src="<?= load_public("lib/ckeditor/ckeditor.js") ?>"></script>
<script src="<?= load_admin_view("articles/js/edit.js") ?>"></script>
<script type="text/javascript">CKEDITOR.replace('mieuta');</script>