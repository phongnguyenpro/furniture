<div class="page-content page-order">

    <div style="overflow-x: scroll" class="panel panel-default ">
        <div class="panel-heading red">Danh sách sản phẩm yêu thích</div>
        <div class="panel-body">
            <table class="table table-bordered  cart_summary">
                <thead>
                <tr>
                    <th class="cart_product">Sản phẩm</th>
                    <th>Miêu tả</th>
                    <th class="action"><i class="fa fa-trash-o"></i></th>
                </tr>
                </thead>
                <tbody>

                <?php
                if (isset($this->data['sanpham']))
                    foreach ($this->data['sanpham'] as $key => $value) { ?>

                        <tr>
                            <td class="cart_product">
                                <a href="<?= BASE_URL ?>san-pham/<?= $value['product_id'] ?>/<?= $value['product_slug'] ?>">
                                    <img class="img-responsive"
                                         src="<?= BASE_URL . "public/upload/images/thumb_product/" . $value['product_avatar'] ?>"
                                         alt="p10">
                                </a>
                            </td>
                            <td class="cart_description">

                                <p class="product-name"><a
                                        href="<?= BASE_URL ?>san-pham/<?= $value['product_id'] ?>/<?= $value['product_slug'] ?>"><?= $value['product_name'] ?> </a>
                                </p>
                                <small class="cart_ref">Mã SP : <?= $value['product_code'] ?></small>
                                <br>
                                <span>$<?= tien($value['product_price']) ?>VND</span>
                            </td>
                            <td class="action">
                                <a data-id="<?= $value['product_id'] ?>" class="xoayeuthich">Delete item</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>


        </div>
    </div>
    <div class="cart_navigation">
        <a class="prev-btn" href="<?= BASE_URL ?>">Tiếp tục mua hàng</a>

    </div>
</div>
</div>
</div>