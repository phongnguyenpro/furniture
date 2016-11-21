<?php 
$danhmuc=$this->data['danhmucsanpham'];
$menu=$this->data['menu'];
$giohang= isset($_COOKIE['giohang'])==true?unserialize($_COOKIE['giohang']):array();
$yeuthich= isset($_COOKIE['yeuthich'])==true?count(unserialize($_COOKIE['yeuthich'])):"";
$taikhoan=isset($_COOKIE['taikhoan'])==true?unserialize($_COOKIE['taikhoan']):array();
?>
<!DOCTYPE html>
<html>

<head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-language" content="vi">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <title><?= $this->data['meta']['title'] ?></title>
         <meta name="description" content="<?=$this->data['meta']['mieuta'] ?> ">
         <!-- Mạng xã hội -->
  <meta property="og:type" content="website" />
 <meta property="og:title" content="<?= $this->data['meta']['title'] ?>" >
 <meta property="og:description"  content="<?= $this->data['meta']['mieuta'] ?>" >
 <meta property="og:image" content="<?= $this->data['meta']['image'] ?>" >
 <meta property="fb:app_id" content="416654985192230" />     
 <meta property="fb:admins" content="100005194575333" /> 
    
    
    
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/jquery.bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/fancyBox/jquery.fancybox.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/css/responsive.css" />
    
    
    <link href="<?= URL ?>lib/public/lib/icheck/skins/flat/red.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL ?>lib/public/css/style.css">
    
    <script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/jquery/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="<?= URL ?>lib/public/js/config.js"></script>
    <script type="text/javascript" src="<?= URL ?>lib/public/js/function.js"></script>
    <!-- lib -->
    <script type="text/javascript" src="<?= URL ?>lib/public/lib/validate/jquery.validate.js"></script> 
    <script type="text/javascript" src="<?= URL ?>lib/public/lib/login/dangnhap_dangky.js"></script> 
    <script type="text/javascript" src="<?= URL ?>lib/public/lib/icheck/js/icheck.min.js"></script> 
    <script type="text/javascript" src="<?= URL ?>lib/public/js/like.js"></script> 
    <script type="text/javascript" src="<?= URL ?>lib/public/lib/login/mangxahoi.js"></script> 
    
    <!-- end lib -->
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/select2/js/select2.min.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script> <!-- Trình chiếu -->
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/owl.carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/jquery.countdown/jquery.countdown.min.js"></script>  <!-- Thời gian -->
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/fancyBox/jquery.fancybox.js"></script> <!-- Xem hinh -->
<?php echo "<script >token='".$_SESSION['token']."'</script>";  ?>
<script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/js/jquery.actual.min.js"></script>


</head>
<body class=" <?= isset($this->data['home'])==true?"home":"product-info" ?>" style="">
    
    <!-- HEADER -->
<div id="header" class="header">
    <div class="top-header">
        <div class="container">
            <div class="nav-top-links">
                <a class="first-item" ><img alt="phone" src="<?= URL."view/".THEME ?>/assets/images/phone.png" /><?= SDT ?></a>
                <a ><img alt="email" src="<?= URL."view/".THEME ?>/assets/images/email.png" /><?= EMAIL ?></a>
       
                     
            </div>
           

            <div id="user-info-top" class="user-info pull-right">
                   <?php if(kiemtradangnhapuser(array(1,2,3,4))) {?>
                <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?= $taikhoan['emaildangnhap'] ?>
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
   <li><a href="<?= URL ?>taikhoan/edit">Quản lý tài khoản</a></li>
  <li><a href="<?= URL ?>login/logout">Đăng xuất</a></li>
  </ul>
</div>
                   <?php }else{ ?>
                   <a href="" class="current-open"  data-toggle="modal" data-target="#modal_dk_dn"><span>Đăng nhập</span></a>                 
                   <?php } ?>
                   <a  href="<?= URL ?>sanpham/yeuthich" class="sanphamyeuthich" >Yêu thích  <i class="fa fa-heart"></i><span><?= $yeuthich ?></span></a>
                  
            </div>
        </div>
    </div>
</div>
    <!--/.top-header -->
    
    <!-- MAIN HEADER -->
    <div class="container main-header">
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo">
                <a href="<?= URL ?>"><img alt="<?= TENSHOP ?>" src="<?= LOGO ?>" /></a>
            </div>
            <div class="col-xs-7 col-sm-7 header-search-box">
                <form class="form-inline">
                      <div class="form-group form-category">
                          <select class="select-category" id="selectdanhmuc">
                              <option value="-1">Tất cả</option>
                         <?php  foreach ($danhmuc['parent'][0] as $value) {?>
                          
                            <option value="<?=  $danhmuc['item'][$value]['id_danhmuc'] ?>"><?=  $danhmuc['item'][$value]['ten'] ?></option>
                            
                         <?php } ?>
                        </select>
                      </div>
                      <div class="form-group input-serach">
                          <input type="text" id="search-terms"  placeholder="Tên sản phẩm, mã, giá...">
                        
                      </div>
                    <button type="button" class="pull-right btnsearch"><i class="fa fa-search" id="search-icon"></i></button>
                      
                      <div class="timkiem" id="ketquatim">
                          <ul class="ketquatim" >
       
                            </ul>
                            
                        </div>
                </form>
            </div>
            <div id="cart-block" class="col-xs-5 col-sm-2 shopping-cart-box">
                <a class="cart-link" href="<?=URL."sanpham/checkout" ?>">
                    <span class="title">Giỏ hàng</span>
                    <span class="total"><?= $total= count($giohang)?> Sản phẩm</span>
                    <span class="notify notify-left "><?= $total ?></span>
                </a>
                  <div class="cart-block">
                
                 </div>
            </div>
        </div>
        
    </div>
    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus">
                        <h4 class="title">
                            <span class="title-menu">Danh mục sản phẩm</span>
                            <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars"></i></span>
                        </h4>
                    <div class="vertical-menu-content is-home">
                        <ul class="vertical-menu-list">
                           
                           <?php 
                                  function submenu($menu,$cha,$in)
                      {
                          $html='';
                          if($in==1)
                                {
                                     $html.='<ul class="block-sub">';
                                }
                            foreach ($menu['parent'][$cha] as $value)
                            {
                                
                                  if(isset($menu['parent'][$value]))
                                  {
                                  
                                     
                                   $temp=$menu['item'][$value]['slug']==1?"menuactive":""; 
                                  $html.='<li class="link_container li-sub '.$temp.' ">'
                                          . '<a href="'.$menu['item'][$value]['slug'].'">'.$menu['item'][$value]['ten'].'</a>';
                                  $html.=submenu($menu,$value,1);
                                  $html.="</li>";
                                  }
                                  else
                                  {
                                      $temp=$menu['item'][$value]['slug']==1?"menuactive":""; 
                                $html.='<li class="link_container '.$temp.'"><a href="'.$menu['item'][$value]['slug'].'">'.$menu['item'][$value]['ten'].'</a>';
                                  }   
                                
                                  }
                                           
                               if($in==1)
                                {
                                     $html.='</ul>';
                                }
                            return $html;
                        }
                        // IN DANH MUC SAN PHAM
                         function submenu_sanpham($danhmuc,$cha)
                      {
                             $html='';
                             if(isset($danhmuc['parent'][$cha]))
                             {
                                    $html.="<ul class='sub-sanpham'>";
                             foreach ($danhmuc['parent'][$cha] as $value)
                             {
                           $url=URL."danh-muc/".$danhmuc['item'][$value]['id_danhmuc']."/".$danhmuc['item'][$value]['slug'];
                            $curren=1==$url?"menuactivesub":"";
                                $html.="<li class='".$curren."'><a href='$url'>".$danhmuc['item'][$value]['ten']."</a>";
                                $html.=submenu_sanpham($danhmuc,$value);
                                $html.="</li>";
                                
                             }
                              $html.="</ul>";
                             }
                             return $html;
                      }
                
$quangcao=1;$item=0; 
if(isset($danhmuc['parent'][0]))
{
foreach ($danhmuc['parent'][0] as $value)
 {
                           ?>
                <?php if(isset($danhmuc['parent'][$value])){
                           $url=URL."danh-muc/".$danhmuc['item'][$value]['id_danhmuc']."/".$danhmuc['item'][$value]['slug'];

                    ?>            
                            <li class=" <?= $item>10?"cat-link-orther":"" ?> <?= 1==$url?"menuactive":"" ?>">       
                         <a class="parent" href="<?= $url ?>">
                <?php if($danhmuc['item'][$value]['icon']!=''){ ?>   <img   src="<?= $danhmuc['item'][$value]['icon'] ?>"> <?php }?>
     <?= $danhmuc['item'][$value]['ten'] ?>
                         </a>
                   
                        
        <div class="vertical-dropdown-menu">
            <div class="vertical-groups  col-sm-12">
                <?php  $i=0; foreach ($danhmuc['parent'][$value] as $value1) {
                    
                           $url=URL."danh-muc/".$danhmuc['item'][$value1]['id_danhmuc']."/".$danhmuc['item'][$value1]['slug'];
                    
                    $i++;?>
                 <div class="mega-group col-sm-4">
                     <h4 class="mega-group-header"><span><b class="<?= 1==$url?"menuactivesub":"" ?>"><a href="<?= $url ?>"><?= $danhmuc['item'][$value1]['ten'] ?></a></b></span></h4>
                        <?php if(isset($danhmuc['parent'][$value1])){ ?>
                     
                     <ul class="group-link-default">
                          <?php  foreach ($danhmuc['parent'][$value1] as $value2) {
                           $url=URL."danh-muc/".$danhmuc['item'][$value2]['id_danhmuc']."/".$danhmuc['item'][$value2]['slug'];
                              ?>
                         
                         <li class="<?= 1==$url?"menuactivesub":"" ?>"><a href="<?= $url ?>" ><?= $danhmuc['item'][$value2]['ten'] ?></a>
                          
                            <?= submenu_sanpham($danhmuc,$value2) ?>
                          
                          </li>
                         
                         <?php } ?>
                         
                     </ul>
                     
                     
                         <?php } ?>
                    
                 </div>
                 <?php if($i==3){ echo "<div class='clearfix'></div>" ; $i=0;}?>
                <?php }?>
               
                <?php 
                if(isset($this->data['quangcao'][1][$quangcao]))
                {
                    
                ?>
                <div class=" col-sm-12 quangcaomenu ">
                     <a href="<?= $this->data['quangcao'][1][$quangcao]["linkurl"] ?>" ><img src="<?= $this->data['quangcao'][1][$quangcao]["linkimage"] ?>" alt="Banner"></a>
                 </div>
                <?php }?>
                 
            </div>
        </div>
        </li>
                   <?php } else{
                           $url=URL."danh-muc/".$danhmuc['item'][$value]['id_danhmuc']."/".$danhmuc['item'][$value]['slug'];
                       ?>
        <li class="<?= $item>10?"cat-link-orther":"" ?> <?= 1==$url?"menuactive":"" ?>" ><a href="<?= $url ?>">
                     <?php if($danhmuc['item'][$value]['icon']!=''){ ?>   <img   src="<?= $danhmuc['item'][$value]['icon'] ?>"> <?php }?>
                <i class="<?= $danhmuc['item'][$value]['icon'] ?>"></i> <?= $danhmuc['item'][$value]['ten'] ?></a></li>
                   <?php } ?>
                     
                     
<?php $quangcao++;$item++; }} ?>
                            
                           
                           
                        </ul>
                        <?php if($item>11){ ?>
<div class="all-category"><span class="open-cate">Xem tất cả</span></div>
                        <?php }?>

                    </div>
                </div>
                </div>
                <div id="main-menu" class="col-sm-9 main-menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                  <?php 

                                  
 foreach ($menu['parent'][0] as $value)
 {
    
     if($menu['item'][$value]['type']==2)
     {
                                  ?>  
      <li class="dropdown">
                     <a  class="dropdown-toggle"><?= $menu['item'][$value]['ten'] ?></a>
                 <ul class="mega_dropdown dropdown-menu" style="width: 830px; left: 36px;">
                           
                                              
                                                 <?php 
                                                 $i=0;    
                                                  foreach ($danhmuc['parent'][0] as $value)
 {
                           $url=URL."danh-muc/".$danhmuc['item'][$value]['id_danhmuc']."/".$danhmuc['item'][$value]['slug'];
                                                      $i++;
                           ?>
                     
                      <li class="block-container col-sm-3 menudanhmuc">
                                                <ul class="block">
  <li class="link_container group_header">
        <?php if($danhmuc['item'][$value]['icon']!=''){ ?>   <img   src="<?= $danhmuc['item'][$value]['icon'] ?>"> <?php }?>
                                                        <a href="<?= $url ?>"><?= $danhmuc['item'][$value]['ten'] ?></a>
                                                   </li>   
                                                    
                                           
                                                         <?php if(isset($danhmuc['parent'][$value])){ ?>
                     
                    
                          <?php foreach ($danhmuc['parent'][$value] as $value1) {
                           $url=URL."danh-muc/".$danhmuc['item'][$value1]['id_danhmuc']."/".$danhmuc['item'][$value1]['slug'];
                              ?>
                                         <li class="link_container danhmuccap2">
                                             <a href="<?= $url ?>"><?= $danhmuc['item'][$value1]['ten'] ?></a>
                                           <?= submenu_sanpham($danhmuc,$value1) ?>
                                                        
                                         </li>
                                                    
                                                    
                                                         <?php }}?>
                                                        
                                          
                                
                                                </ul>
                                            </li>  
                                            <?php if($i==4){ echo "<div class='clearfix'></div>" ; $i=0;}?>
                                            
 <?php }?>
                          <div class='clearfix'></div>;                                     
<!--                     <li class="block-container col-sm-12">
                                                <ul class="block">
                                                    <li class="img_container">
                                                        <img src="http://localhost/OOP/view/theme2/assets/data/banner-megamenu.jpg" alt="Banner">
                                                    </li>
                                                </ul>
                                            </li>                 -->
                                             
                                            
                                         

                                        </ul>
                                    </li>
     <?php } else{?>
                                    
         <?php 
         if(isset($menu['parent'][$value]))
         {         
         ?>
                                    
                                        <li class="dropdown <?= $menu['item'][$value]['slug']==1?"active":""  ?>  ">
                                        <a href="<?=$menu['item'][$value]['slug'] ?>" class="dropdown-toggle" data-toggle="dropdown"><?= $menu['item'][$value]['ten'] ?></a>
                                        <ul class="dropdown-menu container-fluid">
                                            <li class="block-container">
                                                <ul class="block">
<!--                                                    in con-->

<?= submenu($menu,$value,0) ?>
<!--                                                    <li class="link_container li-sub"><a href="#">Mobile</a>
                                                        <ul class="block-sub">
                                                              <li class="link_container"><a href="#">Tablets1</a></li>
                                                           <li class="link_container li-sub"><a href="#">Tablets2</a>
                                                               <ul class="block-sub">
                                                                      <li class="link_container"><a href="#">Tablets2.1</a></li>
                                                                       <li class="link_container"><a href="#">Tablets2.2</a></li>
                                                               </ul>
                                                           
                                                           </li>
                                                           <li class="link_container"><a href="#">Tablets3</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="link_container"><a href="#">Tablets</a></li>
                                                    <li class="link_container"><a href="#">Laptop</a></li>
                                                    <li class="link_container"><a href="#">Memory Cards</a></li>
                                                    <li class="link_container"><a href="#">Accessories</a></li>-->
                                                </ul>
                                            </li>
                                        </ul> 
                                    </li>                          
         <?php }else{?>
          <li class="<?= $menu['item'][$value]['slug']==1?"active":""  ?>">
             <a href="<?=$menu['item'][$value]['slug'] ?>" ><?= $menu['item'][$value]['ten'] ?></a>
               </li>   
 <?php }}} ?>

                                  
                       
                                   
                                    
                                    
                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
            </div>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <!-- userinfo on top-->
            <div id="user-info-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <a href="<?= URL ?>sanpham/checkout"><i class="fa fa-shopping-cart"></i></a>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>
    
<!-- end header -->

 <?php if(!kiemtradangnhapuser(array(1,2,3,4))){ ?>

  <!-- Modal thông báo -->
   <div class="modal fade " id="modal_dk_dn" role="dialog">
    <div  class="modal-dialog">   
      <div class="modal-content">
        <div class="modal-header">
            <a title="Đóng" > <button type="button" class="close" data-dismiss="modal" style="font-size: 30px">&times;</button></a>
          <h4 class="modal-title">ĐĂNG NHẬP TRƯỚC KHI ĐẶT HÀNG</h4>
          <small>Để nhận được nhiều ưu đãi hơn</small>
             
        </div>
        <div class="modal-body box-authentication">  
                       <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#home"><i class="glyphicon glyphicon-log-in"></i> ĐĂNG NHẬP</a></li>
    <li><a data-toggle="tab" href="#menu1"><i class="glyphicon glyphicon-plus"></i> ĐĂNG KÝ</a></li>
  </ul>
                        <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
<form id="frmdangnhap" action="dangnhapungvien.php" class="form-horizontal">
    <br>
    <div class="form-group">
    <label class="control-label col-sm-3" for="email">Email đăng nhập:</label>
    <div class="col-sm-7">
        <input name="email" required="" type="email" class="form-control" placeholder="Nhập email">
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="email">Mật khẩu:</label>
    <div class="col-sm-7">
        <input  minlength="3"  required="" name="pass" type="password" class="form-control" placeholder="Nhập mật khẩu">
    </div>
  </div>
    
          <div align="center">
              <div style="margin-top: 15px"> 
                  <button  class="button"  type="submit" id="btndangnhapungvien" >
           <i class="glyphicon glyphicon-log-in"></i> Đăng Nhập
                  </button></div>
          </div>
      </form>
        <hr>
        <div class="row">
             <div class="col-md-6 text-center">
 <div class="btn-group">
                    <a class="btn btn-danger disabled" style="height: 40px;
    opacity: 0.8;"><i class="fa fa-google-plus" style="width:16px; height:20px"></i></a>
                    <a class="btn btn-danger logingoogle" href="#" style="width:14em;height: 40px;">Đăng nhập với Google</a>
	</div>
           </div>
            
             <div class="col-md-6 text-center">
 <div class="btn-group">
                    <a class="btn btn-primary disabled" style="height: 40px;
    opacity: 0.8;"><i class="fa fa-google-plus" style="width:16px; height:20px"></i></a>
                    <a class="btn btn-primary loginfacebook" href="https://www.facebook.com/dialog/oauth?client_id=<?= ID_FB ?>&redirect_uri=<?= URL ?>login/facebook" style="width:14em;height: 40px;">Đăng nhập với Facebook</a>
	</div>
           </div>
        </div>
       
    </div>
    <div id="menu1" class="tab-pane fade">
        <br>
                       <form  method="post" class="form-horizontal" id="frmdangky">

               <div class="form-group  has-feedback ">
      <label class="col-sm-3 control-label" for="inputWarning">Email đăng nhập</label>
    <div class="col-sm-9">
        <input name="email"  type="email" required="" placeholder="Nhập địa chỉ Email của bạn"   class="form-control tendangnhap">
       
    </div>
  </div>
    <div class="form-group has-feedback ">
    <label class="col-sm-3 control-label">Mật khẩu</label>
    <div class="col-sm-9">
        <input  minlength="3"  required="" name="matkhau" type="text" class="form-control" placeholder="Nhập mật khẩu">
     
      <i></i>
    </div>
  </div>
               
           
               <div class="form-group  has-feedback thongtin">
    <label class="col-sm-3 control-label" for="inputWarning">Họ và tên:</label>
    <div class="col-sm-9">
        <input name="tentaikhoan" type="text" required="" class="form-control">
      <span class=" form-control-feedback"></span>
      <i></i>
    </div>
  </div>
           
               
        
               
               
           <div class="form-group  has-feedback thongtin">
    <label class="col-sm-3 control-label" for="inputWarning">Tuổi</label>
    <div class="col-sm-9">
       
   <input type="number" min="10" name="tuoi" class="required form-control" placeholder="Tuổi">
      <i></i>
    </div>
  </div>
  <div class="form-group  has-feedback thongtin">
    <label class="col-sm-3 control-label" for="inputWarning">Giới tính</label>
    <div class="col-sm-9" >
        <div class="icheck">
            <div class="itemicheck">
                <input checked=""  value="1" class="required" name="gioitinh" id="nam" type="radio">
                <label  class="view " for="nam">Nam<span class="button"></span></label>
            </div>
            <div class="itemicheck">
                <input class="required" value="2" name="gioitinh" id="nu" type="radio">
        <label class="view" for="nu">Nữ<span class="button"></span></label>
            </div>
        </div>
    </div>
  </div>                
                 <div class="form-group  has-feedback thongtin">
    <label class="col-sm-3 control-label" for="inputWarning">SDT:</label>
    <div class="col-sm-9">
        <input name="sdt" type="text" required="" class="form-control">
      <span class=" form-control-feedback"></span>
      <i></i>
    </div>
  </div>     
                                   <div class="form-group  has-feedback thongtin">
    <label class="col-sm-3 control-label" for="inputWarning">Địa chỉ:</label>
    <div class="col-sm-9">
        <input name="diachi" type="text" required="" class="form-control">
      <span class=" form-control-feedback"></span>
      <i></i>
    </div>
  </div>   
                           
                           <div align="center" id="ketquadangky"> 
                               <button  class="button " type="submit" id="btndangky" >
                               <i class="fa fa-user-plus"></i> Đăng Ký</button><br>
                               <div class="alert alert-danger thongbaodangky"></div>
                          </div> 
                       </form>
      
    </div>
                        </div>
            
        </div>
        <div class="modal-footer ">
            
           
          
        </div>
      </div>
      
   
      
    </div>
  </div>
 <?php }?>


        <?php if(!isset($this->data["home"])) {?>
    <div class="columns-container">
    <div class="container" id="columns">
         
        <div class="breadcrumb clearfix">
            <a class="home" href="<?= URL ?>" title="Return to Home">Home</a>
            <span class="navigation-pipe">&nbsp;</span>
            <?php 
            for($i=count($this->data["bre"]['info'])-1;$i>=0;$i--)
            {
            ?>
             <span class="navigation_page">
                 <a 
                     <?php if(isset($this->data['bre']['info'][$i]['slug'])){ ?>
                     href="<?= $this->data['bre']['info'][$i]['slug'] ?>"
                         <?php }?>
                     >             
   <?=$this->data['bre']['info'][$i]['ten'] ?>
                 </a>
             </span>
            <?php if($i>0){ ?> <span class="navigation-pipe">&nbsp;</span> <?php }?>
            <?php }?>
                </div>
        <?php }?>
  <div class="row">

      <div class="center_column col-xs-12 col-sm-12" id="center_column">
          <div class="alert alert-info text-center">
              Trang bạn yêu cầu không tồn tại! <br>
              
              <a href="<?= URL ?>"> <i class="fa fa-home"></i> GO HOME </a>
          </div>
          <div class="text-center">
      <a href="<?= URL ?>">    <img src="<?= URL ?>/public/upload/images/public/image/ja-wall-404.png"></a>
          </div>
      </div>
    
    
</div>  

</div>
</div>


