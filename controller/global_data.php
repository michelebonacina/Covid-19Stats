<?php

require_once 'controller/configuration.php';
require_once 'model/global_data.php';

/**
 * Global data management.
 *
 * @author Michele Bonacina
 */
class GlobalDataController {

    private static function checkNewData($globalData) {
        // TODO
    }

    private static function loadGlobalData() {
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
        // return global data
        return $globalData;
    }

    private static function loadGlobalHistoryData() {
        // load row data
        $url = ConfigurationController::$globalDataHistoryURL;
        $rowContents = file_get_contents($url);
        $rowData = json_decode($rowContents, true);
        $globalHistoryData = [];
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
            array_push($globalHistoryData, $globalData);
        }
        // return global history data
        return $globalHistoryData;
    }

    public static function getGlobalData($forceReload = false) {
        if ($forceReload || !isset($_SESSION[__CLASS__ . '-globalData'])) {
            echo("RELOAD");
            $globalData = self::loadGlobalData();
            // check new data
            self::checkNewData($globalData);
            $_SESSION[__CLASS__ . '-globalData'] = base64_encode(serialize($globalData));
        }
        return unserialize(base64_decode($_SESSION[__CLASS__ . '-globalData']));
    }

    public static function getGlobalHistoryData() {
        if (!isset($_SESSION[__CLASS__ . '-globalHistoryData'])) {
            echo("RELOAD HISTORY");
            $_SESSION[__CLASS__ . '-globalHistoryData'] = base64_encode(serialize(self::loadGlobalHistoryData()));
        }
        return unserialize(base64_decode($_SESSION[__CLASS__ . '-globalHistoryData']));
    }

}
