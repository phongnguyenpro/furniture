<!DOCTYPE html>
<html>

<head> 
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-language" content="vi">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
        <link rel="stylesheet" type="text/css" href="<?= URL."view/".THEME ?>/assets/lib/bootstrap/css/bootstrap.min.css" />
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

</head>
<body>
   <?php 
   $data=$this->data;
   ?>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="boxlogin">
                    <?php if(isset($data['error'])){ ?>
                      <h4 class="text-center"><?= $data['error'] ?></h4>
                    <?php } else{?>
                    <h4 class="text-center">Một số thông tin cần thiết để hoàn thành!</h4>
                    <?php }?>
                    <div class="avatar" style=" background-image: url(<?= $data['hinhdaidien'] ?>);">
                        
                    </div>
                
                    <form class="form-horizontal frm-login" method="POST" role="form">
                      
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email: </label>
      <div class="col-sm-10">
          <input type="email" name="email" class="form-control" required="" value='<?= $data['email'] ?>' id="email" placeholder="Enter email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Tuổi: </label>
      <div class="col-sm-10">          
          <input type="number" required="" name="tuoi" class="form-control"  placeholder="Nhập tuổi">
      </div>
    </div>
   <div class="form-group">
      <label class="control-label col-sm-3" for="pwd">Giới tính: </label>
      <div class="col-sm-9" style="padding-top: 10px;">          
          <label for="nam">Nam</label><input required="" value="1" id="nam" name="gioitinh" type="radio" >
          -
          <label for="nu">Nữ</label><input required="" value="2" id="nu" name="gioitinh" type="radio" >
      </div>
    </div>
                <div class="text-center"><button type="submit" class="btn-login-success">Hoàn thành đăng nhập</button></div>
                <div class="text-center"><a href="<?= URL ?>login/huybo"><button type="button" class="btn btn-danger btn-huybo">Hủy bỏ</button></a></div>

            </form>
                    </div>
                </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <script>
       $(document).ready(function()
       {



  $('input[name=gioitinh]').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_flat-red'
  });
          $(".frm-login").validate({
               submitHandler: function(form) {
                   btnlinkload($('.btn-login-success'));
                 form.submit();
               }
          });
//          $(".btn-huybo").click(function(){
//              window.close();
//          })
       })
</script>
</body>
</html>