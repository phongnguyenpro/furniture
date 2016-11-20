$(document).ready(function(){
    
    $('#contact-form').submit(function(){
        current=$('.btn-send');
        btnlinkload(current);
        
        Form = document.querySelector('#contact-form');
        var formdata = new FormData(Form);
        formdata.append("token",token);
            var  http =new  XMLHttpRequest();
           http.open("POST",URL+"checksum/createchecksum",true);
                 http.onreadystatechange = function (event) {
     if (http.readyState == 4 && http.status == 200)
            {
                var ketqua = JSON.parse(http.responseText);
                           if(ketqua.tinhtrang==1)
                           {
                                  token=ketqua.token;
                                var  checksum=ketqua.checksum;
                                 formdata.append("checksum",checksum);
                                 http =new  XMLHttpRequest();
                                 http.open("POST",URL+"lienhe/send",true);
                                        http.onreadystatechange = function(event) {
     if(http.readyState==4 && http.status==200)
    {
        var  o = JSON.parse(http.responseText);
        
          if(o.tinhtrang==1)
       {
            btnlinkthanhcong(current,"<i class='glyphicon glyphicon-check'></i> ĐÃ GỬI THÀNH CÔNG");
                current.prop("disabled",true);
       }
       else
       {
             btnlinkthanhcong(current,"Chưa gửi được! THỬ LẠI"); 
       }
   }}
   http.send(formdata);
                           }else alert("Lỗi xác thực Vui lòng tải lại trang");
            }}
        http.send(formdata);
        return false;
    })
})