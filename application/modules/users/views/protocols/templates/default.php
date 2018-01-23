<div class="default-protocol">
    <div class="document-type">
        <h1><?= $protocol['translation']['transmission_protocol'] ?></h1>
    </div>
    <div class="info">
        <div class="client-info">
            <?php if ($protocol['type'] == 'acceptable') { ?>
                <h1><?= $protocol['translation']['supplier'] ?></h1>
                <p><?= $protocol['firm']['name'] ?></p>
                <p><?= $protocol['firm']['accountable_person'] ?></p>
                <p><span><?= $protocol['translation']['city'] ?></span> <?= $protocol['firm']['city'] ?></p>
                <p><span><?= $protocol['translation']['address'] ?></span> <?= $protocol['firm']['address'] ?></p>
                <p><span><?= $protocol['translation']['bulstat'] ?></span> <?= $protocol['firm']['bulstat'] ?></p>
                <?php if ($protocol['firm']['is_vat_registered'] == 1) { ?>
                    <p><b><?= $protocol['translation']['vat_number'] ?></b> <?= $protocol['firm']['vat_number'] ?></p>
                <?php } ?>
            <?php } else { ?>
                <h1><?= $protocol['translation']['recipient'] ?></h1>
                <p><?= $protocol['client']['client_name'] ?></p>
                <p><?= $protocol['client']['accountable_person'] ?></p>
                <p><span><?= $protocol['translation']['city'] ?></span> <?= $protocol['client']['client_city'] ?></p>
                <p><span><?= $protocol['translation']['address'] ?></span> <?= $protocol['client']['client_address'] ?></p>
                <p><span><?= $protocol['translation']['bulstat'] ?></span> <?= $protocol['client']['client_bulstat'] ?></p>
            <?php } ?> 
        </div>
        <div class="firm-info">
            <?php if ($protocol['type'] == 'transmitter') { ?>
                <h1><?= $protocol['translation']['supplier'] ?></h1>
                <p><?= $protocol['firm']['name'] ?></p>
                <p><?= $protocol['firm']['accountable_person'] ?></p>
                <p><span><?= $protocol['translation']['city'] ?></span> <?= $protocol['firm']['city'] ?></p>
                <p><span><?= $protocol['translation']['address'] ?></span> <?= $protocol['firm']['address'] ?></p>
                <p><span><?= $protocol['translation']['bulstat'] ?></span> <?= $protocol['firm']['bulstat'] ?></p>
                <?php if ($protocol['firm']['is_vat_registered'] == 1) { ?>
                    <p><b><?= $protocol['translation']['vat_number'] ?></b> <?= $protocol['firm']['vat_number'] ?></p>
                <?php } ?>
            <?php } else { ?>
                <h1><?= $protocol['translation']['recipient'] ?></h1>
                <p><?= $protocol['client']['client_name'] ?></p>
                <p><?= $protocol['client']['accountable_person'] ?></p>
                <p><span><?= $protocol['translation']['city'] ?></span> <?= $protocol['client']['client_city'] ?></p>
                <p><span><?= $protocol['translation']['address'] ?></span> <?= $protocol['client']['client_address'] ?></p>
                <p><span><?= $protocol['translation']['bulstat'] ?></span> <?= $protocol['client']['client_bulstat'] ?></p>
            <?php } ?> 
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="document-info">
        <div class="number">
            № <?= $protocol['protocol_number'] ?>
        </div>
        <div class="date-create">
            <?= $protocol['translation']['from_date'] . ' ' . date('d.m.Y', $protocol['created']) ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php if ($protocol['to_invoice'] != '') { ?>
        <div class="to-inv">
            <div class="number-inv">
                <?= $protocol['translation']['to_invoice'] ?>  № <?= $protocol['to_invoice'] ?>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php } ?>
    <div class="provider-transmit">
        <?= $protocol['provider_transmit'] ?> 
    </div>
    <div class="items">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $protocol['translation']['product_name'] ?></th>
                    <th><?= $protocol['translation']['product_quantity'] ?></th>
                    <th><?= $protocol['translation']['product_quantity_type'] ?></th>
                    <th><?= $protocol['translation']['product_single_price'] ?></th> 
                    <th class="text-right"><?= $protocol['translation']['product_final_price'] ?></th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($protocol['items'] as $item) { ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['quantity_type'] ?></td>
                        <td><?= $item['single_price'] . $protocol['currency'] ?></td> 
                        <td class="text-right"><?= $item['total_price'] . $protocol['currency'] ?></td> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="protocol-totals">
        <p><span><?= $protocol['translation']['amount'] ?></span> <?= $protocol['amount'] . $protocol['currency'] ?></p>
        <p><span><?= $protocol['translation']['vat'] ?></span> <?= $protocol['vat_percent'] ?>%</p>
        <p><span><?= $protocol['translation']['vat_amount'] ?></span> <?= $protocol['vat_sum'] . $protocol['currency'] ?></p>
        <p><span><?= $protocol['translation']['final_amount'] ?></span> <?= $protocol['final_total'] . $protocol['currency'] ?></p> 
    </div>
    <div class="clearfix"></div>
    <div class="contract">
        <?= $protocol['contract'] ?> 
    </div>
    <div class="transmission">
        <div class="received">
            <p><?= $protocol['translation']['received'] ?> <?= $protocol['received'] ?></p> 
            <div>
                <?= $protocol['translation']['signature'] ?>................
            </div>
        </div>
        <div class="compiled">
            <p><?= $protocol['translation']['compiled'] ?> <?= $protocol['compiled'] ?></p> 
            <div>
                <?= $protocol['translation']['signature'] ?>................
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php if (trim($protocol['remarks']) != '') { ?>
        <hr>
        <p><b><?= $protocol['translation']['remarks'] ?></b></p>
        <?= $protocol['remarks'] ?>
    <?php } ?>
</div>