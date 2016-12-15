         $(document).ready(function(){
         $(".changenganhnghe").hide();
$(".btn-doinganhnghe").click(function(){
    $(".changenganhnghe").slideToggle();
})
    
             $('#doiavatar').change(function(){
  fileIn=$(this)[0];

        if(ktanh($(this)))
        {
       
        
            
             var file = fileIn.files[0];
            var  reader = new FileReader();
         reader.onload = function (e) {
            
            $('#imgavatar').prop('src',e.target.result);
          
         }
          reader.readAsDataURL(file);    
         }
         else
             alert("Vui lòng chọn file ảnh");
             })
                  $(':input[name=tenbaiviet]').keyup(function(){
             str=$(this).val();
             $(':input[name=slug]').prop('value',ChangeToSlug(str));
         }) 
             
             $('#capnhatbaiviet').click(function(){
$('#frmcapnhat').submit();
             })
         })
