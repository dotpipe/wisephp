<?php
namespace Adoms\oauth2;


require_once __DIR__ . '../../../../vendor/autoload.php';
$PARAM = ($_SERVER['REQUEST_METHOD'] == "POST") ? $_POST : $_GET;

if (count($PARAM) == 0 && $_COOKIE['TOK'] == "")
{}
else {
    echo "\nCONNECTED TO: " . $_SERVER['SERVER_HOST'];
    echo "\nCONNECTION REQUESTED FROM: " . $_SERVER['REMOTE_HOST'];
    $oauth2 = new OAuth2Owner();
    $oauth2->login();
    $oauth2->checkexpiry();
    $oauth2->home_dir();
}

?>