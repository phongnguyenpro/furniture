$(document).ready(function () {

    $(document).on("click", ".yeuthich", function (e) {

        var id_sanpham = $(this).attr("data-id");
        var curren = $(this);
        if (id_sanpham != '' && id_sanpham != null && id_sanpham != 'undefined') {

            var formData = new FormData();
            formData.append("token", token);
            formData.append("id_sanpham", id_sanpham);
            var http = new XMLHttpRequest();
            http.open("POST", BASE_URL + "checksum/createchecksum", true);

            http.onreadystatechange = function (event) {
                if (http.readyState == 4 && http.status == 200) {
                    var ketqua = JSON.parse(http.responseText);
                    if (ketqua.status == 1) {
                        token = ketqua.token;
                        var checksum = ketqua.checksum;
                        formData.append("checksum", checksum);
                        http = new XMLHttpRequest();
                        http.open("POST", BASE_URL + "Product_like/like", true);
                        http.onreadystatechange = function (event) {
                            if (http.readyState == 4 && http.status == 200) {
                                ketqua = JSON.parse(http.responseText);
                                if (ketqua.status == 1) {
                                    $(".sanphamyeuthich").children("span").html(ketqua.data.length);
                                    curren.addClass("yeuthichactive");
                                    if ($(".totalyeuthich").attr("data-yeuthich") != "undefined") {
                                        $yeuthich = parseInt($(".totalyeuthich").attr("data-yeuthich")) + 1;
                                        $(".totalyeuthich").html($yeuthich);
                                    }
                                    curren.removeClass("yeuthich");
                                    curren.attr("data-id", null);
                                }
                            }
                        }
                        http.send(formData);
                    }

                }
            }
            http.send(formData);

        }

    })

    $(".xoayeuthich").click(function () {

        var curren = $(this);
        id_sanpham = $(this).attr("data-id");

        $.post(BASE_URL + "Product_like/deletelike", {"id_sanpham": id_sanpham}, function (o) {

            if (o.status == 1) {
                curren.parents("tr").fadeOut("slow", function () {
                    $(this).remove();
                })

            }
        }, "JSON")

    })

    $(".chiase").click(function () {
        url = "http://www.facebook.com/sharer.php?";
        url += "u=" + $(this).attr("data-url");
        url += "&display=popup&ref=plugin&src=like&app_id=885940871479537";

        window.open(url, toolbar = 0, status = 0);
    })
})
