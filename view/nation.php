<?php
require_once('controller/global_data.php');

$url = $_SERVER['PHP_SELF'] . '?page=nation';
$dateList = GlobalDataController::getGlobalHistoryDates();
$date = isset($_GET['date']) ? $_GET['date'] : $dateList[sizeof($dateList) - 1];
$globalData = GlobalDataController::getGlobalDataByDate($date);
?>
<!-- main -->
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Situazione Nazionale giorno <?= date('d-m-Y', $date) ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Andamento Nazionale al <?= date('d-m-Y H:i', $globalData->date) ?></li>
        </ol>
        <div class="row mb-4">
            <div class="col-md-5">
                <div id="globalCalendar" class="vanilla-calendar"></div>
                <script>
                    let globalCalendar = new VanillaCalendar({
                        selector: "#globalCalendar",
                        date: new Date("<?= date('Y-m-d', $date) ?>"),
                        todaysDate: new Date("<?= date('Y-m-d', $date) ?>"),
                        months: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"],
                        availableDates: [
<?php
foreach ($dateList as $date) {
    echo('{date: "' . date('Y-m-d', $date) . '"},');
}
?>
                        ],
                        datesFilter: true,
                        onSelect: (data, element) => {
                            console.log(data.data.date);
                            window.location.href = '<?= $url ?>&date=' + new Date(data.data.date).getTime() / 1000;
                        }
                    });
                    globalCalendar.init();
                </script>
            </div>
            <div class="col-md-7 my-auto">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Casi Totali</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?= $globalData->totalCases ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Totale Positivi</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?= $globalData->totalActualPositive ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Dimessi Guariti</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?= $globalData->dischargedHealed ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Deceduti</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <?= $globalData->deceased ?>
                                </div>
                            </div>
                        </div>
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