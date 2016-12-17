<div class="row">
    <!-- Left colunm -->
    <div class="column col-xs-12 col-sm-3" id="left_column">
        <?php $this->load->view(THEME . '/left'); ?>
    </div>
</div>
<div class="center_column col-xs-12 col-sm-9 boxbaivietchitiet" id="center_column">

    <h1 class="page-heading">
        <span class="page-heading-title2"><?= $this->data['baiviet']['articles_name'] ?></span>

    </h1>
    <article class="entry-detail">
        <div><b><?= $this->data['baiviet']['articles_description'] ?></b></div>
        <div class="entry-meta-data">
            <span class="date"><i class="fa fa-calendar"></i> <?= date_out($this->data['baiviet']['articles_date_create']) ?></span>
        </div>
        <div class="noidungbaiviet"> <?= $this->data['baiviet']['articles_content'] ?> </div>

        <hr>
        <?php if (!empty($this->data['baiviet']['danhmuc'])) { ?>
            <span class="cat">
                         
                            <?php foreach ($this->data['baiviet']['danhmuc'] as $value) { ?>
                                <i class="fa fa-folder-o"></i> <a
                                        href="<?= BASE_URL . "danh-muc-bai-viet/" . $value['articlescategory_id'] . "/" . $value['articlescategory_slug'] ?>"><?= $value['articlescategory_name'] ?> </a> |

                            <?php } ?>
                    </span><br>
        <?php } ?>
        <div class="tag">
            <span><i class="fa fa-key" aria-hidden="true"></i> Từ khóa:</span>
            <?php foreach ($this->data['tag'] as $value) { ?>
                <a class="item-tag"
                   href="<?= BASE_URL ?>baiviet/tag/<?= $value['tag_id'] . "/" . $value['tag_slug'] ?>"><?= $value['tag_name'] ?></a>
            <?php } ?>
        </div>
    </article>

    <hr>
    <?php if (!empty($this->data['baivietlienquan'])){ ?>
    <h2 class="title-lienquan">
        <span class="page-heading-title2">Bài viết liên quan</span>
    </h2>
    <ul class="blog-posts">
        <?php foreach ($this->data['baivietlienquan'] as $value) { ?>
            <li class="post-item">
                <article class="entry">
                    <div class="row">
                        <div class="col-sm-3 col-xs-4">
                            <div class="entry-thumb image-hover2">
                                <a href="<?= BASE_URL . "bai-viet/" . $value['articles_id'] . "/" . $value['articles_slug'] ?>">
                                    <img src="<?= BASE_URL . "public/upload/images/thumb_articles/" . $value['articles_avatar'] ?>"
                                         alt="Blog">
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-8">
                            <div class="entry-ci">
                                <h3 class="entry-title"><a
                                            href="<?= BASE_URL . "bai-viet/" . $value['articles_id'] . "/" . $value['articles_slug'] ?>"><?= $value['articles_name'] ?></a>
                                </h3>
                                <div class="entry-meta-data">
                                            <span class="author">
                                            <i class="fa fa-user"></i> 
                                            by: <a>Admin</a></span>


                                    <span class="date"><i class="fa fa-calendar"></i> <?= date_out($value['articles_date_create']) ?></span>
                                </div>

                                <div class="entry-excerpt">
                                    <?= $value['articles_description'] ?>
                                </div>
                                <div class="entry-more">
                                    <a href="<?= BASE_URL . "bai-viet/" . $value['articles_id'] . "/" . $value['articles_slug'] ?>">Đọc
                                        tiếp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </li>
        <?php }
        } ?>
    </ul>

</div>


</div>
</div>