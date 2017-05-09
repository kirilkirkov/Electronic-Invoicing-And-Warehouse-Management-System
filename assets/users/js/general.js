/*
 * okay we lets ready :)
 * @description Users JavaScript
 */
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
$('.close-alert').click(function () {
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
    obj.find('.field').val('');
    obj.find('.item-total-price').text('0');
    var selectedOption = $('#selectCurrencyNewInv').find(":selected").val();
    if (!selectedOption) {
        selectedOption = $('.currency-text').first().text();
    }
    obj.find('.item-total-price').append(' <span class="currency-text">' + selectedOption + '</span>');
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
        $('.new-quantity-value').css("border-color", "#e9e9e9");
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
        $('.new-quantity-value').css("border-color", "red");
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
        $('.my-new-pay-method').css("border-color", "#e9e9e9");
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
        $('.my-new-pay-method').css("border-color", "red");
    }
});
$('#addPaymentMethod').on('hidden.bs.modal', function () {
    $('select.payment-method option:first').prop("selected", "selected");
    $('.selectpicker').selectpicker('refresh');
});
/*
 * Create Invoice form validation
 */
function createNewInvValidate() {
    document.getElementById('setInvoiceForm').submit();
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
        $('#formAddCurrency .c-name').css("border-color", "red");
        valid = false;
    }
    if (value.length == 0) {
        $('#formAddCurrency .c-value').css("border-color", "red");
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
        $('[name="quantityTypeName"]').css("border-color", "red");
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formAddQuantityType').submit();
    }
}
/*
 * Add new payment method validator
 */
function addNewQuantityType() {
    var valid = true;
    var name = $('[name="paymentMethodName"]').val();
    name = $.trim(name);
    if (name.length == 0) {
        $('[name="paymentMethodName"]').css("border-color", "red");
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formAddPaymentMethod').submit();
    }
}