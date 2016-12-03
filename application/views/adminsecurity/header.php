<!doctype html>
<!--[if lte IE 9]>
<html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <title>Admin</title>
          <script>
            ADMIN_URL = "<?= ADMIN_URL ?>";
            BASE_URL = "<?= BASE_URL ?>";
        </script>
        <link rel="stylesheet" id="data-uikit-theme"  href="<?= load_admin_public("css/select2.min.css") ?>">
        <!-- uikit -->
        <link rel="stylesheet"  href="<?= load_admin_public("css/uikit.almost-flat.min.css") ?>" media="all">
        <!-- flag ions -->
        <link rel="stylesheet" href="<?= load_admin_public("assets/icons/flags/flags.min.css") ?>" media="all">
        <!-- altair admin -->
        <link rel="stylesheet" href="<?= load_admin_public("assets/css/main.min.css") ?>" media="all">
        <link rel="stylesheet" href="<?= load_admin_public("css/bootstrap.min.css") ?>" >
        <link rel="stylesheet" href="<?= load_admin_public("css/style.css") ?>" >

        <script src="<?= load_admin_public("js/jquery.js") ?>"></script>
        <script src="<?= load_admin_public("js/function.js") ?>"></script>
        <script src="<?= load_admin_public("js/select2.min.js") ?>"></script>
        <script src="<?= load_public("js/function.js") ?>"></script>
      
    </head>
    <body class="sidebar_main_open sidebar_main_swipe" style="background-color: #ECECEC">
        <?php
        if (!isset($this->curren))
            $this->curren = 0;
        ?>

        <div class="thongbao">
            <i class=""></i>
        </div>
        <!-- main header -->
        <header id="header_main">
            <div class="header_main_content">
                <nav class="uk-navbar">
                    <!-- main sidebar switch -->
                    <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                        <span class="sSwitchIcon"></span>
                    </a>
                    <!-- secondary sidebar switch -->
                    <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                        <span class="sSwitchIcon"></span>
                    </a>
                    <div class="uk-navbar-flip">
                        <ul class="uk-navbar-nav user_actions">

                            <li data-uk-dropdown="{mode:'click'}">

                                <div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
                                    <ul class="uk-nav js-uk-prevent">

                                        <li><a></a></li>


                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="header_main_search_form">
                <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
                <form class="uk-form">
                    <input type="text" class="header_main_search_input"/>
                    <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i>
                    </button>
                </form>
            </div>
        </header><!-- main header end -->

        <!-- main sidebar -->
        <aside id="sidebar_main">


            <div class="sidebar_main_header">
                <div class="sidebar_logo">
                    <a href="<?= BASE_URL ?>administrator247/" class="sSidebar_hide"><img
                            src="<?= BASE_URL.LOGO ?>" alt="" height="15"
                            width="71"/></a>
                    <a href="<?= BASE_URL ?>administrator247/" class="sSidebar_show"><img
                            src="<?= BASE_URL.LOGO ?>" alt="" height="32"
                            width="32"/></a>
                </div>

            </div>
            <div class="menu_section">
                <ul>
                    <?php foreach ($this->data["menu_item"] as $k_group => $v_group) { ?>
                        <li title="<?= $k_group; ?>">
                            <a>
                                <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                                <span class="menu_title"><?= $k_group ?></span>
                            </a>
                            <ul>
                                <?php
                                foreach ($v_group["item"] as $k_item => $v_item) {
                                    ?>
                                    <li class="<?= $v_item["active"]==1?"act_item":"" ?>"><a href="<?= ADMIN_URL . $v_item["controller"] ?>"><?= $v_item["label"]; ?></a></li>   


                                <?php } ?>  
                            </ul>
                        </li>
                    <?php } ?>



                </ul>
            </div>

        </aside><!-- main sidebar end -->
        <div id="page_content">
            <div id="page_content_inner">
                <?php
                if ($notify = session_get("notify")) {
                    session_delete("notify");
                    ?>
                        <script>
                            $(document).ready(function (e) {
                                showNotify({
                                       status: '<?=  $notify["type"] == 1 ? "info" : $notify["type"] == 2 ? "warning" : $notify["type"] == 3 ? "success" : "danger" ?>',
                                       messager: '<?= $notify["messager"] ?>'
                                        },null);
                            })
                        </script>
                <?php  } ?>