
$(document).ready(function (e) {
    var modal = UIkit.modal("#showedit");
    var modalxoa = UIkit.modal("#xoa");
    $('.sua').click(function () {


        modal.show();
        var ten = $(this).attr('data-ten');
        var id = $(this).attr('data-id');
        var id_nganhnghe = $(this).attr('data-nganhnghe');
        $("#careeredit").val(id_nganhnghe);
        $('#tenedit').val(ten);
        $('#idedit').val(id);
    })
    $('.xoa').click(function () {
        modalxoa.show();
        id = $(this).attr('data-id');
        $('#idxoa').val(id);

    })
    $('.btnxoa').click(function () {
        $('#xoathuoctinh').submit();
    })

})