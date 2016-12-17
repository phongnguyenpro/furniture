<div class="row">
    <!-- Left colunm -->
    <div class="column col-xs-12 col-sm-3" id="left_column">
        <?php $this->load->view(THEME . '/left'); ?>
    </div>
</div>
<div class="center_column col-xs-12 col-sm-9" id="center_column">

    <h2 class="">
        <span class="page-heading-title2"><?= $this->data['bre']['thongtindanhmucchinh']['articlescategory_name'] ?></span>
    </h2>

    <ul class="blog-posts">
        <?php foreach ($this->data['data'] as $value) { ?>
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
        <?php } ?>
    </ul>

    <div class="sortPagiBar">
        <div class="bottom-pagination">

            <nav>
                <?php
                $totalpage = $this->data['phantrang']['totalpage'];
                $currentpage = $this->data['phantrang']['currentpage'];
                ?>
                <ul class="pagination">

                    <?php
                    $url = BASE_URL . "danh-muc-bai-viet/" . $this->data['bre']['thongtindanhmucchinh']['articlescategory_id'] . "/" . $this->data['bre']['thongtindanhmucchinh']['articlescategory_slug'];

                    ?>
                    <?= phantrang($totalpage, $currentpage, $url . "?page=%u") ?>


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
