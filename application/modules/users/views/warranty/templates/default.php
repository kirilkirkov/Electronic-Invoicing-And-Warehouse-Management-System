<div class="default-warranty">
    <div class="document-type">
        <h1><?= $warranty['translation']['warranty_card'] ?></h1>
    </div>
    <div class="info">
        <div class="client-info">
            <h1><?= $warranty['translation']['recipient'] ?></h1>
            <p><?= $warranty['client']['client_name'] ?></p>
            <p><?= $warranty['client']['accountable_person'] ?></p>
            <p><span><?= $warranty['translation']['city'] ?></span> <?= $warranty['client']['client_city'] ?></p>
            <p><span><?= $warranty['translation']['address'] ?></span> <?= $warranty['client']['client_address'] ?></p>
            <p><span><?= $warranty['translation']['bulstat'] ?></span> <?= $warranty['client']['client_bulstat'] ?></p>
        </div>
        <div class="firm-info">
            <h1><?= $warranty['translation']['sender'] ?></h1>
            <p><?= $warranty['firm']['name'] ?></p>
            <p><?= $warranty['firm']['accountable_person'] ?></p>
            <p><span><?= $warranty['translation']['city'] ?></span> <?= $warranty['firm']['city'] ?></p>
            <p><span><?= $warranty['translation']['address'] ?></span> <?= $warranty['firm']['address'] ?></p>
            <p><span><?= $warranty['translation']['bulstat'] ?></span> <?= $warranty['firm']['bulstat'] ?></p>
            <?php if ($warranty['firm']['is_vat_registered'] == 1) { ?>
                <p><b><?= $warranty['translation']['vat_number'] ?></b> <?= $warranty['firm']['vat_number'] ?></p>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="document-info">
        <div class="number">
            № <?= $warranty['warranty_number'] ?>
        </div>
        <div class="date-create">
            <?= $warranty['translation']['date_valid'] . ' ' . date('d.m.Y', $warranty['valid_from']) ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="items">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?= $warranty['translation']['product_name'] ?></th>
                    <th><?= $warranty['translation']['product_months'] ?></th>
                    <th><?= $warranty['translation']['product_valid_to'] ?></th>
                    <th><?= $warranty['translation']['product_serial_num'] ?></th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($warranty['items'] as $item) { ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['months'] ?></td>
                        <td><?= date('d.m.Y', $item['valid_to']) ?></td>
                        <td><?= $item['serial'] ?></td> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="conditions">
        <?= $warranty['translation']['warranty_conditions'] ?>  
        <div>
            <?= $warranty['conditions'] ?>  
        </div>
    </div>
    <div class="transmission">
        <div class="received">
            <p><?= $warranty['translation']['received'] ?> <?= $warranty['received'] ?></p> 
            <div>
                <?= $warranty['translation']['signature'] ?>................
            </div>
        </div>
        <div class="compiled">
            <p><?= $warranty['translation']['compiled'] ?> <?= $warranty['compiled'] ?></p> 
            <div>
                <?= $warranty['translation']['signature'] ?>................
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php if (trim($warranty['remarks']) != '') { ?>
        <hr>
        <p><b><?= $warranty['translation']['remarks'] ?></b></p>
        <?= $warranty['remarks'] ?>
    <?php } ?>
</div>