<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('store') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li class="active"><?= lang('store') ?></li>
        </ol>
    </div> 
</div>
<div class="inner-page-menu">
    <div class="left-nav-side">
        <a href="<?= lang_url('user/store/add-movement') ?>" class="btn btn-blue"><?= lang('add_store_movement') ?></a>
        <a href="<?= lang_url('user/store/stocks') ?>" class="btn btn-blue"><?= lang('store_stocks') ?></a>
        <button data-toggle="collapse" class="btn btn-blue" data-target="#store-search"><?= lang('search') ?></button>
        <a href="javascript:void(0);" class="btn btn-blue list-action" data-action-type="stat_canceled"><?= lang('to_canceled_stat') ?></a>
        <a href="javascript:void(0);" class="btn btn-blue list-action" data-action-type="remove_canceled"><?= lang('remove_canceled_stat') ?></a>
    </div>
    <div class="right-nav-side">
        <a href="<?= lang_url('user/settings/stores') ?>" class="btn btn-blue"><?= lang('store_settings') ?></a>
    </div>
    <div class="clearfix"></div>
</div> 
<div id="store-search" class="collapse <?= isset($_GET['selected_store']) ? 'in' : '' ?> lists-search-form">    
    <form method="GET" action="" class="site-form"> 
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?= lang('search_by_store') ?></label>
                    <select class="selectpicker" name="selected_store" data-live-search="true">
                        <option value="all"><?= lang('all_stores') ?></option>
                        <?php
                        foreach ($myStores as $myStore) {
                            ?>
                            <option <?= isset($_GET['selected_store']) && $_GET['selected_store'] == $myStore['id'] ? 'selected="selected"' : '' ?> value="<?= $myStore['id'] ?>"><?= $myStore['name'] ?></option>
                        <?php } ?>
                    </select>
                </div> 
                <div class="form-group">
                    <label><?= lang('search_store_client') ?></label>
                    <input type="text" name="client_name" value="<?= isset($_GET['client_name']) ? $_GET['client_name'] : '' ?>" class="form-control field">
                </div>
                <div class="form-group">
                    <label><?= lang('search_date_from') ?></label>
                    <input type="text" name="create_from" value="<?= isset($_GET['create_from']) ? $_GET['create_from'] : '' ?>" class="form-control field datepicker">
                    <label><?= lang('search_to') ?></label>
                    <input type="text" name="create_to" value="<?= isset($_GET['create_to']) ? $_GET['create_to'] : '' ?>" class="form-control field datepicker">
                </div> 
                <div class="form-group">
                    <label><?= lang('create_movement_lot') ?></label>
                    <input type="text" name="lot" value="<?= isset($_GET['lot']) ? $_GET['lot'] : '' ?>" class="form-control field">
                </div> 
                <div class="form-group">
                    <label><?= lang('expire_date_to') ?></label>
                    <input type="text" name="expire_date" value="<?= isset($_GET['expire_date']) ? $_GET['expire_date'] : '' ?>" class="form-control field datepicker">
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-green" value="<?= lang('search') ?>"> 
        <a href="<?= lang_url('user/store') ?>"><?= lang('clear_search') ?></a>
    </form>
</div>
<?php
if ($this->permissions->hasPerm('perm_view_movement_page')) {
    if (!empty($movements)) {
        ?>
        <form method="POST" action="" id="action-form">
            <input type="hidden" name="action" value="">
            <div class="table-responsive">
                <table class="table table-list table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="check-all-boxes"></th>
                            <th><?= lang('list_movement') ?></th>
                            <th><?= lang('list_bill_of_lading') ?></th>
                            <th><?= lang('list_movem_type') ?></th>
                            <th><?= lang('list_movem_from') ?></th>
                            <th><?= lang('list_movem_to') ?></th>
                            <th><?= lang('list_movem_status') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($movements as $movem) {
                            if ($movem['movement_type'] == 'in') {
                                $from = $movem['client_name'];
                                $to = $movem['firm_name'];
                            }
                            if ($movem['movement_type'] == 'out') {
                                $from = $movem['firm_name'];
                                $to = $movem['client_name'];
                            }
                            if ($movem['movement_type'] == 'move') {
                                $from = $movem['from_store'];
                                $to = $movem['to_store'];
                            }
                            if ($movem['movement_type'] == 'revision') {
                                $from = '';
                                $to = '';
                            }
                            ?>
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="<?= $movem['id'] ?>" class="check-me-now"></td>
                                <td><a href="<?= lang_url('user/movement/view/' . $movem['movement_number']) ?>"><?= lang('movem_preview') ?></a></td>
                                <td><a href="<?= base_url('user/store-order/print/' . $movem['movement_number']) ?>" target="_blank"><?= $movem['movement_number'] ?></a></td>
                                <td><?= lang('movem_type_' . $movem['movement_type']) ?></td>
                                <td><?= $from ?></td>
                                <td><?= $to ?></td>
                                <td><?= $movem['cancelled'] == 0 ? lang('movem_stat_confirmed') : lang('movem_stat_cancelled') ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> 
        </form>
        <?= $linksPagination ?>
    <?php } else { ?>
        <h1 class="no-results-found"><?= lang('no_movements_yet') ?></h1>
    <?php } ?>

<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>