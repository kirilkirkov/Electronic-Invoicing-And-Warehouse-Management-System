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
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
        <link href="<?= base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/users/css/general.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/bootstrap-select-1.12.2/dist/css/bootstrap-select.min.css') ?>" rel="stylesheet">
        <link href="<?= base_url('assets/bootstrap-datepicker-1.6.4-dist/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet">
        <script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js') ?>"></script> 
        <script src="<?= lang_url('loadlanguage/all.js') ?>"></script>
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
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand visible-xs" href="#"><?= $firmInfo['name'] ?></a>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
                                        <?= lang('change_firm') ?>
                                        <span class="sprite-caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php if (empty($myFirms)) { ?>
                                            <li><a href="#"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?= lang('dont_have_firms') ?></a></li> 
                                            <?php
                                        } else {
                                            foreach ($myFirms as $firm) {
                                                if (in_array($firm['id'], $canUseFirms)) {
                                                    ?>
                                                    <li <?= SELECTED_COMPANY_ID == $firm['id'] ? 'class="active"' : '' ?>><a href="<?= lang_url('user/usecompany/' . $firm['id']) ?>"><?= SELECTED_COMPANY_ID == $firm['id'] ? '<i class="fa fa-check" aria-hidden="true"></i>' : '' ?> <?= $firm['name'] ?></a></li> 
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <li class="divider hidden-xs"></li>
                                        <li><a href="<?= lang_url('user/managefirms') ?>" class="manage-firms"><?= lang('manage_firms') ?></a></li>
                                    </ul>
                                </li>
                                <li><a class="settings" href="<?= lang_url('user/settings') ?>"><span class="sprite-cog"></span> <?= lang('settings') ?></a></li>
                            </ul> 
                            <form class="navbar-form navbar-left top-search-form" role="search">
                                <div class="form-group">
                                    <input class="field" type="text" placeholder="<?= lang('search_header_u') ?>">
                                    <span class="sprite-search"></span>
                                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    <div id="topSearchResults"></div>
                                </div>
                            </form> 
                            <ul class="nav navbar-nav navbar-right">
                                <?php if (!defined('EMPLOYEE_ID')) { ?>
                                    <li><a href="<?= lang_url('user/admin') ?>"><?= lang('usr_admin_menu') ?></a></li>
                                <?php } ?>
                                <li><a href="<?= lang_url('user/plans') ?>"><?= lang('plans') ?></a></li>
                                <li><a class="logout" href="<?= lang_url('user/logout') ?>"><?= lang('logout') ?></a></li>
                            </ul>
                            <?php
                            $cleanUriString = uri_string();
                            if (mb_strlen($this->uri->segment(1)) == 2) {
                                $cleanUriString = str_replace($this->uri->segment(1) . '/', '', uri_string());
                            }
                            ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= lang('language') ?><span class="sprite-caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= base_url($cleanUriString) ?>">English</a></li>
                                        <li><a href="<?= base_url('bg/' . $cleanUriString) ?>">Български</a></li>
                                        <li><a href="<?= base_url('fr/' . $cleanUriString) ?>">Français</a></li>
                                    </ul>
                                </li>    
                            </ul>
                        </div>
                    </div>
                </nav>
                <?php if (!empty($myFirms)) { ?>
                    <header>
                        <div class="container-fluid"> 
                            <div class="row">
                                <div class="col-sm-6 col-firm-info"> 
                                    <h1>
                                        <?php if (is_file('attachments/' . COMPANIES_IMAGES_DIR . '/' . $firmInfo['id'] . '/' . $firmInfo['image'])) { ?>
                                            <img src="<?= base_url('attachments/' . COMPANIES_IMAGES_DIR . '/' . $firmInfo['id'] . '/' . $firmInfo['image']) ?>" alt="<?= lang('no_image') ?>">
                                        <?php } ?>                                       
                                        <?= $firmInfo['name'] ?>
                                    </h1>
                                </div>
                                <div class="col-sm-6 col-stats">
                                    <div class="stats">
                                        <div class="stat">
                                            <span class="sprite-inv-docs icon"></span> <span class="num"><?= $planUnits['num_invoices'] ?></span> <?= lang('documents') ?>
                                        </div>
                                        <div class="stat">
                                            <span class="sprite-companies icon"></span> <span class="num"><?= $planUnits['num_firms'] >= count($myFirms) ? $planUnits['num_firms'] - count($myFirms) : 0 ?></span> <?= lang('companies') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-2 left-col">
                                <div class="visible-xs text-center">
                                    <button data-toggle="collapse" id="btn-show-main-menu" class="btn btn-blue" data-target="#main-menu"><?= lang('show_main_menu') ?></button>
                                </div>
                                <div id="main-menu" class="left-menu collapse">
                                    <ul>
                                        <li>
                                            <a href="<?= lang_url('user') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-home"></span>
                                                </div>
                                                <?= lang('menu_home') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/new/invoice') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-new-inv"></span>
                                                </div>
                                                <?= lang('menu_create_invoice') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/invoices') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-invoices"></span>
                                                </div>
                                                <?= lang('menu_list_invoices') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/clients') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-clients"></span>
                                                </div>
                                                <?= lang('menu_list_clients') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/items') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-items"></span>
                                                </div>
                                                <?= lang('menu_list_items') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li> 
                                        <li>
                                            <a href="<?= lang_url('user/store') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-storage"></span>
                                                </div>
                                                <?= lang('menu_list_store') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/warranties') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-war-card"></span>
                                                </div>
                                                <?= lang('menu_list_warranties') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/protocols') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-protocols"></span>
                                                </div>
                                                <?= lang('menu_list_protocols') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/reports') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-reports"></span>
                                                </div>
                                                <?= lang('menu_list_reports') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= lang_url('user/import-export') ?>">
                                                <div class="left-icon">
                                                    <span class="sprite-imp-exp"></span>
                                                </div>
                                                <?= lang('menu_list_import_export') ?> 
                                                <div class="right-arrow">
                                                    <span class="sprite-arrow-right"></span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2 col-right">
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

