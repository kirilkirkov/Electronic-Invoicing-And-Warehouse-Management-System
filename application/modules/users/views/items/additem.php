<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('add_item') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/items') ?>"><?= lang('items') ?></a></li>  
            <li class="active"><?= lang('add_item') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_add_items') && $editId == 0 || $this->permissions->hasPerm('perm_edit_items') && $editId > 0) { ?>
    <form action="" class="site-form" method="POST" id="setNewItem">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                    <label><?= lang('add_item_name') ?></label> 
                    <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('add_item_qua_type') ?></label> 
                    <select class="selectpicker" name="quantity_type">
                        <?php foreach ($quantityTypes as $quantityType) { ?>
                            <option value="<?= $quantityType['name'] ?>"><?= $quantityType['name'] ?></option>
                        <?php } if (isset($_POST['quantity_type'])) { ?>
                            <option selected="" value="<?= $_POST['quantity_type'] ?>"><?= $_POST['quantity_type'] ?></option>
                        <?php } ?>
                    </select> 
                </div>
                <div class="form-group">
                    <label><?= lang('add_item_price') ?></label> 
                    <input type="text" name="single_price" value="<?= isset($_POST['single_price']) ? $_POST['single_price'] : '' ?>" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('add_item_currency') ?></label> 
                    <select class="selectpicker" name="currency" title="<?= lang('no_currency_selected_item') ?>" data-live-search="true">
                        <?php
                        foreach ($currencies as $currency) {
                            ?>
                            <option value="<?= $currency['value'] ?>"><?= $currency['name'] ?></option>
                        <?php } if (isset($_POST['currency'])) { ?>
                            <option selected="" value="<?= $_POST['currency'] ?>"><?= $_POST['currency'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <a href="javascript:void(0);" onclick="newItemValidate()" class="btn btn-green"><?= lang('save_item') ?></a>
                <a href="<?= lang_url('user/items') ?>" class="btn btn-default"><?= lang('cancel_save_item') ?></a>
            </div>
        </div>
    </form>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>