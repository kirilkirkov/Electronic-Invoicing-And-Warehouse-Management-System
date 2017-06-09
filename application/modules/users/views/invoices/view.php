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
<a href="<?= base_url('user/' . $invType . '/print/' . $invNum) ?>" class="btn btn-default"><?= lang('download_print') ?></a>
<div class="view-container">
    <div class="invoice-box">
        <?php include $templateFile; ?>
    </div>
</div> 