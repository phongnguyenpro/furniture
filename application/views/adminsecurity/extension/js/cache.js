$(document).ready(function(){
    
    $('.btn-xoacache').click(function(){
       btn=$(this);
          var r = confirm(" Bạn có chắc ? ");
if (r == true) {
     btnlinkload(btn);
            $.post(ADMIN_URL+"cache/clearcache",function(o){
        if(o.status==1)
        {
            btnlinkthanhcong(btn,"");
             btn.html('<i class="icon uk-icon-check"></i>ĐÃ XÓA THÀNH CÔNG');
               btn.removeClass('btn-danger');
                    btn.addClass('btn-success');
                    setTimeout(function (){
                        window.location.reload();
                    },1000)
        }
        else
        {
                    btnlinkthanhcong(btn,"Không thể xóa! Có lỗi xảy ra");
                   
        }
    },"JSON");
}
    })
})
