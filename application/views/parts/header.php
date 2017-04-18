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
        <script src="<?= base_url('loadlanguage/all.js') ?>"></script>
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
                            <form method="POST" action="<?= lang_url('login') ?>">
                                <div class="form-group">
                                    <span><?= lang('login_email') ?></span>
                                    <input type="text" name="email" placeholder="name@example.com" class="my-addr">
                                </div>
                                <div class="form-group">
                                    <span><?= lang('login_pass') ?></span>
                                    <input type="password" name="password" class="my-addr">
                                </div>
                                <div class="form-group">
                                    <div class="pull-right">
                                        <a href="<?= lang_url('password-forgotten') ?>" class="forgot"><?= lang('forgotten_pass') ?></a>
                                        <input type="submit" class="btn btn-orange logme" value="<?= lang('btn_logme') ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        <a class="login" data-toggle="collapse" href="#collapseLogin" aria-expanded="false" aria-controls="collapseExample"><?= lang('btn_login') ?> <i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        <span class="support-top">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <a href="mailto:support@domain.com">support@domain.com</a>
                        </span>
                        <div id="site-top">
                            <h1 class="pull-right"><?= lang('header_text') ?></h1>
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
                                    <img src="<?= base_url('assets/public/imgs/logo.png') ?>" alt="pminvoice.com">
                                </a>
                            </div>
                            <div id="navbar" class="collapse navbar-collapse pull-right">
                                <ul class="nav navbar-nav">
                                    <li <?= uri_string() == '' ? ' class="active"' : '' ?>><a href="<?= lang_url() ?>"><?= lang('btn_home') ?></a></li>
                                    <li <?= uri_string() == 'registration' ? ' class="active"' : '' ?>><a href="javascript:void(0);" data-toggle="modal" data-target="#modalRegister"><?= lang('btn_register') ?></a></li>
                                    <li><a href=""><?= lang('btn_plans') ?></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= lang('btn_features') ?> <span class="caret"></span></a>
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
                                    <li><a href="<?= lang_url('help') ?>"><?= lang('btn_help') ?></a></li>
                                    <li><a href="<?= lang_url('contacts') ?>"><?= lang('btn_contacts') ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>