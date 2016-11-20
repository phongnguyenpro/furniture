
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
               <?php $this->render(THEME,"left") ?> 
                </div>
            </div>
                <div class="center_column col-xs-12 col-sm-9 boxbaivietchitiet" id="center_column">
                    
               <h1 class="page-heading">
                    <span class="page-heading-title2"><?= $this->data['baiviet']['tenbaiviet'] ?></span>
                   
                </h1>
                <article class="entry-detail">
                    <div> <b><?= $this->data['baiviet']['ngangon'] ?></b></div>
                    <div class="entry-meta-data">
                        <span class="date"><i class="fa fa-calendar"></i> <?= $this->data['baiviet']['ngaytao'] ?></span>
                    </div>
                    <div class="noidungbaiviet"> <?= $this->data['baiviet']['noidung'] ?> </div>
                   
                    <hr>
                    <?php if(!empty($this->data['baiviet']['danhmuc'])){ ?>
                    <span class="cat">
                         
                            <?php foreach ($this->data['baiviet']['danhmuc'] as $value){ ?>
                          <i class="fa fa-folder-o"></i> <a href="<?= URL."danh-muc-bai-viet/".$value['id_danhmucbaiviet']."/".$value['slugdanhmucbaiviet'] ?>"><?= $value['tendanhmucbaiviet'] ?> </a> |
                        
                        <?php } ?>
                    </span><br>
                    <?php }?>                    
                        <div class="tag">
                          <span><i class="fa fa-key" aria-hidden="true"></i> Từ khóa:</span>
                        <?php foreach ($this->data['tag'] as $value){ ?>
                          <a class="item-tag" href="<?= URL ?>baiviet/tag/<?= $value['id_tag']."/".$value['slugtag'] ?>"><?= $value['tentag'] ?></a>
                        <?php } ?>
                        </div>
                </article>
                   
                        <hr>
                        <?php if(!empty($this->data['baivietlienquan'])){ ?>
                            <h2 class="title-lienquan">
                    <span class="page-heading-title2">Bài viết liên quan</span>
                </h2>
                        <ul class="blog-posts">
                       <?php foreach ($this->data['baivietlienquan'] as $value){ ?>
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
                        <?php } }?>
                   </ul>
      
                </div>
                
                
         
        
        
    </div>
</div>