<script src="<?= base_url('assets/highcharts/highcharts.src.js') ?>"></script>
<script src="<?= base_url('assets/highcharts/modules/exporting.js') ?>"></script>
<div class="selected-page">
    <div class="inner">
        <h1>
            <i class="fa fa-file-text-o" aria-hidden="true"></i>
            <?= lang('reports') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Library</a></li>
            <li class="active">Data</li>
        </ol>
    </div>
    <div class="border"></div>
</div>
<div class="reports-page">
    <div class="dates"> 
        <form class="form-inline site-form" action="" method="GET">
            <div class="form-group">
                <label for="from_date"><?= lang('from_date') ?></label>
                <input class="form-control field datepicker" value="<?= isset($_GET['from_date']) ? $_GET['from_date'] : '' ?>" id="from_date" name="from_date" placeholder="dd.mm.yyyy" type="text">
            </div>
            <div class="form-group">
                <label for="to_date"><?= lang('to_date') ?></label>
                <input class="form-control field datepicker" value="<?= isset($_GET['to_date']) ? $_GET['to_date'] : '' ?>" id="to_date" name="to_date" placeholder="dd.mm.yyyy" type="text">
            </div> 
            <button type="submit" class="btn btn-default"><?= lang('show_statistic') ?></button>
        </form> 
    </div>
</div>
<?php if (!empty($issuedInvoices)) { ?>
    <div id="report-num-invoices"></div>
    <?php include 'application/modules/users/views/reports/reportNumInvoices.php'; ?>

    <div id="num-invoices-by-month"></div>
    <script>
        Highcharts.chart('num-invoices-by-month', {
            chart: {
                type: 'line'
            },
            title: {
                text: '<?= lang('num_invoices_by_month_stat') ?>'
            },
            subtitle: {
                text: '<?= $betweenDates ?>'
            },
            xAxis: {
                categories: [<?php
    foreach ($issuedInvoicesByMonth['invoice'] as $issuedByMonthKey => $issuedByMonthVal) {
        echo "'" . $issuedByMonthKey . "',";
    }
    ?>]
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [
    <?php foreach ($issuedInvoicesByMonth as $issuedByMonthKey => $issuedByMonthVal) { ?>
                    {
                        name: '<?= $issuedByMonthKey ?>',
                        data: [<?php
        foreach ($issuedByMonthVal as $issuedByMonthNum) {
            echo $issuedByMonthNum . ',';
        }
        ?>]
                    },
    <?php }
    ?>]
        });
    </script>
<?php } else { ?>
    <h1 class="no-invoices"><?= lang('no_reports_yet') ?></h1>
<?php } ?>
