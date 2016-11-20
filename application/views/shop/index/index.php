<!-- Home slideder-->
<div id="home-slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 slider-left"></div>
            <div class="col-sm-9 header-top-right">
                <div class="homeslider">
                  <div class="content-slide" style="height: 450px;overflow: hidden">
                        <ul id="slide-background" >
                            <?php foreach ($this->data['module']['trinhchieu']['data']  as $value){?>
                              <li data-background="<?= $value['color'] ?>">
                              <a href="<?= $value['linkurl'] ?>">
                                <img alt="Funky roots" src="<?= $value['linkimage'] ?>" title="<?= $value['tieude'] ?>" />
                              </a>
                              </li>  
                              
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="header-banner banner-opacity">
                    <ul  class="owl-carousel"  data-dots="false" data-loop="false" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true" data-responsive='{"0":{"items":1},"600":{"items":1},"1000":{"items":1}}'>        
                <?php for($i=1;$i<4;$i++){ ?>  
                 <?php if(isset($this->data['module']['quangcao']['data']['main'][$i]) ){ ?>
                        <li><a href="<?= $this->data['module']['quangcao']['data']['main'][$i]['linkurl'] ?>"><img alt="Funky roots" src="<?= $this->data['module']['quangcao']['data']['main'][$i]['linkimage'] ?>" /></a></li>
                   <?php } ?>
                <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Home slideder-->
   <!-- servives -->
<div class="container">
    <div class="service ">
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="<?= URL ?>view/<?= THEME ?>/assets/data/s1.png" />
            </div>
            <div class="info">
                <a   ><h3>vận chuyển</h3></a>
                <span>Nhanh chóng </span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="<?= URL ?>view/<?= THEME ?>/assets/data/s2.png" />
            </div>
            <div class="info">
                <a   ><h3>Đổi trả</h3></a>
                <span>15 ngày</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="<?= URL ?>view/<?= THEME ?>/assets/data/s3.png" />
            </div>
            
            <div class="info" >
                <a   ><h3>Phụ vụ</h3></a>
                <span> 24/7</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 service-item">
            <div class="icon">
                <img alt="services" src="<?= URL ?>view/<?= THEME ?>/assets/data/s4.png" />
            </div>
            <div class="info">
                <a   ><h3>Giá rẻ</h3></a>
                <span>Tốt nhất</span>
            </div>
        </div>
    </div>
</div>
<!-- end services -->


<div class="page-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 <?= empty($this->data['sanpham']['sanphamsapve'])==true?"col-sm-12":"col-sm-9" ?> page-top-left">
                <div class="popular-tabs">
                    
                      <ul class="nav-tab">
                         <?php $i=1; foreach ($this->data['module'] as $key=>$datasp){ ?>
                 <?php if(chapnhanmodule(array("sanphamnoibat","sanphammoi","sanphambanchay","sanphamgiamgia"),$key)){ ?>
                        <li class="<?= $i==1?"active":"" ?>" data-toggle="tab" href="#tab-<?= $key ?>"><a ><?= $this->data['module'][$key]['thongtin']['tenmodule'] ?></a></li>
                         <?php $i=0;}}?>
<!--                        <li class="active" data-toggle="tab" href="#tab-1"><a >Bạn chạy nhất</a></li>
                        <li class=""  data-toggle="tab" href="#tab-2" ><a>Sản phẩm nhất</a></li>
                        <li data-toggle="tab" href="#tab-3"><a >Nổi bật</a></li>
                        <li data-toggle="tab" href="#tab-4"><a >Giảm giá</a></li>-->
                        
                      </ul>
                    
             <div class="tab-container">
                 <?php $i=1; foreach ($this->data['module'] as $key=>$datasp){ ?>
                 <?php if(chapnhanmodule(array("sanphamnoibat","sanphammoi","sanphambanchay","sanphamgiamgia"),$key)){ ?>
                            <div id="tab-<?= $key ?>" class="tab-panel <?= $i==1?"active":"" ?>">
                                <ul  class="product-list owl-carousel"  data-dots="false" data-loop="false" data-nav = "true" data-margin = "30" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":2},"600":{"items":2},"1000":{"items":<?= empty($this->data['sanpham']['sanphamsapve'])==true?"4":"3" ?>}}'>        
                <?php foreach ($datasp['data'] as $value){ ?>
                   <li>
                          <?php
                                       if($value['noibat']==1){
                                        ?>
                                         <div class="featured-text"><span></span></div>
                                        <?php }?>
                            <div class="">
                                <div class="left-block">
                                    <a title="<?= $value['tensanpham'] ?>" href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>" class="loading">
                                        <img class="img-responsive b-lazy" title="<?= $value['tensanpham'] ?>"  alt="<?= $value['tensanpham'] ?>" data-src="<?= URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['hinhdaidien'] ?>" />
                                    </a>
                                    <div class="quick-view">
                                            <a title="Yêu thích" data-id="<?= $value['id_sanpham'] ?>" class="heart yeuthich"   ></a>
                                    </div>
                                    <div class="add-to-cart">
                                       <?php if(kiemtranull($value['ngangon'])){ ?>
                                        <a> <?= neods($value['ngangon'],120)?></a>
                        <?php }else{} ?>
                                    </div>
                                    <?php
                                        if($value['giamgia']>0){
                                        ?>
                                    <div class="price-percent-reduction2">-<?=$value['giamgia']?>%<br>SAFE</div>
                                    <?php }?>
                                    <div class="group-price">
                                          <?php
                                        if($value['moi']==1){
                                        ?>
                                         <span class="product-new">New</span>
                                        <?php }?>                                          
                                      </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a title="<?= $value['tensanpham'] ?>" href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>"><?= $value['tensanpham'] ?></a>
                                
                                    </h5>
                                   
                                    <div class="content_price">
                                        <?php if($value['gia']!=$value['giamoi']){ ?>
                                        <span class="price product-price"><?= tien($value['giamoi'])?>&nbsp;₫</span>
                                        <span class="price old-price"><?= tien($value['gia']) ?></span>
                                        <?php }ELSE{ ?>
                                         <span class="price product-price"><?= tien($value['gia']) ?>&nbsp;₫</span>
                                        <?php } ?>
                                    </div>
                                   
                                </div>
                            </div>
                        </li>                 
                      
                                    
                <?php } ?>
                                </ul>
                            </div>
                 <?php $i++; }}?>
                 <!-- End tab 1 -->
                
             </div>
          </div>
            </div>
            <?php if(!empty($this->data['sanpham']['sanphamsapve'])){ ?>
            <div class="col-xs-12 col-sm-3 page-top-right">
                <div class="latest-deals">
                    <h2 class="latest-deal-title">Sản phẩm sắp về</h2>
                    <div class="latest-deal-content">
                        <ul class="product-list owl-carousel" data-dots="false" data-loop="false" data-nav = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":2},"1000":{"items":1}}'>
                           <?php foreach ($this->data['sanpham']['sanphamsapve'] as $value){ ?>
                            <li>
                                <div class="count-down-time" data-countdown="<?= $value['ngaytao'] ?>"></div>
                          <?php
                                       if($value['noibat']==1){
                                        ?>
                                         <div class="featured-text"><span></span></div>
                                        <?php }?>
                            <div class="">
                                <div class="left-block">
                                    <a href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>">
                                        <img class="img-responsive" alt="product" src="<?= URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['hinhdaidien'] ?>" />
                                    </a>
                                    <div class="quick-view">
                                            <a title="Yêu thích" data-id="<?= $value['id_sanpham'] ?>" class="heart yeuthich"   ></a>
                                    </div>
                                    <div class="add-to-cart">
                                       <?php if(kiemtranull($value['ngangon'])){ ?>
                                        <a> <?= neods($value['ngangon'],120)?></a>
                        <?php }else{} ?>
                                    </div>
                                    <?php
                                        if($value['giamgia']>0){
                                        ?>
                                    <div class="price-percent-reduction2">-<?=$value['giamgia']?>%<br>SAFE</div>
                                    <?php }?>
                                    <div class="group-price">
                                          <?php
                                        if($value['moi']==1){
                                        ?>
                                         <span class="product-new">New</span>
                                        <?php }?>                                          
                                      </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>"><?= $value['tensanpham'] ?></a>
                                
                                    </h5>
                                   
                                    <div class="content_price">
                                        <?php if($value['gia']!=$value['giamoi']){ ?>
                                        <span class="price product-price">$<?= tien($value['giamoi'])?>&nbsp;₫</span>
                                        <span class="price old-price"><?= tien($value['gia']) ?></span>
                                        <?php }ELSE{ ?>
                                         <span class="price product-price"><?= tien($value['gia']) ?>&nbsp;₫</span>
                                        <?php } ?>
                                    </div>
                                   
                                </div>
                            </div>
                        </li>      
                           <?php } ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<!-- END PAGE TOP. -->

<div class="content-page">
    <div class="container">
        <?php
        $cache=new \lib\Cache();
           $filecache="public/cache/view_".NGONNGU."_danhmucindex.html";  
        if($cache->kiemtra($filecache))
            echo $cache->getcacheview($filecache);
        else
        {
            ob_start();
        ?>
        <!-- featured category fashion -->
        <?php $i=0;$quangcao=4; foreach ($this->data['sanpham']['danhmuccapmot'] as $sanpham){ ?>
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-red show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-brand"><a  href="<?= URL ?>danh-muc/<?= $sanpham['thongtin']['id_danhmuc'] ?>/<?= $sanpham['thongtin']['slug'] ?>" >
<!--                          <img alt="fashion" src="assets/data/fashion.png" />-->
                          <?= $sanpham['thongtin']['ten'] ?></a></div>
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
               <?php $left=0;$item=5; if(isset($this->data['module']['quangcao']['data']['main'][$quangcao])){ ?>
               <div class="banner-featured">
<!--                    <div class="featured-text"><span>featured</span></div>-->
                    <div class="banner-img">
                        <a   ><img alt="Quang Cao" src="<?= $this->data['module']['quangcao']['data']['main'][$quangcao]["linkimage"] ?>" /></a>
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
                          <?php
                                       if($value['noibat']==1){
                                        ?>
                                         <div class="featured-text"><span></span></div>
                                        <?php }?>
                            <div class="">
                                <div class="left-block">
                                    <a title="<?= $value['tensanpham'] ?>" href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>" class="loading">
                                        <img class="img-responsive b-lazy" title="<?= $value['tensanpham'] ?>"  alt="<?= $value['tensanpham'] ?>" data-src="<?= URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['hinhdaidien'] ?>" />
                                    </a>
                                    <div class="quick-view">
                                            <a title="Yêu thích" data-id="<?= $value['id_sanpham'] ?>" class="heart yeuthich"   ></a>
                                    </div>
                                    <div class="add-to-cart">
                                       <?php if(kiemtranull($value['ngangon'])){ ?>
                                        <a> <?= neods($value['ngangon'],120)?></a>
                        <?php }else{} ?>
                                    </div>
                                    <?php
                                        if($value['giamgia']>0){
                                        ?>
                                    <div class="price-percent-reduction2">-<?=$value['giamgia']?>%<br>SAFE</div>
                                    <?php }?>
                                    <div class="group-price">
                                          <?php
                                        if($value['moi']==1){
                                        ?>
                                         <span class="product-new">New</span>
                                        <?php }?>                                          
                                      </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a title="<?= $value['tensanpham'] ?>" href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>"><?= $value['tensanpham'] ?></a>
                                
                                    </h5>
                                   
                                    <div class="content_price">
                                        <?php if($value['gia']!=$value['giamoi']){ ?>
                                        <span class="price product-price"><?= tien($value['giamoi'])?>&nbsp;₫</span>
                                        <span class="price old-price"><?= tien($value['gia']) ?></span>
                                        <?php }ELSE{ ?>
                                         <span class="price product-price"><?= tien($value['gia']) ?>&nbsp;₫</span>
                                        <?php } ?>
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

        <?php
        
        // cache
      $content = ob_get_contents(); 
    ob_end_clean(); 
    // Ghi cache file 
    $cache->putcacheview($filecache,$content);
    echo  $content;
    }
        
        ?>
        
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
