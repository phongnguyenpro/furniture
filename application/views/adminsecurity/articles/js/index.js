$(document).ready(function (e) {

    $('.chondanhmuc').click(function (e) {
        $('.danhmucsanpham').slideToggle();
        e.stopPropagation();
    })

    var table = $('#dt_tableTools1').DataTable({

        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": BASE_URL + "application/views/adminsecurity/public/bower_components/datatables-tabletools/swf/copy_csv_xls_pdf.swf",
            "aButtons": ["copy", "xls", "print"]
        },
        "lengthMenu": [[5, 20, 30, 40, 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, -1], [5, 20, 30, 40, 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, "All"]],

        "language": {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không có dữ liệu",
            "info": "Trang hiển thị _PAGE_ / _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(Lọc từ _MAX_ bài viết)",

        },
        stateSave: true,
        "stateSaveParams": function (settings, data) {
            //  console.log(data);
            //   data.order[0]= [1, " desc "];
        },
        "processing": true,
        "serverSide": true,

        "ajax": {
            "url": ADMIN_URL + "articles/articles_ajax/" + $('.id_danhmuc:checked').val(),
            "type": "POST",
        },

        "columns": [
            null,
            {"searchable": false},
            {"searchable": false, "orderable": false},
            null,
            null,
            {"searchable": false, "orderable": false},
            {"searchable": false, "orderable": false},
            {"searchable": false, "orderable": false},
        ],

        "createdRow": function (row, data, dataIndex) {
            $(row).attr('data-id', data[0] + '.' + data[1]);
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
//table.order( [ 1, 'desc' ] ).draw();
// table.column( 1 ).visible( false );
    table.column(0).visible(true);

    $('input:radio[name=articlescategory_id]').change(function () {

        alert("Allot Thai Gayo Bhai");

    });
    $('.btnlietke').click(function () {
        $('.chondanhmuc').children("span").html($('.id_danhmuc:checked').parent().next().text());
        $('.danhmucsanpham').slideToggle();
        table.ajax.url(ADMIN_URL + "articles/articles_ajax/" + $('.id_danhmuc:checked').val()).load();


    })

    var nestable = UIkit.sortable($(".uk-sortable"));

    $('#capnhatthutu').click(function () {

        var data = $(".uk-sortable").data("sortable").serialize();
        datamenu = JSON.stringify(data); // lấy giá trị
        $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')
        $.post(URL + "administrator247/baiviet/sortbaiviet", {'baiviet': datamenu}, function (o) {
            if (o.tinhtrang == 1) {
                $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')
                table.ajax.reload(null, false);

            }
        }, 'JSON')

    })


    $(document).on('change', '.hienthi', function () {
        id_baiviet = $(this).attr('data-id');
        if ($(this).prop('checked'))
            giatri = 1;
        else
            giatri = 0;
        thongbaoload();
        $.post(URL + "administrator247/baiviet/hienthi", {
            "hienthi": true,
            'id_baiviet': id_baiviet,
            "giatri": giatri
        }, function (o) {
            if (o.tinhtrang == 1)
                thongbaothanhcong();
        }, "JSON")


    })

    $(document).on('change', '.noibat', function () {
        id_baiviet = $(this).attr('data-id');
        if ($(this).prop('checked'))
            giatri = 1;
        else
            giatri = 0;
        thongbaoload();
        $.post(URL + "administrator247/baiviet/hienthi", {'id_baiviet': id_baiviet, "giatri": giatri}, function (o) {
            if (o.tinhtrang == 1)
                thongbaothanhcong();
        }, "JSON")

    })
    var modalxoa = UIkit.modal("#xoa");
    $(document).on('click', '.xoa', function () {
        modalxoa.show();
        id_sanpham = $(this).attr('data-id');
        $('.btnxoa').prop('value', id_sanpham);
    })

    $('.btnxoa').click(function () {


        $('.btnxoa').prop("disabled", true);
        $('#thongbaoxoa').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang xóa bài viết</div>');
        id_baiviet = $(this).val();
        $.post(URL + "administrator247/baiviet/xoabaiviet", {"id_baiviet": id_baiviet}, function (o) {
            if (o.tinhtrang == 1)
                modalxoa.hide();
            $('tr[id=' + id_sanpham + ']').fadeOut("slow", function () {
                $(this).remove();
            });
            $('.btnxoa').prop("disabled", false);
            $('#thongbaoxoa').html("Bạn có muốn xóa bài viết này");
        }, "JSON")


    })
//  
//  $('body').click(function(e){
//       $('.danhmucsanpham').hide();
//       e.stopPropagation();
//  })
//  
//    $('ul.danhmuc').click(function(){
//      return false;
//  })
})