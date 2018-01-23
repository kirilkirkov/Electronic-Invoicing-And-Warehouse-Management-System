<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('global') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li>  
            <li><a href="<?= lang_url('user/settings') ?>"><?= lang('settings') ?></a></li> 
            <li class="active"><?= lang('global') ?></li>
        </ol>
    </div>
</div>
<div class="settings-inner-page">
    <div class="row">
        <div class="col-sm-4 col-settings">     
            <h4><?= lang('pages_pagination_num') ?></h4>
            <form method="POST" action="">
                <div class="input-group">
                    <input class="form-control field" name="opt_pagination" value="<?= $opt_pagination ?>" type="text">
                    <span class="input-group-btn">
                        <button class="btn btn-default" value="" type="submit">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>