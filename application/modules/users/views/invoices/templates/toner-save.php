<div class="invoice-toner-save">
    <div class="row-my-firm">
        <?php
        if ($invoice['firm']['image'] != null && $firmInfo['show_logo'] == 1) {
            ?>
            <div class="firm-logo">
                <img src="<?= base_url('attachments/companiesimages/' . $firmInfo['id'] . '/' . $invoice['firm']['image']) ?>" alt="">
            </div>
        <?php } ?>
        <div class="my-firm-info">
            <p class="firm-name"><?= $invoice['firm']['name'] ?></p>
            <p><?= $invoice['translation']['bulstat'] ?> <?= $invoice['firm']['bulstat'] ?></p>
            <?php if ($invoice['firm']['is_vat_registered'] == 1) { ?>
                <p><?= $invoice['translation']['vat_number'] ?> <?= $invoice['firm']['vat_number'] ?></p>
            <?php } ?>
            <p><?= $invoice['firm']['address'] ?></p>
            <p><?= $invoice['firm']['city'] ?></p>
            <p><?= $invoice['translation']['mol'] ?> <?= $invoice['firm']['accountable_person'] ?></p>
        </div>
        <div class="clearfix"></div>
    </div> 
    <div class="row-invoice-info">
        <?php
        $to_inv = false;
        if ($invoice['inv_type'] == 'tax_inv') {
            $inv_type = $invoice['translation']['invoice'];
        }
        if ($invoice['inv_type'] == 'prof') {
            $inv_type = $invoice['translation']['pro_forma'];
        }
        if ($invoice['inv_type'] == 'debit') {
            $to_inv = true;
            $inv_type = $invoice['translation']['debit_note'];
        }
        if ($invoice['inv_type'] == 'credit') {
            $to_inv = true;
            $inv_type = $invoice['translation']['credit_note'];
        }
        ?>
        <span class="invoice-type"><?= $inv_type ?></span>
        <div class="info">
            <table>
                <?php if ($to_inv === true) { ?>
                    <tr>
                        <td class="head-td">
                            <?= $invoice['translation']['to_an_invoice'] ?>
                        </td>
                        <td>
                            <?= $invoice['to_inv_number'] ?>
                        </td>
                    </tr> 
                    <tr>
                        <td class="head-td">
                            <?= $invoice['translation']['from_date'] ?>
                        </td>
                        <td>
                            <?= date('d.m.Y', $invoice['to_inv_date']) ?>
                        </td>
                    </tr>

                <?php } ?>
                <tr>
                    <td class="head-td">
                        <?= $invoice['translation']['number'] ?>
                    </td>
                    <td>
                        <?= $invoice['inv_number'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="head-td">
                        <?= $invoice['translation']['date_of_issue'] ?>
                    </td>
                    <td>
                        <?= date('d.m.Y', $invoice['date_create']) ?>
                    </td>
                </tr>
                <tr>
                    <td class="head-td">
                        <?= $invoice['translation']['a_date_of_a_tax_event'] ?>
                    </td>
                    <td>
                        <?= date('d.m.Y', $invoice['date_tax_event']) ?>
                    </td>
                </tr>
                <tr>
                    <td class="head-td">
                        <?= $invoice['translation']['amount'] ?>
                    </td>
                    <td>
                        <?= $invoice['final_total'] . ' ' . $invoice['inv_currency'] ?>
                    </td>
                </tr>
            </table>
            <div class="client-info">
                <p><?= $invoice['client']['client_name'] ?></p>
                <?php if ($invoice['client']['is_to_person'] == 0) { ?>
                    <p><?= $invoice['translation']['bulstat'] ?> <?= $invoice['client']['client_bulstat'] ?></p>
                <?php } else { ?>
                    <?= $invoice['client']['client_ident_num'] ?>
                <?php } if ($invoice['client']['client_vat_registered'] == 1) { ?>
                    <p><?= $invoice['client']['vat_number'] ?></p>
                <?php } ?>
                <p><?= $invoice['client']['client_address'] ?></p>
                <p><?= $invoice['client']['client_city'] ?></p>
                <p><?= $invoice['client']['client_country'] ?></p>
                <?php if ($invoice['client']['is_to_person'] == 0) { ?>
                    <p><?= $invoice['translation']['mol'] ?> <?= $invoice['client']['accountable_person'] ?></p> 
                <?php } ?>
            </div>
            <div class="origin">
                <?= lang($origin . '_txt') ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <table class="table items-table">
        <thead>
            <tr>
                <th><?= $invoice['translation']['products_name'] ?></th>
                <th><?= $invoice['translation']['quantity'] ?></th>
                <th class="text-right"><?= $invoice['translation']['single_price'] ?></th>
                <th class="text-right"><?= $invoice['translation']['value'] ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoice['items'] as $item) { ?>
                <tr>
                    <td class="item-name"><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] . ' ' . $item['quantity_type'] ?></td>
                    <td class="text-right"><?= $item['single_price'] . ' ' . $invoice['inv_currency'] ?></td>
                    <td class="text-right"><?= $item['total_price'] . ' ' . $invoice['inv_currency'] ?></td>
                </tr> 
            <?php } ?>
        </tbody>
    </table>
    <div class="invoice-payments">
        <div class="invoice-totals">
            <table>
                <tr>
                    <td class="info">
                        <?= $invoice['translation']['amount'] ?>
                    </td>
                    <td>
                        <?= $invoice['invoice_amount'] . ' ' . $invoice['inv_currency'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="info">
                        <?= $invoice['translation']['discount'] ?> 
                    </td>
                    <td>
                        <?= $invoice['discount'] . ' ' . $invoice['discount_type'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="info">
                        <?= $invoice['translation']['tax_base'] ?>  
                    </td>
                    <td>
                        <?= $invoice['tax_base'] . ' ' . $invoice['inv_currency'] ?>
                    </td>
                </tr>
                <?php if ($invoice['no_vat'] == 1) { ?>
                    <tr>
                        <td class="info">
                            <?= $invoice['translation']['vat_charget'] ?> 
                        </td>
                        <td>
                            <?= $invoice['no_vat_reason'] ?>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td class="info">
                            <?= $invoice['translation']['percentage_vat'] ?>  -  <?= $invoice['vat_percent'] ?>%
                        </td>
                        <td>
                            <?= $invoice['vat_sum'] . ' ' . $invoice['inv_currency'] ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr class="final-total">
                    <td class="info">
                        <?= $invoice['translation']['everything'] ?>  
                    </td>
                    <td class="total-price">
                        <?= $invoice['final_total'] . ' ' . $invoice['inv_currency'] ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="invoice-payment">
            <p><?= $invoice['translation']['payment_type'] ?>:</p>
            <p><?= $invoice['payment_method'] ?></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="recipient">
        <p class="rec"><?= $invoice['translation']['recipient'] ?>: 
            <?php if ($invoice['client']['is_to_person'] == 0) { ?>
                <?= $invoice['client']['recipient_name'] ?>
            <?php } else { ?>
                <?= $invoice['client']['client_name'] ?>
            <?php } ?>
        </p>
        <p class="comp"><?= $invoice['translation']['compiled'] ?>: <?= $invoice['composed'] ?></p>
        <div class="clearfix"></div>
    </div>
    <div class="signature">
        <p class="sign"><?= $invoice['translation']['signature'] ?>: ..................</p>
        <p class="cipher"><?= $invoice['translation']['schiffer'] ?>: <?= $invoice['schiffer'] ?></p>
        <div class="clearfix"></div>
    </div>
    <div class="remarks">
        <p><?= $invoice['translation']['remarks'] ?>:</p>
        <p><?= $invoice['remarks'] ?></p>
    </div>
</div>