


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
            <div class="col-md-12">
                <div id="map"></div>
                <script>
                    // This example adds a search box to a map, using the Google Place Autocomplete
                    // feature. People can enter geographical searches. The search box will return a
                    // pick list containing a mix of places and predicted search terms.

                    function initAutocomplete() {
                        var pos;
                        var haightAshbury = new google.maps.LatLng(<?= MAPLAT ?>);
                        var map = new google.maps.Map(document.getElementById('map'), {
                            Center: haightAshbury,
                            zoom: 16,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            mapTypeControl: true,
                            mapTypeControlOptions: {
                                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                                position: google.maps.ControlPosition.RIGHT
                            },
                        });
                        marker = new google.maps.Marker({
                            map: map,
                            animation: google.maps.Animation.DROP,
                            position: haightAshbury,
                        });
                        var contentString = '<div id="content">' + "<b><?= TENSHOP ?></b><br><?= DIACHI ?>" + '</div>';
                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        infowindow.open(map, marker);

                        // [END region_getplaces]
                    }


                </script>

                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&key=AIzaSyAqqZi_6QMYAiT5WeDPrVo4JTTJEDpvBzM">
                </script>
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
                                <a  href="<?= $v["module_link"] ?>"><img src="<?= BASE_URL . $v["module_image"] ?>" /></a>
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