<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('settings') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li class="active"><?= lang('settings') ?></li>
        </ol>
    </div> 
</div>
<div class="settings-page">
    <ul class="list-group">
        <li class="list-group-item">
            <a href="<?= lang_url('user/settings/employees') ?>"><?= lang('employees') ?>
                <span class="sprite-arrow-right"></span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="<?= lang_url('user/settings/invoices') ?>"><?= lang('invoices') ?>
                <span class="sprite-arrow-right"></span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="<?= lang_url('user/settings/global') ?>"><?= lang('global') ?>
                <span class="sprite-arrow-right"></span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="<?= lang_url('user/settings/warranty') ?>"><?= lang('warranty') ?>
                <span class="sprite-arrow-right"></span>
            </a>
        </li>
        <li class="list-group-item">
            <a href="<?= lang_url('user/settings/protocols') ?>"><?= lang('protocols') ?>
                <span class="sprite-arrow-right"></span>
            </a>
        </li> 
        <li class="list-group-item">
            <a href="<?= lang_url('user/settings/stores') ?>"><?= lang('store') ?>
                <span class="sprite-arrow-right"></span>
            </a>
        </li> 
    </ul> 
</div>