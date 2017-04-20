<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/public/imgs/pm-subpages.png') ?>" alt="pm:"><?= lang('login') ?></h1>
    </div>
</div>
<div class="container" id="registration">
    <h1 class="shadows-font"><?= lang('log_to_your_acc') ?></h1>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form class="form-registration" method="POST" action="">
                <div class="form-group">
                    <label><?= lang('login_email') ?></label>
                    <input type="text" name="email" value="<?= trim($this->session->flashdata('email')) ?>" placeholder="<?= lang('reg_p_email') ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label><?= lang('login_pass') ?></label>
                    <input type="password" name="password" value="" placeholder="<?= lang('reg_p_secret') ?>" class="form-control">
                </div> 
                <div class="form-group">
                    <input type="submit" value="<?= lang('btn_logme') ?>" class="btn btn-orange">
                    <a href="<?= lang_url('password-forgotten') ?>" class="btn btn-default"><?= lang('forgotten_pass') ?></a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if ($this->session->flashdata('loginErrors')) {
    geterror($this->session->flashdata('loginErrors'));
}
?>