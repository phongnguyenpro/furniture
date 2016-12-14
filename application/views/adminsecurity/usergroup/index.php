<div id='showedit' class="uk-modal">
    <div class="uk-modal-dialog">
      
        <div class="uk-modal-header">Chỉnh sửa</div>
        <div id="loadeditmenu">
              <div class="uk-modal-spinner"></div>
        </div>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>

<div id='showcreate' class="uk-modal">
    <div class="uk-modal-dialog">
      
        <div class="uk-modal-header">Tạo mới</div>
        <form id="createmenu" class="form-horizontal" style="text-align: center">

      <div class="form-group">  
          <label class="col-md-3" >Tên: </label>
          <div class="col-md-9">
              <input class="form-control" name="usergroup_name" type="text" placeholder="Nhập tên menu">
          </div>
        </div>     
        <div class="uk-form-row "> <button  class="uk-button">Tạo mới</button></div>
</form>
        <div class="uk-modal-footer"> <a href="" class="uk-modal-close uk-close uk-close-alt"></a></div>

    </div>
</div>

          <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Quản trị
                            </li>
                             <li class="active">
                                <i class="fa fa-list"></i> Nhóm tài khoản
                            </li>
                        </ol>

<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                          <ul class="uk-nestable" data-uk-nestable>
                              <?= $this->data['usergroup'] ?>
                            </ul>
                        
            <div style="text-align: center">
                                <div class="uk-flex-order-first">
                                    <button  class="md-btn md-btn-primary btn-luu">LƯU</button>
                                  <button data-uk-modal="{target:'#showcreate'}" class="md-btn md-btn-success">TẠO MỚI</button>
                                </div>
                        
                        
                    </div>
                        <hr>
                        <div id="thongbaoupdate">
                                
                            </div>
                            
                </div>
            </div>
      
</div>
</div>
<script src="<?= load_admin_view("usergroup/js/index.js") ?>"> </script>