<div class="footer">
    <div class="extra">
        <div class="extra-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h4><?= lang('support_footer') ?></h4>
                        <ul>
                            <li><a href="mailto:support@domain.com">support@domain.com</a> - 24/7</li>
                        </ul>
                    </div>
                    <div class="col-sm-3">
                        <h4><?= lang('support_questions') ?></h4>
                    </div> 
                    <div class="col-sm-3">
                        <h4><?= lang('support_menu') ?></h4>
                    </div>
                    <div class="col-sm-3">
                        <h4><?= lang('payment_methods') ?></h4>
                        <ul class="payments">
                            <li>
                                <img src="<?= base_url('assets/public/imgs/visa-payment.png') ?>" alt="pminvoice.com visa payment">
                                <img src="<?= base_url('assets/public/imgs/paypal-payment.png') ?>" alt="pminvoice.com paypal payment">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="bottom-inner">
            <div class="container">
                <span>pminvoice.com © 2017</span>
            </div>
        </div>
    </div>
</div> 
</div>
</div>
<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="Modal Registration">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('registration_modal') ?></h4>
            </div>
            <div class="modal-body">
                <form class="form-registration" method="POST" action="<?= lang_url('registration') ?>" id="registerMe">
                    <div class="form-group">
                        <label for="user_email"><?= lang('reg_email') ?></label><sup class="err-email"></sup>
                        <input type="text" name="email" id="user_email" placeholder="<?= lang('reg_p_email') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="user_password"><?= lang('reg_pass') ?></label><sup class="err-password"></sup>
                        <input type="password" id="user_password" name="password" placeholder="<?= lang('reg_p_secret') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="user_password2"><?= lang('reg_pass_repeat') ?></label><sup class="err-password2"></sup>
                        <input type="password" id="user_password2" name="password2" placeholder="<?= lang('reg_p_secret2') ?>" class="form-control">
                    </div>
                    <a href=""><?= lang('read_rules') ?></a>
                    <div class="checkbox">
                        <label><input type="checkbox" id="user_rules" <?= $this->session->flashdata('rules') != null ? 'checked' : '' ?> name="rules" value=""><?= lang('confirm_rules') ?><sup class="err-rules"></sup></label>
                    </div> 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                <button type="button" class="btn btn-orange" onclick="registerValidate()"><?= lang('register_me') ?></button>
            </div> 
        </div>
    </div>
</div>
<script src="<?= base_url('assets/public/js/general.js') ?>"></script> 
<script src="<?= base_url('assets/plugins/placeholders.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>          
</body>
</html>