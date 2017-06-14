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
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th><?= lang('list_inv_num') ?></th>
                    <th><?= lang('list_inv_date') ?></th>
                    <th><?= lang('list_inv_client') ?></th>
                    <th><?= lang('list_inv_type') ?></th>
                    <th><?= lang('list_inv_sum') ?></th> 
                    <th><?= lang('list_inv_status') ?></th>
                    <th><?= lang('list_inv_manage') ?></th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoices as $invoice) { ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><a href="<?= lang_url('user/' . $inv_readable_types[$invoice['inv_type']] . '/view/' . $invoice['inv_number']) ?>"><?= $invoice['inv_number'] ?></a></td>
                        <td><?= date('d.m.Y', $invoice['date_create']) ?></td>
                        <td><?= $invoice['client_name'] ?></td>
                        <td><?= lang('type_' . $invoice['inv_type']) ?></td>
                        <td><?= $invoice['final_total'] . $invoice['inv_currency'] ?></td>
                        <td><?= lang('status_' . $invoice['status']) ?></td> 
                        <td>
                            <a href="<?= lang_url('user/' . $inv_readable_types[$invoice['inv_type']] . '/edit/' . $invoice['inv_number']) ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            <a href="<?= lang_url('user/invoice/delete/' . $invoice['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_invoice') ?>"><i class="fa fa-remove" aria-hidden="true"></i> Remove</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div> 
<?php } else { ?>
    <h1 class="no-invoices"><?= lang('no_invoices_yet') ?></h1>
<?php } ?>
<?= $linksPagination ?>