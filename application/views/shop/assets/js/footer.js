$(document).ready(function () {

    $("img.b-lazy").attr("src", "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==");
    $("img.b-lazy").unveil();
    jQuery(window).load(function () {

        if ($(document).width() > 1200) {
            if ($('body').hasClass("home")) {
                $('.open-cate').click();
                $('.colse-cate').click();
                $('.vertical-groups').each(function () {
                    height1 = $(this).outerHeight() - 25;
                    height2 = $(this).children(".quangcaomenu").children('a').children().outerHeight();
                    htemp = $(this).children(".quangcaomenu").children(".htmlmenu").outerHeight();
                    if (htemp > height2)
                        height2 = htemp;
                    height = height1 + height2;
                    $(this).css("height", height);
                })
                 height=$('.vertical-menu-content').innerHeight();
                 $('#left_column').css("margin-top",height);
            }
            else {
                $('.open-cate').click();
                $(".vertical-menu-content").show();
                $('.vertical-groups').each(function () {

                    height1 = $(this).outerHeight() - 25;
                    height2 = $(this).children(".quangcaomenu").children('a').children().outerHeight();
                    htemp = $(this).children(".quangcaomenu").children(".htmlmenu").outerHeight();
                    if (htemp > height2)
                        height2 = htemp;
                    height = height1 + height2;
                    $(this).css("height", height);
                })
                $(".vertical-menu-content").hide();
                $('.colse-cate').click();
            }
        }
    });


    setTimeout(function () {
        window.fbAsyncInit = function () {
            FB.init({
                xfbml: true,
                version: 'v2.5'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    }, 2000)
    windowwidth = $(window).width();
    left = (windowwidth - 252) / 2;
    $('.boxdangload').css("left", left);
    $('.dangload').hide();
    $('.thongbao').hide();


//$ ( window ). bind ( "load" ,  function ()  {
//    var timeout = setTimeout ( function ()  { 
//        $ ( "img.lazy" ). trigger ( "sporty" ) 
//    },  50000 ); 
//});


    menuactive = $('li.menuactive').parents('li.li-sub').addClass("menuactive");
    menuactive = $('li.menuactive').parents('li.dropdown').addClass("menuactive");
    console.log(menuactive);


    dangtim = false;
    $('#search-terms').keyup(function () {
        if (!dangtim) {
            id_danhmuc = $("#selectdanhmuc").val();
            dangtim = true;
            str = $(this).val();
            $('.btnsearch').html('<i class="fa fa-spinner fa-spin"></i>');


            $.post(BASE_URL + "search", {"str": str, "id_danhmuc": id_danhmuc}, function (o) {
                html = '';
                if (o.tinhtrang == 1) {
                    for (key in o.data) {
                        obj = o.data[key];
                        html += ' <li class="clearfix" id="itemsearch">';
                        html += ' <div class="imageleft">';
                        html += ' <a href="' + BASE_URL + 'san-pham/' + obj.product_id + "/" + obj.product_slug + ' ">';
                        html += '<img  src="' + BASE_URL + 'public/upload/images/thumb_product/' + obj.product_avatar + '"> ';
                        html += '</a></div>';
                        html += ' <div class="inforight "><a href="' + BASE_URL + 'san-pham/' + obj.product_id + "/" + obj.product_slug + ' ">';
                        html += obj.product_name + " | " + obj.product_code + " | " + format1(parseInt(obj.product_price), "") + '&nbsp;₫ </a>';
                        if (obj.product_description != '' && obj.product_description != null) {
                            html += '<br><span>' + neods(obj.product_description, 200) + '...</span>';
                        }
                        html += '</div>';
                    }
                    dangtim = false;
                    $('.btnsearch').html('<i class="fa fa-search" id="search-icon"></i>');
                    $('.ketquatim').html(html);

                }
                else {
                    dangtim = false;
                    $('.btnsearch').html('<i class="fa fa-search" id="search-icon"></i>');
                    $('.ketquatim').html("Không có kết quả");
                }
                $('.ketquatim').show();
            }, "JSON")
        }
    })

// register clicks outisde search box, and toggle correct classes
    document.addEventListener("click", function (e) {
        var clickedID = e.target.id;

//		if (clickedID != "search-terms" && clickedID != "itemsearch" && clickedID != "search-icon") {
//		
//                                $('.ketquatim').hide();
//			
//		}
        if (clickedID == "search-terms" || clickedID == "ketquatim" || clickedID == "select2-selectdanhmuc-container") {
            $('.ketquatim').show();
            e.stopPropagation();

        }

    });
    $("body").click(function (e) {

        $('.ketquatim').hide();
    })

    $(document).on("click", "#ketquatim", function (e) {
        $('.ketquatim').show();
    })
})

