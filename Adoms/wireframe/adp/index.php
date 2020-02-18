<?php

namespace Adoms\wireframe;

$my = function ($pClassName) {
    include_once(__DIR__ . "/../../" . strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);

$pgsv = new PageViews("adp","../../BestPHPEverNow");

$pgsv->viewPartial("index.php");

?>
