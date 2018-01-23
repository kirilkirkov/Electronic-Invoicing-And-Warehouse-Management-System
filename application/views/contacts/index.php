<div id="subpage">
    <div class="container">
        <h1><img src="<?= base_url('assets/public/imgs/pm-subpages.png') ?>" alt="pm:"><?= lang('contacts') ?></h1>
    </div>
</div>
<div class="container" id="support">
    <div class="row">
        <div class="col-sm-6 hidden-xs">
            <img src="<?= base_url('assets/public/imgs/support-image.jpg') ?>" class="img-responsive" alt="pmTicket support">
        </div>
        <div class="col-sm-6 contact-form">
            <?php
            if ($this->session->flashdata('success_send')) {
                ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success_send') ?>
                </div>
                <?php
            }
            ?>
            <h2><?= lang('write_us') ?></h2>
            <form role="form" method="POST" action="">
                <div class="form-group">
                    <input type="text" name="name" placeholder="<?= lang('your_name') ?>" class="form-control">
                    <i class="fa fa-user fa-2x" aria-hidden="true"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="email" placeholder="<?= lang('your_email') ?>" class="form-control">
                    <i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="header" placeholder="<?= lang('your_subject') ?>" class="form-control">
                    <i class="fa fa-header fa-2x" aria-hidden="true"></i> 
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" id="comment"></textarea>
                    <i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
                </div>
                <button type="submit" name="sendEmail" class="btn btn-lg btn-primary pull-right"><?= lang('send') ?></button>
                <div class="clearfix"></div>
            </form>
            <h2><?= lang('or_send_to') ?></h2>
            <a href="mailto:support@pmticket.com" class="mailto shadows-font">support@pmticket.com</a>
        </div>
        <div class="col-sm-6 visible-xs">
            <img src="<?= base_url('assets/imgs/support-image.jpg') ?>" class="img-responsive" alt="pmTicket support">
        </div>
    </div>
</div>