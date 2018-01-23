<?php if (!empty($result['invoices'])) { ?>
    <div class="invoice-search-result">
        <?php
        foreach ($result['invoices'] as $invoice) {
            ?> 
            <a href="<?= lang_url('user/' . $inv_readable_types[$invoice['inv_type']] . '/view/' . $invoice['inv_number']) ?>">
                <?= $invoice['inv_number'] ?>
            </a> 
        <?php }
        ?>
    </div>
    <?php
}
if (!empty($result['clients'])) {
    ?>
    <div class="client-search-result">
        <?php
        foreach ($result['clients'] as $client) {
            ?>
            <a href="<?= lang_url('user/client/view/' . $client['id']) ?>">
                <?= $client['client_name'] ?>
            </a> 
        <?php }
        ?>
    </div>
    <?php
}
if (!empty($result['items'])) {
    ?>
    <div class="item-search-result">
        <?php
        foreach ($result['items'] as $item) {
            ?>
            <a href="<?= lang_url('user/item/view/' . $item['id']) ?>">
                <?= $item['name'] ?>
            </a> 
        <?php }
        ?>
    </div>
    <?php
}
?>



