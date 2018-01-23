<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/public/imgs/pm-subpages.png') ?>" alt="pm:"><?= lang('blog_preview') ?></h1>
    </div>
</div>
<div class="container" id="postPreview">
    <h1><?= $article['title'] ?></h1>
    <?php if ($article['image'] != null) { ?>
        <div>
            <img src="<?= base_url('attachments/blogimages/' . $article['image']) ?>" class="img-thumbnail">
        </div>
    <?php } ?>
    <span class="posted-on shadows-font"><b>Posted on:</b> <?= date('d.m.Y', $article['time']) ?></span>
    <div>
        <?= $article['description'] ?>
    </div>
</div>