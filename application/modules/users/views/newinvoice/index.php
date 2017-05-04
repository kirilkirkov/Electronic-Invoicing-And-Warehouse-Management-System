<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <?= lang('create_invoice') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<div class="new-invoice">
    <div class="type">
        <label><?= lang('create_inv_type') ?></label> 
        <div class="special-radio">
            <label class="control control--radio"><?= lang('create_inv_proforma') ?>
                <input type="radio" name="radio"/>
                <div class="control__indicator"></div>
            </label>
            <label class="control control--radio"><?= lang('create_inv_invoice') ?>
                <input type="radio" name="radio" checked="checked"/>
                <div class="control__indicator"></div>
            </label>
            <label class="control control--radio"><?= lang('create_inv_debit') ?>
                <input type="radio" name="radio"/>
                <div class="control__indicator"></div>
            </label>
            <label class="control control--radio"><?= lang('create_inv_credit') ?>
                <input type="radio" name="radio"/>
                <div class="control__indicator"></div>
            </label>
        </div>
    </div>
    <div class="inner">
        <form action="" id="setInvoiceForm" class="site-form" method="POST">
            <h1><?= lang('invoice') ?></h1>
            <div class="row head-content">
                <div class="col-sm-6 col-md-5">
                    <div class="column-data client">
                        <label><?= lang('create_inv_client') ?></label> 
                        <input type="text" class="form-control field">
                        <a href="" class="choose">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            <span><?= lang('create_inv_choose') ?></span>
                        </a>
                    </div>
                    <div class="column-data client">
                        <label><?= lang('create_inv_bulstat') ?></label> 
                        <input type="text" class="form-control field">
                        <a href="" class="choose">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            <span><?= lang('create_inv_choose') ?></span>
                        </a>
                    </div>
                    <div class="column-data">
                        <label><?= lang('create_inv_mol') ?></label>
                        <input type="text" class="form-control field">
                    </div>
                    <div class="column-data">
                        <label><?= lang('create_inv_city') ?></label>
                        <input type="text" class="form-control field">
                    </div>
                    <div class="column-data">
                        <label><?= lang('create_inv_address') ?></label>
                        <input type="text" class="form-control field">
                    </div>
                    <div class="column-data">
                        <label><?= lang('create_inv_country') ?></label>
                        <input type="text" class="form-control field">
                    </div>
                    <div class="column-data">
                        <label><?= lang('create_inv_recipient') ?></label> 
                        <input type="text" class="form-control field"> 
                    </div>
                </div>
                <div class="col-sm-6 col-md-7">
                    <div class="invoice-setting">
                        <div class="column-data">
                            <label><?= lang('create_inv_inv_num') ?> №:</label>
                            <input type="text" class="form-control field">
                        </div>
                        <div class="column-data">
                            <label><?= lang('create_inv_date_create') ?></label>
                            <input type="text" placeholder="dd.mm.yy" value="<?= date('d.m.Y', time()) ?>" class="form-control field datepicker">
                        </div>
                        <div class="column-data">
                            <label><?= lang('create_inv_date_tax') ?></label>
                            <input type="text" placeholder="dd.mm.yy" value="<?= date('d.m.Y', time()) ?>" class="form-control field datepicker">
                        </div>
                        <div class="column-data">
                            <div class="checkbox">
                                <label><input type="checkbox" id="maturity-date" value=""><?= lang('create_inv_i_maturity_date') ?></label>
                            </div>
                            <div class="maturity-date">
                                <label><?= lang('create_inv_maturity_date') ?></label>
                                <input type="text" placeholder="dd.mm.yy" value="<?= date('d.m.Y', time()) ?>" class="form-control field datepicker">
                            </div>
                        </div>
                        <div class="column-data">
                            <div class="checkbox">
                                <label><input type="checkbox" value=""><?= lang('create_inv_cash_acc') ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="select-currency">
                <?= lang('select_curreny') ?> 
                <select class="selectpicker" id="selectCurrencyNewInv" title="<?= lang('no_currency_selected') ?>" data-live-search="true">
                    <?php foreach ($currencies as $currency) { ?>
                        <option value="<?= $currency['value'] ?>" <?= $myDefaultFirmCurrency == $currency['value'] ? 'selected' : '' ?>><?= $currency['name'] ?></option>
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
                        <tr>
                            <td>
                                <div class="actions">
                                    <a href="javascript:void(0);" class="btn btn-default delete-item" data-my-message="<?= lang('sure_want_to_del_item') ?>">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-default move-me">
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <input type="text" value="" name="item[]" class="form-control field field-item-name">
                                <a href="" class="choose">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    <span><?= lang('create_inv_choose') ?></span>
                                </a>
                            </td>
                            <td>
                                <input type="text" value="" class="form-control field quantity-field">
                                <div class="quantity-type">
                                    <select class="form-control">
                                        <option>Mustard</option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                    </select> 
                                </div>
                            </td>
                            <td>
                                <input type="text" value="" class="form-control field price-field">
                            </td>
                            <td class="text-right">
                                <div class="item-total-price">
                                    0 <span class="currency-text"><?= $myDefaultFirmCurrency != null  ? $myDefaultFirmCurrency : 'EUR' ?></span>
                                </div>
                            </td>
                        </tr> 
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
                            <div class="amount">0 <span class="currency-text"><?= $myDefaultFirmCurrency != null  ? $myDefaultFirmCurrency : 'EUR' ?></span></div> 
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
                                <input type="text" class="form-control field text-discount">
                                <div class="select-discount">
                                    <select class="selectpicker form-control">
                                        <option>%</option>
                                        <option class="currency-text"><?= $myDefaultFirmCurrency != null  ? $myDefaultFirmCurrency : 'EUR' ?></option>
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
                            <div class="amount">0 <span class="currency-text"><?= $myDefaultFirmCurrency != null  ? $myDefaultFirmCurrency : 'EUR' ?></span></div> 
                        </div>
                    </div>
                    <div class="row amount-row">
                        <div class="col-sm-6">
                            <div class="no-vat-container">
                                <?= lang('create_inv_vat') ?>
                                <input type="text" class="form-control field vat-field">
                                %
                            </div>
                            <div class="no-vat">
                                <div class="checkbox">
                                    <label><input type="checkbox" id="no-vat" value=""><?= lang('create_inv_no_vat_mark') ?></label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-6"> 
                            <div class="amount the-vat">0 <span class="currency-text"><?= $myDefaultFirmCurrency != null  ? $myDefaultFirmCurrency : 'EUR' ?></span></div> 
                            <div class="no-vat-field">
                                <label><?= lang('create_inv_reason_no_vat') ?></label>
                                <input type="text" class="form-control field">
                                <a href="" class="choose">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                    <span><?= lang('create_inv_choose') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row amount-row total-row">
                        <div class="col-sm-6">
                            <span class="total"><?= lang('create_inv_total') ?></span> 
                        </div>
                        <div class="col-sm-6">
                            <div class="amount total">0 <span class="currency-text"><?= $myDefaultFirmCurrency != null  ? $myDefaultFirmCurrency : 'EUR' ?></span></div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="remarks">
                <label><?= lang('create_inv_remarks') ?><sup><?= lang('visibile_for_client') ?></sup></label>
                <textarea class="form-control field area"></textarea>
            </div>
            <div class="payment-type">
                <label><?= lang('create_inv_payment_type') ?></label>
                <select class="selectpicker">
                    <option>Mustard</option>
                    <option>Ketchup</option>
                    <option>Relish</option>
                </select> 
            </div>
        </form>
    </div>
    <a href="javascript:void(0);" onclick="createInvValidate()" class="btn btn-green"><?= lang('create_inv_save') ?></a>
    <?= lang('or') ?>
    <a href="<?= lang_url('user/invoices') ?>"><?= lang('open_invoices') ?></a>
</div>