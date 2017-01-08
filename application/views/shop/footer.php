<!-- Footer -->

<footer id="footer">
    <div class="container">
        <!-- introduce-box -->
        <div id="introduce-box" class="row">
            <div class="col-md-3">
                <div id="address-box">
                    <a><img src="<?= BASE_URL . LOGO ?>" alt=""/></a>
                    <div id="address-list">
                        <div class="tit-name">Địa chỉ:</div>
                        <div class="tit-contain"><?= DIACHI ?></div>
                        <div class="tit-name">Phone:</div>
                        <div class="tit-contain"><?= SDT ?></div>
                        <div class="tit-name">Email:</div>
                        <div class="tit-contain"><?= EMAIL ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">

                    <?php
                    if (!$footer = cache_view_start("footer")) {

                        if (isset($this->data['footer']['parent'][0])) {
                            foreach ($this->data['footer']['parent'][0] as $value) {
                                ?>
                                <div class="col-sm-4">
                                    <div class="introduce-title"><?= $this->data['footer']['item'][$value]['menu_name'] ?></div>
                                    <ul id="introduce-company"  class="introduce-list">
                                        <?php
                                        if (isset($this->data['footer']['parent'][$value])) {
                                            foreach ($this->data['footer']['parent'][$value] as $value2) {
                                                ?>
                                        <li><a href="<?= $this->data['footer']['item'][$value2]['menu_slug'] ?>"><?= $this->data['footer']['item'][$value2]['menu_name'] ?></a></li>

                                            <?php }
                                        } ?>
                                    </ul>
                                </div>
                            <?php
                            }
                        }
                        cache_view_end("footer");
                    } else
                        echo $footer
                        ?>


                </div>
            </div>

        </div><!-- /#introduce-box -->

        <!-- #trademark-box -->
<?php
if (isset($this->data["module"]["banner"]["footer"][1])) {
    ?>
            <div id="trademark-box" class="row">
                <div class="col-sm-12">
                    <ul id="trademark-list">
                        <li id="payment-methods"><?= $this->data["module"]["banner"]["footer"][1]["name"] ?></li>
    <?php foreach ($this->data["module"]["banner"]["footer"][1]["data"] as $k => $v) { ?>
                            <li>
                                <a href="<?= $v["module_link"] ?>"><img src="<?= BASE_URL . $v["module_image"] ?>"/></a>
                            </li>
            <?php } ?>
                    </ul>
                </div>
            </div> <!-- /#trademark-box -->

<?php } ?>

    </div>
</footer>
<div class="dangload">

    <div class="boxdangload">
        <img src="<?= BASE_URL . "application/views/shop/assets/images/load.gif" ?>">
    </div>

</div>
<a class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>

<script type="text/javascript" src="<?= load_public("js/like.js") ?>"></script>
<script type="text/javascript" src="<?= load_frontend_view("assets/js/jquery.validate.js") ?>"></script>
<script type="text/javascript" src="<?= load_frontend_view("sanpham/js/giohang.js") ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= load_frontend_view("assets/lib/owl.carousel/owl.carousel.css") ?>"/>

<link rel="stylesheet" type="text/css" href="<?= load_frontend_view("assets/lib/fancyBox/jquery.fancybox.css") ?>"/>
<script type="text/javascript" src="<?= load_frontend_view("assets/lib/fancyBox/jquery.fancybox.js") ?>"></script>

<script type="text/javascript" src="<?= load_frontend_view("assets/lib/bootstrap/js/bootstrap.min.js") ?>"></script>
<script type="text/javascript" src="<?= load_frontend_view("assets/lib/owl.carousel/owl.carousel.min.js") ?>"></script>
<script type="text/javascript" src="<?= load_frontend_view("assets/js/footer.js") ?>"></script>
</body>
</html>