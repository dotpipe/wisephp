<?php

namespace Adoms\src\oauth2;

$PARAM = ($_SERVER['REQUEST_METHOD'] == "POST") ? $_POST : $_GET;


if (count($PARAM) < 6){
    echo "\nPlease read documentation on completing a OAuth2 connection to this site.";
    echo "\nSite is using Adoms::Helium 2.0.3 for OAuth2";
    echo "\nSite needs:\n REQUEST, USERNAME, PASSWORD, REALM, AND TABLE\nto perform its actions";
    exit();
}
else {
    echo "\nCONNECTED TO: " . $_SERVER['SERVER_HOST'];
    echo "\nCONNECTION REQUESTED FROM: " . $_SERVER['REMOTE_HOST'];
    echo "\nREQUEST SUBMITTED: " . $PARAM['REQUEST'];
    if (strtolower($PARAM['REQUEST']) == "oauth2")
        echo "\nREQUEST ACKNOWLEDGED";
    $oauth2 = new OAuth2Owner();
    $oauth2->login($PARAM);

}


?>