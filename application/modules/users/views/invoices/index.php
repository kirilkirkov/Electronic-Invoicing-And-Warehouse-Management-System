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
        </div>
        <div id="payment-statuses">
            <a href="javascript:void(0);" data-new-pay-status="paid" class="change-pay-status"><?= lang('payment_status_paid') ?></a>
            <a href="javascript:void(0);" data-new-pay-status="unpaid" class="change-pay-status"><?= lang('payment_status_unpaid') ?></a>
        </div>
    </form>
    <?= $linksPagination ?>
<?php } else { ?>
    <h1 class="no-invoices"><?= lang('no_invoices_yet') ?></h1>
<?php } ?>