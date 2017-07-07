<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <?= lang('items') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<?php if ($this->permissions->hasPerm('perm_view_warranty_page')) { ?>
    <a href="<?= lang_url('user/settings/warranty') ?>" class="btn btn-default"><?= lang('warranty_settings') ?></a>
    <a href="<?= lang_url('user/warranties/add-warranty') ?>" class="btn btn-default"><?= lang('add_warranty') ?></a>

    <button data-toggle="collapse" data-target="#warranties-search">Collapsible</button>
    <div id="warranties-search" class="collapse">    
        <form method="GET" action=""> 
            <div class="row">
                <div class="col-sm-4"> 
                    <div class="form-group">
                        <label><?= lang('search_store_client') ?></label>
                        <input type="text" name="client_name" value="<?= isset($_GET['client_name']) ? $_GET['client_name'] : '' ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><?= lang('search_date_from') ?></label>
                        <input type="text" name="create_from" value="<?= isset($_GET['create_from']) ? $_GET['create_from'] : '' ?>" class="form-control datepicker">
                        <label><?= lang('search_to') ?></label>
                        <input type="text" name="create_to" value="<?= isset($_GET['create_to']) ? $_GET['create_to'] : '' ?>" class="form-control datepicker">
                    </div> 
                </div>
            </div>
            <input type="submit" value="search"> 
            <a href="<?= lang_url('user/store') ?>"><?= lang('clear_search') ?></a>
        </form>
    </div>
    <?php if (!empty($warranties)) { ?>
        <form method="POST" action="" id="action-form">
            <input type="hidden" name="action" value="">
            <a href="javascript:void(0);" class="btn btn-default list-action" data-action-type="delete"><?= lang('delete_warranties') ?></a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="check-all-boxes"></th>
                            <th><?= lang('list_war_number') ?></th>
                            <th><?= lang('list_war_to_inv') ?></th>
                            <th><?= lang('list_war_valid_from') ?></th>
                            <th><?= lang('list_war_client') ?></th>
                            <th><?= lang('list_war_events') ?></th>
                            <th><?= lang('list_war_action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($warranties as $warranty) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="<?= $warranty['id'] ?>" class="check-me-now"></td>
                                <td><a href="<?= lang_url('user/warranty/print/' . $warranty['warranty_number']) ?>"><?= $warranty['warranty_number'] ?></a></td>
                                <td><?= $warranty['to_invoice'] ?></td>
                                <td><?= date('d.m.Y', $warranty['valid_from']) ?></td>
                                <td><?= $warranty['client'] ?></td>
                                <td><a href="<?= lang_url('user/warranty/events/' . $warranty['warranty_number']) ?>" class="btn btn-default"><?= lang('war_events') ?></a></td>
                                <td><a href="<?= lang_url('user/warranty/edit/' . $warranty['warranty_number']) ?>"><?= lang('edit_warranty') ?></a></td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> 
        </form>
        <?= $linksPagination ?>
    <?php } else { ?>
        <h1 class="no-invoices"><?= lang('no_warranties_yet') ?></h1>
    <?php } ?>

<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>