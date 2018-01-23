<tr>
    <td>
        <input type="hidden" name="is_item_update[]" value="<?= isset($itemPost) ? $itemPost['id'] : '0' ?>">
        <div class="actions">
            <a href="javascript:void(0);" class="btn btn-default delete-item">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
            <a href="javascript:void(0);" class="btn btn-default move-me">
                <i class="fa fa-sort" aria-hidden="true"></i>
            </a>
        </div>
    </td>
    <td>
        <input type="text" value="<?= isset($itemPost) ? $itemPost['name'] : '' ?>" name="items_names[]" class="form-control field field-item-name">
        <a href="javascript:void(0);" data-choose-title="<?= lang('choose_item') ?>" data-selector-type="item" class="choose">
            <i class="fa fa-bars" aria-hidden="true"></i>
            <span><?= lang('create_inv_choose') ?></span>
        </a>
    </td>
    <td>
        <input type="text" value="<?= isset($itemPost) ? $itemPost['months'] : '' ?>" name="items_months[]" class="form-control field field-item-months">
    </td>
    <td>
        <input type="text" value="<?= isset($itemPost) ? $itemPost['serial'] : '' ?>" name="items_serial_nums[]" class="form-control field">
    </td> 
</tr> 