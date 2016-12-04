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
        <?php $this->load->view(THEME . "/left") ?>
    </div>
</div>
<!-- Center colunm-->

<div class="center_column col-xs-12 col-sm-9" id="center_column">

    <?php
    if (isset($this->data["module"]["banner"]["main"]["1"])) {
        ?>
        <div class="category-banner">
            <a href="#">
                <img class="img-responsive" src="<?= BASE_URL . $this->data["module"]["banner"]["main"]["1"]["data"][0]["module_image"] ?>" alt="">
            </a>
        </div>
    <?php } ?>
    <?php
    if (isset($this->data['thongtindanhmuc'])) {
        ?>
        <div class="listing-title">

            <h1><span><?= $this->data['thongtindanhmuc']['productcategory_name'] ?></span></h1>

        </div>
    <?php } ?>
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
        <div class="page-heading">

            <div class="box-filter clearfix">

                <?php
                if (isset($this->data['boloc'])) {
                    ?>
                    <div class="block left-module">
                        <div class="block_content">
                            <!-- layered -->
                            <div class="layered layered-filter-price">
                                <form method="GET">
                                    <?php
                                    foreach ($this->data['boloc'] as $key => $value) {
                                        switch ($value['thongtin']['productattr_name']) {
                                            case "Màu sắc": {
                                                    ?>

                                                    <div class="layered-content filter-color clearfix">
                                                        <div class="layered_subtitle"><a><?= $value['thongtin']['productattr_name'] ?></a></div>
                                                        <div class="check-box-list listgiatri" data-label="<?= $key ?>">
                                                            <ul>
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
                                                }
                                                ?>

            <?php default : { ?>
                                                    <!-- bo loc -->
                                                    <div class="layered-content filter-size">
                                                        <div class="layered_subtitle"><a><?= $value['thongtin']['productattr_name'] ?></a></div>
                                                        <div class="check-box-list listgiatri" data-label="<?= $key ?>">
                                                            <ul>
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
                                                    </div>
                                                    <?php break;
                                                }
                                                ?>
                                                <!--/bo loc -->
        <?php }
    }
    ?>
                                </form>
                            </div>
                        </div>
                    </div>
    <?php
}
?>
            </div>
            <div class="box-orderby">

                <span class="label-filter">Sắp xếp</span> 
                <select name="sapxep" class='orderby'>
                        <?php
                        foreach ($this->sapxep as $key => $value) {
                            ?>
                        <option <?= $value['selected'] ?>
                            value="<?= $key ?>"><?= $value['ten'] ?></option>
<?php } ?>
                </select>
                <div class="sort-product-icon sortby btn">
                    <i data-type="asc"
                       class="fa fa-sort-alpha-asc <?= $this->data['sortby'] == "asc" ? "sortbyactive" : "" ?>"></i>
                    <i data-type="desc"
                       class="fa fa-sort-alpha-desc <?= $this->data['sortby'] == "desc" ? "sortbyactive" : "" ?>"></i>
                </div>

                <span class="label-filter">Lọc giá</span>
                <input id="price-min"  value="<?= isset($this->data["price"][0]) ? $this->data["price"][0] : "" ?>" class="price input-price" placeholder="Min Price">
                <input id="price-max" value="<?= isset($this->data["price"][1]) ? $this->data["price"][1] : "" ?>" class="price input-price" placeholder="Max Price">



                <ul class="display-product-option">
                    <li class="view-as-grid selected">
                        <span>grid</span>
                    </li>
                    <li class="view-as-list">
                        <span>list</span>
                    </li>
                </ul>

            </div>
        </div>

        <!-- PRODUCT LIST -->
        <ul class="row product-list grid dulieusanpham">
<?php
if (isset($this->data['sanpham'])) {
    foreach ($this->data['sanpham'] as $value) {
        ?>

                    <li class="col-xs-6 col-sm-4">
                        <div class="product-container">
                            <div class="left-block">
                                <a title="<?= $value['product_name'] ?>"
                                   href="<?= BASE_URL . $value['product_slug'] . "-" . $value['product_id'] . "-html" ?>"
                                   class="loading">
                                    <img class="img-responsive b-lazy" title="<?= $value['product_name'] ?>"
                                         alt="<?= $value['product_name'] ?>"
                                         data-src="<?= BASE_URL ?>public/upload/images/thumb_product/<?= $value['product_avatar'] ?>"/>
                                </a>

                                <div class="add-to-cart">
                                    <?php if (kiemtranull($value['product_description'])) { ?>
                                        <a> <?= neods($value['product_description'], 120) ?></a>
                                <?php
                                } else {
                                    
                                }
                                ?>
                                </div>
                                <?php
                                if ($value['product_sale'] > 0) {
                                    ?>
                                    <div class="price-percent-reduction2">-<?= $value['product_sale'] ?>%<br>SAFE
                                    </div>
        <?php } ?>
                            </div>
                            <div class="right-block">
                                <h5 class="product-name"><a title="<?= $value['product_name'] ?>"
                                                            href="<?= BASE_URL . $value['product_slug'] . "-" . $value['product_id'] . "-html" ?>" ><?= $value['product_name'] ?></a>

                                </h5>

                                <div class="content_price">
                                    <?php if ($value['product_price'] != $value['product_price_new']) { ?>
                                        <span class="price product-price"><?= tien($value['product_price_new']) ?>
                                            &nbsp;₫</span>
                                        <span class="price old-price"><?= tien($value['product_price']) ?></span>
        <?php } ELSE { ?>
                                        <span class="price product-price"><?= tien($value['product_price']) ?>&nbsp;₫</span>
        <?php } ?>
                                </div>
                                <div class="info-bottom">
                                    <a href="<?= BASE_URL . $value['product_slug'] . "-" . $value['product_id'] . "-html" ?>" class="btn-view-product"><i class="fa fa-shopping-cart"></i> Mua sản phẩm</a>
                                    <a class="btn-view-product"><i class="fa fa-heart" aria-hidden="true"></i> </a>

                                </div>
                            </div>

                        </div>
                    </li>                

    <?php }
}
?>


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
    URLNOW = "<?= BASE_URL . "Product_category/category/" . $thongtindanhmuc['productcategory_id'] . "/" . $this->data['thongtindanhmuc']['productcategory_slug'] ?>";
</script>
<script src="<?= load_frontend_view('sanpham/js/danhmuc.js') ?>"></script>