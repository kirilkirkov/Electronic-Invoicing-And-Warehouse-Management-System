<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= @$title ?></title>
        <meta name="description" content="<?= @$description ?>">
        <meta name="keywords" content="<?= @$keywords ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
        <link href="<?= base_url('assets/public/css/general.css') ?>" rel="stylesheet">
        <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <header>
                    <div class="container">
                        <div class="collapse" id="collapseLogin">
                            <span class="shadows-font">https://</span>
                            <input type="text" class="my-addr">
                            <span class="shadows-font">.pmticket.com</span>
                        </div>
                        <div class="clearfix"></div>
                        <a class="login" data-toggle="collapse" href="#collapseLogin" aria-expanded="false" aria-controls="collapseExample">Login <i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        <div id="site-top">
                            <h1 class="pull-right">Issue Tracking System</h1>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <nav class="navbar">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </button>
                                <a class="navbar-brand" href="<?= base_url() ?>">
                                    <img src="<?= base_url('assets/public/imgs/pmTicket-logo.png') ?>" alt="pmTicket.com logo">
                                </a>
                            </div>
                            <div id="navbar" class="collapse navbar-collapse pull-right">
                                <ul class="nav navbar-nav">
                                    <li <?= uri_string() == '' ? ' class="active"' : '' ?>><a href="<?= base_url() ?>">Home</a></li>
                                    <li <?= uri_string() == 'open-source-issue-tracking-system-with-many-features' ? ' class="active"' : '' ?>><a href="<?= base_url('open-source-issue-tracking-system-with-many-features') ?>">Features</a></li>
                                    <li <?= uri_string() == 'one-month-free-usage-project-management-system' ? ' class="active"' : '' ?>><a href="<?= base_url('one-month-free-usage-project-management-system') ?>">Plans</a></li>
                                    <li><a href="https://github.com/issue-tracking-system" target="_blank"><i class="fa fa-2x fa-github" aria-hidden="true"></i></a></li>     
                                    <li><a href="<?= base_url('blog') ?>">Blog</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-header">For beginners</li>
                                            <li><a href="<?= base_url('usage-guide-of-support-ticketing-system') ?>">Usage Guide</a></li>
                                            <li><a href="<?= base_url('more-about-ticketing-system') ?>">More about systems</a></li>
                                            <li><a href="<?= base_url('home/translate') ?>">Translate</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li class="dropdown-header">For advanced</li>
                                            <li><a href="#">Migration</a></li>
                                            <li><a href="#">Api</a></li>
                                        </ul>
                                    </li>
                                    <li <?= uri_string() == 'support-of-online-project-issue-management-system' ? ' class="active"' : '' ?>><a href="<?= base_url('support-of-online-project-issue-management-system') ?>">Support</a></li>  
                                    <li <?= uri_string() == 'about-our-support-ticketing-system' ? ' class="active"' : '' ?>><a href="<?= base_url('about-our-support-ticketing-system') ?>">About us</a></li>  
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>