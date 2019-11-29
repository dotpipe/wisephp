<?php

function io_xx($lock_mx, &$i)
{
    $_haystack = ['\n', '\r', '\t', '{', '}', '(', ')', ' ', ';'];
    $_class = "";
    $j = $i;

    do {
        if ($i == strlen($lock_mx)) {
            break;
        }
        $_class .= $lock_mx[$i];
        if (in_array($lock_mx[$i], $_haystack)) {

            //echo $_class . "-";
            $_class = substr($lock_mx, $i, strlen($_class));
            //$i++;
            //continue;
        }
        $i++;
    } while ($i < strlen($lock_mx) && !in_array($lock_mx[$i], $_haystack));
    //echo $_class . "-".$i."@";
    return trim($_class);
}

function io_pmx($lock_mx, &$i)
{
    $_haystack = ['\n', '\r', '\t', ')'];
    $j = 0;
    $ol = 0;
    $pl = $i;
    $_class = "";
    do {
        $_class .= $lock_mx[$i];
        $i++;
    } while ($i < strlen($lock_mx) && !in_array($lock_mx[$i], $_haystack));

    return trim($_class);
}

function io__x($lock_mx, &$i, $lm)
{
    $cm = $i - ($i % 10000);
    $kp = $i;
    $_class = "";
    while (++$cm % 10000 < 9999 && $i < strlen($lock_mx) && $lm != substr($lock_mx, $i, strlen($lm))) {
        $i++;
    }
    //echo $_class . "-";
    if (substr($lock_mx, $i, strlen($lm)) == $lm) {
        return trim(substr($lock_mx, $i, strlen($lm)));
    }
    $i = $kp;
    return null;
}

$mp = fopen("assertions.csv", 'r');
$lock_mx = fread($mp, filesize("assertions.csv"));
fclose($mp);
$i = 0;
$com = "";
$arr = [];
$mp = fopen("assertions.html", 'w');
$tmp = '<select id="assertions" onchange="x(this)" style="float:right;width:280">';
fwrite($mp, $tmp);
while ($i < strlen($lock_mx)) {

    if (io__x($lock_mx, $i, '"assert') != null) {
        $tmp = io_x($lock_mx, $i);
        $tmp = substr($tmp, 1, strlen($tmp) - 2);
        $html = '<option id="' . $tmp . '">' . $tmp . '</option>';
        fwrite($mp, $html);
    } else {
        $i += 100;
    }
}

$tmp = '</select>';
fwrite($mp, $tmp);
fclose($mp);

$mp = fopen("annotations.csv", 'r');
$lock_mx = fread($mp, filesize("assertions.csv"));
fclose($mp);
$mp = fopen("annotations.html", 'w');
$i = 0;
$tmp = '<select id="annotations" onchange="x(this)" style="float:right;width:280">';
fwrite($mp, $tmp);
while ($i < strlen($lock_mx)) {

    if (io__x($lock_mx, $i, '"@') != null) {
        $tmp = io_xx($lock_mx, $i);
        $n = 2;
        $tmp1 = substr($tmp, 2, strlen($tmp)-$n);
        $tmp2 = substr($tmp, 1, strlen($tmp)-$n);
        $html = '<option id="' . $tmp1 . '">' . $tmp2 . '</option>';
        fwrite($mp, $html);
    } else {
        $i += 1000;
    }
}
$tmp = '</select>';
fwrite($mp, $tmp);
fclose($mp);
