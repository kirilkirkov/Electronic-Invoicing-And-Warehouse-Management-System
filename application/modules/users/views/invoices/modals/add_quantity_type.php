<!-- Modal Add New Quantity Type -->
<div class="modal fade" id="addQuantityType" tabindex="-1" role="dialog" aria-labelledby="addQuantityType">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= lang('add_new_quantity_type') ?></h4>
            </div>
            <div class="modal-body site-form">
                <input type="text" value="" placeholder="<?= lang('type_quantity_type') ?>" class="form-control field new-quantity-value">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                <button type="button" class="btn btn-primary add-my-new-quantity-type"><?= lang('add_the_quantity') ?></button>
            </div>
        </div>
    </div>
</div>