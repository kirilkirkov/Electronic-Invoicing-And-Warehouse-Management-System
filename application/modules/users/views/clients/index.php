<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <?= lang('clients') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<a href="<?= lang_url('user/add/client') ?>" class="btn btn-default"><?= lang('add_new_client') ?></a>
<?php if (!empty($clients)) { ?>
    <form method="POST" action="" id="action-form">
        <input type="hidden" name="action" value="">
        <a href="javascript:void(0);" class="btn btn-default list-action" data-action-type="delete"><?= lang('delete') ?></a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="check-all-boxes"></th>
                        <th><?= lang('list_cli_name') ?></th>
                        <th><?= lang('list_cli_bulstat') ?></th>
                        <th><?= lang('list_cli_manage') ?></th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client) { ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?= $client['id'] ?>" class="check-me-now"></td>
                            <td><?= $client['client_name'] ?></td>
                            <td><?= $client['client_bulstat'] ?></td>
                            <td>
                                <a href="<?= lang_url('user/edit/client/' . $client['id']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                <?php if ($this->permissions->hasPerm('perm_delete_clients')) { ?>
                                    <a href="<?= lang_url('user/delete/client/' . $client['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_client') ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div> 
    </form>
    <?= $linksPagination ?>
<?php } else { ?>
    <h1 class="no-invoices"><?= lang('no_clients_yet') ?></h1>
<?php } ?> 