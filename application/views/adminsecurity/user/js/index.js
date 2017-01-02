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
            "infoFiltered": "(Lọc từ _MAX_ sản phẩm)",
        },
        stateSave: true,
        "stateSaveParams": function (settings, data) {
            //  console.log(data);
            //   data.order[0]= [1, " desc "];
        },
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": ADMIN_URL + "user/load_data_ssp/",
            "type": "POST",
        },

        "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
        ],
        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data[0]);
            $(row).attr('id', data[0]);
        },
        "fnInitComplete": function () {
            $(function () {
                altair_forms.init()
            })
            this.api().on('draw', function () {
                $(function () {
                    altair_forms.init()
                })

            });
        }

    })
    // table.order( [ 4, 'desc' ] ).draw();
// table.column( 1 ).visible( false );
    //table.column( 0 ).visible( true );


    var modalxoa = UIkit.modal("#xoa");
    $(document).on('click', '.btn_deleteuser', function () {
        modalxoa.show();
        user_id = $(this).attr('data-id');
        $('.btnxoa').prop('value', user_id);
    })
    $('.btnxoa').click(function () {
        $('.btnxoa').prop("disabled", true);
        $('#thongbaoxoa').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang xóa hóa đơn</div>');
        user_id = $(this).val();
        $.post(ADMIN_URL + "user/delete", {"user_id": user_id}, function (o) {
            if (o.status == 1)
            {
                   modalxoa.hide();
            $('tr[id=' + user_id + ']').fadeOut("slow", function () {
                $(this).remove();
            });
             $('#thongbaoxoa').html("Bạn có muốn xóa tài khoản này");
            }
            else
            {
                 $('#thongbaoxoa').html(o.message);
            }
             
            $('.btnxoa').prop("disabled", false);
           
        }, "JSON")


    })


})