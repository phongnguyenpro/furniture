<script type="text/javascript" src="<?= load_frontend_view("assets/lib/jquery.bxslider/jquery.bxslider.min.js") ?>"/></script> <!-- Trình chiếu -->
<link rel="stylesheet" type="text/css" href="<?= load_frontend_view("assets/lib/jquery.bxslider/jquery.bxslider.css") ?>" />

<!-- Home slideder-->
<div id="home-slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 slider-left"></div>
            <div class="col-sm-9 header-top-right">
                <div class="homeslider">
                    <div class="content-slide" style="height: 450px;overflow: hidden">
                        <ul id="slide-background" >
                            <?php if(isset($this->data['module']['slider']["main"][1]['data'])){ foreach ($this->data['module']['slider']["main"][1]['data'] as $value) { ?>
                            <li data-background="">
                                <a href="<?= $value['module_link'] ?>">
                                    <img alt="Funky roots" src="<?= $value['module_image'] ?>" title="<?= $this->data['module']['slider']["main"][1]["name"] ?>" />
                                </a>
                            </li>

                            <?php }} ?>
                        </ul>
                    </div>
                </div>
                <div class="header-banner banner-opacity">
                    <ul>
                        <?php
                        if (isset($this->data['module']['banner']['main'][1]["data"])) {
                            foreach ($this->data['module']['banner']['main'][1]["data"] as $value) {
                                ?>
                                <li><a href=""><img alt="Funky roots" src="<?= $value['module_image'] ?>" /></a></li>

                                <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- END Home slideder-->

                        <!-- servives -->
                        <div class="service ">
                            <div class="col-xs-6 col-sm-3 service-item">
                                <div class="icon">
                                </div>
                                <div class="info">
                                    <a   ><h3>vận chuyển</h3></a>
                                    <span>Nhanh chóng </span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 service-item">
                                <div class="icon">
                                </div>
                                <div class="info">
                                    <a   ><h3>Đổi trả</h3></a>
                                    <span>15 ngày</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 service-item">
                                <div class="icon">
                                </div>

                                <div class="info" >
                                    <a   ><h3>Phụ vụ</h3></a>
                                    <span> 24/7</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-3 service-item">
                                <div class="icon">
                                </div>
                                <div class="info">
                                    <a   ><h3>Giá rẻ</h3></a>
                                    <span>Tốt nhất</span>
                                </div>
                            </div>
                        </div>
                        <!-- end services -->

                    </div>
                </div>
            </div>
        </div>



        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 page-top-left">
                        <div class="popular-tabs">

                            <ul class="nav-tab clearfix">
                                <?php
                                if(isset($this->data['module']["product"]["main"])){
                                $i = 1;
                                foreach ($this->data['module']["product"]["main"] as $key => $datasp) {
                                    ?>
                                    <li class="<?= $i == 1 ? "active" : "" ?>" data-toggle="tab" href="#tab-<?= $key ?>"><a ><?= $datasp["name"] ?></a></li>
                                    <?php
                                    $i = 0;
                                }
                                ?>
                        <!--                     <li class="active" data-toggle="tab" href="#tab-1"><a >Bạn chạy nhất</a></li>
                                                <li class=""  data-toggle="tab" href="#tab-2" ><a>Sản phẩm nhất</a></li>
                                                <li data-toggle="tab" href="#tab-3"><a >Nổi bật</a></li>
                                                <li data-toggle="tab" href="#tab-4"><a >Giảm giá</a></li>-->

                                            </ul>
                                            <div class="tab-container">
                                                <?php
                                                $i = 1;
                                                foreach ($this->data['module']["product"]["main"] as $key => $datasp) {
                                                    ?>
                                                    <div id="tab-<?= $key ?>" class="tab-panel <?= $i == 1 ? "active" : "" ?>">
                                                        <ul  class="product-list owl-carousel"  data-dots="false" data-loop="false" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":2},"600":{"items":2},"1000":{"items":"4"}}'>        
                                                            <?php foreach ($datasp['data'] as $value) { ?>
                                                            <li>
                                                                <div class="">
                                                                    <div class="left-block">
                                                                        <a title="<?= $value['product_name'] ?>"
                                                                        href="<?= BASE_URL.$value['product_slug']."-".$value['product_id']."-html" ?>"
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
                                                                            href="<?= BASE_URL.$value['product_slug']."-".$value['product_id']."-html" ?>" ><?= $value['product_name'] ?></a>

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
                                                                                <a href="<?= BASE_URL.$value['product_slug']."-".$value['product_id']."-html" ?>" class="btn-view-product"><i class="fa fa-shopping-cart"></i> Mua sản phẩm</a>
                                                                              <a class="btn-view-product"><i class="fa fa-heart" aria-hidden="true"></i> </a>

                                                                          </div>
                                                                      </div>
                                                                      
                                                                  </div>
                                                              </li>                


                                                              <?php } ?>
                                                          </ul>
                                                      </div>
                                                      <?php
                                                      $i++;
                                }}
                                                  ?>
                                                  <!-- End tab 1 -->

                                              </div>


                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </div>
                          <!-- END PAGE TOP. -->




                          <div class="content-page">
                            <div class="container">
                                <!-- featured category fashion -->
                                <?php $i=0;$quangcao=0; foreach ($this->data['product']['home_productcategory_data'] as $sanpham){ ?>
                                <div class="category-featured">
                                    <nav class="navbar nav-menu nav-menu-red show-brand">
                                      <div class="container">
                                        <!-- Brand and toggle get grouped for better mobile display -->
                                        <div class="navbar-brand"><a  href="<?= BASE_URL ?>danh-muc/<?= $sanpham['thongtin']['productcategory_id'] ?>/<?= $sanpham['thongtin']['productcategory_slug'] ?>" >
                                            <!--                          <img alt="fashion" src="assets/data/fashion.png" />-->
                                            <?= $sanpham['thongtin']['productcategory_name'] ?></a></div>
                                            <!--                  <span class="toggle-menu"></span>-->
                                            <!-- Collect the nav links, forms, and other content for toggling -->
                                            <div class="collapse navbar-collapse">           
                                              
                                                <ul class="nav navbar-nav">
                                                  
                                                </ul>
                                            </div><!-- /.navbar-collapse -->
                                        </div><!-- /.container-fluid -->
                                        <div id="<?= $i ?>" class="floor-elevator">
                                            <a href="#<?= $i-1 ?>" class="btn-elevator up  fa fa-angle-up"></a>
                                            <a href="#<?=   $i+1 ?>" class="btn-elevator down fa fa-angle-down"></a>
                                        </div>
                                    </nav>
<!--            <div class="category-banner">
                <div class="col-sm-6 banner">
                    <a   ><img alt="ads2" class="img-responsive" src="assets/data/ads2.jpg" /></a>
                </div>
                <div class="col-sm-6 banner">
                    <a   ><img alt="ads2" class="img-responsive" src="assets/data/ads3.jpg" /></a>
                </div>
            </div>-->
            <div class="product-featured clearfix">
             <?php $left=0;$item=5; if(isset($this->data['module']['banner']['main'][2]["data"][$quangcao])){ ?>
             <div class="banner-featured">
                <!--                    <div class="featured-text"><span>featured</span></div>-->
                <div class="banner-img">
                    <a  href="<?= $this->data['module']['banner']['main'][2]["data"][$quangcao]["module_link"]  ?>" ><img alt="Quang Cao" src="<?= $this->data['module']['banner']['main'][2]["data"][$quangcao]["module_image"] ?>" /></a>
                </div>
            </div>
            <?php $left="234";$item=4; } ?>
            <div class="product-featured-content">
                <div class="product-featured-list" style="margin-left: <?= $left ?>px;">
                    <div class="tab-container">
                        <!-- tab product -->
                        <div class="tab-panel active" id="tab-4">
                            <?php  if(isset($sanpham['data'])){ ?>
                            <ul data-items="5" class="product-list owl-carousel" data-dots="false" data-loop="false" data-nav = "true"  data-autoplay="true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":2},"600":{"items":3},"1000":{"items":<?= $item ?>}}'>
                                
                                <?php 
                                
                                foreach ($sanpham['data'] as $value)
                                    {         ?>    
                                
                                <li>
                                                                <div class="">
                                                                    <div class="left-block">
                                                                        <a title="<?= $value['product_name'] ?>"
                                                                        href="<?= BASE_URL.$value['product_slug']."-".$value['product_id']."-html" ?>"
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
                                                                            href="<?= BASE_URL.$value['product_slug']."-".$value['product_id']."-html" ?>" ><?= $value['product_name'] ?></a>

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
                                                                                <a href="<?= BASE_URL.$value['product_slug']."-".$value['product_id']."-html" ?>" class="btn-view-product"><i class="fa fa-shopping-cart"></i> Mua sản phẩm</a>
                                                                              <a class="btn-view-product"><i class="fa fa-heart" aria-hidden="true"></i> </a>

                                                                          </div>
                                                                      </div>
                                                                      
                                                                  </div>
                                                              </li>               
                                  
                                  <?php }?>
                              </ul>
                              
                              
                              <?php  }?>
                              
                          </div>
                      </div>
                      
                  </div>
              </div>
          </div>  
      </div><!-- Ket thuc mot cai -->
      <?php $i++;$quangcao++;} ?>

      
      <?php if(isset($this->data['module']['quangcao']['data']['footer']) ){ ?>

      <div class="row banner-bottom">
          
       
        
        <?php foreach($this->data['module']['quangcao']['data']['footer'] as $value){ ?>
        <div class="col-sm-6">
            <div class="banner-boder-zoom">
                <a href="#"><img alt="ads" class="img-responsive" src="<?= $value['linkimage'] ?>"></a>
            </div>
        </div>
        <?php }?>
    </div>    			
    <?php }?>
</div>
</div>  <!-- box -->
<!-- end danhmucapmot -->
