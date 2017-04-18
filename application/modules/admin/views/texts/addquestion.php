<div class="right_col" role="main"> 
    <div class="page-title">
        <div class="title_left">
            <h3>Add Question</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel"> 
                <div class="x_content">
                    <form method="POST" action="">
                        <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : 0 ?>">
                        <?php foreach ($languages->result() as $language) { ?>
                            <input type="hidden" name="abbr[]" value="<?= $language->abbr ?>">
                        <?php } foreach ($languages->result() as $language) { ?> 
                            <div class="form-group">
                                <label>Question (<?= ucfirst($language->name) ?><img src="<?= base_url('attachments/langflags/' . $language->flag) ?>" class="flag" alt="">)</label>
                                <input type="text" name="question[]" placeholder="" value="<?= isset($_POST['translations']) ? $_POST['translations'][$language->abbr]['question'] : '' ?>" class="form-control">
                            </div>
                        <?php } foreach ($languages->result() as $language) { ?> 
                            <div class="form-group">
                                <label>Answer (<?= ucfirst($language->name) ?><img src="<?= base_url('attachments/langflags/' . $language->flag) ?>" class="flag" alt="">)</label>
                                <textarea name="answer[]" class="form-control"><?= isset($_POST['translations']) ? $_POST['translations'][$language->abbr]['answer'] : '' ?></textarea>
                            </div>
                        <?php } ?> 
                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" name="position" placeholder="0" value="<?= isset($_POST['position']) ? $_POST['position'] : '' ?>" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save">
                        <?php if (isset($_GET['edit'])) { ?>
                            <a class="btn btn-default" href="<?= base_url('admin/questions') ?>">Cancel</a>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>