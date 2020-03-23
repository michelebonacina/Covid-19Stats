<?php

require_once 'controller/configuration.php';
require_once 'model/global_data.php';

/**
 * Global data management.
 *
 * @author Michele Bonacina
 */
class GlobalDataController {

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!isset($_SESSION[__CLASS__])) {
            echo ("NOT SET");
            $_SESSION[__CLASS__] = base64_encode(serialize(new GlobalDataController()));
        }
        return unserialize(base64_decode($_SESSION[__CLASS__]));
    }

    private $globalHistoryData = null;

    private function checkNewData($globalData) {
        // TODO
    }

    public function loadGlobalData() {
        // load row data
        $url = ConfigurationController::$globalDataURL;
        $rowContents = file_get_contents($url);
        $rowData = json_decode($rowContents, true);
        $data = $rowData[0];
        // create the global data
        $globalData = new GlobalData();
        $globalData->date = strtotime($data["data"]);
        $globalData->country = $data["stato"];
        $globalData->synptomaticRecoverd = $data["ricoverati_con_sintomi"];
        $globalData->intensiveCare = $data["terapia_intensiva"];
        $globalData->totalHospitalized = $data["totale_ospedalizzati"];
        $globalData->homeIsolation = $data["isolamento_domiciliare"];
        $globalData->totalActualPositive = $data["totale_attualmente_positivi"];
        $globalData->newActualPositive = $data["nuovi_attualmente_positivi"];
        $globalData->dischargedHealed = $data["dimessi_guariti"];
        $globalData->deceased = $data["deceduti"];
        $globalData->totalCases = $data["totale_casi"];
        $globalData->swabs = $data["tamponi"];
        // check new data
        $this->checkNewData($globalData);
        // return global data
        return $globalData;
    }

    public function loadGlobalHistoryData() {
        var_dump($this->globalHistoryData);
        if (is_null($this->globalHistoryData)) {
            echo('STOP');
            // load row data
            $url = ConfigurationController::$globalDataHistoryURL;
            $rowContents = file_get_contents($url);
            $rowData = json_decode($rowContents, true);
            $this->globalHistoryData = [];
            foreach ($rowData as $data) {
                // create the global data
                $globalData = new GlobalData();
                $globalData->date = strtotime($data["data"]);
                $globalData->country = $data["stato"];
                $globalData->synptomaticRecoverd = $data["ricoverati_con_sintomi"];
                $globalData->intensiveCare = $data["terapia_intensiva"];
                $globalData->totalHospitalized = $data["totale_ospedalizzati"];
                $globalData->homeIsolation = $data["isolamento_domiciliare"];
                $globalData->totalActualPositive = $data["totale_attualmente_positivi"];
                $globalData->newActualPositive = $data["nuovi_attualmente_positivi"];
                $globalData->dischargedHealed = $data["dimessi_guariti"];
                $globalData->deceased = $data["deceduti"];
                $globalData->totalCases = $data["totale_casi"];
                $globalData->swabs = $data["tamponi"];
                // add global data to list
                array_push($this->globalHistoryData, $globalData);
            }
        }
        // return global data
        return $this->globalHistoryData;
    }

}
