<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('warranty') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/settings') ?>"><?= lang('settings') ?></a></li> 
            <li class="active"><?= lang('warranty') ?></li>
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
                        <th colspan="2"><?= lang('warranty_conditions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($myConditions)) {
                        foreach ($myConditions as $myCondition) {
                            ?>
                            <tr>
                                <td><?= $myCondition['condition_title'] ?></td>
                                <td>
                                    <a href="javacsript:void(0);" onclick="openConditionDescription(<?= $myCondition['id'] ?>)" data-toggle="modal" data-target="#modalDescriptionExplain" class="btn btn-default"><?= lang('war_condit_preview_descr') ?></a>
                                    <div class="hidden" data-descr-id="<?= $myCondition['id'] ?>">
                                        <?= $myCondition['condition_description'] ?>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a href="<?= base_url('user/settings/warranty/delete/condition/' . $myCondition['id']) ?>" class="confirm btn btn-xs btn-default" data-my-message="<?= lang('confirm_delete_condition') ?>">
                                        <?= lang('delete') ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3"><?= lang('no_conditions_added') ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3">
                            <form method="POST" action="" class="site-form" id="formAddWarrantyCondition">
                                <div class="form-group">
                                    <input type="text" name="conditionTitle" placeholder="<?= lang('condition_title') ?>" class="form-control field">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="condition" placeholder="<?= lang('condition_description') ?>" rows="5"></textarea>
                                </div>
                                <a href="javascript:void(0);" onclick="addNewWarrantyCondition()" class="btn btn-xs btn-default pull-right">
                                    <?= lang('add_new_condition') ?>
                                </a> 
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Conditions Description Explain -->
<div class="modal fade" id="modalDescriptionExplain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('war_condit_preview_descr') ?></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button> 
            </div>
        </div>
    </div>
</div>