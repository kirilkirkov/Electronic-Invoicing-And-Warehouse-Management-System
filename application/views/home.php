<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="carousel-main">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div id="slide-1" class="item active">
                <div class="carousel-caption">
                    <div class="pull-left left-side">
                        <span><?= lang('home_slide_tx1') ?> <span class="shadows-font"><?= lang('home_slide_free') ?></span></span>
                        <h1><?= lang('electronic_invoices') ?></h1>
                        <a href="<?= base_url('features') ?>"><?= lang('check_our_options') ?></a>
                        <img alt="pmTicket arrow" class="hand-made-arrow  hidden-xs" src="<?= base_url('assets/public/imgs/hand-made-arrow.png') ?>">
                        <img alt="pmTicket arrow" class="hand-made-cicle" src="<?= base_url('assets/public/imgs/hand-made-cicle.png') ?>">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalRegister" class="shadows-font down">
                            <h4><?= lang('home_slide_register_now') ?></h4>
                        </a>
                    </div>
                    <img class="pull-right img-responsive mac hidden-xs" alt="pminvoice.com" src="<?= base_url('assets/public/imgs/first-mac.png') ?>">
                </div>
            </div>
            <div id="slide-2" class="item">
                <div class="carousel-caption">
                    <div class="pull-left left-side">
                        <img alt="pmTicket arrow" class="hand-made-down" src="<?= base_url('assets/public/imgs/handmade-arrow-down.png') ?>">
                        <img alt="pmTicket arrow" class="hand-made-cicle" src="<?= base_url('assets/public/imgs/hand-made-cicle.png') ?>">
                        <h3 class="shadows-font use-it">Use it online</h3>
                        <p>
                            There is <span>NO need</span> to download nothing. You can use it absolutley<br> 
                            online and save your data to our high protected servers. <br> 
                            You will have support <span>everyday and hour</span>.
                        </p>
                    </div>
                    <div class="pull-right  hidden-xs">
                        <h3 class="right-h3">We will support you</h3>
                        <h4 class="text-right">Make it easy!</h4>
                        <a href="<?= base_url('one-month-free-usage-project-management-system') ?>" class="btn btn-orange pull-right">Check our plans</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div id="after-carousel">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <p><?= lang('text_register_after_carousel') ?> <em class="shadows-font"><?= lang('text_free_after_carousel') ?></em> <?= lang('text_account_after_carousel') ?></p>
                <span><?= lang('text_bottom_after_carousel') ?></span>
            </div>
            <div class="col-sm-4 right-side">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalRegister" class="btn btn-orange uppercase pull-right"><?= lang('register_now') ?></a>
            </div>
        </div>
    </div>
</div>
<div class="feature-badges">
    <div class="container">
        <ul class="icons-features">
            <li>
                <a href="">
                    <img src="<?= base_url('assets/public/imgs/flat-icons/accounts.png') ?>" alt="">
                    <span><?= lang('one_acc') ?></span>
                </a>
            </li>
            <li>
                <a href="">
                    <img src="<?= base_url('assets/public/imgs/flat-icons/email.png') ?>" alt="">
                    <span><?= lang('send_by_email') ?></span>
                </a>
            </li>
            <li><a href="">
                    <img src="<?= base_url('assets/public/imgs/flat-icons/pdf-flat.png') ?>" alt="">
                    <span><?= lang('down_pdf') ?></span>
                </a>
            </li>
            <li>
                <a href="">
                    <img src="<?= base_url('assets/public/imgs/flat-icons/sign.png') ?>" alt="">
                    <span><?= lang('el_sign') ?></span>
                </a>
            </li>
            <li>
                <a href="">
                    <img src="<?= base_url('assets/public/imgs/flat-icons/support.png') ?>" alt="">
                    <span><?= lang('24_support') ?></span>
                </a>
            </li>
            <li>
                <a href="">
                    <img src="<?= base_url('assets/public/imgs/flat-icons/template.png') ?>" alt="">
                    <span><?= lang('inv_templates') ?></span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="container">
    <div id="intro">
        <h2 class="text-center"><?= lang('what_is') ?> <img src="<?= base_url('assets/public/imgs/pm-small-bg_backgr.png') ?>" alt="pm:"><span class="orange-gradient">Invoice</span> <?= lang('and_how_it_works') ?></h2>
        <div class="deliver"></div>
        <p>
            We are present you software for create and send invoices absolutley online. 
            Your data will be stored to our high protected servers to prevent you from data loss. 
            You can choose the best template design for your invoices to have professional view.
            Invoices can be signed with electronic signature.
            <br>
            Our support team will waiting for all yours questions and help need.
        </p>
    </div>
    <hr>
    <div id="become-member">
        <h2 class="text-center"><?= lang('become_member_in_3') ?></h2>
        <div class="text-center">
            <img src="<?= base_url('assets/public/imgs/customers-label.png') ?>" alt="200+ customers">
        </div>
        <div class="deliver"></div>
        <img src="<?= base_url('assets/public/imgs/home_steps.jpg') ?>" class="img-responsive" alt="Registration steps in pmticket.com">
    </div>
    <hr> 
    <div id="carousel-blog">
        <h2 class="text-center"><?= lang('comming_features') ?></h2> 
        <div class="deliver"></div>
        <div class="carousel slide" data-ride="carousel" id="quote-carousel">
            <ol class="carousel-indicators">
                <?php
                $num_articles = count($last_articles);
                for ($s = 0; $s <= $num_articles - 1; $s++) {
                    ?>
                    <li data-target="#quote-carousel" data-slide-to="<?= $s ?>" <?= $s == 0 ? ' class="active"' : '' ?>></li>
                <?php } ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($last_articles as $article) {
                    ?>
                    <div class="item <?= $i == 0 ? 'active' : '' ?>">
                        <blockquote>
                            <div class="row">
                                <div class="col-sm-3 text-center">
                                    <div class="text-center date-body">
                                        <label class="date-title"><?= date('F/Y', $article['time']) ?></label>
                                        <div class="date-content">
                                            <p class="dia"><?= date('m', $article['time']) ?></p>
                                            <hr class="nomargin"/>
                                            <p class="nomargin"><strong>published</strong></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <p><i class="fa fa-quote-left" aria-hidden="true"></i> <a href="<?= base_url($article['url']) ?>"><?= character_limiter($article['title'], 50) ?></a></p>
                                    <small><?= character_limiter(strip_tags($article['description']), 80) ?></small>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>
            <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
            <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
        </div>      
    </div>
</div> 