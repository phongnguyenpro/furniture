<?php
if (isset($this->data["module"]["product"]["left"])) {
    foreach ($this->data["module"]["product"]["left"] as $k => $v) {
        ?>  
        <div class="block left-module product-list  ">
            <p class="title_block"><?= $v["name"] ?></p>
            <ul>

                <?php foreach ($v["data"] as $k1 => $value) { ?>
                    <li>
                        <div class="product-container">
                            <div class="left-block">
                                <a title="<?= neods($value['product_name'], 40) ?>"
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
                                <h5 class="product-name"><a title="<?= neods($value['product_name'], 40) ?>"
                                                            href="<?= BASE_URL . $value['product_slug'] . "-" . $value['product_id'] . "-html" ?>" ><?= neods($value['product_name'], 40) ?></a>

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
                <?php } ?>
            </ul>
        </div>

        <?php
    }
}
?>

<?php
if (isset($this->data["module"]["banner"]["left"])) {
    foreach ($this->data["module"]["banner"]["left"] as $k => $v) {
        ?>  
        <div class="block left-module product-list  ">

            <?php
            foreach ($v["data"] as $k1 => $value) {
                ?>
                <a href="<?= $value["module_link"] ?>"><img src="<?= BASE_URL . $value["module_image"] ?>" class="img-responsive"></a>
                <?php } ?>
        </div>

    <?php }
} ?>

