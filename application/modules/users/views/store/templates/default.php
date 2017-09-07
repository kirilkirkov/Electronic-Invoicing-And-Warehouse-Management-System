<div class="default-movement">
    <div class="document-type">
        <h1><?= $movement['translation']['bill_of_goods'] ?></h1>
    </div>
    <div class="info">
        <div class="client-info">
            <h1><?= $movement['translation']['recipient'] ?></h1>
            <p><?= $movement['client']['client_name'] ?></p>
            <p><?= $movement['client']['accountable_person'] ?></p>
            <p><span><?= $movement['translation']['city'] ?></span> <?= $movement['client']['client_city'] ?></p>
            <p><span><?= $movement['translation']['address'] ?></span> <?= $movement['client']['client_address'] ?></p>
            <p><span><?= $movement['translation']['bulstat'] ?></span> <?= $movement['client']['client_bulstat'] ?></p>
        </div>
        <div class="firm-info">
            <h1><?= $movement['translation']['sender'] ?></h1>
            <p><?= $movement['firm']['name'] ?></p>
            <p><?= $movement['firm']['accountable_person'] ?></p>
            <p><span><?= $movement['translation']['city'] ?></span> <?= $movement['firm']['city'] ?></p>
            <p><span><?= $movement['translation']['address'] ?></span> <?= $movement['firm']['address'] ?></p>
            <p><span><?= $movement['translation']['bulstat'] ?></span> <?= $movement['firm']['bulstat'] ?></p>
            <?php if ($movement['firm']['is_vat_registered'] == 1) { ?>
                <p><b><?= $movement['translation']['vat_number'] ?></b> <?= $movement['firm']['vat_number'] ?></p>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="document-info">
        <div class="number">
            № <?= $movement['movement_number'] ?>
        </div>
        <div class="date-create">
            <?= $movement['translation']['date'] . ' ' . date('d.m.Y', $movement['created']) ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="document-info">
        <div class="number">
            <?= $movement['translation']['lot'] . ' ' . $movement['lot'] ?>
        </div>
        <div class="date-create">
            <?= $movement['translation']['expire_date'] . ' ' . date('d.m.Y', $movement['expire_date']) ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="items">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $movement['translation']['product_name'] ?></th>
                    <th><?= $movement['translation']['product_quantity'] ?></th>
                    <th><?= $movement['translation']['product_quantity_type'] ?></th>
                    <th><?= $movement['translation']['single_price'] ?></th>
                    <th><?= $movement['translation']['product_amount'] ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movement['items'] as $item) { ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['quantity_type'] ?></td>
                        <td><?= $item['single_price'] ?></td>
                        <td><?= $item['total_price'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="amounts">
        <div class="payment-method">
            <p><?= $movement['translation']['payment_method'] ?></p>
            <span><?= $movement['payment_method'] ?></span>
        </div>
        <div class="amount">
            <p><?= $movement['translation']['amount'] ?><span><?= $movement['tax_base'] ?></span></p>
            <p><?= $movement['translation']['vat'] ?><span><?= $movement['vat_percent'] ?></span></p>
            <p><?= $movement['translation']['vat_amount'] ?><span><?= $movement['vat_sum'] ?></span></p>
            <p><?= $movement['translation']['final_amount'] ?><span><?= $movement['final_total'] ?></span></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="transmission">
        <div class="betrayed">
            <p><?= $movement['translation']['betrayed'] ?></p>
            <span><?= $movement['betrayed'] ?></span>
        </div>
        <div class="accepted">
            <p><?= $movement['translation']['accepted'] ?></p>
            <span><?= $movement['accepted'] ?></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php if (trim($movement['remarks']) != '') { ?>
        <hr>
        <p><b><?= $movement['translation']['remarks'] ?></b></p>
        <?= $movement['remarks'] ?>
    <?php } ?>
</div>