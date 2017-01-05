$(document).ready(function (e) {
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
            "url": ADMIN_URL + "invoice/load_data_ssp/",
            "type": "POST",
            "dataSrc": function (json) {
                if (json.status == 2) {
                    NotAccess();
                } else
                    return json.data;
            }
        },

        "columns": [
            {"searchable": false, "orderable": false},
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            {"searchable": false, "orderable": true},
            {"searchable": false, "orderable": false}
        ],

        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data[0] + '.' + data[1]);
            $(row).attr('id', data[1]);
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
    // table.order( [ 4, 'desc' ] ).draw();
// table.column( 1 ).visible( false );
    //table.column( 0 ).visible( true );


    var modalxoa = UIkit.modal("#xoa");
    $(document).on('click', '.xoa', function () {
        modalxoa.show();
        id_sanpham = $(this).attr('data-id');
        $('.btnxoa').prop('value', id_sanpham);
    });

    $('.btnxoa').click(function () {

        $('.btnxoa').prop("disabled", true);
        $('#thongbaoxoa').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang xóa hóa đơn</div>');
        id_hoadon = $(this).val();
        $.post(ADMIN_URL + "invoice/delete_invoice", {"id_hoadon": id_hoadon}, function (o) {
            if (o.status == 1) {
                modalxoa.hide();
                $('tr[id=' + id_hoadon + ']').fadeOut("slow", function () {
                    $(this).remove();
                });
            }else if (o.status == 2) {
                modalxoa.hide();
                NotAccess();
            }
            $('.btnxoa').prop("disabled", false);
            $('#thongbaoxoa').html("Bạn có muốn xóa hóa đơn này");
        }, "JSON")
    })
});