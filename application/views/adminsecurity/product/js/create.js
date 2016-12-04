$(document).ready(function (e) {


    id_sanpham = false;

    $(':input[name=product_name]').keyup(function () {
        str = $(this).val();
        $(':input[name=product_slug]').prop('value', ChangeToSlug(str));
    })
    $(':input[name=gia]').keyup(function () {
        var x = event.keyCode;
        if (x != 37 && x != 38 && x != 39 && x != 40) {
            var array = new Array();
            var arraystr = new Array();
            var x = $(this).val();
            x = x.replace(/[^0-9]/g, '');

            $j = 0;
            for ($i = x.length - 1; $i >= 0; $i--) {

                if ($j == 3) {
                    arraystr.push('.');
                    arraystr.push(x[$i]);
                    $j = 0;
                }
                else {
                    arraystr.push(x[$i]);
                }
                $j++;
            }
            temp = '';
            for ($i = arraystr.length - 1; $i >= 0; $i--) {
                temp = temp + arraystr[$i];
            }

            $(this).prop('value', temp);
        }

    })

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

    $('#formthemsanpham').keydown(function () {

        var x = event.keyCode;

        if (x == 13) {
            return false;
        }
    })


    $('#formthemsanpham').submit(function () {
        $('.btnlink').parent().append('<div class="ketqua"><span class="uk-icon-spinner uk-icon-spin"> </span></div>');
        $('.btnlink').remove();
        str = CKEDITOR.instances.mieuta.getData();
        $('#nhapdulieu').prop('value', str)
        Form = document.querySelector('#formthemsanpham');
        var formData = new FormData(Form);
        formData.append("product_content", str);
        http = new XMLHttpRequest();
        http.open("POST", ADMIN_URL + "product/insert", true);
        http.send(formData);
        http.onreadystatechange = function (event) {
            if (http.readyState == 4 && http.status == 200) {
                var ketqua = JSON.parse(http.responseText);
                if (ketqua.status == 1) {

                    id_sanpham = ketqua.product_id;
                    $('.ketqua').html('<div class="uk-alert uk-alert-success">Sản phẩm đã thêm thành công <a href="' + ADMIN_URL + 'product/create?nganh=' + ketqua.nganh + '" class="btn btn-default"> <i class="uk-icon-plus"></i> Tiếp tục thêm </a> <a href="' + ADMIN_URL + 'product/edit/' + ketqua.product_id + '" class="btn btn-default"> <i class="uk-icon-edit"></i> Cập nhật sản phẩm </a></div>');
                    return false;
                }
            }

        }

        return false;
    })


    $('.boxphantram').hide();
    var avatar = true;

    $('#doiavatar').change(function () {
        inputfile = $(this);
        file = $(this)[0].files;

        var request2 = new XMLHttpRequest();
        request2.open("GET", ADMIN_URL + "product/delete_temp_forder", true);
        request2.send();
        request2.onreadystatechange = function (event) {
            if (request2.readyState == 4 && request2.status == 200) {
                var result = JSON.parse(request2.responseText);
                if (result.status == 1) {
                    if (avatar == true) {
                        if (ktanh(inputfile)) {
                            if (id_sanpham != false) {
                                linkimg = $('#imgavatar').attr('src');
                                $('#imgavatar').prop('src', '');
                                $('.boxanhdaidien').addClass('dangload');
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
                                            $('#doiavatar').prop('value', null);
                                            linkimg = BASE_URL + 'public/upload/images/product/' + ketqua.tenanh;
                                            $('#imgavatar').prop('src', linkimg);
                                            $('.boxanhdaidien').removeClass('dangload');
                                            $(' .boxphantram').hide();
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
                                //alert("Bạn cần thêm sản phẩm trước");
                                //inputfile.val(null)
                                linkimg = $('#imgavatar').attr('src');
                                $('#imgavatar').prop('src', '');
                                $('.boxanhdaidien').addClass('dangload');
                                var Form = new FormData();
                                Form.append('avatar', file[0]);
                                Form.append('id_sanpham', "");
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
                                            $('#doiavatar').prop('value', null);
                                            linkimg = BASE_URL + 'public/upload/images/temp/' + ketqua.tenanh;
                                            $("#tmp_ava").val(ketqua.tenanh);
                                            $('#imgavatar').prop('src', linkimg);
                                            $('.boxanhdaidien').removeClass('dangload');
                                            $(' .boxphantram').hide();
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
                            }
                        }

                    }
                    else
                        alert('Đợi trong giây lát, quá trình đổi avatar đang diễn ra');
                }
            }
        }


    })


// upload anh


    function uploadanh(file) {
        if (id_sanpham != false) {
            html = '  <li data-id="-1" class="uk-grid-margin dangloadanh ">\n\
          <div class="uk-progress uk-progress-striped uk-active phantramupload">\n\
         <div class="uk-progress-bar" style="width:0%;"></div> \n\
        </div></li>';


            $('.uk-sortable').append(html);
            var boxupload = $('.uk-sortable').children("li:last-child");


            var progwith = boxupload.children('.uk-progress');

            var Form = new FormData();
            Form.append('hinhanh', file);
            Form.append('id_sanpham', id_sanpham);
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
                        boxupload.append(html);
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
        else
        {
            html = '  <li data-id="-1" class="uk-grid-margin dangloadanh ">\n\
          <div class="uk-progress uk-progress-striped uk-active phantramupload">\n\
         <div class="uk-progress-bar" style="width:0%;"></div> \n\
        </div></li>';
            $('.uk-sortable').append(html);
            var boxupload = $('.uk-sortable').children("li:last-child");
            var progwith = boxupload.children('.uk-progress');
            var Form = new FormData();
            Form.append('hinhanh', file);
            Form.append('id_sanpham', "");
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
                        <div><img src="' + BASE_URL + 'public/upload/images/temp/' + ketqua.tenhinh + '" alt="" class="img_small"></div>';
                        boxupload.append(html);
                        $("#tmp_photo").val($("#tmp_photo").val() + ketqua.tenhinh + ";");
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
    }

// end upload anh
    $('#chonfile').change(function () {
        if (id_sanpham == false) {
            str1 = $('#imgavatar').attr('src');
            if (str1.length < 1) {
                alert("Vui lòng chọn ảnh đại diện trước. Ảnh đại diện chọn sau hình sản phẩm có thể bị mất.");
                return;
            }
        }

        file = $(this)[0].files;
        for (i = 0; i < file['length']; i++) {

            uploadanh(file[i]);
        }

    })
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
                    if ($("#inputhinhsanpham").val() == tenhinh)
                        $("#inputhinhsanpham").prop("value", "");
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

    $('#chonfiletest').change(function () {


        file = $(this)[0].files;
        var array = new Array();
        for (i = 0; i < file['length']; i++) {


            if (file[i].name == "2250.jpg") {
                file[i].slice.call(file[i]); //will return an array-copy of the filelist
                file[i].slice(0, 0); //Then simply use the slice arg


            }

        }
        console.log(file);

    })
})