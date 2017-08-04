<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('add_employees') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/settings') ?>"><?= lang('settings') ?></a></li>  
            <li><a href="<?= lang_url('user/settings/employees') ?>"><?= lang('employees') ?></a></li>  
            <li class="active"><?= lang('add_employees') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_add_employees')) { ?>
    <form action="" class="site-form" method="POST" id="setNewEmployee">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                    <label><?= lang('add_employee_name') ?></label> 
                    <input type="text" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('add_employee_email') ?></label> 
                    <input type="text" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('add_employee_phone') ?></label> 
                    <input type="text" name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('schiffer_replace') ?></label> 
                    <input type="text" name="schiffer" value="<?= isset($_POST['schiffer']) ? $_POST['schiffer'] : '' ?>" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('add_employee_pass') ?></label> 
                    <input type="text" name="password" value="" <?= $editId > 0 ? 'placeholder="' . lang('if_dont_change_emp_pass') . '"' : '' ?> class="form-control field">
                </div>
                <?php if (!defined('EMPLOYEE_ID')) { ?>
                    <div><?= lang('can_access_firms') ?></div>
                    <?php foreach ($myFirms as $firm) { ?>
                        <div class="checkbox">
                            <label><input type="checkbox" name="firms[]" value="<?= $firm['id'] ?>" <?= in_array($firm['id'], $myAccessFirms) ? 'checked="checked"' : '' ?>><?= $firm['name'] ?></label>
                        </div>
                        <?php
                    }
                }
                ?>
                <a href="javascript:void(0);" onclick="newEmployeeValidate()" class="btn btn-green"><?= lang('save_employee') ?></a>
                <a href="<?= lang_url('user/settings/employees') ?>" class="btn btn-default"><?= lang('cancel_save_employee') ?></a>
            </div>
        </div>
    </form>
    <script>
        var opt = {
            passReq: <?= isset($_POST['name']) ? '0' : '1' ?>
        }
    </script>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>