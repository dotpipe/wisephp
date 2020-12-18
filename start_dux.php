<?php declare (strict_types = 1);

namespace wise;

use dux;

require_once __DIR__ . '/vendor/autoload.php';    

$dux = new src\dux\dux();
$path = realpath("/mnt/c/xampp/htdocs/wise/wise/src");
$dux->start($path);

?>