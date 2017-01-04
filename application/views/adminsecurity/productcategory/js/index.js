$(document).ready(function () {
    var nestable = UIkit.nestable($(".uk-nestable"), {group: 'group-lists', maxDepth: 10});

    nestable.on({
        'stop.uk.nestable': function () {
        }
    });

    $(".btn-luu").click(function () {

        var data = $(".uk-nestable").data("nestable").serialize();
        datamenu = JSON.stringify(data);
        $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

        $.post(ADMIN_URL + 'productcategory/sort_category', {'productcategory': datamenu}, function (o) {
            if (o.status == 1) {
                $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')
            } else if (o.status == 2) {
                $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger">Cập nhật thất bại</div>');
                NotAccess(o);
            }
        }, 'JSON')
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

        $.post(ADMIN_URL + 'productcategory/load_category_edit', {"id": id}, function (o) {
            if (o.status == 1) {
                $('#loadeditmenu').html(o.html);
            } else if (o.status == 2) {
                modal.hide();
                NotAccess(o);
            }
        }, 'JSON')
    });

    $(document).on('submit', '#savecategory', function () {

        var Form = document.querySelector('form#savecategory');
        var formdata = new FormData(Form);
        id = $(this).find("input[name=productcategory_id]").val();
        name = $(this).find("input[name=productcategory_name]").val();
        $('#loadeditmenu').html('<div class="uk-modal-spinner"></div>');
        var http = new XMLHttpRequest();
        http.open("POST", ADMIN_URL + 'productcategory/update', true);
        http.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        http.send(formdata);
        http.onreadystatechange = function (event) {
            if (http.readyState == 4 && http.status == 200) {
                var ketqua = JSON.parse(http.responseText);
                if (ketqua.status == 1) {
                    $('li[data-id=' + id + ']').children().children().next('span').text(name);
                    modal.hide();
                } else if (ketqua.status == 2) {
                    modal.hide();
                    NotAccess();
                }
            }
        };
        return false;
    });

    $(':input[name=productcategory_name]').keyup(function () {
        str = $(this).val();
        $(':input[name=productcategory_slug]').prop('value', ChangeToSlug(str));
    });

    $(document).on("keyup", ':input[name=productcategory_name]', function () {
        id = $(':input[name=productcategory_id]').val();
        str = ChangeToSlug($(this).val());
        strview = BASE_URL + "danh-muc/" + id + "/" + str;
        $(':input[name=productcategory_slug]').prop('value', str);
        $(':input#slugview').prop('value', strview);
    });
    $(document).on("keyup", ':input[name=productcategory_slug]', function () {
        id = $(':input[name=productcategory_id]').val();
        strview = URL + "danh-muc/" + id + "/" + $(this).val();
        $(':input#slugview').prop('value', strview);
    });

    $('#createmenu').submit(function () {

        var x = $(this).serialize();
        //  $.each(x, function (i, field) {
        //      data.push(field)
        //   });
        $.post(ADMIN_URL + 'productcategory/insert', x, function (o) {
            if (o.status == 1) {
                id = o.id;
                html = '<li data-id="' + id + '" class="uk-nestable-item">' +
                    '<div class="uk-nestable-panel"><div class="uk-nestable-toggle" data-nestable-action="toggle"></div>   <span>' + o.name + '</span>   <a  class="itemedit uk-badge"> <i class="uk-icon-pencil-square-o"></i> Chỉnh sửa</a>---<a class="deletemenu uk-badge uk-badge-danger" ref="' + o.id + '"><i class="uk-icon-times"></i>Xóa</a></div> </li>';
                $(".uk-nestable").append(html);
                modalcreate.hide();
            } else if (o.status == 2) {
                modalcreate.hide();
                NotAccess(o);
            }
        }, 'JSON');
        return false;
    });

    $(document).on('click', '.deletemenu', function () {
        var id = $(this).attr('ref');

        $_deletecategory = function () {
            var data = $(".uk-nestable").data("nestable").serialize();
            datamenu = JSON.stringify(data);
            $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')
            $.post(ADMIN_URL + 'productcategory/sort_category', {'productcategory': datamenu}, function (o) {
                if (o.status == 1) {
                    $.post(ADMIN_URL + 'productcategory/delete', {'id': id}, function (o) {
                        if (o.status == 1) {
                            $('li[data-id=' + id + ']').remove();
                            $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')
                        } else if (o.status == 2) {
                            $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger">Cập nhật thất bại</div>');
                            NotAccess(o);
                        }
                    }, 'JSON')
                }
            }, 'JSON')
        };
        UIkit.modal.confirm("Bạn có chắc muốn xóa danh mục này", $_deletecategory);
    })
});
