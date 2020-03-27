<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Area Chart Example
    var params = <?= json_encode($params) ?>;
    var ctx = document.getElementById(params.elementId);
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: params.labels,
            datasets: [{
                    label: "Sessions",
                    lineTension: 0.3,
                    backgroundColor: params.backgroundColor,
                    borderColor: params.lineColor,
                    pointRadius: 5,
                    pointBackgroundColor: params.lineColor,
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: params.lineColor,
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: params.values,
                }],
        },
        options: {
            scales: {
                xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                yAxes: [{
                        ticks: {
                            min: 0,
                            max: Math.max(...params.values),
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
            },
            legend: {
                display: false
            }
        }
    });
</script>
