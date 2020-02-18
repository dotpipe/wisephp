<?php

namespace Adoms\wireframe;

$my = function ($pClassName) {
    include_once("c:\\xampp\\htdocs\\Adoms\\" . strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);

$pgsv = new PageViews("adp","index");

$pgsv->viewPartial("index.php");

$pgsv->viewPartial("ad");

?>