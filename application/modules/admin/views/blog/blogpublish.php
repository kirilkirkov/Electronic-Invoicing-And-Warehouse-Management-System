<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/tagsinput/bootstrap-tagsinput.css') ?>">
<h1>Publish post</h1>
<hr>
<div class="row">
    <div class="col-sm-8 col-md-7"> 
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="edit" value="<?= isset($_POST['update']) ? $_POST['update'] : 0 ?>">
            <?php foreach ($languages->result() as $language) { ?>
                <input type="hidden" name="abbr[]" value="<?= $language->abbr ?>">
            <?php } foreach ($languages->result() as $language) { ?>
                <div class="form-group"> 
                    <label>Title (<?= $language->name ?><img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">)</label>
                    <input type="text" name="title[]" value="<?= isset($_POST['translations'][$language->abbr]['title']) ? $_POST['translations'][$language->abbr]['title'] : '' ?>" class="form-control">
                </div>
                <?php
            } $i = 0;
            foreach ($languages->result() as $language) {
                ?>
                <div class="form-group">
                    <label for="description<?= $i ?>">Description (<?= $language->name ?><img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">)</label>
                    <textarea name="description[]" id="description<?= $i ?>" rows="50" class="form-control"><?= isset($_POST['translations'][$language->abbr]['description']) ? $_POST['translations'][$language->abbr]['description'] : '' ?></textarea>
                    <script>
                        CKEDITOR.replace('description<?= $i ?>');
                    </script>
                </div>
                <?php
                $i++;
            }
            ?>
            <div class="form-group">
                <label>Tags:</label>
                <input type="text" data-role="tagsinput" name="tags" value="<?= isset($_POST['tags']) && $_POST['tags'] != null ? $_POST['tags'] : '' ?>" class="form-control">
            </div>

            <div class="form-group">
                <?php if (isset($_POST['image'])) { ?>
                    <input type="hidden" name="old_image" value="<?= $_POST['image'] ?>">
                    <div><img class="img-responsive" src="<?= base_url('attachments/blogimages/' . $_POST['image']) ?>"></div>
                    <label for="input_file">Choose another image:</label>
                <?php } else { ?>
                    <label for="input_file">Upload image:</label>
                <?php } ?>
                <input type="file" id="input_file" name="input_file">
            </div>
            <button type="submit" class="btn btn-default">Publish</button>
            <?php if ($id > 0) { ?>
                <a href="<?= base_url('admin/blog') ?>" class="btn btn-info">Cancel</a>
            <?php } ?>
        </form>
    </div>
</div>
<script src="<?= base_url('assets/tagsinput/bootstrap-tagsinput.js') ?>"></script>