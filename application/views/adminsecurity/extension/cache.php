<?php
$data = $this->data["data"];
?>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Quản trị
            </li>
            <li class="active">
                <i class="fa fa-list"></i> Cache và dữ liệu tạm
            </li>
        </ol>
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>

            <div class="uk-width-xLarge-10-10  uk-width-large-10-10">
                <div class="md-card">
                    
                     <div class="uk-grid">
                         <div class="uk-width-medium-1-1">
                             <div class="uk-alert uk-alert-info">
                                 Bạn có <?= $data['total'] ?> file dữ liệu tạm / Tổng dung lượng là  <?= $data['totalsize'] ?> bytes
                             </div>
                         </div>
                      <?php if($data['total']){ ?>
                         <div class="uk-width-medium-1-1 text-center">
                         <hr>
                             <button class="btn btn-danger btn-xoacache "><i class="icon uk-icon-trash-o"></i> XÓA DỮ LIỆU TẠM</button>
                          <hr>
                         </div>
                      <?php }?>
                </div>
            </div>
            </div>
    </div>
</div>
    <script src="<?= load_admin_view("extension/js/cache.js") ?>"> </script>