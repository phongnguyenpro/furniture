<?php
$productattr = $this->data["productattr"];
$career_id = -1;
if (isset($_GET['career_id'])) {
    $career_id = $_GET['career_id'];
}
?>

<link id="data-uikit-theme" rel="stylesheet" href="<?= load_admin_view("public/css/sortable.css") ?>">

<div id='showedit' class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">Chỉnh sửa</div>


        <form id="createthuoctinh" method="POST" action="<?= ADMIN_URL ?>productattr/update" class="uk-form" style="text-align: center">
            <fieldset>

                <div class="form-group uk-form-row">
                    <label class="control-label col-sm-3" for="email">Tên thuộc tính:</label>
                    <div class="col-sm-8">
                        <input  class="form-control" name="productattr_name" type="text" id="nameedit" placeholder="">
                        <input  class="form-control hidden" name="productattr_id" type="text" id="idedit" placeholder="">
                    </div>
                </div>
                <div class="form-group uk-form-row">
                    <label class="control-label col-sm-3" for="email">Chọn ngành nghề:</label>
                    <div class="col-sm-8">
                        <select class="form-control" required="" id="careeredit" name="career_id" style="padding: 5px;" >
                            <?php foreach ($this->data["career"] as $value) { ?>
                                <option  value="<?= $value['career_id'] ?>"><?= $value['career_name'] ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group uk-form-row">
                    <label class="control-label col-sm-3" for="email">Hiện thị lọc:</label>
                    <div class="col-sm-8">
                        <input name="productattr_showfilter" type="checkbox"  id="filteredit" class="hienthiloc" />
                    </div>
                </div>

                <div class="uk-form-row "> <button  class="uk-button btnlink">Cập nhật</button></div>
            </fieldset>
        </form>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>


<div id='showcreate' class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">TẠO THUỘC TÍNH</div>
        <form id="createthuoctinh" method="POST" action="<?= ADMIN_URL ?>productattr/insert" class="uk-form" style="text-align: center">

            <div class="form-group uk-form-row">
                <label class="control-label col-sm-3" >Tên thuộc tính:</label>
                <div class="col-sm-8">
                    <input class="form-control" name="productattr_name" type="text" placeholder="">
                </div>
            </div>
            <div class="form-group uk-form-row">
                <label class="control-label col-sm-3" for="email">Chọn ngành nghề:</label>
                <div class="col-sm-8">
                    <select class="form-control" required="" name="career_id" style="padding: 5px;" >
                        <?php foreach ($this->data["career"] as $value) { ?>
                            <option <?= $value['career_id'] == $career_id ? "selected" : "" ?> value="<?= $value['career_id'] ?>"><?= $value['career_name'] ?></option>

                        <?php } ?>
                    </select>

                </div>
            </div>
            <div class="form-group uk-form-row">
                <label class="control-label col-sm-3" for="email">Hiện thị lọc:</label>
                <div class="col-sm-8">

                    <input  name="productattr_showfilter" type="checkbox"  />

                </div>
            </div>
            <fieldset>


                <div class="uk-form-row "> <button  class="uk-button">Tạo mới</button></div>
            </fieldset>
        </form>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>


<div id='xoa' class="uk-modal">
    <div class="uk-modal-dialog">


        <div class="uk-modal-header">Cảnh báo</div>

        <div><div class="uk-margin uk-modal-content">Bạn có chắc muốn xóa?</div>
            <div class="uk-modal-footer uk-text-right"> 
                <button class="uk-modal-close md-btn md-btn-flat">Cancel</button>

                <form class="hidden" method="POST" id="xoathuoctinh" action="<?= ADMIN_URL ?>productattr/delete" >
                    <input name="productcatgory_id" class="hidden" id="idxoa" type="text" placeholder="">
                </form>
                <button class="js-modal-confirm md-btn-flat-primary md-btn md-btn-flat btnxoa btnlink">Ok</button>


            </div></div>

    </div>
</div>
<div class="md-card uk-margin-medium-bottom">
    <div class="md-card-content">

        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Quản trị
            </li>
            <li class="active">
                <i class="fa fa-list"></i> Giá trị thuộc tính
            </li>
        </ol> 
        <div class="uk-overflow-container">


            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-1-1">

                        <?php
                        $i = 1;
                        foreach ($productattr as $k => $data_productattr) {
                            $table = "table" . $i;
                            ?>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
    <?= $k ?>
                                </div>
                                <div class="panel-body">
                                    <ul class=" <?= $table ?>  md-list md-list-addon uk-sortable sortable-handler">

    <?php
    foreach ($data_productattr as $key => $value) {
        ?> 
                                            <li  data-id="<?= $value['productattr_id'] ?>">

                                                <div class="md-list-content">
                                                    <div class="uk-grid">

                                                        <div class="uk-width-1-4 "><b><?= $value['productattr_name'] ?></b></div>
                                                        <div class="uk-width-1-4">                                          
                                                        
                                                        </div>
                                                        <div class="uk-width-1-4"><a data-career_id="<?= $value['career_id'] ?>" data-productattr_showfilter="<?= $value['productattr_showfilter'] ?>" data-productattr_id="<?= $value['productattr_id'] ?>" data-productattr_name="<?= $value['productattr_name'] ?>"  class="sua label label-info">Sửa</a>
                                                                <a data-id="<?= $value['productattr_id'] ?>" data-ten="<?= $value['productattr_name'] ?>" class="xoa label label-danger">Xóa</a>
                                                        </div>

                                                        <div class="uk-width-1-4"><a href="<?= ADMIN_URL ?>productattr/v_attr_val/<?= $value['productattr_id'] ?>" class="label label-warning"><i class="glyphicon glyphicon-edit"></i>Chỉnh sửa giá trị</a></div>

                                                    </div>
                                                </div>
                                            </li>
    <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function () {

                                    var <?= $table ?> = UIkit.sortable($(".<?= $table ?>"));

    <?= $table ?>.on({'stop.uk.sortable': function () {

                                            var data = $(".<?= $table ?>").data("sortable").serialize();
                                            var data_attr = JSON.stringify(data); // lấy giá trị 

                                            $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

                                            $.post(ADMIN_URL+'productattr/sort_attr', {"data":data_attr}, function (o) {
                                                if (o.status == 1)
                                                {
                                                    $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')
                                                } else if (o.status == 2)
                                                {
                                                    $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger">Cập nhật thất bại/div>');
                                                    NotAccess(o);
                                                }
                                            }, 'JSON')


                                        }});

                                })
                            </script>
    <?php $i++;
} ?>


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
<script src="<?= load_admin_view("productattr/js/index.js") ?>"></script>