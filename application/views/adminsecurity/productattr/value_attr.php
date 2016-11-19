<?php
$attr_val = $this->data["attr_val"];
?>
<link id="data-uikit-theme" rel="stylesheet" href="<?= load_admin_view("public/css/sortable.css") ?>">

<div id='showedit' class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">Chỉnh sửa giá trị</div>


        <form method="POST" id="createthuoctinh" action="<?= ADMIN_URL ?>productattr/attr_val_update" class="uk-form" style="text-align: center">
            <fieldset>
                <div class="uk-form-row">  
                    <input class="hidden" value='<?= $this->data["info"]["productattr_id"] ?>' name="productattr_id" type="text"  placeholder="">
                    <label >Giá trị: <input name="attr_val_value" type="text" id="tenedit" placeholder=""> </label><br>
                    <label >Nhãn : <input name="attr_val_label" type="text" id="nhanedit" placeholder=""> </label>
                    <input class="hidden" name="attr_val_id" type="text" id="idedit" placeholder="">
                </div>

                <div class="uk-form-row "> <button  class="uk-button">Cập nhật</button></div>
            </fieldset>
        </form>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>


<div id='showcreate' class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">Tạo mới giá trị</div>
        <form method="POST" id="createthuoctinh" action="<?= ADMIN_URL ?>productattr/attr_val_insert" class="uk-form" style="text-align: center">
            <fieldset>

                <div class="uk-form-row">  
                    <input class="hidden" value='<?= $this->data["info"]["productattr_id"] ?>' name="productattr_id" type="text"  placeholder="">
                    <label >Giá trị: <input name="attr_val_value" type="text" placeholder=""> </label><br>
                    <label >Nhãn : <input name="attr_val_label" type="text" placeholder=""> </label>
                </div>

                <div class="uk-form-row "> <button  class="uk-button btnlink">Thêm</button></div>
            </fieldset>
        </form>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>


<div id='xoa' class="uk-modal">
    <div class="uk-modal-dialog">


        <div class="uk-modal-header">Cảnh báo</div>

        <div><div class="uk-margin uk-modal-content">Bạn có chắc?</div>
            <div class="uk-modal-footer uk-text-right"> 
                <button class="uk-modal-close md-btn md-btn-flat">Cancel</button>

                <form method="POST" class="hidden" id="xoathuoctinh" action="<?= ADMIN_URL ?>productattr/attr_val_delete" >

                    <input class="hidden"  value='<?= $this->data["info"]["productattr_id"] ?>' name="productattr_id" type="text"  placeholder="">
                    <input name="attr_val_id" class="hidden" id="idxoa" type="text" placeholder="">

                </form>
                <button class="js-modal-confirm md-btn-flat-primary md-btn md-btn-flat btnxoa btnlink">Ok</button>


            </div></div>

    </div>
</div>
<div class="md-card uk-margin-medium-bottom">
    <div class="md-card-content">
        <div class="uk-overflow-container">


            <div class="md-card-content">

                <div class="uk-grid" data-uk-grid-margin="">
                    <a href="<?= ADMIN_URL ?>productattr" style="    position: absolute;
                       top: 0px;
                       left: 0px;" class="md-btn"> <i class="uk-icon-reply"></i></a>
                    <div class="uk-width-medium-1-1">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Quản trị
                            </li>
                            <li class="active">
                                <i class="fa fa-list"></i> Chỉnh sửa thuộc tính
                            </li>
                             <li class="active">
                                <i class="fa fa-list"></i><?= $this->data["info"]["productattr_name"] ?>
                            </li>
                        </ol> 
                        <div class="uk-overflow-container">


                            <div class="md-card-content">
                                <div class="uk-grid" data-uk-grid-margin="">
                                    <div class="uk-width-medium-1-1">
                                        <table class="table table-bordered">
                                            <thead>

                                            <td>Giá trị</td>

                                            <td>Nhãn</td>
                                            <td>Sửa giá trị</td>
                                            <td>Xóa giá trị</td>

                                            </thead>

                                        </table>

                                        <ul class="md-list md-list-addon uk-sortable sortable-handler" data-uk-sortable="{group:'connected-group'}">
                                            <?php
                                            foreach ($attr_val as $key => $value) {
                                                ?> 
                                                <li  data-id="<?= $value['attr_val_id'] ?>">

                                                    <div class="md-list-content">
                                                        <div class="uk-grid">

                                                            <div class="uk-width-1-4 "><b><?= $value['attr_val_value'] ?></b></div>
                                                            <div class="uk-width-1-4 "><b><?= $value['attr_val_label'] ?></b></div>
                                                            <div class="uk-width-1-4"><a data-id="<?= $value['attr_val_id'] ?>" data-nhan="<?= $value['attr_val_label'] ?>" data-ten="<?= $value['attr_val_value'] ?>" class="edit_attr_value label label-info">Sửa</a></div>
                                                            <div class="uk-width-1-4"><a data-id="<?= $value['attr_val_id'] ?>" data-ten="<?= $value['attr_val_value'] ?>" class="xoa label label-danger">Xóa</a></div>
                                                        </div>
                                                    </div>
                                                </li>
<?php } ?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="thongbaoupdate">

                </div>
                <div style="text-align: center">
                    <div class="uk-flex-order-first">
                        <button data-uk-modal="{target:'#showcreate'}" class="uk-button uk-button-success">TẠO MỚI</button>
                    </div>


                </div>
            </div>

        </div>
<script src="<?= load_admin_view("productattr/js/index.js") ?>"></script>