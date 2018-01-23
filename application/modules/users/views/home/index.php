<?php
if (SELECTED_COMPANY_ID != null) { // in first login we dont have companies and this is null
    ?>
    <script src="<?= base_url('assets/highcharts/highcharts.js') ?>"></script>
    <script src="<?= base_url('assets/highcharts/modules/exporting.js') ?>"></script>
    <div class="selected-page">
        <div class="inner">
            <h1> 
                <?= lang('home') ?>
            </h1> 
        </div> 
    </div>
    <div class="home-page">
        <?php
        if (!empty($issuedInvoices)) {
            ?>
            <div id="report-num-invoices"></div>
            <?php include 'application/modules/users/views/reports/reportNumInvoices.php'; ?>
        <?php } else { ?>
            <h1 class="no-results-found"><?= lang('no_reports_yet_all_time') ?></h1>
            <div class="text-center">
                <a href="<?= lang_url('user/new/invoice') ?>" class="btn btn-green"><?= lang('create_first_one_inv') ?></a>
            </div>
            <?php
        }
        ?>
    </div> 
<?php }
?>