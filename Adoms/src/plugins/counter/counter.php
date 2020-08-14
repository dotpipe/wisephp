<?php

namespace Adoms\src\lib;

include("../../../../vendor/autoload.php");

$cntMap = new Map();

$cnt = 0;
if (file_exists("counter.json")) {
    $cntMap->loadJSON("counter.json");
    $cnt = $cntMap->dat[$_SERVER['REQUEST_URI']];
}
echo ++$cnt;
$cntMap->add($_SERVER['REQUEST_URI'], $cnt);

$cntMap->save("counter.json");

?>