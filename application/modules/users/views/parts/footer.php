<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if (!empty($myFirms)) { ?>
    </div>
    </div>
    </div> 
    </div>
    <?php
}
?>
<footer>
    © CI Invoices.
    Copyright 2018. All Rights Reserved.
    <p>
        Download available for WordPress - <a href="https://codecanyon.net/item/wp-invoices-pdf-electronic-invoicing-system/36891583" target="_blank">WP Invoices.</a>
    </p>
</footer>
</div> 
</div> 
<?php
if ($this->session->flashdata('resultAction')) {
    geterror($this->session->flashdata('resultAction'));
}
?>
<script src="<?= base_url('assets/bootstrap-select-1.12.2/dist/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/placeholders.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>  
<script src="<?= base_url('assets/plugins/bootbox.min.js') ?>"></script>
<script>
    var urls = {
        changeDefaultCurrency: "<?= lang_url('user/defaultcurrency') ?>",
        addNewQuantityType: "<?= lang_url('user/addnewquantitytype') ?>",
        addNewPaymentMethod: "<?= lang_url('user/addnewpaymentmethod') ?>",
        modalSelector: "<?= lang_url('user/modalselector') ?>",
        changeInvoiceStatus: "<?= lang_url('user/changeinvoicestatus') ?>",
        topNavSearch: "<?= lang_url('user/findresults') ?>"
    };
</script>
<script src="<?= base_url('assets/users/js/general.js') ?>"></script>
<script>
    // Auto-inject CSRF token into every POST form that does not already have it
    (function() {
        var csrfName = '<?= $this->security->get_csrf_token_name() ?>';
        var csrfHash = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
        // Also patch jQuery $.ajax / $.post to always send the token
        if (typeof $ !== 'undefined') {
            $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    if (settings.type && settings.type.toUpperCase() === 'POST') {
                        if (typeof settings.data === 'string') {
                            settings.data += '&' + csrfName + '=' + csrfHash;
                        } else if (settings.data instanceof FormData) {
                            settings.data.append(csrfName, csrfHash);
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