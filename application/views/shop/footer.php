


<!-- Footer -->


<footer id="footer">
    <div class="container">
        <!-- introduce-box -->
        <div id="introduce-box" class="row">
            <div class="col-md-3">
                <div id="address-box">
                    <a ><img src="<?= BASE_URL . LOGO ?>" alt="" /></a>
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

            <div class="col-md-3">
                <div class="introduce-title">About Market</div>
                <ul id="introduce-company" class="introduce-list">
                    <li><a>About</a></li>
                    <li><a>Market Reviews</a></li>
                    <li><a>Terms of Use</a></li>
                    <li><a>Privacy Policy</a></li>
                    <li><a>Site Map</a></li>

                </ul>
            </div>
             <div class="col-md-3">
                <div class="introduce-title">Customer Service</div>
                <ul id="introduce-company" class="introduce-list">
                    <li><a>Shipping Policy</a></li>
                    <li><a>Compensation First</a></li>
                    <li><a>My Account</a></li>
                    <li><a>Return Policy</a></li>
                    <li><a>Contact</a></li>

                </ul>
            </div>
             <div class="col-md-3">
                <div class="introduce-title">Payment & Shipping</div>
                <ul id="introduce-company" class="introduce-list">
                    <li><a>Terms of Use</a></li>
                    <li><a>Payment Methods</a></li>
                    <li><a>Shipping Guide</a></li>
                    <li><a>Locations We Ship To</a></li>
                    <li><a>Estimated Delivery Time</a></li>

                </ul>
            </div>
        </div><!-- /#introduce-box -->

        <!-- #trademark-box -->
        <div id="trademark-box" class="row">
            <div class="col-sm-12">
                <ul id="trademark-list">
                    <li id="payment-methods">Hình thức thanh toán</li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-ups.jpg"  alt="ups"/></a>
                    </li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-qiwi.jpg"  alt="ups"/></a>
                    </li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-wu.jpg"  alt="ups"/></a>
                    </li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-cn.jpg"  alt="ups"/></a>
                    </li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-visa.jpg"  alt="ups"/></a>
                    </li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-mc.jpg"  alt="ups"/></a>
                    </li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-ems.jpg"  alt="ups"/></a>
                    </li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-dhl.jpg"  alt="ups"/></a>
                    </li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-fe.jpg"  alt="ups"/></a>
                    </li>
                    <li>
                        <a ><img src="<?= BASE_URL . "application/views/" . THEME ?>/assets/data/trademark-wm.jpg"  alt="ups"/></a>
                    </li>
                </ul> 
            </div>
        </div> <!-- /#trademark-box -->



    </div> 
</footer>
<div class="dangload">

    <div class="boxdangload">
        <img src="<?= BASE_URL . "application/views/shop/assets/images/load.gif" ?>"  >
    </div>

</div>
<a class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>

<script type="text/javascript" src="<?= load_public("js/like.js") ?>"></script>
<script type="text/javascript" src="<?= load_frontend_view("assets/js/jquery.validate.js") ?>"></script>
<script type="text/javascript" src="<?= load_frontend_view("sanpham/js/giohang.js") ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= load_frontend_view("assets/lib/owl.carousel/owl.carousel.css") ?>" />

<link rel="stylesheet" type="text/css" href="<?= load_frontend_view("assets/lib/fancyBox/jquery.fancybox.css") ?>" />
<script type="text/javascript" src="<?= load_frontend_view("assets/lib/fancyBox/jquery.fancybox.js") ?>"></script>

<script type="text/javascript" src="<?= load_frontend_view("assets/lib/bootstrap/js/bootstrap.min.js") ?>"></script>
<script type="text/javascript" src="<?= load_frontend_view("assets/lib/owl.carousel/owl.carousel.min.js") ?>"></script>
<script type="text/javascript" src="<?= load_frontend_view("assets/js/footer.js") ?>"></script>
</body>
</html>