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
<?php if ($this->permissions->hasPerm('perm_view_protocols_page')) { ?>
    <a href="<?= lang_url('user/settings/protocols') ?>" class="btn btn-default"><?= lang('protocols_settings') ?></a>
    <a href="<?= lang_url('user/protocols/add-protocol') ?>" class="btn btn-default"><?= lang('add_protocol') ?></a>

    <button data-toggle="collapse" data-target="#protocols-search">Collapsible</button>
    <div id="protocols-search" class="collapse">    
        <form method="GET" action=""> 
            <div class="row">
                <div class="col-sm-4"> 
                    <div class="form-group">
                        <label><?= lang('search_store_client') ?></label>
                        <input type="text" name="client_name" value="<?= isset($_GET['client_name']) ? $_GET['client_name'] : '' ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><?= lang('search_date_from') ?></label>
                        <input type="text" name="create_from" value="<?= isset($_GET['create_from']) ? $_GET['create_from'] : '' ?>" class="form-control datepicker">
                        <label><?= lang('search_to') ?></label>
                        <input type="text" name="create_to" value="<?= isset($_GET['create_to']) ? $_GET['create_to'] : '' ?>" class="form-control datepicker">
                    </div> 
                </div>
            </div>
            <input type="submit" value="search"> 
            <a href="<?= lang_url('user/protocols') ?>"><?= lang('clear_search') ?></a>
        </form>
    </div>
    <?php if (!empty($protocols)) { ?>
        <form method="POST" action="" id="action-form">
            <input type="hidden" name="action" value="">
            <a href="javascript:void(0);" class="btn btn-default list-action" data-action-type="delete"><?= lang('delete_protocols') ?></a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="check-all-boxes"></th> 
                            <th><?= lang('protocol_number') ?></th> 
                            <th><?= lang('protocol_to_inv') ?></th> 
                            <th><?= lang('protocol_from_date') ?></th> 
                            <th><?= lang('protocol_client') ?></th> 
                            <th><?= lang('protocols_action') ?></th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($protocols as $protocol) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="<?= $protocol['id'] ?>" class="check-me-now"></td>
                                <td><a href="<?= lang_url('user/protocol/print/' . $protocol['protocol_number']) ?>"><?= $protocol['protocol_number'] ?></a></td>
                                <td><?= $protocol['to_invoice'] ?></td>
                                <td><?= date('d.m.Y', $protocol['from_date']) ?></td>
                                <td><?= $protocol['client'] ?></td>
                                <td><a href="<?= lang_url('user/protocol/edit/' . $protocol['protocol_number']) ?>">edit</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> 
        </form>
        <?= $linksPagination ?>
    <?php } else { ?>
        <h1 class="no-results-found"><?= lang('no_protocols_yet') ?></h1>
    <?php } ?>
<?php } else { ?>
    <h1 class="no-permissions"><?= lang('no_permissions') ?></h1>
<?php } ?>