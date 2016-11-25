<script type="text/javascript"
        src="<?= load_frontend_view('assets/lib/jquery.elevatezoom.js') ?>"></script>

<?php
$data = $this->data;
$url = BASE_URL . "san-pham/" . $data['sanpham']['product_id'] . "/" . $data['sanpham']['product_slug']
?>
<script type="text/javascript">
    window.___gcfg = {
        lang: 'vi',
        parsetags: 'onload'
    };

    (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();
</script>


<div id="fb-root"></div>


<!-- row -->
<div class="row">

    <!-- Left colunm -->
    <div class="column col-xs-12 col-sm-3" id="left_column">
        <?php $this->load->view(THEME . "/left") ?>
        <?php if (!empty($data['tag'])) { ?>
            <div class="block left-module">
                <p class="title_block">Tags</p>
                <div class="block_content">
                    <div class="tags">
                        <?php foreach ($data['tag'] as $value) { ?>
                            <a href="<?= URL ?>sanpham/tag/<?= $value['id_tag'] . "/" . $value['slugtag'] ?>"><span
                                    class="level2"><?= $value['tentag'] ?></span></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- ./left colunm -->
<!-- Center colunm-->
<div class="center_column col-xs-12 col-sm-9" id="center_column">
    <!-- Product -->

    <div id="product">
        <div class="primary-box row">
            <div class="pb-left-column col-xs-12 col-sm-6">
                <!-- product-imge-->
                <div class="product-image">
                    <div class="product-full">
                        <img id="product-zoom"
                             src="<?= BASE_URL ?>public/upload/images/hinhsanpham/<?= $data['sanpham']['product_avatar'] ?>"
                             data-zoom-image="<?= BASE_URL ?>public/upload/images/hinhsanpham/<?= $data['sanpham']['product_avatar'] ?>"/>
                    </div>
                    <div class="product-img-thumb" id="gallery_01">
                        <ul class="owl-carousel" data-items="3" data-nav="true" data-dots="false" data-margin="20"
                            data-loop="false">
                            <li>
                                <a href="#" title="<?= $data['sanpham']['product_avatar'] ?>"
                                   data-image="<?= BASE_URL ?>public/upload/images/hinhsanpham/<?= $data['sanpham']['product_avatar'] ?>"
                                   data-zoom-image="<?= BASE_URL ?>public/upload/images/hinhsanpham/<?= $data['sanpham']['product_avatar'] ?>">
                                    <img id="product-zoom"
                                         src="<?= BASE_URL ?>public/upload/images/thumb_hinhsanpham/<?= $data['sanpham']['product_avatar'] ?>"/>
                                </a>
                            </li>
                            <?php
                            foreach ($data['sanpham']['hinh'] as $value) {

                                ?>
                                <li class="itemimg">
                                    <a title="<?= $value['product_images_name'] ?>" href="#"
                                       data-image="<?= BASE_URL ?>public/upload/images/hinhsanpham/<?= $value['product_images_name'] ?>"
                                       data-zoom-image="<?= BASE_URL ?>public/upload/images/hinhsanpham/<?= $value['product_images_name'] ?>">
                                        <img id="product-zoom"
                                             src="<?= BASE_URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['product_images_name'] ?>"/>
                                    </a>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>

                <!-- product-imge-->
            </div>
            <div class="pb-right-column col-xs-12 col-sm-6">
                <h1 class="product-name"><?= $data['sanpham']['product_name'] ?></h1>


                <?php if (kiemtranull($data['sanpham']['product_code'])) { ?>
                    <p>Mã SP: <?= $data['sanpham']['product_code'] ?></p>
                <?php } ?>


                <div class="product-price-group">
                    <?php if ($data['sanpham']['product_price'] != $data['sanpham']['product_price_new']) { ?>
                        <span class="price giasanphammoi"><?= tien($data['sanpham']['product_price_new']) ?>&nbsp;
                        ₫</span><?php if (kiemtranull($data['sanpham']['product_unit'])) echo "/ <b class='price'>" . $data['sanpham']['product_unit'] . "</b>" ?>
                        <span class="old-price giasanpham"><?= tien($data['sanpham']['product_price']) ?></span>
                        <span class="discount">-<?= $data['sanpham']['product_sale'] ?>%</span>
                    <?php } else { ?>
                        <span class="price giasanpham"><?= tien($data['sanpham']['product_price']) ?>&nbsp;
                        ₫</span><?php if (kiemtranull($data['sanpham']['product_unit'])) echo "/ <b class='price'>" . $data['sanpham']['product_unit'] . "</b>" ?>
                    <?php } ?>

                </div>

                <div class="product-desc">
                    <?= $data['sanpham']['product_description'] ?>

                </div>
                <div class="form-option">

                    <p class="form-option-title"> Thông tinn sản phẩm:</p>
                    <br>
                    <?php
                    //                           Duyệt thuộc tính chọn
                    foreach ($data['sanpham']['thuoctinhchon'] as $key => $value) {

                        switch ($key) {
                            case "Màu sắc": { ?>
                                <div class="layered_subtitle thuoctinhmau"><?= $key ?></div>
                                <div class="layered-content filter-color">
                                    <div class="check-box-list listgiatri" data-label="<?= $key ?>">
                                        <?php foreach ($value as $value2) { ?>

                                            <input data-name="<?= $value2['attr_val_value'] ?>" class="giatrithuoctinhchon"
                                                   name="<?= $key ?>" type="radio"
                                                   id="<?= $value2['attr_val_id'] ?>"
                                                   value="<?= $value2['attr_val_id'] ?>"/>
                                            <label style=" background:<?= $value2['attr_val_value'] ?>;"
                                                   for="<?= $value2['attr_val_id'] ?>"><span
                                                    class="button"></span></label>


                                        <?php } ?>
                                    </div>
                                </div>
                                <?php break;
                            } ?>

                            <?php default : { ?>

                            <div class="attributes">
                                <div class="attribute-label"><?= $key ?></div>
                                <div class="attribute-list">
                                    <div class="layered-content filter-size">
                                        <div class="check-box-list listgiatri" data-label="<?= $key ?>">
                                            <?php foreach ($value as $value2) { ?>
                                                <input class="filter giatrithuoctinhchon"
                                                       data-name="<?= $value2['attr_val_value'] ?>" data-label="<?= $key ?>"
                                                       value="<?= $value2['attr_val_id'] ?>" type="radio"
                                                       id="<?= $value2['attr_val_id'] ?>" name="<?= $key ?>">
                                                <label for="<?= $value2['attr_val_id'] ?>"><span
                                                        class="button"></span><span><?= $value2['attr_val_value'] ?></span></label>


                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php break;
                        } ?>


                        <?php }
                    } ?>


                    <div class="attributes">
                        <div class="attribute-label">Cần mua:</div>
                        <div class="attribute-list quantity">

                            <button class="changesoluong" data-type="2"><b>-</b></button>
                            <input min="1" max="<?= $data['sanpham']['product_total'] ?>" name="soluongthem" type="text"
                                   readonly value="1" id="quantity"/>
                            <button class="changesoluong" data-type="1"><b>+</b></button>
                        </div>

                    </div>
                    <div class="attributes">
                        <div class="attribute-label">Số lượng:</div>
                        <div class="attribute-list ">
                            <b class="soluongsanpham">    <?php if ($data['sanpham']['product_total'] > 0) { ?>
                                    Còn <?= $data['sanpham']['product_total'] ?> sản phẩm
                                <?php } else {
                                    echo "Tạm hết hàng";
                                } ?>
                            </b>
                        </div>

                    </div>
                    </form>
                </div>

                <div class="form-action">
                    <div class="button-group">
                        <button class="btn-add-cart " <?= $data['sanpham']['product_total'] == 0 ? "disabled" : "" ?>
                                data-hinhsanpham="<?= $data['sanpham']['product_avatar'] ?>"
                                data-soluongsanpham="<?= $data['sanpham']['product_total'] ?>"
                                data-giamgia="<?= $data['sanpham']['product_sale'] ?>"
                                data-tensanpham="<?= $data['sanpham']['product_name'] ?>"
                                data-image="<?= $data['sanpham']['product_avatar'] ?>"
                                data-id="<?= $data['sanpham']['product_id'] ?>"
                                data-giasanpham="<?= $data['sanpham']['product_price'] ?>"
                                data-masanpham="<?= $data['sanpham']['product_code'] ?>"><?= $data['sanpham']['product_total'] == 0 ? "Tạm hết hàng" : "Thêm vào giỏ hàng" ?></button>
                        <br> <i>Đặt để giữ sản phẩm tại shop, không mua không sao</i>
                    </div>

                </div>

                <div class="form-action">
                    <div class="button-group">
                        <a class="wishlist"><i data-id="<?= $data['sanpham']['product_id'] ?>"
                                               class="fa fa-heart-o  yeuthich"></i>
                            <br> <span class="totalyeuthich"
                                       data-yeuthich="<?= $data['sanpham']['product_like'] ?>"><?= $data['sanpham']['product_like'] ?></span>
                            Yêu thích</a>
                        <a class="compare"><i class="fa fa-eye"></i>
                            <br>
                            <?= $data['sanpham']['product_view'] ?> Đã xem</a>
                    </div>
                </div>
                <div class="form-share">
                    <div class="share">

                        <div class="itemshare fb">
                            <span class="fb-like" data-href="<?= $url ?>" data-layout="button_count" data-action="like"
                                  data-show-faces="true" data-share="true"></span>
                            <span style="margin-left: 20px;" class="fb-send" data-href="<?= $url ?>"></span>
                        </div>
                        <div class="itemshare google">
                            <a>
                                <span class="g-plusone" data-size="standard" data-href='<?= $url ?>'></span>
                                <span class="g-plus" data-action="share" data-annotation="none"></span>
                            </a>
                        </div>
                    </div>
                    <div class="network-share">
                    </div>
                </div>
            </div>
        </div>

        <!-- tab product -->
        <div class="product-tab">
            <ul class="nav-tab">
                <li class="active">
                    <a aria-expanded="false" data-toggle="tab" href="#product-detail">Miêu tả</a>
                </li>
                <?php if (!empty($data['sanpham']['thuoctinhchitiet'])) { ?>
                    <li>
                        <a aria-expanded="true" data-toggle="tab" href="#information">Thông số chi tiết</a>
                    </li>
                <?php } ?>
                <li>
                    <a data-toggle="tab" href="#reviews">Bình luận</a>
                </li>

            </ul>
            <div class="tab-container">
                <div id="product-detail" class="tab-panel active">
                    <?= $data['sanpham']['product_content'] ?>
                </div>
                <div id="information" class="tab-panel">
                    <table class="table table-bordered">
                        <?php
                        foreach ($data['sanpham']['thuoctinhchitiet'] as $value) {
                            ?>

                            <tr>
                                <td width="200"><?= $data['val']['thuoctinh'][$value['product_prop_id']] ?></td>
                                <td><?= $value['product_prop_detail_value'] ?></td>
                            </tr>
                        <?php } ?>


                    </table>
                </div>
                <div id="reviews" class="tab-panel">
                    <div class="product-comments-block-tab">

                        <div class="fb-comments fb-like" data-href="<?= $url ?>"
                             data-colorscheme="light" data-numposts="5" data-width="100%"></div>
                    </div>

                </div>


            </div>
        </div>
        <!-- ./tab product -->
        <!-- box product -->
        <?php if (!empty($this->data['sanphamlienquan'])) { ?>
            <div class="page-product-box">
                <h3 class="heading">Sản phẩm liên quan</h3>
                <ul class="product-list danhsachsanpham owl-carousel" data-dots="false" data-loop="false"
                    data-nav="true" data-margin="30" data-autoplayTimeout="1000" data-autoplayHoverPause="true"
                    data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>


                    <?php foreach ($this->data['sanphamlienquan'] as $value) { ?>

                        <li>
                            <?php
                            if ($value['product_feature'] == 1) {
                                ?>
                                <div class="featured-text"><span></span></div>
                            <?php } ?>
                            <div class="">
                                <div class="left-block">
                                    <a title="<?= $value['product_name'] ?>"
                                       href="<?= BASE_URL ?>san-pham/<?= $value['product_id'] . '/' . $value['product_slug'] ?>"
                                       class="loading">
                                        <img class="img-responsive b-lazy" title="<?= $value['product_name'] ?>"
                                             alt="<?= $value['product_name'] ?>"
                                             data-src="<?= BASE_URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['product_avatar'] ?>"/>
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
                                    <?php
                                    if ($value['product_sale'] > 0) {
                                        ?>
                                        <div class="price-percent-reduction2">-<?= $value['product_sale'] ?>%<br>SAFE
                                        </div>
                                    <?php } ?>
                                    <div class="group-price">
                                        <?php
                                        if ($value['product_new'] == 1) {
                                            ?>
                                            <span class="product-new">New</span>
                                        <?php } ?>
                                    </div>
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

                                </div>
                            </div>
                        </li>
                    <?php } ?>


                </ul>
            </div>
        <?php } ?>
        <!-- ./box product -->
        <!-- box product -->
        <?php if (!empty($this->data['apriori'])) { ?>
            <div class="page-product-box">
                <h3 class="heading">Có thể bạn sẽ thích</h3>
                <ul class="product-list danhsachsanpham owl-carousel" data-dots="false" data-loop="false"
                    data-nav="true" data-margin="30" data-autoplayTimeout="1000" data-autoplayHoverPause="true"
                    data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}'>


                    <?php foreach ($this->data['apriori'] as $value) { ?>

                        <li>
                            <?php
                            if ($value['product_feature'] == 1) {
                                ?>
                                <div class="featured-text"><span></span></div>
                            <?php } ?>
                            <div class="">
                                <div class="left-block">
                                    <a title="<?= $value['product_name'] ?>"
                                       href="<?= BASE_URL ?>san-pham/<?= $value['product_id'] . '/' . $value['product_slug'] ?>"
                                       class="loading">
                                        <img class="img-responsive b-lazy" title="<?= $value['product_name'] ?>"
                                             alt="<?= $value['product_name'] ?>"
                                             data-src="<?= BASE_URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['product_avatar'] ?>"/>
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
                                    <?php
                                    if ($value['product_sale'] > 0) {
                                        ?>
                                        <div class="price-percent-reduction2">-<?= $value['product_sale'] ?>%<br>SAFE
                                        </div>
                                    <?php } ?>
                                    <div class="group-price">
                                        <?php
                                        if ($value['product_new'] == 1) {
                                            ?>
                                            <span class="product-new">New</span>
                                        <?php } ?>
                                    </div>
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

                                </div>
                            </div>
                        </li>

                    <?php } ?>


                </ul>
            </div>
        <?php } ?>
        <!-- ./box product -->
    </div>
    <!-- Product -->
</div>
<!-- ./ Center colunm -->
</div>
<!-- ./row-->
</div>
</div>

<script type="text/javascript" src="<?= load_frontend_view('sanpham/js/chitiet.js') ?>"></script>

<script>
    sanphamchitiet = JSON.parse(JSON.stringify(<?= json_encode($data['sanpham']['sanphamchitiet']) ?>));

</script>