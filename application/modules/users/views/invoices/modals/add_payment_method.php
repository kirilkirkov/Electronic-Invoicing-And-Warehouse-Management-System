<!-- Modal Add Payment Method -->
<div class="modal fade" id="addPaymentMethod" tabindex="-1" role="dialog" aria-labelledby="addPaymentMethod">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= lang('add_new_payment_method') ?></h4>
            </div>
            <div class="modal-body site-form">
                <input type="text" value="" placeholder="<?= lang('type_payment_method') ?>" class="form-control field my-new-pay-method">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                <button type="button" class="btn btn-primary add-my-new-pay-method"><?= lang('add_the_pay_method') ?></button>
            </div>
        </div>
    </div>
</div>