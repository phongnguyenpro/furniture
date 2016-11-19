
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
    })
    $('.xoa').click(function () {
        modalxoa.show();
        id = $(this).attr('data-id');
        $('#idxoa').val(id);

    })
    $('.btnxoa').click(function () {
        $('#xoathuoctinh').submit();
    })



    // ========= attr_val 
    var nestable = UIkit.sortable($(".uk-sortable"));


    nestable.on({'stop.uk.sortable': function () {

            var data = $(".uk-sortable").data("sortable").serialize();
            datamenu = JSON.stringify(data); // lấy giá trị 
            console.log(datamenu);

            $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

            $.post(ADMIN_URL + 'productattr/attr_val_sort', {'data': datamenu}, function (o) {
                if (o.status == 1)
                {
                    $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')

                }
            }, 'JSON')


        }});

    $("form#createthuoctinh").find(":input[name=attr_val_value]").keyup(function () {
        $(":input[name=attr_val_label]").prop("value", $(this).val());
    })
        $('.edit_attr_value').click(function(){
          modal.show();
       var ten=$(this).attr('data-ten');
       var id=$(this).attr('data-id');
      var nhan=$(this).attr('data-nhan');
        $('#tenedit').val(ten);
        $('#idedit').val(id);
        $('#nhanedit').val(nhan);
    })



})

