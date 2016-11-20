


<!-- Footer -->


<footer id="footer">
     <div class="container">
            <!-- introduce-box -->
            <div id="introduce-box" class="row">
                <div class="col-md-3">
                    <div id="address-box">
                        <a ><img src="<?= LOGO ?>" alt="" /></a>
                        <div id="address-list">
                            <div class="tit-name">Địa chỉ:</div>
                            <div class="tit-contain"><?=  DIACHI ?></div>
                            <div class="tit-name">Phone:</div>
                            <div class="tit-contain"><?=  SDT ?></div>
                            <div class="tit-name">Email:</div>
                            <div class="tit-contain"><?= EMAIL ?></div>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="row">
                     
                        <?php 
                        $cache=new lib\Cache();
                        $filecache="public/cache/view_".NGONNGU."_footer.html";
                       if($cache->kiemtra($filecache))
                        {
                            echo $cache->getcacheview($filecache);
                        }
                        else
                        {
                            ob_start();
                        if(isset($this->data['footer']['parent'][0]))
                        {
                        foreach ($this->data['footer']['parent'][0] as $value){ ?>
                         <div class="col-sm-4">
                            <div class="introduce-title"><?= $this->data['footer']['item'][$value]['ten'] ?></div>
                            <ul id="introduce-company"  class="introduce-list">
                         <?php 
                        if(isset($this->data['footer']['parent'][$value]))
                        {
                        foreach ($this->data['footer']['parent'][$value] as $value2){ ?>
                                <li><a ><?= $this->data['footer']['item'][$value2]['ten'] ?></a></li>
                              
                                    <?php } }?>
                            </ul>
                        </div>
                        <?php } } 
                        $conten=  ob_get_contents();
                        ob_end_clean();
                        echo $conten;
                        $cache->putcacheview($filecache,$conten);
                        
                        }?>
                       
                   
                    </div>
                </div>
                <div class="col-md-3">
                    <div id="contact-box">
                        <?php if(isset($this->data['module']['html']['data']['footer'])){ 
     foreach ($this->data['module']['html']['data']['footer'] as $k=>$v){
                            ?>
                        <div class="introduce-title"><?= $v['tieude'] ?></div>
                        <div class="input-group" id="mail-box">
                         <?= $v['noidung'] ?>
                        </div><!-- /input-group -->
                        <?php }}?>                       
                    </div>
                    
                </div>
            </div><!-- /#introduce-box -->
        
            <!-- #trademark-box -->
            <div id="trademark-box" class="row">
                <div class="col-sm-12">
                    <ul id="trademark-list">
                        <li id="payment-methods">Hình thức thanh toán</li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-ups.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-qiwi.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-wu.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-cn.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-visa.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-mc.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-ems.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-dhl.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-fe.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a ><img src="<?= URL."view/".THEME ?>/assets/data/trademark-wm.jpg"  alt="ups"/></a>
                        </li>
                    </ul> 
                </div>
            </div> <!-- /#trademark-box -->
            
          
      
        </div> 
</footer>
<div class="dangload">
   
            <div class="boxdangload">
                <p> Vui lòng đợi! </p><br>
          
           <div class="load">
        <div class="loading-bar"></div>
        <div class="loading-bar"></div>
        <div class="loading-bar"></div>
        <div class="loading-bar"></div>
        </div> 
            </div>
            
</div>
<a  class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>

    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/jquery.bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/css/responsive.css" />
    <link rel="stylesheet" href="<?= URL ?>lib/public/css/style.css">
<!-- Script-->

  <!-- lib -->
    <script type="text/javascript" src="<?= URL ?>lib/public/lib/validate/jquery.validate.js"></script> 
    <script type="text/javascript" src="<?= URL ?>lib/public/lib/login/dangnhap_dangky.js"></script> 
    <script type="text/javascript" src="<?= URL ?>lib/public/js/like.js"></script> 
    <script type="text/javascript" src="<?= URL ?>lib/public/lib/login/mangxahoi.js"></script> 
   <!-- end lib -->
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/select2/js/select2.min.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script> <!-- Trình chiếu -->
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/owl.carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/js/jquery.actual.min.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/jquery.countdown/jquery.countdown.min.js"></script>  <!-- Thời gian -->


<script type="text/javascript" src="<?= URL ?>lib/public/js/lazyload.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/sanpham/js/giohang.js"></script>
<script type="text/javascript" src="<?= URL ?>lib/public/lib/ticker/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?= URL ?>lib/public/lib/ticker/js/jquery.easy-ticker.js"></script>
<script type="text/javascript" src="<?= URL ?>lib/public/js/ngonngu.js"></script>
<script type="text/javascript" src="<?= URL ?>lib/public/lib/soanthao/soanthao.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/js/footer.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/js/theme-script.js"></script>

<!-- lib -->
<script type="text/javascript" src="<?= URL ?>lib/public/lib/soanthao/soanthao.js"></script>
<link rel="stylesheet" type="text/css" href="<?= URL ?>lib/public/lib/soanthao/soanthao.css" />
</body>


<!-- Mirrored from kutethemes.com/demo/kuteshop/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Aug 2015 18:12:22 GMT -->
</html>