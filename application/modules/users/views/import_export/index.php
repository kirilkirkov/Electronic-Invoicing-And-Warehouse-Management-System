<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('import_export') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li class="active"><?= lang('import_export') ?></li>
        </ol>
    </div> 
</div>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="<?= !isset($_POST['importType']) ? 'active' : '' ?>"><a href="#export" aria-controls="home" role="tab" data-toggle="tab"><?= lang('export') ?></a></li>
    <li role="presentation" class="<?= !isset($_POST['importType']) ? '' : 'active' ?>"><a href="#import" aria-controls="profile" role="tab" data-toggle="tab"><?= lang('import') ?></a></li> 
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane <?= !isset($_POST['importType']) ? 'active' : '' ?>" id="export">
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
                    <option value="xml">XML</option>
                    <option value="excel">Excel(xls)</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-default"><?= lang('export') ?></button>
            </div>
        </form> 
    </div>
    <div role="tabpanel" class="tab-pane <?= !isset($_POST['importType']) ? '' : 'active' ?>" id="import">
        <form class="form-inline site-form" action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToImport">
            <div>
                <select class="selectpicker" name="importType">
                    <option value="uni-xml">Universal XML</option> 
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-default"><?= lang('import') ?></button>
            </div>
        </form>
        <?php
        if (!empty($resultImport)) {
            ?>
            <h1><?= lang('import_results') ?></h1>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th><?= lang('inv_num_row_in_file') ?></th>
                        <th><?= lang('inv_number') ?></th>
                        <th><?= lang('inv_type') ?></th>
                        <th><?= lang('inv_errors') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultImport as $numRow => $importRow) { ?>
                        <tr>
                            <td> 
                                <?php if (!empty($importRow['errors'])) { ?>
                                    X
                                <?php } else { ?>
                                    OK
                                <?php } ?>
                            </td>
                            <td><?= $numRow ?></td>
                            <td><?= $importRow['inv']['inv_number'] ?></td>
                            <td><?= $invReadableTypes[$importRow['inv']['inv_type']] ?></td>
                            <td>
                                <?php
                                if (!empty($importRow['errors'])) {
                                    foreach ($importRow['errors'] as $error) {
                                        ?>
                                        <p><?= $error ?></p>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                        </tr> 
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>