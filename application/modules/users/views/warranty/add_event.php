<script src="<?= base_url('assets/plugins/math.min.js') ?>"></script>
<div class="selected-page">
    <div class="inner">
        <h1>
            <?= lang('add_warranty_event') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li><a href="<?= lang_url('user/warranties') ?>"><?= lang('warranties') ?></a></li>  
            <li><a href="<?= lang_url('user/warranty/events/' . $eventNumber) ?>"><?= lang('warranty_events') ?></a></li>  
            <li class="active"><?= lang('add_warranty_event') ?></li>
        </ol>
    </div>
</div>
<?php if ($this->permissions->hasPerm('perm_add_warranty_events')) { ?>
    <div class="row">
        <div class="col-sm-4">
            <form method="POST" class="site-form" action="">
                <div class="form-group">
                    <label><?= lang('war_event_item') ?></label>
                    <?php foreach ($warranty['items'] as $item) { ?>
                        <div class="radio">
                            <label><input type="radio" value="<?= $item['name'] ?>" name="item"><?= $item['name'] ?></label>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label><?= lang('date_war_event_manupulation') ?></label>
                    <input type="text" name="on_date" placeholder="dd.mm.yyyy" value="<?= date('d.m.Y', time()) ?>" class="form-control field datepicker">
                </div>
                <div class="form-group">
                    <label><?= lang('war_event_type') ?></label>
                    <select class="selectpicker" name="type"> 
                        <option value="repair" selected=""><?= lang('repair') ?></option>
                        <option value="replacement" selected=""><?= lang('replacement') ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label><?= lang('war_event_description') ?></label>
                    <textarea class="form-control" name="description" rows="5"></textarea>
                </div> 
                <button type="submit" class="btn btn-default"><?= lang('save_war_event') ?></button>
                <a href="<?= lang_url('user/warranty/events/' . $eventNumber) ?>" class="btn btn-default"><?= lang('cancel') ?></a>
            </form>
        </div>
    </div>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>
