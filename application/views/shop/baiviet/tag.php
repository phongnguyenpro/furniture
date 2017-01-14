<?php
$thongtintag = $this->data['thongtintag'];
?>

<!-- row -->
<div class="row">
    <!-- Left colunm -->
    <div class="column col-xs-12 col-sm-3" id="left_column">
        <div class="col-left">
            <?php $this->load->view(THEME . '/left'); ?>
        </div>
    </div>
<div class="center_column col-xs-12 col-sm-9" id="center_column">
    <h2 class="page-heading-title">
        <span class="page-heading-title"><?= $this->data['thongtintag']['tag_name'] ?></span>
    </h2>
    <ul class="blog-posts">
        <?php foreach ($this->data['baiviet'] as $value) { ?>
            <li class="post-item">
                <article class="entry">
                    <div class="row">
                        <div class="col-sm-3 col-xs-4">
                            <div class="entry-thumb image-hover2">
                                <a href="<?= BASE_URL . "bai-viet/" . $value['articles_slug']."-".$value['articles_id']  ?>">
                                    <img src="<?= BASE_URL . "public/upload/images/thumb_articles/" . $value['articles_avatar'] ?>"
                                         alt="Blog">
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-8">
                            <div class="entry-ci">
                                <h3 class="entry-title"><a
                                            href="<?= BASE_URL . "bai-viet/" . $value['articles_slug']."-".$value['articles_id']  ?>"><?= $value['articles_name'] ?></a>
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
                                    <a href="<?= BASE_URL . "bai-viet/" . $value['articles_slug']."-".$value['articles_id']  ?>">Đọc
                                        tiếp</a>
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
                $totalpage = $this->data['phantrang']['totalpage'];
                $currentpage = $this->data['phantrang']['currentpage'];
                $url = BASE_URL . "baiviet/tag/" . $thongtintag['tag_id'] . "/" . $thongtintag['tag_slug'] . "?page=%u";
                ?>
                <ul class="pagination">
                    <?=
                    phantrang($totalpage, $currentpage, $url);
                    ?>

                </ul>
            </nav>
        </div>
    </div>

</div>

</div>
</div>
            