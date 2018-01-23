<div class="container">
    <div id="collapseLogin">
        <?php if (!isset($_SESSION['user_login'])) { ?>
            <form method="POST" action="<?= lang_url('login') ?>">
                <div class="form-group">
                    <span><?= lang('login_email') ?></span>
                    <input type="text" name="email" placeholder="name@example.com" class="my-addr">
                </div>
                <div class="form-group">
                    <span><?= lang('login_pass') ?></span>
                    <input type="password" name="password" class="my-addr">
                </div>
                <div class="form-group">
                    <div class="pull-right">
                        <a href="<?= lang_url('password-forgotten') ?>" class="forgot"><?= lang('forgotten_pass') ?></a>
                        <input type="submit" class="btn btn-orange logme" value="<?= lang('btn_logme') ?>">
                    </div>
                </div>
            </form>
        <?php } else { ?>
            <a href="<?= lang_url('user') ?>" class="btn btn-orange"><?= lang('log_me_public_home') ?></a>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalRegister"><?= lang('btn_register') ?></a>
</div>