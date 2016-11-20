$(document).ready(function(){
    
   
    $('.thongbaochitiet').hide();
       $('.btn-add-cart').click(function(){
           curren=$(this);
           if(datasanphamchitiet!='' && datasanphamchitiet!=null)
           {
               $totaldachon=$(".giatrithuoctinhchon:checked").length;
              
               if(tontai && ($totaldachon==$totalthuoctinhchon))
               {
                  
                   // Đã hoàn thành và tiến hành đặt hàng
                   
                   soluongthem=$(":input[name=soluongthem]").val();
                   
                   if(parseInt(soluongthem)<=parseInt(soluongsanpham) && parseInt(soluongthem)>0)
                   {
          var loithuoctinh=false;                    
       giatri=new Array();
        $(".giatrithuoctinhchon:checked").each(function(){
        
     
//         var jsonArg1 = new Object();
//        jsonArg1.giatri = $(this).val();
//        //jsonArg1.ten=$(this).attr("data-name");
           if(in_array($(this).val(),listthuoctinhchon))
           {
      giatri.push($(this).val());
      
           }
           else
           {
               alert("Có lỗi xảy ra! Vui lòng tải lại trang");
               loithuoctinh=true;
               
            }
        
      })
      if(!loithuoctinh)
      {
      giatri=giatri.toString();
                   
                   btnlinkload(curren);
                   var formdata=new FormData();
                   formdata.append("id_sanpham",id_sanpham);
                   formdata.append("id_sanphamchitiet",id_sanphamchitiet);
                   formdata.append("soluongthem",soluongthem);
                   formdata.append("giatri",giatri);
                   formdata.append("token",token);
                  var  http =new  XMLHttpRequest();
                                      http.open("POST",URL+"checksum/createchecksum",true);
                                      http.send(formdata);
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
                               http.open("POST",URL+"sanpham/themgiohang",true);
                             http.onreadystatechange = function (event) {
                   if (http.readyState == 4 && http.status == 200)
                       {
                           ketqua = JSON.parse(http.responseText);
                               if(ketqua.tinhtrang==1)
                           {
                            capnhatgiohang(ketqua);
                            btnlinkthanhcong(curren,"Thêm vào giỏ hàng");
                            }
                            else
                                 btnlinkthanhcong(curren,"Bạn không thể thêm sản phẩm này vào giỏ hàng"); 
                        }
                    }
                     http.send(formdata);
                
                             }
                     else
                     {
                        btnlinkthanhcong(curren,"Lỗi xác thực! Vui lòng tải lại trang"); 
                     }
                       
                 
               }
           }
       }
   }
                    else
                    {
                        alert("Sản phẩm này chỉ còn lại "  +soluongsanpham + " sản phẩm");
                    }
   
               }
               else
               {// Thông báo chọn
                   
                   $('.listgiatri').each(function(){
                       label=$(this).attr("data-label");
                       itemcheck=$(this).find(":checked");
                       
                       if(!itemcheck.prop("checked"))
                       {  
                           chuachon=false;
                           alert("Vui lòng chọn "+ label);
                       }
                   
                   })
                     
                   
//                    $(".giatrithuoctinhchon").each(function(){
//                        
//                         
//                           if($(this).prop("checked")==false)
//                           {
//                               namethuoctinhtemp=$(this).attr("data-label");
//                               if(namethuoctinh!=namethuoctinhtemp)
//                               {
//                                   alert("")
//                                alert("Bạn chưa chọn " +namethuoctinhtemp);
//                                namethuoctinh=namethuoctinhtemp;      
//                                }
//                           }
//                           
//                           }) 
               }
           }
           else
           {
              var loithuoctinh=false;
               chuachon=true;
                  $('.listgiatri').each(function(){
                       label=$(this).attr("data-label");
                       itemcheck=$(this).find(":checked");
                       
                       if(!itemcheck.prop("checked"))
                       {  
                           chuachon=false;
                           alert("Vui lòng chọn "+ label);
                       }
                   
                   })
                    
                   if(chuachon)
                   {
        giatri=new Array();
        $(".giatrithuoctinhchon:checked").each(function(){
              
           if(in_array($(this).val(),listthuoctinhchon))
           {
      giatri.push($(this).val());
      
           }
           else
           {
               alert("Có lỗi xảy ra! Vui lòng tải lại trang");
               loithuoctinh=true;
               
            }
//         var jsonArg1 = new Object();
//        jsonArg1.giatri = $(this).val();
//        //jsonArg1.ten=$(this).attr("data-name");
        
        
      })
      giatri=giatri.toString();
            
            if(!loithuoctinh)
                {
               // Giá trị mặc định nếu không có thuộc tính chọn
                  soluongthem=$(":input[name=soluongthem]").val();
         
                 if(parseInt(soluongthem)<=parseInt(soluongsanpham))
                   {
                    
                       btnlinkload(curren);
                   var formdata=new FormData();
                   formdata.append("id_sanpham",id_sanpham);
                   formdata.append("id_sanphamchitiet",-1);
                   formdata.append("soluongthem",soluongthem);
                   formdata.append("giatri",giatri);
                   formdata.append("token",token);
                  var  http =new  XMLHttpRequest();
                                      http.open("POST",URL+"checksum/createchecksum",true);
                                      http.send(formdata);
    http.onreadystatechange = function (event) {
     if (http.readyState == 4 && http.status == 200)
            {
                       var ketqua = JSON.parse(http.responseText);
                           if(ketqua.tinhtrang==1)
                           {
                               token=ketqua.token;
                               var checksum=ketqua.checksum;
                               formdata.append("checksum",checksum);
                               http =new  XMLHttpRequest();
                               http.open("POST",URL+"sanpham/themgiohang",true);
                             http.onreadystatechange = function (event) {
                   if (http.readyState == 4 && http.status == 200)
                       {
                           ketqua = JSON.parse(http.responseText);
                               if(ketqua.tinhtrang==1)
                           {
                            capnhatgiohang(ketqua);
                            btnlinkthanhcong(curren,"Thêm vào giỏ hàng");
                            }
                            else
                                 btnlinkthanhcong(curren,"Bạn không thể thêm sản phẩm này vào giỏ hàng"); 
                        }
                    }
                     http.send(formdata);
                
                           }
                           else   btnlinkthanhcong(curren,"Bạn không thể thêm sản phẩm này vào giỏ hàng"); 
                       }}
                   
                   }
                   
                   else
                        alert("Sản phẩm này chỉ còn lại "  +soluongsanpham + " sản phẩm");
                }
               }
           }
          
          
          
           return false;
       
    
                
          
   }) 
   
   
   $(document).on("click",".xoasanpham",function(){
       item=$(this);
       key=$(this).attr("data-id");
        btnlinkload(item);
       
       
       
       var formdata=new FormData();
  formdata.append("key",key);
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
                               http.open("POST",URL+"sanpham/xoagiohang",true);
                             http.onreadystatechange = function (event) {
                   if (http.readyState == 4 && http.status == 200)
                       {
                           o = JSON.parse(http.responseText);
                               if(o.tinhtrang==1)
                           {
                                   if(capnhatgiohang(o))
                           {
                 item.parent().parent().remove();
                  
                            }
                           }
                           else
                           {
                                window.location.reload();
                           }
                       }}
                  http.send(formdata); 
                           }   
                       }}
           http.send(formdata); 
       
       
   })
   
    function capnhatgiohang(ketqua)
    { $('.notify-left').removeClass('totalactive');
         html='<div class="cart-block-content"> <div class="cart-block-list">  <ul>';
              
                   total=0;
                   tongtien=0;
                   for (var key in ketqua.data) {
                       var obj =  ketqua.data[key];
                      
                        total++;
                        html+='<li class="product-info">';
                         html+='<div class="p-left">  <a data-id="'+key+'" class="remove_link xoasanpham"></a>  <a >';
                         html+='<img class="img-responsive" src="'+URL+'public/upload/images/thumb_hinhsanpham/'+obj.hinhsanpham+'" alt="p10"> </a> </div>';
                         html+='<div class="p-right">';   
                          html+='<p class="p-name">'+obj.tensanpham+'</p>';
                            if(obj.tengiatri!='')  
                           html+='<p>Thuộc tính: '+obj.tengiatri;
                          html+='</p>';
                           html+='<p>Giảm giá: '+obj.giamgia+'%</p>';
                             html+='<p>Số lượng: '+obj.soluongthem+'</p>'; 
                             html+='<p>Đơn giá: '+format1(parseInt(obj.giasanpham),"")+'&#8363;</p>';
                              tongtiensanpham=obj.giasanpham*obj.soluongthem;
                              tiengiamgia=(obj.giasanpham*obj.soluongthem)*(obj.giamgia/100);
                              tien=tongtiensanpham-tiengiamgia;
                              html+='  <p class="p-rice">Tổng: '+format1(parseInt(tien),'$')+'&#8363;</p>';
                             html+='</div> </li>';  
                            tongtien=tongtien+tien;
                               }
                    html+='</ul></div>';
                    html+=' <div class="toal-cart"> <span>Tổng cộng:</span>';
                    html+='  <span class="toal-price pull-right">$'+format1(tongtien,'')+'&#8363;</span> </div>'
                     html+='<div class="cart-buttons">  <a href="'+URL+'sanpham/checkout" class="btn-check-out">Lập hóa đơn</a>  </div></div>';
                       
     $('html, body').animate({
        scrollTop: ($(".notify-left").offset().top)-100
    }, 1000,function(){
        
         $('.cart-block').html(html); 
         $('.notify-left').addClass('totalactive');
         $('.notify-left').html(total);
         $('.total').html(total + " Sản phẩm");
    });
                  
                return true;
        
    }
})