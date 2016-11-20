
          <div class="page-content page-order">
        
        <div  style="overflow-x: scroll" class="panel panel-default ">
                    <div class="panel-heading red">Danh sách sản phẩm yêu thích</div>
                    <div class="panel-body">
                    <table    class="table table-bordered  cart_summary">
                    <thead>
                        <tr>
                            <th class="cart_product">Sản phẩm</th>
                            <th>Miêu tả</th>
                            <th  class="action"><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody >
                       
                           <?php foreach ($this->data['sanpham'] as $key=>$value){ ?>
                        
                        <tr>
                            <td class="cart_product">
                                <a href="<?= URL ?>san-pham/<?= $value['id_sanpham'] ?>/<?= $value['slugsanpham']  ?>">
                                <img class="img-responsive" src="<?= URL."public/upload/images/thumb_hinhsanpham/".$value['hinhdaidien'] ?>" alt="p10">
                                </a>
                            </td>
                            <td class="cart_description">
                                
                                    <p class="product-name"><a href="<?= URL ?>san-pham/<?= $value['id_sanpham'] ?>/<?= $value['slugsanpham']  ?>"><?= $value['tensanpham'] ?> </a></p>
                                <small class="cart_ref">Mã SP : <?= $value['masanpham'] ?></small><br>   
                                <span>$<?= tien($value['gia']) ?>VND</span>
                            </td>
                            <td class="action">
                                <a data-id="<?= $value['id_sanpham'] ?>"  class="xoayeuthich">Delete item</a>
                            </td>
                        </tr>
                           <?php }?>
                    </tbody>
      
                </table> 
                        
                        
                    </div>
                </div>
         <div class="cart_navigation">
                    <a class="prev-btn" href="<?= URL ?>">Tiếp tục mua hàng</a>
                   
                </div>
          </div>
    </div>
</div>