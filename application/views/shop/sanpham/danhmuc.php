<?php
$thongtindanhmuc = $this->data['thongtindanhmuc'];
$phantrang = $this->data['phantrang'];

?>


<!-- breadcrumb -->

<!-- ./breadcrumb -->
<!-- row -->
<div class="row">
    <!-- Left colunm -->

    <div class="column col-xs-12 col-sm-3" id="left_column">
        <div class="block left-module">
            <p class="title_block">Lọc sản phẩm</p>
            <div class="block_content">
                <!-- layered -->
                <div class="layered layered-filter-price">
                    <form method="GET">
                        <?php foreach ($this->data['boloc'] as $key => $value) {
                            switch ($value['thongtin']['productattr_name']) {
                                case "Màu sắc": { ?>
                                    <div class="layered_subtitle"><?= $value['thongtin']['productattr_name'] ?></div>
                                    <div class="layered-content filter-color">
                                        <div class="check-box-list listgiatri" data-label="<?= $key ?>">
                                            <ul class="check-box-list">
                                                <?php foreach ($value['data'] as $value2) { ?>

                                                    <li>
                                                        <input <?= in_array($value2['attr_val_id'], $this->data['filter']) == true ? "checked" : "" ?>
                                                            class="filter" value="<?= $value2['attr_val_id'] ?>"
                                                            type="checkbox" id="<?= $value2['attr_val_id'] ?>"
                                                            name="filter[]">
                                                        <label style=" background:<?= $value2['attr_val_value'] ?>;"
                                                               for="<?= $value2['attr_val_id'] ?>"><span
                                                                class="button"></span></label>
                                                    </li>

                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php break;
                                } ?>

                                <?php default : { ?>
                                <!-- bo loc -->
                                <div class="layered_subtitle"><?= $value['thongtin']['tenthuoctinhchon'] ?></div>
                                <div class="layered-content filter-size">

                                    <ul class="check-box-list">
                                        <?php foreach ($value['data'] as $value2) { ?>
                                            <li>
                                                <input <?= in_array($value2['id_giatrithuoctinhchon'], $this->data['filter']) == true ? "checked" : "" ?>
                                                    class="filter" value="<?= $value2['id_giatrithuoctinhchon'] ?>"
                                                    type="checkbox" id="<?= $value2['id_giatrithuoctinhchon'] ?>"
                                                    name="filter[]">
                                                <label for="<?= $value2['id_giatrithuoctinhchon'] ?>">
                                                    <span class="button"></span>
                                                    <?= $xuly->output($value2['giatri']) ?>
                                                </label>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                </div>
                                <?php break;
                            } ?>
                                <!--/bo loc -->
                            <?php }
                        } ?>

                        <div class="layered_subtitle">Hiển thị</div>
                        <div class="layered-content filter-size ">
                            <div class="sortPagiBar">
                                <div class="sort-product" style="float: left;">
                                    <select name="sapxep" class='orderby'>
                                        <?php
                                        foreach ($this->sapxep as $key => $value) {
                                            ?>
                                            <option <?= $value['selected'] ?>
                                                value="<?= $key ?>"><?= $value['ten'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="sort-product-icon sortby btn btn-default">
                                        <i data-type="asc"
                                           class="fa fa-sort-alpha-asc <?= $this->data['sortby'] == "asc" ? "sortbyactive" : "" ?>"></i>
                                        <i data-type="desc"
                                           class="fa fa-sort-alpha-desc <?= $this->data['sortby'] == "desc" ? "sortbyactive" : "" ?>"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="button" class="btn btn-primary btnlocsanpham">TÌM NGAY</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->load->view(THEME . "/left") ?>
    </div>
</div>
<!-- Center colunm-->

<div class="center_column col-xs-12 col-sm-9" id="center_column">

    <!-- subcategories -->
    <div class="subcategories">
        <ul>

            <li data-tuychon="tatca"
                class="tuychonsanpham <?= $this->data['tuychonsanpham'] == 'tatca' ? "current-categorie" : "" ?>">
                <a>Tất cả</a>
            </li>
            <li data-tuychon="noibat"
                class="tuychonsanpham <?= $this->data['tuychonsanpham'] == 'noibat' ? "current-categorie" : "" ?>">
                <a>Sản nổi bật</a>
            </li>
            <li data-tuychon="giamgia"
                class="tuychonsanpham <?= $this->data['tuychonsanpham'] == 'giamgia' ? "current-categorie" : "" ?>">
                <a>Sản phẩm giảm giá</a>
            </li>
        </ul>
    </div>
    <!-- ./subcategories -->
    <!-- view-product-list-->
    <div id="view-product-list" class="view-product-list">
        <h2 class="page-heading">
            <span class="page-heading-title"><?= $this->data['thongtindanhmuc']['productcategory_name'] ?></span>
        </h2>
        <ul class="display-product-option">
            <li class="view-as-grid selected">
                <span>grid</span>
            </li>
            <li class="view-as-list">
                <span>list</span>
            </li>
        </ul>
        <!-- PRODUCT LIST -->
        <ul class="row product-list grid dulieusanpham">
            <?php foreach ($this->data['sanpham'] as $value) { ?>

                <li class="col-xs-6 col-sm-4">
                    <div class="product-container">
                        <div class="left-block">
                            <a title="<?= $value['tensanpham'] ?>"
                               href="<?= URL ?>san-pham/<?= $value['id_sanpham'] . '/' . $value['slugsanpham'] ?>"
                               class="loading">
                                <img class="img-responsive b-lazy" title="<?= $value['tensanpham'] ?>"
                                     alt="<?= $value['tensanpham'] ?>"
                                     data-src="<?= URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['hinhdaidien'] ?>"/>
                            </a>
                            <div class="quick-view">
                                <a title="Yêu thích" data-id="<?= $value['id_sanpham'] ?>" class="heart yeuthich"></a>

                            </div>
                            <div class="add-to-cart">
                                <?php if (kiemtranull($value['ngangon'])) { ?>
                                    <a> <?= neods($value['ngangon'], 120) ?></a>
                                <?php } else {
                                } ?>
                            </div>
                            <?php
                            if ($value['giamgia'] > 0) {
                                ?>
                                <div class="price-percent-reduction2">-<?= $value['giamgia'] ?>%<br>SAFE</div>
                            <?php } ?>
                            <?php
                            if ($value['noibat'] == 1) {
                                ?>
                                <div class="featured-text"><span></span></div>
                            <?php } ?>

                            <?php
                            if ($value['moi'] == 1) {
                                ?>
                                <div class="group-price">
                                    <span class="product-new">New</span>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="right-block">
                            <h5 class="product-name"><a title="<?= $value['tensanpham'] ?>"
                                                        href=<?= URL ?>san-pham/<?= $value['id_sanpham'] . '/' . $value['slugsanpham'] ?>"><?= $value['tensanpham'] ?></a>

                            </h5>

                            <div class="content_price">

                                <div class="info-orther">
                                    <div class="product-desc">
                                        <?= neods($value['ngangon'], 120) ?>
                                    </div>
                                </div>
                                <?php if ($value['gia'] != $value['giamoi']) { ?>
                                    <span class="price product-price"><?= tien($value['giamoi']) ?>&nbsp;₫</span>
                                    <span class="price old-price"><?= tien($value['gia']) ?></span>
                                <?php } ELSE { ?>
                                    <span class="price product-price"><?= tien($value['gia']) ?>&nbsp;₫</span>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </li>
            <?php } ?>


        </ul>
        <!-- ./PRODUCT LIST -->
    </div>

    <!-- ./view-product-list-->
    <div class="sortPagiBar">
        <div class="bottom-pagination">

            <nav>
                <?php
                $totalpage = $this->data['phantrang']['totalpage'];
                $currentpage = $this->data['phantrang']['currentpage'];
                ?>
                <ul class="pagination">
                    <?=
                    phantrangajax($totalpage, $currentpage, URL);
                    ?>

                </ul>
            </nav>
        </div>
        <form method="GET" id="locsanpham">


        </form>
    </div>
</div>
<!-- ./ Center colunm -->
</div>
<!-- ./row-->
</div>
</div>

<script>
    URLNOW = "<?=  URL . "danh-muc/" . $thongtindanhmuc['id_danhmuc'] . "/" . $this->data['thongtindanhmuc']['slug'] ?>";
</script>
<script src="<?= URL ?>view/<?= THEME ?>/sanpham/js/danhmuc.js"></script>