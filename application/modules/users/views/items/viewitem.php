<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <?= lang('add_client') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">  
        <p><?= lang('add_item_name') ?> <?= $itemInfo['name'] ?></p>
        <p><?= lang('add_item_qua_type') ?> <?= $itemInfo['quantity_type'] ?></p>
        <p><?= lang('add_item_price') ?> <?= $itemInfo['single_price'] ?></p>
        <p><?= lang('add_item_currency') ?> <?= $itemInfo['currency'] ?></p> 
        <a href="<?= lang_url('user/item/edit/' . $itemInfo['id']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
        <?php if ($this->permissions->hasPerm('perm_delete_items')) { ?>
            <a href="<?= lang_url('user/item/delete/' . $itemInfo['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_item') ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</a>
        <?php } ?>
    </div>
</div>