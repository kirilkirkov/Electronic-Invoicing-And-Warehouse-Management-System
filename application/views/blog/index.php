<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/public/imgs/pm-subpages.png') ?>" alt="pm:">Blog</h1>
    </div>
</div>
<div class="container" id="blog">
    <div class="row">
        <div class="col-md-3 right-side">
            <form action="" method="GET">
                <span><?= lang('find_by_keyword') ?></span>
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="find" value="<?= isset($_GET['find']) ? $_GET['find'] : '' ?>" class="search-query form-control" placeholder="<?= lang('term') ?>" />
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit">
                                <span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
            <hr>
            <div id="tags">
                <div><span><?= lang('find_by_tags') ?></span></div>
                <?php foreach (explode(',', $tags) as $tag) { ?>
                    <a href="<?= lang_url('blog?tag=' . $tag) ?>"><span class="label orange-gradient"><?= $tag ?></span></a>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-9">
            <?php foreach ($articles as $article) { ?>
                <div class="article">
                    <h2>
                        <a href="<?= lang_url('/blog/' . $article['url']) ?>"><?= $article['title'] ?></a>
                    </h2>
                    <span class="posted-on shadows-font"><b>Posted on:</b> <?= date('d.m.Y', $article['time']) ?></span>
                    <div>
                        <?= word_limiter($article['description'], 200) ?>
                    </div>
                    <a href="<?= lang_url('/blog/' . $article['url']) ?>" class="btn btn-orange pull-right">Read..</a>
                    <div class="clearfix"></div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?= $links_pagination ?>
</div>