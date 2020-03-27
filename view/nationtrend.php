<?php
require_once("controller/global_data.php");

$dates = GlobalDataController::getGlobalHistoryValues('date');
foreach ($dates as $i=>$date) {
    $dates[$i] = date('d-m-Y', $date);
}

$totalActualPositive = GlobalDataController::getGlobalHistoryValues('totalActualPositive');
$dischargedHealed = GlobalDataController::getGlobalHistoryValues('dischargedHealed');
$deceased = GlobalDataController::getGlobalHistoryValues('deceased');

?>
<!-- main -->
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Andamento Nazionale</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Andamento Nazionale</li>
        </ol>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-chart-line mr-1"></i>Andamento Complessivo</div>
                    <div class="card-body"><canvas id="dailyArea" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
    </div>
    <!-- charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <?php
    $params = [
        'elementId' => "dailyArea",
        'labels' => $dates,
        'titles' => ['Positivi', 'Dimessi', 'Deceduti'],
        'values' => [$totalActualPositive, $dischargedHealed, $deceased],
        'lineColor' => ['#ffc107', '#28a745', '#dc3545'],
    ];
    include 'assets/chart_line.php';
    ?>
</main>