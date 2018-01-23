<tr>
    <td>
        <input type="hidden" name="item_from_list[]" value="0">
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
    <td class="min-w-190">
        <input type="text" value="<?= isset($itemPost) ? $itemPost['quantity'] : '1.00' ?>" name="items_quantities[]" class="form-control field quantity-field">
        <div class="quantity-type">
            <select class="form-control" name="items_quantity_types[]" data-my-id="1">
                <?php foreach ($quantityTypes as $quantityType) { ?>
                    <option value="<?= $quantityType['name'] ?>"><?= $quantityType['name'] ?></option>
                <?php } if (isset($itemPost)) { ?>
                    <option value="<?= $itemPost['quantity_type'] ?>" selected=""><?= $itemPost['quantity_type'] ?></option>
                <?php } ?>
                <option value="--">--</option>
                <option value="createNewQuantity"><?= lang('create_new_quantity') ?></option>
            </select> 
        </div>
        x
    </td>
    <td class="min-w-180">
        <input type="text" value="<?= isset($itemPost) ? $itemPost['single_price'] : '0.00' ?>" name="items_prices[]" class="form-control field price-field">
        =
    </td>
    <td class="text-right">
        <div class="item-total-price">
            <span class="item-total"><?= isset($itemPost) ? $itemPost['total_price'] : '0.00' ?></span>
            <input type="hidden" class="item-total field" value="<?= isset($itemPost) ? $itemPost['total_price'] : '0.00' ?>" name="items_totals[]">
            <span class="currency-text">
                <?= $theCurrency ?>
            </span>
        </div>
    </td>
</tr> 