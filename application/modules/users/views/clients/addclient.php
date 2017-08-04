<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('add_client') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>
            <li><a href="<?= lang_url('user/clients') ?>"><?= lang('clients') ?></a></li>  
            <li class="active"><?= lang('add_client') ?></li>
        </ol>
    </div>
</div>
<?php if ($this->permissions->hasPerm('perm_add_clients') && $editId == 0 || $this->permissions->hasPerm('perm_edit_clients') && $editId > 0) { ?>
    <form action="" class="site-form" method="POST" id="setNewClient">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                    <label><?= lang('create_inv_client') ?></label> 
                    <input type="text" name="client_name" value="<?= isset($_POST['client_name']) ? $_POST['client_name'] : '' ?>" class="form-control field">
                    <div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="is_to_person" <?= isset($_POST['is_to_person']) && $_POST['is_to_person'] == 1 ? 'checked="checked"' : '' ?> id="individual-client" value=""><?= lang('create_inv_individual') ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group client-company" <?= isset($_POST['is_to_person']) && $_POST['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>> 
                    <label><?= lang('create_inv_bulstat') ?></label> 
                    <input type="text" name="client_bulstat" value="<?= isset($_POST['client_bulstat']) ? $_POST['client_bulstat'] : '' ?>" class="form-control field">
                    <div>
                        <div class="checkbox">
                            <label><input type="checkbox" <?= isset($_POST['client_vat_registered']) && $_POST['client_vat_registered'] == 1 ? 'checked="checked"' : '' ?> name="client_vat_registered" id="client-vat-registered" value=""><?= lang('create_inv_client_vat_registered') ?></label>
                        </div>
                    </div>
                </div>
                <div class="form-group client-company client-vat-registered" <?= isset($_POST['is_to_person']) && $_POST['is_to_person'] == 1 ? 'style="display:none;"' : '' ?> <?= isset($_POST['client_vat_registered']) && $_POST['client_vat_registered'] == 1 ? 'style="display:block;"' : '' ?>>
                    <label><?= lang('create_inv_vat_number') ?></label>
                    <input type="text" value="<?= isset($_POST['vat_number']) ? $_POST['vat_number'] : '' ?>" name="vat_number" class="form-control field">
                </div>
                <div class="form-group client-company" <?= isset($_POST['is_to_person']) && $_POST['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>>
                    <label><?= lang('create_inv_mol') ?></label>
                    <input type="text" value="<?= isset($_POST['accountable_person']) ? $_POST['accountable_person'] : '' ?>" name="accountable_person" class="form-control field">
                </div>
                <div class="form-group client-individial" <?= isset($_POST['is_to_person']) && $_POST['is_to_person'] == 1 ? 'style="display:block;"' : '' ?>>
                    <label><?= lang('create_inv_ident_num') ?></label>
                    <input type="text" value="<?= isset($_POST['client_ident_num']) ? $_POST['client_ident_num'] : '' ?>" name="client_ident_num" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('create_inv_city') ?></label>
                    <input type="text" value="<?= isset($_POST['client_city']) ? $_POST['client_city'] : '' ?>" name="client_city" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('create_inv_address') ?></label>
                    <input type="text" value="<?= isset($_POST['client_address']) ? $_POST['client_address'] : '' ?>" name="client_address" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('create_inv_country') ?></label>
                    <input type="text" value="<?= isset($_POST['client_country']) ? $_POST['client_country'] : '' ?>" name="client_country" class="form-control field">
                </div>
                <div class="form-group" <?= isset($_POST['is_to_person']) && $_POST['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>>
                    <label><?= lang('create_inv_recipient') ?></label> 
                    <input type="text" value="<?= isset($_POST['recipient_name']) ? $_POST['recipient_name'] : '' ?>" name="recipient_name" class="form-control field"> 
                </div>
                <a href="javascript:void(0);" onclick="newClientValidate()" class="btn btn-green"><?= lang('save_client') ?></a>
                <a href="<?= lang_url('user/clients') ?>" class="btn btn-default"><?= lang('cancel_save_client') ?></a>
            </div>
        </div>
    </form>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>