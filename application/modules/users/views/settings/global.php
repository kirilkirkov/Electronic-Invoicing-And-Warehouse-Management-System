<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-cog" aria-hidden="true"></i>
            <?= lang('settings') ?>
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
    <div class="col-sm-4">     
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