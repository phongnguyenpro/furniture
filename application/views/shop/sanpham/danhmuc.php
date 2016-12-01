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
        <?php
        if (isset($this->data['boloc'])) {
            ?>
            <div class="block left-module">
                <p class="title_block">Lọc sản phẩm</p>
                <div class="block_content">
                    <!-- layered -->
                    <div class="layered layered-filter-price">
                        <form method="GET">
                            <?php foreach ($this->data['boloc'] as $key => $value) {
                                switch ($value['thongtin']['productattr_name']) {
                                    case "Màu sắc": { ?>
                                        <div
                                            class="layered_subtitle"><?= $value['thongtin']['productattr_name'] ?></div>
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
                                    <div class="layered_subtitle"><?= $value['thongtin']['productattr_name'] ?></div>
                                    <div class="layered-content filter-size">

                                        <ul class="check-box-list">
                                            <?php foreach ($value['data'] as $value2) { ?>
                                                <li>
                                                    <input <?= in_array($value2['attr_val_id'], $this->data['filter']) == true ? "checked" : "" ?>
                                                        class="filter" value="<?= $value2['attr_val_id'] ?>"
                                                        type="checkbox" id="<?= $value2['attr_val_id'] ?>"
                                                        name="filter[]">
                                                    <label for="<?= $value2['attr_val_id'] ?>">
                                                        <span class="button"></span>
                                                        <?= string_output($value2['attr_val_value']) ?>
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
            <?php
        }
        ?>
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
        <?php
        if (isset($this->data['thongtindanhmuc'])) {
            ?>
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
            <?php
        }
        ?>
        <!-- PRODUCT LIST -->
        <ul class="row product-list grid dulieusanpham">
            <?php
            if (isset($this->data['sanpham'])){
            foreach ($this->data['sanpham'] as $value) {
            ?>

            <li class="col-xs-6 col-sm-4">
                <div class="product-container">
                    <div class="left-block">
                        <a title="<?= $value['product_name'] ?>"
                           href="<?= BASE_URL . 'san-pham/' . $value['product_id'] . '/' . $value['product_slug'] ?>"
                           class="loading">
                            <img class="img-responsive b-lazy" title="<?= $value['product_name'] ?>"
                                 alt="<?= $value['product_name'] ?>"
                                 data-src="<?= BASE_URL ?>public/upload/images/thumb_product/<?= $value['product_avatar'] ?>"/>
                        </a>
                        <div class="quick-view">
                            <a title="Yêu thích" data-id="<?= $value['product_id'] ?>" class="heart yeuthich"></a>

                        </div>
                        <div class="add-to-cart">
                            <?php if (kiemtranull($value['product_description'])) { ?>
                                <a> <?= neods($value['product_description'], 120) ?></a>
                            <?php } else {
                            } ?>
                        </div>
                        <?php
                        if ($value['product_sale'] > 0) {
                            ?>
                            <div class="price-percent-reduction2">-<?= $value['product_sale'] ?>%<br>SAFE</div>
                        <?php } ?>
                        <?php
                        if ($value['product_feature'] == 1) {
                            ?>
                            <div class="featured-text"><span></span></div>
                        <?php } ?>

                        <?php
                        if ($value['product_new'] == 1) {
                            ?>
                            <div class="group-price">
                                <span class="product-new">New</span>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="right-block">
                        <h5 class="product-name"><a title="<?= $value['product_name'] ?>"
                                                    href=<?= BASE_URL . 'san-pham/' . $value['product_id'] . '/' . $value['product_slug'] ?>"><?= $value['product_name'] ?></a>

                            </h5>

                            <div class=" content_price">

                            <div class="info-orther">
                                <div class="product-desc">
                                    <?= neods($value['product_description'], 120) ?>
                                </div>
                            </div>
                            <?php if ($value['product_price'] != $value['product_price_new']) { ?>
                                <span class="price product-price"><?= tien($value['product_price_new']) ?>
                                    &nbsp;₫</span>
                                <span class="price old-price"><?= tien($value['product_price']) ?></span>
                            <?php } ELSE { ?>
                                <span class="price product-price"><?= tien($value['product_price']) ?>&nbsp;₫</span>
                            <?php } ?>
                    </div>

                </div>
    </div>
    </li>
    <?php }
    } ?>


    </ul>
    <!-- ./PRODUCT LIST -->
</div>

<!-- ./view-product-list-->
<?php
if (isset($this->data['phantrang'])) {
    ?>
    <div class="sortPagiBar">
        <div class="bottom-pagination">

            <nav>
                <?php
                $totalpage = $this->data['phantrang']['totalpage'];
                $currentpage = $this->data['phantrang']['currentpage'];
                ?>
                <ul class="pagination">
                    <?=
                    phantrangajax($totalpage, $currentpage, BASE_URL);
                    ?>

                </ul>
            </nav>
        </div>
        <form method="GET" id="locsanpham">


        </form>
    </div>
    <?php
}
?>
</div>
<!-- ./ Center colunm -->
</div>
<!-- ./row-->
</div>
</div>

<script>
    URLNOW = "<?=  BASE_URL . "Product_category/category/" . $thongtindanhmuc['productcategory_id'] . "/" . $this->data['thongtindanhmuc']['productcategory_slug'] ?>";
</script>
<script src="<?= load_frontend_view('sanpham/js/danhmuc.js') ?>"></script>