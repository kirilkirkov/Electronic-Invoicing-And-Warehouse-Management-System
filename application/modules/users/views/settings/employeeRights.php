<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-cog" aria-hidden="true"></i>
            <?= lang('settings') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/settings') ?>"><?= lang('settings') ?></a></li>  
            <li><a href="<?= lang_url('user/settings/employees') ?>"><?= lang('employees') ?></a></li>  
            <li class="active"><?= lang('rights') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_can_manage_rights')) { ?>
    <form method="POST" action="">
        <?php foreach ($permissions as $permission => $v) { ?>
            <div class="checkbox">
                <label><input type="checkbox" name="<?= $permission ?>" value="" <?= $userPermissions[$permission] ? 'checked="checked"' : '' ?>><?= lang($permission) ?></label>
            </div>
        <?php } ?>
        <input type="submit" name="savePermissions" value="<?= lang('save') ?>" class="btn btn-green">
        <a href="<?= lang_url('user/settings/employees') ?>" class="btn btn-default"><?= lang('cancel_save_employee') ?></a>
    </form> 
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>
