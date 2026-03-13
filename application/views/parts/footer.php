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
<script>
    (function() {
        var csrfName = '<?= $this->security->get_csrf_token_name() ?>';
        var csrfHash = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function injectCsrf() {
            var forms = document.querySelectorAll('form[method="post"], form[method="POST"]');
            for (var i = 0; i < forms.length; i++) {
                if (!forms[i].querySelector('input[name="' + csrfName + '"]')) {
                    var input = document.createElement('input');
                    input.type  = 'hidden';
                    input.name  = csrfName;
                    input.value = csrfHash;
                    forms[i].appendChild(input);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', injectCsrf);
        document.addEventListener('submit', function(e) {
            var form = e.target;
            if (form.method && form.method.toLowerCase() === 'post' && !form.querySelector('input[name="' + csrfName + '"]')) {
                var input = document.createElement('input');
                input.type  = 'hidden';
                input.name  = csrfName;
                input.value = csrfHash;
                form.appendChild(input);
            }
        }, true);

        if (typeof $ !== 'undefined') {
            $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    if (settings.type && settings.type.toUpperCase() === 'POST') {
                        if (typeof settings.data === 'string') {
                            settings.data += '&' + csrfName + '=' + csrfHash;
                        } else {
                            settings.data = settings.data || {};
                            settings.data[csrfName] = csrfHash;
                        }
                    }
                }
            });
        }
    })();
</script>
<script src="<?= base_url('assets/plugins/placeholders.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>          
</body>
</html>