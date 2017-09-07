<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('warranties') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li class="active"><?= lang('warranties') ?></li>
        </ol>
    </div> 
</div>
<div class="inner-page-menu">
    <div class="left-nav-side">
        <a href="<?= lang_url('user/warranties/add-warranty') ?>" class="btn btn-blue"><?= lang('add_warranty') ?></a>
        <a href="javascript:void(0);" class="btn btn-blue list-action" data-action-type="delete"><?= lang('delete_warranties') ?></a>
        <button data-toggle="collapse" class="btn btn-blue" data-target="#warranties-search"><?= lang('search') ?></button> 
    </div>
    <div class="right-nav-side">
        <a href="<?= lang_url('user/settings/warranty') ?>" class="btn btn-blue"><?= lang('warranty_settings') ?></a>
    </div>
    <div class="clearfix"></div>
</div> 
<?php if ($this->permissions->hasPerm('perm_view_warranty_page')) { ?>
    <div id="warranties-search" class="collapse <?= isset($_GET['client_name']) ? 'in' : '' ?> lists-search-form">    
        <form method="GET" action="" class="site-form"> 
            <div class="row">
                <div class="col-sm-4"> 
                    <div class="form-group">
                        <label><?= lang('search_store_client') ?></label>
                        <input type="text" name="client_name" value="<?= isset($_GET['client_name']) ? $_GET['client_name'] : '' ?>" class="form-control field">
                    </div>
                    <div class="form-group">
                        <label><?= lang('search_date_from') ?></label>
                        <input type="text" name="create_from" value="<?= isset($_GET['create_from']) ? $_GET['create_from'] : '' ?>" class="form-control field datepicker">
                        <label><?= lang('search_to') ?></label>
                        <input type="text" name="create_to" value="<?= isset($_GET['create_to']) ? $_GET['create_to'] : '' ?>" class="form-control field datepicker">
                    </div> 
                </div>
            </div>
            <input type="submit" class="btn btn-green" value="search"> 
            <a href="<?= lang_url('user/warranties') ?>"><?= lang('clear_search') ?></a>
        </form>
    </div>
    <?php if (!empty($warranties)) { ?>
        <form method="POST" action="" id="action-form">
            <input type="hidden" name="action" value="">
            <div class="table-responsive">
                <table class="table table-list table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="check-all-boxes"></th>
                            <th><?= lang('list_war_number') ?></th>
                            <th><?= lang('list_war_to_inv') ?></th>
                            <th><?= lang('list_war_valid_from') ?></th>
                            <th><?= lang('list_war_client') ?></th>
                            <th><?= lang('list_war_events') ?></th>
                            <th class="text-right"><?= lang('list_war_action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($warranties as $warranty) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="<?= $warranty['id'] ?>" class="check-me-now"></td>
                                <td><a href="<?= base_url('user/warranty/print/' . $warranty['warranty_number']) ?>"><?= $warranty['warranty_number'] ?></a></td>
                                <td><?= $warranty['to_invoice'] ?></td>
                                <td><?= date('d.m.Y', $warranty['valid_from']) ?></td>
                                <td><?= $warranty['client'] ?></td>
                                <td><a href="<?= lang_url('user/warranty/events/' . $warranty['warranty_number']) ?>" class="btn btn-default"><?= lang('war_events') ?></a></td>
                                <td class="table-options"> 
                                    <a class="option" href="<?= lang_url('user/warranty/edit/' . $warranty['warranty_number']) ?>">
                                        <span class="sprite-edit"></span>
                                    </a>
                                </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> 
        </form>
        <?= $linksPagination ?>
    <?php } else { ?>
        <h1 class="no-results-found"><?= lang('no_warranties_yet') ?></h1>
    <?php } ?>

<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>