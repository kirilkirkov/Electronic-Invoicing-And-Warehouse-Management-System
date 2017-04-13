<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/imgs/pm-subpages.png') ?>" alt="pm:">Features</h1>
    </div>
</div>
<div class="container" id="features">
    <h4>We have a great set of features that can be useful in any area. 
        pmTicket is designed to be useful for any type of users and working environment of companies.<br>
        It is available on <img src="<?= base_url('assets/imgs/en_flag.jpg') ?>" alt="England flag"><b>English</b>, 
        <img src="<?= base_url('assets/imgs/gr_flag.jpg') ?>" alt="Germany flag"><b>German</b>,
		<img src="<?= base_url('assets/imgs/fr_flag.jpg') ?>" alt="England flag"><b>French</b>
        and <img src="<?= base_url('assets/imgs/bg_flag.jpg') ?>" alt="Bulgarian flag"><b>Bulgarian</b> languages!
    </h4>
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
    <hr>
    <h4 class="text-center">Just part of all features! We can't present you all, they are so many..</h4>
</div>