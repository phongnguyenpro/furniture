$(document).ready(function (e) {

    $('.chondanhmuc').click(function (e) {
        $('.danhmucsanpham').slideToggle();
        e.stopPropagation();
    });

    var table = $('#dt_tableTools1').DataTable({
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": BASE_URL + "application/views/adminsecurity/public/bower_components/datatables-tabletools/swf/copy_csv_xls_pdf.swf",
            "aButtons": ["copy", "xls", "print"]
        },
        "lengthMenu": [[5, 10, 20, 30, 40, 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, -1], [5, 10, 20, 30, 40, 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, "All"]],
        "language": {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không có dữ liệu",
            "info": "Trang hiển thị _PAGE_ / _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(Lọc từ _MAX_ sản phẩm)"
        },
        stateSave: true,
        "stateSaveParams": function (settings, data) {
            //  console.log(data);
            //   data.order[0]= [1, " desc "];
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": ADMIN_URL + "product/load_data_ssp/" + $('.id_danhmuc:checked').val(),
            "type": "POST",
            "dataSrc": function (json) {
                if (json.status == 2){
                    NotAccess();
                }else
                    return json.data;
            }
        },
        "columns": [
            null,
            {"searchable": false},
            {"searchable": false, "orderable": false},
            null,
            null,
            null,
            null,
            {"searchable": false, "orderable": false},
            {"searchable": false, "orderable": false},
            {"searchable": false, "orderable": false}
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data[0]);
            $(row).attr('data-stt', data[1]);
            $(row).attr('id', data[0]);
        },
        "fnInitComplete": function () {
            $(function () {
                altair_forms.init()
            });
            this.api().on('draw', function () {
                $(function () {
                    altair_forms.init()
                })

            });
        }

    });
//table.order( [ 1, 'desc' ] ).draw();
// table.column( 1 ).visible( false );
    table.column(0).visible(true);

    $('input:radio[name=id_danhmuc]').change(function () {

        alert("Allot Thai Gayo Bhai");

    });
    $('.btnlietke').click(function () {
        $('.chondanhmuc').children("span").html($('.id_danhmuc:checked').parent().next().text());
        $('.danhmucsanpham').slideToggle();
        table.ajax.url(ADMIN_URL + "product/load_data_ssp/" + $('.id_danhmuc:checked').val()).load();
    });

    var nestable = UIkit.sortable($(".uk-sortable"));

    $('#capnhatthutu').click(function () {

        var data = $(".uk-sortable").data("sortable").serialize();
        //  datamenu = JSON.stringify(data); // lấy giá trị 
        $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')
        $.post(ADMIN_URL + "product/sort_product", {'product': data}, function (o) {
            if (o.status == 1) {
                $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>');
                table.ajax.reload(null, false);
            } else if (o.status == 2) {
                $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger">Cập nhật thất bại</div>');
                NotAccess(o);
            }
        }, 'JSON')
    });

    $(document).on('change', '.hienthi', function () {
        id_sanpham = $(this).attr('data-id');
        if ($(this).prop('checked'))
            giatri = 1;
        else
            giatri = 2;
        thongbaoload();
        $.post(ADMIN_URL + "product/update_show_feature", {
            "hienthi": true,
            'id_sanpham': id_sanpham,
            "giatri": giatri
        }, function (o) {
            if (o.status == 1)
                thongbaothanhcong();
            else if (o.status == 2) {
                NotAccess(o);
                reload_delay(3000);
            }
        }, "JSON")
    });

    $(document).on('change', '.noibat', function () {
        id_sanpham = $(this).attr('data-id');
        if ($(this).prop('checked'))
            giatri = 1;
        else
            giatri = 2;
        thongbaoload();
        $.post(ADMIN_URL + "product/update_show_feature", {'id_sanpham': id_sanpham, "giatri": giatri}, function (o) {
            if (o.status == 1)
                thongbaothanhcong();
            else if (o.status == 2) {
                NotAccess(o);
                reload_delay(3000);
            }
        }, "JSON")
    });
    var modalxoa = UIkit.modal("#xoa");
    $(document).on('click', '.xoa', function () {
        modalxoa.show();
        id_sanpham = $(this).attr('data-id');
        $('.btnxoa').prop('value', id_sanpham);
    });

    $('.btnxoa').click(function () {

        $('.btnxoa').prop("disabled", true);
        $('#thongbaoxoa').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang xóa sản phẩm</div>');
        id_sanpham = $(this).val();
        $.post(ADMIN_URL + "product/delete", {"id_product": id_sanpham}, function (o) {
            if (o.status == 1) {
                modalxoa.hide();
                $('tr[id=' + id_sanpham + ']').fadeOut("slow", function () {
                    $(this).remove();
                    $('#thongbaoxoa').html("Bạn có muốn xóa sản phẩm này");
                });
            }else if (o.status == 2) {
                modalxoa.hide();
                NotAccess();
            }else {
                $('#thongbaoxoa').html(o.message);
            }
            $('.btnxoa').prop("disabled", false);
        }, "JSON")
    })
});