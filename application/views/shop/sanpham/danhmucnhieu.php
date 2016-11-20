<?php 
$data=$this->data['data'];
$bre=$this->data['bre'];
unset($data['bre']);
?>
    
        <!-- breadcrumb -->
        
        <!-- ./breadcrumb -->
        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <?php $this->render(THEME,"left") ?> 
            </div>
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                
                
                
                <!-- category-slider -->
            
         
                <div id="view-product-list" class="view-product-list">
               
                    <?php foreach ($data as $danhmuc)
                    {?>
                    
                   <h2 class="page-heading">
                        <span class="page-heading-title">
                            <a href="<?= URL."danh-muc/".$danhmuc['thongtin']['id_danhmuc']."/".$danhmuc['thongtin']['slug'] ?>"><?= $danhmuc['thongtin']['ten'] ?> <span class="fa fa-angle-right"> xem nhiều hơn</span></a></span>
                        
                    </h2>
                    
                    <?php  if(isset($danhmuc['data'])){ ?>
                    <ul class="danhmucnhieu danhsachsanpham product-list  owl-carousel" data-items="4" data-nav="true" data-dots="false" data-margin="20" data-loop="false" data-responsive='{"0":{"items":2},"600":{"items":2},"800":{"items":2},"1200":{"items":3}}'>
                        
                    <?php 
                   
foreach ($danhmuc['data'] as $value)
{         ?>    
                        
 <li>
                          <?php
                                       if($value['noibat']==1){
                                        ?>
                                         <div class="featured-text"><span></span></div>
                                        <?php }?>
                            <div class="">
                                <div class="left-block">
                                    <a title="<?= $value['tensanpham'] ?>" href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>" class="loading">
                                        <img class="img-responsive " title="<?= $value['tensanpham'] ?>"  alt="<?= $value['tensanpham'] ?>" src="<?= URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['hinhdaidien'] ?>" />
                                    </a>
                                    <div class="quick-view">
                                            <a title="Yêu thích" data-id="<?= $value['id_sanpham'] ?>" class="heart yeuthich"   ></a>
                                    </div>
                                    <div class="add-to-cart">
                                       <?php if(kiemtranull($value['ngangon'])){ ?>
                                        <a> <?= neods($value['ngangon'],120)?></a>
                        <?php }else{} ?>
                                    </div>
                                    <?php
                                        if($value['giamgia']>0){
                                        ?>
                                    <div class="price-percent-reduction2">-<?=$value['giamgia']?>%<br>SAFE</div>
                                    <?php }?>
                                    <div class="group-price">
                                          <?php
                                        if($value['moi']==1){
                                        ?>
                                         <span class="product-new">New</span>
                                        <?php }?>                                          
                                      </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a title="<?= $value['tensanpham'] ?>" href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>"><?= $value['tensanpham'] ?></a>
                                
                                    </h5>
                                   
                                    <div class="content_price">
                                        <?php if($value['gia']!=$value['giamoi']){ ?>
                                        <span class="price product-price"><?= tien($value['giamoi'])?>&nbsp;₫</span>
                                        <span class="price old-price"><?= tien($value['gia']) ?></span>
                                        <?php }ELSE{ ?>
                                         <span class="price product-price"><?= tien($value['gia']) ?>&nbsp;₫</span>
                                        <?php } ?>
                                    </div>
                                   
                                </div>
                            </div>
                        </li>             
<?php }?>
                    </ul>
                    
                   
                    <?php } echo '
                    <hr>';  } ?>
                    
                  
                  
                    
                    <!-- PRODUCT LIST -->
                    
                    <!-- ./PRODUCT LIST -->
                </div>
                <!-- ./view-product-list-->
                
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>


