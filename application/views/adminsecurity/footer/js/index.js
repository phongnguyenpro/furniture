$(document).ready(function () {

    var nestable = UIkit.nestable($(".uk-nestable"), {group: 'group-lists', maxDepth: 10});


    nestable.on({'stop.uk.nestable': function () {


        }});
    $(".btn-luu").click(function () {
        var data = $(".uk-nestable").data("nestable").serialize();
        datafooter = JSON.stringify(data);
        $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

        $.post(ADMIN_URL + 'footer/sort_footer', {'footer': datafooter}, function (o) {
            if (o.tinhtrang = 1)
            {
                $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')

            }
        })
    })





    var modal = UIkit.modal("#showedit");

    var modalcreate = UIkit.modal("#showcreate");

    $(document).on('click', '.itemedit', function () {
        modal.show();

        id = $(this).parents('li').attr('data-id');

        $.post(ADMIN_URL + 'footer/load_footer_edit', {"id": id}, function (o) {
            if (o.tinhtrang == 1)
            {

                $('#loadeditfooter').html(o.html);
            }

        }, 'JSON')
    })

    $(document).on('submit', '#savefooter', function () {


        var Form = document.querySelector('form#savefooter');
        var formdata = new FormData(Form);
        id = $(this).find("input[name=menu_id]").val();
        name = $(this).find("input[name=menu_name]").val();
        $('#loadeditfooter').html('<div class="uk-modal-spinner"></div>');
        var http = new XMLHttpRequest();
        http.open("POST", ADMIN_URL + 'footer/update', true);
        http.send(formdata);
        http.onreadystatechange = function (event) {
            if (http.readyState == 4 && http.status == 200)
            {

                var result = JSON.parse(http.responseText);
                if (result.status == 1)
                {
                    $('li[data-id=' + id + ']').children().children().next('span').text(name);
                    modal.hide();

                }
            }
        }
        return false;

    })

    $('#createfooter').submit(function () {

        var x = $(this).serializeArray();
        var data = new Array();

        $.each(x, function (i, field) {
            data.push(field)
        });

        datasend = JSON.parse(JSON.stringify(data));
        console.log(datasend);
        $.post(ADMIN_URL + 'footer/insert', {'data': data}, function (o) {
            if (o.status == 1)
            {
                id = o.id;
                html = '<li data-id="' + id + '" class="uk-nestable-item">' +
                        '<div class="uk-nestable-panel"><div class="uk-nestable-toggle" data-nestable-action="toggle"></div>   <span>' + o.name + '</span>   <a class="itemedit uk-badge"> <i class="uk-icon-pencil-square-o"></i> Chỉnh sửa</a>---<a class="deletemenu uk-badge uk-badge-danger" ref="' + o.id + '"><i class="uk-icon-times"></i>Xóa</a></div> </li>';
                $(".uk-nestable").append(html);
                modalcreate.hide();

            }

        }, 'JSON')
        return false;
    })

    $(document).on('click', '.deletemenu', function () {
        var current = $(this);
        var r = confirm("Bạn có chắc!");
        if (r == true) {
            var data = $(".uk-nestable").data("nestable").serialize();
            datafooter = JSON.stringify(data);
            $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

            $.post(ADMIN_URL + 'footer/sort_footer', {'footer': datafooter}, function (o) {
                if (o.status = 1)
                {
                    $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')

                    id = current.attr('ref');
                    $.post(ADMIN_URL + 'footer/delete', {'id': id}, function (o) {
                        if (o.status == 1)
                        {
                            $('li[data-id=' + id + ']').remove();
                        }
                    }, 'JSON')
                }
            })

        }

    })
});  