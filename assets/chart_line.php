<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    var params = <?= json_encode($params) ?>;

    var datasets = [];
    params.values.forEach(
            function (value, index)
            {
                datasets.push(
                        {
                            label: params.titles[index],
                            backgroundColor: params.lineColor[index],
                            borderColor: params.lineColor[index],
                            data: value,
                            fill: false,
                        }
                );
            }
    );
    console.log(datasets);

    var ctx = document.getElementById(params.elementId);
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: params.labels,
            datasets: datasets,
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                        }
                    }],
                yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                        }
                    }]
            }
        }
    });
</script>
