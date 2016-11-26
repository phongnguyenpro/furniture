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
            </div>
        </div>
    </div>
</div>
<!-- END Home slideder-->
