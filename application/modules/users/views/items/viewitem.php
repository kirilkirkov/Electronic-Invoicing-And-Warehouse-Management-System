<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('preview_item') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/items') ?>"><?= lang('items') ?></a></li>  
            <li class="active"><?= lang('preview_item') ?></li>
        </ol>
    </div> 
</div>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">  
        <p><?= lang('add_item_name') ?> <?= $itemInfo['name'] ?></p>
        <p><?= lang('add_item_qua_type') ?> <?= $itemInfo['quantity_type'] ?></p>
        <p><?= lang('add_item_price') ?> <?= $itemInfo['single_price'] ?></p>
        <p><?= lang('add_item_currency') ?> <?= $itemInfo['currency'] ?></p> 
        <a href="<?= lang_url('user/item/edit/' . $itemInfo['id']) ?>" class="btn btn-default"><?= lang('edit') ?></a>
        <?php if ($this->permissions->hasPerm('perm_delete_items')) { ?>
            <a href="<?= lang_url('user/item/delete/' . $itemInfo['id']) ?>" class="confirm btn btn-default" data-my-message="<?= lang('confirm_delete_item') ?>"><?= lang('delete') ?></a>
        <?php } ?>
    </div>
</div>