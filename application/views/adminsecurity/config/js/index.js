$(document).ready(function () {

    $('.btntest').click(function () {

        curren = $(this);
        btnlinkload(curren);
        $.post(ADMIN_URL + "config/testmail", function (o) {
            if (o.status == 1) {
                alert("Mail đã được gửi đi");
                btnlinkthanhcong(curren, "Đã gửi thành công");
            }
            else {
                alert("Không thành công");
                btnlinkthanhcong(curren, "Thử lại");
            }

        }, "JSON")
    })
    $('#maucd').change(function () {
        $('#mauchudao').val($('#maucd').val());
    });

})

