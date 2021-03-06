<div id='showedit' class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">Chỉnh sửa</div>
        <div id="loadeditfooter">
            <div class="uk-modal-spinner"></div>
        </div>
        <div class="uk-modal-footer"><a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>

<div id='showcreate' class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">Tạo mới</div>
        <form id="createfooter" class="form-horizontal" style="text-align: center">

            <div class="form-group">
                <label class="col-md-3">Tên: </label>
                <div class="col-md-9">
                    <input class="form-control" name="menu_name" type="text" placeholder="Nhập tên menu">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Địa chỉ liên kết: </label>
                <div class="col-md-9">
                    <input class="form-control" name="menu_slug" type="text" placeholder="Địa chỉ url">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Loại: </label>
                <div class="col-md-9">
                    <select name="menu_format" class="form-control">
                        <option value="link">Liên kết</option>
                        <option value="productcategory">Danh mục sản phẩm</option>
                    </select>
                </div>
            </div>

            <div class="uk-form-row ">
                <button class="uk-button">Tạo mới</button>
            </div>
        </form>
        <div class="uk-modal-footer"><a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>

<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i> Quản trị
    </li>
    <li class="active">
        <i class="fa fa-list"></i> Footer
    </li>
</ol>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <ul class="uk-nestable" data-uk-nestable>
                    <?= $this->data['footer'] ?>
                </ul>

                <div style="text-align: center">
                    <div class="uk-flex-order-first">
                        <button class="md-btn md-btn-primary btn-luu">LƯU</button>
                        <button data-uk-modal="{target:'#showcreate'}" class="md-btn md-btn-success">TẠO MỚI</button>
                    </div>


                </div>
                <hr>
                <div id="thongbaoupdate">

                </div>

            </div>
        </div>

    </div>
</div>
<script src="<?= load_admin_view("footer/js/index.js") ?>"></script>