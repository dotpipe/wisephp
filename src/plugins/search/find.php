<?php

    use src\oauth2\CRUD;

    include("/../../../vendor/autoload.php");

    $crud = new CRUD("../../config/config.json");

    $table = "test";
    if ($_GET['keywords'] == "" || $_GET['keywords'] == null)
        return;
    $keywords = $_GET['keywords'];
    $exp_keys = explode(" ", $keywords);
    $key_string = "";
    foreach ($exp_keys as $key => $value)
    {
        if (strlen($key_string) > 0)
            $key_string .= " OR ";
        $key_string .= "`test`.`keywords` like '%$value%'";
    }
    $read = $crud->read(
        [
            $table =>
            [
                "id",
                "category1",
                "category2",
                "title",
                "author"
            ]
        ],
        $key_string
    );
    
    $returning = [];
    $cat = [];
    
    foreach ($read as $key)
    {
        foreach($key as $rk => $rv) {
            if (is_int($rk) || $rk == "id") {}
            else if ($rk == "title")
                $returning[] = '<br><div name="tid" method="GET" ajax="idgrab.php" value="' . $key['id'] . '" insert="details" id="id">' . $rv . '<text class="gotoitem">></text></div><br>';
            else
                $cat[] = $rv;
        }
    }
    $returning = array_unique($returning);
    $cat = array_unique($cat);
    $show = '<pre onload="javascript:changeresults()" id="category">Categories</pre>
    <pre id="categories"><br>';
    if (count($cat) > 0) {
        foreach ($cat as $f => $g)
        {
            $show .= '<x class="current" name=""><span>' . $g . '</span></x><br>';
        }
    }
    $show .= '</pre>
    <pre id="title">' . count($returning) . ' Results </pre>
    <pre id="results" width="296">';
    if (count($returning) > 0)
    {   
      foreach ($returning as $f => $g)
        {
            $show .= $g;
        }
    }
    else
        $show .= '<br><span class=\"listitem\"><text>Search Returned Nothing...</text></span>';
    $show .= '</pre>';
    echo $show;
?>