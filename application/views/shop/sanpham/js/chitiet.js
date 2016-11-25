$(document).ready(function () {
    $('.changesoluong').click(function () {
        type = $(this).attr("data-type");
        slhientai = parseInt($("input[name=soluongthem]").val());
        if (type == 1)
            slmoi = slhientai + 1;
        else
            slmoi = slhientai - 1;

        if (slmoi > 0 && !isNaN(slmoi))
            $("input[name=soluongthem]").prop("value", slmoi);
        else
            $("input[name=soluongthem]").prop("value", slhientai);

    })

    id_sanpham = $('.btn-add-cart').attr("data-id");
    tensanpham = $('.btn-add-cart').attr("data-tensanpham");
    masanpham = $('.btn-add-cart').attr("data-masanpham");
    giamgia = $('.btn-add-cart').attr("data-giamgia");
    giasanpham = $('.btn-add-cart').attr("data-giasanpham");
    soluongsanpham = $('.btn-add-cart').attr("data-soluongsanpham");
    hinhsanpham = $('.btn-add-cart').attr("data-hinhsanpham");
    tontai = false;
    datasanphamchitiet = new Array();
    thuoctinhchon = Array();
    listthuoctinhchon = new Array();
    $totalthuoctinhchon = $('.listgiatri').length;
    // san pham chi tiet
    sogiatri = 0;
    for (var key in sanphamchitiet) {

        datasanphamchitiet.push(sanphamchitiet[key]);
        temp = sanphamchitiet[key]['thuoctinh'].length;
        for ($i = 0; $i < temp; $i++) {
            thuoctinhchon.push(sanphamchitiet[key]['thuoctinh'][$i]);
        }
        if (temp > sogiatri)
            sogiatri = temp;
    }

    if (datasanphamchitiet == '' || datasanphamchitiet == null) {
        $('.listgiatri').each(function () {

            itemcheck = $(this).find(":input:first").prop("checked", true);

            $(this).find(":input").each(function () {
                listthuoctinhchon.push($(this).val());
            })

        })
    }
    else {


        $('.listgiatri').each(function () {

            itemcheck = $(this).find(":input").prop("checked", false);

            $(this).find(":input").each(function () {
                listthuoctinhchon.push($(this).val());
            })
        })
    }

// end


    $(".giatrithuoctinhchon").change(function () {


        giatrithuoctinhcheck = $(this).val();

        if (isset(giatrithuoctinhcheck, thuoctinhchon)) {

            if (datasanphamchitiet != '' && datasanphamchitiet != null) {
                giatri = new Array();
                countcheck = 0;
                $(".giatrithuoctinhchon:checked").each(function () {
                    countcheck++;
                    var jsonArg1 = new Object();
                    jsonArg1.giatri = $(this).val();
                    jsonArg1.ten = $(this).attr("data-name");
                    giatri.push(jsonArg1);

                })

                if (sogiatri <= countcheck) // check đủ rồi mới làm
                {

                    for (i = 0; i < datasanphamchitiet.length; i++) {
                        dadung = 0;
                        tontai = false;

                        for (j = 0; j < sogiatri; j++) {
                            tempgiatri = datasanphamchitiet[i]['thuoctinh'][j];

                            for (k = 0; k < giatri.length; k++) {

                                if (tempgiatri == giatri[k]['giatri']) {
                                    dadung++;
                                    break;
                                }
                            }

                        }

                        if (dadung == sogiatri) {
                            soluongsanpham = datasanphamchitiet[i]['soluongsanpham'];
                            giasanpham = datasanphamchitiet[i]['giasanpham'];
                            if (datasanphamchitiet[i]['hinhsanpham'] != null && datasanphamchitiet[i]['hinhsanpham'] != '') {

                                hinhsanpham = datasanphamchitiet[i]['hinhsanpham'];

                            }
                            else
                                hinhsanpham = $('.btn-add-cart').attr("data-hinhsanpham");

                            giasanphammoi = giasanpham - (giasanpham * (giamgia / 100));
                            id_sanphamchitiet = datasanphamchitiet[i]['id_sanphamchitiet'];
                            tontai = true;
                            break;

                        }

                    }

                    if (!tontai) {
                        $("a[title='" + hinhsanpham + "']").click();
                        $(".soluongsanpham").html("Sản phẩm tạm hết hàng");
                        $(".giasanpham").html("0 &#8363;");
                        $(".giasanphammoi").html("0 &#8363;");
                        $('.btn-add-cart').html("Tạm hết hàng").prop("disabled", true)
                    }
                    else {

                        if (soluongsanpham == 0) {
                            $("a[title='" + hinhsanpham + "']").click();
                            $(".soluongsanpham").html("Sản phẩm tạm hết hàng");
                            $(".giasanpham").html("0 &#8363;");
                            $(".giasanphammoi").html("0 &#8363;");
                            $('.btn-add-cart').html("Tạm hết hàng").prop("disabled", true)
                        }
                        else {
                            $("a[title='" + hinhsanpham + "']").click();
                            $(".soluongsanpham").html("Còn " + soluongsanpham + " sản phẩm");
                            $(".giasanpham").html(format1(parseInt(giasanpham), '') + " &#8363;");
                            $(".giasanphammoi").html(format1(parseInt(giasanphammoi), '') + " &#8363;");
                            $('.btn-add-cart').html("Thêm vào giỏ hàng").prop("disabled", false)
                        }
                    }


                }
            }
        }
    })


})
