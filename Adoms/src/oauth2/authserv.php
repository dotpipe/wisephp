<?php
namespace Adoms\src\oauth2;


require_once __DIR__ . '../../../../vendor/autoload.php';
$PARAM = ($_SERVER['REQUEST_METHOD'] == "POST") ? $_POST : $_GET;

if (count($PARAM) == 0 && $_COOKIE['TOK'] == "")
{}
else {
    echo "\nCONNECTED TO: " . $_SERVER['SERVER_HOST'];
    echo "\nCONNECTION REQUESTED FROM: " . $_SERVER['REMOTE_HOST'];
    $crud = new CRUD('../config/config.ini');
    $oauth2 = new OAuth2Owner();
    $oauth2->login('../config/config.ini',$PARAM);
    $oauth2->checkexpiry($PARAM,$crud);
}

?>