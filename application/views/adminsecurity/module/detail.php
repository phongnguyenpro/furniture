
<?php 
session_set("module_page",$this->data["page"]);
$page_list =get_page();
?>
<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i>Quản trị
    </li>
    <li class="active">
        <i class="fa fa-list"></i> Quản lý module
    </li>
    <li class="active">
        <i class="fa fa-list"></i><?= $page_list[$this->data["page"]] ?>
    </li>
</ol>

<style>
    .list-module
    {
        background-color: #efefef;
    }
    .list-module .md-card-overlay-content
    {
        background-color: #00aef0 !important;
        color: white;
    }
    .md-card.md-card-hover
    {
        overflow: visible;
    }
    .md-card.md-card-overlay .md-card-content
    {
        height: 250px;
    }
</style>

<div id="module_create" class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">Tạo mới Module</div>
        <fieldset>
            <form action="<?= ADMIN_URL . "module/insert" ?>" method="POST">    
                <input class="hidden" name="page" value="<?= $this->data["page"] ?>">
                <div class="form-group uk-form-row">
                    <label class="control-label col-sm-3" for="email">Loại:</label>
                    <div class="col-sm-8">
                        <select name="module_type">                           
                            <?php
                            foreach ($module_type = get_module_type() as $k => $v) {
                                ?>
                                <option value="<?= $k ?>"><?= $v ?></option>
                            <?php } ?>
                        </select>
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
                    <label class="control-label col-sm-3" for="email">Tên Module:</label>
                    <div class="col-sm-8">
                        <input required="" class="form-control" name="module_name"  type="text" placeholder="">
                    </div>
                </div>
                <div class="form-group uk-form-row">
                    <label class="control-label col-sm-3" for="email">Miêu tả:</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="module_description"  type="text" placeholder="">
                    </div>
                </div>


                <div class="form-group uk-form-row">
                    <label class="control-label col-sm-3" for="email">Thứ tự:</label>
                    <div class="col-sm-8">
                        <input required class="form-control" name="module_index"  type="number" placeholder="">
                    </div>
                </div>

                <div class="form-group uk-form-row">
                    <label class="control-label col-sm-3" for="email">Trang:</label>
                    <div class="col-sm-8">
                        <ul class="listtrang">
                            <?php foreach ($page_list as $key => $value) { ?>
                                <li>
                                    <input  name="module_page[]" class="<?= $key != -1 ? "check_page" : "check_all" ?>" data-md-icheck type="checkbox" id="edit<?= $key ?>" value="<?= $key ?>">
                                    <label for="edit<?= $key ?>"><?= $value ?></label>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="text-center"> <button class="btn btn-success" type="submit">TẠO MỚI</button> </div>

            </form>
        </fieldset>

        <div class="uk-modal-footer"><a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>
  <div id="modal_edit" class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">Edit</div>
        <fieldset>
       
        </fieldset>
        <div class="uk-modal-footer"><a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>
    </div>
</div>
        
<div style="margin: 20px;">
    <div class="text-center">
        <button class="md-btn md-btn-flat-success btn_create_module">Thêm module</button>
    </div>
</div>
<?php
foreach ($this->data["module"] as $k => $v) {
    ?>
    <div class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                <?= $module_type[$k] ?>
            </h3>
        </div>
        <div class="md-card-content list-module">
            <div class="uk-grid uk-grid-width-small-1-3" data-uk-grid-margin="">
                <?php
                foreach ($v as $k_module => $val_module) {
                    ?>
                    <div>
                        <div class="md-card md-card-hover md-card-overlay">
                            <div class="md-card-content truncate-text is-truncated" style="word-wrap: break-word;">
                                <h4>   <?= $val_module["module_name"] ?></h4>
                                <p><b>Vị trí:</b> <?= $module_location[$val_module["module_location"]] ?></p>                    
                                <p><b>Thứ tự:</b> <?= $val_module["module_index"] ?></p>
                                <p>- <?= $val_module["module_description"] ?> -</p>

                                <div class="md-card-overlay-content">
                                    <div class="uk-clearfix md-card-overlay-header">
                                  
                                        <div class="pull-right">
                                            <a onclick="_confirm_link('<?= ADMIN_URL."module/delete/".$val_module["module_id"] ?>')"    class="md-btn md-btn-flat-danger">Delete</a>
                                            <a data-type="<?= $k ?>" data-id="<?= $val_module["module_id"] ?>"  class="md-btn md-btn-flat-primary btn-edit">Edit</a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>

<script src="<?= load_admin_view("module/js/detail.js") ?>"></script>