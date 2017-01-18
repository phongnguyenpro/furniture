<?php

$danhmuc = $this->data['category'];
$menu = $this->data['menu'];
$giohang = isset($_COOKIE['giohang']) == true ? unserialize($_COOKIE['giohang']) : array();
$yeuthich = isset($_COOKIE['yeuthich']) == true ? count(unserialize($_COOKIE['yeuthich'])) : "";
$taikhoan = isset($_COOKIE['taikhoan']) == true ? unserialize($_COOKIE['taikhoan']) : array();
define("URL_NOW", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$_SESSION['URL_NOW'] = URL_NOW;
if (!isset($_SESSION['token']))
    $_SESSION['token'] = generate_password(20);

//debug($this->data);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="content-language" content="vi">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->data['meta']['title'] ?></title>
    <meta name="description" content="<?= $this->data['meta']['description'] ?> ">
    <!-- Mạng xã hội -->
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?= $this->data['meta']['title'] ?>">
    <meta property="og:description" content="<?= $this->data['meta']['description'] ?>">
    <meta property="og:image" content="<?= $this->data['meta']['image'] ?>">
    <meta property="fb:app_id" content="416654985192230"/>
    <meta property="fb:admins" content="100005194575333"/>


    <link rel="stylesheet" type="text/css"
          href="<?= load_frontend_view("assets/lib/font-awesome/css/font-awesome.min.css") ?>"/>
    <link rel="stylesheet" type="text/css"
          href="<?= load_frontend_view("assets/lib/bootstrap/css/bootstrap.min.css"); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= load_frontend_view("assets/css/style.css"); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= load_frontend_view("assets/css/reset.css"); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?= load_frontend_view("assets/css/responsive.css"); ?>"/>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    
    <script type="text/javascript" src="<?= load_frontend_view("assets/lib/jquery/jquery-1.11.2.min.js"); ?>"></script>
    <script type="text/javascript" src="<?= BASE_URL . "public/js/function.js"; ?>"></script>
    <!-- Trình chiếu -->
    <script type="text/javascript" src="<?= load_frontend_view("assets/js/jquery.actual.min.js"); ?>"></script>
    <script type="text/javascript" src="<?= BASE_URL . "public/js/lazyload.js" ?> "></script>
    <script type="text/javascript" src="<?= load_frontend_view("assets/js/theme-script.js"); ?>"></script>


    <?php echo "<script >token='" . $_SESSION['token'] . "'</script>"; ?>
    <style>
        .left-block img {
            width: <?= WIDTHTHUMB ?>px;
        }
    </style>
    <script>
        ADMIN_URL = "<?= ADMIN_URL ?>";
        BASE_URL = "<?= BASE_URL ?>";
    </script>
</head>
<body class=" <?= isset($this->data['home']) == true ? "home" : "product-info" ?>" style="">
<!-- HEADER -->
<div id="header" class="header">
    <div class="top-header">
        <div class="container">
            <div class="nav-top-links">
                <a class="first-item"> <i class="fa fa-phone"></i> <?= SDT ?></a>
                <a> <i class="fa fa-envelope" aria-hidden="true"></i> <?= EMAIL ?></a>


            </div>


            <div id="user-info-top" class="user-info pull-right">
                <?php if (check_login_user(array(1, 2, 3, 4))) { ?>
                    <div class="dropdown drdtaikhoan">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                           href="#">
                            <span><?= $taikhoan['emaildangnhap'] ?></span>
                            <span class="glyphicon glyphicon-menu-down"></span></a>
                        <ul class="dropdown-menu mega_dropdown" role="menu">
                            <li><a href="<?= BASE_URL ?>login/logout">Đăng xuất</a></li>
                            <li><a href="<?= BASE_URL ?>taikhoan/edit">Quản lý tài khoản</a></li>

                        </ul>
                    </div>
                <?php } ?>
                <a href="<?= BASE_URL ?>yeu-thich" class="sanphamyeuthich">Yêu thích <i
                        class="fa fa-heart"></i><span><?= $yeuthich ?></span></a>

            </div>
        </div>
    </div>
</div>
<!--/.top-header -->

<!-- MAIN HEADER -->
<div class="container main-header">
    <div class="row">
        <div class="col-xs-12 col-sm-2 logo">
            <a href="<?= BASE_URL ?>"><img alt="<?= TENSHOP ?>" src="<?= BASE_URL.LOGO ?>"/></a>
        </div>
        <div class="col-xs-10 col-sm-8 header-search-box">
            <form class="form-inline">
                <div class="form-group form-category">
                    <div class="select-category" id="selectdanhmuc" disabled="">
                        Tìm kiếm sản phẩm
                    </div>
                </div>
                <div class="form-group input-serach">
                    <input type="text" id="search-terms" placeholder="Tìm kiếm">

                </div>
                <button type="button" class="pull-right btnsearch"><i class="fa fa-search" id="search-icon"></i>
                </button>

                <div class="timkiem" id="ketquatim">
                    <ul class="ketquatim">

                    </ul>

                </div>
            </form>
        </div>
        <div id="cart-block" class="col-xs-2 col-sm-2 shopping-cart-box">
            <a class="cart-link" href="<?= BASE_URL . "checkout" ?>">
                <div class="info">
                <span class="title">Giỏ hàng</span><br>
                <span class="total"><?= $total = count($giohang) ?> sản phẩm</span>
                </div>
            </a>
            <div class="cart-block">

            </div>
        </div>
    </div>

</div>

<!-- END MANIN HEADER -->
<?php
function submenu($menu, $cha, $in)
{
    $html = '';
    if ($in == 1) {
        $html .= '<ul class="block-sub">';
    }
    foreach ($menu['parent'][$cha] as $value) {

        if (isset($menu['parent'][$value])) {


            $temp = $menu['item'][$value]['menu_slug'] == BASE_URL ? "" : "";
            $html .= '<li class="link_container li-sub ' . $temp . ' ">'
                . '<a href="' . $menu['item'][$value]['menu_slug'] . '">' . $menu['item'][$value]['menu_name'] . '</a>';
            $html .= submenu($menu, $value, 1);
            $html .= "</li>";
        } else {
            $temp = $menu['item'][$value]['menu_slug'] == BASE_URL ? "" : "";
            $html .= '<li class="link_container ' . $temp . '"><a href="' . $menu['item'][$value]['menu_slug'] . '">' . $menu['item'][$value]['menu_name'] . '</a>';
        }

    }

    if ($in == 1) {
        $html .= '</ul>';
    }
    return $html;
}

// IN DANH MUC SAN PHAM
function submenu_sanpham($danhmuc, $cha)
{
    $html = '';
    if (isset($danhmuc['parent'][$cha])) {
        $html .= "<ul class='sub-sanpham'>";
        foreach ($danhmuc['parent'][$cha] as $value) {
            $url = BASE_URL . "danh-muc/" . $danhmuc['item'][$value]['productcategory_slug']."-".$danhmuc['item'][$value]['productcategory_id'];
            $curren = BASE_URL == $url ? "" : "";
            $html .= "<li class='" . $curren . "'><a href='$url'>" . $danhmuc['item'][$value]['productcategory_name'] . "</a>";
            $html .= submenu_sanpham($danhmuc, $value);
            $html .= "</li>";

        }
        $html .= "</ul>";
    }
    return $html;
}

?>
<div id="nav-top-menu" class="nav-top-menu">
    <div class="container">
        <div class="row">

            <!-- BAT DAU CACHE DANH MUC SP -->
            <?php
            if (!$cache_category = cache_view_start("category")) {
                ?>
                <div class="col-sm-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus">
                        <h4 class="title">
                            <span class="title-menu"> <i class="fa fa-th-list" aria-hidden="true"></i> DANH MỤC SẢN PHẨM</span>
                            <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars" aria-hidden="true"></i></span>
                        </h4>
                        <div class="vertical-menu-content is-home">
                            <ul class="vertical-menu-list">

                                <?php

                                $quangcao = 1;
                                $item = 0;
                                if (isset($danhmuc['parent'][0])) {
                                    foreach ($danhmuc['parent'][0] as $value) {
                                        ?>
                                        <?php if (isset($danhmuc['parent'][$value]) || isset($this->data['module']['quangcao']['data']['menu'][$quangcao]) || isset($this->data['module']['html']['data']['menu'][$quangcao])) {
                                                 $url = BASE_URL . "danh-muc/" . $danhmuc['item'][$value]['productcategory_slug']."-".$danhmuc['item'][$value]['productcategory_id'];
                                            ?>
                                            <li class="<?= $item > 10 ? "cat-link-orther" : "" ?> <?= BASE_URL == $url ? "menuactive" : "" ?>">
                                                <a class="parent" href="<?= $url ?>">
                                                    <?php if ($danhmuc['item'][$value]['productcategory_icon'] != '') { ?>
                                                        <img
                                                            src="<?= $danhmuc['item'][$value]['productcategory_icon'] ?>"> <?php } ?>
                                                    <?= $danhmuc['item'][$value]['productcategory_name'] ?>
                                                </a>


                                                <div class="vertical-dropdown-menu">
                                                    <div class="vertical-groups  col-sm-12">
                                                        <?php if (isset($danhmuc['parent'][$value])) { ?>
                                                            <?php $i = 0;
                                                            foreach ($danhmuc['parent'][$value] as $value1) {

                                                                      $url = BASE_URL . "danh-muc/" . $danhmuc['item'][$value]['productcategory_slug']."-".$danhmuc['item'][$value]['productcategory_id'];

                                                                $i++; ?>
                                                                <div class="mega-group col-sm-4">
                                                                    <h4 class="mega-group-header"><span><b
                                                                                class="<?= BASE_URL == $url ? "" : "" ?>"><a
                                                                                    href="<?= $url ?>"><?= $danhmuc['item'][$value1]['productcategory_name'] ?></a></b></span>
                                                                    </h4>
                                                                    <?php if (isset($danhmuc['parent'][$value1])) { ?>

                                                                        <ul class="group-link-default">
                                                                            <?php foreach ($danhmuc['parent'][$value1] as $value2) {
                                                                                     $url = BASE_URL . "danh-muc/" . $danhmuc['item'][$value]['productcategory_slug']."-".$danhmuc['item'][$value]['productcategory_id'];
                                                                                ?>

                                                                                <li class="<?= BASE_URL == $url ? "" : "" ?>">
                                                                                    <a href="<?= $url ?>"><?= $danhmuc['item'][$value2]['productcategory_name'] ?></a>

                                                                                    <?= submenu_sanpham($danhmuc, $value2) ?>

                                                                                </li>

                                                                            <?php } ?>

                                                                        </ul>


                                                                    <?php } ?>

                                                                </div>
                                                                <?php if ($i == 3) {
                                                                    echo "<div class='clearfix'></div>";
                                                                    $i = 0;
                                                                } ?>
                                                            <?php }
                                                        } ?>


                                                        <div class=" col-sm-12 quangcaomenu " style="height: 100%">
                                                            <?php
                                                            if (isset($this->data['module']['quangcao']['data']['menu'][$quangcao])) {
                                                                ?>
                                                                <a id="itemquangcao"
                                                                   href="<?= $this->data['module']['quangcao']['data']['menu'][$quangcao]["linkurl"] ?>"><img
                                                                        src="<?= $this->data['module']['quangcao']['data']['menu'][$quangcao]["linkimage"] ?>"
                                                                        alt="Banner"></a>
                                                            <?php } ?>
                                                            <?php if (isset($this->data['module']['html']['data']['menu'][$quangcao])) { ?>
                                                                <div
                                                                    class="htmlmenu "><?= $this->data['module']['html']['data']['menu'][$quangcao]['noidung'] ?></div>
                                                            <?php } ?>
                                                        </div>
                                                        <?php unset($this->data['module']['quangcao']['data']['menu'][$quangcao]); ?>

                                                    </div>
                                                </div>
                                            </li>
                                        <?php } else {
                                                       $url = BASE_URL . "danh-muc/" . $danhmuc['item'][$value]['productcategory_slug']."-".$danhmuc['item'][$value]['productcategory_id'];
                                            ?>
                                            <li class="<?= $item > 10 ? "cat-link-orther" : "" ?> <?= BASE_URL == $url ? "" : "" ?>">
                                                <a href="<?= $url ?>">
                                                    <?php if ($danhmuc['item'][$value]['productcategory_icon'] != '') { ?>
                                                        <img
                                                            src="<?= $danhmuc['item'][$value]['productcategory_icon'] ?>"> <?php } ?>
                                                    <?= $danhmuc['item'][$value]['productcategory_name'] ?></a></li>
                                        <?php } ?>


                                        <?php $quangcao++;
                                        $item++;
                                    }
                                } ?>


                            </ul>
                            <?php if ($item > 11) { ?>
                                <div class="all-category"><span class="open-cate">Xem tất cả</span></div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

                <?php
                cache_view_end("category");
            } else
                echo $cache_category;
            ?>

            <!-- IN MENU -->
            <div id="main-menu" class="col-sm-9 main-menu">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="#">MENU</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <?php

                                if (isset($menu['parent'][0]))
                                    foreach ($menu['parent'][0] as $value) {

                                        if ($menu['item'][$value]['menu_format'] == "productcat") {
                                            ?>
                                            <li class="dropdown">
                                                <a class="dropdown-toggle"><?= $menu['item'][$value]['menu_name'] ?></a>
                                                <ul class="mega_dropdown dropdown-menu"
                                                    style="width: 830px; left: 36px;">


                                                    <?php
                                                    $i = 0;
                                                    foreach ($danhmuc['parent'][0] as $value) {
                                                           $url = BASE_URL . "danh-muc/" . $danhmuc['item'][$value]['productcategory_slug']."-".$danhmuc['item'][$value]['productcategory_id'];
                                                        $i++;
                                                        ?>

                                                        <li class="block-container col-sm-3 menudanhmuc">
                                                            <ul class="block">
                                                                <li class="link_container group_header">
                                                                    <?php if ($danhmuc['item'][$value]['productcategory_icon'] != '') { ?>
                                                                        <img
                                                                            src="<?= $danhmuc['item'][$value]['productcategory_icon'] ?>"> <?php } ?>
                                                                    <a href="<?= $url ?>"><?= $danhmuc['item'][$value]['productcategory_name'] ?></a>
                                                                </li>


                                                                <?php if (isset($danhmuc['parent'][$value])) { ?>


                                                                    <?php foreach ($danhmuc['parent'][$value] as $value1) {
                                                                             $url = BASE_URL . "danh-muc/" . $danhmuc['item'][$value]['productcategory_slug']."-".$danhmuc['item'][$value]['productcategory_id'];
                                                                        ?>
                                                                        <li class="link_container danhmuccap2">
                                                                            <a href="<?= $url ?>"><?= $danhmuc['item'][$value1]['productcategory_name'] ?></a>
                                                                            <?= submenu_sanpham($danhmuc, $value1) ?>

                                                                        </li>


                                                                    <?php }
                                                                } ?>


                                                            </ul>
                                                        </li>
                                                        <?php if ($i == 4) {
                                                            echo "<div class='clearfix'></div>";
                                                            $i = 0;
                                                        } ?>

                                                    <?php } ?>
                                                    <div class='clearfix'></div>
                                                    ;
                                                    <!--                     <li class="block-container col-sm-12">
                                                                                                    <ul class="block">
                                                                                                        <li class="img_container">
                                                                                                            <img src="http://localhost/OOP/view/theme2/assets/data/banner-megamenu.jpg" alt="Banner">
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </li>                 -->


                                                </ul>
                                            </li>
                                        <?php } else { ?>

                                            <?php
                                            if (isset($menu['parent'][$value])) {
                                                ?>

                                                <li class="dropdown  ">
                                                    <a href="<?= $menu['item'][$value]['menu_slug'] ?>"
                                                       class="dropdown-toggle"
                                                       data-toggle="dropdown"><?= $menu['item'][$value]['menu_name'] ?></a>
                                                    <ul class="dropdown-menu container-fluid">
                                                        <li class="block-container">
                                                            <ul class="block">
                                                                <!--                                                    in con-->

                                                                <?= submenu($menu, $value, 0) ?>

                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            <?php } else {
                                                ?>
                                                <li class="">
                                                    <a href="<?= $menu['item'][$value]['menu_slug'] ?>"><?= $menu['item'][$value]['menu_name'] ?></a>
                                                </li>
                                            <?php }
                                        }
                                    } ?>


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
            <a href="<?= BASE_URL ?>sanpham/checkout"><i class="fa fa-shopping-cart"></i></a>
            <div class="shopping-cart-box-ontop-content"></div>
        </div>
    </div>
</div>

<!-- end header -->


<?php if (!isset($this->data["home"])) { ?>
<div class="columns-container">
    <div class="container" id="columns">

        <div class="breadcrumb clearfix">
            <span class="home navigation_page"  title="Return to Home">
           <a href="<?= BASE_URL ?>"> Home</a>
            </span>
            <?php
            for ($i = count($this->data["bre"]['info']) - 1; $i >= 0; $i--) {
                ?>
                <span class="navigation_page">
                 <a
                     <?php if (isset($this->data['bre']['info'][$i]['slug'])) { ?>
                         href="<?= $this->data['bre']['info'][$i]['slug'] ?>"
                     <?php } ?>
                 >
   <?= $this->data['bre']['info'][$i]['ten'] ?>
                 </a>
             </span>
            <?php } ?>
        </div>
<?php } ?>