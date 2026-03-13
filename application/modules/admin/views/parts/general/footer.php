<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/general.js') ?>"></script>
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
</body>
</html>