<script type="text/javascript" src="<?= load_frontend_view("assets/lib/jquery.bxslider/jquery.bxslider.min.js")?>"/></script> <!-- Trình chiếu -->
<link rel="stylesheet" type="text/css" href="<?= load_frontend_view("assets/lib/jquery.bxslider/jquery.bxslider.css")?>" />

<!-- Home slideder-->
<div id="home-slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 slider-left"></div>
            <div class="col-sm-9 header-top-right">
                <div class="homeslider">
                  <div class="content-slide" style="height: 450px;overflow: hidden">
                        <ul id="slide-background" >
                            <?php foreach ($this->data['module']['slider']["main"][1]['data']  as $value){?>
                              <li data-background="">
                              <a href="<?= $value['module_link'] ?>">
                                <img alt="Funky roots" src="<?= $value['module_image'] ?>" title="<?= $this->data['module']['slider']["main"][1]["name"] ?>" />
                              </a>
                              </li>  
                              
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="header-banner banner-opacity">
                    <ul>        
                 <?php if(isset($this->data['module']['banner']['main'][2]["data"])){ 
                        foreach ($this->data['module']['banner']['main'][2]["data"]  as $value){
                     ?>
                        <li><a href=""><img alt="Funky roots" src="<?= $value['module_image'] ?>" /></a></li>

                            <?php } ?>
                 <?php }?>
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




