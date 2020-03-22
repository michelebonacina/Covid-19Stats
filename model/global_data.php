<?php

    class GlobalData {

    }    

function loadGlobalData($url)
{
    // TODO: insert url in global parameter
    $contents = file_get_contents($url);
    $data = json_decode($contents, true);
    echo $data[0]["data"];
}
