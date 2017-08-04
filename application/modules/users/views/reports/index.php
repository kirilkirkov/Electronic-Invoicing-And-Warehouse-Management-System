<script src="<?= base_url('assets/highcharts/highcharts.js') ?>"></script>
<script src="<?= base_url('assets/highcharts/modules/exporting.js') ?>"></script>
<div class="selected-page">
    <div class="inner">
        <h1> 
            <?= lang('reports') ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= lang_url('user') ?>"><?= lang('home') ?></a></li> 
            <li class="active"><?= lang('reports') ?></li>
        </ol>
    </div> 
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
            <div class="form-group">
                <select class="selectpicker" name="payment_status"> 
                    <option <?= !isset($_GET['payment_status']) || $_GET['payment_status'] == 'all' ? 'selected="selected"' : '' ?> value="all"><?= lang('report_show_all') ?></option>
                    <option <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'paid' ? 'selected="selected"' : '' ?> value="paid"><?= lang('report_show_paid') ?></option>
                    <option <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'unpaid' ? 'selected="selected"' : '' ?> value="unpaid"><?= lang('report_show_unpaid') ?></option>
                    <option <?= isset($_GET['payment_status']) && $_GET['payment_status'] == 'partly_paid' ? 'selected="selected"' : '' ?> value="partly_paid"><?= lang('report_show_partly_paid') ?></option>
                </select>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" <?= isset($_GET['show_drafts']) && $_GET['show_drafts'] == 'true' ? 'checked="checked"' : '' ?> name="show_drafts" value="true"><?= lang('show_drafts_report') ?></label>
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
            echo $issuedByMonthNum['num'] . ',';
        }
        ?>]
                    },
    <?php }
    ?>]
        });</script>

    <div id="amount-of-invoices-by-month"></div>
    <script>
        Highcharts.chart('amount-of-invoices-by-month', {
        chart: {
        type: 'line'
        },
                title: {
                text: '<?= str_replace('%currency%', $firmCurrency, lang('amount_invoices_by_month_stat')) ?>'
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
            echo $issuedByMonthNum['sum'] . ',';
        }
        ?>]
                    },
    <?php }
    ?>]
        });</script>

    <div id="top-clients"></div>
    <script>
        Highcharts.chart('top-clients', {
        chart: {
        type: 'column'
        },
                title: {
                text: '<?= str_replace('%currency%', $firmCurrency, lang('top_clients_stat')) ?>'
                },
                subtitle: {
                text: '<?= $betweenDates ?>'
                },
                xAxis: {
                type: 'category',
                        labels: {
                        rotation: - 45,
                                style: {
                                fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                }
                        }
                },
                legend: {
                enabled: false
                },
                tooltip: {
                pointFormat: '<?= lang('sum_of_invoices_in_stat') ?> <b>{point.y:.1f} <?= $firmCurrency ?></b>'
                },
                series: [{
                name: '',
                        data: [
    <?php foreach ($topClients as $topClient) { ?>
                            ['<?= $topClient['client'] ?>', <?= $topClient['sumInvoices'] ?>],
    <?php } ?>
                        ],
                        dataLabels: {
                        enabled: true,
                                rotation: - 90,
                                color: '#FFFFFF',
                                align: 'right',
                                format: '{point.y:.1f}', // one decimal
                                y: 10, // 10 pixels down from the top
                                style: {
                                fontSize: '13px',
                                        fontFamily: 'Verdana, sans-serif'
                                }
                        }
                }]
        });
    </script>
<?php } else { ?>
    <h1 class="no-results-found"><?= lang('no_reports_yet') ?></h1>
<?php } ?>
