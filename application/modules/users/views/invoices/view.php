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
<a href="<?= base_url('user/' . $invType . '/print/' . $invNum) ?>" class="btn btn-default" style="position: relative;">
    <?= lang('download_print') ?>&nbsp;&nbsp;&nbsp;
    <img src="<?= base_url('assets/users/imgs/pdf-icon-100.png') ?>" style="position: absolute; width:20px; top:0; right:2px;" alt="pdf">
</a>
<div class="view-container">
    <div class="pageDelivery hidden"></div>
    <div class="invoice-box">
        <?php include $templateFile; ?>
    </div>
</div> 