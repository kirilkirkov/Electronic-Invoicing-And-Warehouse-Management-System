<script src="<?= base_url('assets/plugins/math.min.js') ?>"></script>
<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('add_protocol') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li><a href="<?= lang_url('user/protocols') ?>"><?= lang('protocols') ?></a></li>  
            <li class="active"><?= lang('add_protocol') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_add_protocol')) { ?>
    <form action="" id="setProtocol" class="site-form" method="POST"> 
        <?php if ($editId > 0) { ?>
            <input type="hidden" name="editId" value="<?= $editId ?>">
            <input type="hidden" name="onLoadItems" value="<?= implode(',', $currentItems) ?>">
        <?php } ?> 
        <div class="row">
            <div class="col-sm-6">  
                <div class="choose-translation">
                    <p><?= lang('explain_protocol_translation') ?></p>
                    <select class="selectpicker" name="protocol_translation" title="<?= lang('choose_war_translation') ?>">
					    <option value="3" selected=""><?= lang('default_inv_lang_fr') ?></option>
                        <option value="1"><?= lang('default_inv_lang_en') ?></option>
                        <option value="2"><?= lang('default_inv_lang_bg') ?></option>
                        <?php
                        if (!empty($protocolsLanguages)) {
                            foreach ($protocolsLanguages as $protocolsLanguage) {
                                ?>
                                <option value="<?= $protocolsLanguage['id'] ?>"><?= $protocolsLanguage['language_name'] ?>(<?= $protocolsLanguage['id'] ?>)</option>
                                <?php
                            }
                        }
                        ?> 
                    </select>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalAddNewTranslation" class="btn btn-default">
                        <?= lang('add_protocol_translation') ?>
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
                        <select class="selectpicker" name="protocol_firm_translation"> 
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
                <label><?= lang('create_protocol_type') ?></label> 
                <div class="special-radio">
                    <label class="control control--radio"><?= lang('create_protocol_acceptable') ?>
                        <input type="radio" value="acceptable" name="type" <?= isset($_POST['type']) && $_POST['type'] == 'acceptable' ? 'checked="checked"' : '' ?>/>
                        <div class="control__indicator"></div>
                    </label>
                    <label class="control control--radio"><?= lang('create_protocol_transmitter') ?>
                        <input type="radio" value="transmitter" name="type" <?= (isset($_POST['type']) && $_POST['type'] == 'transmitter') || !isset($_POST['type']) ? 'checked="checked"' : '' ?>/>
                        <div class="control__indicator"></div>
                    </label>
                </div>
            </div>
            <div class="inner">
                <div class="row head-content">
                    <div class="col-sm-6 col-md-5"> 
                        <div class="column-data client">
                            <label><?= lang('create_inv_client') ?></label> 
                            <input type="text" name="client_name" value="<?= isset($_POST['client']['client_name']) ? $_POST['client']['client_name'] : '' ?>" class="form-control field">
                            <a href="javascript:void(0);" data-choose-title="<?= lang('choose_client') ?>" data-selector-type="client" class="choose">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span><?= lang('create_inv_choose') ?></span>
                            </a> 
                            <div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="is_to_person" <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'checked="checked"' : '' ?> id="individual-client" value=""><?= lang('create_inv_individual') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="column-data client client-company"  <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>> 
                            <label><?= lang('create_inv_bulstat') ?></label> 
                            <input type="text" name="client_bulstat" value="<?= isset($_POST['client']['client_bulstat']) ? $_POST['client']['client_bulstat'] : '' ?>" class="form-control field">
                            <a href="javascript:void(0);" data-choose-title="<?= lang('choose_client') ?>" data-selector-type="client" class="choose">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span><?= lang('create_inv_choose') ?></span>
                            </a>
                            <div>
                                <div class="checkbox">
                                    <label><input type="checkbox" <?= isset($_POST['client']['client_vat_registered']) && $_POST['client']['client_vat_registered'] == 1 ? 'checked="checked"' : '' ?> name="client_vat_registered" id="client-vat-registered" value=""><?= lang('create_inv_client_vat_registered') ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="column-data client-company client-vat-registered" <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:none;"' : '' ?> <?= isset($_POST['client_vat_registered']) && $_POST['client_vat_registered'] == 1 ? 'style="display:block;"' : '' ?>>
                            <label><?= lang('create_inv_vat_number') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['vat_number']) ? $_POST['client']['vat_number'] : '' ?>" name="vat_number" class="form-control field">
                        </div>
                        <div class="column-data client-company" <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>>
                            <label><?= lang('create_inv_mol') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['accountable_person']) ? $_POST['client']['accountable_person'] : '' ?>" name="accountable_person" class="form-control field">
                        </div>
                        <div class="column-data client-individial" <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:block;"' : '' ?>>
                            <label><?= lang('create_inv_ident_num') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['client_ident_num']) ? $_POST['client']['client_ident_num'] : '' ?>" name="client_ident_num" class="form-control field">
                        </div>
                        <div class="column-data">
                            <label><?= lang('create_inv_city') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['client_city']) ? $_POST['client']['client_city'] : '' ?>" name="client_city" class="form-control field">
                        </div>
                        <div class="column-data">
                            <label><?= lang('create_inv_address') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['client_address']) ? $_POST['client']['client_address'] : '' ?>" name="client_address" class="form-control field">
                        </div>
                        <div class="column-data">
                            <label><?= lang('create_inv_country') ?></label>
                            <input type="text" value="<?= isset($_POST['client']['client_country']) ? $_POST['client']['client_country'] : '' ?>" name="client_country" class="form-control field">
                        </div>
                        <div class="column-data client-company" <?= isset($_POST['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>>
                            <label><?= lang('create_inv_recipient') ?></label> 
                            <input type="text" value="<?= isset($_POST['client']['recipient_name']) ? $_POST['client']['recipient_name'] : '' ?>" name="recipient_name" class="form-control field"> 
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-7">
                        <div class="invoice-setting">
                            <div class="column-data">
                                <span class="inv-type-num"><?= lang('protocol_number') ?></span> <label>№:</label>
                                <input type="text" name="protocol_number" value="<?= isset($_POST['protocol_number']) ? $_POST['protocol_number'] : $nextProtocolNumber ?>" class="form-control field">
                            </div>
                            <div class="column-data">
                                <label><?= lang('create_protocol_from_date') ?></label>
                                <input type="text" name="from_date" placeholder="dd.mm.yyyy" value="<?= isset($_POST['from_date']) ? date('d.m.Y', $_POST['from_date']) : date('d.m.Y', time()) ?>" class="form-control field datepicker">
                            </div> 
                            <div class="column-data">
                                <label><?= lang('create_warranty_to_inv') ?></label>
                                <input type="text" name="to_invoice" placeholder="<?= lang('curr_name_for_int_use') ?>" value="<?= isset($_POST['to_invoice']) ? $_POST['to_invoice'] : '' ?>" class="form-control field">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label><?= lang('provider_transmit') ?></label>
                    <textarea class="form-control" name="provider_transmit" rows="5"><?= isset($_POST['provider_transmit']) ? $_POST['provider_transmit'] : '' ?></textarea>
                </div> 
                <div class="form-group">
                    <label><?= lang('select_saved_provider_trans') ?></labe>
                        <select class="selectpicker saved-prov-trans"> 
                            <option value="" selected=""></option>
                            <?php
                            foreach ($prov_transmits as $prov_transmit) {
                                ?>
                                <option value="<?= $prov_transmit['id'] ?>"><?= $prov_transmit['title'] ?></option>
                                <?php
                            }
                            ?> 
                        </select>
                        <?php
                        foreach ($prov_transmits as $prov_transmit) {
                            ?>
                            <div class="hidden" data-saved-prov-trans="<?= $prov_transmit['id'] ?>">
                                <?= $prov_transmit['description'] ?>
                            </div>
                            <?php
                        }
                        ?> 
                </div>
                <div class="select-currency">
                    <?= lang('select_curreny') ?> 
                    <select class="selectpicker" id="selectCurrencyNewInv" name="currency" title="<?= lang('no_currency_selected') ?>" data-live-search="true">
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
                            if (isset($_POST['items'])) {
                                foreach ($_POST['items'] as $itemPost) {
                                    include $thisDir . '/itemTableTr.php';
                                }
                            } else {
                                include $thisDir . '/itemTableTr.php';
                            }
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
                                <?= lang('create_protocol_amount') ?>
                            </div>
                            <div class="col-sm-6">
                                <div class="amount">
                                    <span id="items-total"><?= isset($_POST['amount']) ? $_POST['amount'] : '0.00' ?></span> 
                                    <input type="hidden" value="<?= isset($_POST['amount']) ? $_POST['amount'] : '0.00' ?>" name="amount" class="items-total field">
                                    <span class="currency-text">
                                        <?= $theCurrency ?>
                                    </span>
                                </div> 
                            </div>
                        </div>
                        <div class="row amount-row hidden">
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
                        <div class="row amount-row hidden">
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
                <div class="form-group">
                    <label><?= lang('protocol_contracts') ?></label>
                    <textarea class="form-control" name="contract" rows="5"><?= isset($_POST['contract']) ? $_POST['contract'] : '' ?></textarea>
                </div> 
                <div class="form-group">
                    <label><?= lang('select_saved_contracts') ?></labe>
                        <select class="selectpicker saved-contract"> 
                            <option value="" selected=""></option>
                            <?php
                            foreach ($contracts as $contract) {
                                ?>
                                <option value="<?= $contract['id'] ?>"><?= $contract['title'] ?></option>
                                <?php
                            }
                            ?> 
                        </select>
                        <?php
                        foreach ($contracts as $contract) {
                            ?>
                            <div class="hidden" data-saved-contract="<?= $contract['id'] ?>">
                                <?= $contract['contract'] ?>
                            </div>
                            <?php
                        }
                        ?> 
                </div>
                <div class="remarks">
                    <label><?= lang('create_inv_remarks') ?><sup><?= lang('visibile_for_client') ?></sup></label>
                    <textarea class="form-control field area" name="remarks"><?= isset($_POST['remarks']) ? $_POST['remarks'] : '' ?></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label><?= lang('warranty_received') ?></label>
                            <input type="text" class="form-control field" name="received" value="<?= isset($_POST['received']) ? $_POST['received'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label><?= lang('warranty_compiled') ?></label>
                            <input type="text" class="form-control field" name="compiled" value="<?= isset($_POST['compiled']) ? $_POST['compiled'] : '' ?>">
                        </div>
                    </div>
                </div>
            </div> 
            <a href="javascript:void(0);" onclick="createNewProtocolValidate()" class="btn btn-green"><?= lang('create_protocol') ?></a>
            <?= lang('or') ?>
            <a href="<?= lang_url('user/protocols') ?>"><?= lang('open_protocols') ?></a>
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
                        <input type="hidden" name="addNewProtocolTranslation" value="1">
                        <div class="form-group">
                            <label><?= lang('trans_language_name') ?></label>
                            <input type="text" name="language_name" placeholder="<?= lang('lang_name_internal_use') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_protocol_number') ?></label>
                            <input type="text" name="protocol_number" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_from_date') ?></label>
                            <input type="text" name="from_date" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_recipient') ?></label>
                            <input type="text" name="recipient" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_supplier') ?></label>
                            <input type="text" name="supplier" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
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
                            <input type="text" name="product_single_price" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_product_final_price') ?></label>
                            <input type="text" name="product_final_price" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
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
                            <label><?= lang('trans_final_amount') ?></label>
                            <input type="text" name="final_amount" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_received') ?></label>
                            <input type="text" name="received" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_compiled') ?></label>
                            <input type="text" name="compiled" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_signature') ?></label>
                            <input type="text" name="signature" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_page') ?></label>
                            <input type="text" name="page" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_to_invoice') ?></label>
                            <input type="text" name="to_invoice" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_city') ?></label>
                            <input type="text" name="city" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_address') ?></label>
                            <input type="text" name="address" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_bulstat') ?></label>
                            <input type="text" name="bulstat" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                        </div>
                        <div class="form-group">
                            <label><?= lang('trans_transmission_protocol') ?></label>
                            <input type="text" name="transmission_protocol" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
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
    <?php if ($opt_protocolCalculator == 0) { ?>
        <style>
            span.item-total, #items-total, #tax-base, #vat-sum, #final-total {display: none;}
        </style>
        <script>
            $('input.item-total, [name="amount"], [name="tax_base"], [name="vat_sum"], [name="final_total"]').attr('type', 'text');
        </script>
        <?php
    }
    /*
     * if edit invoice and have more from one items
     * show action buttons
     */
    if (isset($_POST['items']) && count($_POST['items']) > 1) {
        ?>
        <style>
            .create-document .actions {display: block;}
        </style>
    <?php }
    ?>
    <script>
        var createDocument = {
            rountTo: <?= $opt_protocolRoundTo ?>,
            calculatorStatus: <?= $opt_protocolCalculator ?>
        };
    </script>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>
