<script src="<?= base_url('assets/plugins/math.min.js') ?>"></script>
<div class="selected-page">
    <div class="inner">
        <h1>
            <?= lang('add_movement') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/store') ?>"><?= lang('store') ?></a></li>  
            <li class="active"><?= lang('add_movement') ?></li>
        </ol>
    </div> 
</div> 
<?php if ($this->permissions->hasPerm('perm_add_movement')) { ?>
    <form action="" id="setMovementForm" class="site-form" method="POST">
        <div class="row">
            <div class="col-sm-6">  
                <div class="choose-translation">
                    <p><?= lang('explain_movem_translation') ?></p>
                    <select class="selectpicker" name="movement_translation" title="<?= lang('choose_movem_translation') ?>">
					    <option value="3"  selected=""><?= lang('default_inv_lang_fr') ?></option>
                        <option value="1"><?= lang('default_inv_lang_en') ?></option>
                        <option value="2"><?= lang('default_inv_lang_bg') ?></option>
                        <?php
                        if (!empty($movementsLanguages)) {
                            foreach ($movementsLanguages as $mvLanguage) {
                                ?>
                                <option value="<?= $mvLanguage['id'] ?>"><?= $mvLanguage['language_name'] ?>(<?= $mvLanguage['id'] ?>)</option>
                                <?php
                            }
                        }
                        ?> 
                    </select>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalAddNewTranslation" class="btn btn-default">
                        <?= lang('choose_movem_translation') ?>
                    </a>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalExplainTranslation">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </a>
                </div>
            </div> 
            <div class="col-sm-6">
                <div class="pull-right">  
                    <div class="choose-firm-translation">
                        <p><?= lang('explain_firm_translation') ?></p>
                        <select class="selectpicker" name="movement_firm_translation"> 
                            <?php
                            foreach ($allForFirm['translations'] as $theFirm) {
                                ?>
                                <option value="<?= $theFirm['id'] ?>" <?= $theFirm['is_default'] == 1 ? 'selected="selected"' : '' ?>><?= $theFirm['trans_name'] ?></option>
                                <?php
                            }
                            ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>  
        <div class="create-document">
            <div class="type">
                <label><?= lang('create_movement_type') ?></label> 
                <div class="special-radio">
                    <label class="control control--radio"><?= lang('movement_type_in') ?>
                        <input type="radio" value="in" name="type" class="movement-type" checked="" />
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--radio"><?= lang('movement_type_out') ?>
                        <input type="radio" value="out" name="type" class="movement-type" />
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--radio"><?= lang('movement_type_move') ?>
                        <input type="radio" value="move" name="type" class="movement-type" />
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--radio"><?= lang('movement_type_revision') ?>
                        <input type="radio" value="revision" name="type" class="movement-type" />
                        <div class="control__indicator"></div>
                    </label>
                </div>
            </div>
            <div class="inner">
                <div class="row head-content">
                    <div class="col-sm-6 col-md-5"> 
                        <div class="form-group store-selector">
                            <label class="label-from-store hidden"><?= lang('movem_from_store') ?></label> 
                            <label class="label-to-store"><?= lang('movem_to_store') ?></label> 
                            <select class="selectpicker" name="selected_store" data-live-search="true">
                                <?php
                                foreach ($myStores as $myStore) {
                                    ?>
                                    <option value="<?= $myStore['id'] ?>"><?= $myStore['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group to-store-movement hidden">
                            <label class="label-from-store hidden"><?= lang('movem_to_store') ?></label> 
                            <label class="label-to-store"><?= lang('movem_to_store') ?></label> 
                            <select class="selectpicker" name="selected_to_store" data-live-search="true">
                                <?php
                                foreach ($myStores as $myStore) {
                                    ?>
                                    <option value="<?= $myStore['id'] ?>"><?= $myStore['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="movement-for-client">
                            <div class="column-data client">
                                <label class="label-from-client"><?= lang('create_movem_from_client') ?></label> 
                                <label class="label-to-client hidden"><?= lang('create_movem_to_client') ?></label>  
                                <input type="text" name="client_name" value="" class="form-control field">
                                <a href="javascript:void(0);" data-choose-title="<?= lang('choose_client') ?>" data-selector-type="client" class="choose">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    <span><?= lang('create_inv_choose') ?></span>
                                </a> 
                                <div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="is_to_person" id="individual-client" value=""><?= lang('create_inv_individual') ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="column-data client client-company"> 
                                <label><?= lang('create_inv_bulstat') ?></label> 
                                <input type="text" name="client_bulstat" value="" class="form-control field">
                                <a href="javascript:void(0);" data-choose-title="<?= lang('choose_client') ?>" data-selector-type="client" class="choose">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    <span><?= lang('create_inv_choose') ?></span>
                                </a>
                                <div>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="client_vat_registered" id="client-vat-registered" value=""><?= lang('create_inv_client_vat_registered') ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="column-data client-company client-vat-registered">
                                <label><?= lang('create_inv_vat_number') ?></label>
                                <input type="text" value="" name="vat_number" class="form-control field">
                            </div>
                            <div class="column-data client-company">
                                <label><?= lang('create_inv_mol') ?></label>
                                <input type="text" value="" name="accountable_person" class="form-control field">
                            </div>
                            <div class="column-data client-individial">
                                <label><?= lang('create_inv_ident_num') ?></label>
                                <input type="text" value="" name="client_ident_num" class="form-control field">
                            </div>
                            <div class="column-data">
                                <label><?= lang('create_inv_city') ?></label>
                                <input type="text" value="" name="client_city" class="form-control field">
                            </div>
                            <div class="column-data">
                                <label><?= lang('create_inv_address') ?></label>
                                <input type="text" value="" name="client_address" class="form-control field">
                            </div>
                            <div class="column-data">
                                <label><?= lang('create_inv_country') ?></label>
                                <input type="text" value="" name="client_country" class="form-control field">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-7">
                        <div class="invoice-setting">
                            <div class="column-data">
                                <span class="inv-type-num"><?= lang('create_movement_id') ?></span> <label>№:</label>
                                <input type="text" name="movement_number" value="<?= $nextMovementNumber ?>" class="form-control field">
                            </div>
                            <div class="column-data">
                                <label><?= lang('create_movement_date_create') ?></label>
                                <input type="text" name="date_create" placeholder="dd.mm.yyyy" value="<?= date('d.m.Y', time()) ?>" class="form-control field datepicker">
                            </div>
                            <div class="column-data">
                                <label><?= lang('create_movement_lot') ?></label>
                                <input type="text" name="lot" value="" class="form-control field">
                            </div>
                            <div class="column-data">
                                <label><?= lang('create_movement_expire') ?></label>
                                <input type="text" name="expire_date" value="<?= date('d.m.Y', strtotime('+2 years')) ?>" class="form-control field datepicker">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="select-currency">
                    <?= lang('select_curreny') ?> 
                    <select class="selectpicker" id="selectCurrencyNewInv" name="movement_currency" title="<?= lang('no_currency_selected') ?>" data-live-search="true">
                        <?php
                        $choosedCur = false;
                        foreach ($currencies as $currency) {
                            if ($theCurrency == $currency['value']) {
                                $selectedCurrency = 'selected';
                                $choosedCur = true;
                            } else {
                                $selectedCurrency = '';
                            }
                            ?>
                            <option value="<?= $currency['value'] ?>" <?= $selectedCurrency ?>><?= $currency['name'] ?></option>
                        <?php } if ($selectedCurrency == '' && $choosedCur == false) { ?>
                            <option value="<?= $theCurrency ?>" selected=""><?= $theCurrency ?></option> 
                        <?php } ?>
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-items">
                        <thead>
                            <tr>
                                <th></th>
                                <th><?= lang('create_inv_item') ?></th>
                                <th><?= lang('create_inv_quantity') ?></th>
                                <th><?= lang('create_inv_price') ?></th>
                                <th class="text-right"><?= lang('create_inv_total') ?></th>
                            </tr>
                        </thead>
                        <tbody class="body-items">
                            <?php
                            $thisDir = ltrim(str_replace(getcwd(), '', dirname(__FILE__)), '/');
                            include $thisDir . '/itemTableTr.php';
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="items-features">
                    <a href="javascript:void(0);" class="add-new-item">
                        <i class="fa fa-plus"></i>
                        <?= lang('add_new_item_to_table') ?>
                    </a>
                </div>
                <div class="row amounts">
                    <div class="col-sm-12 col-md-6 col-md-offset-6">
                        <div class="row amount-row">
                            <div class="col-sm-6">
                                <?= lang('create_movement_amount') ?>
                            </div>
                            <div class="col-sm-6">
                                <div class="amount">
                                    <span id="items-total">0.00</span> 
                                    <input type="hidden" value="0.00" name="amount" class="items-total">
                                    <span class="currency-text">
                                        <?= $theCurrency ?>
                                    </span>
                                </div> 
                            </div>
                        </div>
                        <div class="row amount-row">
                            <div class="col-sm-6">
                                <div class="discount-txt">
                                    <?= lang('create_inv_discount') ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="discount">
                                    <input type="text" value="<?= isset($_POST['discount']) ? $_POST['discount'] : '0.00' ?>" name="discount" class="form-control field text-discount">
                                    <div class="select-discount">
                                        <select class="selectpicker form-control" name="discount_type" id="discount-value"> 
                                            <option class="currency-text" <?= isset($_POST['discount_type']) && $_POST['discount_type'] != '%' ? 'selected="selected"' : '' ?>><?= $theCurrency ?></option>
                                            <option <?= isset($_POST['discount_type']) && $_POST['discount_type'] == '%' ? 'selected="selected"' : '' ?>>%</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row amount-row">
                            <div class="col-sm-6">
                                <?= lang('create_inv_tax_base') ?>
                            </div>
                            <div class="col-sm-6">
                                <div class="amount">
                                    <span id="tax-base"><?= isset($_POST['tax_base']) ? $_POST['tax_base'] : '0.00' ?></span>
                                    <input type="hidden" value="<?= isset($_POST['tax_base']) ? $_POST['tax_base'] : '0.00' ?>" name="tax_base" class="tax-base field">
                                    <span class="currency-text">
                                        <?= $theCurrency ?>
                                    </span>
                                </div> 
                            </div>
                        </div>
                        <div class="row amount-row">
                            <div class="col-sm-6">
                                <div class="no-vat-container" <?= isset($_POST['no_vat']) && $_POST['no_vat'] == 1 ? 'style="display:none;"' : '' ?>>
                                    <?= lang('create_inv_vat') ?>
                                    <input type="text" class="form-control field vat-field" name="vat_percent" value="<?= isset($_POST['vat_percent']) ? $_POST['vat_percent'] : '20' ?>">
                                    %
                                </div>
                                <div class="no-vat">
                                    <div class="checkbox">
                                        <label><input type="checkbox" <?= isset($_POST['no_vat']) && $_POST['no_vat'] == 1 ? 'checked="checked"' : '' ?>  name="no_vat" id="no-vat" value=""><?= lang('create_inv_no_vat_mark') ?></label>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-6"> 
                                <div class="amount the-vat" <?= isset($_POST['no_vat']) && $_POST['no_vat'] == 1 ? 'style="display:none;"' : '' ?>>
                                    <span id="vat-sum"><?= isset($_POST['vat_sum']) ? $_POST['vat_sum'] : '0.00' ?></span> 
                                    <input type="hidden" name="vat_sum" value="<?= isset($_POST['vat_sum']) ? $_POST['vat_sum'] : '0.00' ?>" class="vat-sum field">
                                    <span class="currency-text">
                                        <?= $theCurrency ?>
                                    </span>
                                </div> 
                                <div class="no-vat-field" <?= isset($_POST['no_vat']) && $_POST['no_vat'] == 1 ? 'style="display:block;"' : '' ?>>
                                    <label><?= lang('create_inv_reason_no_vat') ?></label> 
                                    <input type="text" class="form-control field" name="no_vat_reason" value="<?= isset($_POST['no_vat_reason']) ? $_POST['no_vat_reason'] : '' ?>">
                                    <?php if (!empty($myNoVatReasons)) { ?>
                                        <select class="selectpicker" id="select-vat-from-list" title="<?= lang('no_vat_reason_selected') ?>" data-live-search="true">
                                            <?php
                                            foreach ($myNoVatReasons as $vatReason) {
                                                ?>
                                                <option value="<?= $vatReason['reason'] ?>"><?= $vatReason['reason'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row amount-row total-row">
                            <div class="col-sm-6">
                                <span class="total"><?= lang('create_inv_total') ?></span> 
                            </div>
                            <div class="col-sm-6">
                                <div class="amount total">
                                    <span id="final-total"><?= isset($_POST['final_total']) ? $_POST['final_total'] : '0.00' ?></span>
                                    <input type="hidden" name="final_total" class="final-total field" value="<?= isset($_POST['final_total']) ? $_POST['final_total'] : '0.00' ?>">
                                    <span class="currency-text">
                                        <?= $theCurrency ?>
                                    </span>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="remarks">
                    <label><?= lang('create_inv_remarks') ?><sup><?= lang('visibile_for_client') ?></sup></label>
                    <textarea class="form-control field area" name="remarks"><?= isset($_POST['remarks']) ? $_POST['remarks'] : '' ?></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="payment-type">
                            <label><?= lang('create_inv_payment_type') ?></label>
                            <select class="selectpicker payment-method" name="payment_method">
                                <?php foreach ($paymentMethods as $paymentMethod) { ?>
                                    <option value="<?= $paymentMethod['name'] ?>"><?= $paymentMethod['name'] ?></option>
                                <?php } if (isset($_POST['payment_method'])) { ?>
                                    <option value="<?= $_POST['payment_method'] ?>" selected=""><?= $_POST['payment_method'] ?></option>
                                <?php } ?>
                                <option value="--">--</option>
                                <option value="createNewMethod"><?= lang('create_new_pay_method') ?></option>
                            </select> 
                        </div> 
                    </div> 
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label><?= lang('momvem_betrayed') ?></label>
                            <input type="text" class="form-control field" name="betrayed" value="">
                        </div>
                        <div class="form-group">
                            <label><?= lang('momvem_accepted') ?></label>
                            <input type="text" class="form-control field" name="accepted" value="">
                        </div>
                    </div>
                </div>
            </div> 
            <a href="javascript:void(0);" onclick="validateStoreMovement()" class="btn btn-green"><?= lang('create_store_movement') ?></a>
            <?= lang('or') ?>
            <a href="<?= lang_url('user/store') ?>"><?= lang('open_store_movements') ?></a>
        </div>
    </form>
    <?php
    include 'application/modules/users/views/invoices/modals/add_quantity_type.php';
    include 'application/modules/users/views/invoices/modals/add_payment_method.php';
    include 'application/modules/users/views/invoices/modals/selector.php';
    ?>
    <!-- Modal Explain Add Translations -->
    <div class="modal fade" id="modalExplainTranslation" tabindex="-1" role="dialog" aria-labelledby="modalExplainTranslation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?= lang('what_mean_new_translate') ?></h4>
                </div>
                <div class="modal-body">
                    <?= lang('what_mean_new_translate_explain') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button> 
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Create New Translation -->
    <div class="modal fade" id="modalAddNewTranslation" tabindex="-1" role="dialog" aria-labelledby="modalAddNewTranslation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?= lang('add_new_translation') ?></h4>
                </div>
                <div class="modal-body site-form">
                    <form method="POST" action="" id="formAddNewTranslate">
                        <input type="hidden" name="addNewMovementTranslation" value="1">
                        <div class="form-group">
                            <label><?= lang('trans_language_name') ?></label>
                            <input type="text" name="language_name" placeholder="<?= lang('lang_name_internal_use') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_bill_of_goods') ?></label>
                            <input type="text" name="bill_of_goods" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_date') ?></label>
                            <input type="text" name="date" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_recipient') ?></label>
                            <input type="text" name="recipient" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_sender') ?></label>
                            <input type="text" name="sender" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_bulstat') ?></label>
                            <input type="text" name="bulstat" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_address') ?></label>
                            <input type="text" name="address" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_city') ?></label>
                            <input type="text" name="city" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_betrayed') ?></label>
                            <input type="text" name="betrayed" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_accepted') ?></label>
                            <input type="text" name="accepted" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_amount') ?></label>
                            <input type="text" name="amount" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_vat') ?></label>
                            <input type="text" name="vat" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_vat_amount') ?></label>
                            <input type="text" name="vat_amount" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_no_vat_reason') ?></label>
                            <input type="text" name="no_vat_reason" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_amount') ?></label>
                            <input type="text" name="final_amount" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_product_name') ?></label>
                            <input type="text" name="product_name" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_product_name') ?></label>
                            <input type="text" name="product_name" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_product_quantity') ?></label>
                            <input type="text" name="product_quantity" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_product_quantity_type') ?></label>
                            <input type="text" name="product_quantity_type" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_single_price') ?></label>
                            <input type="text" name="single_price" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_product_amount') ?></label>
                            <input type="text" name="product_amount" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_payment_method') ?></label>
                            <input type="text" name="payment_method" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div> 
                        <div class="form-group">
                            <label><?= lang('trans_page') ?></label>
                            <input type="text" name="page" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_vat_number') ?></label>
                            <input type="text" name="vat_number" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-default" onclick="saveNewTranslation()"><?= lang('save_new_translate') ?></a>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button> 
                </div>
            </div>
        </div>
    </div> 
    <?php if ($opt_movementCalculator == 0) { ?>
        <style>
            span.item-total, #items-total, #tax-base, #vat-sum, #final-total {display: none;}
        </style>
        <script>
            $('input.item-total, [name="invoice_amount"], [name="tax_base"], [name="vat_sum"], [name="final_total"]').attr('type', 'text');
        </script>
    <?php }
    ?>
    <script>
        var createDocument = {
            rountTo: <?= $opt_movementRoundTo ?>,
            calculatorStatus: <?= $opt_movementCalculator ?>
        };
    </script>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>
