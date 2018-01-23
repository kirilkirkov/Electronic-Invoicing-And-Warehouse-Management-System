<?php if (uri_string() != 'registration') { ?>
    <div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="modalRegister">
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                    <button type="button" class="btn btn-orange" onclick="registerValidate()"><?= lang('register_me') ?></button>
                </div> 
            </div>
        </div>
    </div>
<?php } ?>
<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/public/js/general.js') ?>"></script> 
<script src="<?= base_url('assets/plugins/placeholders.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>          
</body>
</html>