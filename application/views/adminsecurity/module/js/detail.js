$(document).ready(function () {

    var modal = UIkit.modal("#module_create");
    var modal_edit = UIkit.modal("#modal_edit");
    $(".btn_create_module").click(function () {
        modal.show();
    });

    $(".btn-edit").click(function () {
        var type = $(this).attr("data-type");
        var id = $(this).attr("data-id");
        $.post(ADMIN_URL + "module/config", {"type": type, "id_module": id}, function (o) {
            try {
                json = $.parseJSON(o);
                if (json.status == 2) {
                    NotAccess();
                }
            } catch (e) {
                $("#modal_edit").find("fieldset").html(o);
                modal_edit.show();
            }
        })
    })
});

