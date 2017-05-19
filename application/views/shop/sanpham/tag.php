<?php
$thongtintag = $this->data['thongtintag'];
?>

<!-- row -->
<div class="row">

    <div class="column col-xs-12 col-sm-3" id="left_column">
        <div class="col-left">
            <?php $this->load->view(THEME . "/left") ?>
        </div>
    </div>


    <div class="center_column col-xs-12 col-sm-9" id="center_column">


        <div id="view-product-list" class="view-product-list">
            <h2 class="page-heading">
                <span class="page-heading-title"><?= $this->data['thongtintag']['tag_name'] ?></span>
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
                <?php
                if (isset($this->data['sanpham']))
                    foreach ($this->data['sanpham'] as $value) {
                        ?>

                        <li class="col-xs-6 col-sm-4">
                            <div class="product-container">
                                <div class="left-block">
                                    <a title="<?= neods($value['product_name'], 40) ?>"
                                       href="<?= BASE_URL . $value['product_slug'] . "-" . $value['product_id'] . ".html" ?>"
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
                                    <h5 class="product-name"><a title="<?= neods($value['product_name'], 40) ?>"
                                                                href="<?= BASE_URL . $value['product_slug'] . "-" . $value['product_id'] . ".html" ?>" ><?= neods($value['product_name'], 40) ?></a>

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
                                        <a href="<?= BASE_URL . $value['product_slug'] . "-" . $value['product_id'] . ".html" ?>" class="btn-view-product"><i class="fa fa-shopping-cart"></i> Mua sản phẩm</a>
                                        <a class="btn-view-product"><i class="fa fa-heart" aria-hidden="true"></i> </a>

                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
            </ul>
            <!-- ./PRODUCT LIST -->
        </div>

        <div class="sortPagiBar">
            <div class="bottom-pagination">

                <nav>
                    <?php
                    $totalpage = $this->data['phantrang']['totalpage'];
                    $currentpage = $this->data['phantrang']['currentpage'];
                    $url = BASE_URL . "product_category/tag/" . $thongtintag['tag_id'] . "/" . $thongtintag['tag_slug'] . "?page=%u";
                    ?>
                    <ul class="pagination">
                        <?=
                        phantrang($totalpage, $currentpage, $url);
                        ?>

                    </ul>
                </nav>
            </div>
            <form method="GET" id="locsanpham">


            </form>
        </div>


    </div>

</div>
</div>