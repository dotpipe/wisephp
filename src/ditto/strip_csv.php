<?php declare (strict_types = 1);

$mpr = fopen("assertions.csv", 'r');
$mpw = fopen("assertions.html", 'w');
$tmp = '<select id="assertions" onchange="x(this)" style="float:right;width:280">';
fwrite($mpw, $tmp);
$gets = fgets($mpr);
do {
    $gets = fgets($mpr);
    $tmp = substr($gets, 0, strpos($gets,"("));
    $params = substr($gets, strpos($gets,"(") + 1, - 4);
    $html = '<option id="' . $tmp . '" params=\'(' . $params . '\'>' . $tmp . '</option>';
    fwrite($mpw, $html);
    $gets = fgets($mpr);
} while ($gets != false);
$tmp = '</select>';
fwrite($mpw, $tmp);
fclose($mpw);
fclose($mpr);
$mpr = fopen("annotations.csv", 'r');
$mpw = fopen("annotations.html", 'w');
$tmp = '<select id="annotations" onchange="x(this)" style="float:right;width:280">';
fwrite($mpw, $tmp);

$gets = fgets($mpr);
do {
    $tmp = substr($gets, 1, -4);
    $html = '<option id=' . $tmp . '>' . $tmp . '</option>';
    fwrite($mpw, $html);
    $gets = fgets($mpr);
}while ($gets != false);
$tmp = '</select>';
fwrite($mpw, $tmp);
fclose($mpw);
fclose($mpr);
