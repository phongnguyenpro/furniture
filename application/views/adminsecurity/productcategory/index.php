
        <div id='showcreate' class="uk-modal">
            <div class="uk-modal-dialog">

                <div class="uk-modal-header">Tạo mới</div>
                <form id="createmenu" class="form-horizontal" style="text-align: center">

                    <div class="form-group">
                        <label class="col-md-3">Tên: </label>
                        <div class="col-md-9">
                            <input class="form-control" name="productcategory_name" type="text" placeholder="Nhập tên danh mục">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3">Slug: </label>
                        <div class="col-md-9">
                            <input class="form-control" name="productcategory_slug" type="text" placeholder="Slug danh mục">
                        </div>
                    </div>
  <div class="form-group">
                        <label class="col-md-3">Miêu tả: </label>
                        <div class="col-md-9">
                            <input class="form-control" name="productcategory_description" type="text" placeholder="Miêu tả danh mục">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3">Icon: </label>
                        <div class="col-md-8" style="padding-right: 0">
                            <input class="form-control" name="productcategory_icon" id="linkIcon" type="text" placeholder="Đường dẫn icon">
                        </div>
                        <div class="col-md-1" style="line-height:34px;">
                            <a onclick="BrowseServer('linkIcon','Images');"><i style="color:blue; font-size:20px;"
                                                                               class="uk-icon-edit"></i></a>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3">Ngành nghề: </label>
                        <div class="col-md-9">
                            <select class="form-control" required="" name="career_id">
                                <?php foreach ($this->data["career"] as $value) { ?>
                                    <option value="<?= $value['career_id'] ?>"><?= $value['career_name'] ?></option>
                                <?php } ?>
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
                    <i class="fa fa-dashboard"></i>Quản trị
                </li>
                <li class="active">
                    <i class="fa fa-list"></i> Danh mục sản phẩm
                </li>
            </ol>
        </div>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="uk-nestable" data-uk-nestable>
                            <?= $this->data["productcategory"]; ?>
                        </ul>

                        <div style="text-align: center">
                            <div class="uk-flex-order-first">
                                <button class="md-btn md-btn-primary btn-luu">LƯU</button>
                                <button data-uk-modal="{target:'#showcreate'}" class="md-btn md-btn-success">TẠO MỚI
                                </button>
                            </div>


                        </div>
                        <hr>
                        <div id="thongbaoupdate">

                        </div>
                    </div>
                </div>

            </div>
        </div>


<script src="<?= load_admin_view("productcategory/js/index.js") ?>"></script>