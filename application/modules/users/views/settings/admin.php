<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('settings') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>
            <li class="active"><?= lang('edit_admin') ?></li>
        </ol>
    </div> 
</div>
<form action="" class="site-form" method="POST" id="editAdminUserForm">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <label><?= lang('add_employee_name') ?></label> 
                <input type="text" name="name" value="<?= $_POST['name'] ?>" class="form-control field">
            </div>
            <div class="form-group">
                <label><?= lang('add_employee_email') ?></label> 
                <input type="text" name="email" value="<?= $_POST['email'] ?>" class="form-control field">
            </div>
            <div class="form-group">
                <label><?= lang('add_employee_phone') ?></label> 
                <input type="text" name="phone" value="<?= $_POST['phone'] ?>" class="form-control field">
            </div>
            <div class="form-group">
                <label><?= lang('schiffer_replace') ?></label> 
                <input type="text" name="schiffer" value="<?= $_POST['schiffer'] ?>" class="form-control field">
            </div>
            <div class="form-group">
                <label><?= lang('add_employee_pass') ?></label> 
                <input type="text" name="password" value="" placeholder="<?= lang('if_dont_change_usr_pass') ?>" class="form-control field">
            </div>
            <button type="submit" class="btn btn-green"><?= lang('save_user_data') ?></button>
            <a href="<?= lang_url('user') ?>" class="btn btn-default"><?= lang('cancel_save_user') ?></a>
        </div>
    </div>
</form>