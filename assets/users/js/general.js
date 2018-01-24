/*
 * okay we lets ready :)
 * @description Users JavaScript
 */
var pattern_sums = /^[0-9\-\.\,]+$/;
var pattern_email = /\S+@\S+\.\S+/;
var border_color_fields = '#e9e9e9';
var border_color_wrong = 'red';
var alertBoxHtml = '<div class="alert-errors">%output%<a href="javascript:void(0);" class="close-alert" onclic="cs"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
var chooseItemIndex;
var pixelsPdfDelivery = 1300; // pixels that wkhtmltopdf deliver segments of pdf

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
    /*
     * NavBar Border Bottom check
     */
    if ($(window).scrollTop() != 0) {
        $(".navbar-user").addClass("navbar-scroll-border");
    } else {
        $(".navbar-user").removeClass("navbar-scroll-border");
    }
});
/*
 * NavBar Border Bottom check
 */
$(window).scroll(function () {
    if ($(this).scrollTop() != 0) {
        $(".navbar-user").addClass("navbar-scroll-border");
    } else {
        $(".navbar-user").removeClass("navbar-scroll-border");
    }
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
 * Show Translations
 * When edit invoice we hide translations
 * if user want to show him.. when save the invoice edit
 * we will get choosed translation :)
 */
$('#show-translations').change(function () {
    if ($(this).is(":checked")) {
        $('.choose-translation').show();
    } else {
        $('.choose-translation').hide();
    }
});
/*
 * Show Translations
 * When edit invoice we hide translations
 * if user want to show him.. when save the invoice edit
 * we will get choosed translation :)
 */
$('#show-translations-firms').change(function () {
    if ($(this).is(":checked")) {
        $('.choose-firm-translation').show();
    } else {
        $('.choose-firm-translation').hide();
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
        vatRegisteredFieldVisibility();
    }
});
/*
 * Show client vat field for vat registration
 */
$('#client-vat-registered').change(function () {
    vatRegisteredFieldVisibility();
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
    obj.find('.quantity-field').val('1.00').css("border-color", border_color_fields);
    obj.find('.price-field').val('0.00').css("border-color", border_color_fields);
    obj.find('.item-total-price').text('');
    obj.find('[name="item_from_list[]"]').val('0'); // clear some indicators
    obj.find('[name="is_item_update[]"]').val('0'); // clear some indicators
    var selectedOption = $('#selectCurrencyNewInv').find(":selected").val();
    if (!selectedOption) {
        selectedOption = $('.currency-text').first().text();
    }
    obj.find('.item-total-price').append('<span class="item-total">0.00</span> <input type="hidden" class="item-total field" value="0.00" name="items_totals[]"> <span class="currency-text">' + selectedOption + '</span>');
    $('.body-items .actions').css('display', 'inline-block');
    numItemsDefault = numItemsDefault + 1;
    obj.find('.quantity-type select').attr('data-my-id', numItemsDefault);
    if (createDocument.calculatorStatus == 0) {
        $('input.item-total, [name="invoice_amount"], [name="tax_base"], [name="vat_sum"], [name="final_total"]').attr('type', 'text');

    }
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
    var newVal = jQuery.trim($('.new-quantity-value').val());
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
    var newVal = jQuery.trim($('.my-new-pay-method').val());
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
 * Modal Selector
 */
$('.choose').click(function () {
    var modalTitle = $(this).data('choose-title');
    $('#modalSelector .modal-title').text(modalTitle);
    var selectorType = $(this).data('selector-type');

    /*
     * If we click choose in table of items
     * save this index because we will need after to
     * add item_from_list[] value to 1
     */
    if ($(this).closest('td').parent()[0]) {
        chooseItemIndex = $(this).closest('td').parent()[0].sectionRowIndex;
    }

    $.post(urls.modalSelector, {selectType: selectorType},
            function (htmlList) {
                $('#modalSelector .modal-body').empty().append(htmlList);
            });
    $('#modalSelector').modal('show');
});
/*
 * Select vat reason from list
 */
$('#select-vat-from-list').change(function () {
    $('[name="no_vat_reason"]').val($(this).val());
});
/*
 * Search in modal selector
 */
$(document).on("keyup", '[name="SearchDualList"]', function (e) {
    var current_query = $('[name="SearchDualList"]').val();
    if (current_query !== "") {
        $("#modalSelector .list-group li").hide();
        $("#modalSelector .list-group li").each(function () {
            var current_keyword = $(this).text();
            if (current_keyword.search(current_query) >= 0) {
                $(this).show();
            }
        });
    } else {
        $(".list-group li").show();
    }
});
/*
 * If we are on invoice preview page
 * Add pages segments
 */
if ($('.invoice-box').length) {
    var invoice_box = $('.invoice-box');
    var num_parts = parseInt(invoice_box.height() / pixelsPdfDelivery);
    var i = 1;
    var position = 0;
    while (i <= num_parts) {
        var newDelivery = $('.pageDelivery').last().clone().insertAfter('.pageDelivery:last');
        var position = position + pixelsPdfDelivery;
        newDelivery.css('top', position).removeClass('hidden').addClass('clone-delivery');
        i++;
    }
}
/*
 * if check checkbox {check-all-boxes}
 * lets check all boxes with class check-me-now :)
 */
$(".check-all-boxes").change(function () {
    if (this.checked) {
        $('.check-me-now').prop("checked", true);
    } else {
        $('.check-me-now').prop("checked", false);
    }
});
/*
 * .list-action buttons call action like delete, send
 * for all selected elements in list
 */
$('.list-action').click(function () {
    var action = $(this).data('action-type');
    $('[name="action"]').val(action);
    var num_checked = $(".check-me-now:checked").length;
    if (num_checked == 0) {
        showError(lang.noCheckedCheckboxes);
        return;
    }
    if (action == 'delete') {
        var the_message = lang.confirmDelete;
    }
    if (action == 'stat_canceled') {
        var the_message = lang.confirmCancel;
    }
    if (action == 'remove_canceled') {
        var the_message = lang.confirmRemoveCancel;
    }
    bootbox.confirm({
        message: the_message,
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
                document.getElementById('action-form').submit();
            }
        }
    });
});
/*
 * Change invoices payment status
 */
var parent_div_statuses;
$('.show-pay-statuses').click(function () { // show statuses
    parent_div_statuses = $(this);
    $('#payment-statuses').show().appendTo($(this).parents('.status-changer'));
});
$('.change-pay-status').click(function () { // ajax change status
    var new_pay_status = $(this).data('new-pay-status');
    var new_pay_status_text = $(this).text();
    var to_inv_id = parent_div_statuses.data('inv-id');
    parent_div_statuses.find('.new_pay_status_text').text(new_pay_status_text);
    parent_div_statuses.parents('.status-changer').removeClass().addClass('txt_status_' + new_pay_status + ' status-changer');
    $('#payment-statuses').hide();
    $.post(urls.changeInvoiceStatus, {invId: to_inv_id, newStatus: new_pay_status}, function (result) {
        if (result != '1') {
            showError(lang.errorChangeInvStatusAjax);
        }
    });
});
/*
 * Top search form
 */
$('.top-search-form .field').keyup(function () {
    var search_phrase = jQuery.trim($(this).val());
    if (search_phrase != '') {
        $('.top-search-form .fa-spinner').show();
        $('.top-search-form .spray-search').hide();
        $.post(urls.topNavSearch, {search: search_phrase}, function (result) {
            $('#topSearchResults').empty().hide();
            $('.top-search-form .fa-spinner').hide();
            $('.top-search-form .spray-search').show();
            $('#topSearchResults').append(result).show();
        });
    } else {
        $('#topSearchResults').empty().hide();
    }
});
/*
 * when export if check export all
 * disable input fields
 */
$('[name="export_all"]').change(function () {
    if ($(this).is(":checked")) {
        $('[name="from_date"]').attr('disabled', true);
        $('[name="to_date"]').attr('disabled', true);
    } else {
        $('[name="from_date"]').attr('disabled', false);
        $('[name="to_date"]').attr('disabled', false);
    }
});
/*
 * Store movements type
 */
$('.movement-type').change(function () {
    var movement_type = $(this).val();
    if (movement_type == 'in') {
        $('.label-from-client').removeClass('hidden');
        $('.label-to-client').addClass('hidden');

        $('.label-from-store').addClass('hidden');
        $('.label-to-store').removeClass('hidden');

        $('.movement-for-client').show();
        $('.to-store-movement').addClass('hidden');
    }
    if (movement_type == 'out') {
        $('.label-from-client').addClass('hidden');
        $('.label-to-client').removeClass('hidden');

        $('.label-from-store').removeClass('hidden');
        $('.label-to-store').addClass('hidden');

        $('.movement-for-client').show();
        $('.to-store-movement').addClass('hidden');
    }

    if (movement_type == 'move') {
        $('.movement-for-client').hide();
        $('.label-from-store').removeClass('hidden');
        $('.label-to-store').addClass('hidden');
        $('.to-store-movement').removeClass('hidden');
    }

    if (movement_type == 'revision') {
        $('.movement-for-client').hide();
        $('.label-from-store').removeClass('hidden');
        $('.label-to-store').addClass('hidden');
        $('.to-store-movement').addClass('hidden');
    }
});
/*
 * Choose saved condition 
 * When create warranty
 */
$('.saved-condition').change(function () {
    var selected_condition = $(this).val();
    var description_text = $('[data-saved-condition="' + selected_condition + '"]').text();
    $('[name="conditions"]').empty().append(description_text);
});
/*
 * Choose saved contracts 
 * When create protocols
 */
$('.saved-contract').change(function () {
    var selected = $(this).val();
    var description_text = $('[data-saved-contract="' + selected + '"]').text();
    $('[name="contract"]').empty().append(description_text);
});
/*
 * Choose saved contracts 
 * When create protocols
 */
$('.saved-prov-trans').change(function () {
    var selected = $(this).val();
    var description_text = $('[data-saved-prov-trans="' + selected + '"]').text();
    $('[name="provider_trasmit"]').empty().append(description_text);
});
/*
 * Firm vat registration field show/hide
 */
$('[name="is_vat_registered"]').change(function () {
    if ($(this).is(":checked")) {
        $('.firm-vat-number').removeClass('hidden');
    } else {
        $('.firm-vat-number').addClass('hidden');
    }
});
/*
 * Main menu button 
 * Show/Hide text for opened and hidden
 */
$('#btn-show-main-menu').click(function () {
    $("#main-menu").on("hide.bs.collapse", function () {
        $('#btn-show-main-menu').text(lang.show_main_menu);
    });
    $("#main-menu").on("show.bs.collapse", function () {
        $('#btn-show-main-menu').text(lang.hide_main_menu);
    });
})
/*
 * Create draft invoice
 */
function createDraft() {
    $('[name="status"]').val('draft');
    createNewInvValidate();
}
/*
 * Create Invoice form validation
 */
function createNewInvValidate() {
    var valid = true;
    var validItems = true;

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
    validItems = validateItems();
    if (validItems == false) {
        valid = false;
    }
    if (valid == true) {
        document.getElementById('setInvoiceForm').submit();
    } else {
        /*
         * Return to some default values
         * who is changed from submit buttons
         */
        $('[name="status"]').val('issued');
        $('html, body').animate({
            scrollTop: $("#setInvoiceForm").offset().top
        }, 1000);
        showError(lang.errorCreateDocument);
    }
}
/*
 * Store movement validator
 */
function validateStoreMovement() {
    var valid = true;
    var validItems = true;
    validItems = validateItems();
    if (validItems == false) {
        valid = false;
    }
	var selectedStore = $('[name="selected_store"]').val(); 
	if(!selectedStore) {
		valid = false;
		$('.store-selector button.btn-default').css("border-color", "red");
	}
    if (valid == true) {
        document.getElementById('setMovementForm').submit();
    } else {
        /*
         * Return to some default values
         * who is changed from submit buttons
         */
        $('[name="status"]').val('issued');
        $('html, body').animate({
            scrollTop: $("#setMovementForm").offset().top
        }, 1000);
        showError(lang.errorCreateDocument);
    }
}
/*
 * Create warranty validator
 */
function validateWarranty() {
    var valid = true;
    var validItems = true;
    validItems = validateWarrantyItems();
    if (validItems == false) {
        valid = false;
    }
    if (valid == true) {
        document.getElementById('setWarrantyForm').submit();
    } else {
        $('html, body').animate({
            scrollTop: $("#setWarrantyForm").offset().top
        }, 1000);
        showError(lang.errorCreateDocument);
    }
}
function validateWarrantyItems() {
    var valid = true;
    $('.body-items tr').each(function () {
        $('.field-item-name', this).css("border-color", border_color_fields);
        $('.field-item-months', this).css("border-color", border_color_fields);
        var item_name = $('.field-item-name', this).val();
        var items_months = $('.field-item-months', this).val();
        if (!pattern_sums.test(items_months) || $.trim(items_months).length == 0 || items_months <= 0) {
            $('.field-item-months', this).css("border-color", border_color_wrong);
            valid = false;
        }
        if ($.trim(item_name).length == 0) {
            $('.field-item-name', this).css("border-color", border_color_wrong);
            valid = false;
        }
    });
    if (valid == false) {
        return false;
    }
    return true;
}
/*
 * Add items validation
 */
function validateItems() {
    var valid = true;
    $('.body-items tr').each(function () {
        $('.quantity-field', this).css("border-color", border_color_fields);
        $('.field-item-name', this).css("border-color", border_color_fields);
        var item_quantity = $('.quantity-field', this).val();
        var item_name = $('.field-item-name', this).val();
        if (!pattern_sums.test(item_quantity) || $.trim(item_quantity).length == 0 || item_quantity <= 0) {
            $('.quantity-field', this).css("border-color", border_color_wrong);
            valid = false;
        }
        if ($.trim(item_name).length == 0) {
            $('.field-item-name', this).css("border-color", border_color_wrong);
            valid = false;
        }
    });
    if (valid == false) {
        return false;
    }
    return true;
}
/*
 * Show alert box
 */
function showError(text) {
    $(document.body).append(alertBoxHtml.replace('%output%', text));
    $('.alert-errors').css('position', 'fixed').delay(4000).fadeOut(1500);
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
 * Add new store validator
 */
function addNewStore() {
    var valid = true;
    var name = $('[name="newStore"]').val();
    name = $.trim(name);
    if (name.length == 0) {
        $('[name="newStore"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formAddStore').submit();
    }
}
/*
 * Create Invoice Calculator
 * Sum Items prices
 * Sum Vat %/Currency
 * Sum Discount
 * We will use math.js library
 * createDocument variable is initialized in calculator used pages
 */
function createInvoiceCalculator() {
    // if is enabled calculator
    if (createDocument.calculatorStatus == 1) {
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
                var item_total = math.multiply(item_quantity, item_price).toFixed(createDocument.rountTo);
                $('.item-total', this).text(item_total);
                $('.item-total', this).val(item_total);
                items_total = math.add(items_total, item_total).toFixed(createDocument.rountTo);
            }
        });
        $('#items-total').text(items_total);
        $('.items-total').val(items_total);
        // Tax base after discount
        var discount_type = $('#discount-value option:selected').val();
        var discount_value = $('.text-discount').val();
        if (pattern_sums.test(discount_value)) {
            $('.text-discount').css("border-color", border_color_fields);
            if (discount_type == '%') {
                var tax_base = math.subtract(items_total, math.multiply(items_total, math.divide(discount_value, 100))).toFixed(createDocument.rountTo);
            } else {
                var tax_base = math.subtract(items_total, discount_value).toFixed(createDocument.rountTo);
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
                var vat_sum = math.multiply(math.divide(tax_base, 100), vat_percent).toFixed(createDocument.rountTo);
                $('#vat-sum').text(vat_sum);
                $('.vat-sum').val(vat_sum);
                final_sum = math.add(tax_base, vat_sum).toFixed(createDocument.rountTo);
            } else {
                $('.vat-field').css("border-color", border_color_wrong);
            }
        }
        // Set final sum
        $('#final-total').text(final_sum);
        $('.final-total').val(final_sum);
    }
}
/*
 * Verify that filed for round totals is not empty
 */
function updateRoundTotals() {
    var pattern = /^[0-9]+$/;
    var valid = true;
    var name = $('.optRoundTo').val();
    name = $.trim(name);
    if (name.length == 0 || !pattern.test(name)) {
        $('[name="opt_invRoundTo"]').css("border-color", border_color_wrong);
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
/*
 * When click client from list
 * parse object and fill fields
 */
function getClient(id) {
    $('[name="client_from_list"]').val(1);
    $('[name="client_name"]').val(clients[id].client_name);
    $('[name="client_bulstat"]').val(clients[id].client_bulstat);
    if (clients[id].is_to_person == '1') {
        $('[name="is_to_person"]').prop("checked", true);
        $('.client-company').hide();
        $('.client-individial').show();
    } else {
        $('[name="is_to_person"]').prop("checked", false);
        $('.client-company').show();
        $('.client-individial').hide();
    }
    if (clients[id].client_vat_registered == '1') {
        $('[name="client_vat_registered"]').prop("checked", true);
        $('.client-vat-registered').show();
    } else {
        $('.client-vat-registered').hide();
    }
    $('[name="client_city"]').val(clients[id].client_city);
    $('[name="client_country"]').val(clients[id].client_country);
    $('[name="accountable_person"]').val(clients[id].accountable_person);
    $('[name="client_address"]').val(clients[id].client_address);
    $('[name="recipient_name"]').val(clients[id].recipient_name);
    $('[name="client_ident_num"]').val(clients[id].client_ident_num);
    $('[name="vat_number"]').val(clients[id].vat_number);
    $('#modalSelector').modal('hide');
}
/*
 * When click item from list
 * parse object and fill fields
 */
function getItem(id) {
    $('[name="item_from_list[]"]:eq(' + chooseItemIndex + ')').val(items[id].id);
    $('[name="items_names[]"]:eq(' + chooseItemIndex + ')').val(items[id].name);
    $('[name="items_prices[]"]:eq(' + chooseItemIndex + ')').val(items[id].single_price);
    if ($('[name="items_quantity_types[]"]:eq(' + chooseItemIndex + ') option[value="' + items[id].quantity_type + '"]').length <= 0) {
        $('[name="items_quantity_types[]"]:eq(' + chooseItemIndex + ')').prepend('<option value="' + items[id].quantity_type + '">' + items[id].quantity_type + '</option>');
    }
    $('[name="items_quantity_types[]"]:eq(' + chooseItemIndex + ')').val(items[id].quantity_type);
    var selectedCurrency = $('#selectCurrencyNewInv').val();
    // typeof checking is because in some fileds we do not use currency
    if (typeof selectedCurrency !== "undefined" && selectedCurrency != items[id].currency) {
        showError(lang.currencyItemNotSame + ' - ' + items[id].currency);
    }
    $('#modalSelector').modal('hide');
    createInvoiceCalculator();
}
/*
 * Vat field visibility check
 */
function vatRegisteredFieldVisibility() {
    if ($('#client-vat-registered').is(":checked")) {
        $('.client-vat-registered').show();
    } else {
        $('.client-vat-registered').hide();
    }
}
/*
 * When create/update client
 * Validate him
 */
function newClientValidate() {
    var valid = true;
    $('[name="client_name"]').css("border-color", border_color_fields);
    $('[name="client_address"]').css("border-color", border_color_fields);
    var client_name = $('[name="client_name"]').val();
    var client_address = $('[name="client_address"]').val();
    if ($.trim(client_name).length == 0) {
        $('[name="client_name"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if ($.trim(client_address).length == 0) {
        $('[name="client_address"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('setNewClient').submit();
    } else {
        $('html, body').animate({
            scrollTop: $("#setNewClient").offset().top
        }, 1000);
        showError(lang.errorCreateClient);
    }
}
/*
 * When create/update item
 * Validate him
 */
function newItemValidate() {
    var valid = true;
    $('[name="name"]').css("border-color", border_color_fields);
    var item_name = $('[name="name"]').val();
    if ($.trim(item_name).length == 0) {
        $('[name="name"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('setNewItem').submit();
    } else {
        showError(lang.errorCreateItem);
    }
}
/*
 * When create/update employee
 * Validate him
 */
function newEmployeeValidate() {
    var valid = true;
    $('[name="email"]').css("border-color", border_color_fields);
    $('[name="password"]').css("border-color", border_color_fields);
    var emp_email = $('[name="email"]').val();
    if ($.trim(emp_email).length == 0) {
        $('[name="email"]').css("border-color", border_color_wrong);
        valid = false;
    } else {
        if (!pattern_email.test(emp_email)) {
            $('[name="email"]').css("border-color", border_color_wrong);
            valid = false;
        }
    }
    if (opt.passReq == 1) {
        var emp_pass = $('[name="password"]').val();
        if ($.trim(emp_pass).length == 0) {
            $('[name="password"]').css("border-color", border_color_wrong);
            valid = false;
        }
    }
    if (valid == true) {
        document.getElementById('setNewEmployee').submit();
    } else {
        showError(lang.errorCreateEmployee);
    }
}
/*
 * Validation add warranty conditions
 */
function addNewWarrantyCondition() {
    var valid = true;
    var condition = $('[name="condition"]').val();
    condition = $.trim(condition);
    var condition_title = $('[name="conditionTitle"]').val();
    condition_title = $.trim(condition_title);
    if (condition_title.length == 0) {
        $('[name="conditionTitle"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (condition.length == 0) {
        $('[name="condition"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formAddWarrantyCondition').submit();
    }
}
/*
 * Open preview warranty descriptions
 */
function openConditionDescription(id) {
    var description_text = $('[data-descr-id="' + id + '"]').text();
    $('#modalDescriptionExplain .modal-body').empty().append(description_text);
}
/*
 * Create protocol validator
 */
function createNewProtocolValidate() {
    var valid = true;
    var validItems = true;
    $('[name="client_name"]').css("border-color", border_color_fields);

    var client_name = $('[name="client_name"]').val();
    if ($.trim(client_name).length == 0) {
        $('[name="client_name"]').css("border-color", border_color_wrong);
        valid = false;
    }
    validItems = validateItems();
    if (validItems == false) {
        valid = false;
    }
    if (valid == false) {
        $('html, body').animate({
            scrollTop: $("#setProtocol").offset().top
        }, 1000);
        showError(lang.errorCreateDocument);
    }
    if (valid == true) {
        document.getElementById('setProtocol').submit();
    }
}
/*
 * Validation add provider transmit
 */
function addNewProviderTransmitText() {
    var valid = true;
    var description = $('[name="description"]').val();
    description = $.trim(description);
    var title = $('[name="title"]').val();
    title = $.trim(title);
    if (title.length == 0) {
        $('[name="title"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (description.length == 0) {
        $('[name="description"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formAddProviderTransmitText').submit();
    }
}
/*
 * Open provider transmit description
 */
function openProviderTransmitDescription(id) {
    var description_text = $('[data-descr-id="' + id + '"]').text();
    $('#modalDescriptionExplain .modal-body').empty().append(description_text);
}
/*
 * Open contract description
 */
function openContractDescription(id) {
    var description_text = $('[data-contr-id="' + id + '"]').text();
    $('#modalDescriptionExplain .modal-body').empty().append(description_text);
}
/*
 * Validation contract texts add
 */
function addNewContractText() {
    var valid = true;
    var description = $('[name="contract"]').val();
    description = $.trim(description);
    var title = $('[name="title_contract"]').val();
    title = $.trim(title);
    if (title.length == 0) {
        $('[name="title_contract"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (description.length == 0) {
        $('[name="contract"]').css("border-color", border_color_wrong);
        valid = false;
    }
    if (valid == true) {
        document.getElementById('formContractText').submit();
    }
}
/*
 * Remove firm logo when edit firm
 */
function removeFirmLogo() {
    $('[name="old_image"]').val('');
    $('.firm-image-container').remove();
    $('.remove-firm-logo-btn').remove();
}
/*
 * Validate and submit form for
 * custom plan request
 */
function makePlanRequest() {
    var submit = true;
    $('[name="inv_per_month"]').css("border-color", border_color_fields);
    $('[name="want_companies"]').css("border-color", border_color_fields);
    var inv_per_month = parseInt($('[name="inv_per_month"]').val());
    var want_companies = parseInt($('[name="want_companies"]').val());
    if (inv_per_month == 0 || isNaN(inv_per_month)) {
        $('[name="inv_per_month"]').css("border-color", border_color_wrong);
        submit = false;
    }
    if (want_companies == 0 || isNaN(want_companies)) {
        $('[name="want_companies"]').css("border-color", border_color_wrong);
        submit = false;
    }
    if (submit == true) {
        document.getElementById("formMakePlanReq").submit();
    }
}
/*
 * Make direct bank payments to paypal
 */
function makeBankPayment() {
    $.ajax({
        type: "POST",
        url: "http://in.dev/bankpayment",
        data: {posta:'aa'}
    }).done(function (data) {
      
    }).fail(function (err) {
       
    }).always(function () { 
    });
}
