$(document).ready(function (e) {
    var modal = UIkit.modal("#showedit");
    var modalxoa = UIkit.modal("#xoa");
    $('.sua').click(function () {

        modal.show();
        var name = $(this).attr('data-productattr_name');
        var id = $(this).attr('data-productattr_id');
        var filter = $(this).attr("data-productattr_showfilter");
        var career = $(this).attr('data-career_id');

        $('#nameedit').val(name);
        $('#idedit').val(id);
        $('#careeredit').val(career);
        filter == 1 ? $("#filteredit").prop("checked", true) : $("#filteredit").prop("checked", false);
    });
    $('.xoa').click(function () {
        modalxoa.show();
        id = $(this).attr('data-id');
        $('#idxoa').val(id);

    });
    $('.btnxoa').click(function () {
        $('#xoathuoctinh').submit();
    });


});

