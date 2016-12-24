<?php
$data = $this->data_item;
?>

<div id='edittag' class="uk-modal">
    <div class="uk-modal-dialog">

        <div class="uk-modal-header">Chỉnh sửa tag</div>
        <form method="POST" id="createthuoctinh" action="<?= ADMIN_URL ?>tag/update_tag"
              class="uk-form" style="text-align: center">

            <div class="form-group uk-form-row">
                <label class="control-label col-sm-3" for="email">Tên tag:</label>
                <div class="col-sm-8">
                    <input class="form-control" required="" name="tag_name" id="edittagten" type="text"
                           placeholder="">
                    <input class="form-control hidden" required="" name="tag_id" id="edittagid" type="text"
                           placeholder="">
                </div>
            </div>

            <div class="form-group uk-form-row">
                <label class="control-label col-sm-3" for="email">Slug:</label>
                <div class="col-sm-8">
                    <input class="form-control" required="" name="tag_slug" id="edittagslug" type="text"
                           placeholder="">
                </div>
            </div>
            <fieldset>


                <div class="uk-form-row ">
                    <button class="uk-button ">Cập nhật</button>
                </div>
            </fieldset>
        </form>
        <div class="uk-modal-footer"><a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>
<div id='showcreate' class="uk-modal">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">TẠO TAG</div>
        <form method="POST" id="createthuoctinh" action="<?= ADMIN_URL ?>tag/create_tag"
              class="uk-form" style="text-align: center">

            <div class="form-group uk-form-row">
                <label class="control-label col-sm-3" for="email">Tên tag:</label>
                <div class="col-sm-8">
                    <input class="form-control" required="" name="tag_name" type="text" placeholder="">
                </div>
            </div>

            <div class="form-group uk-form-row">
                <label class="control-label col-sm-3" for="email">Slug:</label>
                <div class="col-sm-8">
                    <input class="form-control" required="" name="tag_slug" type="text" placeholder="">
                </div>
            </div>
            <fieldset>


                <div class="uk-form-row ">
                    <button class="uk-button btnlink">Tạo mới</button>
                </div>
            </fieldset>
        </form>
        <div class="uk-modal-footer"><a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>


<div class="md-card uk-margin-medium-bottom">
    <div class="md-card-content">
        <div class="uk-overflow-container">


            <div class="md-card-content">
                <div class="uk-grid" data-uk-grid-margin="">
                    <div class="uk-width-medium-1-1">

                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Quản trị
                            </li>
                            <li class="active">
                                <i class="fa fa-list"></i> Quản lý tag
                            </li>
                        </ol>
                        <table class="table table-bordered">
                            <thead>
                            <th>ID</th>
                            <th>Tên tag</th>
                            <th>Công cụ</th>

                            </thead>
                            <tbody class="md-list md-list-addon uk-sortable sortable-handler"
                                   data-uk-sortable="{group:'connected-group'}">
                            <?php foreach ($data as $value) { ?>
                                <tr data-id="<?= $value['tag_id'] ?>">
                                    <td><?= $value['tag_id'] ?></td>
                                    <td><?= $value['tag_name'] ?></td>
                                    <td>
                                        <a data-id="<?= $value['tag_id'] ?>" data-ten="<?= $value['tag_name'] ?>"
                                           data-slug="<?= $value['tag_slug'] ?>"
                                           class="label label-info btn-edit"><i
                                                    class="glyphicon glyphicon-edit"></i>Sửa</a>
                                        <?php if (true) { ?>
                                            <a href="<?= ADMIN_URL ?>tag/delete_tag/<?= $value['tag_id'] ?>"
                                               class="label label-danger xoatag"><i
                                                        class="glyphicon glyphicon-trash"></i> Xóa</a>
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


<div id="thongbaoupdate">

</div>
<div style="text-align: center">
    <div class="uk-flex-order-first">
        <button data-uk-modal="{target:'#showcreate'}" class="uk-button uk-button-success">TẠO MỚI</button>
    </div>


</div>
<style>
    tr {
        position: relative !important;
    }

    td, th {
        width: 00px;
        overflow: hidden;
    }

    .dataTables_length {
        float: left;
    }

    #dt_tableTools1_filter {
        float: right;
    }
</style>
<script src="<?= load_admin_view("tag/js/index.js") ?>"></script>