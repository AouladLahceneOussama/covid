<?php

namespace App\Src;

use App\Src\Methods;

$methods = new Methods();

switch ($_POST['method']) {
    case "getCItyByRegion":
        $regionID = $_POST['regionID'];
        $methods->getCityByRegion($regionID);
        break;
    case "getRegionName":
        $regionID = $_POST['regionID'];
        $methods->getNameByID($regionID);
        break;
    default:
        echo "Error";
}
