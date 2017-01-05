<div id='showcreate' class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">Tạo mới</div>
        <form id="createdanhmucbaiviet" class="form-horizontal" style="text-align: center">
            <fieldset>
                <div class="form-group">
                    <label class="col-md-3">Tên:</label>
                    <div class="col-md-9">
                        <input class="form-control" name="articlescategory_name" type="text" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Slug:</label>
                    <div class="col-md-9">
                        <input class="form-control" name="articlescategory_slug" type="text" placeholder="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3">Icon:</label>
                    <div class="col-md-9">
                        <input class="form-control" name="articlescategory_icon" type="text" placeholder="">
                    </div>
                </div>
                <!--                <div class="form-group -->
                <? //= count($this->ngonngu) == 1 ? "hidden" : "" ?><!--">-->
                <!--                    <label class="col-md-3">Ngôn ngữ: </label>-->
                <!--                    <div class="col-md-9">-->
                <!--                        <select class="form-control" required="" name="id_ngonngu">-->
                <!--                            --><?php //foreach ($this->ngonngu as $value) { ?>
                <!--                                <option value="--><? //= $value['id_ngonngu'] ?><!--">-->
                <? //= $value['tenngonngu'] ?><!--</option>-->
                <!---->
                <!--                            --><?php //} ?>
                <!--                        </select>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div class="uk-form-row ">
                    <button class="uk-button">Tạo mới</button>
                </div>

            </fieldset>
        </form>
        <div class="uk-modal-footer"><a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>
<div id='showedit' class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">Chỉnh sửa</div>
        <div id="loadeditmenu">
            <div class="uk-modal-spinner"></div>
        </div>
        <div class="uk-modal-footer"><a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>


<div class="col-lg-12">

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Quản trị
        </li>
        <li class="active">
            <i class="fa fa-list"></i> Danh mục bài viết
        </li>
    </ol>
</div>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ul class="uk-nestable" data-uk-nestable>
                    <?= $this->menu ?>
                </ul>


                <div id="thongbaoupdate">

                </div>
                <div style="text-align: center">
                    <div class="uk-flex-order-first">
                        <button data-uk-modal="{target:'#showcreate'}" class="uk-button uk-button-success">TẠO
                            MỚI
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>
<script src="<?= load_admin_view("articlescategory/js/index.js") ?>"></script>