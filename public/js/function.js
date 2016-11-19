function reloadtrang()
{

    window.location.reload();
}
function ChangeToSlug(str)
{
    // Chuyển hết sang chữ thường
    str = str.toLowerCase();    
 
    // xóa dấu
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
 
    // Xóa ký tự đặc biệt
    str = str.replace(/([^0-9a-z-\s])/g, '');
 
    // Xóa khoảng trắng thay bằng ký tự -
    str = str.replace(/(\s+)/g, '-');
 
    // xóa phần dự - ở đầu
    str = str.replace(/^-+/g, '');
 
    // xóa phần dư - ở cuối
    str = str.replace(/-+$/g, '');
 
    // return
    return str;
}

     function ktanh(file){
     
        chonfile=file;
             var fileIn = file[0];
        if (fileIn.files === undefined || fileIn.files.length == 0) {
            
            alert("Không có ảnh nào được chọn");
            chonfile.val(null);
           
        return false;
    }
    else
    { 
        var file = fileIn.files[0];
        type=file.type; 
        size=file.size;

        if(size<3000000)
        {
        if(type=="image/jpg" || type=="image/jpeg" || type=="image/png" || type=="image/gif"  )
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
    
    function createchecksum(thistoken,data)
{
    
                                     
                                    data.append("token",thistoken);
                                    var  http =new  XMLHttpRequest();
                                      http.open("POST",URL+"checksum/createchecksum",true);
                                     http.send(data);
    http.onreadystatechange = function (event) {
     if (http.readyState == 4 && http.status == 200)
            {
     
                 var ketqua = JSON.parse(http.responseText);
                 if(ketqua.tinhtrang==1)
                 {
                     token=ketqua.token;
                     return ketqua.checksum;
                     
                 }
                 else
                    return false;
                
            }
}
}
    function format1(n, currency) {
      
    return currency  + n.toFixed(0).replace(/./g, function(c, i, a) {
        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
    });
}

    function tien(str)
    {
        var array =  new Array();
var arraystr =  new Array();
var x=str;
x=x.replace(/[^0-9]/g,'');

$j=0;
for($i=x.length-1;$i>=0;$i--)
{
  
    if($j==3)
    {
  arraystr.push('.');  
  arraystr.push(x[$i]);  
  $j=0;
    }
    else
    {
       arraystr.push(x[$i]);    
    } 
    $j++;
}
temp='';
for($i=arraystr.length-1;$i>=0;$i--)
{
    temp=temp+arraystr[$i];
}

return temp;
    }
    function cuon(phantu,plus)
    {
             $('html, body').animate({
        scrollTop: (phantu.offset().top)-plus
    }, 1000)
    }
    function kiemtramoi(date)
    
{
    ngaytao=new Date(date);
 var ngayhientai = Date.now();
    if(parseInt((ngayhientai-ngaytao)/(1000*60*60*24))<7)
        return true;
    else
        return false;
}

function parseDate(str) {
    var mdy = str.split('/')
    return new Date(mdy[2], mdy[0]-1, mdy[1]);}
function daydiff(first, second) {
    return (second-first)/(1000*60*60*24)	
}	


   function dangload()
        {
           $('.dangload').show();
        }
        function loadthanhcong()
        {
             $('.dangload').hide();
        }
        
        
function btnlinkload(curren,text)
{
   if(!text)
   {
       text="Vui lòng đợi";
   }   
     curren.html(text+' <i class="fa fa-spinner fa-spin uk-icon-spinner uk-icon-spin"></i>');
     curren.prop("disabled",true);
}
function btnlinkthanhcong(curren,text)
{
     curren.html(text);
     curren.prop("disabled",false);
}
function isset(key,array){
ret = false;
array.forEach(function(entry) {
  if( entry == key ){
    ret = true;
  }
});
return ret;
}
function in_array(needle, haystack)
{
    for(var key in haystack)
    {
        if(needle === haystack[key])
        {
            return true;
        }
    }

    return false;
}
function phantrangajax(total_page,cur_page)
{
    
    cur_page=parseInt(cur_page);
    total_page=parseInt(total_page);
    current_range=new Array();
    if(cur_page-2 < 1)
        start=1;
    else
        start=cur_page-2;
    if(cur_page+2 > total_page)
        end=total_page;
    else
        end=cur_page+2;
    current_range[0]=start;
    current_range[1]=end;
    
    first_page='';
    if(cur_page > 3)
    first_page+='<li  data-page="1" class="page" ><a >1</a></li>';
    if(cur_page >= 5)
        first_page+='<li> <a>...</a> <li>';
    
    last_page='';
    if(cur_page <= (total_page-4))
    last_page+='<li> <a>...</a> <li>';
    if(cur_page < (total_page-2))
    last_page+='<li  data-page="'+total_page+'" class="page" ><a >'+total_page+'</a></li>';
   
    
    previous_page='';
    if(cur_page>1)
       previous_page='<li data-page="'+(cur_page-1)+'" class="page" ><a >Previous</a></li>'; 
   
    next_page='';
    if(cur_page < total_page)
       next_page='<li data-page="'+(cur_page+1)+'" class="page" ><a >Next</a></li>'; 
    
    page=new Array();
     for (x=current_range[0];x <= current_range[1]; ++x)
     {
         active='';
         if(x==cur_page)
         active="active";
         var html='<li data-page="'+x +'" class="page '+ active +' "><a>'+x+'</a></li>';
         page.push(html);
     }
    if (total_page>1)
    {
        return  previous_page+first_page+page.join(" ")+last_page+next_page;
    }
    else
        return '';
}
function  neods(str,l)
{
      str=str.replace(/<(?:.|\n)*?>/gm, '');
   str=str.substr(0,l);

 
    
return str;
}
 $_checksumajax = function (formdata, url_callback, callback)
    {

        var http = new XMLHttpRequest();
        http.open("POST", BASE_URL + "checksum/createchecksum", true);
        http.onreadystatechange = function (event) {
            if (http.readyState == 4)
            {
                if(http.status == 200)
                {
                var result = JSON.parse(http.responseText);
                if (result.status == 1)
                {
                    TOKEN = result.token;
                    var checksum = result.checksum;
                    formdata.append("checksum", checksum);
                    http = new XMLHttpRequest();
                    http.open("POST", url_callback, true);
                    http.onreadystatechange = function (event) {
                        if (http.readyState == 4 && http.status == 200)
                        {
                            var result = JSON.parse(http.responseText);
                            if (result.tinhtrang == 1)
                            {
                                callback();
                            }
                            else
                            {
                                 window.location.reload();
                            }
                        }
                    }
                       http.send(formdata);
                }
                    else {
                        // checksum thất bại
                         window.location.reload();s
                    }

               }
                else
                {
                    // gửi dữ liệu thất bại
                    window.location.reload();
                }
            }
        }
         http.send(formdata);
    }

