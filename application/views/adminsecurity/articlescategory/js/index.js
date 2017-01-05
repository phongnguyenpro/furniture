$(document).ready(function () {
    var nestable = UIkit.nestable($(".uk-nestable"), {group: 'group-lists', maxDepth: 10});

    nestable.on({
        'stop.uk.nestable': function () {

            var data = $(".uk-nestable").data("nestable").serialize();
            datamenu = JSON.stringify(data);
            $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

            $.post(ADMIN_URL + 'articlescategory/sort', {'danhmucbaiviet': datamenu}, function (o) {
                if (o.status == 1) {
                    $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')
                } else if (o.status == 2) {
                    $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger">Cập nhật thất bại, tài khoản không được cấp quyền.</div>')
                    NotAccess();
                }
            }, 'JSON')
        }
    });

    var modal = UIkit.modal("#showedit");

    var modalcreate = UIkit.modal("#showcreate");

    modal.on({

//    'show.uk.modal': function(){
//        console.log("Modal is visible.");
//    },

        'hide.uk.modal': function () {
            $('#loadeditmenu').html('     <div class="uk-modal-spinner"></div>');
        }
    });

    $(document).on('click', '.itemedit', function () {
        modal.show();

        id = $(this).parents('li').attr('data-id');

        $.post(ADMIN_URL + 'articlescategory/load_info_articles_category', {"id": id}, function (o) {
            if (o.status == 1) {
                $('#loadeditmenu').html(o.html);
            } else if (o.status == 2) {
                NotAccess();
                modal.hide();
            }
        }, 'JSON')
    });

    $(document).on('submit', '#savemenu', function () {

        var Form = document.querySelector('form#savemenu');
        var formdata = new FormData(Form);

        id = $(this).find("input[name=articlescategory_id]").val();
        name = $(this).find("input[name=articlescategory_name]").val();

        //$("div.id_100 select").val("val2");
        $('#loadeditmenu').html('<div class="uk-modal-spinner"></div>');
        var http = new XMLHttpRequest();
        http.open("POST", ADMIN_URL + 'articlescategory/update_info_articles_category', true);
        http.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        http.send(formdata);
        http.onreadystatechange = function (event) {
            if (http.readyState == 4 && http.status == 200) {
                var ketqua = JSON.parse(http.responseText);
                if (ketqua.status == 1) {
                    $('li[data-id=' + id + ']').children().children().next('span').text(name);
                    modal.hide();
                } else if (ketqua.status == 2) {
                    NotAccess();
                    modal.hide();
                }
            }
        };
        return false;
    });

    $(':input[name=articlescategory_name]').keyup(function () {
        str = $(this).val();
        $(':input[name=articlescategory_slug]').prop('value', ChangeToSlug(str));
    });

    $(document).on("keyup", ':input[id=tenedit]', function () {
        id = $(':input[id=idedit]').val();
        str = ChangeToSlug($(this).val());
        strview = BASE_URL + "danh-muc-bai-viet/" + id + "/" + str;
        $(':input[id=slugedit]').prop('value', str);
        $(':input[id=slugview]').prop('value', strview);
    });

    $(document).on("keyup", ':input[id=slugedit]', function () {
        id = $(':input[id=idedit]').val();
        strview = BASE_URL + "danh-muc-bai-viet/" + id + "/" + $(this).val();
        $(':input[id=slugview]').prop('value', strview);
    });

    $('#createdanhmucbaiviet').submit(function () {

        var x = $(this).serializeArray();
        var data = new Array();

        $.each(x, function (i, field) {
            data.push(field)
        });
        datasend = JSON.parse(JSON.stringify(data));
        $.post(ADMIN_URL + 'articlescategory/create_articles_category', {'data': data}, function (o) {
            if (o.status == 1) {
                id = o.id;
                html = '<li data-id="' + id + '" class="uk-nestable-item">' +
                    '<div class="uk-nestable-panel"><div class="uk-nestable-toggle" data-nestable-action="toggle"></div>   <span>' + o.name + '</span>   <a  class="itemedit uk-badge"> <i class="uk-icon-pencil-square-o"></i> Chỉnh sửa</a>---<a class="deletemenu uk-badge uk-badge-danger" ref="' + o.id + '"><i class="uk-icon-times"></i>Xóa</a></div> </li>';
                $(".uk-nestable").append(html);
                modalcreate.hide();
            } else if (o.status == 2) {
                NotAccess();
                modalcreate.hide();
            }
        }, 'JSON');
        return false;
    });

    $(document).on('click', '.deletemenu', function () {

        var r = confirm(" Bạn có chắc ? ");
        if (r == true) {
            id = $(this).attr('ref');
            $.post(ADMIN_URL + 'articlescategory/delete_articles_category', {'id': id}, function (o) {
                if (o.status == 1) {
                    $('li[data-id=' + id + ']').remove();
                } else if (o.status == 2) {
                    NotAccess();
                }
            }, 'JSON')
        }
    })
});