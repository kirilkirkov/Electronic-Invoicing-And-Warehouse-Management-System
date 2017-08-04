<script src="<?= base_url('assets/plugins/math.min.js') ?>"></script>
<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('stocks') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li><a href="<?= lang_url('user/store') ?>"><?= lang('store') ?></a></li>  
            <li class="active"><?= lang('stocks') ?></li>
        </ol>
    </div> 
</div>
<div class="inner-page-menu">
    <a href="<?= lang_url('user/store') ?>" class="btn btn-blue"><?= lang('back_to_movements') ?></a>
</div> 
<?php if ($this->permissions->hasPerm('perm_view_store_stocks')) { ?>
    <form method="GET" action="" class="site-form">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label><?= lang('my_added_stores') ?></label>
                    <select class="selectpicker" name="store"> 
                        <option value=""></option>
                        <?php
                        foreach ($myStores as $store) {
                            ?>
                            <option <?= isset($_GET['store']) && $_GET['store'] == $store['id'] ? 'selected="selected"' : '' ?> value="<?= $store['id'] ?>"><?= $store['name'] ?></option>
                            <?php
                        }
                        ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label><?= lang('search_store_client') ?></label>
                    <input type="text" name="item" value="<?= isset($_GET['item']) ? $_GET['item'] : '' ?>" class="form-control field">
                </div>
                <input type="submit" class="btn btn-green" value="search"> 
                <a href="<?= lang_url('user/store/stocks') ?>"><?= lang('clear_search') ?></a>
            </div>
        </div>
    </form>
    <?php if (!empty($stockQuantities)) { ?>
        <table class="table table-list table-striped">
            <thead>
                <tr>
                    <th>Store</th>
                    <th>Item</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($stockQuantities as $stock) {
                    ?>
                    <tr>
                        <td><?= $stock['store_name'] ?></td>
                        <td><?= $stock['name'] ?></td>
                        <td><?= $stock['quantity'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?= $linksPagination ?>
        <?php
    } else {
        ?>
        <h1 class="no-results-found"><?= lang('no_stocks_yet') ?></h1>
        <?php
    }
} else {
    ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>
