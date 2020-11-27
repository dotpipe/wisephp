<?php
/*
if (!isset($_SESSION))
    session_start();

$ini = json_decode(file_get_contents(__DIR__ . "\\chat.ini"));

$_SESSION['host'] = (isset($ini->host)) ? $ini->host : "localhost";
$_SESSION['username'] = (isset($ini->host)) ? $ini->username : "root";
$_SESSION['password'] = (isset($ini->host)) ? $ini->password : "";
$_SESSION['database'] = (isset($ini->host)) ? $ini->database : die("No Database Selected. Please check chat.ini in your root folder.");
$_SESSION['port'] = (isset($ini->host)) ? $ini->port : "port";

include_once("../../../vendor/autoload.php");

$results = $cnxn->query('SELECT * FROM tokenName WHERE (aim = "' . $_COOKIE['myemail'] . '" || start = "' . $_COOKIE['myemail'] . '") LIMIT 1');

if ($results->num_rows == 1) {
    $row = $results->fetch_assoc();
    print_r($row['tokenName']);
}
else {
    print_r("Error: Record not found");
}
*/
