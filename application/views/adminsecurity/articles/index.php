<script src="<?= load_admin_public("assets/js/common.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/uikit_custom.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/altair_admin_common.min.js") ?>"></script>
<script src="<?= load_admin_public("bower_components/ionrangeslider/js/ion.rangeSlider.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/pages/forms_advanced.min.js") ?>"></script>
<?php
$danhmuc = $this->danhmuc;

function buiding_menu($parent, $menuData)
{
    $html = "";
    if (isset($menuData['parent'][$parent])) {
        $html .= "<ul class='danhmuc' >";
        foreach ($menuData['parent'][$parent] as $value) {
            $html .= "<li>";
            $html .= " <span> <input class='id_danhmuc' type='radio' name='articlescategory_id'  id='" . $menuData['items'][$value]['articlescategory_id'] . "' value='" . $menuData['items'][$value]['articlescategory_id'] . "' data-md-icheck>    <label for='" . $menuData['items'][$value]['articlescategory_id'] . "'>" . $menuData['items'][$value]['articlescategory_name'] . "   </label> </span>";
            $html .= buiding_menu($value, $menuData);
            $html .= "</li>";
        }
        $html .= "</ul>";
    }
    return $html;
}

?>
<div>

    <div>
        <div id='xoa' class="uk-modal">
            <div class="uk-modal-dialog">


                <div class="uk-modal-header">Cảnh báo</div>

                <div class="uk-margin uk-modal-content"><span id="thongbaoxoa">Bạn có chắc muốn xóa bài viết này?</span>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-modal-close md-btn md-btn-flat">Cancel</button>

                    <form class="hidden" id="xoathuoctinh">


                        <input name="idxoa" class="hidden" id="idxoa" type="text" placeholder="">

                    </form>
                    <button class="js-modal-confirm md-btn-danger md-btn btnxoa">Ok</button>


                </div>

            </div>
        </div>
        <!--         <form class="form-horizontal " role="form">-->
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Chọn danh mục
                </h3>
            </div>
            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin>

                    <div class="uk-width-medium-1-2 uk-width-large-1-2">
                        <div class="chondanhmuc"><i class="glyphicon glyphicon-list"></i> <span>Tất cả danh mục</span>
                        </div>
                        <div class="tree danhmucsanpham ">
                            <input name="articlescategory_id" id="-1" checked="checked" class='id_danhmuc' type='radio'
                                   value='-1' data-md-icheck>
                            <label for="-1">Tất cả danh mục</label>
                            <?= buiding_menu(0, $danhmuc) ?>

                        </div>

                    </div>
                    <div class="uk-width-medium-1-2 uk-width-large-1-2">
                        <button class="md-btn btnlietke" type="submit">Liệt kê</button>
                    </div>

                </div>
            </div>
        </div>
        <!--                </form>-->
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Danh sách bài viết <a href="<?= ADMIN_URL ?>articles/create"><button class="btn btn-success">Tạo bài viết</button></a>
                </h3>
            </div>
            <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content boxtable">
                    <table id="dt_tableTools1" class="uk-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Ngày</th>
                            <th>Nổi bật</th>
                            <th>Hiển thị</th>
                            <th>Công cụ</th>

                        </tr>
                        </thead>


                        <tbody class="uk-sortable sortable-handler ">


                        </tbody>
                    </table>


                </div>
            </div>
            <div class="text-center col-md-12">

                <input type="button" id="capnhatthutu" class="md-btn md-btn-primary " value="Cập nhật">
                <div id="thongbaoupdate">

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<style>
    tr {
        position: relative !important;
    }

    td, th {
        width: 00px;
        overflow: hidden;
    }

    .dataTables_length {
        float: left;
    }

    #dt_tableTools1_filter {
        float: right;
    }
</style>

<!-- common functions -->


<script src="<?= load_admin_public("bower_components/datatables/media/js/jquery.dataTables.min.js") ?>"></script>
<script src="<?= load_admin_public("bower_components/datatables-colvis/js/dataTables.colVis.js") ?>"></script>
<script src="<?= load_admin_public("bower_components/datatables-tabletools/js/dataTables.tableTools.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/custom/datatables_uikit.min.js") ?>"></script>
<script src="<?= load_admin_public("assets/js/pages/plugins_datatables.min.js") ?>"></script>

<script src="<?= load_admin_view("articles/js/index.js") ?>"></script>
     
