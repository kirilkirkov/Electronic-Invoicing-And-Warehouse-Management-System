<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('store') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/settings') ?>"><?= lang('settings') ?></a></li> 
            <li class="active"><?= lang('store') ?></li>
        </ol>
    </div> 
</div>
<div class="settings-inner-page">
    <div class="row">
        <div class="col-sm-4 col-settings">
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
                                <td class="text-right">
                                    <a href="<?= base_url('user/settings/stores/delete/store/' . $myStore['id']) ?>" class="confirm btn btn-xs btn-default" data-my-message="<?= lang('confirm_delete_store') ?>">
                                        <?= lang('delete') ?>
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
                                            <a href="javascript:void(0);" onclick="addNewStore()" class="btn btn-default pull-right">
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
        <div class="col-sm-4 col-settings">
            <h4><?= lang('how_do_you_round_values_in_move') ?></h4>
            <form method="POST" action="" class="site-form" id="formRoundTotals">
                <table>
                    <tr>
                        <td><input type="text" value="<?= $opt_movementRoundTo ?>" name="opt_movementRoundTo" class="form-control field optRoundTo"></td>
                        <td>
                            <a href="javascript:void(0);" onclick="updateRoundTotals()" class="btn btn-default pull-right">
                                <?= lang('update_round_totals') ?>
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>    
        <div class="col-sm-4 col-settings">     
            <h4><?= lang('stop_movem_calculator') ?></h4>
            <form method="POST" action="">
                <div class="checkbox">
                    <label><input type="checkbox" name="opt_movementCalculator" <?= $opt_movementCalculator == 0 ? 'checked="checked"' : '' ?> value=""><?= lang('stop_movem_calculator') ?></label>
                </div>
                <button class="btn btn-default" name="stopMovementCalculator" value="" type="submit">
                    <?= lang('save') ?>
                </button>
            </form>
        </div>
        <div class="col-sm-4 col-settings">     
            <h4><?= lang('allow_negative_qua_in_store') ?></h4>
            <form method="POST" action="">
                <div class="checkbox">
                    <label><input type="checkbox" name="opt_negativeQuantities" <?= $opt_negativeQuantities == 0 ? 'checked="checked"' : '' ?> value=""><?= lang('allow_negative_qua_in_store') ?></label>
                </div>
                <button class="btn btn-default" name="allowNegativeQuantities" value="" type="submit">
                    <?= lang('save') ?>
                </button>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/plugins/jquery.eqheight.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function () {
    $(".settings-inner-page").eqHeight(".col-settings");
});
</script>