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
    © InvoicePro.fr Copyright 2018. All Rights Reserved.
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
</body>
</html>