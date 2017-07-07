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
                        <td>
                            <a href="<?= base_url('user/settings/warranty/delete/condition/' . $myCondition['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_condition') ?>">
                                <i class="fa fa-times" aria-hidden="true"></i>
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