$(document).ready(function () {

    $('input[name=hinhthucthanhtoan]').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red'
    });
    laphoadon = false;

    $(".frmcheckout").validate({
        submitHandler: function (form) {
            if (!laphoadon) {
                curren = $('.btn-laphoadon');
                btnlinkload(curren);
                var timeout = new Array();

                timeout[0] = setTimeout(function () {
                    btnlinkload(curren, "Đang kiểm tra dữ liệu")
                }, 1000);
                timeout[1] = setTimeout(function () {
                    btnlinkload(curren, "Đang xử lý dữ liệu")
                }, 3000);
                timeout[2] = setTimeout(function () {
                    btnlinkload(curren, "Đang gửi dữ liệu")
                }, 5000);
                timeout[3] = setTimeout(function () {
                    btnlinkload(curren, "Hóa đơn đang được tạo")
                }, 7000);

                Form = document.querySelector('.frmcheckout');
                var formdata = new FormData(Form);
                formdata.append("token", token);
                var http = new XMLHttpRequest();
                http.open("POST", BASE_URL + "checksum/createchecksum", true);
                http.onreadystatechange = function (event) {
                    if (http.readyState == 4 && http.status == 200) {
                        var ketqua = JSON.parse(http.responseText);
                        if (ketqua.status == 1) {
                            $(".btn-capnhat").prop("disabled", true);
                            $(".checkoutxoasanpham").prop("disabled", true);
                            token = ketqua.token;
                            var checksum = ketqua.checksum;
                            formdata.append("checksum", checksum);
                            http = new XMLHttpRequest();
                            http.open("POST", BASE_URL + "sanpham/laphoadon", true);
                            http.onreadystatechange = function (event) {
                                if (http.readyState == 4 && http.status == 200) {
                                    var o = JSON.parse(http.responseText);
                                    if (o.tinhtrang == 1) {
                                        // Lập hóa đơn thành công
                                        url = BASE_URL + "hoadon?mahoadon=" + o.mahoadon + "&token=" + o.token;
                                        $('.thongbao').html("Hóa đơn đã được tạo thành công! <br> Chúng tôi sẽ gọi lại cho bạn \n\
       trong thời gian sớm nhất! <br> Mã hóa đơn của bạn là: " + o.mahoadon + " <br>Click vào xem hóa đơn và lưu lại địa chỉ để theo dõi hóa đơn của bạn<br><a class='btn btn-default' target='_blank' href='" + url + "'> XEM HÓA ĐƠN </a>").addClass('alert-success').show();
                                        $('.btn-laphoadon').remove();
                                        $('.btn-capnhat').remove();
                                        $('.checkoutxoasanpham').remove();

                                        return false;
                                    }
                                    else {
                                        timeout.forEach(function (e) {
                                            clearTimeout(e);
                                        });
                                        $(':input').prop("disabled", false);
                                        $(".btn-capnhat").prop("disabled", false);
                                        $(".checkoutxoasanpham").prop("disabled", false);
                                        if (o.tinnhan == "reload")
                                            window.location.reload();
                                        else {
                                            laphoadon = false;
                                            btnlinkthanhcong(curren, "Lập hóa đơn");
                                            html = 'Lập hóa đơn thất bại: <hr>';
                                            i = 1;
                                            for (var key in o.tinnhan) {
                                                var obj = o.tinnhan[key];
                                                html += i + "/ " + obj + "<hr>";
                                                i++;
                                            }
                                            $('.thongbao').html(html).show();
                                        }
                                    }
                                }
                            };
                            http.send(formdata);
                        }
                        else alert("Lỗi xác thực! Vui lòng tải lại trang");
                    }
                };
                http.send(formdata);
            }
        }
    });

    $(document).on("click", ".btn-capnhat", function () {

        if (!laphoadon) {
            item = $(this);
            key = $(this).attr("data-key");
            soluongthem = parseInt($(this).prev().val());

            if (soluongthem > 0) {
                soluongsanpham = datagiohang[key].soluongsanpham;
                if (soluongthem <= soluongsanpham) {

                    dangload();


                    var formdata = new FormData();
                    formdata.append("key", key);
                    formdata.append("soluongthem", soluongthem);
                    formdata.append("token", token);
                    var http = new XMLHttpRequest();
                    http.open("POST", BASE_URL + "checksum/createchecksum", true);
                    http.onreadystatechange = function (event) {
                        if (http.readyState == 4 && http.status == 200) {
                            var ketqua = JSON.parse(http.responseText);
                            if (ketqua.status == 1) {
                                token = ketqua.token;
                                var checksum = ketqua.checksum;
                                formdata.append("checksum", checksum);
                                http = new XMLHttpRequest();
                                http.open("POST", BASE_URL + "Product_category/update_cart", true);
                                http.onreadystatechange = function (event) {
                                    if (http.readyState == 4 && http.status == 200) {
                                        o = JSON.parse(http.responseText);
                                        if (o.status == 1) {
                                            item.parent().next().children("span").html(format1(parseInt(o.tien), '') + ' VND');
                                            $('.tientotal').html(format1(parseInt(o.tientotal), '') + " VND");
                                            datagiohang[key].soluongthem = soluongthem;
                                            loadthanhcong();
                                        }
                                        else {
                                            window.location.reload();
                                        }
                                    }
                                }
                                http.send(formdata);
                            } else alert("Lỗi xác thực! Vui lòng tải lại trang");
                        }
                    }
                    http.send(formdata);


                }
                else {
                    alert("Sản phẩm này chỉ còn " + soluongsanpham + " sản phẩm");
                    $(this).prev().prop("value", datagiohang[key].soluongthem);
                }
// Nếu > 0
            } else
                alert("Số lượng phải > 0")
        }
    });
    $(document).on("click", ".checkoutxoasanpham", function () {
        if (!laphoadon) {
            var x;
            if (confirm("Bạn có chắc!") == true) {
                item = $(this);
                key = $(this).attr("data-key");
                dangload();

                var formdata = new FormData();
                formdata.append("key", key);
                formdata.append("token", token);
                formdata.append("checkout", true);
                var http = new XMLHttpRequest();
                http.open("POST", BASE_URL + "checksum/createchecksum", true);
                http.onreadystatechange = function (event) {
                    if (http.readyState == 4 && http.status == 200) {
                        var ketqua = JSON.parse(http.responseText);
                        if (ketqua.status == 1) {
                            token = ketqua.token;
                            var checksum = ketqua.checksum;
                            formdata.append("checksum", checksum);
                            http = new XMLHttpRequest();
                            http.open("POST", BASE_URL + "Product_category/delete_cart", true);
                            http.onreadystatechange = function (event) {
                                if (http.readyState == 4 && http.status == 200) {
                                    o = JSON.parse(http.responseText);
                                    if (o.status == 1) {
                                        $('.tientotal').html(format1(parseInt(o.tientotal), '') + "VND");
                                        item.parents('tr').fadeOut(function () {
                                            $(this).remove();
                                        });
                                        if (parseInt(o.tientotal) == 0)
                                            $('.btn-laphoadon').remove();
                                        loadthanhcong();
                                        $('.notify-left').addClass('totalactive');
                                        $('.notify-left').html(o.sl);
                                        $('.total').html(o.sl + " Sản phẩm");
                                    }
                                    else {
                                        window.location.reload();
                                    }
                                }
                            }
                            http.send(formdata);
                        }
                    }
                }
                http.send(formdata);
            }
        }
    })

    $('.btn-laphoadon').click(function () {

//    $('.dangload').show();
//      Form =document.querySelector('.frmcheckout');
//        var formData = new FormData(Form);
//        http =new  XMLHttpRequest();
//               http.open("POST",BASE_URL+"sanpham/laphoadon",true);
//               http.send(formData);
//                             http.onreadystatechange = function(event) {
//     if(http.readyState==4 && http.status==200)
//    {
//        var  o = JSON.parse(http.responseText);
//        
//          if(o.tinhtrang==1)
//       {
//           // Lập hóa đơn thành công
//           
//                $('.thongbao').html("Thành công, cảm ơn bạn đã đặt hàng! <br> Chúng tôi sẽ gọi lại cho bạn \n\
//       trong thời gian sớm nhất!").addClass('alert-success').show();
//                $('.btn-laphoadon').remove();
//                $('.btn-capnhat').remove();
//                $('.checkoutxoasanpham').remove();
//                $(':input').prop("disabled",true);
//           
//       }
//       else
//       {
//           $('.thongbao').html(o.thongbaoloi).show();
//     
//       }
//         $('.dangload').hide();
//    }
//    
//                }
//    
//    
//    return false;
    })
    $('.frmcheckout').submit(function () {


        return false;
    })

})