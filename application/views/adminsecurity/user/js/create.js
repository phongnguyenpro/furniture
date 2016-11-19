
$(document).ready(function () {
  var fromvalidator = $("form[name=updateuser]").parsley();
    $("#btn_update_user").click(function () {
        if (fromvalidator.isValid())
            UIkit.modal.confirm('Bạn có chắc muốn lưu?',function(){ $("form[name=updateuser]").submit()});
        else
            $("form[name=updateuser]").submit()
    })
//    $("form[name=updateuser]").submit(function () {
//        
//         if ( $(this).parsley().isValid() ) {
//        $_updateuser = function () {
//            Form = document.querySelector("form[name=updateuser]");
//            var formData = new FormData(Form);
//            http = new XMLHttpRequest();
//            http.open("POST","http://localhost/furniture/admin/user/insert", true);
//            http.send(formData);
//        }
//
//        UIkit.modal.confirm('Are you sure?',$_updateuser);
//        return false;
//         }
//    })

})