
$(document).ready(function (e) {

    $('#frmlogin').submit(function () {

        email = $("input[name=login_username]").val();
        pass = $("input[name=login_pass]").val();
        if (validateEmail(email) && pass.length > 5)
        {
            var formdata = new FormData();
            formdata.append("email", email);
            formdata.append("pass", pass);
            formdata.append("token", TOKEN);
          
            $_checksumajax(formdata,ADMIN_URL+"login/check_login",function(){alert("ok")});

        }
        else
        {
            alert("Mật khẩu lớn hơn 5 ký tự");
        }
        return false;
    })
})