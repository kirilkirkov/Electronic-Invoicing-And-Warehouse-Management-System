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
        <p><?= lang('create_inv_client') ?> <?= $clientInfo['client_name'] ?></p>
        <?php if ($clientInfo['is_to_person'] != 1) { ?>
            <p><?= lang('create_inv_bulstat') ?> <?= $clientInfo['client_bulstat'] ?></p>
            <?php if ($clientInfo['client_vat_registered'] == 1) { ?>
                <p><?= lang('create_inv_vat_number') ?> <?= $clientInfo['vat_number'] ?></p>
            <?php } ?> 
            <p><?= lang('create_inv_mol') ?> <?= $clientInfo['accountable_person'] ?></p>
            <p><?= lang('create_inv_recipient') ?> <?= $clientInfo['recipient_name'] ?></p>
        <?php } else { ?>
            <p><?= lang('create_inv_ident_num') ?> <?= $clientInfo['client_ident_num'] ?></p>
        <?php } ?> 
        <p><?= lang('create_inv_address') ?> <?= $clientInfo['client_address'] ?></p>
        <p><?= lang('create_inv_city') ?> <?= $clientInfo['client_city'] ?></p>
        <p><?= lang('create_inv_country') ?> <?= $clientInfo['client_country'] ?></p>  
        <a href="<?= lang_url('user/client/edit/' . $clientInfo['id']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
        <?php if ($this->permissions->hasPerm('perm_delete_clients')) { ?>
            <a href="<?= lang_url('user/client/delete/' . $clientInfo['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_client') ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</a>
        <?php } ?>
    </div>
</div>