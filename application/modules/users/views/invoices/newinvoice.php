<script src="<?= base_url('assets/plugins/math.min.js') ?>"></script>
<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('create_invoice') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li class="active"><?= lang('create_invoice') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_add_invoice') && $editId == 0 || $this->permissions->hasPerm('perm_edit_invoice') && $editId > 0) { ?>
    <?php if ($planUnits['num_invoices'] > 0 || ($planUnits['num_invoices'] == 0 && $editId > 0)) { ?>
        <form action="" id="setInvoiceForm" class="site-form" method="POST">
            <div class="inner-page-menu">
                <a href="<?= lang_url('user/settings/invoices') ?>" class="btn btn-blue">
                    <?= lang('invoice_settings') ?>
                </a> 
            </div>
            <input type="hidden" name="client_from_list" value="0"> 
            <input type="hidden" name="status" value="issued"> 
            <?php if ($editId > 0) { ?>
                <input type="hidden" name="editId" value="<?= $editId ?>">
                <input type="hidden" name="onLoadItems" value="<?= implode(',', $currentItems) ?>">
            <?php } ?>
            <?php if ($editId > 0) { ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox">
                            <label><input type="checkbox" id="show-translations" name="show_translations" value=""><?= lang('show_translation_on_edit') . str_replace('%transname%', $_POST['translation']['language_name'], lang('show_translation_now_use')) ?></label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" id="show-translations-firms" name="show_translations_firms" value=""><?= lang('show_translation_on_edit') . str_replace('%transname%', $_POST['firm']['name'], lang('show_translation_firm_now_use')) ?></label>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row new-doc-page">
                <div class="col-sm-12 col-md-6 new-doc-page-right"> 
                    <div class="choose-translation" <?= $editId > 0 ? 'style="display:none;"' : '' ?>>
                        <p><?= lang('explain_inv_translation') ?></p>
                        <select class="selectpicker" name="invoice_translation" title="<?= lang('choose_translation') ?>">
						    <option value="3" selected=""><?= lang('default_inv_lang_fr') ?></option>
                            <option value="1"><?= lang('default_inv_lang_en') ?></option>
                            <option value="2"><?= lang('default_inv_lang_bg') ?></option>
                            <?php
                            if (!empty($invoiceLanguages)) {
                                foreach ($invoiceLanguages as $invLanguage) {
                                    ?>
                                    <option value="<?= $invLanguage['id'] ?>"><?= $invLanguage['language_name'] ?>(<?= $invLanguage['id'] ?>)</option>
                                    <?php
                                }
                            }
                            ?> 
                        </select>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modalAddNewTranslation" class="btn btn-default">
                            <?= lang('add_new_inv_translation') ?>
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modalExplainTranslation">
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </a>
                    </div>
                </div> 
                <div class="col-sm-12 col-md-6  new-doc-page-left"> 
                    <div class="choose-firm-translation" <?= $editId > 0 ? 'style="display:none;"' : '' ?>>
                        <p><?= lang('explain_firm_translation') ?></p>
                        <select class="selectpicker" name="invoice_firm_translation"> 
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
            <div class="create-document">
                <div class="type">
                    <label><?= lang('create_inv_type') ?></label> 
                    <div class="special-radio">
                        <label class="control control--radio"><?= lang('create_inv_proforma') ?>
                            <input type="radio" value="prof" name="inv_type" <?= isset($_POST['inv_type']) && $_POST['inv_type'] == 'prof' ? 'checked="checked"' : '' ?>/>
                            <div class="control__indicator"></div>
                        </label>
                        <label class="control control--radio"><?= lang('create_inv_invoice') ?>
                            <input type="radio" value="tax_inv" name="inv_type" <?= (isset($_POST['inv_type']) && $_POST['inv_type'] == 'tax_inv') || !isset($_POST['inv_type']) ? 'checked="checked"' : '' ?>/>
                            <div class="control__indicator"></div>
                        </label>
                        <label class="control control--radio"><?= lang('create_inv_debit') ?>
                            <input type="radio" value="debit" name="inv_type" <?= isset($_POST['inv_type']) && $_POST['inv_type'] == 'debit' ? 'checked="checked"' : '' ?>/>
                            <div class="control__indicator"></div>
                        </label>
                        <label class="control control--radio"><?= lang('create_inv_credit') ?>
                            <input type="radio" value="credit" name="inv_type" <?= isset($_POST['inv_type']) && $_POST['inv_type'] == 'credit' ? 'checked="checked"' : '' ?>/>
                            <div class="control__indicator"></div>
                        </label>
                    </div>
                </div>
                <div class="inner"> 
                    <h1 class="inv-type-title"><?= lang('invoice') ?></h1>
                    <div class="row credit-debit-option" <?= isset($_POST['inv_type']) && ($_POST['inv_type'] == 'debit' || $_POST['inv_type'] == 'credit') ? 'style="display:block;"' : '' ?>>
                        <div class="col-sm-5">
                            <div class="column-data">
                                <label><?= lang('to_inv_num') ?></label>
                                <input class="form-control field" value="<?= isset($_POST['to_inv_number']) ? $_POST['to_inv_number'] : '' ?>" name="to_inv_number" type="text">
                            </div>
                            <div class="column-data">
                                <label><?= lang('to_inv_date') ?></label>
                                <input class="form-control field datepicker" value="<?= isset($_POST['to_inv_date']) ? date('d.m.Y', $_POST['to_inv_date']) : '' ?>" name="to_inv_date" placeholder="dd.mm.yyyy" type="text">
                            </div>
                        </div> 
                    </div>
                    <div class="row head-content">
                        <div class="col-sm-6 col-md-5"> 
                            <div class="column-data client">
                                <label><?= lang('create_inv_client') ?></label> 
                                <input type="text" name="client_name" value="<?= isset($_POST['client']['client_name']) ? $_POST['client']['client_name'] : '' ?>" class="form-control field">
                                <a href="javascript:void(0);" data-choose-title="<?= lang('choose_client') ?>" data-selector-type="client" class="choose">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    <span><?= lang('create_inv_choose') ?></span>
                                </a>
                                <div class="clearfix"></div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="is_to_person" <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'checked="checked"' : '' ?> id="individual-client" value=""><?= lang('create_inv_individual') ?></label>
                                </div> 
                            </div>
                            <div class="column-data client client-company"  <?= isset($_POST['client']['is_to_person']) && $_POST['client']['is_to_person'] == 1 ? 'style="display:none;"' : '' ?>> 
                                <label><?= lang('create_inv_bulstat') ?></label> 
                                <input type="text" name="client_bulstat" value="<?= isset($_POST['client']['client_bulstat']) ? $_POST['client']['client_bulstat'] : '' ?>" class="form-control field">
                                <a href="javascript:void(0);" data-choose-title="<?= lang('choose_client') ?>" data-selector-type="client" class="choose">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    <span><?= lang('create_inv_choose') ?></span>
                                </a>
                                <div class="clearfix"></div>
                                <div class="checkbox">
                                    <label><input type="checkbox" <?= isset($_POST['client']['client_vat_registered']) && $_POST['client']['client_vat_registered'] == 1 ? 'checked="checked"' : '' ?> name="client_vat_registered" id="client-vat-registered" value=""><?= lang('create_inv_client_vat_registered') ?></label>
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
                                    <span class="inv-type-num"><?= lang('create_inv_inv_num') ?></span> <label>№:</label>
                                    <input type="text" name="inv_number" value="<?= isset($_POST['inv_number']) ? $_POST['inv_number'] : $nextInvNumber ?>" class="form-control field">
                                </div>
                                <div class="column-data">
                                    <label><?= lang('create_inv_date_create') ?></label>
                                    <input type="text" name="date_create" placeholder="dd.mm.yyyy" value="<?= isset($_POST['date_create']) ? date('d.m.Y', $_POST['date_create']) : date('d.m.Y', time()) ?>" class="form-control field datepicker">
                                </div>
                                <div class="column-data">
                                    <label><?= lang('create_inv_date_tax') ?></label>
                                    <input type="text" name="date_tax_event" placeholder="dd.mm.yyyy" value="<?= isset($_POST['date_tax_event']) ? date('d.m.Y', $_POST['date_tax_event']) : date('d.m.Y', time()) ?>" class="form-control field datepicker">
                                </div>
                                <div class="column-data">
                                    <div class="checkbox">
                                        <label><input type="checkbox" <?= isset($_POST['have_maturity_date']) && $_POST['have_maturity_date'] == 1 ? 'checked="checked"' : '' ?> name="have_maturity_date" id="maturity-date" value=""><?= lang('create_inv_i_maturity_date') ?></label>
                                    </div>
                                    <div class="maturity-date" <?= isset($_POST['have_maturity_date']) && $_POST['have_maturity_date'] == 1 ? 'style="display:block;"' : '' ?>>
                                        <label><?= lang('create_inv_maturity_date') ?></label>
                                        <input type="text" placeholder="dd.mm.yyyy" value="<?= isset($_POST['maturity_date']) ? date('m.d.Y', $_POST['maturity_date']) : date('d.m.Y', time()) ?>" name="maturity_date" class="form-control field datepicker">
                                    </div>
                                </div>
                                <div class="column-data">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="cash_accounting" <?= isset($_POST['cash_accounting']) && $_POST['cash_accounting'] == 1 ? 'checked="checked"' : '' ?> value=""><?= lang('create_inv_cash_acc') ?></label>
                                    </div>
                                </div>
                                <?php if ($editId > 0) { ?>
                                    <div class="column-data">
                                        <label><?= lang('composed_from') ?></label>
                                        <input type="text" name="composed" value="<?= $_POST['composed'] ?>" class="form-control field">
                                    </div> 
                                    <div class="column-data">
                                        <label><?= lang('schiffer_replace') ?></label>
                                        <input type="text" name="schiffer" value="<?= $_POST['schiffer'] ?>" class="form-control field">
                                    </div> 
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="select-currency">
                        <?= lang('select_curreny') ?> 
                        <select class="selectpicker" id="selectCurrencyNewInv" name="inv_currency" title="<?= lang('no_currency_selected') ?>" data-live-search="true">
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
                                    <?= lang('create_inv_invoice_amount') ?>
                                </div>
                                <div class="col-sm-6">
                                    <div class="amount">
                                        <span id="items-total"><?= isset($_POST['invoice_amount']) ? $_POST['invoice_amount'] : '0.00' ?></span> 
                                        <input type="hidden" value="<?= isset($_POST['invoice_amount']) ? $_POST['invoice_amount'] : '0.00' ?>" name="invoice_amount" class="items-total field">
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
                <a href="javascript:void(0);" onclick="createNewInvValidate()" class="btn btn-green"><?= $editId == 0 ? lang('create_inv_save') : lang('update_inv_save') ?></a>
                <?php if ($editId == 0) { ?>
                    <a href="javascript:void(0);" onclick="createDraft()" class="btn btn-orange"><?= lang('create_inv_save_draft') ?></a>
                <?php } ?>
                <?= lang('or') ?>
                <a href="<?= lang_url('user/invoices') ?>"><?= lang('open_invoices') ?></a>
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
                            <input type="hidden" name="addNewInvoiceLanguage" value="1">
                            <div class="form-group">
                                <label><?= lang('trans_language_name') ?></label>
                                <input type="text" name="language_name" placeholder="<?= lang('lang_name_internal_use') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_recipient') ?></label>
                                <input type="text" name="recipient" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_bulstat') ?></label>
                                <input type="text" name="bulstat" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_mol') ?></label>
                                <input type="text" name="mol" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_sender') ?></label>
                                <input type="text" name="sender" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_original') ?></label>
                                <input type="text" name="original" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_number') ?></label>
                                <input type="text" name="number" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_date_of_issue') ?></label>
                                <input type="text" name="date_of_issue" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_date_tax_event') ?></label>
                                <input type="text" name="a_date_of_a_tax_event" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_to_an_invoice') ?></label>
                                <input type="text" name="to_an_invoice" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_from_date') ?></label>
                                <input type="text" name="from_date" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_invoice') ?></label>
                                <input type="text" name="invoice" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_debit_note') ?></label>
                                <input type="text" name="debit_note" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_credit_note') ?></label>
                                <input type="text" name="credit_note" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_remarks') ?></label>
                                <input type="text" name="remarks" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_pro_forma') ?></label>
                                <input type="text" name="pro_forma" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_products_name') ?></label>
                                <input type="text" name="products_name" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_quantity') ?></label>
                                <input type="text" name="quantity" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_single_price') ?></label>
                                <input type="text" name="single_price" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_value') ?></label>
                                <input type="text" name="value" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_amount') ?></label>
                                <input type="text" name="amount" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_tax_base') ?></label>
                                <input type="text" name="tax_base" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_percentage_vat') ?></label>
                                <input type="text" name="percentage_vat" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="from-group">
                                <label><?= lang('trans_vat_charget') ?></label>
                                <input type="text" name="vat_charget" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_everything') ?></label>
                                <input type="text" name="everything" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_reason_non_var') ?></label>
                                <input type="text" name="reason_for_non_vat" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
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
                                <label><?= lang('trans_schiffer') ?></label>
                                <input type="text" name="schiffer" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_discount') ?></label>
                                <input type="text" name="discount" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_payment_type') ?></label>
                                <input type="text" name="payment_type" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_page') ?></label>
                                <input type="text" name="page" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_i_accept') ?></label>
                                <input type="text" name="i_accept" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_i_refuse') ?></label>
                                <input type="text" name="i_refuse" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_vat_number') ?></label>
                                <input type="text" name="vat_number" placeholder="<?= lang('your_translation') ?>" value="" class="form-control field field-new-translate">
                            </div>
                            <div class="form-group">
                                <label><?= lang('trans_receive_from') ?></label>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" name="receive_inv_from" placeholder="<?= lang('you_receved_tr') ?>" value="" class="form-control field field-new-translate">
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <?= lang('invoice') ?>
                                    </div>
                                    <div class="col-sm-5"> 
                                        <input type="text" name="receive_inv_from" placeholder="<?= lang('from_tr') ?>" value="" class="form-control field field-new-translate">
                                    </div>
                                </div>
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
        <?php if ($opt_invCalculator == 0) { ?>
            <style>
                span.item-total, #items-total, #tax-base, #vat-sum, #final-total {display: none;}
            </style>
            <script>
                $('input.item-total, [name="invoice_amount"], [name="tax_base"], [name="vat_sum"], [name="final_total"]').attr('type', 'text');
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
        <?php
// if load items from other document, lets calculate him
        if (isset($_GET['create-from'])) {
            ?>
                $(document).ready(function () {
                    createInvoiceCalculator();
                });
        <?php } ?>
            var createDocument = {
                rountTo: <?= $opt_invRoundTo ?>,
                calculatorStatus: <?= $opt_invCalculator ?>
            };
        </script>
    <?php } else {
        ?>
        <h1 class="limit-error"><?= lang('limit_inv_error') ?></h1>
        <?php
    }
} else {
    ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>
