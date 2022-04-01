<div class="container">
    <?php /*
    <div class="col-xs-6">
        <h3>Choose Language:</h3>
        <ul class="langs">
            <li><a href="<?= base_url() ?>">English</a></li>
            <li><a href="<?= base_url('fr') ?>">Français</a></li> 
            <li><a href="<?= base_url('bg') ?>">Български</a></li>
        </ul>
    </div>
    */  ?>
    <div class="">
        <div class="login">
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
                                <?php /*    
                                <a href="<?= lang_url('password-forgotten') ?>" class="forgot"><?= lang('forgotten_pass') ?></a>
                                */ ?>
                                <input type="submit" class="btn btn-orange logme" value="<?= lang('btn_logme') ?>">
                                <a href="<?= lang_url('registration') ?>" class="register"><?= lang('btn_register') ?></a>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                    <a href="<?= lang_url('user') ?>" class="btn btn-orange"><?= lang('log_me_public_home') ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>