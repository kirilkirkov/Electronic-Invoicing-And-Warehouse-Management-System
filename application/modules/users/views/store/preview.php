<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <?= lang('items') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<?php
if ($movement['movement_type'] == 'in') {
    $from = $movement['client']['client_name'];
    $to = $movement['firm']['name'];
}
if ($movement['movement_type'] == 'out') {
    $from = $movement['firm']['name'];
    $to = $movement['client']['client_name'];
}
if ($movement['movement'] == 'move') {
    $from = $movem['from_store'];
    $to = $movement['to_store'];
}
if ($movement['movement_type'] == 'revision') {
    $from = $movement['f_stores']['from_store'];
    $to = $movement['f_stores']['to_store'];
}
?>
<div class="row">
    <div class="col-sm-6">
        <p><?= lang('preview_movem_num') ?> <?= $movement['movement_number'] ?><p>
        <p><?= lang('preview_movem_type') ?> <?= lang('movem_type_' . $movement['movement_type']) ?><p>
        <p><?= lang('preview_movem_currency') ?> <?= $movement['movement_currency'] ?><p>
        <p><?= lang('preview_movem_status') ?> <?= $movem['cancelled'] == 0 ? lang('movem_stat_confirmed') : lang('movem_stat_cancelled') ?><p>
        <p><?= lang('preview_movem_from') ?> <?= $from ?><p>
        <p><?= lang('preview_movem_to') ?> <?= $to ?><p>
    </div>
    <div class="col-sm-6">
        <a href="<?= lang_url('user/bill-of-lading/print/' . $movement['movement_number']) ?>"><?= lang('bill_of_lading') ?></a>
    </div>
</div>
<hr>
<?php if ($movement['movement_type'] != 'revision') { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= lang('movement_item_name') ?></th>
                <th><?= lang('movement_item_quantity') ?></th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movement['items'] as $item) { ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?= lang('movement_item_name') ?></th>
                <th><?= lang('movement_item_before_revision') ?></th> 
                <th><?= lang('movement_item_after_revision') ?></th> 
                <th><?= lang('movement_item_difference') ?></th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movement['revision'] as $item) { ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['before_revision'] ?></td>
                    <td><?= $item['after_revision'] ?></td>
                    <td><?= $item['difference'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
