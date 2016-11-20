$(document).ready(function(){
$(".sortby").click(function(){

  $(".sortby").find("i").each(function(){
      if($(this).hasClass("sortbyactive"))
      {
          $(this).removeClass("sortbyactive");
          console.log($(this));
      }
      else
      {
           $(this).addClass("sortbyactive");
       }
       
       
  })

})
$('.btnlocsanpham').click(function(){
   
        urlsend="";
        type='';
        if($('i.sortbyactive').attr("data-type")=="asc")
        type="type="+$('i.sortbyactive').attr("data-type")+"&";
    
        // Lay filter
        strfilter="filter=";
       $('.filter').each(function(){
           if($(this).prop('checked'))
         strfilter=strfilter+$(this).val()+',';
       });
       
       if(strfilter!="filter=")
       {
           strfilter=strfilter.substr(0,strfilter.length-1)+'&';
          
       }
        else {
            strfilter=''; 
        }
  //  end Lay filter
        
           // Lay orderby 
       if($(".orderby option:selected").val()!='stt'){
       strorderby="orderby="+$(".orderby option:selected").val()+'&';
 
       }
   else
      strorderby='';
    //end Lay orderby
    // Noi bat
    tuychonsanpham='';
    $('.tuychonsanpham').each(function(){
        if($(this).hasClass("current-categorie"))
            tuychonsanpham=$(this).attr('data-tuychon');
    })
    
   
    noibat='';
    if(tuychonsanpham=="noibat")
        noibat="noibat=1&";
    // end noi bat
    // giam gia
    giamgia='';
     if(tuychonsanpham=="giamgia")
    giamgia="giamgia=1&";
// end giam gia
// Tất cả
 if(tuychonsanpham=="tatca"){
    giamgia='';
    noibat='';
 }
// end tất cả

// page
//currentpage=$('.page,.active').attr('data-page');
// end page

            urlsend=URLNOW+"?"+strfilter+strorderby+noibat+giamgia+type+"page=1";

     
       if(urlsend!=window.location){
        
       window.history.pushState('page2', 'page2',urlsend);
     load(urlsend);
       }
    
})

// Tuy chon san pham
$('.tuychonsanpham').click(function(){
  $('.tuychonsanpham').each(function(){
      $(this).removeClass("current-categorie");
  })  
  $(this).addClass("current-categorie");
  urlsend=URLNOW;
  tuychon=$(this).attr('data-tuychon');
  
   if(tuychon!='tatca')
   {
        type='';
        if($('i.sortbyactive').attr("data-type")=="asc")
        type="type="+$('i.sortbyactive').attr("data-type")+"&";
      
           // Lay orderby 
       if($(".orderby option:selected").val()!='stt'){
       strorderby="orderby="+$(".orderby option:selected").val()+'&';
 
       }
   else
      strorderby='';
  urlsend=URLNOW+"?"+strorderby+type+tuychon+"=1";
   }
  
   if(urlsend!=window.location){
  window.history.pushState('page2', 'page2',urlsend);
        load(urlsend);  
   }
  
})
//$(window).on("navigate", function (event, data) {
//  var direction = data.state.direction;
//  if (direction == 'back') {
//    alert('ok');
//  }
//  if (direction == 'forward') {
//    // do something else
//  }
//});


  if (window.history && window.history.pushState) {

    //window.history.pushState('forward', null, './#forward');

    $(window).on('popstate', function() {
        $('.fancybox-overlay').show();
        load(window.location);
    });

  }
  
  $(document).on('click','.page',function(){
     urlsend="";
     
     type='';
        if($('i.sortbyactive').attr("data-type")=="asc")
        type="type="+$('i.sortbyactive').attr("data-type")+"&";
     
   $('.page').each(function(){
       if($(this).hasClass("active"))
           currentpage=$(this).attr('data-page');
   })
   page=$(this).attr('data-page');
     
   if(currentpage==page)
       return false;
        // Lay filter
        strfilter="filter=";
       $('.filter').each(function(){
           if($(this).prop('checked'))
         strfilter=strfilter+$(this).val()+',';
       });
       
       if(strfilter!="filter=")
       {
           strfilter=strfilter.substr(0,strfilter.length-1)+'&';
          
       }
        else {
            strfilter=''; 
        }
  //  end Lay filter
        
           // Lay orderby 
       if($(".orderby option:selected").val()!='stt'){
       strorderby="orderby="+$(".orderby option:selected").val()+'&';
 
       }
   else
      strorderby='';
    //end Lay orderby
    // Noi bat
    tuychonsanpham='';
    $('.tuychonsanpham').each(function(){
        if($(this).hasClass("current-categorie"))
            tuychonsanpham=$(this).attr('data-tuychon');
    })
    
   
    noibat='';
    if(tuychonsanpham=="noibat")
        noibat="noibat=1&";
    // end noi bat
    // giam gia
    giamgia='';
     if(tuychonsanpham=="giamgia")
    giamgia="giamgia=1&";
// end giam gia
// Tất cả
 if(tuychonsanpham=="tatca"){
    giamgia='';
    noibat='';
 }
// end tất cả


   urlsend=URLNOW+"?"+strfilter+strorderby+noibat+giamgia+type+"page="+page;

     
       if(urlsend!=window.location){
        
       window.history.pushState('page2', 'page2',urlsend);
     load(urlsend);
       }
   
  })
//  var count = 0; // needed for safari
//window.onload = function () { 
//    if (typeof history.pushState === "function") { 
//        history.pushState("back", null, null);          
//        window.onpopstate = function () { 
//            history.pushState('back', null, null);              
//            if(count == 1){window.location = 'your url';}
//         }; 
//     }
// }  

function load(urlsend)
{
      $('.dangload').show();
    $.post(urlsend,({"ajax":true}),function(o){
          html='';
        //   console.log(o.sanpham.length);
               o.sanpham.forEach(function(value){
               html+='<li class="col-xs-6 col-sm-4"><div class="product-container"><div class="left-block">';
               html+='<a href="'+URL+'san-pham/'+value.id_sanpham+"/"+value.slugsanpham+'">';
               html+='<img class="img-responsive" alt="product" src="'+URL+'public/upload/images/thumb_hinhsanpham/'+value.hinhdaidien+'" /></a>';
               html+=' <div class="quick-view"><a data-id="'+value.id_sanpham+'" title="Yêu thích" class="heart yeuthich"></a></div>' ;
                if(value.ngangon!=null &&  value.ngangon!='')
                {ngangon=neods(value.ngangon,200)+"..."}else {
                    ngangon='';
                }
;
               html+='  <div class="add-to-cart"><a>'+ngangon+'</a></div>';
              
               if(value.giamgia>0)
               { 
                 html+=' <div class="price-percent-reduction2">-'+value.giamgia+'%<br>SAFE</div>';  
               }
                if(value.noibat==1)
               {
                     html+='  <div class="featured-text"><span></span></div>';  
               }
               if(value.moi==1)
               {
                 html+='  <div class="group-price"> <span class="product-new">New</span></div>';  
               }
              
          
               html+="</div>";
               html+='<div class="right-block">';
               html+='<h5 class="product-name"><a href="'+URL+'san-pham/'+value.id_sanpham+"/"+value.slugsanpham+'" >'+value.tensanpham+'</a>';
               html+='</h5>';
               html+='  <div class="content_price">';

               if(value.gia != value.giamoi)
                html+=' <span class="price product-price">'+format1(parseInt(value.giamoi),'')+' &#8363;</span><span class="price old-price">'+tien(value.gia)+'</span> </div>';
             else
                  html+=' <span class="price product-price">$'+tien(value.gia)+' &#8363;</span>';
               html+='  <div class="info-orther">';
               html+=' <div class="product-desc">'+ngangon+'</div>';
               html+='</div></div></div></li>'
                   
               })
                 $('.filter').each(function(){
                     
                    if(o.filter.indexOf($(this).val())>-1)
                        $(this).prop("checked",true);
                    else
                          $(this).prop("checked",false);
                 })
                 $('.orderby option[value='+o.orderby+']').prop("selected",true);
                 
                   $(".sortby").find("i").each(function(){
                       if($(this).attr("data-type")==o.sortby)
                       {
                           if(!$(this).hasClass("sortbyactive"))
                           $(this).addClass("sortbyactive");
                       }
                       else
                       {
                            $(this).removeClass("sortbyactive");
                       }
                          })
                 // Phan page
                 totalpage=o.phantrang.totalpage;
                 currentpage=o.phantrang.currentpage;
                 htmlpage='';
                 htmlpage=phantrangajax(totalpage,currentpage);
                  //end phan page
                  // tuychonsanpham
                tuychon=o.tuychonsanpham;
                  $('.tuychonsanpham').each(function(){
      $(this).removeClass("current-categorie");
  })  
                         $('.tuychonsanpham').each(function(){
           if($(this).attr('data-tuychon')==tuychon)
               $(this).addClass('current-categorie');
  })       
              
               $('.dangload').hide();
                 $('.pagination').html(htmlpage);
                 $('.dulieusanpham').html(html);
               setTimeout(function(){
                       setheightitem();
               },500);
                 cuon($(".current-categorie"),0);
       },"JSON")
    
}

    function setheightitem()
    {
listitem=$(".dulieusanpham").find("li");
boxwith=$(".dulieusanpham").width();
totalwith=0;
item=new Array();
max=0;
listitem.each(function(){
    item.push($(this));
    itemwith=parseInt($(this).outerWidth());
    itemheight=$(this).children().height();
   
    if(itemheight>max)
        max=itemheight;
    
    totalwith+=itemwith;
    if(totalwith==boxwith || (totalwith<boxwith+50 && totalwith>boxwith-50) )
    {
      for(i=0;i<item.length;i++)
      {
          item[i].children().height(max);
      }
        max=0;
        totalwith=0;
        item=new Array();
    }
   
})
    }
    jQuery(window).load(function () {
    setheightitem();
})
$(window).bind('resizeEnd', function() {

  setheightitem();
});
  $(window).resize(function() {
      $(".dulieusanpham").find("li").children().css("height","auto");
        if(this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function() {
            $(this).trigger('resizeEnd');
        }, 500);
    });
    
    
    
})


