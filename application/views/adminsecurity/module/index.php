<ol class="breadcrumb">
    <li class="active">
        <i class="fa fa-dashboard"></i>Quản trị
    </li>
    <li class="active">
        <i class="fa fa-list"></i> Quản lý module
    </li>
    <li class="active">
        <i class="fa fa-list"></i> Danh sách trang
    </li>
</ol>
<div class="list-page">

    <?php
    foreach (get_page() as $k => $v) {
        ?>
        <div class="md-card md-card-hover item-page">
            <div class="title">
                <h1><a href="<?= ADMIN_URL ?>module/detail/<?= $k ?>"><?= $v ?></a></h1>
            </div>
        </div>
    <?php } ?>


</div>


<style>

    .item-page {
        display: inline-block;
        min-width: 300px;
        height: 200px;
        margin: 20px;
    }

    .item-page .title {

        display: table;
        height: 100%;
        width: 100%;
    }

    .item-page .title h1 {
        text-align: center;
        display: table-cell;
        vertical-align: middle;
        color: #1976d2;
        font-weight: bold;
    }
</style>