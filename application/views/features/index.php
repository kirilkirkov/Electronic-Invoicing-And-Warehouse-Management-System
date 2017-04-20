<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/public/imgs/pm-subpages.png') ?>" alt="pm:"><?= lang('features') ?></h1>
    </div>
</div>
<div class="container" id="features">
    <div class="top-text">
        <?= $featuresText ?>
    </div>
    <hr>
    <?php
    if (!empty($features)) {
        $i = 0;
        foreach ($features as $feature) {
            if ($i == 2)
                $i = 0;
            ?>
            <div class="row">
                <div class="col-sm-6 part hidden-xs <?= $i == 0 ? 'visible-sm visible-md visible-lg' : 'hidden-sm hidden-md hidden-lg' ?>">
                    <img src="<?= base_url('attachments/features/' . $feature['image']) ?>" class="img-responsive img-thumbnail" alt="pmTicket - <?= $feature['name'] ?>">
                </div>
                <div class="col-sm-6 part description">
                    <h3><?= $feature['name'] ?></h3>
                    <p><?= $feature['description'] ?></p>
                </div>
                <div class="col-sm-6 part visible-xs <?= $i == 1 ? 'visible-sm visible-md visible-lg' : 'hidden-sm hidden-md hidden-lg' ?>">
                    <img src="<?= base_url('attachments/features/' . $feature['image']) ?>" class="img-responsive img-thumbnail" alt="pmTicket - <?= $feature['name'] ?>">
                </div>
            </div>
            <?php
            $i++;
        }
    }
    ?>
</div>