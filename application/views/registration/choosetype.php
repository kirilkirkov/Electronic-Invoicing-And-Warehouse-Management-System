<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/public/imgs/pm-subpages.png') ?>" alt="pm:"><?= lang('choose_type_of_login') ?></h1>
    </div>
</div>
<div class="container" id="registration">
    <h1 class="shadows-font"><?= lang('there_are_two_types') ?></h1>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="text-center" style="margin-bottom: 15px;"><a href="<?= lang_url('choose-type-of-login?type=1') ?>" class="btn btn-orange"><?= lang('type_user') ?></a></div>
            <div class="text-center"><a href="<?= lang_url('choose-type-of-login?type=2') ?>" class="btn btn-orange"><?= lang('type_employee') ?></a></div>
        </div>
    </div>
</div>