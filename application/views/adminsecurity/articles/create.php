<?php
$danhmuc = $this->danhmuc;


function buiding_menu($parent, $menuData)
{
    $html = "";
    if (isset($menuData['parent'][$parent])) {
        $html .= "<ul >";
        foreach ($menuData['parent'][$parent] as $value) {
            $html .= "<li>";
            $html .= " <span> <input class='id_danhmuc' type='checkbox' name='articlescategory_id[]'  id='" . $menuData['items'][$value]['articlescategory_id'] . "' value='" . $menuData['items'][$value]['articlescategory_id'] . "' data-md-icheck>    <label for='" . $menuData['items'][$value]['articlescategory_id'] . "'>" . $menuData['items'][$value]['articlescategory_name'] . "   </label> </span>";
            $html .= buiding_menu($value, $menuData);
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
                    <i class="fa fa-list"></i> Thêm bài viết mới
                </li>
            </ol>

            <?php if (!isset($_GET['ngonngu']) && false){
                ?>

                <!-- Chọn ngành -->

                <form method="GET">
                    <div class="md-card">
                        <div class="md-card-content">
                            <h3 class="heading_a">Chọn ngôn ngữ</h3>
                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-2 uk-width-large-1-2">
                                    <select name="ngonngu" id="select_demo_1" data-md-selectize>
                                        <?php foreach ($this->ngonngu as $value) { ?>
                                            <option value="<?= $value['id_ngonngu'] ?>"><?= $value['tenngonngu'] ?></option>
                                        <?php } ?>
                                        <option value="-1">Tất cả</option>
                                    </select>

                                </div>
                                <div class="uk-width-medium-1-1 uk-width-large-1-1 text-center">
                                    <button class="md-btn md-btn-primary btnchon" type="submit">Chọn</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (count($this->ngonngu) == 1) {
                        ?>
                        <script>
                            $(".btnchon").click();
                        </script>
                    <?php } ?>
                </form>

            <?php } else{ ?>
            <form action="<?= ADMIN_URL ?>articles/insert" class="uk-form-stacked" enctype="multipart/form-data"
                  id="formthemsanpham" method="post">
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
                                                       name="articles_name" value=""/>
                                            </div>
                                        </div>

                                        <div class="uk-form-row">
                                            <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            <i class="uk-icon-edit"></i>
                                        </span>
                                                <label for="product_edit_name_control">Slug</label>
                                                <input type="text" class="md-input" id="product_edit_name_control"
                                                       name="articles_slug" value=" "/>
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
                                                           value=""
                                                           data-uk-datepicker="{format:'DD/MM/YYYY',i18n:{ months:['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],weekdays:['Chủ nhật','TH2','TH3','TH4','TH5','TH6','TH7']}}">
                                                    <span class="md-input-bar"></span></div>

                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="boxanhdaidien">

                                                <img class="img-responsive" id="imgavatar"
                                                     src="<?= BASE_URL ?>public/upload/images/hinhsanpham/noimage.jpg">
                                                <a class="changeavatar">
                                                    <input type="file" class="form-control" name="articles_avatar"
                                                           id="doiavatar">
                                                    <i class="glyphicon glyphicon-camera"></i>
                                                    Cập nhật ảnh đại diện
                                                </a>


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
                                        <?= buiding_menu(0, $danhmuc) ?>

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
                                                        placeholder: "Nhập tag cho bài viết",

                                                        options: [
                                                            <?php foreach ($this->tag as $key=>$value){ ?>
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


                    </div>

                    <div class="uk-width-xLarge-1-1">
                        <div class="md-card">
                            <div class="md-card-toolbar">
                                <h3 class="md-card-toolbar-heading-text">
                                    Bài viết
                                </h3>
                            </div>
                            <div class="md-card-content">
                                <textarea name="articles_content" class="form-control" id="mieuta"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="text-center col-md-12">

                    <input type="submit" id="themsanpham" class="md-btn md-btn-primary btnlink" value="THÊM">

                </div>
            </form>


    <script src="<?= load_public("lib/ckeditor/ckeditor.js") ?>"></script>
    <script src="<?= load_admin_view("articles/js/create.js") ?>"></script>
    <script type="text/javascript">CKEDITOR.replace('mieuta');</script>
<?php } ?>