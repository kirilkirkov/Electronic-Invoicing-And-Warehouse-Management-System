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
<div class="col-sm-4">
    <h4><?= lang('my_added_stores') ?></h4>
    <table class="table table-bordered">
        <thead>
            <tr> 
                <th colspan="2"><?= lang('store_name') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($myStores)) {
                foreach ($myStores as $myStore) {
                    ?>
                    <tr>
                        <td><?= $myStore['name'] ?></td>
                        <td>
                            <a href="<?= base_url('user/settings/stores/delete/store/' . $myStore['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_store') ?>">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="2"><?= lang('no_stores_added') ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="2">
                    <form method="POST" action="" class="site-form" id="formAddStore">
                        <table>
                            <tr>
                                <td><input type="text" name="newStore" class="form-control field"></td>
                                <td>
                                    <a href="javascript:void(0);" onclick="addNewStore()" class="btn btn-xs btn-default pull-right">
                                        <?= lang('add_new_store') ?>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-sm-4">
    <h4><?= lang('how_do_you_round_values_in_move') ?></h4>
    <form method="POST" action="" class="site-form" id="formRoundTotals">
        <table>
            <tr>
                <td><input type="text" value="<?= $opt_movementRoundTo ?>" name="opt_movementRoundTo" class="form-control field optRoundTo"></td>
                <td>
                    <a href="javascript:void(0);" onclick="updateRoundTotals()" class="btn btn-xs btn-default pull-right">
                        <?= lang('update_round_totals') ?>
                    </a>
                </td>
            </tr>
        </table>
    </form>
</div>    
<div class="col-sm-4">     
    <h4><?= lang('stop_inv_calculator') ?></h4>
    <form method="POST" action="">
        <div class="input-group">
            <input class="form-control field" name="opt_movementCalculator" value="<?= $opt_movementCalculator ?>" type="text">
            <span class="input-group-btn">
                <button class="btn btn-default" value="" type="submit">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
            </span>
        </div>
    </form>
</div>
<div class="col-sm-4">     
    <h4><?= lang('allow_negative_qua_in_store') ?></h4>
    <form method="POST" action="">
        <div class="input-group">
            <input class="form-control field" name="opt_negativeQuantities" value="<?= $opt_negativeQuantities ?>" type="text">
            <span class="input-group-btn">
                <button class="btn btn-default" value="" type="submit">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </button>
            </span>
        </div>
    </form>
</div>