<html>

    <?php
    $xuly=new \lib\Xulydulieu();
    $thongtin = $this->data;
    ?>
    <!-- Mirrored from kutethemes.com/demo/kuteshop/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Aug 2015 18:10:16 GMT -->
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="<?= URL . "view/" . THEME ?>/hoadon/css/hoadon.css" />
        <link rel="stylesheet" type="text/css" href="<?= URL . "view/" . THEME ?>/assets/lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= URL . "view/" . THEME ?>/hoadon/css/print.css" type="text/css" media="print" />
        <script type="text/javascript" src="<?= URL."view/".THEME ?>/assets/lib/jquery/jquery-1.11.2.min.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="row">
                
                <hr>
       <?php if($thongtin['tinhtrang']==1) {?>
        
        <div class="alert alert-success text-center">GIAO DỊCH THÀNH CÔNG</div>
        <div class="text-center"><label class="label label-warning " style="font-size: 20px">5</label></div>
        <script>
            i=5;
        var refreshIntervalId =setInterval(function(){
          i--;
          if(i==0)
          {
             window.location='<?= $thongtin['urllink'] ?>';
        clearInterval(refreshIntervalId);  
        }
          else
          {
              $("label.label").html(i);
          }
        },1000)
        </script>      
 <?php } else{?>
        <div class="alert alert-danger text-center">GIAO DỊCH KHÔNG THÀNH CÔNG<hr>
            <?php if(isset($thongtin['tinnhan'])){ ?>
            <p><?= $thongtin['tinnhan']  ?></p>
   <?php }?>
        </div> 
         <?php if(isset($thongtin['magiaodich'])){ ?>
         <div class="alert alert-danger text-center">Hãy kiểm tra tài khoản. Nếu tiền của bạn đã được chuyển vào tài khoản của chúng tôi?<br> 
             Vui lòng giữ mã giao dịch này <b class="label label-success"><?= $thongtin['magiaodich'] ?></b> để tiến hành khiếu nại và nhận lại tiền. </div> 
          
  <?php }?>
        <div class="text-center"><a href="<?= URL ?>"> VỀ TRANG CHỦ </a> </div>      
 <?php }?>
        <hr>
            </div>
        </div>
    </body>
</html>