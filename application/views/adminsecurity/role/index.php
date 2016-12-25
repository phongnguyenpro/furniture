
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Quản trị
            </li>
            <li class="active">
                <i class="fa fa-list"></i> Phân quyền tài khoản
            </li>
        </ol> 

        <form name="frmsaverole" action="<?= ADMIN_URL ?>role"  method="POST">

            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-1-1  uk-width-large-1-1">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Chọn quyền sử dụng
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                <div class="uk-width-large-1-5">
                                    <select class="basic" id="change_role" name="role_current">
                                        <?php foreach (getrole() as $k => $v) { ?>
                                            <option <?= $this->data["role_current"] == $k ? "selected" : "" ?> value="<?= $k ?>"><?= $v["label"] ?></option>
                                        <?php } ?>

                                    </select>

                                </div>
                                <div class="uk-width-large-1-2">
                                    <button type="button" class="btn btn-success" id="btn_save_role">Lưu</button>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-1-1  uk-width-large-1-1">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <h3 class="md-card-toolbar-heading-text">
                                Danh sách quyền hạn
                            </h3>
                        </div>
                        <div class="md-card-content large-padding">
                            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                                <div class="uk-width-large-1-1">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <th>Controller</th>  
                                        <th>Action</th>  

                                        </thead>

                                        <tbody>
                                            <?php foreach ($this->data["list_role"] as $controller => $list_action) { ?>

                                                <tr>
                                                    <td><b><?= $controller; ?></b></td>
                                                    <td>
                                                        <?php foreach ($list_action as $k_action => $v_action) { ?>
                                                        <div class="col-md-3" style="border: 1px solid #dcd9d4;margin-top: 2px">
                                                            <label>  <input
                                                                <?php
                                                                if (isset($this->data["get_role"][$controller]) &&
                                                                        in_array($v_action["value"], $this->data["get_role"][$controller])
                                                                )
                                                                    echo 'checked';
                                                                ?>
                                                                    type="checkbox" value="<?= $v_action["value"] ?>" name="<?= $controller ?>[]">
                                                               <?php
                                                                       if(isset($v_action["label"]))
                                                                        echo $v_action["label"];
                                                                       else 
                                                                           $v_action;
                                                                    ?>
                                                            </label>
                                                                    
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
<script src="<?= load_admin_view("role/js/index.js") ?>"></script>