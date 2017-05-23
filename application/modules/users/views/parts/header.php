<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="<?= MY_LANGUAGE_ABBR ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/users/css/general.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/bootstrap-select-1.12.2/dist/css/bootstrap-select.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
        <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js') ?>"></script> 
        <script src="<?= base_url('loadlanguage/all.js') ?>"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <nav class="navbar navbar-user navbar-fixed-top">
                    <div class="container-fluid"> 
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span class="label label-success">
                                        <i class="fa fa-copyright" aria-hidden="true"></i>
                                    </span>
                                    <?= lang('change_firm') ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if (empty($myFirms)) { ?>
                                        <li><a href="#"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?= lang('dont_have_firms') ?></a></li> 
                                        <?php
                                    } else {
                                        foreach ($myFirms as $firm) {
                                            ?>
                                            <li <?= SELECTED_COMPANY_ID == $firm['id'] ? 'class="active"' : '' ?>><a href="<?= lang_url('user/usecompany/' . $firm['id']) ?>"><?= $firm['name'] ?></a></li> 
                                            <?php
                                        }
                                    }
                                    ?>
                                    <li class="divider"></li>
                                    <li><a href="<?= lang_url('user/managefirms') ?>" class="text-center"><?= lang('manage_firms') ?></a></li>
                                </ul>
                            </li>
                            <li><a href="<?= lang_url('user/settings') ?>"><?= lang('settings') ?></a></li>
                        </ul>
                        <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="<?= lang('search_header_u') ?>">
                            </div>
                        </form>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?= base_url('user/logout') ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                        </ul>
                    </div>
                </nav>
                <?php if (!empty($myFirms)) { ?>
                    <header>
                        <div class="container-fluid"> 
                            <div class="row">
                                <div class="col-sm-6">
                                    <h1><?= SELECTED_COMPANY_NAME ?></h1>
                                </div>
                                <div class="col-sm-6">
                                    <div class="stats">
                                        asd
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-2 left-col">
                                <div class="left-menu">
                                    <ul>
                                        <li>
                                            <a href="<?= lang_url('user') ?>">
                                                <i class="fa fa-home" aria-hidden="true"></i>
                                                <?= lang('menu_home') ?> 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/new/invoice') ?>">
                                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                <?= lang('menu_create_invoice') ?> 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/invoices') ?>">
                                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                <?= lang('menu_list_invoices') ?> 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                                <?= lang('menu_list_clients') ?> 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-buysellads" aria-hidden="true"></i>
                                                <?= lang('menu_list_items') ?> 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2">
                                <div class="right-side">
                                <?php } else { ?> 
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                                                <form class="form-verifing site-form" method="POST" action="">
                                                    <h2>
                                                        <img src="<?= base_url('assets/users/imgs/notok.png') ?>" alt="Verified">
                                                        <?= lang('no_firm_data') ?>
                                                    </h2>
                                                    <div class="form-group">
                                                        <label><?= lang('firm_name') ?></label>
                                                        <input type="text" name="firm_name" class="form-control field" value="<?= trim($this->session->flashdata('firm_name')) ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label><?= lang('firm_bulstat') ?></label>
                                                        <input type="text" name="firm_bulstat" value="<?= trim($this->session->flashdata('firm_bulstat')) ?>" class="form-control field">
                                                    </div>
                                                    <div class="form-group">
                                                        <label><?= lang('firm_reg_address') ?></label>
                                                        <textarea name="firm_reg_address" class="form-control field"><?= trim($this->session->flashdata('firm_reg_address')) ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label><?= lang('firm_city') ?></label>
                                                        <input type="text" name="firm_city" value="<?= trim($this->session->flashdata('firm_city')) ?>" class="form-control field">
                                                    </div>
                                                    <div class="form-group">
                                                        <label><?= lang('firm_mol') ?></label>
                                                        <input type="text" name="firm_mol" value="<?= trim($this->session->flashdata('firm_mol')) ?>" class="form-control field">
                                                    </div>
                                                    <button type="submit" class="btn btn-default"><?= lang('save_firm_details') ?></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

