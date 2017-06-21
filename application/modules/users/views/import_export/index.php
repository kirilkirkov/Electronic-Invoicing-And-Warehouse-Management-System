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
<form class="form-inline site-form" action="" method="POST">
    <div class="form-group">
        <label for="from_date"><?= lang('from_date') ?></label>
        <input class="form-control field datepicker" value="<?= isset($_POST['from_date']) ? $_POST['from_date'] : $from_date ?>" id="from_date" name="from_date" placeholder="dd.mm.yyyy" type="text">
    </div>
    <div class="form-group">
        <label for="to_date"><?= lang('to_date') ?></label>
        <input class="form-control field datepicker" value="<?= isset($_POST['to_date']) ? $_POST['to_date'] : $to_date ?>" id="to_date" name="to_date" placeholder="dd.mm.yyyy" type="text">
    </div>
    <div class="checkbox">
        <label><input type="checkbox" name="export_all" <?= isset($_POST['export_all']) ? 'checked="checked"' : '' ?> value="true">Export All</label>
    </div>
    <div>
        <select class="selectpicker" name="exportType">
            <option <?= isset($_POST['exportType']) && $_POST['exportType'] == 'xml' ? 'selected="selected"' : '' ?> value="xml">Xml</option>
            <option <?= isset($_POST['exportType']) && $_POST['exportType'] == 'excel' ? 'selected="selected"' : '' ?>  value="excel">Excel</option>
        </select>
    </div>
    <div>
        <button type="submit" class="btn btn-default">Export</button>
    </div>
</form> 