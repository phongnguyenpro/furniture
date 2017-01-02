$(document).ready(function (e) {


    $('.thongbao').hide();

    $('.btnlink').click(function () {
        $(this).html('<i class="uk-icon-spinner uk-icon-spin"> </i>');
        //$(this).prop("disabled",true);
    })

    $('.input-price').keyup(function () {
        $(this).prop("value", dinhdanggia($(this).val()));
    })

    $("#input_avatar").change(function () {
        fileIn = $(this)[0];
        if (ktanh($(this)))
        {
            var file = fileIn.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgavatar').prop('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
        else
            alert("Vui lòng chọn file ảnh");
    })

    $(".input_price").keyup(function () {
        var x = event.keyCode;
        if (x != 37 && x != 38 && x != 39 && x != 40) {
            $(this).prop("value", dinhdanggia($(this).val()));
        }
    })
         $(":input.check_all[type=checkbox][value=-1]").on('ifChecked', function(event){
         $('.check_page').iCheck("uncheck");
         });
         $('.check_page').on('ifChecked', function(event){
           $(":input.check_all[type=checkbox][value=-1]").iCheck("uncheck");
         })
      
 $(document).on("change",".check_all[data-edit=1]",function(){
     if($(this).prop("checked"))
         $('.check_page[data-edit]').prop("checked",false);
 })
  $(document).on("change",".check_page[data-edit=1]",function(){
     //if($(this).prop("checked"))
       //  $('.check_all[data-edit]').prop("checked",false);
 })
 
    _confirm_link  =function(url)
 {
      UIkit.modal.confirm('Bạn có chắc muốn lưu?',function(){ window.location=url});
 }
     NotAccess  = function(o)
 {
      UIkit.modal.alert("Bạn không có quyền truy cập");
 }
 

})
function showNotify(option, t) {
    if (thisNotify = UIkit.notify({
        message: t != null ? t.data("message") ? t.data("message") : "" : option.messager,
        status: t != null ? t.data("status") ? t.data("status") : "info" : option.status,
        timeout: t != null ? t.attr("data-timeout") ? t.data("timeout") : 5e3 : 5e3,
        group: t != null ? t.data("group") ? t.data("group") : null : null,
        pos: t != null ? t.data("pos") ? t.data("pos") : "bottom-center" : "bottom-center",
        onClose: function () {
            $body.find(".md-fab-wrapper").css("margin-bottom", ""), t.data("callback") && executeCallback(t.data("callback")), clearTimeout(thisNotify.timeout)
        }
    }), $window.width() < 768 && ("bottom-right" == thisNotify.options.pos || "bottom-left" == thisNotify.options.pos || "bottom-center" == thisNotify.options.pos) || "bottom-right" == thisNotify.options.pos) {
        var o = $(thisNotify.element).outerHeight(),
                i = $window.width() < 768 ? -6 : 8;
        $body.find(".md-fab-wrapper").css("margin-bottom", o + i)
    }
}
// CKFINDER
var imported = document.createElement('script');
imported.src = BASE_URL + 'public/lib/ckfinder/ckfinder.js';
document.head.appendChild(imported);
var editedField;
function BrowseServer(field, type)
{
    var get = CKFinder.tools.getUrlParam;
    editedField = field;
    var finder = new CKFinder();
    finder.basePath = get("basePath");
    finder.selectActionFunction = SetFileField;
    finder.resourceType = type;
    //finder.defaultLanguage = 'es';
    //finder.language = 'es';
    //finder.selectActionFunction = showFileInfo;
    //finder.tabIndex = 1;
    //finder.startupPath = "Images:/";
    finder.popup();
}

// This is a sample function which is called when a file is selected in CKFinder.
function SetFileField(fileUrl)
{
    document.getElementById(editedField).value = fileUrl.substr(fileUrl.search("public/upload/"));
}



function ktanh(file) {

    chonfile = file;
    var fileIn = file[0];
    if (fileIn.files === undefined || fileIn.files.length == 0) {

        alert("Không có ảnh nào được chọn");
        chonfile.val(null);

        return false;
    }
    else
    {
        var file = fileIn.files[0];
        type = file.type;
        size = file.size;

        if (size < 3000000)
        {
            if (type == "image/jpg" || type == "image/jpeg" || type == "image/png" || type == "image/gif")
            {
                return true;
            }
            else
            {
                alert("Vui lòng chọn 1 file ảnh");
                chonfile.val(null);
                return false;
            }

        }
        else
        {

            alert("Dung lượng file nhỏ hơn 3MB");
            chonfile.val(null);
            return false;

        }
    }
}
function btnlinkthanhcong(curren, text)
{
    curren.html(text);
    curren.prop("disabled", false);
}

function thongbaoload() {
    $('.thongbao').show();
    $('.thongbao').children().addClass(' uk-icon-spin uk-icon-cog');
}
function thongbaothanhcong() {

    $('.thongbao').children().removeClass(' uk-icon-spin uk-icon-cog');
    $('.thongbao').children().addClass('uk-icon-check alertok');
    setTimeout(function () {
        $('.thongbao').fadeOut()
    }, 3000);
}


function dinhdanggia(str)
{
    var array = new Array();
    var arraystr = new Array();
    var x = str;
    x = x.replace(/[^0-9]/g, '');

    $j = 0;
    for ($i = x.length - 1; $i >= 0; $i--)
    {

        if ($j == 3)
        {
            arraystr.push('.');
            arraystr.push(x[$i]);
            $j = 0;
        }
        else
        {
            arraystr.push(x[$i]);
        }
        $j++;
    }
    temp = '';
    for ($i = arraystr.length - 1; $i >= 0; $i--)
    {
        temp = temp + arraystr[$i];
    }
    return temp;
}
function validateEmail(email)
{
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
