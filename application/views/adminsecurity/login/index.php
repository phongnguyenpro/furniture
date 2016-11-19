<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

    <?php
    if (!isset($_SESSION['token']))
        session_set("token", generate_password(20));
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Remove Tap Highlight on Windows Phone IE -->

        <title>Login</title>

        <script src="<?= load_admin_public("js/jquery.js") ?>"></script>
        <!-- uikit -->
        <link rel="stylesheet" href="<?= load_admin_public("bower_components/uikit/css/uikit.almost-flat.min.css") ?>" media="all">
        <?= "<script >TOKEN='" .session_get("token"). "'</script>"; ?>
        <script>
            ADMIN_URL = "<?= ADMIN_URL ?>";
            BASE_URL = "<?= BASE_URL ?>";
        </script>


        <!-- altair admin login page -->
        <link rel="stylesheet" href="<?= load_admin_public("assets/css/login_page.min.css") ?>" />

    </head>
    <body class="login_page">

        <div class="login_page_wrapper">
            <div class="md-card" id="login_card">
                <div class="md-card-content large-padding" id="login_form">
                    <div class="login_heading">
                        <div class="user_avatar"></div>
                    </div>
                    <form id="frmlogin">
                        <div class="uk-form-row">
                            <label for="login_username">Email đăng nhập</label>
                            <input class="md-input" type="email" id="login_username" name="login_username" />
                        </div>
                        <div class="uk-form-row">
                            <label for="login_password">Mật khẩu</label>
                            <input class="md-input" type="password" id="login_password" name="login_pass" />
                        </div>
                        <div class="uk-margin-medium-top">
                            <button  type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
                        </div>
                    </form>


                </div>



            </div>
        </div>

        <!-- common functions -->
        <script src="<?= load_admin_public("assets/js/common.min.js") ?>"></script>
        <!-- altair core functions -->
        <script src="<?= load_admin_public("assets/js/altair_admin_common.min.js") ?>"></script>
        <script src="<?= load_admin_public("assets/js/pages/login.min.js") ?>"></script>
        <script src="<?= load_admin_public("js/function.js") ?>"></script>
        <script src="<?= load_public("js/function.js") ?>"></script>
        <!-- altair login page functions -->
        <script src="<?= load_admin_view("login/js/index.js") ?>"></script>
    </body>

</html>