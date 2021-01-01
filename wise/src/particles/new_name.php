<?php

// if ($_SESSION == null)
    session_start();

use wise\src\lib\Set;

require_once '../../../vendor/autoload.php';

$sign_book = new Set();

$sign_book->loadJSON("signed.json");

if (isset($_GET) && isset($_GET['texthere']))
{
  $sign_book->add(stripslashes(htmlspecialchars($_GET['texthere'])));
}

$sign_book->save("signed.json");

$signed_yet = "";
reset($sign_book);
do
{
    if (is_array($sign_book->pt))
    {}
    else {
        $signed_yet .= "<h1><i>" . ($sign_book->pt) . "</i></h1><br>";
    }
} while ($sign_book->Cycle());

echo $signed_yet;

?>