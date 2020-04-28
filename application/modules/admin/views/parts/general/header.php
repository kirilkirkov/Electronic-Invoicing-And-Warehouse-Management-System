<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= @$description ?>">
        <title><?= @$title ?></title>
        <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet"> 
        <link href="<?= base_url('assets/admin/css/general.css') ?>" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>
        <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <div id="content"> 
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <i class="fa fa-lg fa-bars"></i>
                        </button>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="<?= base_url('admin') ?>"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="<?= base_url() ?>" target="_blank"><i class="glyphicon glyphicon-star"></i> Production</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?= base_url('admin/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </div>
                </nav> 
                <div class="container-fluid">
                    <div class="row"> 
                        <div class="col-sm-3 col-md-3 col-lg-2 left-side navbar-default">
                            <div class="show-menu">
                                <a id="show-xs-nav" class="visible-xs" href="javascript:void(0)">
                                    <span class="show-sp">
                                        Show menu
                                        <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
                                    </span>
                                    <span class="hidde-sp">
                                        Hide menu
                                        <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>
                            <ul class="sidebar-menu">
                                <li class="sidebar-search">
                                    <div class="input-group custom-search-form">
                                        <form method="GET" action="<?= base_url('admin/products') ?>">
                                            <div class="input-group">
                                                <input class="form-control" name="search_title" value="<?= isset($_GET['search_title']) ? $_GET['search_title'] : '' ?>" type="text" placeholder="Find user">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" value="" placeholder="Find user" type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="header">USERS</li>
                                <li><a href="<?= base_url('admin/plans/requests') ?>" <?= urldecode(uri_string()) == 'admin/plans/requests' ? 'class="active"' : '' ?>><i class="fa fa-credit-card" aria-hidden="true"></i> Plans Payment Requests</a></li>
                                <li><a href="<?= base_url('admin/plans/individual/request') ?>" <?= urldecode(uri_string()) == 'admin/plans/individual/request' ? 'class="active"' : '' ?>><i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i> Custom Plan Requests</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2">

