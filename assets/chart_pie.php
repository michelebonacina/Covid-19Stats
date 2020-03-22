<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Pie Chart Example
    var params = <?= json_encode($params) ?>;
    var dataElementId = params.elementId;
    var dataLabels = params.labels;
    var dataValues = params.values;
    var dataBackgroudColor = params.backgroundColor;

    var ctx = document.getElementById(dataElementId);
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: dataLabels,
            datasets: [{
                    data: dataValues,
                    backgroundColor: dataBackgroudColor,
                }],
        },
    });
</script>