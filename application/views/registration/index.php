<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/public/imgs/pm-subpages.png') ?>" alt="pm:"><?= lang('registration') ?></h1>
    </div>
</div>
<div class="container" id="registration">
    <h1 class="shadows-font"><?= lang('register_account') ?></h1>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form class="form-registration" method="POST" action="">
                <div class="form-group">
                    <label for="user_email"><?= lang('reg_email') ?></label>
                    <input type="text" name="email" id="user_email" value="<?= trim($this->session->flashdata('email')) ?>" placeholder="<?= lang('reg_p_email') ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="user_password"><?= lang('reg_pass') ?></label>
                    <input type="password" id="user_password" value="<?= trim($this->session->flashdata('password')) ?>" name="password" placeholder="<?= lang('reg_p_secret') ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="user_password2"><?= lang('reg_pass_repeat') ?></label>
                    <input type="password" id="user_password2" value="<?= trim($this->session->flashdata('password2')) ?>" name="password2" placeholder="<?= lang('reg_p_secret2') ?>" class="form-control">
                </div>
                <a href=""><?= lang('read_rules') ?></a>
                <div class="checkbox">
                    <label><input type="checkbox" id="user_rules" <?= $this->session->flashdata('rules') !== null ? 'checked' : '' ?> name="rules" value=""><?= lang('confirm_rules') ?></label>
                </div> 
                <div class="form-group">
                    <input type="submit" value="<?= lang('register_me') ?>" class="btn btn-orange">
                    <a href="<?= lang_url('login') ?>" class="btn btn-default"><?= lang('i_have_account') ?></a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if ($this->session->flashdata('resultRegister')) {
    geterror($this->session->flashdata('resultRegister'));
}
?>