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
                        <span>Try the <span class="shadows-font">best</span></span>
                        <h1>Ticketing System</h1>
                        <a href="<?= base_url('features') ?>">Check our options and features!</a>
                        <img alt="pmTicket arrow" class="hand-made-arrow  hidden-xs" src="<?= base_url('assets/public/imgs/hand-made-arrow.png') ?>">
                        <img alt="pmTicket arrow" class="hand-made-cicle" src="<?= base_url('assets/public/imgs/hand-made-cicle.png') ?>">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalRegister" class="shadows-font down"><h4>Register now!</h4></a>
                    </div>
                    <img class="pull-right img-responsive mac hidden-xs" alt="pmTicket Mac Present" src="<?= base_url('assets/public/imgs/first-mac.png') ?>">
                </div>
            </div>
            <div id="slide-2" class="item">
                <div class="carousel-caption">
                    <div class="pull-left left-side">
                        <img alt="pmTicket arrow" class="hand-made-down" src="<?= base_url('assets/public/imgs/handmade-arrow-down.png') ?>">
                        <img alt="pmTicket arrow" class="hand-made-cicle" src="<?= base_url('assets/public/imgs/hand-made-cicle.png') ?>">
                        <h3 class="shadows-font http">http://yourfirm.pmticket.com/</h3>
                        <h3 class="shadows-font use-it">Use it online</h3>
                        <p>Choose the best plan for you and use it online. We will <br> 
                            give you <span>24/7 support</span>, you will have your own sub domain<br>
                            and will have quick accessibility <br> from anywhere!
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
                <p>Get one month <em class="shadows-font">free</em> and test functionality of pmTicket</p>
                <span>Mobile friendly(responsive), multilanguage, fast, secure and etc. project management system</span>
            </div>
            <div class="col-sm-4 right-side">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#ModalRegister" class="btn btn-orange pull-right">REGISTER NOW!</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div id="intro">
        <h2 class="text-center">What is <img src="<?= base_url('assets/public/imgs/pm-small-bg_backgr.png') ?>" alt="pm:"><span class="orange-gradient">Ticket</span> and why is it better than others</h2>
        <div class="deliver"></div>
        <p>
            Issue tracking systems are commonly used in an organization's customer support call center or development work 
            tracking to create, update, and resolve reported customer/developer issues, or even issues reported by that organization's 
            other employees.It also contains a knowledge base/wikipedia containing information on each customer, 
            resolutions to common problems, and other such data. An issue tracking system is similar to a "bugtracker",
            and often, a software company will sell both, and some bugtrackers are capable of being used as an issue tracking
            system, and vice versa. Consistent use of an issue or bug tracking system is considered one of the "hallmarks of a 
            good software team".
            <br>
            pmTicket allows you to setup unlimited number of email addresses to handle all your company's 
            mail accounts and email communication. Incoming emails are converted to support tickets allowing you to easily
            manage, organize and archive all emailed support requests in one place.
            It comes with easy users guide and developer documentation
        </p>
    </div>
    <hr>
    <div id="become-member">
        <h2 class="text-center">Become member just in 3 easy steps!</h2>
        <div class="text-center">
            <img src="<?= base_url('assets/public/imgs/customers-label.png') ?>" alt="200+ customers">
        </div>
        <div class="deliver"></div>
        <img src="<?= base_url('assets/public/imgs/home_steps.jpg') ?>" class="img-responsive" alt="Registration steps in pmticket.com">
    </div>
    <hr>
    <div id="organize-work">
        <h2 class="text-center">Organizing Your Work Life</h2>
        <div class="deliver"></div>
        <div class="row">
            <?php
            $borders = array('blue-border', 'red-border', 'green-border', 'orange-border');
            foreach ($organizes as $organize) {
                $b_key = array_rand($borders, 1);
                ?>
                <div class="col-xs-6 col-sm-4 col-md-3">
                    <div class="organize <?= $borders[$b_key] ?>">
                        <span><?= $organize['header'] ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <hr>
    <div id="carousel-blog">
        <h2 class="text-center">Recent topics</h2>
        <p class="text-center">Latest news from our blog</p>
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