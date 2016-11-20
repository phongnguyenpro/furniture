<?php 
$thongtintag=$this->data['thongtintag'];
?>

        <!-- row -->
        <div class="row">
            
             <div class="column col-xs-12 col-sm-3" id="left_column">
                       <?php $this->render(THEME,"left") ?>   
                     </div>
                 </div>
            
            
            
               <div class="center_column col-xs-12 col-sm-9" id="center_column">
                   
                   
                      <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title"><?= $this->data['thongtintag']['tentag'] ?></span>
                    </h2>
                    <ul class="display-product-option">
                        <li class="view-as-grid selected">
                            <span>grid</span>
                        </li>
                        <li class="view-as-list">
                            <span>list</span>
                        </li>
                    </ul>
                          
                          <!-- PRODUCT LIST -->
                    <ul class="row product-list grid dulieusanpham">
                        <?php foreach ($this->data['sanpham'] as $value){ ?>
                        
                       <li class="col-xs-6 col-sm-4">
                            <div class="product-container">
                                <div class="left-block">
                             <a title="<?= $value['tensanpham'] ?>" href="<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>" class="loading">
                                        <img class="img-responsive b-lazy" title="<?= $value['tensanpham'] ?>"  alt="<?= $value['tensanpham'] ?>" data-src="<?= URL ?>public/upload/images/thumb_hinhsanpham/<?= $value['hinhdaidien'] ?>" />
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
                                    <?php
                                       if($value['noibat']==1){
                                        ?>
                                         <div class="featured-text"><span></span></div>
                                        <?php }?>
                                  
                                          <?php
                                        if($value['moi']==1){
                                        ?>
                                           <div class="group-price">
                                         <span class="product-new">New</span>
                                         </div>
                                        <?php }?> 
                                      
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a title="<?= $value['tensanpham'] ?>" href=<?= URL ?>san-pham/<?= $value['id_sanpham'].'/'.$value['slugsanpham'] ?>"><?= $value['tensanpham'] ?></a>
                                   
                                    </h5>
                                   
                                    <div class="content_price">
                                        
                                        <div class="info-orther">
                                            <div class="product-desc">
                                              <?= neods($value['ngangon'],120)?>
                                            </div>
                                        </div>
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
                    <!-- ./PRODUCT LIST -->
                      </div>
                   
                   <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        
                        <nav>
                            <?php
                            $totalpage=$this->data['phantrang']['totalpage'];
                            $currentpage=$this->data['phantrang']['currentpage'];
                            $url=URL."sanpham/tag/".$thongtintag['id_tag']."/".$thongtintag['slugtag']."?page=%u";
                            ?>
                          <ul class="pagination">
                              <?=
                            phantrang($totalpage,$currentpage,$url);
                             ?>
                            
                          </ul>
                        </nav>
                    </div>
                    <form method="GET" id="locsanpham">
                 
                   
                        
                        
                    </form>
                </div>
                   
                   
                   
               </div>
            
        </div>
</div>