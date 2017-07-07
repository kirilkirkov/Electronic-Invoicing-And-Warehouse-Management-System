<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <?= lang('invoices') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<a href="<?= lang_url('user/new/invoice') ?>" class="btn btn-default"><?= lang('create_new_inv') ?></a>
<button data-toggle="collapse" data-target="#invoices-search">Collapsible</button>
<div id="invoices-search" class="collapse in">    
    <form method="GET" action=""> 
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?= lang('search_inv_num') ?></label>
                    <input type="text" name="inv_number" value="<?= isset($_GET['inv_number']) ? $_GET['inv_number'] : '' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label><?= lang('search_client') ?></label>
                    <input type="text" name="inv_client" value="<?= isset($_GET['inv_client']) ? $_GET['inv_client'] : '' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label><?= lang('search_item') ?></label>
                    <input type="text" name="inv_item" value="<?= isset($_GET['inv_item']) ? $_GET['inv_item'] : '' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label><?= lang('search_amount_from') ?></label>
                    <input type="text" name="amount_from" value="<?= isset($_GET['amount_from']) ? $_GET['amount_from'] : '' ?>" class="form-control">
                    <label><?= lang('search_to') ?></label>
                    <input type="text" name="amount_to" value="<?= isset($_GET['amount_to']) ? $_GET['amount_to'] : '' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label><?= lang('search_date_from') ?></label>
                    <input type="text" name="create_from" value="<?= isset($_GET['create_from']) ? $_GET['create_from'] : '' ?>" class="form-control datepicker">
                    <label><?= lang('search_to') ?></label>
                    <input type="text" name="create_to" value="<?= isset($_GET['create_to']) ? $_GET['create_to'] : '' ?>" class="form-control datepicker">
                </div> 
                <div class="form-group">
                    <label><?= lang('search_payment_type') ?></label>
                    <select class="selectpicker" name="inv_payment_type">
                        <option value=""></option>
                        <?php foreach ($paymentMethods as $paymentMethod) { ?>
                            <option value="<?= $paymentMethod['name'] ?>"><?= $paymentMethod['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div>
                    <label><?= lang('search_inv_type') ?></label> 
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_type[]" <?= isset($_GET['inv_type']) && in_array('tax_inv', $_GET['inv_type']) ? 'checked="checked"' : '' ?> value="tax_inv"><?= lang('type_tax_inv') ?></label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_type[]" <?= isset($_GET['inv_type']) && in_array('prof', $_GET['inv_type']) ? 'checked="checked"' : '' ?> value="prof"><?= lang('type_prof') ?></label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_type[]" <?= isset($_GET['inv_type']) && in_array('debit', $_GET['inv_type']) ? 'checked="checked"' : '' ?> value="debit"><?= lang('type_debit') ?></label>
                    </div> 
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_type[]" <?= isset($_GET['inv_type']) && in_array('credit', $_GET['inv_type']) ? 'checked="checked"' : '' ?> value="credit"><?= lang('type_credit') ?></label>
                    </div>
                </div>
                <div>
                    <label><?= lang('search_inv_payments') ?></label>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_payment[]" <?= isset($_GET['inv_payment']) && in_array('paid', $_GET['inv_payment']) ? 'checked="checked"' : '' ?> value="paid"><?= lang('search_paied') ?></label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_payment[]" <?= isset($_GET['inv_payment']) && in_array('unpaid', $_GET['inv_payment']) ? 'checked="checked"' : '' ?> value="unpaid"><?= lang('search_unpaied') ?></label>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div>
                    <label><?= lang('search_inv_status') ?></label>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_status[]" <?= isset($_GET['inv_status']) && in_array('issued', $_GET['inv_status']) ? 'checked="checked"' : '' ?> value="issued"><?= lang('search_issued') ?></label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_status[]" <?= isset($_GET['inv_status']) && in_array('sended', $_GET['inv_status']) ? 'checked="checked"' : '' ?> value="sended"><?= lang('search_sended') ?></label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_status[]" <?= isset($_GET['inv_status']) && in_array('refused', $_GET['inv_status']) ? 'checked="checked"' : '' ?> value="refused"><?= lang('search_refused') ?></label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_status[]" <?= isset($_GET['inv_status']) && in_array('accepted', $_GET['inv_status']) ? 'checked="checked"' : '' ?> value="accepted"><?= lang('search_accepted') ?></label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_status[]" <?= isset($_GET['inv_status']) && in_array('canceled', $_GET['inv_status']) ? 'checked="checked"' : '' ?> value="canceled"><?= lang('search_canceled') ?></label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="inv_status[]" <?= isset($_GET['inv_status']) && in_array('draft', $_GET['inv_status']) ? 'checked="checked"' : '' ?> value="draft"><?= lang('search_draft') ?></label>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" value="search">
        <a href="<?= lang_url('user/invoices') ?>"><?= lang('clear_search') ?></a>
    </form>
</div>
<?php if (!empty($invoices)) { ?>
    <form method="POST" action="" id="action-form">
        <input type="hidden" name="action" value="">
        <a href="javascript:void(0);" class="btn btn-default list-action" data-action-type="delete"><?= lang('delete') ?></a>
        <a href="javascript:void(0);" class="btn btn-default list-action" data-action-type="stat_canceled"><?= lang('to_canceled_stat') ?></a>
        <a href="javascript:void(0);" class="btn btn-default list-action" data-action-type="remove_canceled"><?= lang('remove_canceled_stat') ?></a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="check-all-boxes"></th>
                        <th><?= lang('list_inv_num') ?></th>
                        <th><?= lang('list_inv_date') ?></th>
                        <th><?= lang('list_inv_client') ?></th>
                        <th><?= lang('list_inv_type') ?></th>
                        <th><?= lang('list_inv_payment_status') ?></th>
                        <th><?= lang('list_inv_status') ?></th>
                        <th><?= lang('list_inv_sum') ?></th>  
                        <th><?= lang('list_inv_manage') ?></th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $invoice) { ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?= $invoice['id'] ?>" class="check-me-now"></td>
                            <td><a href="<?= lang_url('user/' . $inv_readable_types[$invoice['inv_type']] . '/view/' . $invoice['inv_number']) ?>"><?= $invoice['inv_number'] ?></a></td>
                            <td><?= date('d.m.Y', $invoice['date_create']) ?></td>
                            <td><?= $invoice['client_name'] ?></td>
                            <td><?= lang('type_' . $invoice['inv_type']) ?></td>
                            <td class="status-changer">
                                <span class="show-pay-statuses" data-inv-id="<?= $invoice['id'] ?>">
                                    <span class="new_pay_status_text"><?= lang('payment_status_' . $invoice['payment_status']) ?></span>
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </span>
                            </td>
                            <td><?= lang('status_' . $invoice['status']) ?></td> 
                            <td><?= $invoice['final_total'] . $invoice['inv_currency'] ?></td> 
                            <td>
                                <a href="<?= lang_url('user/' . $inv_readable_types[$invoice['inv_type']] . '/edit/' . $invoice['inv_number']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                <a href="<?= lang_url('user/invoice/delete/' . $invoice['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_invoice') ?>"><i class="fa fa-remove" aria-hidden="true"></i> Remove</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= lang('countInvoices') . $countInvoices . ' ' . lang('with_sum_of') . ' ' . round($sumAmount, $opt_invRoundTo) ?>
        </div>
        <div id="payment-statuses">
            <a href="javascript:void(0);" data-new-pay-status="paid" class="change-pay-status"><?= lang('payment_status_paid') ?></a>
            <a href="javascript:void(0);" data-new-pay-status="unpaid" class="change-pay-status"><?= lang('payment_status_unpaid') ?></a>
        </div>
    </form>
    <?= $linksPagination ?>
<?php } else { ?>
    <h1 class="no-results-found"><?= lang('no_invoices_yet') ?></h1>
<?php } ?>