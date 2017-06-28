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
<a href="<?= lang_url('user/client/add') ?>" class="btn btn-default"><?= lang('add_new_client') ?></a>
<button data-toggle="collapse" data-target="#invoices-search">Collapsible</button>
<div id="invoices-search" class="collapse in">    
    <form method="GET" action=""> 
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?= lang('search_client_name') ?></label>
                    <input type="text" name="client_name" value="<?= isset($_GET['client_name']) ? $_GET['client_name'] : '' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label><?= lang('search_client_bulstat') ?></label>
                    <input type="text" name="client_bulstat" value="<?= isset($_GET['client_bulstat']) ? $_GET['client_bulstat'] : '' ?>" class="form-control">
                </div>
            </div>
        </div>
        <input type="submit" value="search"> 
    </form>
</div>
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
                            <td><a href="<?= lang_url('user/client/view/' . $client['id']) ?>"><?= $client['client_name'] ?></a></td>
                            <td><?= $client['is_to_person'] == 1 ? $client['client_ident_num'] : $client['client_bulstat'] ?></td>
                            <td>
                                <a href="<?= lang_url('user/client/edit/' . $client['id']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                <?php if ($this->permissions->hasPerm('perm_delete_clients')) { ?>
                                    <a href="<?= lang_url('user/client/delete/' . $client['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_client') ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</a>
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