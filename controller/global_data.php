<?php

require_once 'controller/configuration.php';
require_once 'model/global_data.php';

/**
 * Global data management.
 *
 * @author Michele Bonacina
 */
class GlobalDataController {

    /**
     * Check if the global history data list is updated.
     * Assumed that the global data passed is the last version, checks if its date is 
     * the same as the max date in global history data list. 
     * If yes is updated and all is ok.
     * Otherwise is outdated and load the online history list.
     * @param GlobalData $globalData 
     */
    private static function checkNewData(GlobalData $globalData) {
        // TODO
    }

    /**
     * Load global data from online sources.
     * @return global data loaded
     */
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

    /**
     * Load global history data from online sources.
     * @return loaded array of global history data 
     */
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

    /**
     * Gets global data.
     * If present returns the cached version, otherwise loads and returns it.
     * @param bool $forceReload force reload online version overwriting the cached
     * @return GlobalData global data
     */
    public static function getGlobalData(bool $forceReload = false) {
        if ($forceReload || !isset($_SESSION[__CLASS__ . '-globalData'])) {
            $globalData = self::loadGlobalData();
            // check new data
            self::checkNewData($globalData);
            $_SESSION[__CLASS__ . '-globalData'] = base64_encode(serialize($globalData));
        }
        return unserialize(base64_decode($_SESSION[__CLASS__ . '-globalData']));
    }

    /**
     * Gets global history data list.
     * If present returns the cached version, otherwise loads and returns it.
     * @return GlobalData array of global history data
     */
    public static function getGlobalHistoryData() {
        if (!isset($_SESSION[__CLASS__ . '-globalHistoryData'])) {
            $_SESSION[__CLASS__ . '-globalHistoryData'] = base64_encode(serialize(self::loadGlobalHistoryData()));
        }
        return unserialize(base64_decode($_SESSION[__CLASS__ . '-globalHistoryData']));
    }

    /**
     * List dates from local history data.
     * @return array of dates
     */
    public static function getGlobalHistoryValues($property) {
        // get global history data
        $globalHistoryData = self::getGlobalHistoryData();
        // get date list
        $dateList = [];
        foreach ($globalHistoryData as $globalData) {
            array_push($dateList, $globalData->{$property});
        }
        // return date list
        return $dateList;
    }

    public static function getGlobalDataByDate($date) {
        $globalHistoryData = self::getGlobalHistoryData();
        $toReturn = null;
        foreach ($globalHistoryData as $globalData) {
            if ($globalData->isSameDay($date)) {
                $toReturn = $globalData;
            }
        }
        return $toReturn;
    }

}
