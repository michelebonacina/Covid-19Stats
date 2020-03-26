<?php

/**
 * Contains global data information.
 */
class GlobalData {

    public int $date;
    public string $country;
    public int $synptomaticRecoverd;
    public int $intensiveCare;
    public int $totalHospitalized;
    public int $homeIsolation;
    public int $totalActualPositive;
    public int $newActualPositive;
    public int $dischargedHealed;
    public int $deceased;
    public int $totalCases;
    public int $swabs;

    public function isSameDay(int $date) {
        return date('d-m-Y', $date) == date('d-m-Y', $this->date);
    }

}
