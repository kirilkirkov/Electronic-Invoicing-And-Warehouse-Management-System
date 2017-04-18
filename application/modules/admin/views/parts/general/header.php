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
                            <li>
                                <a href="javascript:void(0);" class="h-settings"><i class="fa fa-key" aria-hidden="true"></i> Pass Change</a>
                                <div class="relative">
                                    <div class="settings">
                                        <div class="panel panel-primary" >
                                            <div class="panel-heading">
                                                <div class="panel-title">Security</div>
                                            </div>     
                                            <div class="panel-body">
                                                <label>Change my password</label> <span class="bg-success" id="pass_result">Changed!</span>
                                                <form class="form-inline" role="form">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control new-pass-field" placeholder="New password" name="new_pass">
                                                    </div>
                                                    <a href="javascript:void(0);" onclick="changePass()" class="btn btn-sm btn-primary">Update</a>
                                                    <hr>
                                                    <span>Password Strength:</span>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-default generate-pwd">Generate Password</button> 
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#modalCalculator"><i class="fa fa-calculator" aria-hidden="true"></i> Calculator</a></li>
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
                                                <input class="form-control" name="search_title" value="<?= isset($_GET['search_title']) ? $_GET['search_title'] : '' ?>" type="text" placeholder="Search in products...">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" value="" placeholder="Find product.." type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="header">ECOMMERCE</li>
                                <li><a href="<?= base_url('admin/history') ?>" <?= urldecode(uri_string()) == 'admin/history' ? 'class="active"' : '' ?>><i class="fa fa-history"></i> Activity History</a></li>
                                <li class="header">ADVANCED SETTINGS</li>
                                <li><a href="<?= base_url('admin/languages') ?>" <?= urldecode(uri_string()) == 'admin/languages' ? 'class="active"' : '' ?>><i class="fa fa-globe"></i> Languages</a></li>
                                <li><a href="<?= base_url('admin/filemanager') ?>" <?= urldecode(uri_string()) == 'admin/filemanager' ? 'class="active"' : '' ?>><i class="fa fa-file-code-o"></i> File Manager</a></li>
                                <li><a href="<?= base_url('admin/adminusers') ?>" <?= urldecode(uri_string()) == 'admin/adminusers' ? 'class="active"' : '' ?>><i class="fa fa-user" aria-hidden="true"></i> Admin Users</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2">

