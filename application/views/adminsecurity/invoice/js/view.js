$(document).ready(function (e) {
    tinhtrang = $("#tinhtrang").val();

    $('.btn-capnhatsoluong').click(function () {
        current = $(this);
        id_hoadonchitiet = $(this).attr("data-id_hoadonchitiet");
        soluongthem = parseInt($(this).prev().val());
        id_sanphamchitiet = $(this).attr("data-id_sanphamchitiet");
        soluonghientai = parseInt($(this).attr("data-soluonghientai"));
        id_hoadon = $(this).attr("data-id_hoadon");
        dongia = $(this).attr("data-dongia");
        id_sanpham = $(this).attr("data-id_sanpham");

        data = {
            "tinhtrang": tinhtrang,
            "id_hoadon": id_hoadon,
            "id_hoadonchitiet": id_hoadonchitiet,
            "id_sanpham": id_sanpham,
            "dongia": dongia,
            "id_sanphamchitiet": id_sanphamchitiet,
            "soluongthem": soluongthem,
            "soluonghientai": soluonghientai
        };
        if (tinhtrang == 3)
            if (soluongthem >= soluonghientai) {
                alert("Hóa đơn đã thanh toán! Bạn chỉ có thể giảm số lượng sản phẩm.");
                current.prev().prop("value", soluonghientai);
                return false;
            }
        if (soluongthem > 0) {
            thongbaoload();
            $.post(ADMIN_URL + "invoice/update_quantity", {"data": data}, function (o) {
                if (o.status == 1) {
                    current.parent().next().children().text(format1(o.data.tonggiasanpham, "$") + "VND");
                    $('.tientotal').text(format1(o.data.tongtiensanpham, "$") + "VND");
                    $('.totalhoadon').text(format1(o.data.tongtienhoadon, ""));
                    current.attr("data-soluonghientai", soluongthem);
                    thongbaothanhcong();
                } else if (o.status == 2) {
                    $('#quantityInput').val(soluonghientai);
                    NotAccess();
                    thongbaothanhcong();
                } else {
                    alert(o.tinnhan);
                    thongbaothanhcong();
                    current.prev().prop("value", soluonghientai);
                }
            }, "JSON")
        }
        else {
            alert("Lỗi! Số lượng phải lớn hơn 0");
            current.prev().prop("value", soluonghientai);
        }
    });
    $('.tien').keyup(function () {
        var x = event.keyCode;
        if (x != 37 && x != 38 && x != 39 && x != 40) {
            temp = dinhdanggia($(this).val());
            $(this).prop('value', temp);
        }

    });
    $('#capnhathoadon').submit(function () {
        thongbaoload();
        Form = document.querySelector('#capnhathoadon');
        var formData = new FormData(Form);
        http = new XMLHttpRequest();
        http.open("POST", ADMIN_URL + "invoice/update_invoice", true);
        http.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        http.send(formData);
        http.onreadystatechange = function (event) {
            if (http.readyState == 4 && http.status == 200) {
                var ketqua = JSON.parse(http.responseText);
                if (ketqua.status == 1) {
                    $('.totalhoadon').text(format1(ketqua.data.tongtienhoadon, ""));
                    thongbaothanhcong();

                } else if (ketqua.status == 2) {
                    NotAccess();
                    reload_delay(3000);

                } else {
                    thongbaothanhcong();
                    alert(ketqua.tinnhan);
                }
            }
        };
        return false;
    });
    $('.thongbaothanhtoan').hide();
    $('.btnthanhtoan').click(function () {
        id = $(this).attr("data-id");
        var x;
        if (confirm("Hóa đơn này sẽ được thanh toán") == true) {
            $.post(ADMIN_URL + "invoice/invoice_payment", {"id_hoadon": id}, function (o) {

                if (o.status == 1) {
                    $('.btnthanhtoan').remove();
                    $('.thongbaothanhtoan').removeClass("alert-danger").addClass("alert-success").html("<i class='glyphicon glyphicon-ok'></i> Hóa đơn đã được thanh toán!").fadeIn();
                    $("#tinhtrang").prop("value", 3);
                    window.location.reload();
                } else if (o.status == 2) {
                    // thong bao loi
                    i = 1;
                    html = 'THANH TOÁN THẤT BẠI: <hr> Tài khoản không có quyền thanh toán hóa đơn';
                    $('.thongbaothanhtoan').addClass("alert-danger").html(html).fadeIn();
                } else {
                    // thong bao loi
                    i = 1;
                    html = 'THANH TOÁN THẤT BẠI: <hr>';
                    for (var key in o.tinnhan) {
                        var obj = o.tinnhan[key];
                        html += i + "/ " + obj + "<hr>";
                        i++;
                    }
                    $('.thongbaothanhtoan').addClass("alert-danger").html(html).fadeIn();
                }
            }, "JSON")
        }
    });
    $('.xoasanphamhoadon').click(function () {
        current = $(this);

        id_hoadonchitiet = $(this).attr("data-id_hoadonchitiet");
        id_hoadon = $(this).attr("data-id_hoadon");
        if (confirm("Bạn có chắc muốn xóa?") == true) {
            thongbaoload();
            $.post(ADMIN_URL + "invoice/delete_invoice_detail", {
                "tinhtrang": tinhtrang,
                "id_hoadonchitiet": id_hoadonchitiet,
                "id_hoadon": id_hoadon
            }, function (o) {
                if (o.status == 1) {
                    $('.tientotal').text(format1(o.data.tongtiensanpham, "$") + "VND");
                    $('.totalhoadon').text(format1(o.data.tongtienhoadon, ""));

                    current.parents('tr').fadeOut(function () {
                        $(this).remove();
                    });
                    thongbaothanhcong();
                } else if (o.status == 2) {
                    thongbaothanhcong();
                    NotAccess();
                }
            }, "JSON")
        }
    })
});