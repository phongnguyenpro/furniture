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
                    <option <?= $module["module_location"]==$k?"selected":"" ?> value="<?= $k ?>"><?= $v ?></option>
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
        <label class="control-label col-sm-3" >Số lượng hiển thị</label>
        <div class="col-sm-8">
            <input min="1" value="<?= isset($config["module_product_limit"] )?$config["module_product_limit"]:"" ?>" required class="form-control" name="module_product_limit"  type="number" placeholder="">
        </div>
    </div>
         <div class="form-group uk-form-row">
        <label class="control-label col-sm-3" for="email">Loại sản phẩm:</label>
        <div class="col-sm-8">
            <select name="module_product_type">
                <?php
                foreach ( get_product_type() as $k => $v) {
                    ?>
                    <option  <?= (isset($config["module_product_type"])&&$config["module_product_type"]==$k)?"selected":"" ?> value="<?= $k ?>"><?= $v ?></option>
                <?php } ?>
            </select>
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
     
    <hr>
    <div class="text-center"> <button class="btn btn-success" type="submit">Cập nhật</button> </div>

</form>

<script>

</script>