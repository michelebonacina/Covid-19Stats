<?php
require_once("controller/global_data.php");

$globalData = GlobalDataController::getGlobalData(true);
?>
<!-- main -->
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Situazione Globale</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Situazione Globale al <?= date('d-m-Y H:i', $globalData->date) ?></li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Casi Totali</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <?= $globalData->totalCases ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Totale Positivi</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <?= $globalData->totalActualPositive ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Dimessi Guariti</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <?= $globalData->dischargedHealed ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Deceduti</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <?= $globalData->deceased ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-chart-pie mr-1"></i>Situazione Globale</div>
                    <div class="card-body"><canvas id="globalPie" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>Situazione Positivi</div>
                    <div class="card-body"><canvas id="globalBar" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
    </div>
    <!-- charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <?php
    $params = [
        'elementId' => "globalPie",
        'labels' => ['Totale Positivi', 'Dimessi Guariti', 'Deceduti'],
        'values' => [$globalData->totalActualPositive, $globalData->dischargedHealed, $globalData->deceased],
        'backgroundColor' => ['#ffc107', '#28a745', '#dc3545']
    ];
    include 'assets/chart_pie.php';
    ?>
    <?php
    $params = [
        'elementId' => "globalBar",
        'labels' => ['Ricoverati Sintomatici', 'Terapia Intensiva', 'Isolamento Domiciliare'],
        'values' => [$globalData->synptomaticRecoverd, $globalData->intensiveCare, $globalData->homeIsolation],
        'backgroundColor' => '#ffc107'
    ];
    include 'assets/chart_bar.php';
    ?>

</main>