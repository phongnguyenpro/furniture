<?php 
$data=$this->data["career"];
?>

           <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Quản trị
            </li>
            <li class="active">
                <i class="fa fa-list"></i> Ngành nghề
            </li>
        </ol>  
            <div id='showedit' class="uk-modal">
    <div class="uk-modal-dialog">
      
        <div class="uk-modal-header">Chỉnh sửa</div>
        
        
         <form id="createthuoctinh" action="<?= ADMIN_URL ?>career/update" class="uk-form" style="text-align: center">
    <fieldset>
      <div class="uk-form-row">  
          <label >Tên: <input name="career_name" type="text" id="career_name_edit" placeholder=""> </label>
          <input class="hidden" name="career_id" type="text" id="career_id_edit" placeholder="">
        </div>
         
        <div class="uk-form-row "> <button  class="uk-button btnlink">Cập nhật</button></div>
    </fieldset>
</form>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>
            
          <div id='showcreate' class="uk-modal">
    <div class="uk-modal-dialog">
      
        <div class="uk-modal-header">Tạo mới ngành nghề</div>
        <form method="POST" id="createthuoctinh" action="<?= ADMIN_URL ?>career/insert" class="uk-form" style="text-align: center">
    <fieldset>
      <div class="uk-form-row">  
          <label >Tên: <input name="career_name" type="text" placeholder=""> </label>
        </div>
         
        <div class="uk-form-row "> <button  class="uk-button btnlink">Tạo mới</button></div>
    </fieldset>
</form>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>
       
            
            <div id='xoa' class="uk-modal">
    <div class="uk-modal-dialog">
      
     
         <div class="uk-modal-header">Cảnh báo</div>
        
         <div><div class="uk-margin uk-modal-content">Bạn có chắc? <b style="color: #e90">Cẩn thận</b> Tất cả dữ liệu sản phẩm sẽ bị xóa theo.</div>
           <div class="uk-modal-footer uk-text-right"> 
               <button class="uk-modal-close md-btn md-btn-flat">Cancel</button>
               
               <form class="hidden" id="xoathuoctinh" action="<?= BASE_URL ?>career/delete" >
   
  
                         <input name="idxoa" class="hidden" id="idxoa" type="text" placeholder="">
  
         </form>
              <button class="js-modal-confirm md-btn-flat-primary md-btn md-btn-flat btnxoa btnlink">Ok</button>
  

           </div></div>

    </div>
</div>
         <div class="md-card uk-margin-medium-bottom">
                <div class="md-card-content">
                    <div class="uk-overflow-container">
                      
                         
                        <div class="md-list-content">
                                        <div class="uk-grid">
                                       
                                            <div class="uk-width-1-3 "><b>ID</b></div>
                                             <div class="uk-width-1-3 "><b>TÊN NGÀNH</b></div>
                                              <div class="uk-width-1-3 "><b>TÁC VỤ</b></div>
                                              
                                        </div>
                                    </div>
                        <hr>
                      
                            <ul class="md-list md-list-addon uk-sortable sortable-handler" data-uk-sortable="{group:'connected-group'}"> 
                                                   
  <?php  foreach ($data as $key=>$value) {?>
                                 <li data-id="<?= $value['career_id'] ?>">     
                       <div class="md-list-content">
                                        <div class="uk-grid">
                                       
                                            <div class="uk-width-1-3 "><b><?= $value['career_id'] ?></b></div>
                                              <div class="uk-width-1-3 "><b><?= $value['career_name'] ?></b></div>
                                              <a  data-id="<?= $value['career_id'] ?>" data-ten="<?= $value['career_name'] ?>" class="sua">Sửa</a>
                                 <a  data-id="<?= $value['career_id'] ?>" data-ten="<?= $value['career_name'] ?>" class="xoa">Xóa</a>

                                              
                                        </div>
                       </div>
                                 </li>
                              <?php }?>  
                            </ul>                        
                    </div>
                </div>
            </div>
            <div style="text-align: center">
                                <div class="uk-flex-order-first">
                                  <button data-uk-modal="{target:'#showcreate'}" class="uk-button uk-button-success">TẠO MỚI</button>
                                </div>
                <br>     <div id="thongbaoupdate"></div>
                        
                    </div>

<script src="<?= load_admin_view("career/js/index.js") ?>"></script>