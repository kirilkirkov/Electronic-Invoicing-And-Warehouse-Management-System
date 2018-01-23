<script src="<?= base_url('assets/plugins/math.min.js') ?>"></script>
<div class="selected-page">
    <div class="inner">
        <h1>
            <?= lang('warranty_events') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li><a href="<?= lang_url('user/warranties') ?>"><?= lang('warranties') ?></a></li>  
            <li class="active"><?= lang('warranty_events') ?></li>
        </ol>
    </div> 
</div>
<?php if ($this->permissions->hasPerm('perm_view_warranty_events')) { ?>
    <a href="<?= lang_url('user/warranty/events/' . $eventId . '/add-event') ?>" class="btn btn-default"><?= lang('add_new_war_event') ?></a>
    <?php
    if (!empty($events)) {
        foreach ($events as $event) {
            ?>
            <h2><?= lang('war_ev_type') ?> <?= $event['type'] ?></h2>
            <div><?= lang('war_ev_date') ?> <?= date('d.m.Y', $event['on_date']) ?></div>
            <div><?= lang('war_ev_item') ?> <?= $event['item'] ?></div>
            <div><?= lang('war_ev_descr') ?> <?= $event['description'] ?></div>
            <?php
        }
    } else {
        ?>
        <h1 class="no-results-found"><?= lang('no_war_events_yet') ?></h1>
        <?php
    }
    ?>

<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>
