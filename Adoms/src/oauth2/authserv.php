<?php

$PARAM = ($_SERVER['REQUEST_METHOD'] == "POST") ? $_POST : $_GET;

if (count($PARAM) == 0 && $_COOKIE['TOK'] == "")
    exit();
else {
    echo "\nCONNECTED TO: " . $_SERVER['SERVER_HOST'];
    echo "\nCONNECTION REQUESTED FROM: " . $_SERVER['REMOTE_HOST'];
    $oauth2 = new OAuth2();
    $oauth2->login();
    $oauth2->checkexpiry();
}

?>