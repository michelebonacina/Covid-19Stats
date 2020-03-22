<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Example
    var params = <?= json_encode($params) ?>;
    
    var ctx = document.getElementById(params.elementId);
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: params.labels,
            datasets: [{
                    label: "Revenue",
                    backgroundColor: params.backgroundColor,
                    borderColor: params.backgroundColor,
                    data: params.values,
                }],
        },
        options: {
            scales: {
                xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                yAxes: [{
                        ticks: {
                            min: 0,
                            max: Math.max(...params.values),
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
                        }
                    }],
            },
            legend: {
                display: false
            }
        }
    });
</script>