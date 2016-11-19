<?php
$product_prop=$this->data["product_prop"];
$career_id=-1;
if(isset($_GET['career_id']))
{
    $career_id=$_GET['career_id'];
}
?>
<link id="data-uikit-theme" rel="stylesheet" href="<?= load_admin_view("public/css/sortable.css") ?>">

         
       <div id='showedit' class="uk-modal">
    <div class="uk-modal-dialog">
      
        <div class="uk-modal-header">Chỉnh sửa</div>
        
        
        <form id="createthuoctinh" method="POST" action="<?= ADMIN_URL ?>product_prop/update" class="uk-form" style="text-align: center">
    <fieldset>
  
        <div class="form-group uk-form-row">
    <label class="control-label col-sm-3" for="email">Tên thuộc tính:</label>
    <div class="col-sm-8">
        <input class="form-control" name="product_prop_name" type="text" id="tenedit" placeholder=""> 
        <input class="hidden" name="product_prop_id" type="text" id="idedit" placeholder="">
    </div>
  </div>
         <div class="form-group uk-form-row">
    <label class="control-label col-sm-3" for="email">Chọn ngành nghề:</label>
    <div class="col-sm-8">
       <select class="form-control" required="" id="careeredit" name="career_id" style="padding: 5px;" >
                            <?php foreach ($this->data["career"] as $value) { ?>
                                <option  value="<?= $value['career_id'] ?>"><?= $value['career_name'] ?></option>

                            <?php } ?>
                        </select>
    </div>
  </div>  
        <div class="uk-form-row "> <button  class="uk-button">LƯU</button></div>
    </fieldset>
</form>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>


<div id='showcreate' class="uk-modal">
    <div class="uk-modal-dialog">
      
        <div class="uk-modal-header">Tạo mới</div>
        <form id="createthuoctinh" method="POST" action="<?= ADMIN_URL ?>product_prop/insert" class="uk-form" style="text-align: center">
    <fieldset>
    
        
         <div class="form-group uk-form-row">
    <label class="control-label col-sm-3" for="email">Tên thuộc tính:</label>
    <div class="col-sm-8">
        <input class="form-control" name="product_prop_name" type="text" placeholder="">
    </div>
  </div>
          <div class="form-group uk-form-row">
    <label class="control-label col-sm-3" for="email">Chọn ngành nghề:</label>
    <div class="col-sm-8">
              <select class="form-control" required="" id="careeredit" name="career_id" style="padding: 5px;" >
                            <?php foreach ($this->data["career"] as $value) { ?>
                                <option  value="<?= $value['career_id'] ?>"><?= $value['career_name'] ?></option>

                            <?php } ?>
                        </select>
    </div>
  </div>
        
        <div class="uk-form-row "> <button  class="uk-button">TẠO</button></div>
    </fieldset>
</form>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>
         
         
          <div id='xoa' class="uk-modal">
    <div class="uk-modal-dialog">
      
     
           <div class="uk-modal-header">Cảnh báo</div>
        
       <div><div class="uk-margin uk-modal-content">Bạn có chắc?</div>
           <div class="uk-modal-footer uk-text-right"> 
               <button class="uk-modal-close md-btn md-btn-flat">Cancel</button>
               
               <form class="hidden" id="xoathuoctinh" method="POST" action="<?= ADMIN_URL ?>product_prop/delete" >
   
  
                         <input name="product_prop_id" class="hidden" id="idxoa" type="text" placeholder="">
  
         </form>
              <button class="js-modal-confirm md-btn-flat-primary md-btn md-btn-flat btnxoa btnlink">Ok</button>
  

           </div></div>

    </div>
</div>
     <div class="md-card uk-margin-medium-bottom">
    <div class="md-card-content">
                        
                        

                     <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Quản trị
                            </li>
                             <li class="active">
                                <i class="fa fa-list"></i> Đặc tính sản phẩm
                            </li>
                        </ol> 
              
                            
                            <?php 
                            $i=1;
                             foreach ($product_prop as $k=>$data)
                             {
                               $table="table".$i;
                            ?>
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                               <?= $k ?>
                                </div>
                                <div class="panel-body">
                                  <ul class=" <?= $table ?>  md-list md-list-addon uk-sortable sortable-handler">
                                                        
     <?php
                             
                             foreach ($data as $key=>$value)
                             {
                             ?> 
                                <li  data-id="<?= $value['product_prop_id'] ?>">
                                   
                                    <div class="md-list-content">
                                        <div class="uk-grid">
                                       
                                            <div class="uk-width-1-4 "><b><?= $value['product_prop_name'] ?></b></div>
                                            <div class="uk-width-1-4">
                                               
                                            </div>
                                            <div class="uk-width-1-4"><a data-nganhnghe="<?= $value['career_id'] ?>"  data-id="<?= $value['product_prop_id'] ?>" data-ten="<?= $value['product_prop_name'] ?>" class="sua label label-info">Sửa</a></div>
                                <div class="uk-width-1-4">                                          
                                           <a data-id="<?= $value['product_prop_id'] ?>" data-ten="<?= $value['product_prop_name'] ?>" class="xoa label label-danger">Xóa</a>
                                           </div>
                                        
                                        </div>
                                    </div>
                                </li>
                                   <?php } ?>
                            </ul>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function(){
                       
                                var <?= $table ?> = UIkit.sortable($(".<?= $table ?>"));

                <?= $table ?>.on({'stop.uk.sortable': function () {

                        var data = $(".<?= $table ?>").data("sortable").serialize();
                     var   datamenu = JSON.stringify(data); // lấy giá trị 
                        
                        $('#thongbaoupdate').html('<div class="uk-alert uk-alert-danger"><span class="uk-icon-spinner uk-icon-spin"> </span>Đang cập nhật</div>')

                        $.post(ADMIN_URL+'product_prop/product_prop_sort', {'data': datamenu}, function (o) {
                            if (o.status == 1)
                            {
                                $('#thongbaoupdate').html('<div class="uk-alert uk-alert-success">Cập nhật thành công</div>')


                            }
                        },'JSON')
                        
                        
                    }});
                                 
                                })
                            </script>
                             <?php $i++; }?>
                     
                            
                                      <div id="thongbaoupdate">
                                
                            </div>
                            <div style="text-align: center">
                                <div class="uk-flex-order-first">
                                  <button data-uk-modal="{target:'#showcreate'}" class="uk-button uk-button-success">TẠO MỚI</button>
                                </div>
                        
                        
                    </div>
                            
                            
                        </div>
                        
                    </div>
 
         
         


<script src="<?= load_admin_view("product_prop/js/index.js") ?>"></script>