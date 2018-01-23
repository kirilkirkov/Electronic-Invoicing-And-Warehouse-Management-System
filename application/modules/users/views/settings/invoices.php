<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('settings_invoices') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/settings') ?>"><?= lang('settings') ?></a></li> 
            <li class="active"><?= lang('settings_invoices') ?></li>
        </ol>
    </div> 
</div>
<div class="settings-inner-page">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-settings">
            <h4><?= lang('default_currency') ?></h4>
            <p class="selected-new-default"><?= lang('selected_new_def') ?></p>
            <p class="not-selected-new-default"><?= lang('not_selected_new_def') ?></p>
            <?php foreach ($myFirms as $myFirm) { ?>
                <div style="margin-bottom: 10px;">
                    <?= $myFirm['name'] ?> - <?= $myFirm['default_currency'] == null ? lang('default_currency_null') : '' ?> 
                    <select class="selectpicker selectDefaultCurrency" title="<?= lang('select_def_currency') ?>" data-default-for="<?= $myFirm['id'] ?>" data-live-search="true">
                        <?php foreach ($currencies as $currency) { ?>
                            <option value="<?= $currency['value'] ?>" <?= $currency['value'] == $myFirm['default_currency'] ? 'selected' : '' ?>><?= $currency['name'] ?></option>
                        <?php } ?>
                    </select> 
                    <?php if ($myFirm['default_currency'] != null) { ?>
                        <a href="<?= lang_url('user/settings/invoices/delete/default/' . $myFirm['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_del_def_currency') . $myFirm['name'] . '?' ?>">
                            <?= lang('clear_def_currency') ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-sm-6 col-md-4 col-settings">
            <h4><?= lang('my_currencies') ?></h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?= lang('currency_name') ?><sup><?= lang('curr_name_for_int_use') ?></sup></th>
                        <th colspan="2"><?= lang('currency_value') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($myCurrencies)) {
                        foreach ($myCurrencies as $myCurrency) {
                            ?>
                            <tr>
                                <td><?= $myCurrency['name'] ?></td>
                                <td><?= $myCurrency['value'] ?></td>
                                <td class="text-right">
                                    <a href="<?= base_url('user/settings/invoices/delete/currency/' . $myCurrency['id']) ?>" class="confirm btn btn-xs btn-default" data-my-message="<?= lang('conirm_del_my_currency') ?>">
                                        <?= lang('delete') ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3"><?= lang('no_my_currencies_added') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3">
                            <form method="POST" action="" class="site-form" id="formAddCurrency">
                                <table>
                                    <tr>
                                        <td><input type="text" placeholder="<?= lang('currency_name') ?>" name="currencyName" class="form-control field c-name"></td>
                                        <td><input type="text" placeholder="<?= lang('currency_value') ?>" name="currencyValue" class="form-control field c-value"></td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="addNewCurrency()" class="btn btn-default pull-right">
                                                <?= lang('add_new_currency') ?>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6 col-md-4 col-settings">
            <h4><?= lang('my_quantity_types') ?></h4>
            <table class="table table-bordered">
                <thead>
                    <tr> 
                        <th colspan="2"><?= lang('quantity_name') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($myQuantityTypes)) {
                        foreach ($myQuantityTypes as $myQuantityType) {
                            ?>
                            <tr>
                                <td><?= $myQuantityType['name'] ?></td>
                                <td class="text-right">
                                    <a href="<?= base_url('user/settings/invoices/delete/quantitytype/' . $myQuantityType['id']) ?>" class="confirm btn btn-xs btn-default" data-my-message="<?= lang('conirm_del_my_quantity_type') ?>">
                                        <?= lang('delete') ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="2"><?= lang('no_my_quantity_types') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2">
                            <form method="POST" action="" class="site-form" id="formAddQuantityType">
                                <table>
                                    <tr>
                                        <td><input type="text" name="quantityTypeName" class="form-control field"></td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="addNewQuantityType()" class="btn btn-default pull-right">
                                                <?= lang('add_new_q_type') ?>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6 col-md-4 col-settings">
            <h4><?= lang('my_payment_methods') ?></h4>
            <table class="table table-bordered">
                <thead>
                    <tr> 
                        <th colspan="2"><?= lang('quantity_name') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($myPaymentMethods)) {
                        foreach ($myPaymentMethods as $myPaymentMethod) {
                            ?>
                            <tr>
                                <td><?= $myPaymentMethod['name'] ?></td>
                                <td class="text-right">
                                    <a href="<?= base_url('user/settings/invoices/delete/paymentmethod/' . $myPaymentMethod['id']) ?>" class="confirm btn btn-xs btn-default" data-my-message="<?= lang('conirm_del_my_pay_method') ?>">
                                        <?= lang('delete') ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="2"><?= lang('no_my_pay_methods') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2">
                            <form method="POST" action="" class="site-form" id="formAddPaymentMethod">
                                <table>
                                    <tr>
                                        <td><input type="text" name="paymentMethodName" class="form-control field"></td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="addNewPaymentMethod()" class="btn btn-default pull-right">
                                                <?= lang('add_new_p_method') ?>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6 col-md-4 col-settings">
            <h4><?= lang('my_no_vat_reasons') ?></h4>
            <table class="table table-bordered">
                <thead>
                    <tr> 
                        <th colspan="2"><?= lang('vat_reason') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($myNoVatReasons)) {
                        foreach ($myNoVatReasons as $myNoVatReason) {
                            ?>
                            <tr>
                                <td><?= $myNoVatReason['reason'] ?></td>
                                <td class="text-right">
                                    <a href="<?= base_url('user/settings/invoices/delete/novatreason/' . $myNoVatReason['id']) ?>" class="confirm btn btn-xs btn-default" data-my-message="<?= lang('confirm_del_no_vat_reason') ?>">
                                        <?= lang('delete') ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="2"><?= lang('no_my_no_vat_reasons') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2">
                            <form method="POST" action="" class="site-form" id="formAddNoVatReason">
                                <table>
                                    <tr>
                                        <td><input type="text" name="noVatReason" class="form-control field"></td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="addNewNoVatReason()" class="btn btn-default pull-right">
                                                <?= lang('add_new_vat_reas') ?>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6 col-md-4 col-settings">
            <h4><?= lang('how_do_you_round_values') ?></h4>
            <form method="POST" action="" class="site-form" id="formRoundTotals">
                <table>
                    <tr>
                        <td><input type="text" value="<?= $opt_invRoundTo ?>" name="opt_invRoundTo" class="form-control field optRoundTo"></td>
                        <td>
                            <a href="javascript:void(0);" onclick="updateRoundTotals()" class="btn btn-default pull-right">
                                <?= lang('update_round_totals') ?>
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>    
        <div class="col-sm-6 col-md-4 col-settings">     
            <h4><?= lang('stop_inv_calculator') ?></h4>
            <form method="POST" action="">
                <div class="checkbox">
                    <label><input type="checkbox" name="opt_invCalculator" <?= $opt_invCalculator == 0 ? 'checked="checked"' : '' ?> value=""><?= lang('stop_inv_calculator') ?></label>
                </div> 
                <button class="btn btn-default" name="updateInvCalculator" value="" type="submit">
                    <?= lang('save') ?>
                </button> 
            </form>
        </div>
        <div class="col-sm-6 col-md-4 col-settings">     
            <h4><?= lang('inv_templ_change') ?></h4>
            <form method="POST" action="">
                <div class="radio">
                    <label><input type="radio" <?= $opt_invTemplate == 'creative' ? 'checked=""' : '' ?>  name="invTempl" value="creative">Creative</label>
                </div>
                <div class="radio">
                    <label><input type="radio" <?= $opt_invTemplate == 'toner-save' ? 'checked=""' : '' ?> name="invTempl" value="toner-save">Toner-save</label>
                </div> 
                <button class="btn btn-default" name="updateInvTemplate" value="" type="submit">
                    <?= lang('save') ?>
                </button> 
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/plugins/jquery.eqheight.js') ?>"></script>
<script type="text/javascript">
                                $(document).ready(function () {
                                    $(".settings-inner-page").eqHeight(".col-settings");
                                });
</script>