<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('items') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li class="active"><?= lang('items') ?></li>
        </ol>
    </div> 
</div>
<div class="inner-page-menu">
    <a href="<?= lang_url('user/item/add') ?>" class="btn btn-blue"><?= lang('add_new_item') ?></a>
    <a href="javascript:void(0);" class="btn btn-blue list-action" data-action-type="delete"><?= lang('delete') ?></a>
    <button data-toggle="collapse" data-target="#items-search" class="btn btn-blue"><?= lang('search') ?></button>
</div> 
<div id="items-search" class="collapse <?= isset($_GET['item_name']) ? 'in' : '' ?> lists-search-form">    
    <form method="GET" action="" class="site-form"> 
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?= lang('search_item_name') ?></label>
                    <input type="text" name="item_name" value="<?= isset($_GET['item_name']) ? $_GET['item_name'] : '' ?>" class="form-control field">
                </div> 
                <div class="form-group">
                    <label><?= lang('search_amount_from') ?></label>
                    <input type="text" name="amount_from" value="<?= isset($_GET['amount_from']) ? $_GET['amount_from'] : '' ?>" class="form-control field">
                    <label><?= lang('search_to') ?></label>
                    <input type="text" name="amount_to" value="<?= isset($_GET['amount_to']) ? $_GET['amount_to'] : '' ?>" class="form-control field">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-green" value="search"> 
        <a href="<?= lang_url('user/items') ?>"><?= lang('clear_search') ?></a>
    </form>
</div>
<?php if (!empty($items)) { ?>
    <form method="POST" action="" id="action-form">
        <input type="hidden" name="action" value=""> 
        <div class="table-responsive">
            <table class="table table-list table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="check-all-boxes"></th>
                        <th><?= lang('list_item_name') ?></th>
                        <th><?= lang('list_cli_qu_type') ?></th>
                        <th><?= lang('list_cli_price') ?></th>
                        <th class="text-right"><?= lang('list_cli_manage') ?></th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?= $item['id'] ?>" class="check-me-now"></td>
                            <td><a href="<?= lang_url('user/item/view/' . $item['id']) ?>"><?= $item['name'] ?></a></td>
                            <td><?= $item['quantity_type'] ?></td>
                            <td><?= $item['single_price'] . ' ' . $item['currency'] ?></td>                           
                            <td class="table-options"> 
                                <?php if ($this->permissions->hasPerm('perm_delete_clients')) { ?>
                                    <div class="dropdown more-btn option">
                                        <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                                            <span class="sprite-more"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li> 
                                                <a href="<?= lang_url('user/item/delete/' . $item['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_item') ?>">
                                                    <?= lang('delete') ?>
                                                </a>
                                            </li> 
                                        </ul>
                                    </div>
                                <?php } ?>
                                <a class="option" href="<?= lang_url('user/item/edit/' . $item['id']) ?>">
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
    <h1 class="no-results-found"><?= lang('no_items_yet') ?></h1>
<?php } ?>
