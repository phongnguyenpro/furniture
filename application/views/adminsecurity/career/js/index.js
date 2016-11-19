    
$(document).ready(function(e) {
     var modal = UIkit.modal("#showedit");
     var modalxoa = UIkit.modal("#xoa");
    $('.sua').click(function(){
          modal.show();
        ten=$(this).attr('data-ten');
        id=$(this).attr('data-id');
        $('#career_name_edit').val(ten);
        $('#career_id_edit').val(id);
    })
  $('.xoa').click(function(){
        modalxoa.show();
         id=$(this).attr('data-id');
          $('#idxoa').val(id);
         
  })
  $('.btnxoa').click(function(){
      $('#xoathuoctinh').submit();
  })
    
    $('.btnlink').click(function(){
       
        $(this).parent().append('<div><span class="uk-icon-spinner uk-icon-spin"> </span></div>');
       $(this).hide();
    })
     var nestable = UIkit.sortable($(".uk-sortable"));


                nestable.on({'stop.uk.sortable': function () {

                        var data = $(".uk-sortable").data("sortable").serialize();
                        datamenu = JSON.stringify(data); // lấy giá trị 
                        console.log(datamenu);
                        
                        $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

                        $.post(ADMIN_URL+'career/sort_career', {'nganhnghe': datamenu}, function (o) {
                            if (o.status == 1)
                            {
                                $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')

                            }
                        },'JSON')
                        
                        
                    }});
})

