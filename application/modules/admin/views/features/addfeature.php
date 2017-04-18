<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<h3>Add Feature</h3>
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : 0 ?>">
            <input type="hidden" name="old_image" value="<?= isset($_POST['image']) ? $_POST['image'] : '' ?>">
            <?php foreach ($languages->result() as $language) { ?>
                <input type="hidden" name="abbr[]" value="<?= $language->abbr ?>">
            <?php } foreach ($languages->result() as $language) { ?> 
                <div class="form-group">
                    <label>Title (<?= ucfirst($language->name) ?><img src="<?= base_url('attachments/langflags/' . $language->flag) ?>" class="flag" alt="">)</label>
                    <input type="text" name="title[]" placeholder="" value="<?= isset($_POST['translations']) ? $_POST['translations'][$language->abbr]['title'] : '' ?>" class="form-control">
                </div>
            <?php } ?>  
            <?php if (isset($_POST['image'])) { ?>
                <img src="<?= base_url('attachments/featuresimages/' . $_POST['image']) ?>" alt="" style="height: 100px;">
            <?php } ?>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="input_file">
            </div>
            <?php
            $i = 0;
            foreach ($languages->result() as $language) {
                ?> 
                <div class="form-group">
                    <label>Description (<?= ucfirst($language->name) ?><img src="<?= base_url('attachments/langflags/' . $language->flag) ?>" class="flag" alt="">)</label>
                    <textarea id="d_in_u<?= $i ?>" name="description[]" class="form-control"><?= isset($_POST['translations']) ? $_POST['translations'][$language->abbr]['description'] : '' ?></textarea>
                </div>
                <script>
                    CKEDITOR.replace('d_in_u<?= $i ?>');
                </script>
                <?php
                $i++;
            }
            ?>
            <input type="submit" class="btn btn-primary" value="Save">
            <?php if (isset($_GET['edit'])) { ?>
                <a class="btn btn-default" href="<?= base_url('admin/features') ?>">Cancel</a>
            <?php } ?>
        </form>
    </div>
</div> 