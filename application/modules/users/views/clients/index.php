<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('clients') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li class="active"><?= lang('clients') ?></li>
        </ol>
    </div>
</div>
<div class="inner-page-menu">
    <a href="<?= lang_url('user/client/add') ?>" class="btn btn-blue"><?= lang('add_new_client') ?></a>
    <a href="javascript:void(0);" class="btn btn-blue list-action" data-action-type="delete"><?= lang('delete') ?></a>
    <button data-toggle="collapse" data-target="#clients-search" class="btn btn-blue"><?= lang('search') ?></button> 
</div> 
<div id="clients-search" class="collapse <?= isset($_GET['client_name']) ? 'in' : '' ?> lists-search-form">    
    <form method="GET" action="" class="site-form"> 
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?= lang('search_client_name') ?></label>
                    <input type="text" name="client_name" value="<?= isset($_GET['client_name']) ? $_GET['client_name'] : '' ?>" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('search_client_bulstat') ?></label>
                    <input type="text" name="client_bulstat" value="<?= isset($_GET['client_bulstat']) ? $_GET['client_bulstat'] : '' ?>" class="form-control field">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-green" value="search"> 
        <a href="<?= lang_url('user/clients') ?>"><?= lang('clear_search') ?></a>
    </form>
</div>
<?php if (!empty($clients)) { ?>
    <form method="POST" action="" id="action-form">
        <input type="hidden" name="action" value="">
        <div class="table-responsive">
            <table class="table table-list table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="check-all-boxes"></th>
                        <th><?= lang('list_cli_name') ?></th>
                        <th><?= lang('list_cli_bulstat') ?></th>
                        <th class="text-right"><?= lang('list_cli_manage') ?></th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client) { ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?= $client['id'] ?>" class="check-me-now"></td>
                            <td><a href="<?= lang_url('user/client/view/' . $client['id']) ?>"><?= $client['client_name'] ?></a></td>
                            <td><?= $client['is_to_person'] == 1 ? $client['client_ident_num'] : $client['client_bulstat'] ?></td>
                            <td class="table-options"> 
                                <?php if ($this->permissions->hasPerm('perm_delete_clients')) { ?>
                                    <div class="dropdown more-btn option">
                                        <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                                            <span class="sprite-more"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li> 
                                                <a href="<?= lang_url('user/client/delete/' . $client['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_client') ?>">
                                                    <?= lang('delete') ?>
                                                </a>
                                            </li> 
                                        </ul>
                                    </div>
                                <?php } ?>
                                <a class="option" href="<?= lang_url('user/client/edit/' . $client['id']) ?>">
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
    <h1 class="no-results-found"><?= lang('no_clients_yet') ?></h1>
<?php } ?> 