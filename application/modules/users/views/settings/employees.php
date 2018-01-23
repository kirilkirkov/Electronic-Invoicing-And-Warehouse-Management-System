<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('employees') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/settings') ?>"><?= lang('settings') ?></a></li>  
            <li class="active"><?= lang('employees') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_add_employees')) { ?>
    <div class="inner-page-menu">
        <a href="<?= lang_url('user/settings/employees/add') ?>" class="btn btn-blue"><?= lang('add_new_employee') ?></a>
    </div>  
<?php }if (!empty($employees)) { ?> 
    <table class="table table-list table-striped">
        <thead>
            <tr>
                <th><?= lang('list_empl_name') ?></th>
                <th><?= lang('list_empl_email') ?></th>
                <th><?= lang('list_empl_phone') ?></th>
                <th class="text-right"><?= lang('list_empl_manage') ?></th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee) { ?>
                <tr>
                    <td><?= $employee['name'] ?></td>
                    <td><?= $employee['email'] ?></td>
                    <td><?= $employee['phone'] ?></td>
                    <td class="table-options">
                        <div class="dropdown more-btn option">
                            <a class="dropdown-toggle" type="button" data-toggle="dropdown">
                                <span class="sprite-more"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right"> 
                                <?php if ($this->permissions->hasPerm('perm_delete_employees')) { ?>
                                    <li> 
                                        <a href="<?= lang_url('user/settings/employees/delete/' . $employee['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_employee') ?>"><?= lang('delete') ?></a>
                                    </li>                                      
                                <?php } if ($this->permissions->hasPerm('perm_can_manage_rights')) { ?>
                                    <li>
                                        <a href="<?= lang_url('user/settings/employees/rights/' . $employee['id']) ?>"><?= lang('rights') ?></a>
                                    </li>                                       
                                <?php } ?> 
                            </ul>
                        </div>
                        <?php if ($this->permissions->hasPerm('perm_edit_employees')) { ?>
                            <a class="option" href="<?= lang_url('user/settings/employees/add/' . $employee['id']) ?>">
                                <span class="sprite-edit"></span>
                            </a> 
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table> 
    <?= $linksPagination ?>
<?php } else { ?>
    <h1><?= lang('no_employees_yet') ?></h1>
<?php } ?> 