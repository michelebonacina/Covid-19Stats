<?php

require_once 'controller/configuration.php';
require_once 'model/global_data.php';

/**
 * Global data management.
 *
 * @author Michele Bonacina
 */
class GlobalDataController {

    public static function loadGlobalData() {
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

}
