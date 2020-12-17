<?php

require '../../lib/map.php';

$nMap = new wise\src\lib\Map();

$email = "inland14@live.com";

$nMap->loadJSON(__DIR__ . "/counter.json");

$message = "";

foreach ($nMap->dat as $key => $val) {
    $message .= $key . ": " . $val . "\r\n";
}



//$headers["From"] = "
$head = "From: wise Homepage <$email>\r\n";
//$headers['Return-path'] =
$head .= "Return-path: $email\r\n";
//$headers['Content-type'] = 'text/html; charset=iso-8859-1';

mail($email, "Total hits", $message, $head); 

?>