<link rel="stylesheet" href="<?= base_url('assets/users/css/invoices-templates.css') ?>">
<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <?= lang('invoices') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<a href="<?= base_url('user/' . $invType . '/print/copy/' . $invNum) ?>" target="_blank" class="btn btn-default" style="position: relative;">
    <?= lang('download_print_copy') ?>&nbsp;&nbsp;&nbsp;
    <img src="<?= base_url('assets/users/imgs/pdf-icon-100.png') ?>" style="position: absolute; width:20px; top:0; right:2px;" alt="pdf">
</a>
<a href="<?= base_url('user/' . $invType . '/print/original/' . $invNum) ?>" target="_blank" class="btn btn-default" style="position: relative;">
    <?= lang('download_print_original') ?>&nbsp;&nbsp;&nbsp;
    <img src="<?= base_url('assets/users/imgs/pdf-icon-100.png') ?>" style="position: absolute; width:20px; top:0; right:2px;" alt="pdf">
</a>
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