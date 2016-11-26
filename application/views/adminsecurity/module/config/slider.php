<?php
$module = $this->data["module"][0];
$page = $this->data["page"];
$config = unserialize($module["module_config"]);
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
<form action="<?= ADMIN_URL . "module/update" ?>" method="POST">   
    <input class="hidden" name="module_id" value="<?= $module["module_id"] ?>">
     <input class="hidden" name="module_type" value="<?= $module["module_type"] ?>">
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
            <input value="<?= $module["module_index"] ?>" required class="form-control" name="module_index"  type="text" placeholder="">
        </div>
    </div>
    <div class="form-group uk-form-row">
        <label class="control-label col-sm-3" for="email">Trang:</label>
        <div class="col-sm-8">
            <ul class="listtrang">
                <?php foreach (get_page() as $key => $value) { ?>
                    <li>
                        <input   <?= in_array($key, $page) == true ? "checked" : "" ?>  name="module_page[]" class="<?= $key != -1 ? "check_page" : "check_all" ?>" data-edit="1" type="checkbox" id="edit_module<?= $key ?>" value="<?= $key ?>">
                        <label for="edit_module<?= $key ?>"><?= $value ?></label>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="row-slider-add hidden">
        <div class="uk-form-row">
            <div class="uk-input-group">
                <span class="uk-input-group-addon">
                    <a title="Chọn ảnh slider" id="openCKf" ><i style="color:blue" class="uk-icon-edit uk-margin-small-top"></i></a>
                </span>
                <div class="md-input-wrapper md-input-filled"><label for="product_edit_name_control_logo">Image: </label><input required="" disabled="" title="Chọn ảnh" value=""  type="text" class="md-input module_img"><span class="md-input-bar"></span></div>

            </div>

        </div>
        <div class="uk-form-row">
            <div class="uk-input-group">
                <span class="uk-input-group-addon">
                </span>
                <div class="md-input-wrapper md-input-filled"><label for="product_edit_name_control_logo">Link: </label><input required="" disabled="" title="" value="" type="text" class="md-input module_link" ><span class="md-input-bar"></span></div>

            </div>

        </div>
        <button type="button" class="pull-right btn btn-sm btn-danger btn-delete">Xóa</button>
    </div>
     
     
    <div class="list-row-slider">       
        <?php if(is_array($config)) foreach ($config as $k=>$v){ ?>
         <div class="row-slider clearfix">
          <div class="uk-form-row">
            <div class="uk-input-group">
                <span class="uk-input-group-addon">
                    <a title="Chọn ảnh slider" id="openCKf" ><i style="color:blue" class="uk-icon-edit uk-margin-small-top"></i></a>
                </span>
                <div class="md-input-wrapper md-input-filled"><label for="product_edit_name_control_logo">Image: </label><input required="" name="module_image[]"   title="Chọn ảnh" value="<?= $v["module_image"] ?>"  type="text" class="md-input module_img"><span class="md-input-bar"></span></div>

            </div>

        </div>
        <div class="uk-form-row">
            <div class="uk-input-group">
                <span class="uk-input-group-addon">
                </span>
                <div class="md-input-wrapper md-input-filled"><label for="product_edit_name_control_logo">Link: </label><input required=""  name="module_link[]" title="" value="<?= $v["module_link"] ?>" type="text" class="md-input module_link" ><span class="md-input-bar"></span></div>

            </div>

        </div>
        <button type="button" class="pull-right btn btn-sm btn-danger btn-delete">Xóa</button>
 </div>
        <?php }?>
        
        <div class="row-slider-hide clearfix"></div>
    </div>
    <button type="button" class="btn btn-info btn-add">Thêm ảnh</button>
    <hr>
    <div class="text-center"> <button class="btn btn-success" type="submit">Cập nhật</button> </div>

</form>

<script>
    id_input_link =<?= count($config) ?>;
    $(".btn-add").click(function () {

        id_input_link += 1;
        var x = $(".row-slider-hide").html($(".row-slider-add").html());
        x.removeClass("row-slider-hide").addClass("row-slider");
        x.find("a#openCKf").attr("onclick", "BrowseServer('set_link" + id_input_link + "', 'Images')");
        x.find("input.module_img").attr("id", "set_link" + id_input_link).attr("name", "module_image[]").attr("disabled", false);
        x.find("input.module_link").attr("name", "module_link[]").attr("disabled", false);

        $(".list-row-slider").append('<div class="row-slider-hide clearfix"></div>');

    });

    $(document).on("click", ".btn-delete", function () {
        var el = $(this);
        _delete = function (el) {
            el.parents(".row-slider").remove();
        };

        var x = confirm("Bạn có chắc muốn xóa");
        if (x)
            _delete(el);

    })
</script>