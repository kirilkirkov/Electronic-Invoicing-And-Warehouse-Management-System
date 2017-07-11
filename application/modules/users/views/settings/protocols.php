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
    <h4><?= lang('my_added_provider_transmits') ?></h4>
    <table class="table table-bordered">
        <thead>
            <tr> 
                <th colspan="2"><?= lang('my_added_provider_transmits') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($providerTransmits)) {
                foreach ($providerTransmits as $providerTransmit) {
                    ?>
                    <tr>
                        <td><?= $providerTransmit['title'] ?></td>
                        <td>
                            <a href="javacsript:void(0);" onclick="openProviderTransmitDescription(<?= $providerTransmit['id'] ?>)" data-toggle="modal" data-target="#modalDescriptionExplain" class="btn btn-default"><?= lang('war_condit_preview_descr') ?></a>
                            <div class="hidden" data-descr-id="<?= $providerTransmit['id'] ?>">
                                <?= $providerTransmit['description'] ?>
                            </div>
                        </td>
                        <td>
                            <a href="<?= base_url('user/settings/protocols/delete/provider-transmit/' . $providerTransmit['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_provider_trasmit') ?>">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3"><?= lang('no_provider_trans_txts_added') ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <form method="POST" action="" class="site-form" id="formAddProviderTransmitText">
                        <div class="form-group">
                            <input type="text" name="title" placeholder="<?= lang('provider_trans_title') ?>" class="form-control field">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description" placeholder="<?= lang('provider_trans_description') ?>" rows="5"></textarea>
                        </div>
                        <a href="javascript:void(0);" onclick="addNewProviderTransmitText()" class="btn btn-xs btn-default pull-right">
                            <?= lang('add_new_provider_desc') ?>
                        </a> 
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-sm-4">
    <h4><?= lang('my_added_provider_transmits') ?></h4>
    <table class="table table-bordered">
        <thead>
            <tr> 
                <th colspan="2"><?= lang('my_added_provider_transmits') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($contracts)) {
                foreach ($contracts as $contract) {
                    ?>
                    <tr>
                        <td><?= $contract['title'] ?></td>
                        <td>
                            <a href="javacsript:void(0);" onclick="openContractDescription(<?= $contract['id'] ?>)" data-toggle="modal" data-target="#modalDescriptionExplain" class="btn btn-default"><?= lang('war_condit_preview_descr') ?></a>
                            <div class="hidden" data-contr-id="<?= $contract['id'] ?>">
                                <?= $contract['contract'] ?>
                            </div>
                        </td>
                        <td>
                            <a href="<?= base_url('user/settings/protocols/delete/contract/' . $contract['id']) ?>" class="confirm" data-my-message="<?= lang('confirm_delete_provider_trasmit') ?>">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3"><?= lang('no_contr_txts_added') ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <form method="POST" action="" class="site-form" id="formContractText">
                        <div class="form-group">
                            <input type="text" name="title_contract" placeholder="<?= lang('provider_trans_title') ?>" class="form-control field">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="contract" placeholder="<?= lang('provider_trans_description') ?>" rows="5"></textarea>
                        </div>
                        <a href="javascript:void(0);" onclick="addNewContractText()" class="btn btn-xs btn-default pull-right">
                            <?= lang('add_new_provider_desc') ?>
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