$(document).ready(function () {

    $(":input[name=tag_name]").keyup(function () {
        $(":input[name=tag_slug]").prop("value", ChangeToSlug($(this).val()));
    })
    var modaledittag = UIkit.modal("#edittag");
    $(".btn-edit").click(function () {
        ten = $(this).attr("data-ten");
        slug = $(this).attr("data-slug");
        id = $(this).attr(("data-id"));
        $("#edittagten").prop("value", ten);
        $("#edittagid").prop("value", id);
        $("#edittagslug").prop("value", slug);

        modaledittag.show();
    })
    $(".xoatag").click(function () {
        if (confirm("Bạn có chắc muốn xóa!") == true) {
            return true;
        } else {
            return false;
        }
    })


    var nestable = UIkit.sortable($(".uk-sortable"));
    nestable.on({
        'stop.uk.sortable': function () {

            var data = $(".uk-sortable").data("sortable").serialize();
            datamenu = JSON.stringify(data); // lấy giá trị
            console.log(datamenu);

            $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

            $.post(ADMIN_URL + 'tag/sort_tag', {'tag': datamenu}, function (o) {
                if (o.status == 1) {
                    $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')

                }
            }, 'JSON')


        }
    });
})