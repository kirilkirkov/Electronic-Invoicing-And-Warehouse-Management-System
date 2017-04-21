<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-cog" aria-hidden="true"></i>
            <?= lang('selected_manage_firms') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<div class="row">
    <div class="col-sm-8 col-md-6">
        <div class="panel-content">
            <div class="head">
                <div><?= lang('list_firms') ?></div>
            </div>
            <div>
                <div class="body">
                    <ul class="list-firms">
                        <?php foreach ($firms as $firm) { ?>
                            <li>
                                <?= $firm['name'] ?>
                                <a href="?delete=<?= $firm['id'] ?>" class="confirm" data-my-message="<?= lang('delete_firm_confirm') ?>">
                                    <i class="fa fa-remove" aria-hidden="true"></i>
                                </a>
                                <a href="?edit=<?= $firm['id'] ?>">
                                    <i class="fa fa-wrench" aria-hidden="true"></i>
                                </a>
                                <?php if ($firm['is_default'] == 1) { ?>
                                    <span class="label label-success"><?= lang('firm_default') ?></span>
                                <?php } else { ?>
                                    <a href="" class="confirm" data-my-message="<?= lang('default_firm_confirm') ?>">
                                        <span class="label label-danger"><?= lang('make_firm_default') ?></span>
                                    </a>
                                <?php } ?>
                            </li> 
                        <?php } ?>
                        <li> 
                            <a href="" class="btn btn-xs btn-default">
                                <?= lang('add_new_company') ?>
                            </a>
                            <div class="clearfix"></div>
                        </li> 
                    </ul>
                </div>
                <div class="footer"> </div>
            </div>
        </div>
    </div>
</div>