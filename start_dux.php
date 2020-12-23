<?php declare (strict_types = 1);

namespace wise;

use dux;

require_once __DIR__ . '/vendor/autoload.php';    

$dux = new src\dux\dux();
$path = realpath("/mnt/c/xampp/htdocs/wise/wise/src");
$dux->start($path);

echo "\nClasses found: $dux->classes_total\t";
echo "Classes Undocumented: $dux->classes_undocd\t";
echo "Methods found: $dux->methods_total\t";
echo "Methods Documented: $dux->methods_docd\n";
?>