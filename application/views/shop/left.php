<div class="col-left">


    <?php if (isset($this->data['module'])) { ?>

        <?php foreach ($this->data['module'] as $key => $module) { ?>

            <?php
            if (false) {  //  module html
                ?>
                <?php
                if (isset($module['data']['left'])) {
                    foreach ($module['data']['left'] as $value) {
                        ?>
                        <div class="block left-module">-->
                            <p class="title_block">--><?= $value['tieude'] ?></p>
                            <div class="block_content">--><?= $value['noidung'] ?></div>

                        </div>
                    <?php } ?>
                <?php }
            } ?>
            <?php
            if (false) {  // module bai viet
                ?>
                <div class="block left-module">
                    <p class="title_block"><?= $module['thongtin']['tenmodule'] ?></p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered">
                            <div class="layered-content ticker ">
                                <ul class="blog-list-sidebar clearfix ">
                                    <?php
                                    foreach ($module['data'] as $value) {
                                        ?>
                                        <li>
                                            <div class="post-thumb">

                                                <a href="<?= BASE_URL . "bai-viet/" . $value['id_baiviet'] . "/" . $value['slug'] ?>">
                                                    <img
                                                        src="<?= BASE_URL . "public/upload/images/thumb_baiviet/" . $value['hinhdaidien'] ?>"
                                                        alt="Blog">
                                                </a>
                                            </div>
                                            <div class="post-info">
                                                <h5 class="entry_title"><a
                                                        href="<?= BASE_URL . "bai-viet/" . $value['id_baiviet'] . "/" . $value['slug'] ?>"><?= $value['tenbaiviet'] ?></a>
                                                </h5>
                                                <div class="post-meta">
                                                    <span><?= neods($value['ngangon'], 100) ?></span><br>
                                                    <span class="date"><i
                                                            class="fa fa-calendar"></i><?= ngayoutput($value['ngaytao']) ?></span>
                                                    <!--                                                <span class="comment-count">
                                                                                                        <i class="fa fa-comment-o"></i> 3
                                                                                                    </span>-->
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="text-center controlticker"><a class="up"><i
                                        class="glyphicon glyphicon-download"></i></a></div>
                        </div>
                        <!-- ./layered -->
                    </div>
                </div>

            <?php } ?>
            <?php if ($key == "product") {
                if (isset($module["left"])) {
                    foreach ($module["left"] as $moduleProductLeft) {
                        ?>
                        <div class="block left-module ">
                            <p class="title_block"><?= $moduleProductLeft['name'] ?></p>
                            <div class="block_content product-onsale">
                                <ul class="product-list owl-carousel" data-dots="false" data-nav="false" data-margin="0"
                                    data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-items="1"
                                    data-autoplay="true">
                                    <?php
                                    foreach ($moduleProductLeft['data'] as $value) {
                                        ?>
                                        <li>
                                            <div class="">
                                                <div class="left-block">
                                                    <a title="<?= $value['product_name'] ?>"
                                                       href="<?= BASE_URL . 'Product_category/product/' . $value['product_id'] . '/' . $value['product_slug'] ?>">
                                                        <img title="<?= $value['product_name'] ?>"
                                                             alt="<?= $value['product_name'] ?>" class="img-responsive"
                                                             src="<?= BASE_URL ?>public/upload/images/thumb_product/<?= $value['product_avatar'] ?>"/>
                                                    </a>

                                                    <div class="quick-view">
                                                        <a title="Yêu thích" data-id="<?= $value['product_id'] ?>"
                                                           class="heart yeuthich"></a>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <?php if (kiemtranull($value['product_description'])) { ?>
                                                            <a> <?= neods($value['product_description'], 120) ?></a>
                                                        <?php } else {
                                                        } ?>
                                                    </div>
                                                </div>
                                                <div class="right-block">
                                                    <h5 class="product-name"><a title="<?= $value['product_name'] ?>"
                                                                                href="<?= BASE_URL . 'Product_category/product/' . $value['product_id'] . '/' . $value['product_slug'] ?>"><?= $value['product_name'] ?></a>

                                                    </h5>

                                                    <div class="content_price">
                                                        <?php if ($value['product_price'] != $value['product_price_new']) { ?>
                                                            <span
                                                                class="price product-price">$<?= tien($value['product_price_new']) ?>
                                                                &nbsp;₫</span>
                                                            <span
                                                                class="price old-price"><?= tien($value['product_price']) ?></span>
                                                        <?php } else { ?>
                                                            <span
                                                                class="price product-price"><?= tien($value['product_price']) ?>
                                                                &nbsp;₫</span>
                                                        <?php } ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    <?php }
                }
            } ?>

            <?php
            if (false) { // module quang cao
                ?>
                <?php if (isset($module['data']['left'])) { ?>
                    <div class="col-left-slide left-module">
                        <ul class="owl-carousel owl-style2" data-items="1" data-nav="false" data-margin="0"
                            data-autoplayTimeout="1000" data-autoplayHoverPause="true" data-autoplay="true">
                            <?php foreach ($module['data']['left'] as $value) { ?>
                                <li><a href=""><img src="<?= $value['linkimage'] ?>" alt="slide-left"></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

            <?php } ?>
            <?php unset($this->module[$key]);;
        }
    } ?>
    <!-- quang cao -->


    <!-- ./left colunm -->
      
     