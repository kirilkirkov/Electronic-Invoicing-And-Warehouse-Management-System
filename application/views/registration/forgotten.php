<div id="subpage">
    <div class="container">
        <h1><?= lang('recover_your_pass') ?></h1>
    </div>
</div>
<div class="container" id="registration"> 
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <form class="form-registration form-inline text-center" method="POST" action="">
                <div class="form-group">
                    <label><?= lang('login_email') ?></label>
                    <input type="text" name="email" placeholder="<?= lang('reg_p_email') ?>" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= lang('send_pass_link') ?>" class="btn btn-orange"> 
                </div>
            </form>
        </div>
    </div>
</div>