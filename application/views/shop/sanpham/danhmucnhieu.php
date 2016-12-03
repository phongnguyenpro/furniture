<?php
if (isset($this->data['data'])) {
    $data = $this->data['data'];
    $bre = $this->data['bre'];
    if (isset($data['bre']))
        unset($data['bre']);
}
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
<!-- ./left colunm -->
<!-- Center colunm-->
<div class="center_column col-xs-12 col-sm-9" id="center_column">


    <!-- category-slider -->


    <div id="view-product-list" class="view-product-list">

        <?php
        if (isset($data)) {
            foreach ($data as $danhmuc) {
                ?>

                <h2 class="page-heading">
                        <span class="page-heading-title">
                            <a href="<?= BASE_URL . "danh-muc/" . $danhmuc['thongtin']['productcategory_id'] . "/" . $danhmuc['thongtin']['productcategory_slug'] ?>"><?= $danhmuc['thongtin']['productcategory_name'] ?>
                                <span class="fa fa-angle-right"> xem nhiều hơn</span></a></span>

                </h2>

                <?php if (isset($danhmuc['data'])) { ?>
                    <ul class="danhmucnhieu danhsachsanpham product-list  owl-carousel" data-items="4" data-nav="true"
                        data-dots="false" data-margin="20" data-loop="false"
                        data-responsive='{"0":{"items":2},"600":{"items":2},"800":{"items":2},"1200":{"items":3}}'>

                        <?php

                        foreach ($danhmuc['data'] as $value) { ?>

                            <li>
                                    <div class="">
                                        <div class="left-block">
                                            <a title="<?= $value['product_name'] ?>"
                                             href="<?= BASE_URL ?>san-pham/<?= $value['product_id'] . '/' . $value['product_slug'] ?>"
                                             class="loading">
                                             <img class="img-responsive b-lazy" title="<?= $value['product_name'] ?>"
                                             alt="<?= $value['product_name'] ?>"
                                             data-src="<?= BASE_URL ?>public/upload/images/thumb_product/<?= $value['product_avatar'] ?>"/>
                                         </a>
                                         
                                         <div class="add-to-cart">
                                            <?php if (kiemtranull($value['product_description'])) { ?>
                                            <a> <?= neods($value['product_description'], 120) ?></a>
                                            <?php } else {
                                                
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
                                                href="<?= BASE_URL ?>san-pham/<?= $value['product_id'] . '/' . $value['product_slug'] ?>"><?= $value['product_name'] ?></a>

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
                                                  <a class="btn-view-product"><i class="fa fa-shopping-cart"></i> Mua sản phẩm</a>
                                                  <a class="btn-view-product"><i class="fa fa-heart" aria-hidden="true"></i> </a>

                                              </div>
                                          </div>
                                          
                                      </div>
                                  </li>   
                        <?php } ?>
                    </ul>


                <?php }
                echo '
                    <hr>';
            }
        } ?>


        <!-- PRODUCT LIST -->

        <!-- ./PRODUCT LIST -->
    </div>
    <!-- ./view-product-list-->

</div>
<!-- ./ Center colunm -->
</div>
<!-- ./row-->
</div>
</div>


