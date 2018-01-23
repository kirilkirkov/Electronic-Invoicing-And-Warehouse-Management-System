<link rel="stylesheet" href="<?= base_url('assets/users/css/invoices-templates.css') ?>">
<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <?= lang('invoices') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
			<li><a href="<?= lang_url('user/invoices') ?>"><?= lang('invoices') ?></a></li>
            <li class="active"><?= $invNum ?></li>
        </ol>
    </div> 
</div>
<div class="inner-page-menu">
    <a href="<?= base_url('user/' . $invType . '/print/copy/' . $invNum) ?>" target="_blank" class="btn btn-blue" style="position: relative;">
        <?= lang('download_print_copy') ?>
    </a>
    <a href="<?= base_url('user/' . $invType . '/print/original/' . $invNum) ?>" target="_blank" class="btn btn-blue" style="position: relative;">
        <?= lang('download_print_original') ?> 
    </a>
</div> 
<?php $origin = 'original'; ?>
<div class="view-container">
    <div class="pageDelivery hidden"></div>
    <div class="invoice-box">
        <?php include $templateFile; ?>
    </div>
</div> 
<?php
if (!empty($actionHistory)) {
    ?>
    <div class="action-history">
        <h1><?= lang('inv_action_history') ?></h1>
        <table>
            <?php foreach ($actionHistory as $action) { ?> 
                <tr>
                    <td><?= lang('status_' . $action['action']) ?></td>
                    <td><?= $action['info'] ?></td>
                    <td><?= date('d.m.Y', $action['time']) ?></td>
                </tr> 
            <?php } ?>
        </table>
    </div>
    <?php
}
?>