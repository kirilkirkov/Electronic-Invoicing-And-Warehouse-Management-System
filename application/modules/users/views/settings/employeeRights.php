<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-cog" aria-hidden="true"></i>
            <?= lang('settings') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<?php if ($this->permissions->hasPerm('perm_can_manage_rights')) { ?>
    <form method="POST" action="">
        <?php foreach ($permissions as $permission => $v) { ?>
            <div class="checkbox">
                <label><input type="checkbox" name="<?= $permission ?>" value="" <?= $userPermissions[$permission] ? 'checked="checked"' : '' ?>><?= lang($permission) ?></label>
            </div>
        <?php } ?>
        <input type="submit" name="savePermissions" class="btn btn-default">
    </form> 
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>
