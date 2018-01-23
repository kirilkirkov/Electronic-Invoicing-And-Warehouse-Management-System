<?php
/*
 * This file is loaded in home page and reports page
 */
?>
<script>
    Highcharts.chart('report-num-invoices', {
        chart: {
            type: 'column'
        },
        title: {
            text: '<?= lang('num_invoices_stat') ?>'
        },
        subtitle: {
            text: '<?= $betweenDates ?>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            },
            labels: {
                formatter: function () {
                    return Highcharts.numberFormat(this.value, 0);
                }
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<?= lang('num_created') ?>'
        },
        series: [{
                name: '<?= lang('issued') ?>',
                data: [
<?php foreach ($issuedInvoices as $key => $val) { ?>
                        ['<?= $inv_readable_types[$key] ?>', <?= $val ?>],

<?php } ?>
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.0f}', // one decimal
                    y: 10, // 10 pixels down from the top
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
    });
</script>