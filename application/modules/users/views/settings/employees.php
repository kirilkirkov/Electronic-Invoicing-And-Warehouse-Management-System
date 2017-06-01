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
<a href="<?= lang_url('user/settings/employees/add') ?>" class="btn btn-default"><?= lang('add_new_employee') ?></a>
<?php if (!empty($employees)) { ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th><?= lang('list_empl_name') ?></th>
                    <th><?= lang('list_empl_email') ?></th>
                    <th><?= lang('list_empl_phone') ?></th>
                    <th><?= lang('list_empl_manage') ?></th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) { ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= $employee['name'] ?></td>
                        <td><?= $employee['email'] ?></td>
                        <td><?= $employee['phone'] ?></td>
                        <td>
                            <a href="<?= lang_url('user/settings/employees/rights/' . $employee['id']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Rights</a>
                            <a href="<?= lang_url('user/settings/employees/add/' . $employee['id']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            <a href="<?= lang_url('user/settings/employees/delete/' . $employee['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_employee') ?>"><i class="fa fa-remove" aria-hidden="true"></i> Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div> 
<?php } else { ?>
    <h1><?= lang('no_employees_yet') ?></h1>
<?php } ?>
<?= $linksPagination ?>