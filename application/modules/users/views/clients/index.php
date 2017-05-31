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
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th><?= lang('list_cli_name') ?></th>
                    <th><?= lang('list_cli_bulstat') ?></th>
                    <th><?= lang('list_cli_manage') ?></th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client) { ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= $client['client_name'] ?></td>
                        <td><?= $client['client_bulstat'] ?></td>
                        <td>
                            <a href="<?= lang_url('user/edit/client/' . $client['id']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            <a href="<?= lang_url('user/delete/client/' . $client['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_client') ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div> 
<?php } else { ?>
    <h1 class="no-invoices"><?= lang('no_clients_yet') ?></h1>
<?php } ?>
<?= $linksPagination ?>