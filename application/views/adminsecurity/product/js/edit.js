$(document).ready(function (e) {
    $('.select2').css('width', '100%');
    $(".changenganhnghe").hide();
    $(".btn-doinganhnghe").click(function () {
        $(".changenganhnghe").slideToggle();
    })

// $('input.id_danhmuc').change(function(){
//  current=$(this);
//current.parents("li:gt(0)").each(function(){
// 
//        if($(this).find("input:first").prop("checked"))
//        $(this).find("input:first").prop("checked",false);
//})
//
//current.parent().find("li").each(function(){
//     if($(this).find("input:first").prop("checked"))
//        $(this).find("input:first").prop("checked",false);
//})
//
//});
    $(".sethienthi").click(function () {
        checkbox = $(this).next();
        check = $(this).next().prop("checked");
        if (check) {

            checkbox.prop("checked", false);
            $('.hienthichitiet').change();
        }
        else
            checkbox.prop("checked", true);
        $('.hienthichitiet').change();
    })

    $('.hienthichitiet').change(function () {

        if ($(this).prop("checked")) {
            $(this).prev().children().removeClass("glyphicon glyphicon-eye-open");
            $(this).prev().children().addClass("glyphicon glyphicon-eye-close");
        }
        else {
            $(this).prev().children().removeClass("glyphicon glyphicon-eye-close");
            $(this).prev().children().addClass("glyphicon glyphicon-eye-open");

        }
    })
    $('.hienthichitiet').each(function () {
        if ($(this).prop("checked")) {
            $(this).prev().children().removeClass("glyphicon glyphicon-eye-open");
            $(this).prev().children().addClass("glyphicon glyphicon-eye-close");
        }
        else {
            $(this).prev().children().removeClass("glyphicon glyphicon-eye-close");
            $(this).prev().children().addClass("glyphicon glyphicon-eye-open");

        }
    })
    $('input').on('ifUnchecked', function (event) {
        curren = $(this);
    });
    var modal = UIkit.modal("#showedit");
    var modalhinhanh = UIkit.modal("#chonhinhanh");
    kieuchonhinh = "add";

    $(document).on("click", ".showmodalhinhanh", function () {

        if ($(this).attr("data-type") == '2') {
            kieuchonhinh = "detail";
            id_doihinh = $(this).attr("data-id_sanphamchitiet");
            current = $(this);
        }
        else
            kieuchonhinh = "add";
        modalhinhanh.show();
    })

    $(document).on("click", ".xoaproductchitiet", function (e) {
        current = $(this);
        id_sanphamchitiet = $(this).attr('data-id_sanphamchitiet');
        $(this).removeClass("xoaproductchitiet");
        $(this).attr('ref', '#');
        $(this).addClass("uk-icon-spin");

        $.post(BASE_URL + "administrator247/sanpham/xoaproductchitiet", {"id_sanphamchitiet": id_sanphamchitiet}, function (o) {
            if (o.tinhtrang == 1) {
                current.next().children("img").remove();
                current.removeClass("uk-icon-spin");
                current.addClass("xoaproductchitiet");
            }
            else {

                alert("Lỗi! Cập nhật");
                modalhinhanh.hide();
            }
        }, "JSON")
    })
    $(document).on("click", ".xoasanphamchitiet", function () {
        var r = confirm("Bạn có chắc! Đều này rất quan trọng");
        if (r == true) {

            current = ($(this));
            btnlinkload($(this));
            id_sanphamchitiet = $(this).attr('data-id_sanphamchitiet');

            $.post(BASE_URL + "administrator247/sanpham/xoasanphamchitiet", {"id_sanphamchitiet": id_sanphamchitiet}, function (o) {
                if (o.tinhtrang == 1) {
                    current.parent().parent().remove();
                }
                else {

                }
                btnlinkthanhcong(current, "OK");
            }, "JSON")
        }
    })
    $(document).on("click", ".itemhinhchon", function () {
        $(".itemhinhchon").removeClass("hinhdangchon");
        $(this).addClass("hinhdangchon");
    })
    $(document).on("dblclick", ".itemhinhchon", function () {
        $(".itemhinhchon").removeClass("hinhdangchon");
        $(this).addClass("hinhdangchon");
        $('.btnchonhinh').click();
    })

    $(".btnchonhinh").click(function () {
        if (kieuchonhinh == "add") {
          
            name = $('.hinhdangchon').attr("data-name");
            url = BASE_URL + 'public/upload/images/product/' + name;
            $('#inputhinhsanpham').prop('value', name);
            html = '<img title="' + name + '" src="' + BASE_URL + 'public/upload/images/product/' + name + '" alt="" class="img-responsive">';
            $('.hinhsanphamchitiet').html(html);

            modalhinhanh.hide();
        }
        else {
            name = $('.hinhdangchon').attr("data-name");
            url = BASE_URL + 'public/upload/images/product/' + name;
            html = '<img title="' + name + '" src="' + BASE_URL + 'public/upload/images/product/' + name + '" alt="" class="img-responsive">';
            current.html(html);
            current.parent().next().children().attr("data-productchitiet", name);
            $.post(BASE_URL + "administrator247/sanpham/updateproductchitiet", {
                "name": name,
                "id_sanphamchitiet": id_doihinh
            }, function (o) {
                if (o.tinhtrang == 1)
                    modalhinhanh.hide();
                else {

                    alert("Lỗi! Cập nhật");
                    modalhinhanh.hide();
                }
            }, "JSON")

        }
    })
    tr = null;
    $(document).on("click", ".suasanphamchitiet", function () {
        tr = $(this).parent().parent();
        modal.show();
        id_sanphamchitiet = $(this).attr("data-idsanphamchitiet");
        giasanpham = $(this).attr("data-giasanpham");
        soluongsanpham = $(this).attr("data-soluongsanpham");
        giatri = $(this).parents().prevAll('td.giatrithuoctinhchon');
        hinhsanpham = $(this).attr("data-hinhsanphamchitiet");
        $(".chonthuoctinhsanphamchitietedit option").attr('selected', false);

        $(".chonthuoctinhsanphamchitietedit").each(function () {
            select = $(this);
            giatri.each(function () {
                id_giatri = $(this).attr("data-giatri");
                if (id_giatri != -1) {
                            
                       
                    select.children().each(function () {
                        if ($(this).val() == id_giatri && id_giatri != -1) {
                            select.prop('value', id_giatri);
                        }
                    })

                }
            })

        })

        $("#giasanphamchitietedit").prop("value", giasanpham);
        $("#soluongsanphamchitietedit").prop("value", soluongsanpham);
        $("#idsanphamchitietedit").prop("value", id_sanphamchitiet);
        $("#hinhsanphamchitiet").prop("value", hinhsanpham);


    })


    $(document).on("click", ".btncapnhatsanphamchitiet", function () {

         current = $(this);
        btnlinkload(current);
        sotien = $("#giasanphamchitietedit").val();
        soluong = $("#soluongsanphamchitietedit").val();
        hinhsanpham = $("#hinhsanphamchitiet").val();
        id_sanphamchitiet = $('#idsanphamchitietedit').val();
        thuoctinh = new Array();
        $(".chonthuoctinhsanphamchitietedit").each(function () {
            temp = $(this).val();
            thuoctinh.push(temp);
        })
        $.post(ADMIN_URL + "product/update_product_detail", {
            "thuoctinh": thuoctinh,
            "sotien": sotien,
            "hinhsanpham": hinhsanpham,
            "soluong": soluong,
            "id_sanpham": id_sanpham,
            "id_sanphamchitiet": id_sanphamchitiet
        }, function (o) {
            if (o.status == 1) {
                modal.hide();
                tr.html(o.html);
            }
            else {
                alert(o.tinnhan);
            }
            btnlinkthanhcong(current, "Cập nhật");
        }, "JSON")
    })

    $('.btn-themgia').click(function () {
        current = $(this);
        btnlinkload(current);
        sotien = $('#giasanpham').val();
        soluong = $('#soluong').val();
        hinhsanpham = $('#inputhinhsanpham').val();
        thuoctinh = new Array();

        $('.thuoctinhchon').each(function () {
            temp = $(this).val();
            thuoctinh.push(temp);

        })

        $.post(ADMIN_URL + "product/add_product_detail", {
            "thuoctinh": thuoctinh,
            "sotien": sotien,
            "soluong": soluong,
            "hinhsanpham": hinhsanpham,
            "id_sanpham": id_sanpham
        }, function (o) {
            if (o.status == 1) {
                $('.listgiasanpham').append(o.html);
                btnlinkthanhcong(current, "+");
            }
            else {

                btnlinkthanhcong(current, "+");
                alert("Lỗi! " + o.tinnhan);
            }
        }, "JSON")


    })

    $(document).on("click", '.xoacongthem', function () {
        $(this).parent().remove();
    })
    $('#formcapnhatsanpham').keydown(function () {

        var x = event.keyCode;

        if (x == 13) {
            return false;
        }
    })

    dangcapnhat = false;

    $('#formcapnhatsanpham').submit(function () {
        if (!dangcapnhat) {
            dangcapnhat = true;
            $('.ketqua').html('<span class="uk-icon-spinner uk-icon-spin"> </span>');
            str = CKEDITOR.instances.mieuta.getData();
            $('#nhapdulieu').prop('value', str)
            Form = document.querySelector('#formcapnhatsanpham');
            var formData = new FormData(Form);
            formData.append("product_content", str);
            formData.append("product_id",id_sanpham);
            http = new XMLHttpRequest();
            http.open("POST", ADMIN_URL + "product/update", true);
            http.send(formData);
            http.onreadystatechange = function (event) {
                if (http.readyState == 4 && http.status == 200) {
                    var ketqua = JSON.parse(http.responseText);
                    if (ketqua.status == 1) {
                        dangcapnhat = false;
                        $('.ketqua').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>');
                        if (ketqua.reload == 1) {
                            window.location.reload();
                        }
                        return false;
                    }
                    else
                        dangcapnhat = false;

                }

            }


        }

        return false;
    })


    $('.boxphantram').hide();
    avatar = true;

    $('#doiavatar').change(function () {
        inputfile = $(this);
        if (avatar == true) {
            if (ktanh($(this))) {
                if (id_sanpham != false) {
                    linkimg = $('#imgavatar').attr('src');
                    $('#imgavatar').prop('src', '');
                    $('.boxanhdaidien').addClass('dangload');
                    file = $(this)[0].files;
                    var Form = new FormData();
                    Form.append('avatar', file[0]);
                    Form.append('id_sanpham', id_sanpham);
                    var request = new XMLHttpRequest();
                    $('.boxphantram').show();

                    request.upload.addEventListener('progress', function (e) {

                        var percent = Math.round((e.loaded / e.total) * 100);
                        $('.phantramanhdaidien').css('width', percent + '%');
                        $('.phantramanhdaidien').html(percent + '%');
                    }, false);

                    request.open("POST", ADMIN_URL + "product/avatar", true);
                    request.send(Form);
                    avatar = false;
                    request.onreadystatechange = function (event) {
                        if (request.readyState == 4 && request.status == 200) {
                            avatar = true;
                            var ketqua = JSON.parse(request.responseText);
                            if (ketqua.status == 1) {
                                $('.img-responsive[title="' + ketqua.tenanhxoa + '"]').parent('li').remove();
                                $('.img-responsive[title="' + ketqua.tenanhxoa + '"]').remove();
                                if ($("#inputproduct").val() == ketqua.tenanhxoa)
                                    $("#inputproduct").prop("value", "");

                                htmlchonhinh = '<li data-name="' + ketqua.tenanh + '" class="uk-grid-margin itemhinhchon" ><img title="' + ketqua.tenanh + '" src="' + BASE_URL + 'public/upload/images/product/' + ketqua.tenanh + '" alt="" class="img-responsive img_small"></li>';
                                $('.listchonhinh').append(htmlchonhinh);

                                $('#doiavatar').prop('value', null);
                                linkimg = BASE_URL + 'public/upload/images/product/' + ketqua.tenanh;
                                $('#imgavatar').prop('src', linkimg);
                                $('.boxanhdaidien').removeClass('dangload');
                                $('.boxphantram').hide();
                                $('.phantramanhdaidien').css('width', 0);
                                $('.phantramanhdaidien').html('');

                            }
                            else {
                                $('#doiavatar').prop('value', null);
                                $('#imgavatar').prop('src', linkimg);
                                $('.boxanhdaidien').removeClass('dangload');
                                $(' .boxphantram').hide();
                                $('.phantramanhdaidien').css('width', 0);
                                $('.phantramanhdaidien').html('');

                            }
                        }
                    }
                } else {
                    alert("Bạn cần thêm sản phẩm trước");
                    inputfile.val(null)
                }
            }

        }
        else
            alert('Đợi trong giây lát, quá trình đổi avatar đang diễn ra');
    })


// upload anh


    function uploadanh(file) {
          html = '  <li data-id="-1" class="uk-grid-margin dangloadanh ">\n\
          <div class="uk-progress uk-progress-striped uk-active phantramupload">\n\
         <div class="uk-progress-bar" style="width:0%;"></div> \n\
        </div></li>';


            $('.uk-sortable').append(html);
            var boxupload = $('.uk-sortable').children("li:last-child");


            var progwith = boxupload.children('.uk-progress');

            var Form = new FormData();
            Form.append('hinhanh', file);
            Form.append('id_sanpham',id_sanpham);
            var request = new XMLHttpRequest();
            // http_arr.push(request);
            request.upload.addEventListener('progress', function (e) {
                percent = Math.round((e.loaded / e.total) * 100);
                progwith.children().css('width', percent + '%');
                progwith.children().html(percent + '%');
            }, false);

            request.open("POST", ADMIN_URL + "product/upload_image", true);
            request.send(Form);


            request.onreadystatechange = function (event) {
                if (request.readyState == 4 && request.status == 200) {

                    var ketqua = JSON.parse(request.responseText);
                    if (ketqua.status == 1) {

                        progwith.remove();
                        html = '<a type="button" tenhinh="' + ketqua.tenhinh + '" ref="' + ketqua.id_hinh + '" class="xoaanh uk-modal-close uk-close uk-close-alt uk-position-absolute"></a>\n\
                        <div><img src="' + BASE_URL + 'public/upload/images/product/' + ketqua.tenhinh + '" alt="" class="img_small"></div>';
                        htmlchonhinh = '<li data-name="' + ketqua.tenhinh + '" class="uk-grid-margin itemhinhchon" ><img title="' + ketqua.tenhinh + '" src="' + BASE_URL + 'public/upload/images/product/' + ketqua.tenhinh + '" alt="" class="img-responsive img_small"></li>';
                        boxupload.append(html);
                        $('.listchonhinh').append(htmlchonhinh);
                        boxupload.attr("data-id", ketqua.id_hinh);
                        return true;
                    }
                    else {
                        curren.prop('value', null);
                        //  alert('Có lỗi xảy ra. Hãy thử lại')
                        imageitem.remove();
                        return false;

                    }
                }

            }

    }

// end upload anh
    $('#chonfile').change(function () {


        file = $(this)[0].files;
        for (i = 0; i < file['length']; i++) {

            uploadanh(file[i]);
        }

    })
    dangxoa = false;
    $(document).on("click", ".xoaanh", function () {
        if (!dangxoa) {
            var id_hinh = $(this).attr('ref');
            var tenhinh = $(this).attr('tenhinh');

            $(this).removeClass("xoaanh");
            $(this).attr('ref', '#');
            $(this).addClass("uk-icon-spin");
            box = $(this).parent();
            dangxoa = true;
            $.post(ADMIN_URL + "product/delete_image", {'id_hinh': id_hinh, 'tenhinh': tenhinh}, function (o) {
                if (o.status = 1) {
                    box.remove();
                    $('.img-responsive[title="' + tenhinh + '"]').parent('li').remove();
                    $('.img-responsive[title="' + tenhinh + '"]').remove();
                    if ($("#inputproduct").val() == tenhinh)
                        $("#inputproduct").prop("value", "");
                    dangxoa = false;
                }

            })
            return false;

        }

    })

    var nestable = UIkit.sortable($(".uk-sortable"));


    nestable.on({
        'stop.uk.sortable': function () {

            var list_images = $(".uk-sortable").data("sortable").serialize();
          //  datamenu = JSON.stringify(data); // lấy giá trị
            //console.log(datamenu);

            $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

            $.post(ADMIN_URL + "product/sort_image", {"list_images": list_images}, function (o) {
                if (o.tinhtrang = 1) {
                    $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')

                }
            })


        }
    });
})