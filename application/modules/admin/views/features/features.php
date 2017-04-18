<div class="row">
    <div class="col-sm-6">
        <h3>Add Feature</h3>
    </div>
    <div class="col-sm-6">
        <a href="<?= base_url('admin/addfeature') ?>" class="btn btn-default pull-right">Add Feature</a>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <?php
        if (!empty($features)) {
            ?>
            <div class="row">
                <?php
                foreach ($features as $feature) {
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="event">
                            <h2><?= $feature['title'] ?></h2>
                            <img src="<?= base_url('attachments/featuresimages/' . $feature['image']) ?>" class="img-thumbnail img-responsive" style="margin-bottom: 10px;" alt="">
                            <p>
                                <?= $feature['description'] ?>
                            </p>
                            <div class="buttons">
                                <a href="<?= base_url('admin/addfeature?edit=' . $feature['id']) ?>" class="btn btn-default">Edit</a>
                                <a href="<?= base_url('admin/features?delete=' . $feature['id']) ?>" class="btn btn-danger confirm-delete">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
            <?php
        } else {
            ?>
            No features!
        <?php } ?>
    </div>
</div>