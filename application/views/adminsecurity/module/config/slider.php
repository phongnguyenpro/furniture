<?php
$module = $this->data["module"][0];
?>

<style>
    .row-slider
    {
        padding: 10px;
        border: 1px solid #89a1b9;
        margin: 5px;
    }
    .row-slider-hide
    {
        opacity: 0;
    }
</style>
<form action="<?= ADMIN_URL . "module/insert" ?>" method="POST">              
    <div class="form-group uk-form-row">
        <label class="control-label col-sm-3" >Tên module</label>
        <div class="col-sm-8">
            <input value="<?= $module["module_name"] ?>" required class="form-control" name="module_name"  type="text" placeholder="">
        </div>
    </div>
    <div class="form-group uk-form-row">
        <label class="control-label col-sm-3" >Miêu tả</label>
        <div class="col-sm-8">
            <input value="<?= $module["module_description"] ?>" required class="form-control" name="module_description"  type="text" placeholder="">
        </div>
    </div>
    <div class="form-group uk-form-row">
        <label class="control-label col-sm-3" for="email">Vị trí:</label>
        <div class="col-sm-8">
            <select name="module_location">
                <?php
                foreach ($module_location = get_module_location() as $k => $v) {
                    ?>
                    <option value="<?= $k ?>"><?= $v ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group uk-form-row">
        <label class="control-label col-sm-3" >Thứ tự</label>
        <div class="col-sm-8">
            <input value="<?= $module["module_index"] ?>" required class="form-control" name="module_description"  type="text" placeholder="">
        </div>
    </div>
    <div class="form-group uk-form-row">
        <label class="control-label col-sm-3" for="email">Trang:</label>
        <div class="col-sm-8">
            <ul class="listtrang">
                <?php foreach (get_page() as $key => $value) { ?>
                    <li>
                        <input  name="module_page[]" class="<?= $key != -1 ? "check_page" : "check_all" ?>" data-md-icheck type="checkbox" id="edit_module<?= $key ?>" value="<?= $key ?>">
                        <label for="edit_module<?= $key ?>"><?= $value ?></label>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="list-row-slider">       
        <div class="row-slider">
            <div class="uk-form-row">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon">
                        <a title="Đổi logo" id="openCKf" onclick="BrowseServer('product_edit_name_control_logo', 'Images');"><i style="color:blue" class="uk-icon-edit uk-margin-small-top"></i></a>
                    </span>
                    <div class="md-input-wrapper md-input-filled"><label for="product_edit_name_control_logo">LOGO: </label><input title="Click hình bên trái để đổi logo" value="public/upload/images/logo%5B1%5D%5B1%5D.png" required="" type="text" class="md-input" id="product_edit_name_control_logo" name="logo"><span class="md-input-bar"></span></div>

                </div>

            </div>
            <div class="uk-form-row">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon">
                    </span>
                    <div class="md-input-wrapper md-input-filled"><label for="product_edit_name_control_logo">Link: </label><input title="" value="" required="" type="text" class="md-input" id="product_edit_name_control_logo" name="logo"><span class="md-input-bar"></span></div>

                </div>

            </div>
            <div class="uk-form-row">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon">
                    </span>
                    <div class="md-input-wrapper md-input-filled"><label for="product_edit_name_control_logo">Thứ tự: </label><input title="" value="" required="" type="text" class="md-input" id="product_edit_name_control_logo" name="logo"><span class="md-input-bar"></span></div>

                </div>

            </div>
        </div>
        <div class="row-slider-hide"></div>
    </div>
    <button type="button" class="btn btn-info btn-add">Thêm ảnh</button>
    <hr>
    <div class="text-center"> <button class="btn btn-success" type="submit">Cập nhật</button> </div>

</form>

<script>
    $(".btn-add").click(function () {
        var x = $(".row-slider-hide").html($(".row-slider").html());
        x.removeClass("row-slider-hide").addClass("row-slider");
        $(".list-row-slider").append('<div class="row-slider-hide"></div>');

    })

</script>