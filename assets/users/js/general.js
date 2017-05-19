/*
 * okay we lets ready :)
 * @description Users JavaScript
 */
var pattern_sums = /^[0-9\-\.\,]+$/;
var border_color_fields = '#e9e9e9';
var border_color_wrong = 'red';
var alertBoxHtml = '<div class="alert-errors">%output%<a href="javascript:void(0);" class="close-alert" onclic="cs"><i class="fa fa-times" aria-hidden="true"></i></a></div>';


$(document).ready(function () {
    /*
     * Confirm dialog
     */
    $('.confirm').click(function (e) {
        e.preventDefault();
        var lHref = $(this).attr('href');
        var myMessage = $(this).data('my-message');
        bootbox.confirm({
            message: myMessage,
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    window.location.href = lHref;
                }
            }
        });
    });
    /*
     * Alerts fade out after 5sec.
     */
    if ($('.alert-errors').length) {
        $('.alert-errors').delay(4000).fadeOut(1500);
    }
    /*
     * DatePicker
     */
    $('.datepicker').datepicker({
        format: 'dd.mm.yyyy'
    });
    /*
     * Sortable items in Create Invoice page
     */
    $('.body-items').sortable({
        handle: '.move-me'
    });
});
/*
 * Alerts close
 */
$(document).on("click", ".close-alert", function () {
    $('.alert-errors').hide();
});
/*
 * Checkbox maturity date in craete invoice page
 */
$('#maturity-date').change(function () {
    if ($(this).is(":checked")) {
        $('.maturity-date').show();
    } else {
        $('.maturity-date').hide();
    }
});
/*
 * Change company to individaul and back
 */
$('#individual-client').change(function () {
    if ($(this).is(":checked")) {
        $('.client-company').hide();
        $('.client-individial').show();
    } else {
        $('.client-company').show();
        $('.client-individial').hide();
    }
});
/*
 * Show client vat field for vat registration
 */
$('#client-vat-registered').change(function () {
    if ($(this).is(":checked")) {
        $('.client-vat-registered').show();
    } else {
        $('.client-vat-registered').hide();
    }
});
/*
 * Checkbox no vat in craete invoice page
 */
$('#no-vat').change(function () {
    if ($(this).is(":checked")) {
        $('.no-vat-container, .the-vat').hide();
        $('.no-vat-field').show();
    } else {
        $('.no-vat-container, .the-vat').show();
        $('.no-vat-field').hide();
    }
});
/*
 * Add Item in create invoice page
 */
var numItemsDefault = 1;
$('.add-new-item').click(function () {
    var obj = $('.body-items tr:first').clone(true).insertAfter('tr:last');
    obj.find('.field').val('').css("border-color", border_color_fields);
    obj.find('.quantity-field').val('0.00').css("border-color", border_color_fields);
    obj.find('.price-field').val('0.00').css("border-color", border_color_fields);
    obj.find('.item-total-price').text('');
    var selectedOption = $('#selectCurrencyNewInv').find(":selected").val();
    if (!selectedOption) {
        selectedOption = $('.currency-text').first().text();
    }
    obj.find('.item-total-price').append('<span class="item-total">0.00</span> <span class="currency-text">' + selectedOption + '</span><input type="hidden" class="item-total" value="0.00" name="items_totals[]">');
    $('.body-items .actions').css('display', 'inline-block');
    numItemsDefault = numItemsDefault + 1;
    obj.find('.quantity-type select').attr('data-my-id', numItemsDefault);
});
/*
 * Remove Item in create invoice page
 */
$('.delete-item').on("click", function () {
    $(this).closest('tr').remove();
    if ($('.body-items tr').length < 2) {
        $('.body-items .actions').hide();
    }
});
/*
 * Select Currency for new invoice
 * On change we change curreny texts in class currency-text tags
 */
$('#selectCurrencyNewInv').change(function () {
    $('.currency-text').text($(this).val());
    $('.selectpicker').selectpicker('refresh');
});
/*
 * Select default currency for company
 */
$('.selectDefaultCurrency').change(function () {
    var forId = $(this).data('default-for');
    var newDefault = $(this).val();
    $.post(urls.changeDefaultCurrency, {forId: forId, newDefault: newDefault}, function (result) {
        if (result == '1') {
            $('.selected-new-default').fadeIn(500).delay(1000).fadeOut(500);
        } else {
            $('.not-selected-new-default').fadeIn(500).delay(1000).fadeOut(500);
        }
    });
});
/*
 * Quantity Type in create invoice page
 * When click create new show dialog box
 * Save new added values
 * Full manage logic is here
 */
var myNewQuantityType = false;
var whoIAm = 0;
$('.quantity-type select').change(function () {
    var selectedValue = $(this).val();
    whoIAm = $(this).attr('data-my-id');
    if (selectedValue == 'createNewQuantity') {
        $('#addQuantityType').modal('show');
        $('.new-quantity-value').val('');
        $('.new-quantity-value').css("border-color", border_color_fields);
        myNewQuantityType = false;
    }
    if (selectedValue == '--') {
        $('[data-my-id="' + whoIAm + '"] option:first').prop("selected", "selected");
    }
});
$('.add-my-new-quantity-type').click(function () {
    var newVal = $('.new-quantity-value').val();
    if (newVal != '') {
        myNewQuantityType = true;
        $('.quantity-type select').prepend('<option value="' + newVal + '">' + newVal + '</option>');
        $('[data-my-id="' + whoIAm + '"] option:first').prop("selected", "selected");
        $('#addQuantityType').modal('hide');
        $.post(urls.addNewQuantityType, {newVal: newVal}, function (result) {});
    } else {
        $('.new-quantity-value').css("border-color", border_color_wrong);
    }
});
$('#addQuantityType').on('hidden.bs.modal', function () {
    if (myNewQuantityType == false) {
        $('[data-my-id="' + whoIAm + '"] option:first').prop("selected", "selected");
    }
});
/*
 * Payment method - add new method
 */
$('select.payment-method').change(function () {
    var selectedValue = $(this).val();
    if (selectedValue == 'createNewMethod') {
        $('#addPaymentMethod').modal('show');
        $('.my-new-pay-method').val('');
        $('.my-new-pay-method').css("border-color", border_color_fields);
    }
    if (selectedValue == '--') {
        $('option', this).first().prop("selected", "selected");
    }
});
$('.add-my-new-pay-method').click(function () {
    var newVal = $('.my-new-pay-method').val();
    if (newVal != '') {
        $('select.payment-method').prepend('<option value="' + newVal + '">' + newVal + '</option>');
        $('#addPaymentMethod').modal('hide');
        $.post(urls.addNewPaymentMethod, {newVal: newVal}, function (result) {});
    } else {
        $('.my-new-pay-method').css("border-color", border_color_wrong);
    }
});
$('#addPaymentMethod').on('hidden.bs.modal', function () {
    $('select.payment-method option:first').prop("selected", "selected");
    $('.selectpicker').selectpicker('refresh');
});
/*
 * On change some form this html-s :)
 * Call the calculator
 */
$('.quantity-field, .price-field, .text-discount, .vat-field, #no-vat, #discount-value').change(function () {
    createInvoiceCalculator();
});
/*
 * Invoice type changer
 */
$('[name="inv_type"]').change(function () {
    var inv_type = $(this).val();
    if (inv_type == 'prof') {
        $('.inv-type-title').text(lang.proforma);
        $('.inv-type-num').text(lang.proforma);
        $('.credit-debit-option').hide();
    }
    if (inv_type == 'tax_inv') {
        $('.inv-type-title').text(lang.invoice);
        $('.inv-type-num').text(lang.invoice);
        $('.credit-debit-option').hide();
    }
    if (inv_type == 'debit') {
        $('.inv-type-title').text(lang.debit_note);
        $('.inv-type-num').text(lang.debit_note);
        $('.credit-debit-option').show();
    }
    if (inv_type == 'credit') {
        $('.inv-type-title').text(lang.credit_note);
        $('.inv-type-num').text(lang.credit_note);
        $('.credit-debit-option').show();
    }
});
/*
 * Create draft invoice
 */
function createDraft() {
    $('[name="is_draft"]').val(1);
    createNewInvValidate();
}
/*
 * Create Invoice form validation
 */
function createNewInvValidate() {
    var valid = true;
    $('[name="client_name"]').css("border-color", border_color_fields);
    $('[name="client_address"]').css("border-color", border_color_fields);
    $('[name="inv_number"]').css("border-color", border_color_fields);
    $('[name="date_create"]').css("border-color", border_color_fields);
    $('[name="date_tax_event"]').css("border-color", border_color_fields);
    var client_name = $('[name="client_name"]').val();
    var client_address = $('[name="client_address"]').val();
    var date_create = $('[name="date_create"]').val();
    var date_tax_event = $('[name="date_tax_event"]').val();
    var inv_number = $('[name="inv_number"]').val();
    if ($('[name="inv_type"]:checked').val() == 'debit' || $('[name="inv_type"]:checked').val() == 'credit') {
        $('[name="to_inv_number"]').css("border-color", border_color_fields);
        $('[name="to_inv_date"]').css("border-color", border_color_fields);
        var to_inv_number = $('[name="to_inv_number"]').val();
        var to_inv_date = $('[name="to_inv_date"]').val();
        if ($.trim(to_inv_number).length == 0) {
            $('[name="to_inv_number"]').css("border-color", border_color_wrong);
            valid = false;
        }
        if ($.trim(to_inv_date).length == 0) {
            $('[name="to_inv_date"]').css("border-color", border_color_wrong);
            valid = false;
        }
    }
    if ($.trim(client_name).length == 0) {
        $('[name="client_name"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if ($.trim(client_address).length == 0) {
        $('[name="client_address"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if ($.trim(date_create).length == 0) {
        $('[name="date_create"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if ($.trim(date_tax_event).length == 0) {
        $('[name="date_tax_event"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if ($.trim(inv_number).length == 0) {
        $('[name="inv_number"]').css("border-color", border_color_wrong);
        valid = false;
    }
    $('.body-items tr').each(function () {
        $('.quantity-field', this).css("border-color", border_color_fields);
        $('.field-item-name', this).css("border-color", border_color_fields);
        var item_quantity = $('.quantity-field', this).val();
        var item_name = $('.field-item-name', this).val();
        if (!pattern_sums.test(item_quantity) || item_quantity.length == 0 || item_quantity <= 0) {
            $('.quantity-field', this).css("border-color", border_color_wrong);
            valid = false;
        }
        if ($.trim(item_name).length == 0) {
            $('.field-item-name', this).css("border-color", border_color_wrong);
            valid = false;
        }

    });
    if (valid == true) {
        document.getElementById('setInvoiceForm').submit();
    } else {
        /*
         * Return to some default values
         * who is changed from submit buttons
         */
        $('[name="is_draft"]').val(0);
        $('html, body').animate({
            scrollTop: $("#setInvoiceForm").offset().top
        }, 1000);
        showError();
    }
}
/*
 * Show alert box
 */
function showError() {
    $(document.body).append(alertBoxHtml.replace('%output%', lang.errorCreateInvoice));
    $('.alert-errors').css('position', 'fixed');
}
/*
 * Add new currency validator
 */
function addNewCurrency() {
    var valid = true;
    var name = $('#formAddCurrency .c-name').val();
    var value = $('#formAddCurrency .c-value').val();
    name = $.trim(name);
    value = $.trim(value);
    if (name.length == 0) {
        $('#formAddCurrency .c-name').css("border-color", border_color_wrong);
        valid = false;
    }
    if (value.length == 0) {
        $('#formAddCurrency .c-value').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formAddCurrency').submit();
    }
}
/*
 * Add new quantity type validator
 */
function addNewQuantityType() {
    var valid = true;
    var name = $('[name="quantityTypeName"]').val();
    name = $.trim(name);
    if (name.length == 0) {
        $('[name="quantityTypeName"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formAddQuantityType').submit();
    }
}
/*
 * Add new payment method validator
 */
function addNewPaymentMethod() {
    var valid = true;
    var name = $('[name="paymentMethodName"]').val();
    name = $.trim(name);
    if (name.length == 0) {
        $('[name="paymentMethodName"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formAddPaymentMethod').submit();
    }
}
/*
 * Add new no vat reason validator
 */
function addNewNoVatReason() {
    var valid = true;
    var name = $('[name="noVatReason"]').val();
    name = $.trim(name);
    if (name.length == 0) {
        $('[name="noVatReason"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formAddNoVatReason').submit();
    }
}
/*
 * Create Invoice Calculator
 * Sum Items prices
 * Sum Vat %/Currency
 * Sum Discount
 * We will use math.js library
 * createInv variable is initialized in create invoice page
 */
function createInvoiceCalculator() {
    // Sum item by item
    var items_total = 0.00;
    $('.body-items tr').each(function () {
        $('.quantity-field', this).css("border-color", border_color_fields);
        $('.price-field', this).css("border-color", border_color_fields);
        var item_quantity = $('.quantity-field', this).val();
        var item_price = $('.price-field', this).val();
        var is_valid = true;
        if (!pattern_sums.test(item_quantity)) {
            $('.quantity-field', this).css("border-color", border_color_wrong);
            is_valid = false;
        }
        if (!pattern_sums.test(item_price)) {
            $('.price-field', this).css("border-color", border_color_wrong);
            is_valid = false;
        }
        if (is_valid == true) {
            var item_total = math.multiply(item_quantity, item_price).toFixed(createInv.rountTo);
            $('.item-total', this).text(item_total);
            $('.item-total', this).val(item_total);
            items_total = math.add(items_total, item_total).toFixed(createInv.rountTo);
        }
    });
    $('#items-total').text(items_total);
    $('.items-total', this).val(items_total);
    // Tax base after discount
    var discount_type = $('#discount-value option:selected').val();
    var discount_value = $('.text-discount').val();
    if (pattern_sums.test(discount_value)) {
        $('.text-discount').css("border-color", border_color_fields);
        if (discount_type == '%') {
            var tax_base = math.subtract(items_total, math.multiply(items_total, math.divide(discount_value, 100))).toFixed(createInv.rountTo);
        } else {
            var tax_base = math.subtract(items_total, discount_value).toFixed(createInv.rountTo);
        }
        $('#tax-base').text(tax_base);
        $('.tax-base').val(tax_base);
    } else {
        $('.text-discount').css("border-color", border_color_wrong);
    }
    // Get vat 
    var final_sum = tax_base;
    if (!$('#no-vat').is(":checked")) {
        var vat_percent = $('.vat-field').val();
        if (pattern_sums.test(vat_percent)) {
            $('.vat-field').css("border-color", border_color_fields);
            var vat_sum = math.multiply(math.divide(tax_base, 100), vat_percent).toFixed(createInv.rountTo);
            $('#vat-sum').text(vat_sum);
            $('.vat-sum').val(vat_sum);
            final_sum = math.add(tax_base, vat_sum).toFixed(createInv.rountTo);
        } else {
            $('.vat-field').css("border-color", border_color_wrong);
        }
    }
    // Set final sum
    $('#final-total').text(final_sum);
    $('.final-total').val(final_sum);
}
/*
 * Verify that filed for round totals is not empty
 */
function updateRoundTotals() {
    var pattern = /^[0-9]+$/;
    var valid = true;
    var name = $('[name="opt_inv_roundTo"]').val();
    name = $.trim(name);
    if (name.length == 0 || !pattern.test(name)) {
        $('[name="opt_inv_roundTo"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formRoundTotals').submit();
    }
}
/*
 * Verifi that translation no have empty fields
 * Submit form and add to db
 */
function saveNewTranslation() {
    $('.field-new-translate').css("border-color", border_color_fields);
    var valid = true;
    $('.field-new-translate').each(function (index) {
        var translate = $(this).val();
        translate = $.trim(translate);
        if (translate.length == 0) {
            $(this).css("border-color", border_color_wrong);
            valid = false;
        }
    });
    if (valid == true) {
        document.getElementById('formAddNewTranslate').submit();
    }
}