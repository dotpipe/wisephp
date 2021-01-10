<?php

    use src\oauth2\CRUD;

    include("../../../../vendor/autoload.php");

    $crud = new CRUD("../../config/config.json");

    $table = "test";
    if (!isset($_GET['tid']) || $_GET['tid'] == "" || $_GET['tid'] == null)
        return;
    $id = $_GET['tid'];
    $key_string = "`test`.`id` = $id";

    $read = $crud->read(
        [
            $table =>
            [
                "title",
                "author"
            ]
        ],
        $key_string
    );
    
    $returning = [];
    $cat = [];
    
    $show = '<text>Details</text>';
    $show .= '<pre><br>';
    if (count($read) > 0) {
        foreach ($read as $h => $f)
        {
            $f = array_unique($f); 
            foreach($f as $g => $c)
            {
                if ($g == "author")
                    $show .= '<x class="current"><span>Author: ' . $c . '</span></x><br>';
                else
                    $show .= '<x class="current"><span>Title: ' . $c . '</span></x><br>';
            }
        }
    }
    $show .= '</pre>';
    echo $show;
?>