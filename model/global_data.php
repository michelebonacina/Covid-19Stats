<?php

/**
 * Contains global data information.
 */
class GlobalData {

    public $date;
    public $country;
    public $synptomaticRecoverd;
    public $intensiveCare;
    public $totalHospitalized;
    public $homeIsolation;
    public $totalActualPositive;
    public $newActualPositive;
    public $dischargedHealed;
    public $deceased;
    public $totalCases;
    public $swabs;

    public function isSameDay(int $date) {
        return date('d-m-Y', $date) == date('d-m-Y', $this->date);
    }

}
