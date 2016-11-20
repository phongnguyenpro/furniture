
        
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                   <?php $this->render(THEME,"left") ?>   
                </div>
            </div>
             <div class="center_column col-xs-12 col-sm-9" id="center_column">
                  
                <h2 class="">
                    <span class="page-heading-title2"><?= $this->data['bre']['thongtindanhmucchinh']['tendanhmucbaiviet'] ?></span>
                </h2>
                 
                   <ul class="blog-posts">
                       <?php foreach ($this->data['data'] as $value){ ?>
                    <li class="post-item">
                        <article class="entry">
                            <div class="row">
                                <div class="col-sm-3 col-xs-4">
                                    <div class="entry-thumb image-hover2">
                                        <a href="<?= URL."bai-viet/".$value['id_baiviet']."/".$value['slug'] ?>">
                                            <img src="<?= URL."public/upload/images/thumb_baiviet/".$value['hinhdaidien'] ?>"  alt="Blog">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-9 col-xs-8">
                                    <div class="entry-ci">
                                        <h3 class="entry-title"><a href="<?= URL."bai-viet/".$value['id_baiviet']."/".$value['slug'] ?>"><?= $value['tenbaiviet'] ?></a></h3>
                                        <div class="entry-meta-data">
                                            <span class="author">
                                            <i class="fa fa-user"></i> 
                                            by: <a >Admin</a></span>
                                            
                                            
                                            <span class="date"><i class="fa fa-calendar"></i> <?= $value['ngaytao'] ?></span>
                                        </div>
                                      
                                        <div class="entry-excerpt">
<?= $value['ngangon'] ?>
                                        </div>
                                        <div class="entry-more">
                                            <a href="<?= URL."bai-viet/".$value['id_baiviet']."/".$value['slug'] ?>">Đọc tiếp</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>
                    <?php } ?>
                   </ul>
                 
                 <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        
                        <nav>
                            <?php
                            $totalpage=$this->data['phantrang']['totalpage'];
                            $currentpage=$this->data['phantrang']['currentpage'];
                            ?>
                          <ul class="pagination">
                          
                            <?php 
                           $url=URL."baiviet/danhmuc/".$this->data['bre']['thongtindanhmucchinh']['id_danhmucbaiviet']."/".$this->data['bre']['thongtindanhmucchinh']['slugdanhmucbaiviet'];
                      
                            ?>
                              <?= phantrang($totalpage, $currentpage, $url."/%u") ?>
                                
                          
                          </ul>
                        </nav>
                    </div>
                    <form method="GET" id="locsanpham">
                 
                   
                        
                        
                    </form>
                </div>
             </div>
            
            
        </div>
    </div>
</div>
