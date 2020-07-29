<?php

require_once __DIR__ . '../../../../vendor/autoload.php';

$con = mysqli_connect($_SESSION['host'], $_SESSION['username'], $_SESSION['password'], $_SESSION['database'], $_SESSION['port']) or die("Error: Cannot create connection");

$results = $con->query('SELECT id, filename FROM chat WHERE 1');
$var = [];
$temp = 0;

// recover filenames
while ($var = $results->fetch_assoc()) {
    if (file_exists("../chatxml/" . $var['filename']))
        continue;
    if (!file_exists("../chatxml/" . $var['filename'])) {
        file_put_contents("../chatxml/" . $var['filename'], "<?xml version='1.0'?><?xml-stylesheet type='text/xsl' href='chatxml.xsl' ?><messages></messages>");
        chmod('../chatxml/' . $var['filename'], 0644);
    }
}

?>